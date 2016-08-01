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

import org.codehaus.jettison.json.JSONObject;

import lib.driver.inward.driver_class.charts.TemperaturechartDBDriver;
import core.classes.inward.charts.DiabeticChart;
import core.classes.inward.charts.Temperaturechart;
import flexjson.JSONSerializer;
import flexjson.transformer.DateTransformer;

@Path("temperaturechart")
public class TemperaturechartResource {

	TemperaturechartDBDriver temperaturechartdbddiver = new TemperaturechartDBDriver();
	DateFormat dateformat = new SimpleDateFormat("yyyy-MM-dd'T'HH:mm");
	@GET
	@Path("/getChart")
	@Produces(MediaType.APPLICATION_JSON)
	public String ChartDetails()
	{
		List<Temperaturechart> chartList = temperaturechartdbddiver.getChartValues();
		JSONSerializer serializer = new JSONSerializer();
		return serializer.transform(new DateTransformer("yyyy-MM-dd HH:mm:ss"),
				"checkedDate").serialize(chartList);

	}
	
	@GET
	@Path("/getTemperaturechartByBHTNo/{bhtNo}")
	@Produces(MediaType.APPLICATION_JSON)
	public String getDiabeticChartByBHTNo(@PathParam("bhtNo")  String bhtNo)
	{
				 String result="";
		 List<Temperaturechart> req =temperaturechartdbddiver.getTemperaturechartByBHTNo(bhtNo);
		 JSONSerializer serializor=new JSONSerializer();
		 result= serializor.serialize(req);
		 return result;
	}
	
	@POST
	@Path("/addNewTempchartDetails")
	@Produces(MediaType.APPLICATION_JSON)
	@Consumes(MediaType.APPLICATION_JSON)
	public String addNewTempchartDetails(JSONObject wJson)
	{
				
		try {
			Temperaturechart newterm  =  new Temperaturechart();
			
			//newterm.setoral(wJson.getInt("oral"));
			newterm.setTemperature(Double.parseDouble(wJson.getString("temperature").toString()));
			
						
			newterm.setDateTime(dateformat.parse(wJson.get("dateTime").toString())); 	
			String bht_no=wJson.getString("bht_no");				 
			temperaturechartdbddiver.addNewTempchartDetails(newterm,bht_no);
			 			
			return "true";
		} catch (Exception e) {
			 System.out.println(e.getMessage());
			 
			return e.getMessage().toString(); 
		}

	}
}
