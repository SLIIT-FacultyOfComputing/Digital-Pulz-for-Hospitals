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

import org.codehaus.jettison.json.JSONArray;
import org.codehaus.jettison.json.JSONException;
import org.codehaus.jettison.json.JSONObject;

import core.classes.lims.ParentTestFields;
import flexjson.JSONSerializer;
import lib.driver.lims.driver_class.ParentTestFieldsDBDriver;
import lib.driver.lims.driver_class.TestFieldsRangeDBDriver;
import lib.driver.lims.driver_class.TestNamesDBDriver;

@Path("ParentTestFields")
public class ParentTestFieldsResource {

ParentTestFieldsDBDriver parentfieldDBDriver= new ParentTestFieldsDBDriver();
TestFieldsRangeDBDriver testFieldsRangeDBDriver= new TestFieldsRangeDBDriver();
TestNamesDBDriver testNamesDBDriver= new TestNamesDBDriver();
	

	@POST
	@Path("/addNewParentTestField")
	@Produces("text/plain")
	@Consumes(MediaType.APPLICATION_JSON)
	public String addNewParentField(JSONObject obj)
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
			return "true";
		} catch (JSONException e) {
			System.out.print(e.getMessage());
			e.printStackTrace();
		}
		return "false";
	}
	
	@GET
	@Path("/getAllParenTestFields")
	@Produces(MediaType.APPLICATION_JSON)
	public String getAllParenTestFields()
	{
		List<ParentTestFields> parentTestFIeldsList =   parentfieldDBDriver.getParentTeatFieldsList();
		JSONSerializer serializer = new JSONSerializer();
		return  serializer.include("fTest_NameID.test_Name").exclude("*.class","fTest_NameID.*").serialize(parentTestFIeldsList);
	}
	
	@GET
	@Path("/getAllParenTestFields/{ID}")
	@Produces(MediaType.APPLICATION_JSON)
	public String getAllParenTestFieldsByID(@PathParam("ID")int TestID)
	{
		List<ParentTestFields> parentTestFIeldsList =   parentfieldDBDriver.getParentField(TestID);
		JSONSerializer serializer = new JSONSerializer();
		return  serializer.exclude("*.class").serialize(parentTestFIeldsList);
	}
	
	@GET
	@Path("/getMaxParentID")
	@Produces(MediaType.APPLICATION_JSON)
	public String GetMAxParentID()
	{
		String MaxID =   parentfieldDBDriver.getMaxParentID();
		JSONSerializer serializer = new JSONSerializer();
		return  serializer.exclude("*.class").serialize(MaxID);
	}
	
	
}