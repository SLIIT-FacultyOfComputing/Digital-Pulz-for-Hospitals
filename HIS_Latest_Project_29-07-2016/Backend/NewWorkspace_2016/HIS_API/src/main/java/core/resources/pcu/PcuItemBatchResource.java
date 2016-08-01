package core.resources.pcu;

import java.sql.Date;
import java.util.List;

import javax.ws.rs.GET;
import javax.ws.rs.Path;
import javax.ws.rs.PathParam;
import javax.ws.rs.Produces;
import javax.ws.rs.core.MediaType;

import core.classes.pcu.PcuItembatch;
import flexjson.JSONSerializer;
import lib.driver.pcu.driver_class.PcuItemBatchDBDriver;

@Path("PcuItemBatch")
public class PcuItemBatchResource {
	
	PcuItemBatchDBDriver pcuItemBatchDBDriver = new PcuItemBatchDBDriver();
	
	@GET
	@Path("/getAll")
	@Produces(MediaType.APPLICATION_JSON)
	public String GetAllBatches() {
		String result="";
		try {
			List<PcuItembatch> ItemList=pcuItemBatchDBDriver.GetAllItems();
			
			JSONSerializer serializer = new JSONSerializer();

			return serializer.exclude("*.class").serialize(ItemList);
			
		} catch (Exception e) {
			return e.getMessage();
		}
	}
	
	@GET
	@Path("/UpdateItems/{bno}/{date}")
	@Produces(MediaType.APPLICATION_JSON)
	public String UpdateItems(@PathParam("bno") int BNO,@PathParam("date") Date rcvdDate) {
		String status="";
		try {
			if (pcuItemBatchDBDriver.UpdateItems(BNO, rcvdDate)) {
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
	@Path("/DeleteItems/{bno}")
	@Produces(MediaType.APPLICATION_JSON)
	public String DeleteItems(@PathParam("bno") int BNO) {
		String status="";
		try {
			if (pcuItemBatchDBDriver.DeleteItems(BNO)) {
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
