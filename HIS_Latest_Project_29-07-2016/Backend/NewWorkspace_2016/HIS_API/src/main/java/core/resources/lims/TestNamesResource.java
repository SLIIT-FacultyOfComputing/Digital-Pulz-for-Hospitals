package core.resources.lims;

import java.text.DateFormat;
import java.text.SimpleDateFormat;
import java.util.Date;
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
import org.jboss.logging.Logger;

import core.ErrorConstants;
import core.classes.lims.Category;
import core.classes.lims.SpecimenRetentionType;
import core.classes.lims.SpecimenType;
import core.classes.lims.SubCategory;
import core.classes.lims.TestNames;
import flexjson.JSONSerializer;
import flexjson.transformer.DateTransformer;
import lib.driver.lims.driver_class.CategoryDBDriver;
import lib.driver.lims.driver_class.SpecimenRetentionTypeDBDriver;
import lib.driver.lims.driver_class.SpecimenTypeDBDriver;
import lib.driver.lims.driver_class.TestNamesDBDriver;

@Path("TestNames")
public class TestNamesResource {

TestNamesDBDriver testDBDriver= new TestNamesDBDriver();
DateFormat dateformat = new SimpleDateFormat("yyyy-MM-dd HH:mm:ss");
DateFormat dateformat2 = new SimpleDateFormat("yyyy-MM-dd");
	
	final static Logger logger=Logger.getLogger(TestNamesResource.class);
	@POST
	@Path("/addNewtest")
	@Produces(MediaType.APPLICATION_JSON)
	@Consumes(MediaType.APPLICATION_JSON)
	public String addNewTest(JSONObject pJson) throws JSONException
	{

		logger.info("Entering addNewTest method.");
		
		try {
			TestNames test  =  new TestNames();
			
			int categoryID = pJson.getInt("fTest_CategoryID");
			int subcategoryID = pJson.getInt("fTest_Sub_CategoryID");
			int userid = pJson.getInt("fTest_CreateUserID");
			
			
			test.setTest_IDName(pJson.getString("test_IDName").toString());
			test.setTest_Name(pJson.getString("test_Name").toString());
			test.setTest_CreatedDate(new Date());
			test.setTest_LastUpdate(new Date());
			
			testDBDriver.insertNewTest(test, categoryID, subcategoryID, userid);
			logger.info("Added new test resource: "+test);
			 
			JSONSerializer jsonSerializer = new JSONSerializer();
			return jsonSerializer.include("test_ID").serialize(test);
		}
		catch(org.hibernate.exception.ConstraintViolationException e)
		{
			logger.error("Error in adding new test "+e.getMessage()); 
			JSONObject jsonErrorObject = new JSONObject();
			jsonErrorObject.put("errorcode", ErrorConstants.ENTRY_ALREADY_EXISTS.getCode());
			jsonErrorObject.put("message", ErrorConstants.ENTRY_ALREADY_EXISTS.getMessage());
			e.printStackTrace();
			return jsonErrorObject.toString(); 
		}
		catch(RuntimeException e)
		{
			logger.error("Error in adding new test "+e.getMessage()); 
			
			JSONObject jsonErrorObject = new JSONObject();
			jsonErrorObject.put("errorcode", ErrorConstants.NO_CONNECTION.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_CONNECTION.getMessage());
			e.printStackTrace();
			return jsonErrorObject.toString(); 				

		}
		catch(JSONException e)
		{
			logger.error("Error in adding new test "+e.getMessage()); 
			
			JSONObject jsonErrorObject = new JSONObject();
			jsonErrorObject.put("errorcode", ErrorConstants.FILL_REQUIRED_FIELDS.getCode());
			jsonErrorObject.put("message", ErrorConstants.FILL_REQUIRED_FIELDS.getMessage());
								
			return jsonErrorObject.toString(); 
			
		}
		catch (Exception e) {
			
			logger.error("Error in adding new test"+e.getMessage()); 
			return e.getMessage(); 
		}

	}
	
	@GET
	@Path("/getAllTests")
	@Produces(MediaType.APPLICATION_JSON)
	public String getAllSTests() throws JSONException
	{
		logger.info("Entering getAllSTests method.");
		
		try {
			List<TestNames> testsList =   testDBDriver.getTestNamesList();
			logger.info("Getting all test name resources :"+testsList);
			
			JSONSerializer serializer = new JSONSerializer();
			return  serializer.include("fTest_CategoryID.category_ID","fTest_CategoryID.category_Name","fTest_Sub_CategoryID.sub_CategoryID","fTest_Sub_CategoryID.sub_CategoryName","fTest_CreateUserID.userName","fTest_LastUpdateUserID.userName").exclude("*.class","fTest_CreateUserID.*","fTest_LastUpdateUserID.*","fTest_CategoryID.*","fTest_Sub_CategoryID.*").transform(new DateTransformer("yyyy-MM-dd"),"test_CreatedDate","test_LastUpdate")
					.serialize(testsList);
		
		} 
		catch(RuntimeException e)
		{
			logger.error("Error in getAllSTests method."+e.getMessage()); 
			
			JSONObject jsonErrorObject = new JSONObject();
			jsonErrorObject.put("errorcode", ErrorConstants.NO_CONNECTION.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_CONNECTION.getMessage());
								
			return jsonErrorObject.toString();
		}
		catch (Exception e) {
			logger.error("Error in getAllSTests method."+e.getMessage()); 
			return e.getMessage();
		}
		}
	
