/*
-----------------------------------------------------------------------------------------------------------------------------------
HIS – Health Information System - RESTful  API
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
package lib.classes.CasttingMethods;

import java.util.ArrayList;
import java.util.Collection;
import java.util.List;

public class CastList {
	
	/**
	 * Cast collection of data list into a particular java List and the type will be as mentioned 
	 * @param clazz Class name 
	 * @param c collection of data that need to be cast
	 * @return returns a java List that contains data and the type will be as mentioned in clazz param
	 */
	
	public static <T> List<T> castList(Class<? extends T> clazz, Collection<?> c) {
	    List<T> r = new ArrayList<T>(c.size());
	    for(Object o: c)
	      r.add(clazz.cast(o));
	    return r;
	}

}
