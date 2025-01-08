<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Archi
 */

/** Add body class by filter **/
add_filter( 'body_class', 'archi_body_class_names', 999 );
function archi_body_class_names( $classes ) {
	
	$theme = wp_get_theme();
	if( is_child_theme() ) { $theme = wp_get_theme()->parent(); }

  	$classes[] = 'archi-theme-ver-'.$theme->version;

  	$classes[] = 'wordpress-version-'.get_bloginfo( 'version' );

  	if( archi_get_option('header_position') == 'header_left' ){
		$classes[] = 'header-vertical';
	}else{
		$classes[] = 'header-horizontal';
	}

  	if( !empty( archi_get_option('light_mode') ) ) {
		$classes[] = 'de_light';
	}

  	return $classes;
}

/**
 *  Add attribute dark / light to HTML tag
 */
function archi_dark_light_mode() {
	$mode = '';
	if ( !empty( archi_get_option( 'light_mode' ) ) ){
		$mode = 'light';
	}else{
		$mode = 'dark';
	}
    echo $mode;
}

/**
 *  Add specific CSS class to header
 */
function archi_header_class() {

	$header_classes = '';

	if ( archi_get_option('header_fixed') != false ){
		$header_classes = 'header-fixed';
	}else{
		$header_classes = 'header-static';
	}
	if ( function_exists('rwmb_meta') ) {
		if( rwmb_meta('header_style') == 'h_fixed'){
			$header_classes = 'header-fixed';
		}elseif( rwmb_meta('header_style') == 'h_static'){
			$header_classes = 'header-static';
		}elseif( rwmb_meta('header_style') == 'h_autoshow'){
			$header_classes = 'header-autoshow';
		}elseif( rwmb_meta('header_style') == 'h_bottom'){
			$header_classes = 'header-bottom';
		}

        $header_trans = rwmb_meta('header_is_trans');
        if( !empty( $header_trans ) ){
        	$header_classes  .= ' header-transparent';
        }

        if( is_singular('ot_portfolio') ){
            $portfolio_header_trans = rwmb_meta('portfolio_header_is_trans');
            if( !empty( $portfolio_header_trans ) ){
            	$header_classes  .= ' header-transparent';
            }
        }
        
	}
	if( archi_get_option('header_position') == 'header_left' ){
		$header_classes = 'site-header-vertical';
	}
    echo $header_classes;
}

/* Select blog style */
if ( ! function_exists( 'archi_blog_style' ) ) :
	function archi_blog_style() {

		$blog_style = array();

		// Check if layout is one column.
		if ( archi_get_option( 'blog_style' ) === 'grid' ) {
			$blog_style[] = 'blog-grid';
			$blog_style[] = archi_get_option( 'blog_columns' );
		}elseif( archi_get_option( 'blog_style' ) === 'poster' ){
			$blog_style[] = 'blog-grid poster';
			$blog_style[] = archi_get_option( 'blog_columns' );
		} 
		else {
			$blog_style[] = 'blog-list';
		}

		// return the $classes array
    	echo implode( ' ', $blog_style );
	}
endif;

/* Select blog style layout Full Width */
if ( ! function_exists( 'archi_blog_layout_container' ) ) :
	function archi_blog_layout_container() {

		$class_container = '';

		// Check if layout is one column.
		if ( !empty( archi_get_option( 'is_fullwidth' ) ) ) {
			$class_container = 'container-fluid';
		}else {
			$class_container = 'container';
		}

		// return the $classes array
    	echo $class_container;
	}
endif;

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function archi_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'archi_pingback_header' );

/*Get layout post & page.*/
if ( ! function_exists( 'archi_get_layout' ) ) :
	function archi_get_layout() {
		/*Get layout.*/
		if ( is_page() && !is_home() && function_exists( 'rwmb_meta' ) ) {
			$page_layout = rwmb_meta('page_layout');
		} elseif ( is_single() ) {
			$page_layout = archi_get_option( 'single_post_layout' );
		} else {
			$page_layout = archi_get_option( 'blog_layout' );
		}

		return $page_layout;
	}
endif;

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
if ( ! function_exists( 'archi_content_columns' ) ) :
	function archi_content_columns() {

		$blog_content_width = array();

		/*Check if layout is one column.*/
		if ( 'content-sidebar' === archi_get_layout() && is_active_sidebar( 'primary' ) ) {
			$blog_content_width[] = 'col-lg-8 col-md-8 col-sm-12 col-xs-12';
		}elseif ('sidebar-content' === archi_get_layout() && is_active_sidebar( 'primary' ) ) {
			$blog_content_width[] = 'col-lg-8 col-md-8 col-sm-12 col-xs-12 pull-right';
		}else{
			$blog_content_width[] = 'col-lg-12 col-md-12 col-sm-12 col-xs-12';
		}

		/* Return the $classes Array */
    	echo implode( ' ', $blog_content_width );
	}
endif;

/**
 * Portfolio Columns
 */
