<?php
/**
 * Plugin Name: Font Custom - Archi
 * Description: Custom icons for Elementor is a fantastic custom Elementor icons plugin for the Elementor page builder. Increase Elementor icons library using the plugin. it's a perfect Elementor custom icons plugin for website owners.
 * Version:     1.0
 * Author:      OceanThemes
 * License:     GPL2
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: ot_cife
 * Domain Path: /languages
**/

	// Exit if accessed directly
	if ( ! defined( 'ABSPATH' ) ) exit; 

	// Define Useful Contastant
	define( 'OT_CIFE_VER', '1.0' );
	define( 'OT_CIFE_PL_ROOT', __FILE__ );
	define( 'OT_CIFE_PL_URL', plugin_dir_url(  OT_CIFE_PL_ROOT ) );
	define( 'OT_CIFE_PL_PATH', plugin_dir_path( OT_CIFE_PL_ROOT ) );
	define( 'OT_CIFE_PLUGIN_BASE', plugin_basename( OT_CIFE_PL_ROOT ) );
	define( 'OT_CIFE_ASSETS', trailingslashit( OT_CIFE_PL_URL . 'assets' ) );

	// Include base class file
	if ( !file_exists('class-base.php') ){
		require ( OT_CIFE_PL_PATH . 'includes/class-base.php' );
	}

    // Helper Function
    if ( !file_exists('helper-functions.php') ){
        require( OT_CIFE_PL_PATH . 'includes/helper-functions.php' );
    }
	 
	// Instance
	\Ot_Cife\Ot_Cife_Base::instance();

