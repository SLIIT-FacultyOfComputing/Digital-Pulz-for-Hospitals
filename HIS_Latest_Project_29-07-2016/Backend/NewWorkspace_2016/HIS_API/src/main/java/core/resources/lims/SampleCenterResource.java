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
import lib.driver.lims.driver_class.SampleCentersDBDriver;
import lib.driver.lims.driver_class.SpecimenRetentionTypeDBDriver;
import lib.driver.lims.driver_class.SpecimenTypeDBDriver;
import lib.driver.lims.driver_class.TestNamesDBDriver;

@Path("SampleCenters")
public class SampleCenterResource {

SampleCentersDBDriver samplecenterDBDriver= new SampleCentersDBDriver();
DateFormat dateformat = new SimpleDateFormat("yyyy-MM-dd HH:mm:ss");
DateFormat dateformat2 = new SimpleDateFormat("yyyy-MM-dd");
	
@POST
@Path("/addNewsampleCenter")
@Produces(MediaType.APPLICATION_JSON)
@Consumes(MediaType.APPLICATION_JSON)
public String addNewSampleCenter(JSONObject pJson)
{

	try {
		
		
		
		SampleCenters samplecenter  =  new SampleCenters();
		
		int sampleCenterTypeID = pJson.getInt("fSampleCenterType_ID");
		
		int userid = pJson.getInt("fSampleCenter_AddedUserID");
		samplecenter.setSampleCenter_Name(pJson.getString("sampleCenter_Name").toString());
		samplecenter.setSampleCenter_Incharge(pJson.getString("sampleCenter_Incharge").toString());
		samplecenter.setLocation(pJson.getString("location").toString());
		samplecenter.setEmail(pJson.getString("email").toString());
		samplecenter.setContactNumber1(pJson.getString("contactNumber1").toString());
		samplecenter.setContactNumber2(pJson.getString("contactNumber2").toString());
		samplecenter.setSampleCenter_AddedDate(new Date());
		samplecenter.setSampleCenter_LastUpdatedDate(new Date());
		samplecenterDBDriver.insertNewSampleCenter(samplecenter, sampleCenterTypeID, userid);
		
	
		JSONSerializer jsonSerializer = new JSONSerializer();
		return jsonSerializer.include("sampleCenter_ID").serialize(samplecenter);
	} catch (Exception e) {
		 System.out.println(e.getMessage());
		return null; 
	}

}
		

	@GET
	@Path("/getAllSampleCenters")
	@Produces(MediaType.APPLICATION_JSON)
	public String getAllSampleCenters()
	{
		List<SampleCenters> sampleCenterList =   samplecenterDBDriver.getNewSampleCenterList();
		JSONSerializer serializer = new JSONSerializer();
		return  serializer.include("fSampleCenterType_ID.sample_Center_TypeName","fSampleCenterType_ID.sampleCenter_ID","fSampleCenter_AddedUserID.userName","fSampleCenterLast_UpdatedUserID.userName","fSampleCenter_Phone.id.phone","location").exclude("*.class","fSampleCenter_AddedUserID.*","fSampleCenterLast_UpdatedUserID.*","fSampleCenter_Phone.*").transform(new DateTransformer("yyyy-MM-dd"),"sampleCenter_AddedDate","sampleCenter_LastUpdatedDate").serialize(sampleCenterList);
	}
	
	@GET
	@Path("/getSampleCentersByLabType/{typeID}")
	@Produces(MediaType.APPLICATION_JSON)
	public String getAllSampleCentersByLabType(@PathParam("typeID")int typeID)
	{
		List<SampleCenters> sampleCenterList =   samplecenterDBDriver.getSamplecentersByLabType(typeID);
		JSONSerializer serializer = new JSONSerializer();
		return  serializer.include("fSampleCenterType_ID.sample_Center_TypeName","fSampleCenter_AddedUserID.userName","fSampleCenterLast_UpdatedUserID.userName","fSampleCenter_Phone.id.phone","location").exclude("*.class","fSampleCenterType_ID.*","fSampleCenter_AddedUserID.*","fSampleCenterLast_UpdatedUserID.*","fSampleCenter_Phone.*").transform(new DateTransformer("yyyy-MM-dd"),"sampleCenter_AddedDate","sampleCenter_LastUpdatedDate").serialize(sampleCenterList);
	}
	
	@POST
	@Path("/updateSampleCenter")
	@Produces(MediaType.TEXT_PLAIN)
	@Consumes(MediaType.APPLICATION_JSON)
	public String updateSampleCenterDetailsTest(JSONObject pJson)
	{
		
		
		try {
			
			
			SampleCenters samplecenter  =  new SampleCenters();
			
			int sampleCenterTypeID = pJson.getInt("fSampleCenterType_ID");
			
			int userid = pJson.getInt("fSampleCenter_AddedUserID");
		
			
			int samplecenterid = pJson.getInt("sampleCenter_ID");
			
			samplecenter.setSampleCenter_Name(pJson.getString("sampleCenter_Name").toString());
			samplecenter.setSampleCenter_Incharge(pJson.getString("sampleCenter_Incharge").toString());
			samplecenter.setLocation(pJson.getString("location").toString());
			samplecenter.setEmail(pJson.getString("email").toString());
			samplecenter.setContactNumber1(pJson.getString("contactNumber1").toString());
			samplecenter.setContactNumber2(pJson.getString("contactNumber2").toString());
			samplecenter.setSampleCenter_AddedDate(new Date());
			samplecenter.setSampleCenter_LastUpdatedDate(new Date());
			
			
			
			samplecenterDBDriver.updateSampleCenters(samplecenter, samplecenterid, sampleCenterTypeID, userid);
			
			
			return "True";	
			
		} catch (Exception e) {
			 
			return "False";
		}
	}
	
	@GET
	@Path("/deleteSampleCenter/{SampleCenterid}")
	@Produces(MediaType.APPLICATION_JSON)
	public String deleteSampleCenter(@PathParam("SampleCenterid") int SampleCenterid) {
		//String status="";
		try {
			
			samplecenterDBDriver.DeleteSampleCenter(SampleCenterid);
			
			
			return "True";	
		} catch (Exception e) {
			return "False";
		}
	}
	
	
}