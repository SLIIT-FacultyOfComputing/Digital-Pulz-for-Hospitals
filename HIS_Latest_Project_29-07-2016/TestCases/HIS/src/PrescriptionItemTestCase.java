import java.io.IOException;
import java.util.ArrayList;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;
import org.testng.Assert;
import org.testng.annotations.Test;

/**
 * This class is for TestNG Integration Test cases related to all
 * functionalities of inward in HIS Project. developed by Gayesha.S & Navoda.S
 * for prescriptionItemResourse.java {@link BaseLogic.BaseTestCase}
 * 
 * @author udara.s
 * 
 */

public class PrescriptionItemTestCase extends BaseTestCase {

	public static final int SUCCESS_STATUS_CODE = 200;

	public String term_id, dose, frequency, status, bht_no,auto_id;
	public int drug_id;

	/**
	 * This is Add New Prescription Item Test Case.
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
	@Test(groups = "his.test.prescriptionItem", dependsOnMethods = { "getMaxTermIdByUserId" })
	public void AddPrescriptionItem() throws IOException, JSONException {

		JSONObject jsonRequestObject = new JSONObject(
				RequestUtil
						.requestByID(TestCaseConstants.ADD_PRESCRIPTION_ITEM));

		jsonRequestObject.put("term_id", term_id);

		// Send POST request to add Prescription Item
		ArrayList<String> resArrayList = getHTTPResponse(
				properties
						.getProperty(TestCaseConstants.URL_APPEND_ADD_PRESCRIPTION_ITEM),
				TestCaseConstants.HTTP_POST, jsonRequestObject.toString());

		JSONObject jsonResObj = new JSONObject(resArrayList.get(0));
		
		JSONObject jsonReqObj = new JSONObject(
				RequestUtil
						.requestByID(TestCaseConstants.ADD_PRESCRIPTION_ITEM));
		bht_no = jsonReqObj.getString("bht_no");

		drug_id = Integer.parseInt(jsonResObj.getJSONObject("drug_id")
				.getString("dSrNo"));
		status = jsonReqObj.getString("status");

		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)),
				SUCCESS_STATUS_CODE);
		Assert.assertEquals(drug_id, jsonReqObj.getInt("drug_id"));

	}

	/**
	 * This is Get Max TermID By UserID Test Case.
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
	@Test(groups = "his.test.prescriptionItem", dependsOnGroups = { "his.prescription.Term" })
	public void getMaxTermIdByUserId() throws IOException, JSONException {

		ArrayList<String> resArrayList = getHTTPResponse(
				properties
						.getProperty(TestCaseConstants.URL_GET_MAX_TERM_ID_BY_USERID),
				TestCaseConstants.HTTP_GET, null);

		String term = resArrayList.get(0);
		System.out.println("term_id IN ITEM= " + term);
		term_id = PrescriptionTermTestCase.termID;

		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)),
				SUCCESS_STATUS_CODE);
		Assert.assertEquals(term, PrescriptionTermTestCase.termID);

	}

	/**
	 * This is Get prescription Id By bht No Test Case.
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
	@Test(groups = "his.test.prescriptionItem", dependsOnMethods = { "AddPrescriptionItem" })
	public void getPrescriptionItemByBHTno() throws IOException, JSONException {

		ArrayList<String> resArrayList = getHTTPResponse(
				properties.getProperty(TestCaseConstants.URL_GET_PRESCRIPTION_ITEM_BY_BHTNO)
						+ bht_no, TestCaseConstants.HTTP_GET, null);

		JSONArray jsonArray = new JSONArray(resArrayList.get(0));

		JSONObject jsonObject = ((JSONObject) jsonArray
				.get(jsonArray.length() - 1));
		System.out.println("json = " + jsonObject);
		String act_bht = jsonObject.getJSONObject("term_id")
				.getJSONObject("bht_no").getString("bhtNo");
		auto_id = jsonObject.getString("auto_id");
		System.out.println("auto id"+auto_id);
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)),SUCCESS_STATUS_CODE);
		Assert.assertEquals(act_bht, bht_no);

	}

	/**
	 * This is Get prescriptionItem By TermID Test Case.
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
	@Test(groups = "his.test.prescriptionItem", dependsOnMethods = { "AddPrescriptionItem" })
	public void getPrescriptionItemByTermID() throws IOException, JSONException {

		ArrayList<String> resArrayList = getHTTPResponse(
				properties.getProperty(TestCaseConstants.URL_APPEND_GET_TERM_PRESCRIPTION_BY_TERM_ID)
						+ term_id, TestCaseConstants.HTTP_GET, null);

		JSONArray jsonArray = new JSONArray(resArrayList.get(0));

		JSONObject jsonObject = ((JSONObject) jsonArray
				.get(jsonArray.length() - 1));

		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)),
				SUCCESS_STATUS_CODE);
		Assert.assertEquals(jsonObject.get("status"), status);

	}
	
	/**
	 * This is to update prescriptionItem  Test Case.
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
	@Test(groups = "his.test.prescriptionItem", dependsOnMethods = { "getPrescriptionItemByBHTno" })
	public void UpdatePrescrptionItemTestCase() throws IOException, JSONException {
	 //Get JSON Request body to send prescriptionItem update Request
	JSONObject jsonRequestObject = new JSONObject(RequestUtil.requestByID(TestCaseConstants.UPDATE_PRESCRIPTION_ITEM));
				System.out.println(auto_id);
				jsonRequestObject.put("auto_id",auto_id);
		//Send JSON Update prescriptionItem Request	
				
				System.out.println(jsonRequestObject);
				ArrayList<String> resArrayList=getHTTPResponse(properties.getProperty(TestCaseConstants.URL_APPEND_UPDATE_PRESCRIPTION_ITEM),
						TestCaseConstants.HTTP_POST,jsonRequestObject.toString());	
			
		//assert the result
				Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
				
				Assert.assertEquals(resArrayList.get(0),jsonRequestObject.getString("auto_id"));

			
		
}
	
	
}