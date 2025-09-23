<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">
<?php $this->load->view('Template/head'); ?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<body>
    <?php
    $date  = date("Y-m-d");
    $date2 = date('Y-m-d', strtotime($date . ' + 1 day'));
    ?>
    <div class="main-wrapper">
        <div class="header">
            <?php $this->load->view('Template/header'); ?>
            <div class="page-wrapper">
                <div class="content container-fluid pb-0">

                    <?php $this->load->view('Template/page_header'); ?>

                    <div class="row">
                        <div class="col-md-12">

                            <!-- Page Title + Add Button -->
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="mb-0">Task Management</h4>
<?php
$show_add_button = false;

// $user is your logged-in user object from session or DB
$logged_in_user = $this->db->get_where('users', ['id' => $user->id])->row(); // Make sure this is an object, not an ID

// 1️⃣ Check if parent_id = 1 (super-admin)
if ($logged_in_user->parent_id == 1) {
    $show_add_button = true;
} 
// 2️⃣ Otherwise check access column (comma-separated numbers)
elseif (!empty($logged_in_user->access)) {
    $access_array = explode(',', $logged_in_user->access); // e.g., ["1","2","3","4"]
    if (in_array('1', $access_array)) { // 1 = "create" right
        $show_add_button = true;
    }
}
?>

<?php if($show_add_button): ?>
<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTaskModal">
    <i class="fas fa-plus"></i> Add Task
</button>
<?php endif; ?>





                            </div>
<!-- Status Filter -->
<form method="get" action="<?= base_url('Task'); ?>" class="row g-2 mb-3">
    <!-- Task Title Search -->
    <div class="col-12 col-md-4">
        <input type="text" name="title_search" class="form-control" 
               placeholder="Search Task Title..." 
               value="<?= htmlspecialchars($title_search ?? '', ENT_QUOTES); ?>">
    </div>

    <!-- Status Filter -->
    <div class="col-8 col-md-3">
        <select name="status_filter" class="form-control">
            <option value="">All (Active Default)</option>
            <?php foreach ($status_options as $status): ?>
                <option value="<?= $status['id']; ?>" 
                    <?= ($status_filter == $status['id']) ? 'selected' : ''; ?>>
                    <?= $status['name']; ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <!-- Filter Button -->
    <div class="col-4 col-md-2">
        <button type="submit" class="btn btn-info w-100">
            <i class="fas fa-filter"></i>
            <span class="d-none d-md-inline"> Filter</span>
        </button>
    </div>
</form>



                            <!-- Success message -->
                            <?php if ($this->session->flashdata('success')): ?>
                                <div class="alert alert-success"><?= $this->session->flashdata('success'); ?></div>
                            <?php endif; ?>

                            <!-- Task Table -->
                            <div class="table-responsive">
                                <div class="table-responsive">
<div class="table-responsive d-none d-md-block">
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Lead</th>
                <th>Assigned To</th>
                <th>Observer</th>
                <th>Priority</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Status</th>
                <?php if($show_status_info): ?>
                    <th>Changed By</th>
                    <th>Remark</th>
                <?php endif; ?>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($tasks)): $i = 1;
                foreach ($tasks as $task): ?>
                    <tr>
                        <td><?= $i++; ?></td>
                        <td><?= $task['title']; ?></td>
                        <td><?= $task['lead_name']; ?></td>
                        <td><?= $task['assigned_name']; ?></td>
                        <td><?= $task['observer']; ?></td>
                        <td><?= $task['priority']; ?></td>
                        <td><?= $task['start_date']; ?></td>
                        <td><?= $task['end_date']; ?></td>
                        <td>
                            <?php 
                                $status_display = !empty($task['status_name']) ? $task['status_name'] : 'Active';
                                $badge_class = ($status_display === 'Active') ? 'bg-success' : 'bg-secondary';
                            ?>
                            <span class="badge <?= $badge_class; ?>" 
                                  style="cursor:pointer;"
                                  onclick="changeStatus(<?= $task['id']; ?>)">
                                <?= $status_display; ?>
                            </span>
                        </td>

                        <?php if($show_status_info): ?>
                            <td>
                                <?= !empty($task['status_changed_by']) ? $task['status_changed_by'] : ''; ?>
                            </td>
                            <td>
                                <?= !empty($task['remark']) ? $task['remark'] : ''; ?>
                            </td>
                        <?php endif; ?>

                       <?php
