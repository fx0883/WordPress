<?php
/**
 * Registering meta boxes
 *
 * Using Meta Box plugin: http://www.deluxeblogtips.com/meta-box/
 *
 * @see https://docs.metabox.io/
 *
 * @param array $meta_boxes Default meta boxes. By default, there are no meta boxes.
 *
 * @return array All registered meta boxes
 */
function archi_register_meta_boxes( $meta_boxes ) {
	
	/*Post format's meta box*/
	$meta_boxes[] = array(
		'id'       => 'format_detail',
		'title'    => esc_html__( 'Post Format Details', 'archi' ),
		'pages'    => array( 'post' ),
		'context'  => 'normal',
		'priority' => 'high',
		'autosave' => true,
		'fields'   => array(
			array(
				'name'             => esc_html__( 'Image', 'archi' ),
				'id'               => 'post_image',
				'type'             => 'image_advanced',
				'class'            => 'image',
				'max_file_uploads' => 1,
				/*Image size that displays in the edit page. Possible sizes small,medium,large,original*/
    			'image_size'       => 'thumbnail',
			),
			array(
				'name'  			=> esc_html__( 'Gallery', 'archi' ),
				'id'    			=> 'post_gallery',
				'type'  			=> 'image_advanced',
				'class' 			=> 'gallery',
				/*Image size that displays in the edit page. Possible sizes small,medium,large,original*/
    			'image_size'       	=> 'thumbnail',
			),			
			array(
				'name'  => esc_html__( 'Audio', 'archi' ),
				'id'    => 'post_audio',
				'type'  => 'textarea',
				'cols'  => 20,
				'rows'  => 2,
				'class' => 'audio',
				'desc'  => 'Example: https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/139083759',
			),
			array(
				'name'  => esc_html__( 'Video', 'archi' ),
				'id'    => 'post_video',
				'type'  => 'textarea',
				'cols'  => 20,
				'rows'  => 2,
				'class' => 'video',
				'desc'  => 'Example: https://vimeo.com/87959439',
			),
			array(
				'name'  => esc_html__( 'Background Video', 'archi' ),
				'id'    => 'bg_video',
				'type'  => 'image_advanced',
				'class' => 'video',
				'max_file_uploads' => 1,
			),
			array(
				'name'  => esc_html__( 'Link', 'archi' ),
				'id'    => 'post_link',
				'type'  => 'textarea',
				'cols'  => 20,
				'rows'  => 2,
				'class' => 'link',
			),
			array(
				'name'  => esc_html__( 'Text Link', 'archi' ),
				'id'    => 'text_link',
				'type'  => 'textarea',
				'cols'  => 20,
				'rows'  => 2,
				'class' => 'link',
			),
			array(
				'name'  => esc_html__( 'Quote', 'archi' ),
				'id'    => 'post_quote',
				'type'  => 'textarea',
				'class' => 'quote',
			),
			array(
				'name'  => esc_html__( 'Quote Name', 'archi' ),
				'id'    => 'quote_name',
				'type'  => 'text',
				'class' => 'quote',
			)		
		),
	);

	/*Page Settings*/
	$meta_boxes[] = array(
		'id'       => 'page-settings',
		'title'    => esc_html__( 'Page Settings', 'archi' ),
		'pages'    => array( 'page' ),
		'context'  => 'normal',
		'priority' => 'high',
		'autosave' => true,
		'fields'   => array(
            array(
                'id'        			=> 'page_layout',
                'name'      			=> esc_html__( 'Page Layout', 'archi' ),
                'type'      			=> 'image_select',
                'options'   			=> array(
                    'full-content'    	=> get_template_directory_uri() . '/inc/backend/images/full.png',
                    'content-sidebar' 	=> get_template_directory_uri() . '/inc/backend/images/right.png',
                    'sidebar-content' 	=> get_template_directory_uri() . '/inc/backend/images/left.png',
                ),
                'std'       			=> 'full-content'
            ),
            array(
                'name'             => esc_html__( 'Page Header On/Off', 'archi' ),
                'id'               => 'pheader_switch',
                'type'             => 'switch',
                'style'            => 'rounded',
                'on_label'         => esc_html__( 'On', 'archi' ),
                'off_label'        => esc_html__( 'Off', 'archi' ),
                'std'              => 'on'
            ),
            array(
                'name'             => esc_html__( 'Background Page Header', 'archi' ),
                'id'               => 'pheader_bg_image',
                'type'             => 'image_advanced',
                'max_file_uploads' => 1,
            ),
            array(
				'name'  => esc_html__( 'Sub Title', 'archi' ),
				'id'    => 'page_subtitle',
				'type'  => 'textarea',
				'cols'  => 20,
				'rows'  => 2,
			),
		),
	);
    
	$meta_boxes[] = array (
      	'id' 			=> 'select-header-footer',
      	'title' 		=> esc_html__( 'Header/Footer Settings', 'archi' ),
      	'pages' 		=> array ('page'),
      	'context' 		=> 'normal',
      	'priority' 		=> 'high',
      	'autosave' 		=> false,
      	'fields' 		=>   array (  
		    array(
            	'name'             => esc_html__( 'Header Transparent On/Off', 'archi' ),
                'id'        	   => 'header_is_trans',
               	'type'             => 'switch',
                'style'            => 'rounded',
                'on_label'         => esc_html__( 'On', 'archi' ),
                'off_label'        => esc_html__( 'Off', 'archi' ),
                'std'              => ''
            ),
        	array(
        		'name' 					=> esc_html__( 'Header Layout', 'archi' ),
				'id' 					=> 'select_header',
				'type'  				=> 'post',
		    	'post_type'   			=> 'ot_header_builders',
		    	'field_type'  			=> 'select_advanced',
		    	'placeholder' 			=> esc_html__( 'Select a header', 'archi' ),
		    	'query_args'  			=> array(
		        	'post_status'    	=> 'publish',
		        	'posts_per_page' 	=> - 1,
		        	'orderby' 		 	=> 'date',
		        	'order' 		 	=> 'ASC',
		    	),
			),
			array(
                'name'             					=> esc_html__( 'Select Header Style', 'archi' ),
                'id'               					=> 'header_style',
				'type'             					=> 'select',
				'options'   						=> array(
                    'default'   					=> esc_html__( 'Default', 'archi' ),
                    'h_fixed'						=> esc_html__( 'Header Fixed', 'archi' ),
                    'h_static' 						=> esc_html__( 'Header Static', 'archi' ),
                    'h_autoshow' 					=> esc_html__( 'Header Auto Show', 'archi' ),
                    'h_bottom' 						=> esc_html__( 'Header Bottom', 'archi' ),
                ),
                'std'       			=> 'default'
            ),
			array(
        		'name' 					=> esc_html__( 'Header Mobile Layout', 'archi' ),
				'id' 					=> 'select_header_mobile',
				'type'  				=> 'post',
		    	'post_type'   			=> 'ot_header_builders',
		    	'field_type'  			=> 'select_advanced',
		    	'placeholder' 			=> esc_html__( 'Select a header mobile', 'archi' ),
		    	'query_args'  			=> array(
		        	'post_status'    	=> 'publish',
		        	'posts_per_page' 	=> - 1,
		        	'orderby' 		 	=> 'date',
		        	'order' 		 	=> 'ASC',
		    	),
			),
			array (
        		'name' 					=> esc_html__( 'Footer Layout', 'archi' ),
				'id' 					=> 'select_footer',
				'type'  				=> 'post',
		    	'post_type'   			=> 'ot_footer_builders',
		    	'field_type'  			=> 'select_advanced',
		    	'placeholder' 			=> esc_html__( 'Select a footer', 'archi' ),
		    	'query_args'  			=> array(
		        	'post_status'    	=> 'publish',
		        	'posts_per_page' 	=> - 1,
		        	'orderby' 		 	=> 'date',
		        	'order' 		 	=> 'ASC',
		    	),
        	),
      	),
	);

	$meta_boxes[] = array(
        'id'       => 'ppheader-settings',
        'title'    => esc_html__( 'Page Header Settings', 'archi' ),
        'pages'    => array( 'ot_portfolio' ),
        'context'  => 'normal',
        'priority' => 'high',
        'autosave' => true,
        'fields'   => array(
        	array(
            	'name'             => esc_html__( 'Header Transparent On/Off', 'archi' ),
                'id'        	   => 'portfolio_header_is_trans',
               	'type'             => 'switch',
                'style'            => 'rounded',
                'on_label'         => esc_html__( 'On', 'archi' ),
                'off_label'        => esc_html__( 'Off', 'archi' ),
                'std'              => ''
            ),
            array(
                'name'             => esc_html__( 'Page Header On/Off', 'archi' ),
                'id'               => 'pheader_switch',
                'type'             => 'switch',
                'style'            => 'rounded',
                'on_label'         => 'On',
                'off_label'        => 'Off',
                'std'              => 'on'
            ),
            array(
                'name'             => esc_html__( 'Background Page Header', 'archi' ),
                'id'               => 'pheader_bg_image',
                'type'             => 'image_advanced',
                'max_file_uploads' => 1,
			),
			array(
				'name'  => esc_html__( 'Sub Title', 'archi' ),
				'id'    => 'page_subtitle',
				'type'  => 'textarea',
				'cols'  => 20,
				'rows'  => 2,
			),
        ),
	);

	$meta_boxes[] = array(
        'id'       => 'pthumb-settings',
        'title'    => esc_html__( 'Portfolio Featured Image Settings', 'archi' ),
        'pages'    => array( 'ot_portfolio' ),
        'context'  => 'normal',
        'priority' => 'high',
        'autosave' => true,
        'fields'   => array(
            array(
                'id'        => 'thumb_size',
                'name'      => esc_html__( 'Select Size', 'archi' ),
                'type'      => 'select',
                'options'   => array(
                    'normal' 	  => 'Normal Size',
                    'width2x'     => 'Double Width',
                ),
                'std'       => 'normal'
            ),
        ),
    );

	return $meta_boxes;
}

add_filter( 'rwmb_meta_boxes', 'archi_register_meta_boxes' );
