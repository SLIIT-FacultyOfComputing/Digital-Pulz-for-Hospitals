package core.resources.lims;

import java.util.Date;
import java.util.List;

import javax.ws.rs.Consumes;
import javax.ws.rs.GET;
import javax.ws.rs.POST;
import javax.ws.rs.Path;
import javax.ws.rs.Produces;
import javax.ws.rs.core.MediaType;

import org.codehaus.jettison.json.JSONException;
import org.codehaus.jettison.json.JSONObject;

import core.classes.lims.Category;
import core.classes.lims.LabDepartments;
import core.classes.lims.LabTestRequest;
import core.classes.lims.LabTypes;
import core.classes.lims.Laboratories;
import core.classes.lims.MainResults;
import core.classes.lims.ParentTestFields;
import core.classes.lims.PcuLabTestRequest;
import core.classes.lims.Reports;
import core.classes.lims.SampleCenterTypes;
import core.classes.lims.SampleCenters;
import core.classes.lims.SpecimenRetentionType;
import core.classes.lims.SpecimenType;
import core.classes.lims.SubCategory;
import core.classes.lims.SubFieldResults;
import core.classes.lims.SubTestFields;
import core.classes.lims.TestFieldsRange;
import core.classes.lims.TestNames;
import flexjson.JSONSerializer;
import lib.driver.lims.driver_class.CategoryDBDriver;
import lib.driver.lims.driver_class.LabDepartmentDBDriver;
import lib.driver.lims.driver_class.LabTestRequestDBDriver;
import lib.driver.lims.driver_class.LabTypeDBDriver;
import lib.driver.lims.driver_class.LaboratoriesDBDriver;
import lib.driver.lims.driver_class.MainResultsDBDriver;
import lib.driver.lims.driver_class.ParentTestFieldsDBDriver;
import lib.driver.lims.driver_class.ReportsDBDriver;
import lib.driver.lims.driver_class.SampleCenterTypeDBDriver;
import lib.driver.lims.driver_class.SampleCentersDBDriver;
import lib.driver.lims.driver_class.SpecimenRetentionTypeDBDriver;
import lib.driver.lims.driver_class.SpecimenTypeDBDriver;
import lib.driver.lims.driver_class.SubCategoryDBDriver;
import lib.driver.lims.driver_class.SubTestFieldsDBDriver;
import lib.driver.lims.driver_class.SubTestFieldsResultsDBDriver;
import lib.driver.lims.driver_class.TestFieldsRangeDBDriver;
import lib.driver.lims.driver_class.TestNamesDBDriver;

@Path("SampleWSTesting")
public class SampleWSTestingResource {

CategoryDBDriver cDBDriver= new CategoryDBDriver();
SubCategoryDBDriver sDBDriver= new SubCategoryDBDriver();
TestNamesDBDriver testDBDriver= new TestNamesDBDriver();
TestFieldsRangeDBDriver  rangeDBDriver= new TestFieldsRangeDBDriver();
ParentTestFieldsDBDriver parentfieldDBDriver = new ParentTestFieldsDBDriver();
SubTestFieldsDBDriver subtestfieldsDBDriver = new SubTestFieldsDBDriver();
LabDepartmentDBDriver ldDBDriver= new LabDepartmentDBDriver();
LaboratoriesDBDriver labDBDriver= new LaboratoriesDBDriver();
LabTestRequestDBDriver requestDBDriver= new LabTestRequestDBDriver();
LabTypeDBDriver ltDBDriver= new LabTypeDBDriver();
MainResultsDBDriver mrDBDriver= new MainResultsDBDriver();
ParentTestFieldsDBDriver pDBDriver = new ParentTestFieldsDBDriver();
LabTestRequestDBDriver lrDBDriver = new LabTestRequestDBDriver();
TestNamesDBDriver testNamesDBDriver= new TestNamesDBDriver();
ReportsDBDriver reportDBDriver = new ReportsDBDriver();
SampleCentersDBDriver samplecenterDBDriver= new SampleCentersDBDriver();
SampleCenterTypeDBDriver scDBDriver= new SampleCenterTypeDBDriver();
SpecimenRetentionTypeDBDriver srtDBDriver= new SpecimenRetentionTypeDBDriver();
SpecimenTypeDBDriver stDBDriver= new SpecimenTypeDBDriver();
MainResultsDBDriver mainresultDBDriver = new MainResultsDBDriver();
SubTestFieldsDBDriver subtestfieldDBDriver = new SubTestFieldsDBDriver();
SubTestFieldsResultsDBDriver subtestfieldresultsDBDriver = new SubTestFieldsResultsDBDriver();
	
