<ul class="sidebar-vertical">
	<!-- <li class="menu-title">
			<span>Main</span>
		</li> -->
		<li >
			<a href="<?php echo base_url(); ?>Dashboard"><i class="la la-dashcube"></i> <span> Dashboard</span> </a>
		</li>
		<li >
			<a href="<?php echo base_url(); ?>Leads/list"><i class="la la-chart-area"></i> <span> Leads </span></a>
		</li>

		<?php if($user->role==1){ ?>
			<li >
				<a href="<?php echo base_url(); ?>Mastertable/list/role"><i class="la la-user-shield"></i> <span> Team Roles </span></a>
			</li>
			<li class="submenu">
				<a href="#" class=""><i class="la la-building"></i> <span> Team Structure</span> <span class="menu-arrow"></span></a>
				<ul style="display: none;">
					<?php $result=get_all_list('master_table',' where type="role"'); ?>
					<?php foreach($result as $row){ ?>
						<li> <a href="<?php echo base_url(); ?>TeamStructure/list/<?php echo $row->id; ?>"><?php echo $row->name; ?></a>	</li>
					<?php } ?>
					
				</ul>
			</li>
			<li >
				<a href="<?php echo base_url(); ?>Mastertable/list/branch"><i class="la la-table"></i> <span> Our Branches </span></a>
			</li>
			<li >
				<a href="<?php echo base_url(); ?>Mastertable/list/source"><i class="la la-table"></i> <span> Lead Sources </span></a>
			</li>
			<li >
				<a href="<?php echo base_url(); ?>Mastertable/list/status"><i class="la la-table"></i> <span> Lead Status </span></a>
			</li>
			<li >
				<a href="<?php echo base_url(); ?>Mastertable/list/priority"><i class="la la-table"></i> <span> Lead Priorities </span></a>
			</li>
				
			
			
			
		<?php } ?>

	</ul>