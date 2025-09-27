<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">
<?php $this->load->view('Template/head',$data); ?>
<!-- Bootstrap Icons CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<!-- Flatpickr CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<!-- Flatpickr JS -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

<!-- Flatpickr JS -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<body>
	<?php  $date=date("Y-m-d");
	$date2=date('Y-m-d', strtotime($date.' + 1 day')); ?>
	<div class="main-wrapper">
		<div class="header">
			<?php $this->load->view('Template/header',$data); ?>
			<div class="page-wrapper">
				<div class="content container-fluid pb-0">
					<?php $this->load->view('Template/page_header',$data); ?>
					<div class="row">
							<?php
// Get logged-in user object
$logged_in_user = $this->db->get_where('users', ['id' => $user->id])->row();

// Convert access string into array
$access_array = !empty($logged_in_user->access) ? explode(',', $logged_in_user->access) : [];
?>

<div class="col-md-12 d-flex flex-wrap gap-2">

    <?php if ($user->role == 1 || $user->role == 2): ?>
        <span onclick="delete_selected()" class="custom-btn bg-danger btn-sm">
            <i class="fas fa-trash"></i> Delete Selected
        </span>
    <?php endif; ?>

    <div class="container mt-3">
        <?php if (!empty($success)): ?>
            <div class="alert alert-success">
                <?= $success ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($errors)): ?>
            <div class="alert alert-warning">
                <strong>Some rows were not imported:</strong>
                <ul>
                    <?php foreach ($errors as $err): ?>
                        <li><?= $err ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
    </div>

    <!-- Upload CSV -->
    <?php if (in_array(9, $access_array) || $logged_in_user->parent_id == 1): ?>
        <span onclick="upload_csv()" class="custom-btn bg-success btn-sm">
            <i class="fas fa-upload"></i>CSV
        </span>
    <?php endif; ?>

    <!-- Download Sample -->
    <?php if (in_array(8, $access_array) || $logged_in_user->parent_id == 1): ?>
        <span class="custom-btn bg-danger btn-sm">
            <a download href="<?= base_url(); ?>lead_sample_csv.csv" class="text-white text-decoration-none">
                <i class="fas fa-download"></i>Sample
            </a>
        </span>
    <?php endif; ?>

    <!-- Assign To -->
    <?php if ($logged_in_user->parent_id == 1): ?>
        <span onclick="assign_to()" class="custom-btn bg-info btn-sm">
            <i class="fas fa-users"></i>Assign To
        </span>
    <?php endif; ?>

</div>


<style>
    .custom-btn {
    padding: 4px 10px;   /* smaller padding */
    border-radius: 4px;
    font-size: 13px;     /* smaller font */
    cursor: pointer;
    display: inline-block;
}
.custom-btn i {
    font-size: 12px;     /* smaller icons */
}

.custom-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 4px 10px;      /* Medium size */
    font-size: 16px;         /* Medium text */
    cursor: pointer;
    border-radius: 6px;
    color: #fff;
    transition: background 0.3s;
}

.custom-btn i {
    margin-right: 6px;       /* Space between icon and text */
}

.custom-btn:hover {
    opacity: 0.85;           /* Simple hover effect */
}

.custom-btn a {
    display: inline-flex;
    align-items: center;
    color: #fff;
}
</style>


					<div class="row mt-2" >
					<?php if($user->role == 1 || $user->role == 2){ ?>
<div class="col-md-12 d-flex gap-2">

    <?php 
    // Get logged-in user's ID from session
    $logged_in_user_id = ucfirst($user->id);

    // Fetch users where parent_id = logged-in user's ID
    $assign_to = $this->db->get_where('users', ['parent_id' => $logged_in_user_id])->result(); 
    ?>
   
    <select onchange="filter_by()" id="assign_to" class="custom-select"  style="width: 50%!important;">
        <option value="" >--employee--</option>
        <?php foreach($assign_to as $userAssign){ ?>
            <option <?php if(isset($_GET['assign_to']) && $_GET['assign_to'] == $userAssign->id){ echo "selected"; } ?> 
                    value="<?= $userAssign->id; ?>">
                <?= $userAssign->name; ?>
            </option>
        <?php } ?>
    </select>

    <?php 
    $status = $this->db
                   ->get_where('master_table', ['type' => 'status', 'parent_id' => $logged_in_user_id])
                   ->result(); 
    ?>
    <select onchange="filter_by()" id="status" class="custom-select" >
        <option value="">--status--</option>
        <?php foreach($status as $rowStatus){ ?>
            <option <?php if(isset($_GET['status']) && $_GET['status'] == $rowStatus->id){ echo "selected"; } ?> 
                    value="<?= $rowStatus->id; ?>">
                <?= $rowStatus->name; ?>
            </option>
        <?php } ?>
    </select>

</div>



<style>
.custom-select {
    padding: 8px 12px;      /* Medium size */
    font-size: 16px;        /* Medium text */
    border-radius: 6px;
    border: 1px solid #ccc;
      /* Minimum width */
    cursor: pointer;
    transition: border-color 0.3s, box-shadow 0.3s;
}

.custom-select:focus {
    border-color: #28a745;
    box-shadow: 0 0 5px rgba(40, 167, 69, 0.5);
    outline: none;
}
</style>

<?php } ?>
<div class="quick-filters d-flex gap-2 mb-3 mt-3">

  <a href="<?= base_url('Leads/list?filter=fresh') ?>" class="btn btn-success btn-sm">
    <i class="fas fa-bolt"></i> Fresh
