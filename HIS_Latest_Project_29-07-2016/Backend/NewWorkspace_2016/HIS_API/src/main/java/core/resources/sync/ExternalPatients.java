package core.resources.sync;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;
import java.text.DateFormat;
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.Date;
import java.util.HashSet;
import java.util.Set;

import javax.ws.rs.GET;
import javax.ws.rs.Path;
import javax.ws.rs.PathParam;
import javax.ws.rs.Produces;
import javax.ws.rs.core.MediaType;

import lib.driver.api.driver_class.user.UserDBDriver;
import lib.driver.sync.driver_class.cpsDBDriver;

import org.codehaus.jettison.json.JSONArray;
import org.codehaus.jettison.json.JSONException;
import org.codehaus.jettison.json.JSONObject;

import com.sun.jersey.api.container.MappableContainerException;

import core.classes.opd.Allergy;
import core.classes.opd.OutPatient;
import core.classes.sync.Cps;

@Path("/external")
public class ExternalPatients {

	cpsDBDriver cpsDBDriver = new cpsDBDriver();
	DateFormat dateformat = new SimpleDateFormat("yyyy-MM-dd HH:mm:ss");
	DateFormat dateformat2 = new SimpleDateFormat("yyyy-MM-dd");
	
	@GET
	@Path("/requestExternalPatient/{keyID}")
	@Produces(MediaType.TEXT_PLAIN)
	public String PatientDetails(@PathParam("keyID") String keyID)throws RuntimeException,MappableContainerException
	{	JSONObject jObject = null;
	String hin=null;
		try{
			Cps cps=cpsDBDriver.getCPS();
			URL url = new URL("http://"+cps.getCps_IP()+":"+cps.getCps_Port()+"/cps/api/patient/getPatientsByKey/"+keyID);
			HttpURLConnection conn = (HttpURLConnection) url.openConnection();
    		conn.setRequestMethod("GET");
    		conn.setRequestProperty("Accept", "application/json");
     
    		if (conn.getResponseCode() != 200) {
    			throw new RuntimeException("Failed : HTTP error code : "+ conn.getResponseCode());
    		}
     
    		BufferedReader br = new BufferedReader(new InputStreamReader((conn.getInputStream())));
    		String output="";
    		if((output = br.readLine()) != null) {
    			System.out.println("Data object recieved by HIS :  "+output);

    			//JSONObject jObject;
					UserDBDriver userDriver=new UserDBDriver();
					jObject = new JSONObject(output);
					JSONArray data = jObject.getJSONArray("allergies");

					OutPatient patient = new OutPatient();
					patient.setPatientTitle(jObject.get("patientTitle").toString());
					patient.setPatientFullName(jObject.get("patientFullName").toString());	
					patient.setPatientPersonalUsedName(jObject.getString("patientPersonalUsedName"));
					patient.setPatientNIC(jObject.get("patientNIC").toString());
					patient.setPatientHIN(jObject.get("patientHIN").toString());
					patient.setPatientCreateDate(new Date());
					patient.setPatientLastUpdate(new Date());
					patient.setPatientPhoto(jObject.get("patientPhoto").toString());
					patient.setPatientPassport(jObject.get("patientPassport").toString());
					
					String dob = jObject.get("patientDateOfBirth").toString();
					System.out.println(jObject.get("patientDateOfBirth").toString());
					if(!(dob.isEmpty() | dob==null))
						try {
							patient.setPatientDateOfBirth(dateformat2.parse(jObject.get("patientDateOfBirth").toString()));
						} catch (ParseException e) {
							e.printStackTrace();
						} 
					

					System.out.println(patient.getPatientDateOfBirth());
					patient.setPatientContactPName(jObject.get("patientContactPName").toString());
					patient.setPatientContactPNo(jObject.get("patientContactPNo").toString());	
					patient.setPatientGender(jObject.get("patientGender").toString());
					patient.setPatientCivilStatus(jObject.get("patientCivilStatus").toString());
					patient.setPatientAddress(jObject.get("patientAddress").toString());
					patient.setPatientTelephone(jObject.get("patientTelephone").toString());
					patient.setPatientPreferredLanguage(jObject.get("patientPreferredLanguage").toString());
					patient.setPatientCitizenship(jObject.get("patientCitizenship").toString());
					patient.setPatientRemarks(jObject.get("patientRemarks").toString());
					String photo = jObject.get("patientPhoto").toString();
					 
					if (photo  == null | photo.isEmpty()
							| photo  == "null")
						patient.setPatientPhoto(photo);
					else {
						photo = photo.substring(photo.lastIndexOf("/") + 1, photo.length());
						patient.setPatientPhoto(photo);
					}
					cpsDBDriver.insertExternalPatient(patient);
					
    		}
    		conn.disconnect();
    		hin = jObject.get("patientHIN").toString();
	  } catch (MalformedURLException e) {
		e.printStackTrace();
	  } catch (IOException e) {
		e.printStackTrace();
	  } catch (JSONException e) {
			e.printStackTrace();
		}catch(MappableContainerException m){
			return null;
		}catch(RuntimeException r){
			return null;
		} 
		return hin;
	}
}
	
