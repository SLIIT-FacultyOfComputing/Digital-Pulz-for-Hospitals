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

import core.classes.inward.charts.LiquidBalanceChart;
import core.classes.inward.prescription.PrescriptionTerms;
import flexjson.JSONSerializer;
import flexjson.transformer.DateTransformer;
import lib.driver.inward.driver_class.charts.LiquidBalanceChartDBDriver;

@Path("LiquidBalanceChart")
public class LiquidBalanceChartResource {
	LiquidBalanceChartDBDriver liquidbalancechartdbdriver = new LiquidBalanceChartDBDriver();
	
	DateFormat dateformat = new SimpleDateFormat("yyyy-MM-dd'T'HH:mm");
	
	
	
	@GET
	@Path("/getChart")
	@Produces(MediaType.APPLICATION_JSON)
	public String ChartDetails()
	{
		List<LiquidBalanceChart> chartList = liquidbalancechartdbdriver.getChartValues();
		JSONSerializer serializer = new JSONSerializer();
		return serializer.transform(new DateTransformer("yyyy-MM-dd"),
				"checkedDate").serialize(chartList);

	}
	
	@GET
	@Path("/getLiquidBalanceChartByBHTNo/{bhtNo}")
	@Produces(MediaType.APPLICATION_JSON)
	public String getDiabeticChartByBHTNo(@PathParam("bhtNo")  String bhtNo)
	{
				 String result="";
		 List<LiquidBalanceChart> req =liquidbalancechartdbdriver.getLiquidBalanceChartByBHTNo(bhtNo);
		 JSONSerializer serializor=new JSONSerializer();
		 result= serializor.serialize(req);
		 return result;
	}
	
	@POST
	@Path("/addNewchartDetails")
	@Produces(MediaType.APPLICATION_JSON)
	@Consumes(MediaType.APPLICATION_JSON)
	public String addNewchartDetails(JSONObject wJson)
	{
				
		try {
			LiquidBalanceChart newterm  =  new LiquidBalanceChart();
			
			//newterm.setoral(wJson.getInt("oral"));
			newterm.setoral(Double.parseDouble(wJson.getString("oral").toString()));
			newterm.setsaline(Double.parseDouble(wJson.getString("saline").toString()));
			newterm.setoutput(Double.parseDouble(wJson.getString("output").toString()));				
			newterm.setDateTime(dateformat.parse(wJson.get("dateTime").toString())); 	
			String bht_no=wJson.getString("bht_no");				 
			liquidbalancechartdbdriver.addNewchartDetails(newterm,bht_no);
			 			
			return "true";
		} catch (Exception e) {
			 System.out.println(e.getMessage());
			 
			return e.getMessage().toString(); 
		}

	}
}
