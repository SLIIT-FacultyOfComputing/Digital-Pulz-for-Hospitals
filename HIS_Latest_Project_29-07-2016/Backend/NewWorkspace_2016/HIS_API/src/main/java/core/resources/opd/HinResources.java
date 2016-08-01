/**
 * 
 */
package core.resources.opd;

import javax.ws.rs.GET;
import javax.ws.rs.POST;
import javax.ws.rs.Path;
import javax.ws.rs.PathParam;
import javax.ws.rs.Produces;
import javax.ws.rs.core.MediaType;

import lib.driver.opd.driver_class.PatientDBDriver;
import core.classes.opd.OutPatient;
import core.classes.opd.Patient;

/**
 * @author 
 *
 */
@Path("Hin")
public class HinResources {
	
	PatientDBDriver patient = new PatientDBDriver();
	
/**
 * generate serial number of the HIN
 * 
 * 
 */
@GET
@Path("/serialNumberForHin")
@Produces(MediaType.TEXT_PLAIN)
public String serialNumberForHin()
{
	String ID = patient.getMaxPatientID();
	switch (ID.length()) {
		case 1:
			ID = "00000" + ID;			
			break;
		case 2:
			ID = "0000" + ID;
			break;
		case 3:
			ID = "000" + ID;
			break;
		case 4:
			ID = "00" + ID;
			break;
		case 5:
			ID = "0" + ID;
			break;
		default:
			break;
	}
	String PatientNewHIN = "1001"+ID;
	return PatientNewHIN;
}
/**
 * generate check digit for HIN
 * 
 * 
 */

@GET
@Path("/generateChekDigit")
public String generateChekDigit() throws Exception{
	int checkDigit;
	String oldHin = serialNumberForHin();

	String validChars = "0123456789ABCDEFGHIJKLMNOPQRSTUVYWXZ_";
	
	oldHin = oldHin.trim().toUpperCase();
	
	int sum = 0;
	 
	for (int i = 0; i < oldHin.length(); i++) {
	
		char ch = oldHin.charAt(oldHin.length() - i - 1);
	 
		if (validChars.indexOf(ch) == -1)
			throw new Exception();
	 
			int digit = (int)ch - 48;
	
			int weight;
			if (i % 2 == 0)
			{
				weight = (2 * digit) - (int) (digit / 5) * 9;
	 
			} 
			else 
			{
				weight = digit;
			}
			sum += weight;
	}
	sum = Math.abs(sum) + 10;
	
	checkDigit = (10 - (sum % 10)) % 10;
	String checkHin = oldHin+"-"+Integer.toString(checkDigit);
	//System.out.println("Hin is :"+checkHin);
	return checkHin;
	
}


}