	@GET
	@Path("/addTestCategory")
	@Produces(MediaType.APPLICATION_JSON)
		//@Consumes(MediaType.APPLICATION_JSON)
	public String addTestCategory()
	{
		JSONObject pJson= new JSONObject();
		try {
			pJson.put("category_IDName", "TC");
			pJson.put("category_Name", "Pathology");
		} 
		catch (JSONException e1) {
			// TODO Auto-generated catch block
			e1.printStackTrace();
		}
		catch (Exception e) {
			System.out.println(e.getMessage());
			return null; 
		}

		try {
			Category cat  =  new Category();
			cat.setCategory_IDName(pJson.get("category_IDName").toString());
			cat.setCategory_Name(pJson.get("category_Name").toString());	
			cDBDriver.insertCategory(cat);
			 
			JSONSerializer jsonSerializer = new JSONSerializer();
			return jsonSerializer.include("category_ID").serialize(cat);
		} catch (Exception e) {
			 System.out.println(e.getMessage());
			return null; 
		}

	}
	
	
	@GET
	@Path("/addTestSubCategory")
	@Produces(MediaType.APPLICATION_JSON)
	@Consumes(MediaType.APPLICATION_JSON)
	public String addTestSubCategory()
	{
		JSONObject pJson= new JSONObject();
		try {
			pJson.put("subCategory_IDName", "STC");
			pJson.put("sub_CategoryName", "Histopathalogy");
			pJson.put("fCategory_ID", "1");
		} 
		//catch (JSONException e1) {
			//TODO Auto-generated catch block
			//e1.printStackTrace();
		//}
		
		catch (Exception e) {
			 System.out.println(e.getMessage());
			 
			return null; 
		}

		

		try {
			SubCategory scat  =  new SubCategory();
			
			int categoryID = pJson.getInt("fCategory_ID");
			
			scat.setSubCategory_IDName(pJson.get("subCategory_IDName").toString());
			scat.setSub_CategoryName(pJson.get("sub_CategoryName").toString());
			
			
			sDBDriver.insertSubCategory(scat, categoryID);
			 
			JSONSerializer jsonSerializer = new JSONSerializer();
			return jsonSerializer.include("sub_CategoryID").serialize(scat);
			//return "success";
		} catch (Exception e) {
			 System.out.println(e.getMessage());
			 
			return null; 
		}

	}
	

		@GET
		@Path("/addTestNewtest")
		@Produces(MediaType.APPLICATION_JSON)
		//@Consumes(MediaType.APPLICATION_JSON)
  public String addTestNewTest()
		{
			JSONObject pJson= new JSONObject();
			try {
				pJson.put("test_IDName", "TN");
				pJson.put("test_Name", "PBC");
				pJson.put("fTest_CategoryID", "1");
				pJson.put("fTest_Sub_CategoryID", "1");
				pJson.put("fTest_CreateUserID", "1");
				pJson.put("test_CreatedDate", "01/01/2014");
				pJson.put("test_LastUpdate", "01/01/2014");
				
			} 
			catch (JSONException e1) {
				// TODO Auto-generated catch block
				e1.printStackTrace();
			}
			catch (Exception e) {
				System.out.println(e.getMessage());
				return null; 
			}

			try {
				TestNames test  =  new TestNames();
				
				int categoryID = pJson.getInt("fTest_CategoryID");
				int subcategoryID = pJson.getInt("fTest_Sub_CategoryID");
				int userid = pJson.getInt("fTest_CreateUserID");
				
				
				test.setTest_IDName(pJson.getString("test_IDName").toString());
				test.setTest_Name(pJson.getString("test_Name").toString());
				test.setTest_CreatedDate(new Date());
				test.setTest_LastUpdate(new Date());
				
				testDBDriver.insertNewTest(test, categoryID, subcategoryID, userid);
				
				 
				JSONSerializer jsonSerializer = new JSONSerializer();
				return jsonSerializer.include("test_ID").serialize(test);
			} catch (Exception e) {
				 System.out.println(e.getMessage());
				 
				return null; 
			}

		}
	
		
		@GET
		@Path("/addTestRange")
		@Produces(MediaType.APPLICATION_JSON)
		//@Consumes(MediaType.APPLICATION_JSON)
		public String addTestRanges()

