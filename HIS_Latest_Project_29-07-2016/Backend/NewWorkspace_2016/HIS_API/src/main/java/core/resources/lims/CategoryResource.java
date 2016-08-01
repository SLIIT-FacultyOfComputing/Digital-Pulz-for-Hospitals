package core.resources.lims;

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
import flexjson.JSONSerializer;
import lib.driver.lims.driver_class.CategoryDBDriver;

@Path("Category")
public class CategoryResource {

CategoryDBDriver cDBDriver= new CategoryDBDriver();
SubCategoryResource subrs = new SubCategoryResource();	
SpecimenTypeResource spec = new SpecimenTypeResource();
SpecimenRetentionTypeResource retention = new SpecimenRetentionTypeResource();

	public String addCategory(JSONObject pJson)
	{
		
		try {
			Category cat  =  new Category();
			cat.setCategory_IDName("TC");
			cat.setCategory_Name(pJson.get("category").toString());	
			cDBDriver.insertCategory(cat);
			 
			JSONSerializer jsonSerializer = new JSONSerializer();
		    jsonSerializer.include("category_ID").serialize(cat);
			return cat.getCategory_ID()+"";
		} catch (Exception e) {
			 System.out.println(e.getMessage());
			return null; 
		}

	}
	
	@POST
	@Path("/addNewCatDetails")
	@Produces(MediaType.APPLICATION_JSON)
	@Consumes(MediaType.APPLICATION_JSON)
	public String addNewCatDetails(JSONObject pJson)
	{
		
//		try {
//			Category cat  =  new Category();
//			cat.setCategory_IDName("TC");
//			cat.setCategory_Name(pJson.get("category").toString());	
//			cDBDriver.insertCategory(cat);
//			 
//			JSONSerializer jsonSerializer = new JSONSerializer();
//			return jsonSerializer.include("category_ID").serialize(cat);
//		} catch (Exception e) {
//			 System.out.println(e.getMessage());
//			return null; 
//		}
		
		
		try{
			String catid = addCategory(pJson);
			String Subid = subrs.addSubCategory(pJson,catid);
			String spect = spec.addSpecimenType(pJson,catid,Subid);
			retention.addSpecimenType(pJson,catid,Subid,spect);
			
			
			
			return null;
			
			
		}catch(Exception e)
		{
			
			return null;
		}

	}
	
	
	@GET
	@Path("/getAllCategories")
	@Produces(MediaType.APPLICATION_JSON)
	public String getAllCategories()
	{
		List<Category> testsList =   cDBDriver.getCategoryList();
		JSONSerializer serializer = new JSONSerializer();
		return  serializer.exclude("*.class").serialize(testsList);
	}
	
	
	@POST
	@Path("/updateCategories")
	@Produces(MediaType.TEXT_PLAIN)
	@Consumes(MediaType.APPLICATION_JSON)
	public String updateCategoriesDetails(JSONObject pJson)
	{
		
		
		try {
			
			Category cat  =  new Category();
			int categoryid = pJson.getInt("category_ID");
			
			cat.setCategory_Name(pJson.get("category_Name").toString());	
			cDBDriver.updateCategories(categoryid, cat);
			
			return "True";	
			
		} catch (Exception e) {
			 
			return "False";
		}
	}
	
	@GET
	@Path("/deleteCategory/{catid}")
	@Produces(MediaType.APPLICATION_JSON)
	public String deleteCategory(@PathParam("catid") int catid) {
		//String status="";
		try {
			
			
			cDBDriver.DeleteCategory(catid);
			
			return "True";	
		} catch (Exception e) {
			return "False";
		}
	}

}