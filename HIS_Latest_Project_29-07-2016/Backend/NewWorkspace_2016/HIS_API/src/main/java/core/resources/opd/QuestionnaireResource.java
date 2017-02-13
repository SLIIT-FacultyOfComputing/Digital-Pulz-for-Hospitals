package core.resources.opd;

import java.util.HashSet;
import java.util.Iterator;
import java.util.List;
import java.util.Set;
import java.text.DateFormat;
import java.text.SimpleDateFormat;
import java.util.Date;

import javax.ws.rs.Consumes;
import javax.ws.rs.GET;
import javax.ws.rs.Path;
import javax.ws.rs.POST;
import javax.ws.rs.PathParam;
import javax.ws.rs.Produces;
import javax.ws.rs.core.MediaType;

import org.apache.log4j.Logger;
import org.codehaus.jettison.json.JSONException;
import org.codehaus.jettison.json.JSONArray;
import org.codehaus.jettison.json.JSONObject;
import org.hibernate.Query;
import org.hibernate.Session;

import core.ErrorConstants;
import core.classes.opd.Answer;
import core.classes.opd.AnswerSet;
import core.classes.opd.Question;
import core.classes.opd.Questionnaire;
import flexjson.JSONSerializer;
import lib.SessionFactoryUtil;

import org.hibernate.Transaction;

import lib.driver.opd.driver_class.QuestionnaireDBDriver;

/**
 * This class define all the generic REST Services necessary for handling
 * questionnaires for patient visits
 * 
 * @author
 * @version 1.0
 */
@Path("Questionnaire")
public class QuestionnaireResource {
	
	final static Logger logger = Logger.getLogger(QuestionnaireResource.class);

	QuestionnaireDBDriver questionnaireDBDriver = new QuestionnaireDBDriver();
	DateFormat dateformat1 = new SimpleDateFormat("yyyy-MM-dd HH:mm:ss");
	DateFormat dateformat2 = new SimpleDateFormat("yyyy-MM-dd");

	/**
	 * @param json
	 * @param userid
	 * @return
	 * @throws JSONException 
	 */
	@POST
	@Path("/addQuestionnaire/{userid}")
	@Produces(MediaType.TEXT_PLAIN)
	@Consumes(MediaType.APPLICATION_JSON)
	public String addQuestionnaire(JSONObject json,
			@PathParam("userid") int userid) throws JSONException {
		logger.info("add questionnaire");

		try {

			Questionnaire questionnaire = new Questionnaire();
			questionnaire.setQuestionnaireName(json.getString("name"));
			questionnaire.setQuestionnaireRelateTo(json.getString("relateto"));
			questionnaire.setQuestionnaireRemarks(json.getString("remarks"));
			questionnaire.setQuestionnaireActive(1);
			questionnaire.setQuestionnaireCreateDate(new Date());
			questionnaire.setQuestionnaireCreateUser(userid);
			questionnaire.setQuestionnaireLastUpdate(new Date());
			questionnaire.setQuestionnaireLastUpdateUser(userid);

			JSONArray questions = json.getJSONArray("question_list");

			for (int i = 0; i < questions.length(); i++) {

				JSONObject questionjson = questions.getJSONObject(i);

				String text = questionjson.getString("text");
				String answertype = questionjson.getString("answertype");
				String answervals = questionjson.getString("answervals");

				Question question = new Question();
				question.setQuestionText(text);
				question.setQuestionAnswerType(answertype);
				question.setQuestionAnswerValue(answervals);
				question.setQuestionnaireID(questionnaire);
				questionnaire.questions.add(question);
			}

			if (questionnaireDBDriver.insertQuestionnaire(questionnaire)){
				logger.info("successfully new questionnaire added");
				JSONSerializer jsonSerializer = new JSONSerializer();
				return jsonSerializer.include("userid").serialize(questionnaire);
			
			}
			else{
				logger.info("new questionnaire not added");
				return null;
				
			}

		}catch (JSONException e) {
			logger.error("error adding questionnaire: "+e.getMessage());
			JSONObject jsonErrorObject = new JSONObject();
			jsonErrorObject.put("errorcode", ErrorConstants.FILL_REQUIRED_FIELDS.getCode());
			jsonErrorObject.put("message", ErrorConstants.FILL_REQUIRED_FIELDS.getMessage());		
			
			return jsonErrorObject.toString(); 
		} 
		catch (RuntimeException e)
		{
			logger.error("error adding questionnaire: "+e.getMessage());
			JSONObject jsonErrorObject = new JSONObject();
			jsonErrorObject.put("errorcode", ErrorConstants.FILL_REQUIRED_FIELDS.getCode());
			jsonErrorObject.put("message", ErrorConstants.FILL_REQUIRED_FIELDS.getMessage());
			
			return jsonErrorObject.toString();
		} catch (Exception e) {
			logger.error("error adding questionnaire: "+e.getMessage());
			return e.getMessage();
		}
	}

