<?php

/**
 * Start Settings
 */
if ( ! function_exists( 'main_setup' ) ) :
    function main_setup() {
      /**
       * Enable support for Post Thumbnails on posts and pages.
       * @link //developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
       */
      add_theme_support( 'post-thumbnails' );
    }
    endif;
    add_action( 'after_setup_theme', 'main_setup' );

   


    /**
     * Add svg uploads
     */
  function svg_upload_allow( $mimes ) {
    $mimes['svg']  = 'image/svg+xml';

    return $mimes;
  }

  add_filter( 'wp_check_filetype_and_ext', 'fix_svg_mime_type', 10, 5 );

  function fix_svg_mime_type( $data, $file, $filename, $mimes, $real_mime = '' ){

    if( version_compare( $GLOBALS['wp_version'], '5.1.0', '>=' ) ){
      $dosvg = in_array( $real_mime, [ 'image/svg', 'image/svg+xml' ] );
    }
    else {
      $dosvg = ( '.svg' === strtolower( substr( $filename, -4 ) ) );
    }

    if( $dosvg ){

      // разрешим
      if( current_user_can('manage_options') ){

        $data['ext']  = 'svg';
        $data['type'] = 'image/svg+xml';
      }
      // запретим
      else {
        $data['ext']  = false;
        $data['type'] = false;
      }

    }

    return $data;
  }

      add_filter( 'upload_mimes', 'svg_upload_allow' );

  /**
   * Register Menus
   */
 function register_my_menus() {
    register_nav_menus(
    array(
     'header-menu' => ( 'Header Menu' ),
     'technical-menu' => ( 'Technical Menu' ),
     'burger-menu' => ( 'Burger Menu' ),
     'aside-menu' => ( 'Aside Menu' ),
     'footer-menu' => ( 'Footer Menu' ),
     'footer-menu-second' => ( 'Footer Menu Second' ),
     'footer-additional' => ( 'Footer Additional (Terms/Privacy)' ),

     )
     );
    }
    add_action( 'init', 'register_my_menus' );

  
 /**
  * Create Additional Settings
  */

if (function_exists('acf_add_options_page')) {

  acf_add_options_page(array(
      'page_title' => 'Дополнительные настройки',
      'menu_title' => 'Дополнительные настройки',
      'menu_slug' => 'theme-general-settings',
      'capability' => 'edit_posts',
      'redirect' => false,
  ));

}

/**
 * Remove p and br from content
 */
add_filter( 'wpcf7_autop_or_not', '__return_false' );


/**
 * Save json acf
 */

add_filter( 'acf/settings/save_json', 'my_acf_json_save_point' );

function my_acf_json_save_point( $path ) {

	// update path
	$path = get_stylesheet_directory() . '/acf-json';

	// return
	return $path;
}

    if(!function_exists('get_url_template')) {
      function get_url_template($template) {
        $page_query = new WP_Query(array(
          'post_type' => 'page', 
          'meta_key' => '_wp_page_template', 
          'meta_value' => $template, 
        ));
      
        if ($page_query->have_posts()) {
          $page_query->the_post();
          $permalink = get_permalink();
          wp_reset_postdata();
          return $permalink;
        }
        
        return '';
      }
    }
    

    /**
     * Add Class to menu
     */
    function add_menu_item_class( $classes, $item, $args ) {
      if ( isset( $args->item_class ) ) {
          $classes[] = $args->item_class;
      }
      return $classes;
  }
  add_filter( 'nav_menu_css_class', 'add_menu_item_class', 10, 3 );



/**
 * Remove default WordPress wpautop
 */
remove_filter( 'the_content', 'wpautop' );
remove_filter( 'the_excerpt', 'wpautop' );
remove_filter( 'widget_text_content', 'wpautop' );

/**
 * ACF Builder output in content()
 */
if(!function_exists('my_the_content_filter')) {
    add_filter('the_content', 'my_the_content_filter', 5);

    function my_the_content_filter($content) {
        if (is_page() || is_single()) {
            ob_start();
            
            if (have_rows('flexible')):
                while (have_rows('flexible')):
                    the_row();
                    get_template_part('template-parts/flexible/'. get_row_layout(), null);
                endwhile;
            endif;
            
            $flexible_content = ob_get_clean();
            
            // Очищаем только flexible content
            $flexible_content = tyrbota_remove_empty_paragraphs($flexible_content);
            
            $content .= $flexible_content;
        }
        
        return $content;
    }
}

