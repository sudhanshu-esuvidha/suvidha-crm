<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends MY_Controller  {
	public function __construct(){
 parent::__construct();
       $this->load->database();
       $this->load->model('Common_Model');
	   $this->load->library('session');
	   }
 public function index()
 {
    $this->load->view('index');  
 }	
 
 public function csvread()
 {
    // $csv = str_getcsv(file_get_contents('kajal.csv'));
     $arrayFromCSV =  array_map('str_getcsv', file('madhuri.csv'));
     //print_r($arrayFromCSV); die;
     foreach($arrayFromCSV as $key=> $row)
     {
         if($key>0)
         {
            //  $data=array(
            //       'contact_name'=>$row[0],
            //       'mobile_no'=>$row[2],
            //       'email'=>$row[1],
            //       'owner_name'=>$row[0],
            //       'branch_id'=>3,
            //       'address'=>$row[3],
            //       'description'=>$row[4],
            //       //'source_id'=>5,
            //       'assign_to'=>3,
            //       'remark'=>$row[7],
            //       'created_by'=>1,
            //       );

             
         $data=array(
                  'contact_name'=>$row[1],
                  'mobile_no'=>$row[3],
                  'email'=>$row[2],
                  'owner_name'=>$row[1],
                  'branch_id'=>3,
                  'address'=>$row[4],
                  'description'=>$row[5],
                  //'source_id'=>5,
                  'assign_to'=>3,
                  'remark'=>$row[8],
                  'created_by'=>1,
                  );
                   
     // $lead_id= $this->Common_Model->insert('leads',$data); 
      $data2=array(
              'lead_id'=>$lead_id,
              'created_by'=>1,
              'remark'=>$row[8],
              'date_created'=>'2024-07-16'
              
                  );
       // $this->Common_Model->insert('lead_status_log',$data2);   
        echo $lead_id."<br>";
         }          
     }
 }
 
     
}
