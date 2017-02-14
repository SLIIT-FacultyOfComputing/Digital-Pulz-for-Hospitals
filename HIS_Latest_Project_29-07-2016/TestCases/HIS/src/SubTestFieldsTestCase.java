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
public class SubTestFieldsTestCase extends BaseTestCase{
	public static final int SUCCESS_STATUS_CODE = 200;
	
	public static String ParentID;
	
	/**
	 * This test case is for get all SubTestFields
	 * 
	 * @throws IOException
	 * @throws JSONException 
	 */
	@Test(groups = "his.lab.test", dependsOnMethods = { "addNewSubTestFieldTestCase" })
	public void getAllSubTestFieldsTestCase() throws IOException, JSONException{

		ArrayList<String> resArrayList = getHTTPResponse(properties.getProperty(TestCaseConstants.URL_APPEND_GET_ALL_SUBTESTFIELDS),
				TestCaseConstants.HTTP_GET, null);

		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
		
	}
	
	/**
	 * This test case is for add New sub testField
	 * 
	 * @throws IOException
	 */
	@Test(groups = "his.lab.test")
	public void addNewSubTestFieldTestCase() throws IOException, JSONException {
	
		
		ArrayList<String> resArrayList = getHTTPResponse(
				properties.getProperty(TestCaseConstants.URL_APPEND_ADD_SUBTESTFIELD), TestCaseConstants.HTTP_POST,
				RequestUtil.requestByID(TestCaseConstants.URL_APPEND_ADD_SUBTESTFIELD));

		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
		//Assert.assertEquals(resArrayList.get(0).toLowerCase(), "true");
	}
	
	/**
	 * This test case is for get Max SubTestFields
	 * 
	 * @throws IOException
	 * @throws JSONException 
	 */
	@Test(groups = "his.lab.test", dependsOnMethods = { "addNewSubTestFieldTestCase", "getAllSubTestFieldsTestCase" } )
	public void GetMaxSubTestFieldTestCase() throws IOException, JSONException{

		ArrayList<String> resArrayList = getHTTPResponse(properties.getProperty(TestCaseConstants.URL_APPEND_GET_MAX_SUBTESTFIELD_ID),
				TestCaseConstants.HTTP_GET, null);
		
		System.out.println("Max ID = " +resArrayList.get(0));
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
		
	}
	
	/**
	 * This test case is for get Test Sub fields by parentId
	 * 
	 * @throws IOException
	 * @throws JSONException 
	 * 
	 */
	@Test(groups = "his.lab.test", dependsOnMethods = { "addNewSubTestFieldTestCase", "getAllSubTestFieldsTestCase"})
	public void GetTestSubFieldsTestCase() throws IOException, JSONException {

		JSONObject jsonObject = new JSONObject(RequestUtil.requestByID(TestCaseConstants.URL_APPEND_ADD_SUBTESTFIELD));
		
		ArrayList<String> resArrayList = getHTTPResponse(properties.getProperty(TestCaseConstants.URL_APPEND_GET_TEST_SUB_FIELDS
				)+ jsonObject.getString("parentField"),TestCaseConstants.HTTP_GET, null);

		
		System.out.println(resArrayList.get(0));
		JSONArray jsonArray2 = new JSONArray(resArrayList.get(0));
		JSONObject parentField = new JSONObject(jsonArray2.getJSONObject((jsonArray2.length() - 1)).getString("fPar_Test_FieldID"));
		
		System.out.println(parentField);
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
		Assert.assertEquals(parentField.getString("parent_FieldID"), jsonObject.getString("parentField"));
		
	}
}