	@GET
	@Path("/getMaxTestID")
	@Produces(MediaType.APPLICATION_JSON)
	public String GetMAxParentID() throws JSONException
	{
		logger.info("Entering GetMAxParentID method.");
		
		try{
			String MaxID =   testDBDriver.getMaxTestID();
			logger.info("Max Test ID:"+MaxID);
			
			JSONSerializer serializer = new JSONSerializer();
			return  serializer.exclude("*.class").serialize(MaxID);
		}
		catch(RuntimeException e)
		{
			logger.error("Error in GetMAxParentID method."+e.getMessage()); 
			
			JSONObject jsonErrorObject = new JSONObject();
			jsonErrorObject.put("errorcode", ErrorConstants.NO_CONNECTION.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_CONNECTION.getMessage());
								
			return jsonErrorObject.toString();
		}
		catch (Exception e) {
			logger.error("Error in GetMAxParentID method."+e.getMessage()); 
			return e.getMessage();
		}
		
	}
	
	@POST
	@Path("/updateTestNamesTest")
	@Produces(MediaType.TEXT_PLAIN)
	@Consumes(MediaType.APPLICATION_JSON)
	public String updateTestNamesDetailsTest(JSONObject pJson) throws JSONException
	{
		
		logger.info("Entering updateTestNamesDetailsTest method.");
		
		try {
			
			TestNames test  =  new TestNames();
			
			int testid = pJson.getInt("test_ID");
			String categoryID = pJson.getString("fTest_CategoryID");
			String subcategoryID = pJson.getString("fTest_Sub_CategoryID");
			int userid = pJson.getInt("fTest_LastUpdateUserID");
		
			test.setTest_Name(pJson.getString("test_Name").toString());
			test.setTest_CreatedDate(new Date());
			test.setTest_LastUpdate(new Date());
			
			testDBDriver.updateTestNames(testid, test, categoryID, subcategoryID, userid);
			logger.info("Updating Test Resources with test id: "+testid);
			
			JSONSerializer jsonSerializer = new JSONSerializer();
			return jsonSerializer.include("test_ID").serialize(test);
			
		} 
		catch(NullPointerException e)
		{
			logger.error("Error in updating "+e.getMessage());
			
			JSONObject jsonErrorObject = new JSONObject();
			jsonErrorObject.put("errorcode", ErrorConstants.INVALID_ID.getCode());
			jsonErrorObject.put("message", ErrorConstants.INVALID_ID.getMessage());
					
			return jsonErrorObject.toString(); 
		}
		catch (JSONException e) {
			
			logger.error("Error in updating "+e.getMessage());
			
			JSONObject jsonErrorObject = new JSONObject();
			jsonErrorObject.put("errorcode", ErrorConstants.FILL_REQUIRED_FIELDS.getCode());
			jsonErrorObject.put("message", ErrorConstants.FILL_REQUIRED_FIELDS.getMessage());
						
			return jsonErrorObject.toString();
		}
		catch(RuntimeException e)
		{
			logger.error("Error in updating "+e.getMessage());
			
			JSONObject jsonErrorObject = new JSONObject();
			jsonErrorObject.put("errorcode", ErrorConstants.NO_CONNECTION.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_CONNECTION.getMessage());
								
			return jsonErrorObject.toString();
		}
		catch (Exception e) {
			 
			logger.error("Error in updating "+e.getMessage());
			return e.toString();
		}
	}

	@GET
	@Path("/deleteTests/{testsid}")
	@Produces(MediaType.APPLICATION_JSON)
	public String deleteTests(@PathParam("testsid") int testsid) throws JSONException {
		//String status="";
		logger.info("Entering  deleteTests method.");
		
		try {
			
			testDBDriver.DeleteTest(testsid);
			logger.info("Deleting Test Resources with test id: "+testsid);
			
			return String.valueOf(testsid);
		} 
		catch(org.hibernate.ObjectNotFoundException e)
		{
			logger.error("Error in deleting test resource with id "+testsid+": "+e.getMessage());
			JSONObject jsonErrorObject = new JSONObject();
			jsonErrorObject.put("errorcode", ErrorConstants.INVALID_ID.getCode());
			jsonErrorObject.put("message", ErrorConstants.INVALID_ID.getMessage());
					
			return jsonErrorObject.toString(); 
		}
		catch(RuntimeException e)
		{
			logger.error("Error in deleting test resource with id "+testsid+": "+e.getMessage());
			
			JSONObject jsonErrorObject = new JSONObject();
			jsonErrorObject.put("errorcode", ErrorConstants.NO_CONNECTION.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_CONNECTION.getMessage());
								
			return jsonErrorObject.toString();
		}
		catch (Exception e) {
			
			logger.error("Error in deleting test resource with id "+testsid+": "+e.getMessage());
			return e.getMessage();		
			
		}
	}
	
	
	
	
}