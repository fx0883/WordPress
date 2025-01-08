<?php
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Portfolio Creative Filter
 */
class Archi_Portfolio_Creative_Carousel extends Widget_Base{

 	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'ot-portfolio-creative-carousel';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'OT Portfolio Creative Carousel', 'archi' );
	}

	// The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
	public function get_icon() {
		return 'eicon-gallery-grid';
	}

	// The get_categories method, lets you set the category of the widget, return the category name as a string.
	public function get_categories() {
		return [ 'category_archi' ];
	}

	protected function register_controls() {

		//Content
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'General', 'archi' ),
			]
		);
		
		$this->add_control(
			'project_cat',
			[
				'label' => __( 'Select Categories', 'archi' ),
				'type' => Controls_Manager::SELECT2,
				'options' => $this->select_param_cate_project(),
				'multiple' => true,
				'label_block' => true,
				'placeholder' => __( 'All Categories', 'archi' ),
				'separator' => 'before',
			]
		);
		$this->add_control(
			'project_num',
			[
				'label' => __( 'Show Number Projects', 'archi' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 6,
			]
		);
		
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'post_thumbnail', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
				'exclude' => ['1536x1536', '2048x2048'],
				'include' => [],
				'default' => 'full',
			]
		);
		
		$this->add_control(
			'view_more',
			[
				'label' => __( 'Label View Button ', 'archi' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Click to view', 'archi' ),
				'placeholder' => __( 'Click to view', 'archi' ),
				'separator' => 'before',
			]
		);
		
		$this->add_control(
			'hover_style',
			[
				'label' => __( 'Creative Type', 'archi' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => [
					'style-1'  	=> __( 'Creative 1', 'archi' ),
					'style-2' 	=> __( 'Creative 2', 'archi' ),
					'style-3' 	=> __( 'Creative 3', 'archi' ),
				],
			]
		);
		$this->add_control(
			'popup_gallery',
			[
				'label' => __( 'Popup Gallery', 'archi' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'archi' ),
				'label_off' => __( 'No', 'archi' ),
				'return_value' => 'yes',
				'default' => '',
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

		$this->add_control(
			'slide_type',
			[
				'label' => __( 'Slide Type', 'archi' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'slide',
				'options' => [
					'slide' => __( 'Slide', 'archi' ),
					'coverflow' => __( 'Coverflow', 'archi' ),
				],
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
			'reverse_direction',
			[
				'label' => __( 'Reverse Direction', 'archi' ),
				'type'    => Controls_Manager::SWITCHER,
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
			'slider_speed',
			[
				'label' => __( 'Speed', 'archi' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min'  => 100,
						'max'  => 20000,
						'step' => 50,
					],
				],
				'default' => [
					'size' => 300,
				],
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

		//Style
		$this->start_controls_section(
			'filter_style_section',
			[
				'label' => __( 'Filter', 'archi' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'filter' => 'yes',
				]
			]
		);

		$this->add_responsive_control(
			'filter_align',
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
					]
				],
				'selectors' => [
					'{{WRAPPER}} .isotope-filter,
					 {{WRAPPER}} .loadmore_wrapper' => 'text-align: {{VALUE}};',
				],
				'default' => 'center',
			]
		);
		
		$this->add_responsive_control(
			'filter_spacing',
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
					'{{WRAPPER}} .isotope-filter' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'filter_color',
			[
				'label' => __( 'Color', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .isotope-filter ul li a:not(.active)' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'filter_hcolor',
			[
				'label' => __( 'Active Color', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .isotope-filter ul li a.active,
					 {{WRAPPER}} .isotope-filter ul li a:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'filter_bg_hcolor',
			[
				'label' => __( 'Background Active Color', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .isotope-filter ul li a.active,
					 {{WRAPPER}} .isotope-filter ul li a:hover' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'filter_typography',
				'selector' => '{{WRAPPER}} .isotope-filter ul li a',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'overlay_style_section',
			[
				'label' => __( 'Project Items', 'archi' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'bg_overlay_color',
			[
				'label' => __( 'Background Overlay', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} span.bg' => 'background: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'border_radius',
			[
				'label' => __( 'Border Radius', 'archi' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .projects-thumbnail,
					 {{WRAPPER}} .projects-thumbnail img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
        );

		/* title */
		$this->add_control(
			'heading_title',
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
		$this->add_responsive_control(
			'title_size_hover',
			[
				'label' => __( 'Font Size When Hover', 'archi' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 5,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .creative-three:hover .post-title' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'hover_style'	=> 'style-3'
				]
			]
		);

		/* Label view button */
		$this->add_control(
			'btn_view',
			[
				'label' => __( 'View Button', 'archi' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'btn_view_color',
			[
				'label' => __( 'Color', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} span.btn-text' => 'color: {{VALUE}};',
					'{{WRAPPER}} span.line' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'btn_view_typography',
				'selector' => '{{WRAPPER}} span.btn-text',
			]
		);

		$this->end_controls_section();	
		
		/* Load More Button */
		$this->start_controls_section(
			'style_section',
			[
				'label' => __( 'Load More Button', 'archi' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'load_more[value]!' => '',
				]
			]
		);

		$this->add_responsive_control(
			'btn_spacing',
			[
				'label' => __( 'Spacing', 'archi' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .loadmore_wrapper' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'btn_width',
			[
				'label' => __( 'Width', 'archi' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 1000,
					],
					'%' => [
						'min' => 1,
						'max' => 100,
					]
				],
				'selectors' => [
					'{{WRAPPER}} .octf-btn' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_responsive_control(
			'btn_padding',
			[
				'label' => 'Padding',
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .octf-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'btn_typography',
				'selector' => '{{WRAPPER}} .octf-btn',
			]
		);
		$this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label' => __( 'Normal', 'archi' ),
			]
		);

		$this->add_control(
			'button_text_color',
			[
				'label' => __( 'Text Color', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .octf-btn' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'btn_bg',
			[
				'label' => __( 'Background', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .octf-btn' => 'background-color: {{VALUE}};',
				],
			]
		);
		
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label' => __( 'Hover', 'archi' ),
			]
		);

		$this->add_control(
			'hover_color',
			[
				'label' => __( 'Text Color', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .octf-btn:hover, {{WRAPPER}} .octf-btn:focus' => 'color: {{VALUE}};',
				],
			]
		);

        $this->add_control(
			'btn_bg_hover_color',
			[
				'label' => __( 'Background', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .octf-btn:hover' => 'background-color: {{VALUE}};',
				],
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
						'min' => -200,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ot-carousel .octf-swiper-pagination' => 'margin-top: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .octf-swiper-pagination .swiper-pagination-bullet' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
            'dots_bgcolor',
            [
                'label' => __( 'Color', 'archi' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
					'{{WRAPPER}} .octf-swiper-pagination .swiper-pagination-bullet' => 'background-color: {{VALUE}};',
				],
            ]
        );
        $this->add_control(
            'dots_active_bgcolor',
            [
                'label' => __( 'Active', 'archi' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
					'{{WRAPPER}} .octf-swiper-pagination .swiper-pagination-bullet:hover,
					 {{WRAPPER}} .octf-swiper-pagination .swiper-pagination-bullet.swiper-pagination-bullet-active' => 'background-color: {{VALUE}};',
				],
            ]
        );

        $this->end_controls_section();
        
		// Arrow
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
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .octf-swiper-nav .octf-swiper-button-prev' => 'left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .octf-swiper-nav .octf-swiper-button-next' => 'right: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .octf-swiper-nav > div' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .octf-swiper-nav > div' => 'background: {{VALUE}};',
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
					'{{WRAPPER}} .octf-swiper-nav > div:hover' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .octf-swiper-nav > div:hover' => 'background: {{VALUE}};',
				]
			]
		);
		
		$this->end_controls_tab();

		$this->end_controls_tabs();
		
		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		
		if( $settings['hover_style'] == 'style-3' ){
			$hover_style = 'creative-three';
		}elseif( $settings['hover_style'] == 'style-2' ){
			$hover_style = 'creative-two';
		}else{
			$hover_style = 'creative-one';
		}
		$settings['hover_style'] = $hover_style;

		/* Get param query portfolio */
		$cat_ids_arr = [];
    	if( $settings['project_cat'] ) {
    		foreach( (array)$settings['project_cat'] as $cates){
                $cate = get_term_by('slug', $cates, 'portfolio_cat');
                $cat_ids_arr[] = $cate->term_id;
            }
            $args = array(	                    
                'post_type' => 'ot_portfolio',
                'post_status' => 'publish',
                'posts_per_page' => $settings['project_num'],
                'tax_query' => array(
                    array(
                        'taxonomy' => 'portfolio_cat',
                        'field' => 'term_id',
                        'terms' => $cat_ids_arr,
                    ),
                ),              
			);
        } else {
            $args = array(
                'post_type' => 'ot_portfolio',
                'post_status' => 'publish',
                'posts_per_page' => $settings['project_num'],
            );
        }

        $wp_query = new \WP_Query($args);

        /* End get param query portfolio */

        /* Get option slider portfolio */
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
		$speed  = 	isset( $settings['slider_speed']['size'] ) ? $settings['slider_speed']['size'] : 300;
		$slide_type    = $settings['slide_type'];

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
			'data_reverse'       	     => $settings['reverse_direction'] ? $settings['reverse_direction'] : 'no' ,
			'autoplay'      	   		 => $settings['autoplay'] ? $settings['autoplay'] : 'no',
			'autoplay_time_out'    		 => absint( $timeout ),
			'data_speed'    		 	 => absint( $speed ),
			'loop'      		   		 => $settings['loop'] ? $settings['loop'] : 'no' ,
			'arrows'        	   		 => $arrows,
			'dots'          	   		 => $dots,
			'slide_type'				 => $slide_type
		];

		$this->add_render_attribute([
			'filter-wrapper' => [
				'class'   => [
					'ot-carousel', 
					'ot-project-creative-carousel',
					'swiper swiper-container',
					$settings['popup_gallery'] == 'yes' ? 'image-popup-gallery' : ''
				],
				'dir' => is_rtl() ? 'rtl': 'ltr',
				'data-slider_options' => wp_json_encode( $owl_options ),
				'data-item-slider' => 'swiper_slider_'.$this->get_id(),
			]
		]);

		?>

		<div class="projects-filter-wrapper">
			
	        <div <?php echo $this->get_render_attribute_string( 'filter-wrapper' ); ?>>
				<div class="swiper-wrapper">
		            <?php
		            while ($wp_query -> have_posts()) : $wp_query -> the_post();
					?>
						<div class="swiper-slide">
							<?php
								get_template_part( 'template-parts/content', 'project-creative-filter', array(
									'settings' => $settings
								));
							?>
						</div>
					<?php
		            endwhile; wp_reset_postdata(); ?>
		        </div>

		        <?php if( $dots ){ ?>
				<!-- Add Dots -->
				<div class="octf-swiper-pagination" data-slider="<?php echo esc_attr('swiper_slider_'.$this->get_id()) ?>"></div>
				<?php } ?>

		        <?php if( $arrows  ){ ?>
				<!-- Add Arrows -->
				<div class="octf-swiper-nav">
					<div class="octf-swiper-button-next" data-slider="<?php echo esc_attr('swiper_slider_'.$this->get_id()) ?>"><i class="fa fa-angle-right"></i></div>
					<div class="octf-swiper-button-prev" data-slider="<?php echo esc_attr('swiper_slider_'.$this->get_id()) ?>"><i class="fa fa-angle-left"></i></i></div>
				</div>					
				<?php } ?>

			</div>
	    </div>
										
	    <?php
	}

	public function get_keywords() {
		return [ 'isotope', 'project', 'filter' ];
	}

	protected function select_param_cate_project() {
		$category = get_terms( 'portfolio_cat' );
		$cat = array();
		if ( ! is_wp_error( $category ) && ! empty( $category ) ){
			foreach( $category as $item ) {
			    if( $item ) {
				  	$cat[$item->slug] = $item->name;
			   	}
			}
		}
		return $cat;
	}
}
// After the Archi_Portfolio_Creative_Carousel class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register( new Archi_Portfolio_Creative_Carousel() );