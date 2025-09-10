<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Title -->
    <title>Travelocopeia </title>
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/frontend/css/bootstrap.min.css" />
    <!-- animate css -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/frontend/css/animate.min.css" />
    <!-- Fontawesome css -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/frontend/css/fontawesome.all.min.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/frontend/cdn.jsdelivr.net/npm/bootstrap-icons%401.8.2/font/bootstrap-icons.css">
    <!-- owl.carousel css -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/frontend/css/owl.carousel.min.css" />
    <!-- owl.theme.default css -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/frontend/css/owl.theme.default.min.css" />
    <!-- navber css -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/frontend/css/navber.css" />
    <!-- meanmenu css -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/frontend/css/meanmenu.css" />
    <!-- Style css -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/frontend/css/style.css" />
    <!-- Responsive css -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/frontend/css/responsive.css" />
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?php echo base_url(); ?>assets/frontend/img/favicon.png">
</head>

<body>
    <!-- preloader Area -->
    <?php //$this->load->view('common/preloader'); ?>

    <!-- Header Area -->
   <?php $this->load->view('common/header'); ?>

    <!-- search -->
    <?php $this->load->view('common/search_overlay'); ?>
  
<?php 

$url=$this->uri->segment(1);
if($url)
{
     switch($url)
     {
            case 'about-us':
             $this->load->view('about_us');
             break;
             case 'india':
                 $this->load->view('india');
                 break;
             default:
             $this->load->view('listing');
             break;
     }
}
else
{
    $this->load->view('home_page');
}

?>
   

    <!-- Footer  -->
    <footer id="footer_area">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="footer_heading_area">
                        <h5>Need any help?</h5>
                    </div>
                    <div class="footer_first_area">
                        <div class="footer_inquery_area">
                            <h5>Call 24/7 for any help</h5>
                            <h3> <a href="tel:+00-123-456-789">+00 123 456 789</a></h3>
                        </div>
                        <div class="footer_inquery_area">
                            <h5>Mail to our support team</h5>
                            <h3> <a href="mailto:support@domain.com">travelocopeia@gmail.com</a></h3>
                        </div>
                        <div class="footer_inquery_area">
                            <h5>Follow us on</h5>
                            <ul class="soical_icon_footer">
                                <li><a href="#!"><i class="fab fa-facebook"></i></a></li>
                                <li><a href="#!"><i class="fab fa-twitter-square"></i></a></li>
                                <li><a href="#!"><i class="fab fa-instagram"></i></a></li>
                                <li><a href="#!"><i class="fab fa-linkedin"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 offset-lg-1 col-md-6 col-sm-6 col-12">
                    <div class="footer_heading_area">
                        <h5>Company</h5>
                    </div>
                    <div class="footer_link_area">
                        <ul>
                            <li><a href="about.html">About Us</a></li>
                            <li><a href="testimonials.html">Testimonials</a></li>
                            <li><a href="faqs.html">Rewards</a></li>
                            <li><a href="terms-service.html">Work with Us</a></li>
                            <li><a href="tour-guides.html">Meet the Team </a></li>
                            <li><a href="news.html">Blog</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6 col-12">
                    <div class="footer_heading_area">
                        <h5>Support</h5>
                    </div>
                    <div class="footer_link_area">
                        <ul>
                            <li><a href="dashboard.html">Account</a></li>
                            <li><a href="faq.html">Faq</a></li>
                            <li><a href="testimonials.html">Legal</a></li>
                            <li><a href="contact.html">Contact</a></li>
                            <li><a href="top-destinations.html"> Affiliate Program</a></li>
                            <li><a href="privacy-policy.html">Privacy Policy</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6 col-12">
                    <div class="footer_heading_area">
                        <h5>Other Services</h5>
                    </div>
                    <div class="footer_link_area">
                        <ul>
                            <li><a href="top-destinations-details.html">Community program</a></li>
                            <li><a href="top-destinations-details.html">Investor Relations</a></li>
                            <li><a href="flight-search-result.html">Rewards Program</a></li>
                            <li><a href="room-booking.html">PointsPLUS</a></li>
                            <li><a href="testimonials.html">Partners</a></li>
                            <li><a href="hotel-search.html">List My Hotel</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6 col-12">
                    <div class="footer_heading_area">
                        <h5>Top cities</h5>
                    </div>
                    <div class="footer_link_area">
                        <ul>
                            <li><a href="room-details.html">Chicago</a></li>
                            <li><a href="hotel-details.html">New York</a></li>
                            <li><a href="hotel-booking.html">San Francisco</a></li>
                            <li><a href="tour-search.html">California</a></li>
                            <li><a href="tour-booking.html">Ohio </a></li>
                            <li><a href="tour-guides.html">Alaska</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <div class="copyright_area">
        <div class="container">
            <div class="row align-items-center">
                <div class="co-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="copyright_left">
                        <p>Copyright © 2022 All Rights Reserved</p>
                    </div>
                </div>
                <div class="co-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="copyright_right">
                        <img src="<?php echo base_url(); ?>assets/frontend/img/common/cards.png" alt="img">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="go-top">
        <i class="fas fa-chevron-up"></i>
        <i class="fas fa-chevron-up"></i>
    </div>

    <script src="<?php echo base_url(); ?>assets/frontend/js/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap js -->
    <script src="<?php echo base_url(); ?>assets/frontend/js/bootstrap.bundle.js"></script>
    <!-- Meanu js -->
    <script src="<?php echo base_url(); ?>assets/frontend/js/jquery.meanmenu.js"></script>
    <!-- owl carousel js -->
    <script src="<?php echo base_url(); ?>assets/frontend/js/owl.carousel.min.js"></script>
    <!-- wow.js -->
    <script src="<?php echo base_url(); ?>assets/frontend/js/wow.min.js"></script>
    <!-- Custom js -->
    <script src="<?php echo base_url(); ?>assets/frontend/js/custom.js"></script>
    <script src="<?php echo base_url(); ?>assets/frontend/js/add-form.js"></script>
    <script src="<?php echo base_url(); ?>assets/frontend/js/form-dropdown.js"></script>
</body>



</html>