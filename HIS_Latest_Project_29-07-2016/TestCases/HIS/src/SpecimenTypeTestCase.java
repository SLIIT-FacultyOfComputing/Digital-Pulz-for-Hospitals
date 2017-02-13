import java.io.IOException;
import java.util.ArrayList;

import org.json.JSONArray;
import org.json.JSONException;
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
public class SpecimenTypeTestCase extends BaseTestCase{
	
	public static final int SUCCESS_STATUS_CODE = 200;
	
	public String catName;
	public String subName;
	public JSONArray jsonArray;
	
	/**
	 * This test case is for get all specimen
	 * 
	 * @throws IOException
	 * @throws JSONException 
	 */
	@Test(groups = "his.lab.test.specimen")
	public void getAllSpecimenTypeTestCase() throws IOException, JSONException{

		ArrayList<String> resArrayList = getHTTPResponse(properties.getProperty(TestCaseConstants.URL_APPEND_GET_ALL_SPECIMENS),
				TestCaseConstants.HTTP_GET, null);
		
		jsonArray = new JSONArray(resArrayList.get(0));
		
		
		catName = (jsonArray.getJSONObject(jsonArray.length() - 1)).getJSONObject("fCategry_ID").getString("category_Name");
		subName = (jsonArray.getJSONObject(jsonArray.length() - 1)).getJSONObject("fSub_CategoryID").getString("sub_CategoryName");
		
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
		Assert.assertEquals(catName, properties.getProperty(TestCaseConstants.CATEGORY_NAME));
		Assert.assertEquals(subName, properties.getProperty(TestCaseConstants.SUBCATEGORY_NAME));
	}
	
	/**
	 * This test case is for get specimen by Id
	 * 
	 * @throws IOException
	 * @throws JSONException 
	 * 
	 */
	@Test(groups = "his.lab.test.specimen", dependsOnMethods = { "getAllSpecimenTypeTestCase"})
	public void getAllSpecimenTypeByIdTestCase() throws IOException, JSONException {

		ArrayList<String> resArrayList = getHTTPResponse(properties.getProperty(TestCaseConstants.URL_APPEND_GET_ALL_SPECIMENS_BY_ID
				)+CategoryTestCase.categoryId+"/"+ SubCategoryTestCase.subcategoryId,TestCaseConstants.HTTP_GET, null);

		
		System.out.println(resArrayList.get(0));
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);

		
	}
	

	
	
}