		{
			try {
				//JSONArray data = obj.getJSONArray("ranges");
				//Set<TestFieldsRange> RangeList = new HashSet<TestFieldsRange>();
				//for (int curr = 0; curr < data.length(); curr++){
					TestFieldsRange ra = new TestFieldsRange();
					ra.setGender("Male");
					ra.setMinage(34);
					ra.setMaxage(66);
					ra.setUnit("uml");
					ra.setMinVal(24);
					ra.setMaxVal(34);
					ra.setFparentfield_ID(parentfieldDBDriver.getParentFieldByID(1));
					ra.setFsubfield_ID(subtestfieldsDBDriver.getSubTestFieldByID(1));
					
					//RangeList.add(ra);
				//} 
					
				
				//for (TestFieldsRange ra : RangeList) {
					rangeDBDriver.addNewRange(ra);
				//}*/
				
			 /*catch (JSONException e) {
				e.printStackTrace();
				return null; */
			}     	        
			catch (Exception e) {
				System.out.println(e.getMessage());
				return null; 
			}
			return "TRUE";
		}


		@GET
		@Path("/addTestLabDepartment")
		@Produces(MediaType.APPLICATION_JSON)
		//@Consumes(MediaType.APPLICATION_JSON)
		public String addLabDepartment()
		{
			JSONObject pJson= new JSONObject();
			try {
				pJson.put("labDept_Name", "Biochemistry");
				
			} 
			catch (JSONException e1) {
				// TODO Auto-generated catch block
				e1.printStackTrace();
			}
			catch (Exception e) {
				System.out.println(e.getMessage());
				return null; 
			}

			try {
				LabDepartments dType  =  new LabDepartments();
				
				
				dType.setLabDept_Name(pJson.getString("labDept_Name").toString());
				ldDBDriver.insertNewLabDepartment(dType);
				
				
				
				
				JSONSerializer jsonSerializer = new JSONSerializer();
				return jsonSerializer.include("labDept_ID").serialize(dType);
			} catch (Exception e) {
				 System.out.println(e.getMessage());
				return null; 
			}

		}


