package core.resources.pcu;

import java.text.DateFormat;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.List;

import javax.ws.rs.Consumes;
import javax.ws.rs.GET;
import javax.ws.rs.POST;
import javax.ws.rs.Path;
import javax.ws.rs.Produces;
import javax.ws.rs.core.MediaType;

import lib.driver.pcu.driver_class.PcuItemAddDBDriver;

import org.codehaus.jettison.json.JSONObject;

import core.classes.pcu.PcuItembatchrelation;
import core.classes.pcu.PcuItembatchrelationId;
import core.classes.pharmacy.MstDrugsNew;
import flexjson.JSONSerializer;

@Path("PcuItemAdd")
public class PcuItemAddResource {
	
PcuItemAddDBDriver pcuItemAddDBDriver = new PcuItemAddDBDriver();
	
	@GET
	@Path("/getAllItemIDs")
	@Produces(MediaType.APPLICATION_JSON)
	public String GetAllItemIDs() {
		String result="";
		try {
			List<MstDrugsNew> ItemList=pcuItemAddDBDriver.GetAllItemIDs();
			
			JSONSerializer serializer = new JSONSerializer();

			return serializer.exclude("*.class").serialize(ItemList);
			
		} catch (Exception e) {
			return e.getMessage();
		}
	}
	@GET
	@Path("/getBatchID")
	@Produces(MediaType.APPLICATION_JSON)
	public String GetBatchID() {
		String result="";
		try {
			int batch=pcuItemAddDBDriver.GetBatch();
			
			JSONSerializer serializer = new JSONSerializer();

			return serializer.exclude("*.class").serialize(batch);
			
		} catch (Exception e) {
			return e.getMessage();
		}
	}
	@POST
	@Path("/AddItem")
	@Produces(MediaType.TEXT_PLAIN)
	@Consumes(MediaType.APPLICATION_JSON)
	public String addItem(JSONObject json) {
		
		
		
		String status="";
		
		DateFormat dateFormat = new SimpleDateFormat("yyyy-MM-dd");
		
		try {
			
			//JSONArray dispenseJSONList = json.getJSONObject("dispense").getJSONArray("dispenseList");
			List<PcuItembatchrelation> itemList = new ArrayList<PcuItembatchrelation>();

			for (int i = 0; i < json.length(); i++) {
				
//				Date parsedDate = (Date) dateFormat.parse(json.getJSONObject(i+"").getString("Expiry"));
//				SimpleDateFormat print = new SimpleDateFormat("yyyy/MM/dd");
				
				System.out.println(json.getJSONObject(""+i).getInt("SNumber"));
				System.out.println(json.getJSONObject(i+"").getString("Expiry"));		
				
				// set dispense drug values
				PcuItembatchrelation item = new PcuItembatchrelation();
				PcuItembatchrelationId id = new PcuItembatchrelationId();
				id.setSNumber(json.getJSONObject(""+i).getInt("SNumber"));
				id.setBatchNo(json.getJSONObject(i+"").getInt("Batch"));
				item.setId(id);
				item.setQuantity((float)json.getJSONObject(i+"").getDouble("Quantity"));
				item.setExpiryDate(dateFormat.parse(json.getJSONObject(i+"").getString("Expiry")));
				itemList.add(item);
			}
					
			
			if (pcuItemAddDBDriver.AddItems(itemList)) {
				status = "Drugs have being added!!!";
			} else {
				status = "fail";
			}

			return status;

		} catch (Exception e) {
			e.printStackTrace();
			return e.getMessage();
		}
		
	}

}
