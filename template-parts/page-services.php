<?php
/*
 * Template Name: Страница услуг
 * Description: Это моя кастомная страница услуг
 * Author: Misha Kushnirenko
 * Version: 1.0
 */
include BURY_REQUIRE_DIRECTORY . '/template-parts/content-variables.php';

$services_query = new WP_Query( [
    'post_type'      => 'services',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
    'orderby'        => 'date',
    'order'          => 'DESC',
] );
?>
<?php get_header(); ?>
    <?php get_template_part( 'template-parts/content', 'breadcrumbs', array( 'without_bg' => false ) ); ?>

    <?php if ( $services_query->have_posts() ) : ?>
    <section class="services mb-m">
        <div class="container">

            <div class="services__head">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/quote.svg" alt="" aria-hidden="true">
                <h2 class="services__title"><?php echo esc_html( get_the_title() ); ?></h2>
                <p class="services__subtitle"><?= __('Specialist drylining and interior finishing services supporting commercial developments and residential projects across Manchester and Greater Manchester.' , 'bury') ?></p>
            </div>

            <div class="services__grid">
                <?php while ( $services_query->have_posts() ) : $services_query->the_post(); ?>
                <article class="service-card">
                    <?php if ( has_post_thumbnail() ) : ?>
                    <a class="service-card__img-wrap" href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail( 'large', [ 'class' => 'service-card__img', 'alt' => get_the_title() ] ); ?>
                    </a>
                    <?php endif; ?>
                    <div class="service-card__body">
                        <h3 class="service-card__title">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h3>
                        <?php if ( get_the_excerpt() ) : ?>
                        <p class="service-card__excerpt"><?php echo get_the_excerpt(); ?></p>
                        <?php endif; ?>
                        <a href="<?php the_permalink(); ?>" class="btn btn--sm service-card__btn">
                            <?php esc_html_e( 'Learn more', 'bury' ); ?>
                            <span class="btn__icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 10 10" fill="none">
                                    <path d="M0.587923 0L0.587923 1.66282L7.16101 1.66282L0 8.82439L1.17585 10.0002L8.33852 2.84033L8.33852 9.41286H10.0013L10.0013 0L0.588477 0L0.587923 0Z" fill="white"/>
                                </svg>
                            </span>
                        </a>
                    </div>
                </article>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>

        </div>
    </section>
    <?php endif; ?>

<?php get_footer(); ?>
