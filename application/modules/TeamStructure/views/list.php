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
                                        <td><?php echo date("d-m-Y",strtotime($row->created_at)); ?></td>
                                      <td>
    <!-- Edit Button -->
    <a class="btn btn-sm btn-primary" 
       href="<?= base_url('TeamStructure/add/'.$row->role.'/'.$row->id) ?>" 
       title="Edit">
        <i class="fa fa-edit"></i>
    </a>

    <!-- Delete Button -->
   <a class="btn btn-sm btn-danger" 
   href="<?php echo base_url(); ?>TeamStructure/delete_user/<?php echo $row->id; ?>/<?php echo $role->id; ?>" 
   onclick="return confirm('Are you sure you want to delete this user?');">
   <i class="fa fa-trash"></i>
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
