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
import core.classes.lims.SubCategory;
import flexjson.JSONSerializer;
import lib.driver.lims.driver_class.CategoryDBDriver;
import lib.driver.lims.driver_class.SubCategoryDBDriver;

@Path("SubCategory")
public class SubCategoryResource {

SubCategoryDBDriver sDBDriver= new SubCategoryDBDriver();
	

	public String addSubCategory(JSONObject pJson,String Cid)
	{	

		try {
			SubCategory scat  =  new SubCategory();
			
			int categoryID = Integer.parseInt(Cid);
			
			scat.setSubCategory_IDName("SC");
			scat.setSub_CategoryName(pJson.get("sub_category").toString());
			
			
			sDBDriver.insertSubCategory(scat, categoryID);
			 
			JSONSerializer jsonSerializer = new JSONSerializer();
			jsonSerializer.include("sub_CategoryID").serialize(scat);
			return scat.getSub_CategoryID()+"";
		} catch (Exception e) {
			 System.out.println(e.getMessage());
			 
			return null; 
		}

	}
	
	@GET
	@Path("/getAllSubCategories")
	@Produces(MediaType.APPLICATION_JSON)
	public String getAllSubCategories()
	{
		List<SubCategory> subCatList =   sDBDriver.getSubCategoryList();
		JSONSerializer serializer = new JSONSerializer();
		return  serializer.include("fCategory_ID.category_ID","fCategory_ID.category_Name","Specimentypes").exclude("*.class","fCategory_ID.*").serialize(subCatList);
	}
	
	@GET
	@Path("/getSubCategoriesByCategoryID/{catID}")
	@Produces(MediaType.APPLICATION_JSON)
	public String getAllSubCategories(@PathParam("catID")int catID)
	{
		List<SubCategory> subCatList =   sDBDriver.getSubCategoryListByCatID(catID);
		JSONSerializer serializer = new JSONSerializer();
		return  serializer.include("sub_CategoryID","subCategory_IDName","sub_CategoryName").exclude("*.class","fCategory_ID.*").serialize(subCatList);
	}
	
	@GET
	@Path("/deleteSubCategory/{Subcatid}")
	@Produces(MediaType.APPLICATION_JSON)
	public String deleteSubCategory(@PathParam("Subcatid") int Subcatid) {
		//String status="";
		try {
			
			sDBDriver.DeleteSubCategory(Subcatid);
			
			
			return "True";	
		} catch (Exception e) {
			return "False";
		}
	}
	
	@POST
	@Path("/updateSubCategories")
	@Produces(MediaType.TEXT_PLAIN)
	@Consumes(MediaType.APPLICATION_JSON)
	public String updateSubCategoriesDetails(JSONObject pJson)
	{
		
		
		try {
			
			SubCategory Subcat  =  new SubCategory();
			int Subcategoryid = pJson.getInt("sub_CategoryID");
			//int categoryID = pJson.getInt("fCategory_ID");
			
			
			Subcat.setSub_CategoryName(pJson.get("sub_CategoryName").toString());
			sDBDriver.updateSubCategories(Subcategoryid, Subcat);
		
			
			return "True";	
			
		} catch (Exception e) {
			 
			return "False";
		}
	}
	
	
	
}