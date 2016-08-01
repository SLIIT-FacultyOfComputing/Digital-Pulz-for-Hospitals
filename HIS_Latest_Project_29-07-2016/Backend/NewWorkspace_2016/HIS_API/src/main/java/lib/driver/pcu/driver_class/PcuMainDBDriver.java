package lib.driver.pcu.driver_class;

import java.util.List;

import lib.SessionFactoryUtil;

import org.hibernate.HibernateException;
import org.hibernate.Query;
import org.hibernate.Session;
import org.hibernate.Transaction;

import core.classes.pcu.PcuExpireditems;
import core.classes.pcu.PcuItemstockday;
import core.classes.pcu.PcuViewinventory;
import core.classes.pcu.PcuViewinventoryId;

public class PcuMainDBDriver {
	
	Session session=SessionFactoryUtil.getSessionFactory().openSession();
	
	public List<PcuViewinventory> GetInventoryItems() {
			
			Transaction tx = null;
			try {
				tx = session.beginTransaction();
				Query query = session.createQuery("FROM PcuViewinventory as p");
				List<PcuViewinventory> ItemList = query.list();
				System.out.println(ItemList.toString());
				tx.commit();
				return ItemList;	
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
	public int ItemsBelowCount() {
		
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			Query query = session.createQuery("SELECT COUNT(*) as item_count FROM PcuViewinventory p where p.id.reorderLevel>p.id.totQty");
			int count = Integer.parseInt(query.uniqueResult().toString());
			System.out.print(count);
			tx.commit();
			return count;
		} catch (RuntimeException ex) {
			if (tx != null && tx.isActive()) {
				try {
					tx.rollback();
				} catch (HibernateException he) {
					System.err.println("Error rolling back transaction");
				}
				throw ex;
			}
			return 0;
		}
	}
	public List<PcuViewinventory> GetItemsBelow() {
		
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			Query query = session.createQuery("SELECT p.id.SNumber,p.id.reorderLevel,p.id.totQty FROM PcuViewinventory p where p.id.reorderLevel>p.id.totQty");
			List<PcuViewinventory> ItemList = query.list();
			System.out.println(ItemList.toString());
			tx.commit();
			return ItemList;	
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
	
	public int ItemsExpiredCount() {
		
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			Query query = session.createQuery("SELECT COUNT(*) as expire_count FROM PcuExpireditems p ");
			int count = Integer.parseInt(query.uniqueResult().toString());
			System.out.print(count);
			tx.commit();
			return count;
		} catch (RuntimeException ex) {
			if (tx != null && tx.isActive()) {
				try {
					tx.rollback();
				} catch (HibernateException he) {
					System.err.println("Error rolling back transaction");
				}
				throw ex;
			}
			return 0;
		}
	}
	
public List<PcuExpireditems> GetExpiredItems() {
		
		Transaction tx = null;
		try {
			tx = session.beginTransaction();
			Query query = session.createQuery("FROM PcuExpireditems p");
			List<PcuExpireditems> ItemList = query.list();
			System.out.println(ItemList.toString());
			tx.commit();
			return ItemList;	
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

public List<PcuItemstockday> GetStockPerDay() {
	
	Transaction tx = null;
	try {
		tx = session.beginTransaction();
		Query query = session.createQuery("FROM PcuItemstockday p");
		List<PcuItemstockday> ItemList = query.list();
		System.out.println(ItemList.toString());
		tx.commit();
		return ItemList;	
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