/**
 * Custom wpautop - only for regular content, NOT for flexible
 */
function tyrbota_custom_wpautop( $content ) {
    if ( trim( $content ) === '' ) {
        return '';
    }

    // Пропускаем CF7 формы
    if ( strpos( $content, 'wpcf7' ) !== false || has_shortcode( $content, 'contact-form-7' ) ) {
        return do_shortcode( $content );
    }
    
    // Пропускаем контент который уже содержит HTML разметку (из flexible content)
    if ( strpos( $content, '<section' ) !== false || strpos( $content, 'class="' ) !== false ) {
        return $content;
    }

    // Применяем wpautop только к обычному текстовому контенту
    return wpautop( $content );
}

add_filter( 'the_content', 'tyrbota_custom_wpautop', 10 );
add_filter( 'the_excerpt', 'tyrbota_custom_wpautop', 10 );
add_filter( 'widget_text_content', 'tyrbota_custom_wpautop', 10 );

/**
 * Remove empty paragraphs from content (final cleanup)
 */
function tyrbota_remove_empty_paragraphs( $content ) {
    // Удаляем пустые параграфы
    $content = preg_replace( '/<p>(\s|&nbsp;|<br\s*\/?>)*<\/p>/i', '', $content );
    $content = preg_replace( '/<p>\s*<\/p>/i', '', $content );
    
    // Удаляем множественные <br> (больше 2х подряд)
    $content = preg_replace( '/(<br\s*\/?>\s*){3,}/i', '<br><br>', $content );
    
    // Удаляем пробелы между тегами (осторожно!)
    $content = preg_replace( '/>\s+</i', '><', $content );
    
    return trim( $content );
}

// Применяем в самом конце с высоким приоритетом
add_filter( 'the_content', 'tyrbota_remove_empty_paragraphs', 999 );

/**
 * Remove auto <p> and <br> tags from Contact Form 7
 */
add_filter( 'wpcf7_autop_or_not', '__return_false' );

/**
 * Custom Yoast breadcrumb home icon
 */
add_filter( 'wpseo_breadcrumb_links', 'tyrbota_custom_yoast_home_icon' );
function tyrbota_custom_yoast_home_icon( $links ) {
    if ( isset( $links[0] ) && isset( $links[0]['url'] ) ) {
        $links[0]['text'] = '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
            <path d="M16.7002 14.0425V8.49445C16.7002 7.96015 16.6997 7.69285 16.6348 7.44415C16.5772 7.22385 16.4827 7.01531 16.3548 6.82688C16.2104 6.61425 16.0098 6.43793 15.6076 6.08606L10.8076 1.88606C10.061 1.23278 9.6877 0.906301 9.2676 0.782061C8.8974 0.672581 8.5028 0.672581 8.1326 0.782061C7.7128 0.906211 7.33999 1.23238 6.59455 1.88467L1.79297 6.08607C1.39084 6.43793 1.19024 6.61425 1.0459 6.82688C0.917985 7.01531 0.822745 7.22385 0.765165 7.44415C0.700195 7.69285 0.700195 7.96015 0.700195 8.49445V14.0425C0.700195 14.9743 0.700195 15.4401 0.852435 15.8076C1.05543 16.2977 1.44452 16.6875 1.93458 16.8905C2.30212 17.0427 2.76806 17.0428 3.69994 17.0428C4.63183 17.0428 5.09828 17.0427 5.46582 16.8905C5.95588 16.6875 6.34487 16.2978 6.54786 15.8077C6.7001 15.4402 6.7002 14.9742 6.7002 14.0424V13.0424C6.7002 11.9378 7.5956 11.0424 8.7002 11.0424C9.8048 11.0424 10.7002 11.9378 10.7002 13.0424V14.0424C10.7002 14.9742 10.7002 15.4402 10.8524 15.8077C11.0554 16.2978 11.4445 16.6875 11.9346 16.8905C12.3021 17.0427 12.7681 17.0428 13.6999 17.0428C14.6318 17.0428 15.0983 17.0427 15.4658 16.8905C15.9559 16.6875 16.3449 16.2977 16.5479 15.8076C16.7001 15.4401 16.7002 14.9743 16.7002 14.0425Z" stroke="#1c2a46" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>';
    }
    return $links;
}

