<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller  {
	public function __construct(){
 parent::__construct();
       $this->load->database();
       $this->load->model('Common_Model');
	   $this->load->library('session');
	   
	   
	   
      }
	public function index()
	{
		if($this->session->userdata('site_userid'))
	   {
	   	$role=$this->session->userdata('site_role');
	   	   redirect('Dashboard');

	   }
		if($this->input->post())
		{
            $username=$this->input->post('username');
            $password=$this->input->post('password');  
            $user=$this->Common_Model->get_row('users','*',array('username'=>$username));

           
            if($user)
            {
            	if(encrypt_decrypt('encrypt',$password)==$user->password)
            	{
                   $this->session->set_userdata('site_userid',$user->id);
                   $this->session->set_userdata('site_role',$user->role);
                   $role=$this->session->userdata('site_role');
    		       redirect('Dashboard');
                   
            	}
            	else
            	{
            		$this->session->set_flashdata('error','Username or password incorrect!');
            	redirect(base_url().'/login');
            	}

            }
            else
            {
            	$this->session->set_flashdata('error','Username or password incorrect!');
            	redirect(base_url().'/login');
            }
		}
		else
		{
			$this->load->view('login/index');
		} 
		
	}
	public function logout()
	{
		$this->session->set_userdata('site_userid','');
                   $this->session->set_userdata('site_role','');
                   redirect(base_url().'/login');
	}
	public function frontpage()
	{
		$this->load->view('frontpage');
	}
	public function forget_password()
	{
		if($this->input->post())
		{
               $username=$this->input->post('username');
               $row=$this->Common_Model->get_row('users','*',array('username'=>$username));
               if($row)
               {
                   if($row->email_id)
                   {
                   	$forget_password_key=rand(1000000000,9999999999);
                        $this->Common_Model->update('users',array('forget_password_key'=>$forget_password_key),array('id'=>$row->id));
                        $link=base_url()."reset_password/".$forget_password_key;
                        $subject="Reset password ! ";
                        $message='<strong>Hello '.$row->name.'</strong><br>We have received request for your password reset. <br> You can generate your new password by click on this button. <br>
                        <a   href="'.$link.'" class="f-fallback button button--green" target="_blank" style="font-size:24px;">Reset password</a><br>If you did not request a reset password, please ignore this email or reply to let us know. This link only valid for the next 24 hours, so be sure to use it right away.';
                       // $message="We have received request for your password reset <br> <a href='".$link."'>click here</a> for reset new password.";
                        $email_id=$row->email_id;
                         $this->send_mail($email_id,$subject,$message);
                         	$this->session->set_flashdata('success','An email sent to your email id with generate new password link!');
               	       redirect(base_url().'Login/forget_password');
                   }
                   else
                   {
                   	$this->session->set_flashdata('error','email id not registered with entered username!');
               	       redirect(base_url().'Login/forget_password');
                   }
               }
               else
               {
               	$this->session->set_flashdata('error','Email Id not registered!');
               	redirect(base_url().'Login/forget_password');
               }
		}
		else
		{
			$this->load->view('forget_password');
		}
		
	}
	public function send_mail($to_email,$subject,$message)
    {

    $config['protocol']    = 'smtp';
    
     $config['smtp_host']    = 'mail.walltekpaint.co.in';
            $config['smtp_user']    = 'info@walltekpaint.co.in';
            $config['smtp_pass']    = '[o$-F)Ic?SHq';

       
        $config['smtp_port']    = '587';
        //$config['smtp_timeout'] = '7';
       
        $config['charset']    = 'utf-8';
        $config['newline']    = "\r\n";
        $config['mailtype'] = 'html'; // or html
        $config['validation'] = TRUE; // bool whether to validate email or not      
        $this->load->library('email');
        $this->email->initialize($config);

        $this->email->from('info@walltekpaint.co.in', 'WALLTEK CRM');
        $this->email->to($to_email); 

        $this->email->subject($subject);
        $this->email->message($message);  

        $this->email->send();

       $this->email->print_debugger(); 

      } 
      public function reset_password()
      {
      	if($this->input->post())
      	{
                   $new_password=$this->input->post('new_password');
                   $cpassword=$this->input->post('cpassword');
                   $user_id=$this->input->post('user_id');
                   $data['user_id']=$user_id;
                   if($new_password!=$cpassword)
                   {
                   	$data['error']="Confirm Password Not Match!";
                   	$this->load->view('login/reset_password',$data);
                   }
                   else
                   {
                   	if($this->Common_Model->update('users',array('password'=>encrypt_decrypt('encrypt',$new_password),'forget_password_key'=>''),array('id'=>$user_id)))
                   	{
                   		redirect(base_url().'reset_password_success');
                   	}
                   }
      	}
      	else
      	{


      	$forget_password_key=$this->uri->segment(2);
      	$row=$this->Common_Model->get_row('users','*',array('forget_password_key'=>$forget_password_key));
      	if($row)
      	{
               $data['user_id']=$row->id;
      	}
      	else
      	{
      		$data['link_expired']="Link expired!";
      	}
      	$this->load->view('login/reset_password',$data);
         }
      }
      public function reset_password_success()
      {
      	$this->load->view('login/reset_password_success');
      }
      public function send_mail_test()
    {

   $this->load->library('email');
$config['protocol'] = 'sendmail';
$config['mailpath'] = '/usr/sbin/sendmail';
$config['charset'] = 'iso-8859-1';
$config['wordwrap'] = TRUE;

$this->email->initialize($config);
$this->email->from('admin@testservers.org', 'Your Name');
$this->email->to('shyambrg.mca.bpl@gmail.com');
 
$this->email->subject('Email Test');
$this->email->message('Testing the email class.');

$this->email->send();

      } 
      
      public function create_password()
      {
          if($this->input->post())
          {
              $password=$this->input->post('password');
              $cpassword=$this->input->post('cpassword');
              if($password!=$cpassword)
              {
                  $this->session->set_flashdata('error','Confirm password not match!');
                  redirect(base_url().'create_password/?key='.$_GET['key']);
              }
              else
              {
                  $key=trim($_GET['key']);
                  $row=$this->Common_Model->get_row('users','*',array('create_password_key'=>$key));
                  $this->Common_Model->update('users',array('create_password_key'=>'','password'=>encrypt_decrypt('encrypt',$password)),array('id'=>$row->id));
                  echo '<h1 style="color:green;">Your password successfully created go to crm login!</h1>';
                  
              }
          }
          else
          {
           $key=trim($_GET['key']);
           $row=$this->Common_Model->get_row('users','*',array('create_password_key'=>$key));
          
           if($row)
           {
               $this->load->view('create_password');
           }
           else
           {
               echo '<h1 style="color:red;">Link Invalid!</h1>';
           }
          }
      }
      
}
