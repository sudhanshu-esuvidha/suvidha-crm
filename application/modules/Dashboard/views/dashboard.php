<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">
<?php $this->load->view('Template/head'); ?>
<!-- Bootstrap Icons CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

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
<div class="col-6 col-sm-6 col-md-6 position-relative">
    <a href="<?= base_url('Leads/list'); ?>" class="text-decoration-none">
        <div class="dashboard-card bg-info text-white position-relative p-3">
            <!-- Icon at top-left -->
            <i class="bi bi-people-fill position-absolute" style="top: 10px; left: 10px; font-size: 24px;"></i>

            <!-- Number and label -->
            <h3 style="color:white; margin-top: 30px;"><?= $total_leads; ?></h3>
            <h6 class="mt-2" style="color:white;">Total Leads</h6>
        </div>
    </a>
</div>

<div class="col-6 col-sm-6 col-md-6 position-relative">
    <a href="<?= base_url('Task'); ?>" class="text-decoration-none">
        <div class="dashboard-card bg-success text-white position-relative p-3">
            <!-- Professional Icon -->
            <i class="bi bi-kanban-fill position-absolute" style="top: 10px; left: 10px; font-size: 24px;"></i>

            <!-- Number and label -->
            <h3 style="color:white; margin-top: 30px;"><?= $total_tasks; ?></h3>
            <h6 class="mt-2" style="color:white;">Total Tasks</h6>
        </div>
    </a>
</div>
<div class="col-6 col-sm-6 col-md-6 position-relative">
    <a href="<?= base_url('Leads/list?filter=today_followup') ?>" class="text-decoration-none">
        <div class="dashboard-card bg-warning text-white position-relative p-3">
            <!-- Professional Icon -->
            <i class="bi bi-clock-fill position-absolute" style="top: 10px; left: 10px; font-size: 24px;"></i>

            <!-- Number and label -->
            <h3 style="color:white; margin-top: 30px;"><?= $today_followups; ?></h3>
            <h6 class="mt-2" style="color:white;">Today's Follow-ups</h6>
        </div>
    </a>
</div>


<div class="col-6 col-sm-6 col-md-6 position-relative">
    <a href="<?= base_url('Leads/list?filter=tomorrow_followup') ?>" class="text-decoration-none">
        <div class="dashboard-card bg-danger text-white position-relative p-3">
            <!-- Professional Icon -->
            <i class="bi bi-calendar-check-fill position-absolute" style="top: 10px; left: 10px; font-size: 24px;"></i>

            <!-- Number and label -->
            <h3 style="color:white; margin-top: 30px;"><?= $tomorrow_followups; ?></h3>
            <h6 class="mt-2" style="color:white;">Tomorrow's Follow-ups</h6>
        </div>
    </a>
</div>

<!-- Floating Pending Follow-up Button -->
<button id="pendingFollowupBtn" class="btn btn-warning"
        style="
            position: fixed;
            bottom: 90px; /* slightly above the dialer button */
            right: 20px;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 24px;
            z-index: 9999;
            box-shadow: 0 4px 8px rgba(0,0,0,0.3);
        ">
    <i class="bi bi-hourglass-split"></i>
</button>




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
<div class="col-12">
    <div class="dashboard-card chart-card">
        <h6>Lead Sources</h6>
        <canvas id="leadSourcesChart"></canvas>
    </div>
</div>
            </div>
            <?php $this->load->view('Template/footer'); ?>
        </div>
    </div>
</div>
<!-- Floating Dialer Button -->
<!-- Floating Dialer Button -->
<!-- Floating Dialer Button -->
<button id="dialerBtn" class="btn btn-success"
        style="
            position: fixed;
            bottom: 20px;
            right: 20px;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 24px;
            z-index: 9999;
            box-shadow: 0 4px 8px rgba(0,0,0,0.3);
        ">
    <i class="bi bi-telephone-fill"></i>
</button>


