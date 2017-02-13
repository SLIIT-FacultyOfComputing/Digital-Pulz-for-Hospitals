import java.io.IOException;
import java.util.ArrayList;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;
import org.testng.Assert;
import org.testng.annotations.Test;

/**
 * This class is for TestNG Integration Test cases related to all
 * functionalities of Laboratory Departments in HIS Project. developed by Udesh Hewagama.
 * for LabDepartmentResource.java
 * {@link BaseTestCase}
 * @author udesh.c
 * 
 */
public class LabDepartmentsTestCase extends BaseTestCase {

	public static final int SUCCESS_STATUS_CODE = 200;

	public String labDeptID, labDeptName,returnlabDeptID;

	
	/**
	 * This test case is for get all laboratory departments
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */

	@Test(groups = "his.lab.test", dependsOnMethods = { "insertLabDepartmentTestCase" })
	public void getAllLaboratoriesTestCase() throws IOException {

		ArrayList<String> resArrayList = getHTTPResponse(properties.getProperty(TestCaseConstants.URL_APPEND_ALL_LAB_DEPARTMENTS),
				TestCaseConstants.HTTP_GET, null);

		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
	}
	
	/**
	 * This is Add Laboratory Department Test Case.
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
	@Test(groups = "his.lab.test")
	public void insertLabDepartmentTestCase() throws IOException, JSONException {

		ArrayList<String> resArrayList = getHTTPResponse(
				properties.getProperty(TestCaseConstants.URL_APPEND_ADD_LAB_DEPARTMENT), TestCaseConstants.HTTP_POST,
				RequestUtil.requestByID(TestCaseConstants.ADD_LAB_DEPARTMENT));
		System.out.println(resArrayList.get(1));
		JSONObject jsonObject = new JSONObject(resArrayList.get(0));
		
		labDeptName = jsonObject.getString("labDept_Name");
		labDeptID = jsonObject.getString("labDept_ID");
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
		Assert.assertEquals(labDeptName,properties.getProperty(TestCaseConstants.ADD_LAB_DEPARTMENT_NAME));
	

	}

	
	
	
	/**
	 * This is Update Laboratory Department Test Case.
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process JSON
	 */
	@Test(groups = "his.lab.test", dependsOnMethods = { "insertLabDepartmentTestCase" })
	public void updateLabDepartmentTestCase() throws IOException, JSONException {
		
		// Get JSON Request body to send Lab department update Request
			JSONObject jsonResponseObject = new JSONObject(RequestUtil.requestByID(TestCaseConstants.UPDATE_LAB_DEPARTMENT));
				
			jsonResponseObject.put("labDept_ID", labDeptID);
		// Send JSON Update test Request
		ArrayList<String> resArrayList = getHTTPResponse(
				properties.getProperty(TestCaseConstants.URL_APPEND_UPDATE_LAB_DEPARTMENT), TestCaseConstants.HTTP_POST,
				jsonResponseObject.toString());
		
	
		//Get Updated Lab departments by getting all department
		JSONArray jsonArray = new JSONArray(getHTTPResponse(properties.getProperty(TestCaseConstants.URL_APPEND_ALL_LAB_DEPARTMENTS),
		TestCaseConstants.HTTP_GET, null).get(0));
		
		//get the last entry of all departments
		JSONObject jsonObjectGetAll = jsonArray.getJSONObject(jsonArray.length()-1);
		
		
		//assert the result
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
		Assert.assertEquals(jsonObjectGetAll.getString("labDept_Name"),properties.getProperty(TestCaseConstants.UPDATE_LAB_DEPARTMENT_NAME));
	

	}

	/**
	 * This is delete Laboratory Department Test Case.
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
	@Test(groups = "his.lab.test", dependsOnMethods= {"insertLabDepartmentTestCase","updateLabDepartmentTestCase"})
	public void deleteLabTypeTestCase() throws IOException, JSONException {

		ArrayList<String> resArrayList = getHTTPResponse(properties.getProperty(TestCaseConstants.URL_APPEND_DELETE_LAB_DEPARTMENT)
				+ labDeptID, TestCaseConstants.HTTP_GET, null);
		
		String deletedID = new String(resArrayList.get(0));
		
		System.out.println(resArrayList.get(0));
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
		Assert.assertEquals(deletedID, labDeptID);
		
	}
	

}
