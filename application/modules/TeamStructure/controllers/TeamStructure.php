<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TeamStructure extends MY_Controller
 {
	public function __construct()
	{
        parent::__construct();
        $this->load->database();
        $this->load->model('Common_Model');
	  $this->load->library('session');
	  if(!$this->session->userdata('site_userid'))
	   {
	  	redirect('/');
	   }
	   
      }
      public function list()
      {
        $role_id=$this->uri->segment(3);
        $role=get_row('master_table',' where id='.$role_id);
	    $data['result']=get_all_list('users',' where role='.$role_id.' order by id desc');
	    $data['title']=$role->name."/list";
        $data['heading']=$role->name." List";
	    $data['user']=$this->session->userdata('user_info');
	    $data['role']=$role;
   	    $this->load->view('list',$data);
      }
     
public function add()
{
    $role_id = $this->uri->segment(3);
    $role = get_row('master_table', ' where id=' . $role_id);
    $data['role'] = $role;

    if ($this->input->post()) {

        $parent_id = $this->session->userdata('user_info')->id;

        // Check 5-user limit for new users
        if (!$this->uri->segment(4)) {
            $this->db->where('parent_id', $parent_id);
            $child_count = $this->db->count_all_results('user_details');

            if ($child_count >= 5) {
                $this->session->set_flashdata('error', 'You can create a maximum of 5 users under your account.');
                redirect(base_url() . 'TeamStructure/add/' . $role_id);
                return;
            }
        }

        $dob = $this->input->post('dob') ?? "0000-00-00";

        $row = get_row('users', ' where username="' . $this->input->post('email') . '"');
        if ($row && !$this->uri->segment(4)) {
            $this->session->set_flashdata('error', 'Email already registered!');
            redirect(base_url() . 'TeamStructure/add/' . $role_id);
            return;
        }

        // Name
        $name = $this->input->post('first_name') . ' ' . $this->input->post('last_name');

        // PASSWORD HANDLING
        $password = $this->input->post('password');
        $confirm_password = $this->input->post('confirm_password');
        $encrypted_password = null;

        if ($password) {
            if ($password !== $confirm_password) {
                $this->session->set_flashdata('error', 'Password and Confirm Password do not match!');
                redirect(current_url());
                return;
            }
            $encrypted_password = $this->encrypt_decrypt('encrypt', $password);
        }

        // INSERT OR UPDATE USERS TABLE
        if (!$this->uri->segment(4)) {
            // New user
            $user_data = [
                'username' => $this->input->post('email'),
                'role'     => $role_id,
                'name'     => $name
            ];
            if ($encrypted_password) {
                $user_data['password'] = $encrypted_password;
            }

            $user_id = $this->Common_Model->insert('users', $user_data);

            // Send Create Password Email if password not set
            if (!$password) {
                $key = rand(1000000000, 9999999999);
                $link = base_url() . "create_password/?key=" . $key;
                $this->Common_Model->update('users', [
                    'create_password_key'  => $key,
                    'create_password_time' => date("H:i:s")
                ], ['id' => $user_id]);

                $message = '<strong>Hello ' . $name . '</strong><br>Your registration is successful in CRM, now you can create your password by clicking this button. <br><a href="' . $link . '" class="f-fallback button button--green" target="_blank">Create password</a><br>If you did not request this, please ignore. Link valid for 24 hours.<br>' . $link;

                $this->send_mail($this->input->post('email'), $message, 'Generate Your Password');
            }

        } else {
            // Update existing user
            $user_id = $this->uri->segment(4);
            $update_data = ['name' => $name];
            if ($encrypted_password) {
                $update_data['password'] = $encrypted_password;
            }
            $this->Common_Model->update('users', $update_data, ['id' => $user_id]);
        }

        // INSERT OR UPDATE USER_DETAILS TABLE
        $data2 = [
            'user_id'    => $user_id,
            'email'      => $this->input->post('email'),
            'mobile_no'  => $this->input->post('mobile_no'),
            'branch'     => $this->input->post('branch'),
            'parent_id'  => $parent_id,
            'first_name' => $this->input->post('first_name'),
            'last_name'  => $this->input->post('last_name'),
            'father_name'=> $this->input->post('father_name'),
            'dob'        => $dob,
            'gender'     => $this->input->post('gender'),
            'address'    => $this->input->post('address'),
        ];

        if (!$this->uri->segment(4)) {
            $this->Common_Model->insert('user_details', $data2);
            $this->session->set_flashdata('success', 'User successfully created! <br>' . ($password ? '' : 'An email sent to user email id for create password!'));
        } else {
            $this->Common_Model->update('user_details', $data2, ['user_id' => $user_id]);
            $this->session->set_flashdata('success', 'User successfully updated!');
        }

        redirect(base_url() . 'TeamStructure/list/' . $role_id);

    } else {
        // SHOW FORM
        $data['title'] = $role->name . '/Add';
        $data['heading'] = $role->name . ' Add';
        $data['user'] = $this->session->userdata('user_info');
        $data['data'] = "";

        if ($this->uri->segment(4)) {
            $data['data']  = $this->Common_Model->get_row('user_details', '*', ['user_id' => $this->uri->segment(4)]);
            $data['data2'] = $this->Common_Model->get_row('users', '*', ['id' => $this->uri->segment(4)]);
        }

        $this->load->view('add', $data);
    }
}

/**
 * AES-256-CBC encrypt/decrypt
 */
private function encrypt_decrypt($action, $string) {
    $output = false;
    $encrypt_method = "AES-256-CBC";
    $secret_key = 'e9b8b1596fbb58954dfae1fd6baa8dea';
    $secret_iv  = 'e9b8b1596fbb58954dfae1fd6baa8dea';

    $key = hash('sha256', $secret_key);
    $iv = substr(hash('sha256', $secret_iv), 0, 16);

    if ($action == 'encrypt') {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    } elseif ($action == 'decrypt') {
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }
    return $output;
}




public function edit_user()
{
	if($this->input->post())
	{
        $id=$this->uri->segment(3);
       $user_details=get_row('user_details',' where user_id='.$id); 
       
		
        $data=array(
          
           
            'name'=>$this->input->post('name_of_officer'),
            'user_id'=>$id,
                 // 'designation_id'=>$this->input->post('designation'),
                 // 'email_id'=>$this->input->post('email'),
                 // 'mobile_no'=>$this->input->post('mobile_no'),
                 // 'phone'=>$this->input->post('contact_no'),
                 // 'address'=>$this->input->post('address'),
                 // //'website'=>$this->input->post('website'),
                 // 'profile_update'=>1
                    );
         if($user_details)
         {
                $this->Common_Model->update('user_details',$data,array('user_id'=>$id));
         }
         else
         {
            $this->Common_Model->insert('user_details',$data);
         }
       
        	
            if($this->input->post('change_password'))
            {
                $this->Common_Model->update('users',array('password'=>encrypt_decrypt('encrypt',$this->input->post('password'))),array('id'=>$id));
            }
        	if($id)
        	{
        		$this->session->set_flashdata('success',' User Details Successfully Updated');
        		redirect(base_url().'Users/list');
        	}
       
	}
	else
	{
		$data['data']=$this->Common_Model->get_row('users','*',array('id'=>$this->uri->segment(3)));
        $data['user_details']=$this->Common_Model->get_row('user_details','*',array('user_id'=>$this->uri->segment(3)));
		$data['user']=$this->session->userdata('user_info');
		$data['title']='User/Edit';
		$this->load->view('edit_user',$data);
	}
}


public function uploads_file($path,$fileName)
{
 if(!empty($_FILES[$fileName]['name']))
 {
   if (!file_exists($path)) {
    mkdir($path, 0777, true);
  }
          // Define new $_FILES array - $_FILES['file']
  $_FILES['file']['name'] = $_FILES[$fileName]['name'];
  $_FILES['file']['type'] = $_FILES[$fileName]['type'];
  $_FILES['file']['tmp_name'] = $_FILES[$fileName]['tmp_name'];
  $_FILES['file']['error'] = $_FILES[$fileName]['error'];
  $_FILES['file']['size'] = $_FILES[$fileName]['size'];
          // Set preference
  $config['upload_path'] = $path; 
  $config['allowed_types'] = '*';
    //      $config['max_size'] = '5000'; // max_size in kb
        //  $config['file_name'] = $fileName;
          $config['overwrite'] = TRUE;
          //Load upload library
          $this->load->library('upload',$config); 
          $this->upload->initialize($config);
          // File upload
          if($this->upload->do_upload('file')){
            // Get data about the file
            $uploadData = $this->upload->data();
            $filename = $uploadData['file_name'];
            return $filename;
            // Initialize array
          // return $data['filenames'][] = $filename;
          }
          else
          {
              $error = array('error' => $this->upload->display_errors());
              print_r($error);
          }
        }
      }
 public function uploads_files($path,$fileName)
{
   
 if(!empty($_FILES['image']))
 {
   if (!file_exists($path)) {
    mkdir($path, 0777, true);
  }
  $total = count($_FILES['image']['name']);

              // Loop through each file
              for( $i=0 ; $i < $total ; $i++ )
               {
          // Define new $_FILES array - $_FILES['file']
  $_FILES['file']['name'] = $_FILES['image']['name'][$i];
  $_FILES['file']['type'] = $_FILES['image']['type'][$i];
  $_FILES['file']['tmp_name'] = $_FILES['image']['tmp_name'][$i];
  $_FILES['file']['error'] = $_FILES['image']['error'][$i];
  $_FILES['file']['size'] = $_FILES['image']['size'][$i];
          // Set preference
  $config['upload_path'] = $path; 
  $config['allowed_types'] = '*';
    //      $config['max_size'] = '5000'; // max_size in kb
        //  $config['file_name'] = $fileName;
          $config['overwrite'] = TRUE;
          //Load upload library
          $this->load->library('upload',$config); 
          $this->upload->initialize($config);
          // File upload
          if($this->upload->do_upload('file')){
            // Get data about the file
            $uploadData = $this->upload->data();
            $filename[] = $uploadData['file_name'];
            
            // Initialize array
          // return $data['filenames'][] = $filename;
          }
          else
          {
              $error = array('error' => $this->upload->display_errors());
             // print_r($error);
          }
        }
      }
      
      return $filename;
      }

      public function feedbackForm()
      {
        $lead_id=$this->input->post('lead_id');
         $data=array(
            
            'priority_id'=>$this->input->post('priority_id'),
            'status_id'=>$this->input->post('status_id'),
            'remark'=>$this->input->post('remark'),
            'assign_to'=>$this->input->post('assign_to'),
            'status'=>1,
                     );
           $this->Common_Model->update('leads',$data,array('id'=>$lead_id));  

           $data=array(
                     'lead_id'=>$lead_id,
                     'status'=>$this->input->post('status_id'),
                     'created_by'=>$this->session->userdata('site_userid'),
                     'remark'=>$this->input->post('remark'),
                       ); 


            $logid=$this->Common_Model->insert('lead_status_log',$data); 

            if($this->input->post('next_followup'))
           {
             $next_followup= date("Y-m-d H:i:s ",strtotime($this->input->post('next_followup')));
            $this->Common_Model->update('leads',array('next_followup'=>$next_followup),array('id'=>$lead_id));
            $this->Common_Model->update('lead_status_log',array('next_followup'=>$next_followup),array('id'=>$logid));
           }         
           $this->session->flashdata('success','Data successfully submitted!');
           redirect(base_url().'Dashboard');
      }
      public function send_mail($to_email,$message,$subject)
    {

    $config['protocol']    = 'smtp';
       $config['smtp_host']    = 'mail.walltekpaint.co.in';
            $config['smtp_user']    = 'info@walltekpaint.co.in';
            $config['smtp_pass']    = '[o$-F)Ic?SHq';
            $config['smtp_port']    = 587;
        $config['charset']    = 'utf-8';
        $config['newline']    = "\r\n";
        $config['mailtype'] = 'html'; // or html
        $config['validation'] = TRUE; // bool whether to validate email or not      
        $this->load->library('email');
        $this->email->initialize($config);

        $this->email->from('info@walltekpaint.co.in');
        $this->email->to($to_email); 

        $this->email->subject($subject);
        $this->email->message($message);  

     $this->email->send();

    $this->email->print_debugger();

      } 
      public function test_mail()
      {
          $data['name']="Shyam Bairagi";
          $key=encrypt_decrypt('encrypt',rand(10000000,99999999)); 
          $this->Common_Model->update('users',array('create_password_key'=>$key,'create_password_time'=>date("H:i:s")),array('id'=>4));
         // echo $this->db->last_query();
          $data['link']=base_url()."create_password/".$key;
          $this->load->view('EmailTemplate/create_password',$data);
          
          //echo $this->send_mail('shyam.sakura0921@gmail.com','hello','testing');
      }
     public function delete_user($id)
{
    $role_id = $this->uri->segment(4); // get role_id from 4th segment

    if($id){
        // Delete from user_details first
        $this->Common_Model->delete('user_details', array('user_id' => $id));

        // Delete from users table
        $this->Common_Model->delete('users', array('id' => $id));

        $this->session->set_flashdata('success','User deleted successfully.');
    } else {
        $this->session->set_flashdata('error','Invalid User ID.');
    }

    // Redirect back to the list page of the same role
    redirect(base_url('TeamStructure/list/'.$role_id));
}

}