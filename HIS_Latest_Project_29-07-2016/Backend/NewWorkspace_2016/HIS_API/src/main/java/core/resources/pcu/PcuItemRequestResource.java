package core.resources.pcu;

import java.sql.Date;
import java.util.List;

import javax.ws.rs.Consumes;
import javax.ws.rs.GET;
import javax.ws.rs.Path;
import javax.ws.rs.PathParam;
import javax.ws.rs.Produces;
import javax.ws.rs.core.MediaType;





import core.classes.pcu.PcuRequesteditems;
import flexjson.JSONSerializer;
import lib.driver.pcu.driver_class.PcuItemRequestDBDriver;

@Path("PcuRequest")
public class PcuItemRequestResource {
	
	PcuItemRequestDBDriver pcuItemRequestDBDriver = new PcuItemRequestDBDriver();
	
	@GET
	@Path("/RequestDrug/{qty}/{sno}/{user}")
	@Produces(MediaType.TEXT_PLAIN)
	@Consumes(MediaType.APPLICATION_JSON)
	public String dispenseDrugManual(@PathParam("qty") float QTY,@PathParam("sno") int SNO,@PathParam("user") int userID) {
		String status="";
		try {
			if (pcuItemRequestDBDriver.RequestDrug(SNO, QTY,userID)) {
				status = "Drugs Requested!!!";
			} else {
				status = "fail";
			}
			
			return status;
		} catch (Exception e) {
			return e.getMessage();
		}
		
	}
	
	@GET
	@Path("/getRequestedItems")
	@Produces(MediaType.APPLICATION_JSON)
	public String GetPrescriptionDispensedItems() {
		
		String result="";
		try {
			List<PcuRequesteditems> ItemList=pcuItemRequestDBDriver.GetRequestedItems();
			
			JSONSerializer serializer = new JSONSerializer();

			return serializer.exclude("*.class").serialize(ItemList);
			
		} catch (Exception e) {
			return e.getMessage();
		}
	}
	
	@GET
	@Path("/UpdateItems/{id}/{reqby}/{date}/{stat}")
	@Produces(MediaType.APPLICATION_JSON)
	public String UpdateItems(@PathParam("id") int ID,@PathParam("reqby") int REQBY,@PathParam("date") Date ReqDate, @PathParam("stat") String stat) {
		String status="";
		try {
			if (pcuItemRequestDBDriver.UpdateRequestedItems(ID, REQBY, ReqDate, stat)) {
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
			if (pcuItemRequestDBDriver.DeleteItems(ID)) {
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
