package core.classes.opd;

import java.io.Serializable;
import java.util.Date;
import java.util.HashSet;
import java.util.Set;

/***
 * Questionnaire class contains all the attributes and there getters and setters.
 * @author MIYURU
 *
 */
public class Questionnaire implements Serializable {

	int questionnaireID;
	String questionnaireName;
	String questionnaireRelateTo;
	String questionnaireRemarks;
	int questionnaireCreateUser;
	Date questionnaireLastUpdate;
	int questionnaireLastUpdateUser;
	int questionnaireActive;
	Date questionnaireCreateDate;

	public Set<Question> questions = new HashSet<Question>();
   
	public int getQuestionnaireID() {
		return questionnaireID;
	}

	public void setQuestionnaireID(int questionnaireID) {
		this.questionnaireID = questionnaireID;
	}

	public String getQuestionnaireName() {
		return questionnaireName;
	}

	public void setQuestionnaireName(String questionnaireName) {
		this.questionnaireName = questionnaireName;
	}

	public String getQuestionnaireRelateTo() {
		return questionnaireRelateTo;
	}

	public void setQuestionnaireRelateTo(String questionnaireRelateTo) {
		this.questionnaireRelateTo = questionnaireRelateTo;
	}

	public String getQuestionnaireRemarks() {
		return questionnaireRemarks;
	}

	public void setQuestionnaireRemarks(String questionnaireRemarks) {
		this.questionnaireRemarks = questionnaireRemarks;
	}

	public int getQuestionnaireCreateUser() {
		return questionnaireCreateUser;
	}

	public void setQuestionnaireCreateUser(int questionnaireCreateUser) {
		this.questionnaireCreateUser = questionnaireCreateUser;
	}

	public Date getQuestionnaireLastUpdate() {
		return questionnaireLastUpdate;
	}

	public void setQuestionnaireLastUpdate(Date questionnaireLastUpdate) {
		this.questionnaireLastUpdate = questionnaireLastUpdate;
	}

	public int getQuestionnaireLastUpdateUser() {
		return questionnaireLastUpdateUser;
	}

	public void setQuestionnaireLastUpdateUser(int questionnaireLastUpdateUser) {
		this.questionnaireLastUpdateUser = questionnaireLastUpdateUser;
	}

	public int getQuestionnaireActive() {
		return questionnaireActive;
	}

	public void setQuestionnaireActive(int questionnaireActive) {
		this.questionnaireActive = questionnaireActive;
	}

	public Date getQuestionnaireCreateDate() {
		return questionnaireCreateDate;
	}

	public void setQuestionnaireCreateDate(Date questionnaireCreateDate) {
		this.questionnaireCreateDate = questionnaireCreateDate;
	}

	public Set<Question> getQuestions() {
		return questions;
	}

	public void setQuestions(Set<Question> questions) {
		this.questions = questions;
	}

	
}