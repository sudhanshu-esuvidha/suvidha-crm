	<?php foreach($result as $row){  if($row->mobile_no){ 
															$assign_to=get_row('users',' where id='.$row->assign_to);
															$last_call=get_row('lead_status_log',' where lead_id='.$row->id.' order by id desc');
															$status=get_row('master_table',' where id='.$row->status_id);
															?>
															<li class="employee-notification-grid">

																<div class="employee-notification-content">
																	<h6>
																	<input type="checkbox" class="lead_ids" value="<?php echo $row->id; ?>"> 
<a href="tel:<?php echo $row->mobile_no; ?>" onclick="feedback_form(<?php echo $row->id; ?>,<?php echo $row->mobile_no; ?>)">
																			<?php echo ucwords($row->contact_name); ?> <span class="small"><i class="fa fa-map-marker"></i> <?php echo $row->address; ?></span>

																			<span  class="badge bg-primary pull-right"> <i class="la la-phone-volume"></i>	<?php echo $row->mobile_no; ?> </span>
																		</a> 
																	</h6>

                                                                    <ul class="nav">
																		<li>Assigned To : <?php echo ucwords($assign_to->name); ?></li>
																		<li>Course : <?php echo $row->description; ?></li>
																	</ul>
																
																	<ul class="nav">
																		<li>Last Call : <?php echo date("d-M-Y h:i a",strtotime($last_call->created_at));  ?> </li>
																		<li><?php if($row->status_id==0){ ?> <span class=" badge bg-success"> Fresh Lead </span> <?php }else{ ?> <span class="pull-right badge bg-info"><?php echo $status->name; ?></span><?php } ?></li>
																	</ul>
																 <?php if($last_call->remark){ ?>
																	<ul class="nav">
																	
																		<li>Remark: <?php echo $last_call->remark; ?> </li>
																		<li></li>
																	</ul>
																	<?php }?>
																	<ul class="nav">
																		<li>Next Followup : <?php if($row->next_followup!="0000-00-00 00:00:00"){ ?><?php echo date("d-M-Y h:i a",strtotime($row->next_followup));  ?><?php } ?></li>
																	    <li></li>

																	</ul>
																	<ul class="nav">
																	
																		<li >Date Created: <?php echo date("d-M-Y h:i a",strtotime($row->created_at));  ?></li>
																		<li></i> </span></li>
																		

																	</ul>
																	<ul class="nav">
																	
																	
																		<li class="full-width">	<span onclick="window.location.href='<?php echo base_url(); ?>Leads/delete/<?php echo $row->id; ?>'" class="pull-right  badge bg-danger "> <i class="fas fa-trash"></i> </span></li>
																		

																	</ul>

																</div>
															</li>
														<?php } } ?>