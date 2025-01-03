<?php/** * Created by PhpStorm. * User: Admin * Date: 04.04.2017 * Time: 8:10 */use NetworkPosts\Components\NetsPostsHtmlHelper;if ( ! defined( 'POST_VIEWS_PATH' ) ) {	die();}if( $shortcode_mgr->get_boolean( 'show_title' ) ){	include 'title.php';}$date_post = '';if ( array_key_exists( 'post_date', $the_post ) ) {	$date = new DateTime( trim( $the_post['post_date'] ) );	$date_post = date_i18n( $format, $date->getTimestamp() );}$meta_width = $shortcode_mgr->get( 'meta_width' );if ( $meta_width == "100%" ) {	$width = 'width: 100%;';} else {	$width = "width: " . $meta_width . "px;";}if ( ! $shortcode_mgr->get_boolean( 'hide_source' ) ) {	if ( $shortcode_mgr->get_boolean( 'wrap_source' ) ) {		$html .= '<div class="netsposts-source" style="margin-bottom: 5px;' . $width . '">';	}	if ( $shortcode_mgr->get_boolean( 'meta_info' ) ) {		if ( ! $shortcode_mgr->get_boolean( 'hide_post_date_meta_info' ) ) {			if ( $shortcode_mgr->has_value( 'wrap_post_date_start' ) ) {				$html .= $shortcode_mgr->get( 'wrap_post_date_start' );			}			$html .= '<span>' . __( 'Published', 'netsposts' ) . '</span><span>' . ' ' . $date_post . '' . '</span>' . ' ' . '<span>' . __( 'in', 'netsposts' ) . '</span>  ';			if ( $shortcode_mgr->has_value( 'wrap_post_date_end' ) ) {				$html .= $shortcode_mgr->get( 'wrap_post_date_end' );			}		}		$html .= '<span>' . NetsPostsHtmlHelper::create_link( $blog_url, $blog_name, $open_link_in_new_tab, 'netsposts-source-link' ) . '</span><br/>';	}	if ( $shortcode_mgr->get_boolean( 'show_order' ) ) {		if ( isset( $tab_order_by1 ) && count( $tab_order_by1 ) > 0 && isset( $the_post[ $tab_order_by1[0] ] ) ) {			$fieldname = $tab_order_by1[0];			$fullname  = netsposts_create_label_from_id( $fieldname );			$html      .= "<span>" . $fullname . ": " . $the_post[ $tab_order_by1[0] ] . "</span><br/>";		}	}	$show_date   = false;	$date_column = '';	if( $shortcode_mgr->has_value( 'order_post_by_acf_date' ) ){		$show_date = true;		$data = $shortcode_mgr->split_array( 'order_post_by_acf_date', ' ' );		$date_column = $data[0];	}	if( $shortcode_mgr->has_value( 'exclude_all_past_events' ) ){		$show_date = true;		$date_column = $shortcode_mgr->get( 'exclude_all_past_events' );	}	if( $shortcode_mgr->has_value( 'show_past_events' ) ){		$show_date = true;		$date_column = $shortcode_mgr->get( 'show_past_events' );	}	if ( $shortcode_mgr->has_value( 'show_before_date' ) ) {		$show_date   = true;		$data = $shortcode_mgr->split_array( 'show_before_date', '::' );		$date_column = $data[0];	}	if ( $shortcode_mgr->has_value( 'show_after_date' ) ) {		$show_date   = true;		$data = $shortcode_mgr->split_array( 'show_after_date', '::' );		$date_column = $data[0];	}	if ( $shortcode_mgr->has_value( 'show_for_today' ) ) {		$show_date   = true;		$date_column = $shortcode_mgr->get( 'show_for_today' );	}	if ( $show_date && isset( $the_post[ $date_column ] ) ) {		$date_meta = $the_post[ $date_column ];		if ( is_numeric( $date_meta ) ) {			$date = date( $format, $date_meta );		} else {			$date = new DateTime( $the_post[ $date_column ] );			$date = date_i18n( $format, $date->getTimestamp() );		}		if( $shortcode_mgr->get_boolean( 'add_link_to_date' ) ){			$date = NetsPostsHtmlHelper::create_link( $the_post['guid'], $date );		}		$html .= NetsPostsHtmlHelper::create_span( $date ) . '<br/>';	}##  Full metadata	if ( $shortcode_mgr->get_boolean( 'show_author' ) ) {		if ( $shortcode_mgr->get_boolean( 'show_author_avatar' ) ) {			$author_display_name  = get_avatar( $the_post['post_author'], $shortcode_mgr->get_int( 'author_avatar_size' ) );			$author_display_name .= get_the_author_meta( 'display_name', $the_post['post_author'] );		} else {			$author_display_name = get_the_author_meta( 'display_name', $the_post['post_author'] );		}		$author_url = get_author_posts_url( $the_post['post_author'] );		$html      .= NetsPostsHtmlHelper::create_author_link( $author_url, $author_display_name, $open_link_in_new_tab );	}	if ( $shortcode_mgr->get_boolean( 'wrap_source' ) ) {		$html .= '</div>'; //end of netsposts-source	}}if( $shortcode_mgr->get_boolean( 'show_categories' ) ) {	if ( isset( $the_post['categories'] ) &&	     ! empty( $the_post['categories'] ) ) {		$html .= '<div class="netsposts-categories" style="margin-bottom: 5px; ' . $width . '">';		if( $shortcode_mgr->get_boolean( 'show_category_icon' ) ){			$html .= '<span class="icon ic-category"></span>';		}		foreach ( $the_post['categories'] as $category ) {			$category_name = $category->name;			if( $the_post['post_type'] === 'product' ) {				$link = NetsPostsHtmlHelper::create_term_link( $category->term_id, $category_name, $open_link_in_new_tab );			} else {				$link = NetsPostsHtmlHelper::create_term_link( $category->term_id, $category_name, $open_link_in_new_tab );			}			$html .= $link;		}		$html .= '</div>';	}}if( $shortcode_mgr->has_value( 'show_custom_taxonomies' ) ){	if( isset( $the_post['custom_taxonomies'] ) &&	    ! empty( $the_post['custom_taxonomies'] ) ){		$custom_categories = $the_post['custom_taxonomies'];		$html .= '<div class="netsposts-custom-taxonomies" style="margin-bottom: 5px; ' . $width . '">';		if( $shortcode_mgr->get_boolean( 'show_custom_taxonomy_icon' ) ){			$html .= '<span class="icon ic-custom-taxonomy"></span>';		}		foreach ( $custom_categories as $category ){			$category_name = $category->name;			$link          = NetsPostsHtmlHelper::create_link( $category->url, $category_name, $open_link_in_new_tab );			$html .= $link;		}		$html .= '</div>';	}}if( $shortcode_mgr->get_boolean( 'show_tags' ) ) {	if ( isset( $the_post['terms'] ) &&	     ! empty( $the_post['terms'] ) ) {		$html .= '<div class="netsposts-terms" style="margin-bottom: 5px; ' . $width . '">';		if( $shortcode_mgr->get_boolean( 'show_tag_icon' ) ){			$html .= '<span class="icon ic-tag"></span>';		}		foreach ( $the_post['terms'] as $term ) {			if( $the_post['post_type'] === 'product' ){				$link = NetsPostsHtmlHelper::create_term_link( $term->term_id, $term->name, $open_link_in_new_tab );			} else {				$link = NetsPostsHtmlHelper::create_term_link( $term->term_id, $term->name, $open_link_in_new_tab );			}			$html .= $link;		}		$html .= '</div>';	}}if( $shortcode_mgr->has_value( 'include_post_meta' ) ){	$meta_keys = $shortcode_mgr->split_array( 'include_post_meta', ',' );	// Remove acf fields from meta	if( $shortcode_mgr->has_value( 'include_acf_fields' ) ){		$acf_fields = $shortcode_mgr->split_array( 'include_acf_fields', ',' );		$meta_keys = array_diff( $meta_keys, $acf_fields );	}	$text = apply_filters( 'netsposts_get_meta_html', $the_post, $meta_keys );	$html .= '<div class="netsposts-extra-meta">';	if( is_string( $text ) ){		$html .= $text;	}	else{		foreach ($meta_keys as $key){			if( isset( $the_post[$key] ) ) {				$html .= '<span>';				if ( $shortcode_mgr->get_boolean( 'show_meta_label' ) ) {					$html .= '<span class="post-meta-key">' . $key . '</span>: ';				}				$html .= '<span class="post-meta-value">' . $the_post[ $key ] . '</span></span>';			}		}	}	$html .= '</div>';}if( $shortcode_mgr->has_value( 'include_acf_fields' ) ) {	if ( function_exists( 'get_field_objects' ) ) {		$fields = array();		$registered_fields = get_field_objects( $the_post['ID'], array( 'format_value' => true, 'load_value' => true ) );		if( $registered_fields ){			$fields = array_merge( $fields, $registered_fields );		}		$local_fields = netsposts_get_local_fields( $the_post['ID'] );		if( $local_fields ){			$fields = array_merge( $fields, $local_fields );		}		if ( $fields ) {			$fields_result = array();			if ( $shortcode_mgr->get_boolean( 'include_acf_fields' ) ) {				$filter_fields = array_keys( $fields );			} else {				$filter_fields = $shortcode_mgr->split_array( 'include_acf_fields', ',' );			}			if( $shortcode_mgr->has_value( 'add_link_to_acf' ) ){				$add_link_to_acf = $shortcode_mgr->split_array( 'add_link_to_acf', ',' );			}			else{				$add_link_to_acf = array();			}			foreach ( $filter_fields as $name ) {				if ( isset( $fields[ $name ] ) ) {					$field = $fields[ $name ];					if( $field['type'] === 'date_picker' &&						$shortcode_mgr->has_value( 'acf_date_format' ) ){						$date = date_create_from_format( $field['return_format'], $field['value'] );						$value = $date->format( $shortcode_mgr->get( 'acf_date_format' ) );					}					else{						$value = $field['value'];					}					if( in_array( $name, $add_link_to_acf ) ){						$value = NetsPostsHtmlHelper::create_link( $the_post['guid'], $value );					}					$fields_result[ $name ] = array( 'label' => $field['label'], 'value' => $value );				}			}			$text = apply_filters( 'netsposts_get_acf_html', $fields_result, $the_post );			$html .= '<div class="netsposts-acf-fields">';			if ( is_string( $text ) ) {				$html .= $text;			} else {				foreach ( $fields_result as $name => $field ) {					$label = $field['label'];					$value = $field['value'];					if ( is_string( $value ) ) {						if ( $shortcode_mgr->get_boolean( 'hide_acf_labels' ) ) {							$html .= '<span class="acf-value">' . $value . '</span>';						} else {							$html .= '<span><span class="acf-label">' . $label . '</span><span class="acf-label-colon">:</span> <span class="acf-value">' . $value . '</span></span>';						}					} elseif ( is_array( $value ) ) {						$str = '';						if ( is_array( $value[0] ) ) {							$str = join( ', ', $value );						} elseif ( $value[0] instanceof WP_Post ) {							$str = '';							foreach ( $value as $inner_post ) {								$str .= $inner_post->post_title . ', ';							}							$str = mb_substr( $str, 0, - 2 );						}						if ( $shortcode_mgr->get_boolean( 'hide_acf_labels' ) ) {							$html .= '<span>' . $str . '</span>';						} else {							$html .= '<span>' . $name . '<span class="acf-label-colon">:</span> ' . $str . '</span>';						}					}				}			}			$html .= '</div>';		}	}}if( $shortcode_mgr->get_boolean( 'show_rating' ) ) {	if ( ! empty( $the_post['rating'] ) ) {		$html .= '<div class="br-wrapper br-theme-fontawesome-stars">';        $html .= '<div class="br-widget">';		for ( $i = 1; $i <= $the_post['rating']; $i ++ ) {			$html .= '<a class="br-selected"></a>';		}		$html .= '</div>';		$html .= '</div>';	}}