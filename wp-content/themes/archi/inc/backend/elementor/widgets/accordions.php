<?php
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Accordions 
 */
class Archi_Accordions extends Widget_Base{

 	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'ot-accordions';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'OT Accordions', 'archi' );
	}

	// The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
	public function get_icon() {
		return 'eicon-accordion';
	}

	// The get_categories method, lets you set the category of the widget, return the category name as a string.
	public function get_categories() {
		return [ 'category_archi' ];
	}

	protected function register_controls() {

		//Content Service box
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Accordions', 'archi' ),
			]
		);

		$this->add_control(
			'acc_type',
			[
				'label' => __( 'Type', 'archi' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'basic',
				'options' => [
					'basic' 		=> __( 'Basic', 'archi' ),
					'alway-open'    => __( 'Alway Open', 'archi' ),
				]
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'acc_title',
			[
				'label' => __( 'Title & Content', 'archi' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Accordion Title', 'archi' ),
				'placeholder' => __( 'Accordion Title', 'archi' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'acc_content',
			[
				'label' => __( 'Content', 'archi' ),
				'default' => __( 'Accordion Content', 'archi' ),
				'placeholder' => __( 'Accordion Content', 'archi' ),
				'type' => Controls_Manager::WYSIWYG,
				'show_label' => false,
			]
		);

		$this->add_control(
			'ot_accs',
			[
				'label' => __( 'Accordion Items', 'archi' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'acc_title' => __( 'Accordion #1', 'archi' ),
						'acc_content' => __( 'We reimburse all expenses of the Client for the payment of fines and penalties that were caused by mistakes made by us in accounting and tax accounting and reporting.', 'archi' ),
					],
					[
						'acc_title' => __( 'Accordion #2', 'archi' ),
						'acc_content' => __( 'We reimburse all expenses of the Client for the payment of fines and penalties that were caused by mistakes made by us in accounting and tax accounting and reporting.', 'archi' ),
					],
				],
				'title_field' => '{{{ acc_title }}}',
			]
		);
		$this->add_control(
			'default_active',
			[
				'label'   => esc_html__( 'Default Active', 'archi' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes'
			]
		);
		$this->add_control(
			'item_active',
			[
				'label' => esc_html__( 'Item Active', 'archi' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 1,
				'step' => 1,
				'default' => 1,
				'condition' => [
					'default_active' => 'yes'
				]
			]
		);
		$this->add_control(
			'icon_close',
			[
				'label' => __( 'Icon', 'archi' ),
				'type' => Controls_Manager::ICONS,
				'separator' => 'before',
				'fa4compatibility' => 'icon',
				'default' => [
					'value' => 'fas fa-plus',
					'library' => 'fa-solid',
				],
				'skin' => 'inline',
				'label_block' => false,
			]
		);
		$this->add_control(
			'icon_active',
			[
				'label' => __( 'Active Icon', 'archi' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'select_icon_active',
				'default' => [
					'value' => 'fas fa-minus',
					'library' => 'fa-solid',
				],
				'skin' => 'inline',
				'label_block' => false,
				'condition'	=> [
					'icon_close[value]!' => '',
				]
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
				],
				'default' => 'h2',
			]
		);
		
		$this->end_controls_section();

		//Style
		$this->start_controls_section(
			'style_section',
			[
				'label' => __( 'Accordions', 'archi' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'acc_padding',
			[
				'label' => __( 'Padding', 'archi' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ot-acc-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'acc_radius',
			[
				'label' => __( 'Border Radius', 'archi' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ot-acc-item:first-of-type' => 'border-top-left-radius: {{SIZE}}{{UNIT}}; border-top-right-radius: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .ot-acc-item:last-of-type' => 'border-bottom-left-radius: {{SIZE}}{{UNIT}}; border-bottom-right-radius: {{SIZE}}{{UNIT}}',
				],
			]
		);
		$this->add_control(
			'acc_bgcolor',
			[
				'label' => __( 'Background', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ot-acc-item' => 'background-color: {{VALUE}};',
				]
			]
		);
		
		$this->add_control(
			'border_color',
			[
				'label' => __( 'Border Color', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ot-acc-item' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		//Title
		$this->start_controls_section(
			'style_title',
			[
				'label' => __( 'Title', 'archi' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_responsive_control(
			'icon_size',
			[
				'label' => __( 'Icon Size', 'archi' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 5,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ot-acc-item__title svg' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .ot-acc-item__title i' => 'font-size: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .ot-acc-item:not(.current) .ot-acc-item__title' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'title_color_active',
			[
				'label' => __( 'Color Active', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ot-acc-item.current .ot-acc-item__title, 
					 {{WRAPPER}} .ot-acc-item:hover .ot-acc-item__title' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .ot-acc-item__title',
			]
		);

		$this->end_controls_section();

		//Content
		$this->start_controls_section(
			'style_content',
			[
				'label' => __( 'Content', 'archi' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'content_color',
			[
				'label' => __( 'Color', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .acc__content-inner' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'selector' => '{{WRAPPER}} .acc__content-inner',
			]
		);
		$this->add_responsive_control(
			'content_padding',
			[
				'label' => __( 'Padding', 'archi' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .acc__content-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$migrated = isset( $settings['__fa4_migrated']['icon_close'] );

		if ( ! isset( $settings['icon'] ) && ! Icons_Manager::is_migration_allowed() ) {
			// @todo: remove when deprecated
			// added as bc in 2.6
			// add old default
			$settings['icon'] = 'fa fa-angle-down';
			$settings['select_icon_active'] = 'fa fa-angle-up';
			
		}
		$is_new = empty( $settings['icon'] ) && Icons_Manager::is_migration_allowed();
		$has_icon = ( ! $is_new || ! empty( $settings['icon_close']['value'] ) );
		$this->add_render_attribute( 'wrapper', 'class', [ 'ot-accordions-wrapper', $settings['acc_type'] ] );
		$this->add_render_attribute( 'acc-item', 'class', 'ot-acc-item' );
		?>

		<div <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>
			<?php if ( $settings['ot_accs'] ) : foreach ( $settings['ot_accs'] as $key => $accs ) { 
				$tab_count = $key + 1;
				$tab_title_setting_key = $this->get_repeater_setting_key( 'tab_title', 'tabs', $key );
				$this->add_render_attribute( $tab_title_setting_key, [
					'class' => [ 'ot-acc-item__title', 'flex-middle' ],
					'data-tab' => $tab_count,
					'role' => 'tab',
					'data-default' => $key + 1 == $settings['item_active'] ? 'yes' : ''
				] );
			?>
			<div <?php echo $this->get_render_attribute_string( 'acc-item' ); ?>>
				
				<<?php Utils::print_validated_html_tag( $settings['header_size'] ); ?> <?php echo $this->get_render_attribute_string( $tab_title_setting_key ); ?> >
					<?php echo $accs['acc_title']; ?> 
					<?php if ( $has_icon ) : ?>
						<?php
						if ( $is_new || $migrated ) { ?>
							<span class="down"><?php Icons_Manager::render_icon( $settings['icon_close'] ); ?></span>
							<span class="up"><?php Icons_Manager::render_icon( $settings['icon_active'] ); ?></span>
						<?php } else { ?>
							<i class="down <?php echo esc_attr( $settings['icon'] ); ?>"></i>
							<i class="up <?php echo esc_attr( $settings['select_icon_active'] ); ?>"></i>
						<?php } ?>
					<?php endif; ?>
				</<?php Utils::print_validated_html_tag( $settings['header_size'] ); ?>>
				<div class="ot-acc-item__content">
					<div class="acc__content-inner"><?php echo $accs['acc_content']; ?></div>
				</div>
			</div>
			<?php } endif; ?>
	    </div>

	    <?php
	}

}
// After the Archi_Accordions class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register( new Archi_Accordions() );