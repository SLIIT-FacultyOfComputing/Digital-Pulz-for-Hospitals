package lib.driver.opd.driver_class;

import java.text.DateFormat;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Calendar;
import java.util.Collection;
import java.util.Date;
import java.util.HashMap;
import java.util.Iterator;
import java.util.LinkedHashMap;
import java.util.List;
import java.util.Map;
import java.util.TreeSet;








import lib.SessionFactoryUtil;
import lib.driver.api.driver_class.user.UserDBDriver;
import lib.driver.hr.driver_class.HrAttendanceDBDriver;

import org.hibernate.HibernateException;
import org.hibernate.Query;
import org.hibernate.Session;
import org.hibernate.Transaction;

import core.classes.api.user.AdminUser;
import core.classes.hr.HrAttendance;
import core.classes.hr.HrEmployee;
import core.classes.opd.OutPatient;
import core.classes.opd.Queue;
import core.classes.opd.Visit;
import core.resources.api.user.UserResource;
import core.resources.opd.QueueResource;
import core.resources.opd.QueueResource.QueueStatus;

public class QueueDBDriver {

	Session session = SessionFactoryUtil.getSessionFactory()
			.getCurrentSession();

	public boolean addToQueue(Queue queue, int pID, int assignedBy,
			int emp) {
		Transaction tx = null;

		try {
		
			if(!session.isOpen())  session = SessionFactoryUtil.getSessionFactory()
					.openSession();
			
			tx = session.beginTransaction();
					
			OutPatient patient = (OutPatient) session
					.get(OutPatient.class, pID);
			AdminUser uassignedBy = (AdminUser) session.get(AdminUser.class, assignedBy);
			AdminUser uassigned = (AdminUser) session.get(AdminUser.class, emp);

			int id=uassigned.getHrEmployee().getEmpId();
			
			HrEmployee hremp = (HrEmployee)session.get(HrEmployee.class,id);
			//------------------------------------------------------------------------
			

 
			Query query1 = session
					.createQuery("from AdminUser as a where (a.hrEmployee = :emp)");

			query1.setParameter("emp", hremp);
			
			List<AdminUser> v = query1.list();
			AdminUser user = v.get(0);
			
			
			
			
			//------------------------------------------------------------------------
			
			QueueResource.lastAssignedDcotor = emp;

			//get the max token id and increment it according to the date
			
			//------------------------------------
			DateFormat dateFormat = new SimpleDateFormat("yyyy-MM-dd HH:mm:ss");
			Date date = new Date();
			
			System.out.print(user.getUserId());
			System.out.print(user.getUserName());
			System.out.print(user.getPassword());
			System.out.print(user.getHrEmployee());
			
			
			System.out.println(dateFormat.format(date)); //2014/08/06 15:59:48
			String arr[] = dateFormat.format(date).split(" ");
			
			String d = arr[0];
			int t = 0;
			
			try{
			Query query = session.createQuery("select max(q.queueTokenNo) from Queue as q where q.queueTokenAssignTime like :p");
	        query.setString("p","%"+d+"%");
			
	    
	        t=(int) query.list().get(0);
			t++;
			}
			catch(Exception e)
			{
				t=1;
			}
			
			//-------------------------------------------
			queue.setPatient(patient);
			queue.setQueueTokenNo(t);
			
			
			
			queue.setQueueAssignedBy(uassignedBy);
			queue.setQueueAssignedTo(user);

			session.save(queue);
			tx.commit();
			return true;
		} catch (Exception ex) {
			System.err.println(ex.getMessage());
			if (tx != null && tx.isActive()) {
				try {
					tx.rollback();
					System.out.println(ex.getMessage());
				} catch (HibernateException he) {
					System.err.println("Error rolling back transaction");
				}
				throw ex;
			}else if(tx == null)
			{
				throw ex;
			}
			else{
			return false;
			}
		}

	}