		@GET
		@Path("/addTestNewLaboratory")
		@Produces(MediaType.APPLICATION_JSON)
		//@Consumes(MediaType.APPLICATION_JSON)
		public String addNewLaboratory()
		{
			JSONObject pJson= new JSONObject();
			try {
				pJson.put("lab_Name", "Asiri-SampleCollectionCenter");
				pJson.put("flabType_ID", "1");
				pJson.put("flabDept_ID", "1");
				pJson.put("lab_Dept_Count", "1");
				pJson.put("flab_AddedUserID", "1");
				pJson.put("lab_Incharge", "Nirmali");
				pJson.put("location", "Malabe");
				pJson.put("contactNumber1", "011223456");
				pJson.put("contactNumber2", "011223457");
				pJson.put("email", "asiriSampleCollectionCenter@asirilaboratories.com");
				
			} 
			catch (JSONException e1) {
				// TODO Auto-generated catch block
				e1.printStackTrace();
			}
			catch (Exception e) {
				System.out.println(e.getMessage());
				return null; 
			}

			try {
				Laboratories labs  =  new Laboratories();
				
				int labTypeID = pJson.getInt("flabType_ID");
				int labDeptID = pJson.getInt("flabDept_ID");
			
				int labDeptCount = pJson.getInt("lab_Dept_Count");
				int userid = pJson.getInt("flab_AddedUserID");
				
				
				labs.setLab_Name(pJson.getString("lab_Name").toString());
				labs.setLab_Incharge(pJson.getString("lab_Incharge").toString());
				labs.setLocation(pJson.getString("location").toString());
				labs.setEmail(pJson.getString("email").toString());
				labs.setContactNumber1(pJson.getString("contactNumber1").toString());
				labs.setContactNumber2(pJson.getString("contactNumber2").toString());
				labs.setLab_Dept_Count(labDeptCount);
				labs.setLab_AddedDate(new Date());
				labs.setLab_LastUpdatedDate(new Date());
				
				labDBDriver.insertNewLab(labs, labTypeID, labDeptID, userid);
				
				

				
				JSONSerializer jsonSerializer = new JSONSerializer();
				return jsonSerializer.include("lab_ID").serialize(labs);
			} catch (Exception e) {
				 System.out.println(e.getMessage());
				return null; 
			}

		}


		
		@GET
		@Path("/addTestLabTestRequest")
		@Produces(MediaType.APPLICATION_JSON)
		//@Consumes(MediaType.APPLICATION_JSON)
		public String addTestLabTestRequest()
		{
			JSONObject pJson= new JSONObject();
			try {
				pJson.put("ftest_ID", "1");
				pJson.put("fpatient_ID", "1");
				pJson.put("flab_ID", "3");
				pJson.put("ftest_RequestPerson", "1");
				pJson.put("comment", "Please test");
				pJson.put("priority", "High");
				pJson.put("status", "Sample");
				
				
			} 
			//catch (JSONException e1) {
				//TODO Auto-generated catch block
				//e1.printStackTrace();
			//}
			
			catch (Exception e) {
				 System.out.println(e.getMessage());
				 
				return null; 
			}

			

			try {
				LabTestRequest testRequest = new LabTestRequest();
				
				int testID = pJson.getInt("ftest_ID");
				int patientID = pJson.getInt("fpatient_ID");
				int labID = pJson.getInt("flab_ID");
				int userid = pJson.getInt("ftest_RequestPerson");

				testRequest.setComment(pJson.getString("comment").toString());
				testRequest.setPriority(pJson.getString("priority").toString());
				testRequest.setStatus(pJson.getString("status").toString());
				testRequest.setTest_RequestDate(new Date());
				testRequest.setTest_DueDate(new Date());
				
				
				requestDBDriver.addNewLabTestRequest(testRequest, testID, patientID, labID, userid);
				
				 
				JSONSerializer jsonSerializer = new JSONSerializer();
				return jsonSerializer.include("labTestRequest_ID").serialize(testRequest);
			} catch (Exception e) {
				 System.out.println(e.getMessage());
				 
				return null; 
			}

		}

		@GET
		@Path("/addTestLabType")
		@Produces(MediaType.APPLICATION_JSON)
		//@Consumes(MediaType.APPLICATION_JSON)
		public String addLabType()
		{
			JSONObject pJson= new JSONObject();
			try {
				pJson.put("lab_Type_Name", "Franchized");
				
			} 
			catch (JSONException e1) {
				// TODO Auto-generated catch block
				e1.printStackTrace();
			}
			catch (Exception e) {
				System.out.println(e.getMessage());
				return null; 
			}

			try {
				LabTypes lType  =  new LabTypes();
				
				lType.setLab_Type_Name(pJson.getString("lab_Type_Name").toString());
				ltDBDriver.insertNewLabType(lType);
				
				
				JSONSerializer jsonSerializer = new JSONSerializer();
				return jsonSerializer.include("labType_ID").serialize(lType);
			} catch (Exception e) {
				 System.out.println(e.getMessage());
				return null; 
			}

		}
		
		
		
		@GET
		@Path("/addTestMainTestResultsField")
		@Produces("text/plain")
		//@Consumes(MediaType.APPLICATION_JSON)
		public String addNewParentField()
		{
			try {
				//JSONArray data = obj.getJSONArray("subfields");
				//Set<SubTestFields> SubFieldList = new HashSet<SubTestFields>();
				//for (int curr = 0; curr < data.length(); curr++){
					MainResults mf = new MainResults();				
					mf.setfParentF_ID(pDBDriver.getParentFieldByID(1));
					mf.setMainResult("50");
					mf.setfTestRequest_ID(lrDBDriver.getTestRequestByID(2));
					mf.setResult_FinalizedDate(new Date());
				
					//sf.setfTest_RangeID(testFieldsRangeDBDriver.getTestFieldRangeByID(1));
				
					//SubFieldList.add(sf);
				
		       // } 
				
				//for (SubTestFields sf : SubFieldList) {
					mrDBDriver.addMainResults(mf);
				//}
				
			} /*catch (JSONException e) {
				e.printStackTrace();
				return null; 
			}   */  	        
			catch (Exception e) {
				System.out.println(e.getMessage());
				return null; 
			}
			return "TRUE";
		}