</a>

    <a href="<?= base_url('Leads/list?next_followup=1') ?>" class="btn btn-primary btn-sm">
        <i class="fas fa-calendar-check"></i> Follow-up
    </a>

    <!-- <a href="<?= base_url('Leads/list?filter=today_created') ?>" class="btn btn-info btn-sm">
        <i class="fas fa-calendar-day"></i> Created Today
    </a> -->

    <a href="<?= base_url('Leads/list') ?>" class="btn btn-secondary btn-sm">
        <i class="fas fa-list"></i> All Leads
    </a>
   
</div>
<?php
$logged_in_user = $this->session->userdata('user_info');
$role = $logged_in_user->role;

// Show status filter only if role is NOT 1 or 2
if ($role != 1 && $role != 2):
    $logged_in_user_id = $logged_in_user->id;

    // Fetch parent_id for this user
    $user = $this->db->get_where('users', ['id' => $logged_in_user_id])->row();
    $parent_id_to_use = $user->parent_id ?? 0;

    // Fetch status options
    $status_options = $this->db->get_where('master_table', [
        'type' => 'status',
        'parent_id' => $parent_id_to_use
    ])->result();
?>
<div class="row mt-2">
  <div class="col-12 col-md-6 mb-2">
    <select id="status_filter" class="form-select form-select-sm" style="
        width: 100%;
        padding: 0.35rem 0.5rem;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 0.875rem;
        box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);
        transition: border-color 0.2s;
    ">
        <option value="">-- Select Status --</option>
        <?php foreach($status_options as $status): ?>
            <option value="<?= $status->id ?>" <?php if(isset($_GET['status']) && $_GET['status']==$status->id) echo 'selected'; ?>>
                <?= htmlspecialchars($status->name) ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>

<style>
    #status_filter:focus {
        border-color: #4a90e2;
        outline: none;
        box-shadow: 0 0 0 0.15rem rgba(74, 144, 226, 0.25);
    }
</style>

</div>
<?php endif; ?>

<div class="d-flex gap-2 align-items-center mb-3">
    <!-- Date Filter -->
    <input type="date" id="filter_date" class="form-control" onchange="filterByDate()" style="flex: 1;" placeholder="Select Date">

    <!-- Search Filter -->
<input type="text" id="lead_search" class="form-control" placeholder="Search by name, mobile number or source" style="flex: 1;">
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(function() {

  // Helper: try to extract a meaningful "source" string from a row/card element
  function extractSourceText($el) {
    // 1) Elements with class containing "source" (handles .source, .lead-source, etc.)
    var $found = $el.find('[class*="source"], .source, [data-source], [data-source-name]');
    if ($found.length) {
      var parts = [];
      $found.each(function() {
        var $t = $(this);
        var txt = $.trim($t.text());
        if (!txt) {
          txt = $.trim($t.attr('data-source') || $t.attr('data-source-name') || $t.attr('title') || $t.attr('aria-label') || '');
        }
        if (txt) parts.push(txt);
      });
      if (parts.length) return parts.join(' ').toLowerCase();
    }

    // 2) Attributes directly on the element (fallback)
    var attrs = ['data-source', 'data-source-name', 'title', 'aria-label', 'alt'];
    for (var i = 0; i < attrs.length; i++) {
      var a = $el.attr(attrs[i]);
      if (a) return $.trim(a).toLowerCase();
    }

    // 3) Images/icons inside the element may have title/alt
    var $img = $el.find('img[alt], img[title], i[title], span[title]').first();
    if ($img.length) {
      return $.trim($img.attr('alt') || $img.attr('title') || '').toLowerCase();
    }

    return '';
  }

  // Cache selectors
  var $rows = $("table tbody tr");
  var $cards = $("#list-mobile li");

  // Use 'input' (captures paste, cut, etc.) instead of only keyup
  $("#lead_search").on("input", function() {
    var value = $(this).val().toLowerCase().trim();

    // If empty, show all
    if (!value) {
      $rows.show();
      $cards.show();
      return;
    }

    // Filter rows
    $rows.each(function() {
      var $row = $(this);
      var rowText = $row.text().toLowerCase();
      var sourceText = extractSourceText($row); // robust source extraction
      var match = rowText.indexOf(value) > -1 || sourceText.indexOf(value) > -1;
      $row.toggle(match);
    });

    // Filter mobile cards/list items
    $cards.each(function() {
      var $card = $(this);
      var cardText = $card.text().toLowerCase();
      var sourceText = extractSourceText($card);
      var match = cardText.indexOf(value) > -1 || sourceText.indexOf(value) > -1;
      $card.toggle(match);
    });
  });
});
</script>



