/**
 * 
 */
package core.resources.opd;



import java.text.DateFormat;
import java.text.ParseException;
import java.text.SimpleDateFormat;
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

import lib.driver.opd.driver_class.PatientDBDriver;

import org.codehaus.jettison.json.JSONException;
import org.codehaus.jettison.json.JSONObject;
import core.classes.opd.Hin;
//import core.classes.api.standards.hin.GenerateHin;
import core.classes.opd.OutPatient;
import core.classes.opd.Patient;
import core.classes.opd.Visit;
import flexjson.JSONSerializer;
import flexjson.transformer.DateTransformer;



/**
 * This class define all the generic REST Services necessary for handling patient's information.
 * @author  
 * @version 1.0
 */
@Path("OutPatient")
public class OutPatientResource {

	PatientDBDriver patientDBDriver = new PatientDBDriver();
	HinResources hin = new HinResources();
	
	
	
	DateFormat dateformat = new SimpleDateFormat("yyyy-MM-dd HH:mm:ss");
	DateFormat dateformat2 = new SimpleDateFormat("yyyy-MM-dd");
	
	/**
	 * Register Patient Details
	 * @param pJson A Json Object that contains New Patient Details
	 * @return Is A String and If Data inserted Successfully return is True else False.
	 */
	@POST
	@Path("/registerPatient")
	@Produces(MediaType.APPLICATION_JSON)
	@Consumes(MediaType.APPLICATION_JSON)
	public String registerPatient(JSONObject pJson)
	{
		System.out.println(pJson);
		

		
		
		try {
			OutPatient patient  =  new OutPatient();
			Hin patientHin = new Hin();
			String HIN = patientHin.fullHin();
			patient.setPatientTitle(pJson.get("title").toString());
			patient.setPatientFullName(pJson.get("fullname").toString());	
			patient.setPatientPersonalUsedName(pJson.getString("personalname"));
			patient.setPatientNIC(pJson.get("nic").toString());
			patient.setPatientHIN(HIN);
			 
			String photo = pJson.get("photo").toString();
			 
			if (photo  == null | photo.isEmpty()
					| photo  == "null")
				patient.setPatientPhoto(photo);
			else {
				photo = photo.substring(photo.lastIndexOf("/") + 1, photo.length());
				patient.setPatientPhoto(photo);
			}
			
			patient.setPatientPassport(pJson.get("passport").toString());
			
			String dob = pJson.get("dob").toString();
			if(!(dob.isEmpty() | dob==null))
			{
				String d = "";
				if(dob.contains("/"))
				{
					d = dob.replace("/","-");
				}
				else if(dob.contains("."))
				{
					d= dob.replace(".", "-");
				}
				else if(dob.contains("\\"))
				{
					d = dob.replace("\\", "-");
				}
				else if(dob.contains("-"))
				{
					d = dob;
				}
				
			patient.setPatientDateOfBirth(dateformat2.parse(d)); 
			}
			patient.setPatientContactPName(pJson.get("contactpname").toString());
			patient.setPatientContactPNo(pJson.get("contactpno").toString());	
			patient.setPatientGender(pJson.get("gender").toString());
			patient.setPatientCivilStatus(pJson.get("cstatus").toString());
			patient.setPatientAddress(pJson.get("address").toString());
			patient.setPatientTelephone(pJson.get("telephone").toString());
			patient.setPatientPreferredLanguage(pJson.get("lang").toString());
			patient.setPatientCitizenship(pJson.get("citizen").toString());
			patient.setPatientblood(pJson.get("blood").toString());
			patient.setPatientRemarks(pJson.get("remarks").toString());
			
			
			int userid = pJson.getInt("userid");
			patient.setPatientActive(1);
 
			patient.setPatientCreateDate(new Date());
			patient.setPatientLastUpdate(new Date());
		
			patientDBDriver.insertPatient(patient,userid,pJson.get("dob").toString());
			 
			JSONSerializer jsonSerializer = new JSONSerializer();
			return jsonSerializer.include("patientID").exclude("*").serialize(patient);
		} catch (Exception e) {
			 System.out.println(e.getMessage());
			 
			return null; 
		}

	}


	/**
	 * Get Patient Details By Patient ID
	 * @param patientId Is An Integer Value
	 * @return JSON String that contains all the Patient Details
	 */
	@GET
	@Path("/getPatientsByPID/{patientId}")
	@Produces(MediaType.APPLICATION_JSON)
	public String PatientDetails(@PathParam("patientId")int patientId)
	{
		Patient patient =  new OutPatient();
		patient = patientDBDriver.getPatientDetails(patientId);
		JSONSerializer jsonSerializer = new JSONSerializer();
		return jsonSerializer.exclude(
			"patientLastUpDateUser.specialPermissions",
			"patientLastUpDateUser.userRoles",
			"patientCreateUser.specialPermissions", "patientCreateUser.userRoles","core.classes.hr.HrEmployee.password"
			).include("allergies","visits","exams","attachments","records","laborders",
						"answerSets","answerSets.questionnaireID").serialize(patient);
	}
	  
	/**
	 * Update Patient details
	 * @param pJson A Json Object that contains New Patient Details
	 * @return Is A String and If Data Updated Successfully return is True else False.
	 */
	
