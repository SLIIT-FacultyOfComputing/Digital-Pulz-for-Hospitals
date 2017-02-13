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
public class ReportTestCase extends BaseTestCase{
	
	public static final int SUCCESS_STATUS_CODE = 200;
	public String reportId;
	
	/**
	 * This test case is for generate New Report
	 * 
	 * @throws IOException
	 */
	@Test(groups="his.lab.test")
	public void generateNewReportTestCase() throws IOException,JSONException{
	
		System.out.println(RequestUtil.requestByID(TestCaseConstants.URL_APPEND_GENERATE_NEW_REPORT));
		ArrayList<String> resArrayList=getHTTPResponse(properties.getProperty(TestCaseConstants.URL_APPEND_GENERATE_NEW_REPORT), 
				TestCaseConstants.HTTP_POST, RequestUtil.requestByID(TestCaseConstants.URL_APPEND_GENERATE_NEW_REPORT));
		
		
		
		reportId = (new JSONObject(resArrayList.get(0)).getString("report_ID"));
		
		System.out.println(reportId);
		
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
		
				
	}
	
	/**
	 * This test case is for get all reports
	 * 
	 * @throws IOException
	 */
	@Test(groups="his.lab.test", dependsOnMethods = {"generateNewReportTestCase"})
	public void getAllReportTestCase() throws IOException,JSONException{
	
		ArrayList<String> resArrayList=getHTTPResponse(properties.getProperty(TestCaseConstants.URL_APPEND_GET_ALL_REPORTS), 
				TestCaseConstants.HTTP_GET, null);
		
		
		JSONArray jsonArray = new JSONArray(resArrayList.get(0));
		JSONObject jsonObject = jsonArray.getJSONObject(jsonArray.length() - 1);
		
		System.out.println(jsonObject);
		
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
		Assert.assertEquals(jsonObject.getString("report_ID"),reportId);
				
	}
}
