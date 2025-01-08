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
?>
<div class="entry-content">
	<div class="container">
		<div class="row">
			<div id="primary" class="content-area col-md-12">
				<main id="main" class="site-main">
					<div class="projects-filter-wrapper">
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
							
							<div class="pagination-wrapper">
								<?php archi_posts_navigation(); ?>
							</div>
							
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

