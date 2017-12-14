import java.io.IOException;
import java.util.ArrayList;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;
import org.testng.Assert;
import org.testng.annotations.Test;

/**
 * This class is for TestNG Integration Test cases related to all
 * functionalities of Laboratory in HIS Project. developed by Udara Samaratunge.
 * for LabResource.java
 * {@link BaseLogic.BaseTestCase}
 * @author 
 * 
 */
public class DiabeticChartTestCase extends BaseTestCase {

	
	public static final int SUCCESS_STATUS_CODE = 200;

	public String rowNo="5",bht_no;
	

	/**
	 * This test case is for get all chart
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
	@Test(groups = "his.lab.test", dependsOnMethods = {"addNewDiabeticchartDetailsTestCase"})
	public void getAllChartTestCase() throws IOException, JSONException {

		ArrayList<String> resArrayList = getHTTPResponse(properties.getProperty(TestCaseConstants.URL_APPEND_GET_ALL_CHART),
				TestCaseConstants.HTTP_GET, null);
		
		
		JSONArray jsonArray = new JSONArray(resArrayList.get(0));
		
		JSONObject jsonObject = jsonArray.getJSONObject(jsonArray.length() -1);
		

		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
		Assert.assertEquals(jsonObject.getString("rowNo"), rowNo);
	}
	
	/**
	 * This is Add New Diabetic Chart Test Case.
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
	@Test(groups = "his.lab.test")
	public void addNewDiabeticchartDetailsTestCase() throws IOException, JSONException {

		// Send POST request to add laboratory
		ArrayList<String> resArrayList = getHTTPResponse(
				properties.getProperty(TestCaseConstants.URL_APPEND_ADD_CHART), TestCaseConstants.HTTP_POST,
				RequestUtil.requestByID(TestCaseConstants.ADD_CHART));

		
		JSONObject jsonobj = new JSONObject(resArrayList.get(0));
		rowNo = jsonobj.getString("rowNo");
		
		JSONObject jsonRequest = new JSONObject(RequestUtil.requestByID(TestCaseConstants.ADD_CHART));
		bht_no = jsonRequest.getString("bht_no");
		System.out.println(bht_no);

		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
		Assert.assertEquals(jsonobj.getDouble("bloodSuger"), jsonRequest.getDouble("bloodSuger"));

	}
	
	
	
	/**
	 * This is Get Diabetic Chart By BHTNo Test Case.
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
	@Test(groups = "his.lab.test" ,dependsOnMethods = {"addNewDiabeticchartDetailsTestCase"})
	public void getDiabeticChartByBHTNoTestCase() throws IOException, JSONException {

		ArrayList<String> resArrayList = getHTTPResponse(
				properties.getProperty(TestCaseConstants.URL_APPEND_GET_DIABETIC_CHART)
						+ bht_no, TestCaseConstants.HTTP_GET, null);

	
		JSONArray jsonArray = new JSONArray(resArrayList.get(0));
		
		JSONObject jsonObject = jsonArray.getJSONObject(jsonArray.length() -1);
		


		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
		Assert.assertEquals(jsonObject.getString("rowNo"), rowNo);

	}
	
	
	
	
	
	
}
