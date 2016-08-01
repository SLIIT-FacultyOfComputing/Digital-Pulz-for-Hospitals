package lib.driver.inward.driver_class.charts;

import java.util.List;

import lib.SessionFactoryUtil;
import lib.classes.CasttingMethods.CastList;

import org.hibernate.HibernateException;
import org.hibernate.Query;
import org.hibernate.Session;
import org.hibernate.Transaction;



import core.classes.api.user.AdminUser;
import core.classes.inward.WardAdmission.Admission;
import core.classes.inward.charts.LiquidBalanceChart;
import core.classes.inward.prescription.PrescriptionTerms;

public class LiquidBalanceChartDBDriver {

Session session = SessionFactoryUtil.getSessionFactory().openSession();
	
	public List<LiquidBalanceChart> getChartValues() {
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			Query query = session.createQuery("select d from LiquidBalanceChart as d");
			@SuppressWarnings("unchecked")
			List<LiquidBalanceChart> chartvalues = query.list();
			tx.commit();
			return chartvalues;
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
		// TODO Auto-generated method stub
	}
	public List<LiquidBalanceChart> getLiquidBalanceChartByBHTNo(String bhtNo) {
		Transaction tx = null;
		
		try{
			tx = session.beginTransaction();
			Query query =  session.createQuery("select i from LiquidBalanceChart as i where i.bhtNo.bhtNo=:bhtNo");
			query.setParameter("bhtNo", bhtNo);
			List<LiquidBalanceChart> list =CastList.castList(LiquidBalanceChart.class, query.list()); 
			tx.commit();
			return list;
			
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
	
	public boolean addNewchartDetails(LiquidBalanceChart term, String bhtNo) {

		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			
			
											
			Admission bht=(Admission) session.get(Admission.class, bhtNo);
			term.setBhtNo(bht);
						
			session.save(term);
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
