<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">
<?php $this->load->view('Template/head',$data); ?>

<body>
<?php  
    $date = date("Y-m-d");
    $date2 = date('Y-m-d', strtotime($date.' + 1 day')); 
?>
<div class="main-wrapper">
    <div class="header">
        <?php $this->load->view('Template/header',$data); ?>
        <div class="page-wrapper">
            <div class="content container-fluid pb-0">
                
                <?php 
                $data['url']="TeamStructure/add/".$role->id; 
                $data['add']=1;  
                $this->load->view('Template/page_header',$data); 
                ?>

                <?php if($this->session->flashdata('success')){ ?>
                    <div class="col-md-12">
                        <div class="alert alert-solid-success alert-dismissible fade show">
                            <?php echo $this->session->flashdata('success');  
                            $this->session->set_flashdata('success',''); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                <i class="fas fa-xmark"></i>
                            </button>
                        </div>
                    </div>
                <?php } ?>

                <div class="row">

                    <!-- ✅ Desktop View (Table/List) -->
                    <div class="col-12 d-none d-md-block">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>Branch</th>
                                        <th>Assign To</th>
                                        <th>Access</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php if($result){ foreach($result as $row){ 
                                    $user_details = get_row('user_details',' where user_id='.$row->id);
                                    $branch = get_row('master_table',' where id='.$user_details->branch);
                                    $parent = get_row('users',' where id='.$user_details->parent_id);
                                ?>
                                    <tr>
                                        <td><?php echo $row->name; ?></td>
                                        <td><?php echo $user_details->email; ?></td>
                                        <td><?php echo $user_details->mobile_no; ?></td>
                                        <td><?php echo $branch->name; ?></td>
                                        <td><?php echo $parent->name; ?></td>
                                        <td>
                                            <?php 
                                                $access = $row->access ? explode(',', $row->access) : [];
                                                echo $access ? implode(', ', $access) : '-';
                                            ?>
                                        </td>
                                        <td><?php echo date("d-m-Y",strtotime($row->created_at)); ?></td>
                                      <td>
                                        <!-- Edit Button -->
                                        <a class="btn btn-sm btn-primary" 
                                           href="<?= base_url('TeamStructure/add/'.$row->role.'/'.$row->id) ?>" 
                                           title="Edit">
                                            <i class="fa fa-edit"></i>
                                        </a>

                                        <!-- Rights Button -->
                                        <button type="button" 
                                                class="btn btn-sm btn-primary" 
                                                title="Assign Rights" 
                                                onclick="rights_modal(<?= $row->id ?>, '<?= $row->name ?>')">
                                            <i class="fa fa-check"></i>
                                        </button>

                                        <!-- Delete Button -->
                                        <a class="btn btn-sm btn-primary" 
                                           href="<?php echo base_url(); ?>TeamStructure/delete_user/<?php echo $row->id; ?>/<?php echo $role->id; ?>" 
                                           onclick="return confirm('Are you sure you want to delete this user?');">
                                           <i class=" text-white fa fa-trash"></i>
                                        </a>
                                    </td>

                                    </tr>
                                <?php } } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- ✅ Mobile View (Cards) -->
                    <div class="col-12 d-block d-md-none">
                        <div class="row row-cols-1 g-3">
                            <?php if($result){ foreach($result as $row){ 
                                $user_details = get_row('user_details',' where user_id='.$row->id);
                                $branch = get_row('master_table',' where id='.$user_details->branch);
                                $parent = get_row('users',' where id='.$user_details->parent_id);
                                $access = $row->access ? explode(',', $row->access) : [];
                            ?>
                            <div class="col">
                                <div class="card radius-10 border-start border-0 border-4 border-info">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <h5 class="my-1 text-info"><?php echo $row->name; ?></h5>
                                                <p class="mb-0 small"><?php echo $user_details->email; ?></p>
                                                <p class="mb-0 small">
                                                    <?php echo $user_details->mobile_no; ?> | BRANCH: <?php echo $branch->name; ?>
                                                </p>
                                                <p class="mb-0 small">
                                                    ASSIGN TO: <?php echo $parent->name; ?> | 
                                                    ACCESS: <?php echo $access ? implode(', ', $access) : '-'; ?> | 
                                                    <?php echo date("d-m-Y",strtotime($row->created_at)); ?>
                                                </p>
                                            </div>
                                            <div class="widgets-icons-2 rounded-circle bg-gradient-blues text-white ms-auto">
                                                <div class="d-flex ms-auto gap-2">
                                                <a class="btn btn-sm btn-outline-primary" 
                                                   href="<?= base_url('TeamStructure/add/'.$row->role.'/'.$row->id) ?>" 
                                                   title="Edit">
                                                    <i class="fa fa-edit"></i>
                                                </a>

                                                <button type="button" 
                                                class="btn btn-sm btn-warning" 
                                                title="Assign Rights" 
                                                onclick="rights_modal(<?= $row->id ?>, '<?= $row->name ?>')">
                                                <i class="fa fa-shield-alt"></i>
                                                </button>

                                                <a class="btn btn-sm btn-danger" 
                                               href="<?php echo base_url(); ?>TeamStructure/delete_user/<?php echo $row->id; ?>/<?php echo $role->id; ?>" 
                                               onclick="return confirm('Are you sure you want to delete this user?');">
                                               <i class="fa fa-trash"></i>
                                            </a>

                                            </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } } ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

