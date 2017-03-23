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

import lib.driver.inward.driver_class.charts.TemperaturechartDBDriver;
import core.ErrorConstants;
import core.classes.inward.charts.DiabeticChart;
import core.classes.inward.charts.Temperaturechart;
import core.resources.lims.CategoryResource;
import flexjson.JSONSerializer;
import flexjson.transformer.DateTransformer;

@Path("temperaturechart")
public class TemperaturechartResource {

	final static Logger log = Logger.getLogger(TemperaturechartResource.class);
	
	TemperaturechartDBDriver temperaturechartdbddiver = new TemperaturechartDBDriver();
	DateFormat dateformat = new SimpleDateFormat("yyyy-MM-dd'T'HH:mm");
	
	@GET
	@Path("/getChart")
	@Produces(MediaType.APPLICATION_JSON)
	public String ChartDetails() throws JSONException
	{
		try{
			log.info("Entering the get ChartDetails method");
		
			List<Temperaturechart> chartList = temperaturechartdbddiver.getChartValues();
			JSONSerializer serializer = new JSONSerializer();
			return serializer.transform(new DateTransformer("yyyy-MM-dd HH:mm:ss"),"checkedDate").serialize(chartList);
		}
		catch(RuntimeException e)
		{
			log.error("Runtime Exception in adding NewTempchartDetails, message:" + e.getMessage());
			JSONObject jsonErrorObject = new JSONObject();
			
			jsonErrorObject.put("errorcode", ErrorConstants.NO_CONNECTION.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_CONNECTION.getMessage());
						
			return jsonErrorObject.toString(); 
		}
	}
	
	@GET
	@Path("/getTemperaturechartByBHTNo/{bhtNo}")
	@Produces(MediaType.APPLICATION_JSON)
	public String getDiabeticChartByBHTNo(@PathParam("bhtNo")  String bhtNo) throws JSONException
	{
		log.info("Entering the get diabetic chart by bhtNo method");
		try{
		 String result="";
		 List<Temperaturechart> req =temperaturechartdbddiver.getTemperaturechartByBHTNo(bhtNo);
		 JSONSerializer serializor=new JSONSerializer();
		 result= serializor.serialize(req);
		 return result;
		}
		
		catch(RuntimeException e)
		{
			log.error("Runtime Exception in get all MainResults by ReqID, message:" + e.getMessage());
			JSONObject jsonErrorObject = new JSONObject();
			
			jsonErrorObject.put("errorcode", ErrorConstants.NO_CONNECTION.getCode());
			jsonErrorObject.put("message", ErrorConstants.NO_CONNECTION.getMessage());
			
			
			return jsonErrorObject.toString(); 
		}
	}
	
	@POST
	@Path("/addNewTempchartDetails")
	@Produces(MediaType.APPLICATION_JSON)
	@Consumes(MediaType.APPLICATION_JSON)
	public String addNewTempchartDetails(JSONObject wJson) throws JSONException
	{
		log.info("Entering the add NewTempchartDetails method");
				
		try {
			Temperaturechart newterm  =  new Temperaturechart();
			
			//newterm.setoral(wJson.getInt("oral"));
			newterm.setTemperature(Double.parseDouble(wJson.getString("temperature").toString()));
			
						
			newterm.setDateTime(dateformat.parse(wJson.get("dateTime").toString())); 	
			String bht_no=wJson.getString("bht_no");				 
			temperaturechartdbddiver.addNewTempchartDetails(newterm,bht_no);
			
			JSONSerializer serializor=new JSONSerializer();
			String result= serializor.serialize(newterm);
			log.info("Insert MainResults Successful");
			
			return result;
			//return "true";
		}catch (JSONException e)
		{
			log.error("JSON exception in adding NewTempchartDetails, message: " + e.getMessage());
			
			JSONObject jsonErrorObject = new JSONObject();
			jsonErrorObject.put("errorcode", ErrorConstants.FILL_REQUIRED_FIELDS.getCode());
			jsonErrorObject.put("message", ErrorConstants.FILL_REQUIRED_FIELDS.getMessage());
			
			return jsonErrorObject.toString();
			
		}
		catch(RuntimeException e)
		{
			log.error("Runtime Exception in adding NewTempchartDetails, message:" + e.getMessage());
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
