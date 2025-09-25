<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">
<?php $this->load->view('Template/head',$data); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>
	.floating-btn {
    position: fixed;
    bottom: 30px;
    right: 30px;
    width: 60px;
    height: 60px;
    background-color: #011c55; /* blue color, you can change */
    color: #fff;
    border-radius: 50%;
    text-align: center;
    line-height: 60px;
    font-size: 28px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.3);
    z-index: 9999;
    transition: background-color 0.3s;
}

.floating-btn:hover {
    background-color: #0056b3;
    text-decoration: none;
    color: #fff;
}

</style>
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
							<div class="card1 mb-0">
								<div class="card-body1">
									<div class="row">
										<div class="col-md-12">
											<div class="col-xxl-12 col-lg-12 col-md-12 d-flex">
	<div class="card flex-fill">
		<div class="card-body">

			<div class="notification-tab">
				<ul class="nav nav-tabs" role="tablist">
					<li>
						<a href="#" class="active" data-bs-toggle="tab" data-bs-target="#notification_tab" aria-selected="true" role="tab" style="font-size:16px;">
							<i class="la la-bell"></i> Details
						</a>
					</li>
					<li>
						<a href="#" data-bs-toggle="tab" data-bs-target="#schedule_tab" aria-selected="false" tabindex="-1" role="tab" style="font-size:16px;">
							<i class="la la-list-alt"></i>  History
						</a>
					</li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane active" id="notification_tab" role="tabpanel">
						<div class="employee-noti-content">
							<div class="profile-view">
												<!--<div class="profile-img-wrap">-->
												<!--	<div class="profile-img">-->
												<!--		<a href="#"><img src="assets/img/profiles/avatar-02.jpg" alt="User Image"></a>-->
												<!--	</div>-->
												<!--</div>-->
												<div class="profile-basic">
													<div class="row">
														<div class="col-md-5">
															<div class="profile-info-left">
																<h3 class="user-name m-t-0 mb-0"><?php echo ucwords($data->contact_name); ?></h3>
																<h6 class="text-muted"><?php echo ucwords($data->address); ?></h6>
																
																<div class="staff-id">Course : <?php echo ucwords($data->description); ?></div>
																<div class="small doj text-muted">Date  Created : <?php echo date("d M Y h:i a",strtotime($data->created_at));  ?></div>
																<div class="staff-msg">
																    <a class="btn btn-custom" href="tel:<?php echo $data->mobile_no; ?>" onclick="feedback_form(<?php echo $row->id; ?>,<?php echo $data->mobile_no; ?>)">
									<i class="la la-phone-volume"></i>	Make Call
																		</a> </div>
															</div>
														</div>
														<div class="col-md-7">
															<ul class="personal-info" >
																<li>
																	<div class="title">Phone:</div>
																	<div class="text"><?php echo $data->mobile_no; ?></div>
																</li>
																<li>
																	<div class="title">Email:</div>
																	<div class="text"><?php echo $data->email; ?></div>
																</li>
															
																<li>
																	<div class="title">Address:</div>
																	<div class="text"><?php echo ucwords($data->address); ?></div>
																</li>
																
																<li>
																	<div class="title">Assign to:</div>
																	<div class="text">
																		
																		
																			<?php $assign_to=get_row('users',' where id='.$data->assign_to); echo ucwords($assign_to->name); ?>
																		
																	</div>
																</li>
															</ul>
														</div>
													</div>
												</div>
												<div class="pro-edit"><a data-bs-target="#profile_info" data-bs-toggle="modal" class="edit-icon" href="#"><i class="fa-solid fa-pencil"></i></a></div>
											</div>
						</div>
					</div>
				<div class="tab-pane fade" id="schedule_tab" role="tabpanel">
    <div class="employee-noti-content">

        <!-- Show contact info at top -->
<div class="contact-info d-flex justify-content-between align-items-center">
    <!-- Left: Name -->
    <span><strong><?php echo ucwords($data->contact_name); ?></strong></span>

    <!-- Right: Call Icon -->
    <a href="tel:<?php echo $data->mobile_no; ?>" class="call-btn d-flex align-items-center justify-content-center">
        <i class="bi bi-telephone-fill"></i>
    </a>
