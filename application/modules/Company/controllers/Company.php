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
	error_reporting(-1);
		ini_set('display_errors', 1);
    $company_name = $this->input->post('company_name');
    $email        = $this->input->post('email');
    $phone        = $this->input->post('phone');
    $address      = $this->input->post('address');
    $tenure       = $this->input->post('tenure');
    $password     = $this->input->post('password'); // ✅ Get from form

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

    // Insert into companies
    $data = [
        'company_name' => $company_name,
        'email'        => $email,
        'phone'        => $phone,
        'address'      => $address,
        'tenure'       => $tenure,
        'expiry_date'  => $expiry_date,
        'status'       => 1,
        'created_at'   => $created_at,
        'updated_at'   => $updated_at
    ];
    $this->db->insert('companies', $data);

    // ✅ Insert into users (Admin for company)
    $userData = [
        'username'             => $email,
        'password'             => $this->encrypt_decrypt('encrypt', $password),
        'role'                 => 'Admin',
        'name'                 => $company_name,
        'created_at'           => $created_at,
        'create_password_key'  => null,
        'create_password_time' => null
    ];
    $this->db->insert('users', $userData);

    $this->session->set_flashdata('success', 'Company and Admin User created successfully.');
    redirect('company');
}


private function encrypt_decrypt($action, $string) {
    $output = false;
    $encrypt_method = "AES-256-CBC";
    $secret_key = 'e9b8b1596fbb58954dfae1fd6baa8dea';
    $secret_iv  = 'e9b8b1596fbb58954dfae1fd6baa8dea';

    // hash
    $key = hash('sha256', $secret_key);
    // iv - must be 16 bytes
    $iv = substr(hash('sha256', $secret_iv), 0, 16);

    if ($action == 'encrypt') {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    } elseif ($action == 'decrypt') {
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }
    return $output;
}


    // Fetch company for editing
    public function get_company($id)
    {
        $company = $this->db->get_where('companies', ['id' => $id])->row_array();
        echo json_encode($company);
    }

    // Update company
    // Update company
    public function update_company()
    {
        $id           = $this->input->post('id');
        $company_name = $this->input->post('company_name');
        $email        = $this->input->post('email');
        $phone        = $this->input->post('phone');
        $address      = $this->input->post('address');
        $tenure       = $this->input->post('tenure');
        $password     = $this->input->post('password'); // optional - only update if given

        $updated_at   = date('Y-m-d H:i:s');

        // Recalculate expiry date
        if ($tenure == '3') {
            $expiry_date = date('Y-m-d', strtotime("+3 months"));
        } elseif ($tenure == '6') {
            $expiry_date = date('Y-m-d', strtotime("+6 months"));
        } else {
            $expiry_date = date('Y-m-d', strtotime("+1 year"));
        }

        // Update company table
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

        // Update user table (sync with company)
        $userData = [
            'name'       => $company_name,
            'username'   => $email,
            'updated_at' => $updated_at
        ];

        // If password field was provided, update it
        if (!empty($password)) {
            $userData['password'] = $this->encrypt_decrypt('encrypt', $password);
        }

        $this->db->where('username', $this->input->post('old_email')); // old email from form (hidden field)
        $this->db->update('users', $userData);

        $this->session->set_flashdata('success', 'Company and User updated successfully.');
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
