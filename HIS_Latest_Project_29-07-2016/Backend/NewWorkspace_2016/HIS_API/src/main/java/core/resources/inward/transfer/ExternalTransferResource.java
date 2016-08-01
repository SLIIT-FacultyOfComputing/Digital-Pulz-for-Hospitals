package core.resources.inward.transfer;

import java.text.DateFormat;
import java.text.SimpleDateFormat;
import java.util.List;

import javax.ws.rs.Consumes;
import javax.ws.rs.GET;
import javax.ws.rs.POST;
import javax.ws.rs.Path;
import javax.ws.rs.PathParam;
import javax.ws.rs.Produces;
import javax.ws.rs.core.MediaType;

import org.codehaus.jettison.json.JSONObject;

import core.classes.inward.transfer.ExternalTransfer;
import flexjson.JSONSerializer;
import lib.driver.inward.driver_class.transfer.ExternalTransferDBDriver;

@Path("ExternalTransfer")
public class ExternalTransferResource {
	ExternalTransferDBDriver externaltransferdbdriver = new ExternalTransferDBDriver();
	DateFormat dateformat = new SimpleDateFormat("yyyy-MM-dd'T'HH:mm");
	
//	@GET
//	@Path("/getAllExternalTransfers")
//	@Produces(MediaType.APPLICATION_JSON)
//	
//	public String TransferDetails(){
//		
//		List<ExternalTransfer> transfer = externaltransferdbdriver.getAllExternalTransfers();
//		JSONSerializer serializer = new JSONSerializer();
//		return serializer.transform(new DateTransformer("yyyy-MM-dd HH:mm"),
//				"transferCreatedDate").serialize(transfer);
//	}
//	
	@POST
	@Path("/addExternalTransfer")
	@Produces(MediaType.APPLICATION_JSON)
	@Consumes(MediaType.APPLICATION_JSON)
	
	public String CreateExternalTransfer(JSONObject wJson)
	{
		
		try {
			ExternalTransfer transfer = new ExternalTransfer();
			transfer.setBhtNo(wJson.getString("bhtNo"));
			transfer.setTransferFrom(wJson.getString("transferFrom"));
			transfer.setTransferTo(wJson.getString("transferTo"));
			transfer.setResonForTrasnsfer(wJson.getString("resonForTrasnsfer"));
			transfer.setReportOfSpacialExamination(wJson.getString("reportOfSpacialExamination"));
			transfer.setTreatmentSuggested(wJson.getString("treatmentSuggested"));
			transfer.setTransferCreatedDate(dateformat.parse(wJson.getString("transferCreatedDate").toString()));
			transfer.setTransferCreatedUser(wJson.getInt("transferCreatedUser"));
			transfer.setNameOfGuardian(wJson.getString("nameOfGuardian"));
			transfer.setAddressOfGuardian(wJson.getString("addressOfGuardian"));
	
			externaltransferdbdriver.insertTransfer(transfer);		
			 			
			return "true";
		} catch (Exception e) {
			 System.out.println(e.getMessage());
			 
			return e.getMessage().toString(); 
		}

	}
	
	@GET
	@Path("/getSelectExternalTransfer/{bhtNo}")
	@Produces(MediaType.APPLICATION_JSON)
	public String getSelectInternalTransfer(@PathParam("bhtNo")  String bhtNo)
	{
		String result="";
		 List<ExternalTransfer> transfer = externaltransferdbdriver.getExternalTransferByBHT(bhtNo);
		 JSONSerializer serializor=new JSONSerializer();
		 result= serializor.serialize(transfer);
		 return result;
		 
	}
	
	
	
}
