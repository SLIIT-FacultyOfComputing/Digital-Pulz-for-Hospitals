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
public class CategoryTestCase extends BaseTestCase {
	  
	public static final int SUCCESS_STATUS_CODE = 200;
		
	public static String categoryId;
		
	/**
	 * This test case is for get all Categories
	 * 
	 * @throws IOException
	 * @throws JSONException 
	 */
	@Test(groups = "his.lab.test", dependsOnMethods = { "addNewCatDetailsTestCase" })
	public void getAllCategoriesTestCase() throws IOException, JSONException{

		ArrayList<String> resArrayList = getHTTPResponse(properties.getProperty(TestCaseConstants.URL_APPEND_GET_ALL_CATEGORY),
				TestCaseConstants.HTTP_GET, null);

		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
		
	}
	
	/**
	 * This test case is for add New Category
	 * 
	 * @throws IOException
	 */
	@Test(groups = "his.lab.test")
	public void addNewCatDetailsTestCase() throws IOException, JSONException {
	
		
		ArrayList<String> resArrayList = getHTTPResponse(
				properties.getProperty(TestCaseConstants.URL_APPEND_ADD_CATEGORY), TestCaseConstants.HTTP_POST,
				RequestUtil.requestByID(TestCaseConstants.URL_APPEND_ADD_CATEGORY));

		JSONArray jsonArray = new JSONArray(getHTTPResponse(properties.getProperty(TestCaseConstants.URL_APPEND_GET_ALL_CATEGORY),
				TestCaseConstants.HTTP_GET, null).get(0));
		JSONObject jsonObject = jsonArray.getJSONObject(jsonArray.length() - 1);
		categoryId = resArrayList.get(0);
		
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
		Assert.assertEquals(categoryId, jsonObject.getString("category_ID"));
	}
	
	
	/**
	 * This test case is to update Categories Details
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */

	@Test(groups = "his.lab.test", dependsOnMethods = { "getAllCategoriesTestCase", "addNewCatDetailsTestCase"})
	public void updateCategoriesDetailsTestCase() throws IOException, JSONException {

		// Get JSON Request body to send category update Request
		JSONObject jsonResponseObject = new JSONObject(RequestUtil.requestByID(TestCaseConstants.URL_APPEND_ADD_CATEGORY));
		
		jsonResponseObject.put("category_ID", categoryId);
		jsonResponseObject.put("category_Name", properties.get(TestCaseConstants.UPDATE_CATEGORY_NAME));
		

		// Send JSON Update category Request
		ArrayList<String> resArrayList = getHTTPResponse(
				properties.getProperty(TestCaseConstants.URL_APPEND_UPDATE_CATEGORY), TestCaseConstants.HTTP_POST,
				jsonResponseObject.toString());

		//Get last entry from the category list
		JSONArray jsonArray = new JSONArray(getHTTPResponse(properties.getProperty(TestCaseConstants.URL_APPEND_GET_ALL_CATEGORY),
				TestCaseConstants.HTTP_GET, null).get(0));
		JSONObject jsonObject = jsonArray.getJSONObject(jsonArray.length() - 1);
		

		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
		Assert.assertEquals(properties.get(TestCaseConstants.UPDATE_CATEGORY_NAME), jsonObject.getString("category_Name"));
		Assert.assertEquals(resArrayList.get(0), categoryId);
	}
	
	/**
	 * This test case is for delete Category
	 * 
	 * @throws IOException
	 */
	@Test(groups = "his.lab.test", dependsOnMethods = { "getAllCategoriesTestCase", "addNewCatDetailsTestCase", "updateCategoriesDetailsTestCase"}, dependsOnGroups = {"his.lab.test.subcategory"})
	public void deleteCategoryTestCase() throws IOException {

		// Get response for delete category test case
		ArrayList<String> resArrayList = getHTTPResponse(properties.getProperty(TestCaseConstants.URL_APPEND_DELETE_CATEGORY)
				+ categoryId, TestCaseConstants.HTTP_GET, null);

		System.out.println(resArrayList.get(0));
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
		Assert.assertEquals(resArrayList.get(0), categoryId);
	}
		
	/**
	 * Method to get the last Id of Category
	 * 
	 * @throws IOException
	 * @throws JSONException
	 */
	public String getCatId() throws JSONException, IOException
	{
		JSONArray jsonArray = new JSONArray(getHTTPResponse(properties.getProperty(TestCaseConstants.URL_APPEND_GET_ALL_CATEGORY),
				TestCaseConstants.HTTP_GET, null).get(0));
		
		return jsonArray.getJSONObject(jsonArray.length()-1).get("category_ID").toString();
	}
}
