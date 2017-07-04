<?php
/*
------------------------------------------------------------------------------------------------------------------------
DiPMIMS - Digital Pulz Medical Information Management System
Copyright (c) 2017 Sri Lanka Institute of Information Technology
<http: http://his.sliit.lk />
------------------------------------------------------------------------------------------------------------------------
*/
?>
<?php
session_start ();
/* * ******************************************************************* */
class Question {
	
	// attributes for a Question
	public $index;
	public $questionID;
	public $text;
	public $answertype;
	public $answervals;
	public $answer;
	public function __construct($_text, $_answertype, $_answervals, $_questionID) {
		$this->text = $_text;
		$this->answertype = $_answertype;
		$this->answervals = $_answervals;
		$this->questionID = $_questionID;
	}
}

/* * ******************************************************************* */
class Questionnaire {
	public $question_list = array ();
	public $name;
	public $relateto;
	public $remarks;
	public $active;
	public $lastupdate;
	var $_site_base_url = SITE_BASE_URL;
	
	function addQuestion($question) {
		if (isset ( $_SESSION ["user"] )) {
			if ($_SESSION ["user"] == - 1) {
				redirect ( $this->_site_base_url );
			}
		} else {
			redirect ( $this->_site_base_url );
		}
		$this->question_list [] = $question;
		$question->index = (sizeof ( $this->question_list ) - 1);
	}
	function removeQuestion($index) {
		if (isset ( $_SESSION ["user"] )) {
			if ($_SESSION ["user"] == - 1) {
				redirect ( $this->_site_base_url );
			}
		} else {
			redirect ( $this->_site_base_url );
		}
		unset ( $this->question_list [$index] );
	}
	function getQuestionList() {
		if (isset ( $_SESSION ["user"] )) {
			if ($_SESSION ["user"] == - 1) {
				redirect ( $this->_site_base_url );
			}
		} else {
			redirect ( $this->_site_base_url );
		}
		return $this->question_list;
	}
}

