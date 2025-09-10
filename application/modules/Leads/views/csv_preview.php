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
                        <?php //$this->load->view('Template/page_header',$data); ?>
                        <div class="page-header">
                            <div class="row">
                                <div class="col-md-12">
                                    <button onclick="window.history.back()" class="btn  btn-primary btn-sm">
                                        <i class="fas fa-arrow-left "></i>
                                    </button>
                                    <button style="display:none;" id="loaderBtn" type="button" class="btn btn-warning btn-sm"><i class="fas fa-spinner fa-spin me-2"></i>Loading Please Wait...</button>
                                    <button id="approveBtn"  onclick="approve_csv()" class="btn  btn-success btn-sm">
                                        <i class="fas fa-thumbs-up "></i> Approve & Upload
                                    </button>
                                    <button onclick="window.history.back()" class="btn  btn-danger btn-sm">
                                        <i class="fas fa-ban "></i> Cancel & Back
                                    </button>
                                </div>


                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xxl-4 col-lg-12 col-md-12 d-flex">
                                <div class="card1 flex-fill">
                                    <div class="card-body">

                                        <div class="notification-tab">

                                            <div class="tab-content">
                                                <div class="tab-pane active show" id="notification_tab" role="tabpanel">
                                                    <div class="employee-noti-content">
                                                        <ul class="employee-notification-list" id="list">
                                                            <?php foreach($result as $key=> $row){  if($key>0){

                                                            ?>
                                                            <li class="employee-notification-grid">

                                                                <div class="employee-notification-content">
                                                                    <h6>
                                                                        <a href="javascript:void(0)" >
                                                                            <?php echo ucwords($row[0]); ?>

                                                                            <span  class="badge bg-primary pull-right"> <i class="la la-phone-volume"></i>  <?php echo $row[2]; ?> </span>
                                                                        </a> 
                                                                    </h6>
                                                                    <ul class="nav">
                                                                        <li>Email Id : <?php echo $row[1]; ?></li>

                                                                    </ul>
                                                                    <ul class="nav">
                                                                        <li>Course : <?php echo $row[4]; ?></li>
                                                                        <li>(<?php echo $row[3]; ?>)</li>
                                                                    </ul>

                                                                    <ul class="nav">
                                                                     <li>Source : <?php echo $row[5];  ?></li>

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

                     </div>
                 </div>
             </div>

         </div>




         <?php //$this->load->view('Template/settings',$data); ?>
         <?php $this->load->view('Template/footer',$data); ?>
         <script type="text/javascript" src="http://code.jquery.com/jquery-1.10.0.min.js"></script>
         <script>
          


            function approve_csv()
            {
                $("#approveBtn").hide();
                $("#loaderBtn").show();
                $.ajax({
                            url:"<?php echo base_url(); ?>Leads/approve_csv",
                            type: "POST",
                            data:{id:<?php echo $this->uri->segment(3); ?>},
                            success:function(data)
                            {
                                
                                window.location.href="<?php echo base_url(); ?>Leads/list"
                            }
                        });
            }
          
        </script>
       


        <!-- Modal -->
        <div id="uploadCsvModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
            <div class="modal-dialog">
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
        <style>
            .counter-box{ width:50%; }
            .employee-notification-content{width:100%!important;}
            .pull-right{ float:right; }
        </style>
    </body>


    </html>