/**
 * Custom Yoast breadcrumb separator
 */
add_filter( 'wpseo_breadcrumb_separator', 'tyrbota_custom_breadcrumb_separator' );
function tyrbota_custom_breadcrumb_separator() {
    return '<span class="breadcrumb-separator"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
        <path d="M10 8L14 12L10 16" stroke="#1c2a46" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
    </svg></span>';
}
/**
 * Generate fallback breadcrumbs if Yoast is not available
 */
function bury_fallback_breadcrumbs() {
    global $post;
    
    $home_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
        <path d="M16.7002 14.0425V8.49445C16.7002 7.96015 16.6997 7.69285 16.6348 7.44415C16.5772 7.22385 16.4827 7.01531 16.3548 6.82688C16.2104 6.61425 16.0098 6.43793 15.6076 6.08606L10.8076 1.88606C10.061 1.23278 9.6877 0.906301 9.2676 0.782061C8.8974 0.672581 8.5028 0.672581 8.1326 0.782061C7.7128 0.906211 7.33999 1.23238 6.59455 1.88467L1.79297 6.08607C1.39084 6.43793 1.19024 6.61425 1.0459 6.82688C0.917985 7.01531 0.822745 7.22385 0.765165 7.44415C0.700195 7.69285 0.700195 7.96015 0.700195 8.49445V14.0425C0.700195 14.9743 0.700195 15.4401 0.852435 15.8076C1.05543 16.2977 1.44452 16.6875 1.93458 16.8905C2.30212 17.0427 2.76806 17.0428 3.69994 17.0428C4.63183 17.0428 5.09828 17.0427 5.46582 16.8905C5.95588 16.6875 6.34487 16.2978 6.54786 15.8077C6.7001 15.4402 6.7002 14.9742 6.7002 14.0424V13.0424C6.7002 11.9378 7.5956 11.0424 8.7002 11.0424C9.8048 11.0424 10.7002 11.9378 10.7002 13.0424V14.0424C10.7002 14.9742 10.7002 15.4402 10.8524 15.8077C11.0554 16.2978 11.4445 16.6875 11.9346 16.8905C12.3021 17.0427 12.7681 17.0428 13.6999 17.0428C14.6318 17.0428 15.0983 17.0427 15.4658 16.8905C15.9559 16.6875 16.3449 16.2977 16.5479 15.8076C16.7001 15.4401 16.7002 14.9743 16.7002 14.0425Z" stroke="#1c2a46" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>';
    
    $separator = '<span class="breadcrumb-separator"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
        <path d="M10 8L14 12L10 16" stroke="#1c2a46" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
    </svg></span>';
    
    $output = '<a href="' . home_url('/') . '">' . $home_icon . '</a>';
    
    if ( is_home() ) {
        return $output;
    }
            var_dump('test');

    if ( is_singular( 'services' ) ) {
        $services_page_url = get_url_template( 'template-parts/page-services.php' );
        if ( $services_page_url ) {
            $output .= $separator . '<a href="' . esc_url( $services_page_url ) . '">' . __( 'Послуги', 'tyrbota' ) . '</a>';
        }
        
        if ( $post->post_parent ) {
            $parent_id = $post->post_parent;
            $breadcrumbs = array();
            while ( $parent_id ) {
                $page = get_post( $parent_id );
                $breadcrumbs[] = '<a href="' . get_permalink( $page->ID ) . '">' . get_the_title( $page->ID ) . '</a>';
                $parent_id = $page->post_parent;
            }
            $breadcrumbs = array_reverse( $breadcrumbs );
            foreach ( $breadcrumbs as $crumb ) {
                $output .= $separator . $crumb;
            }
        }
        
        $output .= $separator . '<span>' . get_the_title() . '</span>';
    }
    elseif ( is_category() || is_single() ) {
        $category = get_the_category();
        if ( $category ) {
            $output .= $separator . '<a href="' . get_category_link( $category[0]->term_id ) . '">' . $category[0]->name . '</a>';
        }
        
        if ( is_single() ) {
            $output .= $separator . '<span>' . get_the_title() . '</span>';
        }
    }
    elseif ( is_page() ) {
        if ( $post->post_parent ) {
            $parent_id = $post->post_parent;
            $breadcrumbs = array();
            while ( $parent_id ) {
                $page = get_post( $parent_id );
                $breadcrumbs[] = '<a href="' . get_permalink( $page->ID ) . '">' . get_the_title( $page->ID ) . '</a>';
                $parent_id = $page->post_parent;
            }
            $breadcrumbs = array_reverse( $breadcrumbs );
            foreach ( $breadcrumbs as $crumb ) {
                $output .= $separator . $crumb;
            }
        }
        $output .= $separator . '<span>' . get_the_title() . '</span>';
    }
    elseif ( is_archive() ) {
        $output .= $separator . '<span>' . post_type_archive_title( '', false ) . '</span>';
    }
    elseif ( is_search() ) {
        $output .= $separator . '<span>' . __( 'Результати пошуку для: ', 'tyrbota' ) . get_search_query() . '</span>';
    }
    elseif ( is_404() ) {
        $output .= $separator . '<span>' . __( 'Сторінка не знайдена', 'tyrbota' ) . '</span>';
    }
    
    return $output;
}

