import java.io.File;

import javax.xml.parsers.DocumentBuilderFactory;

import org.w3c.dom.Element;
import org.w3c.dom.NodeList;

/**
 * This class is for TestNG Integration Test cases related to HIS Project. All
 * JSON Responses are stored in RestPostRequests.xml developed by Udara
 * Samaratunge.
 * 
 * @author udara.s
 * 
 */
public class RequestUtil {

	private static final String REQUEST = "request";
	private static final String ID = "id";

	/**
	 * This method read the RestPostRequests.xml file and retrieve the query by
	 * query id.
	 * 
	 * @param type
	 * @return
	 */
	public static String requestByID(String id) {

		NodeList nodeList;
		Element element = null;

		try {
			nodeList = DocumentBuilderFactory.newInstance().newDocumentBuilder()
					.parse(new File(TestCaseConstants.REQUEST_FILE_PATH)).getElementsByTagName(REQUEST);

			for (int x = 0; x < nodeList.getLength(); x++) {
				element = (Element) nodeList.item(x);
				if (element.getAttribute(ID).equals(id))
					break;
			}
		} catch (Exception ex) {
			ex.printStackTrace();
		}
		return element.getTextContent();
	}
}