	@POST
	@Path("/updateQuestionnaire/{qid}/{userid}")
	@Produces(MediaType.TEXT_PLAIN)
	@Consumes(MediaType.APPLICATION_JSON)
	public String updateQuestionnaire(JSONObject json,
			@PathParam("qid") int qid, @PathParam("userid") int userid) throws JSONException {
		logger.info("update questionnaire");

		try {

			Questionnaire questionnaire = new Questionnaire();
			questionnaire.setQuestionnaireName(json.getString("name"));
			questionnaire.setQuestionnaireRelateTo(json.getString("relateto"));
			questionnaire.setQuestionnaireRemarks(json.getString("remarks"));
			questionnaire.setQuestionnaireActive(1);
			questionnaire.setQuestionnaireLastUpdate(new Date());
			questionnaire.setQuestionnaireLastUpdateUser(userid);
			
			System.out.println(json.toString());
		
			JSONObject questions = json.optJSONObject("question_list");
			JSONArray questionsArray = json.optJSONArray("question_list");
			
		 if( questions != null)
		 {
			Iterator ite =  questions.keys();
			
			while(ite.hasNext())
			{
				JSONObject questionjson = questions.getJSONObject(ite.next().toString());

				System.out.println(questionjson.toString());

				String text = questionjson.getString("text");
				String answertype = questionjson.getString("answertype");
				String answervals = questionjson.getString("answervals");

				Question question = new Question();

				if (questionjson.getString("questionID") == "null")
					question.setQuestionID(-1);

				question.setQuestionText(text);
				question.setQuestionAnswerType(answertype);
				question.setQuestionAnswerValue(answervals);
				questionnaire.questions.add(question);
			}
		 }else if(questionsArray != null)
		 {
 
				for(int i=0;i<questionsArray.length();i++)
				{
					JSONObject questionjson = questionsArray.getJSONObject(i);

					System.out.println(questionjson.toString());

					String text = questionjson.getString("text");
					String answertype = questionjson.getString("answertype");
					String answervals = questionjson.getString("answervals");

					Question question = new Question();

					if (questionjson.getString("questionID") == "null")
					{
						question.setQuestionID(-1);
					}

					question.setQuestionText(text);
					question.setQuestionAnswerType(answertype);
					question.setQuestionAnswerValue(answervals);
					questionnaire.questions.add(question);
				}
		 }
		 
			if (questionnaireDBDriver.updateQuestionnaire(qid, questionnaire)){
				logger.info("successfully questionnaire updated");
				JSONSerializer jsonSerializer = new JSONSerializer();
				return jsonSerializer.include("userid").serialize(questionnaire);
			}
			else {
				logger.info("questionnaire not updated");
				return null;
			}

		}catch (JSONException e) {
			logger.error("error updating questionnaire: "+e.getMessage());
			JSONObject jsonErrorObject = new JSONObject();
			jsonErrorObject.put("errorcode", ErrorConstants.FILL_REQUIRED_FIELDS.getCode());
			jsonErrorObject.put("message", ErrorConstants.FILL_REQUIRED_FIELDS.getMessage());		
			
			return jsonErrorObject.toString(); 
		} 
		catch (RuntimeException e)
		{
			logger.error("error updating questionnaire: "+e.getMessage());
			JSONObject jsonErrorObject = new JSONObject();
			jsonErrorObject.put("errorcode", ErrorConstants.FILL_REQUIRED_FIELDS.getCode());
			jsonErrorObject.put("message", ErrorConstants.FILL_REQUIRED_FIELDS.getMessage());
			
			return jsonErrorObject.toString();
		} catch (Exception e) {
			logger.error("error updating questionnaire: "+e.getMessage());
			return null;
		}
	}

