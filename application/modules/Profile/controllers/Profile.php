<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->load->helper(['url', 'form']);

        if (!$this->session->userdata('site_userid')) {
            redirect('/');
        }
    }

    // Show Profile
    public function index()
    {
        $session_userid = $this->session->userdata('site_userid');

        // Fetch username from users table based on session ID
        $user = $this->db->get_where('users', ['id' => $session_userid])->row_array();

        if (!$user) {
            $this->session->set_flashdata('error', 'User not found.');
            redirect('/');
        }

        $username = $user['username']; // Assuming username is the email to match

        // Fetch company row where email matches username
        $company = $this->db->get_where('companies', ['email' => $username])->row_array();

        $data = [
            'company' => $company,
            'user'    => $this->session->userdata('user_info'),
            'url'     => base_url('profile'),
            'list'    => ['Profile'],
            'add'     => false
        ];

        $this->load->view('profile_list', $data);
    }

    // Update Profile
    public function update()
    {
        $session_userid = $this->session->userdata('site_userid');

        // Fetch username from users table
        $user = $this->db->get_where('users', ['id' => $session_userid])->row_array();
        if (!$user) {
            $this->session->set_flashdata('error', 'User not found.');
            redirect('profile');
        }

        $username = $user['username'];

        // Fetch company row where email matches username
        $company = $this->db->get_where('companies', ['email' => $username])->row_array();
        if (!$company) {
            $this->session->set_flashdata('error', 'Company not found.');
            redirect('profile');
        }

        $company_id = $company['id'];

        // Prepare data to update
        $data = [
            'company_name' => $this->input->post('company_name'),
            'updated_at'   => date('Y-m-d H:i:s')
        ];

        // Handle logo upload
        if (!empty($_FILES['logo']['name'])) {
            $upload_path = './assets/logo/' . $company_id . '/';
            if (!is_dir($upload_path)) {
                mkdir($upload_path, 0755, true);
            }

            $config['upload_path']   = $upload_path;
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name']     = time() . '_' . $_FILES['logo']['name'];

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('logo')) {
                $uploadData = $this->upload->data();
                $data['logo'] = 'assets/logo/' . $company_id . '/' . $uploadData['file_name'];
            } else {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('profile');
            }
        }

        // Update company dynamically
        $this->db->where('id', $company_id);
        $this->db->update('companies', $data);

        $this->session->set_flashdata('success', 'Profile updated successfully.');
        redirect('profile');
    }
}
