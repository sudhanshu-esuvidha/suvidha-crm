<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<!-- <link rel="icon" href="<?php echo base_url(); ?>assets/images/favicon-32x32.png" type="image/png" /> -->
	<!--plugins-->
	<link href="<?php echo base_url(); ?>assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
	<link href="<?php echo base_url(); ?>assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
	<link href="<?php echo base_url(); ?>assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
	<!-- loader-->
	<link href="<?php echo base_url(); ?>assets/css/pace.min.css" rel="stylesheet" />
	<script src="<?php echo base_url(); ?>assets/js/pace.min.js"></script>
	<!-- Bootstrap CSS -->
	<link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/css/bootstrap-extended.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/css/app.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/css/icons.css" rel="stylesheet">
	<title>Student Form</title>
</head>

<body class="">
	<?php //echo encrypt_decrypt('encrypt','supadmin'); ?>
	<!--wrapper-->
	<div class="wrapper" style="background-image: url(<?php echo base_url(); ?>assets/images/bgimg2.jpg);  background-repeat: repeat-y;">
		<div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
			<div class="container">
				<div class="row row-cols-1 row-cols-lg-2 " >
					<div class="col mx-auto">
						<div class="card mb-0">
							<div class="card-body" >
								<div class="p-4">
									<div class="mb-3 text-center">

										<img src="<?php echo base_url(); ?>assets/images/zplus-logo.jpg" style="width:275px; height: 60px;" alt="" /> 
										
									</div>
									<div class="text-center mb-4">
										<!-- <h5 class="">Login</h5> -->
										<p class="mb-0">Please fill your basic details</p>
									</div>
									<div class="form-body">
										<?php if($this->session->flashdata('error')){ ?>
											<div class="alert border-0 border-start border-5 border-danger alert-dismissible fade show py-2">
									
												<div class="">
													<h6 class="mb-0 text-danger"><?php echo $this->session->flashdata('error'); $this->session->set_flashdata('error',''); ?></h6>
												</div>
									        </div>
									
								   
										<?php } ?>
										<?php if($this->session->flashdata('success')){ ?>
											<div class="alert border-0 border-start border-5 border-success alert-dismissible fade show py-2">
									
												<div class="">
													<h6 class="mb-0 text-success"><?php echo $this->session->flashdata('success'); $this->session->set_flashdata('success',''); ?></h6>
												</div>
									        </div>
									
								   
										<?php } ?>
										<form class="row g-3" method="post">

											<div class="col-6">
												<label for="inputEmailAddress" class="form-label">Full Name *</label>
												<input required type="text" class="form-control" name="full_name" >
											</div>
											<div class="col-6">
												<label for="inputEmailAddress" class="form-label">Education Qualification *</label>
												<input required type="text" class="form-control" name="education_qualification" >
											</div>
											<div class="col-6">
												<label for="inputEmailAddress" class="form-label">Mobile (Primary) *</label>
												<input required type="text" class="form-control" name="mobile_primary" >
											</div>
											<div class="col-6">
												<label for="inputEmailAddress" class="form-label">Mobile (Alternate)</label>
												<input  type="text" class="form-control" name="mobile_alternate" >
											</div>
											<div class="col-12">
												<label for="inputEmailAddress" class="form-label">Address *</label>
												<input required type="text" class="form-control" name="address" >
											</div>
											
											<div class="col-6">
												<label for="inputEmailAddress" class="form-label">DOB *</label>
												<input required type="date" class="form-control" name="dob" >
											</div>
											<div class="col-12">
												<label for="inputChoosePassword" class="form-label"></label>
												<div class="input-group" id="show_hide_password">
													
												</div>
											</div>
											
											
											<div style="margin-top:0px;" class="col-12">
												<div class="d-grid">
													<button type="submit" class="btn btn-primary">Submit</button>
												</div>
											</div>
<div class="col-12">
												<div class="text-center ">
													<p class="mb-0">For more details  
													</p>
												
													
												</div>
											</div>
											<div class="col-6">
												<div class="text-center ">
													
													<p class="mb-0">  <a href="#"><img style="height: 60px;" class="img-fluid" src="<?php echo base_url(); ?>assets/images/playstore.png"></a>
													</p>
													
												</div>
											</div>
											<div class="col-6">
												<div class="text-center ">
													
													<p class="mb-0"><a href="#"><img  style="height: 60px;" class="img-fluid" src="<?php echo base_url(); ?>assets/images/website_button.png"></a>
													</p>
												</div>
											</div>
											
									</div></div>
											
											
										</form>
									</div>
									
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--end row-->
			</div>
		</div>
	</div>
	<!--end wrapper-->
	<!-- Bootstrap JS -->
	<script src="<?php echo base_url(); ?>assets/js/bootstrap.bundle.min.js"></script>
	<!--plugins-->
	<script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugins/simplebar/js/simplebar.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugins/metismenu/js/metisMenu.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
	<!--Password show & hide js -->
	<script>
		$(document).ready(function () {
			$("#show_hide_password a").on('click', function (event) {
				event.preventDefault();
				if ($('#show_hide_password input').attr("type") == "text") {
					$('#show_hide_password input').attr('type', 'password');
					$('#show_hide_password i').addClass("bx-hide");
					$('#show_hide_password i').removeClass("bx-show");
				} else if ($('#show_hide_password input').attr("type") == "password") {
					$('#show_hide_password input').attr('type', 'text');
					$('#show_hide_password i').removeClass("bx-hide");
					$('#show_hide_password i').addClass("bx-show");
				}
			});
		});
	</script>
	<!--app JS-->
	<script src="<?php echo base_url(); ?>assets/js/app.js"></script>
	<style>
		
	</style>
</body>



</html>