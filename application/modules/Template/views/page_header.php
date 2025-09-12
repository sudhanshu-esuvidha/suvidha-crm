<div class="page-header">
	<div class="row">
		<div class="col">
		    <span onclick="window.history.back()" class="badge bg-primary"> <span class="badge-label">	<i class="fas fa-arrow-left "></i></span></span>
		   <!-- <span style="float:right;"  class="badge bg-primary"> <span class="badge-label">	<i class="fas fa-user "></i> <?php echo ucfirst($user->name); ?></span></span> -->
			<?php if($url){ ?> <span style="float:right; margin-right:5px;"  class="badge bg-success" onclick="<?php if($url!="modal"){ ?>window.location.href='<?php echo base_url().$url; ?>'<?php }else{ ?>add_modal()<?php } ?>" ><i class="fas fa-<?php if($add){ echo "plus";} if($list){ echo "list";} ?>"></i></span> <?php } ?>
		</div>
	</div>
</div>