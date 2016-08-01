/*
-----------------------------------------------------------------------------------------------------------------------------------
HIS – Health Information System - RESTful  API
-----------------------------------------------------------------------------------------------------------------------------------
This is a free and open source API which can be used to develop and distributed in the hope that it will be useful to develop EMR systems.
You can utilize the services provides by the API to speed up the development process. 
You can modify the API to cater your requirements at your own risk. 
 
-----------------------------------------------------------------------------------------------------------------------------------
Authors: H.L.M.M De Silva, K.V.M Jayadewa, G.A.R Perera, S.I Kodithuwakku
Supevisor: Dr. Koliya Pulasinghe | Dean/Faculty of Graduate Studies | SLIIT
Co-Supervisor: Mr.Indraka Udayakumara | Senior Lecturer | SLIIT
URL: https://sites.google.com/a/my.sliit.lk/his
----------------------------------------------------------------------------------------------------------------------------------
*/

package core.resources.finance;

import java.sql.Date;
import java.text.DateFormat;
import java.text.SimpleDateFormat;
import java.util.List;
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
import core.classes.finance.HisFinPayment;
import flexjson.JSONSerializer;
import flexjson.transformer.DateTransformer;

/**
 * Payment web services of the Finance module which is used to expose the funtions to the front end
 * @author MIYURU
 *
 */

@Path("financePayment")
public class PaymentResource {

	PaymentDBDriver dbDriver = new PaymentDBDriver();
	DateFormat dateformat2 = new SimpleDateFormat("yyyy-MM-dd");
	
	/***
	 * Method is used to insert the payment details of particular transaction which accept the JSON object as the param
	 * @param SONObject Json
	 * @return String
	 */
	@POST
	@Path("/newPayment")
	@Produces(MediaType.TEXT_PLAIN)
	@Consumes(MediaType.APPLICATION_JSON)
	public String makeNewPayment(JSONObject Json)
	{
		try{
		HisFinPayment payment = new HisFinPayment();
		payment.setPayVoucherNo(Json.getInt("VoucherNo"));
		payment.setPayDateOfTranx(dateformat2.parse(Json.getString("Date")));
		payment.setPayDescription(Json.getString("Description"));
		payment.setPayAmount(Json.getDouble("Amount"));
		payment.setPayCrossEntry(Json.getDouble("CrossEntry"));
		payment.setPayTotal(Json.getDouble("TotalAmt"));
		payment.setPayPaidFor(Json.getString("PaidFor"));
		dbDriver.addPayments(payment);
		return "True";
		}catch(Exception ex){	
			ex.printStackTrace();
			return "False";
		}
		
	}
	
	/***
	 * Method is used to update the payment details of particular transaction which accept the JSON object as the param
	 * @param SONObject Json
	 * @return String
	 */
	@PUT
	@Path("/payment/change")
	@Produces(MediaType.TEXT_PLAIN)
	@Consumes(MediaType.APPLICATION_JSON)
	public String updatePayment(JSONObject Json)
	{
		
		try{
			HisFinPayment payment = new HisFinPayment();
			payment.setPayId(Json.getInt("Id"));
			payment.setPayVoucherNo(Json.getInt("VoucherNo"));
			payment.setPayDateOfTranx(dateformat2.parse(Json.getString("Date")));
			payment.setPayDescription(Json.getString("Description"));
			payment.setPayAmount(Json.getDouble("Amount"));
			payment.setPayCrossEntry(Json.getDouble("CrossEntry"));
			payment.setPayTotal(Json.getDouble("TotalAmt"));
			payment.setPayPaidFor(Json.getString("PaidFor"));
			dbDriver.updatePayment(payment);
			return "True";
			}catch(Exception ex){
				ex.printStackTrace();
				return "False";
			}
	}
	
	/***
	 * Method is delete to insert the payment details of particular transaction which accept the integer value as the param
	 * @param int ID
	 * @return String
	 */
	@DELETE
	@Path("/payment/delete/{Id}")
	@Produces(MediaType.TEXT_PLAIN)
	public String deletePayment(@PathParam("Id") int Id)
	{	
		try {
			if(dbDriver.deletePayment(Id))
				return "True";
			else
				return "False";
		} catch(Exception ex){
			ex.printStackTrace();
			return "False";
		}
	}
	
	/***
	 * Method is used to insert the Receipt details of particular transaction which accept the string value as the param
	 * @param string voucher
	 * @return String
	 */
	@GET
	@Path("/payment/{voucherNo}")
	@Produces(MediaType.APPLICATION_JSON)
	public String getPayment(@PathParam("voucherNo") String voucher)
	{
		JSONSerializer jsonSerializer = new JSONSerializer();
		return  jsonSerializer.serialize(dbDriver.getPayment(Integer.parseInt(voucher)));
	}
	
	
	/***
	 * Method is used to insert the Receipt details of particular transaction which accept the JSON object as the param
	 * @param SONObject Json
	 * @return String
	 */
	@GET
	@Path("/payments")
	@Produces(MediaType.APPLICATION_JSON)
	public String getPayments()
	{
		List<HisFinPayment> payments  =  dbDriver.getPayments();
		JSONSerializer jsonSerializer = new JSONSerializer();
		return jsonSerializer.transform(new DateTransformer("yyyy-MM-dd"), "payDateOfTranx").serialize(payments);
	}
	
	/***
	 * Method is used to insert the Receipt details of particular transaction which accept given time period
	 * @param Date from, to
	 * @return String
	 */
	@GET
	@Path("/payments/{from}/{to}")
	@Produces(MediaType.APPLICATION_JSON)
	public String getPayments(@PathParam("from") Date from,@PathParam("to") Date to)
	{
		JSONSerializer jsonSerializer = new JSONSerializer();
		return jsonSerializer.serialize(dbDriver.getPayment(from,to));
	}

	/***
	 * Method is used to insert the Receipt details of particular transaction 
	 * @param SONObject Json
	 * @return String
	 */
	@GET
	@Path("/payments/total")
	@Produces(MediaType.TEXT_PLAIN)
	public String getTotalPayments()
	{
		return dbDriver.getTotalPayment();
	}
	
	/***
	 * Method is used to get the total payment details of a given time period
	 * @param SONObject Json
	 * @return String
	 */
	@GET
	@Path("/payments/totalPayments{from}/{to}")
	@Produces(MediaType.APPLICATION_JSON)
	public double getTotalPayments(@PathParam("from") Date from,@PathParam("to") Date to){
		return Double.parseDouble(new JSONSerializer().serialize(dbDriver.getTotalPayment()));
	}
}
