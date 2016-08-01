/*
-----------------------------------------------------------------------------------------------------------------------------------
HIS � Health Information System - RESTful  API
-----------------------------------------------------------------------------------------------------------------------------------
This is a free and open source API which can be used to develop and distributed in the hope that it will be useful to develop EMR systems.
You can utilize the services provides by the API to speed up the development process. 
You can modify the API to cater your requirements at your own risk. 
 
-----------------------------------------------------------------------------------------------------------------------------------
Authors: H.L.M.M De Silva, K.V.M Jayadewa, G.A.R Perera, S.I Kodithuwakku
Supevisor: Dr. Koliya Pulasinghe | Dean /Faculty of Graduate Studies |SLIIT
Co-Supervisor: Mr.Indraka Udayakumara | Senior Lecturer | SLIIT
URL: https://sites.google.com/a/my.sliit.lk/his
----------------------------------------------------------------------------------------------------------------------------------
*/
package lib.classes.DBDriverBase;

import lib.SessionFactoryUtil;

import org.hibernate.HibernateException;
import org.hibernate.Query;
import org.hibernate.Session;
import org.hibernate.Transaction;

import java.util.ArrayList;
import java.util.Iterator;
import java.util.List;
import java.util.Map;
import java.util.Set;

import javassist.bytecode.stackmap.TypeData.ClassName;

/**
 * This abstract class provide all the basic operations that need to be handle when using Hibernate 
 * @param <K>
 *  
 */
public abstract class DBDriverBase<T> {
	
	
	/**
	 * Initializes a session from a SessionFactoryUtil class 
	 */
	private Session session = SessionFactoryUtil.getSessionFactory().openSession();
	
	/**
	 * Method gets a T object and saves it in the DB using Hibernate 
	 * @param T object
	 * @return Boolean 
	 * @exception throws {@link RuntimeException} and {@link HibernateException}
	 */
	public boolean save(T object){
		Transaction tx = null;
		try{	
			tx = session.beginTransaction();
			session.save(object);
			tx.commit();
			return true;
		}catch(RuntimeException ex){
			if(tx != null && tx.isActive())
			{
				try{
					tx.rollback();
				}catch(HibernateException he){
					System.err.println("Error rolling back transaction");
					he.printStackTrace();
				}
			}
			System.err.println("Error in saving the object in the database");
			ex.printStackTrace();
			return false;
		}
	}

	/**
	 * Method gets a T object and updates it in the DB using Hibernate 
	 * @param T object
	 * @return Boolean
	 * @exception throws {@link RuntimeException} and {@link HibernateException}
	 */
	public boolean update(T object){
		Transaction tx = null;
		try{	
			tx = session.beginTransaction();
			session.update(object);
			tx.commit();
			return true;
		}catch(RuntimeException ex){
			if(tx != null && tx.isActive())
			{
				try{
					tx.rollback();
				}catch(HibernateException he){
					System.err.println("Error rolling back transaction");
					he.printStackTrace();
				}
			}
			System.err.println("Error in updating the database");
			ex.printStackTrace();
			return false;
		}
	}

	/**
	 * Method gets a T object and deletes it in the DB using Hibernate 
	 * @param T object
	 * @return Boolean
	 * @exception throws {@link RuntimeException} and {@link HibernateException}
	 */
	public boolean delete(T object){
		Transaction tx = null;
		try{	
			tx = session.beginTransaction();
			session.delete(object);
			tx.commit();
			return true;
		}catch(RuntimeException ex){
			if(tx != null && tx.isActive())
			{
				try{
					tx.rollback();
				}catch(HibernateException he){
					System.err.println("Error rolling back transaction");
				}
			}
			System.err.println("Error in deleting the object details from the DB");
			ex.printStackTrace();
			return false;
		}
	}

	/**
	 * Method gets a Hibernate Query with the list of parameters and retrieve the data from the DB.
	 * @param queryString; gets the Hibernate Query that need to be executed, paramList; gets the Dictionary of parameters which will be passed to the query. 
	 * @return T object
	 * @exception throws {@link RuntimeException} and {@link HibernateException}
	 */
	public T select(String queryString,Map<String,Integer> paramList){
		Transaction tx = null;
		try{
			tx = session.beginTransaction();
			Query query =  session.createQuery(queryString);
			if(paramList != null){
				Set<String> keys =  paramList.keySet();
				for(Iterator<String> iter = keys.iterator(); iter.hasNext();){
					query.setParameter(iter.next(),paramList.get(iter.next()));
				}
			}
			@SuppressWarnings("unchecked")
			List<T> patientList  = (List<T>) query.list();
			T patient = null;
			for(Iterator<T> iter = patientList.iterator(); iter.hasNext();)
			{
				patient = (T) iter.next();
			}
			tx.commit();
			return patient;
		}catch(RuntimeException ex){
			if(tx != null && tx.isActive())
			{
				try{
					tx.rollback();
				}catch(HibernateException he){
					System.err.println("Error rolling back transaction");
				}
			}
			System.err.println("Error in retreiving data from the DB");
			ex.printStackTrace();
			return null;
		}
	}
	
	/**
	 * Method gets a Hibernate Query with the list of parameters and retrieve List of data from the DB.
	 * @param queryString; gets the Hibernate Query that need to be executed, paramList; gets the Dictionary of parameters which will be passed to the query. 
	 * @return List<T>
	 * @exception throws {@link RuntimeException} and {@link HibernateException}
	 */
	public List<T> select(Map<String,Integer> paramList,String queryString){
		Transaction tx = null;
		try{
			tx = session.beginTransaction();
			Query query =  session.createQuery(queryString);
			if(paramList != null){
				Set<String> keys =  paramList.keySet();
				for(Iterator<String> iter = keys.iterator(); iter.hasNext();){
					query.setParameter(iter.next(),paramList.get(iter.next()));
				}
			}
			@SuppressWarnings("unchecked")
			List<T> patientList  = (List<T>)query.list();
			tx.commit();
			return patientList;
		}catch(RuntimeException ex){
			if(tx != null && tx.isActive())
			{
				try{
					tx.rollback();
				}catch(HibernateException he){
					System.err.println("Error rolling back transaction");
				}
			}
			System.err.println("Error in retreiving data from the DB");
			ex.printStackTrace();
			return null;
		}
	}
	
//	@SuppressWarnings({ "rawtypes", "unchecked" })
//	public T getPerticularObject(Object className,int intParameter){
//		Class<T> c=(Class<T>) className.getClass();
//		Class<T> classObj=(Class<T>)session.get(className.getClass(), intParameter);
//		return (T) classObj;
//		
//	}
	
	
	public <k> List<k> getData(Class<k> cls){
		
		List<k> lt=new ArrayList<>();
		return lt;
	}
	
	
	
	
}


 	


/*
Enumeration<String> keys = paramList.keySet();
while(keys.hasMoreElements()){
	query.setParameter(keys.nextElement(),paramList.get(keys.nextElement()));
}
*/