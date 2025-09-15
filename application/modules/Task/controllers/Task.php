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
    $user = $this->session->userdata('user_info');
    $user_id = $user->id;
    $role_id = $user->role ?? 0;

    // Fetch tasks
    $this->db->select('t.*, l.contact_name as lead_name, u.username as assigned_name');
    $this->db->from('tasks t');
    $this->db->join('leads l', 'l.id = t.lead_id', 'left');
    $this->db->join('users u', 'u.id = t.assigned_to', 'left');

    if($role_id == 1){
        $this->db->where('t.parent_id', $user_id);
    } else {
        $this->db->group_start();
        $this->db->where('t.assigned_to', $user_id);
        $this->db->or_where('t.parent_id', $user_id);
        $this->db->group_end();
    }

    $tasks = $this->db->get()->result_array();

    // ✅ Fetch leads only of this user (parent_id = session user_id)
$leads = $this->db->select('id, contact_name')
    ->from('leads')
    ->where('parent_id', $user_id)
    ->get()
    ->result_array();

// ✅ Fetch users only of this user (parent_id = session user_id)
$users = $this->db->select('id, username')
    ->from('users')
    ->where('parent_id', $user_id)
    ->get()
    ->result_array();

// ✅ If you also need observers list separately (same filter)
$observers = $this->db->select('id, username')
    ->from('users')
    ->where('parent_id', $user_id)
    ->get()
    ->result_array();

$data = [
    'tasks'     => $tasks,
    'user'      => $user,
    'url'       => base_url('task'),
    'leads'     => $leads,
    'users'     => $users,
    'observers' => $observers
];

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
