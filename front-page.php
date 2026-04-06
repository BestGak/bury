<?php
	$projects_query = new WP_Query( [
		'post_type'      => 'projects',
		'posts_per_page' => 8,
		'post_status'    => 'publish',
		'orderby'        => 'date',
		'order'          => 'DESC',
	] );
	$faq_title = get_field( 'faq_title' );
	$faq_items = get_field( 'faq' );
?>
<?php get_header(); ?>
		<?= the_content(); ?>

<?php if ( $projects_query->have_posts() ) : ?>
<section class="similar-projects">
    <div class="container">

        <div class="similar-projects__head">
            <div class="similar-projects__title-wrap">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/quote.svg" alt="" aria-hidden="true">
                <h2 class="similar-projects__title"><?php esc_html_e( 'Our commercial projects', 'bury' ); ?></h2>
                <p class="similar-projects__subtitle"><?php esc_html_e( 'Certified drylining contractors delivering commercial interior projects across Manchester', 'bury' ); ?></p>
            </div>
            <div class="similar-projects__nav">
                <button class="similar-projects__btn similar-projects__btn--prev js-home-projects-prev" aria-label="Previous">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="22" viewBox="0 0 14 22" fill="none">
                        <path d="M11.3307 22L14 19.4092L5.33867 11L14 2.59076L11.3307 -1.1668e-07L-4.80825e-07 11L11.3307 22Z" fill="white"/>
                    </svg>
                </button>
                <button class="similar-projects__btn similar-projects__btn--next js-home-projects-next" aria-label="Next">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="22" viewBox="0 0 14 22" fill="none">
                        <path d="M2.66933 -2.02403e-06L-8.48405e-07 2.59076L8.66133 11L-1.13246e-07 19.4092L2.66933 22L14 11L2.66933 -2.02403e-06Z" fill="white"/>
                    </svg>
                </button>
            </div>
        </div>

        <div class="swiper similar-projects__swiper js-home-projects-swiper">
            <div class="swiper-wrapper">
                <?php while ( $projects_query->have_posts() ) : $projects_query->the_post(); ?>
                <div class="swiper-slide">
                    <?php get_template_part( 'template-parts/project', 'card' ); ?>
                </div>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
            <div class="similar-projects__dots swiper-pagination"></div>
        </div>

    </div>
</section>
<?php endif; ?>

<?php if ( $faq_items ) : ?>
<section class="faq-section mb-m">
    <div class="container-l">

        <div class="faq-section__head">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/quote.svg" alt="" aria-hidden="true">
            <h2 class="faq-section__title">
                <?php echo $faq_title ? esc_html( $faq_title ) : esc_html__( 'Frequently asked questions', 'bury' ); ?>
            </h2>
        </div>

        <div class="faq-section__list" itemscope itemtype="https://schema.org/FAQPage">
            <?php foreach ( $faq_items as $item ) : ?>
            <div class="faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                <button class="faq-item__trigger" aria-expanded="false">
                    <span class="faq-item__question" itemprop="name"><?php echo esc_html( $item['faq_ask'] ); ?></span>
                    <span class="faq-item__icon" aria-hidden="true">
					<svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 10 10" fill="none">
						<path d="M0.587923 0L0.587923 1.66282L7.16101 1.66282L0 8.82439L1.17585 10.0002L8.33852 2.84033L8.33852 9.41286H10.0013L10.0013 0L0.588477 0L0.587923 0Z" fill="white"/>
					</svg>
                    </span>
                </button>
                <div class="faq-item__body" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                    <div class="faq-item__answer" itemprop="text"><?php echo wp_kses_post( $item['faq_answer'] ); ?></div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>
<?php endif; ?>

<?php get_footer(); ?>