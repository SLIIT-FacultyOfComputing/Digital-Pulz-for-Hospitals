import java.io.IOException;
import java.text.DateFormat;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Calendar;
import java.util.Date;
import java.util.TimeZone;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;
import org.testng.Assert;
import org.testng.annotations.Test;


/**
 * This class is for TestNG Integration Test cases related to all
 * functionalities of Pharmacy in HIS Project.
 * 
 * {@link BaseTestCase}
 * @author nisal.d & rubika.m
 * 
 */

public class DrugTestCase extends BaseTestCase{

	public static final int SUCCESS_STATUS_CODE = 200;
	
	public String batchNo;
	public String drugId;
	public String frequencyId;
	public String requestId;
	
	/**
	 * This is Add new Batch Test Case.
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
	@Test(groups = "his.pharmacy.test", dependsOnMethods = {"insertDrugTestCase"})
	public void addDrugBatchTestCase() throws IOException, JSONException {


		DateFormat dateFormat = new SimpleDateFormat("YYYY-MM-dd");		
		dateFormat.setTimeZone(TimeZone.getTimeZone("Asia/Colombo"));
        
        Calendar cal = Calendar.getInstance();
        cal.add(Calendar.YEAR, 1); // to get previous year add -1
        Date nextYear = cal.getTime();
		
        JSONObject jsonObjectRequest = new JSONObject(RequestUtil.requestByID(TestCaseConstants.ADD_DRUG_BATCH));
        
        jsonObjectRequest.put("b_edate", dateFormat.format(nextYear));
        
		ArrayList<String> resArrayList = getHTTPResponse(
				properties.getProperty(TestCaseConstants.URL_APPEND_ADD_DRUG_BATCH), TestCaseConstants.HTTP_POST,
				jsonObjectRequest.toString());
		System.out.println(resArrayList.get(0));
		
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
		Assert.assertEquals(resArrayList.get(0),properties.getProperty(TestCaseConstants.ADD_DRUG_BATCH_SUCCESS_MESSAGE));
	

	}
	
	/**
	 * This is update Batch Test Case.
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
	@Test(groups = "his.pharmacy.test", dependsOnMethods ={"addDrugBatchTestCase", "getAllDrugNamesTestCase"})
	public void updateDrugBatchTestCase() throws IOException, JSONException {


        JSONObject jsonObjectRequest = new JSONObject(RequestUtil.requestByID(TestCaseConstants.UPDATE_DRUG_BATCH));
        
        jsonObjectRequest.put("dbatchno", "B01");
        jsonObjectRequest.put("dsr", drugId);
        
		ArrayList<String> resArrayList = getHTTPResponse(
				properties.getProperty(TestCaseConstants.URL_APPEND_UPDATE_DRUG_BATCH), TestCaseConstants.HTTP_POST,
				jsonObjectRequest.toString());
		System.out.println(resArrayList.get(0));
		
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
		Assert.assertEquals(resArrayList.get(0),properties.getProperty(TestCaseConstants.UPDATE_DRUG_BATCH_SUCCESS_MESSAGE));
	

	}
	
	/**
	 * This is Add new frequency Test Case.
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
	@Test(groups = "his.pharmacy.test")
	public void addFrequencyTestCase() throws IOException, JSONException {


		ArrayList<String> resArrayList = getHTTPResponse(
				properties.getProperty(TestCaseConstants.URL_APPEND_ADD_DRUG_FREQUENCY), TestCaseConstants.HTTP_POST,
				RequestUtil.requestByID(TestCaseConstants.URL_APPEND_ADD_DRUG_FREQUENCY));
		System.out.println(resArrayList.get(0));
		
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
		
	}
	
	/**
	 * This is Add new frequency Test Case.
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
	@Test(groups = "his.pharmacy.test", dependsOnMethods = {"addFrequencyTestCase", "getPharmFrequencyTestCase"})
	public void updateFrequencyTestCase() throws IOException, JSONException {

		JSONObject jsonObjectResponse = new JSONObject(RequestUtil.requestByID(TestCaseConstants.URL_APPEND_UPDATE_DRUG_FREQUENCY));
		
		jsonObjectResponse.put("frequencyId", frequencyId);
		
		ArrayList<String> resArrayList = getHTTPResponse(
				properties.getProperty(TestCaseConstants.URL_APPEND_UPDATE_DRUG_FREQUENCY), TestCaseConstants.HTTP_POST,
				jsonObjectResponse.toString());
		System.out.println(resArrayList.get(0));
		
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
		
	}
	
	/**
	 * This test case is for updating drug
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
	@Test(groups = "his.pharmacy.test", dependsOnMethods = {"insertDrugTestCase"})
	public void updateDrugTestCase() throws IOException, JSONException {


		ArrayList<String> resArrayList = getHTTPResponse(
				properties.getProperty(TestCaseConstants.URL_APPEND_UPDATE_DRUG), TestCaseConstants.HTTP_POST,
				RequestUtil.requestByID(TestCaseConstants.UPDATE_DRUG));
		System.out.println(resArrayList.get(0));
		
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
		Assert.assertEquals(resArrayList.get(0),properties.getProperty(TestCaseConstants.UPDATE_DRUG_SUCCESS_MESSAGE));
	

	}
	
	
	/**
	 * This test case is for insert drug
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
	@Test(groups = "his.pharmacy.test")
	public void insertDrugTestCase() throws IOException, JSONException {


		ArrayList<String> resArrayList = getHTTPResponse(
				properties.getProperty(TestCaseConstants.URL_APPEND_ADD_DRUG), TestCaseConstants.HTTP_POST,
				RequestUtil.requestByID(TestCaseConstants.ADD_DRUG));
		System.out.println(resArrayList.get(0));
		
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
		Assert.assertEquals(resArrayList.get(0),properties.getProperty(TestCaseConstants.ADD_DRUG_SUCCESS_MESSAGE));
	

	}
	
	/**
	 * This test case is for get all dosages
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
	
	@Test(groups = "his.pharmacy.test")
	public void getAllDosagesTestCase() throws IOException, JSONException {
		
		ArrayList<String> resArrayList =getHTTPResponse(properties.getProperty(TestCaseConstants.URL_APPEND_GET_ALL_DOSAGES), TestCaseConstants.HTTP_GET, null);
		
		System.out.print(resArrayList.get(0));
		//System.out.print(jsonArray);
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
		
	}
	

	/**
	 * This test case is for get mail history
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
	
	@Test(groups = "his.pharmacy.test")
	public void getMailHistoryTestCase() throws IOException, JSONException {
		
		ArrayList<String> resArrayList =getHTTPResponse(properties.getProperty(TestCaseConstants.URL_APPEND_GET_DRUG_MAIL_HISTORY), TestCaseConstants.HTTP_GET, null);
		
		System.out.println("Mail History"+resArrayList.get(0));
		//System.out.print(jsonArray);
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
		
	}
	
	/**
	 * This test case is for get all drugs
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
	
	@Test(groups = "his.pharmacy.test")
	public void getAllDrugsTestCase() throws IOException, JSONException {
		
		ArrayList<String> resArrayList =getHTTPResponse(properties.getProperty(TestCaseConstants.URL_APPEND_GET_DRUGS), TestCaseConstants.HTTP_GET, null);
		
		System.out.println("Drugs"+ resArrayList.get(0));
		//System.out.print(jsonArray);
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
		
	}
	
	/**
	 * This test case is for get all drug categories
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
	
	@Test(groups = "his.pharmacy.test")
	public void getAllDrugCategoriesTestCase() throws IOException, JSONException {
		
		ArrayList<String> resArrayList =getHTTPResponse(properties.getProperty(TestCaseConstants.URL_APPEND_GET_DRUG_CATEGORIES), TestCaseConstants.HTTP_GET, null);
		
		System.out.println("Drug Categories: "+resArrayList.get(0));
		//System.out.print(jsonArray);
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
		
	}
	
	/**
	 * This test case is for get all drug Details
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
	
	@Test(groups = "his.pharmacy.test")
	public void getDrugDetailsTestCase() throws IOException, JSONException {
		
		ArrayList<String> resArrayList =getHTTPResponse(properties.getProperty(TestCaseConstants.URL_APPEND_GET_DRUG_DETAILS), TestCaseConstants.HTTP_GET, null);
		
		System.out.println("Drug Details: "+resArrayList.get(0));
		
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
		
	}
	
	/**
	 * This test case is for get all pharm Frequency
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
	
	@Test(groups = "his.pharmacy.test")
	public void getPharmFrequencyTestCase() throws IOException, JSONException {
		
		ArrayList<String> resArrayList =getHTTPResponse(properties.getProperty(TestCaseConstants.URL_APPEND_GET_PHARM_FREQUENCY), TestCaseConstants.HTTP_GET, null);
		
		System.out.println("Pharm Frequency: "+resArrayList.get(0));
		
		JSONArray jsonArray = new JSONArray(resArrayList.get(0));
		
		JSONObject jsonObject = jsonArray.getJSONObject(jsonArray.length() - 1);
		
		System.out.println("freqId = "+ jsonObject.getString("freqId"));
		
		frequencyId = jsonObject.getString("freqId");
		
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
		
	}
	
	/**
	 * This test case is for get all Requests
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
	
	@Test(groups = "his.pharmacy.test", dependsOnMethods = {"requestDrugTestCase"})
	public void getAllRequestsTestCase() throws IOException, JSONException {
		
		ArrayList<String> resArrayList =getHTTPResponse(properties.getProperty(TestCaseConstants.URL_APPEND_GET_DRUG_REQUESTS), TestCaseConstants.HTTP_GET, null);
		
		System.out.println("Drug Requests: "+resArrayList.get(0));
		
		JSONArray jsonArray = new JSONArray(resArrayList.get(0));
		
		JSONObject jsonObject = jsonArray.getJSONObject(jsonArray.length()-1);
		
		requestId = jsonObject.getString("requestId");
		
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
		
	}
	
	/**
	 * This test case is for get all Drug Names
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
	
	@Test(groups = "his.pharmacy.test", dependsOnMethods = {"getAllDrugNamesTestCase"})
	public void getAllBatchNamesByDnameTestCase() throws IOException, JSONException {
		
		ArrayList<String> resArrayList =getHTTPResponse(properties.getProperty(TestCaseConstants.URL_APPEND_GET_BATCH_NAMES_BY_DNAME)+drugId, TestCaseConstants.HTTP_GET, null);
		
		System.out.println("Batch Names: "+resArrayList.get(0));
		
		JSONArray jsonArray = new JSONArray(resArrayList.get(0));
		
		System.out.println(jsonArray.getString(jsonArray.length()-1));
		
		batchNo = jsonArray.getString(jsonArray.length()-1);
		
		
		
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
		
	}
	
	/**
	 * This test case is for get all Drug Names
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
	
	@Test(groups = "his.pharmacy.test", dependsOnMethods = {"insertDrugTestCase"})
	public void getAllDrugNamesTestCase() throws IOException, JSONException {
		
		ArrayList<String> resArrayList =getHTTPResponse(properties.getProperty(TestCaseConstants.URL_APPEND_GET_DRUG_NAMES), TestCaseConstants.HTTP_GET, null);
		
		System.out.println("Drug Names: "+resArrayList.get(0));
		
		JSONArray jsonArray = new JSONArray(resArrayList.get(0));
		
		JSONObject jsonObject = jsonArray.getJSONObject(jsonArray.length() - 1);
		
		System.out.println("dSrNo = "+ jsonObject.getString("dSrNo"));
		
		drugId = jsonObject.getString("dSrNo");
		
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
		
	}
	
	/**
	 * This test case is for get all Drug Reports
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
	
	@Test(groups = "his.pharmacy.test")
	public void getAllDrugReportsTestCase() throws IOException, JSONException {
		
		ArrayList<String> resArrayList =getHTTPResponse(properties.getProperty(TestCaseConstants.URL_APPEND_GET_DRUG_REPORTS), TestCaseConstants.HTTP_GET, null);
		
		System.out.println("Drug Reports: "+resArrayList.get(0));
		
		
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
		
	}
	
	
	/**
	 * This is request drugTest Case.
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
	@Test(groups = "his.pharmacy.test", dependsOnMethods = {"insertDrugTestCase", "addDrugBatchTestCase"})
	public void requestDrugTestCase() throws IOException, JSONException {

		
        JSONObject jsonObjectRequest = new JSONObject(RequestUtil.requestByID(TestCaseConstants.REQUEST_DRUG));
       
		ArrayList<String> resArrayList = getHTTPResponse(
				properties.getProperty(TestCaseConstants.URL_APPEND_REQUEST_DRUG), TestCaseConstants.HTTP_POST,
				jsonObjectRequest.toString());
		
		System.out.println(resArrayList.get(0));
		
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
		Assert.assertEquals(resArrayList.get(0),properties.getProperty(TestCaseConstants.REQUEST_DRUG_SUCCESS));
	

	}
	
	/**
	 * This is Approve Drug Test Case.
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
	@Test(groups = "his.pharmacy.test", dependsOnMethods = {"insertDrugTestCase", "requestDrugTestCase", "getAllRequestsTestCase"})
	public void approveDrugRequestTestCase() throws IOException, JSONException {


        JSONObject jsonObjectRequest = new JSONObject(RequestUtil.requestByID(TestCaseConstants.APPROVE_REQUEST));
       
        JSONObject requestDrug = jsonObjectRequest.getJSONObject(properties.getProperty(TestCaseConstants.REQUEST_DRUG_ID));
        
        requestDrug.put("id", requestId);
        
		ArrayList<String> resArrayList = getHTTPResponse(
				properties.getProperty(TestCaseConstants.URL_APPEND_APPROVE_REQUEST), TestCaseConstants.HTTP_POST,
				jsonObjectRequest.toString());
		System.out.println(resArrayList.get(0));
		
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
		Assert.assertEquals(resArrayList.get(0),properties.getProperty(TestCaseConstants.APPROVE_DRUG_SUCCESS));
	

	}
	
	/**
	 * This test case is for get drug by Id
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
	
	@Test(groups = "his.pharmacy.test", dependsOnMethods ={"insertDrugTestCase", "getAllDrugNamesTestCase"})
	public void getDrugByIdTestCase() throws IOException, JSONException {
		
		ArrayList<String> resArrayList =getHTTPResponse(properties.getProperty(TestCaseConstants.URL_APPEND_GET_DRUG_BY_ID)+drugId, TestCaseConstants.HTTP_GET, null);
		
		System.out.println("Drugs"+ resArrayList.get(0));
		//System.out.print(jsonArray);
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
		
	}
	
	
	/**
	 * This test case is for get drug Id by Drug Name
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
	
	@Test(groups = "his.pharmacy.test", dependsOnMethods ={"insertDrugTestCase", "getAllDrugNamesTestCase", "addDrugBatchTestCase"})
	public void getDrugIdByDNameTestCase() throws IOException, JSONException {
		
		ArrayList<String> resArrayList =getHTTPResponse(properties.getProperty(TestCaseConstants.URL_APPEND_GET_DRUG_BY_DNAME)+
				properties.getProperty(TestCaseConstants.DRUG_NAME), TestCaseConstants.HTTP_GET, null);
		
		System.out.println("Drugs"+ resArrayList.get(0));
		System.out.println("drug id = " +resArrayList.get(0));
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
		Assert.assertEquals(resArrayList.get(0), drugId);
	}
	
	/**
	 * This test case is for get drug details with Post method
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
	
	@Test(groups = "his.pharmacy.test", dependsOnMethods ={"insertDrugTestCase", "getAllDrugNamesTestCase", "addDrugBatchTestCase"})
	public void getDrugDetailsWithParamTestCase() throws IOException, JSONException {
		
		ArrayList<String> resArrayList =getHTTPResponse(properties.getProperty(TestCaseConstants.URL_APPEND_GET_DRUG_DETAILS_WITH_PARAM)+
				properties.getProperty(TestCaseConstants.DRUG_NAME), TestCaseConstants.HTTP_GET, null);
		
		System.out.println("Drugs"+ resArrayList.get(0));
		System.out.println("drug details = " +resArrayList.get(0));
		JSONObject jsonObject = (new JSONArray(resArrayList.get(0))).getJSONObject(0);
		
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
		Assert.assertEquals(jsonObject.get("dSrNo").toString(), drugId);
	}
	
	/**
	 * This test case is for get drug details by DName
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
	
	@Test(groups = "his.pharmacy.test", dependsOnMethods ={"insertDrugTestCase", "getAllDrugNamesTestCase", "addDrugBatchTestCase"})
	public void getDrugDetailsByDNameTestCase() throws IOException, JSONException {
		
		ArrayList<String> resArrayList =getHTTPResponse(properties.getProperty(TestCaseConstants.URL_APPEND_GET_DRUG_DETAILS_BY_DNAME)+
				properties.getProperty(TestCaseConstants.DRUG_NAME), TestCaseConstants.HTTP_GET, null);
		
		System.out.println("Drugs"+ resArrayList.get(0));
		System.out.println("drug details = " +resArrayList.get(0));
		JSONObject jsonObject = (new JSONArray(resArrayList.get(0))).getJSONObject(0);
		
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
		Assert.assertEquals(jsonObject.get("dSrNo").toString(), drugId);
	}
	
	
	/**
	 * This test case is for get drug details by Drug Name
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
	
	@Test(groups = "his.pharmacy.test", dependsOnMethods ={"insertDrugTestCase", "getAllDrugNamesTestCase", "addDrugBatchTestCase"})
	public void getDrugDetailsByDrugNameTestCase() throws IOException, JSONException {
		
		ArrayList<String> resArrayList =getHTTPResponse(properties.getProperty(TestCaseConstants.URL_APPEND_GET_DRUG_DETAILS_BY_DRUG_NAME), TestCaseConstants.HTTP_POST, (RequestUtil.requestByID(TestCaseConstants.DRUG_NAME_AND_BATCH)));
		
		System.out.println("drug details = " +resArrayList.get(0));
		
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);

	}
	/**
	 * This test case is for get drug details by Drug category
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
	
	@Test(groups = "his.pharmacy.test", dependsOnMethods ={"insertDrugTestCase", "addDrugBatchTestCase", "getAllDrugNamesTestCase"})
	public void getDrugDetailsByCategoryTestCase() throws IOException, JSONException {
		
		ArrayList<String> resArrayList =getHTTPResponse(properties.getProperty(TestCaseConstants.URL_APPEND_GET_DRUG_DETAILS_BY_CATEGORY)+
				properties.getProperty(TestCaseConstants.DRUG_CATEGORY), TestCaseConstants.HTTP_GET, null);
		
		System.out.println("drug details = " +resArrayList.get(0));
		JSONArray jsonArray = new JSONArray(resArrayList.get(0));

		int dSrNo=-1;
		
		for(int i=0; i<jsonArray.length(); i++)
		{
			JSONObject jsonObj = jsonArray.getJSONObject(i);
			
			int checkDSrNo = jsonObj.getInt("dSrNo");
			
			if(dSrNo < checkDSrNo)
			{
				dSrNo = checkDSrNo;
			}
		}
		
		
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
		Assert.assertEquals(dSrNo + "", drugId);
	}
	
	/**
	 * This test case is for get drug by Drug category
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
	
	@Test(groups = "his.pharmacy.test", dependsOnMethods ={"insertDrugTestCase", "addDrugBatchTestCase", "getAllDrugNamesTestCase"})
	public void getDrugByCategoryTestCase() throws IOException, JSONException {
		
		ArrayList<String> resArrayList =getHTTPResponse(properties.getProperty(TestCaseConstants.URL_APPEND_GET_DRUG_BY_CATEGORY)+
				properties.getProperty(TestCaseConstants.DRUG_CATEGORY), TestCaseConstants.HTTP_GET, null);
		
		System.out.println("drug details = " +resArrayList.get(0));
		JSONArray jsonArray = new JSONArray(resArrayList.get(0));

		int dSrNo=-1;
		
		for(int i=0; i<jsonArray.length(); i++)
		{
			JSONObject jsonObj = jsonArray.getJSONObject(i);
			
			int checkDSrNo = jsonObj.getInt("dSrNo");
			
			if(dSrNo < checkDSrNo)
			{
				dSrNo = checkDSrNo;
			}
		}
		
		
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
		Assert.assertEquals(dSrNo + "", drugId);
	}
	

	/**
	 * This is Add new drug mail Test Case.
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
	@Test(groups = "his.pharmacy.test", dependsOnMethods ={"insertDrugTestCase", "addDrugBatchTestCase", "getAllDrugNamesTestCase"})
	public void insertMailTestCase() throws IOException, JSONException {

		JSONObject jsonObjectRequest = new JSONObject(RequestUtil.requestByID(TestCaseConstants.INSERT_MAIL));
		
		jsonObjectRequest.put("drugid", drugId);
		
		ArrayList<String> resArrayList = getHTTPResponse(
				properties.getProperty(TestCaseConstants.URL_APPEND_INSERT_MAIL), TestCaseConstants.HTTP_POST,
				jsonObjectRequest.toString());
		System.out.println(resArrayList.get(0));
		
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
		
	}
	
	/**
	 * This is dispense Drug Test Case.
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
	@Test(groups = "his.pharmacy.test", dependsOnMethods ={"insertDrugTestCase", "addDrugBatchTestCase", "getAllDrugNamesTestCase"}, dependsOnGroups = {"his.lab.test.prescription"})
	public void dispenseDrugTestCase() throws IOException, JSONException {

		String presecriptionId = PrescriptionTestCase.getPrescriptionId();
		
		JSONObject jsonObjectRequest = new JSONObject(RequestUtil.requestByID(TestCaseConstants.DISPENSE_DRUG));
		
		System.out.println("Request = " +jsonObjectRequest);
		JSONObject jsonObjectInner = jsonObjectRequest.getJSONObject("dispense").getJSONArray("dispenseList").getJSONObject(0);
		JSONObject jsonObjectInner2 = jsonObjectRequest.getJSONObject("dispense");
		
		jsonObjectInner2.put("PrescriptionId", presecriptionId);
		jsonObjectInner.put("DSrNo", drugId);
		
		System.out.println("Request updated = " +jsonObjectRequest);
		
		ArrayList<String> resArrayList = getHTTPResponse(
				properties.getProperty(TestCaseConstants.URL_APPEND_DISPENSE_DRUG), TestCaseConstants.HTTP_POST,
				jsonObjectRequest.toString());
		System.out.println(resArrayList.get(0));
		
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
		
	}
	
	/**
	 * This test case is for get prescriptionList by Date
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
	
	@Test(groups = "his.pharmacy.test", dependsOnMethods={"dispenseDrugTestCase"})
	public void getPrecriptionListbyDateTestCase() throws IOException, JSONException {
		
		DateFormat dateFormat = new SimpleDateFormat("YYYY-MM-dd");		
		dateFormat.setTimeZone(TimeZone.getTimeZone("Asia/Colombo"));
        
        Calendar cal = Calendar.getInstance();
        Date date = cal.getTime();
		
		ArrayList<String> resArrayList =getHTTPResponse(properties.getProperty(TestCaseConstants.URL_APPEND_GET_PRESCRIPITON_LIST_BY_DATE)+ dateFormat.format(date), TestCaseConstants.HTTP_GET, null);
		
		System.out.print(resArrayList.get(0));
		//System.out.print(jsonArray);
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
		
		
	}
	
	/**
	 * This test case is for get prescriptionList by Date
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
	
	@Test(groups = "his.pharmacy.test")
	public void saveDosageTestCase() throws IOException, JSONException {
		
		
		ArrayList<String> resArrayList =getHTTPResponse(properties.getProperty(TestCaseConstants.URL_APPEND_SAVE_DOSAGE), TestCaseConstants.HTTP_POST, RequestUtil.requestByID(TestCaseConstants.SAVE_DOSAGE));
		
		System.out.println(resArrayList.get(0));
		//System.out.print(jsonArray);
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
		Assert.assertEquals(resArrayList.get(0), properties.getProperty(TestCaseConstants.SAVE_DOAGE_SUCCESS));
		
	}
}