/* * ******************************************************************* */
class questionnaire_c extends CI_Controller {
	var $_site_base_url = SITE_BASE_URL;
	public function __construct() {
		parent::__construct ();
		
		@session_start ();
		if (! isset ( $_SESSION ['questionnaire'] )) {
			$_SESSION ['questionnaire'] = new Questionnaire ();
		}
	}
	public function index() {
	}
	public function add($status = '') {
		if (isset ( $_SESSION ["user"] )) {
			if ($_SESSION ["user"] == - 1) {
				redirect ( $this->_site_base_url );
			}
		} else {
			redirect ( $this->_site_base_url );
		}
		$data ['status'] = $status;
		$data ['title'] = "Add Questionnaire";
		$data ['qid'] = '';
		
		if ($_SERVER ['REQUEST_METHOD'] != 'POST') {
			$data ['question_list'] = null;
			$data ['questionnaire'] = null;
			$_SESSION ['questionnaire'] = null;
		}
		
		if ($_SESSION ['questionnaire'] != null)
			$data ['question_list'] = $_SESSION ['questionnaire']->getQuestionList ();
		else
			$data ['question_list'] = null;
		
		$data ['questionnaire'] = $_SESSION ['questionnaire'];
		
		$this->load->view ( 'headerInward', $data );
		
		// loading left side navigation

		$data['leftnavpage'] = '';
		
		$this->load->library('template');
		$this->template->title('Questionnaire');
		$this->template
		->set_layout('panellayout')
		->build('questionnaire_m_v',$data);
		
	}
	public function add_question($qid = '') {

		if($qid == '')
		{
			$_SESSION ['questionnaire']->name = $_POST ['name'];
			$_SESSION ['questionnaire']->relateto = $_POST ['relateto'];
			$_SESSION ['questionnaire']->remarks = $_POST ['remarks'];
			$_SESSION ['questionnaire']->active = 1;

			for($i = 0; $i< $this->input->post('gtablerows'); $i++)
			{			
				$text = $this->input->post('tableText')[$i];
				$answertype = $this->input->post('tableAnswerType')[$i];
				$answervals = $this->input->post('tableAnswervals')[$i];

				$_SESSION ['questionnaire']->addQuestion ( new Question ( $text, $answertype, $answervals, null ) );
			}
		}
		else
		{
			$_SESSION ['questionnaire']->name = $_POST ['name'];
			$_SESSION ['questionnaire']->relateto = $_POST ['relateto'];
			$_SESSION ['questionnaire']->remarks = $_POST ['remarks'];
			$_SESSION ['questionnaire']->active = 1;
		}
	//	$text = $_POST ['text'];
	//	$answertype = $_POST ['answertype'];
	//	$answervals = $_POST ['answervals'];
		
	
		
		/*if ($qid == '') {
			$this->add ();
		} else {
			$this->edit ( $qid );
		}*/
	}
	public function remove_question($index, $qid = '') {
		if (isset ( $_SESSION ["user"] )) {
			if ($_SESSION ["user"] == - 1) {
				redirect ( $this->_site_base_url );
			}
		} else {
			redirect ( $this->_site_base_url );
		}
		
		$_SESSION ['questionnaire']->removeQuestion ( $index );
		
		if ($qid == '') {
			$this->add ();
		} else {
			$this->edit ( $qid );
		}
	}
	public function edit($qid, $loadlist = FALSE, $status = '0') {
		if (isset ( $_SESSION ["user"] )) {
			if ($_SESSION ["user"] == - 1) {
				redirect ( $this->_site_base_url );
			}
		} else {
			redirect ( $this->_site_base_url );
		}
		$data ['status'] = $status;
		$data ['title'] = "Edit Questionnaire";
		$data ['qid'] = $qid;
		
		$this->load->view ( 'headerInward', $data );
		
		// loading left side navigation
		$data ['leftnavpage'] = 'preferences_v';
		$this->load->view ( 'left_navbar_v', $data );
		// ************************************************************************************
		// load the questionnaire *****************************************************************
		$this->load->model ( 'QuestionnaireModel', 'questionnaire' );
		$data ['questionnaire'] = json_decode ( $this->questionnaire->getQuestionnaireByID ( $qid ) );
		
		// load last edited username for the questionnaire
		$lastupdateuid = $data ['questionnaire']->questionnaireLastUpdateUser;
		$this->load->model ( 'ServiceModel', 'service' );
		$data ['lastmodusername'] = $this->service->getFullUserName ( $lastupdateuid );
		// ****************************************************************************
		
		if ($status == "True" || $loadlist == TRUE || ($_SESSION ['questionnaire']->name) == null) {
			
			// load questions of the questionnaire
			$data ['questions'] = json_decode ( $this->questionnaire->getQuestionsByQuestionnaireID ( $qid ) );
			// ****************************************************************************
		print_r($data ['questionnaire']->questionnaireName);
			$_SESSION ['questionnaire'] = new Questionnaire ();
			
			$_SESSION ['questionnaire']->name = $data ['questionnaire']->questionnaireName;
			$_SESSION ['questionnaire']->relateto = $data ['questionnaire']->questionnaireRelateTo;
			$_SESSION ['questionnaire']->remarks = $data ['questionnaire']->questionnaireRemarks;
			$_SESSION ['questionnaire']->active = $data ['questionnaire']->questionnaireActive;
			$_SESSION ['questionnaire']->lastupdate = $data ['questionnaire']->questionnaireLastUpdate;
			
			// load the questionnaire questions
			
			if ($loadlist) {
				for($index = 0; $index < sizeof ( $data ['questions'] ); $index ++) {
					$text = $data ['questions'] [$index]->questionText;
					$answerType = $data ['questions'] [$index]->questionAnswerType;
					$answerValue = $data ['questions'] [$index]->questionAnswerValue;
					$questionID = $data ['questions'] [$index]->questionID;
					
					$_SESSION ['questionnaire']->addQuestion ( new Question ( $text, $answerType, $answerValue, $questionID ) );
				}
			}
		}
		
		$data ['question_list'] = $_SESSION ['questionnaire']->getQuestionList ();
		$data ['questionnaire'] = $_SESSION ['questionnaire'];
		
		//$this->load->view ( 'questionnaire_m_v', $data );
		//$this->load->view ( 'bottom' );
		$data['leftnavpage'] = '';
		
		$this->load->library('template');
		$this->template->title('Questionnaire');
		$this->template
		->set_layout('panellayout')
		->build('questionnaire_m_v',$data);
	}
	public function update($qid) {
		if (isset ( $_SESSION ["user"] )) {
			if ($_SESSION ["user"] == - 1) {
				redirect ( $this->_site_base_url );
			}
		} else {
			redirect ( $this->_site_base_url );
		}
		$data ['status'] = '0';
		$data ['visitid'] = '';
		
		$this->load->model ( 'QuestionnaireModel', 'questionnaire' );
		$this->questionnaire->set_userid ( $this->session->userdata ( "userid" ) );


		$this->add_question($qid);


		$this->questionnaire->set_questionnaire ( $_SESSION ['questionnaire'] );
		
		$data ['status'] = $this->questionnaire->updateQuestionnaire ( $qid );
		
		$_SESSION ['questionnaire'] = NULL;
		
		$data ['question_list'] = NULL;
		
		$this->edit ( $qid, TRUE, $data ['status'] );
	}
	public function save() {
		if (isset ( $_SESSION ["user"] )) {
			if ($_SESSION ["user"] == - 1) {
				redirect ( $this->_site_base_url );
			}
		} else {
			redirect ( $this->_site_base_url );
		}
		$data ['status'] = '0';
		$data ['visitid'] = '';
		
		$this->add_question();


		$this->load->model ( 'QuestionnaireModel', 'questionnaire' );
		$this->questionnaire->set_userid ( $this->session->userdata ( "userid" ) );
		$this->questionnaire->set_questionnaire ( $_SESSION ['questionnaire'] );
		
		if (sizeof ( $_SESSION ['questionnaire']->getQuestionList () ) == 0) {
			$this->add ( "FalseNoQ" );
			return;
		}
		
		$data ['status'] = $this->questionnaire->addQuestionnaire ();
		
		$data ['title'] = "Add Questionnaire";
		$_SESSION ['questionnaire'] = NULL;
		
		$data ['question_list'] = NULL;
		
		$this->add ( $data ['status'] );
	}
	public function answer($pid, $qid, $visitid, $status = '0') {
		if (isset ( $_SESSION ["user"] )) {
			if ($_SESSION ["user"] == - 1) {
				redirect ( $this->_site_base_url );
			}
		} else {
			redirect ( $this->_site_base_url );
		}
		$data ['status'] = $status;
		$data ['pid'] = $pid;
		$data ['visitid'] = $visitid;
		$data ['title2'] = 'Answer';
		$data ['qid'] = $qid;
		//$this->load->view ( 'headerInward', $data );
		
		// loading left side navigation
		$data ['leftnavpage'] = '';
		//$this->load->view ( 'left_navbar_v', $data );
		// ************************************************************************************
		// load the saved questionnaire
		$this->load->model ( 'QuestionnaireModel', 'questionnaire' );
		$data ['questionnaire'] = json_decode ( $this->questionnaire->getQuestionnaireByID ( $qid ) );
		
		// ****************************************************************************
		$data ['title'] = $data ['questionnaire']->questionnaireName;
		
		// load questions of the questionnaire
		$data ['questions'] = json_decode ( $this->questionnaire->getQuestionsByQuestionnaireID ( $qid ) );
		// ****************************************************************************
		// show patient profile mini
		
		
		$this->load->model ( 'PatientModel', 'patient' );
		$this->patient->set_pid ( $pid );
		$data ['pprofile'] = json_decode ( $this->patient->getPatient () );
		
		
		$this->load->library('template');
		$this->template->title('Questionnaire');
		$this->template
		->set_layout('panellayout')
		->build('questionnaire_answer_m_v',$data);
		
	}
	public function save_answer($pid, $qid, $visitid, $status = '0') {
		if (isset ( $_SESSION ["user"] )) {
			if ($_SESSION ["user"] == - 1) {
				redirect ( $this->_site_base_url );
			}
		} else {
			redirect ( $this->_site_base_url );
		}
		$data ['pid'] = $pid;
		$data ['visitid'] = $visitid;
		$data ['leftnavpage'] = 'qans_v';
		// load the saved questionnaire
		$this->load->model ( 'QuestionnaireModel', 'questionnaire' );
		$data ['questionnaire'] = json_decode ( $this->questionnaire->getQuestionnaireByID ( $qid ) );
		
		// load questions of the questionnaire
		$data ['questions'] = json_decode ( $this->questionnaire->getQuestionsByQuestionnaireID ( $qid ) );
		// ****************************************************************************
		
		$curl_post_data = array ();
		foreach ( $data ['questions'] as $question ) {
			$curl_post_data = array_merge ( $curl_post_data, array (
					"'" . $question->questionID . "'" => $this->input->post ( $question->questionID ) 
			) );
		}
		
		$data ['status'] = $this->questionnaire->saveQuestionAnswer ( $qid, $visitid, $this->session->userdata ( 'userid' ), $curl_post_data );
		$this->answer ( $pid, $qid, $visitid, $data ['status'] );
	}
	public function update_answer($pid, $qid, $visitid, $asid, $status = '0') {
		if (isset ( $_SESSION ["user"] )) {
			if ($_SESSION ["user"] == - 1) {
				redirect ( $this->_site_base_url );
			}
		} else {
			redirect ( $this->_site_base_url );
		}
		// load the saved questionnaire
		$this->load->model ( 'QuestionnaireModel', 'questionnaire' );
		$data ['questionnaire'] = json_decode ( $this->questionnaire->getQuestionnaireByID ( $qid ) );
		
		// load questions of the questionnaire
		$data ['questions'] = json_decode ( $this->questionnaire->getQuestionsByQuestionnaireID ( $qid ) );
		// ****************************************************************************
		// load answers for those questions
		$data ['answers'] = json_decode ( $this->questionnaire->getAnswers ( $pid, $qid, $asid ), true );
		// ****************************************************************************
		
		$curl_post_data = array ();
		foreach ( $data ['answers'] as $answer ) {
			$curl_post_data = array_merge ( $curl_post_data, array (
					"'" . $answer ['answerID'] . "'" => $this->input->post ( $answer ['answerID'] ) 
			) );
		}
		
		$data ['status'] = $this->questionnaire->updateQuestionAnswer ( $qid, $visitid, $this->session->userdata ( 'userid' ), $curl_post_data );
		
		$this->view_ques_answer ( $pid, $qid, $asid, $data ['status'] );
	}
	public function view_ques_answer($pid, $qid, $asid, $status = '') {
		if (isset ( $_SESSION ["user"] )) {
			if ($_SESSION ["user"] == - 1) {
				redirect ( $this->_site_base_url );
			}
		} else {
			redirect ( $this->_site_base_url );
		}
		$data ['status'] = $status;
		$data ['pid'] = $pid;
		$data ['visitid'] = '';
		$data ['asid'] = $asid;
		$data ['title2'] = 'View';
		
		$data ['qid'] = $qid;
		$this->load->view ( 'headerInward', $data );
		
		// loading left side navigation
		$data ['leftnavpage'] = 'qans_v';
		// $this->load->view('left_navbar_v',$data);
		// ************************************************************************************
		// load the saved questionnaire
		$this->load->model ( 'QuestionnaireModel', 'questionnaire' );
		$data ['questionnaire'] = json_decode ( $this->questionnaire->getQuestionnaireByID ( $qid ) );
		
		// ****************************************************************************
		$data ['title'] = $data ['questionnaire']->questionnaireName;
		
		// load questions of the questionnaire
		$data ['questions'] = json_decode ( $this->questionnaire->getQuestionsByQuestionnaireID ( $qid ) );
		// ****************************************************************************
		// load answers for those questions
		$data ['answers'] = json_decode ( $this->questionnaire->getAnswers ( $pid, $qid, $asid ), true );
		// ****************************************************************************
		// load last edited username
		$lastupdateuid = $data ['answers'] [0] ['answerSetId'] ['answerSetLastUpDateUser'];
		$this->load->model ( 'ServiceModel', 'service' );
		$data ['lastmodusername'] = "Miyuru"; // $this->service->getFullUserName($lastupdateuid);
		                                     // ****************************************************************************
		
		$data ['visitid'] = $data ['answers'] [0] ['answerSetId'] ['visit'] ['visitID'];
		
		// show patient profile mini
		$this->load->model ( 'PatientModel', 'patient' );
		$this->patient->set_pid ( $pid );
		$data ['pprofile'] = json_decode ( $this->patient->getPatient () );
		$this->load->view ( 'patient_profile_mini_v', $data );
		// ****************************************************************************
		
		$this->load->view ( 'questionnaire_answer_m_v', $data );
		$this->load->view ( 'bottom' );
	}
}

?>