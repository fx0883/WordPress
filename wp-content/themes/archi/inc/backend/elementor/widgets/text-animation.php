<?php
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Section Heading 
 */
class Archi_Text_Animation extends Widget_Base{

 	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'ot-text-animation';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'OT Text Animation', 'archi' );
	}

	// The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
	public function get_icon() {
		return 'eicon-animation-text';
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
				'label' => __( 'Content', 'archi' ),
			]
		);

		$this->add_control(
			'text',
			[
				'label' => __( 'Text & Text animation', 'archi' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => __( 'Archi focuses on', 'archi' ),
				'placeholder' => __( 'Enter your text', 'archi' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'text_typer',
			[
				'label' => '',
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Create, Build, Development', 'archi' ),
				'placeholder' => __( 'Enter your text animation', 'archi' ),
				'show_label' => false,
				'label_block' => true,
			]
		);

		$this->add_control(
			'heading_size',
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
					'{{WRAPPER}}' => 'text-align: {{VALUE}};',
				],
				'default' => '',
			]
		);

		$this->end_controls_section();

		//Style
		$this->start_controls_section(
			'style_section',
			[
				'label' => __( 'Heading', 'archi' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		//Subtitle
		$this->add_control(
			'heading_text',
			[
				'label' => __( 'Content', 'archi' ),
				'type' => Controls_Manager::HEADING,
			]
		);
		
		$this->add_control(
			'content_color',
			[
				'label' => __( 'Color', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .typed-wrap' => 'color: {{VALUE}};',
				]
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'selector' => '{{WRAPPER}} .typed-wrap',
			]
		);

		//Animation
		$this->add_control(
			'heading_typer',
			[
				'label' => __( 'Text Animation', 'archi' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'text_typer_color',
			[
				'label' => __( 'Animation Color', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .typed-wrap span' => 'color: {{VALUE}};',
				]
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
			'typed_speed',
			[
				'label' => esc_html__( 'Typed Speed', 'archi' ),
				'type' => Controls_Manager::NUMBER,
				'description' => esc_html__( 'Min: 100ms (millisecond)', 'archi' ),
				'default' => 100,
				'min' => 100,
				'step' => 50,
			]
		);
		$this->add_control(
			'back_delay',
			[
				'label' => esc_html__( 'Back Delay', 'archi' ),
				'type' => Controls_Manager::NUMBER,
				'description' => esc_html__( 'Min: 100ms (millisecond)', 'archi' ),
				'default' => 1500,
				'min' => 100,
				'step' => 50,
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( [
			'typed-wrapper' => [
				'class' => 'typed-wrap',
				'data-speed' => $settings['typed_speed'],
				'data-delay' => $settings['back_delay'],
				'data-loop' => 'yes' === $settings['loop'] ? 'true' : 'false',
			],
		] );

		$typer_text = explode( ',', $settings['text_typer'] );
		?>

		<<?php Utils::print_validated_html_tag( $settings['heading_size'] ); ?> <?php $this->print_render_attribute_string( 'typed-wrapper' ); ?>>
		    <?php $this->print_unescaped_setting( 'text' ); ?>
		    <div class="typed-strings">
				<?php foreach($typer_text as $value){ ?>
					<p><?php echo esc_html($value); ?></p>
				<?php } ?>
		    </div>
		    <span class="typed"></span>
		</<?php Utils::print_validated_html_tag( $settings['heading_size'] ); ?>>
	    <?php
	}

}
// After the Archi_Text_Animation class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register( new Archi_Text_Animation() );