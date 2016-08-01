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
import org.codehaus.jettison.json.JSONException;
import org.codehaus.jettison.json.JSONArray;
import org.codehaus.jettison.json.JSONObject;
import org.hibernate.Query;
import org.hibernate.Session;

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

	QuestionnaireDBDriver questionnaireDBDriver = new QuestionnaireDBDriver();
	DateFormat dateformat1 = new SimpleDateFormat("yyyy-MM-dd HH:mm:ss");
	DateFormat dateformat2 = new SimpleDateFormat("yyyy-MM-dd");

	/**
	 * @param json
	 * @param userid
	 * @return
	 */
	@POST
	@Path("/addQuestionnaire/{userid}")
	@Produces(MediaType.TEXT_PLAIN)
	@Consumes(MediaType.APPLICATION_JSON)
	public String addQuestionnaire(JSONObject json,
			@PathParam("userid") int userid) {

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
				questionnaire.questions.add(question);
			}

			if (questionnaireDBDriver.insertQuestionnaire(questionnaire))
				return "True";
			else
				return "False";

		} catch (Exception e) {
			System.out.println(e.getMessage());
			return "False";
		}
	}

	@POST
	@Path("/updateQuestionnaire/{qid}/{userid}")
	@Produces(MediaType.TEXT_PLAIN)
	@Consumes(MediaType.APPLICATION_JSON)
	public String updateQuestionnaire(JSONObject json,
			@PathParam("qid") int qid, @PathParam("userid") int userid) {

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
		 
			if (questionnaireDBDriver.updateQuestionnaire(qid, questionnaire))
				return "True";
			else 
				return "False";

		} catch (Exception e) {
			System.out.println("Error " + e.getMessage());
			return "False";
		}
	}

	/**
	 * @return
	 */
	@GET
	@Path("/getAll")
	@Produces(MediaType.APPLICATION_JSON)
	public String get() {
		try {
			List<Questionnaire> uList = questionnaireDBDriver
					.getQuestionnaireList();
			JSONSerializer serializer = new JSONSerializer();
			return serializer.serialize(uList);

		} catch (Exception e) {
			return "False";
		}
	}

	/**
	 * @param QID
	 * @return
	 */
	@GET
	@Path("/getQuestionnaireByID/{QID}")
	@Produces(MediaType.APPLICATION_JSON)
	public String getQuestionnaire(@PathParam("QID") int QID) {
		try {
			 
			JSONSerializer serializer = new JSONSerializer();
			Questionnaire questionnaire = questionnaireDBDriver
					.getQuestionnaire(QID);
			return serializer.serialize(questionnaire);
		} catch (Exception e) {
			return "error";
		}
	}

	/**
	 * @param QID
	 * @return
	 */
	@GET
	@Path("/getQuestions/{QID}")
	@Produces(MediaType.APPLICATION_JSON)
	public String getQuestions(@PathParam("QID") int QID) {
		try {

			List<Question> uList = questionnaireDBDriver.getQuestions(QID);
			JSONSerializer serializer = new JSONSerializer();

			return serializer.serialize(uList);

		} catch (Exception e) {
			return "error" + e.getMessage();
		}
	}

	/**
	 * @param QID
	 * @return
	 */
	@GET
	@Path("/getQuestionnaireByVisitType/{visitType}")
	@Produces(MediaType.APPLICATION_JSON)
	public String getQuestionnaireByVisitType(
			@PathParam("visitType") String visitType) {
		try {

			JSONSerializer serializer = new JSONSerializer();
			List<Questionnaire> questionnaires = questionnaireDBDriver
					.getQuestionnaireByVisitType(visitType);
			return serializer.exclude("*.class").serialize(questionnaires);

		} catch (Exception e) {
			return "error";
		}
	}

	@POST
	@Path("/saveQuestionAnswer/{qid}/{visitid}/{userid}")
	@Produces(MediaType.TEXT_PLAIN)
	@Consumes(MediaType.APPLICATION_JSON)
	public String saveQuestionAnswer(JSONObject json,
			@PathParam("qid") int qid, @PathParam("visitid") int visitID,
			@PathParam("userid") int userid) {

		try {

			JSONArray namearray = json.names();

			for (int i = 0; i < namearray.length(); i++) {
				int iQuesID = Integer.parseInt(namearray.get(i).toString()
						.replace("'", ""));
				String sQuesID = namearray.get(i).toString();
				String answerText = json.getString(sQuesID);

				if (!questionnaireDBDriver.saveQuestionAnswer(iQuesID, visitID,
						userid, answerText))
					return "False";
			}

			return "True";

		} catch (Exception e) {
			return "False";
		}
	}

	@POST
	@Path("/updateQuestionAnswer/{qid}/{visitid}/{userid}")
	@Produces(MediaType.TEXT_PLAIN)
	@Consumes(MediaType.APPLICATION_JSON)
	public String updateQuestionAnswer(JSONObject json,
			@PathParam("qid") int qid, @PathParam("visitid") int visitID,
			@PathParam("userid") int userid) {

		try {

			JSONArray namearray = json.names();

			for (int i = 0; i < namearray.length(); i++) {
				int iAnswerID = Integer.parseInt(namearray.get(i).toString()
						.replace("'", ""));
				String sAnswerID = namearray.get(i).toString();
				String answerText = json.getString(sAnswerID);

				if (!questionnaireDBDriver.updateQuestionAnswer(iAnswerID,
						userid, answerText))
					return "False";
			}

			return "True";

		} catch (Exception e) {
			return "False";
		}
	}

	@GET
	@Path("/getAnswers/{pid}/{qid}/{asetid}")
	@Produces(MediaType.APPLICATION_JSON)
	public String getAnswers(@PathParam("pid") int pid,
			@PathParam("qid") int qid, @PathParam("asetid") int asetid) {
		try {

			JSONSerializer serializer = new JSONSerializer();
			List<Answer> answers = questionnaireDBDriver.getAnswers(pid, qid,
					asetid);
			return serializer.exclude("*.class", "visit", "patient",
					"question", "questionnaire").serialize(answers);

		} catch (Exception e) {
			return "error" + e.getMessage();
		}
	}

}
