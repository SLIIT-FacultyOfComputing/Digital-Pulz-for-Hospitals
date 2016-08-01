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

import org.codehaus.jettison.json.JSONException;
import org.codehaus.jettison.json.JSONObject;

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
	
	/**
	 * @param hJson
	 * @return
	 */
	@POST
	@Path("/addRecord")
	@Produces(MediaType.TEXT_PLAIN)
	@Consumes(MediaType.APPLICATION_JSON)
	public String addHistory(JSONObject hJson) {
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
			
			return "True";

		} catch (Exception e) {
			e.printStackTrace();
			return "False";
		}
 		 

	}
	
	
	/**
	 * @param hJson
	 * @return
	 */
	@POST
	@Path("/updateRecord/")
	@Produces(MediaType.TEXT_PLAIN)
	@Consumes(MediaType.APPLICATION_JSON)
	public String updateRecord(JSONObject hJson) {
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
			return "True";

		}catch (Exception e) {
			System.out.println(e.getMessage());
		 	return "False" ;
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

			List<Record> record = rdbDriver.getNotesByPatientID(patientID);
			JSONSerializer serializer = new JSONSerializer();
			return  serializer.exclude(
					"*.class","patient",
					"recordLastUpDateUser.specialPermissions","recordLastUpDateUser.userRoles","recordLastUpDateUser.employees.department","recordLastUpDateUser.employees.leaves",
					"recordCreateUser.specialPermissions", "recordCreateUser.userRoles","recordCreateUser.employees.department","recordCreateUser.employees.leaves"
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

			List<Record> record = rdbDriver.getRecordRecordByRecordID(hID);
			JSONSerializer serializer = new JSONSerializer();
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
