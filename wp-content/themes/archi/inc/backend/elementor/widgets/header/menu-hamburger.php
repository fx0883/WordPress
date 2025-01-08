<?php
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Menu Hamburger
 */
class Archi_Menu_Hamburger extends Widget_Base{

 	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'ot-menu-hamburger';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'OT Menu Hamburger', 'archi' );
	}

	// The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
	public function get_icon() {
		return 'eicon-menu-bar';
	}

	// The get_categories method, lets you set the category of the widget, return the category name as a string.
	public function get_categories() {
		return [ 'category_archi_header' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Select Menu', 'archi' ),
			]
		);

		$this->add_control(
			'hbuilder_page',
			[
				'label' => __( 'Select Header Builder Page', 'archi' ),
				'type' => Controls_Manager::SELECT2,
				'options' => $this->select_list_header_pages(),
				'multiple' => false,
				'label_block' => true,
				'placeholder' => __( 'Header Builder', 'archi' ),
			]
		);
		
		$this->add_control(
			'pos_close_btn',
			[
				'label' => __( 'Button Close Position', 'archi' ),
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
					'{{WRAPPER}} .menu-hamburger-toggle span' => 'background: {{VALUE}};',
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
		<div class="octf-menu-hamburger-area">
	    	<div class="menu-hamburger-toggle">
				<a href="javascript:void(0)">
					<span></span>
					<span></span>
					<span></span>
				</a>
			</div>
			<div class="octf-menu-hamburger full-screen">
				<a href="javascript:void(0)" class="<?php echo esc_attr( $settings['pos_close_btn'] ); ?>" id="menu-hamburger-close">
					<span class="line-1"></span>
					<span class="line-2"></span>
				</a>
				<?php if( $settings['hbuilder_page'] != '' ){ echo \Elementor\Plugin::$instance->frontend->get_builder_content_for_display( $settings['hbuilder_page'] ); } ?>
			</div>
		</div>
	    <?php
	}

	protected function select_list_header_pages() {
		$pages = get_posts( array( 'post_type' => 'ot_header_builders', 'posts_per_page' => -1, ) ); 
		$list_page = array();
		foreach ( $pages as $page ) {
			$list_page[$page->ID] = $page->post_title;
		}
		return $list_page;
	}
}
// After the Archi_Menu_Hamburger class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register( new Archi_Menu_Hamburger() );