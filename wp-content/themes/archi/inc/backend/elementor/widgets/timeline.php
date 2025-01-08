<?php
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Section Heading 
 */
class Archi_Timeline extends Widget_Base{

 	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'ot-timeline';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'OT Timeline', 'archi' );
	}

	// The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
	public function get_icon() {
		return 'eicon-time-line';
	}

	// The get_categories method, lets you set the category of the widget, return the category name as a string.
	public function get_categories() {
		return [ 'category_archi' ];
	}

	protected function register_controls() {

		//Content
		$this->start_controls_section(
			'section_general',
			[
				'label' => __('Timeline', 'archi')
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'timeline',
			[
				'label'       => __('Timeline', 'archi'),
				'type'        => Controls_Manager::TEXT,
				'default'     => __('2012 - 2014', 'archi'),
			]
		);

		$repeater->add_control(
			'title',
			[
				'label' => __( 'Title', 'archi' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Chief Executive Officer', 'archi' ),
			]
		);

		$repeater->add_control(
			'content_timeline',
			[
				'label'       => __('Content', 'archi'),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'archi'),
			]
		);
		$this->add_control(
			'list_timeline',
			[
				'label'      => __('Items', 'archi'),
				'type'       => Controls_Manager::REPEATER,
				'show_label' => true,
				'default'    => [
					[
						'timeline' => __( '2010 - 2012', 'archi' ),
						'title'	   => __( 'Jr. Interior Designer', 'archi' ),
						'content_timeline' => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'archi'),
					],
					[
						'timeline' => __( '2012 - 2014', 'archi' ),
						'title'	   => __( 'Sr. Interior Designer', 'archi' ),
						'content_timeline' => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'archi'),
					],
				],
				'title_field' => '{{{ timeline }}}',
				'fields'     =>  $repeater->get_controls(),
			]
		);

		$this->end_controls_section();

		//Style general

		$this->start_controls_section(
			'content_style_section',
			[
				'label' => __( 'Timeline', 'archi' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'date_heading',
			[
				'label' => __( 'Date/Time', 'archi' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_responsive_control(
			'image_size',
			[
				'label' => esc_html__( 'Width', 'archi' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 50,
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ot-timeline .tl-time' => 'min-width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'date_color',
			[
				'label' => __( 'Color', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tl-time' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'date_border_color',
			[
				'label' => __( 'Border Color', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tl-time span' => 'border-color: {{VALUE}};',
				]
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'date_typography',
				'selector' => '{{WRAPPER}} .tl-time',
			]
		);
		
		$this->add_control(
			'line_heading',
			[
				'label' => __( 'Marker', 'archi' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'line_color',
			[
				'label' => __( 'Line Color', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tl-marker:after' => 'background: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'dot_color',
			[
				'label' => __( 'Dot Color', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tl-marker:before' => 'background: {{VALUE}};',
				]
			]
		);
		
		$this->add_control(
			'title_heading',
			[
				'label' => __( 'Title', 'archi' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Color', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tl-title' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .tl-title',
			]
		);

		$this->add_control(
			'desc_heading',
			[
				'label' => __( 'Description', 'archi' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'desc_color',
			[
				'label' => __( 'Color', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tl-detail p' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'desc_typography',
				'selector' => '{{WRAPPER}} .tl-detail p',
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		if ( empty( $settings['list_timeline'] ) ) {
			return;
		}

		?>
		<div class="ot-timeline">
			<?php foreach ( $settings['list_timeline'] as $index => $item ) : ?>
	        <div class="ot-timeline-item">
	            <div class="tl-time">
	                <span><?php $this->print_unescaped_setting( 'timeline', 'list_timeline', $index );?></span>
	            </div>
	            <div class="tl-marker"></div>
	            <div class="tl-detail">
	            	<h4 class="tl-title"><?php $this->print_unescaped_setting( 'title', 'list_timeline', $index );?></h4>
	            	<p><?php $this->print_unescaped_setting( 'content_timeline', 'list_timeline', $index );?></p>
	            </div>
	        </div>
	        <?php endforeach; ?>
	    </div>
		
		<?php
	}

}
// After the Archi_Timeline class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register( new Archi_Timeline() );