if ( ! function_exists( 'archi_portfolio_option_class' ) ) :
	function archi_portfolio_option_class() {

		$portfolio_option_class = array();

		if( archi_get_option('portfolio_column') == "2cl" ){
			$portfolio_option_class[] = 'pf_2_cols';
		}elseif( archi_get_option('portfolio_column') == "4cl" ) {
			$portfolio_option_class[] = 'pf_4_cols';
		}else{
			$portfolio_option_class[] = 'pf_3_cols';
		}

	    /* Return the $classes array */
	    echo implode( ' ', $portfolio_option_class );
	}
endif;

/**
 * Change Posts Per Page for Portfolio Archive.
 * 
 * @param object $query data
 *
 */
function archi_change_portfolio_posts_per_page( $query ) {
	$portfolio_ppp = (!empty( archi_get_option('portfolio_posts_per_page') ) ? archi_get_option('portfolio_posts_per_page') : '6');

	if ( !is_singular() && !is_admin() ) {		
	    if ( $query->is_post_type_archive( 'ot_portfolio' ) || $query->is_tax('portfolio_cat') && ! is_admin() && $query->is_main_query() ) {
	        $query->set( 'posts_per_page', $portfolio_ppp );
	    }
	}
    return $query;
}
add_filter( 'pre_get_posts', 'archi_change_portfolio_posts_per_page' );

/**
 * Load More Ajax Portfolio
 */
add_action( 'wp_enqueue_scripts', 'archi_script_and_styles' );
function archi_script_and_styles() {
	global $wp_query;

	// register our main script but do not enqueue it yet
	wp_enqueue_script( 'archi_scripts', get_template_directory_uri() . '/js/myloadmore.js', array('jquery'), time() );

	// now the most interesting part
	// we have to pass parameters to myloadmore.js script but we can get the parameters values only in PHP
	// you can define variables directly in your HTML but I decided that the most proper way is wp_localize_script()
	wp_localize_script( 'archi_scripts', 'archi_loadmore_params', array(
		'ajaxurl' => admin_url( 'admin-ajax.php' ), // WordPress AJAX
	) );

 	// wp_enqueue_script( 'archi_scripts' );
}

add_action('wp_ajax_loadmore', 'archi_loadmore_ajax_handler'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_loadmore', 'archi_loadmore_ajax_handler'); // wp_ajax_nopriv_{action}

function archi_loadmore_ajax_handler(){
	$offset_items  = ( isset($_POST['offset_items']) ) ? $_POST['offset_items'] : 0;
	$cats     	   = ( isset($_POST['data_cates']) ) ? $_POST['data_cates'] : 0;
	$data_load     = ( isset($_POST['settings']['p_more']) ) ? $_POST['settings']['p_more'] : 3;
	$is_latest	   = '';

	if( $_POST['data_cates'] != '' ){
		$args = array(
			'post_type' 	 => 'ot_portfolio',
			'post_status' 	 => 'publish',
			'posts_per_page' => $data_load,
			'offset'         => $offset_items,
			'tax_query' => array(
				array(
					'taxonomy' => 'portfolio_cat',
					'field' => 'term_id',
					'terms' => explode(",",$cats),
				),
			), 
		);
	}else{
		$args = array(
			'post_type' 	 => 'ot_portfolio',
			'post_status' => 'publish',
			'posts_per_page' => $data_load,
			'offset'         => $offset_items,
		);
	}
	$args_temp = array(
		'settings' => $_POST['settings']
	);

	$wp_query = new \WP_Query($args);
		while ($wp_query -> have_posts()) : $wp_query -> the_post();
			if( ($offset_items + $data_load) >= ($wp_query->found_posts) ) {
				$is_latest = 'latest';
			};
			$args_temp['is_latest'] = $is_latest;
			if( $_POST['settings']['widget_name'] == 'ot-portfolio-creative-filter' ){
				get_template_part( 'template-parts/content', 'project-creative-filter', $args_temp);
			}else{
				get_template_part( 'template-parts/content', 'project-filter', $args_temp);
			}
			
		endwhile; wp_reset_postdata();

	die;
}

/**
 * Back-To-Top on Footer
 */
if( !function_exists('archi_custom_back_to_top') ) {
    function archi_custom_back_to_top() {     
	    if( archi_get_option('backtotop') != false ){
	    	echo '<a id="back-to-top" href="#" class="show"><i class="fa fa-angle-up"></i></a>';
	    }
    }
}
add_action('wp_footer', 'archi_custom_back_to_top');

/**
 * Google Analytics
 */
if ( ! function_exists( 'archi_hook_javascript' ) ) {
	function archi_hook_javascript() {
		if ( archi_get_option('js_code') != '' ) {
	    ?>
	    	<!-- Google Analytics code -->
	    	<script type="text/javascript">
	            <?php echo archi_get_option('js_code'); ?>
	        </script>
	    <?php
	    }
	}
}
add_action('wp_head', 'archi_hook_javascript');