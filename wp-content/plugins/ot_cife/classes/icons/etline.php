<?php
namespace Ot_Cife;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/*--------------------------
*   Class Etline Icon Manager
* -------------------------*/
class Ot_Cife_Etline_Design_Icon_Manager{

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

        // Etline icon filter
        add_filter( 'elementor/icons_manager/additional_tabs', [ $this,'ot_cife_etline'] );

    }

	public function ot_cife_etline( $etline_args = array() ) {

	    // Append new icons
	    $etline = array(
			'icon-mobile',
			'icon-laptop',
			'icon-desktop',
			'icon-tablet',
			'icon-phone',
			'icon-document',
			'icon-documents',
			'icon-search',
			'icon-clipboard',
			'icon-newspaper',
			'icon-notebook',
			'icon-book-open',
			'icon-browser',
			'icon-calendar',
			'icon-presentation',
			'icon-picture',
			'icon-pictures',
			'icon-video',
			'icon-camera',
			'icon-printer',
			'icon-toolbox',
			'icon-briefcase',
			'icon-wallet',
			'icon-gift',
			'icon-bargraph',
			'icon-grid',
			'icon-expand',
			'icon-focus',
			'icon-edit',
			'icon-adjustments',
			'icon-ribbon',
			'icon-hourglass',
			'icon-lock',
			'icon-megaphone',
			'icon-shield',
			'icon-trophy',
			'icon-flag',
			'icon-map',
			'icon-puzzle',
			'icon-basket',
			'icon-envelope',
			'icon-streetsign',
			'icon-telescope',
			'icon-gears',
			'icon-key',
			'icon-paperclip',
			'icon-attachment',
			'icon-pricetags',
			'icon-lightbulb',
			'icon-layers',
			'icon-pencil',
			'icon-tools',
			'icon-tools-2',
			'icon-scissors',
			'icon-paintbrush',
			'icon-magnifying-glass',
			'icon-circle-compass',
			'icon-linegraph',
			'icon-mic',
			'icon-strategy',
			'icon-beaker',
			'icon-caution',
			'icon-recycle',
			'icon-anchor',
			'icon-profile-male',
			'icon-profile-female',
			'icon-bike',
			'icon-wine',
			'icon-hotairballoon',
			'icon-globe',
			'icon-genius',
			'icon-map-pin',
			'icon-dial',
			'icon-chat',
			'icon-heart',
			'icon-cloud',
			'icon-upload',
			'icon-download',
			'icon-target',
			'icon-hazardous',
			'icon-piechart',
			'icon-speedometer',
			'icon-global',
			'icon-compass',
			'icon-lifesaver',
			'icon-clock',
			'icon-aperture',
			'icon-quote',
			'icon-scope',
			'icon-alarmclock',
			'icon-refresh',
			'icon-happy',
			'icon-sad',
			'icon-facebook',
			'icon-twitter',
			'icon-googleplus',
			'icon-rss',
			'icon-tumblr',
			'icon-linkedin',
			'icon-dribbble',
	    );
	    
	    $etline_args['ot_cife-etline'] = array(
	        'name'          => 'ot_cife-etline',
	        'label'         => esc_html__( 'Font Etline - Archi', 'ot_cife' ),
	        'labelIcon'     => 'eicon-filter',
	        'prefix'        => '',
	        'displayPrefix' => '',
	        'url'           => OT_CIFE_ASSETS . 'css/etline.css',
	        'icons'         => $etline,
	        'ver'           => OT_CIFE_VER,
	    );

	    return $etline_args;
	}



}
Ot_Cife_Etline_Design_Icon_Manager::instance();