<script>
function filterByDate() {
    var date = $("#filter_date").val();
    if(date) {
        window.location.href = "<?= base_url('Leads/list') ?>?date=" + date;
    }
}
</script>
<script>
function filter_status_only() {
    var status = $('#status_filter').val();
    var url = "<?= base_url('Leads/list') ?>?";

    if(status) {
        url += "status=" + status;
    }

    window.location.href = url;
}

// Attach onchange event
$(document).ready(function() {
    $('#status_filter').on('change', filter_status_only);
});
</script>


						<?php if($this->session->flashdata('success')){ ?>
						<div class="col-md-12">
							<div class="alert alert-solid-success alert-dismissible fade show">
								<?php echo $this->session->flashdata('success');  $this->session->set_flashdata('success',''); ?>
								<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i class="fas fa-xmark"></i></button>
							</div>
						</div>
					<?php } ?>

					</div>
					<div class="row mt-2">
					  <div class="col-md-12">
					   <span class="pull-right small">  Total <?php echo $total; ?> Result  Found</span> 
					      
					  </div>    
					</div>
<div class="row mt-2" style="padding-right:0.01px !important;">

    <!-- ✅ Mobile View (Cards) -->
<div class="col-12 d-block d-md-none">
    <div class="card1 flex-fill" style="padding: 1px; border-radius: 8px;">
        <div class="card-body" style="padding: 1px;">
            <div class="employee-noti-content">
                <ul class="employee-notification-list" id="list-mobile">
                  <?php foreach($result as $row): 
    if($row->mobile_no): 
        $assign_to = get_row('users',' where id='.$row->assign_to);
        $last_call = get_row('lead_status_log',' where lead_id='.$row->id.' order by id desc');
        $status    = get_row('master_table',' where id='.$row->status_id);

        // Prepare numbers array
        $numbers = [$row->mobile_no];
        if(!empty($row->add_mobile_no)){
            $additional_numbers = explode(',', $row->add_mobile_no);
            $numbers = array_merge($numbers, $additional_numbers);
        }
