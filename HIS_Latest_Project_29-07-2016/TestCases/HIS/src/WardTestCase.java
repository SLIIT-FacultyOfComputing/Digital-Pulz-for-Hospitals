import java.io.IOException;
import java.util.ArrayList;
import org.json.JSONArray;
//import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;
import org.testng.Assert;
import org.testng.annotations.Test;

/**
 * This class is for TestNG Integration Test cases related to all
 * functionalities of Inward in HIS Project. developed by Navoda.S & Gayesha.S.
 * for wardResourse.java
 * {@link BaseLogic.BaseTestCase}
 * @author udara.s
 * 
 */



public class WardTestCase extends BaseTestCase {

		public static final int SUCCESS_STATUS_CODE = 200;
		public String wardNo,category,wardGender;
		public JSONArray jsonArray;
		/**
		 * This test case is to add ward
		 * 
		 * @throws IOException
		 *             Signals that an I/O exception of some sort has occurred. This
		 *             class is the general class of exceptions produced by failed
		 *             or interrupted I/O operations.
		 * @throws JSONException
		 *             Exception throws when process Json
		 */
	@Test(groups="his.ward.test") 
	public void AddWardTestCase() throws IOException, JSONException
	{
		ArrayList<String> resArrayList=getHTTPResponse(properties.getProperty(TestCaseConstants.URL_APPPEND_ADD_WARD),
		TestCaseConstants.HTTP_POST,RequestUtil.requestByID(TestCaseConstants.ADD_WARD));	
		
		JSONObject JsonRes=new JSONObject(resArrayList.get(0));
		JSONObject JsonReq=new JSONObject(RequestUtil.requestByID(TestCaseConstants.ADD_WARD));
		
		category = JsonRes.getString("category");
		 wardNo = JsonRes.getString("wardNo");
		
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);	
		Assert.assertEquals(category, JsonReq.get("category"));
			 
			 
	}
	/**
	 * This test case is to get ward
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
@Test(groups="his.ward.test" ,dependsOnMethods = { "AddWardTestCase" }) 
	public void getWardTestCase() throws IOException, JSONException
	{

		ArrayList<String> resArrayList = getHTTPResponse(properties.getProperty(TestCaseConstants.URL_APPPEND_GET_WARD),
				TestCaseConstants.HTTP_GET, null);
		
		JSONArray jsonArray = new JSONArray(resArrayList.get(0));
		JSONObject jsonObject = ((JSONObject) jsonArray.get(jsonArray.length() - 1));

		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
		Assert.assertEquals(jsonObject.getString("wardNo"), wardNo);
		 
			 
	}

/**
 * This test case is to get ward by ward number
 * 
 * @throws IOException
 *             Signals that an I/O exception of some sort has occurred. This
 *             class is the general class of exceptions produced by failed
 *             or interrupted I/O operations.
 * @throws JSONException
 *             Exception throws when process Json
 */
@Test(groups = "his.ward.test", dependsOnMethods = { "AddWardTestCase" })
public void getWardByWardNoTestCase() throws IOException, JSONException {

	ArrayList<String> resArrayList = getHTTPResponse(properties.getProperty(TestCaseConstants.URL_APPEND_GET_WARD_BY_ID)
			+ wardNo, TestCaseConstants.HTTP_GET, null);
	
	
	JSONArray jsonArray = new JSONArray(resArrayList.get(0));
	
	JSONObject jsonObject = ((JSONObject) jsonArray.get(jsonArray.length() - 1));

	Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
	Assert.assertEquals(jsonObject.getString("wardNo"), wardNo);
	Assert.assertEquals(jsonObject.getString("category"), category);

 }
/**
 * This test case is to Update_Ward_Details
 * 
 * @throws IOException
 *             Signals that an I/O exception of some sort has occurred. This
 *             class is the general class of exceptions produced by failed
 *             or interrupted I/O operations.
 * @throws JSONException
 *             Exception throws when process Json
 */
@Test(groups = "his.ward.test", dependsOnMethods = { "AddWardTestCase" })
public void updateWardDetailsTestCase() throws IOException, JSONException {
	// Get JSON Request body to send Ward update Request
			JSONObject jsonRequestObject = new JSONObject(RequestUtil.requestByID(TestCaseConstants.UPDATE_WARD));
			
			jsonRequestObject.put("wardNo", wardNo);
	// Send JSON Update ward Request	
			
			System.out.println(jsonRequestObject);
			ArrayList<String> resArrayList=getHTTPResponse(properties.getProperty(TestCaseConstants.URL_APPEND_UPDATE_WARD_DETAILS),
					TestCaseConstants.HTTP_PUT,RequestUtil.requestByID(TestCaseConstants.UPDATE_WARD));	
			
			JSONObject jsonRes = new JSONObject(resArrayList.get(0));
			
	//assert the result
			Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
			Assert.assertEquals(jsonRes.getString("category"),jsonRequestObject.getString("category"));
			Assert.assertEquals(jsonRes.getString("wardGender"),jsonRequestObject.getString("wardGender"));
		
	
}

/**
 * This test case is to Delete_Ward_Details
 * 
 * @throws IOException
 *             Signals that an I/O exception of some sort has occurred. This
 *             class is the general class of exceptions produced by failed
 *             or interrupted I/O operations.
 * @throws JSONException
 *             Exception throws when process Json
 */

@Test(groups = "his.ward.test", dependsOnMethods= { "AddWardTestCase","updateWardDetailsTestCase" })
public void DeleteWardTestCase() throws IOException, JSONException {

	JSONObject jsonRequestObject = new JSONObject(RequestUtil.requestByID(TestCaseConstants.DELETE_WARD));
	System.out.println(properties.getProperty(TestCaseConstants.URL_APPEND_DELETE_URL));
	
	ArrayList<String> resArrayList = getHTTPResponse(properties.getProperty(TestCaseConstants.URL_APPEND_DELETE_URL), TestCaseConstants.HTTP_DELETE, RequestUtil.requestByID(TestCaseConstants.DELETE_WARD));

	JSONObject jsonRes = new JSONObject(resArrayList.get(0));

	
	System.out.println(resArrayList.get(0));
	Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
	Assert.assertEquals(jsonRes.getString("wardNo"), jsonRequestObject.getString("wardNo"));
	
}

}



