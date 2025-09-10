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
						<a href="#" class="active" data-bs-toggle="tab" data-bs-target="#notification_tab" aria-selected="true" role="tab">
							<i class="la la-bell"></i> Contact Information
						</a>
					</li>
					<li>
						<a href="#" data-bs-toggle="tab" data-bs-target="#schedule_tab" aria-selected="false" tabindex="-1" role="tab">
							<i class="la la-list-alt"></i> Interaction History
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
																    <a class="btn btn-custom" href="tel:<?php echo $row->mobile_no; ?>" onclick="feedback_form(<?php echo $row->id; ?>,<?php echo $data->mobile_no; ?>)">
																			<?php echo ucwords($row->contact_name); ?> 

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
						<div class="tracking-list">
            	<?php $logs=get_all_list('lead_status_log',' where lead_id='.$data->id.' order by id asc'); ?>
            	<?php foreach($logs as $log){ ?>
               <div class="tracking-item">
                      <div class="tracking-icon status-intransit">
                         <!--<img style="width:35px;" src="<?php echo base_url(); ?>assets/backend/images/button.png">-->
                          <i class="fa fa-history"></i> 
                      </div>
                      <div class="tracking-date"><?php echo date('M, d Y',strtotime($row->created_at)); ?><span><?php echo date('h:i a',strtotime($log->created_at)); ?></span></div>
                      <p>User: <?php $createdBy=get_row('users',' where id='.$log->created_by); echo $createdBy->name; ?></p>
                      <p>Status:<?php  if($log->status==0){?> <span class="text-success">Created</span>   <?php  }else{ $status=get_row('master_table',' where id='.$log->status); ?><span class="text-info"><?php echo $status->name; ?></span>  <?php   } ?></p>
                      <p>Next Followup:<?php if($log->next_followup!="0000-00-00 00:00:00"){ ?><?php echo date("d-M-Y h:i a",strtotime($log->next_followup));  ?><?php } ?> </p>
                      <p>Remark:<?php echo $log->remark; ?> </p>
               </div>
              <?php } ?>
               
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
 border:1px solid #e5e5e5
}
.tracking-item {
 border-left:1px solid #e5e5e5;
 position:relative;
 padding:2rem 1.5rem .5rem 2.5rem;
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
	</body>


	</html>