?>
<li class="employee-notification-grid mb-3">
    <div class="employee-notification-content" style="font-size: 15px;">
        <h6 class="fw-bold">
            <input type="checkbox" class="lead_ids" value="<?= $row->id ?>" style="transform: scale(1.2); margin-right: 5px;"> 

            <?php if(count($numbers) == 1): ?>
                <!-- Single number -->
                <a href="tel:<?= $numbers[0] ?>" onclick="feedback_form(<?= $row->id ?>, '<?= $numbers[0] ?>', '<?= addslashes($row->contact_name) ?>')">
                    <?= ucwords($row->contact_name) ?>
                    <span class="badge bg-primary pull-right">
                        <i class="la la-phone-volume"></i> <?= $numbers[0] ?>
                    </span>
                </a>
            <?php else: ?>
                <!-- Multiple numbers: open modal -->
                <a href="#" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#mobileModal<?= $row->id ?>">
                    <?= ucwords($row->contact_name) ?>
                    <span class="badge bg-primary pull-right">
                        <i class="la la-phone-volume"></i> <?= $row->mobile_no ?>
                    </span>
                </a>

                <!-- Modal -->
                <div class="modal fade" id="mobileModal<?= $row->id ?>" tabindex="-1" aria-labelledby="mobileModalLabel<?= $row->id ?>" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="mobileModalLabel<?= $row->id ?>">Call Numbers - <?= ucwords($row->contact_name) ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                      </div>
                      <div class="modal-body">
                        <ul class="list-group">
                            <?php foreach($numbers as $num): ?>
                                <li class="list-group-item">
                                    <a href="tel:<?= $num ?>" onclick="feedback_form(<?= $row->id ?>, '<?= $num ?>', '<?= addslashes($row->contact_name) ?>')">
                                        <?= $num ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>
            <?php endif; ?>
 <span class="small d-block mt-1">
                <i class="fa fa-map-marker"></i> <?= $row->address ?>
            </span>
        </h6>

        <div class="d-flex justify-content-between mt-2" style="font-size:14px;">
            <span>Assigned To: <b><?= ucwords($assign_to->name) ?></b></span>
            <span>Course: <b><?= $row->description ?></b></span>
        </div>

        <div class="d-flex justify-content-between mt-2" style="font-size:14px;">
            <span>Last Call: <?= date("d-M-Y h:i a", strtotime($last_call->created_at)) ?></span>
            <span>
                <?php if($row->status_id==0): ?>
                    <span class="badge bg-success" style="font-size:13px; padding:6px 10px;">Fresh Lead</span>
                <?php else: ?>
                    <span class="badge bg-info" style="font-size:13px; padding:6px 10px;"><?= $status->name ?></span>
                <?php endif; ?>
            </span>
        </div>

        <?php if($last_call->remark): ?>
            <div class="mt-2" style="font-size:14px;">Remark: <i><?= $last_call->remark ?></i></div>
            <div class="mt-2" style="font-size:14px;">Source: <i><?= $row->source ?></i></div>
        <?php endif; ?>

        <div class="d-flex justify-content-between mt-2" style="font-size:14px;">
            <span>Next Followup: <?= ($row->next_followup!="0000-00-00 00:00:00") ? date("d-M-Y h:i a", strtotime($row->next_followup)) : '' ?></span>
            <span>Date Created: <?= date("d-M-Y h:i a", strtotime($row->created_at)) ?></span>
        </div>

        <div class="d-flex justify-content-between mt-3">
            <?php
            $logged_in_user = $this->db->get_where('users', ['id' => $user->id])->row();
            $access_array = !empty($logged_in_user->access) ? explode(',', $logged_in_user->access) : [];
            ?>
            <?php if ($logged_in_user->parent_id == 1 || in_array('3', $access_array)): ?>
                <a href="<?= base_url('Leads/delete/'.$row->id) ?>" 
                   class="btn btn-danger"
                   style="padding:8px 14px; font-size:13px;"
                   onclick="return confirm('Are you sure you want to delete this record?');">
                   <i class="fas fa-trash"></i> Delete
                </a>
            <?php endif; ?>

            <button onclick="window.location.href='<?= base_url() ?>Leads/lead_details/<?= $row->id ?>'" 
                    class="btn btn-primary"
                    style="padding:8px 14px; font-size:13px;">
                <i class="fas fa-eye"></i> View
            </button>
    </div>
</li>
<?php endif; endforeach; ?>



                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Floating Add Button -->
<!-- Floating Add Button -->
<a href="javascript:void(0);" class="floating-btn" data-bs-toggle="modal" data-bs-target="#addLeadModal">
    <i class="fas fa-plus"></i>
</a>

<style>
.floating-btn {
    position: fixed;
    bottom: 20px;
    right: 20px;
    background: #021c55;
    color: #fff;
    width: 55px;
    height: 55px;
    border:2px solid #fff;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 22px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.2);
    z-index: 9999;
}
.floating-btn:hover {
    background: #218838;
    text-decoration: none;
    color: #fff;
}
.flatpickr-input {
    border-radius: 0.5rem;
    padding: 0.5rem 0.75rem;
    font-size: 0.95rem;
}
</style>






