<?php
/*Load the theme's custom Widgets so that they appear in the Elementor element panel.*/
add_action( 'elementor/widgets/register', 'archi_register_elementor_widgets' );
function archi_register_elementor_widgets() {
    if ( defined( 'ELEMENTOR_PATH' ) && class_exists('Elementor\Widget_Base') ) {
        /*Include Elementor Widget files here. */
        require_once( get_template_directory() . '/inc/backend/elementor/widgets/widgets.php' );
        require_once( get_template_directory() . '/inc/backend/elementor/widgets/header/widgets.php' );
    }
}

/*Add a custom 'category_archi' category for to the Elementor element panel so that our theme's widgets have their own category.*/
add_action( 'elementor/init', function() {
    \Elementor\Plugin::$instance->elements_manager->add_category( 
        'category_archi',
        [
            'title' => __( 'Archi', 'archi' ),
            'icon' => 'fa fa-plug', /*default icon*/
        ],
        1 /*// position*/
    );
    \Elementor\Plugin::$instance->elements_manager->add_category( 
        'category_archi_header',
        [
            'title' => __( 'OT Header', 'archi' ),
            'icon' => 'fa fa-plug', /*default icon*/
        ],
        2 /*position*/
    );
});

/*Post types with Elementor*/
function archi_add_cpt_support() {
    
    /*if exists, assign to $cpt_support var*/
    $cpt_support = get_option( 'elementor_cpt_support' );
    
    /*check if option DOESN'T exist in db*/
    if( ! $cpt_support ) {
        $cpt_support = [ 'page', 'ot_portfolio', 'ot_header_builders', 'ot_footer_builders' ]; //create array of our default supported post types
        update_option( 'elementor_cpt_support', $cpt_support ); //write it to the database
    }
    
    /*if it DOES exist, but portfolio is NOT defined*/
    else {
        $ot_portfolio       = in_array( 'ot_portfolio', $cpt_support );
        $ot_header_builders = in_array( 'ot_header_builders', $cpt_support );
        $ot_footer_builders = in_array( 'ot_footer_builders', $cpt_support );
        if( !$ot_portfolio ){
            $cpt_support[] = 'ot_portfolio'; //append to array
        }
        if( !$ot_header_builders ){
            $cpt_support[] = 'ot_header_builders'; //append to array
        }
        if( !$ot_footer_builders ){
            $cpt_support[] = 'ot_footer_builders'; //append to array
        }
        update_option( 'elementor_cpt_support', $cpt_support ); //update database
    }
    
    //otherwise do nothing, portfolio already exists in elementor_cpt_support option
}
add_action( 'elementor/init', 'archi_add_cpt_support' );

/*Upload SVG for Elementor*/
function archi_unfiltered_files_upload() {
    
    //if exists, assign to $cpt_support var
    $cpt_support = get_option( 'elementor_unfiltered_files_upload' );
    
    //check if option DOESN'T exist in db
    if( ! $cpt_support ) {
        $cpt_support = '1'; //create string value default to enable upload svg
        update_option( 'elementor_unfiltered_files_upload', $cpt_support ); //write it to the database
    }
}
add_action( 'elementor/init', 'archi_unfiltered_files_upload' );

/**
 * Elementor Add News Custom Fonts
 */

add_filter( 'elementor/fonts/groups', function( $font_groups ) {
    $font_groups['archi_fonts'] = __( 'Archi Additional Fonts', 'archi' );
    return $font_groups;
} );

// Filters the fonts used by Elementor to add additional fonts. //
add_filter( 'elementor/fonts/additional_fonts', function ( $additional_fonts ) {
    $additional_fonts['Instrument Sans'] = 'archi_fonts';
    return $additional_fonts;
} );

/*Header post type*/
add_action( 'init', 'archi_create_header_builder' ); 
function archi_create_header_builder() {
    register_post_type( 'ot_header_builders',
        array(
            'labels' => array(
                'name'              => esc_html__( 'Header Builder', 'archi' ),
                'singular_name'     => esc_html__( 'Header Builder', 'archi' ),
                'add_new'           => esc_html__( 'Add New', 'archi' ),
                'add_new_item'      => esc_html__( 'Add New Header', 'archi' ),
                'edit'              => esc_html__( 'Edit', 'archi' ),
                'edit_item'         => esc_html__( 'Edit Header', 'archi' ),
                'all_items'         => esc_html__( 'All Headers', 'archi' ),
                'new_item'          => esc_html__( 'New Header', 'archi' ),
                'view'              => esc_html__( 'View', 'archi' ),
                'view_item'         => esc_html__( 'View Header', 'archi' ),
                'search_items'      => esc_html__( 'Search Header', 'archi' ),
                'not_found'         => esc_html__( 'No Header found', 'archi' ),
                'not_found_in_trash'=> esc_html__( 'No Header found in Trash', 'archi' ),
                'parent'            => esc_html__( 'Parent Header', 'archi' )
            ),
            'hierarchical'          => false,
            'public'                => false, //false: not show in list Post Type of Elementor because default is enabled using Elementor, can't be disable
            'show_ui'               => true,
            'menu_position'         => 60,
            'supports'              => array( 'title', 'editor' ),
            'menu_icon'             => 'dashicons-editor-kitchensink',
            'publicly_queryable'    => true,
            'exclude_from_search'   => true,
            'has_archive'           => false,
            'query_var'             => true,
            'can_export'            => true,
            'capability_type'       => 'post'
        )
    );
}

