<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg">
<?php $this->load->view('Template/head',$data); ?>
<style type="text/css">
    h4{
        color: white;
    }
</style>
<body>
    <?php  
        $date  = date("Y-m-d");
        $date2 = date('Y-m-d', strtotime($date.' + 1 day')); 
    ?>
    <div class="main-wrapper">
        <!-- Header -->
        <div class="header shadow-sm">
            <?php $this->load->view('Template/header',$data); ?>

            <!-- Page Wrapper -->
            <div class="page-wrapper">
                <div class="content container-fluid pb-0">
                    <?php $this->load->view('Template/page_header',$data); ?>

                    <!-- DASHBOARD SECTION -->
                    <div class="dashboard-container">
                        <div class="row g-4">
                            <!-- 4 Main Cards -->
                            <div class="col-md-3 col-sm-6">
                                <div class="dashboard-card gradient1">
                                    <h4>Today Follow-ups</h4>
                                    <p class="number"><?= $today_followups ?? 0 ?></p>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="dashboard-card gradient2">
                                    <h4>Pending Follow-ups</h4>
                                    <p class="number"><?= $pending_followups ?? 0 ?></p>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="dashboard-card gradient3">
                                    <h4>Tomorrow Follow-ups</h4>
                                    <p class="number"><?= $tomorrow_followups ?? 0 ?></p>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="dashboard-card gradient4">
                                    <h4>Total Leads</h4>
                                    <p class="number"><?= $total_leads ?? 0 ?></p>
                                </div>
                            </div>
                        </div>

                        <!-- Chart Section -->
                        <div class="row mt-5 g-4">
                            <!-- Line Chart -->
                            <div class="col-lg-6">
                                <div class="card shadow-sm p-4">
                                    <h5 class="mb-3">Users & Leads (Weekly)</h5>
                                    <canvas id="lineChart" height="160"></canvas>
                                </div>
                            </div>

                            <!-- Bar Chart -->
                            <div class="col-lg-6">
                                <div class="card shadow-sm p-4">
                                    <h5 class="mb-3">Daily Leads Distribution</h5>
                                    <canvas id="barChart" height="160"></canvas>
                                </div>
                            </div>

                            <!-- Doughnut Chart -->
                            <div class="col-lg-6">
                                <div class="card shadow-sm p-4">
                                    <h5 class="mb-3">Lead Status Breakdown</h5>
                                    <canvas id="doughnutChart" height="160"></canvas>
                                </div>
                            </div>

                            <!-- Area Chart -->
                            <div class="col-lg-6">
                                <div class="card shadow-sm p-4">
                                    <h5 class="mb-3">Growth Trends</h5>
                                    <canvas id="areaChart" height="160"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END DASHBOARD -->
                </div>
            </div>
        </div>

        <!-- Footer -->
        <?php $this->load->view('Template/footer',$data); ?>
    </div>

    <!-- SCRIPTS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Line Chart - Users & Leads Weekly
    new Chart(document.getElementById('lineChart'), {
        type: 'line',
        data: {
            labels: <?= json_encode($weekLabels) ?>,
            datasets: [
                {
                    label: 'Users',
                    data: <?= json_encode($usersCount) ?>,
                    borderColor: '#2575fc',
                    backgroundColor: 'rgba(37,117,252,0.2)',
                    tension: 0.4,
                    fill: true
                },
                {
                    label: 'Leads',
                    data: <?= json_encode($leadsCount) ?>,
                    borderColor: '#38ef7d',
                    backgroundColor: 'rgba(56,239,125,0.2)',
                    tension: 0.4,
                    fill: true
                }
            ]
        },
        options: { responsive: true }
    });

    // Bar Chart - Daily Leads Distribution
    new Chart(document.getElementById('barChart'), {
        type: 'bar',
        data: {
            labels: <?= json_encode($weekLabels) ?>,
            datasets: [{
                label: 'Leads',
                data: <?= json_encode($dailyLeads) ?>,
                backgroundColor: '#f7971e'
            }]
        },
        options: { responsive: true, scales: { y: { beginAtZero: true } } }
    });

    // Doughnut Chart - Lead Status Breakdown
    new Chart(document.getElementById('doughnutChart'), {
        type: 'doughnut',
        data: {
            labels: <?= json_encode($statusLabels) ?>,
            datasets: [{
                data: <?= json_encode($statusCount) ?>,
                backgroundColor: ['#f7971e','#ff416c','#38ef7d','#2575fc','#ffbb33','#33b5e5']
            }]
        },
        options: { responsive: true }
    });

    // Area Chart - Monthly Growth Trends
    new Chart(document.getElementById('areaChart'), {
        type: 'line',
        data: {
            labels: <?= json_encode($monthLabels) ?>,
            datasets: [{
                label: 'Leads',
                data: <?= json_encode($monthCounts) ?>,
                borderColor: '#ff4b2b',
                backgroundColor: 'rgba(255,75,43,0.3)',
                tension: 0.4,
                fill: true
            }]
        },
        options: { responsive: true }
    });
</script>


    <!-- INTERNAL CSS -->
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, sans-serif;
            background: #f7f9fc;
            color: #333;
        }
        .dashboard-container {
            margin-top: 20px;
        }
        .dashboard-card {
            border-radius: 15px;
            padding: 25px;
            text-align: center;
            color: #fff;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(0,0,0,0.12);
        }
        .dashboard-card h4 { font-size: 16px; margin-bottom: 10px; }
        .dashboard-card .number { font-size: 28px; font-weight: bold; }
        /* Gradient Styles */
        .gradient1 { background: linear-gradient(135deg,#6a11cb,#2575fc); }
        .gradient2 { background: linear-gradient(135deg,#11998e,#38ef7d); }
        .gradient3 { background: linear-gradient(135deg,#f7971e,#ffd200); }
        .gradient4 { background: linear-gradient(135deg,#ff416c,#ff4b2b); }
    </style>
</body>
</html>
