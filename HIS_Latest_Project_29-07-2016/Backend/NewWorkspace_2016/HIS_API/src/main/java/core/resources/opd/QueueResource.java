package core.resources.opd;

import java.text.DateFormat;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Calendar;
import java.util.Date;
import java.util.List;
import java.util.Set;

import javax.swing.text.DateFormatter;
import javax.ws.rs.Consumes;
import javax.ws.rs.GET;
import javax.ws.rs.POST;
import javax.ws.rs.Path;
import javax.ws.rs.PathParam;
import javax.ws.rs.Produces;
import javax.ws.rs.core.MediaType;

import org.apache.log4j.Logger;
import org.codehaus.jettison.json.JSONException;
import org.codehaus.jettison.json.JSONObject;

import core.ErrorConstants;
import core.classes.hr.HrAttendance;
import core.classes.opd.Queue;
import core.classes.opd.Visit;
import flexjson.JSONSerializer;
import flexjson.transformer.DateTransformer;
import lib.driver.api.driver_class.user.UserDBDriver;
import lib.driver.hr.driver_class.HrAttendanceDBDriver;
import lib.driver.opd.driver_class.QueueDBDriver;
import lib.driver.opd.driver_class.VisitDBDriver;
import core.classes.api.user.AdminPermission;
import core.classes.api.user.AdminUser;
import core.classes.api.user.AdminUserroles;
import core.resources.api.user.UserResource;

/**
 * This class define all the generic REST Services necessary for handling the queue
 * 
 * @author Prabhath Jayampathi
 * @version 1.0
 */

@Path("Queue")
public class QueueResource {
	
	final static Logger logger = Logger.getLogger(QueueResource.class);

	//
	public final static int MAX_PATIENT_PER_DAY = 5;
	public static int rotationNumber = 0;
	
	public static class QueueStatus {
		public int user;
		public static int qStatus = 0; // 0 : Open , 1 : Full , 2 : OnHold , 3 : Redirect
	}

	
	//
	
	public static int qType = 0; // 0 : Regular , 1 : Visit
	
	public static ArrayList<QueueStatus> queueStatusList = new ArrayList<QueueStatus>();
	//

	public static int lastAssignedDcotor = -1;
	
	QueueDBDriver queueDBDriver = new QueueDBDriver();
	HrAttendanceDBDriver hrAttendanceDBDriver = new HrAttendanceDBDriver();
	
	/**
	 * @param qJson
	 * @return
	 * @throws JSONException 
	 */
	@POST
	@Path("/addPatientToQueue")
	@Produces(MediaType.TEXT_PLAIN)
	@Consumes(MediaType.APPLICATION_JSON)
	public String addToQueue(JSONObject qJson) throws JSONException {
		logger.info("add patient to queue");

		UserDBDriver userDBDriver = new UserDBDriver();
		
		Queue queue = new Queue();
		try {
 
			queue.setQueueRemarks(qJson.getString("queueRemarks"));
			queue.setQueueTokenAssignTime(new Date());
			queue.setQueueStatus("Waiting");
			int patientID = qJson.getInt("patient");
			int assignedBy = qJson.getInt("queueAssignedBy");
			int assignedTo = userDBDriver.getUserByEmpId(qJson.getInt("queueAssignedTo")).getUserId();
			
			
			
			
			lastAssignedDcotor = assignedTo;
			 
			if((new QueueDBDriver().getQueuePatientsByUserID(assignedTo).size()) == MAX_PATIENT_PER_DAY)
			{
				  System.out.println("Making Q Full for " + assignedTo); 
				  QueueStatus qs = new QueueStatus();
				  qs.user = assignedTo;
				  qs.qStatus = 1;
				  hrAttendanceDBDriver.UpdateAttendance(qs.qStatus, qs.user);
				  queueStatusList.add(qs); 
				  JSONObject jsonobj = new JSONObject();
				  jsonobj.put("status","False");
				  jsonobj.put("full",assignedTo);
				  return jsonobj.toString();
			}
			else
			{
			
			queueDBDriver.addToQueue(queue, patientID, assignedBy, assignedTo);
			logger.info("successfully queue added");
			JSONSerializer jsonSerializer = new JSONSerializer();
			JSONObject jsonobje=new JSONObject(jsonSerializer.include("patient").serialize(queue)).put("status","True").put("full","");
			return jsonobje.toString();
			}

		} catch (JSONException e) {
			logger.error("error adding queue: "+e.getMessage());
			JSONObject jsonErrorObject = new JSONObject();
			jsonErrorObject.put("errorcode", ErrorConstants.FILL_REQUIRED_FIELDS.getCode());
			jsonErrorObject.put("message", ErrorConstants.FILL_REQUIRED_FIELDS.getMessage());		
			
			return jsonErrorObject.toString(); 
		}catch (RuntimeException e)
			{
				logger.error("error adding queue: "+e.getMessage());
				JSONObject jsonErrorObject = new JSONObject();
				jsonErrorObject.put("errorcode", ErrorConstants.FILL_REQUIRED_FIELDS.getCode());
				jsonErrorObject.put("message", ErrorConstants.FILL_REQUIRED_FIELDS.getMessage());				
				
				return jsonErrorObject.toString();
		
		} catch (Exception e) {
			logger.error("error adding queue: "+e.getMessage());
			return null;
		}

	}

