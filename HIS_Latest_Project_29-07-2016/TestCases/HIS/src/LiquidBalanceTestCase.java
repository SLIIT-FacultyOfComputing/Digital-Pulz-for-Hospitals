import java.io.IOException;
import java.util.ArrayList;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;
import org.testng.Assert;
import org.testng.annotations.Test;


public class LiquidBalanceTestCase extends BaseTestCase {

	
	public static final int SUCCESS_STATUS_CODE = 200;
	
	private int bhtNo;
	
	@Test(groups = "his.lab.test")
	public void addNewchartDetails() throws IOException, JSONException {
		
		ArrayList<String> resArray = getHTTPResponse(properties.getProperty(TestCaseConstants.URL_APPEND_NEW_CHART), TestCaseConstants.HTTP_POST, RequestUtil.requestByID(TestCaseConstants.ADD_NEW_CHART));
		
		System.out.println(resArray.get(0));
		
		JSONObject jsonResponse = new JSONObject(resArray.get(0));
		JSONObject jsonRequest = new JSONObject(RequestUtil.requestByID(TestCaseConstants.ADD_NEW_CHART));
		
		int bhtNoRes = jsonResponse.getJSONObject("bhtNo").getInt("bhtNo");
		
		bhtNo = jsonRequest.getInt("bht_no");
		Assert.assertEquals(Integer.parseInt(resArray.get(1)), SUCCESS_STATUS_CODE);
		Assert.assertEquals(bhtNoRes, bhtNo);
		
	}
	
	@Test(groups = "his.lab.test", dependsOnMethods = {"addNewchartDetails"})
	public void getChartDetails() throws IOException, JSONException{
		
		ArrayList<String> resArray = getHTTPResponse(properties.getProperty(TestCaseConstants.GET_CHART), TestCaseConstants.HTTP_GET, null);
		
		System.out.println(resArray.get(0));
		JSONArray jsonArray = new JSONArray(resArray.get(0));
		JSONObject jsonResponse = jsonArray.getJSONObject(jsonArray.length() - 1);
		
		System.out.println(jsonResponse);
		
		String btnNo = jsonResponse.getJSONObject("bhtNo").getString("bhtNo");
	
		Assert.assertEquals(Integer.parseInt(resArray.get(1)), SUCCESS_STATUS_CODE);
		Assert.assertEquals(btnNo, properties.getProperty(TestCaseConstants.CHART_BHT));
		
	}
	
	@Test(groups = "his.lab.test", dependsOnMethods = {"addNewchartDetails"})
	public void getDiabeticChartByBHTNo() throws IOException, JSONException{
		
		ArrayList<String> resArray = getHTTPResponse(properties.getProperty(TestCaseConstants.GET_DIABETIC_CHART)+properties.getProperty(TestCaseConstants.CHART_BHT) , TestCaseConstants.HTTP_GET, null);
		
		JSONArray jsonArray = new JSONArray(resArray.get(0));
		JSONObject jsonResponse = jsonArray.getJSONObject(jsonArray.length() - 1);
		System.out.println(jsonResponse);
		Assert.assertEquals(Integer.parseInt(resArray.get(1)), SUCCESS_STATUS_CODE);
		
	}
	
}
