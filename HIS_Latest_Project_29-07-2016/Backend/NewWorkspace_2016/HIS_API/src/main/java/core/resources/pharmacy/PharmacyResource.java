package core.resources.pharmacy;

import java.util.List;

import javax.ws.rs.Consumes;
import javax.ws.rs.GET;
import javax.ws.rs.POST;
import javax.ws.rs.Path;
import javax.ws.rs.Produces;
import javax.ws.rs.core.MediaType;

import org.apache.log4j.Logger;
import org.codehaus.jettison.json.JSONException;
import org.codehaus.jettison.json.JSONObject;





import core.ErrorConstants;
import core.classes.pharmacy.PhramacyAssitanceStock;
import core.resources.lims.LabResource;
import flexjson.JSONSerializer;
import lib.driver.pharmacy.driver_class.PharmacyDBDriver;

@Path("PharmacyServices")
public class PharmacyResource {
	PharmacyDBDriver pharmacyDriver =new PharmacyDBDriver();
	
	final static Logger logger = Logger.getLogger(PharmacyResource.class);
	
	@POST
	@Path("/insertDrug")
	@Produces(MediaType.TEXT_PLAIN)
	@Consumes(MediaType.APPLICATION_JSON)
	public String insertOrupdateDrug(JSONObject json) throws JSONException{
		
		logger.info("Entering insertOrupdateDrug method...");
		String action="An error Occured";
		logger.info("insert or update drug");
		try
		{  
			/*Create and assign values to PhramacyAssitanceStock object */
			PhramacyAssitanceStock pharmacy_assitance_stock=new PhramacyAssitanceStock();
			pharmacy_assitance_stock.setDrug_srno(Integer.parseInt(json.get("drug_srno").toString()));
			pharmacy_assitance_stock.setDrug_name(json.getString("drug_name"));
			pharmacy_assitance_stock.setDrugQty(Integer.parseInt(json.getString("drugQty")));
			pharmacy_assitance_stock.setRequestedUserID(Integer.parseInt(json.getString("userId")));
			
			/*Create a object to the PhramacyDBDriver class and execute the method */
			
			System.out.println("\n\n\n"+json.getString("drugQty"));
			PharmacyDBDriver pharmacydbDriver =new PharmacyDBDriver();
			boolean result_assist=pharmacydbDriver.insertDrug(pharmacy_assitance_stock);
		    boolean result_main =pharmacydbDriver.MainStock(pharmacy_assitance_stock);
		    boolean result_deleterequest = pharmacydbDriver.DeleteRequsetDrug(Integer.parseInt(json.getString("drug_reqid")));
			if( (result_assist && result_main && result_deleterequest)== true)
				action="Action Sccueess ";
				
		}
		catch(NullPointerException e)
		{
			JSONObject jsonErrorObject = new JSONObject();
			jsonErrorObject.put("errorcode", ErrorConstants.INVALID_ID.getCode());
			jsonErrorObject.put("message", ErrorConstants.INVALID_ID.getMessage());
		}
		catch (JSONException e) 
		{
			JSONObject jsonErrorObject = new JSONObject();
			jsonErrorObject.put("errorcode", ErrorConstants.FILL_REQUIRED_FIELDS.getCode());
			jsonErrorObject.put("message", ErrorConstants.FILL_REQUIRED_FIELDS.getMessage());
		}
		catch (IndexOutOfBoundsException e) 
		{
			JSONObject jsonErrorObject = new JSONObject();
			jsonErrorObject.put("errorcode", ErrorConstants.INVALID_ID.getCode());
			jsonErrorObject.put("message", ErrorConstants.INVALID_ID.getMessage());
		}
		catch (RuntimeException e) 
		{
			logger.error("Exception in insertOrupdateDrug method : "+e.getMessage());
			
			JSONObject jsonErrorObject = new JSONObject();
			jsonErrorObject.put("errorcode", ErrorConstants.NO_CONNECTION.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_CONNECTION.getMessage());
						
			return jsonErrorObject.toString();
		}
		catch(Exception e)
		{
			logger.error("Exception in insertOrupdateDrug method : "+e.getMessage());
			
			System.out.println(e.getMessage());
			return e.getMessage();
		
		}
		return action;
		
	}
	
	@GET
	@Path("/drugStockTable")
	@Consumes(MediaType.APPLICATION_JSON)
	@Produces(MediaType.APPLICATION_JSON)
	public String loadNursesTable() throws JSONException
	{
		logger.info("Entering loadNursesTable method...");
		
		System.out.println("\tLoad the Pharmacy Stock Details Table\n");
		try
		{
			PharmacyDBDriver pd =new PharmacyDBDriver();
			List<PhramacyAssitanceStock> dataillist = pd.getDrugStockTable();

			JSONSerializer serializer = new JSONSerializer();
			return serializer.exclude("*.class").serialize(dataillist);
			
			
		}
		catch (RuntimeException e) 
		{
			logger.error("Exception in loadNursesTable : "+e.getMessage());
			
			JSONObject jsonErrorObject = new JSONObject();
			jsonErrorObject.put("errorcode", ErrorConstants.NO_CONNECTION.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_CONNECTION.getMessage());
						
			return jsonErrorObject.toString();
		}
		catch(Exception e){
			logger.error("Exception in loadNursesTable : "+e.getMessage());
			return e.getMessage().toString();
			
		}
	}
	

}