	@POST
	@Path("/addPatientToQueueAuto/{visittype}")
	@Produces(MediaType.TEXT_PLAIN)
	@Consumes(MediaType.APPLICATION_JSON)
	public String addToQueueAuto(JSONObject qJson, @PathParam("visittype") int visittype) throws JSONException {
		logger.info("add patient to queue automatically");
		UserDBDriver userDBDriver = new UserDBDriver();
		
		Queue queue = new Queue();
		try {
 
			queue.setQueueRemarks(qJson.getString("queueRemarks"));
			queue.setQueueTokenAssignTime(new Date());
			queue.setQueueStatus("Waiting");
			int patientID = qJson.getInt("patient");
			int assignedBy = qJson.getInt("queueAssignedBy");
			
			List<HrAttendance> attendants = hrAttendanceDBDriver.getAllAvailableAttendanceByType(visittype);
			int empId = 0;
			
			if(rotationNumber < attendants.size())
			{
				empId = attendants.get(rotationNumber).getHrEmployee().getEmpId();
				rotationNumber++;
			}
			else
			{
				if(attendants.size() == 0)
				{
					JSONObject jsonobj = new JSONObject();
					jsonobj.put("status","False");
					jsonobj.put("full","");
					jsonobj.put("available", "false");
					return jsonobj.toString();
				}
				rotationNumber = 0;
				empId = attendants.get(rotationNumber).getHrEmployee().getEmpId();
			}
			
			AdminUser user = userDBDriver.getUserByEmpId(empId);
			
			//////////
			int assignedTo = user.getUserId();//qJson.getInt("queueAssignedTo");
			
			lastAssignedDcotor = assignedTo;
			 
			if((new QueueDBDriver().getQueuePatientsByUserID(assignedTo).size()) == MAX_PATIENT_PER_DAY)
			{
				  System.out.println("Making Q Full for " + assignedTo); 
				  QueueStatus qs = new QueueStatus();
				  qs.user = assignedTo;
				  qs.qStatus = 1;
				  hrAttendanceDBDriver.UpdateAttendance(qs.qStatus, qs.user);
				  queueStatusList.add(qs); 
				  JSONObject jsonobj = new JSONObject();
				  jsonobj.put("status","False");
				  jsonobj.put("full",assignedTo);
				  jsonobj.put("available", "true");
				  return jsonobj.toString();
			}
			else
			{
			
			queueDBDriver.addToQueue(queue, patientID, assignedBy, assignedTo);
			logger.info("successfully queue added automatically");
			JSONSerializer jsonSerializer = new JSONSerializer();
			JSONObject jsonobje=new JSONObject(jsonSerializer.include("patient").exclude("queueAssignedTo.*").serialize(queue)).put("status","True").put("full","");
			return jsonobje.toString();
			}

		} catch (JSONException e) {
			logger.error("error adding queue automatically: "+e.getMessage());
			JSONObject jsonErrorObject = new JSONObject();
			jsonErrorObject.put("errorcode", ErrorConstants.FILL_REQUIRED_FIELDS.getCode());
			jsonErrorObject.put("message", ErrorConstants.FILL_REQUIRED_FIELDS.getMessage());		
			
			return jsonErrorObject.toString(); 
		}catch (RuntimeException e)
			{
				logger.error("error adding queue automatically: "+e.getMessage());
				JSONObject jsonErrorObject = new JSONObject();
				jsonErrorObject.put("errorcode", ErrorConstants.FILL_REQUIRED_FIELDS.getCode());
				jsonErrorObject.put("message", ErrorConstants.FILL_REQUIRED_FIELDS.getMessage());				
				
				return jsonErrorObject.toString();
		
		} catch (Exception e) {
			logger.error("error adding queue: "+e.getMessage());
			return null;
		}

	}
	
