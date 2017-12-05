<?php
/*
*  Template Name: Contact Us
*/
get_header();
?>

 <section id="blogArchive">      
      <div class="row">
        <div class="col-lg-12 col-md-12">
          <div class="blog-breadcrumbs-area">
            <div class="container">
              <div class="blog-breadcrumbs-left">
                <h2>Contact</h2>
              </div>
              <div class="blog-breadcrumbs-right">
                <ol class="breadcrumb">
                  <li>You are here</li>
                  <li><a href="#">Home</a></li>                  
                  <li class="active">Contact</li>
                </ol>
              </div>
            </div>
          </div>
        </div>        
      </div>      
    </section>    

  <section id="contact">
      <div class="container">
        <div class="row">
          <div class="col-lg-7 col-md-7 col-sm-6">
            <div class="contact-form">
              <div class="section-heading align-left">
                <h2>Contact Us</h2>
                <div class="line cont-line"></div>
              </div>
              <p>Fill out all required Field to send a Message. Please don't spam,Thank you!</p>
              	<div class="submitphoto_form">
              		<?php echo do_shortcode('[contact-form-7 id="29" title="Contact Us"]'); ?>
              <!-- <form class="submitphoto_form">
                <input type="text" class="wp-form-control wpcf7-text" placeholder="Your name">
                <input type="mail" class="wp-form-control wpcf7-email" placeholder="Email address">          
                <input type="text" class="wp-form-control wpcf7-text" placeholder="Subject">
                <textarea class="wp-form-control wpcf7-textarea" cols="30" rows="10" placeholder="What would you like to tell us"></textarea>
               <button class="wpcf7-submit button--itzel" type="submit"><i class="button__icon fa fa-envelope"></i><span>Send Message</span></button>                
              </form> -->
          		</div>
            </div>
          </div>
          <div class="col-lg-5 col-md-5 col-sm-6">
            <div class="contact-address">
              <div class="section-heading align-left">
                <h2>Contact Information</h2>
                <div class="line cont-line"></div>
              </div>
               <p>The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters.</p>
              <address class="contact-info">               
               <!--  <p><span class="fa fa-home"></span>305 Intergraph Way
                Madison, AL 35758, USA</p> -->
                <p><span class="fa fa-phone"></span>(708) 620-5790</p>
                <p><span class="fa fa-fax"></span>(708) 650-5215</p>
                <p><span class="fa fa-envelope"></span>helpdesk@truelabllc.com</p>
              </address>
              <h3>Social Media</h3>
              <div class="social-share">               
               <ul>
                 <li><a href="#"><span class="fa fa-facebook"></span></a></li>
                 <li><a href="#"><span class="fa fa-twitter"></span></a></li>
                 <li><a href="#"><span class="fa fa-google-plus"></span></a></li>
                 <li><a href="#"><span class="fa fa-linkedin"></span></a></li>
               </ul>
             </div>
            </div>
          </div>
        </div>
      </div>
    </section>   


<?php get_footer(); ?>