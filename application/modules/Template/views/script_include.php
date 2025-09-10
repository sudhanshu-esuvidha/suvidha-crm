<!-- Bootstrap JS -->
<script src="<?php echo base_url(); ?>assets/backend/js/bootstrap.bundle.min.js"></script>
	<!--plugins-->
	<script src="<?php echo base_url(); ?>assets/backend/js/jquery.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/backend/plugins/simplebar/js/simplebar.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/backend/plugins/metismenu/js/metisMenu.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/backend/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
<script src="<?php echo base_url(); ?>assets/backend/plugins/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/backend/plugins/vectormap/jquery-jvectormap-world-mill-en.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/backend/plugins/select2/js/select2-custom.js"></script>
	<script src="<?php echo base_url(); ?>assets/backend/plugins/datatable/js/jquery.dataTables.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/backend/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
	<!--notification js -->
	<script src="<?php echo base_url(); ?>assets/backend/plugins/notifications/js/lobibox.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/backend/plugins/notifications/js/notifications.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/backend/plugins/chartjs/js/chart.js"></script>
	<script src="<?php echo base_url(); ?>assets/backend/js/index.js"></script>
	<!--app JS-->
	<script src="<?php echo base_url(); ?>assets/backend/js/app.js"></script>
	
<script>
	new PerfectScrollbar(".app-container")
</script>



<script>

		$(document).ready(function() {
		    
		    	<?php if($this->session->flashdata('success')){ ?>
								Lobibox.notify('success', {
						pauseDelayOnHover: true,
						size: 'mini',
						icon: 'bx bx-check-circle',
						continueDelayOnInactiveTab: false,
						position: 'bottom right',
						msg: '<?php echo $this->session->flashdata('success'); $this->session->set_flashdata('success','');  ?>'
					});
	
			<?php } ?>
			<?php if($this->session->flashdata('error')){ ?>
								Lobibox.notify('error', {
						pauseDelayOnHover: true,
						size: 'mini',
						icon: 'bx bx-x-circle',
						continueDelayOnInactiveTab: false,
						position: 'bottom right',
						msg: '<?php echo $this->session->flashdata('error'); $this->session->set_flashdata('error',''); ?>'
					});
	
			<?php } ?>
			var table = $('#example2').DataTable( {
				lengthChange: false,
			//	buttons: [ 'copy', 'excel', 'pdf', 'print'],
				 //order: [[1, 'desc']]
			} );
		 
			table.buttons().container()
				.appendTo( '#example2_wrapper .col-md-6:eq(0)' );
				
					});
		
		
		
		$(document).on("input", ".lettersonly", function() {
    	this.value = this.value.replace(/[^a-zA-Z\s]/g,'');
    	});
    	$(document).on("input", ".alphanumbersonly", function() {
    		this.value = this.value.replace(/[^a-zA-Z0-9\s]/g,'');
    	});
    	$(document).on("input", ".numbersonly", function() {
    		this.value = this.value.replace(/[^0-9\s]/g,'');
    	});
    	$(document).on("input", ".specialchar", function() {
    		this.value = this.value.replace(/[^a-zA-Z0-9\.#\/\s]/,'');
    	});
		
		
		
		
		
		
		
		</script>