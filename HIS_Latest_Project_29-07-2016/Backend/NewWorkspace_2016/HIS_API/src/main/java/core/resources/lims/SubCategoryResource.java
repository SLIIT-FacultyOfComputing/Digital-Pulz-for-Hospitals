package core.resources.lims;

import java.util.List;

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
import org.hibernate.ObjectNotFoundException;

import core.ErrorConstants;
import core.classes.lims.Category;
import core.classes.lims.SubCategory;
import flexjson.JSONSerializer;
import lib.driver.lims.driver_class.CategoryDBDriver;
import lib.driver.lims.driver_class.SubCategoryDBDriver;

@Path("SubCategory")
public class SubCategoryResource {

	SubCategoryDBDriver sDBDriver= new SubCategoryDBDriver();
	
	final static Logger log = Logger.getLogger(SubCategoryResource.class);

	public String addSubCategory(JSONObject pJson,String Cid) throws JSONException
	{	
		log.info("Entering the add subCategory method");
		
		try {
			SubCategory scat  =  new SubCategory();
			
			int categoryID = Integer.parseInt(Cid);
			
			scat.setSubCategory_IDName("SC");
			scat.setSub_CategoryName(pJson.get("sub_category").toString());
			
			
			sDBDriver.insertSubCategory(scat, categoryID);
			
			log.info("Insert subCategory Successful, subID = "+scat.getSub_CategoryID());
			
			 
			JSONSerializer jsonSerializer = new JSONSerializer();
			jsonSerializer.include("sub_CategoryID").serialize(scat);
			return scat.getSub_CategoryID()+"";
		} 
		catch(RuntimeException e)
		{
			log.error("Runtime Exception in inserting subCategory, message:" + e.getMessage());
			JSONObject jsonErrorObject = new JSONObject();
			
			jsonErrorObject.put("errorcode", ErrorConstants.NO_CONNECTION.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_CONNECTION.getMessage());
			
			
			return jsonErrorObject.toString(); 
		}
		catch (Exception e) {
			 System.out.println(e.getMessage());
			 log.error("Error while inserting subCategory, message: " + e.getMessage());
			 JSONObject jsonErrorObject = new JSONObject();
				
			jsonErrorObject.put("errorcode", ErrorConstants.NO_DATA.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_DATA.getMessage());
				
			return jsonErrorObject.toString();
		}


	}
	
	@GET
	@Path("/getAllSubCategories")
	@Produces(MediaType.APPLICATION_JSON)
	public String getAllSubCategories() throws JSONException
	{
		try{
			log.info("Entering the get all subCategory method");
		
			List<SubCategory> subCatList =   sDBDriver.getSubCategoryList();
			JSONSerializer serializer = new JSONSerializer();
			return  serializer.include("fCategory_ID.category_ID","fCategory_ID.category_Name","Specimentypes").exclude("*.class","fCategory_ID.*").serialize(subCatList);
		}
		catch(RuntimeException e)
		{
			log.error("Runtime Exception in getting all subCategory, message:" + e.getMessage());
			JSONObject jsonErrorObject = new JSONObject();
			
			jsonErrorObject.put("errorcode", ErrorConstants.NO_CONNECTION.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_CONNECTION.getMessage());
			
			
			return jsonErrorObject.toString(); 
		}
		catch (Exception e) {
			 System.out.println(e.getMessage());
			 log.error("Error while getting all subCategory, message: " + e.getMessage());
			 JSONObject jsonErrorObject = new JSONObject();
				
			jsonErrorObject.put("errorcode", ErrorConstants.NO_DATA.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_DATA.getMessage());
				
			return jsonErrorObject.toString();
		}
	}
	
