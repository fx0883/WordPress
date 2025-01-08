<?php
if ( ! function_exists( 'archi_page_header' ) ) {
    function archi_page_header (){
        $pheader = '';
        if ( function_exists('rwmb_meta') ) {
            $pheader = rwmb_meta('pheader_switch');
            if( is_home() || is_archive() || is_search() || is_singular('post') || is_404() ){
                $pheader = rwmb_meta('pheader_switch', "type=switch", get_option( 'page_for_posts' ));
                if( empty( $pheader ) && !empty( archi_get_option('pheader_switch') ) ){
                    $pheader = '1';
                }
            }
            if( class_exists( 'woocommerce' ) ){
                if( is_shop() || is_product_category() || is_product_tag() || is_product() ){
                    $pheader = rwmb_meta('pheader_switch', "type=switch", get_option( 'woocommerce_shop_page_id' ));
                }
            }
            if( !$pheader ){
                return;
            }
        }
        if( !archi_get_option('pheader_switch') && !$pheader ) {
            return;
        }else{
            $bg     = '';
            $title  = '';
            $output = array();

            if ( is_home() ) {
                $title = get_the_title(get_option('page_for_posts'));
            }elseif ( is_404() ) {
                $title = esc_html__('Error Page', 'archi');
            } elseif ( is_search() ) {
                $title = esc_html__('Search Results for: ', 'archi') . get_search_query();
            } elseif ( is_archive() ) {
                $title = get_the_archive_title();
            } elseif ( is_singular('post') ) {
                $title = archi_get_option( 'ptitle_post' ) ? archi_get_option( 'ptitle_post' ) : get_the_title();
            }else {
                $title = get_the_title();
            }
            
            if ( !function_exists('rwmb_meta') ) {
                $bg = archi_get_option( 'pheader_img' );
            } else {
                if( is_home() ) {
                    $images = rwmb_meta('pheader_bg_image', "type=image", get_option( 'page_for_posts' ));
                }elseif( class_exists( 'woocommerce' ) ){
                    if( is_shop() || is_product_category() || is_product_tag() || is_product() ){
                        $images = rwmb_meta('pheader_bg_image', "type=image", get_option( 'woocommerce_shop_page_id' ));
                    }else{
                        $images = rwmb_meta('pheader_bg_image', "type=image");
                    }
                }elseif ( is_singular('post') ) {
                    $images = rwmb_meta('pheader_bg_image', "type=image");
                }else{
                    $images = rwmb_meta('pheader_bg_image', "type=image");
                }
                if (!$images) {
                    $bg = archi_get_option( 'pheader_img' );
                } else {
                    foreach ($images as $image) {
                        $bg = $image['full_url'];
                        break;
                    }
                }
            }

            if ($title) {
                $output[] = sprintf('%s', $title);
            }
            $htmltag = ( !empty( archi_get_option( 'pheader_htmltag' ) ) ? archi_get_option( 'pheader_htmltag' ) : 'h1');

            global $wp_query;
            $subtitle = get_post_meta( $wp_query->get_queried_object_id(), "page_subtitle", true );
        ?>        
            <div class="page-header" data-type="background" data-speed="8" <?php if ($bg) { ?> style="background-image: url(<?php echo esc_url($bg); ?>);" <?php } ?>>
                <div class="container">
                    <div class="inner">
                        <?php if ( class_exists( 'woocommerce' ) && is_woocommerce() ) { ?>
                            <?php if ( !is_product() ) { ?>
                                <?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
                                    <<?php echo $htmltag; ?> class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></<?php echo $htmltag; ?>>
                                <?php endif; ?>                            
                            <?php } else { ?>
                                <<?php echo $htmltag; ?> class="page-title"><?php echo esc_html( archi_get_option( 'page_title_product' ) ); ?></<?php echo $htmltag; ?>>
                            <?php } ?>    
                            <?php do_action( 'archi_woocommerce_breadcrumb' ); ?>
                        <?php } else { ?>
                            <div class="page-header-title-wrap">
                                <<?php echo $htmltag; ?> class="page-title"><?php echo implode('', $output); ?></<?php echo $htmltag; ?>>
                                <?php if( !empty( $subtitle ) ){ ?><h4 class="page-subtitle"><?php echo esc_html( $subtitle ) ?></h4><?php } ?>
                            </div>
                        <?php 
                            if (function_exists('archi_breadcrumbs') && archi_get_option('breadcrumbs')):
                                echo archi_breadcrumbs();
                            endif;
                        } ?>
                    </div>
                </div>
                <?php if( !empty( archi_get_option( 'pheader_info_switch' ) ) && !empty( archi_get_option( 'pheader_contact_info' ) ) ){ 
                    $contact_infos = archi_get_option( 'pheader_contact_info', array() ); ?>
                    <div class="page-header-contact-info">
                        <div class="container">
                            <div class="dflex list-info-box ot-position-left ot-vertical-align-top bg-color">
                                <?php foreach ( $contact_infos as $contact_info ) { ?>
                                <div class="info-box box-content">
                                    <div class="info-box-icon flex-gap"><i class="<?php echo esc_attr( $contact_info['info_icon'] ) ?>"></i></div>
                                    <div class="info-box_text">
                                        <div class="info-box_title"><?php echo esc_attr( $contact_info['info_title'] ) ?></div>
                                        <div class="info-box_desc"><?php echo esc_attr( $contact_info['info_desc'] ) ?></div>
                                    </div>
                                </div>
                                <?php } ?>
                            </div> 
                        </div>
                    </div>
                <?php } ?>
            </div>
        <?php
        }
    }
}