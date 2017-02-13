package core.resources.lims;

import java.util.HashSet;
import java.util.List;
import java.util.Set;

import javax.ws.rs.Consumes;
import javax.ws.rs.GET;
import javax.ws.rs.POST;
import javax.ws.rs.Path;
import javax.ws.rs.Produces;
import javax.ws.rs.core.MediaType;

import org.apache.log4j.Logger;
import org.codehaus.jettison.json.JSONArray;
import org.codehaus.jettison.json.JSONException;
import org.codehaus.jettison.json.JSONObject;

import core.ErrorConstants;
import core.classes.lims.Category;
import core.classes.lims.ParentTestFields;
import core.classes.lims.SubTestFields;
import core.classes.lims.TestFieldsRange;
import core.resources.opd.LiveSearch;
import flexjson.JSONSerializer;
import lib.driver.lims.driver_class.CategoryDBDriver;
import lib.driver.lims.driver_class.ParentTestFieldsDBDriver;
import lib.driver.lims.driver_class.SubTestFieldsDBDriver;
import lib.driver.lims.driver_class.TestFieldsRangeDBDriver;

@Path("TestFieldsRange")
public class TestFieldsRangeResource {
	
final static Logger logger = Logger.getLogger(TestFieldsRangeResource.class);

TestFieldsRangeDBDriver  rangeDBDriver= new TestFieldsRangeDBDriver();
ParentTestFieldsDBDriver parentfieldDBDriver = new ParentTestFieldsDBDriver();
SubTestFieldsDBDriver subtestfieldsDBDriver = new SubTestFieldsDBDriver();
	
	@POST
	@Path("/addNewRange")
	@Produces(MediaType.APPLICATION_JSON)
	@Consumes(MediaType.APPLICATION_JSON)
	public String addRanges(JSONObject obj) throws JSONException
	{
		logger.info("add new ranges");
		try {
			
			System.out.println(obj);
				TestFieldsRange ra = new TestFieldsRange();
				ra.setGender(obj.getString("gender").toString());
				ra.setMinage(Integer.parseInt(obj.getString("minAge").toString()));
				ra.setMaxage(Integer.parseInt(obj.getString("maxAge").toString()));
				ra.setUnit(obj.getString("unit").toString());
				ra.setMinVal(Double.parseDouble(obj.getString("minValue").toString()));
				ra.setMaxVal(Double.parseDouble(obj.getString("maxValue").toString()));
				int i = (Integer.parseInt(obj.getString("parentID").toString()));
				
			
				
				/*ParentTestFields p = new ParentTestFields();
				p.setParent_FieldName(obj.getString("ftestname").toString());
				p.setParentField_IDName("PF");
				parentfieldDBDriver.addNewParentTestField(p);*/
				
				
				ra.setFparentfield_ID(parentfieldDBDriver.getParentFieldByID(Integer.parseInt(obj.getString("parentID").toString())));
				//ra.setFsubfield_ID(subtestfieldsDBDriver.getSubTestFieldByID(Integer.parseInt(obj.getString("fsubfield_ID").toString())));
			
				rangeDBDriver.addNewRange(ra);
				logger.info("successfully new range added");
				JSONSerializer jsonSerializer = new JSONSerializer();
				return jsonSerializer.include("range_ID").serialize(ra);
				
			
		} catch (JSONException e) {
			logger.error("error adding new range: "+e.getMessage());
			JSONObject jsonErrorObject = new JSONObject();
			jsonErrorObject.put("errorcode", ErrorConstants.FILL_REQUIRED_FIELDS.getCode());
			jsonErrorObject.put("message", ErrorConstants.FILL_REQUIRED_FIELDS.getMessage());		
			
			return jsonErrorObject.toString(); 
		} 
		catch (RuntimeException e)
		{
			logger.error("error adding new range: "+e.getMessage());
			JSONObject jsonErrorObject = new JSONObject();
			jsonErrorObject.put("errorcode", ErrorConstants.FILL_REQUIRED_FIELDS.getCode());
			jsonErrorObject.put("message", ErrorConstants.FILL_REQUIRED_FIELDS.getMessage());
			
			return jsonErrorObject.toString();
		}   	        
		catch (Exception e) {
			logger.error("error adding new range: "+e.getMessage());
			return null; 
		}
		
	}
	
	@POST
	@Path("/addNewSubRange")
	@Produces(MediaType.APPLICATION_JSON)
	@Consumes(MediaType.APPLICATION_JSON)
	public String addSubRanges(JSONObject obj) throws JSONException
	{
		logger.info("add new sub ranges");
		try {
			
			    System.out.print(obj);
				TestFieldsRange ra = new TestFieldsRange();
				ra.setGender(obj.getString("gender").toString());
				ra.setMinage(Integer.parseInt(obj.getString("minAge").toString()));
				ra.setMaxage(Integer.parseInt(obj.getString("maxAge").toString()));
				ra.setUnit(obj.getString("unit").toString());
				ra.setMinVal(Double.parseDouble(obj.getString("minValue").toString()));
				ra.setMaxVal(Double.parseDouble(obj.getString("maxValue").toString()));
				ra.setFparentfield_ID(parentfieldDBDriver.getParentFieldByID(Integer.parseInt(obj.getString("parentID").toString())));
				//ra.setFsubfield_ID(subtestfieldsDBDriver.getSubTestFieldByID(id));
		
				ra.setFsubfield_ID(subtestfieldsDBDriver.getSubTestFieldByID(Integer.parseInt(obj.getString("sub_field").toString())));
				
				rangeDBDriver.addNewRange(ra);
				
				logger.info("successfully new sub range added");
				return ""+1;
				
			
		} catch (JSONException e) {
			logger.error("error adding new sub range: "+e.getMessage());
			JSONObject jsonErrorObject = new JSONObject();
			jsonErrorObject.put("errorcode", ErrorConstants.FILL_REQUIRED_FIELDS.getCode());
			jsonErrorObject.put("message", ErrorConstants.FILL_REQUIRED_FIELDS.getMessage());			
			
			return jsonErrorObject.toString(); 

		} 
		catch (RuntimeException e)
		{
			logger.error("error adding new sub range: "+e.getMessage());
			JSONObject jsonErrorObject = new JSONObject();
			jsonErrorObject.put("errorcode", ErrorConstants.FILL_REQUIRED_FIELDS.getCode());
			jsonErrorObject.put("message", ErrorConstants.FILL_REQUIRED_FIELDS.getMessage());			
			
			return jsonErrorObject.toString();
		}
		catch (Exception e) {
			logger.error("error adding new sub range: "+e.getMessage());
			return null; 
		}
		
	}
	
	@GET
	@Path("/getAllRanges")
	@Produces(MediaType.APPLICATION_JSON)
	public String getAllCategories()
	{
		logger.info("get all ranges");
		List<TestFieldsRange> rangeList =   rangeDBDriver.getRangeList();
		JSONSerializer serializer = new JSONSerializer();
		logger.info("successfully getting all ranges");
		return  serializer.include("fparentfield_ID.parent_FieldName","fsubfield_ID.subtest_FieldName").exclude("*.class","fparentfield_ID.*","fsubfield_ID.*").serialize(rangeList);
	}
	
	
	
	
}