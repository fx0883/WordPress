<?php
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Big Tabs
 */
class Archi_Big_Tabs extends Widget_Base{

 	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'ot-big-tabs';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'OT Big Tabs', 'archi' );
	}

	// The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
	public function get_icon() {
		return 'eicon-tabs';
	}

	// The get_categories method, lets you set the category of the widget, return the category name as a string.
	public function get_categories() {
		return [ 'category_archi' ];
	}

	protected function register_controls() {

		//Content Service box
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Tabs', 'archi' ),
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'tab_title',
			[
				'label' => __( 'Title', 'archi' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Tab Title', 'archi' ),
				'placeholder' => __( 'Tab Title', 'archi' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'tabs_link',
			[
				'label' => __( 'ID link to content section', 'archi' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'tab-id', 'archi' ),
			]
		);

		$this->add_control(
			'ot_tabs',
			[
				'label' => __( 'Tabs Items', 'archi' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'tab_title' => __( 'Tab #1', 'archi' ),
						'tabs_link'	  => __( 'tab-1', 'archi' ),
					],
					[
						'tab_title' => __( 'Tab #2', 'archi' ),
						'tabs_link'	  => __( 'tab-2', 'archi' ),
					],
				],
				'title_field' => '{{{ tab_title }}}',
			]
		);
		
		$this->end_controls_section();

		/* Style */
		$this->start_controls_section(
			'style_section',
			[
				'label' => __( 'Tabs', 'archi' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'style_title',
			[
				'label' => __( 'Title', 'archi' ),
				'type' => Controls_Manager::HEADING,
			]
		);
		
		$this->add_responsive_control(
			'title_space',
			[
				'label' => __( 'Spacing', 'archi' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ot-tabs__item:not(:last-child)' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'title_padding',
			[
				'label' => __( 'Padding', 'archi' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ot-tabs__link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .ot-tabs__link',
			]
		);

		$this->start_controls_tabs( 'tabs_title_style' );

		$this->start_controls_tab(
			'tab_title_normal',
			[
				'label' => __( 'Normal', 'archi' ),
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Color', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ot-tabs__link' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_control(
			'title_bgcolor',
			[
				'label' => __( 'Background', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ot-tabs__link' => 'background-color: {{VALUE}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'title_border',
				'selector' => '{{WRAPPER}} .ot-tabs__link',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_title_active',
			[
				'label' => __( 'Active/Hover', 'archi' ),
			]
		);

		$this->add_control(
			'title_color_active',
			[
				'label' => __( 'Color', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ot-tabs__item.current .ot-tabs__link, {{WRAPPER}} .ot-tabs__link:hover' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_control(
			'title_bg_active',
			[
				'label' => __( 'Background', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ot-tabs__item.current .ot-tabs__link' => 'background-color: {{VALUE}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'title_hover_border',
				'selector' => '{{WRAPPER}} .ot-tabs__item.current .ot-tabs__link',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		if ( empty( $settings['ot_tabs'] ) ) {
			return;
		}
		$this->add_render_attribute( 'tabs_wrapper', 'class', [ 'ot-tabs', 'ot-big-tabs' ] );
		
		?>

		<div <?php $this->print_render_attribute_string( 'tabs_wrapper' ); ?>>
			<ul class="ot-tabs__heading unstyle dflex">
				<?php $i = 1; foreach ( $settings['ot_tabs'] as $index => $tabs ) :
					$migration_allowed = Icons_Manager::is_migration_allowed();
				?>
				<li class="ot-tabs__item" data-tab="<?php echo esc_attr( $tabs['tabs_link'] );?>">
					<a class="ot-tabs__link">
						<?php $this->print_unescaped_setting( 'tab_title', 'ot_tabs', $index );?>
					</a>
				</li>
				<?php endforeach; ?>
			</ul>
	    </div>

	    <?php
	}

}
// After the Archi_Big_Tabs class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register( new Archi_Big_Tabs() );