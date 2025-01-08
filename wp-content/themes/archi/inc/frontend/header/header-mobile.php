<div class="header-mobile">
	<div class="container">
		<div class="mlogo_wrapper clearfix">
	        <div class="mobile_logo">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
					<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/logo.png" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
				</a>
	    	</div>
	        <div id="mmenu_toggle">
		        <button></button>
		    </div>
		    <?php
			if ( class_exists( 'woocommerce' ) ) {
				$product_count = sprintf ( _n( '%d', '%d', WC()->cart->get_cart_contents_count() ), WC()->cart->get_cart_contents_count() );
				$cart_url = esc_url( wc_get_cart_url() );

				$widget_cart_is_hidden = apply_filters( 'woocommerce_widget_cart_is_hidden', false );
			
			if ( ! $widget_cart_is_hidden ) { 
			?>
				<div class="octf-cart">
					<a class="cart-contents" href="<?php echo $cart_url; ?>" title="<?php esc_attr_e( 'View your shopping cart', 'archi' ); ?>"><i class="fa fa-shopping-basket"></i> <span class="cart-count"><?php echo $product_count; ?></span>
					</a>
					<?php if( !is_cart() && !is_checkout() ) { ?>
					<div class="site-header-cart">
						<?php the_widget( 'WC_Widget_Cart', array( 'title' => '' ) ); ?>
					</div>	
					<?php } ?>
				</div>
			<?php }}; ?>	
	    </div>
	    <div class="mmenu_wrapper">		
			<div class="mobile_nav">
				<?php
					$menus = wp_get_nav_menus();
					if( $menus ){
						$options = [];
						foreach ( $menus as $menu ) {
							$options[ $menu->slug ] = $menu->name;
						}
						wp_nav_menu( array(
							'menu' 			 => array_keys( $options )[0],
							'menu_class'     => 'mobile_mainmenu none-style',
							'container'      => 'ul',
						) );
					}
					else{
						wp_nav_menu( array(
							'theme_location' => 'primary',
							'menu_class'     => 'mobile_mainmenu none-style',
							'container'      => 'ul',
						) );
					}
				?>
			</div>
	    </div>
    </div>
</div>