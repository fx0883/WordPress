<?php
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Video Popup
 */
class Archi_Video_Popup extends Widget_Base{

 	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'ot-video-popup';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'OT Video Popup', 'archi' ); }

	// The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
	public function get_icon() {
		return 'eicon-youtube';
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
				'label' => __( 'Button', 'archi' ),
			]
		);

		$this->add_control(
	       'video_image',
	        [
	            'label' => esc_html__( 'Image', 'archi' ),
	            'type'  => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
			  	],
		    ]
	    );

		$this->add_control(
			'vlink',
			[
				'label' => __( 'Video Link', 'archi' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'https://your-link.com', 'archi' ),
			]
		);

		$this->add_control(
			'is_scale',
			[
				'label'   => esc_html__( 'Hover Scale', 'archi' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		$this->add_control(
			'is_effect',
			[
				'label'   => esc_html__( 'Button Effect', 'archi' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->end_controls_section();

		//Style
		$this->start_controls_section(
			'style_section',
			[
				'label' => __( 'Button', 'archi' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		//Button
		$this->add_responsive_control(
			'btn_width',
			[
				'label' => __( 'Width', 'archi' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .octf-btn-play' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .octf-btn-play' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'btn_bg_color',
			[
				'label' => __( 'Background', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .octf-btn-play,
					 {{WRAPPER}} .octf-btn-play:before' => 'background: {{VALUE}};',
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
					'{{WRAPPER}} .ot-video-popup__image, 
					 {{WRAPPER}} img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
        );

		$this->end_controls_section();

	}

	protected function render() {

		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'button-wrap', 'class', 'ot-video-popup' );
		$this->add_render_attribute( 'button', 'class', 'octf-btn octf-btn-play' );
		if ( 'yes' !== $settings['is_scale'] ) {
			$this->add_render_attribute( 'button-wrap', 'class', 'no-scale' );
		}
		if ( 'yes' !== $settings['is_effect'] ) {
			$this->add_render_attribute( 'button', 'class', 'no-effect' );
		}

		?>
		<div <?php echo $this->get_render_attribute_string( 'button-wrap' ); ?>>
			<?php if( !empty( $settings['video_image']['url'] ) ){ ?>
			<div class="ot-video-popup__image">
				<?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'video_image' ); ?>
			</div>
			<?php } ?>
			<div class="ot-video-popup__btn">
		        <a <?php echo $this->get_render_attribute_string( 'button' ); ?> href="<?php echo esc_url( $settings['vlink'] ); ?>">
		        	<i class="fa fa-play"></i>
		        </a>
	        </div>
	    </div>
	    <?php
	}

}
// After the Archi_Video_Popup class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register( new Archi_Video_Popup() );