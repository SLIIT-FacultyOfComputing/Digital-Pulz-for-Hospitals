import java.io.IOException;
import java.util.ArrayList;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;
import org.testng.Assert;
import org.testng.annotations.Test;


public class ExternalTransferResourseTestCase extends BaseTestCase {
	
	public static final int SUCCESS_STATUS_CODE = 200;
	String transferFrom ;

	/**
	 * This test case is to Create ExternalTransfer   
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */

	@Test(groups = "his.lab.test")
	public void CreateExternalTransfer() throws IOException, JSONException{
		
		ArrayList<String> resArray = getHTTPResponse(properties.getProperty(TestCaseConstants.URL_ADD_EXTERNAL_TRANSFER), TestCaseConstants.HTTP_POST, RequestUtil.requestByID(TestCaseConstants.ADD_EXTERNAL_TRANSFER));
		
		
		JSONObject jsonObject = new JSONObject(resArray.get(0));
		
		JSONObject jsonRequest = new JSONObject(RequestUtil.requestByID(TestCaseConstants.ADD_EXTERNAL_TRANSFER));
		
		transferFrom = jsonObject.getString("transferFrom");
		
		System.out.println(jsonObject);
		
		Assert.assertEquals(Integer.parseInt(resArray.get(1)), SUCCESS_STATUS_CODE);
		Assert.assertEquals(jsonObject.get("transferFrom"), jsonRequest.get("transferFrom"));
		
	}
	
	/**
	 * This test case is for get External Transfer for a given bhtNo
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */

	@Test(groups = "his.lab.test", dependsOnMethods ={"CreateExternalTransfer"})
	
	public void getSelectInternalTransfer() throws IOException, JSONException{
		
		ArrayList<String> resArray = getHTTPResponse(properties.getProperty(TestCaseConstants.URL_EXTERNAL_TRANSFER)+properties.getProperty(TestCaseConstants.EXTERNAL_BHTNO), TestCaseConstants.HTTP_GET, null);
		
		JSONArray jsonArray = new JSONArray(resArray.get(0));
		
		JSONObject jsonObject = jsonArray.getJSONObject(jsonArray.length()-1);
		
		System.out.println(jsonObject);
		
		Assert.assertEquals(Integer.parseInt(resArray.get(1)), SUCCESS_STATUS_CODE);
		Assert.assertEquals(jsonObject.getString("transferFrom"), transferFrom);
	}
}
