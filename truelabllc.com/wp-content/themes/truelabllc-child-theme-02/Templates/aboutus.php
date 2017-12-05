<?php
/*
Template Name: Aboutus
*/

get_header();

?>


<section id="blogArchive">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="blog-breadcrumbs-area">
                    <div class="container">
                        <div class="blog-breadcrumbs-left">
                            <h2>About Us</h2>
                        </div>
                        <div class="blog-breadcrumbs-right">
                            <ol class="breadcrumb">
                                <li>You are here</li>
                                <li><a href="#">Home</a>
                                </li>
                                <li class="active">About Us</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--=========== BEGAIN Doctors SECTION ================-->
    <section id="meetDoctors">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-5">
                    <div class="whyChoose-left no-margin">
                        <div class="whychoose-slider">
                             <?php $recent = new WP_Query("cat=11&showposts=3"); while($recent->have_posts()) : $recent->the_post();?> 
                    <div class="whychoose-singleslide">
                       <?php the_post_thumbnail(); ?>
                    </div>
                    <?php endwhile; ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 col-md-7">
                  <div class="sec-cont">
                    <?php $recent = new WP_Query("cat=4&showposts=1"); while($recent->have_posts()) : $recent->the_post();?> 
                    <div class="section-heading align-left">
                      <h2> <?php the_title() ?></h2>
                      <div class="line cont-line"></div>
                    </div>
                    <?php echo get_the_content(); ?>
                    <?php endwhile; ?>
                  </div>
                </div>
            </div>
        </div>
    </section>
    <!--=========== End Doctors SECTION ================-->

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
                                <div class="counter-label">LAB PERSONNEL</div>
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
    <?php get_footer(); ?>