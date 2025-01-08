<?php
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: CountDown
 */
class Archi_CountDown extends Widget_Base{

 	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'ot-countdown';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'OT CountDown', 'archi' );
	}

	// The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
	public function get_icon() {
		return 'eicon-countdown';
	}

	// The get_categories method, lets you set the category of the widget, return the category name as a string.
	public function get_categories() {
		return [ 'category_archi' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'CountDown', 'archi' ),
			]
		);

		$this->add_control(
			'date',
			[
				'label' => __( 'Date - Time', 'archi' ),
				'type' => Controls_Manager::DATE_TIME,
				'default' => gmdate( 'Y-m-d H:i', strtotime( '+1 month' ) + ( get_option( 'gmt_offset' ) * HOUR_IN_SECONDS ) ),
			]
		);

		$this->add_control(
			'zone',
			[
				'label' => __( 'UTC Timezone Offset', 'archi' ),
				'type' => Controls_Manager::NUMBER,
				'default' => __( '0', 'archi' ),
			]
		);

		$this->start_controls_tabs( 'tabs_titles' );

		$this->start_controls_tab(
			'tab_title_normal',
			[
				'label' => __( 'One', 'archi' ),
			]
		);
		$this->add_control(
			'day',
			[
				'label' => __( 'Day', 'archi' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Day', 'archi' ),
			]
		);
		$this->add_control(
			'hour',
			[
				'label' => __( 'Hour', 'archi' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Hour', 'archi' ),
			]
		);
		$this->add_control(
			'min',
			[
				'label' => __( 'Minute', 'archi' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Minute', 'archi' ),
			]
		);
		$this->add_control(
			'second',
			[
				'label' => __( 'Second', 'archi' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Second', 'archi' ),
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_title_active',
			[
				'label' => __( 'Multi', 'archi' ),
			]
		);
		$this->add_control(
			'days',
			[
				'label' => __( 'Days', 'archi' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Days', 'archi' ),
			]
		);
		$this->add_control(
			'hours',
			[
				'label' => __( 'Hours', 'archi' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Hours', 'archi' ),
			]
		);
		$this->add_control(
			'mins',
			[
				'label' => __( 'Minutes', 'archi' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Minutes', 'archi' ),
			]
		);
		$this->add_control(
			'seconds',
			[
				'label' => __( 'Seconds', 'archi' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Seconds', 'archi' ),
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'style_content_section',
			[
				'label' => __( 'Style', 'archi' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		//Number
		$this->add_control(
			'heading_number',
			[
				'label' => __( 'Number', 'archi' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'number_space',
			[
				'label' => __( 'Spacing', 'archi' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ot-countdown li span' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'number_color',
			[
				'label' => __( 'Color', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ot-countdown li span' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'number_typography',
				'selector' => '{{WRAPPER}} .ot-countdown li span',
			]
		);

		//Title
		$this->add_control(
			'heading_titles',
			[
				'label' => __( 'Texts', 'archi' ),
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
					'{{WRAPPER}} .ot-countdown p' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .ot-countdown p',
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$datex = str_replace('-','/',$settings['date']);
		?>
			
		<ul class="ot-countdown unstyle" data-zone="<?php echo $settings['zone']; ?>" data-date="<?php echo $datex; ?>" data-day="<?php echo $settings['day']; ?>" data-days="<?php echo $settings['days']; ?>" data-hour="<?php echo $settings['hour']; ?>" data-hours="<?php echo $settings['hours']; ?>" data-min="<?php echo $settings['min']; ?>" data-mins="<?php echo $settings['mins']; ?>" data-second="<?php echo $settings['second']; ?>" data-seconds="<?php echo $settings['seconds']; ?>">
			<li><span class="days">00</span><p class="days_text">Days</p></li>
			<li><span class="hours">00</span><p class="hours_text">Hours</p></li>
			<li><span class="minutes">00</span><p class="minutes_text">Minutes</p></li>
			<li><span class="seconds">00</span><p class="seconds_text">Seconds</p></li>
		</ul>

	    <?php
	}

}
// After the Archi_CountDown class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register( new Archi_CountDown() );