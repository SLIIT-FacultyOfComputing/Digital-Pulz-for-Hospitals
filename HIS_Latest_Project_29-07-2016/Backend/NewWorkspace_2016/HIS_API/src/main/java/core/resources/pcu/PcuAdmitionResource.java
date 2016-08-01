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

import org.codehaus.jettison.json.JSONObject;
import org.hibernate.Session;

import lib.SessionFactoryUtil;
import lib.driver.api.driver_class.user.UserDBDriver;
import lib.driver.opd.driver_class.PatientDBDriver;
import lib.driver.pcu.driver_class.PcuAdmitionDBDriver;
import core.classes.api.user.AdminUser;
import core.classes.opd.OutPatient;
import core.classes.pcu.PcuAdmition;
import flexjson.JSONSerializer;

@Path("PcuAdmition")
public class PcuAdmitionResource {

	PcuAdmitionDBDriver pcuAdmitionDBDriver = new PcuAdmitionDBDriver();
	
	//http://localhost:8080/HIS_API/rest/PcuAdmition/SelectAll
	@GET
	@Path("/SelectAll")
	@Produces(MediaType.APPLICATION_JSON)
	public String SelectAll() {
		try {
			List<PcuAdmition> pcuAdmitionResult = pcuAdmitionDBDriver
					.SelectAll();
			JSONSerializer serializer = new JSONSerializer();
			return serializer.exclude("*.class").serialize(pcuAdmitionResult);

		} catch (Exception e) {
			return e.getMessage();
		}
	}
	
	//http://localhost:8080/HIS_API/rest/PcuAdmition/SelectSingle/{id}
	@GET
	@Path("/SelectSingle/{id}")
	@Produces(MediaType.APPLICATION_JSON)
	public String SelectSingle(@PathParam("id") int Id) {
		try {
			PcuAdmition pcuAdmitionResult = pcuAdmitionDBDriver
					.SelectSingle(Id);
			JSONSerializer serializer = new JSONSerializer();
			return serializer.exclude("*.class").serialize(pcuAdmitionResult);

		} catch (Exception e) {
			return e.getMessage();
		}
	}

	//http://localhost:8080/HIS_API/rest/PcuAdmition/SelectByPatientId/{patientNo}
	@GET
	@Path("/SelectByPatientId/{patientNo}")
	@Produces(MediaType.APPLICATION_JSON)
	public String SelectByPatientId(@PathParam("patientNo") int patientId) {
		try {
			List<PcuAdmition> pcuAdmitionResult = pcuAdmitionDBDriver
					.SelectByPatientId(patientId);
			JSONSerializer serializer = new JSONSerializer();
			return serializer.exclude("*.class").serialize(pcuAdmitionResult);

		} catch (Exception e) {
			return e.getMessage();
		}
	}

	//http://localhost:8080/HIS_API/rest/PcuAdmition/Save
	@POST
	@Path("/Save")
	@Produces(MediaType.APPLICATION_JSON)
	@Consumes(MediaType.APPLICATION_JSON)
	public String Save(JSONObject newObject) {
		AdminUser userObj = null;
		String status = "";
		
		try {
			userObj = new UserDBDriver().getUserDetailsByUserID(newObject.getInt("created_by")).get(0);
			OutPatient outPatientObj = new PatientDBDriver().getPatientDetails(newObject.getInt("patient_id"));
			PcuAdmition newPcuAdmition = new PcuAdmition();
			newPcuAdmition.setPatientId(outPatientObj);
			newPcuAdmition.setAdmitionDate(new SimpleDateFormat("yyyy-MM-dd HH:mm:ss").parse(newObject
					.getString("admition_date")));
			newPcuAdmition.setStatus(newObject.getString("status"));
			newPcuAdmition.setCreatedBy(userObj);
			newPcuAdmition.setCreatedTime(new SimpleDateFormat(
					"yyyy-MM-dd HH:mm:ss").parse(newObject
					.getString("created_time")));
			newPcuAdmition.setModifiedBy(userObj);
			newPcuAdmition.setModifiedTime(new SimpleDateFormat(
					"yyyy-MM-dd HH:mm:ss").parse(newObject
					.getString("modified_time")));
			if (pcuAdmitionDBDriver.Save(newPcuAdmition)) {
				status = "Save Success";
			} else {
				status = "fail";
			}
			return status;
		} catch (Exception e) {
			return e.getMessage();
		}
	}

	//http://localhost:8080/HIS_API/rest/PcuAdmition/Update
	@POST
	@Path("/Update")
	@Produces(MediaType.APPLICATION_JSON)
	@Consumes(MediaType.APPLICATION_JSON)
	public String Update(JSONObject updateObject) {
		AdminUser userObj = null;
		try {
			userObj = new UserDBDriver().getUserDetailsByUserID(updateObject.getInt("modified_by")).get(0);
			String status = "";
			if (pcuAdmitionDBDriver.Update(updateObject.getInt("admition_id")
					,updateObject.getString("status")
					,userObj
					,new SimpleDateFormat("yyyy-MM-dd HH:mm:ss").parse(updateObject
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
