<!DOCTYPE html>
<html lang="en">



<head>
    <title>The Travel - Tour Travel</title>
    <!--== META TAGS ==-->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- FAV ICON -->
    <link rel="shortcut icon" href="<?php echo base_url(); ?>front/images/fav.ico">
    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Poppins%7CQuicksand:400,500,700" rel="stylesheet">
    <!-- FONT-AWESOME ICON CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>front/css/font-awesome.min.css">
    <!--== ALL CSS FILES ==-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>front/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>front/css/jquery-ui.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>front/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>front/css/mob.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>front/css/animate.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="<?php echo base_url(); ?>front/js/html5shiv.js"></script>
  <script src="<?php echo base_url(); ?>front/js/respond.min.js"></script>
  <![endif]-->
</head>

<body>
    <!-- Preloader -->
    <div id="preloader">
        <div id="status">&nbsp;</div>
    </div>
    <div class="pop-bg"></div>

    <!-- MOBILE MENU -->
  <?php $this->load->view('common/mobile_menu'); ?>
    <!--HEADER SECTION-->
    <?php $this->load->view('common/header'); ?>
    
    <!--END HEADER SECTION-->

    <!--HEADER SECTION-->
    <section>
        <div class="tourz-search">
            <div class="container">
                <div class="row">
                    <div class="tourz-search-1">
                        <h1>Plan Your Travel Now!</h1>
                        <p>650+ Travel Agents serving 65+ Destinations worldwide</p>
                        <div class="ban-search form-select pop pop-search">
                            <form>
                                <ul>
                                    <li class="sr-look">
                                        <div class="form-group">
                                            <label>Your destination</label>
                                            <select class="chosen-select">
                                                <option>Your destination</option>
                                                <option>Any location</option>
                                                <option>Chennai</option>
                                                <option>New york</option>
                                                <option>Perth</option>
                                                <option>London</option>
                                            </select>
                                        </div>
                                    </li>
                                    <li class="sr-gue">
                                        <div class="form-group">
                                            <label>Package</label>
                                            <select class="chosen-select">
                                                <option>Package</option>
                                                <option>Family Package</option>
                                                <option>Honeymoon Package</option>
                                                <option>Group Package</option>
                                                <option>WeekEnd Package</option>
                                                <option>Regular Package</option>
                                            </select>
                                        </div>
                                    </li>
                                    <li class="sr-date">
                                        <div class="form-group">
                                            <label>Age</label>
                                            <input type="text" class="form-control datepicker" name="from" placeholder="Check in">
                                        </div>
                                    </li>
                                    <li class="sr-date">
                                        <div class="form-group">
                                            <label>Age</label>
                                            <input type="text" class="form-control datepicker" name="to" placeholder="Check out">
                                        </div>
                                    </li>
                                    <li class="sr-btn">
                                        <input type="submit" value="Search">
                                    </li>
                                </ul>
                            </form>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--END HEADER SECTION-->

    <section>
        <div class="rows tb-space pad-bot-redu tb-space">
            <div class="container">
                <div class="tourz-hom-ser">
                    <ul class="slider-all">
                        <li>
                            <div class="hom-quick-acc hom-quick-acc-1">
                                <h2>Book your<span>Travel package</span></h2>
                                <a href="<?php echo base_url(); ?>front/booking-tour-package.html" class="cta-1">Book now</a>
                                <img src="<?php echo base_url(); ?>front/images/home-1.png" loading="lazy" alt="">
                            </div>
                        </li>
                        <li>
                            <div class="hom-quick-acc hom-quick-acc-2">
                                <h2>Book your<span>Car Rentals</span></h2>
                                <a href="<?php echo base_url(); ?>front/booking-car-rentals.html" class="cta-1">Book now</a>
                                <img src="<?php echo base_url(); ?>front/images/home-2.png" loading="lazy" alt="">
                            </div>
                        </li>
                        <li>
                            <div class="hom-quick-acc hom-quick-acc-3">
                                <h2>Explore<span>Destinations </span></h2>
                                <a href="<?php echo base_url(); ?>front/destinations.html" class="cta-1">Explore</a>
                                <img src="<?php echo base_url(); ?>front/images/home-3.png" loading="lazy" alt="">
                            </div>
                        </li>
                        <li>
                            <div class="hom-quick-acc hom-quick-acc-4">
                                <h2>Over 30,000+<span>Hotels</span></h2>
                                <a href="<?php echo base_url(); ?>front/hotels-list.html" class="cta-1">Book now</a>
                                <img src="<?php echo base_url(); ?>front/images/home-4.png" loading="lazy" alt="">
                            </div>
                        </li>
                        <li>
                            <div class="hom-quick-acc hom-quick-acc-5">
                                <h2>Travel Events <span>Events</span></h2>
                                <a href="<?php echo base_url(); ?>front/events.html" class="cta-1">Explore</a>
                                <img src="<?php echo base_url(); ?>front/images/home-5.png" loading="lazy" alt="">
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!--====== HOME HOTELS ==========-->
    <section>
        <div class="rows pad-bot-redu">
            <div class="container">
                <!-- TITLE & DESCRIPTION -->
                <div class="spe-title">
                    <h2>Top <span>Destinations</span> </h2>
                    <div class="title-line">
                        <div class="tl-1"></div>
                        <div class="tl-2"></div>
                        <div class="tl-3"></div>
                    </div>
                    <p>World's leading Hotel Booking website,Over 30,000 Hotel rooms worldwide.</p>
                </div>
                <!-- CITY -->
                <div class="col-md-6">
                    <a href="<?php echo base_url(); ?>front/tour-details.html">
                        <div class="tour-mig-like-com">
                            <div class="tour-mig-lc-img"> <img src="<?php echo base_url(); ?>front/images/listing/home.jpg" alt=""> </div>
                            <div class="tour-mig-lc-con">
                                <h5>Europe</h5>
                                <p><span>12 Packages</span> Starting from $2400</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="<?php echo base_url(); ?>front/tour-details.html">
                        <div class="tour-mig-like-com">
                            <div class="tour-mig-lc-img"> <img src="<?php echo base_url(); ?>front/images/listing/home3.jpg" alt=""> </div>
                            <div class="tour-mig-lc-con tour-mig-lc-con2">
                                <h5>Dubai</h5>
                                <p>Starting from $2400</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="<?php echo base_url(); ?>front/tour-details.html">
                        <div class="tour-mig-like-com">
                            <div class="tour-mig-lc-img"> <img src="<?php echo base_url(); ?>front/images/listing/home2.jpg" alt=""> </div>
                            <div class="tour-mig-lc-con tour-mig-lc-con2">
                                <h5>India</h5>
                                <p>Starting from $2400</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="<?php echo base_url(); ?>front/tour-details.html">
                        <div class="tour-mig-like-com">
                            <div class="tour-mig-lc-img"> <img src="<?php echo base_url(); ?>front/images/listing/home1.jpg" alt=""> </div>
                            <div class="tour-mig-lc-con tour-mig-lc-con2">
                                <h5>Usa</h5>
                                <p>Starting from $2400</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="<?php echo base_url(); ?>front/tour-details.html">
                        <div class="tour-mig-like-com">
                            <div class="tour-mig-lc-img"> <img src="<?php echo base_url(); ?>front/images/listing/home4.jpg" alt=""> </div>
                            <div class="tour-mig-lc-con tour-mig-lc-con2">
                                <h5>London</h5>
                                <p>Starting from $2400</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="rows pad-bot-redu">
            <div class="container">
                <!-- TITLE & DESCRIPTION -->
                <div class="spe-title">
                    <h2>Tour <span>Packages</span></h2>
                    <div class="title-line">
                        <div class="tl-1"></div>
                        <div class="tl-2"></div>
                        <div class="tl-3"></div>
                    </div>
                    <p>World's leading tour and travels Booking website,Over 30,000 packages worldwide.</p>
                </div>
                <!-- HOTEL GRID -->
                <div class="to-ho-hotel">
                    <ul class="multiple-items">
                        <li class="col-md-4">
                            <div class="to-ho-hotel-con pack-new-box">
                                <div class="to-ho-hotel-con-1">
                                    <img src="<?php echo base_url(); ?>front/images/places/8.jpg" alt="">
                                    <div class="hom-pack-deta">
                                        <h2>Family package</h2>
                                        <h4><span>20+</span> destinations</h4>
                                        <span class="cta-2">Book now</span>
                                    </div>
                                </div>
                                <a href="<?php echo base_url(); ?>front/hotel-details.html" class="fclick"></a>
                            </div>
                        </li>
                        <li class="col-md-4">
                            <div class="to-ho-hotel-con pack-new-box">
                                <div class="to-ho-hotel-con-1">
                                    <img src="<?php echo base_url(); ?>front/images/places/7.jpg" alt="">
                                    <div class="hom-pack-deta">
                                        <h2>Honeymoon package</h2>
                                        <h4><span>20+</span> destinations</h4>
                                        <span class="cta-2">Book now</span>
                                    </div>
                                </div>
                                <a href="<?php echo base_url(); ?>front/hotel-details.html" class="fclick"></a>
                            </div>
                        </li>
                        <li class="col-md-4">
                            <div class="to-ho-hotel-con pack-new-box">
                                <div class="to-ho-hotel-con-1">
                                    <img src="<?php echo base_url(); ?>front/images/places/12.jpg" alt="">
                                    <div class="hom-pack-deta">
                                        <h2>Group package</h2>
                                        <h4><span>20+</span> destinations</h4>
                                        <span class="cta-2">Book now</span>
                                    </div>
                                </div>
                                <a href="<?php echo base_url(); ?>front/hotel-details.html" class="fclick"></a>
                            </div>
                        </li>
                        <li class="col-md-4">
                            <div class="to-ho-hotel-con pack-new-box">
                                <div class="to-ho-hotel-con-1">
                                    <img src="<?php echo base_url(); ?>front/images/places/4.jpg" alt="">
                                    <div class="hom-pack-deta">
                                        <h2>Friends package</h2>
                                        <h4><span>20+</span> destinations</h4>
                                        <span class="cta-2">Book now</span>
                                    </div>
                                </div>
                                <a href="<?php echo base_url(); ?>front/hotel-details.html" class="fclick"></a>
                            </div>
                        </li>
                        <li class="col-md-4">
                            <div class="to-ho-hotel-con pack-new-box">
                                <div class="to-ho-hotel-con-1">
                                    <img src="<?php echo base_url(); ?>front/images/places/2.jpg" alt="">
                                    <div class="hom-pack-deta">
                                        <h2>Solo package</h2>
                                        <h4><span>20+</span> destinations</h4>
                                        <span class="cta-2">Book now</span>
                                    </div>
                                </div>
                                <a href="<?php echo base_url(); ?>front/hotel-details.html" class="fclick"></a>
                            </div>
                        </li>
                        <li class="col-md-4">
                            <div class="to-ho-hotel-con pack-new-box">
                                <div class="to-ho-hotel-con-1">
                                    <img src="<?php echo base_url(); ?>front/images/places/18.jpg" alt="">
                                    <div class="hom-pack-deta">
                                        <h2>Adventure package</h2>
                                        <h4><span>20+</span> destinations</h4>
                                        <span class="cta-2">Book now</span>
                                    </div>
                                </div>
                                <a href="<?php echo base_url(); ?>front/hotel-details.html" class="fclick"></a>
                            </div>
                        </li>
                        <li class="col-md-4">
                            <div class="to-ho-hotel-con pack-new-box">
                                <div class="to-ho-hotel-con-1">
                                    <img src="<?php echo base_url(); ?>front/images/places/11.jpg" alt="">
                                    <div class="hom-pack-deta">
                                        <h2>Religious package</h2>
                                        <h4><span>20+</span> destinations</h4>
                                        <span class="cta-2">Book now</span>
                                    </div>
                                </div>
                                <a href="<?php echo base_url(); ?>front/hotel-details.html" class="fclick"></a>
                            </div>
                        </li>
                        <li class="col-md-4">
                            <div class="to-ho-hotel-con pack-new-box">
                                <div class="to-ho-hotel-con-1">
                                    <img src="<?php echo base_url(); ?>front/images/places/1.jpg" alt="">
                                    <div class="hom-pack-deta">
                                        <h2>Water sports package</h2>
                                        <h4><span>20+</span> destinations</h4>
                                        <span class="cta-2">Book now</span>
                                    </div>
                                </div>
                                <a href="<?php echo base_url(); ?>front/hotel-details.html" class="fclick"></a>
                            </div>
                        </li>
                        
                    </ul>
                </div>
            </div>
        </div>
    </section>
    
    <!--====== HOME HOTELS ==========-->
    <section>
        <div class="rows hom-hotels tb-space pad-top-o">
            <div class="container">
                <!-- TITLE & DESCRIPTION -->
                <div class="spe-title">
                    <h2>Popular <span>Destinations</span> </h2>
                    <div class="title-line">
                        <div class="tl-1"></div>
                        <div class="tl-2"></div>
                        <div class="tl-3"></div>
                    </div>
                    <p>World's leading Hotel Booking website,Over 30,000 Hotel rooms worldwide.</p>
                </div>
                <!-- HOTEL GRID -->
                <div class="to-ho-hotel">
                    <ul class="multiple-items7">
                        <li class="col-md-4">
                            <div class="plac-hom-box">
                                <div class="plac-hom-box-im">
                                    <img src="<?php echo base_url(); ?>front/images/places/10.jpg" alt="" loading="lazy">
                                    <h4>Taj Mahal</h4>
                                </div>
                                <div class="plac-hom-box-txt">
                                    <span>Symbol of love</span>
                                    <span>More details</span>
                                </div>
                                <a href="<?php echo base_url(); ?>front/destinations.html" class="fclick"></a>
                            </div>
                        </li>
                        <li class="col-md-4">
                            <div class="plac-hom-box">
                                <div class="plac-hom-box-im">
                                    <img src="<?php echo base_url(); ?>front/images/places/11.jpg" alt="" loading="lazy">
                                    <h4>Open House</h4>
                                </div>
                                <div class="plac-hom-box-txt">
                                    <span>Beach & Historical</span>
                                    <span>More details</span>
                                </div>
                                <a href="<?php echo base_url(); ?>front/destinations.html" class="fclick"></a>
                            </div>
                        </li>
                        <li class="col-md-4">
                            <div class="plac-hom-box">
                                <div class="plac-hom-box-im">
                                    <img src="<?php echo base_url(); ?>front/images/places/19.jpg" alt="" loading="lazy">
                                    <h4>Eiffel Tower</h4>
                                </div>
                                <div class="plac-hom-box-txt">
                                    <span>Historical places</span>
                                    <span>More details</span>
                                </div>
                                <a href="<?php echo base_url(); ?>front/destinations.html" class="fclick"></a>
                            </div>
                        </li>
                        <li class="col-md-4">
                            <div class="plac-hom-box">
                                <div class="plac-hom-box-im">
                                    <img src="<?php echo base_url(); ?>front/images/places/17.jpg" alt="" loading="lazy">
                                    <h4>Rio de Janeiro</h4>
                                </div>
                                <div class="plac-hom-box-txt">
                                    <span>Historical places</span>
                                    <span class="cta-3-sml">More details</span>
                                </div>
                                <a href="<?php echo base_url(); ?>front/destinations.html" class="fclick"></a>
                            </div>
                        </li>
                        <li class="col-md-4">
                            <div class="plac-hom-box">
                                <div class="plac-hom-box-im">
                                    <img src="<?php echo base_url(); ?>front/images/places/18.jpg" alt="" loading="lazy">
                                    <h4>Mauritius</h4>
                                </div>
                                <div class="plac-hom-box-txt">
                                    <span>Beach places</span>
                                    <span>More details</span>
                                </div>
                                <a href="<?php echo base_url(); ?>front/destinations.html" class="fclick"></a>
                            </div>
                        </li>
                        <li class="col-md-4">
                            <div class="plac-hom-box">
                                <div class="plac-hom-box-im">
                                    <img src="<?php echo base_url(); ?>front/images/places/22.jpg" alt="" loading="lazy">
                                    <h4>Burj khalifa</h4>
                                </div>
                                <div class="plac-hom-box-txt">
                                    <span>Modern architecture</span>
                                    <span>More details</span>
                                </div>
                                <a href="<?php echo base_url(); ?>front/destinations.html" class="fclick"></a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--====== SECTION: FREE CONSULTANT ==========-->
    <section>
        <div class="offer">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="offer-l"> <span class="ol-1"></span> <span class="ol-2"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></span> <span class="ol-4">Standardized Budget Packages</span>                            <span class="ol-3"></span> <span class="ol-5">$99/-</span>
                            <ul>
                                <li class="wow fadeInUp" data-wow-duration="0.5s">
                                    <a href="<?php echo base_url(); ?>front/#!" class="waves-effect waves-light btn-large offer-btn"><img src="<?php echo base_url(); ?>front/images/icon/dis1.png" alt="">
                  </a><span>Free WiFi</span>
                                </li>
                                <li class="wow fadeInUp" data-wow-duration="0.7s">
                                    <a href="<?php echo base_url(); ?>front/#!" class="waves-effect waves-light btn-large offer-btn"><img src="<?php echo base_url(); ?>front/images/icon/dis2.png" alt=""> </a><span>Breakfast</span>
                                </li>
                                <li class="wow fadeInUp" data-wow-duration="0.9s">
                                    <a href="<?php echo base_url(); ?>front/#!" class="waves-effect waves-light btn-large offer-btn"><img src="<?php echo base_url(); ?>front/images/icon/dis3.png" alt=""> </a><span>Pool</span>
                                </li>
                                <li class="wow fadeInUp" data-wow-duration="1.1s">
                                    <a href="<?php echo base_url(); ?>front/#!" class="waves-effect waves-light btn-large offer-btn"><img src="<?php echo base_url(); ?>front/images/icon/dis4.png" alt=""> </a><span>Television</span>
                                </li>
                                <li class="wow fadeInUp" data-wow-duration="1.3s">
                                    <a href="<?php echo base_url(); ?>front/#!" class="waves-effect waves-light btn-large offer-btn"><img src="<?php echo base_url(); ?>front/images/icon/dis5.png" alt=""> </a><span>GYM</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="offer-r">
                            <div class="or-1"> <span class="or-11">go</span> <span class="or-12">Stays</span> </div>
                            <div class="or-2"> <span class="or-21">Get</span> <span class="or-22">70%</span> <span class="or-23">Off</span> <span class="or-24">use code: RG5481WERQ</span> <span class="or-25"></span> </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--====== EVENTS ==========-->
    <!--<section>
        <div class="rows tb-space">
            <div class="container events events-1" id="inner-page-title">
               
                <div class="spe-title">
                    <h2>Top <span>Events</span> in this month</h2>
                    <div class="title-line">
                        <div class="tl-1"></div>
                        <div class="tl-2"></div>
                        <div class="tl-3"></div>
                    </div>
                    <p>World's leading tour and travels Booking website,Over 30,000 packages worldwide. Book travel packages and enjoy your holidays with distinctive experience</p>
                </div>
                <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search Event Name.." title="Type in a name">
                <table id="myTable">
                    <tbody>
                        <tr>
                            <th>#</th>
                            <th>Event Name</th>
                            <th class="e_h1">Date</th>
                            <th class="e_h1">Time</th>
                            <th class="e_h1">Location</th>
                            <th>Book</th>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td><img src="<?php echo base_url(); ?>front/images/iplace-1.jpg" alt="" /><a href="<?php echo base_url(); ?>front/hotels-list.html" class="events-title">Taj Mahal,Agra, India</a> </td>
                            <td class="e_h1">16.12.2016</td>
                            <td class="e_h1">10.00 PM</td>
                            <td class="e_h1">Australia</td>
                            <td><a href="<?php echo base_url(); ?>front/booking.html" class="link-btn">Book Now</a> </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td><img src="<?php echo base_url(); ?>front/images/iplace-2.jpg" alt="" /><a href="<?php echo base_url(); ?>front/hotels-list.html" class="events-title">Salesforce Summer, Dubai</a> </td>
                            <td class="e_h1">16.12.2016</td>
                            <td class="e_h1">10.00 PM</td>
                            <td class="e_h1">Dubai</td>
                            <td><a href="<?php echo base_url(); ?>front/booking.html" class="link-btn">Book Now</a> </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td><img src="<?php echo base_url(); ?>front/images/iplace-3.jpg" alt="" /><a href="<?php echo base_url(); ?>front/hotels-list.html" class="events-title">God Towers, TOKYO, JAPAN</a> </td>
                            <td class="e_h1">16.12.2016</td>
                            <td class="e_h1">10.00 PM</td>
                            <td class="e_h1">JAPAN</td>
                            <td><a href="<?php echo base_url(); ?>front/booking.html" class="link-btn">Book Now</a> </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td><img src="<?php echo base_url(); ?>front/images/iplace-4.jpg" alt="" /><a href="<?php echo base_url(); ?>front/hotels-list.html" class="events-title">TOUR DE ROMANDIE, Switzerland</a> </td>
                            <td class="e_h1">16.12.2016</td>
                            <td class="e_h1">10.00 PM</td>
                            <td class="e_h1">Switzerland</td>
                            <td><a href="<?php echo base_url(); ?>front/booking.html" class="link-btn">Book Now</a> </td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td><img src="<?php echo base_url(); ?>front/images/iplace-5.jpg" alt="" /><a href="<?php echo base_url(); ?>front/hotels-list.html" class="events-title">TOUR DE POLOGNE, Poland</a> </td>
                            <td class="e_h1">16.12.2016</td>
                            <td class="e_h1">10.00 PM</td>
                            <td class="e_h1">Poland</td>
                            <td><a href="<?php echo base_url(); ?>front/booking.html" class="link-btn">Book Now</a> </td>
                        </tr>
                        <tr>
                            <td>6</td>
                            <td><img src="<?php echo base_url(); ?>front/images/iplace-6.jpg" alt="" /><a href="<?php echo base_url(); ?>front/hotels-list.html" class="events-title">Future of Marketing,Sydney, Australia</a> </td>
                            <td class="e_h1">16.12.2016</td>
                            <td class="e_h1">10.00 PM</td>
                            <td class="e_h1">Australia</td>
                            <td><a href="<?php echo base_url(); ?>front/booking.html" class="link-btn">Book Now</a> </td>
                        </tr>
                        <tr>
                            <td>7</td>
                            <td><img src="<?php echo base_url(); ?>front/images/iplace-7.jpg" alt="" /><a href="<?php echo base_url(); ?>front/hotels-list.html" class="events-title">Eiffel Tower, Paris</a> </td>
                            <td class="e_h1">16.12.2016</td>
                            <td class="e_h1">10.00 PM</td>
                            <td class="e_h1">France</td>
                            <td><a href="<?php echo base_url(); ?>front/booking.html" class="link-btn">Book Now</a> </td>
                        </tr>
                        <tr>
                            <td>8</td>
                            <td><img src="<?php echo base_url(); ?>front/images/iplace-8.jpg" alt="" /><a href="<?php echo base_url(); ?>front/hotels-list.html" class="events-title">PARIS - ROUBAIX, England</a> </td>
                            <td class="e_h1">16.12.2016</td>
                            <td class="e_h1">10.00 PM</td>
                            <td class="e_h1">England</td>
                            <td><a href="<?php echo base_url(); ?>front/booking.html" class="link-btn">Book Now</a> </td>
                        </tr>
                        <tr>
                            <td>9</td>
                            <td><img src="<?php echo base_url(); ?>front/images/iplace-9.jpg" alt="" /><a href="<?php echo base_url(); ?>front/hotels-list.html" class="events-title">Dubai Beach Resort, Dubai</a> </td>
                            <td class="e_h1">16.12.2016</td>
                            <td class="e_h1">10.00 PM</td>
                            <td class="e_h1">Dubai</td>
                            <td><a href="<?php echo base_url(); ?>front/booking.html" class="link-btn">Book Now</a> </td>
                        </tr>
                        <tr>
                            <td>10</td>
                            <td><img src="<?php echo base_url(); ?>front/images/iplace-4.jpg" alt="" /><a href="<?php echo base_url(); ?>front/hotels-list.html" class="events-title">TOUR DE POLOGNE, Poland</a> </td>
                            <td class="e_h1">16.12.2016</td>
                            <td class="e_h1">10.00 PM</td>
                            <td class="e_h1">Poland</td>
                            <td><a href="<?php echo base_url(); ?>front/booking.html" class="link-btn">Book Now</a> </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>-->
    <!--====== POPULAR TOUR PLACES ==========-->
    <section>
        <div class="rows pla pad-bot-redu tb-space">
            <div class="pla1 p-home container">
                <!-- TITLE & DESCRIPTION -->
                <div class="spe-title spe-title-1">
                    <h2>Top <span>Sight Seeing</span> in this month</h2>
                    <div class="title-line">
                        <div class="tl-1"></div>
                        <div class="tl-2"></div>
                        <div class="tl-3"></div>
                    </div>
                    <p>World's leading tour and travels Booking website,Over 30,000 packages worldwide. Book travel packages and enjoy your holidays with distinctive experience</p>
                </div>
                <div class="popu-places-home">
                    <!-- POPULAR PLACES 1 -->
                    <div class="col-md-6 col-sm-6 col-xs-12 place">
                        <div class="col-md-6 col-sm-12 col-xs-12"> <img src="<?php echo base_url(); ?>front/images/place2.jpg" alt="" /> </div>
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <h3><span>Honeymoon Package</span> 7 Days / 6 Nights</h3>
                            <p>lorem ipsum simplelorem ipsum simplelorem ipsum simplelorem ipsum simple</p> <a href="<?php echo base_url(); ?>front/tour-details.html" class="link-btn">more info</a> </div>
                    </div>
                    <!-- POPULAR PLACES 2 -->
                    <div class="col-md-6 col-sm-6 col-xs-12 place">
                        <div class="col-md-6 col-sm-12 col-xs-12"> <img src="<?php echo base_url(); ?>front/images/place1.jpg" alt="" /> </div>
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <h3><span>Family package</span> 14 Days / 13 Nights</h3>
                            <p>lorem ipsum simplelorem ipsum simplelorem ipsum simplelorem ipsum simple</p> <a href="<?php echo base_url(); ?>front/tour-details.html" class="link-btn">more info</a> </div>
                    </div>
                </div>
                <div class="popu-places-home">
                    <!-- POPULAR PLACES 3 -->
                    <div class="col-md-6 col-sm-6 col-xs-12 place">
                        <div class="col-md-6 col-sm-12 col-xs-12"> <img src="<?php echo base_url(); ?>front/images/place3.jpg" alt="" /> </div>
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <h3><span>Weekend Package </span> 3 Days / 2 Nights</h3>
                            <p>lorem ipsum simplelorem ipsum simplelorem ipsum simplelorem ipsum simple</p> <a href="<?php echo base_url(); ?>front/tour-details.html" class="link-btn">more info</a> </div>
                    </div>
                    <!-- POPULAR PLACES 4 -->
                    <div class="col-md-6 col-sm-6 col-xs-12 place">
                        <div class="col-md-6 col-sm-12 col-xs-12"> <img src="<?php echo base_url(); ?>front/images/place4.jpg" alt="" /> </div>
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <h3><span>Group Package</span> 10 Days / 9 Nights</h3>
                            <p>lorem ipsum simplelorem ipsum simplelorem ipsum simplelorem ipsum simple</p> <a href="<?php echo base_url(); ?>front/tour-details.html" class="link-btn">more info</a> </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--====== REQUEST A QUOTE ==========-->
    <section>
        <div class="ho-popu tb-space pad-bot-redu">
            <div class="rows container">
                <!-- TITLE & DESCRIPTION -->
                <div class="spe-title">
                    <h2>Top <span>Branding</span> for this month</h2>
                    <div class="title-line">
                        <div class="tl-1"></div>
                        <div class="tl-2"></div>
                        <div class="tl-3"></div>
                    </div>
                    <p>Book travel packages and enjoy your holidays with distinctive experience</p>
                </div>
                <div class="ho-popu-bod">
                    <div class="col-md-4">
                        <div class="hot-page2-hom-pre-head">
                            <h4>Top Branding <span>Hotels</span></h4>
                        </div>
                        <div class="hot-page2-hom-pre">
                            <ul>
                                <!--LISTINGS-->
                                <li>
                                    <a href="<?php echo base_url(); ?>front/hotels-list.html">
                                        <div class="hot-page2-hom-pre-1"> <img src="<?php echo base_url(); ?>front/images/hotels/1.jpg" alt=""> </div>
                                        <div class="hot-page2-hom-pre-2">
                                            <h5>Taaj Club House</h5> <span>City: illunois, United States</span> </div>
                                        <div class="hot-page2-hom-pre-3"> <span>4.5</span> </div>
                                    </a>
                                </li>
                                <!--LISTINGS-->
                                <li>
                                    <a href="<?php echo base_url(); ?>front/hotels-list.html">
                                        <div class="hot-page2-hom-pre-1"> <img src="<?php echo base_url(); ?>front/images/hotels/2.jpg" alt=""> </div>
                                        <div class="hot-page2-hom-pre-2">
                                            <h5>Universal luxury Grand Hotel</h5> <span>City: Rio,Brazil</span> </div>
                                        <div class="hot-page2-hom-pre-3"> <span>4.2</span> </div>
                                    </a>
                                </li>
                                <!--LISTINGS-->
                                <li>
                                    <a href="<?php echo base_url(); ?>front/hotels-list.html">
                                        <div class="hot-page2-hom-pre-1"> <img src="<?php echo base_url(); ?>front/images/hotels/3.jpg" alt=""> </div>
                                        <div class="hot-page2-hom-pre-2">
                                            <h5>Barcelona Grand Pales</h5> <span>City: Chennai,India</span> </div>
                                        <div class="hot-page2-hom-pre-3"> <span>5.0</span> </div>
                                    </a>
                                </li>
                                <!--LISTINGS-->
                                <li>
                                    <a href="<?php echo base_url(); ?>front/hotels-list.html">
                                        <div class="hot-page2-hom-pre-1"> <img src="<?php echo base_url(); ?>front/images/hotels/4.jpg" alt=""> </div>
                                        <div class="hot-page2-hom-pre-2">
                                            <h5>Lake Palace view Hotel</h5> <span>City: Beijing,China</span> </div>
                                        <div class="hot-page2-hom-pre-3"> <span>2.5</span> </div>
                                    </a>
                                </li>
                                <!--LISTINGS-->
                                <li>
                                    <a href="<?php echo base_url(); ?>front/hotels-list.html">
                                        <div class="hot-page2-hom-pre-1"> <img src="<?php echo base_url(); ?>front/images/hotels/8.jpg" alt=""> </div>
                                        <div class="hot-page2-hom-pre-2">
                                            <h5>First Class Grandd Hotel</h5> <span>City: Berlin,Germany</span> </div>
                                        <div class="hot-page2-hom-pre-3"> <span>4.0</span> </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="hot-page2-hom-pre-head">
                            <h4>Top Branding <span>Packages</span></h4>
                        </div>
                        <div class="hot-page2-hom-pre">
                            <ul>
                                <!--LISTINGS-->
                                <li>
                                    <a href="<?php echo base_url(); ?>front/hotels-list.html">
                                        <div class="hot-page2-hom-pre-1"> <img src="<?php echo base_url(); ?>front/images/trends/1.jpg" alt=""> </div>
                                        <div class="hot-page2-hom-pre-2">
                                            <h5>Family Package Luxury</h5> <span>Duration: 7 Days and 6 Nights</span> </div>
                                        <div class="hot-page2-hom-pre-3"> <span>4.1</span> </div>
                                    </a>
                                </li>
                                <!--LISTINGS-->
                                <li>
                                    <a href="<?php echo base_url(); ?>front/hotels-list.html">
                                        <div class="hot-page2-hom-pre-1"> <img src="<?php echo base_url(); ?>front/images/trends/2.jpg" alt=""> </div>
                                        <div class="hot-page2-hom-pre-2">
                                            <h5>Honeymoon Package Luxury</h5> <span>Duration: 14 Days and 13 Nights</span> </div>
                                        <div class="hot-page2-hom-pre-3"> <span>4.4</span> </div>
                                    </a>
                                </li>
                                <!--LISTINGS-->
                                <li>
                                    <a href="<?php echo base_url(); ?>front/hotels-list.html">
                                        <div class="hot-page2-hom-pre-1"> <img src="<?php echo base_url(); ?>front/images/trends/3.jpg" alt=""> </div>
                                        <div class="hot-page2-hom-pre-2">
                                            <h5>Group Package Luxury</h5> <span>Duration: 28 Days and 29 Nights</span> </div>
                                        <div class="hot-page2-hom-pre-3"> <span>3.0</span> </div>
                                    </a>
                                </li>
                                <!--LISTINGS-->
                                <li>
                                    <a href="<?php echo base_url(); ?>front/hotels-list.html">
                                        <div class="hot-page2-hom-pre-1"> <img src="<?php echo base_url(); ?>front/images/trends/4.jpg" alt=""> </div>
                                        <div class="hot-page2-hom-pre-2">
                                            <h5>Regular Package Luxury</h5> <span>Duration: 12 Days and 11 Nights</span> </div>
                                        <div class="hot-page2-hom-pre-3"> <span>3.5</span> </div>
                                    </a>
                                </li>
                                <!--LISTINGS-->
                                <li>
                                    <a href="<?php echo base_url(); ?>front/hotels-list.html">
                                        <div class="hot-page2-hom-pre-1"> <img src="<?php echo base_url(); ?>front/images/trends/1.jpg" alt=""> </div>
                                        <div class="hot-page2-hom-pre-2">
                                            <h5>Custom Package Luxury</h5> <span>Duration: 10 Days and 10 Nights</span> </div>
                                        <div class="hot-page2-hom-pre-3"> <span>5.0</span> </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="hot-page2-hom-pre-head">
                            <h4>Top Branding <span>Reviewers</span></h4>
                        </div>
                        <div class="hot-page2-hom-pre">
                            <ul>
                                <!--LISTINGS-->
                                <li>
                                    <a href="<?php echo base_url(); ?>front/hotels-list.html">
                                        <div class="hot-page2-hom-pre-1"> <img src="<?php echo base_url(); ?>front/images/reviewer/1.jpg" alt=""> </div>
                                        <div class="hot-page2-hom-pre-2">
                                            <h5>Christopher</h5> <span>No of Reviews: 620, City: illunois</span> </div>
                                        <div class="hot-page2-hom-pre-3"> <i class="fa fa-hand-o-right" aria-hidden="true"></i> </div>
                                    </a>
                                </li>
                                <!--LISTINGS-->
                                <li>
                                    <a href="<?php echo base_url(); ?>front/hotels-list.html">
                                        <div class="hot-page2-hom-pre-1"> <img src="<?php echo base_url(); ?>front/images/reviewer/2.png" alt=""> </div>
                                        <div class="hot-page2-hom-pre-2">
                                            <h5>Matthew</h5> <span>No of Reviews: 48, City: Rio</span> </div>
                                        <div class="hot-page2-hom-pre-3"> <i class="fa fa-hand-o-right" aria-hidden="true"></i> </div>
                                    </a>
                                </li>
                                <!--LISTINGS-->
                                <li>
                                    <a href="<?php echo base_url(); ?>front/hotels-list.html">
                                        <div class="hot-page2-hom-pre-1"> <img src="<?php echo base_url(); ?>front/images/reviewer/3.jpg" alt=""> </div>
                                        <div class="hot-page2-hom-pre-2">
                                            <h5>Stephanie</h5> <span>No of Reviews: 560, City: Chennai</span> </div>
                                        <div class="hot-page2-hom-pre-3"> <i class="fa fa-hand-o-right" aria-hidden="true"></i> </div>
                                    </a>
                                </li>
                                <!--LISTINGS-->
                                <li>
                                    <a href="<?php echo base_url(); ?>front/hotels-list.html">
                                        <div class="hot-page2-hom-pre-1"> <img src="<?php echo base_url(); ?>front/images/reviewer/4.jpg" alt=""> </div>
                                        <div class="hot-page2-hom-pre-2">
                                            <h5>Robert</h5> <span>No of Reviews: 920, City: Beijing</span> </div>
                                        <div class="hot-page2-hom-pre-3"> <i class="fa fa-hand-o-right" aria-hidden="true"></i> </div>
                                    </a>
                                </li>
                                <!--LISTINGS-->
                                <li>
                                    <a href="<?php echo base_url(); ?>front/hotels-list.html">
                                        <div class="hot-page2-hom-pre-1"> <img src="<?php echo base_url(); ?>front/images/reviewer/5.jpg" alt=""> </div>
                                        <div class="hot-page2-hom-pre-2">
                                            <h5>Danielle</h5> <span>No of Reviews: 768, City: Berlin</span> </div>
                                        <div class="hot-page2-hom-pre-3"> <i class="fa fa-hand-o-right" aria-hidden="true"></i> </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--====== REQUEST A QUOTE ==========-->
    <section>
        <div class="foot-mob-sec tb-space">
            <div class="rows container">
                <!-- FAMILY IMAGE(YOU CAN USE ANY PNG IMAGE) -->
                <div class="col-md-6 col-sm-6 col-xs-12 family"> <img src="<?php echo base_url(); ?>front/images/mobile.png" alt="" /> </div>
                <!-- REQUEST A QUOTE -->
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <!-- THANK YOU MESSAGE -->
                    <div class="foot-mob-app">
                        <h2>Have you tried our mobile app?</h2>
                        <p>World's leading tour and travels Booking website,Over 30,000 packages worldwide. Book travel packages and enjoy your holidays with distinctive experience</p>
                        <ul>
                            <li><i class="fa fa-check" aria-hidden="true"></i> Easy Hotel Booking</li>
                            <li><i class="fa fa-check" aria-hidden="true"></i> Tour and Travel Packages</li>
                            <li><i class="fa fa-check" aria-hidden="true"></i> Package Reviews and Ratings</li>
                            <li><i class="fa fa-check" aria-hidden="true"></i> Manage your Bookings, Enquiry and Reviews</li>
                        </ul>
                        <a href="<?php echo base_url(); ?>front/#"><img src="<?php echo base_url(); ?>front/images/android.png" alt=""> </a>
                        <a href="<?php echo base_url(); ?>front/#"><img src="<?php echo base_url(); ?>front/images/apple.png" alt=""> </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--====== REQUEST A QUOTE ==========-->
    <!--<section>
        <div class="form tb-space">
            <div class="rows container">
                <div class="spe-title">
                    <h2>Book your <span>favourite Package</span> Now!</h2>
                    <div class="title-line">
                        <div class="tl-1"></div>
                        <div class="tl-2"></div>
                        <div class="tl-3"></div>
                    </div>
                    <p>World's leading tour and travels Booking website,Over 30,000 packages worldwide. Book travel packages and enjoy your holidays with distinctive experience</p>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12 form_1">
                    <div class="succ_mess">Thank you for contacting us we will get back to you soon.</div>
                    <form id="home_form" name="home_form" action="mail/send.php">
                        <ul>
                            <li>
                                <input type="text" name="ename" value="" id="ename" placeholder="Name" required>
                            </li>
                            <li>
                                <input type="tel" name="emobile" value="" id="emobile" placeholder="Mobile" required>
                            </li>
                            <li>
                                <input type="email" name="eemail" value="" id="eemail" placeholder="Email id" required>
                            </li>
                            <li>
                                <input type="text" name="esubject" value="" id="esubject" placeholder="Subject" required>
                            </li>
                            <li>
                                <input type="text" name="ecity" value="" id="ecity" placeholder="City" required>
                            </li>
                            <li>
                                <input type="text" name="ecount" value="" id="ecount" placeholder="Country" required>
                            </li>
                            <li>
                                <textarea name="emess" cols="40" rows="3" id="text-comment" placeholder="Enter your message"></textarea>
                            </li>
                            <li>
                                <input type="submit" value="Submit" id="send_button">
                            </li>
                        </ul>
                    </form>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12 family">
                    <img src="<?php echo base_url(); ?>front/images/family.png" alt="" />
                </div>
            </div>
        </div>
    </section>-->
    <!--====== TIPS BEFORE TRAVEL ==========-->
    <section>
        <div class="rows tips tips-home tb-space home_title">
            <div class="container tips_1">
                <!-- TIPS BEFORE TRAVEL -->
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <h3>Tips Before Travel</h3>
                    <div class="tips_left tips_left_1">
                        <h5>Bring copies of your passport</h5>
                        <p>Aliquam pretium id justo eget tristique. Aenean feugiat vestibulum blandit.</p>
                    </div>
                    <div class="tips_left tips_left_2">
                        <h5>Register with your embassy</h5>
                        <p>Mauris efficitur, ante sit amet rhoncus malesuada, orci justo sollicitudin.</p>
                    </div>
                    <div class="tips_left tips_left_3">
                        <h5>Always have local cash</h5>
                        <p>Donec et placerat ante. Etiam et velit in massa. </p>
                    </div>
                </div>
                <!-- CUSTOMER TESTIMONIALS -->
                <div class="col-md-8 col-sm-6 col-xs-12 testi-2">
                    <!-- TESTIMONIAL TITLE -->
                    <h3>Customer Testimonials</h3>
                    <div class="testi">
                        <h4>John William</h4>
                        <p>Ut sed sem quis magna ultricies lacinia et sed tortor. Ut non tincidunt nisi, non elementum lorem. Aliquam gravida sodales</p> <address>Illinois, United States of America</address> </div>
                    <!-- ARRANGEMENTS & HELPS -->
                    <h3>Arrangement & Helps</h3>
                    <div class="arrange">
                        <ul>
                            <!-- LOCATION MANAGER -->
                            <li>
                                <a href="<?php echo base_url(); ?>front/#"><img src="<?php echo base_url(); ?>front/images/Location-Manager.png" alt=""> </a>
                            </li>
                            <!-- PRIVATE GUIDE -->
                            <li>
                                <a href="<?php echo base_url(); ?>front/#"><img src="<?php echo base_url(); ?>front/images/Private-Guide.png" alt=""> </a>
                            </li>
                            <!-- ARRANGEMENTS -->
                            <li>
                                <a href="<?php echo base_url(); ?>front/#"><img src="<?php echo base_url(); ?>front/images/Arrangements.png" alt=""> </a>
                            </li>
                            <!-- EVENT ACTIVITIES -->
                            <li>
                                <a href="<?php echo base_url(); ?>front/#"><img src="<?php echo base_url(); ?>front/images/Events-Activities.png" alt=""> </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--====== FOOTER 1 ==========-->
    <section>
        <div class="rows">
            <div class="footer1 home_title tb-space">
                <div class="pla1 container">
                    <!-- FOOTER OFFER 1 -->
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="disco">
                            <h3>30%<span>OFF</span></h3>
                            <h4>Eiffel Tower,Rome</h4>
                            <p>valid only for 24th Dec</p> <a href="<?php echo base_url(); ?>front/booking.html">Book Now</a> </div>
                    </div>
                    <!-- FOOTER OFFER 2 -->
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="disco1 disco">
                            <h3>42%<span>OFF</span></h3>
                            <h4>Colosseum,Burj Al Arab</h4>
                            <p>valid only for 18th Nov</p> <a href="<?php echo base_url(); ?>front/booking.html">Book Now</a> </div>
                    </div>
                    <!-- FOOTER MOST POPULAR VACATIONS -->
                    <div class="col-md-6 col-sm-12 col-xs-12 foot-spec footer_places">
                        <h4><span>Most Popular</span> Vacations</h4>
                        <ul>
                            <li><a href="<?php echo base_url(); ?>front/tour-details.html">Angkor Wat</a> </li>
                            <li><a href="<?php echo base_url(); ?>front/tour-details.html">Buckingham Palace</a> </li>
                            <li><a href="<?php echo base_url(); ?>front/tour-details.html">High Line</a> </li>
                            <li><a href="<?php echo base_url(); ?>front/tour-details.html">Sagrada Família</a> </li>
                            <li><a href="<?php echo base_url(); ?>front/tour-details.html">Statue of Liberty </a> </li>
                            <li><a href="<?php echo base_url(); ?>front/tour-details.html">Notre Dame de Paris</a> </li>
                            <li><a href="<?php echo base_url(); ?>front/tour-details.html">Taj Mahal</a> </li>
                            <li><a href="<?php echo base_url(); ?>front/tour-details.html">The Louvre</a> </li>
                            <li><a href="<?php echo base_url(); ?>front/tour-details.html">Tate Modern, London</a> </li>
                            <li><a href="<?php echo base_url(); ?>front/tour-details.html">Gothic Quarter</a> </li>
                            <li><a href="<?php echo base_url(); ?>front/tour-details.html">Table Mountain</a> </li>
                            <li><a href="<?php echo base_url(); ?>front/tour-details.html">Bayon</a> </li>
                            <li><a href="<?php echo base_url(); ?>front/tour-details.html">Great Wall of China</a> </li>
                            <li><a href="<?php echo base_url(); ?>front/tour-details.html">Hermitage Museum</a> </li>
                            <li><a href="<?php echo base_url(); ?>front/tour-details.html">Yellowstone</a> </li>
                            <li><a href="<?php echo base_url(); ?>front/tour-details.html">Musée d'Orsay</a> </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--====== FOOTER 2 ==========-->
    <section>
        <div class="rows">
            <div class="footer">
                <div class="container">
                    <div class="foot-sec2">
                        <div>
                            <div class="row">
                                <div class="col-sm-3 foot-spec foot-com">
                                    <h4><span>Holiday</span> Tour & Travels</h4>
                                    <p>World's leading tour and travels Booking website,Over 30,000 packages worldwide.</p>
                                </div>
                                <div class="col-sm-3 foot-spec foot-com">
                                    <h4><span>Address</span> & Contact Info</h4>
                                    <p>28800 Orchard Lake Road, Suite 180 Farmington Hills, U.S.A. Landmark : Next To Airport</p>
                                    <p> <span class="strong">Phone: </span> <span class="highlighted">+101-1231-1231</span> </p>
                                </div>
                                <div class="col-sm-3 col-md-3 foot-spec foot-com">
                                    <h4><span>SUPPORT</span> & HELP</h4>
                                    <ul class="two-columns">
                                        <li> <a href="<?php echo base_url(); ?>front/#">About Us</a> </li>
                                        <li> <a href="<?php echo base_url(); ?>front/#">FAQ</a> </li>
                                        <li> <a href="<?php echo base_url(); ?>front/#">Feedbacks</a> </li>
                                        <li> <a href="<?php echo base_url(); ?>front/#">Blog </a> </li>
                                        <li> <a href="<?php echo base_url(); ?>front/#">Use Cases</a> </li>
                                        <li> <a href="<?php echo base_url(); ?>front/#">Advertise us</a> </li>
                                        <li> <a href="<?php echo base_url(); ?>front/#">Discount</a> </li>
                                        <li> <a href="<?php echo base_url(); ?>front/#">Vacations</a> </li>
                                        <li> <a href="<?php echo base_url(); ?>front/#">Branding Offers </a> </li>
                                        <li> <a href="<?php echo base_url(); ?>front/#">Contact Us</a> </li>
                                    </ul>
                                </div>
                                <div class="col-sm-3 foot-social foot-spec foot-com">
                                    <h4><span>Follow</span> with us</h4>
                                    <p>Join the thousands of other There are many variations of passages of Lorem Ipsum available</p>
                                    <ul>
                                        <li><a href="<?php echo base_url(); ?>front/#"><i class="fa fa-facebook" aria-hidden="true"></i></a> </li>
                                        <li><a href="<?php echo base_url(); ?>front/#"><i class="fa fa-google-plus" aria-hidden="true"></i></a> </li>
                                        <li><a href="<?php echo base_url(); ?>front/#"><i class="fa fa-twitter" aria-hidden="true"></i></a> </li>
                                        <li><a href="<?php echo base_url(); ?>front/#"><i class="fa fa-linkedin" aria-hidden="true"></i></a> </li>
                                        <li><a href="<?php echo base_url(); ?>front/#"><i class="fa fa-youtube" aria-hidden="true"></i></a> </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--====== FOOTER - COPYRIGHT ==========-->
    <section>
        <div class="rows copy">
            <div class="container">
                <p>Copyrights © 2023 Company Name. All Rights Reserved</p>
            </div>
        </div>
    </section>
    <section>
        <div class="icon-float">
            <ul>
                <li><a href="<?php echo base_url(); ?>front/#" class="sh">1k <br> Share</a> </li>
                <li><a href="<?php echo base_url(); ?>front/#" class="fb1"><i class="fa fa-facebook" aria-hidden="true"></i></a> </li>
                <li><a href="<?php echo base_url(); ?>front/#" class="gp1"><i class="fa fa-google-plus" aria-hidden="true"></i></a> </li>
                <li><a href="<?php echo base_url(); ?>front/#" class="tw1"><i class="fa fa-twitter" aria-hidden="true"></i></a> </li>
                <li><a href="<?php echo base_url(); ?>front/#" class="li1"><i class="fa fa-linkedin" aria-hidden="true"></i></a> </li>
                <li><a href="<?php echo base_url(); ?>front/#" class="wa1"><i class="fa fa-whatsapp" aria-hidden="true"></i></a> </li>
                <li><a href="<?php echo base_url(); ?>front/#" class="sh1"><i class="fa fa-envelope-o" aria-hidden="true"></i></a> </li>
            </ul>
        </div>
    </section>
    <!--========= Scripts ===========-->
    <script src="<?php echo base_url(); ?>front/js/jquery-latest.min.js"></script>
    <script src="<?php echo base_url(); ?>front/js/bootstrap.js"></script>
    <script src="<?php echo base_url(); ?>front/js/jquery-ui.js"></script>
    <script src="<?php echo base_url(); ?>front/js/wow.min.js"></script>
    <script src="<?php echo base_url(); ?>front/js/select-opt.js"></script>
    <script src="<?php echo base_url(); ?>front/js/slick.js"></script>
    <script src="<?php echo base_url(); ?>front/js/custom.js"></script>
    <script>
         
    $('.multiple-items').slick({
        dots: true,
        arrows: false,
        infinite: false,
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 3000,
        responsive: [{
            breakpoint: 992,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                centerMode: false,
            }
        }]

    });
    $('.slider-all').slick({
        dots: true,
        infinite: false,
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: false,
        autoplaySpeed: 3000,
        responsive: [{
            breakpoint: 992,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                centerMode: false,
            }
        }]

    });
  </script>
</body>



</html>