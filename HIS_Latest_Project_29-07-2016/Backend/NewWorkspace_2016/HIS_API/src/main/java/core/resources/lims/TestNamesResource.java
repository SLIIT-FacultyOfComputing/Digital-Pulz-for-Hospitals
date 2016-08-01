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
	
	@POST
	@Path("/addNewtest")
	@Produces(MediaType.APPLICATION_JSON)
	@Consumes(MediaType.APPLICATION_JSON)
	public String addNewTest(JSONObject pJson)
	{

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
			
			 
			JSONSerializer jsonSerializer = new JSONSerializer();
			return jsonSerializer.include("test_ID").serialize(test);
		} catch (Exception e) {
			 System.out.println(e.getMessage());
			 
			return null; 
		}

	}
	
	@GET
	@Path("/getAllTests")
	@Produces(MediaType.APPLICATION_JSON)
	public String getAllSTests()
	{
		List<TestNames> testsList =   testDBDriver.getTestNamesList();
		JSONSerializer serializer = new JSONSerializer();
		return  serializer.include("fTest_CategoryID.category_ID","fTest_CategoryID.category_Name","fTest_Sub_CategoryID.sub_CategoryID","fTest_Sub_CategoryID.sub_CategoryName","fTest_CreateUserID.userName","fTest_LastUpdateUserID.userName").exclude("*.class","fTest_CreateUserID.*","fTest_LastUpdateUserID.*","fTest_CategoryID.*","fTest_Sub_CategoryID.*").transform(new DateTransformer("yyyy-MM-dd"),"test_CreatedDate","test_LastUpdate")
				.serialize(testsList);
	}
	
	@GET
	@Path("/getMaxTestID")
	@Produces(MediaType.APPLICATION_JSON)
	public String GetMAxParentID()
	{
		String MaxID =   testDBDriver.getMaxTestID();
		JSONSerializer serializer = new JSONSerializer();
		return  serializer.exclude("*.class").serialize(MaxID);
	}
	
	@POST
	@Path("/updateTestNamesTest")
	@Produces(MediaType.TEXT_PLAIN)
	@Consumes(MediaType.APPLICATION_JSON)
	public String updateTestNamesDetailsTest(JSONObject pJson)
	{
		
		
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
			return "True";	
			
		} catch (Exception e) {
			 
			return "False";
		}
	}

	@GET
	@Path("/deleteTests/{testsid}")
	@Produces(MediaType.APPLICATION_JSON)
	public String deleteTests(@PathParam("testsid") int testsid) {
		//String status="";
		try {
			
			testDBDriver.DeleteTest(testsid);
			
			
			return "True";	
		} catch (Exception e) {
			return "False";
		}
	}
	
	
	
	
}