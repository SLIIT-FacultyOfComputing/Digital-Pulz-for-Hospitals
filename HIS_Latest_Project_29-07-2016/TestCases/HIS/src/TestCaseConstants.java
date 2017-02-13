/**
 * This class is for TestNG Integration Test cases related to all
 * Constants developed by Udara Samaratunge.
 * 
 * @author udara.s
 * 
 */
public class TestCaseConstants {
	
	
	public static final String CONTENT_TYPE = "Content-Type";
	
	public static final String JSON = "application/json";
	
	public static final String CONFIG_FILE = "config.properties";
	
	public static final String REQUEST_FILE_PATH = "src/request/RestPostRequests.xml"; 
	
	public static final String HTTP_GET = "GET";
	
	public static final String HTTP_POST = "POST";
	
	public static final String HTTP_PUT = "PUT";
	
	public static final String HTTP_DELETE = "DELETE";
	
	public static final String BASE_URL = "baseUrl";
	
	public static final String URL_APPEND_LAB = "labUrl";
	
	public static final String LAB_TYPE_URL = "getLabByTypeUrl";
	
	public static final String LAB_DELETE_URL = "labDeleteUrl";
	
	public static final String ADD_NEW_LAB = "addNewLab";
	
	public static final String URL_APPEND_ADD_NEW_LAB = "addNewLabUrl";
	
	public static final String URL_APPEND_UPDATE_LAB = "updateLabUrl";
	
	public static final String UPDATE_LAB = "updateLab";
	
	public static final String UPDATE_LAB_NAME = "updateLab.labName";
	
	public static final String ADD_LAB_NAME = "addLab.labName";
	
	public static final String LAB_INCHARGE = "updateLab.labIncharge";
	
	public static final String LAB_CONTACT_NUMBER = "updateLab.contactNumber1";
	
	/*vishva*/
	public static final String NEW_LAB_TEST_REQUEST = "addNewLabTestRequest";
	public static final String GET_ALL_TEST_REQUESTS = "alllabtests";
	public static final String TEST_TYPE_URL = "getTestTypeUrl";
	public static final String GET_ALL_SPECIMEN_TYPES = "getAllSpecimenTypes";
	public static final String GET_ALL_SPECIMEN_RETENTION_TYPES = "getAllSpecimenRetentionTypes";
	public static final String ADD_NEW_SPECIMEN_INFO = "addNewSpecimenInfo";

	/*udesh.c*/

	/*LAB TYPE*/
	public static final String ADD_LAB_TYPE = "addNewLabType";
	
	public static final String UPDATE_LAB_TYPE = "updateLabType";
	
	public static final String URL_APPEND_ADD_LAB_TYPE = "addLabTypeUrl";
	
	public static final String URL_APPEND_UPDATE_LAB_TYPE = "updateLabTypeUrl";
	
	public static final String URL_APPEND_DELETE_LAB_TYPE = "deleteLabTypeUrl";
	
	public static final String UPDATE_LAB_TYPE_NAME = "updateLabType.labTypeName";
	
	public static final String ADD_LAB_TYPE_NAME = "addLabType.labTypeName";
	
	
	/*Lab Department*/
	
	public static final String URL_APPEND_ADD_LAB_DEPARTMENT = "addLabDepartmentUrl";
	
	public static final String ADD_LAB_DEPARTMENT = "addNewLabDepartment";
	
	public static final String ADD_LAB_DEPARTMENT_NAME = "addLabDept.labDeptName";
	
	public static final String UPDATE_LAB_DEPARTMENT_NAME = "updateLabDept.labName";
	
	public static final String UPDATE_LAB_DEPARTMENT = "updateLabDepartment";
	
	public static final String URL_APPEND_UPDATE_LAB_DEPARTMENT = "updateLabDepartmentUrl";
	
	public static final String URL_APPEND_DELETE_LAB_DEPARTMENT = "deleteLabDepartmentUrl";
	
	public static final String URL_APPEND_ALL_LAB_DEPARTMENTS = "getAllLabDepartmentUrl";
	
	
	/*Lab Test*/
	public static final String URL_APPEND_ADD_TEST="addTestUrl";
	
	public static final String ADD_TEST="addNewTest";
	
	public static final String ADD_TEST_NAME="addTestName";
	
	public static final String URL_APPEND_DELETE_TEST = "deleteTestUrl";
	
	public static final String URL_APPEND_LAB_TESTS = "allLabTestsUrl";
	
	public static final String TEST_CAT_NAME="testCatName";
	
