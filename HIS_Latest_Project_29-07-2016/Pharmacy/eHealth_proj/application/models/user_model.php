<?php

class User_model extends CI_Model
{
	function User_model()
	{
		parent::__construct();
	}
	
	function index(){
   		
   		return $query = $this->db->get('mst_Drugs');
   		//Here you should note i am returning 
   		//the query object instead of 
   		//$query->result() or $query->result_array()
}    
	
	function reg_user($name, $email, $username, $password)
	{
		//Encrypts the password before storing in the database
		$encrypt_password = sha1($password);
		
		//Creates an array which includes the field names and the values assigned
		$details = array(
				'u_name' => $name,
				'u_email' => $email,
				'u_username' => $username,
				'u_password' => $encrypt_password
		);
		
		//Executes the insert query
		$this->db->insert('tbl_user',$details);
	}
	
	function user_login($username, $password)
	{
		//Encrypts the password before storing in the database
		$sha1_pswrd = sha1($password);
		
		//assigns the sql query to a variable
		$str = "Select uid from tbl_user where u_username = ? and u_password = ?";
		
		//Executes the query
		$res = $this -> db -> query($str, array($username, $sha1_pswrd));
		
		//Checks whether exactly one result is returned
		if($res -> num_rows() == 1)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function chk_username($username)
	{
		//assigns the sql query to a variable
		$str = "SELECT u_username from tbl_user where u_username = ?";
		
		//Executes the query
		$res = $this -> db -> query($str, $username);
		
		//Checks whether the result is available in the table
		if($res -> num_rows() > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function chk_email($email)
	{
		//assigns the sql query to a variable
		$str = "Select u_email from tbl_user where u_email = ?";
		
		//Executes the query
		$res = $this -> db -> query($str, $email);
		
		//Checks whether the result is available in the table
		if($res -> num_rows() > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
}