<div class="modal fade" id="addLeadModal" tabindex="-1" aria-labelledby="addLeadModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form action="<?= base_url('Leads/store') ?>" method="post" id="addLeadForm">
        <div class="modal-header">
          <h5 class="modal-title" id="addLeadModalLabel">Add New Lead</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Contact Name</label>
            <input type="text" name="contact_name" class="form-control" required>
          </div>

          <!-- MOBILE NUMBERS -->
          <div class="mb-3">
            <label class="form-label">Mobile Numbers</label>
            <div id="mobile_numbers_container">
              <div class="input-group mb-2 phone-number-field">
                <input type="text" name="mobile_numbers[]" class="form-control" placeholder="Enter mobile number" required>
                <button type="button" class="btn btn-outline-success btn-sm add-number-btn" title="Add another number">
                  <i class="fa-solid fa-circle-plus"></i>
                </button>
              </div>
            </div>
            <small class="text-muted">First number will be stored in <strong>mobile_no</strong>, additional numbers in <strong>add_mobile_no</strong>.</small>
          </div>

          <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control">
          </div>
          <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="2"></textarea>
          </div>
          <div class="mb-3">
            <label class="form-label">Source</label>
            <input type="text" name="source" class="form-control">
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Add Lead</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const container = document.getElementById('mobile_numbers_container');

    // Add/remove mobile fields dynamically
    container.addEventListener('click', function(e) {
        if (e.target.closest('.add-number-btn')) {
            const newField = document.createElement('div');
            newField.classList.add('input-group', 'mb-2', 'phone-number-field');
            newField.innerHTML = `
                <input type="text" name="mobile_numbers[]" class="form-control" placeholder="Enter mobile number" required>
                <button type="button" class="btn btn-outline-danger btn-sm remove-number-btn" title="Remove number">
                    <i class="fa-solid fa-trash"></i>
                </button>
            `;
            container.appendChild(newField);
        }

        if (e.target.closest('.remove-number-btn')) {
            e.target.closest('.phone-number-field').remove();
        }
    });

    // Optional: validate numbers (10 digits or +91)
    const form = document.getElementById('addLeadForm');
    form.addEventListener('submit', function(e) {
        let hasError = false;
        form.querySelectorAll('input[name="mobile_numbers[]"]').forEach(input => {
            const val = input.value.trim();
            if (!/^(\+91)?\d{10}$/.test(val)) {
                hasError = true;
                input.classList.add('is-invalid');
            } else {
                input.classList.remove('is-invalid');
            }
        });
        if (hasError) {
            e.preventDefault();
            alert("❌ Enter valid mobile numbers (10 digits or +91XXXXXXXXXX).");
        }
    });
});
</script>

