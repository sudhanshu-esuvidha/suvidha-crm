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
					<?php $this->load->view('Template/page_header',$data); ?>
					<div class="row">
							<div class="col-md-12">
							

								<span onclick="upload_csv()" class="badge bg-success">
									<i class="fas fa-upload "></i> Upload CSV 
								</span>
								<span  class="badge bg-danger"><a download="" href="<?php echo base_url(); ?>lead_sample_csv.csv" >
									<i class="fas fa-download "></i> Download Sample
								</a></span>
                        <?php if($user->role==1 || $user->role==2){ ?>
								<span onclick="assign_to()" class="badge bg-info">
									<i class="fas fa-users "></i> Assign To
								</span>
							
						<?php } ?>

							
						</div>
					<div class="row mt-2">
						<?php if($user->role==1 || $user->role==2){ ?>
						<div class="col-md-12">
						
								<?php $assign_to=get_all_list('users'); ?>
								<select onchange="filter_by()" id="assign_to" class="select1 floating1">
									<option value="" >--all employee--</option>
									<?php foreach($assign_to as $userAssign){ ?>
										<option <?php if($_GET['assign_to']==$userAssign->id){ echo "selected"; } ?> value="<?php echo $userAssign->id; ?>"><?php echo $userAssign->name; ?></option>
									<?php } ?>
								</select>
								<?php $status=get_all_list('master_table',' where type="status"'); ?>
								<select onchange="filter_by()" id="status" class="select1 floating1">
									<option value="" >--all status--</option>
									<?php foreach($status as $rowStatus){ ?>
										<option <?php if($_GET['status']==$rowStatus->id){ echo "selected"; } ?> value="<?php echo $rowStatus->id; ?>"><?php echo $rowStatus->name; ?></option>
									<?php } ?>
								</select>
							
							
						</div>
					<?php } ?>
						<?php if($this->session->flashdata('success')){ ?>
						<div class="col-md-12">
							<div class="alert alert-solid-success alert-dismissible fade show">
								<?php echo $this->session->flashdata('success');  $this->session->set_flashdata('success',''); ?>
								<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i class="fas fa-xmark"></i></button>
							</div>
						</div>
					<?php } ?>

					</div>
					<div class="row mt-2">
					  <div class="col-md-12">
					   <span class="pull-right small">  Total <?php echo $total; ?> Result  Found</span> 
					      
					  </div>    
					</div>
