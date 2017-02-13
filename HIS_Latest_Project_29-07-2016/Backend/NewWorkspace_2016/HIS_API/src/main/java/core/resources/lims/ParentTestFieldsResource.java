package core.resources.lims;

import java.util.HashSet;
import java.util.List;
import java.util.Set;

import javax.ws.rs.Consumes;
import javax.ws.rs.GET;
import javax.ws.rs.POST;
import javax.ws.rs.Path;
import javax.ws.rs.PathParam;
import javax.ws.rs.Produces;
import javax.ws.rs.core.MediaType;

import org.apache.log4j.Logger;
import org.codehaus.jettison.json.JSONArray;
import org.codehaus.jettison.json.JSONException;
import org.codehaus.jettison.json.JSONObject;

import core.ErrorConstants;
import core.classes.lims.ParentTestFields;
import core.resources.opd.LiveSearch;
import flexjson.JSONSerializer;
import lib.driver.lims.driver_class.ParentTestFieldsDBDriver;
import lib.driver.lims.driver_class.TestFieldsRangeDBDriver;
import lib.driver.lims.driver_class.TestNamesDBDriver;

@Path("ParentTestFields")
public class ParentTestFieldsResource {
	
	final static Logger logger = Logger.getLogger(ParentTestFieldsResource.class);

ParentTestFieldsDBDriver parentfieldDBDriver= new ParentTestFieldsDBDriver();
TestFieldsRangeDBDriver testFieldsRangeDBDriver= new TestFieldsRangeDBDriver();
TestNamesDBDriver testNamesDBDriver= new TestNamesDBDriver();
	

	@POST
	@Path("/addNewParentTestField")
	@Produces("text/plain")
	@Consumes(MediaType.APPLICATION_JSON)
	public String addNewParentField(JSONObject obj) throws JSONException
	{
		/*try {
			JSONArray data = obj.getJSONArray("parentfileds");
			Set<ParentTestFields> ParentFieldList = new HashSet<ParentTestFields>();
			for (int curr = 0; curr < data.length(); curr++){
				ParentTestFields pf = new ParentTestFields();
				pf.setParentField_IDName("PF");
				pf.setParent_FieldName(data.getJSONObject(curr).getString("parent_FieldName"));
				//pf.setfTest_RangeID(testFieldsRangeDBDriver.getTestFieldRangeByID(Integer.parseInt(data.getJSONObject(curr).getString("fTest_RangeID"))));
				pf.setfTest_NameID(testNamesDBDriver.getTestNameByID(Integer.parseInt(data.getJSONObject(curr).getString("fTest_NameID"))));
				System.out.print(pf.getParent_FieldID());
				ParentFieldList.add(pf);
	        } 
			
			for (ParentTestFields pf : ParentFieldList) {
				parentfieldDBDriver.addNewParentTestField(pf);
			}*/
		/*	
		} catch (JSONException e) {
			e.printStackTrace();
			System.out.print(e.getMessage());
			return null; 
		}
		    	        
			catch (Exception e) {
				System.out.println(e.getMessage());
				return null; 
			}
			return "TRUE";*/
		
		logger.info("add new parent field");
		ParentTestFields pf = new ParentTestFields();
		try {
			int id = obj.getInt("lab_test_id");
			
			
			pf.setParent_FieldName(obj.getString("test_field_name"));
			pf.setParentField_IDName("PF");
			pf.setfTest_NameID(testNamesDBDriver.getTestNameByID(id));
			//pf.setfTest_RangeID(testFieldsRangeDBDriver.getTestFieldRangeByID(Integer.parseInt(data.getJSONObject(curr).getString("fTest_RangeID"))));
			//pf.setfTest_NameID(obj.getString("fTest_NameID"));
		//	pf.setfTest_NameID(testNamesDBDriver.getTestNameByID(Integer.parseInt(data.getJSONObject(curr).getString("fTest_NameID"))));
		
			parentfieldDBDriver.addNewParentTestField(pf);
			logger.info("successfully parent field added");
			JSONSerializer jsonSerializer = new JSONSerializer();
			return jsonSerializer.include("lab_test_id").exclude("*.class").serialize(pf);
		} catch (JSONException e) {
			logger.error("error adding parent test field: "+e.getMessage());
			JSONObject jsonErrorObject = new JSONObject();
			jsonErrorObject.put("errorcode", ErrorConstants.FILL_REQUIRED_FIELDS.getCode());
			jsonErrorObject.put("message", ErrorConstants.FILL_REQUIRED_FIELDS.getMessage());			
			
			return jsonErrorObject.toString(); 
		}
		catch (RuntimeException e)
		{
			logger.error("error adding parent test field: "+e.getMessage());
			JSONObject jsonErrorObject = new JSONObject();
			jsonErrorObject.put("errorcode", ErrorConstants.FILL_REQUIRED_FIELDS.getCode());
			jsonErrorObject.put("message", ErrorConstants.FILL_REQUIRED_FIELDS.getMessage());
						
			return jsonErrorObject.toString();
		}
		//logger.info("parent field not added");
		//return "null";
		//return "False";
	}
	
	@GET
	@Path("/getAllParenTestFields")
	@Produces(MediaType.APPLICATION_JSON)
	public String getAllParenTestFields()
	{
		logger.info("get all parent test fields");
		List<ParentTestFields> parentTestFIeldsList =   parentfieldDBDriver.getParentTeatFieldsList();
		JSONSerializer serializer = new JSONSerializer();
		logger.info("successfully getting all parent field");
		return  serializer.include("fTest_NameID.test_Name", "fTest_NameID.test_ID").exclude("*.class","fTest_NameID.*").serialize(parentTestFIeldsList);
	}
	
	@GET
	@Path("/getAllParenTestFields/{ID}")
	@Produces(MediaType.APPLICATION_JSON)
	public String getAllParenTestFieldsByID(@PathParam("ID")int TestID)
	{
		logger.info("get all parent test fields by test id");
		List<ParentTestFields> parentTestFIeldsList =   parentfieldDBDriver.getParentField(TestID);
		JSONSerializer serializer = new JSONSerializer();
		logger.info("successfully getting parent field");
		return  serializer.exclude("*.class").serialize(parentTestFIeldsList);
	}
	
	@GET
	@Path("/getMaxParentID")
	@Produces(MediaType.APPLICATION_JSON)
	public String GetMAxParentID()
	{	 
		logger.info("get maximum patent id");
		String MaxID =   parentfieldDBDriver.getMaxParentID();
		JSONSerializer serializer = new JSONSerializer();
		logger.info("successfully getting max parent field id");
		return  serializer.exclude("*.class").serialize(MaxID);
	}
	
	
}