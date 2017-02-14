import java.io.IOException;
import java.util.ArrayList;

import org.json.JSONException;
import org.testng.Assert;
import org.testng.annotations.Test;


/**
 * This class is for TestNG Integration Test cases related to all
 * functionalities of OPD in HIS Project. developed by Nisal De Silva.
 * 
 * {@link BaseTestCase}
 * @author nisal.d
 * 
 */
public class HinTestCase extends BaseTestCase{
	public static final int SUCCESS_STATUS_CODE = 200;
	
	public static String hin;
	public static String serial;
	
	/**
	 * This test case is for get serial for HIN
	 * @throws IOException
	 * @throws JSONException 
	 */
	@Test(groups = "his.opd.test")
	public void serialNumberForHinTestCase() throws IOException, JSONException{

		hin = (new OutPatientTestCase()).getHIN();
		
		ArrayList<String> resArrayList = getHTTPResponse(properties.getProperty(TestCaseConstants.URL_APPEND_GET_SERIAL_NO_FOR_HIN),
				TestCaseConstants.HTTP_GET, null);

		serial = resArrayList.get(0);
		
		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
		

	}
	
	/**
	 * This test case is for get serial for HIN
	 * @throws IOException
	 * @throws JSONException 
	 */
	@Test(groups = "his.opd.test", dependsOnMethods = {"serialNumberForHinTestCase"})
	public void generateChekDigitTestCase() throws IOException, JSONException{

		ArrayList<String> resArrayList = getHTTPResponse(properties.getProperty(TestCaseConstants.URL_APPEND_GET_GENERATE_CHECK_DIGIT),
				TestCaseConstants.HTTP_GET, null);

		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
		
		

	}
}
