<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="author" content="">
	<title>Login</title>

	<link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">

	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">

	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/fontawesome/css/fontawesome.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/fontawesome/css/all.min.css">

	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/line-awesome.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/material.css">

	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/line-awesome.min.css">

	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
</head>
<body class="account-page">

	<div class="main-wrapper">
		<div class="account-content">
			<!-- <a href="job-list.html" class="btn btn-primary apply-btn">Apply Job</a> -->
			<div class="container">

				<div class="account-logo1">
					<a ><img src="<?php echo base_url(); ?>assets/img/logo.png" ></a>
				</div>

				<div class="account-box">
					<div class="account-wrapper" style="border: #011C55 solid 1px;">
						<h3 class="account-title">Forget Password</h3>
						<p class="account-subtitle">Please enter your registered email id</p>
                     <?php if($this->session->flashdata('error')){ ?>
												<p style="color:red;"><?php echo $this->session->flashdata('error'); $this->session->set_flashdata('error',''); ?></p>
												<?php } ?>
												<?php if($this->session->flashdata('success')){ ?>
												<p style="color:green;"><?php echo $this->session->flashdata('success'); $this->session->set_flashdata('success',''); ?></p>
												<?php } ?>
						<form method="post">
							<div class="input-block mb-4">
								<label class="col-form-label">Email Id</label>
								<input required type="email" class="form-control" name="username" >
							</div>
							
							<div class="input-block mb-4 text-center">
								<button class="btn btn-primary account-btn" type="submit">Submit</button>
							</div>
							<div class="account-footer">
								<!-- <p>Don't have an account yet? <a href="register.html">Register</a></p> -->
							</div>
						</form>

					</div>
				</div>
			</div>
		</div>
	</div>


	<script src="<?php echo base_url(); ?>assets/js/jquery-3.7.1.min.js" type="f7908aafb349c8c99d8d461a-text/javascript"></script>

	<script src="<?php echo base_url(); ?>assets/js/bootstrap.bundle.min.js" type="f7908aafb349c8c99d8d461a-text/javascript"></script>

	<script src="<?php echo base_url(); ?>assets/js/app.js" type="f7908aafb349c8c99d8d461a-text/javascript"></script>
	<script src="<?php echo base_url(); ?>assets/cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js" data-cf-settings="f7908aafb349c8c99d8d461a-|49" defer></script></body>


	</html>