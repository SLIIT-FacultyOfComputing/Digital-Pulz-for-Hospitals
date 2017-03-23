package lib;



import java.util.List;

import javax.annotation.Resource;

import org.hibernate.Criteria;
import org.hibernate.Session;
import org.hibernate.SessionFactory;
import org.hibernate.Transaction;


public class BaseDaoImpl {

	Transaction tx = null;
	Session session = null;

	@Resource(name = "sessionFactory")
	private SessionFactory sessionFactory;

	public Transaction SetSession()
	{
		this.session = SessionFactoryUtil.getSessionFactory().openSession();;
		tx = this.session.beginTransaction();
		return tx;
	}
	
	public void CloseSession(Transaction tx)
	{
		tx.commit();
		session.close();
	}
	
	public <T> T save(final T o){
	    return (T) session.save(o);
	}


	public void delete(final Object object){
		session.delete(object);
	}

	/***/
	public <T> T get(final Class<T> type, final int id){
		return (T) session.get(type, id);
	}

	/***/
	public <T> T merge(final T o)   {
	   return (T) session.merge(o);
	}

	/***/
	public <T> void saveOrUpdate(final T o){
		session.saveOrUpdate(o);
	}

	public <T> List<T> getAll(final Class<T> type) {
	  
	   final Criteria crit = session.createCriteria(type);
	   return crit.list();
	}
}