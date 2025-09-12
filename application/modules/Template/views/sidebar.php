<ul class="sidebar-vertical">

    <li>
        <a href="<?php echo base_url(); ?>Dashboard">
            <i class="la la-tachometer-alt"></i> <span>Dashboard</span>
        </a>
    </li>

    <?php if($user->role==1){ ?>
    <li>
        <a href="<?php echo base_url(); ?>Company">
            <i class="la la-building"></i> <span>Companies</span>
        </a>
    </li>
    <?php } ?>

    <li>
        <a href="<?php echo base_url(); ?>Task">
            <i class="la la-tasks"></i> <span>Task Management</span>
        </a>
    </li>

    <li>
        <a href="<?php echo base_url(); ?>Leads/list">
            <i class="la la-chart-line"></i> <span>Leads</span>
        </a>
    </li>
	<?php if($user->role==1 || $user->role==2){ ?>
    <li>
        <a href="<?php echo base_url(); ?>Mastertable/list/role">
            <i class="la la-user-shield"></i> <span>Team Roles</span>
        </a>
    </li>

    <li class="submenu">
        <a href="#">
            <i class="la la-users"></i> <span>Our Team</span> <span class="menu-arrow"></span>
        </a>
        <ul style="display: none;">
           <?php 
			$parent_id = $this->session->userdata('user_info')->id; 
			$result = get_all_list('master_table',' where type="role" AND parent_id="'.$parent_id.'" '); 
			?>

            <?php foreach($result as $row){ ?>
                <li>
                    <a href="<?php echo base_url(); ?>TeamStructure/list/<?php echo $row->id; ?>">
                        <i class="la la-user"></i> <?php echo $row->name; ?>
                    </a>
                </li>
            <?php } ?>
        </ul>
    </li>

    <li>
        <a href="<?php echo base_url(); ?>Mastertable/list/branch">
            <i class="la la-code-branch"></i> <span>Branches</span>
        </a>
    </li>

    <li>
        <a href="<?php echo base_url(); ?>Mastertable/list/source">
            <i class="la la-bullhorn"></i> <span>Lead Sources</span>
        </a>
    </li>

    <li>
        <a href="<?php echo base_url(); ?>Mastertable/list/status">
            <i class="la la-check-circle"></i> <span>Lead Status</span>
        </a>
    </li>

    <li>
        <a href="<?php echo base_url(); ?>Mastertable/list/priority">
            <i class="la la-exclamation-circle"></i> <span>Lead Priorities</span>
        </a>
    </li>
	<?php } ?>
</ul>
