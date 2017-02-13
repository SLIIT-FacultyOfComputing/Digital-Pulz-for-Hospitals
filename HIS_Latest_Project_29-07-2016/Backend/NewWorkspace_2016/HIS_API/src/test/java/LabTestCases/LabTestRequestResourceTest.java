package LabTestCases;

import java.io.IOException;
import java.util.ArrayList;
import java.util.Properties;

import org.json.JSONException;
import org.testng.annotations.Test;

/**
 * This class is for TestNG Integration Test cases related to all
 * functionalities of LaboratoryTests in HIS Project. developed by Ratnayake V.C.
 * 
 * {@link BaseTestCase}
 * 
 * @author Ratnayake V.C
 *
 */

public class LabTestRequestResourceTest extends BaseTestCase {
	
	public static final int SUCCESS_STATUS_CODE = 200;
	
	//variables here

	
  /**
   * test case for insert new lab test
   * @throws IOException
   * @throws JSONException
   */
  @Test
  public void addNewLabTest() throws IOException, JSONException {
	  /*ArrayList<String> resArrayList = getHTTPResponse(properties.getProperty(TestCaseConstants.), httpMethod, requestBody)*/
  }

  @Test
  public void addSpecimenInfo() {
    throw new RuntimeException("Test not implemented");
  }

  @Test
  public void getAllSpecimenRetType() {
    throw new RuntimeException("Test not implemented");
  }

  @Test
  public void getAllSpecimenType() {
    throw new RuntimeException("Test not implemented");
  }

  @Test
  public void getAllSubCategories() {
    throw new RuntimeException("Test not implemented");
  }

  @Test
  public void getAllTestRequests() {
    throw new RuntimeException("Test not implemented");
  }

  @Test
  public void getSpecimenByRequestID() {
    throw new RuntimeException("Test not implemented");
  }

  @Test
  public void getSpecimenIDByRequestID() {
    throw new RuntimeException("Test not implemented");
  }

  @Test
  public void getTestRequestByRequestID()  {
    
  }

  @Test
  public void setStatus() {
    throw new RuntimeException("Test not implemented");
  }
}
