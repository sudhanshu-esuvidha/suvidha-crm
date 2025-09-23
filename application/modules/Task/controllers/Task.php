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
public function change_status()
{
    $user = $this->session->userdata('user_info');

    // Decide parent_id based on role
    if (in_array($user->role, [1, 2])) {
        $parent_id = $user->id;
    } else {
        $parent_id = $user->parent_id;
    }

    $task_id   = $this->input->post('task_id');
    $status_id = $this->input->post('status_id');
    $remark    = $this->input->post('remark');
    $status_changed_by = $user->id;

    // Fetch status name from master table
    $status_row = $this->db->get_where('master_table', ['id' => $status_id])->row();
    $status_name = $status_row ? $status_row->name : '';

    $data = [
        'status_id'        => $status_id,
        'status_name'      => $status_name,
        'remark'           => $remark,
        'status_changed_by'=> $status_changed_by,
        'status_changed_at'=> date('Y-m-d H:i:s')
    ];

    $this->db->where('id', $task_id);
    $this->db->where('parent_id', $parent_id); // restrict update
    $this->db->update('tasks', $data);

    $this->session->set_flashdata('success', 'Task status updated successfully.');
    redirect('Task');
}

    // Task List
public function index()
{
    $user      = $this->session->userdata('user_info');
    $user_id   = $user->id;
    $role_id   = $user->role ?? 0;
    $parent_id = in_array($role_id, [1, 2]) ? $user_id : $user->parent_id;

    $status_filter = $this->input->get('status_filter');
    $title_search  = $this->input->get('title_search');

    $this->db->select('t.*, l.contact_name as lead_name, u.username as assigned_name');
    $this->db->from('tasks t');
    $this->db->join('leads l', 'l.id = t.lead_id', 'left');
    $this->db->join('users u', 'u.id = t.assigned_to', 'left');

    // Access control
    if ($role_id == 1) {
        $this->db->where('t.parent_id', $user_id);
    } else {
        $this->db->group_start();
        $this->db->where('t.assigned_to', $user_id);
        $this->db->or_where('t.parent_id', $user_id);
        $this->db->or_where("FIND_IN_SET(".$this->db->escape($user_id).", t.observer) !=", 0);
        $this->db->group_end();
    }

    // Filter by status if selected
    if (!empty($status_filter)) {
        $this->db->where('t.status_id', $status_filter);
    } else {
        $this->db->where('t.active', 1); // default active tasks
    }

    // Filter by task title if search is provided
    if (!empty($title_search)) {
        $this->db->like('t.title', $title_search);
    }

    $tasks = $this->db->get()->result_array();

    // Fetch leads, users, observers, status options
    $leads = $this->db->select('id, contact_name')
        ->from('leads')
        ->where('parent_id', $parent_id)
        ->get()->result_array();

  $users = $this->db
    ->select('u.id, u.username, u.name, m.name as role_name')
    ->from('users u')
    ->join('master_table m', 'm.id = u.role AND m.type = "role"', 'left')
    ->where('u.parent_id', $parent_id)
    ->get()
    ->result_array();


    $observers = $this->db->select('id, username')
        ->from('users')
        ->where('parent_id', $parent_id)
        ->get()->result_array();

    $status_options = $this->db
        ->where(['type' => 'status', 'parent_id' => $parent_id])
        ->get('master_table')
        ->result_array();

    $data = [
        'tasks'          => $tasks,
        'user'           => $user,
        'url'            => base_url('task'),
        'leads'          => $leads,
        'users'          => $users,
        'observers'      => $observers,
        'status_options' => $status_options,
        'status_filter'  => $status_filter,
        'title_search'   => $title_search, // pass search value to view
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
        redirect('Task');
    }

    // Fetch Task for Edit (AJAX)
    public function get($id)
    {
       

        $task = $this->db->get_where('tasks', [
            'id' => $id
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
        redirect('Task');
    }

    // Delete Task
    public function delete($id)
    {
        $parent_id = $this->session->userdata('user_info')->id;

        $this->db->where('id', $id);
        $this->db->where('parent_id', $parent_id); // restrict delete
        $this->db->delete('tasks');

        $this->session->set_flashdata('success', 'Task deleted successfully.');
        redirect('Task');
    }
}
