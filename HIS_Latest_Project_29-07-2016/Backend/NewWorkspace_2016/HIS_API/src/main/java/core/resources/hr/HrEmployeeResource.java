package core.resources.hr;

import java.util.Date;
import java.util.HashSet;
import java.util.List;
import java.util.Set;
import java.text.DateFormat;
import java.text.SimpleDateFormat;

import javax.ws.rs.Consumes;
import javax.ws.rs.GET;
import javax.ws.rs.POST;
import javax.ws.rs.Path;
import javax.ws.rs.Produces;
import javax.ws.rs.core.MediaType;
import javax.ws.rs.PathParam;

import org.codehaus.jettison.json.JSONObject;

import lib.driver.hr.driver_class.HrContactDBDriver;
import lib.driver.hr.driver_class.HrEmployeeDBDriver;
import lib.driver.hr.driver_class.HrIdentityDBDriver;
import lib.driver.hr.driver_class.HrWorkinDBDriver;
import core.classes.hr.HrContact;
import core.classes.hr.HrContacttype;
import core.classes.hr.HrDepartment;
import core.classes.hr.HrEmployee;
import core.classes.hr.HrEmployeeView;
import flexjson.JSONException;
import flexjson.JSONSerializer;
import flexjson.transformer.DateTransformer;


@Path("HrEmployee")
public class HrEmployeeResource {

	HrEmployeeDBDriver hrEmployeeDBDriver= new HrEmployeeDBDriver();
	HrContactDBDriver hrContactDBDriver=new HrContactDBDriver();
	HrIdentityDBDriver hrIdentityDBDriver=new HrIdentityDBDriver();
	HrWorkinDBDriver hrWorkinDBDriver=new HrWorkinDBDriver();
	
	DateFormat dateformat = new SimpleDateFormat("yyyy-MM-dd'T'HH:mm");
	DateFormat dateformat2 = new SimpleDateFormat("yyyy-MM-dd");
	
	@GET
	@Path("/getAllEmployees")
	@Produces(MediaType.APPLICATION_JSON)
	public String GetAllEmployees() {
		String result="";
		try {
			List<HrEmployeeView> empList=hrEmployeeDBDriver.GetAllEmployees();
			
			JSONSerializer serializer = new JSONSerializer();

			return serializer.exclude("*.class").serialize(empList);
			
		} catch (Exception e) {
			return e.getMessage();
		}
	}
	
	
	
	@POST
	@Path("/addNewEmployee")
	@Produces(MediaType.APPLICATION_JSON)
	@Consumes(MediaType.APPLICATION_JSON)
	public String AddNewEmployee(JSONObject wJson) 
	{
		
		//System.out.println(dateformat2.parse(wJson.getString("empBDay").toString()));

		try {
			HrEmployee emp=new HrEmployee();
			
			
			emp.setTitle(wJson.getString("empTitle"));
			emp.setFirstName(wJson.getString("empFName"));
			emp.setLastName(wJson.getString("empLName"));
			System.out.println("HII BDAY: "+wJson.getString("empBDay").toString());
			emp.setBirthday(dateformat2.parse(wJson.getString("empBDay")));
			emp.setGender(wJson.getString("empGender"));
			emp.setCivilStatus(wJson.getString("empCivilStatus"));
			emp.setEmpImage(wJson.getString("empImage"));
			//String imageURL= wJson.getString("empImage");
			
			//String imageURL= "C:/Users/Nishadini/Desktop/Nisha.jpg";
			
			emp.setIsActive(true);
			
			int empID = Integer.parseInt(hrEmployeeDBDriver.InsertNewEmployee(emp));
			
			//hrEmployeeDBDriver.UploadImage(empID,imageURL);
			
			String contact1=wJson.getString("empAddress");
			String contact2=wJson.getString("empPhone");
			String contact3=wJson.getString("empMobile");
			String contact4=wJson.getString("empMobile");
			
			hrContactDBDriver.InsertContact(1, empID,contact1);
			hrContactDBDriver.InsertContact(2, empID,contact2);
			hrContactDBDriver.InsertContact(3, empID,contact3);
			hrContactDBDriver.InsertContact(4, empID,contact4);
			
			String identity1=wJson.getString("empNIC");
			String identity2=wJson.getString("empEPF");
			String identity3=wJson.getString("empDrivingNo");
			
			hrIdentityDBDriver.InsertIdentity(1, empID,identity1);
			hrIdentityDBDriver.InsertIdentity(2, empID,identity2);
			hrIdentityDBDriver.InsertIdentity(3, empID,identity3);
			
			//int dept=Integer.parseInt(wJson.getString("empDepartment"));
			//int desi=Integer.parseInt(wJson.getString("empDesgnation"));
			//Date startDate=dateformat2.parse(wJson.getString("empStartDate"));
			
			//hrWorkinDBDriver.InsertEmployeeWorkin(empID,dept,desi,startDate);
			
			return emp.getEmpId().toString();
			
		} catch (Exception e) {
			e.printStackTrace();
			return e.getMessage().toString();
		}					
	}
	
