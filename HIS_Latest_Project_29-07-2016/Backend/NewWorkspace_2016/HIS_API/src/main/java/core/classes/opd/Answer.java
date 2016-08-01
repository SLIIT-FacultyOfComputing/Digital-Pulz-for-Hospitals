package core.classes.opd;

import java.io.Serializable;
import java.util.Date;

/***
 * Answer class contains all the attributes and there getters and setters.
 * @author MIYURU
 *
 */
public class Answer implements Serializable {
	
	int answerID;
	AnswerSet answerSetId;
	Question questionID;
	String answerText;

	/***
	 * Get Answer ID
	 * @return A Integer Value
	 */
	public int getAnswerID() {
		return answerID;
	}
	

	/***
	 * Set Answer ID
	 * @param answerID is An Integer Value
	 */
	public void setAnswerID(int answerID) {
		this.answerID = answerID;
	}

	/***
	 * Get Answer Set ID
	 * @return Answer Set Object
	 */
	public AnswerSet getAnswerSetId() {
		return answerSetId;
	}

	/***
	 * Set Answer set ID
	 * @param answerSetId is a Answer Set Object
	 */
	public void setAnswerSetId(AnswerSet answerSetId) {
		this.answerSetId = answerSetId;
	}

	
	public Question getQuestionID() {
		return questionID;
	}

	public void setQuestionID(Question questionID) {
		this.questionID = questionID;
	}

	public String getAnswerText() {
		return answerText;
	}

	public void setAnswerText(String answerText) {
		this.answerText = answerText;
	}

}