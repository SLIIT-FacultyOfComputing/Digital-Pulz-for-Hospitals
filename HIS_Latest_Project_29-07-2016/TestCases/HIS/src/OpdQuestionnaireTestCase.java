import java.io.IOException;
import java.util.ArrayList;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;
import org.testng.Assert;
import org.testng.annotations.Test;

public class OpdQuestionnaireTestCase extends BaseTestCase {

	public static final int SUCCESS_STATUS_CODE = 200;

	public String userid, questionID, VisitType, visitID, asetid, patient,
			questionnaireId;

	/**
	 * This test case is to add Questionnaire
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
	@Test(groups = "his.lab.test")
	public void addOpdQuestionnaireTestCase() throws IOException, JSONException {

		userid = properties
				.getProperty(TestCaseConstants.QUESTIONNAIRE_USER_ID);
		System.out.println("userid = " + userid);
		ArrayList<String> resArrayList = getHTTPResponse(
				properties.getProperty(TestCaseConstants.URL_APPEND_OPD_ADD_QUESTIONNAIRE)
						+ userid, TestCaseConstants.HTTP_POST,
				RequestUtil
						.requestByID(TestCaseConstants.OPD_ADD_QUESTIONNAIRE));

		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)),
				SUCCESS_STATUS_CODE);

	}

	/**
	 * This test case is to update Questionnaire
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
	@Test(groups = "his.lab.test", dependsOnMethods = {
			"addOpdQuestionnaireTestCase", "getAllQuestionnaireTestCase" })
	public void updateQuestionniareTestCase() throws IOException, JSONException {

		JSONObject jsonResponseObject = new JSONObject(
				RequestUtil
						.requestByID(TestCaseConstants.UPDATE_OPD_QUESTIONNAIRE));

		System.out.println("questionnaireId = " + questionnaireId);
		System.out.println("user Id = " + userid);

		ArrayList<String> resArrayList = getHTTPResponse(
				properties.getProperty(TestCaseConstants.URL_APPEND_UPDATE_OPD_QUESTIONNAIRE)
						+ questionnaireId + "/" + userid,
				TestCaseConstants.HTTP_POST, jsonResponseObject.toString());

		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)),
				SUCCESS_STATUS_CODE);

	}

	/**
	 * This test case is to get all Questionnaire
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
	@Test(groups = "his.lab.test", dependsOnMethods = { "addOpdQuestionnaireTestCase" })
	public void getAllQuestionnaireTestCase() throws IOException, JSONException {

		ArrayList<String> resArrayList = getHTTPResponse(
				properties
						.getProperty(TestCaseConstants.URL_APPEND_OPD_GET_QUESTIONNAIRE),
				TestCaseConstants.HTTP_GET, null);

		JSONArray jsonArray = new JSONArray(resArrayList.get(0));

		System.out.println("All Questionnaire" + resArrayList.get(0));
		questionnaireId = (jsonArray.getJSONObject(jsonArray.length() - 1))
				.getString("questionnaireID");
		VisitType = (jsonArray.getJSONObject(jsonArray.length() - 1))
				.getString("questionnaireRelateTo");
		System.out.println("questionnaireId = " + questionnaireId);

		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)),
				SUCCESS_STATUS_CODE);
	}

	/**
	 * This test case is to get Questionnaire by QID
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
	@Test(groups = "his.lab.test", dependsOnMethods = {
			"addOpdQuestionnaireTestCase", "updateQuestionniareTestCase",
			"getAllQuestionnaireTestCase" })
	public void getOpdQuestionniareByQID() throws IOException, JSONException {

		ArrayList<String> resArrayList = getHTTPResponse(
				properties.getProperty(TestCaseConstants.URL_APPEND_OPD_GET_QUESTIONNAIRE_BY_QID)
						+ questionnaireId, TestCaseConstants.HTTP_GET, null);

		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)),
				SUCCESS_STATUS_CODE);

	}

	/**
	 * This test case is to get Question by QID
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
	@Test(groups = "his.lab.test", dependsOnMethods = {
			"addOpdQuestionnaireTestCase", "getAllQuestionnaireTestCase" })
	public void getOpdQuestionByQID() throws IOException, JSONException {

		ArrayList<String> resArrayList = getHTTPResponse(
				properties.getProperty(TestCaseConstants.URL_APPEND_GET_OPD_QUESTION_BY_QID)
						+ questionnaireId, TestCaseConstants.HTTP_GET, null);

		questionID = (new JSONArray (resArrayList.get(0))).getJSONObject(0).getString("questionID");
		
		System.out.println("question Id = " + questionID);
		
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)),
				SUCCESS_STATUS_CODE);

	}

	/**
	 * This test case is to get Questionnaire by Visit Type
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
	@Test(groups = "his.lab.test", dependsOnMethods = {
			"addOpdQuestionnaireTestCase", "updateQuestionniareTestCase",
			"getAllQuestionnaireTestCase" })
	public void getOpdQuestionnaireByVisitType() throws IOException,
			JSONException {

		ArrayList<String> resArrayList = getHTTPResponse(
				properties.getProperty(TestCaseConstants.URL_APPEND_GET_OPD_QUESTIONNAIRE_BY_VISITTYPE)
						+ VisitType, TestCaseConstants.HTTP_GET, null);

		System.out.println("Questionnaire by visit type = "+ resArrayList.get(0));
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)),
				SUCCESS_STATUS_CODE);

	}

	/**
	 * This test case is to save Question answers by IDs
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
	@Test(groups = "his.lab.test", dependsOnMethods = {
			"addOpdQuestionnaireTestCase", "updateQuestionniareTestCase",
			"getAllQuestionnaireTestCase", "getOpdQuestionByQID" })
	public void saveOpdQuestionAnswer() throws IOException, JSONException {

		JSONObject jsonRequestObject = new JSONObject();
		
		jsonRequestObject.put("'"+questionID + "'", questionID);
		
		visitID = properties
				.getProperty(TestCaseConstants.QUESTIONANSWER_VISIT_ID);
		ArrayList<String> resArrayList = getHTTPResponse(
				properties.getProperty(TestCaseConstants.URL_APPEND_SAVE_OPD_QUESTIONANSWER)
						+ userid + "/" + visitID + "/" + questionnaireId,
				TestCaseConstants.HTTP_POST,jsonRequestObject.toString());


		//JSONObject jsonResponseObject = new JSONObject(resArrayList.get(0));

		System.out.println("request = " + jsonRequestObject);
		System.out.println("response = " + resArrayList.get(0));

		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)),
			SUCCESS_STATUS_CODE);
		//Assert.assertEquals(jsonResponseObject.getString("attachName"), jsonRequestObject.getString("attachname"));

	}

	/**
	 * This test case is to update Question answers by IDs
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
	@Test(groups = "his.lab.test", dependsOnMethods = {
			"addOpdQuestionnaireTestCase", "updateQuestionniareTestCase",
			"getAllQuestionnaireTestCase", "saveOpdQuestionAnswer" })
	public void updateQuestionAnswerTestCase() throws IOException,
			JSONException {

		JSONObject jsonResponseObject = new JSONObject(
				RequestUtil
						.requestByID(TestCaseConstants.UPDATE_OPD_QUESTION_ANSWER));

		ArrayList<String> resArrayList = getHTTPResponse(
				properties.getProperty(TestCaseConstants.URL_APPEND_UPDATE_OPD_QUESTION_ANSWER)
						+ userid + "/" + visitID + "/" + questionnaireId,
				TestCaseConstants.HTTP_POST, jsonResponseObject.toString());

		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)),
				SUCCESS_STATUS_CODE);

	}

	/**
	 * This test case is to get answers by IDs
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
	@Test(groups = "his.lab.test", dependsOnMethods = {
			"addOpdQuestionnaireTestCase", "updateQuestionniareTestCase",
			"saveOpdQuestionAnswer", "updateQuestionAnswerTestCase" })
	public void getOpdAnswer() throws IOException, JSONException {

		asetid = properties
				.getProperty(TestCaseConstants.QUESTIONANSWER_ANSWERSET_ID);
		patient = properties
				.getProperty(TestCaseConstants.QUESTIONANSWER_PATIENT_ID);

		ArrayList<String> resArrayList = getHTTPResponse(
				properties.getProperty(TestCaseConstants.URL_APPEND_GET_OPD_ANSWER)
						+ patient + "/" + questionnaireId + "/" + asetid,
				TestCaseConstants.HTTP_GET, null);

		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)),
				SUCCESS_STATUS_CODE);

	}

}
