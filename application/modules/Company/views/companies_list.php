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

                <?php $this->load->view('Template/page_header',$data); ?>

                <div class="row">
                    <div class="col-md-12">

                        <!-- Page Title + Add Button -->
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="mb-0">Company Management</h4>
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCompanyModal">
                                <i class="fas fa-plus"></i> Add Company
                            </button>
                        </div>

                        <!-- Success message -->
                        <?php if($this->session->flashdata('success')): ?>
                            <div class="alert alert-success"><?= $this->session->flashdata('success'); ?></div>
                        <?php endif; ?>

                        <!-- Company Table -->
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead class="table-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>Company Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th>Tenure</th>
                                        <th>Expiry Date</th>
                                        <!-- <th>Status</th> -->
                                        <th>Created</th>
                                        <th>Updated</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1; foreach($companies as $comp): ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= $comp['company_name']; ?></td>
                                        <td><?= $comp['email']; ?></td>
                                        <td><?= $comp['phone']; ?></td>
                                        <td><?= $comp['address']; ?></td>
                                        <td><?= $comp['tenure']; ?> Months</td>
                                        <td><?= $comp['expiry_date']; ?></td>
                                    <!--     <td>
                                            <?php if($comp['status']==1): ?>
                                                <span class="badge bg-success">Active</span>
                                            <?php else: ?>
                                                <span class="badge bg-danger">Inactive</span>
                                            <?php endif; ?>
                                        </td> -->
                                        <td><?= $comp['created_at']; ?></td>
                                        <td><?= $comp['updated_at']; ?></td>
                                        <td>
                                            <button style="color: black;" class="btn btn-sm btn-warning" 
                                                onclick="editCompany(<?= $comp['id']; ?>)">
                                                <i class="fas fa-edit"></i> Edit
                                            </button>
                                            <a style="color: white;" href="<?= base_url('company/delete_company/'.$comp['id']); ?>" 
                                                class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this company?')">
                                                <i class="fas fa-trash"></i> Delete
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                    <?php if(empty($companies)): ?>
                                    <tr>
                                        <td colspan="11" class="text-center">No companies found</td>
                                    </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

            </div>
            <?php $this->load->view('Template/footer',$data); ?>
        </div>
    </div>
</div>

<!-- Add Company Modal -->
<div class="modal fade" id="addCompanyModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?= base_url('company/add_company'); ?>" method="post">
                <div class="modal-header">
                    <h5 class="modal-title">Add Company</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Company Name</label>
                        <input type="text" name="company_name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Phone</label>
                        <input type="text" name="phone" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Address</label>
                        <textarea name="address" class="form-control"></textarea>
                    </div>
                    <div class="mb-3">
                        <label>Tenure</label>
                        <select name="tenure" class="form-control" required>
                            <option value="3">3 Months</option>
                            <option value="6">6 Months</option>
                            <option value="12">1 Year</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Company</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Company Modal -->
<div class="modal fade" id="editCompanyModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?= base_url('company/update_company'); ?>" method="post">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Company</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="edit_id">
                    <div class="mb-3">
                        <label>Company Name</label>
                        <input type="text" name="company_name" id="edit_company_name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" id="edit_email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Phone</label>
                        <input type="text" name="phone" id="edit_phone" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Address</label>
                        <textarea name="address" id="edit_address" class="form-control"></textarea>
                    </div>
                    <div class="mb-3">
                        <label>Tenure</label>
                        <select name="tenure" id="edit_tenure" class="form-control" required>
                            <option value="3">3 Months</option>
                            <option value="6">6 Months</option>
                            <option value="12">1 Year</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Update Company</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- JS for Edit -->
<script>
function editCompany(id) {
    fetch("<?= base_url('company/get_company/'); ?>" + id)
    .then(res => res.json())
    .then(data => {
        document.getElementById('edit_id').value = data.id;
        document.getElementById('edit_company_name').value = data.company_name;
        document.getElementById('edit_email').value = data.email;
        document.getElementById('edit_phone').value = data.phone;
        document.getElementById('edit_address').value = data.address;
        document.getElementById('edit_tenure').value = data.tenure;
        var modal = new bootstrap.Modal(document.getElementById('editCompanyModal'));
        modal.show();
    });
}
</script>

</body>
</html>
