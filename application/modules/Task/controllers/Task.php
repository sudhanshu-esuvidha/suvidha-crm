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
        $parent_id = $this->session->userdata('user_info')->id;

        // Fetch tasks with lead/user names based on parent_id
        $this->db->select('t.*, l.contact_name as lead_name, u.username as assigned_name');
        $this->db->from('tasks t');
        $this->db->join('leads l', 'l.id = t.lead_id', 'left');
        $this->db->join('users u', 'u.id = t.assigned_to', 'left');
        $this->db->where('t.parent_id', $parent_id);
        $tasks = $this->db->get()->result_array();

        // Fetch leads and users for dropdowns (also limited by parent_id)
        $leads = $this->db->get_where('leads', ['parent_id' => $parent_id])->result_array();
        $users = $this->db->get_where('users', ['parent_id' => $parent_id])->result_array();

        // Prepare data array
        $data = [
            'tasks' => $tasks,
            'leads' => $leads,
            'users' => $users,
            'user'  => $this->session->userdata('user_info'),
            'url'   => base_url('task')
        ];

        // Load view with $data
        $this->load->view('task_list', $data);
    }

    // Add Task
    public function add()
    {
        $parent_id = $this->session->userdata('user_info')->id;

        $data = [
            'title'       => $this->input->post('title'),
            'lead_id'     => $this->input->post('lead_id'),
            'start_date'  => $this->input->post('start_date'),
            'end_date'    => $this->input->post('end_date'),
            'assigned_to' => $this->input->post('assigned_to'),
            'observer'    => $this->input->post('observer'),
            'parent_id'   => $parent_id,
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
        $parent_id = $this->session->userdata('user_info')->id;

        $task = $this->db->get_where('tasks', [
            'id' => $id,
            'parent_id' => $parent_id
        ])->row_array();

        echo json_encode($task);
    }

    // Update Task
    public function update()
    {
        $id = $this->input->post('id');
        $parent_id = $this->session->userdata('user_info')->id;

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
        $this->db->where('parent_id', $parent_id); // restrict update
        $this->db->update('tasks', $data);

        $this->session->set_flashdata('success', 'Task updated successfully.');
        redirect('task');
    }

    // Delete Task
    public function delete($id)
    {
        $parent_id = $this->session->userdata('user_info')->id;

        $this->db->where('id', $id);
        $this->db->where('parent_id', $parent_id); // restrict delete
        $this->db->delete('tasks');

        $this->session->set_flashdata('success', 'Task deleted successfully.');
        redirect('task');
    }
}
