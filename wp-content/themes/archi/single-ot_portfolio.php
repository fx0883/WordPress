<?php
/**
 * The template for displaying all portfolios
 *
 * This is the template that displays all portfolio by default.
 * Please note that this is the WordPress construct of portfolios
 * and that other 'portfolios' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Archi
 */

get_header(); ?>

<?php
    while ( have_posts() ) : the_post();
        the_content();                            
    endwhile; 
    $settings = [];
    $hover_style = archi_get_option('portfolio_style') != 'style-1' ? 'reverse' : '';
    if( archi_get_option('portfolio_style') == 'style-3' ){
        $hover_style .= ' title-to-bottom';
    }
    $settings = [
        'hover_style'   => $hover_style,
    ];
?>

<?php if ( archi_get_option('pf_nav') || archi_get_option('pf_related_switch') ) { ?>
<div class="container">
    <div class="project-bottom">        
        <?php if ( archi_get_option('pf_nav') ) { ?>
        <div class="single-project-navigation">
            <?php archi_single_post_nav(); ?>
        </div>
        <?php } ?>

        <?php if ( archi_get_option('pf_related_switch') ) { ?>
        <div class="project-related-posts-wrap">
            <div class="project-related-title-wrap">
                <h2 class="project-related-title"><?php echo archi_get_option('pf_related_text'); ?></h2>
            </div>
            <div class="project-related-posts ot-project-carousel ot-carousel" <?php if ( is_rtl() ) { echo'dir="rtl"'; } ?>>
                <div class="owl-carousel owl-theme">   
                    <?php 
                    /*get the custom post type's taxonomy terms */                   
                    $custom_taxterms = wp_get_object_terms( $post->ID, 'portfolio_cat', array('fields' => 'ids') );
                    /*arguments*/
                    $args = array(
                        'post_type' => 'ot_portfolio',
                        'post_status' => 'publish',
                        'posts_per_page' => -1, /*you may edit this number*/
                        'ignore_sticky_posts' => 1,
                        'orderby' => 'rand',
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'portfolio_cat',
                                'field' => 'id',
                                'terms' => $custom_taxterms
                            )
                        ),
                        'post__not_in' => array ($post->ID),
                    );
                    $second_query = new WP_Query( $args );

                    /*Loop through posts and display...*/
                    if ( $second_query->have_posts() ) : while ( $second_query->have_posts() ) : $second_query->the_post(); 
                        /*
                        * Include the Post-Type-specific template for the content.
                        * If you want to override this in a child theme, then include a file
                        * called content-___.php (where ___ is the Post Type name) and that will be used instead.
                        */
                        get_template_part( 'template-parts/content', 'project-filter', array(
                            'settings' => $settings
                        ));
                    endwhile; wp_reset_query(); endif; 
                    ?>
                </div>
            </div>
        </div>
        <?php } ?>         
    </div>
</div>
<?php } ?>

<?php
get_footer();