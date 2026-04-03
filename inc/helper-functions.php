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


//**
// Reviews
//  */


/**
 * Add meta boxes for reviews
 */
add_action( 'add_meta_boxes', 'tyrbota_reviews_meta_boxes' );
function tyrbota_reviews_meta_boxes() {
    add_meta_box(
        'review_details',
        __( 'Деталі відгуку', 'tyrbota' ),
        'tyrbota_review_details_callback',
        'reviews',
        'normal',
        'high'
    );
}

function tyrbota_review_details_callback( $post ) {
    wp_nonce_field( 'tyrbota_save_review', 'tyrbota_review_nonce' );
    
    $author_name = get_post_meta( $post->ID, '_review_author_name', true );
    $author_email = get_post_meta( $post->ID, '_review_author_email', true );
    $rating = get_post_meta( $post->ID, '_review_rating', true );
    $page_id = get_post_meta( $post->ID, '_review_page_id', true );
    ?>
    
    <table class="form-table">
        <tr>
            <th><label for="review_author_name"><?php _e( 'Ім\'я автора', 'tyrbota' ); ?></label></th>
            <td>
                <input type="text" id="review_author_name" name="review_author_name" value="<?php echo esc_attr( $author_name ); ?>" class="regular-text">
            </td>
        </tr>
        <tr>
            <th><label for="review_author_email"><?php _e( 'Email автора', 'tyrbota' ); ?></label></th>
            <td>
                <input type="email" id="review_author_email" name="review_author_email" value="<?php echo esc_attr( $author_email ); ?>" class="regular-text">
            </td>
        </tr>
        <tr>
            <th><label for="review_rating"><?php _e( 'Оцінка', 'tyrbota' ); ?></label></th>
            <td>
                <select id="review_rating" name="review_rating">
                    <option value="5" <?php selected( $rating, 5 ); ?>>5 зірок</option>
                    <option value="4" <?php selected( $rating, 4 ); ?>>4 зірки</option>
                    <option value="3" <?php selected( $rating, 3 ); ?>>3 зірки</option>
                    <option value="2" <?php selected( $rating, 2 ); ?>>2 зірки</option>
                    <option value="1" <?php selected( $rating, 1 ); ?>>1 зірка</option>
                </select>
            </td>
        </tr>
        <tr>
            <th><label for="review_page_id"><?php _e( 'Прив\'язка', 'tyrbota' ); ?></label></th>
            <td>
                <?php
                $pansionats = get_posts( array(
                    'post_type'      => 'pansionat',
                    'post_status'    => 'publish',
                    'posts_per_page' => -1,
                    'orderby'        => 'title',
                    'order'          => 'ASC',
                ) );
                $pages = get_posts( array(
                    'post_type'      => 'page',
                    'post_status'    => 'publish',
                    'posts_per_page' => -1,
                    'orderby'        => 'title',
                    'order'          => 'ASC',
                ) );
                ?>
                <select name="review_page_id" id="review_page_id">
                    <option value="0"><?php _e( '— Загальний відгук —', 'tyrbota' ); ?></option>
                    <?php if ( $pansionats ) : ?>
                    <optgroup label="<?php esc_attr_e( 'Пансіонати', 'tyrbota' ); ?>">
                        <?php foreach ( $pansionats as $p ) : ?>
                        <option value="<?php echo $p->ID; ?>" <?php selected( $page_id, $p->ID ); ?>>
                            <?php echo esc_html( $p->post_title ); ?>
                        </option>
                        <?php endforeach; ?>
                    </optgroup>
                    <?php endif; ?>
                    <?php if ( $pages ) : ?>
                    <optgroup label="<?php esc_attr_e( 'Сторінки', 'tyrbota' ); ?>">
                        <?php foreach ( $pages as $p ) : ?>
                        <option value="<?php echo $p->ID; ?>" <?php selected( $page_id, $p->ID ); ?>>
                            <?php echo esc_html( $p->post_title ); ?>
                        </option>
                        <?php endforeach; ?>
                    </optgroup>
                    <?php endif; ?>
                </select>
                <p class="description"><?php _e( 'Пансіонат або сторінка, до якої прив\'язаний цей відгук', 'tyrbota' ); ?></p>
            </td>
        </tr>
    </table>
    <?php
}

/**
 * Save review meta
 */
