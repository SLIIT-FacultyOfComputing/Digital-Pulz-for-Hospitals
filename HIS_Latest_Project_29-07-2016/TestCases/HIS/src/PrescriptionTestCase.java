import java.io.IOException;
import java.text.DateFormat;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Date;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;
import org.testng.Assert;
import org.testng.annotations.Test;

/**
 * This class is for TestNG Integration Test cases related to all
 * functionalities of OPD in HIS Project. developed by Nisal De Silva.
 * 
 * {@link BaseTestCase}
 * @author nisal.d
 * 
 */
public class PrescriptionTestCase extends BaseTestCase {

	public static final int SUCCESS_STATUS_CODE = 200;
	
	public static String prescriptionId;
	public static String patientId;
	public static String prescribeddate;
	public JSONArray jsonArray;
	
	
	/**
	 * This test case is for add New prescription with 2 prescription items
	 * 
	 * @throws IOException
	 */
	@Test(groups = "his.lab.test.prescription")
	public void addPrescriptionTestCase() throws IOException, JSONException {
	
		patientId = properties.getProperty(TestCaseConstants.PRESCRIPTION_PATIENT_ID);
		ArrayList<String> resArrayList = getHTTPResponse(
				properties.getProperty(TestCaseConstants.URL_APPEND_ADD_PRESCRIPTION)+patientId
				+"/"+properties.getProperty(TestCaseConstants.PRESCRIPTIION_VISIT_ID)+"/"+properties.getProperty(TestCaseConstants.PRESCRIPTION_USER_ID), TestCaseConstants.HTTP_POST,
				RequestUtil.requestByID(TestCaseConstants.URL_APPEND_ADD_PRESCRIPTION));

		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
	}
	
	/**
	 * This test case is to update prescription
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
	@Test(groups = "his.lab.test.prescription", dependsOnMethods = { "addPrescriptionTestCase","getPrescriptionsByPrescriptionTestCase", "addPrescriptionTestCase" })
	public void updatePrescriptionTestCase() throws IOException, JSONException {

		// Send JSON Update prescription Request
		ArrayList<String> resArrayList = getHTTPResponse(
				properties.getProperty(TestCaseConstants.URL_APPEND_UPDATE_PRESCRIPTION)+properties.getProperty(TestCaseConstants.PRESCRIPTION_PATIENT_ID)
				+"/"+ prescriptionId + "/"+ properties.getProperty(TestCaseConstants.PRESCRIPTION_USER_ID), TestCaseConstants.HTTP_POST,
				RequestUtil.requestByID(TestCaseConstants.URL_APPEND_UPDATE_PRESCRIPTION));

		

		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
		Assert.assertEquals(resArrayList.get(0), prescriptionId);
	}
	
	/**
	 * This test case is for get prescription by patient ID
	 * 
	 * @throws IOException
	 * @throws JSONException 
	 */
	@Test(groups = "his.lab.test.prescription", dependsOnMethods = { "addPrescriptionTestCase"})
	public void getPrescriptionsByPatientTestCase() throws IOException, JSONException{

		ArrayList<String> resArrayList = getHTTPResponse(properties.getProperty(TestCaseConstants.URL_APPEND_GET_PRESCRIPTION_BY_PATIENT_ID)+patientId,
				TestCaseConstants.HTTP_GET, null);
		
		jsonArray = new JSONArray(resArrayList.get(0));
		
		JSONArray jsonArrayRequest = new JSONArray(RequestUtil.requestByID(TestCaseConstants.URL_APPEND_ADD_PRESCRIPTION));
		JSONObject jsonObject2 = jsonArray.getJSONObject(jsonArray.length()-1);
		
		JSONArray jsonArray2 = jsonObject2.getJSONArray("prescribeItems");

		
		System.out.println(jsonArrayRequest.getJSONObject(jsonArrayRequest.length()-1));
		System.out.println(jsonArray2.getJSONObject(jsonArray2.length()-1));
		
		prescriptionId = (jsonArray.getJSONObject(jsonArray.length() - 1)).getString("prescriptionID");
		System.out.println("prescriptionID = "+ prescriptionId);
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
		Assert.assertEquals(jsonArray2.getJSONObject(jsonArray2.length()-1).getString("prescribeItemsPeriod"),jsonArrayRequest.getJSONObject(jsonArrayRequest.length()-1).getString("period"));
	}
	
	
	/**
	 * This test case is for get prescription by prescription ID
	 * 
	 * @throws IOException
	 * @throws JSONException 
	 */
	@Test(groups = "his.lab.test.prescription", dependsOnMethods = { "addPrescriptionTestCase", "getPrescriptionsByPatientTestCase"})
	public void getPrescriptionsByPrescriptionTestCase() throws IOException, JSONException{

		ArrayList<String> resArrayList = getHTTPResponse(properties.getProperty(TestCaseConstants.URL_APPEND_GET_PRESCRIPTION_PRES_ID)+prescriptionId,
				TestCaseConstants.HTTP_GET, null);
	
		JSONObject jsonObject2 =  new JSONObject(resArrayList.get(0));
		
		
		prescriptionId = (jsonArray.getJSONObject(jsonArray.length() - 1)).getString("prescriptionID");
		System.out.println("prescriptionID = "+ prescriptionId);
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
		Assert.assertEquals(jsonObject2.get("prescriptionID").toString(),prescriptionId.toString());
	}
	
