<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg">
<?php $this->load->view('Template/head',$data); ?>

<body>
    <?php  
        $date  = date("Y-m-d");
        $date2 = date('Y-m-d', strtotime($date.' + 1 day')); 
    ?>
    <div class="main-wrapper">
        <!-- Header -->
        <div class="header shadow-sm">
            <?php $this->load->view('Template/header',$data); ?>

            <!-- Page Wrapper -->
            <div class="page-wrapper">
                <div class="content container-fluid pb-0">
                    <?php $this->load->view('Template/page_header',$data); ?>

                    <!-- DASHBOARD SECTION -->
                    <div class="dashboard-container">
                        <div class="row g-4">
                            <!-- Existing Cards -->
                            <div class="col-md-3 col-sm-6">
                                <div class="dashboard-card gradient7">
                                    <h4>Total Users</h4>
                                    <p class="number">1,245</p>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="dashboard-card gradient1">
                                    <h4>Closed Leads</h4>
                                    <p class="number">325</p>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="dashboard-card gradient2">
                                    <h4>Hot Leads</h4>
                                    <p class="number">₹85,450</p>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="dashboard-card gradient3">
                                    <h4>Total Leads</h4>
                                    <p class="number">45</p>
                                </div>
                            </div>

                            <!-- NEW STATUS CARDS -->
                            <div class="col-md-3 col-sm-6">
                                <div class="dashboard-card gradient4">
                                    <h4>Pending</h4>
                                    <p class="number">62</p>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="dashboard-card gradient5">
                                    <h4>Follow-ups</h4>
                                    <p class="number">120</p>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="dashboard-card gradient6">
                                    <h4>Interested</h4>
                                    <p class="number">78</p>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="dashboard-card gradient7">
                                    <h4>Not Interested</h4>
                                    <p class="number">40</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END DASHBOARD -->
                </div>
            </div>
        </div>

        <!-- Theme Customizer -->
        <div class="offcanvas offcanvas-end border-0" tabindex="-1" id="theme-settings-offcanvas">
            <div class="sidebar-headerset">
                <div class="sidebar-headersets">
                    <h2>Customizer</h2>
                    <h6 class="text-muted">Personalize your dashboard</h6>
                </div>
                <div class="sidebar-headerclose">
                    <a data-bs-dismiss="offcanvas" aria-label="Close">
                        <img src="assets/img/close.png" alt="Close">
                    </a>
                </div>
            </div>
            <div class="offcanvas-body p-3">
                <?php /* your layout customizer code remains here */ ?>
            </div>
            <div class="offcanvas-footer border-top p-3 text-center">
                <button type="button" class="btn btn-light w-100 bor-rad-50" id="reset-layout">Reset to Default</button>
            </div>
        </div>

        <!-- Footer -->
        <?php $this->load->view('Template/footer',$data); ?>
    </div>

    <!-- INTERNAL CSS -->
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, sans-serif;
            background: #f7f9fc;
            color: #333;
        }
        .dashboard-container {
            margin-top: 20px;
        }
        .dashboard-card {
            background: #fff;
            border-radius: 15px;
            padding: 25px;
            text-align: center;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(0,0,0,0.12);
        }
        .dashboard-card h4 {
            font-size: 16px;
            margin-bottom: 10px;
            color: #f0f0f0;
        }
        .dashboard-card .number {
            font-size: 28px;
            font-weight: bold;
            color: #fff;
        }
        /* Gradient Styles */
        .gradient1 { background: linear-gradient(135deg,#6a11cb,#2575fc); }
        .gradient2 { background: linear-gradient(135deg,#11998e,#38ef7d); }
        .gradient3 { background: linear-gradient(135deg,#f7971e,#ffd200); }
        .gradient4 { background: linear-gradient(135deg,#ff416c,#ff4b2b); }
        .gradient5 { background: linear-gradient(135deg,#00b09b,#96c93d); }
        .gradient6 { background: linear-gradient(135deg,#4776e6,#8e54e9); }
        .gradient7 { background: linear-gradient(135deg,#232526,#414345); }
        /* Box Section */
        .dashboard-box {
            background: #fff;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        }
        .dashboard-box h5 {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 15px;
        }
        .notif-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .notif-list li {
            padding: 10px;
            border-bottom: 1px solid #eee;
            font-size: 14px;
        }
        .notif-list li:last-child {
            border-bottom: none;
        }
        /* Customizer tweaks */
        h6.fs-12 { font-size: 12px; color:#555; }
        .card-radio img { border-radius:8px; border:1px solid #ddd; }
        .card-radio input:checked + label { border:2px solid #007bff; }
    </style>
</body>
</html>
