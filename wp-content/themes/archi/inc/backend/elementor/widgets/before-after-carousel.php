<?php
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Image Before After
 */
class Archi_Before_After_Carousel extends Widget_Base{

 	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'ot-before-after-carousel';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'OT Image Before After Carousel', 'archi' );
	}

	// The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
	public function get_icon() {
		return 'eicon-image-before-after';
	}

	// The get_categories method, lets you set the category of the widget, return the category name as a string.
	public function get_categories() {
		return [ 'category_archi' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'beforeafter_section',
			[
				'label' => __( 'Image Before After Item', 'archi' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new Repeater();
		$repeater->add_control(
			'image_before',
			[
				'label' => __( 'Image Before', 'archi' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);
		$repeater->add_control(
			'image_after',
			[
				'label' => __( 'Image After', 'archi' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_control(
		    'images_brfore_after_slider',
		    [
		        'label'       => '',
		        'type'        => Controls_Manager::REPEATER,
		        'show_label'  => false,
		        'default'     => [],
		        'fields'      => $repeater->get_controls(),
		        'title_field' => '',
		    ]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'options_section',
			[
				'label' => __( 'Before After Options', 'archi' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);	
		$this->add_control(
			'before_width',
			[
				'label' 		=> __( 'Image Before Width', 'archi' ),
				'description' 	=> __( 'Image before width is visible', 'archi' ),
				'type' 			=> Controls_Manager::SLIDER,
				'size_units' 	=> [ 'px' ],
				'range' 		=> [
					'px' => [
						'min' 	=> 0.3,
						'max' 	=> 0.9,
						'step' 	=> 0.1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 0.5,
				],
			]
		);
		$this->add_control(
			'orientation',
			[
				'label' => __( 'Orientation', 'archi' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'horizontal',
				'options' => [
					'horizontal' 	=> __( 'Horizontal', 'archi' ),
					'vertical'      => __( 'Vertical', 'archi' ),
				]
			]
		);
		$this->add_control(
			'heading_translate',
			[
				'label' => __( 'Translate Text', 'archi' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'before_text',
			[
				'label' => __( 'Before', 'archi' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Before', 'archi' ),
				'placeholder' => __( 'Type your before text here', 'archi' ),
			]
		);

		$this->add_control(
			'after_text',
			[
				'label' => __( 'After', 'archi' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'After', 'archi' ),
				'placeholder' => __( 'Type your after text here', 'archi' ),
			]
		);
		$this->end_controls_section();

		// Styling.
		$this->start_controls_section(
			'style_tcontent',
			[
				'label' => __( 'General', 'archi' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'text_color',
			[
				'label' => __( 'Color for Text', 'archi' ),
				'description' 	=> __( 'Set color for before and after text when hover over image.', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .twentytwenty-before-label:before, {{WRAPPER}} .twentytwenty-after-label:before' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'text_bgcolor',
			[
				'label' => __( 'Background for Text', 'archi' ),
				'description' 	=> __( 'Set background color for before and after text when hover over image.', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .twentytwenty-before-label:before, {{WRAPPER}} .twentytwenty-after-label:before' => 'background: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'beforeafter_typography',
				'selector' => '{{WRAPPER}} .twentytwenty-before-label:before, {{WRAPPER}} .twentytwenty-after-label:before',
			]
		);
		$this->add_control(
			'heading_mainbox',
			[
				'label' => __( 'Main Box', 'archi' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'handle_color',
			[
				'label' => __( 'Curtain Handle Color', 'archi' ),
				'description' 	=> __( 'Set color for Curtain Handle when drag and drop.', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .twentytwenty-handle' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .twentytwenty-horizontal .twentytwenty-handle:before, {{WRAPPER}} .twentytwenty-horizontal .twentytwenty-handle:after, {{WRAPPER}} .twentytwenty-vertical .twentytwenty-handle:before, {{WRAPPER}} .twentytwenty-vertical .twentytwenty-handle:after' => 'background: {{VALUE}};',
					'{{WRAPPER}} .twentytwenty-horizontal .twentytwenty-handle:before' => 'box-shadow: 0 3px 0 {{VALUE}}, 0px 0px 12px rgba(51, 51, 51, 0.5);',
					'{{WRAPPER}} .twentytwenty-horizontal .twentytwenty-handle:after' => 'box-shadow: 0 -3px 0 {{VALUE}}, 0px 0px 12px rgba(51, 51, 51, 0.5);',
					'{{WRAPPER}} .twentytwenty-vertical .twentytwenty-handle:before' => 'box-shadow: 3px 0 0 {{VALUE}}, 0px 0px 12px rgba(51, 51, 51, 0.5);',
					'{{WRAPPER}} .twentytwenty-vertical .twentytwenty-handle:after' => 'box-shadow: -3px 0 0 {{VALUE}}, 0px 0px 12px rgba(51, 51, 51, 0.5);',
					'{{WRAPPER}} .twentytwenty-left-arrow' => 'border-right-color: {{VALUE}};',
					'{{WRAPPER}} .twentytwenty-right-arrow' => 'border-left-color: {{VALUE}};',
					'{{WRAPPER}} .twentytwenty-up-arrow' => 'border-bottom-color: {{VALUE}};',
					'{{WRAPPER}} .twentytwenty-down-arrow' => 'border-top-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'bg_overlay',
			[
				'label' => __( 'Background Overlay', 'archi' ),
				'description' 	=> __( 'Set background color overlay when hover over image.', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .twentytwenty-overlay:hover' => 'background: {{VALUE}};',
				],
			]
		);		
		$this->add_control(
			'bf_border_radius',
			[
				'label' => __( 'Border Radius', 'archi' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .twentytwenty-container' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		// Dots.
		$this->start_controls_section(
			'navigation_section',
			[
				'label' => __( 'Dots', 'archi' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'dots_spacing',
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
					'{{WRAPPER}} .owl-dots' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'dots_size',
			[
				'label' => __( 'Size', 'archi' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .owl-dot span' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
            'dots_bgcolor',
            [
                'label' => __( 'Color', 'archi' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
					'{{WRAPPER}} .owl-dots .owl-dot:not(.active) span' => 'background-color: {{VALUE}};',
				],
            ]
        );
        $this->add_control(
            'dots_active_bgcolor',
            [
                'label' => __( 'Active', 'archi' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
					'{{WRAPPER}} .owl-dots .owl-dot:hover span,
					 {{WRAPPER}} .owl-dots .owl-dot.active span' => 'background-color: {{VALUE}};',
				],
            ]
        );
       
        $this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		if ( empty( $settings['images_brfore_after_slider'] ) ) {
			return;
		}
		$before_width = ( !empty( $settings['before_width']['size'] ) ? esc_attr( $settings['before_width']['size'] ) : 0.5);
		$before_text = ( !empty( $settings['before_text'] ) ? esc_attr( $settings['before_text'] ) : 'Before');
		$after_text = ( !empty( $settings['after_text'] ) ? esc_attr( $settings['after_text'] ) : 'After');
		?>
		<div class="image__before-after ot-carousel">
			<div class="owl-carousel owl-theme">
				<?php foreach ( $settings['images_brfore_after_slider'] as $key => $item ) : 

					$image_before_url = Group_Control_Image_Size::get_attachment_image_src( $item['image_before']['id'], 'full', $settings );
					if ( ! $image_before_url && isset( $item['image_before']['url'] ) ) {
						$image_before_url = $item['image_before']['url'];
					}
					$image_before_html = '<img src="' . esc_attr( $image_before_url ) . '" alt="' . Control_Media::get_image_title( $item['image_before'] ) . '">';

					$image_after_url = Group_Control_Image_Size::get_attachment_image_src( $item['image_after']['id'], 'full', $settings );
					if ( ! $image_after_url && isset( $item['image_after']['url'] ) ) {
						$image_after_url = $item['image_after']['url'];
					}
					$image_after_html = '<img src="' . esc_attr( $image_after_url ) . '" alt="' . Control_Media::get_image_title( $item['image_after'] ) . '">';
				?>
				<div class="twentytwenty-container" data-before="<?php echo esc_attr( $before_text ) ?>" data-after="<?php echo esc_attr( $after_text ) ?>" data-bsize="<?php echo esc_attr( $before_width ) ?>" data-orientation="<?php echo esc_attr( $settings['orientation'] ) ?>">
					<?php echo $image_before_html; ?>
					<?php echo $image_after_html; ?>
				</div>
				
				<?php endforeach ?>
			</div>
		</div>
	    <?php
	}

}
// After the Archi_Before_After_Carousel class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register( new Archi_Before_After_Carousel() );