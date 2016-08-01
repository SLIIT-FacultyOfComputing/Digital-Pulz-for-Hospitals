
package core.resources.finance;

import java.sql.Date;
import java.text.DateFormat;
import java.text.SimpleDateFormat;

import javax.ws.rs.Consumes;
import javax.ws.rs.DELETE;
import javax.ws.rs.GET;
import javax.ws.rs.POST;
import javax.ws.rs.PUT;
import javax.ws.rs.Path;
import javax.ws.rs.PathParam;
import javax.ws.rs.Produces;
import javax.ws.rs.core.MediaType;

import lib.driver.finance.driver_class.*;
import org.codehaus.jettison.json.JSONObject;
import core.classes.finance.HisFinReceipt;
import flexjson.JSONSerializer;

/**
 * Receipt web services of the finance module has been implemented in this class 
 * @author Vishwa
 *
 */
@Path("financeReceipt")
public class ReceiptResource {

	ReceiptDBDriver dbDriver = new ReceiptDBDriver();
	DateFormat dateformat2 = new SimpleDateFormat("yyyy-MM-dd");
	
	/***
	 * Method is used to insert the Receipt details of particular transaction which accept the JSON object as the param
	 * @param SONObject Json
	 * @return String
	 */
	@POST
	@Path("/newReceipt")
	@Produces(MediaType.TEXT_PLAIN)
	@Consumes(MediaType.APPLICATION_JSON)
	public String newReceipt(JSONObject Json){
		
		try{
		HisFinReceipt receipt =  new HisFinReceipt();
		receipt.setRecVoucherNo(Json.getInt("VoucherNo"));
		receipt.setRecDateOfTranx(dateformat2.parse(Json.getString("Date")));
		receipt.setRecDescription(Json.getString("Description"));
		receipt.setRecAmount(Json.getDouble("Amount"));
		receipt.setRecCrossEntry(Json.getDouble("CrossEntry"));
		receipt.setRecTotal(Json.getDouble("TotalAmt"));
		receipt.setRecReceivedForm(Json.getString("PaidFor"));
		dbDriver.addReceipt(receipt);
		return "True";
		}catch(Exception ex){
			ex.printStackTrace();
			return "False";
		}
		
	}
	
	/***
	 * Method is used to update the Receipt details which accept the JSON object as the param
	 * @param SONObject Json
	 * @return String
	 */
	@PUT
	@Path("/receipt/change")
	@Produces(MediaType.TEXT_PLAIN)
	@Consumes(MediaType.APPLICATION_JSON)
	public String updateReceipt(JSONObject Json){
		try{
			HisFinReceipt receipt =  new HisFinReceipt();
			receipt.setRecId(Json.getInt("Id"));
			receipt.setRecVoucherNo(Json.getInt("VoucherNo"));
			receipt.setRecDateOfTranx(dateformat2.parse(Json.getString("Date")));
			receipt.setRecDescription(Json.getString("Description"));
			receipt.setRecAmount(Json.getDouble("Amount"));
			receipt.setRecCrossEntry(Json.getDouble("CrossEntry"));
			receipt.setRecTotal(Json.getDouble("TotalAmt"));
			receipt.setRecReceivedForm(Json.getString("PaidFor"));
			dbDriver.update(receipt);
			return "True";
			}catch(Exception ex){
				ex.printStackTrace();
				return "False";
			}
	}
	
	/***
	 * Method is used to delete the Receipt from the database which accept the transaction id as the param
	 * @param int ID
	 * @return String
	 */
	@DELETE
	@Path("/receipt/delete/{Id}")
	@Produces(MediaType.TEXT_PLAIN)
	public String deleteReceipt(@PathParam("Id") int Id){
		if(dbDriver.deleteReceipt(Id))
			return "True";
		else
			return "False";
	}
	
	/***
	 * Method is used to retrieve the Receipt details of particular transaction which accept receipt id as the param
	 * @param String voucher
	 * @return String
	 */
	@GET
	@Path("/receipt/{voucherNo}")
	@Produces(MediaType.APPLICATION_JSON)
	public String getReceipt(@PathParam("voucherNo") String voucher){
		return new JSONSerializer().serialize(dbDriver.getReceipt(voucher));
	}
	
	/***
	 * Method is used to insert the Receipt details of particular transaction 
	 * 
	 * @return String
	 */
	@GET
	@Path("/receipts")
	@Produces(MediaType.APPLICATION_JSON)
	public String getReceipts(){
		return new JSONSerializer().serialize(dbDriver.getReceipts());
	}
	
	/***
	 * Method is used to retrieve the Receipt details of particular transaction which accept given time time period
	 * @param SONObject Json
	 * @return String
	 */
	@GET
	@Path("/receipts/{from}/{to}")
	@Produces(MediaType.APPLICATION_JSON)
	public String getReceipts(@PathParam("from") Date from,@PathParam("to") Date to){
		return new JSONSerializer().serialize(dbDriver.getReceipt(from, to));
	}
	
	/***
	 * Method is used to retrive the Receipt details of particular transaction 
	 * @param Date from, to
	 * @return String
	 */
	@GET
	@Path("/receipts/total")
	@Produces(MediaType.TEXT_PLAIN)
	public double getTotalReceipts(){
		return dbDriver.getTotalReceipt();
	}

	/***
	 * Method is used to insert the Receipt details of particular transaction which accept the given time period
	 * @param Date from , to
	 * @return Double
	 */
	@GET
	@Path("/receipts/totalreceipts{from}/{to}")
	@Produces(MediaType.APPLICATION_JSON)
	public double getTotalReceipts(@PathParam("from") Date from,@PathParam("to") Date to){
		return dbDriver.getTotalReceipt(from, to);
	}
}
