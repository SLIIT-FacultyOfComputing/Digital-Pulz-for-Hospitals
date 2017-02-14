import java.io.IOException;
import java.util.ArrayList;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;
import org.testng.Assert;
import org.testng.annotations.Test;

/**
 * This class is for TestNG Integration Test cases related to all
 * functionalities of Laboratory in HIS Project. developed by Udesh Hewagama.
 * for LabResource.java
 * {@link BaseTestCase}
 * @author udesh.c
 * 
 */
public class TestNamesTestCase extends BaseTestCase {

	public static final int SUCCESS_STATUS_CODE = 200;

	public String testID, testName, testCat;

	/**
	 * Test Case for Insert Lab Test
	 * 
	 * @throws IOException
	 * @throws JSONException
	 */
	@Test(groups = "his.lab.test")
	public void insertLabTestsTestCase() throws IOException, JSONException {

		ArrayList<String> resArrayList = getHTTPResponse(
				properties.getProperty(TestCaseConstants.URL_APPEND_ADD_TEST), TestCaseConstants.HTTP_POST,
				RequestUtil.requestByID(TestCaseConstants.ADD_TEST));

		JSONObject jsonObject = new JSONObject(resArrayList.get(0));
		testID = jsonObject.getString("test_ID");
		testName = jsonObject.getString("test_Name");
		
		Assert.assertEquals(testName, properties.getProperty(TestCaseConstants.ADD_TEST_NAME));
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
		
	}
	/**
	 * This test case is for get all Lab Tests
	 * 
	 *  @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
	@Test(groups = "his.lab.test")
	public void getAllLabTestsTestCase() throws IOException,JSONException {

		ArrayList<String> resArrayList = getHTTPResponse(properties.getProperty(TestCaseConstants.URL_APPEND_LAB_TESTS),
				TestCaseConstants.HTTP_GET, null);
		JSONArray jsonArray = new JSONArray(resArrayList.get(0));
		JSONObject jsonObject = ((JSONObject) jsonArray.get(jsonArray.length() - 1));
		JSONObject jsonObject2 = jsonObject.getJSONObject("fTest_CategoryID");

		testCat=jsonObject2.getString("category_Name");
		Assert.assertEquals(testCat, properties.getProperty(TestCaseConstants.TEST_CAT_NAME));
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
	}
	
	/**
	 * This test case is for delete a lab test
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
	@Test(groups = "his.lab.test", dependsOnMethods = { "insertLabTestsTestCase", "getMaxTestIDTestCase", "updateTestsTestCase" })
	public void deleteLabTestsTestCase() throws IOException,JSONException {

		ArrayList<String> resArrayList = getHTTPResponse(properties.getProperty(TestCaseConstants.URL_APPEND_DELETE_TEST)
				+ testID ,TestCaseConstants.HTTP_GET, null);
		
		
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
		
	}

	/**
	 * This test case is for getting the maximum test id
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 */
	@Test(groups = "his.lab.test" , dependsOnMethods = {"insertLabTestsTestCase"})
	public void getMaxTestIDTestCase() throws IOException {

		ArrayList<String> resArrayList = getHTTPResponse(properties.getProperty(TestCaseConstants.URL_APPEND_MAX_TEST_ID),
				TestCaseConstants.HTTP_GET, null);
		String maxID = new String(resArrayList.get(0));
		maxID = maxID.replaceAll("\"", "");
		System.out.println(maxID);
		
		
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
		Assert.assertEquals(maxID, testID);
	}
	
	/**
	 * This test case is to update Laboratory
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */

	@Test(groups = "his.lab.test", dependsOnMethods = { "insertLabTestsTestCase" })
	public void updateTestsTestCase() throws IOException, JSONException {

		// Get JSON Request body to send test update Request
		JSONObject jsonResponseObject = new JSONObject(RequestUtil.requestByID(TestCaseConstants.UPDATE_TEST));
		
		jsonResponseObject.put("test_ID", testID);
		jsonResponseObject.put("test_Name", properties.get(TestCaseConstants.UPDATE_TEST_NAME));

		// Send JSON Update test Request
		ArrayList<String> resArrayList = getHTTPResponse(
				properties.getProperty(TestCaseConstants.URL_APPEND_UPDATE_TEST), TestCaseConstants.HTTP_POST,
				jsonResponseObject.toString());

		//Get Updated Lab tests by getting all tests
		JSONArray jsonArray = new JSONArray(getHTTPResponse(
				properties.getProperty(TestCaseConstants.URL_APPEND_LAB_TESTS),
				TestCaseConstants.HTTP_GET, null).get(0));
		JSONObject jsonObject = ((JSONObject) jsonArray.get(jsonArray.length() - 1));

		/*
		 * Assert updated details of Test case by selecting test case with get
		 * /test request 
		 */
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
		Assert.assertEquals(properties.get(TestCaseConstants.UPDATE_TEST_NAME), jsonObject.getString("test_Name"));

	}
	

}
