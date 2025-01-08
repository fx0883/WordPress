<?php
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Text Slider Marquee 
 */
class Archi_Text_Slider_Marquee extends Widget_Base{

 	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'ot-text-slider-marquee';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'OT Text Slider Marquee', 'archi' );
	}

	// The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
	public function get_icon() {
		return 'eicon-animation-text';
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
				'label' => __( 'Content', 'archi' ),
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'text_item',
			[
				'label' => __( 'Text', 'archi' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Concept Development', 'archi' ),
				'placeholder' => __( 'Enter your text', 'archi' ),
			]
		);

		$this->add_control(
			'ot_text_slider_marquee',
			[
				'label' => __( 'Text Marquee', 'archi' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'text_item' => __( 'Space Planning', 'archi' ),
					],
					[
						'text_item' => __( 'Floor Plans', 'archi' ),
					],
				],
				'title_field' => '{{{ text_item }}}',
			]
		);

		/* Option Slider */

		$this->add_control(
			'heading_option_slider',
			[
				'label' => esc_html__( 'Slider Option', 'sandbox' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'reverse_direction',
			[
				'label' => __( 'Reverse Direction', 'sandbox' ),
				'type'    => Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'marquee_speed',
			[
				'label' => __( 'Speed (ms)', 'sandbox' ),
				'type' => Controls_Manager::NUMBER,
				'range' => [
					'px' => [
						'min'  => 1000,
						'max'  => 100000,
						'step' => 1000,
					],
				],
				'min' => 1000,
				'max' => 20000,
				'step' => 100,
				'default' => 3000,
			]
		);

		$this->end_controls_section();

		//Style
		$this->start_controls_section(
			'style_section',
			[
				'label' => __( 'Content', 'archi' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'item_space',
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
					'{{WRAPPER}} .ot-text-marquee .swiper-slide' => 'padding: 0 {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'content_color',
			[
				'label' => __( 'Color', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ot-text-marquee' => 'color: {{VALUE}};',
				]
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'selector' => '{{WRAPPER}} .ot-text-marquee__txt',
			]
		);

		//Divider
		$this->add_control(
			'style_divider',
			[
				'label' => __( 'Divider', 'archi' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'divider_color',
			[
				'label' => __( 'Color', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ot-text-marquee__txt:after' => 'background: {{VALUE}};',
				]
			]
		);
		$this->add_responsive_control(
			'divider_width',
			[
				'label' => __( 'Width', 'archi' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 1000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ot-text-marquee__txt:after' => 'width: {{SIZE}}{{UNIT}}; right: calc(-{{SIZE}}{{UNIT}}/2)',
				],
			]
		);
		$this->add_responsive_control(
			'divider_height',
			[
				'label' => __( 'Height', 'archi' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ot-text-marquee__txt:after' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		if ( empty( $settings['ot_text_slider_marquee'] ) ) {
			return;
		}

		$sliderAutoPlayTime  = isset( $settings['marquee_speed'] ) ? $settings['marquee_speed'] : 5000;

		$marquee_options = [
			'data_speed'  	 	 	   => absint( $sliderAutoPlayTime ),
			'data_reverse'       	   => $settings['reverse_direction'] ? $settings['reverse_direction'] : 'no' ,
			'data_arrows'        	   => false,
			'data_dots'          	   => false,
			'data_centered'		 	   => true,
			'data_loop'		 	 	   => true,
			'data_autoplay'	 	 	   => true,
			'data_autoplaytime'	 	   => 1,
			'data_drag'			 	   => false,
		];

		$this->add_render_attribute(
			'slides', [
				'class'  			  => 'ot-text-marquee swiper swiper-container',
				'data-slider_options' => wp_json_encode( $marquee_options ),
			]
		);
		
		?>
		<div <?php echo $this->get_render_attribute_string( 'slides' ); ?>>
			<div class="swiper-wrapper ticker">
				<?php foreach ( $settings['ot_text_slider_marquee'] as $key => $item ) { ?>
		    	<div class="swiper-slide">
	    			<span class="ot-text-marquee__txt"><?php $this->print_unescaped_setting( 'text_item', 'ot_text_slider_marquee', $key ); ?></span>
		    	</div>
		    	<?php } ?>
			</div>
		</div>
	    <?php
	}

}
// After the Archi_Text_Slider_Marquee class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register( new Archi_Text_Slider_Marquee() );