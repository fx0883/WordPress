<?php
/**
 * Template part for displaying posts layout grid
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
?> 

<article id="post-<?php the_ID(); ?>" <?php post_class('post-box'); ?>>
	<div class="post-inner">
		<?php if ( $format == 'gallery' ) { ?>
			
			<?php if ( function_exists( 'rwmb_meta' ) ) { $images = rwmb_meta( 'post_gallery', array( 'size' => 'full' ) ); } ?>
			<div class="entry-media">
				<?php if( !empty($images) ){ ?>
				<div class="gallery-post ot-carousel" <?php if( is_rtl() ){ echo'dir="rtl"'; }?>>
					<div class="owl-carousel owl-theme"> 
	                	<?php foreach ( $images as $image ) {  ?>
                    		<div class="item-image">
	                    		<img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" width="<?php echo esc_attr( $image['width'] ); ?>" height="<?php echo esc_attr( $image['height'] ); ?>">
                			</div>
                		<?php } ?>    
            		</div>
        		</div> 
	            <?php } ?>
	            <?php archi_posted_in(); ?>
			</div>

	    <?php }elseif( $format == 'image' ) { ?>

	    	<?php if( function_exists( 'rwmb_meta' ) ) { $images = rwmb_meta( 'post_image', array( 'size' => 'full' ) ); } ?>
	    	<div class="entry-media">
			    <?php if($images){ ?>              
			        <?php foreach ( $images as $image ) {  ?>
			            <a href="<?php the_permalink(); ?>">
			            	<img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" width="<?php echo esc_attr( $image['width'] ); ?>" height="<?php echo esc_attr( $image['height'] ); ?>">
			            </a>
			        <?php } ?>                
			    <?php } ?>
			    <?php archi_posted_in(); ?>
			</div>
			
	    <?php }elseif( $format == 'audio' ){ ?>

	    	<?php if( $link_audio ){ ?>
			<div class="entry-media">
				<?php archi_posted_in(); ?>
				<iframe scrolling="no" frameborder="no" src="<?php echo esc_url( $link_audio ); ?>"></iframe>
			</div>
			<?php } ?>

	    <?php }elseif( $format == 'video' ){ ?>

	    	<?php if( function_exists( 'rwmb_meta' ) ) { $images = rwmb_meta( 'bg_video', array( 'size' => 'full' ) ); } ?>
			<div class="entry-media">
			    <?php if( $images ){ ?>
			    	<div class="video-popup">
				    	<a class="octf-btn octf-btn-play" href="<?php echo esc_url( $link_video ); ?>">
							<i class="fa fa-play"></i>
						</a>
					</div>
					<?php foreach ( $images as $image ) { ?>
			            <img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" width="<?php echo esc_attr( $image['width'] ); ?>" height="<?php echo esc_attr( $image['height'] ); ?>">
			        <?php } ?>
			    <?php } ?>
			    <?php archi_posted_in(); ?>
			</div>

	    <?php }elseif( $format == 'link' ){ ?>

	        <?php if( $text_link ){ ?>
	        <?php archi_posted_in(); ?>
			<div class="link-box">
				<i class="fa fa-link"></i>
				<a href="<?php echo esc_url( $link_link ); ?>" class="title-link"><?php echo esc_html( $text_link ); ?></a>
			</div>
			<?php } ?>

	    <?php }elseif( $format == 'quote' ){ ?>
	    	<?php archi_posted_in(); ?>
			<div class="quote-box">
				<div class="quote-text">
					<?php echo esc_html( $quote_text ); ?>
					<span><?php echo esc_html( $quote_name ); ?></span>
				</div>
			</div>

	    <?php }elseif ( has_post_thumbnail() ) { ?>

	        <div class="entry-media">
	            <a href="<?php the_permalink(); ?>">
	                <?php the_post_thumbnail('full'); ?>
	            </a>
	            <?php archi_posted_in(); ?>
	        </div>
	        
	    <?php } ?>

		<div class="inner-post">
	        <?php the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' ); ?>
	        <div class="entry-summary the-excerpt">
	            <?php echo archi_excerpt(25); ?>
	        </div>
	        <?php if ( 'post' === get_post_type() ) : ?>
			    <div class="post-date">
		            <?php archi_posted_on(); ?>
		        </div>
	        <?php endif; ?>
	    </div>
    </div>
</article><!-- #post-<?php the_ID(); ?> -->
