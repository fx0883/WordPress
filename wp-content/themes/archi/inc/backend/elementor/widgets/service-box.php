<?php
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Service Box
 */
class Archi_Service_Box extends Widget_Base{

 	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'ot-service-box';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'OT Service Box', 'archi' );
	}

	// The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
	public function get_icon() {
		return 'eicon-image-box';
	}

	// The get_categories method, lets you set the category of the widget, return the category name as a string.
	public function get_categories() {
		return [ 'category_archi' ];
	}

	protected function register_controls() {

		//Content Image box
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Image Box', 'archi' ),
			]
		);
		
		$this->add_control(
	       'image_box',
	        [
	           'label' => esc_html__( 'Image Box', 'archi' ),
	           'type'  => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
			  	],
		    ]
	    );

		$this->add_control(
			'title',
			[
				'label' => __( 'Title', 'archi' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( 'Marketing Research', 'archi' ),
			]
		);
		$this->add_control(
			'header_size',
			[
				'label' => __( 'Title HTML Tag', 'archi' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
					'div' => 'div',
					'span' => 'span',
					'p' => 'p',
				],
				'default' => 'h3',
			]
		);

		$this->add_control(
			'description_text',
			[
				'label' => __( 'Description', 'archi' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( 'Analysis of the market as a whole and its particular components (competitors, consumers, product, etc.)', 'archi' ),
			]
		);

		$this->add_control(
			'link',
			[
				'label' => __( 'Link', 'archi' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'archi' ),
				'default' => [
					'url' => '#'
				],
			]
		);
		$this->add_control(
			'label_link',
			[
				'label' => __( 'Label Button', 'archi' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Read More', 'archi' ),
				'condition' => [
					'link[url]!' => '',
				],
			]
		);

		$this->end_controls_section();

		/***Style***/

		$this->start_controls_section(
			'style_content_section',
			[
				'label' => __( 'Content', 'archi' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		/* gereral */
		$this->add_control(
			'heading_gereral',
			[
				'label' => __( 'Gereral', 'archi' ),
				'type' => Controls_Manager::HEADING,
			]
		);
		$this->add_responsive_control(
			'align',
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
					'{{WRAPPER}} .ot-service-box__content' => 'text-align: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'box_bg',
			[
				'label' => __( 'Background', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ot-service-box__content' => 'background: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'box_padding',
			[
				'label' => __( 'Padding', 'archi' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ot-service-box__content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'content_reverse',
			[
				'label'   => esc_html__( 'Content Reverse', 'archi' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => '',
				'selectors_dictionary' => [
					'yes' => 'display: flex; flex-direction: column-reverse',
				],
				'selectors' => [
					'{{WRAPPER}} .ot-service-box' => '{{VALUE}}',
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
		$this->add_responsive_control(
			'title_space',
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
					'{{WRAPPER}} .ot-service-box__title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => __( 'Color', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ot-service-box__title,
					 {{WRAPPER}} .ot-service-box__title a' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'title_hcolor',
			[
				'label' => __( 'Hover', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ot-service-box__title a:hover' => 'color: {{VALUE}};',
				],
				'condition' => [
					'link[url]!' => '',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .ot-service-box__title',
			]
		);

		/* description */
		$this->add_control(
			'heading_des',
			[
				'label' => __( 'Description', 'archi' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'desc_space',
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
					'{{WRAPPER}} .octf-btn' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'des_color',
			[
				'label' => __( 'Color', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ot-service-box__desc' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'des_typography',
				'selector' => '{{WRAPPER}} .ot-service-box__desc',
			]
		);

		/* button */
		$this->add_control(
			'heading_btn',
			[
				'label' => __( 'Button', 'archi' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'label_link!' => '',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'btn_typography',
				'selector' => '{{WRAPPER}} .octf-btn',
				'condition' => [
					'label_link!' => '',
				],
			]
		);
		$this->add_responsive_control(
			'border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'archi' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .octf-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'label_link!' => '',
				],
			]
		);
		$this->start_controls_tabs( 'tabs_btn_style' );
		$this->start_controls_tab(
			'tab_btn_normal',
			[
				'label' => __( 'Normal', 'archi' ),
				'condition' => [
					'label_link!' => '',
				],
			]
		);
		$this->add_control(
			'btn_opacity',
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
					'{{WRAPPER}} .octf-btn' => 'opacity: {{SIZE}};',
				],
			]
		);
		$this->add_control(
			'btn_color',
			[
				'label' => __( 'Color', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .octf-btn' => 'color: {{VALUE}};',
				],
				'condition' => [
					'label_link!' => '',
				],
			]
		);

		$this->add_control(
			'btn_bg_color',
			[
				'label' => __( 'Background Color', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .octf-btn' => 'background: {{VALUE}};',
				],
				'condition' => [
					'label_link!' => '',
				],
			]
		);
		
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_btn_hover',
			[
				'label' => __( 'Hover', 'archi' ),
				'condition' => [
					'label_link!' => '',
				],
			]
		);
		$this->add_control(
			'btn_hover_opacity',
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
					'{{WRAPPER}} .octf-btn:hover' => 'opacity: {{SIZE}};',
				],
			]
		);
		$this->add_control(
			'hover_btn_color',
			[
				'label' => __( 'Color', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .octf-btn:hover, {{WRAPPER}} .octf-btn:focus' => 'color: {{VALUE}};',
				],
				'condition' => [
					'label_link!' => '',
				],
			]
		);
		$this->add_control(
			'hover_btn_bg_color',
			[
				'label' => __( 'Background Color', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .octf-btn:hover, {{WRAPPER}} .octf-btn:focus' => 'background: {{VALUE}};',
				],
				'condition' => [
					'label_link!' => '',
				],
			]
		);
		
		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'heading', 'class', 'ot-service-box__title' );
		$this->add_render_attribute( 'description_text', 'class', 'ot-service-box__desc' );
		$this->add_inline_editing_attributes( 'description_text' );
		$title = $settings['title'];
		$title_html = sprintf( '<%1$s %2$s>%3$s</%1$s>', $settings['header_size'], $this->get_render_attribute_string( 'heading' ), $title );
		$image_html = Group_Control_Image_Size::get_attachment_image_html( $settings, 'full', 'image_box' );

		if ( ! empty( $settings['link']['url'] ) ) {
			$this->add_link_attributes( 'button', $settings['link'] );

			$image_html = '<a ' .$this->get_render_attribute_string( 'button' ). '>' .$image_html. '</a>';
			$title_html = sprintf( '<%1$s %2$s><a %3$s>%4$s</a></%1$s>', $settings['header_size'], $this->get_render_attribute_string( 'heading' ), $this->get_render_attribute_string( 'button' ), $title );
		}
		$this->add_render_attribute( 'button', 'class', 'octf-btn' );

		?>

		<div class="ot-service-box">
			<?php if( !empty( $settings['image_box']['url'] ) ){ echo $image_html; } ?>
			<div class="ot-service-box__content">
				<?php if( ! Utils::is_empty( $settings['title'] ) ) { echo $title_html; } ?>
				<?php if ( ! Utils::is_empty( $settings['description_text'] ) ) : ?>
					<p <?php $this->print_render_attribute_string( 'description_text' ); ?>>
						<?php $this->print_unescaped_setting( 'description_text' ); ?>
					</p>
				<?php endif; ?>

				<?php if ( ! Utils::is_empty( $settings['label_link'] ) ) : ?>
					<a <?php $this->print_render_attribute_string( 'button' ); ?>>
						<?php $this->print_unescaped_setting( 'label_link' ); ?>
					</a>
				<?php endif; ?>
			</div>
			
	    </div>

	    <?php
	}

}
// After the Archi_Service_Box class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register( new Archi_Service_Box() );