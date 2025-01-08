<?php
/**
 * Theme customizer
 *
 * @package Archi
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Archi_Customize {
	/**
	 * Customize settings
	 *
	 * @var array
	 */
	protected $config = array();

	/**
	 * The class constructor
	 *
	 * @param array $config
	 */
	public function __construct( $config ) {
		$this->config = $config;

		if ( ! class_exists( 'Kirki' ) ) {
			return;
		}

		$this->register();
	}

	/**
	 * Register settings
	 */
	public function register() {

		/**
		 * Add the theme configuration
		 */
		if ( ! empty( $this->config['theme'] ) ) {
			Kirki::add_config(
				$this->config['theme'], array(
					'capability'  => 'edit_theme_options',
					'option_type' => 'theme_mod',
				)
			);
		}

		/**
		 * Add panels
		 */
		if ( ! empty( $this->config['panels'] ) ) {
			foreach ( $this->config['panels'] as $panel => $settings ) {
				Kirki::add_panel( $panel, $settings );
			}
		}

		/**
		 * Add sections
		 */
		if ( ! empty( $this->config['sections'] ) ) {
			foreach ( $this->config['sections'] as $section => $settings ) {
				Kirki::add_section( $section, $settings );
			}
		}

		/**
		 * Add fields
		 */
		if ( ! empty( $this->config['theme'] ) && ! empty( $this->config['fields'] ) ) {
			foreach ( $this->config['fields'] as $name => $settings ) {
				if ( ! isset( $settings['settings'] ) ) {
					$settings['settings'] = $name;
				}

				Kirki::add_field( $this->config['theme'], $settings );
			}
		}
	}

	/**
	 * Get config ID
	 *
	 * @return string
	 */
	public function get_theme() {
		return $this->config['theme'];
	}

	/**
	 * Get customize setting value
	 *
	 * @param string $name
	 *
	 * @return bool|string
	 */
	public function get_option( $name ) {

		$default = $this->get_option_default( $name );

		return get_theme_mod( $name, $default );
	}

	/**
	 * Get default option values
	 *
	 * @param $name
	 *
	 * @return mixed
	 */
	public function get_option_default( $name ) {
		if ( ! isset( $this->config['fields'][ $name ] ) ) {
			return false;
		}

		return isset( $this->config['fields'][ $name ]['default'] ) ? $this->config['fields'][ $name ]['default'] : false;
	}
}

/**
 * This is a short hand function for getting setting value from customizer
 *
 * @param string $name
 *
 * @return bool|string
 */
function archi_get_option( $name ) {
	global $archi_customize;

	$value = false;

	if ( class_exists( 'Kirki' ) ) {
		$value = Kirki::get_option( 'archi', $name );
	} elseif ( ! empty( $archi_customize ) ) {
		$value = $archi_customize->get_option( $name );
	}

	return apply_filters( 'archi_get_option', $value, $name );
}

/**
 * Get default option values
 *
 * @param $name
 *
 * @return mixed
 */
function archi_get_option_default( $name ) {
	global $archi_customize;

	if ( empty( $archi_customize ) ) {
		return false;
	}

	return $archi_customize->get_option_default( $name );
}

/**
 * Move some default sections to `general` panel that registered by theme
 *
 * @param object $wp_customize
 */
function archi_customize_modify( $wp_customize ) {
	$wp_customize->get_section( 'title_tagline' )->panel     = 'general';
	$wp_customize->get_section( 'static_front_page' )->panel = 'general';
}

add_action( 'customize_register', 'archi_customize_modify' );


/**
 * Get customize settings
 *
 * Priority (Order) WordPress Live Customizer default: 
 * @link https://developer.wordpress.org/themes/customize-api/customizer-objects/
 *
 * @return array
 */
