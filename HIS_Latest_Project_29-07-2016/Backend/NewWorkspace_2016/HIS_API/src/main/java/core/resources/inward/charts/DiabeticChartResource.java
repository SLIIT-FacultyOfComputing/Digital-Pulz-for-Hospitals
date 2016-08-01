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

import core.classes.inward.charts.DiabeticChart;
import core.classes.inward.charts.LiquidBalanceChart;
import flexjson.JSONSerializer;
import flexjson.transformer.DateTransformer;
import lib.driver.inward.driver_class.charts.DiabeticChartDBDriver;

@Path("DiabeticChart")
public class DiabeticChartResource {
	DiabeticChartDBDriver diabeticchartdbdriver = new DiabeticChartDBDriver();
	DateFormat dateformat = new SimpleDateFormat("yyyy-MM-dd'T'HH:mm");
	@GET
	@Path("/getChart")
	@Produces(MediaType.APPLICATION_JSON)
	public String ChartDetails()
	{
		List<DiabeticChart> chartList = diabeticchartdbdriver.getChartValues();
		JSONSerializer serializer = new JSONSerializer();
		return serializer.transform(new DateTransformer("yyyy-MM-dd"),
				"checkedDate").serialize(chartList);

	}
	
	@GET
	@Path("/getDiabeticChartByBHTNo/{bhtNo}")
	@Produces(MediaType.APPLICATION_JSON)
	public String getDiabeticChartByBHTNo(@PathParam("bhtNo")  String bhtNo)
	{
				 String result="";
		 List<DiabeticChart> req =diabeticchartdbdriver.getDiabeticChartByBHTNo(bhtNo);
		 JSONSerializer serializor=new JSONSerializer();
		 result= serializor.serialize(req);
		 return result;
	}
	
	
	@POST
	@Path("/addNewDiabeticchartDetails")
	@Produces(MediaType.APPLICATION_JSON)
	@Consumes(MediaType.APPLICATION_JSON)
	public String addNewDiabeticchartDetails(JSONObject wJson)
	{
				
		try {
			DiabeticChart newterm  =  new DiabeticChart();
			
			//newterm.setoral(wJson.getInt("oral"));
			newterm.setBloodSuger(Double.parseDouble(wJson.getString("bloodSuger").toString()));
			
						
			newterm.setDateTime(dateformat.parse(wJson.get("dateTime").toString())); 	
			String bht_no=wJson.getString("bht_no");				 
			diabeticchartdbdriver.addNewDiabeticchartDetails(newterm,bht_no);
			 			
			return "true";
		} catch (Exception e) {
			 System.out.println(e.getMessage());
			 
			return e.getMessage().toString(); 
		}

	}
}