<style>
.is-invalid { border-color: #dc3545 !important; }
</style>



    <!-- ✅ Desktop View (Table) -->

    <div class="col-12 d-none d-md-block">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th><input type="checkbox" id="select_all"></th>
                        <th>Name</th>
                        <th>Mobile</th>
                        <th>Address</th>
                        <th>Assigned To</th>
                        <th>Course</th>
                        <th>Status</th>
                        <th>Last Call</th>
                        <th>Next Followup</th>
                        <th>Date Created</th>
                        <th>Remark</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($result as $row){  
                    if($row->mobile_no){ 
                        $assign_to=get_row('users',' where id='.$row->assign_to);
                        $last_call=get_row('lead_status_log',' where lead_id='.$row->id.' order by id desc');
                        $status=get_row('master_table',' where id='.$row->status_id);
                ?>
                    <tr>
                        <td><input type="checkbox" class="lead_ids" value="<?php echo $row->id; ?>"></td>
                        <td><?php echo ucwords($row->contact_name); ?></td>
                        <td><a href="tel:<?php echo $row->mobile_no; ?>"><?php echo $row->mobile_no; ?></a></td>
                        <td><?php echo $row->address; ?></td>
                        <td><?php echo ucwords($assign_to->name); ?></td>
                        <td><?php echo $row->description; ?></td>
                        <td><?php echo ($row->status_id==0) ? '<span class="badge bg-success">Fresh Lead</span>' : '<span class="badge bg-info">'.$status->name.'</span>'; ?></td>
                        <td><?php echo date("d-M-Y h:i a",strtotime($last_call->created_at)); ?></td>
                        <td><?php if($row->next_followup!="0000-00-00 00:00:00"){ echo date("d-M-Y h:i a",strtotime($row->next_followup)); } ?></td>
                        <td><?php echo date("d-M-Y h:i a",strtotime($row->created_at)); ?></td>
                        <td><?php echo $last_call->remark; ?></td>
                        <td>
<!-- Delete Button -->
<?php if ($logged_in_user->parent_id == 1 || in_array('3', $access_array)): ?>
   <a href="<?= base_url('Leads/delete/'.$row->id) ?>" class="badge bg-danger" onclick="return confirm('Are you sure you want to delete this record?');">
    <i class="fas fa-trash"></i>
</a>
<?php endif; ?>
                          <span onclick="window.location.href='<?php echo base_url(); ?>Leads/lead_details/<?php echo $row->id; ?>'" class="badge bg-primary"><i class="fas fa-eye"></i></span>
                        </td>
                    </tr>
                <?php } } ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

				</div>
			</div>

		</div>

<script>
    // Select All functionality
    document.getElementById('select_all').addEventListener('change', function () {
        let checkboxes = document.querySelectorAll('.lead_ids');
        checkboxes.forEach(cb => cb.checked = this.checked);
    });
</script>
<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Confirm Delete</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this record?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete</button>
      </div>
    </div>
  </div>
</div>


		
		<?php //$this->load->view('Template/settings',$data); ?>
		<?php $this->load->view('Template/footer',$data); ?>
		<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
		<script>
			var start=10;
			$(document).ready(function() {
			  
				$(window).scroll(function() {
				      
					if($(window).scrollTop() + $(window).height()<= $(document).height()) {
					   
						var assign_to=$("#assign_to").val();
						var status=$("#status").val();
						$.ajax({
							url:"<?php echo base_url(); ?>Leads/list_autoload",
							type: "POST",
							data:{start: start,assign_to:assign_to,status:status},
							success:function(data)
							{
                                  
								$("#list").append(data);
								start=parseInt(start+50);
							}
						});
					}
				});
			});


			function assign_to()
			{
				$("#assignLeadModal").modal('show');
				
			}
	function feedback_form(lead_id, mobile_no, contact_name) {
    // Set hidden input
    $("#lead_id").val(lead_id);

    // Set modal fields
    $("#lead_mobile").text(mobile_no);
    $("#lead_company").text(contact_name);

    // Update modal header with blue tick + number and name
    $("#lead_info").html(`<i class="bi bi-check-circle-fill text-primary"></i> ${mobile_no} - ${contact_name}`);

    // Show modal
    $("#feedbackForm").modal('show');
}

			function filter_by()
			{
				var assign_to=$("#assign_to").val();
				var status=$("#status").val();
				window.location.href="<?php echo base_url(); ?>Leads/list/?assign_to="+assign_to+"&status="+status;
			}
			function upload_csv()
			{
				$("#uploadCsvModal").modal('show');
			}
			function leadsAssign()
			{
				$("#leads_assign_error").hide();
				var leads_assign_to=$("#leads_assign_to").val();
					if(leads_assign_to)
					{
					var lead_ids="";
					$(".lead_ids").each(function() {
						if ($(this).prop('checked')) {
						    var value=$(this).val();
						    lead_ids=lead_ids+value+",";
						}
					   
					});
					if(lead_ids)
					{
						$("#submit_leads_assign").hide();
						$("#loader_leads_assign").show();
                           $.ajax({
							url:"<?php echo base_url(); ?>Leads/leadsAssign",
							type: "POST",
							data:{lead_ids: lead_ids,assign_to:leads_assign_to},
							success:function(data)
							{

								window.location.reload();
							}
						});
					}
					else
					{
						$("#leads_assign_error").show();
					    $("#leads_assign_error").html('First select atleast one lead!');
					}
				}
				else
				{
					$("#leads_assign_error").show();
					$("#leads_assign_error").html('First select any employee name!');
				}
			}
	 // Store the URL dynamically



		</script>
		<!-- Modal -->
		<div class="modal fade" id="feedbackForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" >
				<div class="modal-content ">
					<form action="<?php echo base_url(); ?>Leads/feedbackForm" method="post">
						<input type="hidden" name="lead_id" id="lead_id">
			<div class="modal-header">
    <h5 class="modal-title" id="modal_title">
       
        <span id="lead_info"></span> <!-- dynamically updated -->
    </h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

						<?php 
// Get logged-in user info
$user = $this->session->userdata('user_info');
$user_id = $user->id;
$role_id = $user->role;

// Default parent id
$parent_id = $user_id;

// If role is not 1 or 2 → use their parent_id from users table
if(!in_array($role_id, [1,2])){
    $userRow = $this->db->select('parent_id')
                        ->from('users')
                        ->where('id', $user_id)
                        ->get()
                        ->row();
    if($userRow){
        $parent_id = $userRow->parent_id;
    }
}
?>


<div class="modal-body">
    <div class="mb-3">
        <label class="form-label fw-bold">Priority</label>
        <select class="form-select" name="priority_id" required>
            <option value="">-- Select Priority --</option>
            <?php 
            $result = get_all_list('master_table', " WHERE type='priority' AND parent_id = $parent_id"); 
            foreach($result as $row){ ?>
                <option value="<?php echo $row->id; ?>"><?php echo $row->name; ?></option>
            <?php } ?>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label fw-bold">Status</label>
        <select class="form-select" name="status_id" required>
            <option value="">-- Select Status --</option>
            <?php 
            $result = get_all_list('master_table', " WHERE type='status' AND parent_id = $parent_id"); 
            foreach($result as $row){ ?>
                <option value="<?php echo $row->id; ?>"><?php echo $row->name; ?></option>
            <?php } ?>
        </select>
    </div>

  <div class="mb-3">
    <label class="form-label fw-bold">Next Meeting Date & Time</label>
    <input  type="datetime-local"   name="next_followup" class="form-control" placeholder="Select date and time">
</div>

    <div class="mb-3">
        <label class="form-label fw-bold">Remark</label>
        <textarea class="form-control" name="remark" placeholder="Enter remark" rows="3"></textarea>
    </div>
</div>

<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary">Submit</button>
</div>


<script>
flatpickr("#nextFollowup", {
    enableTime: true,            // allow time selection
    dateFormat: "Y-m-d H:i",     // format: 2025-09-24 14:30
    minDate: "today",            // can't select past dates
    time_24hr: true,             // 24-hour time format
    weekNumbers: true,           // show week numbers
    allowInput: true,            // allow typing manually
    defaultHour: 9,              // default time
    defaultMinute: 0,
    wrap: false,
    onReady: function(selectedDates, dateStr, instance) {
        instance.calendarContainer.style.zIndex = 9999; // ensure it's above modal
    }
});
</script>


						
					</form>
				</div>
			</div>
		</div>

<style>
    .modal {
    z-index: 10000 !important;
}

.modal-backdrop {
    z-index: 1900 !important;
}

/* Keep floating buttons below modal */
.floating-btn, 
#pendingFollowupBtn, 
#dialerBtn {
    z-index: 1800 !important;
}
    /* Optional custom styling for modern look */
    .modal-body .form-label {
        font-size: 0.95rem;
        color: #495057;
    }

    .modal-body .form-control,
    .modal-body .form-select {
        border-radius: 8px;
        padding: 10px 12px;
        box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);
        transition: 0.3s;
    }

    .modal-body .form-control:focus,
    .modal-body .form-select:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.2rem rgba(13,110,253,0.25);
    }

    .modal-body textarea.form-control {
        resize: none;
    }
