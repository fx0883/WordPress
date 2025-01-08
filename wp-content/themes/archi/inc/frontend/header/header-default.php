<!-- Main header start -->
<div class="header-desktop">
	<div class="container octf-mainbar-container">
		<div class="octf-mainbar">
			<div class="octf-mainbar-row octf-row">
				<div class="octf-col logo-col">
					<div id="site-logo" class="site-logo">
						<?php 
							$url_logo = get_template_directory_uri() . '/images/logo.png';
							if( !empty( archi_get_option('light_mode') ) ) {
								$url_logo = get_template_directory_uri() . '/images/logo-dark.png';
							}
							$url_logo = !empty( archi_get_option('logo_site') ) ? archi_get_option('logo_site') : $url_logo ;
						?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
							<img  src="<?php echo esc_url( $url_logo ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
						</a>
					</div>
				</div>
				<div class="octf-col menu-col">
					<?php 
						$nav_class = archi_get_option('header_position') == 'header_left' ? 'vertical-main-navigation' : 'main-navigation';
					?>
					<nav id="site-navigation" class="<?php echo esc_attr( $nav_class );?>">			
						<?php
							$menus = wp_get_nav_menus();
							if( $menus ){
								$options = [];
								foreach ( $menus as $menu ) {
									$options[ $menu->slug ] = $menu->name;
								}
								wp_nav_menu( array(
									'menu' 			 => array_keys( $options )[0],
									'menu_id'        => 'primary-menu',
									'container'      => 'ul',
								) );
							}
							else{
								wp_nav_menu( array(
									'theme_location' => 'primary',
									'menu_id'        => 'primary-menu',
									'container'      => 'ul',
								) );
							}
						?>
					</nav><!-- #site-navigation -->
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
			</div>
		</div>
	</div>
</div>		
<!-- Main header close -->