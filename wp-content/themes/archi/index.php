<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Archi
 */

get_header();
?>

<div class="entry-content <?php if( !empty( archi_get_option( 'no_gap' ) ) ){ echo esc_attr('no-gap'); } ?>">
	<div class="<?php archi_blog_layout_container(); ?>">
		<div class="row">
			<div id="primary" class="content-area <?php archi_content_columns(); ?>">
				<main id="main" class="site-main <?php archi_blog_style(); ?>">

				<?php
				if ( have_posts() ) :

					/* Start the Loop */
					while ( have_posts() ) :
						the_post();

						/*
						 * Include the Post-Type-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
						 */
						if ( archi_get_option( 'blog_style' ) === 'grid' ) {
							get_template_part( 'template-parts/content-grid', get_post_type() );
						}elseif( archi_get_option( 'blog_style' ) === 'poster' ){
							get_template_part( 'template-parts/content-grid-poster', get_post_type() );
						}else{
							get_template_part( 'template-parts/content', get_post_type() );
						}

					endwhile;

				else :

					get_template_part( 'template-parts/content', 'none' );

				endif;
				?>

				</main><!-- #main -->
				
				<?php if ( have_posts() ) : archi_posts_navigation(); endif ?>
			</div><!-- #primary -->

			<?php get_sidebar(); ?>
		</div>
	</div>	
</div>

<?php
get_footer();