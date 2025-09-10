<?php 

	$login_user_id = $this->session->userdata('site_userid');
?>
<!doctype html>
<html  lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php $this->load->view('Template/style_include'); ?>
	<script src="https://code.highcharts.com/highcharts.js"></script>
	<title>Pharmaxia</title>
	
	
</head>
<body>

	
	<!--wrapper-->
	<div class="wrapper">
		<!--sidebar wrapper -->
		<?php $this->load->view('Template/sidebar_psr'); ?>
		<!--end sidebar wrapper -->
		<!--start header -->
		<?php  $this->load->view('Template/header_psr');  ?>
		
		<!--end header -->
		<!--start page wrapper -->
		<div class="page-wrapper">
            <div class="page-content">
				
				
				
                <!--end row-->

                

                 


                    

                     

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
	
</body>



</html>