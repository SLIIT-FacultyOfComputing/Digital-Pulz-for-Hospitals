package core.resources.inward.WardAdmission;

import java.text.DateFormat;
import java.text.SimpleDateFormat;
import java.util.List;
import javax.ws.rs.Consumes;
import javax.ws.rs.GET;
import javax.ws.rs.POST;
import javax.ws.rs.Path;
import javax.ws.rs.PathParam;
import javax.ws.rs.Produces;
import javax.ws.rs.core.MediaType;
import org.codehaus.jettison.json.JSONObject;
import core.classes.inward.WardAdmission.WardAdmission;
import flexjson.JSONSerializer;
import lib.driver.inward.driver_class.WardAdmission.WardAdmissionDBDriver;

@Path("WardAdmission")
public class WardAdmissionResource {
	
	WardAdmissionDBDriver wardadmissiondbDriver = new WardAdmissionDBDriver();
	DateFormat dateformat = new SimpleDateFormat("yyyy-MM-dd'T'HH:mm");
	
	@POST
	@Path("/addWardAdmission")
	@Produces(MediaType.APPLICATION_JSON)
	@Consumes(MediaType.APPLICATION_JSON)
	public String addWard(JSONObject wJson)
	{
		
		try {
			WardAdmission wardadmission  =  new WardAdmission();
			
			wardadmission.setBhtNo(wJson.getString("bhtNo"));
			wardadmission.setPatientID(wJson.getString("patientID").toString());	
			wardadmission.setBedNo(wJson.getInt("bedNo"));
			wardadmission.setWardNo(wJson.getString("wardNo"));
			wardadmission.setDailyNo(wJson.getInt("dailyNo"));
			wardadmission.setMonthlyNo(wJson.getInt("monthlyNo"));	
			wardadmission.setYearlyNo(wJson.getInt("yearlyNo"));
			wardadmission.setDoctorID(wJson.getInt("DoctorID"));
			wardadmission.setAdmitDateTime(dateformat.parse(wJson.get("admitDateTime").toString())); 
			wardadmission.setAdmitDateTime(dateformat.parse(wJson.getString("admitDateTime").toString()));
			wardadmission.setPatientComplain(wJson.getString("patientComplain").toString());	
			wardadmission.setPreviousHistory(wJson.getString("previousHistory"));
			wardadmission.setCreatedUser(wJson.getInt("createdUser"));			
			wardadmission.setCreatedDateTime(dateformat.parse(wJson.getString("createdDateTime")));
			wardadmission.setLastUpdatedUser(wJson.getInt("LastUpdatedUser"));
			wardadmission.setLastUpdatedDateTime(dateformat.parse(wJson.getString("LastUpdatedDateTime").toString()));	
			
		
			wardadmissiondbDriver.insertWardAdmission(wardadmission);
			 			
			return "true";
		} catch (Exception e) {
			 System.out.println(e.getMessage());
			 
			return e.getMessage().toString(); 
		}

	}
	
	
	@GET
	@Path("/getWardAdmission")
	@Produces(MediaType.APPLICATION_JSON)
	public String getWard()
	{
		List<WardAdmission> wardAdmissionList =wardadmissiondbDriver.getWardAdmissionList();
		JSONSerializer serializer = new JSONSerializer();
		return  serializer.serialize(wardAdmissionList);

	}
	
	@GET
	@Path("/getWardAdmissionDetails/{bhtNo}")
	@Produces(MediaType.APPLICATION_JSON)
	public String getWardAdmissionDetails(@PathParam("bhtNo")  String bhtNo){
		String result="";
		 List<WardAdmission> wardlist =wardadmissiondbDriver.getWardAdmissionDetails(bhtNo);
		 JSONSerializer serializor=new JSONSerializer();
		 result= serializor.serialize(wardlist);
		 return result;
	
		
	}
	
	@GET
	@Path("/getWardAdmissionByPatientID/{patientID}")
	@Produces(MediaType.APPLICATION_JSON)
	public String getWardAdmissionByPatientID(@PathParam("patientID")  int patientID){
		String result="";
		 List<WardAdmission> wardlist =wardadmissiondbDriver.getWardAdmissionByPatientID(patientID);
		 JSONSerializer serializor=new JSONSerializer();
		 result= serializor.include("Patient.patientID").exclude("*.class","Patient.*").serialize(wardlist);
		 return result;
	
		
	}
	

	
	

}
