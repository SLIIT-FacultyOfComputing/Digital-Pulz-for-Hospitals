package lib.driver.hr.driver_class;

import java.io.File;
import java.io.FileInputStream;
import java.io.FileOutputStream;
import java.util.List;

import lib.SessionFactoryUtil;
import lib.classes.CasttingMethods.CastList;

import org.hibernate.HibernateException;
import org.hibernate.Query;
import org.hibernate.Session;
import org.hibernate.Transaction;

import core.classes.hr.HrDepartment;
import core.classes.hr.HrEmployee;
import core.classes.hr.HrEmployeeView;
import core.classes.hr.HrEmployeeViewId;
import core.classes.hr.HrWorkin;
import core.classes.hr.HrWorkinId;
import core.classes.hr.HrContact;
import core.classes.hr.HrContacttype;





public class HrEmployeeDBDriver {
	
	Session session=SessionFactoryUtil.getSessionFactory().openSession();
	Transaction tx = null;
	public List<HrEmployeeView> GetAllEmployees() {
		tx = session.beginTransaction();
//		Query query = session
//				.createQuery("select e.empId, e.firstName, e.lastName,e.birthday,e.gender, e.civilStatus, c.contact from HrEmployee e, HrContact c where e.empId=c.id.empId");
		
//		Query query = session
//				.createQuery("select e,c from HrEmployee e LEFT JOIN e.hrContacts.hrContacttype c");
//		
		Query query = session
				.createQuery("select "
						+ "v.id.empId,"
						+ "v.id.title,"
						+ "v.id.firstName,"
						+ "v.id.lastName,"
						+ "v.id.birthday,"
						+ "v.id.gender,"
						+ "v.id.civilStatus,"
						+ "v.id.address,"
						+ "v.id.phone,"
						+ "v.id.mobile,"
						+ "v.id.email,"
						+ "v.id.nic,"
						+ "v.id.epf,"
						+ "v.id.drivingLicence,"
						+ "v.id.deptName,"
						+ "v.id.designationName "
						+ "from HrEmployeeView v, HrEmployee e "
						+ "where e.empId=v.id.empId and v.id.empId !=1 and e.isActive=true");
		
		List<HrEmployeeView> empList= query.list();
		tx.commit();
		

		return empList;
	}

	
	public String InsertNewEmployee(HrEmployee emp) {
		Transaction tx=null;
		
		try {
			tx= session.beginTransaction();
			session.save(emp);
			
			String empID=emp.getEmpId().toString();
			
			tx.commit();
			return empID;
			
		} catch (RuntimeException ex) {
			if (tx != null && tx.isActive()) {
				try {
					tx.rollback();
				} catch (HibernateException he) {
					System.err.println("Error rolling back transaction");
				}
				throw ex;
			}
			return "false";
		}
		
	}

	public List<HrEmployee> GetEmployeesByDept(int dept) {
		
		Query query = session.createQuery("select e.empId,e.firstName,e.lastName from HrEmployee e, HrWorkin w  where e.empId=w.id.empId and w.id.deptId='"+dept+"' and e.empId!=1 order by e.firstName ASC");
		
		@SuppressWarnings("unchecked")
		List<HrEmployee> empList = query.list();

		return empList;
	}


