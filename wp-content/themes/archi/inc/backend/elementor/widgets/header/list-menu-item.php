<?php 
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Team
 */
class Archi_List_Menu_Item extends Widget_Base{

 	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'ot-list-menu-item';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'Archi List Menu', 'archi' );
	}

	// The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
	public function get_icon() {
		return 'eicon-bullet-list';
	}

	// The get_categories method, lets you set the category of the widget, return the category name as a string.
	public function get_categories() {
		return [ 'category_archi_header' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_icon',
			[
				'label' => __( 'List Menu', 'archi' ),
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'text',
			[
				'label' => __( 'Text', 'archi' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'placeholder' => __( 'List Menu Item', 'archi' ),
				'default' => __( 'List Menu Item', 'archi' ),
			]
		);

		$repeater->add_control(
			'link',
			[
				'label' => __( 'Link', 'archi' ),
				'type' => Controls_Manager::URL,
				'label_block' => true,
				'placeholder' => __( 'https://your-link.com', 'archi' ),
			]
		);

		$this->add_control(
			'menu_list',
			[
				'label' => '',
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'text' => __( 'List Menu Item #1', 'archi' ),
						'link' => [
							'url' => '#'
						]
					],
					[
						'text' => __( 'List Menu Item #2', 'archi' ),
						'link' => [
							'url' => '#'
						]
					],
					[
						'text' => __( 'List Menu Item #3', 'archi' ),
						'link' => [
							'url' => '#'
						]
					],
				],
				'title_field' => '{{{ text }}}',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_menu_list',
			[
				'label' => __( 'List', 'archi' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'list_menu_align',
			[
				'label' => __( 'Alignment', 'archi' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
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
				'selectors'	=> [
					'{{WRAPPER}} .list-menu-item-wrapper li a' => 'text-align: {{VALUE}};',
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_text_style',
			[
				'label' => __( 'Text', 'archi' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'text_color',
			[
				'label' => __( 'Text Color', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} ul.list-menu-item-wrapper li.list-menu-item a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'bg_color',
			[
				'label' => __( 'Background Color', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} ul.list-menu-item-wrapper li.list-menu-item a' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'text_color_hover',
			[
				'label' => __( 'Hover Color', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} ul.list-menu-item-wrapper li.list-menu-item:hover a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'bg_hover_color',
			[
				'label' => __( 'Background Color', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} ul.list-menu-item-wrapper li.list-menu-item:hover a' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'icon_typography',
				'selector' => '{{WRAPPER}} ul.list-menu-item-wrapper li a',
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		
		?>
        	<ul class="list-menu-item-wrapper unstyle">
        		<?php foreach ( $settings['menu_list'] as $key => $item ) : ?>
        			<li class="list-menu-item">
        				<?php
							if ( ! empty( $item['link']['url'] ) ) {
								$link_key = 'link_' . $key;

								$this->add_link_attributes( $link_key, $item['link'] );

								echo '<a ' . $this->get_render_attribute_string( $link_key ) . '>';
							}
						?>
						<span><?php echo $item['text']; ?></span>
						<?php if ( ! empty( $item['link']['url'] ) ) : ?>
							</a>
						<?php endif; ?>
        			</li>
        		<?php endforeach ?>
        	</ul>
	    <?php
	}

}
// After the Archi_List_Menu_Item class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register( new Archi_List_Menu_Item() );