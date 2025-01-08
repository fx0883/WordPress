<?php
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Menu_Mobile
 */
class Archi_Menu_Mobile extends Widget_Base{

 	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'ot-menu-mobile';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'OT Menu Mobile', 'archi' );
	}

	// The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
	public function get_icon() {
		return 'eicon-select';
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
					'{{WRAPPER}}' => 'text-align: {{VALUE}};',
				],
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
			'pos_menu',
			[
				'label' => __( 'Position', 'archi' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'on-right',
				'options' => [
					'on-left' 	=> __( 'On Left', 'archi' ),
					'on-right'  => __( 'On Right', 'archi' ),
				]
			]
		);

		$this->end_controls_section();
		
		/*** Style ***/
		$this->start_controls_section(
			'style_icon_section',
			[
				'label' => __( 'Icon', 'archi' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'icon_color',
			[
				'label' => __( 'Icon Color', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .mmenu-toggle button' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'icon_size',
			[
				'label' => __( 'Icon Size', 'archi' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .mmenu-toggle i:before' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'style_mmenu_section',
			[
				'label' => __( 'Menu', 'archi' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'bg_mmenu',
			[
				'label' => __( 'Background', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .mmenu-wrapper' => 'background: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'color_mmenu',
			[
				'label' => __( 'Text Color', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .mmenu-wrapper .mobile_mainmenu li a, 
					 {{WRAPPER}} .mmenu-wrapper .mobile_mainmenu > li.menu-item-has-children .arrow i' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'bcolor_mmenu',
			[
				'label' => __( 'Border Color', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .mmenu-wrapper .mobile_mainmenu li a' => 'border-color: {{VALUE}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'mmenu_typography',
				'selector' => '{{WRAPPER}} .mmenu-wrapper .mobile_mainmenu li a',
			]
		);
		$this->add_control(
			'color_back',
			[
				'label' => __( 'Back Button Color', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .mmenu-wrapper .mmenu-close' => 'color: {{VALUE}};',
				]
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
		?>
			
	    	<div class="octf-menu-mobile octf-cta-header">
				<div id="mmenu-toggle" class="mmenu-toggle">
					<button><i class="fa fa-navicon"></i></button>
				</div>
				<div class="site-overlay mmenu-overlay"></div>
				<div id="mmenu-wrapper" class="mmenu-wrapper <?php echo $settings['pos_menu']; ?>">
					<div class="mmenu-inner">
						<a class="mmenu-close" href="#"><i class="fa fa-close"></i></a>
						<div class="mobile-nav">
							<?php
								wp_nav_menu( array(
									'menu' 			 => $settings['nav_menu'],
									'menu_class'     => 'mobile_mainmenu none-style',
									'container'      => 'ul',
								) );
							?>
						</div>   	
					</div>   	
				</div>
			</div>
	    <?php
	}

}
// After the Archi_Menu_Mobile class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register( new Archi_Menu_Mobile() );