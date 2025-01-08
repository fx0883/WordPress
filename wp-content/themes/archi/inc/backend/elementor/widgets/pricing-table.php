<?php
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Pricing Table
 */
class Archi_Pricing_Table extends Widget_Base{

 	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'ot-pricing-table';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'OT Pricing Table', 'archi' );
	}

	// The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
	public function get_icon() {
		return 'eicon-price-table';
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
				'label' => __( 'Title & Price', 'archi' ),
			]
		);

		$this->add_control(
			'title',
			[
				'label' => __( 'Title', 'archi' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Digital', 'archi' ),
				'label_block' => true,
			]
		);
		
		$this->add_control(
			'currency_symbol',
			[
				'label' => __( 'Currency Symbol', 'archi' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' => __( 'None', 'archi' ),
					'dollar' => '&#36; ' . _x( 'Dollar', 'Currency', 'archi' ),
					'euro' => '&#128; ' . _x( 'Euro', 'Currency', 'archi' ),
					'baht' => '&#3647; ' . _x( 'Baht', 'Currency', 'archi' ),
					'franc' => '&#8355; ' . _x( 'Franc', 'Currency', 'archi' ),
					'guilder' => '&fnof; ' . _x( 'Guilder', 'Currency', 'archi' ),
					'krona' => 'kr ' . _x( 'Krona', 'Currency', 'archi' ),
					'lira' => '&#8356; ' . _x( 'Lira', 'Currency', 'archi' ),
					'peseta' => '&#8359 ' . _x( 'Peseta', 'Currency', 'archi' ),
					'peso' => '&#8369; ' . _x( 'Peso', 'Currency', 'archi' ),
					'pound' => '&#163; ' . _x( 'Pound Sterling', 'Currency', 'archi' ),
					'real' => 'R$ ' . _x( 'Real', 'Currency', 'archi' ),
					'ruble' => '&#8381; ' . _x( 'Ruble', 'Currency', 'archi' ),
					'rupee' => '&#8360; ' . _x( 'Rupee', 'Currency', 'archi' ),
					'indian_rupee' => '&#8377; ' . _x( 'Rupee (Indian)', 'Currency', 'archi' ),
					'shekel' => '&#8362; ' . _x( 'Shekel', 'Currency', 'archi' ),
					'yen' => '&#165; ' . _x( 'Yen/Yuan', 'Currency', 'archi' ),
					'won' => '&#8361; ' . _x( 'Won', 'Currency', 'archi' ),
					'custom' => __( 'Custom', 'archi' ),
				],
				'default' => 'dollar',
			]
		);
		$this->add_control(
			'currency_symbol_custom',
			[
				'label' => __( 'Custom Symbol', 'archi' ),
				'type' => Controls_Manager::TEXT,
				'condition' => [
					'currency_symbol' => 'custom',
				],
			]
		);

		$this->add_control(
			'price_period_1',
			[
				'label' => __( 'Price', 'archi' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '15', 'archi' ),
			]
		);
		$this->add_control(
			'period_1',
			[
				'label'       => __( 'Period', 'archi' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( '/m', 'archi' ),
			]
		);

		$this->add_control(
			'is_ribbon',
			[
				'label'   => esc_html__( 'Ribbon', 'archi' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => '',
			]
		);
		$this->add_control(
			'ribbon_text',
			[
				'label' => __( 'Ribbon Label', 'archi' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Recommend', 'archi' ),
				'condition'	=> [
					'is_ribbon'	=> 'yes'
				]
			]
		);

		$this->add_control(
			'heading_tag',
			[
				'label' => __( 'Title HTML Tag', 'archi' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
				],
				'default' => 'h2',
				'condition'	=> [
					'title!'	=> ''
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_features',
			[
				'label' => __( 'Features', 'archi' ),
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'item_features_text',
			[
				'label' => __( 'Text', 'archi' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'List Item', 'archi' ),
			]
		);

		$default_icon = [
			'value' => 'fas fa-check',
			'library' => 'fa-solid',
		];

		$repeater->add_control(
			'selected_item_icon',
			[
				'label' => __( 'Icon', 'archi' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'item_icon',
				'default' => $default_icon,
			]
		);

		$repeater->add_control(
			'item_icon_color',
			[
				'label' => __( 'Color', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} i' => 'color: {{VALUE}}',
					'{{WRAPPER}} {{CURRENT_ITEM}} svg' => 'fill: {{VALUE}}',
				],
			]
		);

		$repeater->add_control(
			'item_icon_bgcolor',
			[
				'label' => __( 'Background Color', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} li{{CURRENT_ITEM}} i, 
					 {{WRAPPER}} li{{CURRENT_ITEM}} svg' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'features_list',
			[
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'item_features_text' => __( 'List Item #1', 'archi' ),
						'selected_item_icon' => $default_icon,
					],
					[
						'item_features_text' => __( 'List Item #2', 'archi' ),
						'selected_item_icon' => $default_icon,
					],
					[
						'item_features_text' => __( 'List Item #3', 'archi' ),
						'selected_item_icon' => $default_icon,
					],
				],
				'title_field' => '{{{ item_features_text }}}',
				'prevent_empty' => false
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_footer',
			[
				'label' => __( 'Button', 'archi' ),
			]
		);

		$this->add_control(
			'button_text',
			[
				'label' => __( 'Button Text', 'archi' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Choose Plan', 'archi' ),
			]
		);

		$this->add_control(
			'btn_link',
			[
				'label' => __( 'Link', 'archi' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'archi' ),
				'default' => [
					'url' => '#',
				],
			]
		);

		$this->end_controls_section();

		//Style
		$this->start_controls_section(
			'style_table_section',
			[
				'label' => __( 'Table Box', 'archi' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_control(
			'bg_color',
			[
				'label' => __( 'Background Color', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ot-pricing-table' => 'background-color: {{VALUE}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'prices_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'archi' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ot-pricing-table' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);

		//Ribbon
		$this->add_control(
			'heading_ribbon',
			[
				'label' => __( 'Ribbon', 'archi' ),
				'type' => Controls_Manager::HEADING,
				'condition'	=>[
					'is_ribbon'	=> 'yes',
					'ribbon_text!'	=> '',
				],
				'separator' => 'before',
			]
		);
		$this->add_control(
			'ribbon_color',
			[
				'label' => __( 'Color', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ot-pricing-table__ribbon' => 'color: {{VALUE}};',
				],
				'condition'	=>[
					'is_ribbon'	=> 'yes',
					'ribbon_text!'	=> '',
				]
			]
		);
		$this->add_control(
			'ribbon_bgcolor',
			[
				'label' => __( 'Background', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ot-pricing-table__ribbon' => 'background-color: {{VALUE}};',
				],
				'condition'	=>[
					'is_ribbon'	=> 'yes',
					'ribbon_text!'	=> '',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'ribbon_typography',
				'selector' => '{{WRAPPER}} .ot-pricing-table__ribbon',
				'condition'	=>[
					'is_ribbon'	=> 'yes',
					'ribbon_text!'	=> '',
				]
			]
		);
		
		$this->end_controls_section();
		
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
				'condition'	=>[
					'title!'	=> ''
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
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ot-pricing-table__title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition'	=>[
					'title!'	=> ''
				]
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => __( 'Color', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ot-pricing-table__title' => 'color: {{VALUE}};',
				],
				'condition'	=>[
					'title!'	=> ''
				]
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .ot-pricing-table__title',
				'condition'	=>[
					'title!'	=> ''
				],
			]
		);

		//Price
		$this->add_control(
			'heading_price',
			[
				'label' => __( 'Price', 'archi' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		
		$this->add_control(
			'price_color_1',
			[
				'label' => __( 'Color 1', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ot-pricing-table__prices' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'price_color_2',
			[
				'label' => __( 'Color 2', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .price-value' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'price_color_3',
			[
				'label' => __( 'Color 3', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .price-duration' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'price_typography',
				'selector' => '{{WRAPPER}} .ot-pricing-table__prices, {{WRAPPER}} .price-value',
			]
		);
		
		//Features
		$this->add_control(
			'heading_features',
			[
				'label' => __( 'Features', 'archi' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		
		$this->add_control(
			'features_bgcolor_1',
			[
				'label' => __( 'Background 1', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .pricing-features-item:nth-child(odd)' => 'background: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'features_bgcolor_2',
			[
				'label' => __( 'Background 2', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .pricing-features-item:nth-child(even)' => 'background: {{VALUE}};',
				]
			]
		);
		
		$this->add_responsive_control(
			'ficon_size',
			[
				'label' => __( 'Icon Size', 'archi' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ot-icon-list-icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'features_icon_color',
			[
				'label' => __( 'Icon Color', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} i' => 'color: {{VALUE}};',
					'{{WRAPPER}} svg' => 'fill: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
			'features_color',
			[
				'label' => __( 'Text Color', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .pricing-features-text' => 'color: {{VALUE}};',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'features_typography',
				'selector' => '{{WRAPPER}} .pricing-features-text',
			]
		);

		$this->end_controls_section();

		//Button
		$this->start_controls_section(
			'btn_style_section',
			[
				'label' => __( 'Button', 'archi' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'button_text!' => '',
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
		$this->start_controls_tabs( 'tabs_btn_style' );

		$this->start_controls_tab(
			'tab_btn_normal',
			[
				'label' => __( 'Normal', 'archi' ),
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
			]
		);
		
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_btn_hover',
			[
				'label' => __( 'Hover', 'archi' ),
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
			]
		);
		
		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

	}

	private function get_currency_symbol( $symbol_name ) {
		$symbols = [
			'dollar' => '&#36;',
			'euro' => '&#128;',
			'franc' => '&#8355;',
			'pound' => '&#163;',
			'ruble' => '&#8381;',
			'shekel' => '&#8362;',
			'baht' => '&#3647;',
			'yen' => '&#165;',
			'won' => '&#8361;',
			'guilder' => '&fnof;',
			'peso' => '&#8369;',
			'peseta' => '&#8359',
			'lira' => '&#8356;',
			'rupee' => '&#8360;',
			'indian_rupee' => '&#8377;',
			'real' => 'R$',
			'krona' => 'kr',
		];

		return isset( $symbols[ $symbol_name ] ) ? $symbols[ $symbol_name ] : '';
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$symbol = '';

		if ( ! empty( $settings['currency_symbol'] ) ) {
			if ( 'custom' !== $settings['currency_symbol'] ) {
				$symbol = $this->get_currency_symbol( $settings['currency_symbol'] );
			} else {
				$symbol = $settings['currency_symbol_custom'];
			}
		}

		$heading_tag = $settings['heading_tag'];
		$this->add_render_attribute( 'title', 'class', 'ot-pricing-table__title' );

		if ( ! empty( $settings['btn_link']['url'] ) ) {
			$this->add_link_attributes( 'button_detail', $settings['btn_link'] );
		}
		$this->add_render_attribute( 'button_detail', 'class', 'octf-btn' );
		?>

		<div class="ot-pricing-table">
			<?php if( !empty( $settings['ribbon_text'] ) ){ ?>
				<div class="ot-pricing-table__ribbon"><?php $this->print_unescaped_setting( 'ribbon_text' ); ?></div>
			<?php } ?>
			<div class="ot-pricing-table__header">
				<?php if ( ! empty( $settings['title'] ) ) : ?>
					<<?php Utils::print_validated_html_tag( $settings['heading_tag'] );?> <?php $this->print_render_attribute_string( 'title' ); ?>>
					<?php $this->print_unescaped_setting( 'title' ); ?>
					</<?php Utils::print_validated_html_tag( $settings['heading_tag'] ); ?>>
				<?php endif; ?>

				<div class="ot-pricing-table__prices">
					<span class="price-currency"><?php echo $symbol; ?></span>
					<span class="price-value"><?php $this->print_unescaped_setting( 'price_period_1' ); ?></span>
					<span class="price-duration"><?php $this->print_unescaped_setting( 'period_1' ); ?></span>
				</div>
			</div>
			
			<?php if( !empty($settings['features_list']) ){ ?>
			<ul class="ot-pricing-table__features-list ot-icon-list-wrapper ot-view-stacked unstyle">
				<?php foreach ( $settings['features_list'] as $index => $item ) : 
					$item_key = $index + 1;
					$this->add_render_attribute( [
						$item_key => [
							'class' => [
								'pricing-features-item',
								'ot-icon-list-item',
								'elementor-repeater-item-' . $item['_id'],
							],
						],
					] );
				?>
				<li <?php $this->print_render_attribute_string( $item_key ); ?>>
					<span class="pricing-features-icon ot-icon-list-icon">
					<?php Icons_Manager::render_icon( $item['selected_item_icon'], [ 'aria-hidden' => 'true' ] ); ?>
					</span>
					<span class="pricing-features-text ot-icon-list-text"><?php $this->print_unescaped_setting( 'item_features_text', 'features_list', $index );?></span>
				</li>
				<?php endforeach ?>
			</ul>
			<?php } ?>

			<div class="ot-pricing-table__footer">
				<?php if( !empty($settings['button_text']) ){ ?><a <?php $this->print_render_attribute_string( 'button_detail' );?>><?php $this->print_unescaped_setting( 'button_text' ); ?></a><?php } ?>
			</div>
		</div>

	    <?php
	}

}
// After the Archi_Pricing_Table class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register( new Archi_Pricing_Table() );