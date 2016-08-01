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

import lib.SessionFactoryUtil;
import lib.driver.api.driver_class.user.UserDBDriver;
import lib.driver.pcu.driver_class.PcuAdmitionDBDriver;
import lib.driver.pcu.driver_class.PcuPrescriptionDBDriver;

import org.codehaus.jettison.json.JSONObject;
import org.hibernate.Session;

import core.classes.api.user.AdminUser;
import core.classes.pcu.PcuAdmition;
import core.classes.pcu.PcuPrescription;
import core.classes.pcu.PcuNursenote;
import flexjson.JSONSerializer;

@Path("PcuPrescriptionDetails")
public class PcuPrescriptionResource {

	PcuPrescriptionDBDriver pcuPrescriptionDBDriver = new PcuPrescriptionDBDriver();

	@GET
	@Path("/SelectAll")
	@Produces(MediaType.APPLICATION_JSON)
	public String SelectAll() {
		try {
			List<PcuPrescription> pcuPrescriptionResult = pcuPrescriptionDBDriver
					.SelectAll();
			JSONSerializer serializer = new JSONSerializer();
			return serializer.exclude("*.class").serialize(
					pcuPrescriptionResult);

		} catch (Exception e) {
			return e.getMessage();
		}
	}

	@GET
	@Path("/SelectByPatientId/{patientNo}")
	@Produces(MediaType.APPLICATION_JSON)
	public String SelectByPatientId(@PathParam("patientNo") int patientId) {
		try {
			List<PcuPrescription> pcuPrescriptionResult = pcuPrescriptionDBDriver
					.SelectByPatientId(patientId);
			JSONSerializer serializer = new JSONSerializer();
			return serializer.exclude("*.class").serialize(
					pcuPrescriptionResult);

		} catch (Exception e) {
			return e.getMessage();
		}
	}
	
	@GET
	@Path("/SelectSingle/{Id}")
	@Produces(MediaType.APPLICATION_JSON)
	public String SelectSingle(@PathParam("Id") int Id) {
		try {
			PcuPrescription pcuPrescriptionResult = pcuPrescriptionDBDriver
					.SelectSingle(Id);
			JSONSerializer serializer = new JSONSerializer();
			return serializer.exclude("*.class").serialize(
					pcuPrescriptionResult);

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
			AdminUser userObj = new UserDBDriver().getUserDetailsByUserID(newObject.getInt("created_by")).get(0);
			PcuAdmition admitonObj = new PcuAdmitionDBDriver().SelectSingle(newObject.getInt("pcu_patient_id"));
			PcuPrescription newPcuPrescription = new PcuPrescription();
			newPcuPrescription.setPcuPatientId(admitonObj);
			newPcuPrescription.setDoctorId(newObject.getInt("doctor_Id"));
			newPcuPrescription.setPrescriptionDetails(newObject
					.getString("prescription_Details"));
			newPcuPrescription.setPrescriptionDate(new SimpleDateFormat(
					"yyyy-MM-dd HH:mm:ss").parse(newObject
					.getString("prescription_Date")));
			newPcuPrescription.setCreatedBy(userObj);
			newPcuPrescription.setCreatedTime(new SimpleDateFormat(
					"yyyy-MM-dd HH:mm:ss").parse(newObject
					.getString("created_time")));
			newPcuPrescription.setModifiedBy(userObj);
			newPcuPrescription.setModifiedTime(new SimpleDateFormat(
					"yyyy-MM-dd HH:mm:ss").parse(newObject
					.getString("modified_time")));
			if (pcuPrescriptionDBDriver.Save(newPcuPrescription)) {
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
		try {
			String status = "";
			AdminUser userObj = new UserDBDriver().getUserDetailsByUserID(updateObject.getInt("modified_by")).get(0);
			if (pcuPrescriptionDBDriver.Update(updateObject.getInt("prescrption_id")
					,updateObject.getString("prescription_Details")
					,userObj
					,new SimpleDateFormat("yyyy-MM-dd HH:mm:ss").parse(updateObject.getString("modified_time")))) {
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
