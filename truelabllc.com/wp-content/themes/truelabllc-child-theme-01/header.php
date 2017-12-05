<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<!-- CSS
    ================================================== -->       
    <!-- Bootstrap css file-->
    <link href="<?php echo get_stylesheet_directory_uri(); ?>/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font awesome css file-->
    <link href="<?php echo get_stylesheet_directory_uri(); ?>/css/font-awesome.min.css" rel="stylesheet">       
    <!-- Default Theme css file -->
    <link id="switcher" href="<?php echo get_stylesheet_directory_uri(); ?>/css/themes/default-theme.css" rel="stylesheet">   
    <!-- Slick slider css file -->
    <link href="<?php echo get_stylesheet_directory_uri(); ?>/css/slick.css" rel="stylesheet"> 
    <!-- Photo Swipe Image Gallery -->     
    <link rel='stylesheet prefetch' href='<?php echo get_stylesheet_directory_uri(); ?>/css/photoswipe.css'>
    <link rel='stylesheet prefetch' href='<?php echo get_stylesheet_directory_uri(); ?>/css/default-skin.css'>    
    <!-- Main structure css file -->
    <link href="<?php echo get_stylesheet_directory_uri(); ?>/css/main.css" rel="stylesheet">
<!-- CSS Path End Here
    ================================================== -->
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
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<!--div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'twentyseventeen' ); ?></a>

	<header id="masthead" class="site-header" role="banner">

		<?php //get_template_part( 'template-parts/header/header', 'image' ); ?>

		<?php //if ( has_nav_menu( 'top' ) ) : ?>
			<div class="navigation-top">
				<div class="wrap">
					<?php //get_template_part( 'template-parts/navigation/navigation', 'top' ); ?>
				</div>
			</div>
		<?php //endif; ?>

	</header>-->

	<?php
	// If a regular post or page, and not the front page, show the featured image.
	/*if ( has_post_thumbnail() && ( is_single() || ( is_page() && ! twentyseventeen_is_frontpage() ) ) ) :
		echo '<div class="single-featured-image-header">';
		the_post_thumbnail( 'twentyseventeen-featured-image' );
		echo '</div><!-- .single-featured-image-header -->';
	endif;*/
	?>

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
      <div class="menu_area">
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">  
          <div class="container">
            <div class="navbar-header">
              <!-- FOR MOBILE VIEW COLLAPSED BUTTON -->
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <!-- LOGO -->              
              <!-- TEXT BASED LOGO -->
              <a class="navbar-brand" href="<?php echo get_home_url(); ?>"><i class="fa fa-heartbeat"></i>Logo</a>           
                   
            </div>
            <div id="navbar" class="navbar-collapse collapse">

              <?php /* Primary navigation */
        				wp_nav_menu( array(
        				  'menu' => 'Main-Menu',
        				  'depth' => 2,
        				  'container' => false,
        				  'menu_class' => 'nav navbar-nav navbar-right main-nav'
        				));
				      ?>         
            </div><!--/.nav-collapse -->
          </div>     
        </nav>  
      </div>
      <!-- END MENU -->    
    </header>
	<div class="site-content-contain">
		<div id="content" class="site-content">