	public int checkInPatient(int patientID) {
		Transaction tx = null;
		try {
			tx = session.beginTransaction();

		/*	Queue q = (Queue) session.get(Queue.class, P);
			q.setQueueStatus("In");
			session.update(q);*/
			OutPatient patient = (OutPatient) session.get(OutPatient.class,
					patientID);
				
			Query query = session.createQuery("from Queue where patient=:p");
			query.setParameter("p", patient);

			//get the patient rows according to the specific person from the db and update the last one.
			int c = query.list().size();
			c=c-1;
			Queue q = (Queue) query.list().get(c);
			q.setQueueStatus("In");
			 
			session.update(q);
			
		
			  
			tx.commit();
			return 1;
			
		

		} catch (RuntimeException ex) {
			if (tx != null && tx.isActive()) {
				try {
					tx.rollback();
				} catch (HibernateException he) {
					System.err.println("Error rolling back transaction");
				}
				throw ex;
			}else if(tx == null)
			{
				throw ex;
			}
			else{
			return 0;
			}
		}
	}

	public int checkoutPatient(int patientID) {
		Transaction tx = null;
		try {
			tx = session.beginTransaction();

			OutPatient patient = (OutPatient) session.get(OutPatient.class,
					patientID);
			Query query = session.createQuery("from Queue where patient=:p");
			query.setParameter("p", patient);

			//get the patient rows according to the specific person from the db and update the last one.
			int c = query.list().size();
			c=c-1;
			Queue q = (Queue) query.list().get(c);
			q.setQueueStatus("Delete");
			 
			session.update(q);
			
		
			  
			tx.commit();
			return 1;

		} catch (RuntimeException ex) {
			if (tx != null && tx.isActive()) {
				try {
					tx.rollback();
				} catch (HibernateException he) {
					System.err.println("Error rolling back transaction");
				}
				throw ex;
			}else if(tx == null)
			{
				throw ex;
			}
			else{
			return 0;
			}
		}
	}

	public List<Queue> getQueuePatientsByUserID(int userID) {
		Transaction tx = null;
		try {
			if(!session.isOpen())  session = SessionFactoryUtil.getSessionFactory()
					.openSession();
			tx = session.beginTransaction();
		
			
			Query query = session
					.createQuery("from Queue where queueAssignedTo=:userID AND queueStatus!='Delete'");
			AdminUser user = (AdminUser) session.get(AdminUser.class, userID);
			query.setParameter("userID", user);

			List<Queue> queueRecord = castList(Queue.class, query.list());
			tx.commit();
			return queueRecord;

		} catch (RuntimeException ex) {
			if (tx != null && tx.isActive()) {
				try {
					tx.rollback();
				} catch (HibernateException he) {
					System.err.println("Error rolling back transaction");
				}
				throw ex;
			}else if(tx == null)
			{
				throw ex;
			}
			else{
			return null;
			}
		}
	}

	
	public List<Queue> getQueuePatientsByDoctorID(int doctorID) {
		Transaction tx = null;
		try {
			if(!session.isOpen())  session = SessionFactoryUtil.getSessionFactory()
					.openSession();
			tx = session.beginTransaction();
			Query query = session
					.createQuery("from AdminUser as a where a.hrEmployee.empId="+doctorID);
			AdminUser user = (AdminUser) castList(AdminUser.class, query.list()).get(0);
			Query query2 = session
					.createQuery("from Queue where queueAssignedTo=:userID AND queueStatus!='Delete'");
			
			query2.setParameter("userID", user);

			List<Queue> queueRecord = castList(Queue.class, query2.list());
			tx.commit();
			return queueRecord;

		} catch (RuntimeException ex) {
			if (tx != null && tx.isActive()) {
				try {
					tx.rollback();
				} catch (HibernateException he) {
					System.err.println("Error rolling back transaction");
				}
				throw ex;
			}else if(tx == null)
			{
				throw ex;
			}
			else{
			return null;
			}
		}
	}
	
	public Queue isPatientInQueue(int patientID) {
		Transaction tx = null;
		try {
			tx = session.beginTransaction();

			OutPatient patient = (OutPatient) session.get(OutPatient.class,
					patientID);
			Query query = session
					.createQuery("from Queue as q where (q.patient=:patient AND (queueStatus='Waiting' OR queueStatus='In'))");
			query.setParameter("patient", patient);
			
			Queue q = null;
			if(query.list().size() > 0)
				q = (Queue) query.list().get(0);
			
			tx.commit();
			return q;
		} catch (RuntimeException ex) {
			if (tx != null && tx.isActive()) {
				try {
					tx.rollback();
				} catch (HibernateException he) {
					System.err.println("Error rolling back transaction");
				}
				throw ex;
			}else if(tx == null)
			{
				throw ex;
			}
			else{
			return null;
			}
		}
	}

