package lib.driver.hr.driver_class;

import java.util.List;

import lib.SessionFactoryUtil;

import org.hibernate.HibernateException;
import org.hibernate.Query;
import org.hibernate.Session;
import org.hibernate.Transaction;

import core.classes.api.user.AdminUser;
import core.classes.api.user.AdminUserroles;
import core.classes.hr.HrEmployee;
import core.classes.hr.HrHasleaves;
import core.classes.hr.HrHasleavesId;
import core.classes.hr.HrLeavetype;

public class HrHasLeaveDBDriver {
	Session session=SessionFactoryUtil.getSessionFactory().openSession();

	
	public boolean insertLeave(HrHasleaves hasLeave){
		Transaction tx = null;
		try{	
			tx = session.beginTransaction();
			
			HrHasleaves leave = new HrHasleaves();
			HrEmployee emp = (HrEmployee) session.get(HrEmployee.class, hasLeave.getHrEmployee().getEmpId());
			HrLeavetype hrLeavetype=(HrLeavetype) session.get(HrLeavetype.class, hasLeave.getHrLeavetype().getLeaveTypeId());
			leave.setHrLeavetype(hrLeavetype);
			leave.setHrEmployee(emp);
			leave.setRemain(hasLeave.getRemain());
			leave.setTotal(hasLeave.getTotal());
			
			HrHasleavesId leaveId = new HrHasleavesId();

			leaveId.setEmpId(emp.getEmpId());
			leaveId.setLeaveTypeId(hrLeavetype.getLeaveTypeId());

			leave.setId(leaveId);
			
		 
			session.save(leave);
			
			
			tx.commit();
			return true;
		}
		catch(RuntimeException ex){
			if(tx != null && tx.isActive())
			{
				try{
					tx.rollback();
				}
				catch(HibernateException he){
					System.err.println("Error rolling back transaction");
				}
				throw ex;
			}
			return false;
		}
	}
//	
//	public boolean updateRemainLeave( int empId, int type, long remain){
//		Transaction tx = null;
//		try{	
//			tx = session.beginTransaction();
//			
//			HrHasleaves hasLeave = new HrHasleaves();
//			
//			HrEmployee emp = (HrEmployee) session.get(HrEmployee.class, empId);
//			HrLeavetype hrLeavetype=(HrLeavetype) session.get(HrLeavetype.class, type);
//			
//			System.out.println(hrLeavetype.getLeaveTypeId());
//			
//			HrHasleavesId leaveId = new HrHasleavesId();
//
//			leaveId.setEmpId(emp.getEmpId());
//			leaveId.setLeaveTypeId(hrLeavetype.getLeaveTypeId());
//
//			
//			hasLeave.setId(leaveId);
//			
//
//			System.out.println(hasLeave.getId());
//			
//			
//			HrHasleaves leave = (HrHasleaves) session.get(HrHasleaves.class, hasLeave.getId());
//			
//			System.out.println(leave);
//			
//			leave.setHrLeavetype(hrLeavetype);
//			leave.setHrEmployee(emp);
//			leave.setRemain((int)remain);
//			
//			session.update(leave);
//			
//			tx.commit();
//			return true;
//		}
//		catch(RuntimeException ex){
//			if(tx != null && tx.isActive())
//			{
//				try{
//					tx.rollback();
//				}
//				catch(HibernateException he){
//					System.err.println("Error rolling back transaction");
//				}
//				throw ex;
//			}
//			return false;
//		}
//	}

}
