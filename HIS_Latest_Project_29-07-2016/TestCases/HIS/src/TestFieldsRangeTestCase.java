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
public class TestFieldsRangeTestCase extends BaseTestCase {

	public static final int SUCCESS_STATUS_CODE = 200;

	public String rangeID, gender, minage, unit, minVal, maxVal, maxage, subid;

	/**
	 * Test Case for Add Lab Field Range Test
	 * 
	 * @throws IOException
	 * @throws JSONException
	 */
	@Test(groups = "his.lab.test")
	public void addLabFieldRangeTestCase() throws IOException, JSONException {

		ArrayList<String> resArrayList = getHTTPResponse(
				properties
						.getProperty(TestCaseConstants.URL_APPEND_ADD_NEW_LAB_RANGE),
				TestCaseConstants.HTTP_POST, RequestUtil
						.requestByID(TestCaseConstants.ADD_LAB_RANGE));

		System.out.println("test =" + resArrayList.get(0));
		JSONObject jsonObject = new JSONObject(resArrayList.get(0));
		rangeID = jsonObject.getString("range_ID");
		gender = jsonObject.getString("gender");
		minage = jsonObject.getString("minage");
		unit = jsonObject.getString("unit");
		minVal = jsonObject.getString("minVal");
		maxVal = jsonObject.getString("maxVal");
		maxage = jsonObject.getString("maxage");

		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)),
				SUCCESS_STATUS_CODE);
		Assert.assertEquals(gender,
				properties.getProperty(TestCaseConstants.ADD_LAB_RANGE_GENDER));
		Assert.assertEquals(minage,
				properties.getProperty(TestCaseConstants.ADD_LAB_RANGE_MINAGE));
		Assert.assertEquals(unit,
				properties.getProperty(TestCaseConstants.ADD_LAB_RANGE_UNIT));
		Assert.assertEquals(minVal,
				properties.getProperty(TestCaseConstants.ADD_LAB_RANGE_MINVAL));
		Assert.assertEquals(maxVal,
				properties.getProperty(TestCaseConstants.ADD_LAB_RANGE_MAXVAL));
		Assert.assertEquals(maxage,
				properties.getProperty(TestCaseConstants.ADD_LAB_RANGE_MAXAGE));

	}

	/**
	 * Test Case for Add Lab Sub Field Range Test
	 * 
	 * @throws IOException
	 * @throws JSONException
	 */
	@Test(groups = "his.lab.test")
	public void addLabFieldSubRangeTestCase() throws IOException, JSONException {

		ArrayList<String> resArrayList = getHTTPResponse(
				properties
						.getProperty(TestCaseConstants.URL_APPEND_ADD_NEW_LAB_SUB_RANGE),
				TestCaseConstants.HTTP_POST, RequestUtil
						.requestByID(TestCaseConstants.ADD_LAB_SUB_RANGE));

		System.out.println("test =" + resArrayList.get(0));

		JSONArray jsonArray = new JSONArray(getHTTPResponse(
				properties.getProperty(TestCaseConstants.URL_APPEND_LAB_RANGE),
				TestCaseConstants.HTTP_GET, null).get(0));

		JSONObject jsonObject = jsonArray.getJSONObject(jsonArray.length() - 1);

		System.out.println(jsonObject);
		rangeID = jsonObject.getString("range_ID");
		gender = jsonObject.getString("gender");
		minage = jsonObject.getString("minage");
		unit = jsonObject.getString("unit");
		minVal = jsonObject.getString("minVal");
		maxVal = jsonObject.getString("maxVal");
		maxage = jsonObject.getString("maxage");

		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)),
				SUCCESS_STATUS_CODE);
		Assert.assertEquals(gender, properties
				.getProperty(TestCaseConstants.ADD_LAB_SUB_RANGE_GENDER));
		Assert.assertEquals(minage, properties
				.getProperty(TestCaseConstants.ADD_LAB_SUB_RANGE_MINAGE));
		Assert.assertEquals(unit, properties
				.getProperty(TestCaseConstants.ADD_LAB_SUB_RANGE_UNIT));
		Assert.assertEquals(minVal, properties
				.getProperty(TestCaseConstants.ADD_LAB_SUB_RANGE_MINVAL));
		Assert.assertEquals(maxVal, properties
				.getProperty(TestCaseConstants.ADD_LAB_SUB_RANGE_MAXVAL));
		Assert.assertEquals(maxage, properties
				.getProperty(TestCaseConstants.ADD_LAB_SUB_RANGE_MAXAGE));

	}

	/**
	 * Test Case for Get All Field Range Test
	 * 
	 * @throws IOException
	 */
	@Test(groups = "his.lab.test", dependsOnMethods = { "addLabFieldRangeTestCase" })
	public void getAllLabRangeTestCase() throws IOException {

		ArrayList<String> resArrayList = getHTTPResponse(
				properties.getProperty(TestCaseConstants.URL_APPEND_LAB_RANGE),
				TestCaseConstants.HTTP_GET, null);

		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)),
				SUCCESS_STATUS_CODE);
	}

}
