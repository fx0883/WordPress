<?php
/**
 *
 * Template Name: Blog Poster Full Width 3 Columns
 * Description: A Page Template with a design.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Archi
 */

get_header();
?>
    
<div class="entry-content no-gap">
    <div class="container-fluid">
        <div class="row">
            <div id="primary" class="content-area <?php archi_content_columns(); ?>">
                <main id="main" class="site-main blog-grid poster pf_3_cols">

                <?php
                if ( have_posts() ) :

                    /* Start the Loop */
                    
                    $args = array(    
                        'paged' => $paged,
                        'posts_per_page' => 6,
                        'post_type' => 'post',
                    );
                    $wp_query = new WP_Query($args);
                    while ($wp_query -> have_posts()): $wp_query -> the_post();    

                    get_template_part( 'template-parts/content-grid-poster', get_post_type() );
                    
                    endwhile;

                else :

                    get_template_part( 'template-parts/content', 'none' );

                endif;
                ?>

                </main><!-- #main -->
                <?php if ( have_posts() ) : archi_posts_navigation(); endif ?>
            </div><!-- #primary -->
            
        </div>
    </div>  
</div>

<?php
get_footer();