package core.resources.pcu;

import java.sql.Date;
import java.util.List;

import javax.ws.rs.Consumes;
import javax.ws.rs.GET;
import javax.ws.rs.Path;
import javax.ws.rs.PathParam;
import javax.ws.rs.Produces;
import javax.ws.rs.core.MediaType;

import core.classes.pcu.PcuManualdispense;
import core.classes.pcu.PcuPrescriptiondispense;
import flexjson.JSONSerializer;
import lib.driver.pcu.driver_class.PcuManualDispenseDBDriver;


@Path("PcuManual")
public class PcuManualDispenseResource {
	
	PcuManualDispenseDBDriver pcuManualDispenseDBDriver = new PcuManualDispenseDBDriver();
	
	@GET
	@Path("/dispenseDrugManual/{aid}/{qty}/{sno}/{user}")
	@Produces(MediaType.TEXT_PLAIN)
	@Consumes(MediaType.APPLICATION_JSON)
	public String dispenseDrugManual(@PathParam("aid") int AID,@PathParam("qty") float QTY,@PathParam("sno") int SNO,@PathParam("user") int user) {
		String status="";
		try {
			if (pcuManualDispenseDBDriver.DispenseDrugsManual(AID,SNO,QTY,user)) {
				status = "Drugs Dispensed!!!";
			} else {
				status = "fail";
			}
			
			return status;
		} catch (Exception e) {
			return e.getMessage();
		}
		
	}
	
	@GET
	@Path("/getManuallyDispensedItems")
	@Produces(MediaType.APPLICATION_JSON)
	public String GetPrescriptionDispensedItems() {
		
		String result="";
		try {
			List<PcuManualdispense> ItemList=pcuManualDispenseDBDriver.GetManuallyDispensedItems();
			
			JSONSerializer serializer = new JSONSerializer();

			return serializer.exclude("*.class").serialize(ItemList);
			
		} catch (Exception e) {
			return e.getMessage();
		}
	}
	
	@GET
	@Path("/UpdateItems/{id}/{disby}/{qty}/{date}")
	@Produces(MediaType.APPLICATION_JSON)
	public String UpdateItems(@PathParam("id") int ID,@PathParam("disby") int DISBY,@PathParam("qty") float QTY, @PathParam("date") Date DisDate) {
		String status="";
		try {
			if (pcuManualDispenseDBDriver.UpdateManuallyDispensedItems(ID, DISBY, QTY, DisDate)) {
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
	@Path("/DeleteItems/{id}")
	@Produces(MediaType.APPLICATION_JSON)
	public String DeleteItems(@PathParam("id") int ID) {
		String status="";
		try {
			if (pcuManualDispenseDBDriver.DeleteItems(ID)) {
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