	/**
	 * @param pID
	 * @return
	 * @throws JSONException 
	 */
	@GET
	@Path("/checkinPatient/{PID}")
	@Produces(MediaType.TEXT_PLAIN)
	public String checkinPatient(@PathParam("PID") int P) throws JSONException {
		logger.info("checkin patient");
		
		try {

			int status = queueDBDriver.checkInPatient(P);
			if (status == 1){
				logger.info("successfully checked patient");
				return String.valueOf(status);
			}
			else{
				logger.info("patient not checked");
				return String.valueOf(status);
			}

		}catch (RuntimeException e)
			{
				logger.error("error checking in patient: "+e.getMessage());
				JSONObject jsonErrorObject = new JSONObject();
				jsonErrorObject.put("errorcode", ErrorConstants.FILL_REQUIRED_FIELDS.getCode());
				jsonErrorObject.put("message", ErrorConstants.FILL_REQUIRED_FIELDS.getMessage());				
				
				return jsonErrorObject.toString();
		
		} catch (Exception e) {
			logger.error("error checking in patient: "+e.getMessage());
			return null;
			
		}
	}

	/**
	 * @param pID
	 * @return
	 * @throws JSONException 
	 */
	@GET
	@Path("/checkoutPatient/{PID}/{userId}")
	@Produces(MediaType.TEXT_PLAIN)
	public String checkoutPatient(@PathParam("PID") int pID, @PathParam("userId") int userId) throws JSONException {
		logger.info("checkout patient");
		try {
			int status = queueDBDriver.checkoutPatient(pID);
			
			if((new QueueDBDriver().getQueuePatientsByUserID(userId).size()) < MAX_PATIENT_PER_DAY)
			{
				hrAttendanceDBDriver.UpdateAttendance(0, userId);
				for (QueueStatus queuestatus : queueStatusList) {
					
					if (queuestatus.user == userId) {
						queuestatus.qStatus = 0;
						
					}
				}
				
			}
			if (status == 1){
				logger.info("successfully checked patient");
				return String.valueOf(status);
			}
			else
				logger.info("patient not checked");
			return String.valueOf(status);

		} catch (RuntimeException e)
			{
				logger.error("error checking out patient: "+e.getMessage());
				JSONObject jsonErrorObject = new JSONObject();
				jsonErrorObject.put("errorcode", ErrorConstants.FILL_REQUIRED_FIELDS.getCode());
				jsonErrorObject.put("message", ErrorConstants.FILL_REQUIRED_FIELDS.getMessage());				
				
				return jsonErrorObject.toString();
		
		}catch (Exception e) {
			logger.error("error checking out patient: "+e.getMessage());
			return null;
		}
	}

