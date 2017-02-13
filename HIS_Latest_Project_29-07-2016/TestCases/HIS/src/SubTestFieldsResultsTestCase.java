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

public class SubTestFieldsResultsTestCase extends BaseTestCase {

	public static final int SUCCESS_STATUS_CODE = 200;

	public String fMResultID, labName, fSubF_ID, fParentF_ID;

	/**
	 * This is Add Lab Sub Test Fields Results Test Case.
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
	@Test(groups = "his.lab.test")
	public void addSubFieldsResultsTestCase() throws IOException, JSONException {

		// Send POST request to add laboratory
		ArrayList<String> resArrayList = getHTTPResponse(
				properties
						.getProperty(TestCaseConstants.URL_APPEND_ADD_NEW_LAB_SUB_RESULTS),
				TestCaseConstants.HTTP_POST,
				RequestUtil
						.requestByID(TestCaseConstants.ADD_NEW_LAB_SUB_RESULTS));

		JSONObject jsonbject = new JSONObject(
				RequestUtil
						.requestByID(TestCaseConstants.ADD_NEW_LAB_SUB_RESULTS)).getJSONArray("subfieldsresults").getJSONObject(0);
		
		
		System.out.println("subTest ="+jsonbject);

		System.out.println("response ="+resArrayList.get(0)
				);
		
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)),
				SUCCESS_STATUS_CODE);
		Assert.assertEquals((new JSONArray(resArrayList.get(0)).getJSONObject(0).getJSONObject("fMResultID").getString("result_ID")),
				jsonbject.getString("fMResultID"));

	}

	/**
	 * This test case is for get all Lab Sub Test Fields Results
	 * 
	 * @throws IOException
	 */
	@Test(groups = "his.lab.test", dependsOnMethods = { "addSubFieldsResultsTestCase" })
	public void getAllLabSubResultsTestCase() throws IOException {

		ArrayList<String> resArrayList = getHTTPResponse(
				properties.getProperty(TestCaseConstants.LAB_SUB_RESULT_URL),
				TestCaseConstants.HTTP_GET, null);

		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)),
				SUCCESS_STATUS_CODE);
	}

}
