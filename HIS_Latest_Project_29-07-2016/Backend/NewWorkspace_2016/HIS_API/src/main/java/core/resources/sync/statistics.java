package core.resources.sync;

import java.util.List;
import javax.ws.rs.GET;
import javax.ws.rs.Path;
import javax.ws.rs.Produces;
import javax.ws.rs.core.MediaType;
import org.codehaus.jettison.json.JSONArray;
import org.codehaus.jettison.json.JSONException;
import org.codehaus.jettison.json.JSONObject;
import lib.driver.hr.driver_class.HrEmployeeDBDriver;
import lib.driver.inward.driver_class.admin.BedDBDriver;
import lib.driver.inward.driver_class.admin.WardDBDriver;
import core.classes.inward.admin.Bed;
import core.classes.inward.admin.Ward;

@Path("/statistics")
public class statistics {

	HrEmployeeDBDriver hrEmployeeDBDriver=new HrEmployeeDBDriver();
	WardDBDriver warddbdriver = new WardDBDriver();
	BedDBDriver beddbdriver = new BedDBDriver();
	
	@GET
	@Path("/getWardStats")
	@Produces(MediaType.APPLICATION_JSON)
	public JSONObject getWard()
	{
		List<Ward> wardList =warddbdriver.getWardList();
		JSONObject res = new JSONObject();
		JSONArray WardsArray= new JSONArray();
		try {
			for(Ward w : wardList){
				JSONObject ob = new JSONObject();
				List<Bed> bedList =beddbdriver.getAllBedByWardNo(w.getWardNo());				
				ob.put("ward_no",w.getWardNo());
				ob.put("category",w.getCategory());
				ob.put("gender",w.getWardGender());
				ob.put("beds",bedList.size());
				WardsArray.put(ob);
			}
			res.put("Ward", WardsArray);
		} catch (JSONException e) {
			e.printStackTrace();
		}
		return  res;
	}
}
