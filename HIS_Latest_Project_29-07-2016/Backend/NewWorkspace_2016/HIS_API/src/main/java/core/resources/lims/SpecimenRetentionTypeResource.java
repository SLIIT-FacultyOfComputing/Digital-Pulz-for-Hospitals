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
import core.classes.lims.SpecimenRetentionType;
import core.classes.lims.SpecimenType;
import core.classes.lims.SubCategory;
import flexjson.JSONSerializer;
import lib.driver.lims.driver_class.CategoryDBDriver;
import lib.driver.lims.driver_class.SpecimenRetentionTypeDBDriver;
import lib.driver.lims.driver_class.SpecimenTypeDBDriver;

@Path("SpecimenRetentionType")
public class SpecimenRetentionTypeResource {

SpecimenRetentionTypeDBDriver srtDBDriver= new SpecimenRetentionTypeDBDriver();
	

	public String addSpecimenType(JSONObject pJson,String catid,String subid,String specid)
	{
		
		try {
			SpecimenRetentionType srtype  =  new SpecimenRetentionType();
			
			int categoryID = Integer.parseInt(catid);
			int subcategoryID = Integer.parseInt(subid);
			
			srtype.setRetention_TypeName(pJson.getString("retention").toString());
			srtype.setDuration(pJson.getString("duration").toString());
			
			srtDBDriver.insertSpecimenRetentionType(srtype, categoryID, subcategoryID);
		
					 
			JSONSerializer jsonSerializer = new JSONSerializer();
			return jsonSerializer.include("retention_TypeID").serialize(srtype);
		} catch (Exception e) {
			 System.out.println(e.getMessage());
			 
			return null; 
		}

	}
	
	@GET
	@Path("/getAllSpecimenRetentionTypes")
	@Produces(MediaType.APPLICATION_JSON)
	public String getAllSpecimenType()
	{
		List<SpecimenRetentionType> specimenretentiontypeList =   srtDBDriver.getSpecimenRetentionTypeList();
		JSONSerializer serializer = new JSONSerializer();
		return  serializer.include("fCategory_ID.category_Name","fSub_CategryID.sub_CategoryName").exclude("*.class","fCategory_ID.*","fSub_CategryID.*").serialize(specimenretentiontypeList);
	}
	
	@GET
	@Path("/getAllSpecimenRetentionTypesByCIDSID/{catID}/{subID}")
	@Produces(MediaType.APPLICATION_JSON)
	public String getAllSpecimenType(@PathParam("catID")int catID,@PathParam("subID")int subID)
	{
		List<SpecimenRetentionType> specimenretentiontypeList =   srtDBDriver.getSpecimenRetentionTypeBYCIDSIDList(catID,subID);
		JSONSerializer serializer = new JSONSerializer();
		return  serializer.include("fSub_CategryID.sub_CategoryID","fSub_CategryID.subCategory_IDName","fSub_CategryID.sub_CategoryName").exclude("*.class","fSub_CategryID.*").serialize(specimenretentiontypeList);
	}
	
}