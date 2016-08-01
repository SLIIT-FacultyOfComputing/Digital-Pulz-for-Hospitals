package core.resources.save;

import java.io.BufferedOutputStream;
import java.io.File;
import java.io.FileOutputStream;
import java.io.IOException;
import java.io.OutputStream;

import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

import org.hibernate.Criteria;
import org.hibernate.Session;
import org.hibernate.SessionFactory;
import org.hibernate.Transaction;
import org.hibernate.criterion.Restrictions;

import core.classes.inward.WardAdmission.Admission;
import core.classes.inward.WardAdmission.WardAdmission;
import lib.SessionFactoryUtil;

/**
 * Servlet implementation class saveSignature
 */
@WebServlet("/saveSignature")
public class saveSignature extends HttpServlet {

	Transaction t;
	private static final long serialVersionUID = 1L;
       
    /**
     * @see HttpServlet#HttpServlet()
     */
    public saveSignature() {
        super();
        // TODO Auto-generated constructor stub
    }

	/**
	 * @see HttpServlet#doGet(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		// TODO Auto-generated method stub
		response.getWriter().append("Served at: ").append(request.getContextPath());
	}

	/**
	 * @see HttpServlet#doPost(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		 
        String img = request.getParameter("img");
        String Name = request.getParameter("fileName");
        
        String arr[] = img.split(",");
        byte barr[] = new byte[arr.length];
        for (int i = 0; i < arr.length; i++) {
            barr[i] = Byte.parseByte(arr[i]);
        }
        String path = "/home/his/Desktop/dilhara/images/"+Name+".jpeg";
      OutputStream out = new BufferedOutputStream(new FileOutputStream(new File(path)));
      //C:\Users\Babi\Desktop\treatmentimages
      out.write(barr);
        out.close();
        System.out.print("SDSADA");
      //  WardAdmission
      
//        t = session.beginTransaction();
//        
//        Criteria c = session.createCriteria(Admission.class);
//        c.add(Restrictions.eq("bhtNo", Name.split("-")[0]));
//        
//        Admission admission = (Admission) c.uniqueResult();
//        admission.setSign(path);
//
//        session.update(admission);
        
		doGet(request, response);
	}

}
