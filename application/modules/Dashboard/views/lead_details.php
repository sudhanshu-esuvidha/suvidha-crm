<?php 

	$login_user_id = $this->session->userdata('site_userid');
?>
<!doctype html>
<html  lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php $this->load->view('Template/style_include'); ?>
	<script src="https://code.highcharts.com/highcharts.js"></script>
	<title>CRM/</title>
	
	
</head>
<body>

	
	<!--wrapper-->
	<div class="wrapper">
		<!--sidebar wrapper -->
		<?php $this->load->view('Template/sidebar'); ?>
		<!--end sidebar wrapper -->
		<!--start header -->
		<?php  $this->load->view('Template/header');  ?>
		
		<!--end header -->
		<!--start page wrapper -->
		<style>
			.col{ width:50%!important; padding-left:0px!important; }
			.me-auto{ width:100%!important; padding:8px; }
		</style>
		<div class="page-wrapper">
			<div class="page-content">
				<div class="row ">
					<div class="card">
							<div class="card-body1">
								<ul class="nav nav-tabs nav-success" role="tablist">
									<li class="nav-item" role="presentation">
										<a class="nav-link active" data-bs-toggle="tab" href="#successhome" role="tab" aria-selected="true">
											<div class="d-flex align-items-center">
												<div class="tab-icon"><i class="bx bx-file font-18 me-1"></i>
												</div>
												<div class="tab-title">Details</div>
											</div>
										</a>
									</li>
									<li class="nav-item" role="presentation">
										<a class="nav-link" data-bs-toggle="tab" href="#successprofile" role="tab" aria-selected="false" tabindex="-1">
											<div class="d-flex align-items-center">
												<div class="tab-icon"><i class="bx bx-history font-18 me-1"></i>
												</div>
												<div class="tab-title">History</div>
											</div>
										</a>
									</li>
									<li class="nav-item" role="presentation">
										<a class="nav-link" data-bs-toggle="tab" href="#successcontact" role="tab" aria-selected="false" tabindex="-1">
											<div class="d-flex align-items-center">
												<div class="tab-icon"><i class="bx bx-menu font-18 me-1"></i>
												</div>
												<div class="tab-title">Task</div>
											</div>
										</a>
									</li>
								</ul>
								<div class="tab-content py-3">
									<div class="tab-pane fade active show" id="successhome" role="tabpanel">
										<div class="card">
									<div class="card-body">
										<div class="d-flex flex-column align-items-center text-center">
											<!-- <img src="assets/images/avatars/avatar-2.png" alt="Admin" class="rounded-circle p-1 bg-primary" width="110"> -->
											<div class="mt-3">
												<h4><?php echo $data->owner_name; ?></h4>
												<p class="text-secondary mb-1"><?php echo $data->company_name; ?></p>
												<p class="text-muted font-size-sm"><?php echo $data->address; ?></p>
												<p class="text-muted font-size-sm"><i class="bx bx-mail-send"></i> <?php echo $data->email; ?></p>
												<p class="text-muted font-size-sm"><i class="bx bx-mobile"></i> <?php echo $data->mobile_no; ?></p>
												<a href="tel:<?php echo $data->mobile_no; ?>" class="btn btn-primary btn-sm"><i class="bx bx-phone-outgoing"></i></a>
												
											</div>
										</div>
										<hr class="my-4">
										<ul class="list-group list-group-flush">
											<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
												<h6 class="mb-0"><span class="text-primary"> Assign To: </span> <?php $assignTo=get_row('users',' where id='.$data->assign_to); echo $assignTo->name; ?></h6>
												
											</li>
											<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
												<h6 class="mb-0"><span class="text-primary"> Added By: </span><?php $createdBy=get_row('users',' where id='.$data->created_by); echo $createdBy->name; ?></h6>
												
											</li>
											<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
												<h6 class="mb-0"><span class="text-primary"> Source: </span><?php $source=get_row('master_table',' where id='.$data->source_id); echo $source->name; ?></h6>
												
											</li>
											<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
												<h6 class="mb-0"><span class="text-primary"> Refrence: </span><?php echo $data->refrence; ?></h6>
												
											</li>
											<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
												<h6 class="mb-0"><span class="text-primary"> Description: </span><?php echo $data->description; ?></h6>
												
											</li>
											
											
											
											
										</ul>
									</div>
								</div>
									</div>
									<div class="tab-pane fade" id="successprofile" role="tabpanel">
									<div class="row">
      
      <div class="col-md-12 col-lg-12">
         <div id="tracking-pre"></div>
         <div id="tracking">
            
            <div class="tracking-list">
            	<?php $result=get_all_list('lead_status_log',' where lead_id='.$data->id.' order by id asc'); ?>
            	<?php foreach($result as $row){ ?>
               <div class="tracking-item">
                  <div class="tracking-icon status-intransit">
                     <img style="width:35px;" src="<?php echo base_url(); ?>assets/backend/images/button.png">
                     <!-- <i class="fas fa-circle"></i> -->
                  </div>
                  <div class="tracking-date"><?php echo date('M, d Y',strtotime($row->created_at)); ?><span><?php echo date('h:i a',strtotime($row->created_at)); ?></span></div>
                  <p><strong>User:</strong> <?php $createdBy=get_row('users',' where id='.$data->created_by); echo $createdBy->name; ?></p>
                  <p><strong>Status:</strong> <span class="text-success"><?php $status=get_row('master_table',' where id='.$data->status_id); echo $status->name; ?></span></p>
                  <p><strong>Schedule:<?php echo date("d-M-Y h:i a",strtotime($row->next_followup)); ?></strong> </p>
                  <p>Remark:<?php echo $row->remark; ?> </p>

                                 </div>
              <?php } ?>
               
            </div>
         </div>
      </div>
   </div>
									</div>
									<div class="tab-pane fade" id="successcontact" role="tabpanel">
										<p></p>
									</div>
								</div>
							</div>
						</div>
				</div>
		</div>
		<!--end page wrapper -->
		<!--start overlay-->
		<div class="overlay toggle-icon"></div>
		<!--end overlay-->
		<!--Start Back To Top Button-->
		<a href="<?php echo base_url(); ?>javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
		<!--End Back To Top Button-->
		<footer class="page-footer">
			<p class="mb-0"><button onclick="window.location.href='<?php echo base_url(); ?>Leads/add'" class="btn  btn-success"><i class="bx bx-plus"></i>Add New Lead</button></p>
		</footer>
	</div>
	<!--end wrapper-->


	<?php $this->load->view('Template/script_include'); ?>
	<script src="https://code.highcharts.com/highcharts.js"></script>
	<script src="https://code.highcharts.com/modules/data.js"></script>
	<script src="https://code.highcharts.com/modules/drilldown.js"></script>
	<script src="https://code.highcharts.com/modules/exporting.js"></script>
	<script src="https://code.highcharts.com/modules/export-data.js"></script>
	<script src="https://code.highcharts.com/modules/accessibility.js"></script>
	<script>
		Highcharts.chart('leadbystatus', {
			chart: {
				type: 'column'
			},
			title: {
				align: 'left',
				text: 'Lead status'
			},
			subtitle: {
				align: 'left',
       // text: 'Click the columns to view versions. Source: <a href="http://statcounter.com" target="_blank">statcounter.com</a>'
			},
			accessibility: {
				announceNewData: {
					enabled: true
				}
			},
			xAxis: {
				type: 'category'
			},
			yAxis: {
				title: {
           // text: 'Total percent market share'
				}

			},
			legend: {
				enabled: false
			},
			plotOptions: {
				series: {
					borderWidth: 0,
					dataLabels: {
						enabled: true,
						format: '{point.y:.1f}%'
					}
				}
			},

			tooltip: {
				headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
				pointFormat: '<span style="color:{point.color}">{point.name}</span>: ' +
				'<b>{point.y:.2f}%</b> of total<br/>'
			},

			series: [
			{
				name: 'Leads',
				colorByPoint: true,
				data: [
				{
					name: 'Fresh Lead',
					y: 63.06,
                    //drilldown: 'Chrome'
				},
				{
					name: 'Network Failed',
					y: 19.84,
                    //drilldown: 'Safari'
				},
				{
					name: 'Call Not receive',
					y: 4.18,
                   // drilldown: 'Firefox'
				},
				{
					name: 'Floow up',
					y: 4.12,
                    //drilldown: 'Edge'
				},
				{
					name: 'Document Share',
					y: 2.33,
                   // drilldown: 'Opera'
				},
				{
					name: 'Other',
					y: 0.45,
                    //drilldown: 'Internet Explorer'
				},
				{
					name: 'Not Interested',
					y: 1.582,
					drilldown: null
				},
				{
					name: 'Meeting Done',
					y: 0.45,
                    //drilldown: 'Internet Explorer'
				},
				{
					name: 'Number Blocked',
					y: 0.45,
                    //drilldown: 'Internet Explorer'
				},
				]
			}
			],
			drilldown: {
				breadcrumbs: {
					position: {
						align: 'right'
					}
				},
				series: [
				{
					name: 'Chrome',
					id: 'Chrome',
					data: [
						[
							'v65.0',
							0.1
							],
						[
							'v64.0',
							1.3
							],
						[
							'v63.0',
							53.02
							],
						[
							'v62.0',
							1.4
							],
						[
							'v61.0',
							0.88
							],
						[
							'v60.0',
							0.56
							],
						[
							'v59.0',
							0.45
							],
						[
							'v58.0',
							0.49
							],
						[
							'v57.0',
							0.32
							],
						[
							'v56.0',
							0.29
							],
						[
							'v55.0',
							0.79
							],
						[
							'v54.0',
							0.18
							],
						[
							'v51.0',
							0.13
							],
						[
							'v49.0',
							2.16
							],
						[
							'v48.0',
							0.13
							],
						[
							'v47.0',
							0.11
							],
						[
							'v43.0',
							0.17
							],
						[
							'v29.0',
							0.26
							]
						]
				},
				{
					name: 'Firefox',
					id: 'Firefox',
					data: [
						[
							'v58.0',
							1.02
							],
						[
							'v57.0',
							7.36
							],
						[
							'v56.0',
							0.35
							],
						[
							'v55.0',
							0.11
							],
						[
							'v54.0',
							0.1
							],
						[
							'v52.0',
							0.95
							],
						[
							'v51.0',
							0.15
							],
						[
							'v50.0',
							0.1
							],
						[
							'v48.0',
							0.31
							],
						[
							'v47.0',
							0.12
							]
						]
				},
				{
					name: 'Internet Explorer',
					id: 'Internet Explorer',
					data: [
						[
							'v11.0',
							6.2
							],
						[
							'v10.0',
							0.29
							],
						[
							'v9.0',
							0.27
							],
						[
							'v8.0',
							0.47
							]
						]
				},
				{
					name: 'Safari',
					id: 'Safari',
					data: [
						[
							'v11.0',
							3.39
							],
						[
							'v10.1',
							0.96
							],
						[
							'v10.0',
							0.36
							],
						[
							'v9.1',
							0.54
							],
						[
							'v9.0',
							0.13
							],
						[
							'v5.1',
							0.2
							]
						]
				},
				{
					name: 'Edge',
					id: 'Edge',
					data: [
						[
							'v16',
							2.6
							],
						[
							'v15',
							0.92
							],
						[
							'v14',
							0.4
							],
						[
							'v13',
							0.1
							]
						]
				},
				{
					name: 'Opera',
					id: 'Opera',
					data: [
						[
							'v50.0',
							0.96
							],
						[
							'v49.0',
							0.82
							],
						[
							'v12.1',
							0.14
							]
						]
				}
				]
			}
		});