// Get the logged-in user object
$logged_in_user = $this->db->get_where('users', ['id' => $user->id])->row();

// Split access into array if not empty
$access_array = !empty($logged_in_user->access) ? explode(',', $logged_in_user->access) : [];
?>

<td>
    <?php if ($logged_in_user->parent_id == 1 || in_array('2', $access_array)): ?>
        <button style="color: black;" class="btn btn-sm btn-warning"
            onclick="editTask(<?= $task['id']; ?>)">
            <i class="fas fa-edit"></i> Edit
        </button>
    <?php endif; ?>

    <?php if ($logged_in_user->parent_id == 1 || in_array('3', $access_array)): ?>
        <a style="color: white;" href="<?= base_url('Task/delete/' . $task['id']); ?>"
           class="btn btn-sm btn-danger"
           onclick="return confirm('Are you sure you want to delete this task?')">
           <i class="fas fa-trash"></i> Delete
        </a>
    <?php endif; ?>
</td>

                    </tr>
                <?php endforeach;
            else: ?>
                <tr>
                    <td colspan="<?= $show_status_info ? 12 : 10 ?>" class="text-center">No tasks found</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<!-- Task Cards (Mobile Only) -->
<div class="row g-3 d-block d-md-none">
    <?php if(!empty($tasks)): ?>
        <?php foreach($tasks as $task): ?>
            <?php 
                // Get logged-in user
                $logged_in_user = $this->db->get_where('users', ['id' => $user->id])->row();
                $access_array = !empty($logged_in_user->access) ? explode(',', $logged_in_user->access) : [];

                // Assigned To display
                $assignedToDisplay = ($task['assigned_to'] == $user->id) 
                    ? "<span class='badge bg-primary'>Your Lead</span>" 
                    : $task['assigned_name'];

                // Observer display
                $observers = !empty($task['observer']) ? explode(',', $task['observer']) : [];
                $observerDisplay = in_array($user->id, $observers) 
                    ? "<span class='badge bg-info text-dark'>Observer</span>" 
                    : (!empty($task['observer']) ? $task['observer'] : '');

                // Status Badge
                $status = strtolower($task['status_name'] ?? 'active');
                switch($status) {
                    case 'active': $badgeClass = 'bg-success'; break;
                    case 'pending': $badgeClass = 'bg-warning text-dark'; break;
                    case 'completed': $badgeClass = 'bg-primary'; break;
                    case 'cancelled': $badgeClass = 'bg-danger'; break;
                    default: $badgeClass = 'bg-secondary'; break;
                }

                $isObserver = in_array($user->id, $observers);
                $changedBy = !empty($task['status_changed_by']) 
                             ? ($this->db->get_where('users', ['id' => $task['status_changed_by']])->row()->name ?? '') 
                             : '';

                // Short remark for "see more"
                $remark = $task['remark'] ?? '';
                $shortRemark = (strlen($remark) > 35) ? substr($remark, 0, 35).'...' : $remark;
            ?>
            <div class="col-12">
                <div class="d-flex shadow-sm mb-3 rounded-3 overflow-hidden">

                    <!-- Left Date Panel -->
                    <div class="bg-primary text-white d-flex flex-column justify-content-center align-items-center px-2" style="min-width:90px;">
                        <small><?= date('d M Y', strtotime($task['created_at'])); ?></small>
                        <small><?= date('h:i a', strtotime($task['created_at'])); ?></small>
                    </div>

                    <!-- Right Content -->
                    <div class="card flex-grow-1 border-0 rounded-0">
                        <div class="card-body p-2">

                            <!-- Title + Edit -->
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <h6 class="fw-bold mb-0"><?= $task['title']; ?></h6>
                                <?php if ($logged_in_user->parent_id == 1 || in_array('2', $access_array)): ?>
                                    <button class="btn btn-sm btn-light" onclick="editTask(<?= $task['id']; ?>)">
                                        <i class="fas fa-edit text-primary"></i>
                                    </button>
                                <?php endif; ?>
                            </div>

                            <p class="mb-1 small"><strong>Lead:</strong> <?= $task['lead_name']; ?></p>
                            <p class="mb-1 small"><strong>Assigned To:</strong> <?= $assignedToDisplay; ?></p>
                            <?php if (!empty($observerDisplay)): ?>
                                <p class="mb-1 small"><strong>Observer:</strong> <?= $observerDisplay; ?></p>
                            <?php endif; ?>
                            <p class="mb-1 small"><strong>Priority:</strong> <?= $task['priority']; ?></p>
                            <p class="mb-1 small"><strong>Start → End:</strong> <?= $task['start_date']; ?> → <?= $task['end_date']; ?></p>

                            <p class="mb-1 small">
                                <strong>Status:</strong> 
                                <span class="badge <?= $badgeClass; ?> px-3 py-1" 
                                      style="cursor:<?= $isObserver ? 'not-allowed' : 'pointer'; ?>; background-color: rgb(1 28 85) !important;"
                                      <?= $isObserver ? '' : "onclick=\"changeStatus({$task['id']})\""; ?>>
                                    <?= ucfirst($task['status_name'] ?? 'Active'); ?>
                                    <?php if($isObserver): ?><small class="text-muted">(Observer)</small><?php endif; ?>
                                </span>
                            </p>

                            <?php if(!empty($changedBy)): ?>
                                <p class="mb-1 small"><strong>Changed By:</strong> <?= $changedBy; ?></p>
                            <?php endif; ?>

                            <!-- Remark with See More -->
                            <?php if(!empty($remark)): ?>
                                <p class="mb-1 small">
                                    <i class="fas fa-sticky-note me-1 text-muted"></i>
                                    <?= $shortRemark ?>
                                    <?php if(strlen($remark) > 35): ?>
                                        <a href="javascript:void(0)" onclick="showRemarkModal('<?= htmlspecialchars($remark, ENT_QUOTES); ?>')" style="color: #009efb;">see more</a>
                                    <?php endif; ?>
                                </p>
                            <?php endif; ?>

                            <!-- Delete Button -->
                            <?php if ($logged_in_user->parent_id == 1 || in_array('3', $access_array)): ?>
                                <div class="d-flex justify-content-end">
                                    <a href="<?= base_url('Task/delete/' . $task['id']); ?>"
                                       class="btn btn-sm btn-danger rounded-circle"
                                       onclick="return confirm('Are you sure you want to delete this task?')">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="col-12">
            <div class="alert alert-info text-center">No tasks found</div>
        </div>
    <?php endif; ?>
