import java.io.IOException;
import java.util.ArrayList;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;
import org.testng.Assert;
import org.testng.annotations.Test;

/**
 * This class is for TestNG Integration Test cases related to all
 * functionalities of BedResourceTests in HIS Project. developed by saugat.a
 * 
 * {@link BaseTestCase}
 * 
 * @author saugat.aryal
 *
 */
public class AdmissionResourceTestCase extends BaseTestCase {
	
	public static final int SUCCESS_STATUS_CODE = 200;
	public String BHT_No,Patient_ID,Ward_No;
	
	
	
	/**
	 * This test case is to add Ward Admission
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
	@Test(groups = "his.wardadmission.test")
	public void addWardTestCase() throws IOException, JSONException {

		JSONObject jsonRequestObject = new JSONObject(RequestUtil
				.requestByID(TestCaseConstants.ADD_WARD_ADMISSION));
		
		ArrayList<String> resArrayList = getHTTPResponse(
				properties
						.getProperty(TestCaseConstants.URL_APPEND_ADD_WARD_ADMISSION),
				TestCaseConstants.HTTP_POST, jsonRequestObject.toString());

		System.out.println("message :"+resArrayList.get(0));
		
		JSONObject jsonObject = new JSONObject(resArrayList.get(0));
		
		BHT_No= jsonObject.getString("bhtNo");
		Patient_ID = jsonObject.getJSONObject("patientID").getString("patientID");
		Ward_No= jsonObject.getString("wardNo");

		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)),
				SUCCESS_STATUS_CODE);
		Assert.assertEquals(BHT_No,jsonRequestObject.getString("bhtNo"));
	}
	
	
	/**
	 * This test case is to get Ward Admission
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
	@Test(groups = "his.wardadmission.test", dependsOnMethods = { "addWardTestCase" })
	public void getWardAdmissionTestCase() throws IOException, JSONException {

		ArrayList<String> resArrayList = getHTTPResponse(properties.getProperty(TestCaseConstants.URL_GET_WARD_ADMISSION),
				 TestCaseConstants.HTTP_GET, null);

		JSONArray jsonArray = new JSONArray(resArrayList.get(0));
		JSONObject jsonObject = ((JSONObject) jsonArray.get(jsonArray.length() - 1));

		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
		Assert.assertEquals(jsonObject.getString("bhtNo"), BHT_No);
		

	}
	
	
	/**
	 * This test case is to get Ward Admission details by BHT No
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
	@Test(groups = "his.wardadmission.test", dependsOnMethods = { "addWardTestCase" })
	public void getWardAdmissionDetailsByBHTNoTestCase() throws IOException, JSONException {

		ArrayList<String> resArrayList = getHTTPResponse(properties.getProperty(TestCaseConstants.URL_GET_WARD_ADMISSION_DETAILS_BY_BHT_NO)+BHT_No,
				 TestCaseConstants.HTTP_GET, null);

		
		JSONArray jsonArray = new JSONArray(resArrayList.get(0));
		JSONObject jsonObject = ((JSONObject) jsonArray.get(jsonArray.length() - 1));

		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
		Assert.assertEquals(jsonObject.getString("bhtNo"), BHT_No);
		

	}
	
	
	/**
	 * This test case is to get Ward Admission  by Patient ID
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
	@Test(groups = "his.wardadmission.test", dependsOnMethods = { "addWardTestCase" })
	public void getWardAdmissionByPatientIDTestCase() throws IOException, JSONException {

		ArrayList<String> resArrayList = getHTTPResponse(properties.getProperty(TestCaseConstants.URL_GET_WARD_ADMISSION_BY_PATIENT_ID)+Patient_ID,
				 TestCaseConstants.HTTP_GET, null);

		
		JSONArray jsonArray = new JSONArray(resArrayList.get(0));
		JSONObject jsonObject = ((JSONObject) jsonArray.get(jsonArray.length() - 1));

		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
		Assert.assertEquals(jsonObject.getJSONObject("patientID").getString("patientID"), Patient_ID);
		

	}
	
	/**
	 * This test case is to get Ward Admission  by Ward No
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
	@Test(groups = "his.wardadmission.test", dependsOnMethods = { "addWardTestCase" })
	public void getWardAdmissionByWardNoTestCase() throws IOException, JSONException {

		ArrayList<String> resArrayList = getHTTPResponse(properties.getProperty(TestCaseConstants.URL_GET_WARD_ADMISSION_BY_WARD_NO)+Ward_No,
				 TestCaseConstants.HTTP_GET, null);

		
		JSONArray jsonArray = new JSONArray(resArrayList.get(0));
		JSONObject jsonObject = ((JSONObject) jsonArray.get(jsonArray.length() - 1));

		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
		Assert.assertEquals(jsonObject.getString("wardNo"), Ward_No);
		

	}
	
	
	/**
	 * This test case is to get Patient Information  by BHT No
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
	@Test(groups = "his.wardadmission.test", dependsOnMethods = { "addWardTestCase" })
	public void getPatientInformationByBHTNoTestCase() throws IOException, JSONException {

		ArrayList<String> resArrayList = getHTTPResponse(properties.getProperty(TestCaseConstants.URL_GET_PATIENT_INFORMATION_BY_BHT_NO)+BHT_No,
				 TestCaseConstants.HTTP_GET, null);

		
		JSONArray jsonArray = new JSONArray(resArrayList.get(0));
		JSONObject jsonObject = ((JSONObject) jsonArray.get(jsonArray.length() - 1));

		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
		Assert.assertEquals(jsonObject.getString("bhtNo"), BHT_No);
		

	}
	
	/**
	 * This test case is to Update Discharge
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
	
	@Test(groups = "his.wardadmission.test", dependsOnMethods = { "addWardTestCase" })
	public void updateDischargeTestCase() throws IOException, JSONException {

		JSONObject jsonRequestObject = new JSONObject(RequestUtil
				.requestByID(TestCaseConstants.UPDATE_DISCHARGE));
		
		ArrayList<String> resArrayList = getHTTPResponse(
				properties
						.getProperty(TestCaseConstants.URL_APPEND_UPDATE_DISCHARGE),
				TestCaseConstants.HTTP_PUT, jsonRequestObject.toString());

		System.out.println("message :"+resArrayList.get(0));
		
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)),
				SUCCESS_STATUS_CODE);
		
	}
	
	/**
	 * This test case is to Update Discharge Sign 
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
	
	@Test(groups = "his.wardadmission.test", dependsOnMethods = { "addWardTestCase" })
	public void updateDischargeSignTestCase() throws IOException, JSONException {

		JSONObject jsonRequestObject = new JSONObject(RequestUtil
				.requestByID(TestCaseConstants.UPDATE_DISCHARGE_SIGN));
		
		ArrayList<String> resArrayList = getHTTPResponse(
				properties
						.getProperty(TestCaseConstants.URL_APPEND_UPDATE_DISCHARGE_SIGN),
				TestCaseConstants.HTTP_POST, jsonRequestObject.toString());

		System.out.println("message :"+resArrayList.get(0));

		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)),
				SUCCESS_STATUS_CODE);
		
	}
	
	/**
	 * This test case is to Update Admission Bed No
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
	
	@Test(groups = "his.wardadmission.test", dependsOnMethods = { "addWardTestCase" })
	public void updateAdmissionBedNoTestCase() throws IOException, JSONException {

		JSONObject jsonRequestObject = new JSONObject(RequestUtil
				.requestByID(TestCaseConstants.UPDATE_ADMISSION_BED_NO));
		
		ArrayList<String> resArrayList = getHTTPResponse(
				properties
						.getProperty(TestCaseConstants.URL_APPEND_UPDATE_ADMISSION_BED_NO),
				TestCaseConstants.HTTP_PUT, jsonRequestObject.toString());

		System.out.println("message :"+resArrayList.get(0));

		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)),
				SUCCESS_STATUS_CODE);
		
	}
	
	
	
	
	
	
	

}
