<?php
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Menu
 */
class Archi_Menu extends Widget_Base{

 	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'ot-menu';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'OT Nav Menu', 'archi' );
	}

	// The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
	public function get_icon() {
		return 'eicon-nav-menu';
	}

	// The get_categories method, lets you set the category of the widget, return the category name as a string.
	public function get_categories() {
		return [ 'category_archi_header' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Menu', 'archi' ),
			]
		);

		$menus = $this->get_available_menus();
		$this->add_control(
			'nav_menu',
			[
				'label' => esc_html__( 'Select Menu', 'archi' ),
				'type' => Controls_Manager::SELECT,
				'multiple' => false,
				'options' => $menus,
				'default' => array_keys( $menus )[0],
				'save_default' => true,

			]
		);
		$this->add_control(
			'layout_menu',
			[
				'label' => __( 'Layout', 'archi' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'horizontal',
				'options' => [
					'horizontal' => __( 'Horizontal', 'archi' ),
					'vertical' => __( 'Vertical', 'archi' ),
				],
			]
		);
		$this->add_control(
			'separator_style',
			[
				'label' => esc_html__( 'Separator', 'archi' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'none' => esc_html__( 'None', 'archi' ),
					'dotted' => esc_html__( 'Dotted', 'archi' ),
					'line' => esc_html__( 'Line', 'archi' ),
					'circle' => esc_html__( 'Circle', 'archi' ),
					'square' => esc_html__( 'Square', 'archi' ),
					'plus' => esc_html__( 'Plus', 'archi' ),
					'strip' => esc_html__( 'Strip', 'archi' ),
				],
				'default' => 'dotted',
				'condition' => [
					'layout_menu' => 'horizontal',
				],
			]
		);
		$this->add_responsive_control(
			'align',
			[
				'label' => __( 'Alignment', 'archi' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left'    => [
						'title' => __( 'Left', 'archi' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'archi' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'archi' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}},
					 {{WRAPPER}} .vertical-main-navigation ul li' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		/*** Style ***/
		//menu parents
		$this->start_controls_section(
			'style_menu_section',
			[
				'label' => __( 'Menu Parents', 'archi' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'text_color',
			[
				'label' => __( 'Text Color', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .main-navigation ul > li > a' => 'color: {{VALUE}};',
					'{{WRAPPER}} .vertical-main-navigation > ul > li > a, 
					 {{WRAPPER}} .vertical-main-navigation > ul > li.menu-item-has-children > a:after' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'text_hover_color',
			[
				'label' => __( 'Text Hover Color', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .main-navigation ul > li > a:hover,
					 {{WRAPPER}} .main-navigation > ul > li:not(:last-child) > a:after,
					 {{WRAPPER}} .main-navigation > ul > li.current-menu-item > a,
					 {{WRAPPER}} .main-navigation > ul > li.current-menu-ancestor > a' => 'color: {{VALUE}};',
					'{{WRAPPER}} .vertical-main-navigation > ul > li > a:hover' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'border_color',
			[
				'label' => __( 'Border Color', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .vertical-main-navigation ul li' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'layout_menu' => 'vertical'
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'menu_typography',
				'selector' => '{{WRAPPER}} .main-navigation > ul > li > a, {{WRAPPER}} .vertical-main-navigation > ul > li > a',
			]
		);

		$this->end_controls_section();

		//menu child
		$this->start_controls_section(
			'style_smenu_section',
			[
				'label' => __( 'Dropdown Menus', 'archi' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'offset_space',
	        [
	            'label' => __( 'Offset', 'archi' ),
	            'type' => Controls_Manager::SLIDER,
	            'range' => [
	                'px' => [
	                    'min' => 0,
	                    'max' => 10,
	                ],
	            ],
	            'selectors' => [
	                '{{WRAPPER}} .main-navigation > ul > li:hover > ul.sub-menu' => 'top: calc(100% + {{SIZE}}{{UNIT}});',
	                '{{WRAPPER}} .main-navigation ul ul.sub-menu:before' => 'left: -{{SIZE}}{{UNIT}}; top: -{{SIZE}}{{UNIT}};',
	            ],
	        ]
    	);

		$this->add_responsive_control(
			'smenu_width',
			[
				'label' => __( 'Min Width', 'archi' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 150,
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .main-navigation ul ul.sub-menu' => 'min-width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .vertical-main-navigation ul ul.sub-menu' => 'min-width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'text_s_color',
			[
				'label' => __( 'Text Color', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .main-navigation ul li li a' => 'color: {{VALUE}};',
					'{{WRAPPER}} .vertical-main-navigation ul li li a' => 'color: {{VALUE}};',
				]
			]
		);
		
		$this->add_control(
			'bg_s_color',
			[
				'label' => __( 'Background Color', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .main-navigation ul ul.sub-menu' => 'background: {{VALUE}};',
				],
				'condition' => [
					'layout_menu' => 'horizontal'
				]
			]
		);
		$this->add_control(
			'text_s_hover_color',
			[
				'label' => __( 'Text Hover Color', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .main-navigation ul li li:hover > a,
					 {{WRAPPER}} .main-navigation ul ul li.current-menu-item > a,
					 {{WRAPPER}} .main-navigation ul ul li.current-menu-ancestor > a' => 'color: {{VALUE}};',
					'{{WRAPPER}} .vertical-main-navigation ul li li a:hover,
					 {{WRAPPER}} .vertical-main-navigation ul ul li.current-menu-item > a,
					 {{WRAPPER}} .vertical-main-navigation ul ul li.current-menu-ancestor > a' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'bg_s_hover_color',
			[
				'label' => __( 'Background Hover Color', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .main-navigation ul li li:hover > a,
					 {{WRAPPER}} .main-navigation ul ul li.current-menu-item > a,
					 {{WRAPPER}} .main-navigation ul ul li.current-menu-ancestor > a' => 'background: {{VALUE}};',
				],
				'condition' => [
					'layout_menu' => 'horizontal'
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'smenu_typography',
				'selector' => '{{WRAPPER}} .main-navigation ul li li a, {{WRAPPER}} .vertical-main-navigation ul li li a',
			]
		);

		$this->end_controls_section();

	}

	protected function get_available_menus(){

		$menus = wp_get_nav_menus();

		$options = [];

		foreach ( $menus as $menu ) {
			$options[ $menu->slug ] = $menu->name;
		}

		return $options;
   }

	protected function render() {
		$settings = $this->get_settings_for_display();
		$active_mmenu = in_array('ot_mega-menu/ot_mega-menu.php', apply_filters('active_plugins', get_option('active_plugins')));
		$nav_class = $settings['layout_menu'] == 'vertical' ? 'vertical-main-navigation' : 'main-navigation';
		$separator = $settings['separator_style'];
		switch ( $separator ) {
			case 'none':
				$separator_class = ' no-separator';
				break;
			case 'dotted':
				$separator_class = ' dotted-separator';
				break;
			case 'line':
				$separator_class = ' line-separator';
				break;
			case 'circle':
				$separator_class = ' circle-separator';
				break;
			case 'square':
				$separator_class = ' square-separator';
				break;
			case 'plus':
				$separator_class = ' plus-separator';
				break;
			case 'strip':
				$separator_class = ' strip-separator';
				break;
			default:
				$separator_class = ' no-separator';
		}	
		?>
			
	    	<nav id="site-navigation" class="<?php echo esc_attr( $nav_class . $separator_class );?>">			
				<?php
					wp_nav_menu( array(
						'menu' 			 => $settings['nav_menu'],
						'menu_id'        => 'primary-menu',
						'container'      => 'ul',
						'fallback_cb' 	 => '__return_empty_string',
						'walker'         => $active_mmenu ? new \Ot_Mega_Menu_Walker() : '',
					) );
				?>
			</nav>
			
	    <?php
	}

}
// After the Archi_Menu class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register( new Archi_Menu() );