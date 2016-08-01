package core.resources.hr;

import java.util.List;

import javax.ws.rs.GET;
import javax.ws.rs.Path;
import javax.ws.rs.Produces;
import javax.ws.rs.core.MediaType;

import lib.driver.hr.driver_class.HrDesignationDBDriver;
import lib.driver.hr.driver_class.HrDesignationgGrouDBDriver;
import core.classes.hr.HrDesignationgroup;
import flexjson.JSONSerializer;

@Path("HrGroupDesignation")
public class HrDesignationGroupResource {
	HrDesignationgGrouDBDriver hrDesignationGroupDBDriver= new HrDesignationgGrouDBDriver();
	
	@GET
	@Path("/getAllDesigsignationGroup")
	@Produces(MediaType.APPLICATION_JSON)
	public String GetAllDesigsignationGroup() {
		String result="";
		try {
			List<HrDesignationgroup> designationList=hrDesignationGroupDBDriver.GetAllDesigsignationGroup();
			
			JSONSerializer serializer = new JSONSerializer();

			return serializer.exclude("*.class").serialize(designationList);
			
		} catch (Exception e) {
			return e.getMessage();
		}
	}
}