		@GET
		@Path("/addTestParentTestField")
		@Produces("text/plain")
		//@Consumes(MediaType.APPLICATION_JSON)
		public String addTestParentField()
		{
			try {
				
					ParentTestFields pf = new ParentTestFields();
					pf.setParentField_IDName("PF");
					pf.setParent_FieldName("WBC");
					pf.setfTest_NameID(testNamesDBDriver.getTestNameByID(1));
					
					parentfieldDBDriver.addNewParentTestField(pf);
				
				
			} 
			    	        
	catch (Exception e) {
		System.out.println(e.getMessage());
		return null; 
	}
	return "TRUE";
		}

		@GET
		@Path("/addPcuLabTestRequestTest")
		@Produces(MediaType.APPLICATION_JSON)
		//@Consumes(MediaType.APPLICATION_JSON)
		public String addPcuLabTestRequestTest()
		{
			JSONObject pJson= new JSONObject();
			try {
				pJson.put("ftest_ID", "1");
				pJson.put("flab_ID", "3");
				pJson.put("comment", "Please test");
				pJson.put("priority", "High");
				pJson.put("status", "Sample");
				pJson.put("ftest_RequestPerson", "1");
				pJson.put("admintionID", "1");

			} 
			
			
			catch (Exception e) {
				 System.out.println(e.getMessage());
				 
				return null; 
			}
			try {
			
				PcuLabTestRequest request = new PcuLabTestRequest();
				int testID = pJson.getInt("ftest_ID");
				int labID = pJson.getInt("flab_ID");
				int admissionID = pJson.getInt("admintionID");
				int userid = pJson.getInt("ftest_RequestPerson");
			
				request.setComment(pJson.getString("comment").toString());
				request.setPriority(pJson.getString("priority").toString());
				request.setStatus(pJson.getString("status").toString());
				request.setTest_RequestDate(new Date());
				request.setTest_DueDate(new Date());
				requestDBDriver.addNewLabTestRequest(request, testID, admissionID, labID, userid);
				 
				JSONSerializer jsonSerializer = new JSONSerializer();
				return jsonSerializer.include("pcu_lab_test_request_id").serialize(request);
			} catch (Exception e) {
				 System.out.println(e.getMessage());
				 
				return null; 
			}

		}
		
		
		@GET
		@Path("/generateNewReportTest")
		@Produces(MediaType.APPLICATION_JSON)
		//@Consumes(MediaType.APPLICATION_JSON)
		public String GenerateNewReportTest()
		{
			JSONObject pJson= new JSONObject();
			try {
				pJson.put("fPatient_ID", "1");
				pJson.put("fTestRequest_ID", "3");
				pJson.put("issued_Date", "01/01/2014");
			} 
			
			
			catch (Exception e) {
				 System.out.println(e.getMessage());
				 
				return null; 
			}
		try {
				
				Reports report = new Reports();
				
				int patientID = pJson.getInt("fPatient_ID");
				int requestID = pJson.getInt("fTestRequest_ID");
				
				
				report.setIssued_Date(new Date());
			
		
				
				reportDBDriver.GenerateNewReport(report, patientID, requestID);
				
				JSONSerializer jsonSerializer = new JSONSerializer();
				return jsonSerializer.include("report_ID").serialize(report);
			
			} catch (Exception e) {
				 System.out.println(e.getMessage());
				 
				return null; 
			}

		}