	public static final String URL_APPEND_MAX_TEST_ID="maxTestIDUrl";
	
	public static final String UPDATE_TEST_NAME="updateTest.testName";
	
	public static final String UPDATE_TEST="updateTest";
	
	public static final String URL_APPEND_UPDATE_TEST = "updateTest";
	

	/*nisal.d*/
	/*Main Result Constants*/
	
	public static final String URL_APPEND_ADD_MAIN_RESULTS = "addMainResults";
	
	public static final String URL_APPEND_GET_ALL_MAIN_RESULTS = "getAllMainReslts";
	
	public static final String URL_APPEND_GET_ALL_MAIN_SUB_CATEGORIES = "getAllMainSubCategories";
	
	public static final String SUB_CATEGORIES = "SubCategories.reqID";
	
	public static final String SUB_CATEGORIES_MAINRESULT = "Subcategories.mainresult";

	
	/*nisal.d*/
	/*Category Constants*/
	
	public static final String URL_APPEND_ADD_CATEGORY = "addCategory";
	
	public static final String URL_APPEND_GET_ALL_CATEGORY = "getAllCategories";
	
	public static final String URL_APPEND_DELETE_CATEGORY = "deleteCategory";
	
	public static final String URL_APPEND_UPDATE_CATEGORY = "updateCategory";
	
	public static final String CATEGORY_NAME= "addCategory.category";
	
	public static final String UPDATE_CATEGORY_NAME= "updateCategory.category";
	
	/*nisal.d*/
	/*SubCategory Constants*/
	
	public static final String URL_APPEND_GET_ALL_SUBCATEGORY = "getAllSubCategories";
	
	public static final String URL_APPEND_GET_ALL_SUBCATEGORY_BY_ID = "getAllSubCategoriesByCatId";
	
	public static final String URL_APPEND_DELETE_SUBCATEGORY = "deleteSubCategory";
	
	public static final String URL_APPEND_UPDATE_SUBCATEGORY = "updateSubCategory";
	
	public static final String UPDATE_SUBCATEGORY_NAME= "updateSubCategory.Subcategory";
	
	public static final String SUBCATEGORY_NAME= "SubCategory.subcategory";
	
	/*nisal.d*/
	/*Specimen Constants*/
	
	public static final String URL_APPEND_GET_ALL_SPECIMENS = "getAllSpecimens";
	
	public static final String URL_APPEND_GET_ALL_SPECIMENS_BY_ID = "getAllSpecimensByCatId";
	
	/*nisal.d*/
	/*Specimen Retention Constants*/
	
	public static final String URL_APPEND_GET_ALL_SPECIMEN_RETENTION = "getAllSpecimenRetention";
	
	public static final String URL_APPEND_GET_ALL_SPECIMEN_RETENTION_BY_ID = "getAllSpecimenRetentionByCatId";
	
	/*nisal.d*/
	/*SubTestFields Constants*/
	
	public static final String URL_APPEND_ADD_SUBTESTFIELD = "addSubTestField";
	
	public static final String URL_APPEND_GET_ALL_SUBTESTFIELDS = "getAllSubTestField";
	
	public static final String URL_APPEND_GET_MAX_SUBTESTFIELD_ID = "getMaxSubTestFieldID";
	
	public static final String URL_APPEND_GET_TEST_SUB_FIELDS = "getTestSubFields";

	
	/*nisal.d*/
	/*SubTestFieldsResults Constants*/
		
	public static final String URL_APPEND_ADD_SUBTESTFIELD_RESULTS = "addNewSubTestFieldResults";
		
	public static final String URL_APPEND_GET_ALL_SUBTESTFIELDS_RESULTS = "getAllSubTestFieldsResults";

	/*Ayodya*/
	/*Sample Center Constants*/
	public static final String ADD_NEW_SAMPLE_CENTER = "addNewSampleCenter";
	
	public static final String ADD_NEW_SAMPLE_CENTER_INCHARGE = "addNewSampleCenter.sampleCenter_Incharge";
	
	public static final String URL_APPEND_ADD_NEW_SAMPLE_CENTER = "addNewSampleCenterUrl";
	
	public static final String URL_APPEND_GET_ALL_SAMPLE_CENTERS = "getAllSampleCentersUrl";
	
	public static final String URL_APPEND_GET_SAMPLE_CENTERS_BY_LAB_TYPE = "getSampleCentersByLabTypeUrl";
	
