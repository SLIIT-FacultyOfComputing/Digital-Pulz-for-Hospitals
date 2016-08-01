package core.resources.pharmacy;

import java.util.List;

import javax.ws.rs.Consumes;
import javax.ws.rs.GET;
import javax.ws.rs.POST;
import javax.ws.rs.Path;
import javax.ws.rs.Produces;
import javax.ws.rs.core.MediaType;

import org.codehaus.jettison.json.JSONObject;


import core.classes.pharmacy.PhramacyAssitanceStock;
import flexjson.JSONSerializer;
import lib.driver.pharmacy.driver_class.PharmacyDBDriver;

@Path("PharmacyServices")
public class PharmacyResource {
	PharmacyDBDriver pharmacyDriver =new PharmacyDBDriver();
	
	@POST
	@Path("/insertDrug")
	@Produces(MediaType.TEXT_PLAIN)
	@Consumes(MediaType.APPLICATION_JSON)
	public String insertOrupdateDrug(JSONObject json){
		String action="An error Occured";
		try
		{  
			/*Create and assign values to PhramacyAssitanceStock object */
			PhramacyAssitanceStock pharmacy_assitance_stock=new PhramacyAssitanceStock();
			pharmacy_assitance_stock.setDrug_srno(Integer.parseInt(json.get("drug_srno").toString()));
			pharmacy_assitance_stock.setDrug_name(json.getString("drug_name"));
			pharmacy_assitance_stock.setDrugQty(Integer.parseInt(json.getString("drugQty")));
			//pharmacy_assitance_stock.setRequestedUserID(Integer.parseInt(json.getString("drug_reqid")));
			
			/*Create a object to the PhramacyDBDriver class and execute the method */
			
			System.out.println("\n\n\n"+json.getString("drugQty"));
			PharmacyDBDriver pharmacydbDriver =new PharmacyDBDriver();
			boolean result_assist=pharmacydbDriver.insertDrug(pharmacy_assitance_stock);
		    boolean result_main =pharmacydbDriver.MainStock(pharmacy_assitance_stock);
		    boolean result_deleterequest = pharmacydbDriver.DeleteRequsetDrug(Integer.parseInt(json.getString("drug_reqid")));
			if( (result_assist && result_main && result_deleterequest)== true)
				action="Action Sccueess ";
			
				
		}
		catch(Exception e)
		{
			System.out.println(e.getMessage());
		}
		return action;
		
	}
	
	@GET
	@Path("/drugStockTable")
	@Consumes(MediaType.APPLICATION_JSON)
	@Produces(MediaType.APPLICATION_JSON)
	public String loadNursesTable()
	{
		
		System.out.println("\tLoad the Pharmacy Stock Details Table\n");
		try
		{
			PharmacyDBDriver pd =new PharmacyDBDriver();
			List<PhramacyAssitanceStock> dataillist = pd.getDrugStockTable();

			JSONSerializer serializer = new JSONSerializer();
			return serializer.exclude("*.class").serialize(dataillist);
			
			
		}
		catch(Exception e){
			return e.getMessage().toString();
			
		}
	}
	

}
