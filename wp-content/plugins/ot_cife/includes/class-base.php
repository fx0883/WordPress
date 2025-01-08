<?php
namespace Ot_Cife;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit; 

/*--------------
*   Base Class
* -------------*/
class Ot_Cife_Base{
    
    const MINIMUM_ELEMENTOR_VERSION = '2.0.0';
    const MINIMUM_PHP_VERSION = '5.6';

    private static $_instance = null;

    public static function instance(){
        if( is_null( self::$_instance ) ){
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    function __construct(){
        if ( ! function_exists('is_plugin_active') ){ 
            include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); 
        }
        add_action( 'init', [ $this, 'ot_cife_text_domain' ] );
        add_action( 'plugins_loaded', [ $this, 'init' ] );

    }


    /*--------------------
    *   Load Text Domain
    * -------------------*/    
    public function ot_cife_text_domain() {
        load_plugin_textdomain( 'ot_cife', false, dirname( plugin_basename( OT_CIFE_PL_ROOT ) ) . '/languages/' );
    }


    /*-----------------------------------------
    *   Plugins Loaded Hook Call Back Function
    * ----------------------------------------*/        
    public function init(){

        // Elementor Installed and Activated
        if ( ! did_action( 'elementor/loaded' ) ) {
            add_action( 'admin_notices', [ $this, 'admin_notice_for_missing_elementor' ] );
            return;
        }

        // Minimum Elementor Version Check
        if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
            add_action( 'admin_notices', [ $this, 'admin_notice_for_minimum_elementor_version' ] );
            return;
        }

        // Minimum PHP Version Check
        if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
            add_action( 'admin_notices', [ $this, 'admin_notice_for_minimum_php_version' ] );
            return;
        }

        // Include File
        $this->include_files();

    }

    /*---------------------------------
    *   Notice For Minimum PHP Version
    *---------------------------------*/        
    public function admin_notice_for_minimum_php_version() {
        if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );
        $message = sprintf(
            esc_html__( '"%1$s" requires version %2$s or greater.', 'ot_cife' ),
            '<strong>' . esc_html__( 'PHP', 'ot_cife' ) . '</strong>',
             self::MINIMUM_PHP_VERSION
        );
        printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
    }    

    /*--------------------------------------------
    *   Notice For Elementor Install / Activation
    *--------------------------------------------*/       
    public function admin_notice_for_missing_elementor() {

        $elementor = 'elementor/elementor.php';
        /*
            @function ot_cife_is_plugins_active form helper function file
        */
        if( ot_cife_is_plugins_active( $elementor ) ) {
            if( ! current_user_can( 'activate_plugins' ) ) {
                return;
            }
            $activation_url = wp_nonce_url( 'plugins.php?action=activate&amp;plugin=' . $elementor . '&amp;plugin_status=all&amp;paged=1&amp;s', 'activate-plugin_' . $elementor );

            $message = '<p>' . __( 'Ot - Custom Icons for Elementor are not working because you need to activate the Elementor plugin.', 'ot_cife' ) . '</p>';
            $message .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $activation_url, __( 'Activate Elementor Now', 'ot_cife' ) ) . '</p>';
        } else {
            if ( ! current_user_can( 'install_plugins' ) ) {
                return;
            }
            $install_url = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=elementor' ), 'install-plugin_elementor' );
            $message = '<p>' . __( 'Ot - Custom Icons for Elementor are not working because you need to install the Elementor plugin', 'ot_cife' ) . '</p>';
            $message .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $install_url, __( 'Install Elementor Now', 'ot_cife' ) ) . '</p>';
        }
        echo '<div class="error"><p>' . $message . '</p></div>';
    }


    /*---------------------------------
    *   Notice For Minimum Elementor Version
    *---------------------------------*/        
    public function admin_notice_for_minimum_elementor_version() {
        if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );
        $message = sprintf(
            esc_html__( '"%1$s" requires version %2$s or greater.', 'ot_cife' ),
            '<strong>' . esc_html__( 'Elementor', 'ot_cife' ) . '</strong>',
             self::MINIMUM_ELEMENTOR_VERSION
        );
        printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
    }


    /*---------------
    *   Include File
    * --------------*/     
    public function include_files() {

        // Admin Init file
        if( is_admin() ){
           require( OT_CIFE_PL_PATH.'settings-api/settings-api-init.php' );
        }

        // script manager file
        if ( !file_exists('class-scripts-manager.php') ){
            require( OT_CIFE_PL_PATH . 'classes/class-scripts-manager.php' );
        }       

        // Elegant Design Icon
        if ( ot_cife_get_option( 'elegant', 'ot_cife_manage_icon', 'on') === 'on' && !file_exists('elegant.php') ){
            require( OT_CIFE_PL_PATH . 'classes/icons/elegant.php' );
        }

        // Etline Design Icon
        if ( ot_cife_get_option( 'etline', 'ot_cife_manage_icon', 'on') === 'on' && !file_exists('etline.php') ){
            require( OT_CIFE_PL_PATH . 'classes/icons/etline.php' );
        }
    }


}