<!-- ===================== Rights Modal ===================== -->
<div class="modal fade" id="rights_modal" tabindex="-1" aria-labelledby="rightsLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content shadow-lg border-0 rounded-3">
      
      <!-- Header -->
      <div class="modal-header bg-gradient-info text-white">
        <h5 class="modal-title" id="rightsLabel">
          <i class="fa fa-user-shield"></i> Assign Rights to <span id="rightsUserName"></span>
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <!-- Form -->
      <form action="<?php echo base_url(); ?>TeamStructure/save_rights" method="post">
        <input type="hidden" name="user_id" id="rightsUserId">

        <div class="modal-body">
          
          <!-- Info Note -->
          <div class="alert alert-info small">
            <i class="fa fa-info-circle"></i> Select the rights you want to provide to this user.
          </div>

          <!-- ✅ Select All -->
          <div class="mb-3">
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" id="select_all" onclick="toggleAllRights(this)">
              <label class="form-check-label fw-bold text-primary" for="select_all">Select All Rights</label>
            </div>
          </div>

          <!-- ✅ Basic CRUD Rights -->
          <h6 class="fw-bold mt-3">General Rights</h6>
          <div class="row g-3 mb-3">
            <div class="col-md-3 col-6">
              <div class="form-check form-switch">
                <input class="form-check-input rights-checkbox" type="checkbox" name="rights[]" value="create" id="right_create">
                <label class="form-check-label" for="right_create">Create</label>
              </div>
            </div>
            <div class="col-md-3 col-6">
              <div class="form-check form-switch">
                <input class="form-check-input rights-checkbox" type="checkbox" name="rights[]" value="read" id="right_read">
                <label class="form-check-label" for="right_read">Read</label>
              </div>
            </div>
            <div class="col-md-3 col-6">
              <div class="form-check form-switch">
                <input class="form-check-input rights-checkbox" type="checkbox" name="rights[]" value="update" id="right_update">
                <label class="form-check-label" for="right_update">Update</label>
              </div>
            </div>
            <div class="col-md-3 col-6">
              <div class="form-check form-switch">
                <input class="form-check-input rights-checkbox" type="checkbox" name="rights[]" value="delete" id="right_delete">
                <label class="form-check-label" for="right_delete">Delete</label>
              </div>
            </div>
          </div>

          <!-- ✅ CRM Specific Rights -->
          <h6 class="fw-bold mt-3">CRM Module Rights</h6>
          <div class="row g-3 mb-3">
            <div class="col-md-4 col-6">
              <div class="form-check form-switch">
                <input class="form-check-input rights-checkbox" type="checkbox" name="rights[]" value="branches" id="right_branches">
                <label class="form-check-label" for="right_branches">Manage Branches</label>
              </div>
            </div>
            <div class="col-md-4 col-6">
              <div class="form-check form-switch">
                <input class="form-check-input rights-checkbox" type="checkbox" name="rights[]" value="leads" id="right_leads">
                <label class="form-check-label" for="right_leads">Manage Leads</label>
              </div>
            </div>
            <div class="col-md-4 col-6">
              <div class="form-check form-switch">
                <input class="form-check-input rights-checkbox" type="checkbox" name="rights[]" value="sources" id="right_sources">
                <label class="form-check-label" for="right_sources">Manage Sources</label>
              </div>
            </div>
            <div class="col-md-4 col-6">
              <div class="form-check form-switch">
                <input class="form-check-input rights-checkbox" type="checkbox" name="rights[]" value="status" id="right_status">
                <label class="form-check-label" for="right_status">Manage Status</label>
              </div>
            </div>
            <div class="col-md-4 col-6">
              <div class="form-check form-switch">
                <input class="form-check-input rights-checkbox" type="checkbox" name="rights[]" value="calling" id="right_calling">
                <label class="form-check-label" for="right_calling">Calling</label>
              </div>
            </div>
          </div>

          <!-- ✅ Extra Rights -->
          <h6 class="fw-bold mt-3">Extra Rights</h6>
          <div class="row g-3">
            <div class="col-md-4 col-6">
              <div class="form-check form-switch">
                <input class="form-check-input rights-checkbox" type="checkbox" name="rights[]" value="export" id="right_export">
                <label class="form-check-label" for="right_export">Export Data</label>
              </div>
            </div>
            <div class="col-md-4 col-6">
              <div class="form-check form-switch">
                <input class="form-check-input rights-checkbox" type="checkbox" name="rights[]" value="import" id="right_import">
                <label class="form-check-label" for="right_import">Import Data</label>
              </div>
            </div>
            <div class="col-md-4 col-6">
              <div class="form-check form-switch">
                <input class="form-check-input rights-checkbox" type="checkbox" name="rights[]" value="settings" id="right_settings">
                <label class="form-check-label" for="right_settings">Settings Access</label>
              </div>
            </div>
          </div>

        </div>

        <!-- Footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-success">
            <i class="fa fa-save"></i> Save Rights
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- ===================== JS ===================== -->


