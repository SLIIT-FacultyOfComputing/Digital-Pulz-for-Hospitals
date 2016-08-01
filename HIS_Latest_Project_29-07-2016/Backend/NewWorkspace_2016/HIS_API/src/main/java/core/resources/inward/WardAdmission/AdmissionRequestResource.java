package core.resources.inward.WardAdmission;

import java.text.DateFormat;
import java.text.SimpleDateFormat;
import java.util.Date;
import java.util.List;

import javax.ws.rs.Consumes;
import javax.ws.rs.GET;
import javax.ws.rs.POST;
import javax.ws.rs.PUT;
import javax.ws.rs.Path;
import javax.ws.rs.PathParam;
import javax.ws.rs.Produces;
import javax.ws.rs.core.MediaType;
import lib.driver.inward.driver_class.WardAdmission.AdmissionRequestDBDriver;


import org.codehaus.jettison.json.JSONObject;

import core.classes.inward.WardAdmission.AdmissionRequest;
import flexjson.JSONException;
import flexjson.JSONSerializer;


@Path("AdmissionRequest")
public class AdmissionRequestResource {
	
	AdmissionRequestDBDriver requestdbDriver = new AdmissionRequestDBDriver();
	DateFormat dateformat = new SimpleDateFormat("yyyy-MM-dd'T'HH:mm");
	
	@POST
	@Path("/addAdmissionRequest")
	@Produces(MediaType.APPLICATION_JSON)
	@Consumes(MediaType.APPLICATION_JSON)
	public String addAdmissionRequest(JSONObject wJson)
	{
				
		try {
			AdmissionRequest wardadmission  =  new AdmissionRequest();
			
			wardadmission.setRequest_unit(wJson.getString("request_unit"));	
			wardadmission.setIs_read(wJson.getInt("is_read"));
			wardadmission.setRemark(wJson.getString("remark"));
			wardadmission.setIs_user_doctor(wJson.getInt("is_user_doctor"));
			wardadmission.setCreate_date_time(dateformat.parse(wJson.getString("create_date_time")));
			wardadmission.setLast_update_date_time(dateformat.parse(wJson.getString("last_update_date_time").toString()));	
			
			int pid=wJson.getInt("patient_id");			
			int createUser=wJson.getInt("create_user");
			int UpdateUser=wJson.getInt("last_update_user");
			String ward=wJson.getString("transfer_ward");				 
			requestdbDriver.insertAdmissionRequest(wardadmission,pid,createUser,UpdateUser,ward);
			 			
			return "true";
		} catch (Exception e) {
			 System.out.println(e.getMessage());
			 
			return e.getMessage().toString(); 
		}

	}
	
	
	@PUT
	@Path("/updateAdmisiionRequest")
	@Produces(MediaType.TEXT_PLAIN)
	@Consumes(MediaType.APPLICATION_JSON)
	public  String updateAdmisiionRequest(JSONObject wJson){
		
		String result="false";
		boolean r=false;
		
		try{
			int autoid=wJson.getInt("auto_id");
			String BhtNo=wJson.getString("bht_no");
			int LastUpdatedUser=wJson.getInt("last_update_user");
			Date LastUpdatedDateTime=dateformat.parse(wJson.getString("last_update_date_time"));
			r=requestdbDriver.updateAdmisiionRequest(BhtNo,LastUpdatedUser,LastUpdatedDateTime,autoid);
			result=String.valueOf(r);
		
			return result;
			
		}
		catch( JSONException ex){
			ex.printStackTrace();	
			return result;
		}
		
		catch( Exception ex){
			ex.printStackTrace();
			return ex.getMessage();
		}

	}
	
	@GET
	@Path("/getSelectAdmissionReq/{auto_id}")
	@Produces(MediaType.APPLICATION_JSON)
	public String getSelectAdmissionReq(@PathParam("auto_id")  int auto_id)
	{
		 String result="";
		 List<AdmissionRequest> req =requestdbDriver.getSelectAdmissionReq(auto_id);
		 JSONSerializer serializor=new JSONSerializer();
		 result= serializor.serialize(req);
		 return result;
	}
	
	@GET
	@Path("/getNotReadAdmissionRequestByWard/{transfer_ward}")
	@Produces(MediaType.APPLICATION_JSON)
	public String getNotReadAdmissionRequestByWard(@PathParam("transfer_ward")  String transfer_ward)
	{
				 String result="";
		 List<AdmissionRequest> req =requestdbDriver.getNotReadAdmissionRequestByWard(transfer_ward);
		 JSONSerializer serializor=new JSONSerializer();
		 result= serializor.serialize(req);
		 return result;
	}

}