Highcharts.chart('leadbysource', {
	chart: {
		type: 'pie',
		options3d: {
			enabled: true,
			alpha: 45,
			beta: 0
		},
	},
	title: {
		text: 'Lead by Source',
		align: 'left'
	},
	subtitle: {
        // text: 'Source: ' + '<a href="https://www.counterpointresearch.com/global-smartphone-share/"' +
        //     'target="_blank">Counterpoint Research</a>',
		align: 'left'
	},
	accessibility: {
		point: {
			valueSuffix: '%'
		},

	},
	tooltip: {
		pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
	},
	
	plotOptions: {
		pie: {
			allowPointSelect: true,
			cursor: 'pointer',
			depth: 35,
			dataLabels: {
				enabled: true,
				format: '{point.name}'
			},
			showInLegend: true

		}
	},
	series: [{
		type: 'pie',
		name: 'Share',
		data: [
			['Newspaper', 23],
			['Calling', 18],
			['Refrence', 9],
			['Self Call', 8],
			['GMB', 30],
			['Known', 30]
			]
	}]
});

</script>


<style>
	.highcharts-credits{ display:none; }
	
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
 font-size:.9rem;
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
 color:#e5e5e5;
 border:1px solid #e5e5e5;
 font-size:.6rem
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
p{ margin-bottom:0px!important; }
</style>
</body>



</html>