</style>
		<!-- Modal -->
		<div class="modal fade" id="assignLeadModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<form action="<?php echo base_url(); ?>Leads/assin_to" method="post">
						<input type="hidden" name="leadid" id="leadid">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Assign Leads</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							<div style="display:none;" id="leads_assign_error" class="alert alert-danger" role="alert"></div>
							<div class="input-block mb-3 form-focus select-focus">
								<?php 
$result = get_all_list('users', ' WHERE parent_id = ' . $logged_in_user_id); 
?>
								<select  id="leads_assign_to" class="select floating">
									<option value="" >--Select Employee Name--</option>
									<?php foreach($result as $row){ ?>
									<option value="<?php echo $row->id; ?>"><?php echo $row->name; ?></option>
								<?php } ?>
								</select>
								<label class="focus-label">Assign Leads   </label>
							</div>
							
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
							<button style="display:none;" id="loader_leads_assign" type="button" class="btn btn-warning btn-sm"><i class="fas fa-spinner fa-spin me-2"></i>Loading...</button>
							<button id="submit_leads_assign" onclick="leadsAssign()" type="button" class="btn btn-primary">Submit</button>
						</div>
					</form>		
				</div>
			</div>
		</div>


		<!-- Modal -->
	
<div id="uploadCsvModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="<?php echo base_url(); ?>Leads/upload_csv" method="post" enctype="multipart/form-data">    
                <div class="modal-header">
                    <h4 class="modal-title" id="standard-modalLabel">Upload CSV (LEADS)</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="field-1" class="form-label">Select CSV File</label>
                                <input type="file" class="form-control" name="file" required >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Floating Fresh Leads Button -->
<!-- Floating Fresh Leads Button -->

<script>
let deleteUrl = null;

// Called when delete button is clicked
function delete_data(id) {
    console.log("Deleting ID:", id);

    // Build delete URL
    deleteUrl = "<?= base_url('Leads/delete/'); ?>" + id;

    // Always open modal correctly with Bootstrap 5
    const modalElement = document.getElementById("deleteConfirmModal");
    const modal = bootstrap.Modal.getOrCreateInstance(modalElement);
    modal.show();
}

