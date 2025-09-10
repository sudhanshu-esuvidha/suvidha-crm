<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Leads extends MY_Controller
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

      $where="";
      if($_GET['assign_to'])
      {
        $where.=" and assign_to=".$_GET['assign_to'];
      }
      if($_GET['status'])
      {
        $where.=" and status_id=".$_GET['status'];
      }
      
      $data['total']=get_total_of_table('leads',' where id>0 '.$where);
	    $data['result']=get_all_list('leads',' where id>0 '.$where.'  order by id desc LIMIT 0,50 ');
	    $data['title']="Leads/list";
        $data['heading']="Lead List";
	    $data['user']=$this->session->userdata('user_info');
   	    $this->load->view('list',$data);
      }
      public function pending_followup()
      {
           $user=$this->session->userdata('user_info');
        $date=date("Y-m-d");
        $data['result']=get_all_list('leads',' where cast(next_followup as date)<"'.$date.'" and assign_to='.$user->id.' order by id desc');
        $data['title']="Leads/list";
        $data['heading']="Pending Followup";
        $data['user']=$this->session->userdata('user_info');
        $this->load->view('list',$data);
      }
      public function today_followup()
      {
          $user=$this->session->userdata('user_info');
        $date=date("Y-m-d");
        $data['result']=get_all_list('leads',' where cast(next_followup as date)="'.$date.'" and assign_to='.$user->id.' order by id desc ');
        $data['title']="Leads/list";
        $data['heading']="Today Followup";
        $data['user']=$this->session->userdata('user_info');
        $this->load->view('list',$data);
      }

      public function tomorrow_followup()
      {
           $user=$this->session->userdata('user_info');
        $date=date("Y-m-d");
        $date=date('Y-m-d', strtotime($date.' + 1 day'));
        $data['result']=get_all_list('leads',' where cast(next_followup as date)="'.$date.'" and assign_to='.$user->id.' order by id desc');
        $data['title']="Leads/list";
        $data['heading']="Tomorrow Followup";
        $data['user']=$this->session->userdata('user_info');
        $this->load->view('list',$data);
      }
      public function add()
     {
        	if($this->input->post())
        	{
          
         $data=array(
            'contact_name'=>$this->input->post('contact_name'),
            'mobile_no'=>$this->input->post('mobile_no'),
            'email'=>$this->input->post('email'),
            'owner_name'=>$this->input->post('owner_name'),
            'branch_id'=>$this->input->post('branch_id'),
            'source_id'=>$this->input->post('source_id'),
            'priority_id'=>$this->input->post('priority_id'),
            'status_id'=>$this->input->post('status_id'),
            'refrence'=>$this->input->post('refrence'),
            'description'=>$this->input->post('description'),
            'service_id'=>$this->input->post('service_id'),
            'company_name'=>$this->input->post('company_name'),
            'address'=>$this->input->post('address'),
            'business_category'=>$this->input->post('business_category'),
            'created_by'=>$this->session->userdata('site_userid'),
            'remark'=>$this->input->post('remark'),
            'assign_to'=>$this->input->post('assign_to'),
                     );
           $lead_id=$this->Common_Model->insert('leads',$data);  

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
           redirect(base_url().'Leads/list');
                
               
                
        	}
        	else
        	{
        		$data['title']='Leads/Add';
                $data['heading']='Add Lead';
        		$data['user']=$this->session->userdata('user_info');
        		$data['data']="";
        		if($this->uri->segment(3))
        		{
        		    $data['data']=$this->Common_Model->get_row('tours','*',array('id'=>$this->uri->segment(3))); 
        		}
        		$this->load->view('add',$data);
        	}
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
        $config['file_name'] = 'leads_'.time();
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
      
      public function assin_to()
      {
          $leadid=$this->input->post('leadid');
          $assign_to=$this->input->post('assign_to');
          $this->Common_Model->update('leads',array('assign_to'=>$assign_to),array('id'=>$leadid));
           $this->session->flashdata('success','Lead assign successfully!');
           redirect(base_url().'Leads/list');
          
      }

      public function list_autoload()
      {
        $start=$this->input->post('start');
         $where="";
      if($_POST['assign_to'])
      {
        $where.=" and assign_to=".$_POST['assign_to'];
      }
      if($_POST['status'])
      {
        $where.=" and status_id=".$_POST['status'];
      }
        $data['result']=get_all_list('leads',' where id>1 '.$where.'  order by id desc LIMIT '.$start.',50');
        echo $this->load->view('list_autoload',$data,true);
      }

      public function upload_csv()
      {
        if(!empty($_FILES['file']['name']))
         {
            $path="uploads/leads_csv/".date("d-m-Y")."/";
            $file_name= $this->uploads_file($path,'file');
            if($file_name)
            {
              $data=array('file_name'=>$path.$file_name,'created_by'=>$this->session->userdata('site_userid'));
              $id=$this->Common_Model->insert('csv_uploads',$data);
              redirect(base_url().'Leads/csv_preview/'.$id);
            }
         }
      }
      public function csv_preview()
      {
        $id=$this->uri->segment(3);
        $csv=get_row('csv_uploads',' where id='.$id);
        $arrayFromCSV =  array_map('str_getcsv', file($csv->file_name));
        $data['result']=$arrayFromCSV;
        $data['heading']="CSV Preview";
        $this->load->view('csv_preview',$data);
      }
      public function approve_csv()
      {
         $id=$this->input->post('id');
         $csv=get_row('csv_uploads',' where id='.$id);
        $arrayFromCSV =  array_map('str_getcsv', file($csv->file_name));
        foreach($arrayFromCSV as $key=> $row)
         {
           if($key>0)
           {
             $data=array(
                  'contact_name'=>$row[0],
                  'mobile_no'=>$row[2],
                  'email'=>$row[1],
                  'owner_name'=>$row[0],
                  'address'=>$row[3],
                  'description'=>$row[4],
                  'remark'=>'Fresh Lead',
                  'assign_to'=>$this->session->userdata('site_userid'),
                  'created_by'=>$this->session->userdata('site_userid'),
                  );
                   
              $lead_id= $this->Common_Model->insert('leads',$data); 
              $data2=array(
                      'lead_id'=>$lead_id,
                      'created_by'=>$this->session->userdata('site_userid'),
                      'remark'=>'Fresh Lead',
                      'date_created'=>date("Y-m-d")
                      
                          );
                $this->Common_Model->insert('lead_status_log',$data2);   
           }
         }
         $this->Common_Model->update('csv_uploads',array('status'=>1),array('id'=>1));

      }
      public function delete()
      {
        $id=$this->uri->segment(3);
        $this->Common_Model->delete('leads',array('id'=>$id));
        $this->session->set_flashdata('success','Leads successfully deleted!');
        redirect(base_url().'Leads/list/');

      }

      public function leadsAssign()
      {
        $assign_to=$this->input->post('assign_to');
        $lead_ids=explode(",",rtrim($this->input->post('lead_ids'),','));
        foreach($lead_ids as $leadid)
        {
          $this->Common_Model->update('leads',array('assign_to'=>$assign_to),array('id'=>$leadid));
        }
      }
      public function lead_details()
      {
          $data['user']=$this->session->userdata('user_info');
          $data['heading']="Lead Details";
          $id=$this->uri->segment(3);
          $data['data']=get_row('leads',' where id='.$id);
          $this->load->view('lead_details',$data);
      }
}