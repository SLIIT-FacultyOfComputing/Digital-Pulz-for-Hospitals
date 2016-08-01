package core.resources.pcu;

import java.util.List;

import javax.ws.rs.Consumes;
import javax.ws.rs.GET;
import javax.ws.rs.POST;
import javax.ws.rs.Path;
import javax.ws.rs.PathParam;
import javax.ws.rs.Produces;
import javax.ws.rs.core.MediaType;

import lib.driver.pcu.driver_class.PcuAdmitionDBDriver;
import lib.driver.pcu.driver_class.PcuPatientsymtomsDBDriver;

import org.codehaus.jettison.json.JSONObject;

import core.classes.pcu.PcuAdmition;
import core.classes.pcu.PcuNursenote;
import core.classes.pcu.PcuPatientsymtoms;
import flexjson.JSONSerializer;

@Path("PcuPatientsymtoms")
public class PcuPatientsymtomsResource {

	PcuPatientsymtomsDBDriver symtomsDBDriver = new PcuPatientsymtomsDBDriver();

	@GET
	@Path("/SelectAll")
	@Produces(MediaType.APPLICATION_JSON)
	public String SelectAll() {
		try {
			List<PcuPatientsymtoms> ItemList = symtomsDBDriver.SelectAll();
			JSONSerializer serializer = new JSONSerializer();
			return serializer.exclude("*.class").serialize(ItemList);

		} catch (Exception e) {
			return e.getMessage();
		}
	}
	
	@GET
	@Path("/SelectSingle/{Id}")
	@Produces(MediaType.APPLICATION_JSON)
	public String SelectSingle(@PathParam("Id") int Id) {
		try {
			PcuPatientsymtoms ItemList = symtomsDBDriver.SelectSingle(Id);
			JSONSerializer serializer = new JSONSerializer();
			return serializer.exclude("*.class").serialize(ItemList);

		} catch (Exception e) {
			return e.getMessage();
		}
	}

	@GET
	@Path("/SelectByPatientId/{patientNo}")
	@Produces(MediaType.APPLICATION_JSON)
	public String SelectByPatientId(@PathParam("patientNo") int patientId) {
		try {
			List<PcuPatientsymtoms> result = symtomsDBDriver.SelectByPatientId(patientId);
			JSONSerializer serializer = new JSONSerializer();
			return serializer.exclude("*.class").serialize(result);

		} catch (Exception e) {
			return e.getMessage();
		}
	}

	@POST
	@Path("/Save")
	@Produces(MediaType.APPLICATION_JSON)
	@Consumes(MediaType.APPLICATION_JSON)
	public String Save(JSONObject newObject) {
		String status = "";
		try {
			PcuAdmition admitonObj = new PcuAdmitionDBDriver().SelectSingle(newObject.getInt("pcu_patient_id"));
			PcuPatientsymtoms newPcuPatientsymtoms = new PcuPatientsymtoms();
			newPcuPatientsymtoms.setPcuPatientId(admitonObj);
			newPcuPatientsymtoms.setSymtomsDetails(newObject.getString("symtoms_details"));
			newPcuPatientsymtoms.setStatus(newObject.getString("status"));
			if (symtomsDBDriver.Save(newPcuPatientsymtoms)) {
				status = "Save Success";
			} else {
				status = "fail";
			}
			return status;
		} catch (Exception e) {
			return e.getMessage();
		}
	}

	@POST
	@Path("/Update")
	@Produces(MediaType.APPLICATION_JSON)
	@Consumes(MediaType.APPLICATION_JSON)
	public String Update(JSONObject updateObject) {
		String status = "";
		try {
			if (symtomsDBDriver.Update(updateObject.getInt("symtoms_id"),
					updateObject.getString("symtoms_details"),
					updateObject.getString("status"))) {
				status = "Update Success";
			} else {
				status = "fail";
			}
			return status;
		} catch (Exception e) {
			return e.getMessage();
		}
	}

}
