package core.classes.opd;

import lib.driver.opd.driver_class.PatientDBDriver;

public class Hin {
	PatientDBDriver patient = new PatientDBDriver();
	
	public String serialNumberForHin()
	{
		int id1,ID2;
		String ID1 = patient.getMaxPatientID();
		if((ID1=="") || (ID1==null)){
			ID2=1;
		}
		else{	
		 id1 = Integer.parseInt(ID1);
		 ID2 = id1 +1;
		}
		 
		String ID = Integer.toString(ID2);
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
		String PatientNewHIN = "1234"+ID;
		return PatientNewHIN;
	}
	
	public  String generateChekDigit() throws Exception{
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
		String checkHin = Integer.toString(checkDigit);
		//System.out.println("Hin is :"+checkHin);
		return checkHin;
		
	}
	
	public String fullHin()
	{
		String serial = serialNumberForHin();
		try {
			String chek = generateChekDigit();
			String fullHin = serial+chek;
			return fullHin;
		} catch (Exception e) {
			return "Cannot generate Hin";
		}
			
	}

}
