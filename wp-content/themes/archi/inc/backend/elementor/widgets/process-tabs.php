<?php
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Archi Process Tab
 */
class Archi_Process_Tab extends Widget_Base{

 	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'ot-process-tabs';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'OT Process Tab', 'archi' );
	}

	// The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
	public function get_icon() {
		return 'eicon-number-field';
	}

	// The get_categories method, lets you set the category of the widget, return the category name as a string.
	public function get_categories() {
		return [ 'category_archi' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Process', 'archi' ),
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'selected_icon',
			[
				'label' => __( 'Icon', 'archi' ),
				'type' => Controls_Manager::ICONS,
				'label_block' => true,
				'default' => [],
				'fa4compatibility' => 'icon',
			]
		);

		$repeater->add_control(
			'title',
			[
				'label' => __( 'Title', 'archi' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Creating a Concept', 'archi' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'des',
			[
				'label' => 'Description',
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( 'Original design project of high quality raises profit – this is proved in practice by many of our customers. A professional approach will avoid of many common mistakes, minimize the cost of decoration materials and choose the best way to implement your ideas or direct your "runaway" thoughts to one course, forming an integral representation of the idea.', 'archi' ),
			]
		);
		$this->add_control(
			'ot_process',
			[
				'label' => __( 'Process Items', 'archi' ),
				'type' => Controls_Manager::REPEATER,
				'show_label'  => true,
				'prevent_empty' => false,
				'default' => [
					[
						'title' => __( 'Creating a Concept', 'archi' ),
						'tab_content' => __( 'Original design project of high quality raises profit – this is proved in practice by many of our customers. A professional approach will avoid of many common mistakes, minimize the cost of decoration materials and choose the best way to implement your ideas or direct your "runaway" thoughts to one course, forming an integral representation of the idea.', 'archi' ),
					],
					[
						'title' => __( 'Budget Planning', 'archi' ),
						'tab_content' => __( 'Original design project of high quality raises profit – this is proved in practice by many of our customers. A professional approach will avoid of many common mistakes, minimize the cost of decoration materials and choose the best way to implement your ideas or direct your "runaway" thoughts to one course, forming an integral representation of the idea.', 'archi' ),
					],
				],
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{title}}}',
			]
		);
		
		$this->end_controls_section();

		//Style

		$this->start_controls_section(
			'style_content_section',
			[
				'label' => __( 'Content', 'archi' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		//Title
		$this->add_control(
			'heading_title',
			[
				'label' => __( 'Title', 'archi' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'title_size',
			[
				'label' => __( 'Size', 'archi' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 50,
						'max' => 1000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ot-process__title' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; line-height: calc({{SIZE}}{{UNIT}} - 60px)',
				],
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
					'{{WRAPPER}} .ot-process__nav' => 'column-gap: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'border_width',
			[
				'label' => esc_html__( 'Border Width', 'archi' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'max' => 20,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ot-process__title' => 'border-width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'title_border_radius',
			[
				'label' => __( 'Border Radius', 'archi' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ot-process__title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .ot-process__title',
			]
		);

		$this->start_controls_tabs( 'title_process_style' );

		$this->start_controls_tab(
			'title_normal',
			[
				'label' => __( 'Normal', 'archi' ),
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Text Color', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ot-process__title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'bg_title_color',
			[
				'label' => __( 'Background Color', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ot-process__title' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'title_hover',
			[
				'label' => __( 'Hover', 'archi' ),
			]
		);

		$this->add_control(
			'title_hcolor',
			[
				'label' => __( 'Text Color', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} li.current .ot-process__title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'bg_title_hcolor',
			[
				'label' => __( 'Background Color', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} li.current .ot-process__title' => 'background-color: {{VALUE}};',
				],
			]
		);
        $this->add_control(
			'border_hover_color',
			[
				'label' => __( 'Border Color', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} li.current .ot-process__title,
					 {{WRAPPER}} .ot-process__nav' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} li:after' => 'background: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		/* Icon */
		$this->add_control(
			'style_icon',
			[
				'label' => __( 'Icon', 'archi' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'icon_spacing',
			[
				'label' => __( 'Spacing', 'archi' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ot-process__title i,
					 {{WRAPPER}} .ot-process__title svg' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label' => __( 'Size', 'archi' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 6,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ot-process__title i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .ot-process__title svg' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		//Description
		$this->add_control(
			'heading_des',
			[
				'label' => __( 'Description', 'archi' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
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
				'selectors' => [
					'{{WRAPPER}} .process-des-item' => 'text-align: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'des_spacing',
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
					'{{WRAPPER}} .ot-process__des' => 'padding-top: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .process-des-item' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'des_typography',
				'selector' => '{{WRAPPER}} .process-des-item',
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		if ( empty( $settings['ot_process'] ) ) {
			return;
		}

		?>
		<div class="ot-process">
			<ul class="ot-process__nav <?php if( is_rtl() ) echo esc_attr('flex-row-reverse'); ?> unstyle">
				<?php foreach ( $settings['ot_process'] as $index => $tabs ) { 
					$migration_allowed = Icons_Manager::is_migration_allowed();
				?>
				<li>
					
					<div class="ot-process__title">
						<?php 
							$migrated = isset( $tabs['__fa4_migrated']['selected_icon'] );
							$is_new = ! isset( $tabs['icon'] ) && $migration_allowed;
							if ( ! empty( $tabs['icon'] ) || ( ! empty( $tabs['selected_icon']['value'] ) && $is_new ) ) { 
								if ( $is_new || $migrated ) {
									Icons_Manager::render_icon( $tabs['selected_icon'], [ 'aria-hidden' => 'true' ] );
								} else { ?>
									<i class="<?php echo esc_attr( $tabs['icon'] ); ?>" aria-hidden="true"></i>
						<?php } } ?>
						<span><?php $this->print_unescaped_setting( 'title', 'ot_process', $index );?></span>
					</div>
				</li>
				<?php } ?>
			</ul>
			<div class="ot-process__des">
				<?php foreach ( $settings['ot_process'] as $index => $tabs ) { ?>
				<div class="process-des-item"><?php $this->print_unescaped_setting( 'des', 'ot_process', $index );?></div>
				<?php } ?>
			</div>
	    </div>

	    <?php
	}

}
// After the Archi_Process_Tab class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register( new Archi_Process_Tab() );