import java.io.IOException;
import java.util.ArrayList;

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
public class OutPatientTestCase extends BaseTestCase {

public static final int SUCCESS_STATUS_CODE = 200;
	
	public String patientId;
	public String doctorId;
	public String hin; 
	public JSONArray jsonArray;
	
	
	
	/**
	 * This test case is for add New paint
	 * 
	 * @throws IOException
	 */
	@Test(groups = "his.opd.test.outpatient")
	public void registerPatientTestCase() throws IOException, JSONException {
	
		
		ArrayList<String> resArrayList = getHTTPResponse(
				properties.getProperty(TestCaseConstants.URL_APPEND_ADD_PATIENT), TestCaseConstants.HTTP_POST,
				RequestUtil.requestByID(TestCaseConstants.URL_APPEND_ADD_PATIENT));

		System.out.println("Add Exam = "+ resArrayList.get(0));
		patientId = (new JSONObject(resArrayList.get(0))).getString("patientID");
		
		System.out.println("Add Patient ID = "+ patientId);
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);

	}
	
	/**
	 * This test case is to update examimations
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
	@Test(groups = "his.opd.test.outpatient", dependsOnMethods = { "registerPatientTestCase", "getAllPatientsTestCase" })
	public void updateExamTestCase() throws IOException, JSONException {

		JSONObject jsonResponse = new JSONObject(RequestUtil.requestByID(TestCaseConstants.URL_APPEND_UPDATE_PATIENT));
		
		jsonResponse.put("hin", hin);
		jsonResponse.put("pid", patientId);
		ArrayList<String> resArrayList = getHTTPResponse(
				properties.getProperty(TestCaseConstants.URL_APPEND_UPDATE_PATIENT), TestCaseConstants.HTTP_POST,
				jsonResponse.toString());

		
		System.out.println("Update Exam = "+ resArrayList.get(0));
		
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);


	}
	/**
	 * This test case is for get all Patients
	 * @throws IOException
	 * @throws JSONException 
	 */
	@Test(groups = "his.opd.test.outpatient", dependsOnMethods = { "registerPatientTestCase"})
	public void getAllPatientsTestCase() throws IOException, JSONException{

		ArrayList<String> resArrayList = getHTTPResponse(properties.getProperty(TestCaseConstants.URL_APPEND_GET_ALL_PATIENTS),
				TestCaseConstants.HTTP_GET, null);
		
		jsonArray = new JSONArray(resArrayList.get(0));
		
		
		
		JSONObject jsonObject = new JSONObject(RequestUtil.requestByID(TestCaseConstants.URL_APPEND_ADD_PATIENT));
		JSONObject jsonObject2 = jsonArray.getJSONObject(jsonArray.length()-1);
		
		System.out.println(jsonArray.getJSONObject(jsonArray.length()-1));
		patientId = jsonObject2.getString("patientID");
		hin = jsonObject2.getString("patientHIN");
		
		System.out.println("patientId = "+ patientId);
		
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
		Assert.assertEquals(jsonObject2.getString("patientFullName"),jsonObject.getString("fullname"));
	}
	
	/**
	 * This test case is for get Max Patient ID
	 * @throws IOException
	 * @throws JSONException 
	 */
	@Test(groups = "his.opd.test.outpatient", dependsOnMethods = { "registerPatientTestCase","getAllPatientsTestCase"})
	public void getMaxPatientIDTestCase() throws IOException, JSONException{

		ArrayList<String> resArrayList = getHTTPResponse(properties.getProperty(TestCaseConstants.URL_APPEND_GET_MAX_PATIENT_ID),
				TestCaseConstants.HTTP_GET, null);
		
		System.out.println("getMaxPatientID = " +resArrayList.get(0));

		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
		Assert.assertEquals(resArrayList.get(0),"\""+ patientId +"\"");

	}
//	/**
//	 * This test case is for get patient by visit type and user id
//	 * 
//	 * @throws IOException
//	 * @throws JSONException 
//	 */
//	@Test(groups = "his.lab.test", dependsOnMethods = { "registerPatientTestCase","getAllPatientsTestCase"})
//	public void getPatientsByUserIDVisitTypeTestCase() throws IOException, JSONException{
//
//		ArrayList<String> resArrayList = getHTTPResponse(properties.getProperty(TestCaseConstants.URL_APPEND_GET_PATIENT_BY_VISITS_USERS)+
//				properties.getProperty(TestCaseConstants.OUTPATIENT_USER_ID) +"/" + properties.getProperty(TestCaseConstants.OUTPATIENT_VISIT_TYPE),
//				TestCaseConstants.HTTP_GET, null);
//		
//		jsonArray = new JSONArray(resArrayList.get(0));
//		
//		
//		
//		JSONObject jsonObject = new JSONObject(RequestUtil.requestByID(TestCaseConstants.URL_APPEND_ADD_PATIENT));
//		JSONObject jsonObject2 = jsonArray.getJSONObject(jsonArray.length()-1);
//
//		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
//
//	}
	/**
	 * This test case is for get patient by visit type and user id
	 * 
	 * @throws IOException
	 * @throws JSONException 
	 */
	@Test(groups = "his.opd.test.outpatient", dependsOnMethods = { "registerPatientTestCase","getAllPatientsTestCase"})
	public void getPatientsForDoctorTestCase() throws IOException, JSONException{

		ArrayList<String> resArrayList = getHTTPResponse(properties.getProperty(TestCaseConstants.URL_APPEND_GET_PATIENT_FOR_DOCTOR)+
				properties.getProperty(TestCaseConstants.OUTPATIENT_USER_ID) +"/" + properties.getProperty(TestCaseConstants.OUTPATIENT_VISIT_TYPE),
				TestCaseConstants.HTTP_GET, null);
		
		jsonArray = new JSONArray(resArrayList.get(0));
		
		
		JSONObject jsonObject = jsonArray.getJSONObject(jsonArray.length()-1);

		System.out.println(jsonObject);
		
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);

	}
	/**
	 * This test case is for get patient details
	 * 
	 * @throws IOException
	 * @throws JSONException 
	 */
	@Test(groups = "his.opd.test.outpatient", dependsOnMethods = { "registerPatientTestCase", "getAllPatientsTestCase", "updateExamTestCase"})
	public void PatientDetailsTestCase() throws IOException, JSONException{

		ArrayList<String> resArrayList = getHTTPResponse(properties.getProperty(TestCaseConstants.URL_APPEND_GET_PATIENT_BY_ID)+patientId,
				TestCaseConstants.HTTP_GET, null);
		
		JSONObject jsonObject = new JSONObject(resArrayList.get(0));
		
		
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
		Assert.assertEquals(jsonObject.getString("patientID"), patientId);
		Assert.assertEquals(jsonObject.getString("patientHIN"), hin);
	}
	
	public String getHIN() throws IOException, JSONException
	{
		ArrayList<String> resArrayList = getHTTPResponse(properties.getProperty(TestCaseConstants.URL_APPEND_GET_ALL_PATIENTS),
				TestCaseConstants.HTTP_GET, null);
		
		jsonArray = new JSONArray(resArrayList.get(0));
		
		JSONObject jsonObject = jsonArray.getJSONObject(jsonArray.length()-1);
		
		return jsonObject.getString("patientHIN");
	}
}

