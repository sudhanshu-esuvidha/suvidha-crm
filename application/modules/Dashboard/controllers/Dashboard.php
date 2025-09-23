<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->load->helper('date');

        if(!$this->session->userdata('site_userid')) {
            redirect('/');
        }
    }

    public function index()
    {
        $user_id = $this->session->userdata('site_userid');

        // Fetch logged-in user
        $user = $this->db->get_where('users', ['id'=>$user_id])->row();
        $this->session->set_userdata('user_info', $user);
          $role    = $user->role;
    $parent_id = $user->parent_id;
       $data['total_leads'] = $this->db
        ->where('assign_to', $user_id)
        ->count_all_results('leads');

    // ------------------ Tasks ------------------
    $data['total_tasks'] = $this->db
        ->where('assigned_to', $user_id)
        ->count_all_results('tasks');

    // ------------------ Dynamic Dates ------------------
    $yesterday = date('Y-m-d', strtotime('-1 day'));
    $today     = date('Y-m-d');
    $tomorrow  = date('Y-m-d', strtotime('+1 day'));

    // ------------------ Tasks Counts ------------------
    $data['yesterday_tasks'] = $this->db
        ->where('assigned_to', $user_id)
        ->where('DATE(created_at)', $yesterday)
        ->count_all_results('tasks');

    $data['today_tasks'] = $this->db
        ->where('assigned_to', $user_id)
        ->where('DATE(created_at)', $today)
        ->count_all_results('tasks');

    $data['tomorrow_tasks'] = $this->db
        ->where('assigned_to', $user_id)
        ->where('DATE(created_at)', $tomorrow)
        ->count_all_results('tasks');

    // ------------------ Leads Counts ------------------
    $data['yesterday_leads'] = $this->db
        ->where('assign_to', $user_id)
        ->where('DATE(created_at)', $yesterday)
        ->count_all_results('leads');

    $data['today_leads'] = $this->db
        ->where('assign_to', $user_id)
        ->where('DATE(created_at)', $today)
        ->count_all_results('leads');

    $data['tomorrow_leads'] = $this->db
        ->where('assign_to', $user_id)
        ->where('DATE(created_at)', $tomorrow)
        ->count_all_results('leads');

    // ------------------ Leads Follow-up ------------------
    $data['today_followups'] = $this->db
        ->where('assign_to', $user_id)
        ->where('DATE(next_followup)', $today)
        ->count_all_results('leads');

    $data['tomorrow_followups'] = $this->db
        ->where('assign_to', $user_id)
        ->where('DATE(next_followup)', $tomorrow)
        ->count_all_results('leads');

$this->db->select('source, COUNT(*) as lead_count');
$this->db->where('assign_to', $user_id);
$this->db->group_by('source');
$query = $this->db->get('leads');

$data['lead_sources'] = $query->result_array();

    // ------------------ Statuses ------------------
    $master_parent_id = ($role == 1 || $role == 2) ? $user_id : $parent_id;

   if ($user->role == 1) {
    // Role 1: use own ID
    $master_parent_id = $user_id;
} else {
    // Other roles: use parent_id from users table
    $master_parent_id = $user->parent_id;
}

// Fetch statuses
$this->db->select('*');
$this->db->from('master_table');
$this->db->where('parent_id', $master_parent_id);
$this->db->where('type', 'status');
$statuses = $this->db->get()->result_array();

$data['statuses'] = $statuses;
    // ------------------ Status-wise Task & Lead Counts ------------------
    foreach ($statuses as $status) {
        $status_id   = $status['id'];
        $status_name = $status['name'] ?? $status['status'];

        // Task Status
        $data['yesterday_task_status'][$status_name] = $this->db
            ->where('assigned_to', $user_id)
            ->where('DATE(created_at)', $yesterday)
            ->where('status_id', $status_id)
            ->count_all_results('tasks');

        $data['today_task_status'][$status_name] = $this->db
            ->where('assigned_to', $user_id)
            ->where('DATE(created_at)', $today)
            ->where('status_id', $status_id)
            ->count_all_results('tasks');

        $data['tomorrow_task_status'][$status_name] = $this->db
            ->where('assigned_to', $user_id)
            ->where('DATE(created_at)', $tomorrow)
            ->where('status_id', $status_id)
            ->count_all_results('tasks');


// Lead Status
        $data['yesterday_lead_status'][$status_name] = $this->db
            ->where('assign_to', $user_id)
            ->where('DATE(created_at)', $yesterday)
            ->where('status_id', $status_id)
            ->count_all_results('leads');

        $data['today_lead_status'][$status_name] = $this->db
            ->where('assign_to', $user_id)
            ->where('DATE(created_at)', $today)
            ->where('status_id', $status_id)
            ->count_all_results('leads');

        $data['tomorrow_lead_status'][$status_name] = $this->db
            ->where('assign_to', $user_id)
            ->where('DATE(created_at)', $tomorrow)
            ->where('status_id', $status_id)
            ->count_all_results('leads');
    }

    // Load dashboard view
    $this->load->view('dashboard', $data);
}
}
