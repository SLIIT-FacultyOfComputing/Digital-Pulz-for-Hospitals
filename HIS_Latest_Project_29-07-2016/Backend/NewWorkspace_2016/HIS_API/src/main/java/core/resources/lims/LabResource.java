package core.resources.lims;

import java.text.DateFormat;
import java.text.SimpleDateFormat;
import java.util.Date;
import java.util.HashSet;
import java.util.List;
import java.util.Set;

import javax.ws.rs.Consumes;
import javax.ws.rs.GET;
import javax.ws.rs.POST;
import javax.ws.rs.Path;
import javax.ws.rs.PathParam;
import javax.ws.rs.Produces;
import javax.ws.rs.core.MediaType;

import org.codehaus.jettison.json.JSONArray;
import org.codehaus.jettison.json.JSONException;
import org.codehaus.jettison.json.JSONObject;

import core.classes.lims.Category;
import core.classes.lims.LabDepartments;
import core.classes.lims.LabTestRequest;
import core.classes.lims.Laboratories;
import core.classes.lims.ParentTestFields;
import core.classes.lims.SampleCenters;
import core.classes.lims.SpecimenRetentionType;
import core.classes.lims.SpecimenType;
import core.classes.lims.SubCategory;
import core.classes.lims.TestNames;
import flexjson.JSONSerializer;
import flexjson.transformer.DateTransformer;
import lib.driver.lims.driver_class.CategoryDBDriver;
import lib.driver.lims.driver_class.LaboratoriesDBDriver;
import lib.driver.lims.driver_class.SampleCentersDBDriver;
import lib.driver.lims.driver_class.SpecimenRetentionTypeDBDriver;
import lib.driver.lims.driver_class.SpecimenTypeDBDriver;
import lib.driver.lims.driver_class.TestNamesDBDriver;

@Path("Laboratories")
public class LabResource {

	LaboratoriesDBDriver labDBDriver= new LaboratoriesDBDriver();
DateFormat dateformat = new SimpleDateFormat("yyyy-MM-dd HH:mm:ss");
DateFormat dateformat2 = new SimpleDateFormat("yyyy-MM-dd");
	
	
		
@POST
@Path("/addNewLaboratory")
@Produces(MediaType.APPLICATION_JSON)
@Consumes(MediaType.APPLICATION_JSON)
public String addNewLaboratory(JSONObject pJson)
{
	

	try {
		Laboratories labs  =  new Laboratories();
		
		int labTypeID = pJson.getInt("flabType_ID");
		int labDeptID = pJson.getInt("flabDept_ID");
	
		int labDeptCount = pJson.getInt("lab_Dept_Count");
		int userid = pJson.getInt("flab_AddedUserID");
		
		
		labs.setLab_Name(pJson.getString("lab_Name").toString());
		labs.setLab_Incharge(pJson.getString("lab_Incharge").toString());
		labs.setLocation(pJson.getString("location").toString());
		labs.setEmail(pJson.getString("email").toString());
		labs.setContactNumber1(pJson.getString("contactNumber1").toString());
		labs.setContactNumber2(pJson.getString("contactNumber2").toString());
		labs.setLab_Dept_Count(labDeptCount);
		labs.setLab_AddedDate(new Date());
		labs.setLab_LastUpdatedDate(new Date());
		
		labDBDriver.insertNewLab(labs, labTypeID, labDeptID, userid);
		
		

		
		JSONSerializer jsonSerializer = new JSONSerializer();
		return jsonSerializer.include("lab_ID").serialize(labs);
	} catch (Exception e) {
		 System.out.println(e.getMessage());
		return null; 
	}

}
		

	
	
	@GET
	@Path("/getAllLaboratories")
	@Produces(MediaType.APPLICATION_JSON)
	public String getAllLaboratories()
	{
		List<Laboratories> labsList =   labDBDriver.getNewLabsList();
		JSONSerializer serializer = new JSONSerializer();
		return  serializer.include("flabType_ID.lab_Type_Name","flabDept_ID.labDept_Name","flab_AddedUserID.userName","flabLast_UpdatedUserID.userName","labPhone.id.phone","location").exclude("*.class","flabType_ID.*","flabDept_ID.*","labPhone.*","flab_AddedUserID.*","flabLast_UpdatedUserID.*").transform(new DateTransformer("yyyy-MM-dd"),"lab_AddedDate","lab_LastUpdatedDate").serialize(labsList);
	}
	
	@GET
	@Path("/getLaboratoriesByLabType/{typeID}")
	@Produces(MediaType.APPLICATION_JSON)
	public String getAllLaboratoriesByLabType(@PathParam("typeID")int typeID)
	{
		List<Laboratories> labsList =   labDBDriver.getLaboratoriesByLabType(typeID);
		JSONSerializer serializer = new JSONSerializer();
		return  serializer.include("flabType_ID.lab_Type_Name","flabDept_ID.labDept_Name","flab_AddedUserID.userName","flabLast_UpdatedUserID.userName","labPhone.id.phone","location").exclude("*.class","flabType_ID.*","flabDept_ID.*","labPhone.*","flab_AddedUserID.*","flabLast_UpdatedUserID.*").transform(new DateTransformer("yyyy-MM-dd"),"lab_AddedDate","lab_LastUpdatedDate").serialize(labsList);
	}

	
	@POST
	@Path("/updateLaboratories")
	@Produces(MediaType.TEXT_PLAIN)
	@Consumes(MediaType.APPLICATION_JSON)
	public String updateLabDetails(JSONObject pJson)
	{
		try {
			//System.out.println(pJson.toString());
			
			Laboratories labs = new Laboratories();
			
			int labTypeID = pJson.getInt("flabType_ID");
			int labDeptID = pJson.getInt("flabDept_ID");
		
			int labDeptCount = pJson.getInt("lab_Dept_Count");
			int userid = pJson.getInt("flabLast_UpdatedUserID");
			//int userid = pJson.getInt("flabLast_UpdatedUserID");
			int labid = pJson.getInt("lab_ID");
			

			labs.setLab_Name(pJson.getString("lab_Name").toString());
			labs.setLab_Incharge(pJson.getString("lab_Incharge").toString());
			labs.setLocation(pJson.getString("location").toString());
			labs.setEmail(pJson.getString("email").toString());
			labs.setContactNumber1(pJson.getString("contactNumber1").toString());
			labs.setContactNumber2(pJson.getString("contactNumber2").toString());
			labs.setLab_Dept_Count(labDeptCount);
			labs.setLab_AddedDate(new Date());
			labs.setLab_LastUpdatedDate(new Date());
			
			labDBDriver.updateLaboratories(labid, labs, labTypeID, labDeptID, userid);
			
			
			return "True";	
			
		} catch (Exception e) {
			 
			return "False";
		}
	}
	
	@GET
	@Path("/deleteLab/{labid}")
	@Produces(MediaType.APPLICATION_JSON)
	public String deleteLab(@PathParam("labid") int labid) {
		//String status="";
		try {
			
			labDBDriver.DeleteLab(labid);
		
			
			return "True";	
		} catch (Exception e) {
			return "False";
		}
	}
	
	}
	


