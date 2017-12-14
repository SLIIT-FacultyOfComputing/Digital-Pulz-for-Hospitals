import java.io.IOException;
import java.util.ArrayList;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;
import org.testng.Assert;
import org.testng.annotations.Test;


public class InternalTransferResourceTestCase extends BaseTestCase {
	
	public static final int SUCCESS_STATUS_CODE = 200;
	String reasonForTransfer, tranferID;
	
	@Test(groups = "his.lab.test")
	public void CreateInternalTransfer() throws IOException, JSONException{
		
		ArrayList<String> resArray = getHTTPResponse(properties.getProperty(TestCaseConstants.URL_INTERNAL_TRANSFER), TestCaseConstants.HTTP_POST, RequestUtil.requestByID(TestCaseConstants.ADD_INTERNAL_TRANSFER));
		
		JSONObject jsonObject = new JSONObject(resArray.get(0));
		tranferID = jsonObject.getString("transferId");
		JSONObject jsonRequest = new JSONObject(RequestUtil.requestByID(TestCaseConstants.ADD_INTERNAL_TRANSFER));
		System.out.println(jsonObject);
		reasonForTransfer = jsonObject.getString("resonForTrasnsfer");
		
		
		
		Assert.assertEquals(Integer.parseInt(resArray.get(1)), SUCCESS_STATUS_CODE);
		Assert.assertEquals(jsonObject.get("resonForTrasnsfer"), jsonRequest.getString("resonForTrasnsfer") );
	}

	
	@Test(groups = "his.lab.test", dependsOnMethods = {"CreateInternalTransfer"})
	public void getSelectInternalTransfer() throws IOException, JSONException{
		
		ArrayList<String> resArray = getHTTPResponse(properties.getProperty(TestCaseConstants.URL_GET_SELECTED_INTERNAL_TRANSFER)+tranferID, TestCaseConstants.HTTP_GET, null);
		
		JSONArray jsonArray = new JSONArray(resArray.get(0));
		JSONObject jsonObject = jsonArray.getJSONObject(jsonArray.length()-1);
		
		System.out.println(jsonObject);
		
		Assert.assertEquals(Integer.parseInt(resArray.get(1)), SUCCESS_STATUS_CODE);
		Assert.assertEquals(jsonObject.get("resonForTrasnsfer"), reasonForTransfer );
		
	}
	@Test(groups = "his.lab.test", dependsOnMethods = {"CreateInternalTransfer"})
	public void updateInternalTransfer() throws IOException, JSONException{
		
		ArrayList<String> resArray = getHTTPResponse(properties.getProperty(TestCaseConstants.URL_UPDATE_INTERNAL_TRANSFER), TestCaseConstants.HTTP_PUT, RequestUtil.requestByID(TestCaseConstants.UPDATE_INTERNAL_TRANSFER));
		
				
		Assert.assertEquals(Integer.parseInt(resArray.get(1)), SUCCESS_STATUS_CODE);
		Assert.assertTrue(Boolean.parseBoolean(resArray.get(0)));
	}
	
	@Test(groups = "his.lab.test", dependsOnMethods = {"CreateInternalTransfer"})
	public void getNotReadInternalTransferByWard() throws IOException, JSONException{
		
		ArrayList<String> resArray = getHTTPResponse(properties.getProperty(TestCaseConstants.URL_GET_NOT_READ_INTERNAL_TRANSFER)+properties.getProperty(TestCaseConstants.WARD_NO_INTERNAL_TRANSFER), TestCaseConstants.HTTP_GET
				, null);

		JSONArray jsonArray = new JSONArray(resArray.get(0));
		
		JSONObject jsonObject = jsonArray.getJSONObject(jsonArray.length()-1);
		
		System.out.println("by Ward = " + jsonObject);
		System.out.println(jsonObject.get("resonForTrasnsfer"));
		
		Assert.assertEquals(Integer.parseInt(resArray.get(1)), SUCCESS_STATUS_CODE);
		Assert.assertEquals(jsonObject.get("resonForTrasnsfer"), reasonForTransfer );
		
	}
	
	@Test(groups = "his.lab.test", dependsOnMethods = {"CreateInternalTransfer"})
	public void getInternalTransferByID() throws IOException, JSONException{

		ArrayList<String> resArray = getHTTPResponse(properties.getProperty(TestCaseConstants.URL_GET_INTERNAL_TRANSFER_BY_ID)+tranferID, TestCaseConstants.HTTP_GET, null);
		
		JSONArray jsonArray = new JSONArray(resArray.get(0));
		
		System.out.println("arr="+jsonArray.getJSONObject(jsonArray.length()-1));
		
		JSONObject jsonResponse= jsonArray.getJSONObject(jsonArray.length()-1);
		
		
		System.out.println(jsonResponse);
		Assert.assertEquals(Integer.parseInt(resArray.get(1)), SUCCESS_STATUS_CODE);
		
		
		
		Assert.assertEquals(jsonResponse.getString("resonForTrasnsfer"), reasonForTransfer);
		
	}
	
	@Test(groups = "his.lab.test")
	public void getInternalTransferByBHTNo() throws IOException, JSONException{
		
		ArrayList<String> resArray = getHTTPResponse(properties.getProperty(TestCaseConstants.URL_GET_INTERNAL_TRANSFER_BY_BHT_NO)+properties.getProperty(TestCaseConstants.BHT_NO_INTERNAL), TestCaseConstants.HTTP_GET, null);
	
		JSONArray jsonArray = new JSONArray(resArray.get(0));
		
		JSONObject jsonObject = jsonArray.getJSONObject(jsonArray.length()-1);
		
		System.out.println(jsonObject);
		
		
		Assert.assertEquals(Integer.parseInt(resArray.get(1)), SUCCESS_STATUS_CODE);
		Assert.assertEquals(jsonObject.getJSONObject("bhtNo").getString("bhtNo"),properties.getProperty(TestCaseConstants.BHT_NO_INTERNAL));
	}
	
	
}
