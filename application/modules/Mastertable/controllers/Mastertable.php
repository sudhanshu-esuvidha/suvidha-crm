<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//ini_set('display_errors', 1);
class Mastertable extends MY_Controller
{
	public function __construct()
	{
        parent::__construct();
        $this->load->database();
        $this->load->model('Common_Model');
		  $this->load->library('session');

        if(!$this->session->userdata('site_userid')) { 
            redirect('/');  
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
			$config['allowed_types'] = 'jpg|jpeg|png|pdf|csv|xlsx';
			// $config['max_size'] = '5000'; // max_size in kb
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

	public function list()
	{
		$type=$this->uri->segment(3);
		$parent_id=$this->session->userdata('user_info')->id;

		$data['type']=$type;
		$data['parent_id']=$parent_id;
		$data['user']=$this->session->userdata('user_info');

		$data['result']=get_all_list('master_table',' where type="'.$type.'" and parent_id="'.$parent_id.'" order by id desc');
		$data['heading']=$type.' List';
		$this->load->view('list',$data);  
	}
		
		
    public function add()
	{
		$type=$this->uri->segment(3);
		$parent_id=$this->session->userdata('user_info')->id;
		$id=$this->input->post('leadid');

		if($this->input->post())
		{	    
			$data=array(
				'name'=>$this->input->post('name'),
				'type'=>$type,
				'parent_id'=>$parent_id
			);

			if($id)
			{
				$this->Common_Model->update('master_table',$data,array('id'=>$id));
				$this->session->set_flashdata('success','Data Successfully updated!');
			}
			else
			{
				$id=$this->Common_Model->insert('master_table',$data);
				if($id)
				{
					$this->session->set_flashdata('success','Data Successfully added!');     
				}
			}
			redirect(base_url().'Mastertable/list/'.$type.'/'.$parent_id);
		}
		else
		{
			$data['type']=$type;
			$data['parent_id']=$parent_id;
			$data['data']=array();
			if($id)
			{
				$data['data']=$this->Common_Model->get_row('master_table','*',array('id'=>$id));
			}

			// fetch parents for dropdown
			$data['parents']=$this->Common_Model->get_result('master_table','*',array('type'=>$type,'parent_id'=>0,'status'=>1));

			$data['user']=$this->session->userdata('user_info');
			$this->load->view('add',$data);  
		}
	}

	public function delete()
	{
		$type=$this->uri->segment(3);
		$id=$this->uri->segment(4);
		$parent_id=$this->uri->segment(5) ?? 0;

		$this->Common_Model->delete('master_table',array('id'=>$id));
		$this->session->set_flashdata('success','Data Successfully deleted!');
		redirect(base_url().'Mastertable/list/'.$type.'/'.$parent_id);
	}
	
	
	public function list_service_type()
	{
		if($this->input->get('charge_id'))
		{
			$charge_id = $this->input->get('charge_id');
		}
		else
		{
			$charge_id = 0;
		}
		
		if($this->input->get('main_service_id'))
		{
			$main_service_id = $this->input->get('main_service_id');
		}
		else
		{
			$main_service_id = 0;
		}
		
		$data['charge_id']=$charge_id;
		$data['main_service_id']=$main_service_id;
		$data['user']=$this->session->userdata('user_info');
		$this->load->view('list/list_service_type',$data);  
	}
	
	public function add_service_type()
	{
		//$type=$this->uri->segment(3);
		$id=$this->uri->segment(3);
		if($id)
		{
			$updated_at = date("Y-m-d H:i:s");
		}
		else
		{
			$updated_at = "";
		}
		
		
		if($this->input->post())
		{	    
			$data=array(
			'charge_id'=>$this->input->post('charge_id'),
			'main_service_id'=>$this->input->post('main_service_id'),
			'service_type_name'=>$this->input->post('service_type_name'),
			'coastal_rate'=>$this->input->post('coastal_rate'),
			'foreign_rate'=>$this->input->post('foreign_rate'),
			'quantity'=>$this->input->post('quantity'),
			'discount'=>$this->input->post('discount'),
			'updated_at'=>$updated_at,
			'qty_variable_name'=>$this->input->post('qty_variable_name'),
			);
			if($id)
			{
				$this->Common_Model->update('tariff_calculator_service_type',$data,array('id'=>$id));
				$this->session->set_flashdata('success','Data Successfully updated!');
			}
			else
			{
				$id=$this->Common_Model->insert('tariff_calculator_service_type',$data);
				if($id)
				{
					$this->session->set_flashdata('success','Data Successfully added!');     
				}
			}

			///day wise calculation
	       if($this->input->post('is_day_wise_calculation'))
	       {
	       	$this->Common_Model->delete('service_type_day_wise_calculation',array('service_type_id'=>$id));
	       	$day_from=$this->input->post('day_from');
	       	$day_to=$this->input->post('day_to');
	       	$rate_coastal=$this->input->post('rate_coastal');
	       	$rate_foriegn=$this->input->post('rate_foriegn');
	       	$service_type_name=$this->input->post('day_service_type_name');
	       	foreach($day_from as $key=> $row)
	       	{
	          $data=array(
	                'day_from'=>$day_from[$key],
	                'day_to'=>$day_to[$key],
	                'rate_coastal'=>$rate_coastal[$key],
	                'rate_foriegn'=>$rate_foriegn[$key],
	                'service_type_id'=>$id,
	                'service_type_name'=>$service_type_name[$key]
	       	            );
	         
	          $this->Common_Model->insert('service_type_day_wise_calculation',$data);
	          
	       	}

	       	$this->Common_Model->update('tariff_calculator_service_type',array('is_day_wise_calculation'=>1),array('id'=>$id));
	       }
	       else
	       {
	       	$this->Common_Model->update('tariff_calculator_service_type',array('is_day_wise_calculation'=>0),array('id'=>$id));
	       }
      
			///day wise calculation
			redirect(base_url().'Mastertable/list_service_type');
		}
		else
		{
			$data['data']=array();
			if($id)
			{
				$data['data']=$this->Common_Model->get_row('tariff_calculator_service_type','*',array('id'=>$id));
			}
			$data['user']=$this->session->userdata('user_info');
			$this->load->view('add/add_service_type',$data);  
		}
	}
	
	
	public function get_main_service()
	{
		$value=$this->input->post('value');
		$data['result']=$this->Common_Model->get_result('master_table','*',array('parent_id'=>$value,'status'=>1));
		echo $this->load->view('add/load_data',$data,true);
	}

}   