add_action( 'save_post_reviews', 'tyrbota_save_review_meta' );
function tyrbota_save_review_meta( $post_id ) {
    if ( ! isset( $_POST['tyrbota_review_nonce'] ) || ! wp_verify_nonce( $_POST['tyrbota_review_nonce'], 'tyrbota_save_review' ) ) {
        return;
    }

    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    if ( isset( $_POST['review_author_name'] ) ) {
        update_post_meta( $post_id, '_review_author_name', sanitize_text_field( $_POST['review_author_name'] ) );
    }

    if ( isset( $_POST['review_author_email'] ) ) {
        update_post_meta( $post_id, '_review_author_email', sanitize_email( $_POST['review_author_email'] ) );
    }

    if ( isset( $_POST['review_rating'] ) ) {
        update_post_meta( $post_id, '_review_rating', absint( $_POST['review_rating'] ) );
    }

    if ( isset( $_POST['review_page_id'] ) ) {
        update_post_meta( $post_id, '_review_page_id', absint( $_POST['review_page_id'] ) );
    }
}

/**
 * Modify reviews columns in admin
 */
add_filter( 'manage_reviews_posts_columns', 'tyrbota_reviews_columns' );
function tyrbota_reviews_columns( $columns ) {
    $new_columns = array();
    $new_columns['cb'] = $columns['cb'];
    $new_columns['title'] = __( 'Автор', 'tyrbota' );
    $new_columns['rating'] = __( 'Оцінка', 'tyrbota' );
    $new_columns['page'] = __( 'Сторінка', 'tyrbota' );
    $new_columns['date'] = $columns['date'];
    
    return $new_columns;
}

add_action( 'manage_reviews_posts_custom_column', 'tyrbota_reviews_column_content', 10, 2 );
function tyrbota_reviews_column_content( $column, $post_id ) {
    switch ( $column ) {
        case 'rating':
            $rating = get_post_meta( $post_id, '_review_rating', true );
            if ( $rating ) {
                echo str_repeat( '⭐', absint( $rating ) );
            }
            break;
            
        case 'page':
            $page_id = get_post_meta( $post_id, '_review_page_id', true );
            if ( $page_id ) {
                echo '<a href="' . get_edit_post_link( $page_id ) . '">' . get_the_title( $page_id ) . '</a>';
            } else {
                echo '—';
            }
            break;
    }
}


/**
 * AJAX handler for submitting reviews
 */
add_action( 'wp_ajax_submit_review', 'tyrbota_submit_review_ajax' );
add_action( 'wp_ajax_nopriv_submit_review', 'tyrbota_submit_review_ajax' );