<?php $this->load->view('Template/footer',$data); ?>

<script>
    function add_modal(){
        $("#add_modal").modal('show');
    }
    function edit_modal(id,name){
        $("#leadid").val(id);
        $("#name").val(name);
        $("#add_modal").modal('show');
    }
</script>
<!-- ===================== JS ===================== -->
<script>
  // Open Rights Modal and load user's current rights
  function rights_modal(user_id, user_name) {
    $("#rightsUserId").val(user_id);
    $("#rightsUserName").text(user_name);

    // Uncheck all checkboxes first
    $(".rights-checkbox").prop('checked', false);
    $("#select_all").prop('checked', false);

    // Mapping numbers to rights IDs
    const accessMapping = {
      "1": "create",
      "2": "read",
      "3": "update",
      "4": "delete",
      "5": "branches",
      "6": "leads",
      "7": "sources",
      "8": "status",
      "9": "calling",
      "10": "export",
      "11": "import",
      "12": "settings"
    };

    // Fetch user rights via AJAX
    $.ajax({
        url: "<?php echo base_url('TeamStructure/get_user_access'); ?>",
        type: "POST",
        data: { user_id: user_id },
        dataType: "json",
        success: function(data) {
            if(data.access) {
                let rightsArray = data.access.split(',');
                rightsArray.forEach(function(num){
                    num = num.trim();
                    let right = accessMapping[num];
                    if(right){
                        $("#right_" + right).prop('checked', true);
                    }
                });

                // If all rights are checked, select "Select All"
                if($(".rights-checkbox").length === $(".rights-checkbox:checked").length){
                    $("#select_all").prop('checked', true);
                }
            }
        },
        error: function(err){
            console.log("AJAX error:", err);
        }
    });

    // Show modal
    $("#rights_modal").modal('show');
  }

  // Toggle all rights checkboxes
  function toggleAllRights(source) {
    $(".rights-checkbox").prop('checked', source.checked);
  }

  // Update "Select All" checkbox if any individual checkbox is toggled
  $(document).on('change', '.rights-checkbox', function() {
    let total = $(".rights-checkbox").length;
    let checked = $(".rights-checkbox:checked").length;
    $("#select_all").prop('checked', total === checked);
  });
</script>


<!-- Modal -->
<div class="modal fade" id="add_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?php echo base_url(); ?>Mastertable/add/<?php echo $type; ?>" method="post">
                <input type="hidden" name="leadid" id="leadid">
                <div class="modal-body">
                    <div style="display:none;" id="leads_assign_error" class="alert alert-danger" role="alert"></div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="field-3" class="form-label"><?php echo ucwords($type); ?> Name</label>
                                <input required type="text" class="form-control" id="name" name="name">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button  type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>     
        </div>
    </div>
</div>

</div>
</body>
</html>
