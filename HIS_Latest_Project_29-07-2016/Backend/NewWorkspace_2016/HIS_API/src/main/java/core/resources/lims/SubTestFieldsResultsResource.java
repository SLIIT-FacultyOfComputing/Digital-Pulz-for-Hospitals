package core.resources.lims;

import java.util.Date;
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
import core.classes.lims.ParentTestFields;
import core.classes.lims.SubFieldResults;
import core.classes.lims.SubTestFields;
import core.resources.opd.LiveSearch;
import flexjson.JSONSerializer;
import flexjson.transformer.DateTransformer;
import lib.driver.lims.driver_class.MainResultsDBDriver;
import lib.driver.lims.driver_class.ParentTestFieldsDBDriver;
import lib.driver.lims.driver_class.SubTestFieldsDBDriver;
import lib.driver.lims.driver_class.SubTestFieldsResultsDBDriver;
import lib.driver.lims.driver_class.TestFieldsRangeDBDriver;
import lib.driver.lims.driver_class.TestNamesDBDriver;

@Path("SubTestFieldsResults")
public class SubTestFieldsResultsResource {
	
	final static Logger logger = Logger.getLogger(SubTestFieldsResultsResource.class);

MainResultsDBDriver mainresultDBDriver = new MainResultsDBDriver();
SubTestFieldsResultsDBDriver subtestfieldresultsDBDriver = new SubTestFieldsResultsDBDriver();
SubTestFieldsDBDriver subtestfieldDBDriver = new SubTestFieldsDBDriver();
ParentTestFieldsDBDriver parentfieldDBDriver = new ParentTestFieldsDBDriver();
	
@POST
@Path("/addNewSubTestField")
@Produces("text/plain")
@Consumes(MediaType.APPLICATION_JSON)
public String addNewSubFieldResult(JSONObject obj) throws JSONException
{
	logger.info("add new sub field result");
	
	Set<SubFieldResults> SubFieldResultsList = null;
	try {
		JSONArray data = obj.getJSONArray("subfieldsresults");
		SubFieldResultsList = new HashSet<SubFieldResults>();
		for (int curr = 0; curr < data.length(); curr++){
			SubFieldResults sf = new SubFieldResults();
			sf.setSubFieldResult("subFieldResult");
			sf.setfMResultID(mainresultDBDriver.getMainResultsByID(Integer.parseInt(data.getJSONObject(curr).getString("fMResultID"))));
			sf.setfSubF_ID(subtestfieldDBDriver.getSubTestFieldByID(Integer.parseInt(data.getJSONObject(curr).getString("fSubF_ID"))));
			sf.setfParentF_ID(parentfieldDBDriver.getParentFieldByID(Integer.parseInt(data.getJSONObject(curr).getString("fParentF_ID"))));	
			sf.setResult_FinalizedDate(new Date());
			//sf.setfTest_RangeID(testFieldsRangeDBDriver.getTestFieldRangeByID(Integer.parseInt(data.getJSONObject(curr).getString("fTest_RangeID"))));
	
			SubFieldResultsList.add(sf);
		
        } 
		
		for (SubFieldResults sf : SubFieldResultsList) {
			subtestfieldresultsDBDriver.addNewSubTestFieldResults(sf);
		}
		
		logger.info("successfully sub field result added");

		JSONSerializer jsonSerializer = new JSONSerializer();
		return  jsonSerializer.include("fParentF_ID.parent_FieldName","fSubF_ID.subtest_FieldName","fMResultID.result_ID","subFieldResult").exclude("*.class","fMResultID.*","fSubF_ID.*","fParentF_ID.*").transform(new DateTransformer("yyyy-MM-dd"),"result_FinalizedDate").serialize(SubFieldResultsList);
		
	} catch (JSONException e) {
		JSONObject jsonErrorObject = new JSONObject();
		jsonErrorObject.put("errorcode", ErrorConstants.FILL_REQUIRED_FIELDS.getCode());
		jsonErrorObject.put("message", ErrorConstants.FILL_REQUIRED_FIELDS.getMessage());		
		
		return jsonErrorObject.toString(); 

	}    
	catch (RuntimeException e)
	{
		logger.error("error adding sub test field: "+e.getMessage());
		JSONObject jsonErrorObject = new JSONObject();
		jsonErrorObject.put("errorcode", ErrorConstants.FILL_REQUIRED_FIELDS.getCode());
		jsonErrorObject.put("message", ErrorConstants.FILL_REQUIRED_FIELDS.getMessage());		
		
		return jsonErrorObject.toString();
	}
	catch (Exception e) {
		logger.error("error adding sub test field: "+e.getMessage());
		return null; 
	}
	
}
	
	@GET
	@Path("/getAllSubTestFieldsResults")
	@Produces(MediaType.APPLICATION_JSON)
	public String getAllSubTestFieldsResults()
	{
		logger.info("get all sub test fields results");
		List<SubFieldResults> subTestFIeldsResultsList =   subtestfieldresultsDBDriver.getSubTestFieldsResultsList();
		JSONSerializer serializer = new JSONSerializer();
		logger.info("successfully getting all test fields results");
		return  serializer.include("fParentF_ID.parent_FieldName","fSubF_ID.subtest_FieldName","fMResultID.result_ID","subFieldResult").exclude("*.class","fMResultID.*","fSubF_ID.*","fParentF_ID.*").transform(new DateTransformer("yyyy-MM-dd"),"result_FinalizedDate").serialize(subTestFIeldsResultsList);
	}
	
	
	
}
