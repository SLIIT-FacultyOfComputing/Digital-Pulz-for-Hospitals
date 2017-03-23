import java.io.IOException;
import java.util.ArrayList;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;
import org.testng.Assert;
import org.testng.annotations.Test;


public class TempPrescribeResourceTestCase extends BaseTestCase {
	public static final int SUCCESS_STATUS_CODE = 200;
	
	int drug_id;
	int auto_id;
	
	@Test(groups = "his.lab.test")
	public void addNewPrescrptionItemTestCase() throws IOException, JSONException{
		ArrayList<String> resArray = getHTTPResponse(properties.getProperty(TestCaseConstants.URL_APPEND_TEMP_PRESCRIBE), TestCaseConstants.HTTP_POST, RequestUtil.requestByID(TestCaseConstants.TEMP_PRESCRIBE));
		System.out.println(resArray.get(0));
		
		JSONObject jsonresponse = new JSONObject(resArray.get(0));
		JSONObject jsonrequest = new JSONObject(RequestUtil.requestByID(TestCaseConstants.TEMP_PRESCRIBE));
		System.out.println(jsonresponse);
		drug_id=jsonresponse.getJSONObject("drug_id").getInt("dSrNo");
		
		Assert.assertEquals(Integer.parseInt(resArray.get(1)), SUCCESS_STATUS_CODE);
		Assert.assertEquals(drug_id, jsonrequest.getInt("drug_id"));
		
		
	}
	
	@Test(groups = "his.lab.test", dependsOnMethods={"addNewPrescrptionItemTestCase"})
	public void getPrescrptionItemsByTermID() throws IOException, JSONException{
		
		
		JSONObject jsonrequest = new JSONObject(RequestUtil.requestByID(TestCaseConstants.TEMP_PRESCRIBE));
		
		ArrayList<String> resArray = getHTTPResponse(properties.getProperty(TestCaseConstants.URL_APPEND_GET_ITEM)+jsonrequest.getString("term_id"), TestCaseConstants.HTTP_GET, RequestUtil.requestByID(TestCaseConstants.GET_ITEM));
		System.out.println(resArray.get(0));
		JSONArray jsonarray = new JSONArray(resArray.get(0));
		JSONObject jsonresponse = jsonarray.getJSONObject(jsonarray.length()-1);
		
		auto_id = jsonresponse.getInt("auto_id");
		System.out.println(jsonresponse);

		Assert.assertEquals(Integer.parseInt(resArray.get(1)), SUCCESS_STATUS_CODE);
		Assert.assertEquals(jsonresponse.getJSONObject("drug_id").getInt("dSrNo"),drug_id);
		
		
		
	}
	
	
	
	@Test(groups = "his.lab.test", dependsOnMethods={"addNewPrescrptionItemTestCase", "getPrescrptionItemsByTermID"})
	public void UpdatePrescrptionItem() throws IOException, JSONException{
		
		JSONObject jsonRequestObject = new JSONObject(RequestUtil.requestByID(TestCaseConstants.UPDATE_ITEM));
		
		jsonRequestObject.put("auto_id", auto_id);
		
		ArrayList<String> resArray = getHTTPResponse(properties.getProperty(TestCaseConstants.URL_APPEND_UPDATE_ITEM), TestCaseConstants.HTTP_POST, jsonRequestObject.toString());
		System.out.println(resArray.get(0));
		
		Assert.assertEquals(Integer.parseInt(resArray.get(1)), SUCCESS_STATUS_CODE);
		Assert.assertTrue(Boolean.parseBoolean(resArray.get(0)));
		
		
	}
	@Test(groups = "his.lab.test", dependsOnMethods={"addNewPrescrptionItemTestCase", "getPrescrptionItemsByTermID", "UpdatePrescrptionItem"})
	public void deleteWard() throws IOException, JSONException{
		
		JSONObject jsonRequestObject = new JSONObject();
		
		jsonRequestObject.put("auto_id", auto_id);
		
		ArrayList<String> resArray = getHTTPResponse(properties.getProperty(TestCaseConstants.URL_APPEND_DELETE_WARD), TestCaseConstants.HTTP_DELETE, jsonRequestObject.toString());
		System.out.println(resArray.get(0));
		Assert.assertEquals(Integer.parseInt(resArray.get(1)),SUCCESS_STATUS_CODE);
		
		
		
		
		
	}

}
