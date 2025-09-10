<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//ini_set('display_errors', 1);
class ComingSoon extends MY_Controller
 {
 	   public function __construct()
 	   {
       parent::__construct();
       $this->load->database();
       $this->load->model('Common_Model');
	     $this->load->library('session');
	     //if(!$this->session->userdata('site_userid')) {	redirect('/');  }
	   }
      public function index()
      {

        
      	$user_id=$this->session->userdata('site_userid');
	      $user=$this->Common_Model->get_row('users','*',array('id'=>$user_id));
	      $this->session->set_userdata('user_info',$user);
	      $data['user']=$this->session->userdata('user_info');
	      $role=$this->session->userdata('site_role');
	      $data['heading']="DASHBOARD";
           $this->load->view('ComingSoon',$data);
	     
		    
      }
       

    
}