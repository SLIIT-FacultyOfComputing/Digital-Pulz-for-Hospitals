package lib.driver.hr.driver_class;

import java.util.List;

import lib.SessionFactoryUtil;

import org.hibernate.HibernateException;
import org.hibernate.Query;
import org.hibernate.Session;
import org.hibernate.Transaction;

import core.classes.hr.HrAssignschedule;

//import core.classes.hr.AdminAssignschedule;
//import core.classes.hr.AdminAssignscheduleId;


public class HrAssignscheduleDBDriver {
	
	Session session=SessionFactoryUtil.getSessionFactory().openSession();

	public List<HrAssignschedule> GetEmployeeAllocactions(int empID, int shiftID) {
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			Query query = session.createQuery("select a.id.empId as empID,a.id.shiftId as shiftID from HrAssignschedule a where a.id.empId='"+empID+"' and a.id.shiftId= '"+shiftID+"' and  a.id.empId!=1");
			
			List<HrAssignschedule> shiftList = query.list();
			tx.commit();
			return shiftList;
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

	

	public boolean InsertEmployeeAllocation(HrAssignschedule schedule) {
		Transaction tx=null;
		
		try {
			tx= session.beginTransaction();
			session.save(schedule);
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



	public boolean DeleteEmployeeAllocation(HrAssignschedule schedule) {
		
		Transaction tx=null;
		
		try {
				
				//System.out.println("Nisha : "+schedule.toString());
				tx=session.beginTransaction();
				session.delete(schedule);
				tx.commit();
				return true;	
			}
		
		catch (RuntimeException ex) {
			if(tx != null && tx.isActive()){
				try{
					tx.rollback();
				}catch(HibernateException he){
					System.err.println("Error rolling back transaction");
				}
				throw ex;
			}
			return false;
		}
	}



	public List<HrAssignschedule> GetEmployeeSchedule(int empID) {
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			Query query = session.createQuery("from HrAssignschedule a where a.id.empId='"+empID+"'");
			
			List<HrAssignschedule> shiftList = query.list();
			tx.commit();
			return shiftList;
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



	public List<HrAssignschedule> GetEmployeeSchedule(int empID,String fromDate, String toDate) {
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			//Query query = session.createQuery("from HrAssignschedule a where a.id.empId='"+empID+"' and (date(shft.fromDatetime)=date('"+fromDate+"') or date(shft.toDatetime)=date('"+toDate+"'))");
			Query query = session.createQuery("from HrAssignschedule a where a.id.empId='"+empID+"' and (date(a.hrShifttimes.fromDatetime)>=date('"+fromDate+"') and date(a.hrShifttimes.toDatetime)<=date('"+toDate+"'))");
			List<HrAssignschedule> shiftList = query.list();
			tx.commit();
			return shiftList;
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
		}	}

}
