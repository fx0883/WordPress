<?php
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Tabs
 */
class Archi_Tabs extends Widget_Base{

 	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'ot-tabs';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'OT Tabs', 'archi' );
	}

	// The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
	public function get_icon() {
		return 'eicon-tabs';
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
				'label' => __( 'Tabs', 'archi' ),
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'tab_title',
			[
				'label' => __( 'Title & Description', 'archi' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Tab Title', 'archi' ),
				'placeholder' => __( 'Tab Title', 'archi' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'tab_content',
			[
				'label' => __( 'Content', 'archi' ),
				'default' => __( 'Tab Content', 'archi' ),
				'placeholder' => __( 'Tab Content', 'archi' ),
				'type' => Controls_Manager::WYSIWYG,
				'show_label' => false,
			]
		);

		$this->add_control(
			'ot_tabs',
			[
				'label' => __( 'Tabs Items', 'archi' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'tab_title' => __( 'Tab #1', 'archi' ),
						'tab_content' => __( 'Our clients’ needs are constantly changing, so we continually seek new and better ways to serve them. To do this, we are bringing new talent into the firm, acquiring new companies.', 'archi' ),
					],
					[
						'tab_title' => __( 'Tab #2', 'archi' ),
						'tab_content' => __( 'Our clients’ needs are constantly changing, so we continually seek new and better ways to serve them. To do this, we are bringing new talent into the firm, acquiring new companies.', 'archi' ),
					],
				],
				'title_field' => '{{{ tab_title }}}',
			]
		);
		$this->add_control(
			'tabs_style',
			[
				'label' => __( 'Position', 'archi' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'horizontal' => __( 'Horizontal', 'archi' ),
					'vertical' => __( 'Vertical', 'archi' ),
				],
				'default' => 'horizontal',
			]
		);
		$this->add_control(
			'tab_heading_align',
			[
				'label' => esc_html__( 'Horizontal Alignment', 'archi' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'archi' ),
						'icon' => 'eicon-h-align-left',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'archi' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'default' => '',
				'selectors_dictionary' => [
					'left' => 'flex-direction: row',
					'right' => 'flex-direction: row-reverse',
				],
				'selectors' => [
					'{{WRAPPER}} .tabs-vertical' => '{{VALUE}}',
				],
				'condition' => [
					'tabs_style' => 'vertical'
				]
			]
		);

		$this->end_controls_section();

		/* Style */
		$this->start_controls_section(
			'style_section',
			[
				'label' => __( 'Tabs', 'archi' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		/* Title */
		$this->add_control(
			'style_title',
			[
				'label' => __( 'Title', 'archi' ),
				'type' => Controls_Manager::HEADING,
			]
		);
		$this->add_responsive_control(
			'width',
			[
				'label' => esc_html__( 'Width', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => '%',
				],
				'tablet_default' => [
					'unit' => '%',
				],
				'mobile_default' => [
					'unit' => '%',
				],
				'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
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
					'{{WRAPPER}} .ot-tabs__heading' => 'min-width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'tabs_style' => 'vertical'
				]
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
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tabs-horizontal .ot-tabs__heading' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .tabs-vertical' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'border_width',
			[
				'label' => esc_html__( 'Border Width', 'archi' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
				'default' => [],
				'range' => [
					'px' => [
						'max' => 20,
					],
					'em' => [
						'max' => 2,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ot-tabs__heading' => 'border-bottom: {{SIZE}}{{UNIT}} solid #fff;',
				],
				'condition' => [
					'tabs_style' => 'horizontal'
				]
			]
		);

		$this->add_control(
			'border_color',
			[
				'label' => esc_html__( 'Border Color', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ot-tabs__heading' => 'border-bottom-color: {{VALUE}};',
				],
				'condition' => [
					'tabs_style' => 'horizontal'
				]
			]
		);
		$this->add_responsive_control(
			'title_padding',
			[
				'label' => __( 'Padding', 'archi' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ot-tabs__link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .ot-tabs__link',
			]
		);

		$this->start_controls_tabs( 'tabs_title_style' );

		$this->start_controls_tab(
			'tab_title_normal',
			[
				'label' => __( 'Normal', 'archi' ),
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Color', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ot-tabs__link' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_control(
			'title_bgcolor',
			[
				'label' => __( 'Background', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ot-tabs__link' => 'background-color: {{VALUE}};',
				]
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_title_active',
			[
				'label' => __( 'Active/Hover', 'archi' ),
			]
		);

		$this->add_control(
			'title_color_active',
			[
				'label' => __( 'Color', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ot-tabs__item.current .ot-tabs__link, {{WRAPPER}} .ot-tabs__link:hover' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_control(
			'title_bg_active',
			[
				'label' => __( 'Background', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ot-tabs__item.current .ot-tabs__link' => 'background-color: {{VALUE}};',
				]
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		/* Content */
		$this->add_control(
			'style_content',
			[
				'label' => __( 'Content', 'archi' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		
		$this->add_control(
			'content_color',
			[
				'label' => __( 'Color', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ot-tabs__content' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'selector' => '{{WRAPPER}} .ot-tabs__content',
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		if ( empty( $settings['ot_tabs'] ) ) {
			return;
		}
		$this->add_render_attribute( 'tabs_wrapper', 'class', [ 'ot-tabs', 'tabs-'.$settings['tabs_style'] ] );
		
		?>

		<div <?php $this->print_render_attribute_string( 'tabs_wrapper' ); ?>>
			<?php $random = rand(1,1000); ?>
			<ul class="ot-tabs__heading unstyle dflex">
				<?php $i = 1; foreach ( $settings['ot_tabs'] as $index => $tabs ) :
					$migration_allowed = Icons_Manager::is_migration_allowed();
				?>
				<li class="ot-tabs__item" data-tab="tab-<?php echo esc_attr($i.$random); ?>">

					<a class="ot-tabs__link"><?php $this->print_unescaped_setting( 'tab_title', 'ot_tabs', $index );?></a>

				</li>
				<?php $i++; endforeach; ?>
			</ul>
			<div class="ot-tabs__content-wrap">
				<?php $j = 1; foreach ( $settings['ot_tabs'] as $index => $tabs ) : ?>
				<div id="tab-<?php echo esc_attr($j.$random); ?>" class="ot-tabs__content">
					<?php $this->print_unescaped_setting( 'tab_content', 'ot_tabs', $index );?>
				</div>
				<?php $j++; endforeach; ?>
			</div>
	    </div>

	    <?php
	}

}
// After the Archi_Tabs class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register( new Archi_Tabs() );