</div>

<!-- Full Remark Modal -->
<div class="modal fade" id="remarkModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content rounded-3">
      <div class="modal-header">
        <h6 class="modal-title">Task Remark</h6>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <p id="remarkText" class="small text-dark"></p>
      </div>
    </div>
  </div>
</div>

<script>
function showRemarkModal(text) {
    document.getElementById('remarkText').innerText = text;
    var modal = new bootstrap.Modal(document.getElementById('remarkModal'));
    modal.show();
}
</script>


                            </div>

                        </div>
                    </div>

                </div>
                <?php $this->load->view('Template/footer'); ?>
            </div>
        </div>
    </div>
<!-- Change Status Modal -->
<div class="modal fade" id="statusModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="statusForm" method="post" action="<?= base_url('Task/change_status'); ?>">
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title">Change Task Status</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="task_id" id="status_task_id">
<input type="hidden" name="parent_id" value="<?= $user->parent_id ?>">
<input type="hidden" name="status_changed_by" value="<?= $user->name?>">
                    <div class="mb-3">
                      <label class="form-label">Select Status</label>
<select name="status_id" id="status_id" class="form-control" required style="color: black;">
    <option value="">Select Status</option>
    <?php 
    // Determine parent_id based on role
    if (in_array($user->role, [1, 2])) {
        $parent_id = $user->id;   // use own ID if role is 1 or 2
    } else {
        $parent_id = $user->parent_id; // otherwise use parent_id
    }

    // Fetch status options
    $status_options = $this->db
        ->where(['type' => 'status', 'parent_id' => $parent_id])
        ->get('master_table')
        ->result_array();

    foreach ($status_options as $status): ?>
        <option value="<?= $status['id'] ?>"><?= $status['name'] ?></option>
    <?php endforeach; ?>
</select>

                    </div>

                    <div class="mb-3">
                        <label class="form-label">Remark</label>
                        <textarea name="remark" id="status_remark" class="form-control" rows="3" placeholder="Enter remark"></textarea>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-info">Update Status</button>
                </div>
            </form>
        </div>
    </div>
