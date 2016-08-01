package core.resources.pcu;

import java.text.SimpleDateFormat;
import java.util.List;

import javax.ws.rs.Consumes;
import javax.ws.rs.GET;
import javax.ws.rs.POST;
import javax.ws.rs.Path;
import javax.ws.rs.PathParam;
import javax.ws.rs.Produces;
import javax.ws.rs.core.MediaType;

import org.codehaus.jettison.json.JSONException;
import org.codehaus.jettison.json.JSONObject;

import core.classes.api.user.AdminUser;
import core.classes.pcu.PcuAdmition;
import core.classes.pcu.PcuNursenote;
import flexjson.JSONSerializer;
import lib.driver.api.driver_class.user.UserDBDriver;
import lib.driver.pcu.driver_class.PcuAdmitionDBDriver;
import lib.driver.pcu.driver_class.PcuNursenoteDBDriver;

@Path("PcuNursenote")
public class PcuNursenoteResource {

	PcuNursenoteDBDriver pcuNurseNoteDBDriver = new PcuNursenoteDBDriver();

	@GET
	@Path("/SelectAll")
	@Produces(MediaType.APPLICATION_JSON)
	public String SelectAll() {
		try {
			List<PcuNursenote> ItemList = pcuNurseNoteDBDriver.SelectAll();
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
			PcuNursenote ItemList = pcuNurseNoteDBDriver.SelectSingle(Id);
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
			List<PcuNursenote> result = pcuNurseNoteDBDriver
					.SelectByPatientId(patientId);
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
		AdminUser userObj = null;
		PcuAdmition admitonObj = null;
		try {
			admitonObj = new PcuAdmitionDBDriver().SelectSingle(newObject.getInt("pcu_patient_id"));
			userObj = new UserDBDriver().getUserDetailsByUserID(newObject.getInt("note_by")).get(0);
		} catch (JSONException e1) {
			e1.printStackTrace();
		}
		try {
			PcuNursenote newPcuNursenote = new PcuNursenote();
			newPcuNursenote.setPcuPatientId(admitonObj);
			newPcuNursenote.setNoteDetails(newObject.getString("note_details"));
			newPcuNursenote.setNoteBy(userObj);
			newPcuNursenote.setNoteTime(new SimpleDateFormat("yyyy-MM-dd HH:mm:ss").parse(newObject
					.getString("note_time")));
			newPcuNursenote.setModifiedBy(userObj);
			newPcuNursenote.setModifiedTime(new SimpleDateFormat("yyyy-MM-dd HH:mm:ss").parse(newObject
							.getString("modified_time")));
			
			if (pcuNurseNoteDBDriver.Save(newPcuNursenote)) {
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
		AdminUser userObj = null;
		try {
			userObj = new UserDBDriver().getUserDetailsByUserID(updateObject.getInt("modified_by")).get(0);
			if (pcuNurseNoteDBDriver.Update(updateObject.getInt("note_id"),
					updateObject.getString("note_details"), userObj, new SimpleDateFormat(
							"yyyy-MM-dd HH:mm:ss").parse(updateObject
							.getString("modified_time")))) {
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
