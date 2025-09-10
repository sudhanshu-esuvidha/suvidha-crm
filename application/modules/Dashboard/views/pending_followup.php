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
				<div class="row row-cols-1 row-cols-md-2 row-cols-xl-2 row-cols-xxl-4">
					<div class="col-md-6">
						<div class="card   bg-gradient">
							<div class="card-body d-flex" style="padding: 3px;">
								<div style="width:20%;" class="bg-primary  ">
									<div class="d-flex align-items-center">
										<div class="me-auto text-center">

											<p class="my-1 text-white">08 July 2024 06:34 PM</p>

										</div>

									</div>

								</div>

								<div style="width:80%; margin-left:5px;" class="bg-dark   ">
									<div class="d-flex ">
										<div class="me-auto ">

											<p class="my-1 text-white text-center"> Customer Name</p>
											<p class="my-1 text-white "> <i class="bx bx-phone"></i> 7987529462</p>
											<p class="my-1 text-white "> <i class="bx bx-user"></i> Company Owner Name</p>
											<p class="my-1 text-white "> <i class="bx bx-phone-outgoing"></i> Last Call:No Answering</p>
											<p class="my-1 text-white "> <i class="bx bx-book"></i> 8 Jun 2023</p>

										</div>
									</div>

								</div>
							</div>
						</div>

					</div>					<div class="col-md-6">
						<div class="card   bg-gradient">
							<div class="card-body d-flex" style="padding: 3px;">
								<div style="width:20%;" class="bg-primary  ">
									<div class="d-flex align-items-center">
										<div class="me-auto text-center">

											<p class="my-1 text-white">08 July 2024 06:34 PM</p>

										</div>

									</div>

								</div>

								<div style="width:80%; margin-left:5px;" class="bg-dark   ">
									<div class="d-flex ">
										<div class="me-auto ">

											<p class="my-1 text-white text-center"> Customer Name</p>
											<p class="my-1 text-white "> <span class="font-225 text-primary"><i class="bx bx-phone"></i> </span> 7987529462 <span onclick="window.location.href='<?php echo base_url(); ?>Dashboard/lead_details'" style="float:right; font-size: 20px; cursor: pointer;" class="pull-right"><i class="bx bx-show"></i></span></p>
											<p class="my-1 text-white "> <i class="bx bx-user"></i> Company Owner Name</p>
											<p class="my-1 text-white "> <i class="bx bx-phone-outgoing"></i> Last Call:No Answering</p>
											<p class="my-1 text-white "> <i class="bx bx-book"></i> 8 Jun 2023</p>

										</div>
									</div>

								</div>
							</div>
						</div>

					</div>
					<div class="col-md-6">
						<div class="card   bg-gradient">
							<div class="card-body d-flex" style="padding: 3px;">
								<div style="width:20%;" class="bg-primary  ">
									<div class="d-flex align-items-center">
										<div class="me-auto text-center">

											<p class="my-1 text-white">08 July 2024 06:34 PM</p>

										</div>

									</div>

								</div>

								<div style="width:80%; margin-left:5px;" class="bg-dark   ">
									<div class="d-flex ">
										<div class="me-auto ">

											<p class="my-1 text-white text-center"> Customer Name</p>
											<p class="my-1 text-white "> <i class="bx bx-phone"></i> 7987529462</p>
											<p class="my-1 text-white "> <i class="bx bx-user"></i> Company Owner Name</p>
											<p class="my-1 text-white "> <i class="bx bx-phone-outgoing"></i> Last Call:No Answering</p>
											<p class="my-1 text-white "> <i class="bx bx-book"></i> 8 Jun 2023</p>

										</div>
									</div>

								</div>
							</div>
						</div>

					</div>

					<div class="col-md-6">
						<div class="card   bg-gradient">
							<div class="card-body d-flex" style="padding: 3px;">
								<div style="width:20%;" class="bg-primary  ">
									<div class="d-flex align-items-center">
										<div class="me-auto text-center">

											<p class="my-1 text-white">08 July 2024 06:34 PM</p>

										</div>

									</div>

								</div>

								<div style="width:80%; margin-left:5px;" class="bg-dark   ">
									<div class="d-flex ">
										<div class="me-auto ">

											<p class="my-1 text-white text-center"> Customer Name</p>
											<p class="my-1 text-white "> <i class="bx bx-phone"></i> 7987529462</p>
											<p class="my-1 text-white "> <i class="bx bx-user"></i> Company Owner Name</p>
											<p class="my-1 text-white "> <i class="bx bx-phone-outgoing"></i> Last Call:No Answering</p>
											<p class="my-1 text-white "> <i class="bx bx-book"></i> 8 Jun 2023</p>

										</div>
									</div>

								</div>
							</div>
						</div>

					</div><!--end row-->
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
			<p class="mb-0"></p>
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
</style>
	
</body>



</html>