function tyrbota_submit_review_ajax() {
    // 1. Verify nonce - защита от CSRF
    if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'submit_review_nonce' ) ) {
        wp_send_json_error( array( 'message' => __( 'Помилка безпеки', 'tyrbota' ) ) );
    }

    // 2. Honeypot защита от спама
    // if ( ! empty( $_POST['website'] ) ) {
    //     wp_send_json_error( array( 'message' => __( 'Помилка відправки', 'tyrbota' ) ) );
    // }

    // 3. Rate limiting - защита от флуда
    $user_ip = isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( $_SERVER['REMOTE_ADDR'] ) : '';
    $transient_key = 'review_submit_' . md5( $user_ip );
    
    if ( get_transient( $transient_key ) ) {
        wp_send_json_error( array( 'message' => __( 'Зачекайте 5 хвилин перед наступним відгуком', 'tyrbota' ) ) );
    }

    // 4. Усиленная санитизация данных - защита от XSS и SQL injection
    $author_name = isset( $_POST['author_name'] ) ? wp_strip_all_tags( sanitize_text_field( $_POST['author_name'] ) ) : '';
    $author_email = isset( $_POST['author_email'] ) ? sanitize_email( $_POST['author_email'] ) : '';
    $review_text = isset( $_POST['review_text'] ) ? wp_kses_post( sanitize_textarea_field( $_POST['review_text'] ) ) : '';
    $rating = isset( $_POST['rating'] ) ? absint( $_POST['rating'] ) : 0;
    $page_id = isset( $_POST['page_id'] ) ? absint( $_POST['page_id'] ) : 0;

    // 5. Дополнительная очистка - убираем все HTML теги
    $author_name = strip_tags( $author_name );
    $review_text = strip_tags( $review_text );

    // 6. Базовая валидация
    if ( empty( $author_name ) || empty( $author_email ) || empty( $review_text ) || $rating < 1 || $rating > 5 ) {
        wp_send_json_error( array( 'message' => __( 'Будь ласка, заповніть всі поля', 'tyrbota' ) ) );
    }

    if ( ! is_email( $author_email ) ) {
        wp_send_json_error( array( 'message' => __( 'Невірний email', 'tyrbota' ) ) );
    }

    // 7. Ограничение длины - защита от перегрузки БД
    if ( mb_strlen( $review_text ) > 1000 ) {
        wp_send_json_error( array( 'message' => __( 'Текст відгуку занадто довгий (максимум 1000 символів)', 'tyrbota' ) ) );
    }
    
    if ( mb_strlen( $author_name ) > 100 ) {
        wp_send_json_error( array( 'message' => __( 'Ім\'я занадто довге (максимум 100 символів)', 'tyrbota' ) ) );
    }

    if ( mb_strlen( $review_text ) < 10 ) {
        wp_send_json_error( array( 'message' => __( 'Текст відгуку занадто короткий (мінімум 10 символів)', 'tyrbota' ) ) );
    }

    // 8. Фильтр спам-слов
    $spam_words = array( 'viagra', 'cialis', 'casino', 'porn', 'xxx', 'sex', 'bet', 'gambling' );
    $check_text = strtolower( $review_text . ' ' . $author_name );
    
    foreach ( $spam_words as $word ) {
        if ( strpos( $check_text, $word ) !== false ) {
            wp_send_json_error( array( 'message' => __( 'Підозрілий контент виявлено', 'tyrbota' ) ) );
        }
    }

    // 9. Проверка на SQL команды (дополнительная защита)
    $dangerous_patterns = array(
        '/(\bSELECT\b|\bUNION\b|\bDROP\b|\bINSERT\b|\bUPDATE\b|\bDELETE\b|\bEXEC\b|\bSCRIPT\b)/i',
        '/--/',
        '/\/\*/',
        '/<script/i',
        '/<iframe/i',
        '/javascript:/i',
        '/on\w+\s*=/i', // onclick=, onload= и т.д.
    );
    
    $all_data = $author_name . ' ' . $review_text . ' ' . $author_email;
    
    foreach ( $dangerous_patterns as $pattern ) {
        if ( preg_match( $pattern, $all_data ) ) {
            wp_send_json_error( array( 'message' => __( 'Заборонені символи в тексті', 'tyrbota' ) ) );
        }
    }

    // 10. Проверка количества ссылок (защита от спама)
    if ( substr_count( $review_text, 'http' ) > 2 ) {
        wp_send_json_error( array( 'message' => __( 'Занадто багато посилань у відгуку', 'tyrbota' ) ) );
    }

    // 11. Создаем отзыв (WordPress использует prepared statements - защита от SQL injection)
    $review_data = array(
        'post_title'    => $author_name,
        'post_content'  => $review_text,
        'post_type'     => 'reviews',
        'post_status'   => 'pending', // Требует одобрения админа - последний рубеж защиты
        'meta_input'    => array(
            '_review_author_name'  => $author_name,
            '_review_author_email' => $author_email,
            '_review_rating'       => $rating,
            '_review_page_id'      => $page_id,
            '_review_ip'           => $user_ip,
            '_review_user_agent'   => isset( $_SERVER['HTTP_USER_AGENT'] ) ? sanitize_text_field( $_SERVER['HTTP_USER_AGENT'] ) : '',
            '_review_date'         => current_time( 'mysql' ),
        ),
    );

    $review_id = wp_insert_post( $review_data );

    if ( is_wp_error( $review_id ) ) {
        wp_send_json_error( array( 'message' => __( 'Помилка при збереженні відгуку', 'tyrbota' ) ) );
    }

    // 12. Устанавливаем блокировку на 5 минут для этого IP
    set_transient( $transient_key, true, 5 * MINUTE_IN_SECONDS );

    // 13. Отправляем уведомление админу
    tyrbota_send_review_notification( $review_id, $author_name, $rating );

    wp_send_json_success( array( 
        'message' => __( 'Дякуємо! Ваш відгук буде опублікований після модерації', 'tyrbota' ) 
    ) );
}

/**
 * Send email notification to admin about new review
 */
function tyrbota_send_review_notification( $review_id, $author_name, $rating ) {
    $admin_email = get_option( 'admin_email' );
    $subject = sprintf( __( '[%s] Новий відгук очікує на модерацію', 'tyrbota' ), get_bloginfo( 'name' ) );
    
    $message = sprintf(
        __( "Новий відгук від: %s\n\nОцінка: %d/5\n\nПереглянути та затвердити:\n%s", 'tyrbota' ),
        $author_name,
        $rating,
        admin_url( 'post.php?post=' . $review_id . '&action=edit' )
    );
    
    wp_mail( $admin_email, $subject, $message );
}


/**
 * Get average rating for a page
 */
function tyrbota_get_average_rating( $page_id = 0 ) {
    $args = array(
        'post_type'      => 'reviews',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        'meta_query'     => array(
            array(
                'key'   => '_review_page_id',
                'value' => $page_id,
            ),
        ),
    );

    $reviews = get_posts( $args );
    
    if ( empty( $reviews ) ) {
        return 0;
    }

    $total = 0;
    foreach ( $reviews as $review ) {
        $rating = get_post_meta( $review->ID, '_review_rating', true );
        $total += absint( $rating );
    }

    return round( $total / count( $reviews ), 1 );
}

