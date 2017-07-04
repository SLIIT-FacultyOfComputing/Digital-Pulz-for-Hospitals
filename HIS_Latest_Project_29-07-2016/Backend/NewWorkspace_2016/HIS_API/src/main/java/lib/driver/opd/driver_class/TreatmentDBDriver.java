package lib.driver.opd.driver_class;

import java.util.Date;
import java.util.List;

import lib.SessionFactoryUtil;

import org.hibernate.HibernateException;
import org.hibernate.Query;
import org.hibernate.Session;
import org.hibernate.Transaction;

import core.classes.api.user.AdminUser;
import core.classes.opd.Allergy;
import core.classes.opd.OpdTreatment;
import core.classes.opd.OutPatient;
import core.classes.opd.Treatment;
import core.classes.opd.Visit;

public class TreatmentDBDriver {

	Session session = SessionFactoryUtil.getSessionFactory().openSession();
	Transaction tx = null;
	
	public List<Treatment> getAllTreatment()
	{
		Query query = session.createQuery("from Treatment");

		@SuppressWarnings("unchecked")
		List<Treatment> treatmentList = query.list();

		return treatmentList;
	}
	
	public List<OpdTreatment> getOpdTreatmentsForVisit(int visitId)
	{
		Query query = session.createQuery("from OpdTreatment where visitId.visitID = "+visitId );

		@SuppressWarnings("unchecked")
		List<OpdTreatment> opdTreatmentList = query.list();

		return opdTreatmentList;
	}
	
	public List<OpdTreatment> getAllOpdTreatments()
	{
		Query query = session.createQuery("from OpdTreatment order by opdTreatmentId desc");
		
		@SuppressWarnings("unchecked")
		List<OpdTreatment> opdTreatmentList = query.list();

		return opdTreatmentList;
	}
	
	public boolean addOpdTreatment(OpdTreatment opdTreatment,int treatmentId,int visitId, int userId)
	{
		try {
			tx = session.beginTransaction();
			Treatment treatment = (Treatment) session.get(Treatment.class, treatmentId);
			Visit visit = (Visit) session.get(Visit.class, visitId);
			AdminUser user = (AdminUser) session.get(AdminUser.class, userId);
			opdTreatment.setCreateDate(new Date());
			opdTreatment.setCreateUser(user.getUserId().toString());
			opdTreatment.setVisitId(visit);
			
			opdTreatment.setTreatments(treatment);
				
			session.save(opdTreatment);
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
	
	public boolean updateOpdTreatment(OpdTreatment opdTreatment, int userId)
	{
		try {
			tx = session.beginTransaction();;
			OpdTreatment opdTreatmentDao = (OpdTreatment) session.get(OpdTreatment.class, opdTreatment.getOpdTreatmentId());
			
			opdTreatmentDao.setStatus(opdTreatment.getStatus());
			opdTreatmentDao.setRemarks(opdTreatment.getRemarks());
				
			AdminUser user = (AdminUser) session.get(AdminUser.class, userId);
			opdTreatmentDao.setLastUpDate(new Date());
			opdTreatmentDao.setLastUpDateUser(user.getUserId().toString());

			session.update(opdTreatmentDao);
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
