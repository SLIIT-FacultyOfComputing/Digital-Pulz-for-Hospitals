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
public class OPDLabTestRequestTestCase extends BaseTestCase {

	
	public static final int SUCCESS_STATUS_CODE = 200;
	
	public static String OPDLabRequestID;
	public static String visitId;
	public static String patientId;
	
	public JSONArray jsonArray;
	
	
	/**
	 * This test case is for add New OPD Lab Test Request
	 * 
	 * @throws IOException
	 */
	@Test(groups = "his.opd.test")
	public void addOPDLabTestRequest() throws IOException, JSONException {
	
		
		ArrayList<String> resArrayList = getHTTPResponse(properties.getProperty(TestCaseConstants.URL_APPEND_ADD_OPD_LAB_REQUEST), TestCaseConstants.HTTP_POST,
				RequestUtil.requestByID(TestCaseConstants.ADD_OPD_LAB_REQUEST));
		
		//testRequestID = (new JSONObject(RequestUtil.requestByID(TestCaseConstants.ADD_OPD_LAB_REQUEST))).getString("ftest_ID");
		
		patientId = (new JSONObject(RequestUtil.requestByID(TestCaseConstants.ADD_OPD_LAB_REQUEST))).getString("fpatient_ID");
		visitId = (new JSONObject(RequestUtil.requestByID(TestCaseConstants.ADD_OPD_LAB_REQUEST))).getString("visitID");
		
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
		
	}
	
	
	
	/**
	 * This test case is for get all OPD Lab Test Requests
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
	@Test(groups = "his.opd.test", dependsOnMethods = { "addOPDLabTestRequest" })
	public void getAllOPDLabTestRequests() throws IOException, JSONException {

		ArrayList<String> resArrayList = getHTTPResponse(properties.getProperty(TestCaseConstants.URL_APPEND_ALL_OPD_LAB_REQUESTS),
				TestCaseConstants.HTTP_GET, null);
		
		
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
	}
	
	/**
	 * This test case is to update OPD Lab Test requests
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
	@Test(groups = "his.opd.test", dependsOnMethods = { "addOPDLabTestRequest"})
	public void updateOPDLabRequests() throws IOException, JSONException {

		// Get JSON Request body to send OPD LAb Requests update Request
		JSONObject jsonResponseObject = new JSONObject(RequestUtil.requestByID(TestCaseConstants.UPDATE_OPD_LAB_REQUESTS));
		
		jsonResponseObject.put("labTestRequest_ID",OPDLabRequestID);
		
		// Send JSON Update OPD LAb Requests
		ArrayList<String> resArrayList = getHTTPResponse(
				properties.getProperty(TestCaseConstants.URL_APPEND_UPDATE_OPD_LAB_REQUESTS), TestCaseConstants.HTTP_GET,
				jsonResponseObject.toString());

		
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);

	}
	
	/**
	 * This test case is for getting OPD lab requests by patient
	 * 
	 * @throws IOException
	 * @throws JSONException 
	 */
	@Test(groups = "his.opd.test", dependsOnMethods = { "addOPDLabTestRequest"})
	public void getOPDLabRequestsByVisit() throws IOException, JSONException{

		ArrayList<String> resArrayList = getHTTPResponse(properties.getProperty(TestCaseConstants.URL_APPEND_GET_OPD_Lab_Requests_By_Visit)+visitId,
				TestCaseConstants.HTTP_GET, null);
		
		jsonArray = new JSONArray(resArrayList.get(0));
		
		System.out.println(jsonArray.getJSONObject(jsonArray.length()-1));
		OPDLabRequestID = (jsonArray.getJSONObject(jsonArray.length()- 1)).getString("labTestRequest_ID");
		System.out.println("OPD Lab Request ID = "+ OPDLabRequestID);
		
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
		
	}
	
	
	/**
	 * This test case is for getting OPD lab requests by visitId
	 * 
	 * @throws IOException
	 * @throws JSONException 
	 */
	@Test(groups = "his.opd.test", dependsOnMethods = { "addOPDLabTestRequest"})
	public void getOPDLabRequestsByPatient() throws IOException, JSONException{

		ArrayList<String> resArrayList = getHTTPResponse(properties.getProperty(TestCaseConstants.URL_APPEND_GET_OPD_Lab_Requests_By_Patient)+patientId,
				TestCaseConstants.HTTP_GET, null);
		
		jsonArray = new JSONArray(resArrayList.get(0));
		
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
		
	}
	
	/**
	 * When execute this test case it deletes OPD Laboratory Request for the provided ID
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 */
	@Test(groups = "his.opd.test", dependsOnMethods = { "addOPDLabTestRequest", "getOPDLabRequestsByPatient",
			"getOPDLabRequestsByVisit", "updateOPDLabRequests","getAllOPDLabTestRequests" })
	public void deleteOPDLabTestRequest() throws IOException {

		// Get response for delete lab test case
		ArrayList<String> resArrayList = getHTTPResponse(properties.getProperty(TestCaseConstants.URL_APPEND_DELETE_LAB_OPD_REQUESTS_URL)
				+ OPDLabRequestID, TestCaseConstants.HTTP_GET, null);

		System.out.println("response = "+ resArrayList.get(0));
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
		Assert.assertEquals(resArrayList.get(0), OPDLabRequestID);
	}
	
	
	
	
	
}
