<?php $this->load->view('common/header'); ?>
<!-- Breadcrumbs -->

<div class="breadcrumbs">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <ul>
          <li class="home"> <a title="Go to Home Page" href="index.html">Home</a><span>&raquo;</span></li>
          <!-- <li class=""> <a title="Go to Home Page" href="shop_grid.html">Women</a><span>&raquo;</span></li> -->
          <li><strong>College</strong></li>
        </ul>
      </div>
    </div>
  </div>
</div>
<!-- Breadcrumbs End --> 
<!-- Main Container -->
<div class="main-container col2-left-layout">
  <div class="container">
    <div class="row">
      <div class="col-main col-sm-9 col-xs-12 col-sm-push-3">
        <div class="category-description std">
          <div class="slider-items-products">
            <div id="category-desc-slider" class="product-flexslider hidden-buttons">
              <div class="slider-items slider-width-col1 owl-carousel owl-theme"> 

                <!-- Item -->
                <?php $banners=get_all_list('home_page_data',' where section_id=2'); ?>
                <!-- SLIDE  -->
                <?php foreach($banners as $banner){ ?>
                  <div class="item"> <a href="#x"><img alt="" src="<?php echo base_url().$banner->file_url; ?>"></a> </div>
                <?php } ?>
                <!-- End Item --> 

                <!-- Item -->


                <!-- End Item --> 

              </div>
            </div>
          </div>
        </div>
        <div class="shop-inner">
          <div class="page-title">
            <h2>Clother</h2>
          </div>
          <div class="toolbar">
            <div class="view-mode">
              <ul>
                <li class="active"> <a href="shop_grid.html"> <i class="fa fa-th"></i> </a> </li>
                <li> <a href="shop_list.html"> <i class="fa fa-th-list"></i> </a> </li>
              </ul>
            </div>
            <div class="sorter">
              <div class="short-by">
                <label>Sort By:</label>
                <select>
                  
                </select>
              </div>
              <div class="short-by page">
                <label>Show:</label>
                <select>
                  <option selected="selected">18</option>
                  <option>20</option>
                  <option>25</option>
                  <option>30</option>
                </select>
              </div>
            </div>
          </div>
          <div class="product-grid-area">
           <ul class="products-list" id="products-list">

            <?php $latest_news=get_all_list('home_page_data',' where section_id=4'); ?>
            <!-- Item -->
            <?php foreach($latest_news as $news){ ?>
              <li class="item ">
                <div class="product-img">
                  <!-- <div class="icon-sale-label sale-left">Sale</div> -->
                  <a href="single_product.html" title="Ipsums Dolors Untra">
                    <figure> <img class="small-image" src="<?php echo base_url().$news->file_url; ?>" alt="Ipsums Dolors Untra"></figure>
                  </a> </div>
                  <div class="product-shop">
                    <h2 class="product-name"><a href="single_product.html" title="Ipsums Dolors Untra">Ipsums Dolors Untra</a></h2>
                    <div class="ratings">
                      <!-- <div class="rating"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> </div> -->
                      <!-- <p class="rating-links"> <a href="#/">4 Review(s)</a> <span class="separator">|</span> <a href="#review-form">Add Your Review</a> </p> -->
                    </div>
                    <div class="price-box">
                    <!--   <p class="special-price"> <span class="price-label"></span> <span class="price"> $222.99 </span> </p>
                      <p class="old-price"> <span class="price-label"></span> <span class="price"> $442.99 </span> </p> -->
                    </div>
                    <div class="desc std">
                      <p>Nunc facilisis sagittis ullamcorper. Proin lectus ipsum, 
                        gravida et mattis vulputate, tristique ut lectus. Sed et lorem nunc. 
                        Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere
                        cubilia Curae; Aenean eleifend laoreet congue. Vivamus adipiscing nisl 
                        <!-- ut dolor dignissim semper. <a class="link-learn" title="Learn More" href="single_product.html">Learn More</a> </p> -->
                      </div>
                      <div class="actions">
                        <button class="button cart-button" title="Add to Cart" type="button"><i class="fa fa-eye"></i><span>View More</span></button>
                        <ul>
                        <!-- <li> <a href="wishlist.html"> <i class="fa fa-heart"></i><span> Add to Wishlist</span> </a> </li>
                          <li> <a href="compare.html"> <i class="fa fa-signal"></i><span> Add to Compare</span> </a> </li> -->
                        </ul>
                      </div>
                    </div>
                  </li>
                <?php } ?>
              </ul>
            </div>
            <div class="pagination-area ">
              <ul>
                <li><a class="active" href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#"><i class="fa fa-angle-right"></i></a></li>
              </ul>
            </div>
          </div>
        </div>
       <?php $this->load->view('internal_pages/listing_sidebar'); ?>
                </div>
              </div>
            </div>
            <!-- Main Container End --> 
            <!-- service section -->

          <!--   <div class="jtv-service-area">
              <div class="container">
                <div class="row">
                  <div class="col-lg-4 col-sm-4 col-xs-12">
                    <div class="jtv-service">
                      <div class="ser-icon"> <i class="fa fa-truck flip-horizontal"></i> </div>
                      <div class="service-content">
                        <h5>FREE SHIPPING WORLDWIDE </h5>
                        <p>free ship-on oder over $299.00</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4 col-sm-4 col-xs-12">
                    <div class="jtv-service">
                      <div class="ser-icon"> <i class="fa fa-mail-forward"></i> </div>
                      <div class="service-content">
                        <h5>MONEY BACK GUARATEE! </h5>
                        <p>30 days money back guarantee!</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4 col-sm-4 col-xs-12">
                    <div class="jtv-service">
                      <div class="ser-icon"> <i class="fa fa-comments flip-horizontal"></i> </div>
                      <div class="service-content">
                        <h5>24/7 CUSTOMER SERVICE </h5>
                        <p>We support online 24 hours a day</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div> -->

            <!-- Footer -->

            <footer> 
              <?php $this->load->view('common/footer'); ?>
              <!-- Revolution slider --> 

            </body>


            </html>
