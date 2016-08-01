package core.resources.inward.prescription;

import java.text.DateFormat;
import java.text.SimpleDateFormat;
import java.util.List;

import javax.ws.rs.Consumes;
import javax.ws.rs.GET;
import javax.ws.rs.POST;
import javax.ws.rs.PUT;
import javax.ws.rs.Path;
import javax.ws.rs.PathParam;
import javax.ws.rs.Produces;
import javax.ws.rs.core.MediaType;

import org.codehaus.jettison.json.JSONObject;
import org.hibernate.Criteria;
import org.hibernate.Session;
import org.hibernate.criterion.Order;
import org.hibernate.criterion.Restrictions;

import core.classes.inward.prescription.PrescriptionItem;
import core.classes.inward.prescription.PrescriptionTerms;
import flexjson.JSONException;
import flexjson.JSONSerializer;
import lib.SessionFactoryUtil;
import lib.driver.inward.driver_class.prescription.PrescriptionItemDBDrive;

@Path("PrescriptionItem")
public class PrescriptionItemResource {

	PrescriptionItemDBDrive requestdbDriver = new PrescriptionItemDBDrive();
	DateFormat dateformat = new SimpleDateFormat("yyyy-MM-dd'T'HH:mm");

	@POST
	@Path("/addNewPrescrptionItem")
	@Produces(MediaType.APPLICATION_JSON)
	@Consumes(MediaType.APPLICATION_JSON)
	public String addNewPrescrptionItem(JSONObject wJson) {

		try {
			PrescriptionItem newterm = new PrescriptionItem();

			int drug_id = wJson.getInt("drug_id");
			int term_id = wJson.getInt("term_id");
			newterm.setDose(wJson.getInt("dose"));
			newterm.setFrequency(wJson.getString("frequency"));
			newterm.setStatus(wJson.getString("status"));

			requestdbDriver.addNewPrescrptionItem(newterm, drug_id, term_id);

			return "true";
		} catch (Exception e) {
			System.out.println(e.getMessage());

			return e.getMessage().toString();
		}

	}

	@POST
	@Path("/UpdatePrescrptionItem")
	@Produces(MediaType.TEXT_PLAIN)
	@Consumes(MediaType.APPLICATION_JSON)
	public String UpdatePrescrptionItem(JSONObject wJson) {

		String result = "false";
		boolean r = false;

		try {
			int auto_id = wJson.getInt("auto_id");
			int Dose = wJson.getInt("dose");
			String Frequnecy = wJson.getString("frequency");
			String status = wJson.getString("status");
			r = requestdbDriver.UpdatePrescrptionItem(auto_id,Dose,Frequnecy,status);
			result = String.valueOf(r);

			return result;

		} catch (JSONException ex) {
			ex.printStackTrace();
			return result;
		}

		catch (Exception ex) {
			ex.printStackTrace();
			return ex.getMessage();
		}

	}

	@GET
	@Path("/getPrescrptionItemsByBHTNo/{bhtNo}")
	@Produces(MediaType.APPLICATION_JSON)
	public String getPrescrptionItemsByBHTNo(@PathParam("bhtNo") String bhtNo) {
		String result = "";
		List<PrescriptionItem> req = requestdbDriver.getPrescrptionItemsByBHTNo(bhtNo);
		JSONSerializer serializor = new JSONSerializer();
		result = serializor.serialize(req);
		return result;
	}

	@GET
	@Path("/getPrescrptionItemsByTermID/{term_id}")
	@Produces(MediaType.APPLICATION_JSON)
	public String getPrescrptionItemsByTermID(@PathParam("term_id") int term_id) {
		String result = "";
		List<PrescriptionItem> req = requestdbDriver.getPrescrptionItemsByTermID(term_id);
		JSONSerializer serializor = new JSONSerializer();
		result = serializor.serialize(req);
		return result;
	}

	@GET
	@Path("/getMaxTermID")

	public String getMaxTermIDByUserID() {
		Session session = SessionFactoryUtil.getSessionFactory().openSession();
		Criteria c = session.createCriteria(PrescriptionTerms.class);
		c.addOrder(Order.desc("term_id"));
		c.setMaxResults(1);

		PrescriptionTerms terms = (PrescriptionTerms) c.uniqueResult();

		return Integer.toString(terms.getTerm_id());

	}

}