	public static final String URL_APPEND_UPDATE_SAMPLE_CENTER = "updateSampleCenterDetailsUrl";
	
	public static final String UPDATE_SAMPLE_CENTER = "updateSampleCenter";
	
	public static final String UPDATE_SAMPLE_CENTER_NAME = "updateSampleCenter.sampleCenterName";
	
	public static final String UPDATE_SAMPLE_CENTER_EMAIL = "updateSampleCenter.email";
	
	public static final String URL_APPEND_DELETE_SAMPLE_CENTER = "deleteSampleCenterUrl";
	
	/*Ayodya*/
	/*Sample Center Type Constants*/
	
	public static final String ADD_NEW_SAMPLE_CENTER_TYPE = "addSampleCenterType";
	
	public static final String URL_APPEND_ADD_SAMPLE_CENTER_TYPE = "addSampleCenterTypeUrl";
	
	public static final String URL_APPEND_GET_ALL_SAMPLE_CENTER_TYPES = "getAllSampleCenterTypesUrl";
	
	public static final String UPDATE_SAMPLE_CENTER_TYPE = "updateSampleCenterType"; 
	
	public static final String URL_APPEND_UPDATE_SAMPLE_CENTER_TYPE = "updateSampleCenterTypeUrl";
	
	public static final String UPDATE_SAMPLE_CENTER_TYPE_NAME = "updateSampleCenterType.sampleCenterTypeName";
	
	public static final String URL_APPEND_DELETE_SAMPLE_CENTER_TYPE = "deleteSampleCenterTypeUrl";
	
	/*Ayodya*/
	/*Lab Test Request Constants*/
	
	public static final String URL_APPEND_ADD_LAB_TEST_REQUEST = "addLabTestRequestUrl";
	
	public static final String ADD_LAB_TEST_REQUEST = "addLabTestRequest";
	
	public static final String URL_APPEND_GET_ALL_LAB_TEST_REQUESTS = "getAllTestRequestUrl";
	
	public static final String URL_APPEND_LAB_TEST_REQUESTS_BY_ID = "getTestRequestByRequestIDUrl";
	
	public static final String URL_APPEND_ADD_PCU_LAB_TEST_REQUEST = "addPcuLabTestRequestUrl";
	
	public static final String ADD_PCU_LAB_TEST_REQUEST = "addPcuLabTestRequest" ;
	
	public static final String URL_APPEND_ADD_SPECIMEN_INFO = "addSpecimenInfoUrl";
	
	public static final String URL_APPEND_GET_SPECIMEN_BY_REQUEST_ID = "getSpecimenByRequestIDUrl";
	
	public static final String URL_APPEND_GET_SPECIMEN_ID_BY_REQUEST_ID = "getSpecimenIdByRequestIDUrl";
	
	public static final String ADD_SPECIMEN_INFO = "addSpecimenInfo";
	
	public static final String URL_APPEND_GET_ALL_SPECIMEN_RET_TYPES = "getAllSpecimenRetTypesUrl";
	
	public static final String URL_APPEND_GET_ALL_SPECIMEN_TYPES = "getAllSpecimenTypesUrl";
	
	public static final String URL_APPEND_LAB_TEST_REQUESTS_BY_PATIENT_ID = "getRequestsByPatientIDUrl";
	
	public static final String LAB_TEST_REQUEST_STATUS = "labTestRequest.status";
	
	public static final String URL_APPEND_SET_LAB_TEST_REQUEST_STATUS = "setLabTestRequestStatusUrl";
		
	/*Yasini.P*/
	/*Lab Test Field Range Constants*/

	public static final String ADD_LAB_RANGE = "addNewLabRange";

	public static final String URL_APPEND_ADD_NEW_LAB_RANGE = "addNewLabRangeUrl";

	public static final String ADD_LAB_RANGE_GENDER = "addLabRange.labRangeGender";

	public static final String ADD_LAB_RANGE_MINAGE = "addLabRange.labRangeMinage";

	public static final String ADD_LAB_RANGE_UNIT = "addLabRange.labRangeUnit";

	public static final String ADD_LAB_RANGE_MINVAL = "addLabRange.labRangeMinVal";

	public static final String ADD_LAB_RANGE_MAXVAL = "addLabRange.labRangeMaxVal";

	public static final String ADD_LAB_RANGE_MAXAGE = "addLabRange.labRangeMaxage";

	public static final String ADD_LAB_SUB_RANGE = "addNewLabSubRange";

	public static final String URL_APPEND_ADD_NEW_LAB_SUB_RANGE = "addNewLabSubRangeUrl";