	@GET
	@Path("/getQueuePatientsByUserID/{userid}")
	@Produces(MediaType.APPLICATION_JSON)
	public String getQueuePatientsByUserID(@PathParam("userid") int userid) throws JSONException {
		logger.info("get queue patient by user id");
		try {
			List<Queue> queueRecord = queueDBDriver
					.getQueuePatientsByUserID(userid);
			JSONSerializer serializer = new JSONSerializer();
			logger.info("successfully getting queue patient");

			return serializer
					.include("patient.patientGender", "patient.patientTitle",
							"patient.patientFullName", "patient.patientID","patient.patientHIN",
							"queueTokenNo", "queueStatus").exclude("*")
					.serialize(queueRecord);
		} catch (RuntimeException e)
			{
				logger.error("error getting queue: "+e.getMessage());
				JSONObject jsonErrorObject = new JSONObject();
				jsonErrorObject.put("errorcode", ErrorConstants.FILL_REQUIRED_FIELDS.getCode());
				jsonErrorObject.put("message", ErrorConstants.FILL_REQUIRED_FIELDS.getMessage());				
				
				return jsonErrorObject.toString();
		
		}catch (Exception e) {
			logger.error("error getting queue: "+e.getMessage());
			return null;
		}
	}
	
	
	@GET
	@Path("/getQueuePatientsByDoctorID/{doctorid}")
	@Produces(MediaType.APPLICATION_JSON)
	public String getQueuePatientsByDoctorID(@PathParam("doctorid") int doctorid) throws JSONException {
		logger.info("get queue patient by user id");
		try {
			List<Queue> queueRecord = queueDBDriver
					.getQueuePatientsByDoctorID(doctorid);
			JSONSerializer serializer = new JSONSerializer();
			logger.info("successfully getting queue patient");

			return serializer
					.include("patient.patientGender", "patient.patientTitle",
							"patient.patientFullName", "patient.patientID","patient.patientHIN",
							"queueTokenNo", "queueStatus").exclude("*")
					.serialize(queueRecord);
		} catch (RuntimeException e)
			{
				logger.error("error getting queue: "+e.getMessage());
				JSONObject jsonErrorObject = new JSONObject();
				jsonErrorObject.put("errorcode", ErrorConstants.FILL_REQUIRED_FIELDS.getCode());
				jsonErrorObject.put("message", ErrorConstants.FILL_REQUIRED_FIELDS.getMessage());				
				
				return jsonErrorObject.toString();
		
		}catch (Exception e) {
			logger.error("error getting queue: "+e.getMessage());
			return null;
		}
	}
	
	@GET
	@Path("/isPatientInQueue/{patientID}")
	@Produces(MediaType.APPLICATION_JSON)
	public String isPatientInQueue(@PathParam("patientID") int patientID) throws JSONException {
		logger.info("is patient in queue");
		try {
			JSONSerializer serializer = new JSONSerializer();
			Queue q = queueDBDriver.isPatientInQueue(patientID);
			logger.info("successfully checked patient in queue");
			return serializer
					.include("patient.patientID","patient.patientFullName","patient.patientTitle", "queueStatus", "queueTokenNo","queueAssignedTo.hrEmployee.firstName","queueAssignedTo.hrEmployee.lastName")
					.exclude("*").serialize(q); 
		} catch (RuntimeException e)
			{
				logger.error("error checking patient in queue: "+e.getMessage());
				JSONObject jsonErrorObject = new JSONObject();
				jsonErrorObject.put("errorcode", ErrorConstants.FILL_REQUIRED_FIELDS.getCode());
				jsonErrorObject.put("message", ErrorConstants.FILL_REQUIRED_FIELDS.getMessage());				
				
				return jsonErrorObject.toString();
		
		}catch (Exception e) {
			logger.error("error checking patient in queue: "+e.getMessage());

			return null;
		}
	}

	@GET
	@Path("/getCurrentInPatient/{doctor}")
	@Produces(MediaType.APPLICATION_JSON)
	public String getCurrentInPatient(@PathParam("doctor") int doctor) throws JSONException {
		logger.info("get current in patient");
		try {
			JSONSerializer serializer = new JSONSerializer();
			Queue q = queueDBDriver.getCurrentInPatient(doctor);
			logger.info("successfully getting current patient");
			return serializer
					.include("patient.patientID", "queueStatus", "queueTokenNo")
					.exclude("*").serialize(q);
		} catch (RuntimeException e)
			{
				logger.error("error getting current patient: "+e.getMessage());
				JSONObject jsonErrorObject = new JSONObject();
				jsonErrorObject.put("errorcode", ErrorConstants.FILL_REQUIRED_FIELDS.getCode());
				jsonErrorObject.put("message", ErrorConstants.FILL_REQUIRED_FIELDS.getMessage());				
				
				return jsonErrorObject.toString();
		
		}catch (Exception e) {
			logger.error("error getting current patient: "+e.getMessage());

			return e.getMessage();
		}
	}

