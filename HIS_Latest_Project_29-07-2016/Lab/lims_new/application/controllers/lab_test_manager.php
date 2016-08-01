<?php

class Lab_test_manager extends CI_Controller {

    function __construct()
    {
        parent::__construct();

        $this->load->helper('url');

    }

    private function _init()
    {
        $this->output->set_template('default');
        $this->load->section('sidebar', 'includes/sidebar');
    }

    public function index() {
        $this->_init();
        $data['categories']=$this->GetAllCategories();
        $data['Subcategories']=$this->GetAllSubCategories(); 
        $data['TestNames']=$this->GetAllTestNames();
        $this->load->view('lab_test_manager',$data);
    }
     
     //fet all categories
    
    public function GetAllCategories() {
        $this->load->model('lab_test_manager_model', 'category');
        $ss = $this->category->getAlltCategories();
        return $ss;
    }

    //get all subcategories
    
    public function GetAllSubCategories() {
        $this->load->model('lab_test_manager_model', 'Subcategory');
        $ss = $this->Subcategory->getAllSubCategories();
        return $ss;
    }

    //get all test names
    
    public function GetAllTestNames() {
        $this->load->model('lab_test_manager_model', 'TestNames');
        $ss = $this->TestNames->getAllTestNames();
        return $ss;
    }

    //update category

    public function updateCategory(){
        $this->_init();
        $array = $this->uri->uri_to_assoc(3);
        $data['catID']=$array['CID'];
        $data['catName']=$array['Cat'];
        $this->load->view('category_edit',$data);
    }

    public function updateCategoryAjax(){
        if (isset($_POST['Category'])) {
            $Data = $_POST['Category'];
            $curl_post_data = array(
                "category_ID" => $Data[0],
                "category_Name" => $Data[1]
            );
            $data_string = json_encode($curl_post_data);
            $this->load->model('lab_test_manager_model', 'cate');
            print_r($data_string);
            $ss = $this->cate->updateCategory($data_string);
            return $ss;
        }
    }

    //update subcategory

    public function updateSubCategory(){
        $this->_init();
        $array = $this->uri->uri_to_assoc(3);
        $data['SID']=$array['SID'];
        $data['SubcatName']=$array['SubCat'];
       // $data['cid']=$array['catID'];
        $this->load->view('edit_sub_category',$data);
    }

    public function updateSubCategoryAjax(){
        if (isset($_POST['Category'])) {
            $Data = $_POST['Category'];
            $curl_post_data = array(
                "sub_CategoryID" => $Data[0],
                "sub_CategoryName" => $Data[1]
            );
            $data_string = json_encode($curl_post_data);
            $this->load->model('lab_test_manager_model', 'cate');
            print_r($data_string);
            $ss = $this->cate->updateSubCategory($data_string);
            return $ss;
        }
    }

    //update test names

    public function updateTestNames() {
        $this->_init();
        $array = $this->uri->uri_to_assoc();
        $data['TID']=$array['TID'];
        $data['TN']=$array['TN'];
        $data['cid']=$array['cid'];
        $data['sid']=$array['sid'];
            
        $data['cat']=$array['cat'];
      
        $data['sub']=$array['sub'];
    
        $this->load->view('edit_test_names',$data);
    }

    public function updateTestNamesAjax(){

        if (isset($_POST['test'])) {
            $Data = $_POST['test'];
            $curl_post_data = array(
                "test_ID" => $Data[0],
                 "fTest_CategoryID" => $Data[1],
                  "fTest_Sub_CategoryID" => $Data[2],
                  "fTest_LastUpdateUserID" => $Data[3],
                  "test_Name" => $Data[4]
                  
               
            );

            print_r($Data[1]);
            $data_string = json_encode($curl_post_data);
            $this->load->model('lab_test_manager_model', 'cate');
            print_r($data_string);
            $ss = $this->cate->updateTestNames($data_string);
            return $ss;
        }
    }
      
      //add category details
    public function addCategoryDetails() {

        if (isset($_POST['categories'])) {
            $Data = $_POST['categories'];
            $curl_post_data = array(
                "category" => $Data[0],
                "sub_category" => $Data[1],
                "specimen" => $Data[2],
                "retention" => $Data[3],
                "duration" => $Data[4],
            );
            $data_string = json_encode($curl_post_data);
            $this->load->model('lab_test_manager_model', 'category');
            $ss = $this->category->AddCategory($data_string);
        }
    }



}
