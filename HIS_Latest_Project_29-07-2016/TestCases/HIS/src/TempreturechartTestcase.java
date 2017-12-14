import java.io.IOException;
import java.lang.reflect.Array;
import java.util.ArrayList;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;
import org.testng.Assert;
import org.testng.annotations.Test;


public class TempreturechartTestcase extends BaseTestCase {
	public static final int SUCCESS_STATUS_CODE = 200;
	
	String bhtNo;
	
	@Test(groups = "his.lab.test")
	public void addNewTempchartDetails() throws IOException, JSONException{
		
		ArrayList<String> resArray = getHTTPResponse(properties.getProperty(TestCaseConstants.URL_APPEND_ADD_TEMP_DET), TestCaseConstants.HTTP_POST,RequestUtil.requestByID(TestCaseConstants.ADD_TEMP_DET));
		System.out.println(resArray.get(0));
		
		JSONObject jsonresponse = new JSONObject(resArray.get(0));
		
		System.out.println(resArray.get(0));
		
		JSONObject jsonrequest = new JSONObject(RequestUtil.requestByID(TestCaseConstants.ADD_TEMP_DET));
		
		bhtNo = jsonresponse.getJSONObject("bhtNo").getString("bhtNo");
		
		
		Assert.assertEquals(Integer.parseInt(resArray.get(1)), SUCCESS_STATUS_CODE);
		Assert.assertEquals(bhtNo, jsonrequest.getString("bht_no"));
		
	}
	
	@Test(groups = "his.lab.test", dependsOnMethods ={"addNewTempchartDetails"})
	public void TemperaturechartResource() throws IOException, JSONException{
		
		ArrayList<String> resArray = getHTTPResponse(properties.getProperty(TestCaseConstants.CHART_DET), TestCaseConstants.HTTP_GET,null);
		System.out.println(resArray.get(0));
		
		JSONArray jsonarray = new JSONArray(resArray.get(0));
		JSONObject jsonresponse = jsonarray.getJSONObject(jsonarray.length()-1);
		
		System.out.println(jsonresponse);
		
		//bhtNo = jsonresponse.getJSONObject("bhtNo").getString("bhtNo");
		Assert.assertEquals(Integer.parseInt(resArray.get(1)), SUCCESS_STATUS_CODE);
		Assert.assertEquals(jsonresponse.getJSONObject("bhtNo").getString("bhtNo"),bhtNo);
		
	}
	
	@Test(groups = "his.lab.test", dependsOnMethods ={"addNewTempchartDetails"})
	public void getDiabeticChartByBHTNoTestCase() throws IOException, JSONException{
		
		System.out.println(properties.getProperty(TestCaseConstants.GET_DIABITIC));
		System.out.println(bhtNo);
		ArrayList<String> resArray = getHTTPResponse(properties.getProperty(TestCaseConstants.GET_DIABITIC)+bhtNo, TestCaseConstants.HTTP_GET,null);
		System.out.println(resArray.get(0));
		
		JSONArray jsonArr = new JSONArray(resArray.get(0));
		
		JSONObject jsonResponse = jsonArr.getJSONObject(jsonArr.length()-1);
		
		
		System.out.println(jsonResponse.getJSONObject("bhtNo").getString("bhtNo"));
		Assert.assertEquals(Integer.parseInt(resArray.get(1)), SUCCESS_STATUS_CODE);
		Assert.assertEquals(jsonResponse.getJSONObject("bhtNo").getString("bhtNo"),bhtNo);
	}

}