	@GET
	@Path("/getTreatedPatients/{userid}")
	@Produces(MediaType.APPLICATION_JSON)
	public String getTreatedPatients(@PathParam("userid") int userid) throws JSONException {
		logger.info("get treated patients");
		try {
			List<Queue> queueRecord = queueDBDriver.getTreatedPatients(userid);
			JSONSerializer serializer = new JSONSerializer();
			logger.info("successfully getting treated  patient");

			return serializer.include("patient.patientID", "queueTokenNo")
					.exclude("*").serialize(queueRecord);
		} catch (RuntimeException e)
			{
				logger.error("error getting treated  patient: "+e.getMessage());
				JSONObject jsonErrorObject = new JSONObject();
				jsonErrorObject.put("errorcode", ErrorConstants.FILL_REQUIRED_FIELDS.getCode());
				jsonErrorObject.put("message", ErrorConstants.FILL_REQUIRED_FIELDS.getMessage());				
				
				return jsonErrorObject.toString();
		
		}catch (Exception e) {
			logger.error("error getting treated  patient: "+e.getMessage());
			return e.getMessage();
		}
	}

	@GET
	@Path("/redirectQueue/{userid}/{type}")
	@Produces(MediaType.TEXT_PLAIN)
	public String redirectQueue(@PathParam("userid") int userid,@PathParam("type") int type) throws JSONException {
		logger.info("redirect queue");
		HrAttendanceDBDriver hrAttendanceDB = new HrAttendanceDBDriver();
		try {
			if(QueueStatus.qStatus != 3)
			{
				int status = queueDBDriver.redirectQueue(userid,type);
				hrAttendanceDB.UpdateAttendance(3, userid);
				
				if (status == 1){
					
					logger.info("successfully redirect queue");
					return String.valueOf(status);
				}
				else{
					logger.info("not redirect queue");
					return String.valueOf(status);
				}
			}
			else
			{
				QueueStatus.qStatus = 0;
				for(QueueStatus queue : queueStatusList)
				{
					if(queue.user == userid)
					{
						queueStatusList.remove(queue);
						break;
					}
				}
				hrAttendanceDB.UpdateAttendance(0, userid);
				return String.valueOf(QueueStatus.qStatus);
			}
		} catch (RuntimeException e)
			{
				logger.error("error getting redirect queue: "+e.getMessage());
				JSONObject jsonErrorObject = new JSONObject();
				jsonErrorObject.put("errorcode", ErrorConstants.FILL_REQUIRED_FIELDS.getCode());
				jsonErrorObject.put("message", ErrorConstants.FILL_REQUIRED_FIELDS.getMessage());				
				
				return jsonErrorObject.toString();
		
		}catch (Exception e) {
			logger.error("error getting redirect queue: "+e.getMessage());
			return null;
		}
	}

	@GET
	@Path("/getUserQStatus/{userid}")
	@Produces(MediaType.TEXT_PLAIN)
	public String getUserQStatus(@PathParam("userid") int userid) throws JSONException {
		logger.info("get user queue status");
		
		try {
			
			int val = hrAttendanceDBDriver.getStatus(userid);
			for (QueueStatus status : queueStatusList) {
				if (status.user == userid)
					
					val = hrAttendanceDBDriver.getStatus(userid);
					logger.info("successfully getting queue status");
					return String.valueOf(val);
			}
			return String.valueOf(val);
		} catch (RuntimeException e)
			{
				logger.error("error getting queue status: "+e.getMessage());
				JSONObject jsonErrorObject = new JSONObject();
				jsonErrorObject.put("errorcode", ErrorConstants.FILL_REQUIRED_FIELDS.getCode());
				jsonErrorObject.put("message", ErrorConstants.FILL_REQUIRED_FIELDS.getMessage());				
				
				return jsonErrorObject.toString();
		
		}catch (Exception e) {
			logger.error("error getting queue status: "+e.getMessage());
			return "0";
		}
	}

