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
public class OpdAttachmentTestCase extends BaseTestCase {

	public static final int SUCCESS_STATUS_CODE = 200;

	public String attchid, pid, filetype, userid, Remarks, attachname,
			filepath, active, comment;

	/**
	 * This is Add Opd Attachment Test Case.
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
	@Test(groups = "his.opd.test")
	public void addOpdAttachmentTestCase() throws IOException, JSONException {

		// Send POST request to add laboratory
		ArrayList<String> resArrayList = getHTTPResponse(
				properties
						.getProperty(TestCaseConstants.URL_APPEND_OPD_ADD_ATTACHMENT),
				TestCaseConstants.HTTP_POST, RequestUtil
						.requestByID(TestCaseConstants.OPD_ADD_ATTACHMENT));
		
		JSONObject jsonRequestObject = new JSONObject(RequestUtil
						.requestByID(TestCaseConstants.OPD_ADD_ATTACHMENT));
		
		
		JSONObject jsonResponseObject = new JSONObject(resArrayList.get(0));
		
		System.out.println("request = " + jsonRequestObject);
		System.out.println("response = " + jsonResponseObject);
		
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)),
				SUCCESS_STATUS_CODE);
		Assert.assertEquals(jsonResponseObject.getString("attachName"), jsonRequestObject.getString("attachname"));

	}

	/**
	 * This test case is to update opd attachment
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */

	@Test(groups = "his.opd.test", dependsOnMethods = { "addOpdAttachmentTestCase" })
	public void updateOpdAttachmentTestCase() throws IOException, JSONException {

		// Get JSON Request body to send LAb update Request
		JSONObject jsonResponseObject = new JSONObject(
				RequestUtil
						.requestByID(TestCaseConstants.UPDATE_OPD_ATTACHMENT));

		jsonResponseObject.put("attchid", attchid);
		jsonResponseObject.put("pid",
				properties.get(TestCaseConstants.UPDATE_OPD_PID));
		jsonResponseObject.put("filetype",
				properties.get(TestCaseConstants.UPDATE_OPD_FILETYPE));
		jsonResponseObject.put("userid",
				properties.get(TestCaseConstants.UPDATE_OPD_USERID));
		jsonResponseObject.put("Remarks",
				properties.get(TestCaseConstants.UPDATE_OPD_REMARKS));
		jsonResponseObject.put("attachname",
				properties.get(TestCaseConstants.UPDATE_OPD_ATTACHNAME));
		jsonResponseObject.put("filepath",
				properties.get(TestCaseConstants.UPDATE_OPD_FILEPATH));

		// Send JSON Update Opd Request
		ArrayList<String> resArrayList = getHTTPResponse(
				properties
						.getProperty(TestCaseConstants.URL_APPEND_UPDATE_OPD_ATTACH),
				TestCaseConstants.HTTP_POST, jsonResponseObject.toString());

		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)),
				SUCCESS_STATUS_CODE);

	}

	/**
	 * This test case is for get Opd request by Attach ID
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
	@Test(groups = "his.opd.test", dependsOnMethods = {
			"addOpdAttachmentTestCase", "updateOpdAttachmentTestCase",
			"getOpdTestRequestByPID" })
	public void getOpdTestRequestByAttachID() throws IOException, JSONException {

		ArrayList<String> resArrayList = getHTTPResponse(
				properties.getProperty(TestCaseConstants.URL_APPEND_GET_OPD_BY_ATTCHID)
						+ attchid, TestCaseConstants.HTTP_GET, null);

		JSONArray jsonArray = new JSONArray(resArrayList.get(0));
		JSONObject jsonObject = ((JSONObject) jsonArray
				.get(jsonArray.length() - 1));

		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)),
				SUCCESS_STATUS_CODE);
		Assert.assertEquals(jsonObject.getString("attachID"), attchid);

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
			"addOpdAttachmentTestCase", "updateOpdAttachmentTestCase" })
	public void getOpdTestRequestByPID() throws IOException, JSONException {

		ArrayList<String> resArrayList = getHTTPResponse(
				properties
						.getProperty(TestCaseConstants.URL_APPEND_GET_OPD_BY_PID)
						+ (new JSONObject(
								RequestUtil
										.requestByID(TestCaseConstants.OPD_ADD_ATTACHMENT))
								.getString("pid")),
				TestCaseConstants.HTTP_GET, null);

		JSONArray jsonArray = new JSONArray(resArrayList.get(0));
		JSONObject jsonObject = ((JSONObject) jsonArray
				.get(jsonArray.length() - 1));
		attchid = jsonObject.getString("attachID");

		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)),
				SUCCESS_STATUS_CODE);

	}

}
