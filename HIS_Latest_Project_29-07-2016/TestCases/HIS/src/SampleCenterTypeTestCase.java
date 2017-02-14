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
public class SampleCenterTypeTestCase extends BaseTestCase{
	
	public static final int SUCCESS_STATUS_CODE = 200;
	
	public String sampleCenterTypeID,sampleCenterTypeName;
	
	
	/**
	 * This is Add Sample Center Type Test Case.
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
	
	@Test(groups = "his.lab.test")
	public void addSampleCenterTypeTestCase() throws IOException,JSONException{
		
		// Send POST request to add sample center type
		ArrayList<String> resArrayList = getHTTPResponse(
				properties.getProperty(TestCaseConstants.URL_APPEND_ADD_SAMPLE_CENTER_TYPE),
				TestCaseConstants.HTTP_POST, RequestUtil.requestByID(TestCaseConstants.ADD_NEW_SAMPLE_CENTER_TYPE));
		
		JSONObject jsonResponseObject = new JSONObject(resArrayList.get(0));
		JSONObject jsonRequestObject = new JSONObject(RequestUtil.requestByID(TestCaseConstants.ADD_NEW_SAMPLE_CENTER_TYPE));
		
		sampleCenterTypeID = jsonResponseObject.getString("sampleCenterType_ID");
		sampleCenterTypeName = jsonResponseObject.getString("sample_Center_TypeName");
		
		Assert.assertEquals(sampleCenterTypeName, jsonRequestObject.getString("sample_Center_TypeName"));
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
		
	}
	
	/**
	 * This test case is for get all sample center types
	 * 
	 * @throws IOException
	 */
	@Test(groups = "his.lab.test" , dependsOnMethods = "addSampleCenterTypeTestCase")
	
	public void getAllSampleCenterTypesTestCase() throws IOException,JSONException {
	
		ArrayList<String> resArrayList = getHTTPResponse(properties.getProperty(TestCaseConstants.URL_APPEND_GET_ALL_SAMPLE_CENTER_TYPES), 
				TestCaseConstants.HTTP_GET, null);
		
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)),SUCCESS_STATUS_CODE);
				
	}

	/**
	 * This test case is to update Sample Center Types
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
	
	
	@Test(groups = "his.lab.test" , dependsOnMethods = "addSampleCenterTypeTestCase")
	public void updateSampleCenterTypesTestCase() throws IOException,JSONException {
		
		// Get JSON Request body to send Sample Center type update Request
		JSONObject jsonResponseObject = new JSONObject(RequestUtil.requestByID(TestCaseConstants.UPDATE_SAMPLE_CENTER_TYPE));	
		
		jsonResponseObject.put("sampleCenterType_ID", sampleCenterTypeID);
		jsonResponseObject.put("sample_Center_TypeName", properties.get(TestCaseConstants.UPDATE_SAMPLE_CENTER_TYPE_NAME));

		// Send JSON Update Sample Center Type Request
		ArrayList<String> resArrayList = getHTTPResponse(properties.getProperty(TestCaseConstants.URL_APPEND_UPDATE_SAMPLE_CENTER_TYPE),
				TestCaseConstants.HTTP_POST, jsonResponseObject.toString());
		
		JSONArray jsonArray = new JSONArray(getHTTPResponse(properties.getProperty(TestCaseConstants.URL_APPEND_GET_ALL_SAMPLE_CENTER_TYPES), 
				TestCaseConstants.HTTP_GET, null).get(0));
		
		JSONObject jsonObject = (JSONObject)jsonArray.getJSONObject(jsonArray.length()-1);
		
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)),SUCCESS_STATUS_CODE);
		Assert.assertEquals(jsonObject.getString("sample_Center_TypeName"), properties.getProperty(TestCaseConstants.UPDATE_SAMPLE_CENTER_TYPE_NAME));
		
	}
	
	/**
	 * When execute this test case it deletes Sample Center Type for the provided ID
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 */
	
	@Test(enabled=true, groups = "his.lab.test" , dependsOnMethods = {"addSampleCenterTypeTestCase","updateSampleCenterTypesTestCase","getAllSampleCenterTypesTestCase"})
	public void deleteSampleCenterTypeTestCase() throws IOException , JSONException {
		
		ArrayList<String> resArrayList = getHTTPResponse(
				properties.get(TestCaseConstants.URL_APPEND_DELETE_SAMPLE_CENTER_TYPE)+sampleCenterTypeID, 
				TestCaseConstants.HTTP_GET, null);
		
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
		Assert.assertEquals(resArrayList.get(0), sampleCenterTypeID);
		
	}

}