</div>

    <!-- Add Task Modal -->
    <!-- Add Task Modal -->
    <div class="modal fade" id="addTaskModal" tabindex="-1">
        <div class="modal-dialog modal-lg"> <!-- wider modal -->
            <div class="modal-content">
            <form action="<?= base_url('Task/add'); ?>" method="post">
    <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" style="color:white;"><i class="fas fa-tasks text" ></i> Add Task</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
    </div>
    <div class="modal-body">
        <div class="row g-2">
            <!-- Title -->
            <div class="col-md-6 col-12">
                <label class="form-label">Title</label>
                <input type="text" name="title" class="form-control form-control-sm" placeholder="Enter task title" required>
            </div>

            <!-- Lead -->
         <div class="col-md-6 col-12">
    <label class="form-label">Lead</label>
    <select name="lead_id" class="form-control form-control-sm select2" required>
        <option value="">Select Lead</option>
        <?php foreach ($leads as $lead): ?>
            <option value="<?= $lead['id']; ?>"><?= $lead['contact_name']; ?></option>
        <?php endforeach; ?>
    </select>
</div>

            <!-- Start Date -->
            <div class="col-md-6 col-12">
                <label class="form-label">Start Date</label>
                <input type="datetime-local" name="start_date" class="form-control form-control-sm" required>
            </div>

            <!-- End Date -->
            <div class="col-md-6 col-12">
                <label class="form-label">End Date</label>
                <input type="datetime-local" name="end_date" class="form-control form-control-sm" required>
            </div>

            <!-- Assign To -->
          <!-- Assign To -->
<div class="col-md-6 col-12">
    <label class="form-label">Assign To</label>
    <select name="assigned_to" class="form-control form-control-sm select2" required>
        <option value="">Select User</option>
        <?php foreach ($users as $u): ?>
            <option value="<?= $u['id']; ?>"> <?= $u['name'] ?> (<?= $u['role_name'] ?>)</option>
        <?php endforeach; ?>
    </select>
</div>

<!-- Observer -->
<div class="col-md-6 col-12">
    <label class="form-label">Observer</label>
    <select name="observer" class="form-control form-control-sm select2">
        <option value="">Select Observer</option>
        <?php foreach ($users as $u): ?>
            <option value="<?= $u['id']; ?>"> <?= $u['name'] ?> (<?= $u['role_name'] ?>)</option>
        <?php endforeach; ?>
    </select>
</div>


            <!-- Priority -->
            <div class="col-md-6 col-12">
                <label class="form-label">Priority</label>
                <select name="priority" class="form-control form-control-sm" required>
                    <option value="">Select Priority</option>
                    <option value="Low">Low</option>
                    <option value="Medium">Medium</option>
                    <option value="High">High</option>
                </select>
            </div>

            <!-- Active Checkbox -->
            <div class="col-md-6 col-12 d-flex align-items-center">
                <div class="form-check mt-2">
                    <input type="checkbox" class="form-check-input" name="active" id="activeTask" value="1">
                    <label class="form-check-label" for="activeTask">Active Task</label>
                </div>
            </div>

            <!-- Description -->
            <div class="col-12">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control form-control-sm" rows="3" placeholder="Enter task description"></textarea>
            </div>
        </div>
    </div>

    <div class="modal-footer bg-light">
        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">
            <i class="fas fa-times"></i> Close
        </button>
        <button type="submit" class="btn btn-primary btn-sm">
            <i class="fas fa-save"></i> Save Task
        </button>
    </div>