	/**
	 * @return
	 * @throws JSONException 
	 */
	@GET
	@Path("/getAll")
	@Produces(MediaType.APPLICATION_JSON)
	public String get() throws JSONException {
		logger.info("get all questionnaire");
		try {
			List<Questionnaire> uList = questionnaireDBDriver
					.getQuestionnaireList();
			JSONSerializer serializer = new JSONSerializer();
			logger.info("successfully getting all questionniare");
			return serializer.serialize(uList);

		}catch (RuntimeException e)
		{
			logger.error("error getting all questionnaire: "+e.getMessage());
			JSONObject jsonErrorObject = new JSONObject();
			jsonErrorObject.put("errorcode", ErrorConstants.FILL_REQUIRED_FIELDS.getCode());
			jsonErrorObject.put("message", ErrorConstants.FILL_REQUIRED_FIELDS.getMessage());
			
			return jsonErrorObject.toString();
		} catch (Exception e) {
			logger.error("error getting all questionnaire: "+ e.getMessage());
			return "error";
		}
	}

	/**
	 * @param QID
	 * @return
	 * @throws JSONException 
	 */
	@GET
	@Path("/getQuestionnaireByID/{QID}")
	@Produces(MediaType.APPLICATION_JSON)
	public String getQuestionnaire(@PathParam("QID") int QID) throws JSONException {
		logger.info("get questionnaire by questionnaire id");
		try {
			 
			JSONSerializer serializer = new JSONSerializer();
			Questionnaire questionnaire = questionnaireDBDriver
					.getQuestionnaire(QID);
			logger.info("successfully getting questionniare");
			return serializer.serialize(questionnaire);
		} catch (RuntimeException e)
		{
			logger.error("error getting questionniare by questionnaire id: "+e.getMessage());
			JSONObject jsonErrorObject = new JSONObject();
			jsonErrorObject.put("errorcode", ErrorConstants.FILL_REQUIRED_FIELDS.getCode());
			jsonErrorObject.put("message", ErrorConstants.FILL_REQUIRED_FIELDS.getMessage());
			
			return jsonErrorObject.toString();
		}catch (Exception e) {
			logger.error("error getting questionniare by questionnaire id: "+ e.getMessage());
			return "error";
		}
	}

	/**
	 * @param QID
	 * @return
	 * @throws JSONException 
	 */
	@GET
	@Path("/getQuestions/{QID}")
	@Produces(MediaType.APPLICATION_JSON)
	public String getQuestions(@PathParam("QID") int QID) throws JSONException {
		logger.info("get questions by questionnaire id");
		try {

			List<Question> uList = questionnaireDBDriver.getQuestions(QID);
			JSONSerializer serializer = new JSONSerializer();
			logger.info("successfully getting questions");

			return serializer.serialize(uList);

		} catch (RuntimeException e)
		{
			logger.error("error getting questions: "+e.getMessage());
			JSONObject jsonErrorObject = new JSONObject();
			jsonErrorObject.put("errorcode", ErrorConstants.FILL_REQUIRED_FIELDS.getCode());
			jsonErrorObject.put("message", ErrorConstants.FILL_REQUIRED_FIELDS.getMessage());
			
			return jsonErrorObject.toString();
		}catch (Exception e) {
			logger.error("error getting questions: "+e.getMessage());
			return "error" + e.getMessage();
		}
	}

	/**
	 * @param QID
	 * @return
	 * @throws JSONException 
	 */
	@GET
	@Path("/getQuestionnaireByVisitType/{visitType}")
	@Produces(MediaType.APPLICATION_JSON)
	public String getQuestionnaireByVisitType(
			@PathParam("visitType") String visitType) throws JSONException {
		logger.info("get questions by visit type");
		try {

			JSONSerializer serializer = new JSONSerializer();
			List<Questionnaire> questionnaires = questionnaireDBDriver
					.getQuestionnaireByVisitType(visitType);
			logger.info("successfully getting questions");
			return serializer.exclude("*.class").serialize(questionnaires);

		} catch (RuntimeException e)
		{
			logger.error("error getting questions by visit type: "+e.getMessage());
			JSONObject jsonErrorObject = new JSONObject();
			jsonErrorObject.put("errorcode", ErrorConstants.FILL_REQUIRED_FIELDS.getCode());
			jsonErrorObject.put("message", ErrorConstants.FILL_REQUIRED_FIELDS.getMessage());
			
			return jsonErrorObject.toString();
		}catch (Exception e) {
			logger.error("error getting questions by visit type: "+ e.getMessage());
			return "error";
		}
	}

