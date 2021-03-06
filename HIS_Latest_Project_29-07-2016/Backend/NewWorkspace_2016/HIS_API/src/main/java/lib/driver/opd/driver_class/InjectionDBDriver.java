package lib.driver.opd.driver_class;

import java.util.Date;
import java.util.List;

import lib.SessionFactoryUtil;

import org.hibernate.HibernateException;
import org.hibernate.Query;
import org.hibernate.Session;
import org.hibernate.Transaction;

import core.classes.api.user.AdminUser;
import core.classes.opd.Injection;
import core.classes.opd.OpdInjection;
import core.classes.opd.Visit;

public class InjectionDBDriver {

	Session session = SessionFactoryUtil.getSessionFactory().openSession();
	Transaction tx = null;
	
	public List<Injection> getAllInjection()
	{
		Query query = session.createQuery("from Injection");

		@SuppressWarnings("unchecked")
		List<Injection> injectionList = query.list();

		return injectionList;
	}
	
	public List<OpdInjection> getOpdInjectionsForVisit(int visitId)
	{
		Query query = session.createQuery("from OpdInjection where visitId.visitID = "+visitId );

		@SuppressWarnings("unchecked")
		List<OpdInjection> opdInjectionList = query.list();

		return opdInjectionList;
	}
	
	public List<OpdInjection> getAllOpdInjections()
	{
		Query query = session.createQuery("from OpdInjection order by opdInjectionId desc");
		
		@SuppressWarnings("unchecked")
		List<OpdInjection> opdInjectionList = query.list();

		return opdInjectionList;
	}
	
	public boolean addOpdInjection(OpdInjection opdInjection,int injectionId,int visitId, int userId)
	{
		try {
			tx = session.beginTransaction();
			Injection injection = (Injection) session.get(Injection.class, injectionId);
			Visit visit = (Visit) session.get(Visit.class, visitId);
			AdminUser user = (AdminUser) session.get(AdminUser.class, userId);
			opdInjection.setCreateDate(new Date());
			opdInjection.setCreateUser(user.getUserId().toString());
			opdInjection.setVisitId(visit);
			
			opdInjection.setInjectionId(injection);
				
			session.save(opdInjection);
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
			else if(tx == null)
			{
				throw ex;
			}
			else
			{
				return false;
			}
		}
	}
	
	public boolean updateOpdInjection(OpdInjection opdInjection, int userId)
	{
		try {
			tx = session.beginTransaction();
			OpdInjection opdInjectionDao = (OpdInjection) session.get(OpdInjection.class, opdInjection.getOpdInjectionId());
			
			opdInjectionDao.setStatus(opdInjection.getStatus());
			opdInjectionDao.setRemarks(opdInjection.getRemarks());
				
			AdminUser user = (AdminUser) session.get(AdminUser.class, userId);
			opdInjectionDao.setLastUpDate(new Date());
			opdInjectionDao.setLastUpDateUser(user.getUserId().toString());
			opdInjectionDao.setCompleteById(user.getUserId());
			opdInjectionDao.setCompleteDate(new Date());

			session.update(opdInjectionDao);
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
			else if(tx == null)
			{
				throw ex;
			}
			else
			{
				return false;
			}
		}
	}
}
