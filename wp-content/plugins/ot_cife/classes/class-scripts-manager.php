<?php
namespace Ot_Cife;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/*--------------------------
*   Class Scripts Manager
* -------------------------*/
class Ot_Cife_Scripts{

    private static $instance = null;

    public static function instance() {
        if ( is_null( self::$instance ) ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    function __construct(){
        $this->init();
    }

    public function init() {


        // Admin Scripts
        add_action('admin_enqueue_scripts', [ $this, 'enqueue_admin_scripts' ] );        

        // Frontend Scripts
        add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_frontend_scripts' ], 15 );

    }

    /*----------------
    *   Admin Scripts
    * ----------------*/    
    public function enqueue_admin_scripts(){
        
            // ot admin css
            if( is_admin() ){
                wp_enqueue_style(
                    'ot-cife-ot-admin',
                    OT_CIFE_ASSETS . 'css/ot-admin.css',
                    NULL,
                    OT_CIFE_VER
                );
            }

    }

    /*----------------
    *   Enqueue frontend scripts
    * ----------------*/  
    public function enqueue_frontend_scripts() {

        // CSS 
        
        // Elegant design icons css
        if ( ot_cife_get_option( 'elegant', 'ot_cife_manage_icon', 'on' ) == 'on' ){
            wp_enqueue_style(
                'ot-cife-elegant', 
                OT_CIFE_ASSETS . 'css/elegant.css',
                NULL,
                OT_CIFE_VER
            );     
        }

        // Etline design icons css
        if ( ot_cife_get_option( 'etline', 'ot_cife_manage_icon', 'on' ) == 'on' ){
            wp_enqueue_style(
                'ot-cife-etline', 
                OT_CIFE_ASSETS . 'css/etline.css',
                NULL,
                OT_CIFE_VER
            );     
        }

    }

}

Ot_Cife_Scripts::instance();