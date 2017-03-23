import java.io.IOException;
import java.text.DateFormat;
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.ArrayList;

import org.json.JSONArray;
//import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;
import org.testng.Assert;
import org.testng.annotations.Test;

/**
 * This class is for TestNG Integration Test cases related to all
 * functionalities of Inward in HIS Project. developed by Navoda.S & Gayesha.S.
 * for PrescriptiontermResourse.java
 * {@link BaseLogic.BaseTestCase}
 * @author udara.s
 * 
 */



public class PrescriptionTermTestCase extends BaseTestCase {
	public static final int  SUCCESS_STATUS_CODE = 200;
	public  int create_user,no_of_terms; 
	public  String  start_date,end_date,bht_no, term_id;
	
	
	public static String termID;
	DateFormat dateformat = new SimpleDateFormat("yyyy-MM-dd");
	
	/**
	 * This test case is to add new termprescription
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
	
	@Test(groups="his.prescription.Term") 
	public void AddPresceiptionTermTestCase() throws IOException, JSONException, ParseException
	{
		ArrayList<String> resArrayList=getHTTPResponse(properties.getProperty(TestCaseConstants.URL_APPEND_ADD_PRESCRIPTION_TERM),
		TestCaseConstants.HTTP_POST,RequestUtil.requestByID(TestCaseConstants.ADD_PRESCRRIPTION_TERM));	
		
		JSONObject JsonRes=new JSONObject(resArrayList.get(0));
		JSONObject JsonReq=new JSONObject(RequestUtil.requestByID(TestCaseConstants.ADD_PRESCRRIPTION_TERM));
		no_of_terms = Integer.parseInt(JsonRes.getString("no_of_terms"));
		System.out.println(JsonRes);
		bht_no=JsonRes.getJSONObject("bht_no").getString("bhtNo");
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);	
		Assert.assertEquals(no_of_terms, JsonReq.getInt("no_of_terms"));
			 
			 
	}
	
	/**
	 * This test case is to get prescription terms by bht no
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */

	@Test(groups = "his.prescription.Term", dependsOnMethods = { "AddPresceiptionTermTestCase" })
	public void getTermPrescriptionByBHTno() throws IOException, JSONException {

		ArrayList<String> resArrayList = getHTTPResponse(properties.getProperty(TestCaseConstants.URL_APPEND_GET_TERM_PRESCRIPTION_BY_BHT_NO)
				+ bht_no, TestCaseConstants.HTTP_GET, null);
		
		
		JSONArray jsonArray = new JSONArray(resArrayList.get(0));
	
		JSONObject jsonObject = ((JSONObject) jsonArray.get(jsonArray.length() - 1));
		
		term_id = jsonObject.getString("term_id");
		termID = term_id;
		System.out.println("term_id IN TERM= "+ termID);
		
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
		Assert.assertEquals(jsonObject.getJSONObject("bht_no").getString("bhtNo"),bht_no);
		

	 }
	/**
	 * This test case is to update prescriptionTerms 
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
	
	@Test(groups = "his.prescription.Term", dependsOnMethods = { "getTermPrescriptionByBHTno" })
	public void UpdateTermPrescrptionTestCase() throws IOException, JSONException {
		// Get JSON Request body to send prescriptionTerm update Request
		JSONObject jsonRequestObject = new JSONObject(RequestUtil.requestByID(TestCaseConstants.UPDATE_PRESCRIPTION_TERM));
				
				jsonRequestObject.put("term_id", term_id);
		// Send JSON Update prescriptionTerm Request	
				
				System.out.println(jsonRequestObject);
				ArrayList<String> resArrayList=getHTTPResponse(properties.getProperty(TestCaseConstants.URL_APPEND_UPDATE_PRESCRIPTION_TERM),
						TestCaseConstants.HTTP_PUT,jsonRequestObject.toString());	
	
				
				
		//assert the result
				Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
				
				Assert.assertEquals(resArrayList.get(0),jsonRequestObject.getString("term_id"));

			
		
	}
	
	
	
}
