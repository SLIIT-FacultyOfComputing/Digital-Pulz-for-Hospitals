import java.io.IOException;
import java.util.ArrayList;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;
import org.testng.Assert;
import org.testng.annotations.Test;


/**
 * This class is for TestNG Integration Test cases related to all
 * functionalities of LaboratoryTests in HIS Project. developed by Ratnayake V.C.
 * 
 * {@link BaseTestCase}
 * 
 * @author ayodya
 *
 */
public class LabTestRequestTestCase extends BaseTestCase{
 
	public static final int SUCCESS_STATUS_CODE = 200;
	
	public String labTestRequestId, testID,comment,specimenID,remarks,patientId;
	
	
	/**
	 * This is Add Laboratory Test Request Test Case.
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
	@Test(groups="his.lab.test")
	public void addNewLabTestRequestTestCase() throws IOException, JSONException{
		
			ArrayList<String> resArrayList = getHTTPResponse(
					properties.getProperty(TestCaseConstants.URL_APPEND_ADD_LAB_TEST_REQUEST),
					TestCaseConstants.HTTP_POST, RequestUtil.requestByID(TestCaseConstants.ADD_LAB_TEST_REQUEST));
			
			JSONObject jsonObject = new JSONObject(resArrayList.get(0));
			
			labTestRequestId = jsonObject.getString("labTestRequest_ID");
			comment = jsonObject.getString("comment");
			patientId = jsonObject.getJSONObject("fpatient_ID").getString("patientID") ;
			
			Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
			Assert.assertEquals(jsonObject.getString("comment"), comment);
	}
	/**
	 * This is get all test requests Test Case.
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
	
	@Test(groups="his.lab.test" ,dependsOnMethods="addNewLabTestRequestTestCase")
	public void getAllTestRequestsTestCase() throws IOException , JSONException {
		
			ArrayList<String> resArrayList = getHTTPResponse(
					properties.getProperty(TestCaseConstants.URL_APPEND_GET_ALL_LAB_TEST_REQUESTS), 
					TestCaseConstants.HTTP_GET, null);
			
			Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
	}
	
	/**
	 * This isget test request by request id Test Case.
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
	@Test(groups="his.lab.test" ,dependsOnMethods={"addNewLabTestRequestTestCase","getAllTestRequestsTestCase"})
	public void getTestRequestByRequestIDTestCase() throws IOException, JSONException {
		
			ArrayList<String> resArrayList = getHTTPResponse(
					properties.getProperty(TestCaseConstants.URL_APPEND_LAB_TEST_REQUESTS_BY_ID)+labTestRequestId,
					TestCaseConstants.HTTP_GET, null);
			
			JSONObject jsonObject = new JSONObject(resArrayList.get(0));
			
			Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
			Assert.assertEquals(jsonObject.getString("labTestRequest_ID"), labTestRequestId);
		
	}
	/**
	 * This is add specimen information Test Case.
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
	@Test(groups="his.lab.test" ,dependsOnMethods={"addNewLabTestRequestTestCase"})
	public void  addSpecimenInfoTestCase() throws IOException, JSONException{
		
		JSONObject jsonRequestObject = new JSONObject(RequestUtil.requestByID(TestCaseConstants.ADD_SPECIMEN_INFO));

		System.out.println(labTestRequestId);
		jsonRequestObject.put("flabtestrequest_ID", labTestRequestId);

		ArrayList<String > resArrayList = getHTTPResponse(
				properties.getProperty(TestCaseConstants.URL_APPEND_ADD_SPECIMEN_INFO),
				TestCaseConstants.HTTP_POST, jsonRequestObject.toString());
		
		System.out.println(resArrayList.get(0));
		JSONObject jsonResponseObject = new JSONObject(resArrayList.get(0));
		
		specimenID = jsonResponseObject.getString("specimen_ID");
		remarks = jsonResponseObject.getString("remarks");	
		
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
		Assert.assertEquals(remarks, jsonRequestObject.getString("remarks"));
		//Assert.assertEquals(jsonResponseObject.getJSONObject("flabtestrequest_ID").getString("labTestRequest_ID"), 
		//	labTestRequestId);

	}
	/**
	 * This is get Specimen By Request ID Test Case.
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
	@Test(groups="his.lab.test" ,dependsOnMethods={"addNewLabTestRequestTestCase","addSpecimenInfoTestCase"})
	public void getSpecimenByRequestIDTestCase() throws IOException, JSONException {
		
		ArrayList<String> resArryList = getHTTPResponse(
				properties.getProperty(TestCaseConstants.URL_APPEND_GET_SPECIMEN_BY_REQUEST_ID)+labTestRequestId,
				TestCaseConstants.HTTP_GET, null);
		
		JSONObject jsonObject = new JSONObject(resArryList.get(0));

		Assert.assertEquals(Integer.parseInt(resArryList.get(1)), SUCCESS_STATUS_CODE);
		Assert.assertEquals(jsonObject.getString("specimen_ID"), specimenID);
		Assert.assertEquals(jsonObject.getString("remarks"), remarks);
		
	}
	
	/**
	 * This is get Specimen ID By Request ID Test Case.
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
	
	@Test(groups="his.lab.test" ,dependsOnMethods={"addNewLabTestRequestTestCase","addSpecimenInfoTestCase","getSpecimenByRequestIDTestCase"})
	public void getSpecimenIDByRequestIDTestCase() throws IOException, JSONException {
		
		ArrayList<String> resArryList = getHTTPResponse(
				properties.getProperty(TestCaseConstants.URL_APPEND_GET_SPECIMEN_ID_BY_REQUEST_ID)+labTestRequestId,
				TestCaseConstants.HTTP_GET, null);
		
		JSONObject jsonObject = new JSONObject(resArryList.get(0));

		Assert.assertEquals(Integer.parseInt(resArryList.get(1)), SUCCESS_STATUS_CODE);
		Assert.assertEquals(jsonObject.getString("specimen_ID"), specimenID);
		
	}
	
	/**
	 * This is get all speciment type Specimen  Test Case.
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
	@Test(groups="his.lab.test" ,dependsOnMethods={"addNewLabTestRequestTestCase","addSpecimenInfoTestCase","getSpecimenByRequestIDTestCase",
	"getSpecimenIDByRequestIDTestCase"})
	public void getAllSpecimenTypeTestCase() throws IOException {
		
		ArrayList<String> resArrayList = getHTTPResponse(
				properties.getProperty(TestCaseConstants.URL_APPEND_GET_ALL_SPECIMEN_TYPES), 
				TestCaseConstants.HTTP_GET, null);
		
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)),SUCCESS_STATUS_CODE );

	}
	
	/**
	 * This is get all Specimen retention type Test Case.
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
	@Test(groups="his.lab.test" ,dependsOnMethods={"addNewLabTestRequestTestCase","addSpecimenInfoTestCase","getSpecimenByRequestIDTestCase",
			"getSpecimenIDByRequestIDTestCase","getAllSpecimenTypeTestCase"})
	public void getAllSpecimenRetTypesTestCase() throws IOException {
		
		ArrayList<String> resArrayList = getHTTPResponse(
				properties.getProperty(TestCaseConstants.URL_APPEND_GET_ALL_SPECIMEN_RET_TYPES), 
				TestCaseConstants.HTTP_GET, null);
		
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)),SUCCESS_STATUS_CODE );

	}
	
	/**
	 * This is get request by patient ID Test Case.
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
	@Test(groups="his.lab.test" ,dependsOnMethods={"addNewLabTestRequestTestCase","addSpecimenInfoTestCase","getSpecimenByRequestIDTestCase",
			"getSpecimenIDByRequestIDTestCase","getAllSpecimenTypeTestCase","getAllSpecimenRetTypesTestCase"})
	public void  getRequestsByPatientIDTestCase() throws IOException, JSONException{
		
		ArrayList<String> resArrayList = getHTTPResponse(
				properties.getProperty(TestCaseConstants.URL_APPEND_LAB_TEST_REQUESTS_BY_PATIENT_ID)+patientId, 
				TestCaseConstants.HTTP_GET, null);
		
		JSONArray jsonArray = new JSONArray(resArrayList.get(0));
		
		JSONObject jsonObject = ((JSONObject) jsonArray.get(jsonArray.length() - 1));
		
		Assert.assertEquals(jsonObject.getJSONObject("fpatient_ID").getString("patientID"), patientId);
		Assert.assertEquals(jsonObject.getString("labTestRequest_ID"), labTestRequestId);
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
		
	}
	
	/**
	 * This is set request status Test Case.
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
	@Test(groups="his.lab.test" ,dependsOnMethods={"addNewLabTestRequestTestCase","addSpecimenInfoTestCase","getSpecimenByRequestIDTestCase",
			"getSpecimenIDByRequestIDTestCase","getAllSpecimenTypeTestCase","getAllSpecimenRetTypesTestCase"})
	public void setStatusTestCase() throws IOException, JSONException{
		
		JSONObject jsonObject = new JSONObject(RequestUtil.requestByID(TestCaseConstants.LAB_TEST_REQUEST_STATUS ));
		
		jsonObject.put("reqID", labTestRequestId);
		jsonObject.put("status", properties.getProperty(TestCaseConstants.LAB_TEST_REQUEST_STATUS));
	
		ArrayList<String> resArrayList2 = getHTTPResponse(
				properties.getProperty(TestCaseConstants.URL_APPEND_SET_LAB_TEST_REQUEST_STATUS),
				TestCaseConstants.HTTP_POST, jsonObject.toString());
		
		//JSONObject jsonObject1 = new JSONObject(resArrayList2.get(0));
		
		Assert.assertEquals(Integer.parseInt(resArrayList2.get(1)), SUCCESS_STATUS_CODE);
		Assert.assertEquals(resArrayList2.get(0), properties.getProperty(TestCaseConstants.LAB_TEST_REQUEST_STATUS));
		

	}
	
}
