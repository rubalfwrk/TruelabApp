<?php
/*
Template Name: Contact
*/
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!--=============================================== 
    Template Design By Future Work Technologies Team.
    Author URI : https://futureworktechnologies.com/
    ====================================================-->

    <!-- Basic Page Needs
    ================================================== -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Contact Us</title>

    <!-- Mobile Specific Metas
    ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS
    ================================================== -->
    <!-- Bootstrap css file-->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Font awesome css file-->
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <!-- Default Theme css file -->
    <link id="switcher" href="css/themes/default-theme.css" rel="stylesheet">
    <!-- Slick slider css file -->
    <link href="css/slick.css" rel="stylesheet">
    <!-- Photo Swipe Image Gallery -->
    <link rel='stylesheet prefetch' href='css/photoswipe.css'>
    <link rel='stylesheet prefetch' href='css/default-skin.css'>

    <!-- Main structure css file -->
    <link href="style.css" rel="stylesheet">

    <!-- Google fonts -->
    <link href='http://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Habibi' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Cinzel+Decorative:900' rel='stylesheet' type='text/css'>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <!-- BEGAIN PRELOADER -->
    <div id="preloader">
        <div id="status">&nbsp;</div>
    </div>
    <!-- END PRELOADER -->

    <!-- SCROLL TOP BUTTON -->
    <a class="scrollToTop" href="#"><i class="fa fa-heartbeat"></i></a>
    <!-- END SCROLL TOP BUTTON -->

    <!--=========== BEGIN HEADER SECTION ================-->
    <header id="header">
        <!-- BEGIN MENU -->
        <?php get_header();
      
        ?>

        <!-- END MENU -->
    </header>
    <!--=========== END HEADER SECTION ================-->            
    <section id="blogArchive">      
      <div class="row">
        <div class="col-lg-12 col-md-12">
          <div class="blog-breadcrumbs-area">
            <div class="container">
              <div class="blog-breadcrumbs-left">
                <h2>Contact Us</h2>
              </div>
              <div class="blog-breadcrumbs-right">
                <ol class="breadcrumb">
                  <li>You are here</li>
                  <li><a href="#">Home</a></li>                  
                  <li class="active">Contact Us</li>
                </ol>
              </div>
            </div>
          </div>
        </div>        
      </div>      
    </section>    
    <!--=========== BEGIN Google Map SECTION ================-->
<!--    <section id="googleMap">
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3281.297314036103!2d-86.74954699999999!3d34.672444999999996!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x88626565a94cdb25%3A0x74c206053b6a97c9!2s305+Intergraph+Way%2C+Madison%2C+AL+35758%2C+USA!5e0!3m2!1sen!2sbd!4v1431591462160" width="100%" height="500" frameborder="0" style="border:0"></iframe>
    </section>-->
    <!--=========== END Google Map SECTION ================-->
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
              <?php if(isset($_POST['mailbutton'])){
                        //$to = "rahul@avainfotech.com";
                        $to = get_bloginfo('admin_email');
                        $from = $_POST['email'];
                        $subject = $_POST['subject'];
                        $name = $_POST['name'];
                        $comment = $_POST['comment'];
                        $body = '<table><tr><td>Name</td><td>'.$name.'</td></tr><tr><td>Email</td><td>'.$from.'</td></tr><tr><td>Comment</td><td>'.$comment.'</td></tr></table>';
                         
                        $headers = array('Content-Type: text/html; charset=UTF-8');

                        wp_mail($to, $subject, $body, $headers, "From:" . $from);
                       
                      }?>
                      <div class="submitphoto_form">
                      <?php echo do_shortcode('[contact-form-7 id="29" title="Contact Us"]');
                      ?>
                    </div>
             <!--  <form class="submitphoto_form" action="<?php $PHP_SELF;?>" method="post">
                <input type="text" class="wp-form-control wpcf7-text" placeholder="Your name" name="name">
                <input type="email" class="wp-form-control wpcf7-email" placeholder="Email address" name="email">          
                <input type="text" class="wp-form-control wpcf7-text" placeholder="Subject" name="subject">
                <textarea class="wp-form-control wpcf7-textarea" cols="30" rows="10" placeholder="What would you like to tell us" name="comment"></textarea>
               <button class="wpcf7-submit button--itzel" type="submit" name="mailbutton"><i class="button__icon fa fa-envelope"></i><span>Send Message</span></button>                
              </form> -->
            </div>
          </div>
          <div class="col-lg-5 col-md-5 col-sm-6">
          <?php $recent = new WP_Query("cat=12&showposts=1"); while($recent->have_posts()) : $recent->the_post();?> 
          <?php echo get_the_content();?>
          <?php endwhile; ?>

          </div>
        </div>
      </div>
    </section>

    <!--=========== Start Footer SECTION ================-->
    <footer id="footer">
      <!-- Start Footer Top -->
      <?php get_footer();?>

    </footer>
    <!--=========== End Footer SECTION ================-->
     
  </body>
</html>