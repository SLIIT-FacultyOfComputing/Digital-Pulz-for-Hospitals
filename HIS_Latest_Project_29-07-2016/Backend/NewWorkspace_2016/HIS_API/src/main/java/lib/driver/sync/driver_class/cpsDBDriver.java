package lib.driver.sync.driver_class;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.io.OutputStream;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;
import java.util.List;

import lib.SessionFactoryUtil;

import org.codehaus.jettison.json.JSONException;
import org.codehaus.jettison.json.JSONObject;
import org.hibernate.HibernateException;
import org.hibernate.Query;
import org.hibernate.Session;
import org.hibernate.Transaction;

import core.classes.api.user.AdminUser;
import core.classes.opd.Allergy;
import core.classes.opd.OutPatient;
import core.classes.sync.Cps;

public class cpsDBDriver {
	
	Session session = SessionFactoryUtil.getSessionFactory().openSession();
	
	@SuppressWarnings("rawtypes")
	public Cps getCPS() {
			Transaction tx = null;
		try {
			tx = session.beginTransaction();
			Query query = session.createQuery("select c from Cps as c");
			List cps = query.list();

			if (cps.size() == 0)
				return null;

			Cps CP = (Cps) cps.get(0);
			tx.commit();
			
			return CP;
		} catch (RuntimeException ex) {
			if (tx != null && tx.isActive()) {
				try {
					tx.rollback();
				} catch (HibernateException he) {
					System.err.println("Error rolling back transaction");
				}
				throw ex;
			}
			return null;
		}
	}
	
	

	public boolean sendNewPatientObjToCPS(OutPatient patient,String dob) {
			try {
				Cps cps=getCPS();

				URL url = new URL("http://"+cps.getCps_IP()+":"+cps.getCps_Port()+"/cps/api/patient/newPatient");
				HttpURLConnection conn = (HttpURLConnection) url.openConnection();
				conn.setDoOutput(true);
				conn.setRequestMethod("POST");
				conn.setRequestProperty("Content-Type", "application/json");

				JSONObject ob = new JSONObject();
				ob.put("hospital","1");
				ob.put("title",patient.getPatientTitle());
				ob.put("fullname",patient.getPatientFullName());
				ob.put("personalname",patient.getPatientPersonalUsedName());
				ob.put("nic",patient.getPatientNIC());
				ob.put("hin",patient.getPatientHIN());
				ob.put("passport",patient.getPatientPassport());
				ob.put("lang",patient.getPatientPreferredLanguage());
				ob.put("dob",dob);			
				ob.put("gender",patient.getPatientGender());
				ob.put("cstatus",patient.getPatientCivilStatus());
				ob.put("telephone",patient.getPatientTelephone());
				ob.put("address",patient.getPatientAddress());
				ob.put("citizen",patient.getPatientCitizenship());
				ob.put("contactpname",patient.getPatientContactPName());
				ob.put("contactpno",patient.getPatientContactPNo());
				ob.put("remarks",patient.getPatientRemarks());
				OutputStream os = conn.getOutputStream();
				os.write(ob.toString().getBytes());
				os.flush();
				
				if (conn.getResponseCode() != HttpURLConnection.HTTP_CREATED) {
					throw new RuntimeException("Failed : HTTP error code : "
						+ conn.getResponseCode());
				}else{
					System.out.println("Connected with the CPS server...");
					System.out.println("Sending patient object to CPS...");
				}
				
				BufferedReader br = new BufferedReader(new InputStreamReader(
						(conn.getInputStream())));
				String output;
				System.out.print("Acknowledgment from Server :");
				while ((output = br.readLine()) != null) {
					System.out.println(output);
				}

				conn.disconnect();
				return true;
		  }catch (MalformedURLException e) {	 
			  e.printStackTrace();
			  return false;
		  } catch (IOException e) {
			  e.printStackTrace();
			  return false;
		  }	catch (JSONException e) {
			e.printStackTrace();
			return false;
		  }
	}
	

