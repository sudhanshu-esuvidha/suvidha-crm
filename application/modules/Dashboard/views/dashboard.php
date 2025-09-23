<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">
<?php $this->load->view('Template/head'); ?>

<style>
    /* Dashboard cards */
    .dashboard-card {
        border-radius: 0.75rem;
        height: 120px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        margin-bottom: 10px;
        text-align: center;
        padding: 10px;
    }

    .dashboard-card h6 { margin: 0; font-size: 0.9rem; }
    .dashboard-card h3 { margin: 0; font-size: 1.3rem; }

    /* Chart card override */
    .chart-card {
        height: 320px; /* taller cards for charts */
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 15px;
    }

    .chart-card canvas {
        height: 250px !important;
    }

    /* Mobile adjustments */
    @media (max-width: 576px) {
        .dashboard-card { height: 100px; padding: 5px; }
        .dashboard-card h6 { font-size: 0.75rem; }
        .dashboard-card h3 { font-size: 1.1rem; }

        .chart-card { height: 220px; }
        .chart-card canvas { height: 160px !important; }
    }
</style>

<body>
<div class="main-wrapper">
    <div class="header">
        <?php $this->load->view('Template/header'); ?>
        <div class="page-wrapper">
            <div class="content container-fluid pb-0">

                <?php $this->load->view('Template/page_header'); ?>

                <!-- Info Cards -->
                <div class="row mb-3">
                  <div class="col-6 col-sm-6 col-md-6">
    <a href="<?= base_url('Leads/list'); ?>" class="text-decoration-none">
        <div class="dashboard-card bg-info text-white">
            <h6>Total Leads</h6>
            <h3><?= $total_leads; ?></h3>
        </div>
    </a>
</div>

<div class="col-6 col-sm-6 col-md-6">
    <a href="<?= base_url('Task'); ?>" class="text-decoration-none">
        <div class="dashboard-card bg-success text-white">
            <h6>Total Tasks</h6>
            <h3><?= $total_tasks; ?></h3>
        </div>
    </a>
</div>

                    <div class="col-6 col-sm-6 col-md-6">
                        <div class="dashboard-card bg-warning text-dark">
                            <h6>Today's Follow-ups</h6>
                            <h3><?= $today_followups; ?></h3>
                        </div>
                    </div>
                    <div class="col-6 col-sm-6 col-md-6">
                        <div class="dashboard-card bg-danger text-white">
                            <h6>Tomorrow's Follow-ups</h6>
                            <h3><?= $tomorrow_followups; ?></h3>
                        </div>
                    </div>
                </div>

                <!-- Charts -->
                <div class="row mb-3">
                    <div class="col-12">
                        <div class="dashboard-card chart-card">
                            <h6>Today's Task Status</h6>
                            <canvas id="taskStatusChart"></canvas>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="dashboard-card chart-card">
                            <h6>Today's Lead Status</h6>
                            <canvas id="leadStatusChart"></canvas>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="dashboard-card chart-card">
                            <h6>Tasks Trend</h6>
                            <canvas id="tasksTrendChart"></canvas>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="dashboard-card chart-card">
                            <h6>Leads Trend</h6>
                            <canvas id="leadsTrendChart"></canvas>
                        </div>
                    </div>
                </div>

            </div>
            <?php $this->load->view('Template/footer'); ?>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Task Status Pie Chart
    const taskLabels = <?= json_encode(array_keys($today_task_status)); ?>;
    const taskData   = <?= json_encode(array_values($today_task_status)); ?>;
    new Chart(document.getElementById('taskStatusChart').getContext('2d'), {
        type: 'pie',
        data: {
            labels: taskLabels.length ? taskLabels : ["No Data"],
            datasets: [{
                data: taskData.length ? taskData : [1],
                backgroundColor: ['#007bff','#28a745','#ffc107','#dc3545','#6c757d']
            }]
        },
        options: { responsive: true, maintainAspectRatio: false }
    });

    // Lead Status Pie Chart
    const leadLabels = <?= json_encode(array_keys($today_lead_status)); ?>;
    const leadData   = <?= json_encode(array_values($today_lead_status)); ?>;
    new Chart(document.getElementById('leadStatusChart').getContext('2d'), {
        type: 'pie',
        data: {
            labels: leadLabels.length ? leadLabels : ["No Data"],
            datasets: [{
                data: leadData.length ? leadData : [1],
                backgroundColor: ['#007bff','#28a745','#ffc107','#dc3545','#6c757d']
            }]
        },
        options: { responsive: true, maintainAspectRatio: false }
    });

    // Tasks Trend Bar Chart
   // ---- TASKS TREND (stacked by status) ----
const yesterdayTaskStatus = <?= json_encode($yesterday_task_status); ?>;
const todayTaskStatus     = <?= json_encode($today_task_status); ?>;
const tomorrowTaskStatus  = <?= json_encode($tomorrow_task_status); ?>;

const taskStatuses = [...new Set([
    ...Object.keys(yesterdayTaskStatus),
    ...Object.keys(todayTaskStatus),
    ...Object.keys(tomorrowTaskStatus)
])];

// Assign colors dynamically (fallback cycling)
const taskColors = ['#28a745','#ffc107','#17a2b8','#dc3545','#6c757d','#007bff'];

const taskDatasets = taskStatuses.map((status, i) => ({
    label: status,
    data: [
        yesterdayTaskStatus[status] ?? 0,
        todayTaskStatus[status] ?? 0,
        tomorrowTaskStatus[status] ?? 0
    ],
    backgroundColor: taskColors[i % taskColors.length]
}));

new Chart(document.getElementById('tasksTrendChart').getContext('2d'), {
    type: 'bar',
    data: {
        labels: ["Yesterday", "Today", "Tomorrow"],
        datasets: taskDatasets
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { tooltip: { mode: 'index', intersect: false } },
        scales: { x: { stacked: true }, y: { stacked: true } }
    }
});

// ---- LEADS TREND (stacked by status) ----
const yesterdayLeadStatus = <?= json_encode($yesterday_lead_status); ?>;
const todayLeadStatus     = <?= json_encode($today_lead_status); ?>;
const tomorrowLeadStatus  = <?= json_encode($tomorrow_lead_status); ?>;

const leadStatuses = [...new Set([
    ...Object.keys(yesterdayLeadStatus),
    ...Object.keys(todayLeadStatus),
    ...Object.keys(tomorrowLeadStatus)
])];

// Reuse same color set
const leadDatasets = leadStatuses.map((status, i) => ({
    label: status,
    data: [
        yesterdayLeadStatus[status] ?? 0,
        todayLeadStatus[status] ?? 0,
        tomorrowLeadStatus[status] ?? 0
    ],
    backgroundColor: taskColors[i % taskColors.length]
}));

new Chart(document.getElementById('leadsTrendChart').getContext('2d'), {
    type: 'bar',
    data: {
        labels: ["Yesterday", "Today", "Tomorrow"],
        datasets: leadDatasets
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { tooltip: { mode: 'index', intersect: false } },
        scales: { x: { stacked: true }, y: { stacked: true } }
    }
});

</script>
</body>
</html>
