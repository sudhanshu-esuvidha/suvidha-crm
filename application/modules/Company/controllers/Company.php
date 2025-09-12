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
        // Now everything is in `users` table
        $data['users'] = $this->db
            ->where('role', '2') // filter only company admins
            ->get('users')
            ->result_array();

        $data['user'] = $this->session->userdata('user_info');
        $this->load->view('companies_list', $data);
    }

    // Add company (insert into users only)
    public function add_company()
    {
        $company_name = $this->input->post('company_name');
        $email        = $this->input->post('email');
        $phone        = $this->input->post('phone');
        $subusers     = $this->input->post('subusers');
        $address      = $this->input->post('address');
        $tenure       = $this->input->post('tenure');
        $password     = $this->input->post('password');

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

        // Insert into users (merged table)
        $userData = [
            'username'             => $email,
            'password'             => $this->encrypt_decrypt('encrypt', $password),
            'role'                 => 2,
            'name'                 => $company_name,
            'company_name'         => $company_name,
            'email'                => $email,
            'parent_id'            => $this->session->userdata('user_info')->id,
            'phone'                => $phone,
            'subusers'             => $subusers,
            'address'              => $address,
            'tenure'               => $tenure,
            'expiry_date'          => $expiry_date,
            'status'               => 'active',
            'created_at'           => $created_at,
            'updated_at'           => $updated_at,
            'create_password_key'  => null,
            'create_password_time' => null
        ];

        $this->db->insert('users', $userData);

        $this->session->set_flashdata('success', 'Company created successfully.');
        redirect('company');
    }

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

    // Fetch company for editing
    public function get_company($id)
    {
        $company = $this->db->get_where('users', ['id' => $id, 'role' => 'Admin'])->row_array();
        echo json_encode($company);
    }

    // Update company (update users only)
    public function update_company()
    {
        $id           = $this->input->post('id');
        $company_name = $this->input->post('company_name');
        $email        = $this->input->post('email');
        $phone        = $this->input->post('phone');
        $subusers     = $this->input->post('subusers');
        $address      = $this->input->post('address');
        $tenure       = $this->input->post('tenure');
        $password     = $this->input->post('password');

        $updated_at   = date('Y-m-d H:i:s');

        // Recalculate expiry date
        if ($tenure == '3') {
            $expiry_date = date('Y-m-d', strtotime("+3 months"));
        } elseif ($tenure == '6') {
            $expiry_date = date('Y-m-d', strtotime("+6 months"));
        } else {
            $expiry_date = date('Y-m-d', strtotime("+1 year"));
        }

        // Update users table
        $userData = [
            'name'         => $company_name,
            'username'     => $email,
            'company_name' => $company_name,
            'email'        => $email,
            'phone'        => $phone,
            'subusers'     => $subusers,
            'address'      => $address,
            'tenure'       => $tenure,
            'expiry_date'  => $expiry_date,
            'updated_at'   => $updated_at
        ];

        if (!empty($password)) {
            $userData['password'] = $this->encrypt_decrypt('encrypt', $password);
        }

        $this->db->where('id', $id);
        $this->db->update('users', $userData);

        $this->session->set_flashdata('success', 'Company updated successfully.');
        redirect('company');
    }

    // Delete company
    public function delete_company($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('users');

        $this->session->set_flashdata('success', 'Company deleted successfully.');
        redirect('company');
    }
}
