<?php
/**
 * Template part for displaying posts layout grid POSTER
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Archi
 */

?>

<?php                                                     
	$format 	 = get_post_format();
	$link_video  = get_post_meta(get_the_ID(),'post_video', true);
	$link_audio  = get_post_meta(get_the_ID(),'post_audio', true);
	$link_link   = get_post_meta(get_the_ID(),'post_link', true);
	$text_link   = get_post_meta(get_the_ID(),'text_link', true);
	$quote_text  = get_post_meta(get_the_ID(),'post_quote', true);
	$quote_name  = get_post_meta(get_the_ID(),'quote_name', true);
	$images		 = '';
	if ( has_post_thumbnail() ) {
		$image_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
	}else{
		$image_url = get_bloginfo( 'stylesheet_directory' ) . '/images/thumbnail-default.png';
	}
?> 

<article id="post-<?php the_ID(); ?>" <?php post_class('post-box'); ?>>
	<div class="post-inner">
		
		<a class="d-overlay" href="<?php the_permalink(); ?>"></a>
		<div class="inner-post">
			<?php archi_posted_in(); ?>
			<?php the_title( '<h3 class="entry-title">', '</h3>' ); ?>
			<?php if ( 'post' === get_post_type() ) : ?>
			    <div class="post-date">
		            <?php archi_posted_on(); ?>
		        </div>
	        <?php endif; ?>
		</div>
		<div class="d-image" data-bgimage="url(<?php echo esc_url( $image_url ); ?>)"></div>
		
    </div>
</article><!-- #post-<?php the_ID(); ?> -->
