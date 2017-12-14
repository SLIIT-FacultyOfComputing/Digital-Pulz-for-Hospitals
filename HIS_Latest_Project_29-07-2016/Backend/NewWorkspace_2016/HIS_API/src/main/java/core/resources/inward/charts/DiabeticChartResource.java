package core.resources.inward.charts;

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

import org.apache.log4j.Logger;
import org.codehaus.jettison.json.JSONException;
import org.codehaus.jettison.json.JSONObject;

import core.ErrorConstants;
import core.classes.inward.charts.DiabeticChart;
import core.classes.inward.charts.LiquidBalanceChart;
import core.resources.inward.prescription.PrescriptionTermsResource;
import flexjson.JSONSerializer;
import flexjson.transformer.DateTransformer;
import lib.driver.inward.driver_class.charts.DiabeticChartDBDriver;

@Path("DiabeticChart")
public class DiabeticChartResource {
	final static Logger log = Logger.getLogger(DiabeticChartResource.class);
	DiabeticChartDBDriver diabeticchartdbdriver = new DiabeticChartDBDriver();
	DateFormat dateformat = new SimpleDateFormat("yyyy-MM-dd'T'HH:mm");
	@GET
	@Path("/getChart")
	@Produces(MediaType.APPLICATION_JSON)
	public String ChartDetails() throws JSONException
	{
		try{
		log.info("Entering the get chartDetails method");
		List<DiabeticChart> chartList = diabeticchartdbdriver.getChartValues();
		JSONSerializer serializer = new JSONSerializer();
		return serializer.transform(new DateTransformer("yyyy-MM-dd"),
				"checkedDate").serialize(chartList);
		}
		 catch(RuntimeException e)
		{
			log.error("Runtime Exception in getting charts, message:" + e.getMessage());
			JSONObject jsonErrorObject = new JSONObject();
			
			jsonErrorObject.put("errorcode", ErrorConstants.NO_CONNECTION.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_CONNECTION.getMessage());
			
			
			return jsonErrorObject.toString(); 
		}
		catch (Exception e) {
			 System.out.println(e.getMessage());
			 log.error("Error while getting charts, message: " + e.getMessage());
			 JSONObject jsonErrorObject = new JSONObject();
				
			jsonErrorObject.put("errorcode", ErrorConstants.NO_DATA.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_DATA.getMessage());
				
			return jsonErrorObject.toString();
		}
	}
	
	@GET
	@Path("/getDiabeticChartByBHTNo/{bhtNo}")
	@Produces(MediaType.APPLICATION_JSON)
	public String getDiabeticChartByBHTNo(@PathParam("bhtNo")  String bhtNo) throws JSONException
	{
		try{
			log.info("Entering the get diabetic chart by BhtNo method");
				 String result="";
		 List<DiabeticChart> req =diabeticchartdbdriver.getDiabeticChartByBHTNo(bhtNo);
		 JSONSerializer serializor=new JSONSerializer();
		 result= serializor.serialize(req);
		 return result;
		}
		catch(RuntimeException e)
		{
			log.error("Runtime Exception in getting diabetic chart by BHT_NO, message:" + e.getMessage());
			JSONObject jsonErrorObject = new JSONObject();
			
			jsonErrorObject.put("errorcode", ErrorConstants.NO_CONNECTION.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_CONNECTION.getMessage());
			
			
			return jsonErrorObject.toString(); 
		}
		catch (Exception e) {
			 System.out.println(e.getMessage());
			 log.error("Error while getting diabetic chart message: " + e.getMessage());
			 JSONObject jsonErrorObject = new JSONObject();
				
			jsonErrorObject.put("errorcode", ErrorConstants.NO_DATA.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_DATA.getMessage());
				
			return jsonErrorObject.toString();
		}
	}
	
	
	@POST
	@Path("/addNewDiabeticchartDetails")
	@Produces(MediaType.APPLICATION_JSON)
	@Consumes(MediaType.APPLICATION_JSON)
	public String addNewDiabeticchartDetails(JSONObject wJson) throws JSONException
	{
		
		try {
			log.info("Entering the add New Diabetic Chart method");
			DiabeticChart newterm  =  new DiabeticChart();
			
			//newterm.setoral(wJson.getInt("oral"));
			newterm.setBloodSuger(Double.parseDouble(wJson.getString("bloodSuger").toString()));
			
						
			newterm.setDateTime(dateformat.parse(wJson.get("dateTime").toString())); 	
			String bht_no=wJson.getString("bht_no");				 
			diabeticchartdbdriver.addNewDiabeticchartDetails(newterm,bht_no);
			log.info("Insert new diabetic chart Successful, bhtNo = "+bht_no);
			JSONSerializer serializer=new JSONSerializer();
			String Result=serializer.exclude("*.class").serialize(newterm);
			return Result;			
			
		} catch (JSONException e) {
			log.error("JSON exception in Add new diabetic chart details, message:" + e.getMessage());
			
			JSONObject jsonErrorObject = new JSONObject();
			jsonErrorObject.put("errorcode", ErrorConstants.FILL_REQUIRED_FIELDS.getCode());
			jsonErrorObject.put("message", ErrorConstants.FILL_REQUIRED_FIELDS.getMessage());
			
			
			
			return jsonErrorObject.toString(); 
		}
		catch(RuntimeException e)
		{
			log.error("Runtime Exception in Add new diabetic chart details:" + e.getMessage());
			JSONObject jsonErrorObject = new JSONObject();
			
			jsonErrorObject.put("errorcode", ErrorConstants.NO_CONNECTION.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_CONNECTION.getMessage());
			
			
			return jsonErrorObject.toString(); 
		}
		catch (Exception e) {
			 System.out.println(e.getMessage());
			 log.error("Error while adding new diabetic chart details, message: " + e.getMessage());
			 JSONObject jsonErrorObject = new JSONObject();
				
			jsonErrorObject.put("errorcode", ErrorConstants.NO_DATA.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_DATA.getMessage());
				
			return jsonErrorObject.toString();
		}

	}
}
