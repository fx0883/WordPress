<?php

require_once( get_template_directory() . '/inc/backend/elementor/widgets/header/logo.php' );
require_once( get_template_directory() . '/inc/backend/elementor/widgets/header/menu.php' );
require_once( get_template_directory() . '/inc/backend/elementor/widgets/header/menu-hamburger.php' );
require_once( get_template_directory() . '/inc/backend/elementor/widgets/header/search.php' );
require_once( get_template_directory() . '/inc/backend/elementor/widgets/header/menu-mobile.php' );
if ( in_array('ot_mega-menu/ot_mega-menu.php', apply_filters('active_plugins', get_option('active_plugins'))) ){
    require_once( get_template_directory() . '/inc/backend/elementor/widgets/header/list-menu-item.php' );
}
if ( class_exists( 'woocommerce' ) ) {
    require_once( get_template_directory() . '/inc/backend/elementor/widgets/header/cart.php' );
}