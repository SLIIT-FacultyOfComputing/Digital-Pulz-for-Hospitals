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
public class SpecimenRetentionTypeTestCase extends BaseTestCase{
	
	public static final int SUCCESS_STATUS_CODE = 200;
	
	public String catName;
	public String subName;
	public JSONArray jsonArray;
	
	/**
	 * This test case is for get all specimen retentions
	 * 
	 * @throws IOException
	 * @throws JSONException 
	 */
	@Test(groups = "his.lab.test.specimenretention", dependsOnMethods = {"getAllSpecimenRetentionTypeByIdTestCase"})
	public void getAllSpecimenRetentionTypeTestCase() throws IOException, JSONException{

		ArrayList<String> resArrayList = getHTTPResponse(properties.getProperty(TestCaseConstants.URL_APPEND_GET_ALL_SPECIMEN_RETENTION),
				TestCaseConstants.HTTP_GET, null);
		
		jsonArray = new JSONArray(resArrayList.get(0));
		
		
		catName = (jsonArray.getJSONObject(jsonArray.length() - 1)).getJSONObject("fCategory_ID").getString("category_Name");
		subName = (jsonArray.getJSONObject(jsonArray.length() - 1)).getJSONObject("fSub_CategryID").getString("sub_CategoryName");
		
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
		Assert.assertEquals(catName, properties.getProperty(TestCaseConstants.CATEGORY_NAME));
		Assert.assertEquals(subName, properties.getProperty(TestCaseConstants.UPDATE_SUBCATEGORY_NAME));
	}
	
	/**
	 * This test case is for get specimen retention by Id
	 * 
	 * @throws IOException
	 * @throws JSONException 
	 * 
	 */
	@Test(groups = "his.lab.test.specimenretention")
	public void getAllSpecimenRetentionTypeByIdTestCase() throws IOException, JSONException {

		CategoryTestCase catTest = new CategoryTestCase();
		SubCategoryTestCase subTest = new SubCategoryTestCase();
		
		ArrayList<String> resArrayList = getHTTPResponse(properties.getProperty(TestCaseConstants.URL_APPEND_GET_ALL_SPECIMEN_RETENTION_BY_ID
				)+String.valueOf(catTest.getCatId())+"/"+ String.valueOf(subTest.getSubId()),TestCaseConstants.HTTP_GET, null);

		
		System.out.println(resArrayList.get(0));
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);

		
	}
}