		@GET
		@Path("/addNewTestSampleCenter")
		@Produces(MediaType.APPLICATION_JSON)
		//@Consumes(MediaType.APPLICATION_JSON)
		public String addNewSampleCenter()
		{
			JSONObject pJson= new JSONObject();
			try {
				pJson.put("sampleCenter_Name", "Asiri-SampleCollectionCenter");
				pJson.put("fSampleCenterType_ID", "1");
			
				pJson.put("fSampleCenter_AddedUserID", "1");
				pJson.put("sampleCenter_Incharge", "Nirmali");
				pJson.put("location", "Malabe");
				pJson.put("contactNumber1", "011223456");
				pJson.put("contactNumber2", "011223457");
				pJson.put("email", "asiriSampleCollectionCenter@asirilaboratories.com");
				
			} 
			catch (JSONException e1) {
				// TODO Auto-generated catch block
				e1.printStackTrace();
			}
			catch (Exception e) {
				System.out.println(e.getMessage());
				return null; 
			}

			try {
				
				
				
				SampleCenters samplecenter  =  new SampleCenters();
				
				int sampleCenterTypeID = pJson.getInt("fSampleCenterType_ID");
				
				int userid = pJson.getInt("fSampleCenter_AddedUserID");
				//int userid = pJson.getInt("fSampleCenter_AddedUserID");
				
				
				samplecenter.setSampleCenter_Name(pJson.getString("sampleCenter_Name").toString());
				samplecenter.setSampleCenter_Incharge(pJson.getString("sampleCenter_Incharge").toString());
				samplecenter.setLocation(pJson.getString("location").toString());
				samplecenter.setEmail(pJson.getString("email").toString());
				samplecenter.setContactNumber1(pJson.getString("contactNumber1").toString());
				samplecenter.setContactNumber2(pJson.getString("contactNumber2").toString());
				samplecenter.setSampleCenter_AddedDate(new Date());
				samplecenter.setSampleCenter_LastUpdatedDate(new Date());
			
				
				
				
				samplecenterDBDriver.insertNewSampleCenter(samplecenter, sampleCenterTypeID, userid);
				

				
				JSONSerializer jsonSerializer = new JSONSerializer();
				return jsonSerializer.include("sampleCenter_ID").serialize(samplecenter);
			} catch (Exception e) {
				 System.out.println(e.getMessage());
				return null; 
			}

		}

		@GET
		@Path("/addSampleCenterType")
		@Produces(MediaType.APPLICATION_JSON)
		//@Consumes(MediaType.APPLICATION_JSON)
		public String addSampleCenterType()
		{
			JSONObject pJson= new JSONObject();
			try {
				pJson.put("sample_Center_TypeName", "Regional");
				
			} 
			catch (JSONException e1) {
				// TODO Auto-generated catch block
				e1.printStackTrace();
			}
			catch (Exception e) {
				System.out.println(e.getMessage());
				return null; 
			}

			try {
				SampleCenterTypes scType  =  new SampleCenterTypes();
				
				scType.setSample_Center_TypeName(pJson.getString("sample_Center_TypeName").toString());
				scDBDriver.insertNewSampleCenterType(scType);
				JSONSerializer jsonSerializer = new JSONSerializer();
				return jsonSerializer.include("sampleCenterType_ID").serialize(scType);
			} catch (Exception e) {
				 System.out.println(e.getMessage());
				return null; 
			}

		}


		@GET
		@Path("/addTestSpecimenRetentionType")
		@Produces(MediaType.APPLICATION_JSON)
		
		public String addSpecimenRetentionType()
		{
			JSONObject pJson= new JSONObject();
			try {
				pJson.put("retention_TypeName", "XXX");
				pJson.put("fCategory_ID", "1");
				pJson.put("fSub_CategryID", "1");
				pJson.put("duration","5");
			} 
			catch (JSONException e1) {
				// TODO Auto-generated catch block
				e1.printStackTrace();
			}
			catch (Exception e) {
				System.out.println(e.getMessage());
				return null; 
			}

			try {
				SpecimenRetentionType srtype  =  new SpecimenRetentionType();
				
				int categoryID = pJson.getInt("fCategory_ID");
				int subcategoryID = pJson.getInt("fSub_CategryID");
				
				srtype.setRetention_TypeName(pJson.getString("retention_TypeName").toString());
				srtype.setDuration(pJson.getString("duration").toString());
				
				srtDBDriver.insertSpecimenRetentionType(srtype, categoryID, subcategoryID);
			
						 
				JSONSerializer jsonSerializer = new JSONSerializer();
				return jsonSerializer.include("retention_TypeID").serialize(srtype);
			} catch (Exception e) {
				 System.out.println(e.getMessage());
				 
				return null; 
			}

		}

