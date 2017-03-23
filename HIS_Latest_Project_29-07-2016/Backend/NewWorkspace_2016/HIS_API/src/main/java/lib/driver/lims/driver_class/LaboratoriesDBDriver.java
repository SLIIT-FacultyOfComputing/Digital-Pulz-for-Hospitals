package lib.driver.lims.driver_class;

import lib.BaseDaoImpl;
import lib.SessionFactoryUtil;

import org.hibernate.HibernateException;
import org.hibernate.Query;
import org.hibernate.Session;
import org.hibernate.Transaction;

import java.util.List;

import core.classes.api.user.AdminUser;
import core.classes.lims.LabDepartments;
import core.classes.lims.LabTypes;
import core.classes.lims.Laboratories;


public class LaboratoriesDBDriver extends BaseDaoImpl {

	Session session = SessionFactoryUtil.getSessionFactory().openSession();
	
	public boolean insertNewLab(Laboratories lab, int labTypeID, int labDepartmentID, int userid) {

		Transaction tx = null;
		try {
			//tx = session.beginTransaction();
			tx = SetSession();
			
		
			LabTypes lLabType = (LabTypes)get(LabTypes.class, labTypeID);//(LabTypes)session.get(LabTypes.class, labTypeID);
			LabDepartments lDeptsType = (LabDepartments)get(LabDepartments.class, labDepartmentID);
			
			AdminUser user = (AdminUser) get(AdminUser.class, userid);
			
			lab.setFlabType_ID(lLabType);
			lab.setFlabDept_ID(lDeptsType);
			
			lab.setFlabLast_UpdatedUserID(user);
			lab.setFlab_AddedUserID(user);
	
			save(lab);//session.save(lab);
			CloseSession(tx);//tx.commit();
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
			else if (tx==null)
			{
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
	public List<Laboratories> getNewLabsList() {
		Transaction tx = null;
		try {
			//catID = 2;
			tx = SetSession();
			Query query = session.createQuery("select l from Laboratories l" );
			//query.setParameter("catID", catID);
			List<Laboratories> labList = query.list(); // getAll(Laboratories.class);
			tx.commit();
			return labList;
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
	
	public Laboratories getLabID(int id) {
		Transaction tx = null;
		try {
			tx = SetSession();
			//Query query = session.createQuery("select l from Laboratories l where l.lab_ID="+id);
			Laboratories lab = (Laboratories)get(Laboratories.class, id);//query.list();
			if (lab == null)
				return null;
			CloseSession(tx);;
			return lab;
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
	

	public List<Laboratories> getLaboratoriesByLabType(int typeID) {
		Transaction tx = null;
		try {

			tx = SetSession();
			//Query query = session.createQuery("select t from LabTypes as t where t.labType_ID=:typeID");
			//query.setParameter("typeID", typeID);
			///List<LabTypes> testList = query.list();
			LabTypes catObject=(LabTypes)get(LabTypes.class, typeID);//testList.get(0);
			tx.commit();

			tx = SetSession();
			Query query1 = session.createQuery("select l from Laboratories as l where l.flabType_ID=:catObj");
			query1.setParameter("catObj", catObject);
			List<Laboratories> testList1 = query1.list();
			CloseSession(tx);
			return testList1;
			
			
			
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

	
	public boolean updateLaboratories(int labID, Laboratories lab,int labTypeID, int labDepartmentID, int userid) {
		Transaction tx = null;
		try {
			tx = SetSession();
			Laboratories labs = (Laboratories) get(Laboratories.class,labID);
			LabTypes lLabType = (LabTypes) get(LabTypes.class, labTypeID);
			LabDepartments lDeptsType = (LabDepartments) get(LabDepartments.class, labDepartmentID);
					
			
			labs.setLab_Name(lab.getLab_Name());
			
			labs.setLab_Incharge(lab.getLab_Incharge());
			labs.setLocation(lab.getLocation());
			labs.setFlabType_ID(lLabType);
			labs.setFlabDept_ID(lDeptsType);
			labs.setLab_Dept_Count(lab.getLab_Dept_Count());
			labs.setEmail(lab.getEmail());
			labs.setContactNumber1(lab.getContactNumber1());
			labs.setContactNumber2(lab.getContactNumber2());
			labs.setFlab_AddedUserID(lab.getFlab_AddedUserID());
			labs.setLab_AddedDate(lab.getLab_AddedDate());
			
			AdminUser user = (AdminUser) get(AdminUser.class, userid);
			labs.setFlabLast_UpdatedUserID(user);
			labs.setLab_LastUpdatedDate(lab.getLab_LastUpdatedDate());
			

			merge(labs);
			//session.update(labs);
			CloseSession(tx);//tx.commit();
			return true;
		} catch (Exception ex) {
			System.out.println(ex.getMessage());
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

	
	public boolean DeleteLab(int LabID) {
		// TODO Auto-generated method stub
		Transaction tx = null;
		//boolean status=false;
		
		try{
			Laboratories lab=new Laboratories();
			lab.setLab_ID(LabID);
			
			
					
			
			System.out.println("Deleting Item ");
			tx = SetSession();
			Object object = get(Laboratories.class, LabID);
			Laboratories deleteLab = (Laboratories) object;	
			delete(deleteLab);
			CloseSession(tx);
			
		}
		catch(Exception e)
		{
			e.printStackTrace();
			throw e;
		}
		return true;
	}

}
