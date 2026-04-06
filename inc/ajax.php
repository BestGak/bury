<?php

add_action( 'wp_ajax_get_projects', 'bury_ajax_get_projects' );
add_action( 'wp_ajax_nopriv_get_projects', 'bury_ajax_get_projects' );

function bury_ajax_get_projects() {
    check_ajax_referer( 'bury_ajax_nonce', 'nonce' );

    $per_page = 9;
    $paged    = isset( $_POST['paged'] ) ? absint( $_POST['paged'] ) : 1;
    $term_id  = isset( $_POST['cat'] )   ? absint( $_POST['cat'] )   : 0;

    $args = [
        'post_type'      => 'projects',
        'posts_per_page' => $per_page,
        'paged'          => $paged,
        'post_status'    => 'publish',
    ];

    if ( $term_id ) {
        $args['tax_query'] = [ [
            'taxonomy' => 'project_category',
            'field'    => 'term_id',
            'terms'    => $term_id,
        ] ];
    }

    $query       = new WP_Query( $args );
    $total_pages = $query->max_num_pages;

    ob_start();
    if ( $query->have_posts() ) :
        while ( $query->have_posts() ) : $query->the_post();
            get_template_part( 'template-parts/project', 'card' );
        endwhile;
        wp_reset_postdata();
    else :
        echo '<p class="projects__empty">' . esc_html__( 'No projects found.', 'bury' ) . '</p>';
    endif;
    $grid_html = ob_get_clean();

    // Build pagination HTML
    ob_start();
    if ( $total_pages > 1 ) :
        $current = max( 1, $paged );

        if ( $current > 1 )
            echo '<button class="projects__page-btn projects__page-arrow" data-page="' . ( $current - 1 ) . '">&#8249;</button>';

        $start = max( 1, $current - 2 );
        $end   = min( $total_pages, $current + 2 );

        if ( $start > 1 ) {
            echo '<button class="projects__page-btn" data-page="1">1</button>';
            if ( $start > 2 ) echo '<span class="projects__page-dots">...</span>';
        }
        for ( $i = $start; $i <= $end; $i++ ) {
            $a = $i === $current ? ' is-active' : '';
            echo '<button class="projects__page-btn' . $a . '" data-page="' . $i . '">' . $i . '</button>';
        }
        if ( $end < $total_pages ) {
            if ( $end < $total_pages - 1 ) echo '<span class="projects__page-dots">...</span>';
            echo '<button class="projects__page-btn" data-page="' . $total_pages . '">' . $total_pages . '</button>';
        }

        if ( $current < $total_pages )
            echo '<button class="projects__page-btn projects__page-arrow" data-page="' . ( $current + 1 ) . '">&#8250;</button>';
    endif;
    $pagination_html = ob_get_clean();

    wp_send_json_success( [
        'grid'       => $grid_html,
        'pagination' => $pagination_html,
        'pages'      => $total_pages,
    ] );
}
