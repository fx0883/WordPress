<?php 
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Team Carousel
 */
class Archi_Team_Carousel extends Widget_Base{

 	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'ot-team-slider';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'OT Team Carousel', 'archi' );
	}

	// The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
	public function get_icon() {
		return 'eicon-person';
	}

	// The get_categories method, lets you set the category of the widget, return the category name as a string.
	public function get_categories() {
		return [ 'category_archi' ];
	}

	protected function register_controls() {

		/**TAB_CONTENT**/
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Member Team', 'archi' ),
			]
		);

		$this->add_control(
			'team_type',
			[
				'label' => __( 'Type Content', 'archi' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'display-on-hover',
				'options' => [
					'alway-display' 	 => __( 'Alway Display', 'archi' ),
					'display-on-hover'   => __( 'Display on hover', 'archi' ),
				]
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
	       'member_image',
	        [
	            'label' => esc_html__( 'Photo', 'archi' ),
	            'type'  => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				]
		    ]
		);
		
	    $repeater->add_control(
		    'member_name',
	      	[
	          	'label' => esc_html__( 'Name', 'archi' ),
	          	'type'  => Controls_Manager::TEXT,
				'default' => esc_html__( 'John Smith', 'archi' ),
	    	]
	    );

	    $repeater->add_control(
		    'member_extra',
	      	[
	          	'label' => esc_html__( 'Extra/Job', 'archi' ),
	          	'type'  => Controls_Manager::TEXTAREA,
	          	'default' => esc_html__( 'Project Manager', 'archi' ),
	    	]
	    );

	    $repeater->add_control(
		    'member_desc',
	      	[
	          	'label' => esc_html__( 'Description', 'archi' ),
	          	'type'  => Controls_Manager::TEXTAREA,
	          	'default' => '',
	    	]
	    );
	    $repeater->add_control(
			'link',
			[
				'label' => __( 'Link To Details', 'archi' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://', 'archi' ),
			]
		);
	    $repeater->add_control(
			'social_share',
			[
				'label' => __( 'Socials', 'archi' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'archi' ),
				'label_off' => __( 'Hide', 'archi' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'separator' => 'before',
			]
		);
		$default_social1_icon = [
			'value' => 'fab fa-facebook-f',
			'library' => 'fa-brand',
		];
		$default_social2_icon = [
			'value' => 'fab fa-instagram',
			'library' => 'fa-brand',
		];
		$default_social3_icon = [
			'value' => 'fab fa-linkedin-in',
			'library' => 'fa-brand',
		];

        $repeater->add_control(
		    'social1',
	      	[
	          	'label' => esc_html__( 'Icon Social 1', 'archi' ),
                'type'  => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
				'default' => $default_social1_icon,
				'condition' => [
					'social_share' => 'yes',
				],
	    	]
	    );
	    $repeater->add_control(
			'social1_link',
			[
				'label' => __( 'Link Social 1', 'archi' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://twitter.com/', 'archi' ),
				'condition' => [
					'social_share' => 'yes',
				],
			]
		);
		$repeater->add_control(
			'social1_color',
			[
				'label' => esc_html__( 'Color', 'archi' ),
				'type' => Controls_Manager::COLOR,
			]
		);
		$repeater->add_control(
		    'social2',
	      	[
	          	'label' => esc_html__( 'Icon Social 2', 'archi' ),
                'type'  => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
				'default' => $default_social2_icon,
				'separator' => 'before',
				'condition' => [
					'social_share' => 'yes',
				],
	    	]
	    );
	    $repeater->add_control(
			'social2_link',
			[
				'label' => __( 'Link Social 2', 'archi' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://facebook.com/', 'archi' ),
				'condition' => [
					'social_share' => 'yes',
				],
			]
		);
		$repeater->add_control(
			'social2_color',
			[
				'label' => esc_html__( 'Color', 'archi' ),
				'type' => Controls_Manager::COLOR,
			]
		);

		$repeater->add_control(
		    'social3',
	      	[
	          	'label' => esc_html__( 'Icon Social 3', 'archi' ),
                'type'  => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
				'default' => $default_social3_icon,
				'separator' => 'before',
				'condition' => [
					'social_share' => 'yes',
				],
	    	]
	    );
	    $repeater->add_control(
			'social3_link',
			[
				'label' => __( 'Link Social 3', 'archi' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://dribbble.com/', 'archi' ),
				'condition' => [
					'social_share' => 'yes',
				],
			]
		);
		$repeater->add_control(
			'social3_color',
			[
				'label' => esc_html__( 'Color', 'archi' ),
				'type' => Controls_Manager::COLOR,
			]
		);

		$this->add_control(
		    'ot_teams',
		    [
		        'label'       => esc_html__( 'Teams', 'archi' ),
		        'type'        => Controls_Manager::REPEATER,
		        'show_label'  => true,
		        'default'     => [
		        	[
		        		'member_image'	  => [
		        			'url' => Utils::get_placeholder_image_src(),
		        		],
						'member_name'	  => __( 'Coriss Ambady', 'archi' ),
						'member_extra'	  => __( 'Financial Analyst', 'archi' ),
						'social1' 		  => $default_social1_icon,
						'social1_link'	  => [
							'url' 	=> '#'
						],
						'social2' 		  => $default_social2_icon,
						'social2_link'	  => [
							'url' 	=> '#'
						],
						'social3' 		  => $default_social3_icon,
						'social3_link'	  => [
							'url' 	=> '#'
						],
		            ],
		            [
		            	'member_image'	  => [
		        			'url' => Utils::get_placeholder_image_src(),
		        		],
						'member_name'	  => __( 'Cory Zamora', 'archi' ),
						'member_extra'	  => __( 'Marketing Specialist', 'archi' ),
						'social1' 		  => $default_social1_icon,
						'social1_link'	  => [
							'url' 	=> '#'
						],
						'social2' 		  => $default_social2_icon,
						'social2_link'	  => [
							'url' 	=> '#'
						],
						'social3' 		  => $default_social3_icon,
						'social3_link'	  => [
							'url' 	=> '#'
						],
		            ],
		            [
		            	'member_image'	  => [
		        			'url' => Utils::get_placeholder_image_src(),
		        		],
						'member_name'	  => __( 'Barclay Widerski', 'archi' ),
						'member_extra'	  => __( 'Sales Specialist', 'archi' ),
						'social1' 		  => $default_social1_icon,
						'social1_link'	  => [
							'url' 	=> '#'
						],
						'social2' 		  => $default_social2_icon,
						'social2_link'	  => [
							'url' 	=> '#'
						],
						'social3' 		  => $default_social3_icon,
						'social3_link'	  => [
							'url' 	=> '#'
						],
		            ]
		        ],
		        'fields'      => $repeater->get_controls(),
		        'title_field' => '{{{member_name}}}',
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

		/**TAB_STYLE**/

		$this->start_controls_section(
			'photo_style',
			[
				'label' => esc_html__( 'General', 'archi' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'team_padding',
			[
				'label' => __( 'Padding', 'archi' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ot-team__info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		
		$this->add_control(
			'team_bgcolor',
			[
				'label'     => esc_html__( 'Background', 'archi' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ot-team__info' => 'background: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'info_style',
			[
				'label' => esc_html__( 'Detail', 'archi' ),
				'tab'   => Controls_Manager::TAB_STYLE,
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

		$this->add_responsive_control(
			'title_space',
			[
				'label' => esc_html__( 'Spacing', 'archi' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tname' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => esc_html__( 'Color', 'archi' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .tname, {{WRAPPER}} .tname a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'title_hcolor',
			[
				'label'     => esc_html__( 'Hover', 'archi' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .tname a:hover' => 'color: {{VALUE}};',
				],
				'condition' => [
					'link[url]!'  => ''
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'label'    => esc_html__( 'Typography', 'archi' ),
				'selector' => '{{WRAPPER}} .tname',
			]
		);

		/* extra */
		$this->add_control(
			'heading_job',
			[
				'label' => __( 'Extra/Job', 'archi' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'job_space',
			[
				'label' => esc_html__( 'Spacing', 'archi' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tjob' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'job_color',
			[
				'label'     => esc_html__( 'Color', 'archi' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .tjob' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'job_typography',
				'label'    => esc_html__( 'Typography', 'archi' ),
				'selector' => '{{WRAPPER}} .tjob',
			]
		);

		/* description */
		$this->add_control(
			'heading_desc',
			[
				'label' => __( 'Description', 'archi' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'desc_space',
			[
				'label' => esc_html__( 'Spacing', 'archi' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ot-team__info .tdesc' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'desc_color',
			[
				'label'     => esc_html__( 'Color', 'archi' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .ot-team__info .tdesc' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'desc_typography',
				'label'    => esc_html__( 'Typography', 'archi' ),
				'selector' => '{{WRAPPER}} .ot-team__info .tdesc',
			]
		);

		$this->end_controls_section();

		/* Socials */
		$this->start_controls_section(
			'icon_style',
			[
				'label' => esc_html__( 'Socials', 'archi' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'icon_social_space',
			[
				'label' => esc_html__( 'Spacing', 'archi' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .team-social a:not(:last-child)' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'icon_social_size',
			[
				'label' => esc_html__( 'Size', 'archi' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 5,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .team-social a' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'icon_social_color',
			[
				'label'     => esc_html__( 'Color', 'archi' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .team-social a' => 'color: {{VALUE}};',
					'{{WRAPPER}} .team-social a svg' => 'fill: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'icon_hover_color',
			[
				'label'     => esc_html__( 'Hover', 'archi' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .team-social a:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .team-social a:hover svg' => 'fill: {{VALUE}};',
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

	protected function render() {
		$settings = $this->get_settings_for_display();

		if ( empty( $settings['ot_teams'] ) ) {
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

		$gapXxl      = isset( $settings['slider_spacing']['size'] ) && is_numeric( $settings['slider_spacing']['size'] ) ? ( $settings['slider_spacing']['size'] ) : 30;
		$gapXl  = isset( $settings['slider_spacing_laptop']['size'] ) && is_numeric( $settings['slider_spacing_laptop']['size'] ) ? ( $settings['slider_spacing_laptop']['size'] ) : $gapXxl;
		$gapLg  = isset( $settings['slider_spacing_tablet_extra']['size'] ) && is_numeric( $settings['slider_spacing_tablet_extra']['size'] ) ? ( $settings['slider_spacing_tablet_extra']['size'] ) : $gapXl;
		$gapMd  = isset( $settings['slider_spacing_tablet']['size'] ) && is_numeric( $settings['slider_spacing_tablet']['size'] ) ? ( $settings['slider_spacing_tablet']['size'] ) : $gapLg;
		$gapSm  = isset( $settings['slider_spacing_mobile_extra']['size'] ) && is_numeric( $settings['slider_spacing_mobile_extra']['size'] ) ? ( $settings['slider_spacing_mobile_extra']['size'] ) : $gapMd;
		$gapXs  = isset( $settings['slider_spacing_mobile']['size'] ) && is_numeric( $settings['slider_spacing_mobile']['size'] ) ? ( $settings['slider_spacing_mobile']['size'] ) : $gapSm;
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
				'class'               => 'ot-carousel ot-team-carousel',
				'data-slider_options' => wp_json_encode( $owl_options ),
			]
		);

		$this->add_render_attribute( 'team-box', 'class', [ 'ot-team', $settings['team_type'] ] );

		?>

		<div <?php $this->print_render_attribute_string( 'slides' ); ?>>
			<div class="owl-carousel owl-theme">
				<?php
				foreach ( $settings['ot_teams'] as $key => $mem ) : 
				$image_url = Group_Control_Image_Size::get_attachment_image_src( $mem['member_image']['id'], 'full', $settings );
				if( empty($image_url) ){
					$image_url = Utils::get_placeholder_image_src();
				}
		        $image_html = '<img src="' . esc_attr( $image_url ) . '" alt="' . esc_attr( $mem['member_name'] ) . '">';
				$tname = $mem['member_name'];

				if ( ! empty( $mem['link']['url'] ) ) {
					$this->add_link_attributes( 'm_link' . $key, $mem['link'] );
					$tname = '<a ' .$this->get_render_attribute_string( 'm_link' . $key ). '>' .$tname. '</a>';
				}
				?>
				<div <?php $this->print_render_attribute_string( 'team-box' ); ?>>
					<?php if( $mem['member_image']['url'] ) { ?>
					<figure class="ot-team__thumb">
						<?php echo wp_kses_post( $image_html ); ?>
					</figure>
					<?php } ?>
					<div class="ot-team__info">
						<h3 class="tname"><?php echo wp_kses_post( $tname ); ?></h3>
						<p class="tjob"><?php $this->print_unescaped_setting( 'member_extra', 'ot_teams', $key ); ?></p>
						<?php if ( $mem['member_desc'] ) { echo '<div class="small-border"></div><p class="tdesc">' . wp_kses_post( $mem['member_desc'] ) . '</p>'; } ?>

						<?php if ( $mem['social_share'] == 'yes' ) : ?>
						<div class="team-social">
							<?php if ( ! empty( $mem['social1']['value'] ) ) :
								$this->add_link_attributes( 'social_1' . $key, $mem['social1_link'] );
								if( !empty( $mem['social1_color'] ) ){
									$this->add_render_attribute( 'social_1' . $key, 'style', [
										'color: '. $mem['social1_color']
									] );
								}
							?>
							<a <?php $this->print_render_attribute_string( 'social_1' . $key ); ?>>
								<?php Icons_Manager::render_icon( $mem['social1'], [ 'aria-hidden' => 'true' ] ); ?>
							</a>
							<?php endif; ?>

							<?php if ( ! empty( $mem['social2']['value'] ) ) :
								$this->add_link_attributes( 'social_2' . $key, $mem['social2_link'] );
								if( !empty( $mem['social2_color'] ) ){
									$this->add_render_attribute( 'social_2' . $key, 'style', [
										'color: '. $mem['social2_color']
									] );
								}
							?>
							<a <?php $this->print_render_attribute_string( 'social_2' . $key ); ?>>
								<?php Icons_Manager::render_icon( $mem['social2'], [ 'aria-hidden' => 'true' ] ); ?>
							</a>
							<?php endif; ?>

							<?php if ( ! empty( $mem['social3']['value'] ) ) :
								$this->add_link_attributes( 'social_3' . $key, $mem['social3_link'] );
								if( !empty( $mem['social3_color'] ) ){
									$this->add_render_attribute( 'social_3' . $key, 'style', [
										'color: '. $mem['social3_color']
									] );
								}
							?>
							<a <?php $this->print_render_attribute_string( 'social_3' . $key ); ?>>
								<?php Icons_Manager::render_icon( $mem['social3'], [ 'aria-hidden' => 'true' ] ); ?>
							</a>
							<?php endif; ?>
						</div>
						<?php endif; ?>
					</div>
				</div>
				<?php endforeach; ?>
	        </div>
	    </div>
	    <?php
	}

}
// After the Archi_Team_Carousel class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register( new Archi_Team_Carousel() );