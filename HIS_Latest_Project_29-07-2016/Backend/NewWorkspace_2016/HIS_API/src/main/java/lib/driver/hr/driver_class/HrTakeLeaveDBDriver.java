package lib.driver.hr.driver_class;

import java.rmi.dgc.Lease;
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.Date;
import java.util.List;
import java.util.concurrent.TimeUnit;

import lib.SessionFactoryUtil;
import lib.classes.CasttingMethods.CastList;

import org.hibernate.HibernateException;
import org.hibernate.Query;
import org.hibernate.Session;
import org.hibernate.Transaction;

import core.classes.api.user.AdminUser;
import core.classes.hr.HrEmployee;
import core.classes.hr.HrHasleaves;
import core.classes.hr.HrHasleavesId;
import core.classes.hr.HrLeavetype;
import core.classes.hr.HrTakeleaves;

public class HrTakeLeaveDBDriver {
Session session=SessionFactoryUtil.getSessionFactory().openSession();

	
	public boolean requestLeave(HrTakeleaves takeLeave){
		Transaction tx = null;
		try{	
			tx = session.beginTransaction();
			
			AdminUser user = (AdminUser) session.get(AdminUser.class, takeLeave.getHrEmployee().getEmpId());
			
			System.out.println(user.getHrEmployee().getEmpId());
			
			HrEmployee emp = (HrEmployee) session.get(HrEmployee.class, user.getHrEmployee().getEmpId());
			
			HrLeavetype hrLeavetype=(HrLeavetype) session.get(HrLeavetype.class, takeLeave.getHrLeavetype().getLeaveTypeId());
			
			System.out.println(hrLeavetype.getLeaveTypeId());
			
			takeLeave.setHrLeavetype(hrLeavetype);
			takeLeave.setHrEmployee(emp);
			takeLeave.setApprover(null);
			//takeLeave.setReason(hasLeave.getRemain());
			//leave.setTotal(hasLeave.getTotal());
			
		 
			session.save(takeLeave);
			
			
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
	
	
	public List<HrTakeleaves> getRequestLeaveDetails(){
		Transaction tx = null;
		
		try{
			tx = session.beginTransaction();
			Query query =  session.createQuery("select u from HrTakeleaves as u where u.approver = NULL");
			
			List<HrTakeleaves> userList =CastList.castList(HrTakeleaves.class, query.list()); 
			tx.commit();
			return userList;
			
		}
		catch(RuntimeException ex){
			if(tx != null && tx.isActive())
			{
				try{
					tx.rollback();
				}catch(HibernateException he){
					System.err.println("Error rolling back transaction");
				}
				throw ex;
			}
			return null;
		}
	}
	
	public List<HrTakeleaves> getRequestLeaveDetails(int empId,int status){
		Transaction tx = null;
		
		try{
			tx = session.beginTransaction();
			Query query =  session.createQuery("select u from HrTakeleaves as u where u.approver = NULL");
			
			if (status == 1) {
				
				query =  session.createQuery("select u from HrTakeleaves as u where u.approveStatus = 1");
				
			}else if (status == 0) {
				query =  session.createQuery("select u from HrTakeleaves as u where u.approveStatus = 0 AND u.approver != NULL");
				
			}
			
			List<HrTakeleaves> userList =CastList.castList(HrTakeleaves.class, query.list()); 
			tx.commit();
			return userList;
			
		}
		catch(RuntimeException ex){
			if(tx != null && tx.isActive())
			{
				try{
					tx.rollback();
				}catch(HibernateException he){
					System.err.println("Error rolling back transaction");
				}
				throw ex;
			}
			return null;
		}
	}
	
	public List<Object> getTakenLeaveCount(int empId){
		Transaction tx = null;
		
		try{
			tx = session.beginTransaction();
			Query query =  session.createQuery("select u.hrLeavetype.leaveTypeId,Count(u.hrLeavetype.leaveType) from HrTakeleaves as u where u.approveStatus = 1 AND u.hrEmployee.empId =:empId"
					+ "				Group by u.hrLeavetype.leaveTypeId, u.hrEmployee.empId");
			query.setParameter("empId", empId);
			List<Object> userList =CastList.castList(Object.class, query.list()); 
			tx.commit();
			return userList;
			
		}
		catch(RuntimeException ex){
			if(tx != null && tx.isActive())
			{
				try{
					tx.rollback();
				}catch(HibernateException he){
					System.err.println("Error rolling back transaction");
				}
				throw ex;
			}
			return null;
		}
	}
	
	
	public boolean updateRequestLeave(HrTakeleaves takeLeave) {
		Transaction tx = null;
		try{	
			tx = session.beginTransaction();
			
			HrTakeleaves  leave = (HrTakeleaves) session.get(HrTakeleaves.class, takeLeave.getId());
			
			HrEmployee emp = (HrEmployee) session.get(HrEmployee.class, takeLeave.getApprover().getEmpId());
			
			leave.setApprover(emp);
			
			leave.setApproveStatus(takeLeave.getApproveStatus());
			
			session.update(leave);
			
			String[] start= leave.getStartDatetime().split(" ");
			String[] end= leave.getEndDatetime().split(" ");
			
			System.out.println(start[0]);
			System.out.println(end[1]);
			
			SimpleDateFormat myFormat = new SimpleDateFormat("yyyy-MM-dd");

			
			System.out.println(leave.getEndDatetime().toString());
			System.out.println(leave.getStartDatetime());
			try {
			Date date1;
			
				date1 = (Date) myFormat.parse(start[0]);
			
		    Date date2 = (Date) myFormat.parse(end[0]);
		    long diff = date2.getTime() - date1.getTime();
		   
			
			//Long dates = Date.parse(leave.getEndDatetime().toString()) -  Date.parse(leave.getStartDatetime());
			
			System.out.println(diff);
			
			Long days = TimeUnit.DAYS.convert(diff, TimeUnit.MILLISECONDS);

			System.out.println(days);
			System.out.println(leave.getHrLeavetype().getLeaveTypeId());
			
			HrHasLeaveDBDriver hrHasLeaveDBDriver= new HrHasLeaveDBDriver();
			//hrHasLeaveDBDriver.updateRemainLeave(emp.getEmpId(),leave.getHrLeavetype().getLeaveTypeId(),days);
			
			} catch (ParseException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			}
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
}
