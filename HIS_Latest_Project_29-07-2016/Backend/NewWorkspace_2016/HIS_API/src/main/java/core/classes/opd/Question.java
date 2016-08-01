package core.classes.opd;

import java.io.Serializable;
import java.util.Date;

/***
 * Question class contains all the attributes and there getters and setters.
 * @author MIYURU
 *
 */
public class Question implements Serializable {

	int questionID;
	Questionnaire questionnaireID;
	String questionText;
	String questionAnswerType;
	String questionAnswerValue;
		 
	public int getQuestionID() {
		return questionID;
	}
	public void setQuestionID(int questionID) {
		this.questionID = questionID;
	}
	public Questionnaire getQuestionnaireID() {
		return questionnaireID;
	}
	public void setQuestionnaireID(Questionnaire questionnaireID) {
		this.questionnaireID = questionnaireID;
	}
	public String getQuestionText() {
		return questionText;
	}
	public void setQuestionText(String questionText) {
		this.questionText = questionText;
	}
	public String getQuestionAnswerType() {
		return questionAnswerType;
	}
	public void setQuestionAnswerType(String questionAnswerType) {
		this.questionAnswerType = questionAnswerType;
	}
	public String getQuestionAnswerValue() {
		return questionAnswerValue;
	}
	public void setQuestionAnswerValue(String questionAnswerValue) {
		this.questionAnswerValue = questionAnswerValue;
	}
	
}