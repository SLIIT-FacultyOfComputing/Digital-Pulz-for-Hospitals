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
import lib.driver.pcu.driver_class.PcuItemsDBDriver;
import lib.driver.pcu.driver_class.PcuPrescriptionDBDriver;
import lib.driver.pcu.driver_class.PcuPrescriptionitemsDBDriver;

import org.codehaus.jettison.json.JSONObject;
import org.hibernate.Session;

import core.classes.pcu.PcuItems;
import core.classes.pcu.PcuPatientsymtoms;
import core.classes.pcu.PcuPrescription;
import core.classes.pcu.PcuPrescriptionitems;
import core.classes.pcu.PcuNursenote;
import core.classes.pcu.PcuPrescriptionitemsId;
import flexjson.JSONSerializer;

@Path("PcuPrescriptionitems")
public class PcuPrescriptionitemsResource {

	PcuPrescriptionitemsDBDriver pcuPrescriptionItemsDBDriver = new PcuPrescriptionitemsDBDriver();

	@GET
	@Path("/SelectAll")
	@Produces(MediaType.APPLICATION_JSON)
	public String SelectAll() {
		try {
			List<PcuPrescriptionitems> pcuPrescriptionItemsResult = pcuPrescriptionItemsDBDriver
					.SelectAll();
			JSONSerializer serializer = new JSONSerializer();
			return serializer.exclude("*.class").serialize(
					pcuPrescriptionItemsResult);

		} catch (Exception e) {
			return e.getMessage();
		}
	}
	
	@GET
	@Path("/SelectSingle/{prescptionId}/{itemId}")
	@Produces(MediaType.APPLICATION_JSON)
	public String SelectSingle(@PathParam("prescptionId") int prescptionId, @PathParam("itemId") int itemId) {
		try {
			PcuPrescriptionitems ItemList = pcuPrescriptionItemsDBDriver.SelectSingle(prescptionId,itemId);
			JSONSerializer serializer = new JSONSerializer();
			return serializer.exclude("*.class").serialize(ItemList);

		} catch (Exception e) {
			return e.getMessage();
		}
	}

	@GET
	@Path("/SelectByPrescriptionId/{prescriptionNo}")
	@Produces(MediaType.APPLICATION_JSON)
	public String SelectByPrescptionId(@PathParam("prescriptionNo") int patientId) {
		try {
			List<PcuPrescriptionitems> pcuPrescriptionItemsResult = pcuPrescriptionItemsDBDriver
					.SelectByPrescptionId(patientId);
			JSONSerializer serializer = new JSONSerializer();
			return serializer.exclude("*.class").serialize(
					pcuPrescriptionItemsResult);

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
			
			PcuItems itemObj = new PcuItemsDBDriver().SelectSingle(newObject.getInt("SNumber"));
			PcuPrescription prescriptionObj = new PcuPrescriptionDBDriver().SelectSingle(newObject.getInt("prescription_Id"));
			PcuPrescriptionitemsId pcuPrescriptionItemsId = new PcuPrescriptionitemsId();
			pcuPrescriptionItemsId.setPrescriptionId(prescriptionObj);
			pcuPrescriptionItemsId.setSNumber(itemObj);

			PcuPrescriptionitems newPcuPrescriptionitems = new PcuPrescriptionitems();
			newPcuPrescriptionitems.setId(pcuPrescriptionItemsId);
			newPcuPrescriptionitems.setPeriodInHours(Float.parseFloat(newObject
					.getString("period_In_Hours")));
			newPcuPrescriptionitems.setFrequencyOfDrug(Float
					.parseFloat(newObject.getString("frequency_Of_Drug")));
			newPcuPrescriptionitems.setQuanity(Float.parseFloat(newObject
					.getString("quanity")));
			newPcuPrescriptionitems.setStartedDate(new SimpleDateFormat(
					"yyyy-MM-dd HH:mm:ss").parse(newObject
					.getString("started_Date")));
			newPcuPrescriptionitems.setClosedDate(new SimpleDateFormat(
					"yyyy-MM-dd HH:mm:ss").parse(newObject
					.getString("closed_Date")));
			newPcuPrescriptionitems.setStatus(newObject.getString("status"));
			if (pcuPrescriptionItemsDBDriver.Save(newPcuPrescriptionitems)) {
				status = "Save Success";
			} else {
				status = "fail";
			}
			return status;
		} catch (Exception e) {
			return e.getMessage();
		}
	}
}