	public static final String ADD_LAB_SUB_RANGE_GENDER = "addLabSubRange.labSubRangeGender";

	public static final String ADD_LAB_SUB_RANGE_MINAGE = "addLabSubRange.labSubRangeMinage";

	public static final String ADD_LAB_SUB_RANGE_UNIT = "addLabSubRange.labSubRangeUnit";

	public static final String ADD_LAB_SUB_RANGE_MINVAL = "addLabSubRange.labSubRangeMinVal";

	public static final String ADD_LAB_SUB_RANGE_MAXVAL = "addLabSubRange.labSubRangeMaxVal";

	public static final String ADD_LAB_SUB_RANGE_MAXAGE = "addLabSubRange.labSubRangeMaxage";

	public static final String URL_APPEND_LAB_RANGE = "labRnageUrl";
	
	/*Yasini.P*/
	/*Parent Test Field  Constants*/

	public static final String URL_APPEND_ADD_LAB_PARENT = "addNewLabParentUrl";

	public static final String ADD_LAB_PARENT = "addNewLabParent";

	public static final String ADD_LAB_PARENT_NAME = "addLabParent.labParentName";

	public static final String ADD_LAB_PARENT_ID_NAME = "addLabParent.labParentIDName";

	public static final String ADD_LAB_PARENT_TEST_ID = "addLabParent.labParentTestID";

	public static final String URL_APPEND_LAB_PARENT = "labParentUrl";

	public static final String URL_APPEND_LAB_PARENT_BY_ID = "labParentByIdUrl";

	public static final String URL_APPEND_LAB_PARENT_MAX = "labParentMaxUrl";
	
	
	/* yasini.p */
	/* Sub Test Fields Results */

	public static final String URL_APPEND_ADD_NEW_LAB_SUB_RESULTS = "addNewLabSubResultsUrl";

	public static final String ADD_NEW_LAB_SUB_RESULTS = "addNewLabSubResults";
	
	public static final String LAB_SUB_RESULT_URL="getAllSubFieldsResults";

	
	/*nisal.d*/
	/*Lab Test Request Filter Constants*/
	
	public static final String URL_APPEND_GET_ALL_PATIENTS_TYPES = "getAllPatientsUrlFilter";
	
	public static final String URL_APPEND_GET_ALL_PATIENTS_BY_ID = "getRequestsByPatientIdURL";
	
	public static final String URL_APPEND_GET_ALL_PATIENTS_BY_LOCATION = "getAllLabTestRequestByLabLocationIdURL";
	
	public static final String LAB_TEST_REQUEST_COMMENT = "labTestRequestFilter.comment";
	
	public static final String LAB_TEST_REQUEST_ID = "labTestRequestFilter.labTestRequestID";
	
	/*nisal.d*/
	/*Report Constants*/
	
	public static final String URL_APPEND_GENERATE_NEW_REPORT = "generateNewReport";
	
	public static final String URL_APPEND_GET_ALL_REPORTS = "getAllReports";
	
	public static final String REPORT_ID = "Report.ReportId";
	
	/*rubika.m*/
	/*OPD Lab Test Requests*/
	
	public static final String URL_APPEND_ADD_OPD_LAB_REQUEST="addOPDLabTestRequestUrl";
	
	public static final String ADD_OPD_LAB_REQUEST="addOPDLabTestRequest";
	
	public static final String URL_APPEND_ALL_OPD_LAB_REQUESTS="getAllOPDLabRequests";
	
	public static final String URL_APPEND_GET_OPD_Lab_Requests_By_Patient="getOPDLabRequestByIPatient";
	
	public static final String UPDATE_OPD_LAB_REQUESTS="updateOPDLabTestRequests";

	public static final String URL_APPEND_UPDATE_OPD_LAB_REQUESTS="updateOPDLabRequestUrl";

	public static final String URL_APPEND_GET_OPD_Lab_Requests_By_Visit="getOPDLabRequestByVisit";
	
	public static final String URL_APPEND_DELETE_LAB_OPD_REQUESTS_URL="deleteOPDLabRequestURL";

	/*rubika.m*/
	/*PCU Lab Requests*/
	
	public static final String URL_APPEND_ADD_PCU_REQUEST="addPCURequestUrl";
	
	public static final String ADD_PCU_REQUEST="addPCURequest";

	public static final String URL_APPEND_GET_ALL_PCU_REQUESTS="getAllPCURequests";

