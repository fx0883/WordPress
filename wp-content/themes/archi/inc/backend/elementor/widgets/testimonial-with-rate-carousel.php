<?php
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Testimonial Carousel
 */
class Archi_Testimonials_With_Rate_Carousel extends Widget_Base{

 	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'ot-testimonials-with-rate-carousel';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'OT Testimonial With Rate Carousel', 'archi' );
	}

	// The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
	public function get_icon() {
		return 'eicon-testimonial-carousel';
	}

	// The get_categories method, lets you set the category of the widget, return the category name as a string.
	public function get_categories() {
		return [ 'category_archi' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_testimonials',
			[
				'label' => __( 'Testimonials', 'archi' ),
			]
		);
		$repeater = new Repeater();
		
		$repeater->add_control(
			'timage',
			[
				'label' => __( 'Avatar', 'archi' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$repeater->add_control(
			'tcontent',
			[
				'label' => __( 'Content', 'archi' ),
				'type' => Controls_Manager::TEXTAREA,
				'rows' => '10',
				'default' => __( 'Cum sociis natoque penatibus et magnis dis parturient montes.', 'archi' ),
			]
		);

		$repeater->add_control(
			'tname',
			[
				'label' => __( 'Name', 'archi' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Coriss Ambady', 'archi' ),
			]
		);

		$repeater->add_control(
			'tjob',
			[
				'label' => __( 'Job', 'archi' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Financial Analyst', 'archi' ),
			]
		);
		$repeater->add_control(
			'is_rating',
			[
				'label' => esc_html__( 'Is Rating', 'archi' ),
				'type' => Controls_Manager::SWITCHER,
				'label_off' => esc_html__( 'No', 'archi' ),
				'label_on' => esc_html__( 'Yes', 'archi' ),
			]
		);
		$repeater->add_control(
			'rating',
			[
				'label' => __( 'Rating <span class="elementor-control-field-description">( 0-5 )</span>', 'archi' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 5,
				'step' => 1,
				'default' => 5,
				'condition' => [
					'is_rating' => 'yes'
				]
			]
		);
		$this->add_control(
		    'testi_slider',
		    [
		        'label'       => '',
		        'type'        => Controls_Manager::REPEATER,
		        'show_label'  => false,
		        'default'     => [
		            [
		             	'tcontent' => __( 'Cum sociis natoque penatibus et magnis dis parturient montes.', 'archi' ),
						'tname'	  => __( 'Coriss Ambady', 'archi' ),
						'tjob'	  => __( 'Financial Analyst', 'archi' ),
		            ],
		            [
		             	'tcontent' => __( 'Cum sociis natoque penatibus et magnis dis parturient montes.', 'archi' ),
						'tname'	  => __( 'Cory Zamora', 'archi' ),
						'tjob'	  => __( 'Marketing Specialist', 'archi' ),
		            ],
		            [
		             	'tcontent' => __( 'Cum sociis natoque penatibus et magnis dis parturient montes.', 'archi' ),
						'tname'	  => __( 'Barclay Widerski', 'archi' ),
						'tjob'	  => __( 'Sales Specialist', 'archi' ),
		            ]
		        ],
		        'fields'      => $repeater->get_controls(),
		        'title_field' => '{{{tname}}}',
		    ]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'timage_size',
				'exclude' => ['1536x1536', '2048x2048'],
				'include' => [],
				'default' => 'full',
			]
		);

		/* Option Slider */

		$slides_show = range( 1, 10 );
		$slides_show = array_combine( $slides_show, $slides_show );

		$this->add_control(
			'heading_slider_option',
			[
				'label' => __( 'Slider Option', 'archi' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		
		$this->add_responsive_control(
			'tshow',
			[
				'label' => __( 'Slides To Show', 'archi' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' => __( 'Default', 'archi' ),
				] + $slides_show,
				'default' => ''
			]
		);

		$this->add_control(
			'loop',
			[
				'label'   => esc_html__( 'Loop', 'archi' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		$this->add_control(
			'autoplay',
			[
				'label'   => esc_html__( 'Autoplay', 'archi' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		$this->add_control(
			'timeout',
			[
				'label' => __( 'Autoplay Timeout', 'archi' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min'  => 1000,
						'max'  => 20000,
						'step' => 1000,
					],
				],
				'default' => [
					'size' => 7000,
				],
				'condition' => [
					'autoplay' => 'yes',
				]
			]
		);
		$this->add_responsive_control(
			'slider_spacing',
			[
				'label' => __( 'Slider Spacing <span class="elementor-control-field-description">(Min: 30px)</span>', 'archi' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 30,
						'max' => 200,
					],
				],
			]
		);
		
		$this->add_control(
			'navigation',
			[
				'label' => __( 'Navigation', 'archi' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => [
					'both' => __( 'Arrows and Dots', 'archi' ),
					'arrows' => __( 'Arrows', 'archi' ),
					'dots' => __( 'Dots', 'archi' ),
					'none' => __( 'None', 'archi' ),
				],
			]
		);

		$this->end_controls_section();

		/*Content*/
		$this->start_controls_section(
			'style_tcontent',
			[
				'label' => __( 'Content', 'archi' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'spacing_tcontent',
			[
				'label' => __( 'Spacing', 'archi' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .blockquote-content' => 'padding-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'tcontent_color',
			[
				'label' => __( 'Color', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .blockquote-content' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'selector' => '{{WRAPPER}} .blockquote-content',
			]
		);

		$this->end_controls_section();

		// Image.
		$this->start_controls_section(
			'style_timage',
			[
				'label' => __( 'Avatars', 'archi' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'spacing_img',
			[
				'label' => __( 'Spacing', 'archi' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .blockquote-meta img' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'image_size',
			[
				'label' => __( 'Width', 'archi' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 30,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .blockquote-meta img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'image_border_radius',
			[
				'label' => __( 'Border Radius', 'archi' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .blockquote-meta img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Name.
		$this->start_controls_section(
			'style_info',
			[
				'label' => __( 'Info', 'archi' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_control(
			'heading_name',
			[
				'label' => __( 'Name', 'archi' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_responsive_control(
			'spacing_name',
			[
				'label' => __( 'Spacing', 'archi' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tname' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'name_color',
			[
				'label' => __( 'Color', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tname' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'name_typography',
				'selector' => '{{WRAPPER}} .tname',
			]
		);

		$this->add_control(
			'heading_job',
			[
				'label' => __( 'Job', 'archi' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'job_color',
			[
				'label' => __( 'Color', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tjob' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'job_typography',
				'selector' => '{{WRAPPER}} .tjob',
			]
		);		

		$this->end_controls_section();

		// Dots.
		$this->start_controls_section(
			'navigation_section',
			[
				'label' => __( 'Dots', 'archi' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'navigation' => [ 'dots', 'both' ],
				],
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

        // Arrow.
		$this->start_controls_section(
			'style_nav',
			[
				'label' => __( 'Arrows', 'archi' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'navigation' => [ 'arrows', 'both' ],
				]
			]
		);
		
		$this->add_responsive_control(
			'arrow_spacing',
			[
				'label' => __( 'Spacing', 'archi' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .owl-nav button.owl-prev' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .owl-nav button.owl-next' => 'margin-right: {{SIZE}}{{UNIT}};',
				]
			]
		);

		$this->start_controls_tabs( 'tabs_arrow_style' );

		$this->start_controls_tab(
			'tab_arrow_normal',
			[
				'label' => __( 'Normal', 'archi' ),
			]
		);
		
		$this->add_control(
			'arrow_color',
			[
				'label' => __( 'Color', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .owl-nav button' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_control(
			'arrow_bgcolor',
			[
				'label' => __( 'Background', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .owl-nav button' => 'background: {{VALUE}};',
				]
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_arrow_hover',
			[
				'label' => __( 'Hover', 'archi' ),
			]
		);
		
		$this->add_control(
			'arrow_hcolor',
			[
				'label' => __( 'Color', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .owl-nav button:hover' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_control(
			'arrow_bg_hcolor',
			[
				'label' => __( 'Background', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .owl-nav button:hover' => 'background: {{VALUE}};',
				]
			]
		);
		
		$this->end_controls_tab();

		$this->end_controls_tabs();
		
		$this->end_controls_section();

	}

	protected function get_class_rating( $rating ) {
		$number_rating = [
			'1' => 'one',
			'2' => 'two',
			'3' => 'three',
			'4' => 'four',
			'5' => 'five',
		];

		return isset( $number_rating[ $rating ] ) ? $number_rating[ $rating ] : 'empty';
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$dots      = ( in_array( $settings['navigation'], [ 'dots', 'both' ] ) );
		$arrows    = ( in_array( $settings['navigation'], [ 'arrows', 'both' ] ) );
		$showXxl   = !empty( $settings['tshow'] ) ? $settings['tshow'] : 3;
		$showXl    = !empty( $settings['tshow_laptop'] ) ? $settings['tshow_laptop'] : $showXxl;
		$showLg    = !empty( $settings['tshow_tablet_extra'] ) ? $settings['tshow_tablet_extra'] : $showXl;
		$showMd    = !empty( $settings['tshow_tablet'] ) ? $settings['tshow_tablet'] : $showLg;
		$showSm    = !empty( $settings['tshow_mobile_extra'] ) ? $settings['tshow_mobile_extra'] : $showMd;
		$showXs    = !empty( $settings['tshow_mobile'] ) ? $settings['tshow_mobile'] : $showSm;

		$gapXxl      = isset( $settings['slider_spacing']['size'] ) && is_numeric( $settings['slider_spacing']['size'] ) ? ( $settings['slider_spacing']['size'] - 30 ) : 0;
		$gapXl  = isset( $settings['slider_spacing_laptop']['size'] ) && is_numeric( $settings['slider_spacing_laptop']['size'] ) ? ( $settings['slider_spacing_laptop']['size'] - 30 ) : $gapXxl;
		$gapLg  = isset( $settings['slider_spacing_tablet_extra']['size'] ) && is_numeric( $settings['slider_spacing_tablet_extra']['size'] ) ? ( $settings['slider_spacing_tablet_extra']['size'] - 30 ) : $gapXl;
		$gapMd  = isset( $settings['slider_spacing_tablet']['size'] ) && is_numeric( $settings['slider_spacing_tablet']['size'] ) ? ( $settings['slider_spacing_tablet']['size'] - 30 ) : $gapLg;
		$gapSm  = isset( $settings['slider_spacing_mobile_extra']['size'] ) && is_numeric( $settings['slider_spacing_mobile_extra']['size'] ) ? ( $settings['slider_spacing_mobile_extra']['size'] - 30 ) : $gapMd;
		$gapXs  = isset( $settings['slider_spacing_mobile']['size'] ) && is_numeric( $settings['slider_spacing_mobile']['size'] ) ? ( $settings['slider_spacing_mobile']['size'] - 30 ) : $gapSm;
		$timeout  = isset( $settings['timeout']['size'] ) ? $settings['timeout']['size'] : 5000;

		$owl_options = [
			'slides_show_desktop'  		 => absint( $showXxl ),
			'slides_show_laptop'  		 => absint( $showXl ),
			'slides_show_tablet_extra'   => absint( $showLg ),
			'slides_show_tablet'   		 => absint( $showMd ),
			'slides_show_mobile_extra'   => absint( $showSm ),
			'slides_show_mobile'   		 => absint( $showXs ),
			'margin_desktop'   	   		 => absint( $gapXxl ),
			'margin_laptop'   	   		 => absint( $gapXl ),
			'margin_tablet_extra'  		 => absint( $gapLg ),
			'margin_tablet'   	   		 => absint( $gapMd ),
			'margin_mobile_extra'   	 => absint( $gapSm ),
			'margin_mobile'   	   		 => absint( $gapXs ),
			'autoplay'      	   		 => $settings['autoplay'] ? $settings['autoplay'] : 'no',
			'autoplay_time_out'    		 => absint( $timeout ),
			'fade'      		   		 => 'no' ,
			'loop'      		   		 => $settings['loop'] ? $settings['loop'] : 'no' ,
			'arrows'        	   		 => $arrows,
			'dots'          	   		 => $dots,
		];

		$this->add_render_attribute(
			'slides', [
				'class'               => 'ot-carousel ot-testimonial-carousel',
				'data-slider_options' => wp_json_encode( $owl_options ),
			]
		);

		$this->add_render_attribute( 'testi-wrap', 'class', 'ot-testimonial-wrap' );
		
		?>

		<div <?php $this->print_render_attribute_string( 'slides' ); ?>>
			<div class="owl-carousel owl-theme">

				<?php
				foreach ( $settings['testi_slider'] as $key => $testi_item ) : 
				$image_url = Group_Control_Image_Size::get_attachment_image_src( $testi_item['timage']['id'], 'timage_size', $settings );
				if( empty($image_url) ){
					$image_url = Utils::get_placeholder_image_src();
				}
		        $image_html = '<img src="' . esc_attr( $image_url ) . '" alt="' . esc_attr( $testi_item['tname'] ) . '">';
				
				?>
				<div class="ot-testimonial-item">
					<div <?php $this->print_render_attribute_string('testi-wrap'); ?>>
						<div class="ot-testimonial__inner">
							<?php if( !empty($testi_item['is_rating']) ){ ?>
							<span class="ot-ratings <?php echo esc_attr( $this->get_class_rating( $testi_item['rating'] ) ) ?>"></span>
							<?php } ?>
							<blockquote class="with-rate">
								<p class="blockquote-content"><?php $this->print_unescaped_setting( 'tcontent', 'testi_slider', $key ); ?></p>
								<div class="blockquote-meta">
									<?php if( !empty( $testi_item['timage']['url'] ) ){ 
										echo wp_kses_post( $image_html ); 
									} ?>
									<div class="info">
										<h5 class="tname"><?php $this->print_unescaped_setting( 'tname', 'testi_slider', $key ); ?></h5>
						        		<?php if( !empty( $testi_item['tjob'] ) ) { ?><p class="tjob"><?php $this->print_unescaped_setting( 'tjob', 'testi_slider', $key ); ?></p><?php } ?>
									</div>
								</div>
							</blockquote>
			        	</div>		
				    </div>
				</div>
			    <?php endforeach; ?>
			</div>
		</div>

	    <?php
	}

}
// After the Archi_Testimonials_With_Rate_Carousel class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register( new Archi_Testimonials_With_Rate_Carousel() );