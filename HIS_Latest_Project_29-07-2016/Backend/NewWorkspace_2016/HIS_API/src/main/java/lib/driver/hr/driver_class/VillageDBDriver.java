package lib.driver.hr.driver_class;

import java.util.List;

import lib.SessionFactoryUtil;

import org.hibernate.Query;
import org.hibernate.Session;
import org.hibernate.Transaction;

import core.classes.hr.Village;

public class VillageDBDriver {

	Session session = SessionFactoryUtil.getSessionFactory().openSession();
	Transaction tx = null;
	
	public List<Village> getVillageOnSearch(String villageName)
	{
		Query query = session.createQuery("from Village w where w.gndivision like '%"+ villageName + "%'");

		@SuppressWarnings("unchecked")
		List<Village> villageList = query.list();

		return villageList;
	}
}
