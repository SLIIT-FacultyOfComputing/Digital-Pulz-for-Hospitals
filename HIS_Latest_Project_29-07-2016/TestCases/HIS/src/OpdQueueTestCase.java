import java.io.IOException;
import java.util.ArrayList;
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
public class OpdQueueTestCase extends BaseTestCase {
	
	public static final int SUCCESS_STATUS_CODE = 200;

	public String patient,queueTokenNo,queueAssignedTo,queueAssignedBy;

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
	public void addOpdQueueTestCase() throws IOException, JSONException {

		// Send POST request to add laboratory
		ArrayList<String> resArrayList = getHTTPResponse(
				properties
						.getProperty(TestCaseConstants.URL_APPEND_ADD_OPD_QUEUE),
				TestCaseConstants.HTTP_POST, RequestUtil
						.requestByID(TestCaseConstants.ADD_OPD_QUEUE));
		
		patient = (new JSONObject(RequestUtil.requestByID(TestCaseConstants.ADD_OPD_QUEUE))).getString("patient");

		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)),
				SUCCESS_STATUS_CODE);

	}
	
	@Test(groups = "his.opd.test", dependsOnMethods = {"addOpdQueueTestCase"})
	public void getOpdQueueCheckinByPID() throws IOException, JSONException {

		ArrayList<String> resArrayList = getHTTPResponse(
				properties
						.getProperty(TestCaseConstants.URL_APPEND_GET_OPD_CHECKIN_BY_PID)
						+patient,
				TestCaseConstants.HTTP_GET, null);

		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);


	}
	
	@Test(groups = "his.opd.test", dependsOnMethods = {"addOpdQueueTestCase","getOpdQueueCheckinByPID"})
	public void getOpdQueueCheckoutByPID() throws IOException, JSONException {

		ArrayList<String> resArrayList = getHTTPResponse(
				properties
						.getProperty(TestCaseConstants.URL_APPEND_GET_OPD_CHECKOUT_BY_PID)
						+patient,
				TestCaseConstants.HTTP_GET, null);

		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);


	}
	
	@Test(groups = "his.opd.test", dependsOnMethods = {"addOpdQueueTestCase","getOpdQueueCheckinByPID","getOpdQueueCheckoutByPID"})
	public void getOpdQueueTestRequestByUID() throws IOException, JSONException {

		ArrayList<String> resArrayList = getHTTPResponse(
				properties
						.getProperty(TestCaseConstants.URL_APPEND_GET_OPD_QUEUE_BY_UID)
						+ (new JSONObject(
								RequestUtil
								.requestByID(TestCaseConstants.ADD_OPD_QUEUE))
						.getString("queueAssignedTo")),
				TestCaseConstants.HTTP_GET, null);
		

		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);


	}
	
	@Test(groups = "his.opd.test", dependsOnMethods = {"addOpdQueueTestCase","getOpdQueueCheckinByPID","getOpdQueueCheckoutByPID","getOpdQueueTestRequestByUID"})
	public void getOpdQueueIsPatientInByPID() throws IOException, JSONException {

		ArrayList<String> resArrayList = getHTTPResponse(
				properties
						.getProperty(TestCaseConstants.URL_APPEND_GET_OPD_PATIENTIN_BY_PID)
						+patient,
				TestCaseConstants.HTTP_GET, null);
		
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);



	}
	
	
	@Test(groups = "his.opd.test", dependsOnMethods = {"addOpdQueueTestCase","getOpdQueueCheckinByPID","getOpdQueueCheckoutByPID","getOpdQueueTestRequestByUID","getOpdQueueIsPatientInByPID"})
	public void getOpdQueueCurrentInByDID() throws IOException, JSONException {

		ArrayList<String> resArrayList = getHTTPResponse(
				properties.getProperty(TestCaseConstants.URL_APPEND_GET_OPD_CURRENTIN_BY_DID)
						+(new JSONObject(
								RequestUtil
								.requestByID(TestCaseConstants.ADD_OPD_QUEUE))
						.getString("queueAssignedBy")),
				TestCaseConstants.HTTP_GET, null);
		
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);



	}
	
	@Test(groups = "his.opd.test", dependsOnMethods = {"addOpdQueueTestCase","getOpdQueueCheckinByPID","getOpdQueueCheckoutByPID","getOpdQueueTestRequestByUID","getOpdQueueIsPatientInByPID"})
	public void getOpdQueueTreatedByUID() throws IOException, JSONException {

		ArrayList<String> resArrayList = getHTTPResponse(
				properties
						.getProperty(TestCaseConstants.URL_APPEND_GET_OPD_TREATED_BY_UID)
						+ (new JSONObject(
								RequestUtil
								.requestByID(TestCaseConstants.ADD_OPD_QUEUE))
						.getString("queueAssignedTo")),
				TestCaseConstants.HTTP_GET, null);

		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);

	}
	
	@Test(groups = "his.opd.test", dependsOnMethods = {"addOpdQueueTestCase","getOpdQueueCheckinByPID","getOpdQueueCheckoutByPID","getOpdQueueTestRequestByUID","getOpdQueueIsPatientInByPID","getOpdQueueTreatedByUID"})
	public void getOpdQueueRediectByUID() throws IOException, JSONException {

		ArrayList<String> resArrayList = getHTTPResponse(
				properties
						.getProperty(TestCaseConstants.URL_APPEND_OPD_REDIECT_BY_UID)
						+ (new JSONObject(
								RequestUtil
								.requestByID(TestCaseConstants.ADD_OPD_QUEUE))
						.getString("queueAssignedTo")),
				TestCaseConstants.HTTP_GET, null);

		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);

	}

	@Test(groups = "his.opd.test", dependsOnMethods = {"addOpdQueueTestCase","getOpdQueueCheckinByPID","getOpdQueueCheckoutByPID","getOpdQueueTestRequestByUID","getOpdQueueIsPatientInByPID","getOpdQueueTreatedByUID","getOpdQueueRediectByUID"})
	public void getOpdQueueStatusByUID() throws IOException, JSONException {

		ArrayList<String> resArrayList = getHTTPResponse(
				properties
						.getProperty(TestCaseConstants.URL_APPEND_GET_OPD_STATUS_BY_UID)
						+ (new JSONObject(
								RequestUtil
								.requestByID(TestCaseConstants.ADD_OPD_QUEUE))
						.getString("queueAssignedTo")),
				TestCaseConstants.HTTP_GET, null);

		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);

	}
	
	@Test(groups = "his.opd.test", dependsOnMethods = {"addOpdQueueTestCase","getOpdQueueCheckinByPID","getOpdQueueCheckoutByPID","getOpdQueueTestRequestByUID","getOpdQueueIsPatientInByPID","getOpdQueueTreatedByUID","getOpdQueueRediectByUID","getOpdQueueStatusByUID"})
	public void getOpdSetQueue() throws IOException {

		ArrayList<String> resArrayList = getHTTPResponse(properties.getProperty(TestCaseConstants.URL_APPEND_OPD_SET_QUEUE),
				TestCaseConstants.HTTP_GET, null);

		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
	}
	
	@Test(groups = "his.opd.test", dependsOnMethods = {"addOpdQueueTestCase","getOpdQueueCheckinByPID","getOpdQueueCheckoutByPID","getOpdQueueTestRequestByUID","getOpdQueueIsPatientInByPID","getOpdQueueTreatedByUID","getOpdQueueRediectByUID","getOpdQueueStatusByUID","getOpdSetQueue"})
	public void getOpdGetQueueType() throws IOException {

		ArrayList<String> resArrayList = getHTTPResponse(properties.getProperty(TestCaseConstants.URL_APPEND_OPD_GET_QUEUE_TYPE),
				TestCaseConstants.HTTP_GET, null);

		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
	}
	
	@Test(groups = "his.opd.test", dependsOnMethods = {"addOpdQueueTestCase","getOpdQueueCheckinByPID","getOpdQueueCheckoutByPID",
			"getOpdQueueTestRequestByUID","getOpdQueueIsPatientInByPID","getOpdQueueTreatedByUID","getOpdQueueRediectByUID",
			"getOpdQueueStatusByUID","getOpdSetQueue","getOpdGetQueueType"})
	public void getOpdHoldQuiueByUID() throws IOException, JSONException {

		ArrayList<String> resArrayList = getHTTPResponse(
				properties
						.getProperty(TestCaseConstants.URL_APPEND_OPD_HOLD_QUEUE_BY_UID)
						+ (new JSONObject(
								RequestUtil
								.requestByID(TestCaseConstants.ADD_OPD_QUEUE))
						.getString("queueAssignedTo")),
				TestCaseConstants.HTTP_GET, null);

		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);

	}
	
	
	@Test(groups = "his.opd.test", dependsOnMethods = {"addOpdQueueTestCase","getOpdQueueCheckinByPID","getOpdQueueCheckoutByPID",
			"getOpdQueueTestRequestByUID","getOpdQueueIsPatientInByPID","getOpdQueueTreatedByUID","getOpdQueueRediectByUID",
			"getOpdQueueStatusByUID","getOpdSetQueue","getOpdGetQueueType","getOpdHoldQuiueByUID"})
	public void getOpdQueueNextAssignByPID() throws IOException, JSONException {

		ArrayList<String> resArrayList = getHTTPResponse(
				properties
						.getProperty(TestCaseConstants.URL_APPEND_OPD_NEXT_ASSIGN_BY_PID)
						+patient,
				TestCaseConstants.HTTP_GET, null);
		
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);



	}
	
	
	
	
	
	
	
	
	

}