	public Queue getCurrentInPatient(int doctor) {
		Transaction tx = null;
		try {
			tx = session.beginTransaction();

			AdminUser user = (AdminUser) session.get(AdminUser.class, doctor);
			Query query = session
					.createQuery("from Queue as q where (q.queueAssignedTo=:user AND q.queueStatus='In')");
			query.setParameter("user", user);//AdminUser - changed to user
			Queue q = null;
			
			if(query.list().size() > 0)
			{
				q = (Queue) query.list().get(0);
			}
			
			tx.commit();
			return q;
		} catch (RuntimeException ex) {
			if (tx != null && tx.isActive()) {
				try {
					tx.rollback();
				} catch (HibernateException he) {
					System.err.println("Error rolling back transaction");
				}
				throw ex;
			}else if(tx == null)
			{
				throw ex;
			}
			else{
			return null;
			}
		}
	}

	public List<Queue> getTreatedPatients(int userID) {
		Transaction tx = null;
		try {
			tx = session.beginTransaction();

			Query query = session
					.createQuery("from Queue where (queueAssignedTo=:AdminUser AND queueStatus='Delete')");
			AdminUser user = (AdminUser) session.get(AdminUser.class, userID);
			query.setParameter("AdminUser", user);
			List<Queue> queueRecord = castList(Queue.class, query.list());
			tx.commit();
			return queueRecord;

		} catch (RuntimeException ex) {
			if (tx != null && tx.isActive()) {
				try {
					tx.rollback();
				} catch (HibernateException he) {
					System.err.println("Error rolling back transaction");
				}
				throw ex;
			}else if(tx == null)
			{
				throw ex;
			}
			else{
			return null;
			}
		}
	}

	public int redirectQueue(int userID, int visitType) {
		Transaction tx = null;
		try {

			List<Queue> patientList = getQueuePatientsByUserID(userID);
 
			QueueResource.QueueStatus qs = new QueueResource.QueueStatus();
			qs.qStatus = 3;
			qs.user=userID;
			QueueResource.queueStatusList.add(qs); 
			

			if (!session.isOpen())
				session = SessionFactoryUtil.getSessionFactory().openSession();
			tx = session.beginTransaction();

			// delete all queue entries belong to this doctor
			AdminUser user = (AdminUser) session.get(AdminUser.class, userID); 
			
			String roleName="Doctor";
			DateFormat df = new SimpleDateFormat("yyyy-MM-dd");
			Date today = Calendar.getInstance().getTime();
			List<HrAttendance> attendenceList = new HrAttendanceDBDriver().getAllAttendanceByType(df.format(today), visitType);
			
			if(attendenceList.size() == 1)
			{
				return 0;
			}
			
			
			Query query = session
					.createQuery("delete Queue where (queueAssignedTo=:user AND queueStatus!='Delete')");
			query.setParameter("user", user);
			query.executeUpdate();
			tx.commit();
 
			QueueResource qr = new QueueResource();
		 
			Iterator ite =  patientList.iterator(); 
			while(ite.hasNext())
			{ 
				Queue q = (Queue) ite.next();
				addToQueue(q, q.getPatient().getPatientID(), q
								.getQueueAssignedBy().getUserId(),  qr.getNextAssignDoctorID( q.getPatient().getPatientID(), visitType)); 
			}
		  
			return 1; 
		} catch (Exception ex) {

			System.out.println("Error  HERE: " + ex.getMessage());

			if (tx != null && tx.isActive()) {
				try {
					tx.rollback();
				} catch (HibernateException he) {
					System.err.println("Error rolling back transaction");
				}
				throw ex;
			}else if(tx == null)
			{
				throw ex;
			}
			else{
			return 0;
			}
		}
	}

	public static <T> List<T> castList(Class<? extends T> clazz, Collection<?> c) {
		List<T> r = new ArrayList<T>(c.size());
		for (Object o : c)
			r.add(clazz.cast(o));
		return r;
	}

	

}
