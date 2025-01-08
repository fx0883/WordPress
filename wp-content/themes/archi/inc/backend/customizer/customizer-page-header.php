<?php
function page_header_customize_settings() {
    /**
     * Customizer configuration
     */

    $settings = array(
        'theme' => 'archi',
    );

    $sections = array(
        'page_header'     => array(
            'title'       => esc_html__( 'Page Header', 'archi' ),
            'description' => '',
            'priority'    => 9,
            'capability'  => 'edit_theme_options',
        ),
    );

    $fields = array(
        /*page header */
        'pheader_switch'  => array(
            'type'        => 'toggle',
            'label'       => esc_html__( 'Page Header On/Off', 'archi' ),
            'section'     => 'page_header',
            'default'     => 1,
            'priority'    => 10,
        ),
        'breadcrumbs'     => array(
            'type'        => 'toggle',
            'label'       => esc_html__( 'Breadcrumbs On/Off', 'archi' ),
            'section'     => 'page_header',
            'default'     => 1,
            'priority'    => 10,
            'active_callback' => array(
                array(
                    'setting'  => 'pheader_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'pheader_separator1'     => array(
            'type'        => 'custom',
            'label'       => esc_html__( '', 'archi' ),
            'section'     => 'page_header',
            'default'     => '<hr>',
            'priority'    => 10,
            'active_callback' => array(
                array(
                    'setting'  => 'pheader_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'pheader_img'  => array(
            'type'     => 'image',
            'label'    => esc_html__( 'Background Image', 'archi' ),
            'section'  => 'page_header',
            'default'  => get_template_directory_uri() . '/images/bg-pheader-default.jpg',
            'priority' => 10,
            // 'output'    => array(
            //     array(
            //         'element'  => '.page-header',
            //         'property' => 'background-image'
            //     ),
            // ),
            'active_callback' => array(
                array(
                    'setting'  => 'pheader_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'pheader_color'    => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Background Color', 'archi' ),
            'section'  => 'page_header',
            'priority' => 10,
            'output'    => array(
                array(
                    'element'  => '.page-header',
                    'property' => 'background-color'
                ),
            ),
            'transport'   => 'postMessage',
            'js_vars'     => array(
                array(
                    'element'  => '.page-header',
                    'function' => 'css',
                    'property' => 'background-color',
                ),
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'pheader_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'ptitle_color'    => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Primary Color', 'archi' ),
            'section'  => 'page_header',
            'priority' => 10,
            'output'    => array(
                array(
                    'element'  => '.page-header .breadcrumbs li a',
                    'property' => 'color'
                ),
            ),
            'transport'   => 'postMessage',
            'js_vars'     => array(
                array(
                    'element'  => '.page-header .breadcrumbs li a',
                    'function' => 'css',
                    'property' => 'color',
                ),
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'pheader_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'bread_color'    => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Second Color', 'archi' ),
            'section'  => 'page_header',
            'priority' => 10,
            'output'    => array(
                array(
                    'element'  => '.page-header .page-title, .page-header .page-subtitle, .page-header .breadcrumbs',
                    'property' => 'color'
                ),
            ),
            'transport'   => 'postMessage',
            'js_vars'     => array(
                array(
                    'element'  => '.page-header .page-title, .page-header .page-subtitle, .page-header .breadcrumbs',
                    'function' => 'css',
                    'property' => 'color',
                ),
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'pheader_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
                array(
                    'setting'  => 'breadcrumbs',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'pheader_top'  => array(
            'type'     => 'number',
            'label'    => esc_html__( 'Margin Top(px)', 'archi' ),
            'section'  => 'page_header',
            'priority' => 10,
            'default'  => '',
            'output'    => array(
                array(
                    'element'  => '.page-header .inner',
                    'property' => 'margin-top',
                    'units'    => 'px'
                ),
            ),
            'transport'   => 'postMessage',
            'js_vars'     => array(
                array(
                   'element'  => '.page-header .inner',
                    'function' => 'css',
                    'property' => 'margin-top',
                    'units'    => 'px'
                ),
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'pheader_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'pheader_ptop'  => array(
            'type'        => 'dimensions',
            'label'       => esc_html__( 'Padding Top (Ex: 100px)', 'archi' ),
            'section'     => 'page_header',    
            'priority' => 10,
            'choices'   => array(
                'desktop' => esc_attr__( 'Desktop', 'archi' ),
                'tablet'  => esc_attr__( 'Tablet', 'archi' ),
                'mobile'  => esc_attr__( 'Mobile', 'archi' ),
            ),
            'output'   => array(
                array(
                    'choice'      => 'mobile',
                    'element'     => '.page-header',
                    'property'    => 'padding-top',
                    'media_query' => '@media (max-width: 767px)',
                ),
                array(
                    'choice'      => 'tablet',
                    'element'     => '.page-header',
                    'property'    => 'padding-top',
                    'media_query' => '@media (min-width: 768px) and (max-width: 1024px)',
                ),
                array(
                    'choice'      => 'desktop',
                    'element'     => '.page-header',
                    'property'    => 'padding-top',
                    'media_query' => '@media (min-width: 1024px)',
                ),
            ),
            'default' => array(
                'desktop' => '',
                'tablet'  => '',
                'mobile'  => '',
            ),
            'transport'   => 'postMessage',
            'js_vars'     => array(
                array(
                   'element'  => '.page-header',
                    'function' => 'css',
                    'property' => 'padding-top',
                    'units'    => 'px'
                ),
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'pheader_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'pheader_pbottom'  => array(
            'type'        => 'dimensions',
            'label'       => esc_html__( 'Padding Bottom (Ex: 100px)', 'archi' ),
            'section'     => 'page_header',         
            'priority' => 10,
            'choices'   => array(
                'desktop' => esc_attr__( 'Desktop', 'archi' ),
                'tablet'  => esc_attr__( 'Tablet', 'archi' ),
                'mobile'  => esc_attr__( 'Mobile', 'archi' ),
            ),
            'output'   => array(
                array(
                    'choice'      => 'mobile',
                    'element'     => '.page-header',
                    'property'    => 'padding-bottom',
                    'media_query' => '@media (max-width: 767px)',
                ),
                array(
                    'choice'      => 'tablet',
                    'element'     => '.page-header',
                    'property'    => 'padding-bottom',
                    'media_query' => '@media (min-width: 768px) and (max-width: 1024px)',
                ),
                array(
                    'choice'      => 'desktop',
                    'element'     => '.page-header',
                    'property'    => 'padding-bottom',
                    'media_query' => '@media (min-width: 1024px)',
                ),
            ),
            'default' => array(
                'desktop' => '',
                'tablet'  => '',
                'mobile'  => '',
            ),
            'transport'   => 'postMessage',
            'js_vars'     => array(
                array(
                   'element'  => '.page-header',
                    'function' => 'css',
                    'property' => 'padding-bottom',
                    'units'    => 'px'
                ),
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'pheader_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'pheader_height'  => array(
            'type'     => 'dimensions',
            'label'    => esc_html__( 'Page Header Height (Min: 160px)', 'archi' ),
            'section'  => 'page_header',
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
                    'element'     => '.page-header',
                    'property'    => 'height',
                    'media_query' => '@media (max-width: 767px)',
                ),
                array(
                    'choice'      => 'tablet',
                    'element'     => '.page-header',
                    'property'    => 'height',
                    'media_query' => '@media (min-width: 768px) and (max-width: 1024px)',
                ),
                array(
                    'choice'      => 'desktop',
                    'element'     => '.page-header',
                    'property'    => 'height',
                    'media_query' => '@media (min-width: 1024px)',
                ),
            ),
            'default' => array(
                'desktop' => '',
                'tablet'  => '',
                'mobile'  => '',
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'pheader_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'pheader_separator2'     => array(
            'type'        => 'custom',
            'label'       => esc_html__( '', 'archi' ),
            'section'     => 'page_header',
            'default'     => '<hr>',
            'priority'    => 10,
            'active_callback' => array(
                array(
                    'setting'  => 'pheader_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'pheader_htmltag'   => array(
            'type'          => 'select',
            'label'         => esc_html__( 'Page Title HTML Tag', 'archi' ),
            'section'       => 'page_header',
            'default'       => 'h1',
            'priority'      => 10,            
            'placeholder'   => esc_html__( 'Choose an html tag', 'archi' ),
            'choices'       => array(
                'h1'        => esc_html__( 'H1', 'archi' ),
                'h2'        => esc_html__( 'H2', 'archi' ),
                'h3'        => esc_html__( 'H3', 'archi' ),
                'h4'        => esc_html__( 'H4', 'archi' ),
                'h5'        => esc_html__( 'H5', 'archi' ),
                'h6'        => esc_html__( 'H6', 'archi' ),
                'span'      => esc_html__( 'SPAN', 'archi' ),
                'p'         => esc_html__( 'P', 'archi' ),
                'div'       => esc_html__( 'DIV', 'archi' ),             
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'pheader_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'ptitle_typo'=> array(
            'type'     => 'typography',
            'label'    => esc_html__( 'Page Title Typography', 'archi' ),
            'section'  => 'page_header',
            'priority' => 10,
            'default'  => array(
                'font-family'    => '',
                'variant'        => '',
                'font-size'      => '',
                'line-height'    => '',
                'letter-spacing' => '',
                'subsets'        => array( 'latin', 'latin-ext' ),
                'color'          => '',
                'text-transform' => '',
            ),
            'output'      => array(
                array(
                    'element' => '.page-header .page-title',
                ),
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'pheader_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'psubtitle_typo'=> array(
            'type'     => 'typography',
            'label'    => esc_html__( 'Page Sub Title Typography', 'archi' ),
            'section'  => 'page_header',
            'priority' => 10,
            'default'  => array(
                'font-family'    => '',
                'variant'        => '',
                'font-size'      => '',
                'line-height'    => '',
                'letter-spacing' => '',
                'subsets'        => array( 'latin', 'latin-ext' ),
                'color'          => '',
                'text-transform' => '',
            ),
            'output'      => array(
                array(
                    'element' => '.page-header .page-subtitle',
                ),
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'pheader_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        // Page Header Contact Info 
        'pheader_separator3'     => array(
            'type'        => 'custom',
            'label'       => '',
            'section'     => 'page_header',
            'default'     => '<hr>',
            'priority'    => 11,
        ),
        'pheader_info_switch'     => array(
            'type'        => 'toggle',
            'label'       => esc_attr__( 'Page Header Info On/Off?', 'archi' ),
            'section'     => 'page_header',
            'default'     => '',
            'priority'    => 11,
        ),
        'pheader_contact_info'     => array(
            'type'     => 'repeater',
            'label'    => esc_html__( 'Content', 'archi' ),
            'section'  => 'page_header',
            'priority' => 11,
            'row_label' => array(
                'type' => 'field',
                'value' => esc_attr__('Contact Info', 'archi' ),
                'field' => 'info_title',
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'pheader_info_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
            'default'  => array(),
            'fields'   => array(
                'info_icon' => array(
                    'type'        => 'text',
                    'label'       => esc_html__( 'Icon Code', 'archi' ),
                    'default'     => '',
                ),
                'info_title' => array(
                    'type'        => 'text',
                    'label'       => esc_html__( 'Title', 'archi' ),
                    'default'     => '',
                ),
                'info_desc' => array(
                    'type'        => 'textarea',
                    'label'       => esc_html__( 'Description', 'archi' ),
                    'default'     => '',
                ),              
            ),
        ),
        'pheader_info_icon_color'    => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Icon Color', 'archi' ),
            'section'  => 'page_header',
            'priority' => 11,
            'output'    => array(
                array(
                    'element'  => '.page-header-contact-info .info-box-icon',
                    'property' => 'color'
                ),
            ),
            'transport'   => 'postMessage',
            'js_vars'     => array(
                array(
                    'element'  => '.page-header-contact-info .info-box-icon',
                    'function' => 'css',
                    'property' => 'color',
                ),
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'pheader_info_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'pheader_info_text_color'    => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Text Color', 'archi' ),
            'section'  => 'page_header',
            'priority' => 11,
            'output'    => array(
                array(
                    'element'  => '.info-box_text, .page-header-contact-info .info-box_title',
                    'property' => 'color'
                ),
            ),
            'transport'   => 'postMessage',
            'js_vars'     => array(
                array(
                    'element'  => '.info-box_text, .page-header-contact-info .info-box_title',
                    'function' => 'css',
                    'property' => 'color',
                ),
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'pheader_info_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'pheader_info_bgcolor'    => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Background Primary', 'archi' ),
            'section'  => 'page_header',
            'priority' => 11,
            'output'    => array(
                array(
                    'element'  => '.page-header .bg-color',
                    'property' => 'background-color'
                ),
            ),
            'transport'   => 'postMessage',
            'js_vars'     => array(
                array(
                    'element'  => '.page-header .bg-color',
                    'function' => 'css',
                    'property' => 'background-color',
                ),
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'pheader_info_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'pheader_info_bgcolor2'    => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Background Second', 'archi' ),
            'section'  => 'page_header',
            'priority' => 11,
            'output'    => array(
                array(
                    'element'  => '.page-header-contact-info',
                    'property' => 'background-color'
                ),
            ),
            'transport'   => 'postMessage',
            'js_vars'     => array(
                array(
                    'element'  => '.page-header-contact-info',
                    'function' => 'css',
                    'property' => 'background-color',
                ),
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'pheader_info_switch',
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

$archi_customize = new Archi_Customize( page_header_customize_settings() );