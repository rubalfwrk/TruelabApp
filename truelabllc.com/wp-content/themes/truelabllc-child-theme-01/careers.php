<?php
/*

	Template Name: Careers

*/

get_header(); ?>

<section id="blogArchive">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="blog-breadcrumbs-area">
                    <div class="container">
                        <div class="blog-breadcrumbs-left">
                            <h2>Career</h2>
                        </div>
                        <div class="blog-breadcrumbs-right">
                            <ol class="breadcrumb">
                                <li>You are here</li>
                                <li><a href="#">Home</a>
                                </li>
                                <li class="active">Career</li>
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
                <!-- <div class="col-lg-5 col-md-5">
                <aside class="sidebar">
                  <div class="left_job">
                    <div class="section-heading align-left">
                      <h2>View Jobs By Department</h2>
                      <div class="line cont-line"></div>
                    </div>
                    <form class="filter_form">
                      <select class="wp-form-control">
                        <option>Select Department</option>
                        <option>Phlebotomist</option>
                      </select>
                    </form>
                  </div>
                  <div class="sidebar-widget">
                    <ul>
                      <li><a href="#"><span class="fa fa-angle-right"></span>Phlebotomist</a></li>
                    </ul>
                  </div>
                </aside>
                </div> -->
                <div class="col-lg-9 col-md-9 center-col">
                  <div class="right_job">
                    <div class="section-heading align-left">
                      <h2>Applying For Position</h2>
                      <div class="line cont-line"></div>
                    </div>
                    <div class="career_form">
                      <?php echo do_shortcode('[contact-form-7 id="24" title="Contact form 1"]'); ?>
                    </div>
                    <!--form class="career_form">
                      <li><input type="text" class="wp-form-control wpcf7-text" placeholder="Your first name"></li>
                      <li><input type="text" class="wp-form-control wpcf7-text" placeholder="Your last name"></li>
                      <li><input type="text" class="wp-form-control wpcf7-email" placeholder="Your email id"></li>
                      <li><input type="text" class="wp-form-control wpcf7-text" placeholder="Your cell number"></li>
                      <li><input type="text" class="wp-form-control wpcf7-text" placeholder="Applying for position"></li>
                      <li><input type="file" class="wp-form-control wpcf7-text" name="" placeholder="Your CV"></li>
                      <li><textarea class="wp-form-control wpcf7-textarea" cols="30" rows="10" placeholder="What would you like to tell us"></textarea></li>
                      <li><button class="wpcf7-submit button--itzel" type="submit"><i class="button__icon fa fa-envelope"></i><span>Send Message</span></button></li>
                    </form-->
                  </div>
                </div>
            </div>
        </div>
    </section>
    <!--=========== End Doctors SECTION ================-->
<?php  get_footer(); ?>