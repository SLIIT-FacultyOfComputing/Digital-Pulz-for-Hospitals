import java.io.IOException;
import java.util.ArrayList;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;
import org.testng.Assert;
import org.testng.annotations.Test;

/**
 * This class is for TestNG Integration Test cases related to all
 * functionalities of BedResourceTests in HIS Project. developed by saugat.a
 * 
 * {@link BaseTestCase}
 * 
 * @author saugat.aryal
 *
 */

public class BedTestCase extends BaseTestCase {

	public static final int SUCCESS_STATUS_CODE = 200;
	
	public int BedId;

	/**
	 * This test case is to add Bed
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
	@Test(groups = "his.bed.test")
	public void addBedTestCase() throws IOException, JSONException {

		JSONObject jsonRequestObject = new JSONObject(RequestUtil
				.requestByID(TestCaseConstants.ADD_INWARD_BED));
		
		ArrayList<String> resArrayList = getHTTPResponse(
				properties
						.getProperty(TestCaseConstants.URL_APPEND_ADD_BED),
				TestCaseConstants.HTTP_POST, jsonRequestObject.toString());

		System.out.println("message :"+resArrayList.get(0));
		
		JSONObject jsonObject = new JSONObject(resArrayList.get(0));
		
		BedId= jsonObject.getInt("bedNo");

		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)),
				SUCCESS_STATUS_CODE);
		Assert.assertEquals(BedId, Integer.parseInt(jsonRequestObject.getString("bedNo")));
	}
	
	/**
	 * This test case is to get Bed by Ward No
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
	
	@Test(groups = "his.bed.test")
	public void getAllBedByWardNoTestCase() throws IOException {

		ArrayList<String> resArrayList = getHTTPResponse(
				properties.getProperty(TestCaseConstants.URL_APPEND_GET_BED_BY_WARD_NO)+
				properties.getProperty(TestCaseConstants.WARD_NO),
				TestCaseConstants.HTTP_GET, null);
		
		System.out.println(resArrayList.get(0));
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)),
				SUCCESS_STATUS_CODE);
	}
	
	/**
	 * This test case is to Delete Bed
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
	
	
	
	
	
	
	/**
	 * This test case is to Update Bed
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
	
	@Test(groups = "his.bed.test" , dependsOnMethods = {"addBedTestCase"})
	public void updateBedTestCase() throws IOException, JSONException {

		JSONObject obj=new JSONObject(RequestUtil.requestByID(TestCaseConstants.UPDATE_BED));
		
		obj.put("bedID", BedId);

		
		ArrayList<String> resArrayList = getHTTPResponse(
				properties.getProperty(TestCaseConstants.URL_APPEND_UPDATE_BED), TestCaseConstants.HTTP_PUT,obj.toString());
		System.out.println(resArrayList.get(0));
		
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
		//Assert.assertTrue((Boolean.parseBoolean(resArrayList.get(0))));
		Assert.assertEquals(BedId, Integer.parseInt(obj.getString("bedNo")));
	

	}
	
	
	
	/**
	 * This test case is to Get Bed By Ward No and Bed No
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
	
	@Test(groups = "his.bed.test")
	public void getBedByWardNoAndBedNoTestCase() throws IOException, JSONException {

		ArrayList<String> resArrayList = getHTTPResponse(
				properties.getProperty(TestCaseConstants.URL_APPEND_GET_BED_BY_WARD_NO_AND_BED_NO)+
				properties.getProperty(TestCaseConstants.BED_WARD_NO)+"/"+properties.getProperty(TestCaseConstants.BED_NO),
				TestCaseConstants.HTTP_GET, null);
		

		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)),
				SUCCESS_STATUS_CODE);
	

	}
	
	
	
	/**
	 * This test case is to Get Free Bed By Ward No
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
	
	@Test(groups = "his.bed.test")
	public void getFreeBedByWardNoTestCase() throws IOException, JSONException {

		ArrayList<String> resArrayList = getHTTPResponse(
				properties.getProperty(TestCaseConstants.URL_APPEND_GET_FREE_BED_BY_WARD_NO)+
				properties.getProperty(TestCaseConstants.FREE_BED_WARD_NO),
				TestCaseConstants.HTTP_GET, null);
		
		System.out.println(resArrayList.get(0));
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)),
				SUCCESS_STATUS_CODE);
	

	}
	
	

}