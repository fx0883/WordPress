<?php
/**
 * Template part for displaying widget Portfolio Creative Filter
 *
 * @package Archi
 */
?>
<?php 
	$cates = get_the_terms( get_the_ID(), 'portfolio_cat' );
	$cate_id   = '';
    if ( ! is_wp_error( $cates ) && ! empty( $cates ) ) :
	    foreach ( $cates as $cate ) {
	        $cate_id .= 'portfolio-category-id-' . $cate->term_id . ' ';
	    }
	endif;
	$thumb_size = '';
	if ( function_exists('rwmb_meta') ) {
		$thumb_size = rwmb_meta('thumb_size');
	}

	if ( has_post_thumbnail() ) {
		$args['settings']['post_thumbnail'] = [
			'id' => get_post_thumbnail_id(),
		];
		$image_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
		$thumbnail_html = Elementor\Group_Control_Image_Size::get_attachment_image_html( $args['settings'], 'post_thumbnail' );
	}else{
		$image_url = get_bloginfo( 'stylesheet_directory' ) . '/images/thumbnail-default.png';
		$thumbnail_html = '<img src="' . $image_url . '" alt=""/>';
	}

?>
<article class="project-item <?php echo esc_attr( $cate_id . $thumb_size ); ?>">
	<div class="projects-box">
		<figure class="projects-thumbnail overlay-creative hover-scale <?php echo esc_attr( $args['settings']['hover_style'] ); ?>" data-src="<?php echo esc_url( $image_url ); ?>" data-sub-html="<?php the_title(); ?>">
			<a href="<?php the_permalink(); ?>">
				<?php echo wp_kses_post( $thumbnail_html ); ?>
				<span class="bg"></span>
				<span class="line"></span>
				<figcaption><h5 class="post-title"><?php the_title(); ?></h5></figcaption>
				<span class="btn-text"><?php echo wp_kses_post( $args['settings']['view_more'] ); ?></span>
			</a>
		</figure>
	</div>
</article>
<?php if(!empty( $args['is_latest'] )){ ?>
<div class="hidden_load_more"></div>
<?php } ?>
