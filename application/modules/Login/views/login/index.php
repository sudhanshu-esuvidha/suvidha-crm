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

	<link rel="stylesheet" href="assets/css/bootstrap.min.css">

	<link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
	<link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">

	<link rel="stylesheet" href="assets/css/line-awesome.min.css">
	<link rel="stylesheet" href="assets/css/material.css">

	<link rel="stylesheet" href="assets/css/line-awesome.min.css">

	<link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="account-page">

	<div class="main-wrapper">
		<div class="account-content">
			<!-- <a href="job-list.html" class="btn btn-primary apply-btn">Apply Job</a> -->
			<div class="container">

			

				<div class="account-box">
				    <img class="img-fluid" src="<?php echo base_url(); ?>assets/img/logo.png" >
					<div class="account-wrapper" style="border: #011C55 solid 1px;">
						<h3 class="account-title">Login</h3>
						<p class="account-subtitle">Please log in to your account</p>
                     <?php if($this->session->flashdata('error')){ ?>
												<p style="color:red;"><?php echo $this->session->flashdata('error'); $this->session->set_flashdata('error',''); ?></p>
												<?php } ?>
						<form method="post">
							<div class="input-block mb-4">
								<label class="col-form-label">Username or Email Id</label>
								<input required type="text" class="form-control" name="username" >
							</div>
							<div class="input-block mb-4">
								<div class="row align-items-center">
									<div class="col">
										<label class="col-form-label">Password</label>
									</div>
									<div class="col-auto">
										<!-- <a class="text-muted" href="forgot-password.html">
											Forgot password?
										</a> -->
									</div>
								</div>
								<div class="position-relative">
									<input required class="form-control" type="password"  id="password" name="password">
									<span class="fa-solid fa-eye-slash" id="toggle-password"></span>
								</div>
							</div>
							<div class="input-block mb-4 text-center">
								<button class="btn btn-primary account-btn" type="submit">Login</button>
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


	<script src="assets/js/jquery-3.7.1.min.js" type="f7908aafb349c8c99d8d461a-text/javascript"></script>

	<script src="assets/js/bootstrap.bundle.min.js" type="f7908aafb349c8c99d8d461a-text/javascript"></script>

	<script src="assets/js/app.js" type="f7908aafb349c8c99d8d461a-text/javascript"></script>
	<script src="assets/cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js" data-cf-settings="f7908aafb349c8c99d8d461a-|49" defer></script></body>


	</html>