	@GET
	@Path("/getEmployeesByDept/{workinDept}")
	@Produces(MediaType.APPLICATION_JSON)
	public String GetEmployeesByDept(@PathParam("workinDept")  int dept) {
		
		
		try {
			List<HrEmployee> empList=hrEmployeeDBDriver.GetEmployeesByDept(dept);
			
			JSONSerializer serializer = new JSONSerializer();

			return serializer.exclude("*.class").serialize(empList);
			
		} catch (Exception e) {
			return e.getMessage();
		}
	}
	
	@GET
	@Path("/getEmployeeByID/{data}")
	@Produces(MediaType.APPLICATION_JSON)
	public String GetEmployeesByID(@PathParam("data")  int empId) {
		
		
		try {
			List<HrEmployeeView> empList=hrEmployeeDBDriver.GetEmployeesByID(empId);
			
			JSONSerializer serializer = new JSONSerializer();

			return serializer.exclude("*.class").serialize(empList);
			
		} catch (Exception e) {
			return e.getMessage();
		}
	}
	
	@POST
	@Path("/updateEmployee")
	@Produces(MediaType.APPLICATION_JSON)
	@Consumes(MediaType.APPLICATION_JSON)
	public String UpdateEmployee(JSONObject wJson) 
	{
		
		try {
			HrEmployee emp=new HrEmployee();
			
			emp.setEmpId( Integer.parseInt(wJson.getString("empID")));
			emp.setTitle(wJson.getString("empTitle"));
			emp.setFirstName(wJson.getString("empFName"));
			emp.setLastName(wJson.getString("empLName"));
			emp.setBirthday(dateformat2.parse(wJson.getString("empBDay")));
			emp.setGender(wJson.getString("empGender"));
			emp.setCivilStatus(wJson.getString("empCivilStatus"));
			
			hrEmployeeDBDriver.UpdateEmployee(emp);
			
			String contact1=wJson.getString("empAddress");
			String contact2=wJson.getString("empPhone");
			String contact3=wJson.getString("empMobile");
			String contact4=wJson.getString("empMobile");
			
			int empID=emp.getEmpId();
			
			
			hrContactDBDriver.UpdateContact(1, empID,contact1);
			hrContactDBDriver.UpdateContact(2, empID,contact2);
			hrContactDBDriver.UpdateContact(3, empID,contact3);
			hrContactDBDriver.UpdateContact(4, empID,contact4);

			String identity1=wJson.getString("empNIC");
			String identity2=wJson.getString("empEPF");
			String identity3=wJson.getString("empDrivingNo");
			
			hrIdentityDBDriver.UpdateContact(1, empID,identity1);
			hrIdentityDBDriver.UpdateContact(2, empID,identity2);
			hrIdentityDBDriver.UpdateContact(3, empID,identity3);
			

			
			
			
			
			return "True";
		} catch (Exception e) {
			e.printStackTrace();
			return e.getMessage().toString();
		}					
	}
	
