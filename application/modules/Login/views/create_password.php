

	<!doctype html>
	<html lang="en">

	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!--favicon-->
		<link rel="icon" href="<?php echo base_url(); ?>site_images/favicon.png" type="image/png" />
		<!--plugins-->
		<link href="<?php echo base_url(); ?>assets/backend/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
		<link href="<?php echo base_url(); ?>assets/backend/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
		<link href="<?php echo base_url(); ?>assets/backend/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
		<!-- loader-->
		<link href="<?php echo base_url(); ?>assets/backend/css/pace.min.css" rel="stylesheet" />
		<script src="<?php echo base_url(); ?>assets/backend/js/pace.min.js"></script>
		<!-- Bootstrap CSS -->
		<link href="<?php echo base_url(); ?>assets/backend/css/bootstrap.min.css" rel="stylesheet">
		<link href="<?php echo base_url(); ?>assets/backend/css/bootstrap-extended.css" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet">
		<link href="<?php echo base_url(); ?>assets/backend/css/app.css" rel="stylesheet">
		<link href="<?php echo base_url(); ?>assets/backend/css/icons.css" rel="stylesheet">
		<title>CRM LOGIN</title>
	</head>

	<body class="" style="background-color:#FFF; height: 100vh; ">
		<?php //echo encrypt_decrypt('encrypt','123456'); ?>
		<!--wrapper-->
		<div class="wrapper">
			<div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0" style="height:100vh" >
				<div class="container">
					
					<div style="margin-top: -100px;"  id="logindiv" class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
						<div class="col mx-auto">
							<div class="card mb-0">
								<div class="card-body" >
									<div class="p-4">
										<div class="mb-3 text-center">
											  <img src="<?php echo base_url(); ?>assets/backend/images/logo.png" style="width:100%;">
											
										</div>
										<div class="text-center mb-4">
											<h5 class="">Create Password</h5>
											<p class="mb-0"></p>
										</div>
										<div class="form-body">
												<?php if($this->session->flashdata('error')){ ?>
												<p style="color:red;"><?php echo $this->session->flashdata('error'); $this->session->set_flashdata('error',''); ?></p>
												<?php } ?><form class="row g-3" method="post">

												<div class="col-12">
													<label for="inputEmailAddress" class="form-label">New Password</label>
													<input required type="password" class="form-control" name="password" > 
												</div>
												<div class="col-12">
													<label for="inputChoosePassword" class="form-label">Confirm Password</label>
													<div class="input-group" id="show_hide_password">
														<input required type="password" class="form-control border-end-0" name="cpassword"  > 
													</div>
												</div>
												
												<div class="col-md-12 text-end">	<!--<a href="<?php echo base_url(); ?><?php echo base_url(); ?>forget_password">Forgot Password ?</a>-->
												</div>
												
												<div style="margin-top:0px;" class="col-12">
													<div class="d-grid">
														<button type="submit" class="btn btn-primary">Create Password</button>
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
					<!--end row-->
				</div>
			</div>
		</div>
		<!--end wrapper-->
		<!-- Bootstrap JS -->
		<script src="<?php echo base_url(); ?>assets/backend/js/bootstrap.bundle.min.js"></script>
		<!--plugins-->
		<script src="<?php echo base_url(); ?>assets/backend/js/jquery.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/backend/plugins/simplebar/js/simplebar.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/backend/plugins/metismenu/js/metisMenu.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/backend/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
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
		 $(document).on('click', '#refresh', function () {
	        $.post('<?php echo base_url(); ?>Login/refresh',{},function(data){
	            if(data){
	                $('#captchaimg').html(data);
	            }
	        });
	    });
	</script>
		<!--app JS-->
		<script src="<?php echo base_url(); ?>assets/backend/js/app.js"></script>
		
	</body>



	</html>