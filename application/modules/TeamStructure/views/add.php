<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">
<?php $this->load->view('Template/head',$data); ?>

<body>
<?php  
    $date  = date("Y-m-d");
    $date2 = date('Y-m-d', strtotime($date.' + 1 day')); 
?>
<div class="main-wrapper">
    <div class="header">
        <?php $this->load->view('Template/header',$data); ?>
        <div class="page-wrapper">
            <div class="content container-fluid pb-0">

                <?php 
                $data2['url']="TeamStructure/list/".$role->id; 
                $data2['list']=1;  
                $this->load->view('Template/page_header',$data2); 
                ?>

                <?php if($this->session->flashdata('success')){ ?>
                    <div class="alert alert-success alert-dismissible fade show shadow-sm">
                        <?php echo $this->session->flashdata('success');  
                              $this->session->set_flashdata('success',''); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php } ?>

                <div class="row justify-content-center">
                    <div class="col-lg-10 col-md-12">
                        <div class="card shadow-lg border-0 rounded-3">
                            <div class="card-header bg-primary text-white text-center py-3">
                                <h4 style="color:white;" class="mb-0">User Registration / Update</h4>
                            </div>
                            <div class="card-body p-4">
                                <form method="post" enctype="multipart/form-data" autocomplete="off">

                                    <!-- Row 1 -->
                                    <div class="row g-3">
                                        <div class="col-md-4">
                                            <label class="form-label">First Name <span class="text-danger">*</span></label>
                                            <input value="<?php echo $data->first_name; ?>" type="text" class="form-control" name="first_name" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Last Name</label>
                                            <input value="<?php echo $data->last_name; ?>" type="text" class="form-control" name="last_name" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Mobile No. <span class="text-danger">*</span></label>
                                            <input value="<?php echo $data->mobile_no; ?>" type="text" class="form-control" name="mobile_no" required>
                                        </div>
                                    </div>

                                    <!-- Row 2 -->
                                    <div class="row g-3 mt-2">
                                        <div class="col-md-6">
                                            <label class="form-label">Email <span class="text-danger">*</span></label>
                                            <input value="<?php echo $data->email; ?>" type="email" class="form-control" name="email" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Branch <span class="text-danger">*</span></label>
                                            <?php $result=get_all_list('master_table',' where type="branch"'); ?>
                                            <select class="form-select" name="branch" required>
                                                <option value="">--Select Branch---</option>
                                                <?php foreach($result as $row){ ?>
                                                    <option <?php if($data->branch==$row->id){ echo "selected"; }?> 
                                                            value="<?php echo $row->id; ?>">
                                                            <?php echo $row->name; ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Row 3 -->
                                    <div class="row g-3 mt-2">
                                        <div class="col-md-6">
                                            <label class="form-label">Password<?php if(!$data) echo '<span class="text-danger">*</span>'; ?></label>
                                            <input type="password" class="form-control" name="password" 
                                                   <?php if(!$data) echo 'required'; ?> placeholder="Enter password">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Confirm Password<?php if(!$data) echo '<span class="text-danger">*</span>'; ?></label>
                                            <input type="password" class="form-control" name="confirm_password" 
                                                   <?php if(!$data) echo 'required'; ?> placeholder="Confirm password">
                                        </div>
                                    </div>

                                    <!-- Row 4 -->
                                    <div class="row g-3 mt-2">
                                        <div class="col-md-6">
                                            <label class="form-label">Father's Full Name</label>
                                            <input value="<?php echo $data->father_name; ?>" type="text" class="form-control" name="father_name" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Date Of Birth</label>
                                            <input value="<?php echo $data->dob; ?>" type="date" class="form-control" name="dob" required>
                                        </div>
                                    </div>

                                    <!-- Row 5 -->
                                    <div class="row g-3 mt-2">
                                        <div class="col-md-6">
                                            <label class="form-label d-block">Select Gender</label>
                                            <div class="form-check form-check-inline">
                                                <input <?php if($data){ if($data->gender=="male"){ echo "checked"; } }else{ echo "checked"; } ?> 
                                                       class="form-check-input" type="radio" name="gender" value="male">
                                                <label class="form-check-label">Male</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input <?php if($data->gender=="female"){ echo "checked"; } ?> 
                                                       class="form-check-input" type="radio" name="gender" value="female">
                                                <label class="form-check-label">Female</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Address</label>
                                            <textarea class="form-control" name="address" rows="2" required><?php echo $data->address; ?></textarea>
                                        </div>
                                    </div>

                                    <!-- Submit -->
                                    <div class="row mt-4">
                                        <div class="col-md-12 text-center">
                                            <button type="submit" class="btn btn-primary px-5 py-2 rounded-pill shadow-sm">
                                                <i class="fas fa-save me-2"></i> Submit
                                            </button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<?php $this->load->view('Template/footer',$data); ?>
</body>
</html>
