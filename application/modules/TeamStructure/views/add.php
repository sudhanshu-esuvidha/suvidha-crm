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
					<?php $data2['url']="TeamStructure/list/".$role->id; 
					$data2['list']=1;  
					$this->load->view('Template/page_header',$data2); ?>
					<?php if($this->session->flashdata('success')){ ?>
						<div class="col-md-12">
							<div class="alert alert-solid-success alert-dismissible fade show">
								<?php echo $this->session->flashdata('success');  $this->session->set_flashdata('success',''); ?>
								<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i class="fas fa-xmark"></i></button>
							</div>
						</div>
					<?php } ?>
					<div class="row">
						<div class="col-md-12">
							<form method="post" enctype="multipart/form-data">
								<div class="card">
									<!--<div class="card-header">-->
										<!--	<div class="d-flex align-items-center">-->
											<!--		<div>-->
												<!--			<h6 class="mb-0">Contact Details</h6>-->
												<!--		</div>-->

												<!--	</div>-->
												<!--</div>-->
												<div class="card-body">

													<div class="form-group row mb-3">
														<div class="col-md-4 mb-2">
															<label>First Name<span class="text-danger">*</span></label>
															<input  value="<?php echo $data->first_name; ?>"  type="text" class="form-control" name="first_name" required >
														</div>
														<div class="col-md-4 mb-2">
															<label>Last Name</label>
															<input  value="<?php echo $data->last_name; ?>"  type="text" class="form-control" name="last_name"  >
														</div>
														<div class="col-md-4 mb-2">
															<label>Mobile No.<span class="text-danger">*</span></label>
															<input  value="<?php echo $data->mobile_no; ?>"  type="text" class="form-control" name="mobile_no" required >
														</div>
													</div>
													<div class="form-group row mb-3">
														<div class="col-md-6 mb-2">
															<label>Email<span class="text-danger">*</span></label>
															<input  value="<?php echo $data->email; ?>"  type="email" class="form-control" name="email" required >
														</div>

														<div class="col-md-6 mb-2">
															<label>Branch<span class="text-danger">*</span></label>
															<?php $result=get_all_list('master_table',' where type="branch"'); ?>
															<select class="form-control" name="branch" required>
																<option value="">--Select Branch---</option>
																<?php foreach($result as $row){ ?>
																	<option <?php if($data->branch==$row->id){ echo "selected"; }?> value="<?php echo $row->id; ?>"><?php echo $row->name; ?></option>
																<?php } ?>

															</select>
														</div>
													</div>
													<hr/>
													<div class="form-group row mb-3">

														<div class="col-md-6 mb-2">
															<label>Assign To</label>
															<?php $result=get_all_list('users'); ?>
															<select class="form-control" name="parent" >
																<option value="">--Select User---</option>
																<?php foreach($result as $row){ ?>
																	<option <?php if($data->parent_id==$row->id){ echo "selected";} ?> value="<?php echo $row->id; ?>"><?php echo $row->name; ?></option>
																<?php } ?>

															</select>
														</div>
														<div class="col-md-6 mb-2">
															<label>Father's Full Name</label>
															<input  value="<?php echo $data->father_name; ?>"  type="text" class="form-control" name="father_name"  >
														</div>
													</div>
													<div class="form-group row mb-3">

														<div class="col-md-6 mb-2">
															<label>Date Of Birth</label>
															<input  value="<?php echo $data->dob; ?>"  type="date" class="form-control" name="dob"  >
														</div>
														<div class="col-md-6 mb-2">
															<label>Select Gender</label><br>
															<div class="form-check form-check-inline">
																<input <?php if($data){ if($data->gender=="male"){ echo "checked"; } }else{ echo "checked"; } ?>   class="form-check-input" type="radio" name="gender"  value="male">
																<label class="form-check-label" for="inlineRadio1">Male</label>
															</div>
															<div class="form-check form-check-inline">
																<input <?php if($data->gender=="female"){ echo "checked"; } ?> class="form-check-input" type="radio" name="gender"  value="female">
																<label class="form-check-label" for="inlineRadio1">Female</label>
															</div>
														</div>
													</div>

													<div class="form-group row mb-3">

														<div class="col-md-6 mb-2">
															<label>Address</label>
															<textarea class="form-control" name="address"><?php echo $data->address; ?></textarea>
														</div>
													</div>

													<div class="form-group row mb-3">
														<div class="col-md-12">
															<button style="float:right;" type="submit" class="btn  btn-primary">Submit </button>
														</div>
													</div>

												</form>
											</div>
										</div>

									</div>
								</div>
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