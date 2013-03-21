<?php
/**
 * Webproject functions and definitions
 *
 * @package Webproject
 * @since Webproject 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since Webproject 1.0
 */
if ( ! isset( $content_width ) )
	$content_width = 654; /* pixels */

/*
 * Load Jetpack compatibility file.
 */
require( get_template_directory() . '/inc/jetpack.php' );

if ( ! function_exists( 'webproject_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since Webproject 1.0
 */
function webproject_setup() {

	/**
	 * Custom template tags for this theme.
	 */
	require( get_template_directory() . '/inc/template-tags.php' );

	/**
	 * Custom functions that act independently of the theme templates
	 */
	require( get_template_directory() . '/inc/extras.php' );

	/**
	 * Customizer additions
	 */
	require( get_template_directory() . '/inc/customizer.php' );

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on Webproject, use a find and replace
	 * to change 'webproject' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'webproject', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'webproject' ),
	) );

	/**
	 * Enable support for Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );
}
endif; // webproject_setup
add_action( 'after_setup_theme', 'webproject_setup' );

/**
 * Setup the WordPress core custom background feature.
 *
 * Use add_theme_support to register support for WordPress 3.4+
 * as well as provide backward compatibility for WordPress 3.3
 * using feature detection of wp_get_theme() which was introduced
 * in WordPress 3.4.
 *
 * @todo Remove the 3.3 support when WordPress 3.6 is released.
 *
 * Hooks into the after_setup_theme action.
 */
function webproject_register_custom_background() {
	$args = array(
		'default-color' => 'ffffff',
		'default-image' => '',
	);

	$args = apply_filters( 'webproject_custom_background_args', $args );

	if ( function_exists( 'wp_get_theme' ) ) {
		add_theme_support( 'custom-background', $args );
	} else {
		define( 'BACKGROUND_COLOR', $args['default-color'] );
		if ( ! empty( $args['default-image'] ) )
			define( 'BACKGROUND_IMAGE', $args['default-image'] );
		add_custom_background();
	}
}
add_action( 'after_setup_theme', 'webproject_register_custom_background' );

/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since Webproject 1.0
 */
function webproject_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Primary Widget Area', 'webproject' ),
		'id' => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
	
	    register_sidebar( array(
        'name' => __( 'Secondary Widget Area', 'webproject' ),
        'id' => 'sidebar-2',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h1 class="widget-title">',
        'after_title' => '</h1>',
    ) );
	
}
add_action( 'widgets_init', 'webproject_widgets_init' );


/**
 * Add Custom Post type for Team Members
 */

add_action( 'init', 'create_my_post_types' );

function create_my_post_types() {
 register_post_type( 'Artist', 
 array(
      'labels' => array(
      	'name' => __( 'Artists' ),
      	'singular_name' => __( 'Artist' ),
      	'add_new' => __( 'Add New' ),
      	'add_new_item' => __( 'Add New Artist' ),
      	'edit' => __( 'Edit' ),
      	'edit_item' => __( 'Edit Artist' ),
      	'new_item' => __( 'New Artist' ),
      	'view' => __( 'View Artist' ),
      	'view_item' => __( 'View Artist' ),
      	'search_items' => __( 'Search Artists' ),
      	'not_found' => __( 'No Artists found' ),
      	'not_found_in_trash' => __( 'No Artists found in Trash' ),
      	'parent' => __( 'Parent Artist' ),
      ),
 'public' => true,
      'menu_position' => 4,
      'rewrite' => array('slug' => 'Artists'),
      'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail' ),
      'taxonomies' => array('category', 'post_tag'),
      'publicly_queryable' => true,
      'show_ui' => true,
      'query_var' => true,
      'capability_type' => 'post',
      'hierarchical' => false,
     )
  );
}



// functions run on activation –> important flush to clear rewrites
if ( is_admin() && isset($_GET['activated'] ) && $pagenow == ‘themes.php’ ) {
$wp_rewrite->flush_rules();
}



/**
 * Enqueue scripts and styles
 */
function webproject_scripts() {
	wp_enqueue_style( 'style', get_stylesheet_uri() );
	
	wp_enqueue_script( 'small-menu', get_template_directory_uri() . '/js/small-menu.js', array( 'jquery' ), '20120206', true );
	
	wp_enqueue_script( 'jquery', false, false, false, false );
	
	wp_enqueue_script( 'main', get_template_directory_uri() . '/js/main.js', array( 'jquery' ), false, true );


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}
	
	
}
add_action( 'wp_enqueue_scripts', 'webproject_scripts' );

