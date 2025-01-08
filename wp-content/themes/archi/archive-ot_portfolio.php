<?php
/**
 * The template for displaying archive portfolio pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Archi
 */

get_header(); ?>
<?php
	$settings = [];
	$hover_style = archi_get_option('portfolio_style') != 'style-1' ? 'reverse' : '';
	if( archi_get_option('portfolio_style') == 'style-3' ){
		$hover_style .= ' title-to-bottom';
	}
	$settings = [
		'project_num'   => !empty( archi_get_option('portfolio_posts_per_page') ) ? archi_get_option('portfolio_posts_per_page') : '6',
		'p_more' 	    => 3,
		'widget_name'	=> 'ot-portfolio-filter',
		'hover_style'	=> $hover_style,
		'project_cat'	=> ''
	];
	$loadmore_param = [
		'data_cates'   	=> '',
		'settings' 		=>  $settings
	];
?>

<div class="entry-content">
	<div class="container">
		<div class="row">
			<div id="primary" class="content-area col-md-12">
				<main id="main" class="site-main">	
					<div class="projects-filter-wrapper">
						<div class="isotope-filter text-center">			
							<ul>
								<li><a href="#" data-filter="*" class="active filter-item"><?php esc_html_e('All', 'archi'); ?></a></li>
								<?php 
									$terms = get_terms( 'portfolio_cat' ); // get all categories, but you can use any taxonomy
									$count = count( $terms ); //How many are they?
									if ( $count > 0 ){  //If there are more than 0 terms
										foreach ( $terms as $term ) {  //for each term:
											echo "<li><a class='filter-item' href='#' data-filter='.portfolio-category-id-".$term->term_id."'>" . $term->name . "</a></li>\n";
											//create a list item with the current term slug for sorting, and name for label
										}
									} 
								?>
							</ul>
						</div>

						<?php $p_count = wp_count_posts('ot_portfolio'); $c = $p_count->publish; if ( have_posts() ) : ?>
							<div class="projects-masonry isotope <?php archi_portfolio_option_class(); ?>">
								<div class="grid-sizer"></div>
								<?php
									/* Start the Loop */
									while ( have_posts() ) : the_post();

										/*
										* Include the Post-Type-specific template for the content.
										* If you want to override this in a child theme, then include a file
										* called content-___.php (where ___ is the Post Type name) and that will be used instead.
										*/
										get_template_part( 'template-parts/content', 'project-filter', array(
											'settings' => $settings
										));

									endwhile; 
								?>
							</div>
							<?php if ( $c > archi_get_option( 'portfolio_posts_per_page' ) ) { ?>
								<div class="loadmore_wrapper text-center">
									<button class="octf-btn btn-loadmore">
										<span><?php esc_attr_e('Load More','archi'); ?></span>
										<i class="fa fa-spinner" aria-hidden="true"></i>
									</button>
									<form class="posts_data_ajax">
										<input type="hidden" class="data_ajax" name="data_ajax-9999" value="<?php echo esc_attr( wp_json_encode( $loadmore_param ) ) ?>">
									</form>
								</div>
							<?php } ?>
						<?php 	
						else :

							get_template_part( 'template-parts/content', 'none' );

						endif;
						?>	
					</div>	
				</main><!-- #main -->
			</div><!-- #primary -->
		</div>
	</div>
</div>

<?php
get_footer();

