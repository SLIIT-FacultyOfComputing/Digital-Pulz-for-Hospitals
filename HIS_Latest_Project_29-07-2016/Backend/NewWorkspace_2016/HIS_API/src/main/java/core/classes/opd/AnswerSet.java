package core.classes.opd;

import java.io.Serializable;
import java.util.Date;

/***
 * Answerset class contains all the attributes and there getters and setters.
 * @author MIYURU
 *
 */
public class AnswerSet implements Serializable {
	
	int answerSetId;
	Visit visit;
	Questionnaire questionnaire;
	int answerSetCreateUser;
	Date answerSetCreateDate;
	Date answerSetLastUpDate;
	int answerSetLastUpDateUser;
	
	
	public int getAnswerSetId() {
		return answerSetId;
	}
	public void setAnswerSetId(int answerSetId) {
		this.answerSetId = answerSetId;
	}
	public Visit getVisit() {
		return visit;
	}
	public void setVisit(Visit visit) {
		this.visit = visit;
	}
	public Questionnaire getQuestionnaire() {
		return questionnaire;
	}
	public void setQuestionnaire(Questionnaire questionnaire) {
		this.questionnaire = questionnaire;
	}
	public int getAnswerSetCreateUser() {
		return answerSetCreateUser;
	}
	public void setAnswerSetCreateUser(int answerSetCreateUser) {
		this.answerSetCreateUser = answerSetCreateUser;
	}
	public Date getAnswerSetCreateDate() {
		return answerSetCreateDate;
	}
	public void setAnswerSetCreateDate(Date answerSetCreateDate) {
		this.answerSetCreateDate = answerSetCreateDate;
	}
	public Date getAnswerSetLastUpDate() {
		return answerSetLastUpDate;
	}
	public void setAnswerSetLastUpDate(Date answerSetLastUpDate) {
		this.answerSetLastUpDate = answerSetLastUpDate;
	}
	public int getAnswerSetLastUpDateUser() {
		return answerSetLastUpDateUser;
	}
	public void setAnswerSetLastUpDateUser(int answerSetLastUpDateUser) {
		this.answerSetLastUpDateUser = answerSetLastUpDateUser;
	}
	
 
}