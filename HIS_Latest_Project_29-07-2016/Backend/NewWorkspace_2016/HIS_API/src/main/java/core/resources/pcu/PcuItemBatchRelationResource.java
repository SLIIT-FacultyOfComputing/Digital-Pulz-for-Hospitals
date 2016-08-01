package core.resources.pcu;

import java.sql.Date;
import java.util.List;

import javax.ws.rs.GET;
import javax.ws.rs.Path;
import javax.ws.rs.PathParam;
import javax.ws.rs.Produces;
import javax.ws.rs.core.MediaType;

import lib.driver.pcu.driver_class.PcuItemBatchRelationDBDriver;
import core.classes.pcu.PcuItembatchrelation;
import flexjson.JSONSerializer;

@Path("PcuBatchItemRelation")
public class PcuItemBatchRelationResource {
	
	PcuItemBatchRelationDBDriver pcuItemBatchRelationDBDriver = new PcuItemBatchRelationDBDriver();
	
	@GET
	@Path("/getAllItems")
	@Produces(MediaType.APPLICATION_JSON)
	public String GetAllItems() {
		String result="";
		try {
			List<PcuItembatchrelation> ItemList=pcuItemBatchRelationDBDriver.GetAllItems();
			
			JSONSerializer serializer = new JSONSerializer();

			return serializer.exclude("*.class").serialize(ItemList);
			
		} catch (Exception e) {
			return e.getMessage();
		}
	}
	
	@GET
	@Path("/UpdateItems/{sno}/{bno}/{newbno}/{qty}/{expiry}")
	@Produces(MediaType.APPLICATION_JSON)
	public String UpdateItems(@PathParam("sno") int SNO,@PathParam("bno") int BNO,@PathParam("bno") int newBNO,@PathParam("qty") float QTY, @PathParam("expiry") Date exDate) {
		String status="";
		try {
			if (pcuItemBatchRelationDBDriver.UpdateItems(SNO, newBNO, BNO, QTY, exDate)) {
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
			if (pcuItemBatchRelationDBDriver.DeleteItems(SNO, BNO)) {
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