	@GET
	@Path("/setQueueType")
	@Produces(MediaType.TEXT_PLAIN)
	public String setQueueType() throws JSONException {
		logger.info("set queue type");
		try {

			if (qType == 0)
				qType = 1;
			else
				qType = 0;
			logger.info("successfully setting queue type");
			return String.valueOf(qType);

		} catch (RuntimeException e)
			{
				logger.error("error setting queue type: "+e.getMessage());
				JSONObject jsonErrorObject = new JSONObject();
				jsonErrorObject.put("errorcode", ErrorConstants.FILL_REQUIRED_FIELDS.getCode());
				jsonErrorObject.put("message", ErrorConstants.FILL_REQUIRED_FIELDS.getMessage());				
				
				return jsonErrorObject.toString();
		
		}catch (Exception e) { 
			logger.error("error setting queue type: "+e.getMessage());
			return null;
		}
	}
	
	@GET
	@Path("/getQueueType")
	@Produces(MediaType.TEXT_PLAIN)
	public String getQueueType() throws JSONException {
		logger.info("get queue type");
		try {
			return String.valueOf(qType);
		}catch (RuntimeException e)
			{
				logger.error("error setting queue type: "+e.getMessage());
				JSONObject jsonErrorObject = new JSONObject();
				jsonErrorObject.put("errorcode", ErrorConstants.FILL_REQUIRED_FIELDS.getCode());
				jsonErrorObject.put("message", ErrorConstants.FILL_REQUIRED_FIELDS.getMessage());				
				
				return jsonErrorObject.toString();
		
		} catch (Exception e) { 
			logger.error("error setting queue type: "+e.getMessage());
			return null;
		}
	}
	
	@GET
	@Path("/setQueueType/{type}/{userid}")
	@Produces(MediaType.TEXT_PLAIN)
	public String setQueueTypeForDoctor(@PathParam("type") int type,@PathParam("userid") int userid) throws JSONException {
		logger.info("set queue type for doctor");
		try {

			int typeValue = hrAttendanceDBDriver.UpdateAttendanceType(type, userid);
			logger.info("successfully setting queue type for doctor");
			return String.valueOf(typeValue);

		} catch (RuntimeException e)
			{
				logger.error("error setting queue type for doctor: "+e.getMessage());
				JSONObject jsonErrorObject = new JSONObject();
				jsonErrorObject.put("errorcode", ErrorConstants.FILL_REQUIRED_FIELDS.getCode());
				jsonErrorObject.put("message", ErrorConstants.FILL_REQUIRED_FIELDS.getMessage());				
				
				return jsonErrorObject.toString();
		
		}catch (Exception e) { 
			logger.error("error setting queue type for doctor: "+e.getMessage());
			return null;
		}
	}

