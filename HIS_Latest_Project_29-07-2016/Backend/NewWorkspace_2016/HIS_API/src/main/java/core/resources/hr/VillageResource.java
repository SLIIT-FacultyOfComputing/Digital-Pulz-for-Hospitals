package core.resources.hr;

import java.util.List;

import javax.ws.rs.GET;
import javax.ws.rs.Path;
import javax.ws.rs.PathParam;
import javax.ws.rs.Produces;
import javax.ws.rs.core.MediaType;

import org.apache.log4j.Logger;
import org.codehaus.jettison.json.JSONException;
import org.codehaus.jettison.json.JSONObject;

import lib.driver.hr.driver_class.VillageDBDriver;
import core.ErrorConstants;
import core.classes.hr.Village;
import core.resources.opd.AllergyResource;
import flexjson.JSONSerializer;

@Path("Village")
public class VillageResource {

	final static Logger log = Logger.getLogger(VillageResource.class);
	VillageDBDriver villageDBDriver = new VillageDBDriver();
	
	@GET
	@Path("/getVillageOnSearch/{village}")
	@Produces(MediaType.APPLICATION_JSON)
	public String getVillageOnSearch(@PathParam("village")  String villageName) throws JSONException {
		
		
		try {
			List<Village> villageList=villageDBDriver.getVillageOnSearch(villageName);
			
			JSONSerializer serializer = new JSONSerializer();

			return serializer.include("vgeId","province","province","district","dsdivision","gndivision").exclude("*").serialize(villageList);
			
		} 
		catch(RuntimeException e)
		{
			log.error("Runtime Exception in searching for village name, message:" + e.getMessage());
			JSONObject jsonErrorObject = new JSONObject();
			
			jsonErrorObject.put("errorcode", ErrorConstants.NO_CONNECTION.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_CONNECTION.getMessage());
			
			
			return jsonErrorObject.toString(); 
		}
		catch(Exception e)
		{
			log.error("Error while searching for village name, message:" + e.getMessage());
			
			JSONObject jsonErrorObject = new JSONObject();
			
			jsonErrorObject.put("errorcode", ErrorConstants.NO_DATA.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_DATA.getMessage());
			
			return jsonErrorObject.toString(); 
			
		}
	}
}
