<?php
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Button Popup
 */
class Archi_Button_Popup extends Widget_Base {

	/**
	 * Get Elementor Page List
	 *
	 * Returns an array of Elementor templates
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return $options array Elementor Templates
	 */

	public function select_param_list_pages() {

		$pagelist = get_posts(
			array(
				'post_type' => 'elementor_library',
				'showposts' => 999,
			)
		);

		if ( ! empty( $pagelist ) && ! is_wp_error( $pagelist ) ) {

			foreach ( $pagelist as $post ) {
				$options[ $post->post_title ] = $post->post_title;
			}

			update_option( 'temp_count', $options );

			return $options;
		}
	}


	/**
	 * Get ID By Title
	 *
	 * Get Elementor Template ID by title
	 *
	 * @since 3.6.0
	 * @access public
	 *
	 * @param string $title template title.
	 *
	 * @return string $template_id template ID.
	 */

	public function get_id_by_title( $title ) {
		$query = new \WP_Query( 
			array(
		        'post_type'              => 'elementor_library',
		        'title'                  => $title,
		        'posts_per_page'         => 1,
		    )
		);
		if ( ! empty( $query->post ) ) {
		    $template = $query->post;
		    $template_id = $template->ID;
		} else {
		    $template_id = $title;
		}
		return $template_id;
	}

	/**
	 * Get Elementor Template HTML Content
	 *
	 * @since 3.6.0
	 * @access public
	 *
	 * @param string $title Template Title.
	 *
	 * @return $template_content string HTML Markup of the selected template.
	 */

	public function get_template_content( $title ) {

		$frontend = \Elementor\Plugin::$instance->frontend;

		$id = $this->get_id_by_title( $title );

		// $id = apply_filters( 'wpml_object_id', $id, 'elementor_library', true );
		$template_content = $frontend->get_builder_content_for_display( $id, true );

		return $template_content;

	}

	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'ot-btn-popup';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'OT Button Popup', 'archi' );
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
	 * Register Multi Scroll controls.
	 */
	protected function register_controls() { 

		$this->start_controls_section(
			'content_templates',
			[
				'label' => __( 'Content', 'archi' ),
			]
		);

		
		$this->add_control(
			'content_popup',
			[
				'label'       => __( 'Select Template is Content Popup', 'archi' ),
				'type'        => Controls_Manager::SELECT2,
				'options'     => $this->select_param_list_pages(),
				'multiple'    => false,
				'label_block' => true,
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

		$this->add_control(
			'button_icon_color',
			[
				'label' => __( 'Color', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .octf-btn-popup-down:before,
					 {{WRAPPER}} .octf-btn-popup-up:before' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_bg_color',
			[
				'label' => __( 'Background', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .octf-btn-popup-up' => 'border-bottom-color: {{VALUE}}',
					'{{WRAPPER}} .octf-btn-popup-down' => 'border-top-color: {{VALUE}}'
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render() {

		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'button-wrapper', 'class', 'ot-button-wrapper' );

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

		<div class="ot-btn-popup">
			<div class="hide-content">
				<?php
					$template = $settings['content_popup'];
					echo $this->get_template_content( $template );
				?>
			</div>
			<div class="octf-btn-popup-down"></div>
            <div class="octf-btn-popup-up"></div>
		</div>

		<?php

	}
}
// After the Archi_Button_Popup class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register( new Archi_Button_Popup() );
