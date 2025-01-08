<?php 
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Image Gallery
 */
class Archi_Image_Gallery extends Widget_Base{

 	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'ot-image-gallery';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'OT Image Gallery', 'archi' );
	}

	// The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
	public function get_icon() {
		return 'eicon-gallery-grid';
	}

	// The get_categories method, lets you set the category of the widget, return the category name as a string.
	public function get_categories() {
		return [ 'category_archi' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Logo', 'archi' ),
			]
		);

		$repeater = new Repeater();
		$repeater->add_control(
			'title',
			[
				'label' => __( 'Name', 'archi' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Client', 'archi' ),
			]
		);
		
		$repeater->add_control(
			'image_gallery_item',
			[
				'label' => __( 'Image', 'archi' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				]
			]
		);
		
		$repeater->add_control(
			'dowble_size',
			[
				'label' => __( 'Dowble Size', 'archi' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => __( 'Default', 'archi' ),
					'width2x' => __( 'Double Width', 'archi' ),
				],
			]
		);
		
		$this->add_control(
		    'images_gallery',
		    [
		        'label'       => '',
		        'type'        => Controls_Manager::REPEATER,
		        'show_label'  => false,
		        'default'     => [
		        	[
			        	'title'	  => __( 'Client 1', 'archi' ),
						'image_gallery_item'	  => [
							'url' 	=> Utils::get_placeholder_image_src(),
						],
					],
					[
			        	'title'	  => __( 'Client 2', 'archi' ),
						'image_gallery_item'	  => [
							'url' 	=> Utils::get_placeholder_image_src(),
						],
					],
					[
			        	'title'	  => __( 'Client 3', 'archi' ),
						'image_gallery_item'	  => [
							'url' 	=> Utils::get_placeholder_image_src(),
						],
					]
		        ],
		        'fields'      => $repeater->get_controls(),
		        'title_field' => '{{{title}}}',
		    ]
		);

		$gallery_columns = range( 1, 10 );
		$gallery_columns = array_combine( $gallery_columns, $gallery_columns );

		$this->add_control(
			'gallery_columns',
			[
				'label' => esc_html__( 'Columns', 'archi' ),
				'type' => Controls_Manager::SELECT,
				'default' => 4,
				'options' => $gallery_columns,
			]
		);

		$this->add_responsive_control(
			'w_gaps',
			[
				'label' => __( 'Gap Width', 'archi' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ot-gallery__item' => 'padding: 0 calc({{SIZE}}{{UNIT}}/2);',
					'{{WRAPPER}} .ot-gallery__item a' => 'margin-top: calc({{SIZE}}{{UNIT}})',
					'{{WRAPPER}} .ot-gallery' => 'margin-top: calc(-{{SIZE}}{{UNIT}}); margin-left: calc(-{{SIZE}}{{UNIT}}/2); margin-right: calc(-{{SIZE}}{{UNIT}}/2);',
				],
			]
		);
		$this->add_control(
			'popup_gallery',
			[
				'label' => __( 'Popup Gallery', 'archi' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'archi' ),
				'label_off' => __( 'No', 'archi' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'hover_style',
			[
				'label' => __( 'Hover Style', 'archi' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => [
					'style-1'  	=> __( 'Title Overlay', 'archi' ),
					'style-2' 	=> __( 'Hidden Title Overlay', 'archi' ),
				],
			]
		);

		$this->end_controls_section();

		//Style

		$this->start_controls_section(
			'image_style_section',
			[
				'label' => __( 'Image', 'archi' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'bg_overlay_color',
			[
				'label' => __( 'Background Overlay', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} span.bg' => 'background: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'image_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'archi' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .ot-gallery__item a,
					 {{WRAPPER}} .ot-gallery__item img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		/* Title */
		$this->add_control(
			'heading_title',
			[
				'label' => __( 'Title', 'archi' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		
		$this->add_control(
			'title_color',
			[
				'label' => __( 'Color', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .post-title' => 'color: {{VALUE}};',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .post-title',
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		if ( empty( $settings['images_gallery'] ) ) {
			return;
		}

		$this->add_render_attribute(
			'ot-gallery', [
				'class'   => [
					'ot-gallery',
					$settings['popup_gallery'] == 'yes' ? 'image-popup-gallery' : '',
					'gallery-column-' . $settings['gallery_columns']
				],
			]
		);
		
		?>
		<div <?php echo $this->get_render_attribute_string( 'ot-gallery' ); ?>>
			<div class="grid-sizer"></div>
			<?php
			foreach ( $settings['images_gallery'] as $key => $item ) {
				$title = $item['title'];
				$gallery_html= '';

				$image_html = wp_get_attachment_image( $item['image_gallery_item']['id'], 'full' );

				if ( empty( $image_html ) && isset( $item['image_gallery_item']['url'] ) ) {
					$image_html = '<img src="' . esc_attr( $item['image_gallery_item']['url'] ) . '" alt="' . esc_attr( Control_Media::get_image_alt( $item['image_gallery_item'] ) ) . '" />';
				}
				
				$this->add_render_attribute(
					'overlay-wraper' . $key, [
						'class' => [
							'overlay',
							'hover-scale',
							$settings['hover_style'] == 'style-2' ? 'reverse' : '',
						],
						'data-src' => [
							$item['image_gallery_item']['url']
						],
						'data-sub-html' => [
							Control_Media::get_image_alt( $item['image_gallery_item'] )
						]
					]
				);
				
				$this->add_render_attribute(
					'figure-item' . $key, [
						'class'   => [
							'ot-gallery__item',
							$item['dowble_size'],
						]
					]
				);

				$title = '';
				if( !empty($item['title']) ){
					$title = '<figcaption><h5 class="post-title">'.$item['title'].'</h5></figcaption>';
				}

				$gallery_html = '<figure '.$this->get_render_attribute_string('figure-item' . $key). '><a '.$this->get_render_attribute_string('overlay-wraper' . $key). '>' . $image_html . '<span class="bg"></span>'. $title . '</a></figure>';
				
            	echo wp_kses_post( $gallery_html );
			}
			?>
	    </div>
		<?php 
		
	}

}
// After the Archi_Image_Gallery class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register( new Archi_Image_Gallery() );