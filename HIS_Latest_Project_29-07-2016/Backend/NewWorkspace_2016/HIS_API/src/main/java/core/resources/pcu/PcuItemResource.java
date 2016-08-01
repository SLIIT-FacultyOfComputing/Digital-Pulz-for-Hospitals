package core.resources.pcu;

import java.util.List;

import javax.ws.rs.GET;
import javax.ws.rs.Path;
import javax.ws.rs.PathParam;
import javax.ws.rs.Produces;
import javax.ws.rs.core.MediaType;






import core.classes.pcu.PcuItems;
import flexjson.JSONSerializer;
import lib.driver.pcu.driver_class.PcuItemsDBDriver;


@Path("PcuItem")
public class PcuItemResource {
	PcuItemsDBDriver pcuItemDBDriver = new PcuItemsDBDriver();
	
	@GET
	@Path("/getAllItemIDs")
	@Produces(MediaType.APPLICATION_JSON)
	public String GetAllItemIDs() {
		String result="";
		try {
			List<PcuItems> ItemList=pcuItemDBDriver.GetAllItemIDs();
			
			JSONSerializer serializer = new JSONSerializer();

			return serializer.exclude("*.class").serialize(ItemList);
			
		} catch (Exception e) {
			return e.getMessage();
		}
	}
	@GET
	@Path("/getAllItems")
	@Produces(MediaType.APPLICATION_JSON)
	public String GetAllItems() {
		String result="";
		try {
			List<PcuItems> ItemList=pcuItemDBDriver.GetAllItems();
			
			JSONSerializer serializer = new JSONSerializer();

			return serializer.exclude("*.class").serialize(ItemList);
			
		} catch (Exception e) {
			return e.getMessage();
		}
	}
	@GET
	@Path("/UpdateItems/{sno}/{rorder}/{measure}")
	@Produces(MediaType.APPLICATION_JSON)
	public String UpdateItems(@PathParam("sno") int SNO,@PathParam("rorder") float ReOrder,@PathParam("measure") String Measure) {
		String status="";
		try {
			if (pcuItemDBDriver.UpdateItems(SNO, ReOrder, Measure)) {
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
	@Path("/DeleteItems/{sno}")
	@Produces(MediaType.APPLICATION_JSON)
	public String UpdateItems(@PathParam("sno") int SNO) {
		String status="";
		try {
			if (pcuItemDBDriver.DeleteItems(SNO)) {
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
