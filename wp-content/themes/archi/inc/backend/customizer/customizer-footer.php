<?php
function footer_customize_settings() {
	/**
	 * Customizer configuration
	 */

	$settings = array(
		'theme' => 'archi',
	);

	$sections = array(				
        // Footer Customize Panel
	    'footer'         => array(
			'title'      => esc_html__( 'Footer', 'archi' ),
			'priority'   => 10,
			'capability' => 'edit_theme_options',
		),
	);

	$fields = array(		
		/* footer settings */
		'footer_layout'     => array(
			'type'        => 'select',  
	 		'label'       => esc_attr__( 'Select Footer', 'archi' ), 
	 		'description' => esc_attr__( 'Choose a footer for all site here.', 'archi' ), 
	 		'section'     => 'footer', 
	 		'default'     => '', 
	 		'priority'    => 1,
	 		'placeholder' => esc_attr__( 'Select a footer', 'archi' ), 
	 		'choices'     => ( class_exists( 'Kirki_Helper' ) ) ? Kirki_Helper::get_posts( array( 'post_type' => 'ot_footer_builders', 'posts_per_page' => -1 ) ) : array(),
		),
		'backtotop_separator'     => array(
			'type'        => 'custom',
			'label'       => '',
			'section'     => 'footer',
			'default'     => '<hr>',
			'priority'    => 2,
		),
		'backtotop'  => array(
            'type'        => 'toggle',
            'label'       => esc_html__( 'Back To Top On/Off?', 'archi' ),
            'section'     => 'footer',
            'default'     => 1,
            'priority'    => 3,
        ),
        'bg_backtotop'    => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Background Color', 'archi' ),
            'section'  => 'footer',
            'priority' => 4,
            'default'     => '',
            'output'    => array(
                array(
                    'element'  => '#back-to-top',
                    'property' => 'background',
                ),
            ),
            'active_callback' => array(
				array(
					'setting'  => 'backtotop',
					'operator' => '==',
					'value'    => 1,
				),
			),
        ),
        'color_backtotop' => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Color', 'archi' ),
            'section'  => 'footer',
            'priority' => 5,
            'default'     => '',
            'output'    => array(
                array(
                    'element'  => '#back-to-top > i:before',
                    'property' => 'color',
                )
            ),
            'active_callback' => array(
				array(
					'setting'  => 'backtotop',
					'operator' => '==',
					'value'    => 1,
				),
			),
        ),
        'spacing_backtotop' => array(
            'type'     => 'dimensions',
            'label'    => esc_html__( 'Spacing', 'archi' ),
            'section'  => 'footer',
            'priority' => 6,
            'default'     => array(
				'bottom'  => '',
				'right' => '',
			),
			'choices'     => array(
				'labels' => array(
					'bottom'  => esc_html__( 'Bottom (Ex: 20px)', 'archi' ),
					'right'   => esc_html__( 'Right (Ex: 20px)', 'archi' ),
				),
			),
            'output'    => array(
                array(
                    'choice'      => 'bottom',
                    'element'     => '#back-to-top.show',
                    'property'    => 'bottom',
                ),
                array(
                    'choice'      => 'right',
                    'element'     => '#back-to-top.show',
                    'property'    => 'right',
                ),
            ),
            'active_callback' => array(
				array(
					'setting'  => 'backtotop',
					'operator' => '==',
					'value'    => 1,
				),
			),
		),
	);

	$settings['sections'] = apply_filters( 'archi_customize_sections', $sections );
	$settings['fields']   = apply_filters( 'archi_customize_fields', $fields );

	return $settings;
}

$archi_customize = new Archi_Customize( footer_customize_settings() );