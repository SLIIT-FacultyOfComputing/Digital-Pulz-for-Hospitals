
import java.io.IOException;
import java.util.ArrayList;
import org.json.JSONException;
import org.json.JSONObject;
import org.testng.Assert;
import org.testng.annotations.Test;

/**
 * This class is for TestNG Integration Test cases related to all
 * functionalities of Laboratory Types in HIS Project. developed by Udesh Hewagama.
 * for LabTypeResource.java
 * {@link BaseTestCase}
 * @author udesh.c
 * 
 */
public class LabTypeTestCase extends BaseTestCase {

	public static final int SUCCESS_STATUS_CODE = 200;

	public String labTypeID, labTypeName;

	/**
	 * This is Add Laboratory Type Test Case.
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
	@Test(groups = "his.lab.test")
	public void insertLabTypeTestCase() throws IOException, JSONException {

		ArrayList<String> resArrayList = getHTTPResponse(
				properties.getProperty(TestCaseConstants.URL_APPEND_ADD_LAB_TYPE), TestCaseConstants.HTTP_POST,
				RequestUtil.requestByID(TestCaseConstants.ADD_LAB_TYPE));
		System.out.println(resArrayList.get(1));
		JSONObject jsonObject = new JSONObject(resArrayList.get(0));
		
		labTypeName = jsonObject.getString("lab_Type_Name");
		labTypeID = jsonObject.getString("labType_ID");
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
		Assert.assertEquals(labTypeName,properties.getProperty(TestCaseConstants.ADD_LAB_TYPE_NAME));
	

	}

	
	
	
	/**
	 * This is Update Laboratory Type Test Case.
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
	@Test(groups = "his.lab.test")
	public void updateLabTypeTestCase() throws IOException, JSONException {

		ArrayList<String> resArrayList = getHTTPResponse(
				properties.getProperty(TestCaseConstants.URL_APPEND_UPDATE_LAB_TYPE), TestCaseConstants.HTTP_POST,
				RequestUtil.requestByID(TestCaseConstants.UPDATE_LAB_TYPE));
		System.out.println(resArrayList.get(1));
		JSONObject jsonObject = new JSONObject(resArrayList.get(0));
		
		labTypeName = jsonObject.getString("lab_Type_Name");
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
		Assert.assertEquals(labTypeName,properties.getProperty(TestCaseConstants.UPDATE_LAB_TYPE_NAME));

	}

	/**
	 * This is delete Laboratory Type Test Case.
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
	@Test(groups = "his.lab.test", dependsOnMethods= {"insertLabTypeTestCase"})
	public void deleteLabTypeTestCase() throws IOException, JSONException {

		ArrayList<String> resArrayList = getHTTPResponse(properties.getProperty(TestCaseConstants.URL_APPEND_DELETE_LAB_TYPE)
				+ labTypeID, TestCaseConstants.HTTP_GET, null);
		System.out.println(resArrayList.get(1));
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);

	}
	

}
