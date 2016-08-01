package core.resources.opd;

import java.util.Date;
import java.util.List;

import javax.ws.rs.Consumes;
import javax.ws.rs.GET;
import javax.ws.rs.POST;
import javax.ws.rs.PUT;
import javax.ws.rs.Path;
import javax.ws.rs.PathParam;
import javax.ws.rs.Produces;
import javax.ws.rs.core.MediaType;

import lib.driver.opd.driver_class.AllergyDBDriver;

import org.codehaus.jettison.json.JSONException;
import org.codehaus.jettison.json.JSONObject;

import core.classes.opd.Allergy;
import core.classes.opd.LiveAllergy;
import core.classes.opd.LiveInjury;
import flexjson.JSONSerializer;

@Path("LiveSearch")
public class LiveSearch {
AllergyDBDriver allergyDBDriver=new AllergyDBDriver();
	
	/** Add New Allergy For particular Visit
	 * @param ajson A Json Object that contains New Allergy Details
	 * @return If Data Inserted Successfully return is True else False
	 */
@GET
@Path("/allergyLivesearch")
@Produces (MediaType.APPLICATION_JSON)
public String getAllergyLive() {
	
	List<LiveAllergy> allergyList=allergyDBDriver.liveSearchAllergy();
	JSONSerializer serializer = new JSONSerializer();
	return 	serializer.exclude("*.class").serialize(allergyList);
}
@GET
@Path("/injuryLivesearch")
@Produces (MediaType.APPLICATION_JSON)
public String getInjuryLive() {
	
	List<LiveInjury> allergyList=allergyDBDriver.liveSearchInjury();
	JSONSerializer serializer = new JSONSerializer();
	return 	serializer.exclude("*.class").serialize(allergyList);
}
}
