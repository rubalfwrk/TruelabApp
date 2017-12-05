<?php
/*
*  Template Name: About Us
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
                            <div class="whychoose-singleslide">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/choose-us-img1.jpg" alt="img">
                            </div>
                            <div class="whychoose-singleslide">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/choose-us-img2.jpg" alt="img">
                            </div>
                            <div class="whychoose-singleslide">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/choose-us-img3.jpg" alt="img">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 col-md-7">
                  <div class="sec-cont">
                    <div class="section-heading align-left">
                      <h2> About us</h2>
                      <div class="line cont-line"></div>
                    </div>
                    <p>
                       TrueLab is a CLIA Waived-certified laboratory specializing on use of point of care devices (POC) to deliver fast and reliable results to our clients. We understand how critical it is to know the results right away in order for your health care provider to prevent, diagnose and treat the disease.
                    </p>
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
                                    200
                                </div>
                                <div class="counter-label">Doctors</div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6">
                            <div class="counter-box">
                                <div class="counter-no counter">
                                    300
                                </div>
                                <div class="counter-label">Clinic Rooms</div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6">
                            <div class="counter-box">
                                <div class="counter-no counter">
                                    350
                                </div>
                                <div class="counter-label">Awards</div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6">
                            <div class="counter-box">
                                <div class="counter-no counter">
                                    450
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
                  <li>
                    <div class="single-testimonial">
                      <div class="testimonial-img">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/patients-3.jpg" alt="img">
                      </div>
                      <div class="testimonial-cotent">
                        <p class="testimonial-parg">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.There are many variations of passages of Lorem Ipsum available.</p>
                      </div>
                    </div>
                  </li> 
                  <li>
                    <div class="single-testimonial">
                      <div class="testimonial-img">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/patients-1.jpg" alt="img">
                      </div>
                      <div class="testimonial-cotent">
                        <p class="testimonial-parg">There are many variations of passages of Lorem Ipsum available.Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
                      </div>
                    </div>
                  </li> 
                  <li>
                    <div class="single-testimonial">
                      <div class="testimonial-img">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/patients-2.jpg" alt="img">
                      </div>
                      <div class="testimonial-cotent">
                        <p class="testimonial-parg">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.There are many variations of passages of Lorem Ipsum available.</p>
                      </div>
                    </div>
                  </li>                 
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--=========== End Testimonial SECTION ================-->
    <?php get_footer(); ?>