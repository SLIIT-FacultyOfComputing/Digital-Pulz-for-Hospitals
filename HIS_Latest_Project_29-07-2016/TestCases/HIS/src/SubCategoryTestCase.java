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
public class SubCategoryTestCase extends BaseTestCase{
	
	public static final int SUCCESS_STATUS_CODE = 200;
	
	public static String subcategoryId;
	public JSONArray jsonArray;
	
	/**
	 * This test case is for get all subCategories
	 * 
	 * @throws IOException
	 * @throws JSONException 
	 */
	@Test(groups = "his.lab.test.subcategory")
	public void getAllSubCategoriesTestCase() throws IOException, JSONException{

		ArrayList<String> resArrayList = getHTTPResponse(properties.getProperty(TestCaseConstants.URL_APPEND_GET_ALL_SUBCATEGORY),
				TestCaseConstants.HTTP_GET, null);
		
		jsonArray = new JSONArray(resArrayList.get(0));
		subcategoryId = (jsonArray.getJSONObject(jsonArray.length() - 1)).getString("sub_CategoryID");

		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
		
	}
	
	/**
	 * This test case is for get subCategories by Id
	 * 
	 * @throws IOException
	 * @throws JSONException 
	 * 
	 */
	@Test(groups = "his.lab.test.subcategory", dependsOnMethods = { "getAllSubCategoriesTestCase"})
	public void getAllSubCategoriesByIdTestCase() throws IOException, JSONException {

		
		ArrayList<String> resArrayList = getHTTPResponse(properties.getProperty(TestCaseConstants.URL_APPEND_GET_ALL_SUBCATEGORY_BY_ID
				)+subcategoryId,TestCaseConstants.HTTP_GET, null);

		
		JSONArray jsonArray2 = new JSONArray(resArrayList.get(0));
		String subCatId = jsonArray2.getJSONObject((jsonArray2.length() - 1)).getString("sub_CategoryID");
		
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
		Assert.assertEquals(subCatId, subcategoryId);
		
	}
	
	/**
	 * This test case is to update subCategories Details
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */

	@Test(groups = "his.lab.test.subcategory", dependsOnMethods = { "getAllSubCategoriesTestCase"})
	public void updateSubCategoriesDetailsTestCase() throws IOException, JSONException {

		//Get all sub categories
		jsonArray = new JSONArray(getHTTPResponse(properties.getProperty(TestCaseConstants.URL_APPEND_GET_ALL_SUBCATEGORY),
				TestCaseConstants.HTTP_GET, null).get(0));
		subcategoryId = (jsonArray.getJSONObject(jsonArray.length() - 1)).getString("sub_CategoryID");
		
		System.out.println("SubCat id = " +subcategoryId);
		
		// Get JSON Request body to send subcategory update Request
		JSONObject jsonResponseObject = jsonArray.getJSONObject(jsonArray.length() - 1);

		jsonResponseObject.put("sub_CategoryName", properties.get(TestCaseConstants.UPDATE_SUBCATEGORY_NAME));
		


		
		// Send JSON Update subcategory Request
		ArrayList<String> resArrayList = getHTTPResponse(
				properties.getProperty(TestCaseConstants.URL_APPEND_UPDATE_SUBCATEGORY), TestCaseConstants.HTTP_POST,
				jsonResponseObject.toString());

		//Get last entry from the subcategory list
		JSONArray jsonArray = new JSONArray(getHTTPResponse(properties.getProperty(TestCaseConstants.URL_APPEND_GET_ALL_SUBCATEGORY),
				TestCaseConstants.HTTP_GET, null).get(0));
		
		JSONObject jsonObject = jsonArray.getJSONObject(jsonArray.length() - 1);
		
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
		Assert.assertEquals(jsonObject.getString("sub_CategoryName"), properties.get(TestCaseConstants.UPDATE_SUBCATEGORY_NAME));
		Assert.assertEquals(jsonObject.getString("sub_CategoryID"), subcategoryId);
	}
	
	/**
	 * This test case is for delete SubCategory
	 * 
	 * @throws IOException
	 * 
	 */
	@Test(groups = "his.lab.test.subcategory", dependsOnMethods = {"getAllSubCategoriesByIdTestCase","updateSubCategoriesDetailsTestCase"}, dependsOnGroups = {"his.lab.test.specimen", "his.lab.test.specimenretention"})
	public void deleteSubCategoryTestCase() throws IOException {
	
		// Get response for delete lab test case
		ArrayList<String> resArrayList = getHTTPResponse(properties.getProperty(TestCaseConstants.URL_APPEND_DELETE_SUBCATEGORY)
				+ subcategoryId, TestCaseConstants.HTTP_GET, null);
	
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
		Assert.assertEquals(resArrayList.get(0), subcategoryId);
	}
	
	/**
	 * Method to get the last Id of subCategory
	 * 
	 * @throws IOException
	 * @throws JSONException
	 */
	public String getSubId() throws JSONException, IOException
	{
		JSONArray jsonArray = new JSONArray(getHTTPResponse(properties.getProperty(TestCaseConstants.URL_APPEND_GET_ALL_SUBCATEGORY),
				TestCaseConstants.HTTP_GET, null).get(0));
		
		return (String) jsonArray.getJSONObject(jsonArray.length()-1).get("sub_CategoryID").toString();
	}
	
}