	public boolean sendUpdatedPatientObjToCPS(OutPatient patient,String dob) {
		try {
			Cps cps=getCPS();

			URL url = new URL("http://"+cps.getCps_IP()+":"+cps.getCps_Port()+"/cps/api/patient/updatePatient");
			HttpURLConnection conn = (HttpURLConnection) url.openConnection();
			conn.setDoOutput(true);
			conn.setRequestMethod("POST");
			conn.setRequestProperty("Content-Type", "application/json");

			JSONObject ob = new JSONObject();
			ob.put("hospital","1");
			ob.put("title",patient.getPatientTitle());
			ob.put("fullname",patient.getPatientFullName());
			ob.put("personalname",patient.getPatientPersonalUsedName());
			ob.put("nic",patient.getPatientNIC());
			ob.put("hin",patient.getPatientHIN());
			ob.put("passport",patient.getPatientPassport());
			ob.put("lang",patient.getPatientPreferredLanguage());
			ob.put("dob",dob);			
			ob.put("gender",patient.getPatientGender());
			ob.put("cstatus",patient.getPatientCivilStatus());
			ob.put("telephone",patient.getPatientTelephone());
			ob.put("address",patient.getPatientAddress());
			ob.put("citizen",patient.getPatientCitizenship());
			ob.put("contactpname",patient.getPatientContactPName());
			ob.put("contactpno",patient.getPatientContactPNo());
			ob.put("remarks",patient.getPatientRemarks());
			OutputStream os = conn.getOutputStream();
			os.write(ob.toString().getBytes());
			os.flush();
			
			if (conn.getResponseCode() != HttpURLConnection.HTTP_CREATED) {
				throw new RuntimeException("CPS Connection Failed : HTTP error code : "
					+ conn.getResponseCode());
			}else{
				System.out.println("Connected with the CPS server...");
				System.out.println("Sending patient object to CPS...");
			}
			
			BufferedReader br = new BufferedReader(new InputStreamReader(
					(conn.getInputStream())));
			String output;
			System.out.print("Acknowledgment from Server :");
			while ((output = br.readLine()) != null) {
				System.out.println(output);
			}

			conn.disconnect();
			return true;
	  }catch (MalformedURLException e) {	 
		  e.printStackTrace();
		  return false;
	  } catch (IOException e) {
		  e.printStackTrace();
		  return false;
	  }	catch (JSONException e) {
		e.printStackTrace();
		return false;
	  }
}
	
	
	public boolean saveAllergy(Allergy allergy){
		Transaction tx=null;
		try {
			
			tx = session.beginTransaction();			
			session.save(allergy);
			tx.commit();
			System.out.println("Allergy Added To The HIS Database : "+allergy.getAllergyID());
			return true;
		} catch (RuntimeException ex) {
			if (tx != null && tx.isActive()) {
				try {
					tx.rollback();
				} catch (HibernateException he) {
					System.err.println("Error rolling back transaction");
				}
				throw ex;
			}
			return false;
		}		
	}
	
	
	
	public boolean insertExternalPatient(OutPatient patient) {

		AdminUser user = (AdminUser) session.get(AdminUser.class, 1); 
		patient.setPatientLastUpdateUser(user);
		patient.setPatientCreateUser(user);
		
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			session.save(patient);
			tx.commit();
			System.out.println("Patient Added To HIS Database: "+patient.getPatientFullName());
			return true;
		} catch (RuntimeException ex) {
			if (tx != null && tx.isActive()) {
				try {
					tx.rollback();
				} catch (HibernateException he) {
					System.err.println("Error rolling back transaction");
				}
				throw ex;
			}
			return false;
		}

	}
	
	
	@SuppressWarnings("rawtypes")
	public OutPatient getPatientByHIN(String hin) {
			Transaction tx = null;
		try {
			tx = session.beginTransaction();
			Query query = session.createQuery("select p from OutPatient as p where p.patientHIN = :hin");
			query.setParameter("hin", hin);
			List patientList = query.list();

			if (patientList.size() == 0)
				return null;

			tx.commit();
			
			return (OutPatient) patientList.get(0);
		} catch (RuntimeException ex) {
			if (tx != null && tx.isActive()) {
				try {
					tx.rollback();
				} catch (HibernateException he) {
					System.err.println("Error rolling back transaction");
				}
				throw ex;
			}
			return null;
		}
	}
	
	
}
