package lib.driver.hr.driver_class;

import java.util.List;

import lib.SessionFactoryUtil;

import org.hibernate.HibernateException;
import org.hibernate.Query;
import org.hibernate.Session;
import org.hibernate.Transaction;






import core.classes.hr.HrDepartment;
import core.classes.hr.HrEmployee;
import core.classes.hr.HrShifttimes;

public class HrShifttimesDBDriver {

	Session session=SessionFactoryUtil.getSessionFactory().openSession();
	
	public List<HrShifttimes> GetShitTimesByDept(String date, int dept) {
		//System.out.println(date);
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			
			HrDepartment deptO=(HrDepartment) session.get(HrDepartment.class, dept);
			
			//System.out.println("Nishaa"+deptO);
			Query query = session.createQuery("select shft.fromDatetime,shft.toDatetime,shft.shiftId from HrShifttimes shft  where (date(shft.fromDatetime)=date('"+date+"') or date(shft.toDatetime)=date('"+date+"')) and shft.hrDepartment.deptId='"+dept+"' order by shft.shiftId ASC");
			//Query query = session.createQuery("select s.shiftId, s.to, s.from  from AdminShifttimes s");
			List<HrShifttimes> shiftList = query.list();
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

	public boolean SetShiftTime(int dept,HrShifttimes shift) {
		Transaction tx=null;
		
		try {
			tx= session.beginTransaction();
			
			HrDepartment deptO=(HrDepartment) session.get(HrDepartment.class, dept);
			
			shift.setHrDepartment(deptO);
			
			session.save(shift);
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

	

}
