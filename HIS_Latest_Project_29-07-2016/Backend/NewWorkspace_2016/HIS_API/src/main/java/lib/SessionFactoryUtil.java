package lib;

import org.hibernate.Session;
import org.hibernate.SessionFactory;
import org.hibernate.Transaction;
import org.hibernate.cfg.Configuration;
import org.hibernate.service.ServiceRegistry;
import org.hibernate.service.ServiceRegistryBuilder;

public class SessionFactoryUtil {
	
	
	private static SessionFactory sesFactory;
	private static ServiceRegistry sesRegistry;
	
	static{
		try{
			//This is the initial system database check. Select the master database to this
			Configuration cfg= new Configuration().configure("lib/hibernate.cfg.xml");
			sesRegistry = new ServiceRegistryBuilder().applySettings(cfg.getProperties()).buildServiceRegistry();
			sesFactory=cfg.buildSessionFactory(sesRegistry);
		}
		catch(Throwable ex){
			System.err.println("Initial SessionFactory Creation Failed"+ex);
			throw new ExceptionInInitializerError(ex);
		}
	}	
	
	public static SessionFactory getSessionFactory() {
	    return sesFactory;
	}
	
}
