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

import org.codehaus.jettison.json.JSONArray;
import org.codehaus.jettison.json.JSONException;
import org.codehaus.jettison.json.JSONObject;

import core.classes.lims.ParentTestFields;
import core.classes.lims.SubFieldResults;
import core.classes.lims.SubTestFields;
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

MainResultsDBDriver mainresultDBDriver = new MainResultsDBDriver();
SubTestFieldsResultsDBDriver subtestfieldresultsDBDriver = new SubTestFieldsResultsDBDriver();
SubTestFieldsDBDriver subtestfieldDBDriver = new SubTestFieldsDBDriver();
ParentTestFieldsDBDriver parentfieldDBDriver = new ParentTestFieldsDBDriver();
	
@POST
@Path("/addNewSubTestField")
@Produces("text/plain")
@Consumes(MediaType.APPLICATION_JSON)
public String addNewSubFieldResult(JSONObject obj)
{
	try {
		JSONArray data = obj.getJSONArray("subfieldsresults");
		Set<SubFieldResults> SubFieldResultsList = new HashSet<SubFieldResults>();
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
		
	} catch (JSONException e) {
		e.printStackTrace();
		return null; 
	}     	        
	catch (Exception e) {
		System.out.println(e.getMessage());
		return null; 
	}
	return "TRUE";
}
	
	@GET
	@Path("/getAllSubTestFieldsResults")
	@Produces(MediaType.APPLICATION_JSON)
	public String getAllSubTestFieldsResults()
	{
		List<SubFieldResults> subTestFIeldsResultsList =   subtestfieldresultsDBDriver.getSubTestFieldsResultsList();
		JSONSerializer serializer = new JSONSerializer();
		return  serializer.include("fParentF_ID.parent_FieldName","fSubF_ID.subtest_FieldName","fMResultID.result_ID","subFieldResult").exclude("*.class","fMResultID.*","fSubF_ID.*","fParentF_ID.*").transform(new DateTransformer("yyyy-MM-dd"),"result_FinalizedDate").serialize(subTestFIeldsResultsList);
	}
	
	
	
}
