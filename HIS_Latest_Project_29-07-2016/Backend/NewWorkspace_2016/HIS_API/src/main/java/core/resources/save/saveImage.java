package core.resources.save;

import java.io.BufferedOutputStream;
import java.io.File;
import java.io.FileInputStream;
import java.io.FileOutputStream;
import java.io.IOException;
import java.io.InputStream;
import java.io.ObjectOutputStream;
import java.io.OutputStream;

import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

@WebServlet("/saveImage")
public class saveImage extends HttpServlet {
	private static final long serialVersionUID = 1L;

	public saveImage() {
		super();
		// TODO Auto-generated constructor stub
	}

	protected void doGet(HttpServletRequest request,
			HttpServletResponse response) throws ServletException, IOException {
		// TODO Auto-generated method stub
		response.getWriter().append("Served at: ")
				.append(request.getContextPath());
	}

	protected void doPost(HttpServletRequest request,
			HttpServletResponse response) throws ServletException, IOException {
		// TODO Auto-generated method stub

		String img = request.getParameter("img");
		String Name = request.getParameter("fileName");

		String arr[] = img.split(",");
		byte barr[] = new byte[arr.length];
		for (int i = 0; i < arr.length; i++) {
			barr[i] = Byte.parseByte(arr[i]);
		}

		OutputStream out = new BufferedOutputStream(new FileOutputStream(
				new File("/home/his/Desktop/dilhara/images/" + Name
						+ ".jpeg")));
		// C:\Users\Babi\Desktop\treatmentimages
		out.write(barr);
		out.close();
		System.out.print("SDSADA");
		doGet(request, response);
	}

}
