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
import core.classes.lims.SpecimenType;
import core.classes.lims.SubCategory;
import flexjson.JSONSerializer;
import lib.driver.lims.driver_class.CategoryDBDriver;
import lib.driver.lims.driver_class.SpecimenTypeDBDriver;

@Path("SpecimenType")
public class SpecimenTypeResource {

SpecimenTypeDBDriver stDBDriver= new SpecimenTypeDBDriver();
	

	public String addSpecimenType(JSONObject pJson,String catid,String subid)
	{

		try {
			SpecimenType stype  =  new SpecimenType();
			
			int categoryID = Integer.parseInt(catid);
			int subcategoryID = Integer.parseInt(subid);
			
			stype.setSpecimen_TypeName(pJson.getString("specimen").toString());
			
				stDBDriver.insertSpecimenType(stype, categoryID, subcategoryID);		 
			JSONSerializer jsonSerializer = new JSONSerializer();
			 jsonSerializer.include("specimenType_ID").serialize(stype);
			 return stype.getSpecimenType_ID()+"";
		} catch (Exception e) {
			 System.out.println(e.getMessage());
			 
			return null; 
		}

	}
	
	@GET
	@Path("/getAllSpecimenTypes")
	@Produces(MediaType.APPLICATION_JSON)
	public String getAllSpecimenType()
	{
		List<SpecimenType> specimentypeList =   stDBDriver.getSpecimenTypeList();
		JSONSerializer serializer = new JSONSerializer();
		return  serializer.include("fCategry_ID.category_Name","fSub_CategoryID.sub_CategoryName").exclude("*.class","fCategry_ID.*","fSub_CategoryID.*").serialize(specimentypeList);
	}
	
	@GET
	@Path("/getAllSpecimenTypesByCIDSID/{catID}/{subID}")
	@Produces(MediaType.APPLICATION_JSON)
	public String getAllSpecimenType(@PathParam("catID")int catID,@PathParam("subID")int subID)
	{
		List<SpecimenType> specimentypeList =   stDBDriver.getSpecimenTypeListByCIDSID(catID,subID);
		JSONSerializer serializer = new JSONSerializer();
		return  serializer.exclude("*.class").serialize(specimentypeList);
	}
	
}