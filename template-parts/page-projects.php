<?php
/*
 * Template Name: Страница проектов
 * Description: Это моя кастомная страница проектов
 * Author: Misha Kushnirenko
 * Version: 1.0
 */
include BURY_REQUIRE_DIRECTORY . '/template-parts/content-variables.php';

$per_page = 9;
$paged    = isset( $_GET['paged'] ) ? absint( $_GET['paged'] ) : 1;
$term_id  = isset( $_GET['cat'] ) ? absint( $_GET['cat'] ) : 0;

$categories = get_terms( [
    'taxonomy'   => 'project_category',
    'hide_empty' => true,
] );

$query_args = [
    'post_type'      => 'projects',
    'posts_per_page' => $per_page,
    'paged'          => $paged,
    'post_status'    => 'publish',
];

if ( $term_id ) {
    $query_args['tax_query'] = [ [
        'taxonomy' => 'project_category',
        'field'    => 'term_id',
        'terms'    => $term_id,
    ] ];
}

$projects_query = new WP_Query( $query_args );
$total_pages    = $projects_query->max_num_pages;
$all_count      = wp_count_posts( 'projects' )->publish;
?>
<?php get_header(); ?>
    <?php get_template_part( 'template-parts/content', 'breadcrumbs', array( 'without_bg' => false ) ); ?>

    <section class="projects">
        <div class="container">

            <!-- TABS -->
            <div class="projects__tabs" id="projects-tabs">
                <button class="projects__tab<?php echo ! $term_id ? ' is-active' : ''; ?>" data-cat="0">
                    <span class="projects__tab-count"><?php echo $all_count; ?></span>
                    <?= __( 'All projects', 'bury' ) ?>
                </button>
                <?php if ( ! is_wp_error( $categories ) ) : foreach ( $categories as $cat ) : ?>
                <button class="projects__tab<?php echo ( $term_id === (int) $cat->term_id ) ? ' is-active' : ''; ?>" data-cat="<?php echo $cat->term_id; ?>">
                    <span class="projects__tab-count"><?php echo $cat->count; ?></span>
                    <?php echo esc_html( $cat->name ); ?>
                </button>
                <?php endforeach; endif; ?>
            </div>

            <!-- GRID -->
            <div class="projects__grid" id="projects-grid">
                <?php if ( $projects_query->have_posts() ) : while ( $projects_query->have_posts() ) : $projects_query->the_post(); ?>
                    <?php get_template_part( 'template-parts/project', 'card' ); ?>
                <?php endwhile; wp_reset_postdata(); else : ?>
                    <p class="projects__empty"><?= __( 'No projects found.', 'bury' ) ?></p>
                <?php endif; ?>
            </div>

            <!-- PAGINATION -->
            <?php if ( $total_pages > 1 ) : ?>
            <nav class="projects__pagination" id="projects-pagination">
                <?php
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
                ?>
            </nav>
            <?php endif; ?>

        </div>
    </section>

<?php get_footer(); ?>
