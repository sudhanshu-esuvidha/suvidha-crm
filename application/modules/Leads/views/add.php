<!doctype html>
<html  lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php $this->load->view('Template/style_include'); ?>
	<title><?php echo $title; ?></title>
</head>
<body>

	
	<!--wrapper-->
	<div class="wrapper">
		<!--sidebar wrapper -->
		<?php $this->load->view('Template/sidebar'); ?>
		<!--end sidebar wrapper -->
		<!--start header -->
		<?php  $this->load->view('Template/header');  ?>
		
		<!--end header -->
		<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Add New Lead </div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin/dashboard"><i class="bx bx-home-alt"></i></a>
								</li>
								<!-- <li class="breadcrumb-item active" aria-current="page"><?php echo ucfirst($this->uri->segment(3)); ?></li> -->
							</ol>
						</nav>
					</div>
					<div class="ms-auto">
						<button title="all list" onclick="window.location.href='<?php echo base_url(); ?>Leads/list'" type="button" class="btn btn-success px-5"><i class="fadeIn animated bx bx-list-ol"></i>All List</button>
						
					</div>
				</div>
				<!--end breadcrumb-->
				<hr/>
				<form method="post" enctype="multipart/form-data">
					<div class="card">
						<div class="card-header">
							<div class="d-flex align-items-center">
								<div>
									<h6 class="mb-0">Contact Details</h6>
								</div>
								
							</div>
						</div>
						<div class="card-body">

							<div class="form-group row mb-3">
								<div class="col-md-8">
									<input placeholder="Contact Name" value="<?php echo $data->contact_name; ?>"  type="text" class="form-control" name="contact_name" required >
								</div>
							</div>
							<div class="form-group row mb-3">
								
								<div class="col-md-8">
									<input placeholder="Mobile No." value="<?php echo $data->mobile_no; ?>"  type="text" class="form-control" name="mobile_no" required >
								</div>
							</div>
							<div class="form-group row mb-3">
								
								<div class="col-md-8">
									<input placeholder="Email" value="<?php echo $data->email; ?>"  type="text" class="form-control" name="email"  >
								</div>
							</div>
							

						</div>
					</div>

					<div class="card">
						<div class="card-header">
							<div class="d-flex align-items-center">
								<div>
									<h6 class="mb-0">Company Other Details</h6>
								</div>
								
							</div>
						</div>
						<div class="card-body">

							<div class="form-group row mb-3">
								<div class="col-md-8">
									<input placeholder="Owner Name" value="<?php echo $data->owner_name; ?>"  type="text" class="form-control" name="owner_name" required >
								</div>
							</div>
							<div class="form-group row mb-3">
								
								<div class="col-md-8">
									<select class="form-control" name="branch_id">
										<option value="">--select branch--</option>
										<?php $result=get_all_list('master_table',' where type="branch"'); ?>
										<?php foreach($result as $row){ ?>
                                        <option value="<?php echo $row->id; ?>"><?php echo $row->name; ?></option>
										<?php } ?>
										
									</select>
								</div>
							</div>
							<div class="form-group row mb-3">
								
								<div class="col-md-8">
									<select class="form-control" name="source_id">
										<option value="">--select source--</option>
										<?php $result=get_all_list('master_table',' where type="source"'); ?>
										<?php foreach($result as $row){ ?>
                                        <option value="<?php echo $row->id; ?>"><?php echo $row->name; ?></option>
										<?php } ?>
										
									</select>
								</div>
							</div>

                            <div class="form-group row mb-3">
								
								<div class="col-md-8">
									<select class="form-control" name="priority_id">
										<option value="">--select priority--</option>
										<?php $result=get_all_list('master_table',' where type="priority"'); ?>
										<?php foreach($result as $row){ ?>
                                        <option value="<?php echo $row->id; ?>"><?php echo $row->name; ?></option>
										<?php } ?>
										
									</select>
								</div>
							</div>
							<div class="form-group row mb-3">
								
								<div class="col-md-8">
									<select class="form-control" name="status_id">
										<option value="">--select status--</option>
										<?php $result=get_all_list('master_table',' where type="status"'); ?>
										<?php foreach($result as $row){ ?>
                                        <option value="<?php echo $row->id; ?>"><?php echo $row->name; ?></option>
										<?php } ?>
										
									</select>
								</div>
							</div>
                            <div class="form-group row mb-3">
								
								<div class="col-md-8">
									<input placeholder="Next Meeting Date Time" type="datetime-local" name="next_followup" class="form-control">
								</div>

							</div>							

                            <div class="form-group row mb-3">
								
								<div class="col-md-8">
									<textarea placeholder="Remark" class="form-control" name="remark"></textarea>
								</div>

							</div>
							<div class="form-group row mb-3">
								
								<div class="col-md-8">
									<input placeholder="Reference" type="text" name="refrence" class="form-control">
								</div>

							</div>							

                            <div class="form-group row mb-3">
								
								<div class="col-md-8">
									<textarea placeholder="Description" class="form-control" name="description"></textarea>
								</div>

							</div>							

						</div>
					</div>
                    <div class="card">
						<div class="card-header">
							<div class="d-flex align-items-center">
								<div>
									<h6 class="mb-0">Company Dynamic Questions</h6>
								</div>
								
							</div>
						</div>
						<div class="card-body">
<div class="form-group row mb-3">
								
								<div class="col-md-8">
								    <label>Assign To </label>
									<select required class="form-control" name="assign_to">
										
										<?php $result=get_all_list('users'); ?>
										<?php foreach($result as $row){ ?>
                                        <option <?php if($user->id==$row->id){ echo "selected";} ?>  value="<?php echo $row->id; ?>"><?php echo $row->name; ?></option>
										<?php } ?>
										
									</select>
								</div>
							</div>
							
							<div class="form-group row mb-3">
								
								<div class="col-md-8">
									<select class="form-control" name="service_id">
										<option value="">--select service--</option>
										<?php $result=get_all_list('master_table',' where type="service"'); ?>
										<?php foreach($result as $row){ ?>
                                        <option value="<?php echo $row->id; ?>"><?php echo $row->name; ?></option>
										<?php } ?>
										
									</select>
								</div>
							</div>
							
							<div class="form-group row mb-3">
								
								<div class="col-md-8">
									<input placeholder="Company Name" type="text" name="company_name" class="form-control">
								</div>

							</div>							

                            <div class="form-group row mb-3">
								
								<div class="col-md-8">
									<textarea placeholder="Company Address" class="form-control" name="address"></textarea>
								</div>

							</div>	

							<div class="form-group row mb-3">
								
								<div class="col-md-8">
									<input placeholder="Business Category" type="text" name="business_category" class="form-control">
								</div>

							</div>						

						</div>
					</div>
					<div class="card">
						<div class="card-body text-center">
							<button type="submit" class="btn  btn-primary">Add Lead</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		<!--end page wrapper -->
		<!--start overlay-->
		<div class="overlay toggle-icon"></div>
		<!--end overlay-->
		<!--Start Back To Top Button-->
		<a href="<?php echo base_url(); ?>javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
		<!--End Back To Top Button-->
		<footer class="page-footer">
			<p class="mb-0"></p>
		</footer>
	</div>
	<!--end wrapper-->


	<?php $this->load->view('Template/script_include'); ?>
	

	<!-- Place the first <script> tag in your HTML's <head> -->

	</body>



	</html>