	@POST
	@Path("/saveQuestionAnswer/{qid}/{visitid}/{userid}")
	@Produces(MediaType.TEXT_PLAIN)
	@Consumes(MediaType.APPLICATION_JSON)
	public String saveQuestionAnswer(JSONObject json,
			@PathParam("qid") int qid, @PathParam("visitid") int visitID,
			@PathParam("userid") int userid) throws JSONException {
		logger.info("save question answer");

		try {

			JSONArray namearray = json.names();

			for (int i = 0; i < namearray.length(); i++) {
				int iQuesID = Integer.parseInt(namearray.get(i).toString()
						.replace("'", ""));
				String sQuesID = namearray.get(i).toString();
				String answerText = json.getString(sQuesID);

				if (!questionnaireDBDriver.saveQuestionAnswer(iQuesID, visitID,
						userid, answerText))
					logger.info("no questions saved");
				
			}
			logger.info("successfully saving question answer");
			return String.valueOf(visitID);

		}catch (RuntimeException e)
		{
			logger.error("error saving question answer: "+e.getMessage());
			JSONObject jsonErrorObject = new JSONObject();
			jsonErrorObject.put("errorcode", ErrorConstants.FILL_REQUIRED_FIELDS.getCode());
			jsonErrorObject.put("message", ErrorConstants.FILL_REQUIRED_FIELDS.getMessage());
			
			return jsonErrorObject.toString();
		} catch (Exception e) {
			logger.error("error saving question answer: "+ e.getMessage());
			return null;
		}
	}

	@POST
	@Path("/updateQuestionAnswer/{qid}/{visitid}/{userid}")
	@Produces(MediaType.TEXT_PLAIN)
	@Consumes(MediaType.APPLICATION_JSON)
	public String updateQuestionAnswer(JSONObject json,
			@PathParam("qid") int qid, @PathParam("visitid") int visitID,
			@PathParam("userid") int userid) throws JSONException {
		logger.info("update question answer");

		try {

			JSONArray namearray = json.names();

			for (int i = 0; i < namearray.length(); i++) {
				int iAnswerID = Integer.parseInt(namearray.get(i).toString()
						.replace("'", ""));
				String sAnswerID = namearray.get(i).toString();
				String answerText = json.getString(sAnswerID);

				if (!questionnaireDBDriver.updateQuestionAnswer(iAnswerID,
						userid, answerText))
					logger.info("no question answer updated");
					//return "False";
				return null;
			}
			logger.info("successfully updating question answer");
			return String.valueOf(visitID);

		} catch (RuntimeException e)
		{
			logger.error("error updating question answer: "+e.getMessage());
			JSONObject jsonErrorObject = new JSONObject();
			jsonErrorObject.put("errorcode", ErrorConstants.FILL_REQUIRED_FIELDS.getCode());
			jsonErrorObject.put("message", ErrorConstants.FILL_REQUIRED_FIELDS.getMessage());
			
			return jsonErrorObject.toString();
		}catch (Exception e) {
			logger.error("error updating question answer: "+ e.getMessage());
			return null;
		}
	}

	@GET
	@Path("/getAnswers/{pid}/{qid}/{asetid}")
	@Produces(MediaType.APPLICATION_JSON)
	public String getAnswers(@PathParam("pid") int pid,
			@PathParam("qid") int qid, @PathParam("asetid") int asetid) throws JSONException {
		logger.info("get answers");
		try {

			JSONSerializer serializer = new JSONSerializer();
			List<Answer> answers = questionnaireDBDriver.getAnswers(pid, qid,
					asetid);
			logger.info("successfully getting answers");
			return serializer.exclude("*.class", "visit", "patient",
					"question", "questionnaire").serialize(answers);

		} catch (RuntimeException e)
		{
			logger.error("error getting answers: "+e.getMessage());
			JSONObject jsonErrorObject = new JSONObject();
			jsonErrorObject.put("errorcode", ErrorConstants.FILL_REQUIRED_FIELDS.getCode());
			jsonErrorObject.put("message", ErrorConstants.FILL_REQUIRED_FIELDS.getMessage());
			
			return jsonErrorObject.toString();
		}catch (Exception e) {
			logger.error("error getting answers: "+e.getMessage());
			return "error" + e.getMessage();
		}
	}

}