<div class="row mt-2">

    <!-- ✅ Mobile View (Cards) -->
    <div class="col-12 d-block d-md-none">
        <div class="card1 flex-fill">
            <div class="card-body">
                <div class="notification-tab">
                    <div class="tab-content">
                        <div class="tab-pane active show" id="notification_tab_mobile" role="tabpanel">
                            <div class="employee-noti-content">
                                <ul class="employee-notification-list" id="list-mobile">
                                    <?php foreach($result as $row){  
                                        if($row->mobile_no){ 
                                            $assign_to=get_row('users',' where id='.$row->assign_to);
                                            $last_call=get_row('lead_status_log',' where lead_id='.$row->id.' order by id desc');
                                            $status=get_row('master_table',' where id='.$row->status_id);
                                    ?>
                                    <li class="employee-notification-grid">
                                        <div class="employee-notification-content">
                                            <h6>
                                                <input type="checkbox" class="lead_ids" value="<?php echo $row->id; ?>"> 
                                                <a href="tel:<?php echo $row->mobile_no; ?>" onclick="feedback_form(<?php echo $row->id; ?>,<?php echo $row->mobile_no; ?>)">
                                                    <?php echo ucwords($row->contact_name); ?> 
                                                    <span class="small"><i class="fa fa-map-marker"></i> <?php echo $row->address; ?></span>
                                                    <span class="badge bg-primary pull-right">
                                                        <i class="la la-phone-volume"></i> <?php echo $row->mobile_no; ?>
                                                    </span>
                                                </a>
                                            </h6>
                                            <ul class="nav">
                                                <li>Assigned To : <?php echo ucwords($assign_to->name); ?></li>
                                                <li>Course : <?php echo $row->description; ?></li>
                                            </ul>
                                            <ul class="nav">
                                                <li>Last Call : <?php echo date("d-M-Y h:i a",strtotime($last_call->created_at)); ?></li>
                                                <li>
                                                    <?php if($row->status_id==0){ ?>
                                                        <span class="badge bg-success"> Fresh Lead </span>
                                                    <?php }else{ ?>
                                                        <span class="badge bg-info"><?php echo $status->name; ?></span>
                                                    <?php } ?>
                                                </li>
                                            </ul>
                                            <?php if($last_call->remark){ ?>
                                            <ul class="nav">
                                                <li>Remark: <?php echo $last_call->remark; ?></li>
                                            </ul>
                                            <?php } ?>
                                            <ul class="nav">
                                                <li>Next Followup : <?php if($row->next_followup!="0000-00-00 00:00:00"){ echo date("d-M-Y h:i a",strtotime($row->next_followup)); } ?></li>
                                            </ul>
                                            <ul class="nav">
                                                <li>Date Created: <?php echo date("d-M-Y h:i a",strtotime($row->created_at)); ?></li>
                                            </ul>
                                            <ul class="nav">
                                                <li class="full-width">
                                                    <span onclick="delete_data()" class="pull-right badge bg-danger"><i class="fas fa-trash"></i></span>
                                                    <span onclick="window.location.href='<?php echo base_url(); ?>Leads/lead_details/<?php echo $row->id; ?>'" class="pull-right badge bg-primary"><i class="fas fa-eye"></i></span>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    <?php } } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ✅ Desktop View (Table) -->
    <div class="col-12 d-none d-md-block">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th><input type="checkbox" id="select_all"></th>
                        <th>Name</th>
                        <th>Mobile</th>
                        <th>Address</th>
                        <th>Assigned To</th>
                        <th>Course</th>
                        <th>Status</th>
                        <th>Last Call</th>
                        <th>Next Followup</th>
                        <th>Date Created</th>
                        <th>Remark</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($result as $row){  
                    if($row->mobile_no){ 
                        $assign_to=get_row('users',' where id='.$row->assign_to);
                        $last_call=get_row('lead_status_log',' where lead_id='.$row->id.' order by id desc');
                        $status=get_row('master_table',' where id='.$row->status_id);
                ?>
                    <tr>
                        <td><input type="checkbox" class="lead_ids" value="<?php echo $row->id; ?>"></td>
                        <td><?php echo ucwords($row->contact_name); ?></td>
                        <td><a href="tel:<?php echo $row->mobile_no; ?>"><?php echo $row->mobile_no; ?></a></td>
                        <td><?php echo $row->address; ?></td>
                        <td><?php echo ucwords($assign_to->name); ?></td>
                        <td><?php echo $row->description; ?></td>
                        <td><?php echo ($row->status_id==0) ? '<span class="badge bg-success">Fresh Lead</span>' : '<span class="badge bg-info">'.$status->name.'</span>'; ?></td>
                        <td><?php echo date("d-M-Y h:i a",strtotime($last_call->created_at)); ?></td>
                        <td><?php if($row->next_followup!="0000-00-00 00:00:00"){ echo date("d-M-Y h:i a",strtotime($row->next_followup)); } ?></td>
                        <td><?php echo date("d-M-Y h:i a",strtotime($row->created_at)); ?></td>
                        <td><?php echo $last_call->remark; ?></td>
                        <td>
                            <span onclick="delete_data()" class="badge bg-danger"><i class="fas fa-trash"></i></span>
                            <span onclick="window.location.href='<?php echo base_url(); ?>Leads/lead_details/<?php echo $row->id; ?>'" class="badge bg-primary"><i class="fas fa-eye"></i></span>
                        </td>
                    </tr>
                <?php } } ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

				</div>
			</div>

		</div>

<script>
    // Select All functionality
    document.getElementById('select_all').addEventListener('change', function () {
        let checkboxes = document.querySelectorAll('.lead_ids');
        checkboxes.forEach(cb => cb.checked = this.checked);
    });
