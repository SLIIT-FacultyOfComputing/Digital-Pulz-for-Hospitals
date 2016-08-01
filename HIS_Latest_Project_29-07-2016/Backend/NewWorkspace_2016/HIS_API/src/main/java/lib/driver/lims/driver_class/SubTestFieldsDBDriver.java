package lib.driver.lims.driver_class;

import lib.SessionFactoryUtil;

import org.hibernate.HibernateException;
import org.hibernate.Query;
import org.hibernate.Session;
import org.hibernate.Transaction;

import java.util.Collection;
import java.util.List;

import core.classes.lims.Category;
import core.classes.lims.ParentTestFields;
import core.classes.lims.SpecimenRetentionType;
import core.classes.lims.SpecimenType;
import core.classes.lims.SubCategory;
import core.classes.lims.SubTestFields;
import core.classes.lims.TestFieldsRange;
import core.classes.lims.TestNames;
import core.classes.opd.OutPatient;

public class SubTestFieldsDBDriver {

	Session session = SessionFactoryUtil.getSessionFactory().openSession();
	
	public boolean addNewSubTestField(SubTestFields subtestfields) {

		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			session.save(subtestfields);
			
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
	
	/**
	 * This method retrieve a list of laboratory tests currently available in the system
	 * 
	 * @return lab test list List<TestNames>
	 * @throws Method
	 *             throws a {@link RuntimeException} in failing the return,
	 *             throws a {@link HibernateException} on error rolling back
	 *             transaction.
	 */
	public List<SubTestFields> getSubTestFieldsList() {
		Transaction tx = null;
		try {
			//catID = 2;
			tx = session.beginTransaction();
			Query query = session.createQuery("select s from SubTestFields s" );
			//query.setParameter("catID", catID);
			List<SubTestFields> subTestFieldsList = query.list();
			tx.commit();
			return subTestFieldsList;
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
	
	public SubTestFields getSubTestFieldByID(int id) {
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			Query query = session.createQuery("select s from SubTestFields s where s.sub_TestFieldID="+id);
			List<SubTestFields> subfieldList = query.list();
			if (subfieldList.size() == 0)
				return null;
			tx.commit();
			return (SubTestFields)subfieldList.get(0);
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
	

	public String getsubtestfieldID() {
		Transaction tx = null;
		try {
			
			tx = session.beginTransaction();
			Query query1 = session.createQuery("select max(sub_TestFieldID) from SubTestFields" );
			//query1.setParameter("testID", testObj);
			List list = query1.list();
			tx.commit();
			return list.get(0).toString();
		} catch (RuntimeException ex) {
			if (tx != null && tx.isActive()) {
				try {
					tx.rollback();
				} catch (HibernateException he) {
					System.err.println("Error rolling back transaction");
				}
				throw ex;
			}
			return "0";
		}
	}

	public SubTestFields addNewSubTestField(SubTestFields subtestfields, String idd) {
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			int id = Integer.parseInt(idd);
			ParentTestFields p = (ParentTestFields)session.get(ParentTestFields.class,id);
			subtestfields.setfPar_Test_FieldID(p);
			session.save(subtestfields);
			
			tx.commit();
			return subtestfields;
		} catch (RuntimeException ex) {
			if (tx != null && tx.isActive()) {
				try {
					System.out.println(ex.getMessage());
					tx.rollback();
				} catch (HibernateException he) {
					System.out.println(ex.getMessage());
				}
				throw ex;
			}
			return null;
		}
		
	}

	public List<SubTestFields> getSubTestFieldsList(int id) {
	
			Transaction tx = null;
			try {
				tx = session.beginTransaction();
				Query query = session.createQuery("select s from SubTestFields s where s.fPar_Test_FieldID="+id);
				List<SubTestFields> subfieldList = query.list();
				if (subfieldList.size() == 0)
					return null;
				tx.commit();
				return subfieldList;
			} catch (RuntimeException ex) {
				if (tx != null && tx.isActive()) {
					try {
						tx.rollback();
					} catch (HibernateException he) {
						System.out.print(he.getMessage());
						System.err.println("Error rolling back transaction");
					}
					throw ex;
				}
				return null;
			
		}
	}

	

}
