import java.io.IOException;
import java.text.ParseException;
import java.util.ArrayList;

import org.json.JSONArray;
//import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;
import org.testng.Assert;
import org.testng.annotations.Test;

/**
 * This class is for TestNG Integration Test cases related to all
 * functionalities of Inward in HIS Project. developed by Gayesha.S.
 * for InwardNurseNoteResourse.java
 * {@link BaseLogic.BaseTestCase}
 * @author udara.s
 * 
 */
public class InwardNurseNoteTestCase extends BaseTestCase{
	public static final int SUCCESS_STATUS_CODE = 200;
	public String testing,bht_no,note,create_user,date,term_id;
	
	/**
	 * This test case is to add New Inward Nurse Note
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
	@Test(groups="his.prescription.test") 
	public void AddInwardNurseNoteTestCase() throws IOException, JSONException, ParseException
	{
		ArrayList<String> resArrayList=getHTTPResponse(properties.getProperty(TestCaseConstants.URL_APPEND_ADD_INWARD_NURSE_NOTE),
		TestCaseConstants.HTTP_POST,RequestUtil.requestByID(TestCaseConstants.ADD_INWARD_NURSE_NOTE));	
		
		
		JSONObject JsonRes=new JSONObject(resArrayList.get(0));
		JSONObject JsonReq=new JSONObject(RequestUtil.requestByID(TestCaseConstants.ADD_INWARD_NURSE_NOTE));
		
		System.out.println(JsonReq);
		bht_no=JsonRes.getJSONObject("bht_no").getString("bhtNo");
		//term_id=JsonRes.getJSONObject("term_id").getString("term_id");
		//create_user=JsonRes.getJSONObject("create_user").getString("create_user");
		
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);	
		Assert.assertEquals(bht_no, JsonReq.getString("bht_no"));
			 
			 
	}
	
	/**
	 * This test case is to get Diabetic Chart By Bht No
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
	@Test(groups = "his.prescription.test", dependsOnMethods = { "AddInwardNurseNoteTestCase" })
	public void getDiabeticChartByBHTno() throws IOException, JSONException {

		ArrayList<String> resArrayList = getHTTPResponse(properties.getProperty(TestCaseConstants.URL_APPEND_GET_DIABETIC_CHART_BY_BHTNO)
				+ bht_no, TestCaseConstants.HTTP_GET, null);
		
		
		JSONArray jsonArray = new JSONArray(resArrayList.get(0));
	
		JSONObject jsonObject = ((JSONObject) jsonArray.get(jsonArray.length() - 1));
		

		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
		Assert.assertEquals(jsonObject.getJSONObject("bht_no").getString("bhtNo"),bht_no);
		

	 }
	/**
	 * This test case is to get Nurse Note
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
	@Test(groups = "his.prescription.test", dependsOnMethods = { "AddInwardNurseNoteTestCase" })
	public void getNurseNote() throws IOException, JSONException {

		
		ArrayList<String> resArrayList = getHTTPResponse(properties.getProperty(TestCaseConstants.URL_APPEND_GET_NURSE_NOTE),
				TestCaseConstants.HTTP_GET, null);
		
		
		JSONArray jsonArray = new JSONArray(resArrayList.get(0));
	
		JSONObject jsonObject = ((JSONObject) jsonArray.get(jsonArray.length() - 1));
		

		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
		Assert.assertEquals(jsonObject.getJSONObject("bht_no").getString("bhtNo"),bht_no);
		

	 }
	/**
	 * This test case is to Update Term Prescription
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
	
	@Test(groups = "his.prescription.test", dependsOnMethods = { "getDiabeticChartByBHTno" }, dependsOnGroups = { "his.prescription.Term" })
	public void UpdateTermPrescrptionTestCase() throws IOException, JSONException {
		// Get JSON Request body to send prescriptionTerm update Request
		JSONObject jsonRequestObject = new JSONObject(RequestUtil.requestByID(TestCaseConstants.UPDATE_NURSENOTE_TERM_PRESCRIPTION));
		
		jsonRequestObject.put("term_id", PrescriptionTermTestCase.termID);
		// Send JSON Update prescriptionTerm Request	
				ArrayList<String> resArrayList=getHTTPResponse(properties.getProperty(TestCaseConstants.URL_APPEND_UPDATE_NURSE_NOTE_TERM_PRESCRIPTION),
						TestCaseConstants.HTTP_PUT,jsonRequestObject.toString());	
				
				
				
		//assert the result
				Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
				Assert.assertTrue(Boolean.parseBoolean(resArrayList.get(0)));


			
		
	}
}
