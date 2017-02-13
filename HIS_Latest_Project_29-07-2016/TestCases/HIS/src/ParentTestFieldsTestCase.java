import java.io.IOException;
import java.util.ArrayList;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;
import org.testng.Assert;
import org.testng.annotations.Test;

/**
 * This class is for TestNG Integration Test cases related to all
 * functionalities of LaboratoryTests in HIS Project. developed by yasini.p
 * 
 * {@link BaseTestCase}
 * 
 * @author yasini.p
 *
 */
public class ParentTestFieldsTestCase extends BaseTestCase {

	public static final int SUCCESS_STATUS_CODE = 200;

	public String parent_FieldID, parentField_IDName, parent_FieldName,
			test_ID;

	/**
	 * Test Case for Add Lab Parent Test Fields Test
	 * 
	 * @throws IOException
	 * @throws JSONException 
	 */
	@Test(groups = "his.lab.test")
	public void addLabParentTestCase() throws IOException, JSONException {

		ArrayList<String> resArrayList = getHTTPResponse(
				properties
						.getProperty(TestCaseConstants.URL_APPEND_ADD_LAB_PARENT),
				TestCaseConstants.HTTP_POST, RequestUtil
						.requestByID(TestCaseConstants.ADD_LAB_PARENT));

		JSONObject jsonObject = new JSONObject(RequestUtil
				.requestByID(TestCaseConstants.ADD_LAB_PARENT));
		
		System.out.println("request = "+ jsonObject);
		System.out.println("respose = "+ resArrayList.get(0));
		
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)),
				SUCCESS_STATUS_CODE);
		Assert.assertEquals((new JSONObject(resArrayList.get(0))).getString("parent_FieldName"),
				jsonObject.getString("test_field_name"));

	}

	/**
	 * Test Case for Get All Lab Parent Test Fields Test
	 * 
	 * @throws IOException
	 */
	@Test(groups = "his.lab.test", dependsOnMethods = { "addLabParentTestCase" })
	public void getAllLabParentTestCase() throws IOException {

		ArrayList<String> resArrayList = getHTTPResponse(
				properties.getProperty(TestCaseConstants.URL_APPEND_LAB_PARENT),
				TestCaseConstants.HTTP_GET, null);

		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)),
				SUCCESS_STATUS_CODE);
	}

	/**
	 * Test Case for Get All Lab Parent Test Fields By ID Test
	 * 
	 * @throws IOException
	 * @throws JSONException
	 */

	@Test(groups = "his.lab.test", dependsOnMethods = { "addLabParentTestCase",
			"getAllLabParentTestCase" })
	public void getAllLabParentByIDTestCase() throws IOException, JSONException {

		JSONArray jsonArray = new JSONArray(
				getHTTPResponse(
						properties
								.getProperty(TestCaseConstants.URL_APPEND_LAB_PARENT),
						TestCaseConstants.HTTP_GET, null).get(0));

		JSONObject jsonObject = jsonArray.getJSONObject(jsonArray.length() - 1);
		System.out.println("test_ID = "
				+ (new JSONObject(jsonObject.get("fTest_NameID").toString())
						.getInt("test_ID")));
		test_ID = (new JSONObject(jsonObject.get("fTest_NameID").toString())
				.getInt("test_ID")) + "";

		ArrayList<String> resArrayList = getHTTPResponse(
				properties.getProperty(TestCaseConstants.URL_APPEND_LAB_PARENT_BY_ID)
						+ test_ID, TestCaseConstants.HTTP_GET, null);

		JSONArray jsonArray2 = new JSONArray(resArrayList.get(0));
		System.out.println(jsonArray2.getJSONObject(0));
		JSONObject jsonObject2 = jsonArray2.getJSONObject(0);

		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)),
				SUCCESS_STATUS_CODE);
		Assert.assertEquals((new JSONObject(jsonObject2.get("fTest_NameID")
				.toString()).getInt("test_ID")) + "", test_ID);
	}

	/**
	 * Test Case for Get Max Parent ID Test Fields Test
	 * 
	 * @throws IOException
	 * @throws JSONException
	 */

	@Test(groups = "his.lab.test", dependsOnMethods = { "addLabParentTestCase",
			"getAllLabParentTestCase" })
	public void getMaxParentIDTestCase() throws IOException, JSONException {

		ArrayList<String> resArrayList = getHTTPResponse(
				properties
						.getProperty(TestCaseConstants.URL_APPEND_LAB_PARENT_MAX),
				TestCaseConstants.HTTP_GET, null);


		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)),
				SUCCESS_STATUS_CODE);

	}

}
