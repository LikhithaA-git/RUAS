<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database(); // Load the database library
    }

   // public function getAdminByUsername($username) {
   //      // Query the admin table to retrieve admin details by username
   //      $this->db->where(array('email'=> $username,'isActive'=> 1));
   //      $query = $this->db->get('admin');
   //      return $query->row();
   //  }


    public function getAllAdmin()
    {
        $this->db->where(array('isActive'=>1));
        $query = $this->db->get('admin');
        return $query->result();
    }
    public function getAdminByUsername($username)
    {
        $this->db->group_start();
        $this->db->where(array('email'=> $username,'isActive'=> 1));
        $this->db->or_where('number', $username);
        $this->db->group_end();
        return $this->db->get('admin')->row();
    }



    public function insert_admin($data) {
        $this->db->insert('admin', $data);
        return $this->db->insert_id();
    }

    public function update_admin($admin_id, $data) {
    $this->db->where('id', $admin_id);
    return $this->db->update('admin', $data);
   }
   
    public function getAdminDetails($adminId) {
        $this->db->select('id, name,role,number, email,profile,user_status,team'); // Specify the fields you want to retrieve excluding password
        $this->db->from('admin');
        $this->db->where(array('id'=> $adminId,'isActive'=>1));
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return null;
        }
    }
    //manager save
    public function saveManagerData($data)
    {
        // Assuming you have a model called "Manager_model" for managing manager-related database operations

        // Insert the data into the manager table
         $this->db->insert('manager', $data);

        // Check if the insert was successful
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function UpdateManagerData($data,$id)
{
   
     $this->db->where('id', $id);
        return $this->db->update('manager', $data);
  }
  //delete
   public function Managerdelete($id){
     $this->db->where('id', $id);
    return $this->db->delete('manager');
    }  
   public function Docdelete($id){
     $this->db->where('id', $id);
    return $this->db->delete('doctors');
    }  
    //  public function Managerdelete($id){
    //   $data =  array( 'isActive' => 0);
    //  $this->db->where('id', $id);
    // return $this->db->update('manager',$data); 
    // } 

   //get navigator
    public function getNavigators()
    {
        // $query = $this->db->get('manager'); // Assuming 'manager' is the table name
        // return $query->result(); // Return the result as an array of objects

        $this->db->where(array('isActive'=> 1));
        $query = $this->db->get('manager');
        return $query->result();
    }


    public function getNavigatorByID($id) {
 
        $this->db->where('id', $id);
        $query = $this->db->get('manager');
        
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return null;
        }
    }
 
        /*Foget password*/
         public function getAdminByEmail($email)
        {
            return $this->db->get_where('admin', ['email' => $email])->row();
        }

        public function saveResetToken($email, $token)
        {
            $this->db->where('email', $email);
            $this->db->update('admin', ['reset_token' => $token]);
        }

        public function isValidResetToken($token)
        {
            return $this->db->where('reset_token', $token)->get('admin')->num_rows() === 1;
        }

        public function updatePasswordByToken($token, $password)
        {
            $admin = $this->db->where('reset_token', $token)->get('admin')->row();

            if ($admin) {
                $hashed_password = password_hash($password, PASSWORD_BCRYPT);
                $this->db->where('id', $admin->id);
                $this->db->update('admin', ['password' => $hashed_password, 'reset_token' => null]);
                return true;
            }

            return false;
        }
     

     //remove token

      public function removetokenbyadmin($token)
        {
            $admin = $this->db->where('reset_token', $token)->get('admin')->row();

            if ($admin) {
              //  $hashed_password = password_hash($password, PASSWORD_BCRYPT);
                $this->db->where('id', $admin->id);
                $this->db->update('admin', ['reset_token' => null]);
                return true;
            }

            return false;
        }
      public function removetokenbyuser($token)
        {
            $admin = $this->db->where('reset_token', $token)->get('members')->row();

            if ($admin) {
               // $hashed_password = password_hash($password, PASSWORD_BCRYPT);
                $this->db->where('id', $admin->id);
                $this->db->update('members', [ 'reset_token' => null]);
                return true;
            }

            return false;
        }

        //New 24/1/24
        public function get_points_and_leaderboard() {
            $this->db->select('*','leader_board.team as team_name'); // Select all columns
            $this->db->from('points');
            $this->db->join('leader_board', 'points.team = leader_board.id', 'inner');
            
            $query = $this->db->get();
            
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return array(); // or handle no results as needed
            }
        }
    
}
