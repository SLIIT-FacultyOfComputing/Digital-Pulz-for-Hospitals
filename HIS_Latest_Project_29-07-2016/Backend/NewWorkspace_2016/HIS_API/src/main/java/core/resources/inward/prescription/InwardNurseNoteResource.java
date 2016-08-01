package core.resources.inward.prescription;

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

import org.codehaus.jettison.json.JSONObject;





import core.classes.inward.WardAdmission.WardAdmission;
import core.classes.inward.charts.DiabeticChart;
import core.classes.inward.prescription.InwardNurseNote;
import core.classes.pcu.PcuNursenote;
import flexjson.JSONException;
import flexjson.JSONSerializer;
import lib.driver.inward.driver_class.prescription.InwardNurseNoteDBDrive;


@Path("InwardNurseNote")
public class InwardNurseNoteResource {
	
	InwardNurseNoteDBDrive requestdbDriver = new InwardNurseNoteDBDrive();
	DateFormat dateformat = new SimpleDateFormat("yyyy-MM-dd");
	

	@POST
	@Path("/addNewInwardNurseNote")
	@Produces(MediaType.APPLICATION_JSON)
	@Consumes(MediaType.APPLICATION_JSON)
	public String addNewTermPrescrption(JSONObject wJson)
	{
			//note,create user,datetme	
		try {
			InwardNurseNote Nursenote  =  new InwardNurseNote();
			
					
			Nursenote.setP_note(wJson.getString("note"));			
			
			Nursenote.setDatetime(new Date());
			int create_user=wJson.getInt("create_user");			
			String bht_no=wJson.getString("bht_no");	
			
			requestdbDriver.addNewInwardNurseNote(Nursenote,create_user,bht_no);
			 			
			return "true";
		} catch (Exception e) {
			 System.out.println(e.getMessage());
			 
			return e.getMessage().toString(); 
		}

	}
	
	
	
	@PUT
	@Path("/UpdateTermPrescrption")
	@Produces(MediaType.TEXT_PLAIN)
	@Consumes(MediaType.APPLICATION_JSON)
	public  String UpdateTermPrescrption(JSONObject wJson){
		
		String result="false";
		boolean r=false;
		
		try{
			int term_id=wJson.getInt("term_id");
			Date end_date=dateformat.parse(wJson.getString("end_date"));
			r=requestdbDriver.UpdateTermPrescrption(term_id,end_date);
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
	@Path("/getInwardNurseNoteByBHTNo/{bhtNo}")
	@Produces(MediaType.APPLICATION_JSON)
	public String getDiabeticChartByBHTNo(@PathParam("bhtNo")  String bhtNo)
	{
				 String result="";
		 List<InwardNurseNote> list =requestdbDriver.getInwardNurseNoteByBHTNo(bhtNo);
		 JSONSerializer serializor=new JSONSerializer();
		 result= serializor.serialize(list);
		 return result;
	}
	

	@GET
	@Path("/getNurseNote")
	@Produces(MediaType.APPLICATION_JSON)
	public String getNurseNote()
	{
		List<InwardNurseNote> notelist =requestdbDriver.getNurseNote();
		JSONSerializer serializer = new JSONSerializer();
		return  serializer.serialize(notelist);

	}
	
	
}
