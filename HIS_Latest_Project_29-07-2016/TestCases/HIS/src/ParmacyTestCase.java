import java.io.IOException;
import java.util.ArrayList;

import org.json.JSONException;
import org.testng.Assert;
import org.testng.annotations.Test;

/**
 * This class is for TestNG Integration Test cases related to all
 * functionalities of PharmacyTests in HIS Project. developed by yasini.p
 * 
 * {@link BaseTestCase}
 * 
 * @author yasini.p
 *
 */
public class ParmacyTestCase extends BaseTestCase {

	public static final int SUCCESS_STATUS_CODE = 200;

	/**
	 * This test case is to add Pharmacy
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
	@Test(groups = "his.pharmacy.test")
	public void addPharmacyTestCase() throws IOException, JSONException {

		ArrayList<String> resArrayList = getHTTPResponse(
				properties
						.getProperty(TestCaseConstants.URL_APPEND_ADD_PHARMACY),
				TestCaseConstants.HTTP_POST, RequestUtil
						.requestByID(TestCaseConstants.ADD_OPD_PHARMACY));

		System.out.println("message :"+resArrayList.get(0));

		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)),
				SUCCESS_STATUS_CODE);

	}
	
	/**
	 * This test case is to load Pharmacy
	 * 
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 * @throws JSONException
	 *             Exception throws when process Json
	 */
	@Test(groups = "his.pharmacy.test")
	public void loadPharmacyTestCase() throws IOException {

		ArrayList<String> resArrayList = getHTTPResponse(
				properties.getProperty(TestCaseConstants.LOAD_PHARMACY_TABLE),
				TestCaseConstants.HTTP_GET, null);

		Assert.assertEquals(Integer.parseInt(resArrayList.get(1)),
				SUCCESS_STATUS_CODE);
	}

}
