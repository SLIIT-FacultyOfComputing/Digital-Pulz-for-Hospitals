package lib.driver.pharmacy.driver_class;

import java.util.Iterator;
import java.util.List;

import lib.SessionFactoryUtil;

import org.hibernate.HibernateException;
import org.hibernate.Query;
import org.hibernate.Session;
import org.hibernate.Transaction;








import core.classes.pharmacy.MstDrugsNew;
import core.classes.pharmacy.PhramacyAssitanceStock;
import core.classes.pharmacy.TrnRequestDrugs;

public class PharmacyDBDriver {
	Session session = SessionFactoryUtil.getSessionFactory().openSession();
	Transaction tx;
	public Boolean insertDrug(PhramacyAssitanceStock d)
    {
		Boolean status = false;
		try {
			tx = session.beginTransaction();
			PhramacyAssitanceStock pas=(PhramacyAssitanceStock)session.get(PhramacyAssitanceStock.class, d.getDrug_srno());
			if(pas != null){
				pas.setDrugQty(pas.getDrugQty()+d.getDrugQty());
				session.saveOrUpdate(pas);
			}
			else
			{
				session.save(d);
			}
			tx.commit();
			
			status = true;

		} catch (HibernateException e) {
			status = false;
			if (tx != null) {
				tx.rollback();
				e.printStackTrace();
			}
		} catch (Exception ex) {
			System.out.println(ex.getMessage());
		} finally {
			//session.close();
		}
		return status;
    }
   @SuppressWarnings("unchecked")
public boolean MainStock(PhramacyAssitanceStock pas) {
	   boolean  status=false;
	
	   try{
		   tx=session.beginTransaction();
		   MstDrugsNew MDN=(MstDrugsNew)session.get(MstDrugsNew.class, pas.getDrug_srno());
		   MDN.setdQty(MDN.getdQty()-pas.getDrugQty());
		   session.saveOrUpdate(MDN);
		   status =true;
		   tx.commit();
	   }
	   catch(HibernateException e){
			status = false;
				if (tx != null) {
					tx.rollback();
					e.printStackTrace();
				}
		   	}
		   catch (Exception ex) {
			   status=false;
				System.out.println(ex.getMessage());
			}
	   return status;
   }
   public boolean DeleteRequsetDrug(int reqid) {
	   boolean  status=false;
	
	   try{
		   tx=session.beginTransaction();
		   TrnRequestDrugs MDN=(TrnRequestDrugs)session.get(TrnRequestDrugs.class, reqid);
		   MDN.setProcessed(true);
		   session.saveOrUpdate(MDN);
		   status =true;
		   tx.commit();
	   }
	   catch(HibernateException e){
			status = false;
				if (tx != null) {
					tx.rollback();
					e.printStackTrace();
				}
		   	}
		   catch (Exception ex) {
			   status=false;
				System.out.println(ex.getMessage());
			}
	   return status;
   }
   
   
	@SuppressWarnings("unchecked")
	public List<PhramacyAssitanceStock> getDrugStockTable() throws Exception {
		List<PhramacyAssitanceStock> details = null;
		try {
			tx = session.beginTransaction();
			details = session.createQuery("FROM PhramacyAssitanceStock").list();
			
			tx.commit();

		} catch (HibernateException e1) {
			if (tx != null) {
				tx.rollback();
				e1.printStackTrace();
			}
		} finally {
			// session.close();
		}
		return details;
	}

}

