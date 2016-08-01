package core.resources.inward.treat;

import java.text.DateFormat;
import java.text.SimpleDateFormat;
import java.util.Date;
import java.util.List;

import javax.ws.rs.Consumes;
import javax.ws.rs.GET;
import javax.ws.rs.POST;
import javax.ws.rs.Path;
import javax.ws.rs.PathParam;
import javax.ws.rs.Produces;
import javax.ws.rs.core.MediaType;




import lib.driver.inward.driver_class.treat.DiagnoseDBDrive;

import org.codehaus.jettison.json.JSONObject;

import core.classes.inward.treat.Diagnose;
import flexjson.JSONSerializer;

@Path("Diagnose")
public class DiagnoseResource {
	
	DiagnoseDBDrive requestdbDriver = new DiagnoseDBDrive();
	DateFormat dateformat = new SimpleDateFormat("yyyy-MM-dd'T'HH:mm");

	@POST
	@Path("/addDiagnose")
	@Produces(MediaType.APPLICATION_JSON)
	@Consumes(MediaType.APPLICATION_JSON)
	public String addDiagnose(JSONObject wJson)
	{
				
		try {
			Diagnose newterm  =  new Diagnose();
										
			String bht_no=wJson.getString("bht_no");					
			int user=wJson.getInt("create_user");
			newterm.setTreat(wJson.getString("treat"));
			newterm.setImage(wJson.getString("image"));	
			newterm.setCreate_date_time(new Date());
			requestdbDriver.addDiagnose(newterm,bht_no,user);			 			
			
			return "true";
		} catch (Exception e) {
			 System.out.println(e.getMessage());
			 
			return e.getMessage().toString(); 
		}
	}
	
	@GET
	@Path("/getDiagnoseByBHTNo/{bhtNo}")
	@Produces(MediaType.APPLICATION_JSON)
	public String getDiagnoseByBHTNo(@PathParam("bhtNo")  String bhtNo)
	{
				 String result="";
		 List<Diagnose> req =requestdbDriver.getDiagnoseByBHTNo(bhtNo);
		 JSONSerializer serializor=new JSONSerializer();
		 result= serializor.serialize(req);
		 return result;
	}
}
