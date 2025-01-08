<?php
function header_customize_settings() {
	/**
	 * Customizer configuration
	 */

	$settings = array(
		'theme' => 'archi',
	);

	$sections = array(
        'main_header'     => array(
            'title'       => esc_html__( 'Header', 'archi' ),
            'description' => '',
            'priority'    => 8,
            'capability'  => 'edit_theme_options',
        ),
	);

	$fields = array(
		/* header settings */
		'header_position'   => array(
			'type'        => 'select',  
	 		'label'       => esc_attr__( 'Select Header Style', 'archi' ), 
	 		'description' => esc_attr__( 'Choose the header style on desktop.', 'archi' ), 
	 		'section'     => 'main_header', 
	 		'default'     => 'header_top', 
	 		'priority'    => 1,
	 		'choices'     => array(
				'header_top' => esc_attr__( 'Header Basic (Top)', 'archi' ),
				'header_left' => esc_attr__( 'Side Navigation', 'archi' ),
			),
		),
        'header_builder'    => array(
            'type'        => 'toggle',
			'label'       => esc_html__( 'Header Builder?', 'archi' ),
			'section'     => 'main_header',
			'default'     => '',
			'priority'    => 1,
        ),
		'header_layout'   => array(
			'type'        => 'select',  
	 		'label'       => esc_attr__( 'Select Header Desktop', 'archi' ), 
	 		'description' => esc_attr__( 'Choose the header on desktop.', 'archi' ), 
	 		'section'     => 'main_header', 
	 		'default'     => '', 
	 		'priority'    => 3,
	 		'placeholder' => esc_attr__( 'Select a header', 'archi' ), 
	 		'choices'     => ( class_exists( 'Kirki_Helper' ) ) ? Kirki_Helper::get_posts( array( 'post_type' => 'ot_header_builders', 'posts_per_page' => -1 ) ) : array(),
	 		'active_callback' => array(
                array(
					'setting'  => 'header_builder',
					'operator' => '=',
					'value'    => '1',
				),
            ),
		),
        'header_mobile'   => array(
			'type'        => 'select',  
	 		'label'       => esc_attr__( 'Select Header Mobile', 'archi' ), 
	 		'description' => esc_attr__( 'Choose the header on mobile.', 'archi' ), 
	 		'section'     => 'main_header', 
	 		'default'     => '', 
	 		'priority'    => 4,
	 		'placeholder' => esc_attr__( 'Select a header', 'archi' ), 
	 		'choices'     => ( class_exists( 'Kirki_Helper' ) ) ? Kirki_Helper::get_posts( array( 'post_type' => 'ot_header_builders', 'posts_per_page' => -1 ) ) : array(),
	 		'active_callback' => array(
                array(
					'setting'  => 'header_builder',
					'operator' => '=',
					'value'    => '1',
				),
            ),
        ),
        'header_fixed'    => array(
            'type'        => 'toggle',
			'label'       => esc_html__( 'Header Fixed? (Only Desktop)', 'archi' ),
            'section'     => 'main_header',
			'default'     => '1',
			'priority'    => 5,
			'active_callback' => array(
                array(
                    'setting'  => 'header_position',
                    'operator' => '==',
                    'value'    => 'header_top',
                ),
            ),
        ),
        'logo_site'  => array(
            'type'     => 'image',
            'label'    => esc_html__( 'Logo', 'archi' ),
            'section'  => 'main_header',
            'default'  => '',
            'priority' => 10,
            'active_callback' => array(
                array(
					'setting'  => 'header_builder',
					'operator' => '=',
					'value'    => '',
				),
            ),
        ),
        'logo_width'  => array(
            'type'     => 'dimensions',
            'label'    => esc_html__( 'Logo Width (Ex: 200px)', 'archi' ),
            'section'  => 'main_header',
            'transport' => 'auto',
            'priority' => 10,
            'choices'   => array(
                'desktop' => esc_attr__( 'Desktop', 'archi' ),
                'tablet'  => esc_attr__( 'Tablet', 'archi' ),
                'mobile'  => esc_attr__( 'Mobile', 'archi' ),
            ),
            'output'   => array(
                array(
                    'choice'      => 'mobile',
                    'element'     => '#site-logo',
                    'property'    => 'width',
                    'media_query' => '@media (max-width: 767px)',
                ),
                array(
                    'choice'      => 'tablet',
                    'element'     => '#site-logo',
                    'property'    => 'width',
                    'media_query' => '@media (min-width: 768px) and (max-width: 1024px)',
                ),
                array(
                    'choice'      => 'desktop',
                    'element'     => '#site-logo',
                    'property'    => 'width',
                    'media_query' => '@media (min-width: 1025px)',
                ),
            ),
            'default' => array(
                'desktop' => '',
                'tablet'  => '',
                'mobile'  => '',
            ),
            'active_callback' => array(
                array(
					'setting'  => 'header_builder',
					'operator' => '=',
					'value'    => '',
				),
            ),
        ),
		
	);

	$settings['sections'] = apply_filters( 'archi_customize_sections', $sections );
	$settings['fields']   = apply_filters( 'archi_customize_fields', $fields );

	return $settings;
}

$archi_customize = new Archi_Customize( header_customize_settings() );