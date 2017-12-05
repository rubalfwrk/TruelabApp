<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?>
		</div><!-- #content -->
		<footer id="footer">
      <!-- Start Footer Top -->
      <div class="footer-top">
        <div class="container">
          <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-3">
              <div class="single-footer-widget">
                <div class="section-heading">
                <h2>About Us</h2>
                <div class="line"></div>
              </div>           
              <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>
              </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3">
              <div class="single-footer-widget">
                <div class="section-heading">
                <h2>Our Service</h2>
                <div class="line"></div>
              </div>
              <ul class="footer-service">
                <li><a href="<?php echo get_home_url(); ?>"><span class="fa fa-check"></span>Home</a></li>
                <li><a href="<?php echo get_home_url(); ?>/about-us"><span class="fa fa-check"></span>About Us</a></li>
                <li><a href="<?php echo get_home_url(); ?>/services"><span class="fa fa-check"></span>Services</a></li>
                <li><a href="<?php echo get_home_url(); ?>/careers"><span class="fa fa-check"></span>Career</a></li>
                <li><a href="<?php echo get_home_url(); ?>/contact"><span class="fa fa-check"></span>Contact Us</a></li>
              </ul>
              </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3">
              <div class="single-footer-widget">
                <div class="section-heading">
                <h2>Tags</h2>
                <div class="line"></div>
              </div>
                <ul class="tag-nav">
                  <li><a href="#">Dental</a></li>
                  <li><a href="#">Surgery</a></li>
                  <li><a href="#">Pediatric</a></li>
                  <li><a href="#">Cardiac</a></li>
                  <li><a href="#">Ophthalmology</a></li>
                  <li><a href="#">Diabetes</a></li>
                </ul>
              </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3">
              <div class="single-footer-widget">
                <div class="section-heading">
                <h2>Contact Info</h2>
                <div class="line"></div>
              </div>
              <address class="contact-info">
                <!-- <p><span class="fa fa-home"></span>305 Intergraph Way
                Madison, AL 35758, USA</p> -->
                <p><span class="fa fa-phone"></span>(708) 620-5790</p>
                <p><span class="fa fa-fax"></span>(708) 650-5215</p>
                <p><span class="fa fa-envelope"></span>helpdesk@truelabllc.com</p>
              </address>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Start Footer Middle -->
      <div class="footer-middle">
        <div class="container">
          <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="footer-copyright">
              <p>&copy; Copyright 2017 <a href="index.html">truelabllc</a></p>
            </div>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="footer-social">              
                <a href="#"><span class="fa fa-facebook"></span></a>
                <a href="#"><span class="fa fa-twitter"></span></a>
                <a href="#"><span class="fa fa-google-plus"></span></a>
                <a href="#"><span class="fa fa-linkedin"></span></a>     
            </div>
          </div>
        </div>
        </div>
      </div>
    </footer>

<!-- jQuery Library  -->
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/jquery.js"></script>    
    <!-- Bootstrap default js -->
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/bootstrap.min.js"></script>
    <!-- slick slider -->
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/slick.min.js"></script>    
    <script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/modernizr.custom.79639.js"></script>      
    <!-- counter -->
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/waypoints.min.js"></script>
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/jquery.counterup.min.js"></script>
    <!-- Doctors hover effect -->
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/snap.svg-min.js"></script>
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/hovers.js"></script>
    <!-- Photo Swipe Gallery Slider -->
    <script src='<?php echo get_stylesheet_directory_uri(); ?>/js/photoswipe.min.js'></script>
    <script src='<?php echo get_stylesheet_directory_uri(); ?>/js/photoswipe-ui-default.min.js'></script>    
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/photoswipe-gallery.js"></script>

    <!-- Custom JS -->
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/custom.js"></script>

</body>
</html>
