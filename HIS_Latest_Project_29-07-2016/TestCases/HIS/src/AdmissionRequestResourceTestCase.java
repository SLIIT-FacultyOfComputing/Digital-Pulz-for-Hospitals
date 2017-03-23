import java.io.IOException;
import java.util.ArrayList;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;
import org.testng.Assert;
import org.testng.annotations.Test;

import com.google.gson.JsonObject;


public class AdmissionRequestResourceTestCase extends BaseTestCase {
	
	public static final int SUCCESS_STATUS_CODE = 200;

	String autoID;
	/**
	 * This test case is for add an admission request  
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */

	@Test(groups = "his.lab.test")
	public void addAdmissionRequest() throws IOException, JSONException{
		
		ArrayList<String> resArray = getHTTPResponse(properties.getProperty(TestCaseConstants.URL_ADD_ADMISSION_REQ), TestCaseConstants.HTTP_POST, RequestUtil.requestByID(TestCaseConstants.ADD_ADMISSION_REQ));		
		
		JSONObject jsonObject = new JSONObject(resArray.get(0));
		JSONObject jsonRequest = new JSONObject(RequestUtil.requestByID(TestCaseConstants.ADD_ADMISSION_REQ));
		
		autoID = jsonObject.getString("auto_id");
		
		Assert.assertEquals(Integer.parseInt(resArray.get(1)), SUCCESS_STATUS_CODE);
		Assert.assertEquals(jsonObject.get("remark"), jsonRequest.get("remark"));
		
	}
	
	/**
	 * This test case is for Update Admission Requests 
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
	
	@Test(groups = "his.lab.test", dependsOnMethods ={"addAdmissionRequest"})
	public void updateAdmissionRequest() throws JSONException, IOException{
		JSONObject jsonRequest = new JSONObject(RequestUtil.requestByID(TestCaseConstants.UPDATE_ADMISSION_REQ));
		
		jsonRequest.put("auto_id", autoID);
		
		ArrayList<String> resArray = getHTTPResponse(properties.getProperty(TestCaseConstants.URL_UPDATE_ADMISSION_REQ), TestCaseConstants.HTTP_PUT, jsonRequest.toString());		
		
		//JSONArray jsonArray = new JSONArray(resArray.get(0));
		//JSONObject jsonObject2 = jsonArray.getJSONObject(jsonArray.length()-1);
		JSONObject jsonRequest2 = new JSONObject(RequestUtil.requestByID(TestCaseConstants.UPDATE_ADMISSION_REQ));
		
		System.out.println(jsonRequest2);
		
		Assert.assertEquals(Integer.parseInt(resArray.get(1)), SUCCESS_STATUS_CODE);
		Assert.assertTrue(Boolean.parseBoolean(resArray.get(0)));
		
	}
	
	/**
	 * This test case is for get Admission Reqrest for a given auto ID
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
	
	@Test(groups = "his.lab.test", dependsOnMethods ={"addAdmissionRequest"})
	public void getSelectAdmissionReq() throws IOException, JSONException{

		
		ArrayList<String> resArray = getHTTPResponse(properties.getProperty(TestCaseConstants.GET_SELECT_ADMISSION_REQ)+autoID,TestCaseConstants.HTTP_GET , null);
		
		JSONArray jsonArray = new JSONArray(resArray.get(0));
	
		JSONObject jsonObject2 = jsonArray.getJSONObject(jsonArray.length()-1);
		System.out.println(jsonObject2);
		Assert.assertEquals(Integer.parseInt(resArray.get(1)), SUCCESS_STATUS_CODE);
		Assert.assertEquals(jsonObject2.getString("auto_id"), autoID);
	}
	
	/**
	 * This test case is for get Not Read Admission Request  for a given Ward ID
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
	
	@Test(groups = "his.lab.test", dependsOnMethods ={"addAdmissionRequest"})
	public void getNotReadAdmissionRequestByWard() throws IOException, JSONException{
		
		ArrayList<String> resArray = getHTTPResponse(properties.getProperty(TestCaseConstants.GET_NOT_READ_ADMIS_REQ_BY_WARD)+properties.getProperty(TestCaseConstants.TRANSFER_WARD), TestCaseConstants.HTTP_GET, null);
		
		//System.out.println(jsonObject);
		
		Assert.assertEquals(Integer.parseInt(resArray.get(1)), SUCCESS_STATUS_CODE);
		
		JSONArray jsonArray = new JSONArray(resArray.get(0));
		
		JSONObject jsonObject2 = jsonArray.getJSONObject(jsonArray.length()-1);
		System.out.println(jsonObject2);
		Assert.assertEquals(Integer.parseInt(resArray.get(1)), SUCCESS_STATUS_CODE);
		Assert.assertEquals(jsonObject2.getString("auto_id"), autoID);
		
	}
	
}
