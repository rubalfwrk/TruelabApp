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

		<footer id="colophon" class="site-footer" role="contentinfo">
			<div class="wrap">
				<?php
				//get_template_part( 'template-parts/footer/footer', 'widgets' );

				if ( has_nav_menu( 'social' ) ) : ?>
					<nav class="social-navigation" role="navigation" aria-label="<?php _e( 'Footer Social Links Menu', 'twentyseventeen' ); ?>">
						<?php
							wp_nav_menu( array(
								'theme_location' => 'social',
								'menu_class'     => 'social-links-menu',
								'depth'          => 1,
								'link_before'    => '<span class="screen-reader-text">',
								'link_after'     => '</span>' . twentyseventeen_get_svg( array( 'icon' => 'chain' ) ),
							) );
						?>
					</nav><!-- .social-navigation -->
				<?php endif;

				//get_template_part( 'template-parts/footer/site', 'info' );
				?>
			</div><!-- .wrap -->
		</footer><!-- #colophon -->
	</div><!-- .site-content-contain -->
</div><!-- #page -->
<?php wp_footer(); ?>

</body>
</html>


</div><!-- #content -->
		<footer id="footer">
      <!-- Start Footer Top -->
      <div class="footer-top">
        <div class="container">
          <div class="row">
            <?php
             get_template_part( 'template-parts/footer/footer', 'widgets' );
              /*if(is_active_sidebar('footer-sidebar-1')){
                dynamic_sidebar('footer-sidebar-1');
              }
            
              if(is_active_sidebar('footer-sidebar-2')){
                dynamic_sidebar('footer-sidebar-2');
              }*/
            
              if(is_active_sidebar('sidebar-30')){
                dynamic_sidebar('sidebar-30');
              }
              /*$options = array('number' => 5,
                               'tag_from_post' => false,
                               'tag_from_post_slug' => false,
                               'tag_from_post_custom_field' => false,
                               'exclude' => false,
                               'excerpt' => false,
                               'excerpt_filter' => true,
                               'thumbnail' => false,
                               'thumbnail_size' => ''
                               );
              posts_by_tag('Service', $options);
           */
              if(is_active_sidebar('sidebar-40')){
                dynamic_sidebar('sidebar-40');
              }
            ?>
          
            
          </div>
        </div>
      </div>
      <!-- Start Footer Middle -->
      <div class="footer-middle">
        <div class="container">
          <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="footer-copyright">
              <p>&copy; Copyright 2017 <a href="<?php home_url();?>">truelabllc</a></p>
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