		@GET
		@Path("/addTestSpecimenType")
		@Produces(MediaType.APPLICATION_JSON)
		
		public String addSpecimenType()
		{
			JSONObject pJson= new JSONObject();
			try {
				pJson.put("specimen_TypeName", "TestType");
				pJson.put("fCategry_ID", "1");
				pJson.put("fSub_CategoryID", "1");
			} 
			catch (JSONException e1) {
				// TODO Auto-generated catch block
				e1.printStackTrace();
			}
			catch (Exception e) {
				System.out.println(e.getMessage());
				return null; 
			}

			try {
				SpecimenType stype  =  new SpecimenType();
				
				int categoryID = pJson.getInt("fCategry_ID");
				int subcategoryID = pJson.getInt("fSub_CategoryID");
				
				stype.setSpecimen_TypeName(pJson.getString("specimen_TypeName").toString());
				
					stDBDriver.insertSpecimenType(stype, categoryID, subcategoryID);		 
				JSONSerializer jsonSerializer = new JSONSerializer();
				return jsonSerializer.include("specimenType_ID").serialize(stype);
			} catch (Exception e) {
				 System.out.println(e.getMessage());
				 
				return null; 
			}

		}
		@GET
		@Path("/addTestSubTestField")
		@Produces("text/plain")
		//@Consumes(MediaType.APPLICATION_JSON)
		public String addNewTestSubTestField()
		{
			try {
				//JSONArray data = obj.getJSONArray("subfields");
				//Set<SubTestFields> SubFieldList = new HashSet<SubTestFields>();
				//for (int curr = 0; curr < data.length(); curr++){
					SubTestFields sf = new SubTestFields();
					sf.setSubField_IDName("SF");
					sf.setSubtest_FieldName("NEU");
					//sf.setfTest_RangeID(testFieldsRangeDBDriver.getTestFieldRangeByID(1));
					sf.setfPar_Test_FieldID(parentfieldDBDriver.getParentFieldByID(5));			
					//SubFieldList.add(sf);
				
		       // } 
				
				//for (SubTestFields sf : SubFieldList) {
					subtestfieldsDBDriver.addNewSubTestField(sf);
				//}
				
			} /*catch (JSONException e) {
				e.printStackTrace();
				return null; 
			}   */  	        
			catch (Exception e) {
				System.out.println(e.getMessage());
				return null; 
			}
			return "TRUE";
		}
		
		@GET
		@Path("/addTestSubTestResultsField")
		@Produces("text/plain")
		//@Consumes(MediaType.APPLICATION_JSON)
		public String addSubTestFieldResults()
		{
			try {
				//JSONArray data = obj.getJSONArray("subfields");
				//Set<SubTestFields> SubFieldList = new HashSet<SubTestFields>();
				//for (int curr = 0; curr < data.length(); curr++){
					SubFieldResults sf = new SubFieldResults();
					sf.setfMResultID(mainresultDBDriver.getMainResultsByID(1));
					sf.setfSubF_ID(subtestfieldDBDriver.getSubTestFieldByID(1));
					sf.setfParentF_ID(parentfieldDBDriver.getParentFieldByID(1));
					sf.setSubFieldResult("25");
					sf.setResult_FinalizedDate(new Date());
					//sf.setfTest_RangeID(testFieldsRangeDBDriver.getTestFieldRangeByID(1));
				
					//SubFieldList.add(sf);
				
		       // } 
				
				//for (SubTestFields sf : SubFieldList) {
					subtestfieldresultsDBDriver.addNewSubTestFieldResults(sf);
				//}
				
			} /*catch (JSONException e) {
				e.printStackTrace();
				return null; 
			}   */  	        
			catch (Exception e) {
				System.out.println(e.getMessage());
				return null; 
			}
			return "TRUE";
		}



}
