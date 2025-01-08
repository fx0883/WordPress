<?php
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Portfolio Creative Filter
 */
class Archi_Portfolio_Creative_Filter extends Widget_Base{

 	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'ot-portfolio-creative-filter';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'OT Portfolio Creative Filter', 'archi' );
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

		//Content
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'General', 'archi' ),
			]
		);
		
		$this->add_control(
			'project_cat',
			[
				'label' => __( 'Select Categories', 'archi' ),
				'type' => Controls_Manager::SELECT2,
				'options' => $this->select_param_cate_project(),
				'multiple' => true,
				'label_block' => true,
				'placeholder' => __( 'All Categories', 'archi' ),
				'separator' => 'before',
			]
		);
		$this->add_control(
			'project_num',
			[
				'label' => __( 'Show Number Projects', 'archi' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 6,
			]
		);
		
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'post_thumbnail', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
				'exclude' => ['1536x1536', '2048x2048'],
				'include' => [],
				'default' => 'full',
			]
		);
		$this->add_control(
			'filter',
			[
				'label' => __( 'Show Filter', 'archi' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'archi' ),
				'label_off' => __( 'Hide', 'archi' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'all_text',
			[
				'label' => __( 'Text All', 'archi' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'All',
				'condition' => [
					'filter' => 'yes',
				],
			]
		);
		$label_pull = is_rtl() ? 'Left' : 'Right';

		$this->add_control(
			'filter_all_position',
			[
				'label' => __( 'Pull '.$label_pull, 'archi' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'archi' ),
				'label_off' => __( 'No', 'archi' ),
				'return_value' => 'yes',
				'default' => '',
				'condition' => [
					'filter' => 'yes',
					'all_text!' => '',
				],
			]
		);
		
		$this->add_control(
			'column',
			[
				'label' => __( 'Columns', 'archi' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'pf_3_cols',
				'options' => [
					'pf_2_cols' => __( '2 Column', 'archi' ),
					'pf_3_cols'	=> __( '3 Column', 'archi' ),
					'pf_4_cols' => __( '4 Column', 'archi' ),
				],
				'separator' => 'before',
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
					'{{WRAPPER}} .project-item' => 'margin-top: calc({{SIZE}}{{UNIT}}); padding: 0 calc({{SIZE}}{{UNIT}}/2);',
					'{{WRAPPER}} .projects-masonry' => 'margin-top: calc(-{{SIZE}}{{UNIT}}); margin-left: calc(-{{SIZE}}{{UNIT}}/2); margin-right: calc(-{{SIZE}}{{UNIT}}/2);',
				],
			]
		);
			
		$this->add_control(
			'view_more',
			[
				'label' => __( 'Label View Button ', 'archi' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Click to view', 'archi' ),
				'placeholder' => __( 'Click to view', 'archi' ),
				'separator' => 'before',
			]
		);

		$this->add_control(
			'load_more',
			[
				'label' => __( 'Label Load More Button', 'archi' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Load More', 'archi' ),
				'separator' => 'before',
			]
		);
		
		$this->add_control(
			'p_more',
			[
				'label' => __( 'Load More Number', 'archi' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 3,
				'condition' => [
					'load_more[value]!' => '',
				]
			]
		);

		$this->add_control(
			'hover_style',
			[
				'label' => __( 'Creative Type', 'archi' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => [
					'style-1'  	=> __( 'Creative 1', 'archi' ),
					'style-2' 	=> __( 'Creative 2', 'archi' ),
					'style-3' 	=> __( 'Creative 3', 'archi' ),
				],
				'separator' => 'before',
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
				'default' => '',
			]
		);

		$this->end_controls_section();

		//Style
		$this->start_controls_section(
			'filter_style_section',
			[
				'label' => __( 'Filter', 'archi' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'filter' => 'yes',
				]
			]
		);

		$this->add_responsive_control(
			'filter_align',
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
					'{{WRAPPER}} .isotope-filter,
					 {{WRAPPER}} .loadmore_wrapper' => 'text-align: {{VALUE}};',
				],
				'default' => 'center',
			]
		);
		
		$this->add_responsive_control(
			'filter_spacing',
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
					'{{WRAPPER}} .isotope-filter' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'filter_color',
			[
				'label' => __( 'Color', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .isotope-filter ul li a:not(.active)' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'filter_hcolor',
			[
				'label' => __( 'Active Color', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .isotope-filter ul li a.active,
					 {{WRAPPER}} .isotope-filter ul li a:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'filter_bg_hcolor',
			[
				'label' => __( 'Background Active Color', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .isotope-filter ul li a.active,
					 {{WRAPPER}} .isotope-filter ul li a:hover' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'filter_typography',
				'selector' => '{{WRAPPER}} .isotope-filter ul li a',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'overlay_style_section',
			[
				'label' => __( 'Project Items', 'archi' ),
				'tab'   => Controls_Manager::TAB_STYLE,
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
			'border_radius',
			[
				'label' => __( 'Border Radius', 'archi' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .projects-thumbnail,
					 {{WRAPPER}} .projects-thumbnail img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
        );

		/* title */
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
		$this->add_responsive_control(
			'title_size_hover',
			[
				'label' => __( 'Font Size When Hover', 'archi' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 5,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .creative-three:hover .post-title' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'hover_style'	=> 'style-3'
				]
			]
		);

		/* Label view button */
		$this->add_control(
			'btn_view',
			[
				'label' => __( 'View Button', 'archi' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'btn_view_color',
			[
				'label' => __( 'Color', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} span.btn-text' => 'color: {{VALUE}};',
					'{{WRAPPER}} span.line' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'btn_view_typography',
				'selector' => '{{WRAPPER}} span.btn-text',
			]
		);

		$this->end_controls_section();	
		
		/* Load More Button */
		$this->start_controls_section(
			'style_section',
			[
				'label' => __( 'Load More Button', 'archi' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'load_more[value]!' => '',
				]
			]
		);

		$this->add_responsive_control(
			'btn_spacing',
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
					'{{WRAPPER}} .loadmore_wrapper' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'btn_width',
			[
				'label' => __( 'Width', 'archi' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 1000,
					],
					'%' => [
						'min' => 1,
						'max' => 100,
					]
				],
				'selectors' => [
					'{{WRAPPER}} .octf-btn' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_responsive_control(
			'btn_padding',
			[
				'label' => 'Padding',
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .octf-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
		$this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label' => __( 'Normal', 'archi' ),
			]
		);

		$this->add_control(
			'button_text_color',
			[
				'label' => __( 'Text Color', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .octf-btn' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'btn_bg',
			[
				'label' => __( 'Background', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .octf-btn' => 'background-color: {{VALUE}};',
				],
			]
		);
		
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label' => __( 'Hover', 'archi' ),
			]
		);

		$this->add_control(
			'hover_color',
			[
				'label' => __( 'Text Color', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .octf-btn:hover, {{WRAPPER}} .octf-btn:focus' => 'color: {{VALUE}};',
				],
			]
		);

        $this->add_control(
			'btn_bg_hover_color',
			[
				'label' => __( 'Background', 'archi' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .octf-btn:hover' => 'background-color: {{VALUE}};',
				],
			]
		);
		
		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

	}

	protected function array_except($settings, $keys){
		$new_array = [];
		foreach($keys as $key){
			$new_array[$key] = $settings[$key];
		}
		return $new_array;
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$settings['widget_name'] = self::get_name();
		
		if( $settings['hover_style'] == 'style-3' ){
			$hover_style = 'creative-three';
		}elseif( $settings['hover_style'] == 'style-2' ){
			$hover_style = 'creative-two';
		}else{
			$hover_style = 'creative-one';
		}
		$settings['hover_style'] = $hover_style;
		$keys = ['project_num','p_more', 'project_cat','post_thumbnail_size','post_thumbnail_custom_dimension','column', 'view_more','widget_name','hover_style'];
		$param_settings = $this->array_except($settings, $keys);
		$id_int = substr( $this->get_id_int(), 0, 3 );

		$cat_ids_str = '';
		$cat_ids_arr = [];
    	if( $settings['project_cat'] ) {
    		foreach( (array)$settings['project_cat'] as $cates){
                $cate = get_term_by('slug', $cates, 'portfolio_cat');
                $cat_ids_arr[] = $cate->term_id;
            }
            $cat_ids_str = implode(",", $cat_ids_arr);
            $args = array(	                    
                'post_type' => 'ot_portfolio',
                'post_status' => 'publish',
                'posts_per_page' => $settings['project_num'],
                'tax_query' => array(
                    array(
                        'taxonomy' => 'portfolio_cat',
                        'field' => 'term_id',
                        'terms' => $cat_ids_arr,
                    ),
                ),              
			);
        } else {
            $args = array(
                'post_type' => 'ot_portfolio',
                'post_status' => 'publish',
                'posts_per_page' => $settings['project_num'],
            );
        }

        $wp_query = new \WP_Query($args);
		$count = $wp_query->found_posts;

		$loadmore_param = [
			'data_cates'   	=> $cat_ids_str,
			'settings' =>  $param_settings
		];
		$this->add_render_attribute([
			'filter-wrapper' => [
				'class'   => [
					'projects-masonry isotope',
					$settings['column'],
					$settings['popup_gallery'] == 'yes' ? 'image-popup-gallery' : ''
				],
			],
			'btn-loadmore'	=> [
				'class'	  	=> 'octf-btn btn-loadmore',
			],
			'input-value'	=>[
				'value'		=> wp_json_encode( $loadmore_param ),
			]
		]);

		$class_filter_all = '';
		if( $settings['filter_all_position'] == 'yes' ){
			$class_filter_all = is_rtl() ? 'f-left' : 'f-right';
		}

		?>

		<div class="projects-filter-wrapper">
			<?php if( 'yes' === $settings['filter'] ) : ?>
        		<div class="isotope-filter">
	        		<ul>
	        			<?php if( $settings['all_text'] != '' ) { ?>
	        			 	<li class="<?php echo esc_attr( $class_filter_all ); ?>"><a href="#" data-filter="*" class="active filter-item"><?php $this->print_unescaped_setting( 'all_text' ); ?></a></li>
	        			<?php } ?>
		                <?php
		                if( $settings['project_cat'] ){
		                    $categories = $settings['project_cat'];
		                    foreach( (array)$categories as $categorie){
		                        $cates = get_term_by('slug', $categorie, 'portfolio_cat');
		                        $cat_name = $cates->name;
		                        $cat_id   = 'portfolio-category-id-' . $cates->term_id;
		                ?>
		                	<li>
								<a href='#' data-filter='.<?php echo esc_attr( $cat_id ); ?>' class='filter-item'><?php echo esc_html( $cat_name ); ?></a>
							</li>	                   
		                <?php } }else{
		                    $categories = get_terms('portfolio_cat');
		                    foreach( (array)$categories as $categorie){
		                        $cat_name = $categorie->name;
		                        $cat_id   = 'portfolio-category-id-' . $categorie->term_id;
		                    ?>
		                    <li>
								<a href='#' data-filter='.<?php echo esc_attr( $cat_id ); ?>' class='filter-item'><?php echo esc_html( $cat_name ); ?></a>
							</li>	                    
		                <?php } } ?>
					</ul>
				</div>
	        <?php endif; ?>
			
	        <div <?php echo $this->get_render_attribute_string( 'filter-wrapper' ); ?>>
				<div class="grid-sizer"></div>
	            <?php
	            while ($wp_query -> have_posts()) : $wp_query -> the_post();
				
					get_template_part( 'template-parts/content', 'project-creative-filter', array(
						'settings' => $settings
					));

	            endwhile; wp_reset_postdata(); ?>
			</div>
			
			<?php if( !empty( $settings['load_more'] ) && $count > $settings['project_num'] ) { ?>
				<div class="loadmore_wrapper">
					<button <?php $this->print_render_attribute_string( 'btn-loadmore' ) ?>>
						<span><?php $this->print_unescaped_setting( 'load_more' ); ?></span>
						<i class="fa fa-spinner" aria-hidden="true"></i>
					</button>
					<form class="posts_data_ajax">
						<input type="hidden" class="data_ajax" name="data_ajax-<?php echo esc_attr($id_int) ?>" <?php $this->print_render_attribute_string( 'input-value' ) ?>>
					</form>
				</div>
			<?php }?>
	    </div>
										
	    <?php
	}

	public function get_keywords() {
		return [ 'isotope', 'project', 'filter' ];
	}

	protected function select_param_cate_project() {
		$category = get_terms( 'portfolio_cat' );
		$cat = array();
		if ( ! is_wp_error( $category ) && ! empty( $category ) ){
			foreach( $category as $item ) {
			    if( $item ) {
				  	$cat[$item->slug] = $item->name;
			   	}
			}
		}
		return $cat;
	}
}
// After the Archi_Portfolio_Creative_Filter class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register( new Archi_Portfolio_Creative_Filter() );