	@POST
	@Path("/updatePatient")
	@Produces(MediaType.TEXT_PLAIN)
	@Consumes(MediaType.APPLICATION_JSON)
	public String changePatientDetails(JSONObject pJson)
	{
		try {
			System.out.println(pJson.toString());
			
			OutPatient patient  =  new OutPatient(); 
			
			patient.setPatientTitle(pJson.get("title").toString());
			patient.setPatientFullName(pJson.get("fullname").toString());
			patient.setPatientPersonalUsedName(pJson.getString("personalname"));
			patient.setPatientNIC(pJson.get("nic").toString());
			patient.setPatientHIN(pJson.get("hin").toString());
			patient.setPatientPhoto(pJson.get("photo").toString());
			patient.setPatientPassport(pJson.get("passport").toString());
			
			String dob = pJson.get("dob").toString();
			if(!(dob.isEmpty() | dob == "" | dob =="null" | dob==null))
				patient.setPatientDateOfBirth(dateformat2.parse(pJson.get("dob").toString())); 
 
			patient.setPatientContactPName(pJson.get("contactpname").toString());
			patient.setPatientContactPNo(pJson.get("contactpno").toString());	
			patient.setPatientGender(pJson.get("gender").toString());
			patient.setPatientCivilStatus(pJson.get("cstatus").toString());
			patient.setPatientAddress(pJson.get("address").toString());
			patient.setPatientTelephone(pJson.get("telephone").toString());
			patient.setPatientPreferredLanguage(pJson.get("lang").toString());
			patient.setPatientCitizenship(pJson.get("citizen").toString());
			patient.setPatientblood(pJson.get("blood").toString());
			patient.setPatientRemarks(pJson.get("remarks").toString());
			patient.setPatientActive( Integer.parseInt(pJson.get("active").toString()));
		
			patient.setPatientLastUpdate(new Date());
			
			int userid = pJson.getInt("userid");
			int patientid = pJson.getInt("pid");
			patientDBDriver.updatePatient(patientid,patient,userid,pJson.get("dob").toString());
			return "True";	
			
		} catch (Exception e) {
			 
			return "False";
		}
	}
	
	/**
	 * Get All Patient Details available in DB
	 * @return A JSON Object that contains Patient Details
	 */
	@GET
	@Path("/getAllPatients")
	@Produces(MediaType.APPLICATION_JSON)
	public String getPatientList()
	{
		System.out.println("hsjgsjdhdbskhd");
		List<OutPatient> patientList =   patientDBDriver.getPatientList();
		JSONSerializer serializer = new JSONSerializer();
		return  serializer.exclude("*.class","patientCreateUser.hrEmployee.birthday").transform(new DateTransformer("yyyy-MM-dd"),"patientCreateDate","patientLastUpdate").serialize(patientList);
	}
	
	
	
	/**
	 * Get Patient Details By Visit Type
	 * @param userid Is an Integer value
	 * @param visitype is an String Value
	 * @return 
	 */
	@GET
	@Path("/{userid}/{visitype}")
	@Produces (MediaType.APPLICATION_JSON)
	public String getPatients(@PathParam("userid")int userid,@PathParam("visitype")int visitype) {
		
		OutPatient patient =  new OutPatient();
		patient = patientDBDriver.getPatient_By_VisitType(userid, visitype);
		JSONSerializer jsonSerializer = new JSONSerializer();
		return jsonSerializer.exclude("*.class").transform(new DateTransformer("yyyy-MM-dd"), "patientDateOfBirth","patientCreateDate","patientLastUpdate").serialize(patient);
	}
	
	
	

	/**
	 * A JSON Object that contains Patient Details
	 * @param userID
	 * @param visitType
	 * @return
	 */
	@GET
	@Path("/getPatientsForDoctor/{userid}/{visitype}")
	@Produces (MediaType.APPLICATION_JSON)
	public String getPatientsForDoctor(@PathParam("userid")int userID,@PathParam("visitype")int visitType) {
		try 
		{
			 
		   List<Visit> uList = patientDBDriver.getPatientsForDoctor(userID, visitType);
			 
           JSONSerializer serializer = new JSONSerializer();
		   return  serializer.include("visit.visitDate","visit.visitComplaint","visit.patient.*").exclude("*.class","visit.*").
				   transform(new DateTransformer("yyyy-MM-dd"), "patient.patientDateOfBirth",
						   "patient.patientCreateDate","patient.patientLastUpdate",
						   "visitLastUpdate").serialize(uList);
		} catch (Exception e) 
		{
			 return "error";
		}
	}
	
	/**
	 * A JSON Object that contains Patient Details
	 * @param userID
	 * @param visitType
	 * @return
	 */
	@GET
	@Path("/getMaxPatientID")
	@Produces (MediaType.APPLICATION_JSON)
	public String getMaxPatientID() {
		try 
		{
			String id = patientDBDriver.getMaxPatientID();
			JSONSerializer jsonSerializer = new JSONSerializer();
			return jsonSerializer.serialize(id);
		} catch (Exception e) 
		{
			 return "error";
		}
	}
	
	
}