// Confirm delete action
document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("confirmDeleteBtn").addEventListener("click", function () {
        if (deleteUrl) {
            window.location.href = deleteUrl; // Go to delete controller
        }
    });
});
function delete_selected() {
    let lead_ids = [];

    // Collect all checked rows
    document.querySelectorAll(".lead_ids:checked").forEach(cb => {
        lead_ids.push(cb.value);
    });

    if (lead_ids.length === 0) {
        alert("⚠️ Please select at least one row to delete.");
        return;
    }

    // Confirm before delete
    if (!confirm("Are you sure you want to delete the selected leads?")) {
        return;
    }

    // Send Ajax request
    $.ajax({
        url: "<?= base_url('Leads/delete_multiple') ?>",
        type: "POST",
        data: { ids: lead_ids },
        success: function (response) {
            alert("✅ Selected leads deleted successfully!");
            location.reload(); // Refresh page
        },
        error: function () {
            alert("❌ Something went wrong while deleting.");
        }
    });
}
$(document).ready(function() {
    $("#freshLeadsBtn").on("click", function() {
        // Filter table rows
        $("table tbody tr").each(function() {
            const statusText = $(this).find("td:nth-child(7)").text().trim();
            if(statusText.includes("Fresh Lead")) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });

        // Filter mobile cards
        $("#list-mobile li").each(function() {
            const badgeText = $(this).find("span.badge").text().trim();
            if(badgeText.includes("Fresh Lead")) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });
});

// Show only Fresh Leads
$("#freshLeadsBtn").click(function(){
    $(".lead-row").show().filter(function(){
        return $(this).data("status") !== "Fresh";
    }).hide();
});

// Show only Followup Leads
$("#followupLeadsBtn").click(function(){
    $(".lead-row").show().filter(function(){
        return $(this).data("status") !== "Followup";
    }).hide();
});
</script>


<!-- <script>
$(document).ready(function() {
    $("#lead_search").on("keyup", function() {
        var value = $(this).val().toLowerCase();

        // ✅ Desktop Table
        $("table tbody tr").filter(function() {
            $(this).toggle(
                $(this).text().toLowerCase().indexOf(value) > -1
            );
        });

        // ✅ Mobile Cards
        $("#list-mobile li").filter(function() {
            $(this).toggle(
                $(this).text().toLowerCase().indexOf(value) > -1
            );
        });
    });
});
</script> -->


	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	
			<!-- Modal -->
		<!-- Delete Confirmation Modal -->
<!-- Delete Confirmation Modal -->
<!-- Delete Confirmation Modal -->





		<style>
			.counter-box{ width:50%; }
			.employee-notification-content{width:100%!important;}
			.pull-right{ float:right; margin-left:5px; }
			.full-width{ width:100%; }
			.small{ font-size:10px; margin-left:10px;  }
			
		</style>
        <a href="javascript:void(0);" id="freshLeadsBtn" class="floating-btn-fresh" title="Show Fresh Leads">

    <span class="btn-text">Fresh</span>
</a>

<style>
.floating-btn-fresh {
    position: fixed;
    bottom: 90px; /* above your existing add button */
    right: 20px;
    background: #55ce63;
    color: #fff;
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    flex-direction: column; /* icon above text */
    justify-content: center;
    align-items: center;
    font-size: 12px; /* small text */
    box-shadow: 0 4px 6px rgba(0,0,0,0.2);
    z-index: 9999;
    cursor: pointer;
    text-align: center;
}

.floating-btn-fresh:hover {
    background: #55ce63;
    color: #fff;
    text-decoration: none;
}
.employee-notification-grid{
        box-shadow: 0 4px 24px 0 rgba(88, 74, 74, 0.25)!important;
}
.floating-btn-fresh .btn-text {
    font-size: 10px; /* smaller text */
    margin-top: 2px;  /* space between icon and text */
    line-height: 1;
}
</style>

<!-- Floating Followup Leads Button -->
<a href="javascript:void(0);" id="followupLeadsBtn" class="floating-btn-followup" title="Show Followup Leads">
 
    <span class="btn-text">Followup</span>
</a>

<style>
.floating-btn-followup {
    position: fixed;
    bottom: 160px; /* above the Fresh Leads button */
    right: 20px;
    background: #007bff; /* blue */
    color: #fff;
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    flex-direction: column; /* icon above text */
    justify-content: center;
    align-items: center;
    font-size: 12px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.2);
    z-index: 9999;
    cursor: pointer;
    text-align: center;
}

.floating-btn-followup:hover {
    background: #0056b3;
    color: #fff;
    text-decoration: none;
}

.floating-btn-followup .btn-text {
    font-size: 10px;
    margin-top: 2px;
    line-height: 1;
}
</style>

<script>
$(document).ready(function() {
    $("#followupLeadsBtn").on("click", function() {
        // ✅ Desktop Table
        $("table tbody tr").filter(function() {
            var nextFollowup = $(this).find("td:nth-child(9)").text().trim();
            $(this).toggle(nextFollowup !== "");
        });

        // ✅ Mobile Cards
        $("#list-mobile li").filter(function() {
            var nextFollowup = $(this).find("span:contains('Next Followup')").text().trim();
            $(this).toggle(nextFollowup.indexOf("Next Followup:") !== -1 && nextFollowup.replace("Next Followup:","").trim() !== "");
        });
    });
});
</script>

	</body>


	</html>