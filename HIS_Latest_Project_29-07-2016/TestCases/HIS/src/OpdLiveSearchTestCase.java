import java.io.IOException;
import java.util.ArrayList;

import org.testng.Assert;
import org.testng.annotations.Test;

/**
 * This class is for TestNG Integration Test cases related to all
 * functionalities of OPD in HIS Project. developed by yasini.p
 * 
 * {@link BaseTestCase}
 * 
 * @author yasini.p
 *
 */
public class OpdLiveSearchTestCase extends BaseTestCase {
	
	public static final int SUCCESS_STATUS_CODE = 200;
	
	/**
	 * This test case is for get all allergy live
	 * 
	 * @throws IOException
	 */
	@Test(groups = "his.opd.test")
	public void getAllAllergyLiveTestCase() throws IOException {

		ArrayList<String> resArrayList = getHTTPResponse(properties.getProperty(TestCaseConstants.URL_APPEND_OPD_ALLERGY),
				TestCaseConstants.HTTP_GET, null);

		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
	}
	
	/**
	 * This test case is for get all injury live
	 * 
	 * @throws IOException
	 */
	@Test(groups = "his.opd.test")
	public void getAllInjuryLiveTestCase() throws IOException {

		ArrayList<String> resArrayList = getHTTPResponse(properties.getProperty(TestCaseConstants.URL_APPEND_OPD_INJURY),
				TestCaseConstants.HTTP_GET, null);

		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)), SUCCESS_STATUS_CODE);
	}


}
