<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header();
 ?>

 <section id="sliderArea">
      <!-- Start slider wrapper -->      
      <div class="top-slider">
        <?php $recent = new WP_Query("cat=10&showposts=2"); 
        while($recent->have_posts()) : 
          $recent->the_post();
//echo "<pre>"; print_r($recent); echo "</pre>";
        ?> 
        
        
        
        <!-- Start First slide -->
        <div class="top-slide-inner">
          <div class="slider-img top-img
          ">
          <?php //the_post_thumbnail();
          echo get_the_post_thumbnail( $recent->ID, 'full' );  ?>
          </div>
          <div class="slider-text">
            <p><?php the_title() ?></p>
            <h2><?php echo get_the_content(); ?></h2>
            <div class="readmore_area">
              <a data-hover="Read More" href="<?php home_url(); ?>/about-us/"><span>Read More</span></a>                
            </div>
          </div>
        </div>
        <!-- End First slide -->
        <!-- Start 2nd slide
        <div class="top-slide-inner">
          <div class="slider-img">
            <img src="http://ashutosh.crystalbiltech.com/truelabllc/wp-content/uploads/2017/04/slide-two.jpg" alt="">
          </div>
          <div class="slider-text">
            <p>Trust worthy and timely</p>
            <h2>health & medical</h2>
            <div class="readmore_area">
              <a data-hover="Read More" href="#"><span>Read More</span></a>                
            </div>
          </div>
        </div> -->
        <?php endwhile; ?>
        <!-- End 2nd slide -->
      </div><!-- /top-slider -->
    </section>
    <!--=========== END SLIDER SECTION ================-->

    <!--=========== BEGIN Top Feature SECTION ================-->
    <section id="topFeature">
      <div class="row">
        <!-- Start Single Top Feature -->
        <div class="col-lg-8 col-md-8">
          <div class="row">
            <div class="single-top-feature align-left">
            	<?php $recent = new WP_Query("cat=4&showposts=1"); while($recent->have_posts()) : $recent->the_post();?> 
				
              <h3><?php the_title() ?></h3>
             <?php echo get_the_content(); ?>
             <?php endwhile; ?>
            </div>
          </div>
        </div>
        <!-- End Single Top Feature -->
         
        <!-- Start Single Top Feature -->
        <div class="col-lg-4 col-md-4">
          <div class="row">
            <div class="single-top-feature opening-hours">
              <span class="fa fa-clock-o"></span>
              <?php $recent = new WP_Query("cat=5&showposts=1"); while($recent->have_posts()) : $recent->the_post();?> 
              <h3><?php the_title() ?></h3>
              
              <?php echo get_the_content(); ?>
               
              <?php endwhile; ?>           
            </div>
          </div>
        </div>
        <!-- End Single Top Feature -->
      </div>
    </section>
    <!--=========== END Top Feature SECTION ================-->

    <!--=========== BEGIN Service SECTION ================-->
    <section id="service">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 col-md-12">
            <div class="service-area">
              <!-- Start Service Title -->
              <div class="section-heading">
                <h2>Our Services</h2>
                <div class="line"></div>
              </div>
              <div class="service-content">
                <div class="row">
              <?php $recent = new WP_Query("cat=6"); while($recent->have_posts()) : $recent->the_post();?> 
						
						
              <!-- Start Service Content -->
              
                  <!-- Start Single Service -->
                  <div class="col-lg-4 col-md-4">
                    <div class="single-service">
                      <div class="service-icon">
                        <!-- <span class="fa fa-stethoscope service-icon-effect"> -->
                          <span class="service-icon-effect"><?php the_post_thumbnail(); ?></span>  
                      </div>   
                                        
                       <h3><a href="#"><?php the_title() ?></a></h3>
                      <p><?php echo get_the_content(); ?></p> 
                    </div>
                  </div>
                  <!-- Start Single Service -->
                  <?php endwhile; ?> 
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--=========== End Service SECTION ================-->

    <!--=========== BEGAIN Why Choose Us SECTION ================-->
    <section id="whychooseSection">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 col-md-12">
            <div class="service-area">
              <!-- Start Service Title -->
              <div class="section-heading">
                <h2>Why Choose Us</h2>
                <div class="line"></div>
              </div>              
            </div>
          </div>
          <div class="col-lg-12 col-md-12">
            <div class="row">
              <div class="col-lg-5 col-md-6 col-sm-6 col-xs-12">
                <div class="whyChoose-left">
                  <div class="whychoose-slider">
                   <?php $recent = new WP_Query("cat=11&showposts=3"); while($recent->have_posts()) : $recent->the_post();?> 
                    <div class="whychoose-singleslide">
                       <?php the_post_thumbnail('full'); ?>
                    </div>
                    <?php endwhile; ?>
                  </div>
                </div>
              </div>
              <div class="col-lg-7 col-md-6 col-sm-6 col-xs-12">
                <div class="whyChoose-right">
                	<?php $recent = new WP_Query("cat=7"); while($recent->have_posts()) : $recent->the_post();
                  $featured_image = $dynamic_featured_image->get_featured_images(); ?> 
                  <div class="media">
                    <div class="media-left">
                      <!-- <a href="#" class="media-icon"> -->
                      <a href="#">
                        <!-- <span class="fa fa-hospital-o"> -->
                          <span class="before_hr"><?php the_post_thumbnail(); ?></span>
                          <span class="after_hr">
                        <img src="<?php echo $featured_image[0]['full']; ?>"> 
                          </span>
                      </a>
                    </div>

                    <div class="media-body">
                    	
                      <h4 class="media-heading"><?php the_title() ?></h4>
                      <p><?php echo get_the_content(); ?></p>
                    </div>
                  </div>
               
                  <?php endwhile; ?> 
                </div>

              </div>
            </div>
          </div>          
        </div>
      </div>
    </section>
    <!--=========== END Why Choose Us SECTION ================-->

    <!--=========== BEGAIN Counter SECTION ================-->
    <section id="counterSection">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 col-md-12">
            <div class="counter-area">
              <div class="col-lg-3 col-md-3 col-sm-6">
                <div class="counter-box">
                  <div class="counter-no counter">
                    100
                  </div>
                  <div class="counter-label">Doctors</div>
                </div>
              </div>
              <div class="col-lg-3 col-md-3 col-sm-6">
                 <div class="counter-box">
                  <div class="counter-no counter">
                    40
                  </div>
                  <div class="counter-label">Lab Equipments</div>
                </div>
              </div>
              <div class="col-lg-3 col-md-3 col-sm-6">
                 <div class="counter-box">
                  <div class="counter-no counter">
                    50
                  </div>
                  <div class="counter-label">LAB PERSONNEL
</div>
                </div>
              </div>
              <div class="col-lg-3 col-md-3 col-sm-6">
                 <div class="counter-box">
                  <div class="counter-no counter">
                    250 
                  </div>
                  <div class="counter-label">Happy Patients</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--=========== End Counter SECTION ================-->

    <!--=========== BEGAIN Testimonial SECTION ================-->
    <section id="testimonial">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 col-md-12">
            <div class="testimonial-area">
             <!-- Start Service Title -->
              <div class="section-heading">
                <h2>What our patients said</h2>
                <div class="line"></div>
              </div>
              <div class="testimonial-area">
                <ul class="testimonial-nav">
                <?php $recent = new WP_Query("cat=8"); while($recent->have_posts()) : $recent->the_post();?> 
						
						
						
                  <li>
                    <div class="single-testimonial">
                      <div class="testimonial-img">

                        <?php the_post_thumbnail( 'large','style=max-width:100%;height:auto;'); ?>
                      </div>
                      <div class="testimonial-cotent">
                       
                     <?php echo get_the_content(); ?>
                      </div>
                    </div>
                  </li> 
                  
                  <?php endwhile; ?>                
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
<?php get_footer();
