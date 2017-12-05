<?php

/*

* Generated By Orbisius Child Theme Creator - your favorite plugin for Child Theme creation :)

* https://wordpress.org/plugins/orbisius-child-theme-creator/

*

* Unlike style.css, the functions.php of a child theme does not override its counterpart from the parent.

* Instead, it is loaded in addition to the parent’s functions.php. (Specifically, it is loaded right before the parent theme's functions.php).

* Source: http://codex.wordpress.org/Child_Themes#Using_functions.php

*

* Be sure not to define functions, that already exist in the parent theme!

* A common pattern is to prefix function names with the (child) theme name.

* Also if the parent theme supports pluggable functions you can use function_exists( 'put_the_function_name_here' ) checks.

*/



/**

 * Loads parent and child themes' style.css

 */

function orbisius_ctc_truelabllc_child_theme_enqueue_styles() {

    $parent_style = 'orbisius_ctc_truelabllc_parent_style';

    $parent_base_dir = 'truelabllc';



    wp_enqueue_style( $parent_style,

        get_template_directory_uri() . '/style.css',

        array(),

        wp_get_theme( $parent_base_dir ) ? wp_get_theme( $parent_base_dir )->get('Version') : ''

    );



    wp_enqueue_style( $parent_style . '_child_style',

        get_stylesheet_directory_uri() . '/style.css',

        array( $parent_style ),

        wp_get_theme()->get('Version')

    );

}



add_action( 'wp_enqueue_scripts', 'orbisius_ctc_truelabllc_child_theme_enqueue_styles' );

function wpb_widgets_init() {

    register_sidebar( array(

        'name' => __( 'Footer 3', 'wpb' ),

        'id' => 'sidebar-30',

        'description' => __( 'Add widgets here to appear in your footer.', 'wpb' ),

        'before_widget' => '<aside id="%1$s" class="widget %2$s">',

        'after_widget' => '</aside>',

        'before_title' => '<h3 class="widget-title">',

        'after_title' => '</h3>',

    ) );

 

    register_sidebar( array(

        'name' =>__( 'Footer 4', 'wpb'),

        'id' => 'sidebar-40',

        'description' => __( 'Add widgets here to appear in your footer.', 'wpb' ),

        'before_widget' => '<aside id="%1$s" class="widget %2$s">',

        'after_widget' => '</aside>',

        'before_title' => '<h3 class="widget-title">',

        'after_title' => '</h3>',

    ) );

}

add_action( 'widgets_init', 'wpb_widgets_init' );

function my_login_logo() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/logo.png);
            height:90px;
            width:222px;
            background-size: 222px 90px;
            background-repeat: no-repeat;
            padding-bottom: 15px;
            margin:0px auto;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );

function my_login_logo_url() {
    return '';
}
add_filter( 'login_headerurl', 'my_login_logo_url' );


