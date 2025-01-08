<?php
function blog_customize_settings() {
	/**
	 * Customizer configuration
	 */

	$settings = array(
		'theme' => 'archi',
	);

	$panels = array(	
	    'blog'        => array(
			'title'      => esc_html__( 'Blog', 'archi' ),
			'priority'   => 10,
			'capability' => 'edit_theme_options',
		),
	);

	$sections = array(
		'blog_page'           => array(
			'title'       => esc_html__( 'Blog Page', 'archi' ),
			'description' => '',
			'priority'    => 10,
			'capability'  => 'edit_theme_options',
			'panel'       => 'blog',
		),
        'single_post'           => array(
			'title'       => esc_html__( 'Single Post', 'archi' ),
			'description' => '',
			'priority'    => 10,
			'capability'  => 'edit_theme_options',
			'panel'       => 'blog',
		),
	);

	$fields = array(
		/* blog settings */
		'blog_layout'           => array(
			'type'        => 'radio-image',
			'label'       => esc_html__( 'Blog Layout', 'archi' ),
			'section'     => 'blog_page',
			'default'     => 'content-sidebar',
			'priority'    => 7,
			'description' => esc_html__( 'Select default sidebar for the blog page.', 'archi' ),
			'choices'     => array(
				'content-sidebar' 	=> get_template_directory_uri() . '/inc/backend/images/right.png',
				'sidebar-content' 	=> get_template_directory_uri() . '/inc/backend/images/left.png',
				'full-content' 		=> get_template_directory_uri() . '/inc/backend/images/full.png',
			)
		),
		'blog_style'           => array(
			'type'        => 'select',
			'label'       => esc_html__( 'Blog Style', 'archi' ),
			'section'     => 'blog_page',
			'default'     => 'list',
			'priority'    => 8,
			'description' => esc_html__( 'Select style default for the blog page.', 'archi' ),
			'choices'     => array(
				'list' 	 => esc_attr__( 'Blog List', 'archi' ),
				'grid' 	 => esc_attr__( 'Blog Grid', 'archi' ),
				'poster' => esc_attr__( 'Blog Poster', 'archi' ),
			),
		),
		'blog_columns'           => array(
			'type'        => 'select',
			'label'       => esc_html__( 'Blog Columns', 'archi' ),
			'section'     => 'blog_page',
			'default'     => 'pf_2_cols',
			'priority'    => 8,
			'description' => esc_html__( 'Select columns default for the blog page.', 'archi' ),
			'choices'     => array(
				'pf_1_cols' => esc_attr__( '1 Column', 'archi' ),
				'pf_2_cols' => esc_attr__( '2 Columns', 'archi' ),
				'pf_3_cols' => esc_attr__( '3 Columns', 'archi' ),
				'pf_4_cols' => esc_attr__( '4 Columns', 'archi' ),
			),
			'active_callback' => array(
				array(
					'setting'  => 'blog_style',
					'operator' => '!=',
					'value'    => 'list',
				),
			),
		),
		'is_fullwidth'     => array(
            'type'        => 'toggle',
            'label'       => esc_attr__( 'Full Width?', 'archi' ),
            'section'     => 'blog_page',
            'default'     => 0,
            'priority'    => 8,
        ),
        'no_gap'     => array(
            'type'        => 'toggle',
            'label'       => esc_attr__( 'No Gap', 'archi' ),
            'section'     => 'blog_page',
            'default'     => 0,
            'priority'    => 8,
            'active_callback' => array(
				array(
					'setting'  => 'blog_style',
					'operator' => '!=',
					'value'    => 'list',
				),
			),
        ),
		
		'post_entry_meta'              => array(
            'type'     => 'multicheck',
            'label'    => esc_html__( 'Entry Meta', 'archi' ),
            'section'  => 'blog_page',
            'default'  => array( 'author', 'cats', 'tag', 'comm' ),
            'choices'  => array(
                'author'  => esc_html__( 'Author', 'archi' ),
                'cats'    => esc_html__( 'Categories', 'archi' ),
                'tag'    => esc_html__( 'Tag', 'archi' ),
                'comm'    => esc_html__( 'Comment', 'archi' ),
            ),
            'priority' => 10,
        ),
        'blog_read_more'      => array(
			'type'            => 'text',
			'label'           => esc_html__( 'Details Button', 'archi' ),
			'section'         => 'blog_page',
			'default'         => esc_html__( 'READ MORE', 'archi' ),
			'priority'        => 11,
		),
		'blog_prev_pagination'      => array(
            'type'            => 'text',
            'label'           => esc_html__( 'Previous pagination label', 'archi' ),
            'section'         => 'blog_page',
            'default'         => esc_html__( 'Prev', 'archi' ),
            'priority'        => 11,
        ),
        'blog_next_pagination'      => array(
            'type'            => 'text',
            'label'           => esc_html__( 'Next pagination label', 'archi' ),
            'section'         => 'blog_page',
            'default'         => esc_html__( 'Next', 'archi' ),
            'priority'        => 11,
        ),
        /* single blog */
        'single_post_layout'           => array(
            'type'        => 'radio-image',
            'label'       => esc_html__( 'Layout', 'archi' ),
            'section'     => 'single_post',
            'default'     => 'content-sidebar',
            'priority'    => 10,
            'choices'     => array(
				'content-sidebar' 	=> get_template_directory_uri() . '/inc/backend/images/right.png',
				'sidebar-content' 	=> get_template_directory_uri() . '/inc/backend/images/left.png',
				'full-content' 		=> get_template_directory_uri() . '/inc/backend/images/full.png',
			)
        ),
        'ptitle_post'               => array(
			'type'            => 'text',
			'label'           => esc_html__( 'Page Title', 'archi' ),
			'section'         => 'single_post',
			'default'         => esc_html__( 'Blog Single', 'archi' ),
			'priority'        => 10,
		),
		'single_separator1'     => array(
			'type'        => 'custom',
			'label'       => esc_html__( 'Social Share', 'archi' ),
			'section'     => 'single_post',
			'default'     => '<hr>',
			'priority'    => 10,
		),
        'post_socials'              => array(
            'type'     => 'multicheck',
            'section'  => 'single_post',
            'default'  => array( 'twit', 'face', 'pint', 'link' ),
            'choices'  => array(
                'twit'  	=> esc_html__( 'Twitter', 'archi' ),
                'face'    	=> esc_html__( 'Facebook', 'archi' ),
                'pint'     	=> esc_html__( 'Pinterest', 'archi' ),
                'link'     	=> esc_html__( 'Linkedin', 'archi' ),
                'google'  	=> esc_html__( 'Google Plus', 'archi' ),
                'tumblr'    => esc_html__( 'Tumblr', 'archi' ),
                'reddit'    => esc_html__( 'Reddit', 'archi' ),
                'vk'     	=> esc_html__( 'VK', 'archi' ),
            ),
            'priority' => 10,
        ),
        'single_separator2'     => array(
			'type'        => 'custom',
			'label'       => esc_html__( 'Entry Footer', 'archi' ),
			'section'     => 'single_post',
			'default'     => '<hr>',
			'priority'    => 10,
		),
        'author_box'      => array(
			'type'        => 'checkbox',
			'label'       => esc_attr__( 'Author Info Box', 'archi' ),
			'section'     => 'single_post',
			'default'     => true,
			'priority'    => 10,
		),
		'post_nav'     	  => array(
			'type'        => 'checkbox',
			'label'       => esc_attr__( 'Post Navigation', 'archi' ),
			'section'     => 'single_post',
			'default'     => true,
			'priority'    => 10,
		),
		'related_post'    => array(
			'type'        => 'checkbox',
			'label'       => esc_attr__( 'Related Posts', 'archi' ),
			'section'     => 'single_post',
			'default'     => true,
			'priority'    => 10,
		),

	);

	$settings['panels']   = apply_filters( 'archi_customize_panels', $panels );
	$settings['sections'] = apply_filters( 'archi_customize_sections', $sections );
	$settings['fields']   = apply_filters( 'archi_customize_fields', $fields );

	return $settings;
}

$archi_customize = new Archi_Customize( blog_customize_settings() );