<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">
<?php $this->load->view('Template/head'); ?>

<body>
<?php  
    $date  = date("Y-m-d");
    $date2 = date('Y-m-d', strtotime($date.' + 1 day')); 
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
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTaskModal">
                                <i class="fas fa-plus"></i> Add Task
                            </button>
                        </div>

                        <!-- Success message -->
                        <?php if($this->session->flashdata('success')): ?>
                            <div class="alert alert-success"><?= $this->session->flashdata('success'); ?></div>
                        <?php endif; ?>

                        <!-- Task Table -->
                        <div class="table-responsive">
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
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(!empty($tasks)): $i=1; foreach($tasks as $task): ?>
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
                                            <?php if($task['active']): ?>
                                                <span class="badge bg-success">Active</span>
                                            <?php else: ?>
                                                <span class="badge bg-secondary">Inactive</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <button style="color: black;" class="btn btn-sm btn-warning" 
                                                onclick="editTask(<?= $task['id']; ?>)">
                                                <i class="fas fa-edit"></i> Edit
                                            </button>
                                            <a style="color: white;" href="<?= base_url('Task/delete/'.$task['id']); ?>" 
                                                class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this task?')">
                                                <i class="fas fa-trash"></i> Delete
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach; else: ?>
                                    <tr>
                                        <td colspan="10" class="text-center">No tasks found</td>
                                    </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

            </div>
            <?php $this->load->view('Template/footer'); ?>
        </div>
    </div>
</div>

<!-- Add Task Modal -->
<!-- Add Task Modal -->
<div class="modal fade" id="addTaskModal" tabindex="-1">
    <div class="modal-dialog modal-lg"> <!-- wider modal -->
        <div class="modal-content">
            <form action="<?= base_url('Task/add'); ?>" method="post">
               <!--  <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title"><i class="fas fa-tasks"></i> Add Task</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div> -->
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6 col-12">
                            <label class="form-label">Title</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>
                        <div class="col-md-6 col-12">
                            <label class="form-label">Lead</label>
                            <select name="lead_id" class="form-control" required>
                                <option value="">Select Lead</option>
                                <?php foreach($leads as $lead): ?>
                                    <option value="<?= $lead['id']; ?>"><?= $lead['contact_name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6 col-12">
                            <label class="form-label">Start Date</label>
                            <input type="datetime-local" name="start_date" class="form-control" required>
                        </div>
                        <div class="col-md-6 col-12">
                            <label class="form-label">End Date</label>
                            <input type="datetime-local" name="end_date" class="form-control" required>
                        </div>
                        <div class="col-md-6 col-12">
                            <label class="form-label">Assign To</label>
                            <select name="assigned_to" class="form-control" required>
                                <option value="">Select User</option>
                                <?php foreach($users as $user): ?>
                                    <option value="<?= $user['id']; ?>"><?= $user['username']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6 col-12">
                            <label class="form-label">Observer</label>
                            <select name="observer" class="form-control">
                                <option value="">Select Observer</option>
                                <?php foreach($users as $user): ?>
                                    <option value="<?= $user['id']; ?>"><?= $user['username']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6 col-12">
                            <label class="form-label">Priority</label>
                            <select name="priority" class="form-control" required>
                                <option value="">Select Priority</option>
                                <option value="Low">Low</option>
                                <option value="Medium">Medium</option>
                                <option value="High">High</option>
                            </select>
                        </div>
                        <div class="col-md-6 col-12 d-flex align-items-center">
                            <div class="form-check mt-4">
                                <input type="checkbox" class="form-check-input" name="active" id="activeTask" value="1">
                                <label class="form-check-label" for="activeTask">Active Task</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-times"></i> Close</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save Task</button>
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
             <!--    <div class="modal-header bg-success text-white">
                    <h5 class="modal-title"><i class="fas fa-edit"></i> Edit Task</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div> -->
                <div class="modal-body">
                    <input type="hidden" name="id" id="edit_id">
                    <div class="row g-3">
                        <div class="col-md-6 col-12">
                            <label class="form-label">Title</label>
                            <input type="text" name="title" id="edit_title" class="form-control" required>
                        </div>
                        <div class="col-md-6 col-12">
                            <label class="form-label">Lead</label>
                            <select name="lead_id" id="edit_lead" class="form-control" required>
                                <option value="">Select Lead</option>
                                <?php foreach($leads as $lead): ?>
                                    <option value="<?= $lead['id']; ?>"><?= $lead['contact_name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6 col-12">
                            <label class="form-label">Start Date</label>
                            <input type="datetime-local" name="start_date" id="edit_start_date" class="form-control" required>
                        </div>
                        <div class="col-md-6 col-12">
                            <label class="form-label">End Date</label>
                            <input type="datetime-local" name="end_date" id="edit_end_date" class="form-control" required>
                        </div>
                        <div class="col-md-6 col-12">
                            <label class="form-label">Assign To</label>
                            <select name="assigned_to" id="edit_assigned_to" class="form-control" required>
                                <option value="">Select User</option>
                                <?php foreach($users as $user): ?>
                                    <option value="<?= $user['id']; ?>"><?= $user['username']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6 col-12">
                            <label class="form-label">Observer</label>
                            <select name="observer" id="edit_observer" class="form-control">
                                <option value="">Select Observer</option>
                                <?php foreach($users as $user): ?>
                                    <option value="<?= $user['id']; ?>"><?= $user['username']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6 col-12">
                            <label class="form-label">Priority</label>
                            <select name="priority" id="edit_priority" class="form-control" required>
                                <option value="">Select Priority</option>
                                <option value="Low">Low</option>
                                <option value="Medium">Medium</option>
                                <option value="High">High</option>
                            </select>
                        </div>
                        <div class="col-md-6 col-12 d-flex align-items-center">
                            <div class="form-check mt-4">
                                <input type="checkbox" class="form-check-input" name="active" id="edit_active" value="1">
                                <label class="form-check-label" for="edit_active">Active Task</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Description</label>
                            <textarea name="description" id="edit_description" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times"></i> Close
                    </button>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Update Task
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

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
