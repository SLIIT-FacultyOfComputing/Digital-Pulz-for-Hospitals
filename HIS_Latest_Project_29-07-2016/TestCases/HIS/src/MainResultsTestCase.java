import java.io.IOException;
import java.util.ArrayList;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;
import org.testng.Assert;
import org.testng.annotations.Test;

/**
 * This class is for TestNG Integration Test cases related to all
 * functionalities of Laboratory in HIS Project. developed by Nisal De Silva.
 * 
 * {@link BaseTestCase}
 * @author nisal.d
 * 
 */
public class MainResultsTestCase extends BaseTestCase {
  
	public static final int SUCCESS_STATUS_CODE = 200;
	
	public JSONArray mainResultList;
	/**
	 * Test Case for Add Main Results
	 * 
	 * @throws IOException
	 * @throws JSONException
	 */
	@Test(groups = "his.lab.test")
	public void addMainResultsTestCase() throws IOException, JSONException {
	
		
		ArrayList<String> resArrayList = getHTTPResponse(
				properties.getProperty(TestCaseConstants.URL_APPEND_ADD_MAIN_RESULTS), TestCaseConstants.HTTP_POST,
				RequestUtil.requestByID(TestCaseConstants.URL_APPEND_ADD_MAIN_RESULTS));

		JSONObject jsonbject = new JSONObject(RequestUtil.requestByID(TestCaseConstants.URL_APPEND_ADD_MAIN_RESULTS));
		JSONArray jsonArray = jsonbject.getJSONArray("Parentresults");
		
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
		Assert.assertEquals(resArrayList.get(0),String.valueOf(jsonArray.length()));
	}
	
	
	/**
	 * This test case is for get all Main Results
	 * 
	 * @throws IOException
	 */
	@Test(groups = "his.lab.test", dependsOnMethods = { "addMainResultsTestCase" })
	public void getAllMainResultsTestCase() throws IOException{

		ArrayList<String> resArrayList = getHTTPResponse(properties.getProperty(TestCaseConstants.URL_APPEND_GET_ALL_MAIN_RESULTS),
				TestCaseConstants.HTTP_GET, null);

		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
	}
	
	/**
	 * This test case is for get all sub Categories 
	 * 
	 * @throws IOException
	 */
	@Test(groups = "his.lab.test", dependsOnMethods = { "addMainResultsTestCase" })
	public void getAllSubCategoriesTestCase() throws IOException {

		ArrayList<String> resArrayList = getHTTPResponse(properties.getProperty(TestCaseConstants.URL_APPEND_GET_ALL_MAIN_SUB_CATEGORIES
				)+properties.getProperty(TestCaseConstants.SUB_CATEGORIES),TestCaseConstants.HTTP_GET, null);


		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
		
	}
}