</form>

            </div>
        </div>
    </div>


    <!-- Edit Task Modal -->
    <!-- Edit Task Modal -->
    <div class="modal fade" id="editTaskModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
               <form action="<?= base_url('Task/update'); ?>" method="post">
    <div class="modal-header bg-primary text-white">
        <h5 class="modal-title"><i class="fas fa-edit"></i> Edit Task</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
    </div>

    <div class="modal-body">
        <input type="hidden" name="id" id="edit_id">
        <div class="row g-2">
            <!-- Title -->
            <div class="col-md-6 col-12">
                <label class="form-label">Title</label>
                <input type="text" name="title" id="edit_title" class="form-control form-control-sm" placeholder="Enter task title" required>
            </div>

            <!-- Lead -->
            <div class="col-md-6 col-12">
                <label class="form-label">Lead</label>
                <select name="lead_id" id="edit_lead" class="form-control form-control-sm select2" required>
                    <option value="">Select Lead</option>
                    <?php foreach ($leads as $lead): ?>
                        <option value="<?= $lead['id']; ?>"><?= $lead['contact_name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Start Date -->
            <div class="col-md-6 col-12">
                <label class="form-label">Start Date</label>
                <input type="datetime-local" name="start_date" id="edit_start_date" class="form-control form-control-sm" required>
            </div>

            <!-- End Date -->
            <div class="col-md-6 col-12">
                <label class="form-label">End Date</label>
                <input type="datetime-local" name="end_date" id="edit_end_date" class="form-control form-control-sm" required>
            </div>

            <!-- Assign To -->
            <div class="col-md-6 col-12">
                <label class="form-label">Assign To</label>
                <select name="assigned_to" id="edit_assigned_to" class="form-control form-control-sm select2" required>
                    <option value="">Select User</option>
                    <?php foreach ($users as $u): ?>
                        <option value="<?= $u['id']; ?>"><?= $u['name'] ?> (<?= $u['role_name'] ?>)</option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Observer -->
            <div class="col-md-6 col-12">
                <label class="form-label">Observer</label>
                <select name="observer" id="edit_observer" class="form-control form-control-sm select2">
                    <option value="">Select Observer</option>
                    <?php foreach ($users as $u): ?>
                        <option value="<?= $u['id']; ?>"><?= $u['name'] ?> (<?= $u['role_name'] ?>)</option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Priority -->
            <div class="col-md-6 col-12">
                <label class="form-label">Priority</label>
                <select name="priority" id="edit_priority" class="form-control form-control-sm" required>
                    <option value="">Select Priority</option>
                    <option value="Low">Low</option>
                    <option value="Medium">Medium</option>
                    <option value="High">High</option>
                </select>
            </div>

            <!-- Active Checkbox -->
            <div class="col-md-6 col-12 d-flex align-items-center">
                <div class="form-check mt-2">
                    <input type="checkbox" class="form-check-input" name="active" id="edit_active" value="1">
                    <label class="form-check-label" for="edit_active">Active Task</label>
                </div>
            </div>

            <!-- Description -->
            <div class="col-12">
                <label class="form-label">Description</label>
                <textarea name="description" id="edit_description" class="form-control form-control-sm" rows="3" placeholder="Enter task description"></textarea>
            </div>
        </div>
    </div>

    <div class="modal-footer bg-light">
        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">
            <i class="fas fa-times"></i> Close
        </button>
        <button type="submit" class="btn btn-primary btn-sm">
            <i class="fas fa-save"></i> Update Task
        </button>
    </div>
</form>

<!-- Initialize Select2 for Edit Form -->


            </div>
        </div>
    </div>
    <script>
$(document).ready(function() {
    $('#edit_lead, #edit_assigned_to, #edit_observer').select2({
        placeholder: "Select an option",
        allowClear: true,
        width: '100%'
    });
});
</script>
    <script>
$(document).ready(function() {
    $('.select2').select2({
        placeholder: "Select Lead",
        allowClear: true,
        width: '100%'
    });
});
</script>
<script>
function changeStatus(taskId) {
    document.getElementById('status_task_id').value = taskId;
    document.getElementById('status_id').value = ''; // reset
    document.getElementById('status_remark').value = '';
    var modal = new bootstrap.Modal(document.getElementById('statusModal'));
    modal.show();
}
</script>

    <!-- JS for Edit -->`
    <script>
        
        function editTask(id) {
            fetch("<?= base_url('Task/get/'); ?>" + id)
                .then(res => res.json())
                .then(data => {
                    document.getElementById('edit_id').value = data.id;
                    document.getElementById('edit_title').value = data.title;
                    document.getElementById('edit_lead').value = data.lead_id;
                    document.getElementById('edit_start_date').value = data.start_date;
                    document.getElementById('edit_end_date').value = data.end_date;
                    document.getElementById('edit_assigned_to').value = data.assigned_to;
                    document.getElementById('edit_observer').value = data.observer;
                    document.getElementById('edit_priority').value = data.priority;
                    document.getElementById('edit_active').checked = data.active == 1 ? true : false;
                    document.getElementById('edit_description').value = data.description;
                    var modal = new bootstrap.Modal(document.getElementById('editTaskModal'));
                    modal.show();
                });
        }
    </script>

</body>

</html>