<!-- Dialer Form -->
<div id="dialerOverlay" 
     style="
         display: none;
         position: fixed;
         bottom: 0;
         left: 0;
         width: 100%;
         max-width: 400px;
         margin: auto;
         background: #fff;
         border-top-left-radius: 20px;
         border-top-right-radius: 20px;
         box-shadow: 0 -4px 15px rgba(0,0,0,0.3);
         padding: 20px;
         z-index: 10000;
         font-family: 'Poppins', sans-serif;
     ">

    <!-- Close Button -->
    <div style="text-align: right; margin-bottom: 10px;">
        <button id="closeDialer" class="btn btn-light btn-sm">
            <i class="bi bi-x-lg"></i>
        </button>
    </div>

    <!-- Display Input -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <input type="tel" id="dialNumberInput" 
               class="form-control fs-4 text-center" 
               placeholder="Enter Number" readonly
               style="border-radius: 12px; padding: 15px; font-weight: 600;">
        <button id="backspaceBtn" class="btn btn-light ms-2 fs-4" style="width:60px;">⌫</button>
    </div>

    <!-- Keypad -->
    <div class="dialer-keypad">
        <div class="d-flex justify-content-between mb-2">
            <button class="btn btn-light keypad-btn fs-4 flex-fill mx-1">1</button>
            <button class="btn btn-light keypad-btn fs-4 flex-fill mx-1">2</button>
            <button class="btn btn-light keypad-btn fs-4 flex-fill mx-1">3</button>
        </div>
        <div class="d-flex justify-content-between mb-2">
            <button class="btn btn-light keypad-btn fs-4 flex-fill mx-1">4</button>
            <button class="btn btn-light keypad-btn fs-4 flex-fill mx-1">5</button>
            <button class="btn btn-light keypad-btn fs-4 flex-fill mx-1">6</button>
        </div>
        <div class="d-flex justify-content-between mb-2">
            <button class="btn btn-light keypad-btn fs-4 flex-fill mx-1">7</button>
            <button class="btn btn-light keypad-btn fs-4 flex-fill mx-1">8</button>
            <button class="btn btn-light keypad-btn fs-4 flex-fill mx-1">9</button>
        </div>
        <div class="d-flex justify-content-between">
            <button class="btn btn-light keypad-btn fs-4 flex-fill mx-1">*</button>
            <button class="btn btn-light keypad-btn fs-4 flex-fill mx-1">0</button>
            <button class="btn btn-light keypad-btn fs-4 flex-fill mx-1">#</button>
        </div>
    </div>

    <!-- Call Button -->
    <button id="callNumberBtn" class="btn btn-success w-100 mt-3 fs-5 py-2">
        <i class="bi bi-telephone-fill"></i> Call
    </button>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const pendingBtn = document.getElementById('pendingFollowupBtn');

pendingBtn.addEventListener('click', () => {
    // Redirect to Leads/list with filter for yesterday + status=0
    window.location.href = "<?= base_url('Leads/list?filter=yesterday_pending') ?>";
});
</script>
<script>
const dialerBtn = document.getElementById('dialerBtn');
const dialerOverlay = document.getElementById('dialerOverlay');
const closeDialer = document.getElementById('closeDialer');
const callNumberBtn = document.getElementById('callNumberBtn');
const dialInput = document.getElementById('dialNumberInput');
const backspaceBtn = document.getElementById('backspaceBtn');

// Show dialer
dialerBtn.addEventListener('click', () => {
    dialerOverlay.style.display = "block";
});

// Close dialer
closeDialer.addEventListener('click', () => {
    dialerOverlay.style.display = "none";
});

// Keypad input
document.querySelectorAll('.keypad-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        dialInput.value += btn.textContent;
    });
});

// Backspace functionality
backspaceBtn.addEventListener('click', () => {
    dialInput.value = dialInput.value.slice(0, -1);
});

// Call number
callNumberBtn.addEventListener('click', () => {
    const number = dialInput.value.trim();
    if(number === "") {
        alert("Please enter a phone number");
        return;
    }
    window.location.href = `tel:${number}`;
});
</script>

<script>
    // Convert PHP array into JS arrays
    const leadSources = <?= json_encode(array_column($lead_sources, 'source')); ?>;
    const leadCounts  = <?= json_encode(array_column($lead_sources, 'lead_count')); ?>;

    new Chart(document.getElementById('leadSourcesChart').getContext('2d'), {
        type: 'pie',
        data: {
            labels: leadSources.length ? leadSources : ["No Data"],
            datasets: [{
                data: leadCounts.length ? leadCounts : [1],
                backgroundColor: [
                    '#007bff','#28a745','#ffc107','#dc3545',
                    '#17a2b8','#6610f2','#e83e8c','#20c997',
                    '#fd7e14','#6c757d'
                ]
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'bottom' }
            }
        }
    });
</script>

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
