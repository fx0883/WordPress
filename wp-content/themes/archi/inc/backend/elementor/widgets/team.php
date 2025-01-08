<?php 
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Team 3
 */
class Archi_Team extends Widget_Base{

 	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'ot-team';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'OT Team', 'archi' );
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

		$this->add_control(
	       'member_image',
	        [
	            'label' => esc_html__( 'Photo', 'archi' ),
	            'type'  => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				]
		    ]
		);
		
	    $this->add_control(
		    'member_name',
	      	[
	          	'label' => esc_html__( 'Name', 'archi' ),
	          	'type'  => Controls_Manager::TEXT,
				'default' => esc_html__( 'John Smith', 'archi' ),
	    	]
	    );

	    $this->add_control(
		    'member_extra',
	      	[
	          	'label' => esc_html__( 'Extra/Job', 'archi' ),
	          	'type'  => Controls_Manager::TEXTAREA,
	          	'default' => esc_html__( 'Project Manager', 'archi' ),
	    	]
	    );

	    $this->add_control(
		    'member_desc',
	      	[
	          	'label' => esc_html__( 'Description', 'archi' ),
	          	'type'  => Controls_Manager::TEXTAREA,
	          	'default' => '',
	    	]
	    );
	    $repeater = new Repeater();
		$repeater->add_control(
	      	'title',
		    [
		        'label'   => esc_html__( 'Name', 'archi' ),
		        'type'    => Controls_Manager::TEXT,
		        'default' => esc_html__( 'Social', 'archi' ),
		    ]
	    );

        $repeater->add_control(
            'social_icon',
            [
                'label' => esc_html__( 'Icon', 'archi' ),
                'type'  => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
				'default' => [
					'value' => 'fab fa-twitter',
					'library' => 'fa-brand',
				],
            ]
        );
        $repeater->add_control(
			'item_icon_color',
			[
				'label' => esc_html__( 'Color', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .team-social {{CURRENT_ITEM}}' => 'color: {{VALUE}};',
				],
			]
		);

        $repeater->add_control(
            'social_link',
            [
                'label' => esc_html__( 'Link', 'archi' ),
                'type'  => Controls_Manager::URL,
                'dynamic' => [
					'active' => true,
				],
				'placeholder' => __( 'your-link.com', 'archi' ),
				'default' => [
					'url' => 'twitter.com', 
				],
            ]
		);

		$this->add_control(
		    'social_share',
		    [
		        'label'       => esc_html__( 'Socials', 'archi' ),
		        'type'        => Controls_Manager::REPEATER,
		        'show_label'  => true,
		        'default'     => [
		            [
		             	'title'       => esc_html__( 'Facebook', 'archi' ),
		                'social_link' => esc_html__( 'https://www.facebook.com/', 'archi' ),
		                'social_icon' => [
							'value' => 'fab fa-facebook-f',
							'library' => 'fa-brand',
						],
		 
		            ],
		            [
		             	'title'       => esc_html__( 'Instagram', 'archi' ),
		                'social_link' => esc_html__( 'https://www.instagram.com/', 'archi' ),
		                'social_icon' => [
							'value' => 'fab fa-instagram',
							'library' => 'fa-brand',
						],
		 
		            ],
		            [
		             	'title'       => esc_html__( 'Linkedin', 'archi' ),
		                'social_link' => esc_html__( 'https://www.linkedin.com/', 'archi' ),
		                'social_icon' => [
							'value' => 'fab fa-linkedin-in',
							'library' => 'fa-brand',
						],

		            ]
		        ],
		        'fields'      => $repeater->get_controls(),
		        'title_field' => '{{{title}}}',
		    ]
		);

		$this->add_control(
			'link',
			[
				'label' => __( 'Link To Details', 'archi' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://', 'archi' ),
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
				'condition'	=> [
					'member_desc!' => ''
				]
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
				'condition'	=> [
					'member_desc!' => ''
				]
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
				'condition'	=> [
					'member_desc!' => ''
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'desc_typography',
				'label'    => esc_html__( 'Typography', 'archi' ),
				'selector' => '{{WRAPPER}} .ot-team__info .tdesc',
				'condition'	=> [
					'member_desc!' => ''
				]
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

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		
		$image_html = Group_Control_Image_Size::get_attachment_image_html( $settings, 'full', 'member_image' );
		$tname = $settings['member_name'];

		if ( ! empty( $settings['link']['url'] ) ) {
			$this->add_link_attributes( 'm_link', $settings['link'] );
			$tname = '<a ' .$this->get_render_attribute_string( 'm_link' ). '>' .$tname. '</a>';
		}

		$this->add_render_attribute( 'team-box', 'class', [ 'ot-team', $settings['team_type'] ] );
		?>

		<div <?php $this->print_render_attribute_string( 'team-box' ); ?>>
			<?php if( $settings['member_image']['url'] ) { ?>
			<figure class="ot-team__thumb">
				<?php echo wp_kses_post( $image_html ); ?>
			</figure>
			<?php } ?>
			<div class="ot-team__info">
				<h3 class="tname"><?php echo wp_kses_post( $tname ); ?></h3>
				<p class="tjob"><?php $this->print_unescaped_setting( 'member_extra' ) ?></p>
				<?php if ( $settings['member_desc'] ) { echo '<div class="small-border"></div><p class="tdesc">' . wp_kses_post( $settings['member_desc'] ) . '</p>'; } ?>

				<?php if ( ! empty( $settings['social_share'] ) ) : ?>
				<div class="team-social">
					<?php foreach ( $settings['social_share'] as $key => $social ) : ?>
						<?php 
							$link_key = 'link_' . $key;
							$this->add_render_attribute( $link_key, 'class', [
								strtolower( $social['title'] ),
								'elementor-repeater-item-' . $social['_id'],
							] );
							$this->add_link_attributes( $link_key, $social['social_link'] );
						?>
						<a <?php $this->print_render_attribute_string( $link_key ); ?>>
							<?php Icons_Manager::render_icon( $social['social_icon'], [ 'aria-hidden' => 'true' ] ); ?>
						</a>
					<?php endforeach; ?>
				</div>
				<?php endif; ?>
			</div>
		</div>
	        
	    <?php
	}

}
// After the Archi_Team class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register( new Archi_Team() );