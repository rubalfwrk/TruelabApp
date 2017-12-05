<?php
/*
Template Name: Career
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
    <title>Career</title>

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
       <?php get_header();?>

        <!-- END MENU -->
    </header>
    <!--=========== END HEADER SECTION ================-->
    <section id="blogArchive">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="blog-breadcrumbs-area">
                    <div class="container">
                        <div class="blog-breadcrumbs-left">
                            <h2>Careers</h2>
                        </div>
                        <div class="blog-breadcrumbs-right">
                            <ol class="breadcrumb">
                                <li>You are here</li>
                                <li><a href="#">Home</a>
                                </li>
                                <li class="active">Careers</li>
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
                <div class="col-lg-8 col-md-8 center-col">
                  <div class="right_job">
                    <div class="section-heading align-left">
                      <h2>Applying For Position</h2>
                      <div class="line cont-line"></div>
                    </div>
                      <?php if(isset($_POST['mail'])){
//                         $target_dir = "uploads/";
//                        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
//                        $uploadOk = 1;
//                        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
//                        // Check if image file is a actual image or fake image
//                        if(isset($_POST["submit"])) {
//                            
//                            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
//                        } 
                        
                        //$to = "rahul@avainfotech.com";
                        $to = get_bloginfo('admin_email');
                        $from = $_POST['email'];
                        $subject = 'The subject';
                        $name = $_POST['firstname'].$_POST['lastname'];
                        $phone = $_POST['phone'];
                        $position = $_POST['position'];
                        $comment = $_POST['comment'];
                        $body = '<table><tr><td>Name</td><td>'.$name.'</td></tr><tr><td>Phone</td><td>'.$phone.'</td></tr><tr><td>Position</td><td>'.$position.'</td></tr><tr><td>Comment</td><td>'.$comment.'</td></tr></table>';
                                
                             
                        $headers = array('Content-Type: text/html; charset=UTF-8');

                        wp_mail($to, $subject, $body, $headers, "From:" . $from);
                       
                      }?>
                     <div class="career_form">
                        <?php echo do_shortcode('[contact-form-7 id="24" title="Contact form 1"]');?>
                     </div> 
                     <!--  <form class="career_form" action="<?php $PHP_SELF;?>" method="post">
                          
                      <li><input type="text" class="wp-form-control wpcf7-text" placeholder="Your last name" name="lastname"></li>
                      <li><input type="text" class="wp-form-control wpcf7-text" placeholder="Your first name" name="firstname"></li>
                       <li><input type="tel" class="wp-form-control wpcf7-text" placeholder="Your cell number" name="phone"></li>
                      <li><input type="email" class="wp-form-control wpcf7-email" placeholder="Your email id" name="email"></li>
                      <li><input type="file" class="wp-form-control wpcf7-text" name="" placeholder="Your CV"></li>
                      <li><input type="text" class="wp-form-control wpcf7-text" placeholder="Applying for position" name="position"></li>
                      <li><button class="wpcf7-submit button--itzel" type="submit" name="mail"><i class="button__icon fa fa-envelope"></i><span>Send Message</span></button></li>
                      <li><textarea class="wp-form-control wpcf7-textarea" cols="30" rows="10" placeholder="What would you like to tell us" name="comment"></textarea></li>
                      
                    </form> -->

                  </div>
                </div>
            </div>
        </div>
    </section>
    <!--=========== End Doctors SECTION ================-->

    <!--=========== Start Footer SECTION ================-->
    <footer id="footer">
        <?php get_footer();?>
      
    </footer>
    <!--=========== End Footer SECTION ================-->

   
</body>
</html>