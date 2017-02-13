import java.io.IOException;
import java.util.ArrayList;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;
import org.testng.Assert;
import org.testng.annotations.Test;

/**
 * This class is for TestNG Integration Test cases related to all
 * functionalities of OPD in HIS Project. developed by rubika.m
 * 
 * {@link BaseTestCase}
 * 
 * @author rubika.m
 *
 */
public class PCULabTestRequestTestCase extends BaseTestCase {
	
	public static final int SUCCESS_STATUS_CODE = 200;
	
	public String testRequestID;
	public String pcuPatientID;
	public String PCULabRequestID;
	public String adminId;
	
	
	/**
	 * This test case is for add New PUC Lab Test REquest
	 * 
	 * @throws IOException
	 */
	
	@Test(groups = "his.lab.test")
	public void addPcuLabTestRequestTestCase()  throws IOException , JSONException {
		
		ArrayList<String> resArrayList = getHTTPResponse(properties.getProperty(TestCaseConstants.URL_APPEND_ADD_PCU_REQUEST), 
				TestCaseConstants.HTTP_POST, RequestUtil.requestByID(TestCaseConstants.ADD_PCU_REQUEST)) ; 
		
		System.out.print(resArrayList.get(0)+ " and "+resArrayList.get(1));
		testRequestID = (new JSONObject(RequestUtil.requestByID(TestCaseConstants.ADD_PCU_REQUEST))).getString("ftest_ID");
		pcuPatientID = (new JSONObject(RequestUtil.requestByID(TestCaseConstants.ADD_PCU_REQUEST))).getString("fpatient_ID");
		adminId=(new JSONObject(RequestUtil.requestByID(TestCaseConstants.ADD_PCU_REQUEST))).getString("admintionID");
		
		System.out.println("pcuPatientID = "+ pcuPatientID);
		
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
	
		
	}
	
	/**
	 * This test case is for get all PUC Lab Test Requests
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
	
	@Test(groups = "his.lab.test", dependsOnMethods = { "addPcuLabTestRequestTestCase" })
	public void getAllPcuLabTestCase() throws IOException, JSONException {

		ArrayList<String> resArrayList = getHTTPResponse(properties.getProperty(TestCaseConstants.URL_APPEND_GET_ALL_PCU_REQUESTS),
				TestCaseConstants.HTTP_GET, null);
		
		System.out.print(resArrayList.get(0));
		//System.out.print(jsonArray);
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
		
	}
	
	
	/**
	 * This test case is for getting PUC lab requests by patient Id
	 * 
	 * @throws IOException
	 * @throws JSONException 
	 */
	
	@Test(groups = "his.lab.test", dependsOnMethods = { "addPcuLabTestRequestTestCase" })
	public void getPcuLabTestByPatientID() throws IOException, JSONException {

		System.out.println("pcuPatientID = "+ pcuPatientID);
		
		ArrayList<String> resArrayList = getHTTPResponse(
				properties.getProperty(TestCaseConstants.URL_APPEND_GET_PCU_LABS_BY_PATIENT_ID)
				+ pcuPatientID, TestCaseConstants.HTTP_GET, null);

		JSONArray jsonArray = new JSONArray(resArrayList.get(0));
		
		//System.out.println(jsonArray.getJSONObject(jsonArray.length()-1));
		PCULabRequestID = (jsonArray.getJSONObject(jsonArray.length()- 1)).getString("labTestRequest_ID");
		System.out.println("PCU Lab Request ID = "+PCULabRequestID );
						
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
		
	}
	
	/**
	 * This test case is for getting PUC lab requests by PUC Lab Request Id
	 * 
	 * @throws IOException
	 * @throws JSONException 
	 */
	
	@Test(groups = "his.lab.test", dependsOnMethods = { "addPcuLabTestRequestTestCase" ,"getPcuLabTestByPatientID"})
	public void getPcuLabTestByReqID() throws IOException, JSONException {

		ArrayList<String> resArrayList = getHTTPResponse(
				properties.getProperty(TestCaseConstants.URL_APPEND_GET_PCU_LABS_BY_REQUEST_ID)
				+ PCULabRequestID, TestCaseConstants.HTTP_GET, null);

		
		//System.out.print(resArrayList.get(0));	
		
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
		

	}
	
	/**
	 * This test case is for getting PUC lab requests by AdminId
	 * 
	 * @throws IOException
	 * @throws JSONException 
	 */
	@Test(groups = "his.lab.test", dependsOnMethods = { "addPcuLabTestRequestTestCase"})
	public void getPcuLabTestByAdminID() throws IOException, JSONException {

		ArrayList<String> resArrayList = getHTTPResponse(
				properties.getProperty(TestCaseConstants.URL_APPEND_GET_PCU_LABS_BY_ADMIN_ID)
				+ adminId, TestCaseConstants.HTTP_GET, null);

		
		System.out.print(resArrayList.get(0));	
		
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
		

	}
	
	/**
	 * This test case is to update OPD LAb Test requests
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
	@Test(groups = "his.lab.test", dependsOnMethods = { "addPcuLabTestRequestTestCase","getPcuLabTestByReqID"})
	public void updatePCULabRequests() throws IOException, JSONException {

		// Get JSON Request body to send PCU LAb Requests update Request
		JSONObject jsonResponseObject = new JSONObject(RequestUtil.requestByID(TestCaseConstants.UPDATE_PCU_LAB_REQUESTS));
		
		jsonResponseObject.put("labTestRequest_ID",PCULabRequestID);
		
		// Send JSON Update PCU LAb Requests
		ArrayList<String> resArrayList = getHTTPResponse(
				properties.getProperty(TestCaseConstants.URL_APPEND_UPDATE_PCU_LAB_REQUEST), TestCaseConstants.HTTP_POST,
				jsonResponseObject.toString());

		
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);

	}
	
	/**
	 * When execute this test case it deletes PCU Laboratory Request for the provided ID
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 */
	@Test(groups = "his.lab.test", dependsOnMethods = { "addPcuLabTestRequestTestCase", "getPcuLabTestByPatientID",
			"getPcuLabTestByReqID", "updatePCULabRequests","getAllPcuLabTestCase" })
	public void deleteOPDLabTestRequest() throws IOException {

		// Get response for delete lab test case
		ArrayList<String> resArrayList = getHTTPResponse(properties.getProperty(TestCaseConstants.URL_APPEND_DELETE_LAB_PUC_REQUESTS_URL)
				+ PCULabRequestID, TestCaseConstants.HTTP_GET, null);

		
		System.out.println("response = " + resArrayList.get(0));
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
		Assert.assertEquals(resArrayList.get(0), PCULabRequestID);

	}
	
	
	

}
