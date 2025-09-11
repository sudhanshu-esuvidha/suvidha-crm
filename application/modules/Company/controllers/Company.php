<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Company extends MY_Controller
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

    // Show company list
    public function index()
    {
        $data['companies'] = $this->db->get('companies')->result_array();
	    $data['user']=$this->session->userdata('user_info');
        
        $this->load->view('companies_list', $data);
    }

    // Add company
    public function add_company()
    {
        $company_name = $this->input->post('company_name');
        $email        = $this->input->post('email');
        $phone        = $this->input->post('phone');
        $address      = $this->input->post('address');
        $tenure       = $this->input->post('tenure');

        $created_at   = date('Y-m-d H:i:s');
        $updated_at   = $created_at;

        // Calculate expiry date
        if ($tenure == '3') {
            $expiry_date = date('Y-m-d', strtotime("+3 months"));
        } elseif ($tenure == '6') {
            $expiry_date = date('Y-m-d', strtotime("+6 months"));
        } else {
            $expiry_date = date('Y-m-d', strtotime("+1 year"));
        }

        $data = [
            'company_name' => $company_name,
            'email'        => $email,
            'phone'        => $phone,
            'address'      => $address,
            'tenure'       => $tenure,
            'expiry_date'  => $expiry_date,
            'status'       => 1, // Active by default
            'created_at'   => $created_at,
            'updated_at'   => $updated_at
        ];

        $this->db->insert('companies', $data);
        $this->session->set_flashdata('success', 'Company added successfully.');
        redirect('company');
    }

    // Fetch company for editing
    public function get_company($id)
    {
        $company = $this->db->get_where('companies', ['id' => $id])->row_array();
        echo json_encode($company);
    }

    // Update company
    public function update_company()
    {
        $id           = $this->input->post('id');
        $company_name = $this->input->post('company_name');
        $email        = $this->input->post('email');
        $phone        = $this->input->post('phone');
        $address      = $this->input->post('address');
        $tenure       = $this->input->post('tenure');

        $updated_at   = date('Y-m-d H:i:s');

        // Recalculate expiry date
        if ($tenure == '3') {
            $expiry_date = date('Y-m-d', strtotime("+3 months"));
        } elseif ($tenure == '6') {
            $expiry_date = date('Y-m-d', strtotime("+6 months"));
        } else {
            $expiry_date = date('Y-m-d', strtotime("+1 year"));
        }

        $data = [
            'company_name' => $company_name,
            'email'        => $email,
            'phone'        => $phone,
            'address'      => $address,
            'tenure'       => $tenure,
            'expiry_date'  => $expiry_date,
            'updated_at'   => $updated_at
        ];

        $this->db->where('id', $id);
        $this->db->update('companies', $data);

        $this->session->set_flashdata('success', 'Company updated successfully.');
        redirect('company');
    }

    // Delete company
    public function delete_company($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('companies');

        $this->session->set_flashdata('success', 'Company deleted successfully.');
        redirect('company');
    }
}
