/**
 * 
 */
package lib.driver.opd.driver_class;

import java.util.Date;
import java.util.List;
import java.util.Set;

import javax.ws.rs.PathParam;

import lib.SessionFactoryUtil;

import org.hibernate.HibernateException;
import org.hibernate.Query;
import org.hibernate.Session;
import org.hibernate.Transaction;

import core.classes.opd.*;

/**
 * @author Prabhath
 * 
 */
public class QuestionnaireDBDriver {

	Session session = SessionFactoryUtil.getSessionFactory()
			.getCurrentSession();

	public boolean insertQuestionnaire(Questionnaire questionnaire) {

		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			session.save(questionnaire);

			
			tx.commit();
			return true;
		} catch (RuntimeException ex) {
			if (tx != null && tx.isActive()) {
				try {
					tx.rollback();
				} catch (HibernateException he) {
					System.err.println("Error rolling back transaction");
				}
				throw ex;
			}
			return false;
		}
	}

	public boolean updateQuestionnaire(int qid, Questionnaire questionnaire) {

		Transaction tx = null;
		try {
			tx = session.beginTransaction();

			Questionnaire ques = (Questionnaire) session.get(
					Questionnaire.class, qid);

			ques.setQuestionnaireName(questionnaire.getQuestionnaireName());
			ques.setQuestionnaireRelateTo(questionnaire
					.getQuestionnaireRelateTo());
			ques.setQuestionnaireRemarks(questionnaire
					.getQuestionnaireRemarks());
			ques.setQuestionnaireActive(questionnaire.getQuestionnaireActive());
			ques.setQuestionnaireLastUpdate(new Date());
			ques.setQuestionnaireLastUpdateUser(questionnaire
					.getQuestionnaireLastUpdateUser());
			 
			for (Question q : ques.questions) {
				Query query = session.createQuery("delete Answer where questionID=:q");
				query.setParameter("q", q);
				query.executeUpdate();
			}
			
			
			for (Question q : ques.questions) {
				session.delete(q);
			}
			
			ques.questions.clear();
			  
			for (Question q : questionnaire.questions) {
				q.setQuestionnaireID(ques);
				if(q.getQuestionID() == -1)
				{
					session.save(q);
				}
			}

			ques.setQuestions(questionnaire.getQuestions());

			session.update(ques);

			tx.commit();
			return true;
		} catch (Exception ex) {
			System.out.println("DB " + ex.getMessage());
			if (tx != null && tx.isActive()) {
				try {
					tx.rollback();
				} catch (HibernateException he) {
					System.err.println("Error rolling back transaction");
				}
				throw ex;
			}
			return false;
		}
	}

	public List<Questionnaire> getQuestionnaireList() {
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			Query query = session.createQuery("from Questionnaire");
			List<Questionnaire> questionnaireList = query.list();
			tx.commit();
			return questionnaireList;
		} catch (RuntimeException ex) {
			if (tx != null && tx.isActive()) {
				try {
					tx.rollback();
				} catch (HibernateException he) {
					System.err.println("Error rolling back transaction");
				}
				throw ex;
			}
			return null;
		}
	}

	public Questionnaire getQuestionnaire(int QID) {
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			Query query = session
					.createQuery("from Questionnaire where questionnaireID=:qid");
			query.setParameter("qid", QID);

			Questionnaire questionnaire = (Questionnaire) query.list().get(0);

			tx.commit();
			return questionnaire;

		} catch (RuntimeException ex) {
			if (tx != null && tx.isActive()) {
				try {
					tx.rollback();
				} catch (HibernateException he) {
					System.err.println("Error rolling back transaction");
				}
				throw ex;
			}
			return null;
		}
	}

	public List<Question> getQuestions(int qID) {
		Transaction tx = null;
		try {
			tx = session.beginTransaction();

			Questionnaire questionnaire = (Questionnaire) session.get(
					Questionnaire.class, qID);
			Query query = session
					.createQuery("from Question where questionnaireID=:questionnaireID");
			query.setParameter("questionnaireID", questionnaire);

			List<Question> questionList = query.list();
			tx.commit();
			return questionList;

		} catch (RuntimeException ex) {
			if (tx != null && tx.isActive()) {
				try {
					tx.rollback();
				} catch (HibernateException he) {
					System.err.println("Error rolling back transaction");
				}
				throw ex;
			}
			return null;
		}
	}

	public List<Questionnaire> getQuestionnaireByVisitType(String visitType) {
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			Query query = session
					.createQuery("from Questionnaire where questionnaireRelateTo=:visitType");
			query.setParameter("visitType", visitType);

			List<Questionnaire> questionnaireList = query.list();
			tx.commit();
			return questionnaireList;
		} catch (RuntimeException ex) {
			if (tx != null && tx.isActive()) {
				try {
					tx.rollback();
				} catch (HibernateException he) {
					System.err.println("Error rolling back transaction");
				}
				throw ex;
			}
			return null;
		}
	}

	AnswerSet answerSet = null;

	public boolean saveQuestionAnswer(int questionID, int visitID, int userID,
			String answerText) {

		Transaction tx = null;
		try {
			if (!session.isOpen())
				session = SessionFactoryUtil.getSessionFactory().openSession();

			tx = session.beginTransaction();

			Question question = (Question) session.get(Question.class,
					questionID);

			if (answerSet == null) {
				Visit visit = (Visit) session.get(Visit.class, visitID);
				Questionnaire questionnaire = (Questionnaire) session.get(
						Questionnaire.class, question.getQuestionnaireID()
								.getQuestionnaireID());

				answerSet = new AnswerSet();
				answerSet.setQuestionnaire(questionnaire);
				answerSet.setAnswerSetCreateDate(new Date());
				answerSet.setAnswerSetCreateUser(userID);
				answerSet.setAnswerSetLastUpDate(new Date());
				answerSet.setVisit(visit);
				session.save(answerSet);
			}

			Answer answer = new Answer();
			answer.setAnswerSetId(answerSet);
			answer.setQuestionID(question);
			answer.setAnswerText(answerText);

			session.save(answer);

			tx.commit();
			return true;
		} catch (RuntimeException ex) {

			if (tx != null && tx.isActive()) {
				try {
					tx.rollback();
				} catch (HibernateException he) {
					System.err.println("Error rolling back transaction");
				}
				throw ex;
			}
			return false;
		}
	}

	public boolean updateQuestionAnswer(int answerID, int userID,
			String answerText) {

		Transaction tx = null;
		try {
			if (!session.isOpen())
				session = SessionFactoryUtil.getSessionFactory().openSession();

			tx = session.beginTransaction();

			Answer answer = (Answer) session.get(Answer.class, answerID);

			answer.setAnswerText(answerText);

			session.update(answer);

			tx.commit();
			return true;
		} catch (RuntimeException ex) {

			if (tx != null && tx.isActive()) {
				try {
					tx.rollback();
				} catch (HibernateException he) {
					System.err.println("Error rolling back transaction");
				}
				throw ex;
			}
			return false;
		}
	}

	public List<Answer> getAnswers(int pid, int qid, int asetid) {
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			AnswerSet answerSet = (AnswerSet) session.get(AnswerSet.class,
					asetid);
			Query query = session
					.createQuery("from Answer where answerSetId=:answerSetId");
			query.setParameter("answerSetId", answerSet);

			List<Answer> answers = query.list();
			tx.commit();
			return answers;
		} catch (RuntimeException ex) {
			if (tx != null && tx.isActive()) {
				try {
					tx.rollback();
				} catch (HibernateException he) {
					System.err.println("Error rolling back transaction");
				}
				throw ex;
			}
			return null;
		}
	}
}
