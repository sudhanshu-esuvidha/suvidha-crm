<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">
<?php $this->load->view('Template/head'); ?>

<body>
<div class="main-wrapper">
    <!-- Header -->
    <div class="header">
        <?php $this->load->view('Template/header'); ?>
    </div>

    <!-- Page Content -->
    <div class="page-wrapper">
    <div class="content container-fluid pb-0">

        <?php $this->load->view('Template/page_header', [
            'page_title' => 'Company Profile', 
            'url' => $url,
            'list' => $list,
            'add' => $add
        ]); ?>

        <div class="row">
            <div class="col-md-8 offset-md-2">

               
              
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4 text-center">Update Profile</h4>

                       <form action="<?= base_url('profile/update') ?>" method="post" enctype="multipart/form-data">

    <!-- Logo Preview at Top -->
    <?php if(!empty($company['logo']) && file_exists(FCPATH . $company['logo'])): ?>
        <div class="text-center mb-4">
            <img src="<?= base_url($company['logo']) ?>" 
                 alt="Company Logo" 
                 class="rounded-circle"
                 style="width:120px; height:120px; object-fit:cover; border:2px solid #ddd;">
        </div>
    <?php endif; ?>

    <div class="mb-3">
        <label>Company Name</label>
        <input type="text" name="company_name" class="form-control" 
               value="<?= set_value('company_name', $company['company_name'] ?? '') ?>" required>
    </div>

    <div class="mb-3">
        <label>Logo</label>
        <input type="file" name="logo" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">Update Profile</button>
</form>


                    </div>
                </div>

            </div>
        </div>

    </div>

    <?php $this->load->view('Template/footer'); ?>
</div>

</div>

</body>
</html>