/*Footer post type*/
add_action( 'init', 'archi_create_footer_builder' ); 
function archi_create_footer_builder() {
    register_post_type( 'ot_footer_builders',
        array(
            'labels' => array(
                'name'              => esc_html__( 'Footer Builder', 'archi' ),
                'singular_name'     => esc_html__( 'Footer Builder', 'archi' ),
                'add_new'           => esc_html__( 'Add New', 'archi' ),
                'add_new_item'      => esc_html__( 'Add New Footer', 'archi' ),
                'edit'              => esc_html__( 'Edit', 'archi' ),
                'edit_item'         => esc_html__( 'Edit Footer', 'archi' ),
                'all_items'         => esc_html__( 'All Footers', 'archi' ),
                'new_item'          => esc_html__( 'New Footer', 'archi' ),
                'view'              => esc_html__( 'View', 'archi' ),
                'view_item'         => esc_html__( 'View Footer', 'archi' ),
                'search_items'      => esc_html__( 'Search Footer Builders', 'archi' ),
                'not_found'         => esc_html__( 'No Footer found', 'archi' ),
                'not_found_in_trash'=> esc_html__( 'No Footer found in Trash', 'archi' ),
                'parent'            => esc_html__( 'Parent Footer', 'archi' )
            ),
            'hierarchical'          => false,
            'public'                => false, //false: not show in list Post Type of Elementor because default is enabled using Elementor, can't be disable
            'show_ui'               => true,
            'menu_position'         => 60,
            'supports'              => array( 'title', 'editor' ),
            'menu_icon'             => 'dashicons-editor-kitchensink',
            'publicly_queryable'    => true,
            'exclude_from_search'   => true,
            'has_archive'           => false,
            'query_var'             => true,
            'can_export'            => true,
            'capability_type'       => 'post'
        )
    );
}

/*Fix Elementor Pro*/
function archi_register_elementor_locations( $elementor_theme_manager ) {

    $elementor_theme_manager->register_all_core_location();

}
add_action( 'elementor/theme/register_locations', 'archi_register_elementor_locations' );

/* Add options to container */
add_action('elementor/element/container/section_layout_additional_options/after_section_end', function( $container, $args ) {

    /* header options */
    $container->start_controls_section(
        'section_custom_class',
        [
            'label' => __( 'For Header', 'archi' ),
            'tab'   => \Elementor\Controls_Manager::TAB_LAYOUT,
        ]
    );
    $container->start_controls_tabs( 'tabs_header_style' );

    $container->start_controls_tab(
        'tab_header_normal',
        [
            'label' => __( 'Normal', 'archi' ),
        ]
    );
    
    $container->add_control(
        'header_background',
        [
            'label'     => __( 'Header Background', 'archi' ),
            'type'      => Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}}' => 'background: {{VALUE}};',
            ],
        ]
    );
    $container->add_group_control(
        \Elementor\Group_Control_Border::get_type(),
        [
            'name' => 'header_border',
            'selector' => '{{WRAPPER}}',
        ]
    );
    
    $container->end_controls_tab();

    $container->start_controls_tab(
        'tab_header_scroll',
        [
            'label' => __( 'Scroll', 'archi' ),
        ]
    );

    $container->add_control(
        'sticky_background',
        [
            'label'     => __( 'Header Background Scroll', 'archi' ),
            'type'      => Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '.is-stuck {{WRAPPER}}' => 'background: {{VALUE}};',
            ],
        ]
    );

    $container->add_group_control(
        \Elementor\Group_Control_Border::get_type(),
        [
            'name' => 'header_scroll_border',
            'selector' => '.is-stuck {{WRAPPER}}',
        ]
    );

    $container->end_controls_tab();

    $container->end_controls_tabs();

    $container->end_controls_section();

}, 10, 2 );

add_action('elementor/element/container/section_layout_additional_options/before_section_end', function( $container, $args ) {
    $container->add_control(
        'snowy_class',
        [
            'label'        => __( 'Background Jarallax', 'archi' ),
            'type'         => Elementor\Controls_Manager::SWITCHER,
            'return_value' => 'ot-jarallax',
            'prefix_class' => '',
        ]
    );
}, 10, 2 );