	@GET
	@Path("/getQueueType/{userid}")
	@Produces(MediaType.TEXT_PLAIN)
	public String getQueueTypeForDoctor(@PathParam("userid") int userid) throws JSONException {
		logger.info("get queue type  for doctor");
		
		try {
			return String.valueOf(hrAttendanceDBDriver.getType(userid));
		}catch (RuntimeException e)
			{
				logger.error("error setting queue type for doctor: "+e.getMessage());
				JSONObject jsonErrorObject = new JSONObject();
				jsonErrorObject.put("errorcode", ErrorConstants.FILL_REQUIRED_FIELDS.getCode());
				jsonErrorObject.put("message", ErrorConstants.FILL_REQUIRED_FIELDS.getMessage());				
				
				return jsonErrorObject.toString();
		
		} catch (Exception e) { 
			logger.error("error setting queue type for doctor: "+e.getMessage());
			return null;
		}
	}
	
	
	@GET
	@Path("/holdQueue/{userid}")
	@Produces(MediaType.TEXT_PLAIN)
	public String holdQueue(@PathParam("userid") int userid) throws JSONException {
		logger.info("hold queue, UserId = " +userid);
		HrAttendanceDBDriver hrAttendanceDB = new HrAttendanceDBDriver();
		
		try {
			boolean bExists = false;
			
			for (QueueStatus status : queueStatusList) {
				
				if (status.user == userid) {
					
					bExists = true;
					
					if (status.qStatus == 2)
					{ 
						
						hrAttendanceDB.UpdateAttendance(0, userid);
						queueStatusList.remove(status);
						return String.valueOf(status.qStatus);
						
					}
					else if (status.qStatus == 0)
					{
						
						status.qStatus = 2;
						hrAttendanceDB.UpdateAttendance(status.qStatus, userid);
						return String.valueOf(status.qStatus);
					} 
				}
			}
			
			if(bExists == false)
			{
				QueueStatus qstat = new QueueStatus();
				qstat.user = userid;
				qstat.qStatus = 2;
				hrAttendanceDB.UpdateAttendance(qstat.qStatus, userid);
				queueStatusList.add(qstat);
			}
			logger.info("successfully holding queue");
			//return "True";
			return String.valueOf(userid);
		} catch (RuntimeException e)
			{
				logger.error("error holding queue: "+e.getMessage());
				JSONObject jsonErrorObject = new JSONObject();
				jsonErrorObject.put("errorcode", ErrorConstants.FILL_REQUIRED_FIELDS.getCode());
				jsonErrorObject.put("message", ErrorConstants.FILL_REQUIRED_FIELDS.getMessage());				
				return jsonErrorObject.toString();
		}catch (Exception e) {
			logger.error("error holding queue: "+e.getMessage());
			return null;
		}
	}
	
	
	/**
	 * @param pID
	 * @return
	 * @throws JSONException 
	 */
	@GET
	@Path("/getNextAssignDoctor/{patientID}/{date}")
	@Produces(MediaType.APPLICATION_JSON)
	public String getNextAssignDoctor(@PathParam("patientID") int patientID, @PathParam("date") String date) throws JSONException{
		logger.info("get next assign doctor");
		try {
			
			JSONSerializer serializer = new JSONSerializer();
			String roleName="Doctor";
			List<HrAttendance> attendenceList = new HrAttendanceDBDriver().getAllAttendance(date);
			List<AdminUser> adminUserList = new UserDBDriver().getUserDetailsByUserRole(roleName);
			List<AdminUser> userList = new ArrayList<AdminUser>();
			
			
			for(AdminUser user : adminUserList)
			{
				for(HrAttendance attendant : attendenceList)
				{
					if(attendant.getHrEmployee().getEmpId() == user.getHrEmployee().getEmpId())
					{
						userList.add(user);
					}
				}
			}
		
			System.out.println("queueStatusList  " + queueStatusList.toString());
			 
			for(QueueStatus qstat : queueStatusList)
			{ 
				for(AdminUser user : userList)
				{  
					if(qstat.user == user.getUserId())
					{
						System.out.println("Removing " + user.getUserName()+ "  " + qstat.qStatus );
						userList.remove(user);  
						break;
					}
					 
				} 
			}
			  
			System.out.println("userList  " + userList.toString());
			
			if(qType == 1 )
			{
				 
				Visit visit = new VisitDBDriver().retrieveRecent(patientID ).get(0);
				
				if(visit !=null)
				{
					// recent visit doctor
					AdminUser user = visit.getVisitDoctor();
					for(int i=0;i<userList.size();i++)
					{
						if(userList.get(i).getUserId() == user.getUserId())
						{
							return serializer.include("hrEmployee.firstName","hrEmployee.lastName","hrEmployee.empId","userId").exclude("*").serialize(user);
						}
					} 
					
					// recent visit doctor is not available in the userlist
					user = userList.get(0); 
					for(int i=0;i < userList.size();i++)
					{  
						if(userList.get(i).getUserId() == lastAssignedDcotor)
						{ 
							user =  (i + 1) < userList.size()  ? userList.get(i+1) :   userList.get(0); 
						}
					} 
					return serializer.include("hrEmployee.firstName","hrEmployee.lastName","hrEmployee.empId","userId").exclude("*").serialize(user);
				}else
				{
					// recent visit doctor is not available in the userlist
					AdminUser user = userList.get(0); 
					for(int i=0;i < userList.size();i++)
					{  
						if(userList.get(i).getUserId() == lastAssignedDcotor)
						{ 
							user =  (i + 1) < userList.size()  ? userList.get(i+1) :   userList.get(0); 
						}
					} 
					return serializer.include("hrEmployee.firstName","hrEmployee.lastName","hrEmployee.empId","userId").exclude("*").serialize(user);
					 
				}
				 
			} else
			{
			
				if(lastAssignedDcotor == -1)
				{ 
					AdminUser user = userList.get(0);
					return serializer.include("hrEmployee.firstName","hrEmployee.lastName","hrEmployee.empId","userId").exclude("*").serialize(user);  
				}else
				{	
				
					AdminUser user = userList.get(0); 
					for(int i=0;i < userList.size();i++)
					{  
						if(userList.get(i).getUserId() == lastAssignedDcotor)
						{ 
							user =  (i + 1) < userList.size()  ? userList.get(i+1) :   userList.get(0); 
						}
					}  
					return serializer.include("hrEmployee.firstName","hrEmployee.lastName","hrEmployee.empId","userId").exclude("*").serialize(user);  
				}
			}
			
		} catch (RuntimeException e)
			{
				logger.error("error getting next assign doctor: "+e.getMessage());
				JSONObject jsonErrorObject = new JSONObject();
				jsonErrorObject.put("errorcode", ErrorConstants.FILL_REQUIRED_FIELDS.getCode());
				jsonErrorObject.put("message", ErrorConstants.FILL_REQUIRED_FIELDS.getMessage());				
				
				return jsonErrorObject.toString();
		
		}catch (Exception e) {
			logger.error("error getting next assign doctor: "+e.getMessage());
			return null;
		}
	}

	
	
