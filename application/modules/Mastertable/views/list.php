<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">
<?php $this->load->view('Template/head',$data); ?>

<body>
	<?php  $date=date("Y-m-d");
	$date2=date('Y-m-d', strtotime($date.' + 1 day')); ?>
	<div class="main-wrapper">
		<div class="header">
			<?php $this->load->view('Template/header',$data); ?>
			<div class="page-wrapper">
				<div class="content container-fluid pb-0">
					<?php $data['url']="modal"; $data['add']=1;  $this->load->view('Template/page_header',$data); ?>
					<?php if($this->session->flashdata('success')){ ?>
						<div class="col-md-12">
							<div class="alert alert-solid-success alert-dismissible fade show">
								<?php echo $this->session->flashdata('success');  $this->session->set_flashdata('success',''); ?>
								<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i class="fas fa-xmark"></i></button>
							</div>
						</div>
					<?php } ?>
					<table id="example2" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th style="width: 5%;">Sno.</th>
								<th><?php echo ucfirst($type); ?> Name</th>
								<th style="width:5%">Action</th>

							</tr>
						</thead>
						<tbody>
							<?php foreach($result as $key=> $row){  ?>
								<tr>
									<td align="center"><?php echo $key+1; ?>.</td>
									<td><?php echo $row->name; ?></td>
									<td align="center">
										<span class="badge badge-outline-secondary" onclick="edit_modal(<?php echo $row->id; ?>,'<?php echo $row->name; ?>')" class="font-22 text-primary">	<i class="fa fa-edit"></i>
										</span>
										<span class="badge badge-outline-danger" onclick="window.location.href='<?php echo base_url(); ?>Mastertable/delete/<?php echo $type; ?>/<?php echo $row->id; ?>'" class="font-22 text-danger">	<i class="fa fa-trash"></i>
										</span>
										
									</td>
								</tr>
							<?php } ?>

						</tbody>

					</table>

				</div>

			</div>




			
			<?php $this->load->view('Template/footer',$data); ?>
			<script>
				function add_modal()
				{
					$("#add_modal").modal('show');
				}
				function edit_modal(id,name)
				{
					$("#leadid").val(id);
					$("#name").val(name);
					$("#add_modal").modal('show');
				}
			</script>
			<style>
				.counter-box{ width:50%; }
			</style>

			<!-- Modal -->
			<div class="modal fade" id="add_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<form action="<?php echo base_url(); ?>Mastertable/add/<?php echo $type; ?>" method="post">
							<input type="hidden" name="leadid" id="leadid">
							
							<div class="modal-body">
								<div style="display:none;" id="leads_assign_error" class="alert alert-danger" role="alert"></div>
								<div class="row">
									<div class="col-md-12">
										<div class="mb-3">
											<label for="field-3" class="form-label"><?php echo ucwords($type); ?> Name</label>
											<input required type="text" class="form-control" id="name" name="name">
										</div>
									</div>
								</div>

							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
								
								<button  type="submit" class="btn btn-primary">Submit</button>
							</div>
						</form>		
					</div>
				</div>
			</div>

		</body>


		</html>