	public static final String URL_APPEND_GET_PCU_LABS_BY_REQUEST_ID="getPCULabRequestsByID";

	public static final String URL_APPEND_GET_PCU_LABS_BY_PATIENT_ID="getPCULabsByPatientUrl";

	public static final String UPDATE_PCU_LAB_REQUESTS="updatePCURequest";

	public static final String URL_APPEND_UPDATE_PCU_LAB_REQUEST="updatePCURequestUrl";

	public static final String URL_APPEND_DELETE_LAB_PUC_REQUESTS_URL="deletePUCLabRequestUrl";

	public static final String URL_APPEND_GET_PCU_LABS_BY_ADMIN_ID="getPCULabRequestByAdminUrl";
	
	//------------------------------------OPD--------------------------------------------
	
	/*nisal.d*/
	/*allergy*/
	
	public static final String URL_APPEND_ADD_ALLERGY = "addAllergyUrl";
	
	public static final String URL_APPEND_UPDATE_ALLERGY = "updateAllergyUrl";
	
	public static final String UPDATE_ALLERGY_ACTIVE = "updateAllery.active";
			
	public static final String URL_APPEND_GET_ALLERGY_BY_PATIENT = "getAllergyByPatientUrl";
	
	public static final String URL_APPEND_GET_ALLERGY_BY_ID = "getAllergyByAllergyIdUrl";

	/*nisal.d*/
	/*Exams*/
	
	public static final String URL_APPEND_ADD_EXAMS = "addExamsUrl";
		
	public static final String URL_APPEND_UPDATE_EXAMS = "updateExamsUrl";
		
	public static final String UPDATE_EXAMS_ACTIVE = "updateExams.active";
				
	public static final String URL_APPEND_GET_EXAMS_BY_VISITS = "getExamsByVisitsUrl";
		
	public static final String URL_APPEND_GET_EXAMS_BY_ID = "getExamsByExamsIdUrl";

	/*nisal.d*/
	/*Outpatient*/
		
	public static final String URL_APPEND_ADD_PATIENT = "addpatientUrl";
	
	public static final String URL_APPEND_UPDATE_PATIENT = "updatePatientUrl";
		
	public static final String URL_APPEND_GET_PATIENT_BY_VISITS_USERS = "getPatientByUserIdVisitTypeUrl";
		
	public static final String URL_APPEND_GET_PATIENT_BY_ID = "getPatientsByPatientId";

	public static final String URL_APPEND_GET_ALL_PATIENTS = "getAllPatientsUrl";
			
	public static final String URL_APPEND_GET_MAX_PATIENT_ID = "getMaxPatientIdUrl";
			
	public static final String URL_APPEND_GET_PATIENT_FOR_DOCTOR = "getPatientForDoctorUrl";
	
	public static final String OUTPATIENT_USER_ID = "outpatient.userId";
			
	public static final String OUTPATIENT_VISIT_TYPE = "outpatient.visitType";

	/*nisal.d*/
	/*Hin*/
	
	public static final String URL_APPEND_GET_SERIAL_NO_FOR_HIN = "serialNumberForHin";
	
	public static final String URL_APPEND_GET_GENERATE_CHECK_DIGIT = "generateChekDigit";
	
	/*nisal.d*/
	/*Prescription*/
	
	public static final String URL_APPEND_ADD_PRESCRIPTION = "addPerscriptionUrl";
	
	public static final String URL_APPEND_UPDATE_PRESCRIPTION = "updatePrescriptionUrl";

	public static final String URL_APPEND_GET_PRESCRIPTION_PRES_ID = "getPrescriptionByPresIdUrl";
	
	public static final String URL_APPEND_GET_PRESCRIPTION_BY_PATIENT_ID = "getPrescriptionByPatientId";
	
	public static final String URL_APPEND_GET_PRESCRIPTION_BY_PID_AFTER_PRESCRIBE = "getPrescriptionByPatientIdAfterPrescribe";
	
	public static final String URL_APPEND_GET_PRESCIPTION_BY_PID_AFTER_DETAILS = "getPrescriptionByPatientIdAfterPrescribeDetails";

	public static final String PRESCRIPTION_USER_ID = "prescription.userid";
	
	public static final String PRESCRIPTIION_VISIT_ID = "prescription.visitid";
	
	public static final String PRESCRIPTION_PATIENT_ID = "prescription.pid";
	
	/*yasini.p*/
	/*OPD*/
	public static final String URL_APPEND_ADD_NEW_LAB_OPD = "labOPDUrl";