	@GET
	@Path("/getSubCategoriesByCategoryID/{catID}")
	@Produces(MediaType.APPLICATION_JSON)
	public String getAllSubCategories(@PathParam("catID")int catID) throws JSONException
	{
		try{
			log.info("Entering the get all subCategory by Cat ID method");
		
			List<SubCategory> subCatList =   sDBDriver.getSubCategoryListByCatID(catID);
			JSONSerializer serializer = new JSONSerializer();
			return  serializer.include("sub_CategoryID","subCategory_IDName","sub_CategoryName").exclude("*.class","fCategory_ID.*").serialize(subCatList);
		}
		catch(RuntimeException e)
		{
			log.error("Runtime Exception in getting all subCategory by catID, message:" + e.getMessage());
			JSONObject jsonErrorObject = new JSONObject();
			
			jsonErrorObject.put("errorcode", ErrorConstants.NO_CONNECTION.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_CONNECTION.getMessage());
			
			
			return jsonErrorObject.toString(); 
		}
		catch (Exception e) {
			 System.out.println(e.getMessage());
			 log.error("Error while getting all subCategory by catID, message: " + e.getMessage());
			 JSONObject jsonErrorObject = new JSONObject();
				
			jsonErrorObject.put("errorcode", ErrorConstants.NO_DATA.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_DATA.getMessage());
				
			return jsonErrorObject.toString();
		}
	}
	
	@GET
	@Path("/deleteSubCategory/{Subcatid}")
	@Produces(MediaType.APPLICATION_JSON)
	public String deleteSubCategory(@PathParam("Subcatid") int Subcatid) throws JSONException {
		//String status="";
		try {
			log.info("Entering the delete subCategory method");
			sDBDriver.DeleteSubCategory(Subcatid);
			
			log.info("Delete SubCategory successful , SubcatId = " + Subcatid);
			return String.valueOf(Subcatid);
			
		} 
		catch(ObjectNotFoundException e)
		{
			log.error("Object Not Found Exception in Deleting subCategory, message:" + e.getMessage());
			JSONObject jsonErrorObject = new JSONObject();
			
			jsonErrorObject.put("errorcode", ErrorConstants.INVALID_ID.getCode());
			jsonErrorObject.put("message", ErrorConstants.INVALID_ID.getMessage());
			
			
			return jsonErrorObject.toString(); 
		}
		catch(RuntimeException e)
		{
			log.error("Runtime Exception in Deleting subCategory, message:" + e.getMessage());
			JSONObject jsonErrorObject = new JSONObject();
			
			jsonErrorObject.put("errorcode", ErrorConstants.NO_CONNECTION.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_CONNECTION.getMessage());
			
			
			return jsonErrorObject.toString(); 
		}
		catch (Exception e) {
			 System.out.println(e.getMessage());
			 log.error("Error while Deleting subCategory, message: " + e.getMessage());
			 JSONObject jsonErrorObject = new JSONObject();
				
			jsonErrorObject.put("errorcode", ErrorConstants.NO_DATA.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_DATA.getMessage());
				
			return jsonErrorObject.toString();
		}

	}
	
	@POST
	@Path("/updateSubCategories")
	@Produces(MediaType.TEXT_PLAIN)
	@Consumes(MediaType.APPLICATION_JSON)
	public String updateSubCategoriesDetails(JSONObject pJson) throws JSONException
	{
		
		
		try {
			log.info("Entering the updating subCategory method");
			SubCategory Subcat  =  new SubCategory();
			int Subcategoryid = pJson.getInt("sub_CategoryID");
			//int categoryID = pJson.getInt("fCategory_ID");
			
			
			Subcat.setSub_CategoryName(pJson.get("sub_CategoryName").toString());
			sDBDriver.updateSubCategories(Subcategoryid, Subcat);
		
			log.info("updating SubCategory successful , SubcatId = " + Subcategoryid);
			return String.valueOf(Subcategoryid);	
			
		} 
		catch(RuntimeException e)
		{
			log.error("Runtime Exception in updating subCategory, message:" + e.getMessage());
			JSONObject jsonErrorObject = new JSONObject();
			
			jsonErrorObject.put("errorcode", ErrorConstants.NO_CONNECTION.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_CONNECTION.getMessage());
			
			
			return jsonErrorObject.toString(); 
		}
		catch (Exception e) {
			 System.out.println(e.getMessage());
			 log.error("Error while updating subCategory, message: " + e.getMessage());
			 JSONObject jsonErrorObject = new JSONObject();
				
			jsonErrorObject.put("errorcode", ErrorConstants.NO_DATA.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_DATA.getMessage());
				
			return jsonErrorObject.toString();
		}

	}
	
	
	
}