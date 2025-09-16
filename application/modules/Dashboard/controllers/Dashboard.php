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
        $data['user'] = $user;
        $data['heading'] = "DASHBOARD";

        $today = date('Y-m-d');
        $tomorrow = date('Y-m-d', strtotime('+1 day'));

        // -----------------------
        // Dashboard Cards
        // -----------------------
        $data['today_followups'] = $this->db->where('created_by', $user_id)
                                            ->where('DATE(next_followup)', $today)
                                            ->count_all_results('leads');

        $data['pending_followups'] = $this->db->where('created_by', $user_id)
                                              ->where('DATE(next_followup) <', $today)
                                              ->count_all_results('leads');

        $data['tomorrow_followups'] = $this->db->where('created_by', $user_id)
                                               ->where('DATE(next_followup)', $tomorrow)
                                               ->count_all_results('leads');

        $data['total_leads'] = $this->db->where('created_by', $user_id)
                                        ->count_all_results('leads');

        // -----------------------
        // Weekly Line Chart (Users & Leads)
        // -----------------------
        $weekStart = date('Y-m-d', strtotime('monday this week'));
        $weekEnd   = date('Y-m-d', strtotime('sunday this week'));

        // Prepare day labels Mon-Sun
        $weekLabels = [];
        $weekDays = [];
        for($i=0; $i<7; $i++){
            $day = date('Y-m-d', strtotime($weekStart." +$i day"));
            $weekDays[] = $day;
            $weekLabels[] = date('D', strtotime($day));
        }

        // Users Weekly
        $users_weekly = $this->db->select("DATE(created_at) as date, COUNT(*) as count")
                                 ->from("users")
                                 ->where("DATE(created_at) >=", $weekStart)
                                 ->where("DATE(created_at) <=", $weekEnd)
                                 ->where("parent_id", $user->parent_id ?? $user->id)
                                 ->group_by("DATE(created_at)")
                                 ->get()->result_array();

        // Leads Weekly
        $leads_weekly = $this->db->select("DATE(created_at) as date, COUNT(*) as count")
                                 ->from("leads")
                                 ->where("DATE(created_at) >=", $weekStart)
                                 ->where("DATE(created_at) <=", $weekEnd)
                                 ->where("created_by", $user_id)
                                 ->group_by("DATE(created_at)")
                                 ->get()->result_array();

        // Map counts to week days
        $usersCount = []; $leadsCount = [];
        $usersData = array_column($users_weekly,'count','date');
        $leadsData = array_column($leads_weekly,'count','date');

        foreach($weekDays as $d){
            $usersCount[] = isset($usersData[$d]) ? (int)$usersData[$d] : 0;
            $leadsCount[] = isset($leadsData[$d]) ? (int)$leadsData[$d] : 0;
        }

        $data['weekLabels'] = $weekLabels;
        $data['usersCount'] = $usersCount;
        $data['leadsCount'] = $leadsCount;

        // -----------------------
        // Daily Leads Distribution (Bar Chart)
        // -----------------------
        $dailyLeads = [];
        foreach($weekDays as $d){
            $count = $this->db->where('created_by', $user_id)
                              ->where('DATE(created_at)', $d)
                              ->count_all_results('leads');
            $dailyLeads[] = (int)$count;
        }
        $data['dailyLeads'] = $dailyLeads;

        // -----------------------
        // Lead Status Breakdown (Doughnut Chart)
        // -----------------------
        $statuses = $this->db->select("status_id, COUNT(*) as count")
                             ->from("leads")
                             ->where("created_by", $user_id)
                             ->group_by("status_id")
                             ->get()->result_array();

        $statusLabels = []; $statusCount = [];
        foreach($statuses as $s){
            $statusLabels[] = "Status ".$s['status_id'];
            $statusCount[] = (int)$s['count'];
        }
        $data['statusLabels'] = $statusLabels;
        $data['statusCount'] = $statusCount;

        // -----------------------
        // Growth Trends (Area Chart) - Monthly Leads
        // -----------------------
        $monthLabels = []; $monthCounts = [];
        for($m=1; $m<=12; $m++){
            $monthLabels[] = date('M', mktime(0,0,0,$m,1));
            $count = $this->db->select("COUNT(*) as count")
                              ->from('leads')
                              ->where('created_by', $user_id)
                              ->where('MONTH(created_at)', $m)
                              ->get()->row()->count ?? 0;
            $monthCounts[] = (int)$count;
        }
        $data['monthLabels'] = $monthLabels;
        $data['monthCounts'] = $monthCounts;

        // Load view
        $this->load->view('dashboard', $data);
    }
}
