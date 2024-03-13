<?php

	class Login_model extends CI_Model{


	function __consturct(){
		parent::__construct();
	}

	public function getUserForLogin($credential){		

    	return $this->db->get_where('employee', $credential);
	}
	
	public function getdata(){
			
		$query =$this->db->get('users');
		$result=$query->result();
		return $result;
	}

	//**exists employee email check**//
     public function Does_email_exists($email) {
		$user = $this->db->dbprefix('employee');
        $sql = "SELECT `em_email` FROM $user
		WHERE `em_email`='$email' AND `status` = 'ACTIVE'";
		$result=$this->db->query($sql);
		    if ($result->row()) {
		        return $result->row();
		    } else {
		        return false;
		    }
      }

    public function insertUser($data){
		$this->db->insert('users',$data);
	}

	public function UpdateKey($data,$email){
		$this->db->where('em_email',$email);
		return $this->db->update('employee',$data);
	}
	public function Expirecode($data,$email){
		$this->db->where('em_email',$email);
		return $this->db->update('employee',$data);
	}


	public function UpdatePassword($key,$data){
		$this->db->where('forgotten_code',$key);
		return $this->db->update('employee',$data);	    
	}	
	
	public function UpdateStatus($verifycode,$data){
		$this->db->where('confirm_code',$verifycode);
		$this->db->update('users',$data);	    
	}
	
	//**exists employee email check**//
    public function Does_Key_exists($reset_key) {
		$user = $this->db->dbprefix('employee');
        $sql = "SELECT `forgotten_code` FROM $user
		WHERE `forgotten_code`='$reset_key'";
		$result=$this->db->query($sql);
        if ($result->row()) {
            return $result->row();
        } else {
            return false;
        }
    }
	
	public function GetUserInfo($key){
		$user = $this->db->dbprefix('employee');
        $sql = "SELECT `em_password` FROM $user
		WHERE `forgotten_code`='$key'";
		$query=$this->db->query($sql);
		$result = $query->row();
		return $result;			
	}
	public function GetEMP($email){
		$user = $this->db->dbprefix('employee');
        $sql = "SELECT `em_email`,`first_name`,`last_name` FROM $user
		WHERE `em_email`='$email'";
		$query=$this->db->query($sql);
		$result = $query->row();
		return $result;			
	}		
	
	public function GetuserInfoBycode($verifycode){
		$user = $this->db->dbprefix('users');
        $sql = "SELECT * FROM $user
		WHERE `confirm_code`='$verifycode'";
		$query=$this->db->query($sql);
		$result = $query->row();
		return $result;			
	}
	
	 //signup
	 public function save_member($data)
	 {
		// return $this->db->insert('users', $data); // Assuming 'users' is the name of your table
		 return $this->db->insert('admin', $data); // Assuming 'users' is the name of your table
	 }
 
	 public function is_email_duplicate($email)
	 {
		 $this->db->where(array('email'=> $email,'isActive'=>1));
		 $query = $this->db->get('admin');
 
		 return $query->num_rows() > 0;
	 }
	 public function is_number_duplicate($number)
	 {
		 //$this->db->where('number', $number);
		 $this->db->where(array('number'=> $number,'isActive'=>1));
		 $query = $this->db->get('admin');
		 return $query->num_rows() > 0;
	 }
	   public function getAdminDetails($adminId) {
		 $this->db->select('id, name,role,number, email,profile'); // Specify the fields you want to retrieve excluding password
		 $this->db->from('admin');
		 $this->db->where(array('id'=> $adminId,'isActive'=>1));
		 $query = $this->db->get();
		 
		 if ($query->num_rows() > 0) {
			 return $query->row();
		 } else {
			 return null;
		 }
	 }
}
?>