	public static final String ADD_NEW_LAB_OPD = "addNewOPD";
	
	public static final String ADD_LAB_OPD_COMMENT="addNewOPD.opdComment";
	
	public static final String ADD_LAB_OPD_PRIORITY="addNewOPD.opdPriority";
	
	public static final String ADD_LAB_OPD_STATUS="addNewOPD.opdStatus";
	
	
	/*yasini.p*/
	/*OPD - LiveSearch*/
	
	public static final String URL_APPEND_OPD_ALLERGY = "getAllAllergyLiveUrl";
	
	public static final String URL_APPEND_OPD_INJURY = "getAllInjuryLiveUrl";
	
	/*yasini.p*/
	/*OPD - attachment*/
	
	public static final String URL_APPEND_OPD_ADD_ATTACHMENT ="addAttachmentUrl";
	
	public static final String OPD_ADD_ATTACHMENT = "addAttachment";
	
	public static final String UPDATE_OPD_ATTACHMENT = "updateAttachment";
	
	public static final String UPDATE_OPD_PID = "updateAttachment.pid";
	
	public static final String UPDATE_OPD_FILETYPE = "updateAttachment.filetype";
	
	public static final String UPDATE_OPD_USERID = "updateAttachment.userid";
	
	public static final String UPDATE_OPD_REMARKS = "updateAttachment.remarks";
	
	public static final String UPDATE_OPD_ATTACHNAME = "updateAttachment.attachname";
	
	public static final String UPDATE_OPD_FILEPATH = "updateAttachment.filepath";
	
	public static final String URL_APPEND_UPDATE_OPD_ATTACH = "updateAttachmentUrl";
	
	public static final String URL_APPEND_GET_OPD_BY_ATTCHID = "getOpdByAttchid";
	
	public static final String URL_APPEND_GET_OPD_BY_PID = "getOpdByPid";
	
	
	/*yasini.p*/
	/*OPD - Questionnaire*/
	
	public static final String URL_APPEND_OPD_ADD_QUESTIONNAIRE = "addQuestionnaireUrl";
	
	public static final String OPD_ADD_QUESTIONNAIRE = "addQuestionnaire";
	
	public static final String URL_APPEND_OPD_GET_QUESTIONNAIRE= "getAllQuestionnaireUrl";
	
	public static final String URL_APPEND_OPD_GET_QUESTIONNAIRE_BY_QID = "getQuestionnaireByQidUrl";
	
	public static final String URL_APPEND_UPDATE_OPD_QUESTIONNAIRE = "updateQuestionnaireUrl";
	
	public static final String UPDATE_OPD_QUESTIONNAIRE = "updateQuestionnaire";
	
	public static final String URL_APPEND_GET_OPD_QUESTION_BY_QID =  "getQuestionByQidUrl";
	
	public static final String URL_APPEND_GET_OPD_QUESTIONNAIRE_BY_VISITTYPE = "getQuestionnaireByVisitTypeUrl";
	
	public static final String URL_APPEND_SAVE_OPD_QUESTIONANSWER = "saveQuestionAnswerUrl";
	
	public static final String SAVE_OPD_QUESTION_ANSWER = "saveQuestionAnswer";
	
	public static final String URL_APPEND_UPDATE_OPD_QUESTION_ANSWER = "updateQuestionAnswerUrl";
	
	public static final String UPDATE_OPD_QUESTION_ANSWER = "updateQuestionAnswer";
	
	public static final String URL_APPEND_GET_OPD_ANSWER = "getAnswerUrl";

	public static final String QUESTIONNAIRE_USER_ID = "Questionnaire.UserId";
	
	public static final String QUESTION_QUESTION_ID = "Question.QuestionId";
	
	public static final String QUESTIONANSWER_VISIT_ID = "QuestionAnswer.VisitId";
	
	public static final String QUESTIONANSWER_ANSWERSET_ID ="QuestionAnswer.AnswerSetId";
	
	public static final String QUESTIONANSWER_PATIENT_ID ="QuestionAnswer.PatientId";

	/*yasini.p*/
	/*OPD - Record*/
	
	public static final String URL_APPEND_ADD_OPD_RECORD = "addRecordUrl";
	
	public static final String ADD_OPD_RECORD = "addRecord";
	
	public static final String URL_APPEND_UPDATE_OPD_RECORD = "updateRecordUrl";
	
	public static final String UPDATE_OPD_RECORD = "updateRecord";
	
	public static final String UPDATE_OPD_PATIENTID = "updateRecord.parentid";
	
