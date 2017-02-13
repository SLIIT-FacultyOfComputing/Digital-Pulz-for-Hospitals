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
public class SubTestFieldResultsTestCase extends BaseTestCase {
	
	public static final int SUCCESS_STATUS_CODE = 200;

	public JSONArray jsonArray;
	
	/**
	 * This test case is for add SubtestFields Results
	 * 
	 * @throws IOException
	 * @throws JSONException 
	 */
	@Test(groups = "his.lab.test")
	public void addNewSubTestFieldResultsTestCase() throws IOException, JSONException{

		ArrayList<String> resArrayList = getHTTPResponse(properties.getProperty(TestCaseConstants.URL_APPEND_ADD_SUBTESTFIELD_RESULTS),
				TestCaseConstants.HTTP_POST, RequestUtil.requestByID(TestCaseConstants.URL_APPEND_ADD_SUBTESTFIELD_RESULTS));
		
		
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
		
	}
	
	/**
	 * This test case is for get all SubtestFields Results
	 * 
	 * @throws IOException
	 * @throws JSONException 
	 */
	@Test(groups = "his.lab.test", dependsOnMethods = {"addNewSubTestFieldResultsTestCase"})
	public void getAllSubTestFieldsResultsTestCase() throws IOException, JSONException{

		JSONArray jsonArrayRequest = new JSONArray((new JSONObject(RequestUtil.requestByID(TestCaseConstants.URL_APPEND_ADD_SUBTESTFIELD_RESULTS)).get("subfieldsresults").toString()));
		
		ArrayList<String> resArrayList = getHTTPResponse(properties.getProperty(TestCaseConstants.URL_APPEND_GET_ALL_SUBTESTFIELDS_RESULTS),
				TestCaseConstants.HTTP_GET, null);
		
		jsonArray = new JSONArray(resArrayList.get(0));
		JSONObject jsonObject = (JSONObject) jsonArray.getJSONObject(jsonArray.length()-1).get("fMResultID");
		
		System.out.println(jsonObject);
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
		Assert.assertEquals(jsonObject.get("result_ID"), jsonArrayRequest.getJSONObject(jsonArrayRequest.length()-1).get("fMResultID"));
	}
	
}