/**
 * Add custom breadcrumb for Services CPT in Yoast
 */
add_filter( 'wpseo_breadcrumb_links', 'tyrbota_add_services_breadcrumb' );
function tyrbota_add_services_breadcrumb( $links ) {
    global $post;
    
    if ( is_singular( 'services' ) && isset( $post ) ) {
        $services_page_url = get_url_template( 'template-parts/page-services.php' );
        
        if ( $services_page_url ) {
            $services_crumb = array(
                'url'  => $services_page_url,
                'text' => __( 'Послуги', 'tyrbota' ),
            );
            
            array_splice( $links, 1, 0, array( $services_crumb ) );
        }
    }
    
    return $links;
}

/**
 * Calculate reading time for post
 */
function tyrbota_get_reading_time( $post_id = null ) {
	if ( ! $post_id ) {
		$post_id = get_the_ID();
	}
	
	$content = get_post_field( 'post_content', $post_id );
	$content = strip_tags( $content );
	$content = strip_shortcodes( $content );
	
	$word_count = count( preg_split( '/\s+/u', trim( $content ) ) );
	
	$reading_time = ceil( $word_count / 100 );
	
	return max( 1, $reading_time ); 
}

/**
 * Get post views count
 */
function tyrbota_get_post_views( $post_id = null ) {
	if ( ! $post_id ) {
		$post_id = get_the_ID();
	}
	
	$count = get_post_meta( $post_id, 'post_views_count', true );
	
	if ( empty( $count ) ) {
		return 0;
	}
	
	return $count;
}

/**
 * Set post views count
 */
function tyrbota_set_post_views( $post_id = null ) {
	if ( ! $post_id ) {
		$post_id = get_the_ID();
	}
		if ( is_admin() || is_user_logged_in() ) {
		return;
	}
	
	$count = get_post_meta( $post_id, 'post_views_count', true );
	
	if ( empty( $count ) ) {
		$count = 0;
		delete_post_meta( $post_id, 'post_views_count' );
		add_post_meta( $post_id, 'post_views_count', 1 );
	} else {
		$count++;
		update_post_meta( $post_id, 'post_views_count', $count );
	}
}

/**
 * Track post views on single post
 */
add_action( 'wp_head', 'tyrbota_track_post_views' );
function tyrbota_track_post_views() {
	if ( is_single() ) {
		tyrbota_set_post_views();
	}
}

/**
 * Custom posts per page for different archives
 */
add_action( 'pre_get_posts', 'tyrbota_custom_posts_per_page' );
function tyrbota_custom_posts_per_page( $query ) {
    if ( ! is_admin() && $query->is_main_query() ) {
        
        // author
        if ( $query->is_author() ) {
            $query->set( 'posts_per_page', 12 );
        }
        
        // archive
        if ( $query->is_category() ) {
            $query->set( 'posts_per_page', 12 );
        }

        // index.php
        if ( $query->is_home() ) {
            $query->set( 'posts_per_page', 12 );
            $query->set( 'orderby', 'date' );
            $query->set( 'order', 'DESC' );
        }
        
    }
}

