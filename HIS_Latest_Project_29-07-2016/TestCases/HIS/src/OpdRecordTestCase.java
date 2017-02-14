import java.io.IOException;
import java.util.ArrayList;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;
import org.testng.Assert;
import org.testng.annotations.Test;

/**
 * This class is for TestNG Integration Test cases related to all
 * functionalities of OPD in HIS Project. developed by yasini.p
 * 
 * {@link BaseTestCase}
 * 
 * @author yasini.p
 *
 */
public class OpdRecordTestCase extends BaseTestCase {
	
	public static final int SUCCESS_STATUS_CODE = 200;

	public String patientRecordID, patient, recordCreateUser, recordType,recordText,recordVisibility,recordCompleted,recordLastUpdateUser;


	/**
	 * Test Case for Add Lab Parent Test Fields Test
	 * 
	 * @throws IOException
	 */
	@Test(groups = "his.opd.test")
	public void addOpdRecordTestCase() throws IOException, JSONException {

		ArrayList<String> resArrayList = getHTTPResponse(
				properties
						.getProperty(TestCaseConstants.URL_APPEND_ADD_OPD_RECORD),
				TestCaseConstants.HTTP_POST, RequestUtil
						.requestByID(TestCaseConstants.ADD_OPD_RECORD));

		JSONObject jsonRequestObject = new JSONObject(RequestUtil
				.requestByID(TestCaseConstants.ADD_OPD_RECORD));


		JSONObject jsonResponseObject = new JSONObject(resArrayList.get(0));

		System.out.println("request = " + jsonRequestObject);
		System.out.println("response = " + jsonResponseObject);

		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)),
				SUCCESS_STATUS_CODE);
		Assert.assertEquals(jsonResponseObject.getString("recordText"), jsonRequestObject.getString("recordText"));
	}
	
	/**
	 * This test case is to update opd record
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */

	@Test(groups = "his.opd.test", dependsOnMethods = { "addOpdRecordTestCase", "getOpdTestRequestByPatientID" })
	public void updateOpdRecordTestCase() throws IOException, JSONException {

		// Get JSON Request body to send LAb update Request
		JSONObject jsonRequestObject = new JSONObject(
				RequestUtil
						.requestByID(TestCaseConstants.UPDATE_OPD_RECORD));

		jsonRequestObject.put("patientRecordID", patientRecordID);
		
		System.out.println("this is it "+jsonRequestObject);
		// Send JSON Update Opd Request
		ArrayList<String> resArrayList = getHTTPResponse(
				properties
						.getProperty(TestCaseConstants.URL_APPEND_UPDATE_OPD_RECORD),
				TestCaseConstants.HTTP_POST, jsonRequestObject.toString());

		JSONObject jsonResponseObject = new JSONObject(resArrayList.get(0));

		System.out.println("request = " + jsonRequestObject);
		System.out.println("response = " + jsonResponseObject);

		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)),
				SUCCESS_STATUS_CODE);
		Assert.assertEquals(jsonResponseObject.getString("recordText"), jsonRequestObject.getString("recordText"));
	}
	
	/**
	 * This test case is for get Opd request by Patient ID
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
	@Test(groups = "his.opd.test", dependsOnMethods = {
			"addOpdRecordTestCase" })
	public void getOpdTestRequestByPatientID() throws IOException, JSONException {

		System.out.println(properties
						.getProperty(TestCaseConstants.URL_APPEND_OPD_RECORD_BY_PID)
						+ (new JSONObject(
								RequestUtil
										.requestByID(TestCaseConstants.ADD_OPD_RECORD))
								.getString("patient")));
		ArrayList<String> resArrayList = getHTTPResponse(
				properties
						.getProperty(TestCaseConstants.URL_APPEND_OPD_RECORD_BY_PID)
						+ (new JSONObject(
								RequestUtil
										.requestByID(TestCaseConstants.ADD_OPD_RECORD))
								.getString("patient")),
				TestCaseConstants.HTTP_GET, null);

		JSONArray jsonArray = new JSONArray(resArrayList.get(0));
		JSONObject jsonObject = ((JSONObject) jsonArray
				.get(jsonArray.length() - 1));
		System.out.println(jsonObject);
		patientRecordID = jsonObject.getString("patientRecordID");
		System.out.println("patientRecordID = " + patientRecordID);
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)),
				SUCCESS_STATUS_CODE);

	}
	
	/**
	 * This test case is for get Opd request by Record ID
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
	@Test(groups = "his.opd.test", dependsOnMethods = { "addOpdRecordTestCase","updateOpdRecordTestCase","getOpdTestRequestByPatientID" })
	public void getOpdRecordTestRequestByHID() throws IOException, JSONException {

		ArrayList<String> resArrayList = getHTTPResponse(
				properties.getProperty(TestCaseConstants.URL_APPEND_OPD_RECORD_BY_HID)
						+ patientRecordID, TestCaseConstants.HTTP_GET, null);

		JSONArray jsonArray = new JSONArray(resArrayList.get(0));
		JSONObject jsonObject = ((JSONObject) jsonArray
				.get(jsonArray.length() - 1));

		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)),
				SUCCESS_STATUS_CODE);
		Assert.assertEquals(jsonObject.getString("patientRecordID"), patientRecordID);

	}
}
