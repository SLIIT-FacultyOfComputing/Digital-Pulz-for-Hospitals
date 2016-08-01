package core.resources.hr;

import java.text.DateFormat;
import java.text.SimpleDateFormat;
import java.util.List;

import javax.print.attribute.standard.DateTimeAtCompleted;
import javax.ws.rs.Consumes;
import javax.ws.rs.GET;
import javax.ws.rs.POST;
import javax.ws.rs.Path;
import javax.ws.rs.PathParam;
import javax.ws.rs.Produces;
import javax.ws.rs.core.MediaType;

import org.codehaus.jettison.json.JSONObject;









import core.classes.hr.HrShifttimes;
import lib.driver.hr.driver_class.HrShifttimesDBDriver;
import flexjson.JSONSerializer;


@Path("HrShifttimes")
public class HrShifttimesResource {
	
	HrShifttimesDBDriver hrShifttimesDBDriver=new HrShifttimesDBDriver();
	
	DateFormat dateformat = new SimpleDateFormat("yyyy/MM/dd HH:mm");
	DateFormat dateformat2 = new SimpleDateFormat("yyyy/MM/dd");
	SimpleDateFormat sdf = new SimpleDateFormat("yyyy-MM-dd'T'HH:mm");

	@GET
	@Path("/getShitTimesByDept/{date}/{workinDept}")
	@Produces(MediaType.APPLICATION_JSON)
	public String GetAllEmployees(@PathParam("date")  String date,@PathParam("workinDept")  int dept) {
		String result="";
		
		try {
			System.out.println("Nishaa!! : "+dept);
			
			List<HrShifttimes> shitfTimeList=hrShifttimesDBDriver.GetShitTimesByDept(date,dept);
			
			
			System.out.println("Nishaad"+dept);
			JSONSerializer serializer = new JSONSerializer();

			return serializer.exclude("*.class").serialize(shitfTimeList);
			
		} catch (Exception e) {
			return e.getMessage();
		}
	}
	
	@POST
	@Path("/setShiftTime")
	@Produces(MediaType.APPLICATION_JSON)
	@Consumes(MediaType.APPLICATION_JSON)
	public String InsertEmployeeAllocation(JSONObject wJson) 
	{
		
		try {
			HrShifttimes shift=new HrShifttimes();
			
			int deptID=wJson.getInt("deptID");
			
			
			
			
			//System.out.print(wJson.getString("from"));

			shift.setFromDatetime(sdf.parse(wJson.getString("from")));
			
			shift.setToDatetime(sdf.parse(wJson.getString("to")));
						
			hrShifttimesDBDriver.SetShiftTime(deptID, shift);
			
		
			return "True";
		} catch (Exception e) {
			e.printStackTrace();
			return e.getMessage().toString();
		}				
	}
	
}