</script>

		
		<?php //$this->load->view('Template/settings',$data); ?>
		<?php $this->load->view('Template/footer',$data); ?>
		<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
		<script>
			var start=10;
			$(document).ready(function() {
			  
				$(window).scroll(function() {
				      
					if($(window).scrollTop() + $(window).height()<= $(document).height()) {
					   
						var assign_to=$("#assign_to").val();
						var status=$("#status").val();
						$.ajax({
							url:"<?php echo base_url(); ?>Leads/list_autoload",
							type: "POST",
							data:{start: start,assign_to:assign_to,status:status},
							success:function(data)
							{
                                  
								$("#list").append(data);
								start=parseInt(start+50);
							}
						});
					}
				});
			});


			function assign_to()
			{
				$("#assignLeadModal").modal('show');
				
			}
			function feedback_form(lead_id,mobile_no)
			{
				$("#lead_id").val(lead_id);
				$("#modal_title").html(mobile_no);
				$("#feedbackForm").modal('show');
			}
			function filter_by()
			{
				var assign_to=$("#assign_to").val();
				var status=$("#status").val();
				window.location.href="<?php echo base_url(); ?>Leads/list/?assign_to="+assign_to+"&status="+status;
			}
			function upload_csv()
			{
				$("#uploadCsvModal").modal('show');
			}
			function leadsAssign()
			{
				$("#leads_assign_error").hide();
				var leads_assign_to=$("#leads_assign_to").val();
					if(leads_assign_to)
					{
					var lead_ids="";
					$(".lead_ids").each(function() {
						if ($(this).prop('checked')) {
						    var value=$(this).val();
						    lead_ids=lead_ids+value+",";
						}
					   
					});
					if(lead_ids)
					{
						$("#submit_leads_assign").hide();
						$("#loader_leads_assign").show();
                           $.ajax({
							url:"<?php echo base_url(); ?>Leads/leadsAssign",
							type: "POST",
							data:{lead_ids: lead_ids,assign_to:leads_assign_to},
							success:function(data)
							{

								window.location.reload();
							}
						});
					}
					else
					{
						$("#leads_assign_error").show();
					    $("#leads_assign_error").html('First select atleast one lead!');
					}
				}
				else
				{
					$("#leads_assign_error").show();
					$("#leads_assign_error").html('First select any employee name!');
				}
			}
			function delete_data()
			{
			    $("#deleteConfirmModal").modal('show');
			}
		
		</script>
		<!-- Modal -->
		<div class="modal fade" id="feedbackForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" >
				<div class="modal-content ">
					<form action="<?php echo base_url(); ?>Leads/feedbackForm" method="post">
						<input type="hidden" name="lead_id" id="lead_id">
						<div class="modal-header">
							<h5 class="modal-title"  id="modal_title"></h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							<div class="form-group row mb-3">
								
								<div class="col-md-8">
									<select class="form-control" name="priority_id" required>
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
									<select class="form-control" name="status_id" required>
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
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary">Submit</button>
						</div>
					</form>
				</div>
			</div>
		</div>

		<!-- Modal -->
		<div class="modal fade" id="assignLeadModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<form action="<?php echo base_url(); ?>Leads/assin_to" method="post">
						<input type="hidden" name="leadid" id="leadid">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Assign Leads</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							<div style="display:none;" id="leads_assign_error" class="alert alert-danger" role="alert"></div>
							<div class="input-block mb-3 form-focus select-focus">
								<?php $result=get_all_list('users'); ?>
								<select  id="leads_assign_to" class="select floating">
									<option value="" >--Select Employee Name--</option>
									<?php foreach($result as $row){ ?>
									<option value="<?php echo $row->id; ?>"><?php echo $row->name; ?></option>
								<?php } ?>
								</select>
								<label class="focus-label">Assign Leads   </label>
							</div>
							
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
							<button style="display:none;" id="loader_leads_assign" type="button" class="btn btn-warning btn-sm"><i class="fas fa-spinner fa-spin me-2"></i>Loading...</button>
							<button id="submit_leads_assign" onclick="leadsAssign()" type="button" class="btn btn-primary">Submit</button>
						</div>
					</form>		
				</div>
			</div>
		</div>


		<!-- Modal -->
		<div id="uploadCsvModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<form action="<?php echo base_url(); ?>Leads/upload_csv" method="post" enctype="multipart/form-data">	
						<div class="modal-header">
							<h4 class="modal-title" id="standard-modalLabel">Upload CSV (LEADS)</h4>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							<div class="row">
								<div class="col-md-12">
									<div class="mb-3">
										<label for="field-1" class="form-label">Select CSV File</label>
										<input type="file" class="form-control" name="file" required >
									</div>
								</div>

							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary">Submit</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		
			<!-- Modal -->
		<div id="deleteConfirmModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					
						<div class="modal-header">
							<h4 class="modal-title" id="standard-modalLabel">Are you sure want to delete this record!</h4>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>
							<button onclick="window.location.href='<?php echo base_url(); ?>Leads/delete/<?php echo $row->id; ?>'" type="button" class="btn btn-primary">Yes</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<style>
			.counter-box{ width:50%; }
			.employee-notification-content{width:100%!important;}
			.pull-right{ float:right; margin-left:5px; }
			.full-width{ width:100%; }
			.small{ font-size:10px; margin-left:10px;  }
			
		</style>
	</body>


	</html>