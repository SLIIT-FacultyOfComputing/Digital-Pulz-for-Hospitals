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








import org.codehaus.jettison.json.JSONException;
import org.codehaus.jettison.json.JSONObject;
import org.jboss.logging.Logger;

import core.ErrorConstants;
import core.classes.inward.charts.LiquidBalanceChart;
import core.classes.inward.prescription.PrescriptionTerms;
import flexjson.JSONSerializer;
import flexjson.transformer.DateTransformer;
import lib.driver.inward.driver_class.charts.LiquidBalanceChartDBDriver;

@Path("LiquidBalanceChart")
public class LiquidBalanceChartResource {
	final static Logger log = Logger.getLogger(LiquidBalanceChartResource.class);
	
	LiquidBalanceChartDBDriver liquidbalancechartdbdriver = new LiquidBalanceChartDBDriver();
	
	DateFormat dateformat = new SimpleDateFormat("yyyy-MM-dd'T'HH:mm");
	
	
	
	@GET
	@Path("/getChart")
	@Produces(MediaType.APPLICATION_JSON)
	public String ChartDetails() throws JSONException
	{
		log.info("Entering the get Chart details method");
		try{
		List<LiquidBalanceChart> chartList = liquidbalancechartdbdriver.getChartValues();
		JSONSerializer serializer = new JSONSerializer();
		return serializer.transform(new DateTransformer("yyyy-MM-dd"),"checkedDate").serialize(chartList);
		}
		catch(RuntimeException e){
			log.error("Runtime Exception in get all MainResults by ReqID, message:" + e.getMessage());
			JSONObject jsonErrorObject = new JSONObject();
			
			jsonErrorObject.put("errorcode", ErrorConstants.NO_CONNECTION.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_CONNECTION.getMessage());
			
			
			return jsonErrorObject.toString(); 
			
		}
	}
	
	@GET
	@Path("/getLiquidBalanceChartByBHTNo/{bhtNo}")
	@Produces(MediaType.APPLICATION_JSON)
	public String getDiabeticChartByBHTNo(@PathParam("bhtNo")  String bhtNo) throws JSONException
	{
		log.info("Entering the get diabetic Chart by bhtNo method");
		try{
		 String result="";
		 List<LiquidBalanceChart> req =liquidbalancechartdbdriver.getLiquidBalanceChartByBHTNo(bhtNo);
		 JSONSerializer serializor=new JSONSerializer();
		 result= serializor.serialize(req);
		 return result;
		}
		catch(RuntimeException e){
			log.error("Runtime Exception in get all MainResults by ReqID, message:" + e.getMessage());
			JSONObject jsonErrorObject = new JSONObject();
			
			jsonErrorObject.put("errorcode", ErrorConstants.NO_CONNECTION.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_CONNECTION.getMessage());
			
			
			return jsonErrorObject.toString(); 
			
		}
	}
	
	@POST
	@Path("/addNewchartDetails")
	@Produces(MediaType.APPLICATION_JSON)
	@Consumes(MediaType.APPLICATION_JSON)
	public String addNewchartDetails(JSONObject wJson) throws JSONException
	{
		log.info("Entering the add New Chart details method");		
		try {
			LiquidBalanceChart newterm  =  new LiquidBalanceChart();
			
			//newterm.setoral(wJson.getInt("oral"));
			newterm.setoral(Double.parseDouble(wJson.getString("oral").toString()));
			newterm.setsaline(Double.parseDouble(wJson.getString("saline").toString()));
			newterm.setoutput(Double.parseDouble(wJson.getString("output").toString()));				
			newterm.setDateTime(dateformat.parse(wJson.get("dateTime").toString())); 	
			String bht_no=wJson.getString("bht_no");				 
			liquidbalancechartdbdriver.addNewchartDetails(newterm,bht_no);
			
			JSONSerializer serializor=new JSONSerializer();
			log.info("Insert MainResults Successful");
			return  serializor.exclude("*.class").serialize(newterm);
			//return "true";
			}
		catch(JSONException e){
			log.error("JSON exception in adding New DiagnoseDetails, message: " + e.getMessage());
			
			JSONObject jsonErrorObject = new JSONObject();
			jsonErrorObject.put("errorcode", ErrorConstants.FILL_REQUIRED_FIELDS.getCode());
			jsonErrorObject.put("message", ErrorConstants.FILL_REQUIRED_FIELDS.getMessage());
			
			return jsonErrorObject.toString();
			
		}
		catch(RuntimeException e){
			log.error("Runtime Exception in adding New DiagnoseDetail, message:" + e.getMessage());
			
			JSONObject jsonErrorObject = new JSONObject();
			jsonErrorObject.put("errorcode", ErrorConstants.NO_CONNECTION.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_CONNECTION.getMessage());
						
			return jsonErrorObject.toString(); 
			
		}
		catch (Exception e) {
			 System.out.println(e.getMessage());
			 
			return e.getMessage().toString(); 
		}

	}
}
