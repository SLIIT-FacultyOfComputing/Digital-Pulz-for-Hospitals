package lib.driver.inward.driver_class.charts;

import java.util.List;

import lib.SessionFactoryUtil;
import lib.classes.CasttingMethods.CastList;

import org.hibernate.HibernateException;
import org.hibernate.Query;
import org.hibernate.Session;
import org.hibernate.Transaction;

import core.classes.inward.WardAdmission.Admission;
import core.classes.inward.charts.DiabeticChart;
import core.classes.inward.charts.LiquidBalanceChart;


public class DiabeticChartDBDriver {

Session session = SessionFactoryUtil.getSessionFactory().openSession();
	
	public List<DiabeticChart> getChartValues() {
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			Query query = session.createQuery("select d from DiabeticChart as d");
			@SuppressWarnings("unchecked")
			List<DiabeticChart> chartvalues = query.list();
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
			else if(tx == null)
			{
				throw ex;
			}
			else
			{
				return null;
			}
		}
		// TODO Auto-generated method stub
	}
	
	public List<DiabeticChart> getDiabeticChartByBHTNo(String bhtNo) {
		Transaction tx = null;
		
		try{
			tx = session.beginTransaction();
			Query query =  session.createQuery("select i from DiabeticChart as i where i.bhtNo.bhtNo=:bhtNo");
			query.setParameter("bhtNo", bhtNo);
			List<DiabeticChart> list =CastList.castList(DiabeticChart.class, query.list()); 
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
			else if(tx == null)
			{
				throw ex;
			}
			else
			{
				return null;
			}
		}
	}
	public boolean addNewDiabeticchartDetails(DiabeticChart term, String bhtNo) {

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
			else if(tx == null)
			{
				throw ex;
			}
			else
			{
				return false;
			}
		}
	
}}
