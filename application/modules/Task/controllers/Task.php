<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Task extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('Common_Model');
        $this->load->library('session');

        if (!$this->session->userdata('site_userid')) { 
            redirect('/');  
        }
    }

    // Task List
    public function index()
    {
        // Fetch tasks with lead/user names
        $this->db->select('t.*, l.contact_name as lead_name, u.username as assigned_name');
        $this->db->from('tasks t');
        $this->db->join('leads l', 'l.id = t.lead_id', 'left');
        $this->db->join('users u', 'u.id = t.assigned_to', 'left');
        $tasks = $this->db->get()->result_array();

        // Fetch leads and users for dropdowns
        $leads = $this->db->get('leads')->result_array();
        $users = $this->db->get('users')->result_array();

        // Prepare data array
        $data = [
            'tasks' => $tasks,
            'leads' => $leads,
            'users' => $users,
            'user'  => $this->session->userdata('user_info'),
            'url'   => base_url('task')  // needed for page_header.php
        ];

        // Load view with $data
        $this->load->view('task_list', $data);
    }

    // Add Task
    public function add()
    {
        $data = [
            'title'       => $this->input->post('title'),
            'lead_id'     => $this->input->post('lead_id'),
            'start_date'  => $this->input->post('start_date'),
            'end_date'    => $this->input->post('end_date'),
            'assigned_to' => $this->input->post('assigned_to'),
            'observer'    => $this->input->post('observer'),
            'priority'    => $this->input->post('priority'),
            'active'      => $this->input->post('active') ? 1 : 0,
            'description' => $this->input->post('description'),
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s')
        ];

        $this->db->insert('tasks', $data);
        $this->session->set_flashdata('success', 'Task added successfully.');
        redirect('task');
    }

    // Fetch Task for Edit (AJAX)
    public function get($id)
    {
        $task = $this->db->get_where('tasks', ['id' => $id])->row_array();
        echo json_encode($task);
    }

    // Update Task
    public function update()
    {
        $id = $this->input->post('id');
        $data = [
            'title'       => $this->input->post('title'),
            'lead_id'     => $this->input->post('lead_id'),
            'start_date'  => $this->input->post('start_date'),
            'end_date'    => $this->input->post('end_date'),
            'assigned_to' => $this->input->post('assigned_to'),
            'observer'    => $this->input->post('observer'),
            'priority'    => $this->input->post('priority'),
            'active'      => $this->input->post('active') ? 1 : 0,
            'description' => $this->input->post('description'),
            'updated_at'  => date('Y-m-d H:i:s')
        ];

        $this->db->where('id', $id);
        $this->db->update('tasks', $data);

        $this->session->set_flashdata('success', 'Task updated successfully.');
        redirect('task');
    }

    // Delete Task
    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('tasks');

        $this->session->set_flashdata('success', 'Task deleted successfully.');
        redirect('task');
    }
}
