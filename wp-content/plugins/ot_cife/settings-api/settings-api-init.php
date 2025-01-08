<?php
// Exit if accessed directly
if( ! defined( 'ABSPATH' ) ) exit(); 

class Ot_Cife_Admin_Setting_Init{

    public function __construct(){
        //add_action('admin_enqueue_scripts', [ $this, 'enqueue_scripts' ] );
        $this->ot_cife_admin_settings_page();
    }

    /*
    *  Setting Page
    */
    public function ot_cife_admin_settings_page() {
        if ( !file_exists('class.settings-api.php') ){
            require_once('class.settings-api.php');
        }
        if ( !file_exists('settings-fields.php') ){
            require_once('settings-fields.php');
        }    
    }


}

new Ot_Cife_Admin_Setting_Init();