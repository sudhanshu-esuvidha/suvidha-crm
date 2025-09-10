	<?php  $date=date("Y-m-d");
        $date2=date('Y-m-d', strtotime($date.' + 1 day')); ?>
<div class="row">
	<div class="col-lg-6 col-md-12">
		<div class="card flex-fill">
			<div class="card-body">
				<div class="statistic-header">
					<h4>LEAD MANAGEMENT </h4>
					<!--<div class="dropdown statistic-dropdown">-->
					<!--	<a class="dropdown-toggle" data-bs-toggle="dropdown" href="javascript:void(0);">-->
					<!--		Today-->
					<!--	</a>-->
					<!--	<div class="dropdown-menu dropdown-menu-end">-->
					<!--		<a href="javascript:void(0);" class="dropdown-item">-->
					<!--			Week-->
					<!--		</a>-->
					<!--		<a href="javascript:void(0);" class="dropdown-item">-->
					<!--			Month-->
					<!--		</a>-->
					<!--		<a href="javascript:void(0);" class="dropdown-item">-->
					<!--			Year-->
					<!--		</a>-->
					<!--	</div>-->
					<!--</div>-->
				</div>
				<!--<div class="clock-in-info">-->
				<!--	<div class="clock-in-content">-->
				<!--		<p>Work Time</p>-->
				<!--		<h4>6 Hrs : 54 Min</h4>-->
				<!--	</div>-->
				<!--	<div class="clock-in-btn">-->
				<!--		<a href="javascript:void(0);" class="btn btn-primary">-->
				<!--			<img src="assets/img/icons/clock-in.svg" alt="Icon"> Clock-In-->
				<!--		</a>-->
				<!--	</div>-->
				<!--</div>-->
				<div class="clock-in-list">
					<ul class="nav">
						<li onclick="window.location.href='<?php echo base_url(); ?>Leads/today_followup'">
							<p>Today followup</p>
							<h6><?php  if($user->role==1){ echo get_total_of_table('leads','  where cast(next_followup as date)="'.$date.'"  order by id desc'); }else{ echo get_total_of_table('leads','  where cast(next_followup as date)="'.$date.'" and assign_to='.$user->id.' order by id desc');} ?></h6>
						</li>
						<li onclick="window.location.href='<?php echo base_url(); ?>Leads/tomorrow_followup'">
							<p>Tomorrow Followup</p>
							<h6><?php if($user->role==1){ echo get_total_of_table('leads','  where cast(next_followup as date)="'.$date2.'"  order by id desc'); }else{ echo get_total_of_table('leads','  where cast(next_followup as date)="'.$date2.'" and assign_to='.$user->id.' order by id desc');} ?></h6>
						</li>
						<li onclick="window.location.href='<?php echo base_url(); ?>Leads/pending_followup'">
							<p>Total Pending</p>
							<h6><?php if($user->role==1){ echo get_total_of_table('leads',' where cast(next_followup as date)<"'.$date.'" and status!=0  '); }else{echo get_total_of_table('leads',' where cast(next_followup as date)<"'.$date.'" and status!=0  and assign_to='.$user->id);} ?></h6>
						</li>
					</ul>
				</div>
				<div class="view-attendance">
					<a href="<?php echo base_url(); ?>Leads/list">
						View All Leads <i class="fa fa-arrow-right" aria-hidden="true"></i> 
					</a>
					<span style="float:right;"><?php if($user->role==1){ echo get_total_of_table('leads'); }else{echo get_total_of_table('leads',' where assign_to='.$user->id);} ?></span>
				</div>
			</div>
		</div>
	</div>
</div>