/**
 * Get reviews count for a page
 */
function tyrbota_get_reviews_count( $page_id = 0 ) {
    $args = array(
        'post_type'      => 'reviews',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        'meta_query'     => array(
            array(
                'key'   => '_review_page_id',
                'value' => $page_id,
            ),
        ),
    );

    $reviews = get_posts( $args );
    return count( $reviews );
}

/**
 * Render single review slide HTML (shared by PHP template & AJAX)
 */
if ( ! function_exists( 'tyrbota_review_slide_html' ) ) :
function tyrbota_review_slide_html( $author, $rating, $content, $date ) {
    $rating    = max( 1, min( 5, (int) $rating ) );
    $star_path = 'M6.81848 0.464826C7.10441 -0.155071 7.98544 -0.155073 8.27137 0.464824L9.89659 3.98831C10.0131 4.24095 10.2526 4.41491 10.5288 4.44766L14.3821 4.90453C15.06 4.98491 15.3323 5.82282 14.8311 6.28631L11.9823 8.92081C11.778 9.10971 11.6865 9.39117 11.7408 9.66407L12.497 13.4699C12.63 14.1395 11.9173 14.6573 11.3216 14.3239L7.93568 12.4286C7.6929 12.2927 7.39695 12.2927 7.15417 12.4286L3.76829 14.3239C3.1726 14.6573 2.45983 14.1395 2.59287 13.4699L3.34909 9.66407C3.40331 9.39117 3.31186 9.10971 3.10759 8.92081L0.25878 6.28631C-0.24242 5.82282 0.0298321 4.98491 0.707747 4.90453L4.561 4.44766C4.83729 4.41491 5.07672 4.24095 5.19325 3.98831L6.81848 0.464826Z';
    $stars_html = '<div class="rating">';
    for ( $i = 1; $i <= 5; $i++ ) {
        $fill = $i <= $rating ? '#FFB700' : '#D9D9D9';
        $stars_html .= '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="15" viewBox="0 0 16 15" fill="none"><path d="' . $star_path . '" fill="' . $fill . '"/></svg>';
    }
    $stars_html .= '</div>';
    return sprintf(
        '<div class="swiper-slide reviews__slide">
            <div class="reviews__slide__top">
                <div class="reviews__slide__name">%s</div>
                %s
            </div>
            <div class="reviews__slide__content">
                <p>%s</p>
            </div>
            <div class="reviews__slide__info">
                <div class="reviews__slide__date">%s</div>
            </div>
        </div>',
        esc_html( $author ),
        $stars_html,
        nl2br( esc_html( $content ) ),
        esc_html( $date )
    );
}
endif;

/**
 * AJAX: Load more reviews for pansionat
 */
add_action( 'wp_ajax_load_pansionat_reviews', 'tyrbota_load_pansionat_reviews_ajax' );
add_action( 'wp_ajax_nopriv_load_pansionat_reviews', 'tyrbota_load_pansionat_reviews_ajax' );

function tyrbota_load_pansionat_reviews_ajax() {
    if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'load_reviews_nonce' ) ) {
        wp_send_json_error( array( 'message' => __( 'Помилка безпеки', 'tyrbota' ) ) );
    }

    $post_id  = absint( $_POST['post_id'] ?? 0 );
    $offset   = absint( $_POST['offset'] ?? 0 );
    $per_page = 10;

    if ( ! $post_id ) {
        wp_send_json_error( array( 'message' => 'Invalid post ID' ) );
    }

    $reviews = get_posts( array(
        'post_type'      => 'reviews',
        'post_status'    => 'publish',
        'posts_per_page' => $per_page,
        'offset'         => $offset,
        'orderby'        => 'date',
        'order'          => 'DESC',
        'meta_query'     => array( array(
            'key'   => '_review_page_id',
            'value' => $post_id,
        ) ),
    ) );

    $html = '';
    foreach ( $reviews as $review ) {
        $author      = get_post_meta( $review->ID, '_review_author_name', true ) ?: $review->post_title;
        $rating      = (int) get_post_meta( $review->ID, '_review_rating', true );
        $review_date = get_post_meta( $review->ID, '_review_date', true );
        $date_fmt    = $review_date
            ? date_i18n( 'd.m.Y', strtotime( $review_date ) )
            : date_i18n( 'd.m.Y', strtotime( $review->post_date ) );
        $html .= tyrbota_review_slide_html( $author, $rating, $review->post_content, $date_fmt );
    }

    $total  = tyrbota_get_reviews_count( $post_id );
    $loaded = $offset + count( $reviews );

    wp_send_json_success( array(
        'html'      => $html,
        'has_more'  => $loaded < $total,
        'remaining' => max( 0, $total - $loaded ),
        'loaded'    => $loaded,
    ) );
}
