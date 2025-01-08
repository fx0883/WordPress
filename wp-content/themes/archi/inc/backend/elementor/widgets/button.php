<?php
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Button
 */
class Archi_Button extends Widget_Base{

 	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'ot-btn';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'OT Button', 'archi' );
	}

	// The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
	public function get_icon() {
		return 'eicon-button';
	}

	// The get_categories method, lets you set the category of the widget, return the category name as a string.
	public function get_categories() {
		return [ 'category_archi' ];
	}

	/**
	 * Get button sizes.
	 *
	 * Retrieve an array of button sizes for the button widget.
	 *
	 * @since 1.0.0
	 * @access public
	 * @static
	 *
	 * @return array An array containing button sizes.
	 */

	protected function register_controls() {

		//Content
		$this->start_controls_section(
			'button_section',
			[
				'label' => __( 'Button', 'archi' ),
			]
        );

        $this->add_control(
			'text',
			[
				'label' => __( 'Label', 'archi' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( 'Click here', 'archi' ),
			]
		);

		$this->add_control(
			'link',
			[
				'label' => __( 'Link', 'archi' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'archi' ),
				'default' => [
					'url' => '#',
				],
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
					],
				],
				'prefix_class' => 'elementor%s-align-',
				'default' => '',
			]
		);

		$this->add_control(
			'selected_icon',
			[
				'label' => esc_html__( 'Icon', 'archi' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'skin' => 'inline',
				'label_block' => false,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'size',
			[
				'label' => esc_html__( 'Size', 'archi' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
				'range' => [
					'px' => [
						'min' => 6,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .octf-btn i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .octf-btn svg' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [ 
					'selected_icon[value]!' => '' 
				],
			]
		);

		$this->end_controls_section();

		//Style
		$this->start_controls_section(
			'style_section',
			[
				'label' => __( 'General', 'archi' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'width',
			[
				'label' => __( 'Width', 'archi' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'vw' ],
				'range' => [
					'%' => [
						'min' => 1,
						'max' => 100,
					],
					'px' => [
						'min' => 1,
						'max' => 1000,
					],
					'vw' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .octf-btn' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_responsive_control(
			'btn_padding',
			[
				'label' => __( 'Padding', 'archi' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .octf-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'button_radius',
			[
				'label' => __( 'Border Radius', 'archi' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .octf-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
        
		//Hover
		$this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label' => __( 'Normal', 'archi' ),
			]
		);

		$this->add_control(
			'icon_indent',
			[
				'label' => esc_html__( 'Icon Spacing', 'archi' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .octf-btn i,
					 {{WRAPPER}} .octf-btn svg' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
				'condition' => [ 
					'selected_icon[value]!' => '' 
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
			'button_icon_color',
			[
				'label' => __( 'Icon Color', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .octf-btn i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .octf-btn svg' => 'fill: {{VALUE}};',
				],
				'condition' => [ 
					'selected_icon[value]!' => '' 
				],
			]
		);

		$this->add_control(
			'button_text_color',
			[
				'label' => __( 'Text Color', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .octf-btn' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'	=> 'btn_bg',
				'label' => __( 'Background', 'archi' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .octf-btn',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'button_border',
				'selector' => '{{WRAPPER}} .octf-btn',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'btn_box_shadow',
				'selector' => '{{WRAPPER}} .octf-btn',
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
			'icon_hover_indent',
			[
				'label' => esc_html__( 'Icon Spacing', 'archi' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .octf-btn:hover i,
					 {{WRAPPER}} .octf-btn:hover svg' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
				'condition' => [ 
					'selected_icon[value]!' => '' 
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
			'button_icon_hover_color',
			[
				'label' => __( 'Icon Color', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .octf-btn:hover i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .octf-btn:hover svg' => 'fill: {{VALUE}};',
				],
				'condition' => [ 
					'selected_icon[value]!' => '' 
				],
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

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'	=> 'button_background_hover_color',
				'label' => __( 'Background', 'archi' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .octf-btn:hover, {{WRAPPER}} .octf-btn:focus',
			]
        );
        $this->add_control(
			'border_hover_color',
			[
				'label' => __( 'Border Color', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .octf-btn:hover, {{WRAPPER}} .octf-btn:focus' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'btn_box_shadow_hover',
				'selector' => '{{WRAPPER}} .octf-btn:hover',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

	}

	protected function render() {

		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'button-wrapper', 'class', 'ot-button-wrapper' );

		if ( ! empty( $settings['link']['url'] ) ) {
			$this->add_link_attributes( 'button', $settings['link'] );
		}
		$this->add_render_attribute( 'button', 'class', 'octf-btn' );

		$has_icon = ! empty( $settings['icon'] );
		if ( ! $has_icon && ! empty( $settings['selected_icon']['value'] ) ) {
			$has_icon = true;
		}
		if ( $has_icon ) {
			$this->add_render_attribute( 'button', 'class', 'with-icon' );
		}

		$migrated = isset( $settings['__fa4_migrated']['selected_icon'] );
		$is_new = empty( $settings['icon'] ) && Icons_Manager::is_migration_allowed();

		?>
		<div <?php echo $this->get_render_attribute_string( 'button-wrapper' ); ?>>
			<a <?php echo $this->get_render_attribute_string( 'button' ); ?>>
				<?php $this->print_unescaped_setting( 'text' ); ?>
				<?php if ( ! empty( $settings['icon'] ) || ! empty( $settings['selected_icon']['value'] ) ) : ?>
					<?php if ( $is_new || $migrated ) :
						Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true' ] );
					else : ?>
						<i class="<?php echo esc_attr( $settings['icon'] ); ?>" aria-hidden="true"></i>
					<?php endif; ?>
				<?php endif; ?>
			</a>
	    </div>
	    <?php
	}

}
// After the Archi_Button class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register( new Archi_Button() );