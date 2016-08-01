package core.resources.pcu;

import java.util.List;

import javax.ws.rs.GET;
import javax.ws.rs.Path;
import javax.ws.rs.Produces;
import javax.ws.rs.core.MediaType;

import core.classes.pcu.PcuExpireditems;
import core.classes.pcu.PcuItemstockday;
import core.classes.pcu.PcuPrescriptiondispense;
import core.classes.pcu.PcuViewinventory;
import core.classes.pcu.PcuViewinventoryId;
import flexjson.JSONSerializer;
import lib.driver.pcu.driver_class.PcuMainDBDriver;

@Path("PcuMain")
public class PcuMainResource {
	
	PcuMainDBDriver pcuMainDBDriver = new PcuMainDBDriver();
	
	@GET
	@Path("/getInventoryItems")
	@Produces(MediaType.APPLICATION_JSON)
	public String GetPrescriptionDispensedItems() {
		
		String result="";
		try {
			List<PcuViewinventory> ItemList=pcuMainDBDriver.GetInventoryItems();
			
			JSONSerializer serializer = new JSONSerializer();

			return serializer.exclude("*.class").serialize(ItemList);
			
		} catch (Exception e) {
			return e.getMessage();
		}
	}
	
	@GET
	@Path("/getReorderCount")
	@Produces(MediaType.APPLICATION_JSON)
	public String GetReorderCount() {
		
		String result="";
		try {
			int  count =pcuMainDBDriver.ItemsBelowCount();
			
			JSONSerializer serializer = new JSONSerializer();

			return serializer.exclude("*.class").serialize(count);
			
		} catch (Exception e) {
			return e.getMessage();
		}
	}
	
	@GET
	@Path("/getReorderItems")
	@Produces(MediaType.APPLICATION_JSON)
	public String GetReorderItems() {
		
		String result="";
		try {
			List<PcuViewinventory> ItemList=pcuMainDBDriver.GetItemsBelow();
			
			JSONSerializer serializer = new JSONSerializer();

			return serializer.exclude("*.class").serialize(ItemList);
			
		} catch (Exception e) {
			return e.getMessage();
		}
	}
	
	@GET
	@Path("/getExpiredCount")
	@Produces(MediaType.APPLICATION_JSON)
	public String GetExpiredCount() {
		
		String result="";
		try {
			int count =pcuMainDBDriver.ItemsExpiredCount();
			
			JSONSerializer serializer = new JSONSerializer();

			return serializer.exclude("*.class").serialize(count);
			
		} catch (Exception e) {
			return e.getMessage();
		}
	}
	
	@GET
	@Path("/getExpiredItems")
	@Produces(MediaType.APPLICATION_JSON)
	public String GetExpiredItems() {
		
		String result="";
		try {
			List<PcuExpireditems> ItemList=pcuMainDBDriver.GetExpiredItems();
			
			JSONSerializer serializer = new JSONSerializer();

			return serializer.exclude("*.class").serialize(ItemList);
			
		} catch (Exception e) {
			return e.getMessage();
		}
	}
	
	@GET
	@Path("/getStocks")
	@Produces(MediaType.APPLICATION_JSON)
	public String GetStock() {
		
		String result="";
		try {
			List<PcuItemstockday> ItemList=pcuMainDBDriver.GetStockPerDay();
			
			JSONSerializer serializer = new JSONSerializer();

			return serializer.exclude("*.class").serialize(ItemList);
			
		} catch (Exception e) {
			return e.getMessage();
		}
	}
}