	public static final String UPDATE_OPD_CREATEUSER = "updateRecord.createuser";
	
	public static final String UPDATE_OPD_RECORDTYPE = "updateRecord.recordtype";
	
	public static final String UPDATE_OPD_VISIBILITY = "updateRecord.visibility";
	
	public static final String UPDATE_OPD_COMPLETED = "updateRecord.completed";
	
	public static final String UPDATE_OPD_TEXT = "updateRecord.text";
	
	public static final String URL_APPEND_OPD_RECORD_BY_PID = "getRecordByPidUrl";
	
	public static final String URL_APPEND_OPD_RECORD_BY_HID = "getRecordByHidUrl";
	
	/*yasini.p*/
	/*OPD - Visit*/
	
	public static final String URL_APPEND_ADD_OPD_VISIT = "addVisitUrl";
	
	public static final String ADD_OPD_VISIT = "addVisit";
	
	public static final String URL_APPEND_UPDATE_OPD_VISIT = "updateVisitUrl";
	
	public static final String UPDATE_OPD_VISIT = "updateVisit";
	
	public static final String UPDATE_OPD_VISITPID = "updateVisit.pid";
	
	public static final String UPDATE_OPD_INJURY = "updateVisit.injury";
	
	public static final String UPDATE_OPD_DOCTOR = "updateVisit.doctor";
	
	public static final String UPDATE_OPD_VISIT_REMARKS = "updateVisit.remarks";
	
	public static final String UPDATE_OPD_TYPE = "updateVisit.type";
	
	public static final String URL_APPEND_OPD_VISIT_BY_PID = "getVisitByPidUrl";
	
	public static final String URL_APPEND_OPD_VISIT_RECENT_BY_PID = "getVisitRecentByPidUrl";
	
	public static final String URL_APPEND_OPD_VISIT_BY_VISITDATE = "getVisitByVisitDate";
	
	public static final String URL_APPEND_OPD_VISIT_FOR_REPORTS= "getVisitForReports";
	
	public static final String URL_APPEND_OPD_VISIT_BY_VISITID = "getVisitByVisitIdUrl";
	
	/*yasini.p*/
	/*OPD - Queue*/
	
	public static final String URL_APPEND_ADD_OPD_QUEUE = "addQueueUrl";
	
	public static final String ADD_OPD_QUEUE = "addQueue";
	
	public static final String URL_APPEND_GET_OPD_CHECKIN_BY_PID = "queueCheckinUrl";
	
	public static final String URL_APPEND_GET_OPD_CHECKOUT_BY_PID = "queueCheckoutUrl";
	
	public static final String URL_APPEND_GET_OPD_QUEUE_BY_UID = "getQueueByUseridUrl";
	
	public static final String URL_APPEND_GET_OPD_PATIENTIN_BY_PID = "getPatientInUrl";
	
	public static final String URL_APPEND_GET_OPD_CURRENTIN_BY_DID = "getCurrentInUrl";
	
	public static final String URL_APPEND_GET_OPD_TREATED_BY_UID = "getTreatedByUseridUrl";
	
	public static final String URL_APPEND_OPD_REDIECT_BY_UID = "redirectQueueUseridUrl";
	
	public static final String URL_APPEND_GET_OPD_STATUS_BY_UID = "getStatusByUseridUrl";
	
	public static final String URL_APPEND_OPD_SET_QUEUE = "setQueueUrl";
	
	public static final String URL_APPEND_OPD_GET_QUEUE_TYPE ="getQueueTypeUrl";
	
	public static final String URL_APPEND_OPD_HOLD_QUEUE_BY_UID = "holdQueueUrl";
	
	public static final String URL_APPEND_OPD_NEXT_ASSIGN_BY_PID = "getNextAssignDoctorUrl";

	
	/*nisal.d*/
	/*Pharmacy - Drug*/
	
	public static final String URL_APPEND_ADD_DRUG="insertDrugUrl";
	
	public static final String ADD_DRUG="insertDrug";
	
	public static final String ADD_DRUG_SUCCESS_MESSAGE="drug.insertDrug";
	
	public static final String URL_APPEND_UPDATE_DRUG="updateDrugUrl";
	
	public static final String UPDATE_DRUG="updateDrug";
	
	public static final String UPDATE_DRUG_SUCCESS_MESSAGE="drug.updateDrug";
	
	public static final String ADD_DRUG_BATCH="addBatch";
	
