package core.resources.inward.transfer;

import java.text.DateFormat;
import java.text.SimpleDateFormat;
import java.util.List;

import javax.ws.rs.Consumes;
import javax.ws.rs.GET;
import javax.ws.rs.POST;
import javax.ws.rs.PUT;
import javax.ws.rs.Path;
import javax.ws.rs.Produces;
import javax.ws.rs.core.MediaType;

import org.codehaus.jettison.json.JSONObject;

import javax.ws.rs.PathParam;

import core.classes.inward.transfer.InternalTransfer;
import flexjson.JSONException;
import flexjson.JSONSerializer;
import lib.driver.inward.driver_class.transfer.InternalTransferDBDriver;

@Path("InternalTransfer")
public class InternalTransferResource {
	InternalTransferDBDriver internaltransferdbdriver = new InternalTransferDBDriver();
	DateFormat dateformat = new SimpleDateFormat("yyyy-MM-dd'T'HH:mm");
	
/*	@GET
	@Path("/getAllInternalTransfers")
	@Produces(MediaType.APPLICATION_JSON)
	
	public String TransferDetails(){
		
		List<InternalTransfer> transfer = internaltransferdbdriver.getAllInternalTransfers();
		JSONSerializer serializer = new JSONSerializer();
		return serializer.transform(new DateTransformer("yyyy-MM-dd HH:mm"),
				"transferCreatedDate").serialize(transfer);
	}*/
	
	@POST
	@Path("/addInternalTransfer")
	@Produces(MediaType.APPLICATION_JSON)
	@Consumes(MediaType.APPLICATION_JSON)
	public String CreateInternalTransfer(JSONObject wJson)
	{
		
		try {
			InternalTransfer transfer = new InternalTransfer();
			String bhtno=wJson.getString("bhtNo");
			String toward=wJson.getString("transferWard");
			String fromword=wJson.getString("transferFromWard");
			transfer.setResonForTrasnsfer(wJson.getString("resonForTrasnsfer"));
			transfer.setReportOfSpacialExamination(wJson.getString("reportOfSpacialExamination"));
			transfer.setTreatmentSuggested(wJson.getString("treatmentSuggested"));	
			transfer.setTransferCreatedDate(dateformat.parse(wJson.getString("transferCreatedDate").toString()));
			int userId=wJson.getInt("transferCreatedUser");
			
			internaltransferdbdriver.insertTransfer(transfer,bhtno,toward,fromword,userId);			
			 			
			return "true";
		} catch (Exception e) {
			 System.out.println(e.getMessage());
			 
			return e.getMessage().toString(); 
		}

	}
	
	@GET
	@Path("/getSelectInternalTransfer/{transferId}")
	@Produces(MediaType.APPLICATION_JSON)
	public String getSelectInternalTransfer(@PathParam("transferId")  String transferID)
	{
		 String result="";
		 List<InternalTransfer> transfer =internaltransferdbdriver.getInternalTransferByID(transferID);
		 JSONSerializer serializor=new JSONSerializer();
		 result= serializor.serialize(transfer);
		 return result;
	}

	
	
	@PUT
	@Path("/updateInternalTransfer")
	@Produces(MediaType.TEXT_PLAIN)
	@Consumes(MediaType.APPLICATION_JSON)
	public  String updateInternalTransfer(JSONObject wJson){
		
		String result="false";
		boolean r=false;
		 //InternalTransfer transfer =new InternalTransfer();
		try{
			int id=wJson.getInt("transferId");
			String bht=wJson.getString("NewbhtNo");
			//transfer.setTransferId(wJson.getInt("transferId"));
			//transfer.setRead(1);
			//transfer.setBhtNo(wJson.getString("bhtNo"));
			//transfer.setTransferFromWard(wJson.getString("transferFromWard"));
			//transfer.setBhtNo(wJson.getString("transferWard"));
			//transfer.setResonForTrasnsfer("resonForTrasnsfer");
			//transfer.setReportOfSpacialExamination(wJson.getString("reportOfSpacialExamination"));
			//transfer.setTreatmentSuggested(wJson.getString("treatmentSuggested"));
			//transfer.setTransferCreatedDate(dateformat.parse(wJson.getString("transferCreatedDate").toString()));
			//transfer.setTransferCreatedUser(wJson.getString("transferCreatedUser"));
		
			r=internaltransferdbdriver.updateInternalTransferDetails(id,bht);
			result=String.valueOf(r);
			return result;
			
		}
		catch( JSONException ex){
			ex.printStackTrace();	
			return result;
		}
		
		catch( Exception ex){
			ex.printStackTrace();
			return ex.getMessage();
		}

	}
	
	@GET
	@Path("/getNotReadInternalTransferByWard/{wardNo}")
	@Produces(MediaType.APPLICATION_JSON)
	public String getNotReadInternalTransferByWard(@PathParam("wardNo")  String wardNo)
	{
		 String result="";
		 List<InternalTransfer> transfer =internaltransferdbdriver.getNotReadInternalTransferByWard(wardNo);
		 JSONSerializer serializor=new JSONSerializer();
		 result= serializor.include("Admission.bhtNo","Ward.wardNo").exclude("*.class","Admission.*","Ward.*","User.*").serialize(transfer);
		 return result;
	}
	
	@GET
	@Path("/getInternalTransferByID/{tranferId}")
	@Produces(MediaType.APPLICATION_JSON)
	public String getInternalTransferByID(@PathParam("tranferId")  int tranferId)
	{
		 String result="";
		 List<InternalTransfer> transfer =internaltransferdbdriver.getInternalTransferByID(tranferId);
		 JSONSerializer serializor=new JSONSerializer();
		 result= serializor.include("Admission.bhtNo","Ward.wardNo").exclude("*.class","Admission.*","Ward.*","User.*").serialize(transfer);
		 return result;
	}
	
	

	@GET
	@Path("/getInternalTransferByBHTNo/{bhtNo}")
	@Produces(MediaType.APPLICATION_JSON)
	public String getInternalTransferByBHTNo(@PathParam("bhtNo")  String bhtNo)
	{
		 String result="";
		 List<InternalTransfer> transfer =internaltransferdbdriver.getInternalTransferByBHTNo(bhtNo);
		 JSONSerializer serializor=new JSONSerializer();
		 result= serializor.include("Admission.bhtNo","Ward.wardNo").exclude("*.class","Admission.*","Ward.*","User.*").serialize(transfer);
		 return result;
	}
	

}