function archi_customize_settings() {
	/**
	 * Customizer configuration
	 */

	$settings = array(
		'theme' => 'archi',
	);

	$panels = array(
		'general'     => array(
			'priority' => 5,
			'title'    => esc_html__( 'General', 'archi' ),
		),
        'portfolio'           => array(
            'title'       => esc_html__( 'Portfolio', 'archi' ),
            'priority'    => 10,
            'capability'  => 'edit_theme_options',          
        ),
	);

	$sections = array(
        'portfolio_page'  => array(
            'title'       => esc_html__( 'Archive Page', 'archi' ),
            'priority'    => 10,
            'capability'  => 'edit_theme_options',
            'panel'       => 'portfolio',           
        ),
        'portfolio_post'  => array(
            'title'       => esc_html__( 'Single Page', 'archi' ),
            'priority'    => 10,
            'capability'  => 'edit_theme_options',
            'panel'       => 'portfolio',           
        ),
		/* typography */
		'typography'           => array(
            'title'       => esc_html__( 'Typography', 'archi' ),
            'description' => '',
            'priority'    => 15,
            'capability'  => 'edit_theme_options',
        ),
		/* 404 */
		'error_404'       => array(
            'title'       => esc_html__( '404', 'archi' ),
            'description' => '',
            'priority'    => 11,
            'capability'  => 'edit_theme_options',
        ),
        /* color scheme */
        'color_scheme'   => array(
			'title'      => esc_html__( 'Color Scheme', 'archi' ),
			'priority'   => 200,
			'capability' => 'edit_theme_options',
		),
		/* js code */
		'script_code'   => array(
			'title'      => esc_html__( 'Google Analytics(Script Code)', 'archi' ),
			'priority'   => 210,
			'capability' => 'edit_theme_options',
		),
	);

	$fields = array(
		/* typography */
        'typography_switch'     => array(
            'type'        => 'toggle',
            'label'       => esc_attr__( 'Typography Customize?', 'archi' ),
            'section'     => 'typography',
            'default'     => 0,
            'priority'    => 1,
        ),
        'body_typo'    => array(
            'type'     => 'typography',
            'label'    => esc_html__( 'Body Font', 'archi' ),
            'section'  => 'typography',
            'priority' => 2,
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
                    'element' => 'body',
                ),
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'typography_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'heading1_typo'=> array(
            'type'     => 'typography',
            'label'    => esc_html__( 'Heading 1', 'archi' ),
            'section'  => 'typography',
            'priority' => 3,
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
                    'element' => 'h1',
                ),
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'typography_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'heading2_typo'=> array(
            'type'     => 'typography',
            'label'    => esc_html__( 'Heading 2', 'archi' ),
            'section'  => 'typography',
            'priority' => 4,
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
                    'element' => 'h2, .widget-area .widget .widget-title, .widget-area .widget .wp-block-search__label, .widget-area .widget .wp-block-heading',
                ),
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'typography_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'heading3_typo'=> array(
            'type'     => 'typography',
            'label'    => esc_html__( 'Heading 3', 'archi' ),
            'section'  => 'typography',
            'priority' => 5,
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
                    'element' => 'h3',
                ),
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'typography_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'heading4_typo'=> array(
            'type'     => 'typography',
            'label'    => esc_html__( 'Heading 4', 'archi' ),
            'section'  => 'typography',
            'priority' => 6,
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
                    'element' => 'h4, .widget-area .widget .widget-title, .widget-area .widget .wp-block-search__label, .widget-area .widget .wp-block-heading',
                ),
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'typography_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'heading5_typo'=> array(
            'type'     => 'typography',
            'label'    => esc_html__( 'Heading 5', 'archi' ),
            'section'  => 'typography',
            'priority' => 7,
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
                    'element' => 'h5',
                ),
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'typography_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'heading6_typo'=> array(
            'type'     => 'typography',
            'label'    => esc_html__( 'Heading 6', 'archi' ),
            'section'  => 'typography',
            'priority' => 8,
            'default'  => array(
                'font-family'    => '',
                'variant'        => '',
                'font-size'      => '',
                'line-height'    => '',
                'letter-spacing' => '0',
                'subsets'        => array( 'latin', 'latin-ext' ),
                'color'          => '',
                'text-transform' => 'h6',
            ),
            'output'      => array(
                array(
                    'element' => 'h6',
                ),
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'typography_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        /* project settings */
        'portfolio_archive'           => array(
            'type'        => 'select',
            'label'       => esc_html__( 'Portfolio Archive', 'archi' ),
            'section'     => 'portfolio_page',
            'default'     => 'archive_default',
            'priority'    => 1,
            'description' => esc_html__( 'Select page default for the portfolio archive page.', 'archi' ),
            'choices'     => array(
                'archive_default' => esc_attr__( 'Archive page default', 'archi' ),
                'archive_custom' => esc_attr__( 'Archive page custom', 'archi' ),
            ),
        ),
        'archive_page_custom'     => array(
            'type'        => 'dropdown-pages',  
            'label'       => esc_attr__( 'Select Page', 'archi' ), 
            'description' => esc_attr__( 'Choose a custom page for archive portfolio page.', 'archi' ), 
            'section'     => 'portfolio_page', 
            'default'     => '', 
            'priority'    => 2,         
            'active_callback' => array(
                array(
                    'setting'  => 'portfolio_archive',
                    'operator' => '==',
                    'value'    => 'archive_custom',
                ),
            ),
        ),
        'portfolio_column'           => array(
            'type'        => 'select',
            'label'       => esc_html__( 'Portfolio Columns', 'archi' ),
            'section'     => 'portfolio_page',
            'default'     => '3cl',
            'priority'    => 3,
            'description' => esc_html__( 'Select default column for the portfolio page.', 'archi' ),
            'choices'     => array(
                '2cl' => esc_attr__( '2 Column', 'archi' ),
                '3cl' => esc_attr__( '3 Column', 'archi' ),
                '4cl' => esc_attr__( '4 Column', 'archi' ),
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'portfolio_archive',
                    'operator' => '==',
                    'value'    => 'archive_default',
                ),
            ),
        ),
        'portfolio_style'           => array(
            'type'        => 'select',
            'label'       => esc_html__( 'Hover Style', 'archi' ),
            'section'     => 'portfolio_page',
            'default'     => 'style-1',
            'priority'    => 4,
            'description' => esc_html__( 'Select default style for the portfolio page.', 'archi' ),
            'choices'     => array(
                'style-1'   => __( 'Title Overlay', 'archi' ),
                'style-2'   => __( 'Hidden Title Overlay Middle', 'archi' ),
                'style-3'   => __( 'Hidden Title Overlay Bottom', 'archi' ),
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'portfolio_archive',
                    'operator' => '==',
                    'value'    => 'archive_default',
                ),
            ),
        ),
        'portfolio_posts_per_page' => array(
            'type'        => 'number',
            'section'     => 'portfolio_page',
            'priority'    => 5,
            'label'       => esc_html__( 'Posts per page', 'archi' ),            
            'description' => esc_html__( 'Change Posts Per Page for Portfolio Archive, Taxonomy.', 'archi' ),
            'default'     => '',
            'active_callback' => array(
                array(
                    'setting'  => 'portfolio_archive',
                    'operator' => '==',
                    'value'    => 'archive_default',
                ),
            ),
        ),
        'pf_nav'          => array(
            'type'        => 'toggle',
            'label'       => esc_attr__( 'Projects Navigation On/Off', 'archi' ),
            'section'     => 'portfolio_post',
            'default'     => 1,
            'priority'    => 7,
        ),
        'pf_related_switch'     => array(
            'type'        => 'toggle',
            'label'       => esc_attr__( 'Related Projects On/Off', 'archi' ),
            'section'     => 'portfolio_post',
            'default'     => 1,
            'priority'    => 7,
        ),
        'pf_related_text'      => array(
            'type'            => 'text',
            'label'           => esc_html__( 'Related Projects Heading', 'archi' ),
            'section'         => 'portfolio_post',
            'default'         => esc_html__( 'Related Projects', 'archi' ),
            'priority'        => 7,
            'active_callback' => array(
                array(
                    'setting'  => 'pf_related_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),

		/* 404 */
		'custom_404'      => array(
            'type'        => 'toggle',
			'label'       => esc_html__( 'Customize?', 'archi' ),
            'section'     => 'error_404',
			'default'     => 0,
			'priority'    => 3,
		),
		'page_404'   	  => array(
			'type'        => 'dropdown-pages',  
	 		'label'       => esc_attr__( 'Select Page', 'archi' ), 
	 		'description' => esc_attr__( 'Choose a template in pages.', 'archi' ), 
	 		'section'     => 'error_404', 
	 		'default'     => '', 
			 'priority'    => 3,
			 'active_callback' => array(
				array(
					'setting'  => 'custom_404',
					'operator' => '==',
					'value'    => 1,
				),
			),
		),

		/*color scheme*/
        'light_mode'     => array(
            'type'        => 'toggle',
            'label'       => esc_attr__( 'Version Light', 'archi' ),
            'section'     => 'color_scheme',
            'default'     => 0,
            'priority'    => 10,
        ),
        'bg_body'      => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Background Body', 'archi' ),
            'section'  => 'color_scheme',
            'default'  => '',
            'priority' => 10,
            'output'   => array(
                array(
                    'element'  => 'body, .site-content',
                    'property' => 'background-color',
                ),
            ),
        ),
        'main_color'   => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Primary Color', 'archi' ),
            'section'  => 'color_scheme',
            'default'  => '#FAB702',
            'priority' => 10,
        ),

        /*google atlantic*/
        'js_code'  => array(
            'type'        => 'code',
            'label'       => esc_html__( 'Code', 'archi' ),
            'section'     => 'script_code',
            'choices'     => [
				'language' => 'js',
			],
            'priority'    => 3,
        ),
		
	);
	$settings['panels']   = apply_filters( 'archi_customize_panels', $panels );
	$settings['sections'] = apply_filters( 'archi_customize_sections', $sections );
	$settings['fields']   = apply_filters( 'archi_customize_fields', $fields );

	return $settings;
}

$archi_customize = new Archi_Customize( archi_customize_settings() );

require get_template_directory() . '/inc/backend/customizer/customizer-blog.php';
require get_template_directory() . '/inc/backend/customizer/customizer-header.php';
require get_template_directory() . '/inc/backend/customizer/customizer-page-header.php';
require get_template_directory() . '/inc/backend/customizer/customizer-footer.php';
