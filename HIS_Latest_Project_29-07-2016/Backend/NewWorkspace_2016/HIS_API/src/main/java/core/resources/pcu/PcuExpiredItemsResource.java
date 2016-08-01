package core.resources.pcu;

import java.sql.Date;
import java.util.List;

import javax.ws.rs.GET;
import javax.ws.rs.Path;
import javax.ws.rs.PathParam;
import javax.ws.rs.Produces;
import javax.ws.rs.core.MediaType;

import core.classes.pcu.PcuExpireditems;
import flexjson.JSONSerializer;
import lib.driver.pcu.driver_class.PcuExpiredItemsDBDriver;

@Path("PcuExpired")
public class PcuExpiredItemsResource {
	
	PcuExpiredItemsDBDriver pcuExpiredItemsDBDriver = new PcuExpiredItemsDBDriver();
	
	@GET
	@Path("/getExpiredItems")
	@Produces(MediaType.APPLICATION_JSON)
	public String GetPrescriptionDispensedItems() {
		
		String result="";
		try {
			List<PcuExpireditems> ItemList=pcuExpiredItemsDBDriver.GetManuallyDispensedItems();
			
			JSONSerializer serializer = new JSONSerializer();

			return serializer.exclude("*.class").serialize(ItemList);
			
		} catch (Exception e) {
			return e.getMessage();
		}
	}
	
	@GET
	@Path("/UpdateItems/{sno}/{bno}/{qty}/{date}")
	@Produces(MediaType.APPLICATION_JSON)
	public String UpdateItems(@PathParam("sno") int SNO,@PathParam("bno") int BNO,@PathParam("qty") float QTY, @PathParam("date") Date ExDate) {
		String status="";
		try {
			if (pcuExpiredItemsDBDriver.UpdateItems(SNO, BNO, QTY, ExDate)) {
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
	@Path("/DeleteItems/{sno}/{bno}")
	@Produces(MediaType.APPLICATION_JSON)
	public String DeleteItems(@PathParam("sno") int SNO,@PathParam("bno") int BNO) {
		String status="";
		try {
			if (pcuExpiredItemsDBDriver.DeleteItems(SNO,BNO)) {
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
