<?php 
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Image Carousel
 */
class Archi_Image_Slider extends Widget_Base{

 	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'ot-image-slider';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'OT Image Slider', 'archi' );
	}

	// The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
	public function get_icon() {
		return 'eicon-slider-push';
	}

	// The get_categories method, lets you set the category of the widget, return the category name as a string.
	public function get_categories() {
		return [ 'category_archi' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Logo', 'archi' ),
			]
		);

		$repeater = new Repeater();
		$repeater->add_control(
			'title',
			[
				'label' => __( 'Name', 'archi' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Client', 'archi' ),
			]
		);
		
		$repeater->add_control(
			'image_client',
			[
				'label' => __( 'Image', 'archi' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				]
			]
		);
		
		$repeater->add_control(
			'link_detail',
			[
				'label' => __( 'Link', 'archi' ),
				'type' => Controls_Manager::URL,
				'default' => [],
			]
		);
		$this->add_control(
		    'images_slider',
		    [
		        'label'       => '',
		        'type'        => Controls_Manager::REPEATER,
		        'show_label'  => false,
		        'default'     => [
		        	[
			        	'title'	  => __( 'Client 1', 'archi' ),
						'image_client'	  => [
							'url' 	=> Utils::get_placeholder_image_src(),
						],
					],
					[
			        	'title'	  => __( 'Client 2', 'archi' ),
						'image_client'	  => [
							'url' 	=> Utils::get_placeholder_image_src(),
						],
					],
					[
			        	'title'	  => __( 'Client 3', 'archi' ),
						'image_client'	  => [
							'url' 	=> Utils::get_placeholder_image_src(),
						],
					]
		        ],
		        'fields'      => $repeater->get_controls(),
		        'title_field' => '{{{title}}}',
		    ]
		);

		$this->add_control(
			'hover_style',
			[
				'label' => __( 'Hover Style', 'archi' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => [
					'none'  	=> __( 'Default', 'archi' ),
					'style-1'  	=> __( 'Title Overlay', 'archi' ),
					'style-2' 	=> __( 'Hidden Title Overlay', 'archi' ),
				],
			]
		);

		/* Option Slider */

		$this->add_control(
			'heading_option_slider',
			[
				'label' => esc_html__( 'Slider Option', 'archi' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$slides_show = range( 1, 10 );
		$slides_show = array_combine( $slides_show, $slides_show );

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
				'label' => __( 'Slider Spacing', 'archi' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
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

		//Style

		$this->start_controls_section(
			'image_style_section',
			[
				'label' => __( 'Image', 'archi' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'popup_gallery',
			[
				'label' => __( 'Image Gallery', 'archi' ),
				'type'    => Controls_Manager::SWITCHER,
			]
		);

		$this->add_responsive_control(
			'logo_vertical_align',
			[
				'label' => __( 'Vertical Align', 'archi' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'flex-start' => [
						'title' => __( 'Start', 'archi' ),
						'icon' => 'eicon-v-align-top',
					],
					'center' => [
						'title' => __( 'Center', 'archi' ),
						'icon' => 'eicon-v-align-middle',
					],
					'flex-end' => [
						'title' => __( 'End', 'archi' ),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'condition' => [
					'tshow!' => '1',
				],
				'selectors' => [
					'{{WRAPPER}} .owl-stage' => 'display: flex; align-items: {{VALUE}};',
					'{{WRAPPER}} .owl-stage >*' => 'flex-shrink: 0;',
				],
			]
		);

		$this->add_responsive_control(
			'img_width',
			[
				'label' => __( 'Width', 'archi' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
					'%' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} figure img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'logo_padding',
			[
				'label' => 'Padding',
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} figure' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs( 'image_effects' );

		$this->start_controls_tab( 'normal',
			[
				'label' => esc_html__( 'Normal', 'archi' ),
			]
		);

		$this->add_control(
			'opacity',
			[
				'label' => esc_html__( 'Opacity', 'archi' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 1,
						'min' => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} figure img' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'css_filters',
				'selector' => '{{WRAPPER}} figure img',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'hover',
			[
				'label' => esc_html__( 'Hover', 'archi' ),
			]
		);

		$this->add_control(
			'opacity_hover',
			[
				'label' => esc_html__( 'Opacity', 'archi' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 1,
						'min' => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} figure:hover img' => 'opacity: {{SIZE}};',
				],
			]
		);
		$this->add_control(
			'hover_scale',
			[
				'label' => __( 'Hover Scale', 'archi' ),
				'type'    => Controls_Manager::SWITCHER,
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'css_filters_hover',
				'selector' => '{{WRAPPER}} figure:hover img',
			]
		);
		$this->end_controls_tab();

		$this->end_controls_tabs();

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

		$this->start_controls_section(
			'overlay_style_section',
			[
				'label' => __( 'Overlay', 'archi' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'hover_style!' => 'none'
				]
			]
		);
		$this->add_control(
			'bg_overlay_color',
			[
				'label' => __( 'Background', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} span.bg' => 'background: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => __( 'Title', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .post-title' => 'color: {{VALUE}};',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .post-title',
			]
		);
		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		if ( empty( $settings['images_slider'] ) ) {
			return;
		}
		$dots      = ( in_array( $settings['navigation'], [ 'dots', 'both' ] ) );
		$arrows    = ( in_array( $settings['navigation'], [ 'arrows', 'both' ] ) );
		$showXxl   = !empty( $settings['tshow'] ) ? $settings['tshow'] : 3;
		$showXl    = !empty( $settings['tshow_laptop'] ) ? $settings['tshow_laptop'] : $showXxl;
		$showLg    = !empty( $settings['tshow_tablet_extra'] ) ? $settings['tshow_tablet_extra'] : $showXl;
		$showMd    = !empty( $settings['tshow_tablet'] ) ? $settings['tshow_tablet'] : $showLg;
		$showSm    = !empty( $settings['tshow_mobile_extra'] ) ? $settings['tshow_mobile_extra'] : $showMd;
		$showXs    = !empty( $settings['tshow_mobile'] ) ? $settings['tshow_mobile'] : $showSm;

		$gapXxl      = isset( $settings['slider_spacing']['size'] ) && is_numeric( $settings['slider_spacing']['size'] ) ? $settings['slider_spacing']['size'] : 30;
		$gapXl  = isset( $settings['slider_spacing_laptop']['size'] ) && is_numeric( $settings['slider_spacing_laptop']['size'] ) ? $settings['slider_spacing_laptop']['size'] : $gapXxl;
		$gapLg  = isset( $settings['slider_spacing_tablet_extra']['size'] ) && is_numeric( $settings['slider_spacing_tablet_extra']['size'] ) ? $settings['slider_spacing_tablet_extra']['size'] : $gapXl;
		$gapMd  = isset( $settings['slider_spacing_tablet']['size'] ) && is_numeric( $settings['slider_spacing_tablet']['size'] ) ? $settings['slider_spacing_tablet']['size'] : $gapLg;
		$gapSm  = isset( $settings['slider_spacing_mobile_extra']['size'] ) && is_numeric( $settings['slider_spacing_mobile_extra']['size'] ) ? $settings['slider_spacing_mobile_extra']['size'] : $gapMd;
		$gapXs  = isset( $settings['slider_spacing_mobile']['size'] ) && is_numeric( $settings['slider_spacing_mobile']['size'] ) ? $settings['slider_spacing_mobile']['size'] : $gapSm;
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
			'loop'      		   		 => $settings['loop'] ? $settings['loop'] : 'no' ,
			'arrows'        	   		 => $arrows,
			'dots'          	   		 => $dots,
		];

		$this->add_render_attribute(
			'slides', [
				'class'   => [
					'ot-carousel ot-image-carousel',
					$settings['popup_gallery'] == 'yes' ? 'image-popup-gallery' : ''
				],
				'data-slider_options' => wp_json_encode( $owl_options ),
			]
		);
		
		?>
		<div <?php echo $this->get_render_attribute_string( 'slides' ); ?>>
			<div class="owl-carousel owl-theme">

			<?php
			foreach ( $settings['images_slider'] as $key => $item ) {
				$title = $item['title'];
				$slide_html= '';

				$image_html = wp_get_attachment_image( $item['image_client']['id'], 'full' );

				if ( empty( $image_html ) && isset( $item['image_client']['url'] ) ) {
					$image_html = '<img src="' . esc_attr( $item['image_client']['url'] ) . '" alt="' . esc_attr( Control_Media::get_image_alt( $item['image_client'] ) ) . '" />';
				}
				
				if( !empty( $item['link_detail']['url'] ) && empty( $settings['popup_gallery'] ) ){
					$this->add_render_attribute(
						'link' . $key, [
							'class'   => [
								'link_detail',
								$settings['hover_style'] != 'none' ? 'overlay' : '',
								$settings['hover_style'] == 'style-2' ? 'reverse' : '',
								$settings['hover_scale'] == 'yes' ? 'hover-scale' : ''
							],
						]
					);
					$this->add_link_attributes( 'link' . $key, $item['link_detail'] );
					$image_html = '<a '.$this->get_render_attribute_string('link' . $key). '>' . $image_html;
				}elseif( !empty( $settings['popup_gallery'] ) ){
					$this->add_render_attribute(
						'link' . $key, [
							'class'   => [
								'link_detail',
								$settings['hover_style'] != 'none' ? 'overlay' : '',
								$settings['hover_style'] == 'style-2' ? 'reverse' : '',
								$settings['hover_scale'] == 'yes' ? 'hover-scale' : ''
							],
							'data-src' => [
								$item['image_client']['url']
							],
							'data-sub-html' => [
								Control_Media::get_image_alt( $item['image_client'] )
							]
						]
					);
					$image_html = '<a '.$this->get_render_attribute_string('link' . $key). '>' . $image_html;
				}
				if( $settings['hover_style'] != 'none' ){
					$image_html .= '<span class="bg"></span>';
					if( !empty( $title ) ){
						$image_html .= '<figcaption><h5 class="post-title">'.$title.'</h5></figcaption>';
					}
				} 
				$image_html .= '</a>';
				$slide_html = '<figure>' . $image_html . '</figure>';
            	echo wp_kses_post( $slide_html );
			}
			?>

			</div>
	    </div>
		<?php 
		
	}

	public function get_keywords() {
		return [ 'slider', 'carousel', 'logo' ];
	}

}
// After the Archi_Image_Slider class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register( new Archi_Image_Slider() );