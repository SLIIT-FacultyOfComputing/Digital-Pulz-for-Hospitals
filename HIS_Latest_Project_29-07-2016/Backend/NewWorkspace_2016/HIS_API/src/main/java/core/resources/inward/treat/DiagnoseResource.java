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

import org.codehaus.jettison.json.JSONException;
import org.codehaus.jettison.json.JSONObject;
import org.jboss.logging.Logger;

import core.ErrorConstants;
import core.classes.inward.treat.Diagnose;
import core.resources.inward.charts.TemperaturechartResource;
import flexjson.JSONSerializer;

@Path("Diagnose")
public class DiagnoseResource {

	final static Logger log = Logger.getLogger(DiagnoseResource.class);
	
	
	DiagnoseDBDrive requestdbDriver = new DiagnoseDBDrive();
	DateFormat dateformat = new SimpleDateFormat("yyyy-MM-dd'T'HH:mm");

	@POST
	@Path("/addDiagnose")
	@Produces(MediaType.APPLICATION_JSON)
	@Consumes(MediaType.APPLICATION_JSON)
	public String addDiagnose(JSONObject wJson) throws JSONException
	{
		log.info("Entering the add New Diagnose method");
				
		try {
			Diagnose newterm  =  new Diagnose();
										
			String bht_no=wJson.getString("bht_no");					
			int user=wJson.getInt("create_user");
			newterm.setTreat(wJson.getString("treat"));
			newterm.setImage(wJson.getString("image"));	
			newterm.setCreate_date_time(new Date());
			requestdbDriver.addDiagnose(newterm,bht_no,user);			 			
			
			JSONSerializer serializor=new JSONSerializer();
			String result= serializor.exclude("*class").serialize(newterm);
			log.info("Insert MainResults Successful");
			return result;//"true";
		}catch(JSONException e){
			log.error("JSON exception in adding New DiagnoseDetails, message: " + e.getMessage());
			
			JSONObject jsonErrorObject = new JSONObject();
			jsonErrorObject.put("errorcode", ErrorConstants.FILL_REQUIRED_FIELDS.getCode());
			jsonErrorObject.put("message", ErrorConstants.FILL_REQUIRED_FIELDS.getMessage());
			
			return jsonErrorObject.toString();
		
		
		}catch(RuntimeException e){
			
			log.error("Runtime Exception in adding New DiagnoseDetail, message:" + e.getMessage());
			
			JSONObject jsonErrorObject = new JSONObject();
			jsonErrorObject.put("errorcode", ErrorConstants.NO_CONNECTION.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_CONNECTION.getMessage());
			
			
			return jsonErrorObject.toString(); 
			
		} catch (Exception e) {
			log.error("Exception in adding NewTempchartDetails, message:" + e.getMessage());
			JSONObject jsonErrorObject = new JSONObject();
			
			jsonErrorObject.put("errorcode", ErrorConstants.NO_DATA.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_DATA.getMessage());
			 
			 return e.getMessage().toString(); 
			
		}
	}
	
	@GET
	@Path("/getDiagnoseByBHTNo/{bhtNo}")
	@Produces(MediaType.APPLICATION_JSON)
	public String getDiagnoseByBHTNo(@PathParam("bhtNo")  String bhtNo) throws JSONException
	{
		log.info("Entering the get diagnose by bhtNo method");
		
		try{
		 String result="";
		 List<Diagnose> req =requestdbDriver.getDiagnoseByBHTNo(bhtNo);
		 JSONSerializer serializor=new JSONSerializer();
		 result= serializor.serialize(req);
		 return result;
		}
		catch(RuntimeException e){
			log.error("Runtime Exception in get all MainResults by ReqID, message:" + e.getMessage());
			JSONObject jsonErrorObject = new JSONObject();
			
			jsonErrorObject.put("errorcode", ErrorConstants.NO_CONNECTION.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_CONNECTION.getMessage());
			
			
			return jsonErrorObject.toString(); 
			
		}
	}
}
