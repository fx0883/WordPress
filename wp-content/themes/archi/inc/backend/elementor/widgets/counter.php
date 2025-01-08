<?php
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Counter
 */
class Archi_Counter extends Widget_Base{

 	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'ot-counter';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'OT Counter', 'archi' );
	}

	// The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
	public function get_icon() {
		return 'eicon-counter';
	}

	// The get_categories method, lets you set the category of the widget, return the category name as a string.
	public function get_categories() {
		return [ 'category_archi' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Counter', 'archi' ),
			]
		);

		$this->add_control(
			'icon_font',
			[
				'label' => __( 'Icon', 'archi' ),
				'type' => Controls_Manager::ICONS,
				'label_block' => true,
				'fa4compatibility' => 'icon',
				'default' => [
					'value' => 'fas fa-star',
					'library' => 'fa-solid',
				],
			]
		);

		$this->add_control(
			'title',
			[
				'label' => __( 'Title:', 'archi' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Downloads', 'archi' ),
			]
		);
		$this->add_control(
			'before_number',
			[
				'label' => __( 'Before Number:', 'archi' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '', 'archi' ),
			]
		);
		$this->add_control(
			'number_counter',
			[
				'label' => __( 'Number:', 'archi' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '7518', 'archi' ),
			]
		);
		$this->add_control(
			'after_number',
			[
				'label' => __( 'After Number:', 'archi' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '', 'archi' ),
			]
		);	

		$this->add_control(
			'time',
			[
				'label' => __( 'Duration', 'archi' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min'  => 1000,
						'max'  => 10000,
						'step' => 1000,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 2000,
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
				'selectors' => [
					'{{WRAPPER}} .ot-counter-wrapper' => 'text-align: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();

		//Style

		$this->start_controls_section(
			'style_content_section',
			[
				'label' => __( 'Style', 'archi' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		//Number
		$this->add_control(
			'heading_number',
			[
				'label' => __( 'Number', 'archi' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'number_space',
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
					'{{WRAPPER}} .ot-counter__number-wrapper' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'number_color',
			[
				'label' => __( 'Color', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ot-counter__number-wrapper' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'number_typography',
				'selector' => '{{WRAPPER}} .ot-counter__number-wrapper',
			]
		);

		//Title
		$this->add_control(
			'heading_title',
			[
				'label' => __( 'Title', 'archi' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'title!' => ''
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
					'{{WRAPPER}} .ot-counter__title' => 'color: {{VALUE}};',
				],
				'condition' => [
					'title!' => ''
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .ot-counter__title',
				'condition' => [
					'title!' => ''
				]
			]
		);

		//Icon
		$this->add_control(
			'heading_icon',
			[
				'label' => __( 'Icon', 'archi' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'icon_font[value]',
							'operator' => '!=',
							'value' => '',
						],
					],
				],
			]
		);

		$this->add_responsive_control(
			'icon_space',
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
					'{{WRAPPER}} .ot-counter__icon' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'icon_font[value]',
							'operator' => '!=',
							'value' => '',
						],
					],
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
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ot-counter__icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'icon_font[value]',
							'operator' => '!=',
							'value' => '',
						],
					],
				],
			]
		);

		
		$this->add_control(
			'icon_color',
			[
				'label' => __( 'Color', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ot-counter__icon' => 'color: {{VALUE}};',
				],
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'icon_font[value]',
							'operator' => '!=',
							'value' => '',
						],
					],
				],
			]
		);
		
		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$has_icon = false;
		$has_icon = ! empty( $settings['icon'] );
		if ( ! $has_icon && ! empty( $settings['icon_font']['value'] ) ) {
			$has_icon = true;
		}
		$this->add_render_attribute( 'icon_wrapper', 'class', 'ot-counter__icon' );
		
		?>
		<div class="ot-counter-wrapper" data-counter="<?php echo esc_attr($settings['number_counter']); ?>">

			<?php if ( $has_icon ) : ?>
			<div <?php $this->print_render_attribute_string( 'icon_wrapper' ); ?>>
				<?php Icons_Manager::render_icon( $settings['icon_font'], [ 'aria-hidden' => 'true' ] ); ?>
	        </div>
	        <?php endif; ?>
			<div class="ot-counter__content">
				<div class="ot-counter__number-wrapper">
	        		<span class="ot-counter__num-prefix"><?php echo $settings['before_number']; ?></span>
	        		<span class="ot-counter__num" data-to="<?php echo $settings['number_counter']; ?>" data-time= "<?php echo $settings['time']['size']; ?>"></span>
	        		<span class="ot-counter__num-suffix"><?php echo $settings['after_number']; ?></span>
	        	</div>
				<p class="ot-counter__title"><?php $this->print_unescaped_setting( 'title' ); ?></p>
			</div>

		</div>
	    <?php
	}

}
// After the Archi_Counter class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register( new Archi_Counter() );