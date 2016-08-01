package lib.driver.inward.driver_class.transfer;

import java.util.List;

import lib.SessionFactoryUtil;

import org.hibernate.HibernateException;
import org.hibernate.Query;
import org.hibernate.Session;
import org.hibernate.Transaction;

import lib.classes.CasttingMethods.CastList;
import core.classes.api.user.AdminUser;

import core.classes.inward.WardAdmission.Admission;
import core.classes.inward.admin.Ward;
import core.classes.inward.transfer.InternalTransfer;

public class InternalTransferDBDriver {
	Session session = SessionFactoryUtil.getSessionFactory().openSession();
	
	/*public List<InternalTransfer> getAllInternalTransfers(){
		
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			Query query = session.createQuery("select i from InternalTransfer as i");
			@SuppressWarnings("unchecked")
			List<InternalTransfer> transfers = query.list();
			tx.commit();
			return transfers;
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
	*/
	public boolean insertTransfer(InternalTransfer transfer,String bhtno,String toward,String fromword,int userId) {

		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			
			Admission bht = (Admission) session.get(Admission.class, bhtno);
			transfer.setBhtNo(bht);
			
			Ward towardobj = (Ward) session.get(Ward.class, toward);
			transfer.setTransferWard(towardobj);
			
			Ward fromwardobj = (Ward) session.get(Ward.class, fromword);
			transfer.setTransferFromWard(fromwardobj);
			
			AdminUser creuser = (AdminUser) session.get(AdminUser.class, userId);
			transfer.setTransferCreatedUser(creuser);
			
			transfer.setRead(0);
			
			session.save(transfer);
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
	
	public List<InternalTransfer> getInternalTransferByID(String transferId){
		Transaction tx = null;
		
		try{
			tx = session.beginTransaction();
			Query query =  session.createQuery("select i from InternalTransfer as i where i.transferId=:transferId");
			query.setParameter("transferId", transferId);
			List<InternalTransfer> transferList =CastList.castList(InternalTransfer.class, query.list()); 
			tx.commit();
			return transferList;
			
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
	
	public boolean updateInternalTransferDetails(int id,String newbht){
	Transaction tx=null;
	
	try{
		
		tx=session.beginTransaction();
		Admission bht = (Admission) session.get(Admission.class, newbht);		
		
		String hql = "UPDATE InternalTransfer set read = 1,new_bht_no=:newbht "  + 
	             "WHERE transferId = :transferId";
				Query query = session.createQuery(hql);
				query.setParameter("newbht", bht);
				query.setParameter("transferId", id);
		query.executeUpdate();
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
public List<InternalTransfer> getNotReadInternalTransferByWard(String wardNo){
	Transaction tx = null;
	
	try{
		tx = session.beginTransaction();
		Query query =  session.createQuery("select i from InternalTransfer as i where i.transferWard.wardNo=:wardNo and i.read = 0");
		query.setParameter("wardNo", wardNo);
		List<InternalTransfer> transferList =CastList.castList(InternalTransfer.class, query.list()); 
		tx.commit();
		return transferList;
		
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

public List<InternalTransfer> getInternalTransferByBHTNo(String bhtNo){
	Transaction tx = null;
	
	try{
		tx = session.beginTransaction();
		Query query =  session.createQuery("select i from InternalTransfer as i where i.bhtNo.bhtNo=:bhtNo ");
		query.setParameter("bhtNo", bhtNo);
		List<InternalTransfer> transferList =CastList.castList(InternalTransfer.class, query.list()); 
		tx.commit();
		return transferList;
		
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

public List<InternalTransfer> getInternalTransferByID(int  transferId){
	Transaction tx = null;
	
	try{
		tx = session.beginTransaction();
		Query query =  session.createQuery("select i from InternalTransfer as i where i.transferId=:transferId");
		query.setParameter("transferId", transferId);
		List<InternalTransfer> transferList =CastList.castList(InternalTransfer.class, query.list()); 
		tx.commit();
		return transferList;
		
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
}
