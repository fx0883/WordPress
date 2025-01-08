<?php

function archi_preloader_customize_settings() {
	/**
	 * Customizer configuration
	 */

	$settings = array(
		'theme' => 'archi',
	);

	$panels = array(

	);

	$sections = array(
		'preload_section'     => array(
			'title'       => esc_attr__( 'Preloader', 'archi' ),
			'description' => '',
			'priority'    => 22,
			'capability'  => 'edit_theme_options',
		),
	);

	$fields = array(	
        /* preloader */
        'preload'     => array(
            'type'        => 'toggle',
            'label'       => esc_attr__( 'Preloader', 'archi' ),
            'section'     => 'preload_section',
            'default'     => 0,
            'priority'    => 10,
        ),
        'preload_progress_bar_color'    => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Progress Bar Color', 'archi' ),
            'section'  => 'preload_section',
            'default'  => '',
            'priority' => 14,
            'active_callback' => array(
                array(
                    'setting'  => 'preload',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
            'output'    => array(
                array(
                    'element'  => '.archi-jPreLoader #jpreBar',
                    'property' => 'background'
                ),
            ),
        ),
        'preload_bgcolor'    => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Background Color', 'archi' ),
            'section'  => 'preload_section',
            'default'  => '',
            'priority' => 15,
            'active_callback' => array(
                array(
                    'setting'  => 'preload',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
            'output'    => array(
                array(
                    'element'  => '.archi-jPreLoader #jpreOverlay',
                    'property' => 'background'
                ),
            ),
        ),
        'preload_typo' => array(
            'type'        => 'typography',
            'label'       => esc_attr__( 'Percent Preload Font', 'archi' ),
            'section'     => 'preload_section',
            'default'     => array(
                'font-family'    => '',
                'variant'        => '',
                'font-size'      => '',
                'line-height'    => '',
                'letter-spacing' => '',
                'subsets'        => array( 'latin', 'latin-ext' ),
                'color'          => '',
                'text-transform' => '',
            ),
            'priority'    => 16,
            'output'      => array(
                array(
                    'element' => '.archi-jPreLoader #jprePercentage',
                ),
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'preload',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
	);

	$settings['panels']   = apply_filters( 'archi_customize_panels', $panels );
	$settings['sections'] = apply_filters( 'archi_customize_sections', $sections );
	$settings['fields']   = apply_filters( 'archi_customize_fields', $fields );

	return $settings;
}

$archi_customize = new Archi_Customize( archi_preloader_customize_settings() );

if( archi_get_option('preload') != false ){

    function archi_body_classes( $classes ) {

        $classes[] = 'archi-jPreLoader';

        return $classes;
    }
    add_filter( 'body_class', 'archi_body_classes' );

    function archi_preload_scripts() {
        wp_enqueue_style('archi-preload', get_template_directory_uri().'/css/jpreloader.css');
        wp_enqueue_script('archi-preload', get_template_directory_uri()."/js/jpreloader.min.js", array('jquery'), '1.0', true); 
    }
    add_action( 'wp_enqueue_scripts', 'archi_preload_scripts', 9 );

}