/**
 * Custom pagination with custom HTML structure
 */
function tyrbota_custom_pagination( $query = null ) {
    global $wp_query;
    
    if ( $query ) {
        $total_pages = $query->max_num_pages;
    } else {
        $total_pages = $wp_query->max_num_pages;
    }
    
    $current_page = max( 1, get_query_var( 'paged' ) );
    
    if ( $total_pages <= 1 ) {
        return;
    }
    
    $prev_arrow = '<svg xmlns="http://www.w3.org/2000/svg" width="7" height="11" viewBox="0 0 7 11" fill="none">
        <path d="M5.5 1L0.999999 5.5L5.5 10" stroke="#0957C3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>';
    
    $next_arrow = '<svg xmlns="http://www.w3.org/2000/svg" width="7" height="11" viewBox="0 0 7 11" fill="none">
        <path d="M1 10L5.5 5.5L1 1" stroke="#0957C3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>';
    
    echo '<div class="pagination mb-m">';
    
    if ( $current_page > 1 ) {
        echo '<a href="' . get_pagenum_link( $current_page - 1 ) . '" class="pagination__arrow pagination__arrow-prev">' . $prev_arrow . '</a>';
    } else {
        echo '<div class="pagination__arrow pagination__arrow-prev disabled">' . $prev_arrow . '</div>';
    }
    
    echo '<div class="pagination__wrap">';
    
    $range = 2; 
    
    if ( $current_page > $range + 1 ) {
        echo '<a href="' . get_pagenum_link( 1 ) . '"><span>1</span></a>';
        if ( $current_page > $range + 2 ) {
            echo '<span>...</span>';
        }
    }
    
    for ( $i = 1; $i <= $total_pages; $i++ ) {
        if ( $i == $current_page ) {
            echo '<span class="active">' . $i . '</span>';
        } elseif ( $i >= $current_page - $range && $i <= $current_page + $range ) {
            echo '<a href="' . get_pagenum_link( $i ) . '"><span>' . $i . '</span></a>';
        }
    }
    
    if ( $current_page < $total_pages - $range ) {
        if ( $current_page < $total_pages - $range - 1 ) {
            echo '<span>...</span>';
        }
        echo '<a href="' . get_pagenum_link( $total_pages ) . '"><span>' . $total_pages . '</span></a>';
    }
    
    echo '</div>';
    
    if ( $current_page < $total_pages ) {
        echo '<a href="' . get_pagenum_link( $current_page + 1 ) . '" class="pagination__arrow pagination__arrow-next">' . $next_arrow . '</a>';
    } else {
        echo '<div class="pagination__arrow pagination__arrow-next disabled">' . $next_arrow . '</div>';
    }
    
    echo '</div>';
}

//**
// Switcher Language
//  */

/**
 * Display WPML language switcher
 */