</div>

<style>
.contact-info {
    padding: 0.5rem 1rem;
}

.call-btn {
    width: 30px;
    height: 30px; /* make it square */
    background-color: #ebebebff; /* dark blue */
    color: #011C55;
    border-radius: 50%; /* circular */
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px; /* smaller icon */
    transition: background 0.3s;
}

.call-btn:hover {
    background-color: #0040a0; /* lighter blue on hover */
    color: #fff;
    text-decoration: none;
}
</style>


        <div class="tracking-list">
            <?php 
            $logs = get_all_list('lead_status_log',' where lead_id='.$data->id.' order by id asc'); 
            foreach($logs as $log):
                $createdBy = get_row('users',' where id='.$log->created_by);
                $status = $log->status == 0 ? 'Created' : get_row('master_table',' where id='.$log->status)->name;
            ?>
            <div class="tracking-item d-flex align-items-start mb-3">

                <!-- Left: Date & Time -->
                <div class="tracking-date text-end me-3" style="min-width: 100px;">
                    <div><?php echo date('d M Y', strtotime($log->created_at)); ?></div>
                    <span><?php echo date('h:i a', strtotime($log->created_at)); ?></span>
                </div>

                <!-- Middle: Icon -->
            <div class="tracking-icon text-center me-3" style="width: 40px;">
    <i class="bi bi-clock-history text-dark" style="font-size: 24px;"></i>
</div>

                <!-- Right: Details -->
                <div class="tracking-details flex-fill">
                    <p><strong>User:</strong> <?php echo $createdBy->name; ?></p>
                    <p><strong>Status:</strong> 
                        <?php if($log->status == 0){ ?>
                            <span class="text-success"><?php echo $status; ?></span>
                        <?php } else { ?>
                            <span class="text-info"><?php echo $status; ?></span>
                        <?php } ?>
                    </p>
                    <p><strong>Next Followup:</strong> 
                        <?php if($log->next_followup != "0000-00-00 00:00:00"){ ?>
                            <?php echo date("d-M-Y h:i a", strtotime($log->next_followup)); ?>
                        <?php } ?>
                    </p>
                    <p><strong>Remark:</strong> <?php echo $log->remark; ?></p>
                </div>

            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

				</div>
			</div>
		</div>
	</div>
</div>
										</div>
									</div>
								</div>
							</div>
							
						</div>
						
					</div>
					
				</div>
			</div>

		</div>
<a href="#" class="floating-btn" onclick="openFeedbackModal()">
    <i class="fa fa-plus"></i>
</a>

<script>
function openFeedbackModal() {
    // Show the Bootstrap feedback modal
    var modal = new bootstrap.Modal(document.getElementById('feedbackForm'));
    modal.show();

    // Optionally, you can set a default lead ID or phone
    document.getElementById('lead_id').value = ''; 
    document.getElementById('modal_title').innerHTML = 'Add Feedback';
}
</script>

		
		
		<?php $this->load->view('Template/footer',$data); ?>
		<style>
			/*.counter-box{ width:50%; }*/
				
