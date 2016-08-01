package core.resources.pcu;

import java.sql.Date;
import java.util.List;

import javax.ws.rs.Consumes;
import javax.ws.rs.GET;
import javax.ws.rs.POST;
import javax.ws.rs.Path;
import javax.ws.rs.PathParam;
import javax.ws.rs.Produces;
import javax.ws.rs.core.MediaType;

import org.codehaus.jettison.json.JSONObject;

import lib.driver.pcu.driver_class.PcuPrescriptionDispenseDBDriver;
import core.classes.pcu.PcuItems;
import core.classes.pcu.PcuPrescription;
import core.classes.pcu.PcuPrescriptiondispense;
import core.classes.pcu.PcuPrescriptionitems;
import flexjson.JSONSerializer;


@Path("PcuPrescription")

public class PcuPrescriptionDispenseResource {
	
	PcuPrescriptionDispenseDBDriver pcuPrescriptionDBDriver = new PcuPrescriptionDispenseDBDriver();
	
	@GET
	@Path("/getPrescriptions/{id}")
	@Produces(MediaType.APPLICATION_JSON)
	public String GetPrescriptions(@PathParam("id") int ID) {
		
		String result="";
		try {
			List<PcuPrescription> ItemList=pcuPrescriptionDBDriver.GetPrescriptionByAdmition(ID);
			
			JSONSerializer serializer = new JSONSerializer();

			return serializer.exclude("*.class").serialize(ItemList);
			
		} catch (Exception e) {
			return e.getMessage();
		}
	}
	
	@GET
	@Path("/getPrescriptionItems/{id}")
	@Produces(MediaType.APPLICATION_JSON)
	public String GetPrescriptionItems(@PathParam("id") int ID) {
		
		String result="";
		try {
			List<PcuPrescriptionitems> ItemList=pcuPrescriptionDBDriver.GetPrescriptionItemsByPrescription(ID);
			
			JSONSerializer serializer = new JSONSerializer();

			return serializer.exclude("*.class").serialize(ItemList);
			
		} catch (Exception e) {
			return e.getMessage();
		}
	}
	
	
	@GET
	@Path("/dispenseDrugPrescriptions/{id}/{userid}")
	@Produces(MediaType.TEXT_PLAIN)
	@Consumes(MediaType.APPLICATION_JSON)
	public String dispenseDrugPres(@PathParam("id") int ID,@PathParam("userid") int user) {
		String status="";
		
			status = pcuPrescriptionDBDriver.DispenseDrugsPrescriptions(ID,user);
			System.out.print(status);	
			
			return status;
		
		
	}
	@GET
	@Path("/getPrescriptionDispensedItems")
	@Produces(MediaType.APPLICATION_JSON)
	public String GetPrescriptionDispensedItems() {
		
		String result="";
		try {
			List<PcuPrescriptiondispense> ItemList=pcuPrescriptionDBDriver.GetPrescriptionDispensedItems();
			
			JSONSerializer serializer = new JSONSerializer();

			return serializer.exclude("*.class").serialize(ItemList);
			
		} catch (Exception e) {
			return e.getMessage();
		}
	}
	
	@GET
	@Path("/UpdateItems/{sno}/{pid}/{disby}/{qty}/{date}")
	@Produces(MediaType.APPLICATION_JSON)
	public String UpdateItems(@PathParam("sno") int SNO,@PathParam("pid") int PID,@PathParam("disby") int DISBY,@PathParam("qty") float QTY, @PathParam("date") Date DisDate) {
		String status="";
		try {
			if (pcuPrescriptionDBDriver.UpdatePrescrriptionDispensedItems(SNO, PID, DISBY, QTY, DisDate)) {
				status = "Item Updated!!!";
			} else {
				status = "fail";
			}
			
			return status;
		} catch (Exception e) {
			return e.getMessage();
		}
	}
	
	@GET
	@Path("/DeleteItems/{sno}/{pid}")
	@Produces(MediaType.APPLICATION_JSON)
	public String DeleteItems(@PathParam("sno") int SNO,@PathParam("pid") int PID) {
		String status="";
		try {
			if (pcuPrescriptionDBDriver.DeleteItems(SNO, PID)) {
				status = "Item Deleted!!!";
			} else {
				status = "fail";
			}
			
			return status;
		} catch (Exception e) {
			return e.getMessage();
		}
	}
	
	

}