	@GET
	@Path("/deleteEmployee/{empid}")
	@Produces(MediaType.APPLICATION_JSON)
	public String deleteEmployee(@PathParam("empid") int empID) {
		String status="";
		try {
			if (hrEmployeeDBDriver.DeleteEmployee(empID)) {
				status = "Item Deleted!!!";
			} else {
				status = "fail";
			}
			
			return status;
		} catch (Exception e) {
			return e.getMessage();
		}
	}
	
	@GET
	@Path("/getEmployeesByDeptDesig/{workinDept}/{designation}")
	@Produces(MediaType.APPLICATION_JSON)
	public String GetEmployeesByDeptDesig(@PathParam("workinDept")  String dept,@PathParam("designation")  int desig) {
		
		
		try {
			List<HrEmployee> empList=hrEmployeeDBDriver.GetEmployeesByDeptDesig(dept,desig);
			
			JSONSerializer serializer = new JSONSerializer();

			return serializer.exclude("*.class").serialize(empList);
			
		} catch (Exception e) {
			return e.getMessage();
		}
	}
	
	@GET
	@Path("/getNextEmployeeID")
	@Produces(MediaType.APPLICATION_JSON)
	public String GetNextEmployeeID() {
		
		
		try {
			List<HrEmployee> empList=hrEmployeeDBDriver.GetNextEmployeeID();
			
			JSONSerializer serializer = new JSONSerializer();

			return serializer.exclude("*.class").serialize(empList);
			
		} catch (Exception e) {
			return e.getMessage();
		}
	}
	
	@GET
	@Path("/getEmployeeImageByID/{data}")
	@Produces(MediaType.APPLICATION_JSON)
	public String GetEmployeeImageByID(@PathParam("data")  int empId) {
		
		
		try {
			List<HrEmployee> empList=hrEmployeeDBDriver.GetEmployeeImageByID(empId);
			
			JSONSerializer serializer = new JSONSerializer();

			return serializer.exclude("*.class").serialize(empList);
			
		} catch (Exception e) {
			return e.getMessage();
		}
	}
	
	@GET
	@Path("/getEmployeesByDeptDesigGroup/{workinDept}/{designationGroup}")
	@Produces(MediaType.APPLICATION_JSON)
	public String GetEmployeesByDeptDesigGroup(@PathParam("workinDept")  String dept,@PathParam("designationGroup")  int desigGroup) {
		
		
		try {
			List<HrEmployee> empList=hrEmployeeDBDriver.GetEmployeesByDeptDesigGroup(dept,desigGroup);
			
			JSONSerializer serializer = new JSONSerializer();

			return serializer.exclude("*.class").serialize(empList);
			
		} catch (Exception e) {
			return e.getMessage();
		}
	}
	
	@GET
	@Path("/getEmployeesWard/{empId}")
	@Produces(MediaType.APPLICATION_JSON)
	public String GetEmployeesWard(@PathParam("empId")  int  empId) {
		
		
		try {
			List<HrDepartment> empList=hrEmployeeDBDriver.GetEmployeesWard(empId);
			
			JSONSerializer serializer = new JSONSerializer();

			return serializer.exclude("*.class").serialize(empList);
			
		} catch (Exception e) {
			return e.getMessage();
		}
	}
	
	@GET
	@Path("/getEmployeesDepartments/{empId}")
	@Produces(MediaType.APPLICATION_JSON)
	public String GetEmployeesDepartments(@PathParam("empId")  int  empId) {
		
		
		try {
			List<HrEmployee> empList=hrEmployeeDBDriver.GetEmployeesDepartments(empId);
			
			JSONSerializer serializer = new JSONSerializer();

			return serializer.exclude("*.class").serialize(empList);
			
		} catch (Exception e) {
			return e.getMessage();
		}
	}
	
	
	
}