	/**
	 * This test case is for get prescription by patient ID after prescribing
	 * 
	 * @throws IOException
	 * @throws JSONException 
	 */
	@Test(groups = "his.lab.test.prescription2", dependsOnMethods = { "updatePrescriptionTestCase"})
	public void getPrescriptionsByPatientIDAfterprescribeTestCase() throws IOException, JSONException{

		DateFormat dateFormat = new SimpleDateFormat("yyyy-MM-dd");
		Date date = new Date();
		System.out.println(dateFormat.format(date));
		prescribeddate = dateFormat.format(date);
		
		ArrayList<String> resArrayList = getHTTPResponse(properties.getProperty(TestCaseConstants.URL_APPEND_GET_PRESCRIPTION_BY_PID_AFTER_PRESCRIBE)+patientId+"/"+dateFormat.format(date),
				TestCaseConstants.HTTP_GET, null);
		
		JSONArray jsonArrayRequest = new JSONArray(RequestUtil.requestByID(TestCaseConstants.URL_APPEND_UPDATE_PRESCRIPTION));
		
		jsonArray = new JSONArray(resArrayList.get(0));
		if(jsonArray.length() > 0)
		{
		JSONObject jsonObject2 = jsonArray.getJSONObject(jsonArray.length()-1);
		JSONArray jsonArrayResponse = jsonObject2.getJSONArray("prescribeItems");
		
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
		Assert.assertEquals(jsonArrayResponse.getJSONObject(jsonArrayResponse.length()-1).getString("prescribeItemsFrequency"), jsonArrayRequest.getJSONObject(jsonArrayRequest.length()-1).getString("freq"));
	
		}
		else
		{
			Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
			Assert.assertEquals(jsonArray.toString(), "[]");
		}
	
	}
	/**
	 * This test case is for get prescription by patient ID after prescribing
	 * 
	 * @throws IOException
	 * @throws JSONException 
	 */
	@Test(groups = "his.lab.test.prescription2", dependsOnMethods = { "getPrescriptionsByPatientIDAfterprescribeTestCase"})
	public void getPrescriptionsByPatientIDAfterprescribeDetailsTestCase() throws IOException, JSONException{

		
		
		ArrayList<String> resArrayList = getHTTPResponse(properties.getProperty(TestCaseConstants.URL_APPEND_GET_PRESCIPTION_BY_PID_AFTER_DETAILS)+patientId,
				TestCaseConstants.HTTP_GET, null);
		
		jsonArray = new JSONArray(resArrayList.get(0));

		
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
		
	}
	
	public static String getPrescriptionId()
	{
		return prescriptionId;
	}
}