	public boolean UpdateEmployee(HrEmployee emp) {
		Transaction tx=null;
		
		int empID=emp.getEmpId();
		
		
		try {
			//System.out.println(emp.getTitle());
			tx= session.beginTransaction();
			HrEmployee updateEmp=(HrEmployee) session.get(HrEmployee.class, empID);
			
			updateEmp.setFirstName(emp.getFirstName());
			updateEmp.setLastName(emp.getLastName());
			updateEmp.setBirthday(emp.getBirthday());
			updateEmp.setGender(emp.getGender());
			updateEmp.setCivilStatus(emp.getCivilStatus());
			
			session.update(updateEmp);
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


	public boolean DeleteEmployee(int empID) {
		// TODO Auto-generated method stub
		Transaction tx = null;
		boolean status=false;
		
		try{
			HrEmployee emp=new HrEmployee();
			emp.setEmpId(empID);
			
			Object object = session.load(HrEmployee.class, empID);
			HrEmployee deleteEmp = (HrEmployee) object;	
			
			
			deleteEmp.setIsActive(false);;
			System.out.println("Deleting Item ");
			tx = session.beginTransaction();			
			session.update(deleteEmp);
			tx.commit();
			
			
			status = true;
		}
		catch(Exception e)
		{
			e.printStackTrace();
			
		}
		return status;
	}


	public List<HrEmployee> GetEmployeesByDeptDesig(String dept, int desig) {

		Query query = session.createQuery("select e.empId,e.firstName,e.lastName from HrEmployee e, HrWorkin w  where e.empId=w.id.empId and w.hrDepartment.deptName='"+dept+"' and w.id.designationId='"+desig+"' order by e.firstName ASC");
		
		@SuppressWarnings("unchecked")
		List<HrEmployee> empList = query.list();

		return empList;
	}


	public List<HrEmployeeView> GetEmployeesByID(int empId) {
		tx = session.beginTransaction();
//		Query query = session
//				.createQuery("select e.empId, e.firstName, e.lastName,e.birthday,e.gender, e.civilStatus, c.contact from HrEmployee e, HrContact c where e.empId=c.id.empId");
		
//		Query query = session
//				.createQuery("select v from HrEmployeeView v where v.id.empId = '"+empId+"'");
//		
		Query query = session
				.createQuery("select "
						+ "v.id.empId,"
						+ "v.id.title,"
						+ "v.id.firstName,"
						+ "v.id.lastName,"
						+ "v.id.birthday,"
						+ "v.id.gender,"
						+ "v.id.civilStatus,"
						+ "v.id.address,"
						+ "v.id.phone,"
						+ "v.id.mobile,"
						+ "v.id.email,"
						+ "v.id.nic,"
						+ "v.id.epf,"
						+ "v.id.drivingLicence,"
						+ "v.id.deptName,"
						+ "v.id.designationName "
						+ "from HrEmployeeView v "
						+ "where v.id.empId = '"+empId+"'");
		
		List<HrEmployeeView> empList= query.list();
		tx.commit();
		

		return empList;
	}


	public List<HrEmployee> GetNextEmployeeID() {
		Query query = session.createQuery("select max(e.empId) from HrEmployee e");
		
		@SuppressWarnings("unchecked")
		List<HrEmployee> empList = query.list();

		return empList;
	}


//	public void UploadImage(int empID, String imageURL) {
//		tx= session.beginTransaction();
//		
//		File file = new File(imageURL);
//		byte[] imageData = new byte[(int) file.length()];
//		 
//		try {
//		    FileInputStream fileInputStream = new FileInputStream(file);
//		    fileInputStream.read(imageData);
//		    fileInputStream.close();
//		} catch (Exception e) {
//		    e.printStackTrace();
//		}
//		 
//		
//		
//		HrEmployee updateEmp=(HrEmployee) session.get(HrEmployee.class, empID);
//		updateEmp.setEmpImage(imageData);
//		 
//		session.update(updateEmp);
//		tx.commit();
//	}


	public List<HrEmployee> GetEmployeeImageByID(int empId) {
		tx = session.beginTransaction();
		Query query = session
				.createQuery("select e.empImage from HrEmployee e where e.empId= '"+empId+"'");
		
		List<HrEmployee> empList= query.list();
		
		HrEmployee emp=(HrEmployee) session.get(HrEmployee.class, empId);
		//byte[] bAvatar = emp.getEmpImage();
		 
		
		
		tx.commit();
		
		return empList;
	}


	public List<HrEmployee> GetEmployeesByDeptDesigGroup(String dept,
			int desigGroup) {
//Query query = session.createQuery("select e.empId,e.firstName,e.lastName, w.hrDepartment.deptName, w.hrDesignation.designationName from HrEmployee e, HrWorkin w  where e.empId=w.id.empId and w.hrDepartment.deptName='"+dept+"' and w.hrDesignation.hrDesignationgroup.groupId='"+desigGroup+"' order by e.firstName ASC");
Query query = session.createQuery("select e.empId,e.title,e.firstName,e.lastName from HrEmployee e, HrWorkin w  where e.empId=w.id.empId and w.hrDepartment.deptName='"+dept+"' and w.id.designationId='"+desigGroup+"' order by e.firstName ASC");
	
		@SuppressWarnings("unchecked")
		List<HrEmployee> empList = query.list();

		return empList;
	}


	public List<HrDepartment> GetEmployeesWard(int empId) {
		Query query = session.createQuery("select d from HrWorkin w , Ward d  where w.hrEmployee.empId='"+empId+"' and w.hrDepartment.deptName=d.wardNo");
		
		@SuppressWarnings("unchecked")
		List<HrDepartment> empList = query.list();

		return empList;
	}


	public List<HrEmployee> GetEmployeesDepartments(int empId) {
Query query = session.createQuery("select w from HrWorkin w where w.hrEmployee.empId='"+empId+"'");
		
		@SuppressWarnings("unchecked")
		List<HrEmployee> empList = query.list();

		return empList;
	}


	
}
