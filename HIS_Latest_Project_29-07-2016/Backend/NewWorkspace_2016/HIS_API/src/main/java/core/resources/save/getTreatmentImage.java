package core.resources.save;

import java.io.BufferedInputStream;
import java.io.BufferedReader;
import java.io.File;
import java.io.FileInputStream;

import javax.ws.rs.GET;
import javax.ws.rs.Path;
import javax.ws.rs.PathParam;
import javax.ws.rs.Produces;
import javax.ws.rs.core.MediaType;

import org.hibernate.Criteria;
import org.hibernate.Session;
import org.hibernate.criterion.Order;
import org.hibernate.criterion.Restrictions;
import org.hibernate.internal.CriteriaImpl.CriterionEntry;

import core.classes.inward.WardAdmission.Admission;
import core.classes.inward.treat.Diagnose;
import flexjson.JSONSerializer;
import javassist.bytecode.ByteArray;
import lib.SessionFactoryUtil;

@Path("TreatmentImage")
public class getTreatmentImage {

	Session session = SessionFactoryUtil.getSessionFactory().openSession();

	@GET
	@Path("/getTreatmentImage/{bhtNo}")
	public String getTreatmentImageByBHT(@PathParam("bhtNo") String bhtNo) {
		String value = "false";
		String Treat="";
		try {
			
			Admission adminssion = (Admission) session.get(Admission.class, bhtNo);
			Criteria c = session.createCriteria(Diagnose.class);
			c.add(Restrictions.eq("bht_no", adminssion));
			c.addOrder(Order.desc("id"));
			c.setMaxResults(1);
			
			Diagnose diagnose = (Diagnose) c.uniqueResult();
			value =diagnose.getImage().toString();
			Treat = diagnose.getTreat();
			
			File file = new File(value);
			
			FileInputStream fin = new FileInputStream(file);
			byte[] array = new byte[(int)file.length()];
			fin.read(array);
			
			fin.close();
			
			StringBuilder builder = new StringBuilder();
			for (byte b : array) {
				builder.append(""+b+",");
			}
			
			value = builder.toString()+"#"+file.getName()+"#"+Treat;
			
			System.out.println(value);
			System.out.println(bhtNo);
		} catch (Exception e) {
			e.printStackTrace();
		}

		return value;
	}

}