function tyrbota_wpml_language_switcher() {
    if ( ! function_exists( 'icl_get_languages' ) ) {
        return;
    }
    
    $languages = icl_get_languages( 'skip_missing=0&orderby=code' );
    
    if ( empty( $languages ) ) {
        return;
    }
    
    $current_lang = ICL_LANGUAGE_CODE;
    $current_language = null;
    $other_languages = array();
    
    foreach ( $languages as $lang ) {
        if ( $lang['active'] ) {
            $current_language = $lang;
        } else {
            $other_languages[] = $lang;
        }
    }
    
    if ( ! $current_language ) {
        return;
    }
    
    ?>
    <div class="lang">
        <div class="lang__current">
            <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 19 19" fill="none">
                <path d="M9.42212 18.6664H9.24478C6.77719 18.643 4.41929 17.6433 2.68684 15.886C0.954394 14.1286 -0.0116162 11.7568 0.00010544 9.28912C0.0118272 6.82143 1.00033 4.45882 2.7494 2.71804C4.49847 0.977266 6.86574 0 9.33345 0C11.8011 0 14.1684 0.977266 15.9175 2.71804C17.6666 4.45882 18.6551 6.82143 18.6668 9.28912C18.6785 11.7568 17.7124 14.1286 15.98 15.886C14.2476 17.6433 11.8897 18.643 9.42212 18.6664ZM8.94378 2.09727C8.68011 2.41578 8.4036 2.92912 8.15393 3.64079C7.72343 4.87164 7.42359 6.55283 7.35242 8.45802H11.4906C11.4206 6.55283 11.1196 4.87164 10.6891 3.64079C10.4406 2.92912 10.1641 2.41578 9.90045 2.09727C9.67412 1.8231 9.52012 1.76477 9.45128 1.75194H9.39995C9.33578 1.7601 9.17828 1.8126 8.94378 2.09727ZM5.60124 8.45802C5.67357 6.39183 5.99791 4.50764 6.50308 3.06329C6.61858 2.73195 6.74575 2.41694 6.88692 2.12294C5.50944 2.57458 4.29007 3.41114 3.37296 4.53377C2.45583 5.6564 1.8793 7.01814 1.71152 8.45802H5.60124ZM1.71152 10.208C1.8793 11.6479 2.45583 13.0097 3.37296 14.1323C4.29007 15.255 5.50944 16.0915 6.88692 16.5431C6.74155 16.2369 6.61302 15.923 6.50191 15.6027C5.99674 14.1584 5.67357 12.2742 5.60124 10.208H1.71152ZM7.35242 10.208C7.42359 12.1132 7.72343 13.7944 8.15393 15.0252C8.4036 15.7369 8.68011 16.2502 8.94378 16.5687C9.17945 16.8534 9.33578 16.9071 9.39995 16.9153L9.45128 16.9141C9.52128 16.9024 9.67295 16.8429 9.90045 16.5687C10.1641 16.2502 10.4406 15.7369 10.6891 15.0252C11.1208 13.7944 11.4195 12.1132 11.4906 10.208H7.35242ZM13.2418 10.208C13.1707 12.2742 12.8463 14.1584 12.3412 15.6027C12.2455 15.8769 12.1417 16.1394 12.0285 16.3891C13.3051 15.8846 14.421 15.0433 15.2573 13.9548C16.0937 12.8664 16.6193 11.5715 16.778 10.208H13.243H13.2418ZM16.778 8.45802C16.6191 7.09459 16.0936 5.79976 15.2572 4.71133C14.4208 3.6229 13.305 2.78159 12.0285 2.27694C12.1417 2.52661 12.2455 2.79028 12.3412 3.06329C12.8463 4.50764 13.1707 6.39183 13.2418 8.45802H16.778Z" fill="white"/>
            </svg>
            <span><?php echo strtoupper( esc_html( $current_language['code'] ) ); ?></span>
        </div>
        
        <?php if ( ! empty( $other_languages ) ) : ?>
            <ul class="lang__dropdown">
                <?php foreach ( $other_languages as $lang ) : ?>
                    <li class="lang__dropdown-item">
                        <a href="<?php echo esc_url( $lang['url'] ); ?>">
                            <?php echo strtoupper( esc_html( $lang['code'] ) ); ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
    <?php
}

/**
 * Add arrow to submit button — replace <input type="submit"> with <button>
 */
add_filter('wpcf7_form_elements', function($html) {
    $svg = '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="10" viewBox="0 0 18 10" fill="none"><path d="M17.21 5.505L18 4.701L17.21 3.897L17.017 3.701L13.382 0L11.955 1.402L14.215 3.7H0V5.7H14.214L11.956 8L13.382 9.402L17.017 5.7L17.21 5.505Z" fill="white"/></svg>';

    $html = preg_replace_callback(
        '/<input([^>]*)type=["\']submit["\']([^>]*)>/i',
        function($matches) use ($svg) {
            $attrs = $matches[1] . $matches[2];
            preg_match('/value=["\']([^"\']*)["\']/', $attrs, $val);
            $label = isset($val[1]) ? $val[1] : '';
            $attrs = preg_replace('/value=["\'][^"\']*["\']/', '', $attrs);
            return '<button type="submit"' . $attrs . '>' . esc_html($label) . ' ' . $svg . '</button>';
        },
        $html
    );

    return $html;
});