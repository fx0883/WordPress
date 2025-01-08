<?php
/**
 * Archi functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Archi
 */

if ( ! function_exists( 'archi_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function archi_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on _s, use a find and replace
		 * to change 'archi' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'archi', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );
		
		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary', 'archi' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		/*
		 * Enable support for Post Formats.
		 *
		 * See: https://codex.wordpress.org/Post_Formats
		 */
		add_theme_support( 'post-formats', array(
			'image',
			'video',
			'link',
			'quote',
			'gallery',
			'audio',
		) );
		
	}
endif;
add_action( 'after_setup_theme', 'archi_setup' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function archi_widgets_init() {
	/* Register the 'primary' sidebar. */
	register_sidebar( array(
		'name'          => esc_html__( 'Primary Sidebar', 'archi' ),
		'id'            => 'primary',
		'description'   => esc_html__( 'Add widgets here.', 'archi' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	/* Repeat register_sidebar() code for additional sidebars. */
}
add_action( 'widgets_init', 'archi_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function archi_scripts() {

	/** Add theme font **/ 
	wp_enqueue_style( 'archi-font-text', get_template_directory_uri().'/css/font-text.css');
	wp_enqueue_style( 'archi-font-icon', get_template_directory_uri().'/css/font-awesome.css');

    /** Plugin addon css **/ 
	wp_enqueue_style( 'archi-plugin-css', get_template_directory_uri() . '/css/plugin-addon.css', array(), '1.0', 'all');

	/** Theme stylesheet. **/
	$theme = wp_get_theme();
	if( is_child_theme() ) { $theme = wp_get_theme()->parent(); }
	wp_enqueue_style( 'archi-style', get_template_directory_uri() . '/style.css', array(), $theme->version );

	wp_enqueue_script( 'imagesloaded' );
	wp_enqueue_script( 'archi-plugin-script', get_template_directory_uri().'/js/plugin-addon.js', array('jquery'), '20231018',  true );
    wp_enqueue_script( 'archi-elementor-script', get_template_directory_uri() . '/js/elementor-widget.js', array( 'jquery' ), '20231018', true );
	wp_enqueue_script( 'archi-scripts', get_template_directory_uri() . '/js/theme.js', array( 'jquery' ), '20231018', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'archi_scripts' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/frontend/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/frontend/template-functions.php';

/**
 * Custom Page Header for this theme.
 */
require get_template_directory() . '/inc/frontend/page-header/breadcrumbs.php';
require get_template_directory() . '/inc/frontend/page-header/page-header.php';

/**
 * Functions which add more to backend.
 */
require get_template_directory() . '/inc/backend/admin-functions.php';

/**
 * Custom metabox for this theme.
 */
require get_template_directory() . '/inc/backend/meta-boxes.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/backend/customizer/customizer.php';

/**
 * Register the required plugins for this theme.
 */
require get_template_directory() . '/inc/backend/plugin-requires.php';
require get_template_directory() . '/inc/backend/importer.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/backend/color.php';

/**
 * Preloader js & css
 */
require get_template_directory() . '/inc/frontend/preloader.php';

/**
 * Elementor functions.
 */

/**
 * Detect plugin. For use on Front End only.
 */

if ( ! function_exists( 'is_plugin_active' ) ) {
    include_once ABSPATH . 'wp-admin/includes/plugin.php';
}
if ( did_action( 'elementor/loaded' ) ) {
	require get_template_directory() . '/inc/backend/elementor/elementor.php';
}
require get_template_directory() . '/inc/frontend/builder.php';

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'woocommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce/woocommerce.php';
}
