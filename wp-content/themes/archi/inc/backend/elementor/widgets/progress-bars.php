<?php
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Section Progress Bars 
 */
class Archi_Progress_Bars extends Widget_Base{

 	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'ot-progress-bars';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'OT Progress Bars', 'archi' );
	}

	// The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
	public function get_icon() {
		return 'eicon-skill-bar';
	}

	// The get_categories method, lets you set the category of the widget, return the category name as a string.
	public function get_categories() {
		return [ 'category_archi' ];
	}

	protected function register_controls() {

		//Content Progress Bars
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content', 'archi' ),
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'title',
			[
				'label'   => __( 'Title', 'archi' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Advertising', 'archi' ),
			]
		);

		$repeater->add_control(
			'percent',
			[
				'label' => esc_html__( 'Percentage', 'archi' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 80,
					'unit' => '%',
				],
			]
		);

		$repeater->add_control(
			'desc_text',
			[
				'label'   => esc_html__( 'Description', 'archi' ),
				'type' => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter your description', 'archi' ),
				'description' => esc_html__( 'Only use show for Circle style', 'archi' ),
			]
		);

		$repeater->add_control(
			'item_progress_primary_color',
			[
				'label' => esc_html__( 'Color', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .ot-progress__bar' => 'background: {{VALUE}};',
				],
			]
		);

		$repeater->add_control(
			'item_progress_secondary_color',
			[
				'label' => esc_html__( 'Background Color', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .ot-progress-inner' => 'background: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'ot_progress',
			[
				'label' => __( 'Progress Items', 'archi' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'title' => __( 'Development', 'archi' ),
						'percent' => __( '80', 'archi' ),
					]
				],
				'title_field' => '{{{ title }}}',
			]
		);

		$this->add_control(
			'title_html_tag',
			[
				'label' => esc_html__( 'Title HTML Tag', 'archi' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
					'div' => 'div',
				],
				'default' => 'h5',
			]
		);

		$this->end_controls_section();

		// Style
		$this->start_controls_section(
			'bar_style_section',
			[
				'label' => __( 'Progress Bar', 'archi' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'progress_space',
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
					'{{WRAPPER}} .ot-progress li:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'bar_height_line',
			[
				'label' => __( 'Height', 'archi' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 5,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ot-progress-inner' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'bar_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'archi' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .ot-progress-inner,
					 {{WRAPPER}} .ot-progress__bar' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'progress_primary_color',
			[
				'label' => esc_html__( 'Color', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ot-progress__bar' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'progress_secondary_color',
			[
				'label' => esc_html__( 'Background Color', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ot-progress-inner' => 'background: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'style_text_section',
			[
				'label' => __( 'Text', 'archi' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		//Title
		$this->add_control(
			'heading_title',
			[
				'label' => __( 'Title', 'archi' ),
				'type' => Controls_Manager::HEADING,
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
					'{{WRAPPER}} .ot-progress__title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'title_color',
			[
				'label' => __( 'Color', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ot-progress__title' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .ot-progress__title',
			]
		);

		//Percentage
		$this->add_control(
			'heading_percent',
			[
				'label' => __( 'Percentage', 'archi' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		
		$this->add_control(
			'per_color',
			[
				'label' => __( 'Color', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ot-progress__value' => 'color: {{VALUE}}!important;',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'per_typography',
				'selector' => '{{WRAPPER}} .ot-progress__value',
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display(); 

		$this->add_render_attribute( 'progressbar-title', 'class', 'ot-progress__title' );

		?>

		<?php if( !empty( $settings['ot_progress'] ) ) : ?>

			<ul class="ot-progress">
				<?php foreach ( $settings['ot_progress'] as $index => $item ) { 

					$progress_percentage = is_numeric( $item['percent']['size'] ) ? $item['percent']['size'] : '0';
					if ( 100 < $progress_percentage ) {
						$progress_percentage = 100;
					}
					
					$progress_percent_setting_key = $this->get_repeater_setting_key( 'title', 'ot_progress', $index );
					$this->add_render_attribute( $progress_percent_setting_key, [
						'class' => [ 'ot-progress__bar' ],
						'data-value' => $progress_percentage,
					] );

					$item_key = $index + 1;
					$this->add_render_attribute( $item_key, 'class', 'elementor-repeater-item-' . $item['_id'] );
				?>

				<li <?php $this->print_render_attribute_string( $item_key ); ?>>

					<?php if( !empty($item['title']) ) : ?>
					<<?php Utils::print_validated_html_tag( $settings['title_html_tag'] ); ?> <?php $this->print_render_attribute_string( 'progressbar-title' ); ?>>
					<?php $this->print_unescaped_setting( 'title', 'ot_progress', $index );?>
					</<?php Utils::print_validated_html_tag( $settings['title_html_tag'] ); ?>>
					<?php endif; ?>

					<div class="ot-progress-inner">
						<div class="ot-progress__value"><?php echo $progress_percentage; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>%</span></div>
						<div <?php $this->print_render_attribute_string( $progress_percent_setting_key ); ?>></div>
					</div>
				</li>
				
				<?php } ?>
			</ul>
		<?php endif; ?>
		
	    <?php 
	}

}
// After the Archi_Progress_Bars class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register( new Archi_Progress_Bars() );