<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Admin extends CI_Controller {

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
	function __construct() {
        parent::__construct();
        $this->load->model('Admin_model');
        $this->load->model('Manager_model');
        $this->load->model('login_model');
	
       $this->getAdminDetails();
    }
 /* Get admin details */
    private function getAdminDetails() {
        $this->checkLogin();
        $adminId = $this->session->userdata('user_login_id');
        $adminDetails['admin_data'] = $this->Admin_model->getAdminDetails($adminId);
        $this->load->vars($adminDetails); // Make $adminDetails available in all views
    }


    public function index()
	{
	    $this->checkLogin(); // Add this line to check login

	    $this->load->view('Backend/admin/ad-main-page');
	}

	public function Add_Navigator()
	{
	    $this->checkLogin(); // Add this line to check login
	    
	    $this->load->view('Backend/admin/ad-add-nav');
	}

	public function All_Navigators()
	{
	    $this->checkLogin(); // Add this line to check login
	    $navigators = $this->Admin_model->getNavigators();
        $data['navigators'] = $navigators;
      
	    $this->load->view('Backend/admin/ad-all-navigators',$data);
	}

		public function Add_Member()
	{
		$this->checkLogin();
	
		$this->load->view('Backend/admin/ad-add-member');
	}
	public function All_Members()
	{
		$this->checkLogin();
		//
		$query = $this->db->get('branch');
		$announcement = $query->result();
         $data['announcement'] = $announcement;

		$this->load->view('Backend/admin/ad-all-members',$data);
	}






    //check login
	private function checkLogin()
	{
	    if (!$this->session->userdata('user_login_access')) {
	        redirect(base_url() . 'login'); // Redirect to the login page if not logged in
	    }
	}
	// private function checkLogin()
	// {
	//     if (!$this->session->userdata('user_login_access')) {
	//         redirect(base_url() . 'login'); // Redirect to the login page if not logged in
	//     } else {
	//         // Get the requested URL and user's role from the session
	//         $requestedUrl = $this->uri->segment(1); // Assuming the role controller is the first segment of the URL
	//         $role = $this->session->userdata('url');

	//         // Remove the trailing slash from the role if present
    //           $role = rtrim($role, '/');

    //             // Convert both the requested URL and the role to lowercase for comparison
	// 	        $requestedUrl = strtolower($requestedUrl);
	// 	        $role = strtolower($role);

	//         // Check if the requested URL matches the user's role
	//         if ($requestedUrl !== $role) {
	//             // Display an error message or take appropriate action
	//             echo "<script>alert('Access denied. You do not have permission to access this page')</script>";
	//             // Or you can redirect to a specific error page
	//              redirect(base_url() . $role);;
	//             exit; // Stop further execution
	//         }
	//     }
	// }




	    /*Logout method*/
    function logout() {
        $this->session->sess_destroy();
        $this->session->set_flashdata('feedback', 'logged_out');
        redirect(base_url().'login');
    }

	public function Edit_Profile(){
    	$this->checkLogin();
    	$this->load->view('Backend/admin/ad-edit-profile');

    }
	public function View_Profile(){
    	$this->checkLogin();
    	$this->load->view('Backend/admin/view-profile');

    }

	 //save manager
	 public function add_product() {
        $data = array(
            'name' => $this->input->post('name'),
            'brand' => $this->input->post('brand'),
            'quantity' => $this->input->post('quantity'),
            'price' => $this->input->post('price')
        );

        $result = $this->Product_model->insert_product($data);

        if ($result) {
            // Success: Product inserted
			echo json_encode(array('status' => 'success', 'message' => 'Product Added successfully'));
        } else {
            // Error: Product not inserted
        	echo json_encode(array('status' => 'error', 'message' => 'Product Not Added'));
        }
    }
	public function edit_product() {
		$id = $this->input->post('id');
        $data = array(
            'name' => $this->input->post('name'),
            'brand' => $this->input->post('brand'),
            'quantity' => $this->input->post('quantity'),
            'price' => $this->input->post('price')
        );

        $result = $this->Product_model->update_product($id, $data);

        if ($result) {
            // Success: Product updated
             // Success: Product inserted
			echo json_encode(array('status' => 'success', 'message' => 'Product Updated successfully'));
        } else {
            // Error: Product not updated
			echo json_encode(array('status' => 'error', 'message' => 'Product Not Updated'));
        }
    }
	public function getProductByID() {
		$id = $this->input->get('id');
        // Call the model method to retrieve product details by ID
        $product = $this->Product_model->getProductByID($id);

        // Check if the product exists
        if ($product) {
            // Send the product details as JSON response
            echo json_encode($product);
        } else {
            // Product not found
            echo json_encode(array('error' => 'Product not found'));
        }
    }

	public function deleteProduct() {
		$id = $this->input->post('id');
        // Call the model method to delete the product by ID
        $result = $this->Product_model->deleteProductByID($id);

        if ($result) {
            // Product deleted successfully
            // You can redirect to a success page or return a success response here
            echo json_encode(array('status' => 'success','message' => 'Product deleted successfully'));
        } else {
            // Product not found or deletion failed
            // You can redirect to an error page or return an error response here
            echo json_encode(array('status' => 'error', 'message' => 'Product deletion failed'));
        }
    }

	public function update_admin()
	{
		//$this->checkLogin();
		if ($this->session->userdata('user_login_access') != False) {
             //die();
		    	$id = $this->input->post('id');
		    	$name = $this->input->post('name');
				$email = $this->input->post('email');
				$number = $this->input->post('number');
	
				$password = $this->input->post('password');
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

		        $this->load->library('form_validation');
		        $this->form_validation->set_error_delimiters();
		        $this->form_validation->set_rules('name', 'Name', 'trim|required|max_length[255]|xss_clean');
		        $this->form_validation->set_rules('email', 'Email ID', 'trim|required|max_length[255]|valid_email|xss_clean');
		        // Add more validation rules as needed for other fields

		        if ($this->form_validation->run() == FALSE) {
		            echo validation_errors();
		            // Handle validation errors
		        } else {
		        
 
			     if($_FILES['file_url']['name']){
	            $file_name = $_FILES['file_url']['name'];
				$fileSize = $_FILES["file_url"]["size"]/1024;
				$fileType = $_FILES["file_url"]["type"];
				$new_file_name='';
	            $new_file_name .= $file_name;

	            $config = array(
	                'file_name' => $new_file_name,
	                'upload_path' => "./assets/uploads/profile",
	                'allowed_types' => "gif|jpg|png|jpeg|pdf|doc|docx",
	                'overwrite' => False,
	                'max_size' => "50720000"
	            );
	            //create directory
	              if(!is_dir($config['upload_path'])) mkdir($config['upload_path'], 0777, TRUE);
	    
	            $this->load->library('Upload', $config);
	            $this->upload->initialize($config);                
	            if (!$this->upload->do_upload('file_url')) {
	                echo $this->upload->display_errors();
	                #redirect("notice/All_notice");
				}

	   
				else {

	                $path = $this->upload->data();
	                $img_url = $path['file_name'];
		            $data = array(
				   'name' => $name,
					    'email' => $email,
					    // 'number' => $number,
				    'profile' => $img_url,
				   
				);
               if ($password) {
				    $data["password"] = $hashed_password;
				}
		            
		        }
		      }else{

		      	$data = array(
					    'name' => $name,
					    'email' => $email,
					    // 'number' => $number,
	
					);
		      	if ($password) {
					    $data["password"] = $hashed_password;
					}
		      }
        
         // print_r($data);die();
		      // Save the data to the manager table using your model function
		            $success = $this->Admin_model->update_admin($id, $data);// print_r($success);die();

		            if ($success) {
		                echo json_encode(array('status' => 'success', 'message' => 'Profile Updated Successfully'));
		            } else {
		            	
		                echo json_encode(array('status' => 'error', 'message' => 'Failed to update data'));
		            }

		    }
		   // }
		    } else {
		        redirect(base_url(), 'refresh');
		    }
	}

	//--------------------------------Branch -------------------------------------- //
	public function add_branch() {
		// Handle form submission to add a new time slot
		$slot = $this->input->post('title');
		
		// Check if a time slot with the same start_time and end_time already exists with isActive set to 1
		$this->db->where('title', $slot);
	
		$this->db->where('isActive', 1);
		$existingTimeSlot = $this->db->get('branch')->row();

		if ($existingTimeSlot) {
			// Time slot with the same start_time and end_time already exists, return an error
			echo json_encode(array('status' => 'error', 'message' => 'Branch  already exists '));
			return;
		}

		// Slot is available, proceed to insert
		$data = array(
			'title' => $this->input->post('title'),
		
		);

		
		$success = $this->db->insert('branch', $data);

		if ($success) {
			

			echo json_encode(array('status' => 'success', 'message' => 'Data saved successfully'));
		} else {
			echo json_encode(array('status' => 'error', 'message' => 'Failed to save data'));
		}
	}


		public function update_branch() {
		// Handle form submission to update an existing time slot
		$id  =$this->input->post('id');
		$data = array(
			'title' => $this->input->post('title'),
		);

		// Update data in the "time_slots" table
		$this->db->where('id', $id);
		$success =   $this->db->update('branch', $data);

		if ($success) {
			
			echo json_encode(array('status' => 'success', 'message' =>'Data updated successfully'));
		} else {
			echo json_encode(array('status' => 'error', 'message' => 'Failed to update data'));
		}
	}

	public function delete_branch() {
		  $id  =$this->input->post('id');
		// Delete a time slot from the "time_slots" table
		$this->db->where('id', $id);
		$success =   $this->db->delete('branch');

		if ($success) {
			
			echo json_encode(array('status' => 'success', 'message' =>'Deleted successfully'));
		} else {
			echo json_encode(array('status' => 'error', 'message' => 'Failed to delete data'));
		}

	  
	}
	public function getbranchByID() {
		// Get the ID parameter from the AJAX request
		$id = $this->input->get('id');

		// Retrieve time slot details directly in the controller
		$this->db->where('id', $id);
		$query = $this->db->get('branch');
		$timeSlot = $query->row();

		// Prepare the response data as an array
		$response = array(
			'id' => $timeSlot->id,
			'title' => $timeSlot->title,
			
		);

		// Send the response as JSON
		echo json_encode($response);
	}

//--------------------------------Events -------------------------------------- //
	public function All_Events()
	{
		$this->checkLogin();
		//
		$query = $this->db->get('announcement');
		$announcement = $query->result();
         $data['announcement'] = $announcement;

		$this->load->view('Backend/admin/all-events',$data);
	}
	// Calander view
	public  function load()
	{
    
	$query = $this->db->get('events');//events
	$appointment_counts = $query->result();


   $data = array();
   $j = 1;

foreach ($appointment_counts as $row) {
    // Convert date format from "DD-MM-YYYY" to "YYYY-MM-DD"
    $start_date = date('Y-m-d', strtotime($row->start_date));
    $end_date = date('Y-m-d', strtotime($row->end_date));
    if($row->color){
		$color = $row->color;
	}else{
		$color = 'bg-info';
	}
   

    $data[] = array(
        'id' => $j,
        'title' => $row->title,
        'start' => $start_date,
        'end' => $end_date,
		'dataid' => $row->id,
		'datauser' => $this->session->userdata('user_login_id'),
		'datadate' => $start_date,
        'className' =>$color.' delete register',
		'color'=>$color
    );
    $j++;
}

	 echo json_encode($data);
  
 }

 public function add_events() {
	// Handle form submission to add a new time slot
	$slot = $this->input->post('title');
	
	// Check if a time slot with the same start_time and end_time already exists with isActive set to 1
	$this->db->where('title', $slot);

	$this->db->where('isActive', 1);
	$existingTimeSlot = $this->db->get('events')->row();

	if ($existingTimeSlot) {
		// Time slot with the same start_time and end_time already exists, return an error
		echo json_encode(array('status' => 'error', 'message' => 'Event  already exists '));
		return;
	}

	// Slot is available, proceed to insert
	$data = array(
		'title' => $this->input->post('title'),
		'start_date' => $this->input->post('start_date'),
		'end_date' => $this->input->post('end_date'),
	
	);

	
	$success = $this->db->insert('events', $data);

	if ($success) {
		echo json_encode(array('status' => 'success', 'message' => 'Data saved successfully'));
	} else {
		echo json_encode(array('status' => 'error', 'message' => 'Failed to save data'));
	}
}


 public function delete_events() {
	$id  =$this->input->post('id');
  // Delete a time slot from the "time_slots" table
  $this->db->where('id', $id);
  $success =   $this->db->delete('events');

  if ($success) {
	  
	  echo json_encode(array('status' => 'success', 'message' =>'Deleted successfully'));
  } else {
	  echo json_encode(array('status' => 'error', 'message' => 'Failed to delete data'));
  }


}


//--------------------------------Leader Board -------------------------------------- //
    public function Leader_Board()
	{
		$this->checkLogin();
		
		$query = $this->db->get('leader_board');
		$announcement = $query->result();
         $data['announcement'] = $announcement;

		$this->load->view('Backend/admin/team',$data);
	}

	public function add_team() {
		// Handle form submission to add a new time slot
		$slot = $this->input->post('title');
		
		// Check if a time slot with the same start_time and end_time already exists with isActive set to 1
		$this->db->where('team', $slot);
	
		$this->db->where('isActive', 1);
		$existingTimeSlot = $this->db->get('leader_board')->row();

		if ($existingTimeSlot) {
			// Time slot with the same start_time and end_time already exists, return an error
			echo json_encode(array('status' => 'error', 'message' => 'Announcement  already exists '));
			return;
		}

		// Slot is available, proceed to insert
		$data = array(
			'team' => $this->input->post('title'),
			'color' => $this->input->post('color'),
		
		);

		
		$success = $this->db->insert('leader_board', $data);

		if ($success) {
			echo json_encode(array('status' => 'success', 'message' => 'Data saved successfully'));
		} else {
			echo json_encode(array('status' => 'error', 'message' => 'Failed to save data'));
		}
	}


		public function update_team() {
		// Handle form submission to update an existing time slot
		$id  =$this->input->post('id');
		$data = array(
			'team' => $this->input->post('title'),
			'color' => $this->input->post('color'),
		);

		// Update data in the "time_slots" table
		$this->db->where('id', $id);
		$success =   $this->db->update('leader_board', $data);

		if ($success) {
			
			echo json_encode(array('status' => 'success', 'message' =>'Data updated successfully'));
		} else {
			echo json_encode(array('status' => 'error', 'message' => 'Failed to update data'));
		}
	}

	public function delete_team() {
		  $id  =$this->input->post('id');
		// Delete a time slot from the "time_slots" table
		$this->db->where('id', $id);
		$success =   $this->db->delete('leader_board');

		if ($success) {
			
			echo json_encode(array('status' => 'success', 'message' =>'Deleted successfully'));
		} else {
			echo json_encode(array('status' => 'error', 'message' => 'Failed to delete data'));
		}

	  
	}
	public function getTeamByID() {
		// Get the ID parameter from the AJAX request
		$id = $this->input->get('id');

		// Retrieve time slot details directly in the controller
		$this->db->where('id', $id);
		$query = $this->db->get('leader_board');
		$timeSlot = $query->row();

		// Prepare the response data as an array
		$response = array(
			'id' => $timeSlot->id,
			'team' => $timeSlot->team,
			'color' => $timeSlot->color,
			
		);

		// Send the response as JSON
		echo json_encode($response);
	}
	//--------------------------------Students -------------------------------------- //
    public function Students()
	{
		$this->checkLogin();
		
		// $query = $this->db->get('admin');
		// $this->db->where(array('isActive'=> '1','user_status'=>'1'));
		// $announcement = $query->result();
	

        $query = $this->db->get_where('admin', array('isActive' => '1', 'user_status' => '1'));
         $announcement = $query->result();

        $data['announcement'] = $announcement;

		$this->load->view('Backend/admin/students',$data);
	}
	//student ID
	public function generateUniqueNumber() {
        $last_student_id = $this->db->select('student_id')->order_by('student_id', 'DESC')->limit(1)->get('admin')->row('student_id');

        if ($last_student_id) {
            $next_student_id = intval($last_student_id) + 1;
        } else {
            $next_student_id = 6000; // Default starting value
        }

        // Check if the generated student ID already exists
        $student_id_exists = $this->db->where('student_id', $next_student_id)->get('admin')->row();

        if ($student_id_exists) {
            // If it already exists, recursively call the function to generate the next unique number
            return $this->generateUniqueNumber();
        } else {
            // If it doesn't exist, return the generated unique number
            return $next_student_id;
        }
    }
	//student ID
	public function add_student()
	{
		$name = $this->input->post('name');
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$number = $this->input->post('number');
		$roll_no = $this->input->post('roll_no');  // Add roll_no field
		$class = $this->input->post('class');      // Add class field
		$branch = $this->input->post('branch');    // Add branch field
		$gender = $this->input->post('gender');    // Add gender field
		$dob = $this->input->post('dob');          // Add dob field
	    
		$student_id = $this->generateUniqueNumber();

		// Perform form validation
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Name', 'required');
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


			 if ($this->login_model->is_email_duplicate($email)) {
			  
				 $response = array(
				  'status' => 'error',
					'message' => 'Email address already exists'
			  );
			} else {
			 
			

		   
		   
			// Encrypt the password
			$encrypted_password = password_hash($password, PASSWORD_BCRYPT);

			// // Save the member details in the database
			// $member_data = array(
			// 	'name' => $name,
			// 	'email' => $email,
			// 	'password' => $encrypted_password,
			  
			//  //    'number' =>$number,
			// 	'role'=>'Member'
			 
			// );
			$member_data = array(
                'name' => $name,
                'email' => $email,
                'password' => $encrypted_password,
                'number' => $number,
                'roll_no' => $roll_no,  // Add roll_no field
                'class' => $class,      // Add class field
                'branch' => $branch,    // Add branch field
                'gender' => $gender,    // Add gender field
                'dob' => $dob,          // Add dob field
                'role' => 'Member',
                'student_id' => $student_id,
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
	public function update_student()
	{
		//$this->checkLogin();
		if ($this->session->userdata('user_login_access') != False) {
	
		    	$id = $this->input->post('id');
		    	$name = $this->input->post('name');
				$email = $this->input->post('email');
				$number = $this->input->post('number');
				$team = $this->input->post('team');
				$roll_no = $this->input->post('roll_no');  // Add roll_no field
				$class = $this->input->post('class');      // Add class field
				$branch = $this->input->post('branch');    // Add branch field
				$gender = $this->input->post('gender');    // Add gender field
				$dob = $this->input->post('dob');          // Add dob field
				$password = $this->input->post('password');
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                //new
			

		        $this->load->library('form_validation');
		        $this->form_validation->set_error_delimiters();
		        $this->form_validation->set_rules('name', 'Name', 'trim|required|max_length[255]|xss_clean');
               $this->form_validation->set_rules('email', 'Email ID', 'trim|required|max_length[255]|valid_email|xss_clean');
			
		        // Add more validation rules as needed for other fields

		        if ($this->form_validation->run() == FALSE) {
		            echo validation_errors();
		            // Handle validation errors
		        } else {


		        
 
			//      if($_FILES['file_url']['name']){
	        //     $file_name = $_FILES['file_url']['name'];
			// 	$fileSize = $_FILES["file_url"]["size"]/1024;
			// 	$fileType = $_FILES["file_url"]["type"];
			// 	$new_file_name='';
	        //     $new_file_name .= $file_name;

	        //     $config = array(
	        //         'file_name' => $new_file_name,
	        //         'upload_path' => "./assets/uploads/users_profile",
	        //         'allowed_types' => "gif|jpg|png|jpeg|pdf|doc|docx",
	        //         'overwrite' => False,
	        //         'max_size' => "50720000"
	        //     );
	        //     //create directory
	        //       if(!is_dir($config['upload_path'])) mkdir($config['upload_path'], 0777, TRUE);
	    
	        //     $this->load->library('Upload', $config);
	        //     $this->upload->initialize($config);                
	        //     if (!$this->upload->do_upload('file_url')) {
	        //         echo $this->upload->display_errors();
	        //         #redirect("notice/All_notice");
			// 	}

	   
			// 	else {

	        //         $path = $this->upload->data();
	        //         $img_url = $path['file_name'];
		    //         $data = array(
			// 	    'name' => $name,
			// 	    'email' => $email,
				
			// 	    'number' => $number,
			// 	    'team' => $team,
				   
				   
			// 	);
            //    if ($password) {
			// 	    $data["password"] = $hashed_password;
			// 	}
		            
		    //     }
		    //   }else{

					$data = array(
						'name' => $name,
						'email' => $email,
					
						'number' => $number,
						'roll_no' => $roll_no,  // Add roll_no field
						'class' => $class,      // Add class field
						'branch' => $branch,    // Add branch field
						'gender' => $gender,    // Add gender field
						'dob' => $dob,          // Add dob field
						'role' => 'Member'
					);
		      	if ($password) {
					    $data["password"] = $hashed_password;
					}
		    //  }
               
            //  print_r($data);die();

		      // Save the data to the manager table using your model function
		            $success = $this->Admin_model->update_admin($id,$data);// print_r($success);die();

		            if ($success) {
		            	$data["id"] = $id;
		            	
		            
		                echo json_encode(array('status' => 'success', 'message' => 'Data Added successfully'));
		            } else {
		            	
		                echo json_encode(array('status' => 'error', 'message' => 'Failed to update data'));
		            }

		    }
		   // }
		    } else {
		        redirect(base_url(), 'refresh');
		    }
	} 
	public function getstudentsByID() {
		// Get the ID parameter from the AJAX request
		$id = $this->input->get('id');

		// Retrieve time slot details directly in the controller
		$this->db->where('id', $id);
		$query = $this->db->get('admin');
		$member = $query->row();

		// Prepare the response data as an array
		$response = array(
			'id' => $member->id,
			
			'name' => $member->name,
			'email' =>  $member->email,
	
			'team' => $member->team,
			'number' =>  $member->number,
			'roll_no' => $member->roll_no,
			'class' => $member->class,
			'branch' => $member->branch,
			'gender' => $member->gender,
			'dob' => $member->dob,
			
		);

		// Send the response as JSON
		echo json_encode($response);
	}

	public function delete_student() {
		$id  =$this->input->post('id');
	  // Delete a time slot from the "time_slots" table
	  $this->db->where('id', $id);
	  $success =   $this->db->delete('admin');

	  if ($success) {
		  
		  echo json_encode(array('status' => 'success', 'message' =>'Deleted successfully'));
	  } else {
		  echo json_encode(array('status' => 'error', 'message' => 'Failed to delete data'));
	  }

	
  }


//--------------------------------Payment -------------------------------------- //
public function Points()
{
	$this->checkLogin();
	
	$query = $this->db->get('payment');
	$announcement = $query->result();
	 $data['announcement'] = $announcement;

	$this->load->view('Backend/admin/points',$data);
}

public function add_points() {
	// Handle form submission to add a new time slot
	$slot = $this->input->post('student');
	$amount = $this->input->post('amount');
	$date = $this->input->post('date');
	$status = $this->input->post('status');
	
	// Check if a time slot with the same start_time and end_time already exists with isActive set to 1
	$this->db->where('student', $slot);
	$this->db->where('date', $date);

	$this->db->where('isActive', 1);
	$existingTimeSlot = $this->db->get('payment')->row();

	if ($existingTimeSlot) {
		// Time slot with the same start_time and end_time already exists, return an error
		echo json_encode(array('status' => 'error', 'message' => 'Data  already exists '));
		return;
	}

	// Slot is available, proceed to insert
	$data = array(
		'student' => $this->input->post('student'),
		'amount' => $this->input->post('amount'),
		'date' => $this->input->post('date'),
		'status' => $this->input->post('status'),
	
	);

	
	$success = $this->db->insert('payment', $data);

	if ($success) {
		echo json_encode(array('status' => 'success', 'message' => 'Data saved successfully'));
	} else {
		echo json_encode(array('status' => 'error', 'message' => 'Failed to save data'));
	}
}


	public function update_points() {
	// Handle form submission to update an existing time slot
	$id  =$this->input->post('id');
	$data = array(
		'student' => $this->input->post('student'),
		'amount' => $this->input->post('amount'),
		'date' => $this->input->post('date'),
		'status' => $this->input->post('status'),
	
	);

	// Update data in the "time_slots" table
	$this->db->where('id', $id);
	$success =   $this->db->update('payment', $data);

	if ($success) {
		
		echo json_encode(array('status' => 'success', 'message' =>'Data updated successfully'));
	} else {
		echo json_encode(array('status' => 'error', 'message' => 'Failed to update data'));
	}
}

public function delete_points() {
	  $id  =$this->input->post('id');
	// Delete a time slot from the "time_slots" table
	$this->db->where('id', $id);
	$success =   $this->db->delete('payment');

	if ($success) {
		
		echo json_encode(array('status' => 'success', 'message' =>'Deleted successfully'));
	} else {
		echo json_encode(array('status' => 'error', 'message' => 'Failed to delete data'));
	}

  
}
public function getPointsByID() {
	// Get the ID parameter from the AJAX request
	$id = $this->input->get('id');

	// Retrieve time slot details directly in the controller
	$this->db->where('id', $id);
	$query = $this->db->get('payment');
	$timeSlot = $query->row();

	// Prepare the response data as an array
	$response = array(
		'id' => $timeSlot->id,
		
		'student' => $timeSlot->student,
		'amount' => $timeSlot->amount,
		'date' => $timeSlot->date,
		'status' => $timeSlot->status,
		
	);

	// Send the response as JSON
	echo json_encode($response);
}

//--------------------------------exam-results -------------------------------------- //
public function ExamResults()
{
	$this->checkLogin();
	
	$query = $this->db->get('results');
	$announcement = $query->result();
	$data['announcement'] = $announcement;

	$query2 = $this->db->get_where('results', array('isActive' => '1','student'=> $this->session->userdata('user_login_id')));
	$announcement1 = $query2->result();
	$data['announcement1'] = $announcement1;

	$this->load->view('Backend/admin/exam-results',$data);
}

public function add_ExamResults() {
	// Handle form submission to add a new time slot
	$slot = $this->input->post('student');
	$semester = $this->input->post('semester');
	$percentage = $this->input->post('percentage');
	$result = $this->input->post('result');
	
	// Check if a time slot with the same start_time and end_time already exists with isActive set to 1
	$this->db->where('student', $slot);
	$this->db->where('semester', $semester);

	$this->db->where('isActive', 1);
	$existingTimeSlot = $this->db->get('results')->row();

	if ($existingTimeSlot) {
		// Time slot with the same start_time and end_time already exists, return an error
		echo json_encode(array('status' => 'error', 'message' => 'Data  already exists '));
		return;
	}

	// Slot is available, proceed to insert
	$data = array(
		'student' => $this->input->post('student'),
		'semester' => $this->input->post('semester'),
		'percentage' => $this->input->post('percentage'),
		'result' => $this->input->post('result'),
		'payment' => $this->input->post('payment')
	
	);

	
	$success = $this->db->insert('results', $data);

	if ($success) {
		echo json_encode(array('status' => 'success', 'message' => 'Data saved successfully'));
	} else {
		echo json_encode(array('status' => 'error', 'message' => 'Failed to save data'));
	}
}


	public function update_ExamResults() {
	// Handle form submission to update an existing time slot
	$id  =$this->input->post('id');
	$data = array(
		'student' => $this->input->post('student'),
		'semester' => $this->input->post('semester'),
		'percentage' => $this->input->post('percentage'),
		'result' => $this->input->post('result'),
		'payment' => $this->input->post('payment')
	
	);

	// Update data in the "time_slots" table
	$this->db->where('id', $id);
	$success =   $this->db->update('results', $data);

	if ($success) {
		
		echo json_encode(array('status' => 'success', 'message' =>'Data updated successfully'));
	} else {
		echo json_encode(array('status' => 'error', 'message' => 'Failed to update data'));
	}
}

public function delete_ExamResults() {
	  $id  =$this->input->post('id');
	// Delete a time slot from the "time_slots" table
	$this->db->where('id', $id);
	$success =   $this->db->delete('results');

	if ($success) {
		
		echo json_encode(array('status' => 'success', 'message' =>'Deleted successfully'));
	} else {
		echo json_encode(array('status' => 'error', 'message' => 'Failed to delete data'));
	}

  
}
public function getExamResultsByID() {
	// Get the ID parameter from the AJAX request
	$id = $this->input->get('id');

	// Retrieve time slot details directly in the controller
	$this->db->where('id', $id);
	$query = $this->db->get('results');
	$timeSlot = $query->row();

	// Prepare the response data as an array
	$response = array(
		'id' => $timeSlot->id,
		
		'student' => $timeSlot->student,
		'semester' => $timeSlot->semester,
		'percentage' => $timeSlot->percentage,
		'result' => $timeSlot->result,
		
	);

	// Send the response as JSON
	echo json_encode($response);
}

//
	//--------------------------------Event card -------------------------------------- //
	public function event_card()
	{
		$this->checkLogin();
		//
		$query = $this->db->get('event_card');
		$announcement = $query->result();
         $data['announcement'] = $announcement;

		$this->load->view('Backend/admin/event-card',$data);
	}

	public function add_event_card() {
		// Handle form submission to add a new time slot
		$slot = $this->input->post('title');
		
		// Check if a time slot with the same start_time and end_time already exists with isActive set to 1
		$this->db->where('title', $slot);
	
		$this->db->where('isActive', 1);
		$existingTimeSlot = $this->db->get('event_card')->row();

		if ($existingTimeSlot) {
			// Time slot with the same start_time and end_time already exists, return an error
			echo json_encode(array('status' => 'error', 'message' => 'Event  already exists '));
			return;
		}

		// // Slot is available, proceed to insert
		// $data = array(
		// 	'title' => $this->input->post('title'),
		
		// );
		if($_FILES['file_url']['name']){
			$file_name = $_FILES['file_url']['name'];
			$fileSize = $_FILES["file_url"]["size"]/1024;
			$fileType = $_FILES["file_url"]["type"];
			$new_file_name='';
			$new_file_name .= $file_name;

			$config = array(
				'file_name' => $new_file_name,
				'upload_path' => "./assets/uploads/profile",
				'allowed_types' => "gif|jpg|png|jpeg|pdf|doc|docx",
				'overwrite' => False,
				'max_size' => "50720000"
			);
			//create directory
			  if(!is_dir($config['upload_path'])) mkdir($config['upload_path'], 0777, TRUE);
	
			$this->load->library('Upload', $config);
			$this->upload->initialize($config);                
			if (!$this->upload->do_upload('file_url')) {
				echo $this->upload->display_errors();
				#redirect("notice/All_notice");
			}

   
			else {

				$path = $this->upload->data();
				$img_url = $path['file_name'];
				$data = array(
					'title' => $this->input->post('title'),
					'desc' => $this->input->post('desc'),
					'team' => $this->input->post('team'),
					'file_url' => $img_url,
			   
			);
		   
				
			}
		  }else{

			  $data = array(
				'title' => $this->input->post('title'),
				'desc' => $this->input->post('desc'),
				'team' => $this->input->post('team'),

				);
			 
		  }

		
		$success = $this->db->insert('event_card', $data);

		if ($success) {
			echo json_encode(array('status' => 'success', 'message' => 'Data saved successfully'));
		} else {
			echo json_encode(array('status' => 'error', 'message' => 'Failed to save data'));
		}
	}



		public function update_event_card() {
		// Handle form submission to update an existing time slot
		$id  =$this->input->post('id');
		// $data = array(
		// 	'title' => $this->input->post('title'),
		// );

		if($_FILES['file_url']['name']){
			$file_name = $_FILES['file_url']['name'];
			$fileSize = $_FILES["file_url"]["size"]/1024;
			$fileType = $_FILES["file_url"]["type"];
			$new_file_name='';
			$new_file_name .= $file_name;

			$config = array(
				'file_name' => $new_file_name,
				'upload_path' => "./assets/uploads/profile",
				'allowed_types' => "gif|jpg|png|jpeg|pdf|doc|docx",
				'overwrite' => False,
				'max_size' => "50720000"
			);
			//create directory
			  if(!is_dir($config['upload_path'])) mkdir($config['upload_path'], 0777, TRUE);
	
			$this->load->library('Upload', $config);
			$this->upload->initialize($config);                
			if (!$this->upload->do_upload('file_url')) {
				echo $this->upload->display_errors();
				#redirect("notice/All_notice");
			}

   
			else {

				$path = $this->upload->data();
				$img_url = $path['file_name'];
				$data = array(
					'title' => $this->input->post('title'),
					'desc' => $this->input->post('desc'),
					'team' => $this->input->post('team'),
					'file_url' => $img_url,
			   
			);
		   
				
			}
		  }else{

			  $data = array(
				'title' => $this->input->post('title'),
				'desc' => $this->input->post('desc'),
				'team' => $this->input->post('team'),

				);
			 
		  }

		// Update data in the "time_slots" table
		$this->db->where('id', $id);
		$success =   $this->db->update('event_card', $data);

		if ($success) {
			
			echo json_encode(array('status' => 'success', 'message' =>'Data updated successfully'));
		} else {
			echo json_encode(array('status' => 'error', 'message' => 'Failed to update data'));
		}
	}

	public function delete_event_card() {
		  $id  =$this->input->post('id');
		// Delete a time slot from the "time_slots" table
		$this->db->where('id', $id);
		$success =   $this->db->delete('event_card');

		if ($success) {
			
			echo json_encode(array('status' => 'success', 'message' =>'Deleted successfully'));
		} else {
			echo json_encode(array('status' => 'error', 'message' => 'Failed to delete data'));
		}

	  
	}
	public function getevent_cardByID() {
		// Get the ID parameter from the AJAX request
		$id = $this->input->get('id');

		// Retrieve time slot details directly in the controller
		$this->db->where('id', $id);
		$query = $this->db->get('event_card');
		$timeSlot = $query->row();

		// Prepare the response data as an array
		$response = array(
			'id' => $timeSlot->id,
			'title' => $timeSlot->title,
			'desc' => $timeSlot->desc,
			'team' => $timeSlot->team,
			
		);

		// Send the response as JSON
		echo json_encode($response);
	}

	
	
}
