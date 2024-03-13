<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Login extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function __construct()
    {
        parent::__construct();
      //  $this->load->model('member_model'); // Assuming you have a model named Member_model to interact with the members table
         // Load necessary models
        $this->load->model('Admin_model');
        $this->load->model('Product_model');
        $this->load->model('login_model');
    }

    public function layout()
    {
        $this->load->view('layouts_form');
    }

	public function index()
	{
		//$this->load->view('Backend/login');
        // Check if the user is already authenticated
        if ($this->session->userdata('user_login_access')) {
            // Redirect to the appropriate dashboard based on the user's role
            $role = $this->session->userdata('url');
            redirect(base_url('/').$role, 'refresh');
        } else {
            // User is not authenticated, load the login view
            $this->load->view('Backend/login');
        }
	}
	public function Signup()
	{
       
		$this->load->view('Backend/sign_up');
	}

	


    //Login
 
    public function authenticate() {
        // Get the login credentials from the form
        $username = $this->input->post('email');
        $password = $this->input->post('pswd');
        $remember = $this->input->post('remember'); // Assuming remember checkbox has name "remember"
        
        
        // Check if the remember me checkbox is checked
        $rememberMe = $remember ? true : false;

        // Authenticate the user using the submitted credentials
        $role = $this->determineRole($username, $password);

        // Redirect to the appropriate dashboard based on the user's role
        switch ($role) {
            case 'admin':
                echo json_encode(array("status" => "success", "url" => 'admin/'));
                break;
      
            default:
                //redirect(base_url() .'login');
               echo json_encode(array("status" => "error", "url" => 'login',"message"=>"Please check your login details"));
                break;
        }

        // Set cookies if remember me is checked
        if ($rememberMe) {
            $cookie_username = array(
                'name' => 'username',
                'value' => $username,
                'expire' => 604800, // 1 week
                'domain' => $_SERVER['HTTP_HOST'],
                'secure' => false
            );
          $cookie_pass = array(
                'name' => 'password',
                'value' => base64_encode($password),
                'expire' => 604800, // 1 week
                'domain' => $_SERVER['HTTP_HOST'],
                'secure' => false
            );

            $this->input->set_cookie($cookie_username);
            $this->input->set_cookie($cookie_pass);
        } else {
            // Clear the remember me cookie if the remember option is not checked
          if(!empty($this->input->cookie('username')))
            {
                $this->input->set_cookie('username',' ');
            }
            if(!empty($this->input->cookie('password')))
            {
                $this->input->set_cookie('password',' ');
            }               
            redirect(base_url() . 'login', 'refresh');
        }
    }


    private function determineRole($username, $password) {
        // Authenticate the user's credentials against the database
        
        // Check if the user is an admin
        $admin = $this->Admin_model->getAdminByUsername($username);
        if ($admin && password_verify($password, $admin->password)) {
       
            $this->session->set_userdata('user_login_access', '1');
            $this->session->set_userdata('user_login_id', $admin->id);
            $this->session->set_userdata('name', $admin->name);
            $this->session->set_userdata('email', $admin->email);
            $this->session->set_userdata('url', 'admin/');
            $this->session->set_userdata('role', 'admin');
            $this->session->set_userdata('user_status', $admin->user_status);
            return 'admin';
        }
        
     
        
        // If no role is determined, return false
        return false;
    }

	  /*Logout method*/
        function logout() 
        {
        $this->session->sess_destroy();
        $this->session->set_flashdata('feedback', 'logged_out');
         redirect(base_url(),'refresh');
       }


       public function saveuser()
       {
           $name = $this->input->post('uname');
           $email = $this->input->post('email');
           $password = $this->input->post('password');
           $number = $this->input->post('number');
         
   
           // Perform form validation
           $this->load->library('form_validation');
           $this->form_validation->set_rules('uname', 'Name', 'required');
           $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
           $this->form_validation->set_rules('password', 'Password', 'required');
   
           if ($this->form_validation->run() === FALSE) {
               // Form validation failed
               $response = array(
                   'status' => 'valid',
                   'message' => validation_errors()
               );
           } else {
               // Form validation passed
   
   
            //    if ($this->login_model->is_email_duplicate($email) && $this->login_model->is_number_duplicate($number)) {
            //    $response = array(
            //        'status' => 'error',
            //        'message' => 'Email address and number already exist'
            //    );
            //   // echo json_encode($response);
            //   } elseif ($this->login_model->is_email_duplicate($email)) {
                 
            //          $response = array(
            //           'status' => 'error',
            //             'message' => 'Email address already exists'
            //       );
            //     } elseif ($this->login_model->is_number_duplicate($number)) {
                
            //          $response = array(
            //           'status' => 'error',
            //           'message' => 'Number already exists'
            //        );
            //    } else {

                if ($this->login_model->is_email_duplicate($email)) {
                 
                    $response = array(
                     'status' => 'error',
                       'message' => 'Email address already exists'
                 );
               } else {
                
               
   
              
              
               // Encrypt the password
               $encrypted_password = password_hash($password, PASSWORD_BCRYPT);
   
               // Save the member details in the database
               $member_data = array(
                   'name' => $name,
                   'email' => $email,
                   'password' => $encrypted_password,
                 
                //    'number' =>$number,
                   'role'=>'Member'
                
               );
   
               if ($this->login_model->save_member($member_data)) {
   
                   //$this->send_mail($name,$email,$number);
   
                   // Member saved successfully
                   $response = array(
                       'status' => 'success',
                       'message' => 'Registration successful'
                   );
               } else {
                   // Error saving member
                   $response = array(
                       'status' => 'error',
                       'message' => 'Error saving member'
                   );
               }
           }
          }
   
           echo json_encode($response);
       }




}
