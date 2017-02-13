package core.resources.lims;

import java.util.List;

import javax.ws.rs.Consumes;
import javax.ws.rs.GET;
import javax.ws.rs.POST;
import javax.ws.rs.Path;
import javax.ws.rs.PathParam;
import javax.ws.rs.Produces;
import javax.ws.rs.core.MediaType;

import org.apache.commons.logging.impl.Log4JLogger;
import org.codehaus.jettison.json.JSONException;
import org.codehaus.jettison.json.JSONObject;
import org.hibernate.ObjectNotFoundException;
import org.apache.log4j.Logger;

import core.ErrorConstants;
import core.classes.lims.Category;
import flexjson.JSONSerializer;
import lib.driver.lims.driver_class.CategoryDBDriver;

@Path("Category")
public class CategoryResource {

	
	//define a static logger variable so that it references the
	//Logger instance named "CategoryResource"
	
	final static Logger log = Logger.getLogger(CategoryResource.class);
	
	
	CategoryDBDriver cDBDriver= new CategoryDBDriver();
	SubCategoryResource subrs = new SubCategoryResource();	
	SpecimenTypeResource spec = new SpecimenTypeResource();
	SpecimenRetentionTypeResource retention = new SpecimenRetentionTypeResource();

	public String addCategory(JSONObject pJson) throws JSONException
	{
		log.info("Entering the add Category method");
		
		try {
			Category cat  =  new Category();
			cat.setCategory_IDName("TC");
			cat.setCategory_Name(pJson.get("category").toString());	
			cDBDriver.insertCategory(cat);
			
			
			JSONSerializer jsonSerializer = new JSONSerializer();
		    jsonSerializer.include("category_ID").serialize(cat);
		    
		    log.info("Insert category Successful, catID = "+cat.getCategory_ID());
		    
			return cat.getCategory_ID()+"";
		} 
		catch (JSONException e) {
			log.error("JSON exception in Add Category, message:" + e.getMessage());
			
			JSONObject jsonErrorObject = new JSONObject();
			jsonErrorObject.put("errorcode", ErrorConstants.FILL_REQUIRED_FIELDS.getCode());
			jsonErrorObject.put("message", ErrorConstants.FILL_REQUIRED_FIELDS.getMessage());
			
			
			
			return jsonErrorObject.toString(); 
		}
		catch(RuntimeException e)
		{
			log.error("Runtime Exception in Add Category, message:" + e.getMessage());
			JSONObject jsonErrorObject = new JSONObject();
			
			jsonErrorObject.put("errorcode", ErrorConstants.NO_CONNECTION.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_CONNECTION.getMessage());
			
			
			return jsonErrorObject.toString(); 
		}
		catch (Exception e) {
			 System.out.println(e.getMessage());
			 log.error("Error while adding Category, message: " + e.getMessage());
			 JSONObject jsonErrorObject = new JSONObject();
				
			jsonErrorObject.put("errorcode", ErrorConstants.NO_DATA.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_DATA.getMessage());
				
			return jsonErrorObject.toString();
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
			
			
			List<Category> testsList = cDBDriver.getCategoryList();
			return testsList.get(testsList.size()-1).getCategory_ID() + "";	
			 	
			
			
		}
		
		catch(Exception e)
		{
			
			return e.getMessage();
		}

	}
	
	
	@GET
	@Path("/getAllCategories")
	@Produces(MediaType.APPLICATION_JSON)
	public String getAllCategories() throws JSONException
	{
		log.info("Entering the get all Category method");
		try{
			List<Category> testsList =   cDBDriver.getCategoryList();
			JSONSerializer serializer = new JSONSerializer();
		
			log.info("Get All Categories successful, list count = " + testsList.size());
		
			return  serializer.exclude("*.class").serialize(testsList);
		}
		catch(RuntimeException e)
		{
			log.error("Runtime Exception in getting All categories, message:" + e.getMessage());
			JSONObject jsonErrorObject = new JSONObject();
			
			jsonErrorObject.put("errorcode", ErrorConstants.NO_CONNECTION.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_CONNECTION.getMessage());
			
			
			return jsonErrorObject.toString(); 
		}
		catch (Exception e) {
			 System.out.println(e.getMessage());
			 log.error("Error while getting All categories, message: " + e.getMessage());
			 JSONObject jsonErrorObject = new JSONObject();
				
			jsonErrorObject.put("errorcode", ErrorConstants.NO_DATA.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_DATA.getMessage());
				
			return jsonErrorObject.toString();
		}
	}
	
	
	@POST
	@Path("/updateCategories")
	@Produces(MediaType.TEXT_PLAIN)
	@Consumes(MediaType.APPLICATION_JSON)
	public String updateCategoriesDetails(JSONObject pJson) throws JSONException
	{
		log.info("Entering the update Category method");
		
		try {
			
			Category cat  =  new Category();
			int categoryid = pJson.getInt("category_ID");
			
			cat.setCategory_Name(pJson.get("category_Name").toString());	
			cDBDriver.updateCategories(categoryid, cat);
			
			
			
			List<Category> testsList = cDBDriver.getCategoryList();
			
			log.info("Update category Successful, CatID = "+testsList.get(testsList.size()-1).getCategory_ID());
			
			return testsList.get(testsList.size()-1).getCategory_ID() + "";	
			
		} 
		catch(RuntimeException e)
		{
			log.error("Runtime Exception in updating category, message:" + e.getMessage());
			JSONObject jsonErrorObject = new JSONObject();
			
			jsonErrorObject.put("errorcode", ErrorConstants.NO_CONNECTION.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_CONNECTION.getMessage());
			
			
			return jsonErrorObject.toString(); 
		}
		catch (Exception e) {
			 System.out.println(e.getMessage());
			 log.error("Error while updating category, message: " + e.getMessage());
			 JSONObject jsonErrorObject = new JSONObject();
				
			jsonErrorObject.put("errorcode", ErrorConstants.NO_DATA.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_DATA.getMessage());
				
			return jsonErrorObject.toString();
		}
	
	}
	
	@GET
	@Path("/deleteCategory/{catid}")
	@Produces(MediaType.APPLICATION_JSON)
	public String deleteCategory(@PathParam("catid") int catid) throws JSONException {
		//String status="";
		log.info("Entering the delete Category method");
		
		try {
			
			cDBDriver.DeleteCategory(catid);
			log.info("Delete category Successful, catID = "+catid);
			
			return String.valueOf(catid);	
		}
		catch(ObjectNotFoundException e)
		{
			log.error("Object Not Found Exception in Deleting category, message:" + e.getMessage());
			JSONObject jsonErrorObject = new JSONObject();
			
			jsonErrorObject.put("errorcode", ErrorConstants.INVALID_ID.getCode());
			jsonErrorObject.put("message", ErrorConstants.INVALID_ID.getMessage());
			
			
			return jsonErrorObject.toString(); 
		}
		catch(RuntimeException e)
		{
			log.error("Runtime Exception in Deleting category, message:" + e.getMessage());
			JSONObject jsonErrorObject = new JSONObject();
			
			jsonErrorObject.put("errorcode", ErrorConstants.NO_CONNECTION.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_CONNECTION.getMessage());
			
			
			return jsonErrorObject.toString(); 
		}
		catch (Exception e) {
			 System.out.println(e.getMessage());
			 log.error("Error while Deleting category, message: " + e.getMessage());
			 JSONObject jsonErrorObject = new JSONObject();
				
			jsonErrorObject.put("errorcode", ErrorConstants.NO_DATA.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_DATA.getMessage());
				
			return jsonErrorObject.toString();
		}
	}

}