	public static final String ADD_DRUG_BATCH_SUCCESS_MESSAGE="drug.addbatch";
	
	public static final String UPDATE_DRUG_BATCH="updateBatch";
	
	public static final String URL_APPEND_UPDATE_DRUG_BATCH="updateDrugBatch";
	
	public static final String UPDATE_DRUG_BATCH_SUCCESS_MESSAGE="drug.updateBatch";
	
	public static final String URL_APPEND_ADD_DRUG_BATCH="addDrugBatch";
	
	public static final String URL_APPEND_ADD_DRUG_FREQUENCY="addDrugFrequency";
	
	public static final String URL_APPEND_UPDATE_DRUG_FREQUENCY ="updateDrugFrequency";
	
	public static final String URL_APPEND_GET_BATCH_NAMES_BY_DNAME ="getBatchesBydName";
	
	public static final String URL_APPEND_APPROVE_REQUEST="approveRequestUrl";
	
	public static final String APPROVE_REQUEST="approveRequest";
	
	public static final String REQUEST_DRUG="requestDrug";
	
	public static final String REQUEST_DRUG_ID="drug.requestDrugId";
	
	public static final String URL_APPEND_REQUEST_DRUG="requestDrugUrl";
	
	public static final String REQUEST_DRUG_SUCCESS="drug.requestDrug";
	
	public static final String APPROVE_DRUG_SUCCESS="drug.approveRequestDrug";
	
	public static final String URL_APPEND_GET_DRUG_BY_ID="getDrugById";
	
	public static final String URL_APPEND_GET_DRUG_BY_DNAME="getDrugIdByDrugName";
	
	public static final String DRUG_NAME="drug.drugName";
	
	public static final String URL_APPEND_GET_DRUG_DETAILS_BY_DNAME="getDrugDetailsByDName";
	
	public static final String URL_APPEND_GET_DRUG_DETAILS_BY_CATEGORY="getDrugDetailsByCategory";
	
	public static final String DRUG_CATEGORY="drug.drugCategory";
	
	public static final String URL_APPEND_GET_DRUG_DETAILS_WITH_PARAM="getDrugDetailsWithParam";
	
	public static final String URL_APPEND_GET_DRUG_BY_CATEGORY="getDrugFromCategory";
	
	public static final String DRUG_DETAILS_BY_DRUG_NAME="drugDetailByDrugName";
	
	public static final String URL_APPEND_GET_DRUG_DETAILS_BY_DRUG_NAME="getDrugBatchDetailsByDrugName";
	
	public static final String DRUG_NAME_AND_BATCH="drugDetailByDrugName";
	
	public static final String INSERT_MAIL="insertMail";
	
	public static final String URL_APPEND_INSERT_MAIL="insertDrugMail";
	
	public static final String URL_APPEND_DISPENSE_DRUG="dispenseDrugUrl";
	
	public static final String DISPENSE_DRUG="dispenseDrug";
	
	public static final String URL_APPEND_GET_PRESCRIPITON_LIST_BY_DATE="getDrugPrescriptionListbyDate";
	
	public static final String SAVE_DOSAGE="saveDosage";
	
	public static final String URL_APPEND_SAVE_DOSAGE="saveDrugDosage";
	
	public static final String SAVE_DOAGE_SUCCESS="drug.saveDosage";
	
	/*rubika.m*/
	public static final String URL_APPEND_GET_ALL_DOSAGES="getDrugDosages";

	public static final String URL_APPEND_GET_DRUG_MAIL_HISTORY="getDrugMailHistory";

	public static final String URL_APPEND_GET_DRUGS="getDrugsUrl";

	public static final String URL_APPEND_GET_DRUG_CATEGORIES="getDrugCategories";

	public static final String URL_APPEND_GET_DRUG_DETAILS="getDrugDetails";

	public static final String URL_APPEND_GET_PHARM_FREQUENCY="getDrugPharmFrequency";

	public static final String URL_APPEND_GET_DRUG_REQUESTS="getDrugRequest";

	public static final String URL_APPEND_GET_DRUG_NAMES="getDrugNames";

	public static final String URL_APPEND_GET_DRUG_REPORTS="getDrugReport";
	
	/*yasini.p*/
	/*Pharmacy - Pharmacy*/
	
	public static final String URL_APPEND_ADD_PHARMACY = "addPharmacyUrl";
	
	public static final String ADD_OPD_PHARMACY = "addPharmacy";
	
	public static final String LOAD_PHARMACY_TABLE = "loadPharmacyUrl";
	
}
