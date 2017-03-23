import java.io.IOException;
import java.util.ArrayList;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;
import org.testng.Assert;
import org.testng.annotations.Test;


public class DiagnoseResourceTestcase extends BaseTestCase {
	public static final int SUCCESS_STATUS_CODE = 200;
	
	String bhtNo;
	
	@Test(groups = "his.lab.test")
	
	public void addDiagnose() throws IOException, JSONException{
		
		ArrayList<String> resArray = getHTTPResponse(properties.getProperty(TestCaseConstants.URL_APPEND_ADD_DIAGNOSE), TestCaseConstants.HTTP_POST,RequestUtil.requestByID(TestCaseConstants.ADD_DIAGNOSE));
		System.out.println(resArray.get(0));
		
		JSONObject jsonresponse = new JSONObject(resArray.get(0));
		JSONObject jsonrequest = new JSONObject(RequestUtil.requestByID(TestCaseConstants.ADD_DIAGNOSE));
		
		bhtNo = jsonresponse.getJSONObject("bht_no").getString("bhtNo");
		
		Assert.assertEquals(Integer.parseInt(resArray.get(1)),SUCCESS_STATUS_CODE);
		Assert.assertEquals(bhtNo,jsonrequest.getString("bht_no"));
	}
	
	
	@Test(groups = "his.lab.test", dependsOnMethods = {"addDiagnose"})
	
	public void getDiagnoseByBHTNo() throws IOException, JSONException{
		ArrayList<String> resArray = getHTTPResponse(properties.getProperty(TestCaseConstants.URL_APPEND_GET_DIAGNOSE)+bhtNo,TestCaseConstants.HTTP_GET, null);
		System.out.println(resArray.get(0));
		
		JSONArray jsonArr = new JSONArray(resArray.get(0));
		JSONObject jsonResponse = jsonArr.getJSONObject(jsonArr.length()-1);
		
		
		Assert.assertEquals(Integer.parseInt(resArray.get(1)), SUCCESS_STATUS_CODE);
		Assert.assertEquals(jsonResponse.getJSONObject("bht_no").getString("bhtNo"), bhtNo);
	}
}