.tracking-detail {
 padding:3rem 0
}
#tracking {
 margin-bottom:1rem
}
[class*=tracking-status-] p {
 margin:0;
 font-size:1.1rem;
 color:#fff;
 text-transform:uppercase;
 text-align:center
}
[class*=tracking-status-] {
 padding:1.6rem 0
}
.tracking-status-intransit {
 background-color:#65aee0
}
.tracking-status-outfordelivery {
 background-color:#f5a551
}
.tracking-status-deliveryoffice {
 background-color:#f7dc6f
}
.tracking-status-delivered {
 background-color:#4cbb87
}
.tracking-status-attemptfail {
 background-color:#b789c7
}
.tracking-status-error,.tracking-status-exception {
 background-color:#d26759
}
.tracking-status-expired {
 background-color:#616e7d
}
.tracking-status-pending {
 background-color:#ccc
}
.tracking-status-inforeceived {
 background-color:#214977
}
.tracking-list {

	background-color:#f5f4f4 ;
 border:1px solid #f8f8f8ff
}
.tracking-item {
 border-left:1px solid #e5e5e5;
 position:relative;
 padding:8px;
 font-size:12px;
 margin-left:3rem;
 min-height:5rem
}
.tracking-item:last-child {
 padding-bottom:4rem
}
.tracking-item .tracking-date {
 margin-bottom:.5rem
}
.tracking-item .tracking-date span {
 color:#888;
 font-size:85%;
 padding-left:.4rem
}
.tracking-item .tracking-content {
 padding:.5rem .8rem;
 background-color:#f4f4f4;
 border-radius:.5rem
}
.tracking-item .tracking-content span {
 display:block;
 color:#888;
 font-size:85%
}
.tracking-item .tracking-icon {
 line-height:2.6rem;
 position:absolute;
 left:-1.3rem;
 width:2.6rem;
 height:2.6rem;
 text-align:center;
 border-radius:50%;
 font-size:1.1rem;
 background-color:#fff;
 color:#fff
}
.tracking-item .tracking-icon.status-sponsored {
 background-color:#f68
}
.tracking-item .tracking-icon.status-delivered {
 background-color:#4cbb87
}
.tracking-item .tracking-icon.status-outfordelivery {
 background-color:#f5a551
}
.tracking-item .tracking-icon.status-deliveryoffice {
 background-color:#f7dc6f
}
.tracking-item .tracking-icon.status-attemptfail {
 background-color:#b789c7
}
.tracking-item .tracking-icon.status-exception {
 background-color:#d26759
}
.tracking-item .tracking-icon.status-inforeceived {
 background-color:#214977
}
.tracking-item .tracking-icon.status-intransit {
 color:#011C55;
 border:1px solid #e5e5e5;
 font-size:24px;
}
@media(min-width:992px) {
 .tracking-item {
  margin-left:10rem
 }
 .tracking-item .tracking-date {
  position:absolute;
  left:-10rem;
  width:7.5rem;
  text-align:right
 }
 .tracking-item .tracking-date span {
  display:block
 }
 .tracking-item .tracking-content {
  padding:0;
  background-color:transparent
 }

}
p{ margin-bottom:0px!important;}
		</style>
		<!-- Feedback Modal -->
<div class="modal fade" id="feedbackForm" tabindex="-1" aria-labelledby="feedbackModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="<?php echo base_url(); ?>Leads/feedbackForm" method="post">
                <input type="hidden" name="lead_id" id="lead_id">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_title"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <?php 
                $user = $this->session->userdata('user_info');
                $user_id = $user->id;
                $role_id = $user->role;
                $parent_id = $user_id;
                if(!in_array($role_id,[1,2])){
                    $userRow = $this->db->select('parent_id')->from('users')->where('id',$user_id)->get()->row();
                    if($userRow) $parent_id = $userRow->parent_id;
                }
                ?>

                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Priority</label>
                        <select class="form-select" name="priority_id" required>
                            <option value="">-- Select Priority --</option>
                            <?php 
                            $result = get_all_list('master_table', " WHERE type='priority' AND parent_id = $parent_id"); 
                            foreach($result as $row){ ?>
                                <option value="<?php echo $row->id; ?>"><?php echo $row->name; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Status</label>
                        <select class="form-select" name="status_id" required>
                            <option value="">-- Select Status --</option>
                            <?php 
                            $result = get_all_list('master_table', " WHERE type='status' AND parent_id = $parent_id"); 
                            foreach($result as $row){ ?>
                                <option value="<?php echo $row->id; ?>"><?php echo $row->name; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Next Meeting Date & Time</label>
                        <input type="datetime-local" name="next_followup" class="form-control" placeholder="Select date and time">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Remark</label>
                        <textarea class="form-control" name="remark" placeholder="Enter remark" rows="3"></textarea>
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

	</body>


	</html>