	//********
	
	public int getNextAssignDoctorID(int patientID, int visitType){
		try {
			
			String roleName="Doctor";
			DateFormat df = new SimpleDateFormat("yyyy-MM-dd");
			Date today = Calendar.getInstance().getTime();
			List<HrAttendance> attendenceList = new HrAttendanceDBDriver().getAllAttendanceByType(df.format(today), visitType);
			List<AdminUser> adminUserList = new UserDBDriver().getUserDetailsByUserRole(roleName);
			List<AdminUser> userList = new ArrayList<AdminUser>();
			
			
			for(AdminUser user : adminUserList)
			{
				for(HrAttendance attendant : attendenceList)
				{
					if(attendant.getHrEmployee().getEmpId() == user.getHrEmployee().getEmpId())
					{
						userList.add(user);
					}
				}
			}
		
			System.out.println("queueStatusList  " + queueStatusList.toString());
			 
			for(QueueStatus qstat : queueStatusList)
			{ 
				for(AdminUser user : userList)
				{  
					if(qstat.user == user.getUserId())
					{
						System.out.println("Removing " + user.getUserName()+ "  " + qstat.qStatus );
						userList.remove(user);  
						break;
					}
					 
				} 
			}
			  
			System.out.println("userList  " + userList.toString());
			
			if(qType == 1 )
			{
				 
				Visit visit = new VisitDBDriver().retrieveRecent(patientID ).get(0);
				
				if(visit !=null)
				{
					// recent visit doctor
					AdminUser user = visit.getVisitDoctor();
					for(int i=0;i<userList.size();i++)
					{
						if(userList.get(i).getUserId() == user.getUserId())
						{
							return user.getUserId();
						}
					} 
					
					// recent visit doctor is not available in the userlist
					user = userList.get(0); 
					for(int i=0;i < userList.size();i++)
					{  
						if(userList.get(i).getUserId() == lastAssignedDcotor)
						{ 
							user =  (i + 1) < userList.size()  ? userList.get(i+1) :   userList.get(0); 
						}
					} 
					return user.getUserId();
				}else
				{
					// recent visit doctor is not available in the userlist
					AdminUser user = userList.get(0); 
					for(int i=0;i < userList.size();i++)
					{  
						if(userList.get(i).getUserId() == lastAssignedDcotor)
						{ 
							user =  (i + 1) < userList.size()  ? userList.get(i+1) :   userList.get(0); 
						}
					} 
					return  user.getUserId();
					 
				}
				 
			} else
			{ 
				if(lastAssignedDcotor == -1)
				{  
					AdminUser user = userList.get(0);
					return user.getUserId();  
				}else
				{	
				
					AdminUser user = userList.get(0); 
					for(int i=0;i < userList.size();i++)
					{  
						if(userList.get(i).getUserId() == lastAssignedDcotor)
						{ 
							user =  (i + 1) < userList.size()  ? userList.get(i+1) :   userList.get(0); 
						}
					}   
					return user.getUserId();
				}
			}
			
		} catch (Exception e) {
			logger.error("error getting next assign doctor: "+e.getMessage());
			return -1;
		}
	}
	
}
