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

import org.apache.log4j.Logger;
import org.codehaus.jettison.json.JSONException;
import org.codehaus.jettison.json.JSONObject;

import core.ErrorConstants;
import core.classes.opd.Record;
import flexjson.JSONSerializer;
import flexjson.transformer.DateTransformer;
import lib.driver.opd.driver_class.RecordDBDriver;

/**
 * This class define all the generic REST Services necessary for handling patient's history records
 * @author 
 * @version 1.0
 */
@Path("Record")
public class RecordResource {
	
	RecordDBDriver rdbDriver = new RecordDBDriver();
	
	final static Logger logger = Logger.getLogger(RecordResource.class);
	
	/**
	 * @param hJson
	 * @return
	 * @throws JSONException 
	 */
	@POST
	@Path("/addRecord")
	@Produces(MediaType.TEXT_PLAIN)
	@Consumes(MediaType.APPLICATION_JSON)
	public String addHistory(JSONObject hJson) throws JSONException {
		logger.info("add history");
		Record record = new Record();
		try {
			   	
			int patientID = hJson.getInt("patient");
			int createuser = hJson.getInt("recordCreateUser");
			
			record.setRecordType(hJson.getInt("recordType"));
			record.setRecordText(hJson.getString("recordText"));
			record.setRecordVisibility(hJson.getString("recordVisibility"));
			
			record.setRecordCompleted(hJson.getInt("recordCompleted"));
			
			record.setRecordCreateDate(new Date());
			record.setRecordLastUpdate(new Date()); 
			rdbDriver.saveRecord(record, createuser, patientID);	
			logger.info("successfully history added");
			JSONSerializer jsonSerializer = new JSONSerializer();
			return jsonSerializer.include("patient").exclude("*.class","patient.*", "recordCreateUser.*", "hrEmployee.*").serialize(record);

		}
		catch (JSONException e) {
			logger.error("error adding history: "+e.getMessage());
			JSONObject jsonErrorObject = new JSONObject();
			jsonErrorObject.put("errorcode", ErrorConstants.FILL_REQUIRED_FIELDS.getCode());
			jsonErrorObject.put("message", ErrorConstants.FILL_REQUIRED_FIELDS.getMessage());		
			
			return jsonErrorObject.toString(); 
		} 
		catch (RuntimeException e)
		{
			logger.error("error adding history: "+e.getMessage());
			JSONObject jsonErrorObject = new JSONObject();
			jsonErrorObject.put("errorcode", ErrorConstants.FILL_REQUIRED_FIELDS.getCode());
			jsonErrorObject.put("message", ErrorConstants.FILL_REQUIRED_FIELDS.getMessage());
			
			return jsonErrorObject.toString();
		} catch (Exception e) {
			
			logger.error("error adding history: "+ e.getMessage());
			return null;
		}
 		 

	}
	
	
	/**
	 * @param hJson
	 * @return
	 * @throws JSONException 
	 */
	@POST
	@Path("/updateRecord/")
	@Produces(MediaType.TEXT_PLAIN)
	@Consumes(MediaType.APPLICATION_JSON)
	public String updateRecord(JSONObject hJson) throws JSONException {
		logger.info("update record");
		Record record = new Record();
		try {
			  
			System.out.println(hJson.toString());
			
			int updateuser = hJson.getInt("recordLastUpdateUser");
			int recid  = hJson.getInt("patientRecordID");
			record.setRecordType(hJson.getInt("recordType"));
			record.setRecordText(hJson.getString("recordText"));
			record.setRecordVisibility(hJson.getString("recordVisibility"));
			record.setRecordCompleted(hJson.getInt("recordCompleted"));
			record.setRecordLastUpdate(new Date()); 
			
			rdbDriver.updateRecord( recid, record, updateuser ); 
			logger.info("successfully history updated");
			JSONSerializer jsonSerializer = new JSONSerializer();
			return jsonSerializer.include("patientRecordID").serialize(record);
			//return "True";

		}catch (JSONException e) {
			logger.error("error updating history: "+e.getMessage());
			JSONObject jsonErrorObject = new JSONObject();
			jsonErrorObject.put("errorcode", ErrorConstants.FILL_REQUIRED_FIELDS.getCode());
			jsonErrorObject.put("message", ErrorConstants.FILL_REQUIRED_FIELDS.getMessage());		
			
			return jsonErrorObject.toString(); 
		} 
		catch (RuntimeException e)
		{
			logger.error("error updating history: "+e.getMessage());
			JSONObject jsonErrorObject = new JSONObject();
			jsonErrorObject.put("errorcode", ErrorConstants.FILL_REQUIRED_FIELDS.getCode());
			jsonErrorObject.put("message", ErrorConstants.FILL_REQUIRED_FIELDS.getMessage());
			
			return jsonErrorObject.toString();
		} catch (Exception e) {
			logger.error("error updating history: "+e.getMessage());
			return null;
		}
	}
	
	/**
	 * @param hID
	 * @return
	 */
	@GET
	@Path("/getNotesByPatientID/{patientID}")
	@Produces (MediaType.APPLICATION_JSON)
	public String getNotesByPatientID(@PathParam("patientID")int patientID) {
		logger.info("get notes by patient id");

			List<Record> record = rdbDriver.getNotesByPatientID(patientID);
			JSONSerializer serializer = new JSONSerializer();
			logger.info("successfully getting notes");
			return  serializer.exclude(
					"*.class","patient",
					"recordLastUpdateUser.*",
					"recordCreateUser.*"
					).include("*").serialize(record);
 
	}
	
	/**
	 * @param hID
	 * @return
	 */
	@GET
	@Path("/getRecordRecordByRecordID/{hid}")
	@Produces (MediaType.APPLICATION_JSON)
	public String getRecordRecordByRecordID(@PathParam("hid")int hID) {
		logger.info("get records by record id");

			List<Record> record = rdbDriver.getRecordRecordByRecordID(hID);
			JSONSerializer serializer = new JSONSerializer();
			logger.info("successfully getting records");
			return  serializer.include("patients.patientID").exclude("*.class","patients.*").transform(new DateTransformer("yyyy-MM-dd"),"histroyLastUpdate","histroyCreateDate").serialize(record);
 
	}
	
	/*
	 
	@GET
	@Path("/getHistroyRecordsByPatientID/{PID}")
	@Produces (MediaType.APPLICATION_JSON)
	public String getHistoryRecordByPatientID(@PathParam("PID")int pID) {

			List<Record> recordList = rdbDriver.retriveHistroyByPatientID(pID);
			JSONSerializer serializer = new JSONSerializer();
			return  serializer.include("patients.patientID").exclude("*.class","patients.*").transform(new DateTransformer("yyyy-MM-dd"),"histroyLastUpdate","histroyCreateDate").serialize(recordList);

	}
	*/
}
