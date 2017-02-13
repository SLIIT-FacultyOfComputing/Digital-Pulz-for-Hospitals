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
public class SampleCenterTestCase extends BaseTestCase {
	
	public static final int SUCCESS_STATUS_CODE = 200;
	
	public String sampleCenterIncharge,sampleCenterTypeID,sampleCenterTypeName;
	
	public int sampleCenterID;

	/**
	 * Test Case for Insert Lab Test
	 * 
	 * @throws IOException
	 * @throws JSONException
	 */
	@Test(groups = "his.lab.test")
	public void addNewSampleCenterTestCase() throws IOException, JSONException {
	  
		ArrayList<String> resArrayList = getHTTPResponse(
				properties.getProperty(TestCaseConstants.URL_APPEND_ADD_NEW_SAMPLE_CENTER), TestCaseConstants.HTTP_POST,
				RequestUtil.requestByID(TestCaseConstants.ADD_NEW_SAMPLE_CENTER));
		
		

		JSONObject jsonObject = new JSONObject(resArrayList.get(0));	
		
		sampleCenterIncharge = jsonObject.getString("sampleCenter_Incharge");
		sampleCenterID=Integer.parseInt(jsonObject.getString("sampleCenter_ID"));
		sampleCenterTypeID = jsonObject.getJSONObject("fSampleCenterType_ID").getString("sampleCenterType_ID");
		sampleCenterTypeName=jsonObject.getJSONObject("fSampleCenterType_ID").getString("sample_Center_TypeName");
		
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
		Assert.assertEquals(jsonObject.getString("sampleCenter_Incharge"), "Tester");
	  
	}
	
	/**
	 * This test case is for get all Sample Centers
	 * 
	 * @throws IOException
	 */
	@Test(groups="his.lab.test", dependsOnMethods = {"addNewSampleCenterTestCase"})
	public void getAllSampleCentersTestCase() throws IOException,JSONException{
	
		ArrayList<String> resArrayList=getHTTPResponse(properties.getProperty(TestCaseConstants.URL_APPEND_GET_ALL_SAMPLE_CENTERS), 
				TestCaseConstants.HTTP_GET, null);
		
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
		
				
	}
	
	/**
	 * This test case is for get Sample Centers By Lab Type
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
	
	@Test(groups="his.lab.test" ,dependsOnMethods={"addNewSampleCenterTestCase"})
	public void getSampleCentersByLabTypeTestCase() throws IOException,JSONException{
		
		ArrayList<String> resArrayList=getHTTPResponse(properties.getProperty(TestCaseConstants.URL_APPEND_GET_SAMPLE_CENTERS_BY_LAB_TYPE)
				+ sampleCenterTypeID,TestCaseConstants.HTTP_GET, null);
		
		JSONArray jsonArray = new JSONArray(resArrayList.get(0));		
		JSONObject jsonObject = ((JSONObject) jsonArray.get(jsonArray.length() - 1));
		
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
		Assert.assertEquals(jsonObject.getString("sampleCenter_ID"), String.valueOf(sampleCenterID));	
		Assert.assertEquals(jsonObject.getJSONObject("fSampleCenterType_ID").getString("sample_Center_TypeName"), sampleCenterTypeName);
		
	}
	
	/**
	 * This test case is to update Sample Center
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
	
	@Test(enabled = true ,groups="his.lab.test" ,dependsOnMethods={"addNewSampleCenterTestCase"})
	public void updateSampleCenterDetailsTestCase() throws IOException , JSONException {
		
		// Get JSON Request body to send Sample Center update Request
		JSONObject jsonResponseObject = new JSONObject(RequestUtil.requestByID(TestCaseConstants.UPDATE_SAMPLE_CENTER));		
		
		jsonResponseObject.put("sampleCenter_ID", sampleCenterID);
		jsonResponseObject.put("email", properties.get(TestCaseConstants.UPDATE_SAMPLE_CENTER_EMAIL));
		jsonResponseObject.put("sampleCenter_Name", properties.get(TestCaseConstants.UPDATE_SAMPLE_CENTER_NAME));

		// Send JSON Update Sample Center Request
		ArrayList<String> resArrayList = getHTTPResponse(properties.getProperty(TestCaseConstants.URL_APPEND_UPDATE_SAMPLE_CENTER),
				TestCaseConstants.HTTP_POST, jsonResponseObject.toString());
		
		JSONArray jsonArray = new JSONArray(getHTTPResponse(properties.getProperty(TestCaseConstants.URL_APPEND_GET_ALL_SAMPLE_CENTERS), 
				TestCaseConstants.HTTP_GET, null).get(0));
		
		JSONObject jsonObject = ((JSONObject) jsonArray.get(jsonArray.length() - 1));
		
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
		Assert.assertEquals(jsonObject.getString("email"), properties.get(TestCaseConstants.UPDATE_SAMPLE_CENTER_EMAIL));
		Assert.assertEquals(jsonObject.getString("sampleCenter_Name"), properties.get(TestCaseConstants.UPDATE_SAMPLE_CENTER_NAME));
		Assert.assertEquals(Integer.parseInt(resArrayList.get(0)), sampleCenterID);
		
	}	
	
	/**
	 * When execute this test case it deletes Sample Center for the provided ID
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 */
	@Test(enabled = true ,groups="his.lab.test" ,dependsOnMethods={"addNewSampleCenterTestCase","updateSampleCenterDetailsTestCase"})
	public void deleteSampleCenterTestCase() throws IOException , JSONException{
		
		ArrayList<String> resArrayList = getHTTPResponse(properties.getProperty(TestCaseConstants.URL_APPEND_DELETE_SAMPLE_CENTER)+sampleCenterID, 
				TestCaseConstants.HTTP_GET, null);
		
		System.out.println(resArrayList.get(0));
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
		Assert.assertEquals(resArrayList.get(0), String.valueOf(sampleCenterID));
		
	}
	
}
