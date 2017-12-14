import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.io.OutputStream;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;
import java.util.ArrayList;
import java.util.Properties;

/**
 * This class is the base class for TestNG Integration Test cases related to all
 * functionalities of Laboratory in HIS Project. developed by Udara Samaratunge.
 * 
 * {@link BaseTestCase}
 * 
 * @author udara.s
 * 
 */
public class BaseTestCase {

	static Properties properties = null;

	static {
		properties = new Properties();
		try {
			// Load all properties in configuration file to Property map
			properties.load(BaseTestCase.class.getResourceAsStream(TestCaseConstants.CONFIG_FILE));
		} catch (IOException e) {
			e.printStackTrace();
		}
	}

	/**
	 * Create connection for HIS Backend REST API
	 * 
	 * @param urlAppend
	 *            Append request URL for the Base URL
	 *            http://172.16.21.251:8080/HIS_API/rest
	 * @param httpMethod
	 *            This is the HTTP Method Request (GET, POST, PUT or DELETE)
	 * @return HttpURLConnection A URLConnection with support for HTTP-specific
	 *         features
	 * @throws MalformedURLException
	 *             Thrown to indicate that a malformed URL has occurred. Either
	 *             no legal protocol could be found in a specification string or
	 *             the string could not be parsed.
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 */
	private HttpURLConnection createHISConnection(String urlAppend) throws MalformedURLException, IOException {

		HttpURLConnection httpURLConnection = (HttpURLConnection) new URL(
				properties.getProperty(TestCaseConstants.BASE_URL) + urlAppend).openConnection();
		httpURLConnection.setRequestProperty(TestCaseConstants.CONTENT_TYPE, TestCaseConstants.JSON);
		return httpURLConnection;

	}

	/**
	 * Generate HTTP GET Request for HIS Backend REST API
	 * 
	 * @param urlAppend
	 *            Append request URL for the Base URL
	 *            http://172.16.21.251:8080/HIS_API/rest
	 * @param httpMethod
	 *            This is the HTTP Method Request (GET, POST, PUT or DELETE)
	 * @return HttpURLConnection A URLConnection with support for HTTP-specific
	 *         features
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 */
	private HttpURLConnection sendHTTPGetRequest(String urlAppend, String httpMethod) throws IOException {

		HttpURLConnection httpURLConnection = createHISConnection(urlAppend);
		httpURLConnection.setRequestMethod(httpMethod);
		return httpURLConnection;

	}

	/**
	 * Generate HTTP Post request body
	 * 
	 * @param urlAppend
	 *            Append request URL for the Base URL
	 *            http://172.16.21.251:8080/HIS_API/rest
	 * @param httpMethod
	 *            This is the HTTP Method Request (GET, POST, PUT or DELETE)
	 * @return HttpURLConnection A URLConnection with support for HTTP-specific
	 *         features
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 */
	private HttpURLConnection sendHTTPPostRequest(String urlAppend, String httpMethod, String postBody)
			throws IOException {

		HttpURLConnection httpURLConnection = this.createHISConnection(urlAppend);
		httpURLConnection.setRequestMethod(httpMethod);
		httpURLConnection.setDoInput(true);
		httpURLConnection.setDoOutput(true);

		OutputStream os = httpURLConnection.getOutputStream();
		os.write(postBody.getBytes());
		os.flush();
		os.close();
		return httpURLConnection;
	}

	/**
	 * Generate Response for the given request
	 * 
	 * @param urlAppend
	 *            Append request URL for the Base URL
	 *            http://172.16.21.251:8080/HIS_API/rest
	 * @param httpMethod
	 *            This is the HTTP Method Request (GET, POST, PUT or DELETE)
	 * @return ArrayList<String> HTTP Response will be converted into String and
	 *         put in the {@link ArrayList}
	 * @throws IOException
	 *             Signals that an I/O exception of some sort has occurred. This
	 *             class is the general class of exceptions produced by failed
	 *             or interrupted I/O operations.
	 */
	public ArrayList<String> getHTTPResponse(String urlAppend, String httpMethod, String requestBody)
			throws IOException {

		InputStream iStream = null;
		HttpURLConnection httpURLConnection = null;
		StringBuffer response = new StringBuffer();

		// Based on the HTTP method it invoke request.
		if (httpMethod.equals(TestCaseConstants.HTTP_GET)) {
			// if Request is HTTP GET request sent without POST body
			httpURLConnection = sendHTTPGetRequest(urlAppend, httpMethod);
			iStream = httpURLConnection.getInputStream();
		} else if (httpMethod.equals(TestCaseConstants.HTTP_POST)) {
			// if Request is HTTP POST request sent with POST body
			httpURLConnection = sendHTTPPostRequest(urlAppend, httpMethod, requestBody);
			iStream = httpURLConnection.getInputStream();
		} else if (httpMethod.equals(TestCaseConstants.HTTP_PUT)) {
			// if Request is HTTP PUT request sent with POST body
			httpURLConnection = sendHTTPPostRequest(urlAppend, httpMethod, requestBody);
			iStream = httpURLConnection.getInputStream();
		}else if (httpMethod.equals(TestCaseConstants.HTTP_DELETE)) {
			// if Request is HTTP PUT request sent with POST body
			httpURLConnection = sendHTTPPostRequest(urlAppend, httpMethod, requestBody);
			iStream = httpURLConnection.getInputStream();
			}
		BufferedReader in = new BufferedReader(new InputStreamReader(iStream));
		String inputLine;
		while ((inputLine = in.readLine()) != null) {
			response.append(inputLine);
		}
		ArrayList<String> responseArrList = new ArrayList<String>();
		responseArrList.add(response.toString());
		responseArrList.add(String.valueOf(httpURLConnection.getResponseCode()));
		return responseArrList;
	}

}
