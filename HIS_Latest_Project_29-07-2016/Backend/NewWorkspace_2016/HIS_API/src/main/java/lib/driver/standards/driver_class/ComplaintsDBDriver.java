package lib.driver.standards.driver_class;

import java.util.List;

import lib.SessionFactoryUtil;

import org.hibernate.Query;
import org.hibernate.Session;
import org.hibernate.Transaction;

import core.classes.hr.Village;
import core.classes.standards.Complaint;

public class ComplaintsDBDriver {

	Session session = SessionFactoryUtil.getSessionFactory().openSession();
	Transaction tx = null;
	
	public List<Complaint> getVillageOnSearch(String complainName)
	{
		Query query = session.createQuery("from Complaint w where w.name like '%"+ complainName + "%'");

		@SuppressWarnings("unchecked")
		List<Complaint> compList = query.list();

		return compList;
	}
}
