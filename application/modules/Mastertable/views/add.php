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
					<div class="breadcrumb-title pe-3">Add New <?php echo ucfirst($type); ?> </div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>Dashboard"><i class="bx bx-home-alt"></i></a>
								</li>
								 <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url();?>Mastertable/list/<?php echo $type; ?>"><?php echo ucfirst($type); ?> List</a></li> 
							</ol>
						</nav>
					</div>
					<div class="ms-auto">
						<button title="all list" onclick="window.location.href='<?php echo base_url();?>Mastertable/list/<?php echo $type; ?>'" type="button" class="btn btn-success px-5"><i class="fadeIn animated bx bx-list-ol"></i>All <?php echo ucfirst($type); ?> List</button>
						
					</div>
				</div>
				<!--end breadcrumb-->
				<hr/>
				<div class="card">
					<div class="card-body">
						<form method="post" enctype="multipart/form-data">

							
							<div class="form-group row mb-3">
								<div class="col-md-3">
									<label><?php echo ucfirst($type); ?> Name *</label>
								</div>
								<div class="col-md-4">
									<input value="<?php echo $data->name; ?>"  type="text" class="form-control" name="name" required >
								</div>
							</div>
						
							<div class="form-group row mb-3">
								<div class="col-md-3">
									<button id="submitbtn"  type="submit" class="btn btn-primary">Submit</button>
								</div>
							</div>    


						</form>
					</div>
				</div>
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
	
	<script>
		function display_list()
		{
			var cat_id=$("#user_category").val();
			$.ajax({
				url: "<?php echo base_url(); ?>admin/display_list",
				type: "POST",
				data: {cat_id:cat_id},
				success: function(result) {
					$("#categoryDiv").html(result);
					$("#submitbtn").show();
				},
				error: function() {}
			});
		}
	</script>
</body>



</html>