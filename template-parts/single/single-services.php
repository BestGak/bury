<?php
include BURY_REQUIRE_DIRECTORY . '/template-parts/content-variables.php';
$current_id = get_the_ID();

$projects_query = new WP_Query( [
		'post_type'      => 'projects',
		'posts_per_page' => 6,
		'post_status'    => 'publish',
		'orderby'        => 'date',
		'order'          => 'DESC',
] );

$services_query = new WP_Query( [
    'post_type'      => 'services',
    'posts_per_page' => 6,
    'post_status'    => 'publish',
    'post__not_in'   => [ $current_id ],
    'orderby'        => 'date',
    'order'          => 'DESC',
] );

$content_blocks          = get_field( 'first_content_blocks' );
$services_included_title = get_field( 'services_included_title' ) ?: __( "What's Included", 'bury' );
$services_included       = get_field( 'services_included' );
$last_top_content        = get_field( 'last_top_content' );
$last_right_content      = get_field( 'last_right_content' );
$last_image_content      = get_field( 'last_image_content' );
?>


    
<?php
$thumb_url = has_post_thumbnail()
    ? get_the_post_thumbnail_url( null, 'full' )
    : get_stylesheet_directory_uri() . '/assets/images/services-image.jpg';
?>
<section class="service-hero" style="background-image: linear-gradient(0deg, rgba(0,0,0,0.60) 0%, rgba(0,0,0,0.60) 100%), url('<?php echo esc_url( $thumb_url ); ?>'); background-size: cover; background-position: center;">
    <div class="container-l service-hero__inner">

        <div class="service-hero__left">
            <nav class="service-hero__breadcrumbs">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M3 9.5L12 3l9 6.5V20a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V9.5z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/><path d="M9 21V12h6v9" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/></svg>
                </a>
                <span>›</span>
                <a href="<?php echo esc_url( get_post_type_archive_link( 'services' ) ?: home_url( '/services' ) ); ?>"><?php esc_html_e( 'Services', 'bury' ); ?></a>
                <span class="service-hero__breadcrumbs-current">
                    <span>›</span>
                    <?php the_title(); ?>
                </span>
            </nav>

            <h1 class="service-hero__title"><?php the_title(); ?></h1>

            <?php if ( get_the_excerpt() ) : ?>
            <p class="service-hero__excerpt"><?php echo get_the_excerpt(); ?></p>
            <?php endif; ?>

            <?php if ( $contact_phone ) : ?>
            <a href="tel:<?php echo esc_attr( preg_replace( '/\s+/', '', $contact_phone ) ); ?>" class="service-cta__phone">
                <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="0.5" y="0.5" width="39" height="39" fill="white"/>
                <rect x="0.5" y="0.5" width="39" height="39" stroke="#00C4BE"/>
                <path d="M20.6309 16.6408C20.6405 16.5521 20.6703 16.463 20.7225 16.3892L20.7819 16.3211L20.7828 16.3211C20.8724 16.2391 20.9712 16.1927 21.1052 16.1838C21.1687 16.1796 21.2395 16.1839 21.3204 16.1955L21.5969 16.2514C22.2476 16.4062 22.6964 16.6699 23.0472 17.1143C23.3175 17.4596 23.4677 17.8495 23.5277 18.3382C23.5344 18.3909 23.54 18.4643 23.5426 18.5405L23.5435 18.7586C23.5407 18.857 23.5373 18.9245 23.5261 18.9787C23.5138 19.0384 23.4932 19.0797 23.4643 19.1272L23.4632 19.128C23.2882 19.4065 22.88 19.4511 22.6483 19.2185L22.6061 19.1722C22.568 19.1249 22.5402 19.073 22.5212 19.0055C22.4974 18.9212 22.4887 18.8144 22.4837 18.6674C22.4732 18.3631 22.4198 18.1247 22.3223 17.9347C22.2255 17.7463 22.0825 17.6001 21.8829 17.4846L21.7357 17.4091C21.5817 17.3398 21.4047 17.287 21.17 17.2437L21.1683 17.2435C21.0473 17.2198 20.9544 17.1952 20.8808 17.1568C20.822 17.1261 20.7779 17.0881 20.7408 17.0405L20.7063 16.9904C20.6403 16.8867 20.6181 16.759 20.6309 16.6408Z" fill="#00C4BE" stroke="#00C4BE" stroke-width="0.2"/>
                <path d="M21.0753 13.8838C21.0797 13.8025 21.0987 13.7126 21.1382 13.6495C21.1718 13.5974 21.2232 13.5464 21.2747 13.5067C21.3254 13.4676 21.3854 13.4319 21.4418 13.4155C21.464 13.4091 21.4913 13.4068 21.5151 13.4057C21.541 13.4044 21.5714 13.4037 21.6048 13.4045C21.672 13.406 21.7554 13.4115 21.8433 13.4191C21.931 13.4266 22.025 13.4365 22.115 13.4483L22.363 13.4882C23.1345 13.6456 23.84 13.9694 24.4243 14.4418C25.4623 15.2833 26.0399 16.4792 26.1255 17.9563C26.1433 18.2422 26.1417 18.4449 26.1054 18.5916C26.0868 18.667 26.0589 18.731 26.0171 18.7848C25.9751 18.8387 25.9226 18.8775 25.8633 18.9088L25.8625 18.9078C25.6445 19.0251 25.3942 18.9866 25.2242 18.8084C25.1054 18.6855 25.0695 18.5229 25.0709 18.2828C25.075 17.6489 24.9288 16.9419 24.6947 16.4563L24.6938 16.4562C24.4218 15.8892 24.0016 15.4064 23.4724 15.0532L23.2922 14.9415C22.8573 14.6938 22.3216 14.527 21.8004 14.4813C21.6016 14.4638 21.4531 14.4376 21.3428 14.385C21.225 14.3289 21.1552 14.2458 21.1097 14.132C21.0794 14.0582 21.0708 13.9661 21.0753 13.8838Z" fill="#00C4BE" stroke="#00C4BE" stroke-width="0.2"/>
                <path d="M11.9276 15.9474L11.9286 15.9483C11.9527 15.4404 12.1077 15.0427 12.4027 14.6124L12.5379 14.4249L12.5388 14.424C12.7674 14.1232 13.1176 13.7939 13.4529 13.5243C13.7791 13.2621 14.1717 12.992 14.5004 12.8645C15.1114 12.6278 15.773 12.6617 16.306 13.0953L16.3123 13.1007C16.4057 13.1785 16.5278 13.316 16.6251 13.4279C16.7392 13.5592 16.8764 13.7231 17.0163 13.8948C17.293 14.2345 17.6006 14.6285 17.7843 14.8909L17.7852 14.8927C18.0504 15.274 18.4213 15.8697 18.5749 16.1665L18.5767 16.1701C18.828 16.6632 18.8868 17.198 18.7074 17.726C18.6442 17.9108 18.5634 18.0905 18.3919 18.284C18.2545 18.4389 18.0659 18.5928 17.8366 18.7752L17.513 19.0394C17.4889 19.0592 17.4682 19.0773 17.4499 19.0926L17.4355 19.1214C17.4434 19.1043 17.42 19.1279 17.4472 19.262C17.4766 19.4066 17.5546 19.6231 17.7167 19.9489V19.9508C17.9494 20.4209 18.2471 20.846 18.7092 21.3507L18.7101 21.3524C19.097 21.777 19.5959 22.1971 19.9558 22.4162L19.9568 22.417C20.1888 22.5587 20.463 22.6869 20.7194 22.7785C20.9851 22.8735 21.1744 22.9084 21.2585 22.9101C21.2584 22.9101 21.2683 22.9096 21.2873 22.9065C21.307 22.9034 21.33 22.8979 21.3531 22.8912C21.3649 22.8878 21.3755 22.8846 21.3847 22.8813C21.3988 22.8661 21.4162 22.8477 21.4361 22.8254C21.5028 22.7504 21.5872 22.6501 21.6722 22.5451L21.9805 22.1755C22.0759 22.0676 22.1657 21.9746 22.2537 21.897C22.4604 21.7142 22.6557 21.6159 22.8811 21.5516L22.9793 21.5274C23.4736 21.4231 23.9853 21.6092 24.4352 21.8401L24.4361 21.8393C24.8954 22.0748 25.5375 22.5232 26.0848 22.9516C26.3635 23.1698 26.6311 23.3931 26.852 23.5952C27.0568 23.7827 27.2702 23.9961 27.3964 24.1866L27.4009 24.1938C27.4696 24.3005 27.5652 24.4788 27.6164 24.6283L27.6145 24.6292C27.6678 24.7806 27.6993 24.9455 27.7128 25.0907C27.726 25.2327 27.7287 25.4149 27.6921 25.5874C27.6461 25.8059 27.5506 26.0083 27.427 26.2148C27.3038 26.4209 27.131 26.6668 26.9015 26.9756L26.9006 26.9775C26.7405 27.1917 26.5274 27.4329 26.3309 27.6346C26.1538 27.8162 25.9234 28.0357 25.736 28.1475L25.7305 28.1512C25.3984 28.345 25.0506 28.453 24.6253 28.4351C24.2397 28.4188 23.8258 28.2989 23.3543 28.1277C21.7067 27.529 20.1263 26.6563 18.6109 25.518C15.7019 23.3336 13.5822 20.5769 12.1665 17.1391L12.0475 16.8308C12.0131 16.7315 11.9843 16.6345 11.9637 16.5361C11.9194 16.3241 11.9181 16.1392 11.9276 15.9474Z" fill="#00C4BE"/>
                <path d="M21.4722 11.2381C21.4711 11.0739 21.5427 10.9026 21.6948 10.8025C21.7703 10.752 21.8409 10.723 21.9493 10.7171C21.9993 10.7144 22.0581 10.717 22.1298 10.723L22.3878 10.752C23.6034 10.9043 24.6916 11.2661 25.5877 11.8163C26.2297 12.211 26.6362 12.5681 27.1557 13.1872L27.1566 13.1873C27.7062 13.8476 27.9989 14.3398 28.2873 15.0899C28.5789 15.8518 28.7192 16.5365 28.7498 17.3692L28.7497 17.3701C28.7546 17.5351 28.7526 17.835 28.742 18.0391L28.7419 18.04C28.7311 18.2312 28.7203 18.3572 28.6954 18.4485C28.668 18.5489 28.6239 18.608 28.5586 18.6682C28.4451 18.7744 28.2842 18.8099 28.1386 18.7933C27.9932 18.7767 27.8449 18.706 27.7604 18.5765L27.7595 18.5755C27.7175 18.5093 27.6938 18.4484 27.6829 18.3443C27.6728 18.2472 27.674 18.1077 27.6806 17.8835C27.7184 16.564 27.4523 15.5358 26.8135 14.5064C26.0505 13.2726 24.91 12.4396 23.4217 12.0317C23.0415 11.9277 22.721 11.8645 22.2197 11.7969C21.8962 11.7544 21.803 11.735 21.7021 11.6727L21.7004 11.6717L21.6468 11.6317C21.5301 11.5309 21.4732 11.3821 21.4722 11.2381Z" fill="#00C4BE" stroke="#00C4BE" stroke-width="0.2"/>
            </svg>
                <span class="service-cta__phone-info">
                    <strong><?php echo esc_html( $contact_phone ); ?></strong>
                    <span><?php esc_html_e( 'call now', 'bury' ); ?></span>
                </span>
            </a>
            <?php endif; ?>
        </div>

        <div class="service-hero__right cform">
            <div class="service-hero__form cform__form-wrap">
                <h3 class="service-hero__form-title"><?php esc_html_e( 'Fill out to contact us today', 'bury' ); ?></h3>
                <p class="service-hero__form-desc"><?php esc_html_e( 'Complete the form below and our team will get back to you shortly to discuss your project and provide the information you need.', 'bury' ); ?></p>
                <div class="">
                    <?php echo do_shortcode( '[contact-form-7 id="06617ca" title="Contact form 1"]' ); ?>
                </div>
            </div>
        </div>

    </div>
</section>

    <?php get_template_part( 'template-parts/section', 'certification' ); ?>

      <?php if ( $content_blocks ) :
        foreach ( $content_blocks as $block ) :
            $block_img     = $block['services_image'];
            $block_img_url = is_array( $block_img ) ? $block_img['url'] : $block_img;
            $block_img_alt = is_array( $block_img ) ? ( $block_img['alt'] ?? '' ) : '';
            $block_reverse = ! empty( $block['services_revers'] );
            $block_content = $block['services_content'];

            if ( ! $block_content && ! $block_img_url ) continue;
    ?>
    <section class="process-block<?php echo $block_reverse ? ' process-block--reverse' : ''; ?>">
        <div class="container">
            <div class="process-block__inner">

                <?php if ( $block_img_url ) : ?>
                <div class="process-block__img-wrap">
                    <img src="<?php echo esc_url( $block_img_url ); ?>" alt="<?php echo esc_attr( $block_img_alt ); ?>" loading="lazy" class="process-block__img">
                </div>
                <?php endif; ?>

                <?php if ( $block_content ) : ?>
                <div class="process-block__content">
                    <?php echo wp_kses_post( $block_content ); ?>
                </div>
                <?php endif; ?>

            </div>
        </div>
    </section>
    <?php endforeach; endif; ?>

    <?php if ( $services_included ) : ?>
    <section class="service-included">
        <div class="container">

            <div class="service-included__head">
                <div class="service-included__title-wrap">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/quote.svg" alt="" aria-hidden="true">
                    <h2 class="service-included__title"><?php echo esc_html( $services_included_title ); ?></h2>
                </div>
                <div class="service-included__nav">
                    <button class="service-included__btn service-included__btn--prev" aria-label="Previous">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="22" viewBox="0 0 14 22" fill="none">
                            <path d="M11.3307 22L14 19.4092L5.33867 11L14 2.59076L11.3307 -1.1668e-07L-4.80825e-07 11L11.3307 22Z" fill="white"/>
                        </svg>
                    </button>
                    <button class="service-included__btn service-included__btn--next" aria-label="Next">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="22" viewBox="0 0 14 22" fill="none">
                            <path d="M2.66933 -2.02403e-06L-8.48405e-07 2.59076L8.66133 11L-1.13246e-07 19.4092L2.66933 22L14 11L2.66933 -2.02403e-06Z" fill="white"/>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="swiper service-included__swiper">
                <div class="swiper-wrapper">
                    <?php foreach ( $services_included as $item ) :
                        $img      = $item['services_included_image'];
                        $img_url  = is_array( $img ) ? $img['url'] : $img;
                        $img_alt  = is_array( $img ) ? ( $img['alt'] ?? '' ) : '';
                        $title    = $item['services_included_title'] ?? '';
                        $desc     = $item['services_included_description'] ?? '';
                        if ( ! $title && ! $desc && ! $img_url ) continue;
                    ?>
                    <div class="swiper-slide">
                        <div class="included-card">
                            <?php if ( $img_url ) : ?>
                            <div class="included-card__img-wrap">
                                <img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $img_alt ); ?>" loading="lazy">
                            </div>
                            <?php endif; ?>
                            <div class="included-card__body">
                                <?php if ( $title ) : ?>
                                <h3 class="included-card__title"><?php echo esc_html( $title ); ?></h3>
                                <?php endif; ?>
                                <?php if ( $desc ) : ?>
                                <p class="included-card__text"><?php echo esc_html( $desc ); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <div class="service-included__dots swiper-pagination"></div>
            </div>

        </div>
    </section>
    <?php endif; ?>

    <?php
    $last_img_url = is_array( $last_image_content ) ? $last_image_content['url'] : $last_image_content;
    $last_img_alt = is_array( $last_image_content ) ? ( $last_image_content['alt'] ?? '' ) : '';
    if ( $last_top_content || $last_right_content || $last_img_url ) :
    ?>
    <section class="process-block">
        <div class="container">

            <?php if ( $last_top_content ) : ?>
            <div class="process-block__head">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/quote.svg" alt="" aria-hidden="true">
                <?php echo wp_kses_post( $last_top_content ); ?>
            </div>
            <?php endif; ?>

            <?php if ( $last_img_url || $last_right_content ) : ?>
            <div class="process-block__inner">

                <?php if ( $last_img_url ) : ?>
                <div class="process-block__img-wrap">
                    <img src="<?php echo esc_url( $last_img_url ); ?>" alt="<?php echo esc_attr( $last_img_alt ); ?>" loading="lazy" class="process-block__img">
                </div>
                <?php endif; ?>

                <?php if ( $last_right_content ) : ?>
                <div class="process-block__content">
                    <?php echo wp_kses_post( $last_right_content ); ?>
                </div>
                <?php endif; ?>

            </div>
            <?php endif; ?>

        </div>
    </section>
    <?php endif; ?>

        <section class="service-cta">
            <div class="container">
                <h2 class="service-cta__title"><?php esc_html_e( 'Ready to start your project?', 'bury' ); ?></h2>
                <p class="service-cta__text">
                    <?php esc_html_e( 'Whether you\'re planning a small upgrade or a full-scale renovation, our team at DryLining Bury Limited is here to guide you every step of the way. Request a free quotation or call us on ', 'bury' ); ?>
                    <?php if ( $contact_phone ) : ?>
                    <strong><?php echo esc_html( $contact_phone ); ?></strong>
                    <?php endif; ?>
                    <?php esc_html_e( ' to speak with one of our renovation specialists and start your project with confidence.', 'bury' ); ?>
                </p>
                <div class="service-cta__actions">
                    <a href="<?php echo esc_url( home_url( '/contacts/#cform' ) ); ?>" class="btn btn--secondary">
                        <?php esc_html_e( 'Get a free quote', 'bury' ); ?>
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="10" viewBox="0 0 18 10" fill="none">
                                <path d="M17.21 5.505L18 4.701L17.21 3.897L17.017 3.701L13.382 0L11.955 1.402L14.215 3.7H0V5.7H14.214L11.956 8L13.382 9.402L17.017 5.7L17.21 5.505Z" fill="white"/>
                            </svg>
                    </a>
                    <?php if ( $contact_phone ) : ?>
                <a href="tel:<?php echo esc_attr( preg_replace('/\s+/', '', $contact_phone) ); ?>" class="cform__contact-item">
                    <span class="cform__contact-icon">
                       <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M12.6306 8.64071C12.6402 8.55201 12.6701 8.46285 12.7223 8.38904L12.7817 8.32095L12.7826 8.32102C12.8721 8.23901 12.971 8.19257 13.1049 8.1837C13.1684 8.17952 13.2392 8.18377 13.3202 8.19534L13.5966 8.25126C14.2473 8.40605 14.6961 8.66976 15.047 9.11416C15.3173 9.45945 15.4674 9.84933 15.5274 10.3381C15.5342 10.3908 15.5398 10.4642 15.5424 10.5403L15.5432 10.7585C15.5405 10.8569 15.537 10.9243 15.5259 10.9786C15.5136 11.0383 15.493 11.0796 15.464 11.1271L15.463 11.1279C15.288 11.4064 14.8797 11.451 14.648 11.2183L14.6058 11.1721C14.5678 11.1247 14.5399 11.0729 14.5209 11.0054C14.4972 10.9211 14.4884 10.8143 14.4834 10.6673C14.473 10.3629 14.4196 10.1246 14.3221 9.93462C14.2253 9.74613 14.0823 9.60001 13.8827 9.48444L13.7355 9.40902C13.5815 9.3397 13.4045 9.2869 13.1698 9.24361L13.1681 9.24342C13.047 9.21963 12.9542 9.19511 12.8806 9.15671C12.8218 9.12597 12.7777 9.08796 12.7406 9.04036L12.7061 8.99028C12.6401 8.88655 12.6179 8.75888 12.6306 8.64071Z" fill="#00C4BE" stroke="#00C4BE" stroke-width="0.2"/>
                            <path d="M13.0752 5.88391C13.0796 5.80263 13.0986 5.71271 13.1382 5.64963C13.1717 5.59753 13.2231 5.54656 13.2746 5.50686C13.3254 5.46775 13.3853 5.43202 13.4418 5.41566C13.4639 5.40918 13.4912 5.40695 13.515 5.40579C13.5409 5.40454 13.5714 5.40386 13.6047 5.40461C13.6719 5.40613 13.7553 5.41163 13.8432 5.41919C13.9309 5.42674 14.0249 5.43665 14.1149 5.44845L14.3629 5.4883C15.1344 5.64573 15.8399 5.96952 16.4242 6.44189C17.4622 7.28339 18.0398 8.47937 18.1254 9.95641C18.1432 10.2423 18.1416 10.445 18.1053 10.5918C18.0867 10.6671 18.0588 10.7312 18.017 10.7849C17.975 10.8388 17.9225 10.8776 17.8632 10.9089L17.8624 10.9079C17.6444 11.0252 17.3941 10.9868 17.2241 10.8085C17.1053 10.6856 17.0694 10.523 17.0708 10.2829C17.0749 9.64903 16.9287 8.94201 16.6946 8.45638L16.6937 8.45631C16.4217 7.88928 16.0015 7.4065 15.4723 7.05336L15.2921 6.94163C14.8572 6.69388 14.3215 6.52713 13.8003 6.48141C13.6015 6.46396 13.453 6.43768 13.3427 6.38517C13.2249 6.32905 13.1551 6.24596 13.1096 6.13216C13.0793 6.0583 13.0707 5.96626 13.0752 5.88391Z" fill="#00C4BE" stroke="#00C4BE" stroke-width="0.2"/>
                            <path d="M3.92758 7.94753L3.92849 7.94844C3.95264 7.44048 4.10761 7.04283 4.40264 6.6125L4.53786 6.425L4.53876 6.4241C4.76735 6.12335 5.11755 5.79404 5.45283 5.52446C5.77903 5.26217 6.17166 4.99214 6.5003 4.86461C7.11138 4.62795 7.77295 4.66187 8.30589 5.09537L8.3122 5.10078C8.40566 5.17864 8.52771 5.31611 8.625 5.42801C8.73918 5.55932 8.87636 5.72326 9.01623 5.89495C9.29289 6.23464 9.60055 6.62861 9.78425 6.89105L9.78517 6.89285C10.0504 7.27408 10.4213 7.86987 10.5749 8.16658L10.5766 8.17019C10.828 8.66337 10.8868 9.19814 10.7073 9.72607C10.6441 9.91097 10.5633 10.0906 10.3918 10.2841C10.2545 10.4391 10.0659 10.5929 9.83649 10.7753L9.51295 11.0395C9.48886 11.0593 9.46809 11.0775 9.44982 11.0927L9.43542 11.1215C9.44335 11.1044 9.41991 11.128 9.44714 11.2622C9.47649 11.4067 9.55449 11.6232 9.71668 11.949V11.9509C9.94938 12.421 10.2471 12.8461 10.7092 13.3508L10.71 13.3526C11.097 13.7771 11.5959 14.1972 11.9558 14.4163L11.9567 14.4172C12.1888 14.5588 12.4629 14.6871 12.7194 14.7786C12.985 14.8736 13.1743 14.9085 13.2584 14.9103C13.2583 14.9103 13.2682 14.9097 13.2872 14.9067C13.3069 14.9035 13.33 14.898 13.353 14.8913C13.3649 14.8879 13.3755 14.8847 13.3846 14.8815C13.3987 14.8662 13.4161 14.8479 13.436 14.8255C13.5028 14.7505 13.5871 14.6502 13.6722 14.5452L13.9805 14.1756C14.0758 14.0677 14.1656 13.9747 14.2536 13.8971C14.4604 13.7143 14.6556 13.616 14.881 13.5518L14.9792 13.5275C15.4735 13.4232 15.9852 13.6093 16.4351 13.8402L16.436 13.8394C16.8954 14.0749 17.5374 14.5233 18.0847 14.9517C18.3634 15.1699 18.631 15.3932 18.8519 15.5954C19.0567 15.7828 19.2702 15.9963 19.3963 16.1867L19.4009 16.1939C19.4695 16.3006 19.5652 16.4789 19.6163 16.6284L19.6145 16.6293C19.6677 16.7807 19.6992 16.9456 19.7128 17.0908C19.726 17.2328 19.7286 17.415 19.692 17.5876C19.646 17.806 19.5506 18.0084 19.427 18.215C19.3038 18.421 19.131 18.6669 18.9015 18.9758L18.9006 18.9776C18.7404 19.1919 18.5274 19.4331 18.3308 19.6348C18.1538 19.8163 17.9234 20.0358 17.7359 20.1476L17.7305 20.1513C17.3983 20.3451 17.0505 20.4532 16.6253 20.4352C16.2396 20.4189 15.8258 20.299 15.3543 20.1279C13.7067 19.5292 12.1263 18.6564 10.6109 17.5181C7.70184 15.3337 5.58209 12.577 4.16646 9.13925L4.04748 8.83095C4.01299 8.73162 3.98422 8.63459 3.96365 8.53617C3.91938 8.32423 3.91802 8.13929 3.92758 7.94753Z" fill="#00C4BE"/>
                            <path d="M13.4722 3.23839C13.4711 3.07416 13.5427 2.90289 13.6949 2.80274C13.7704 2.75224 13.841 2.72326 13.9494 2.71738C13.9994 2.71467 14.0582 2.71727 14.1298 2.72326L14.3878 2.75222C15.6034 2.90455 16.6916 3.26636 17.5878 3.81654C18.2298 4.21124 18.6362 4.56839 19.1557 5.18745L19.1566 5.18753C19.7062 5.84783 19.9989 6.34 20.2873 7.09017C20.579 7.85202 20.7192 8.53678 20.7498 9.36943L20.7498 9.37035C20.7547 9.53531 20.7526 9.83522 20.742 10.0393L20.7419 10.0402C20.7311 10.2314 20.7203 10.3575 20.6955 10.4488C20.6681 10.5491 20.6239 10.6083 20.5587 10.6685C20.4451 10.7746 20.2842 10.8102 20.1387 10.7936C19.9932 10.7769 19.845 10.7062 19.7604 10.5767L19.7596 10.5757C19.7176 10.5095 19.6938 10.4487 19.683 10.3446C19.6728 10.2475 19.674 10.108 19.6806 9.88377C19.7184 8.56421 19.4524 7.53607 18.8135 6.50665C18.0506 5.27286 16.91 4.43987 15.4218 4.03195C15.0415 3.92796 14.721 3.86479 14.2197 3.79713C13.8963 3.75467 13.803 3.73521 13.7022 3.67299L13.7004 3.67194L13.6469 3.63195C13.5301 3.53113 13.4732 3.38239 13.4722 3.23839Z" fill="#00C4BE" stroke="#00C4BE" stroke-width="0.2"/>
                        </svg>
                    </span>
                    <span class="cform__contact-text">
                        <strong><?php echo esc_html( $contact_phone ); ?></strong>
                        <span><?= __('call now', 'bury') ?></span>
                    </span>
                </a>
                <?php endif; ?>
            </div>
        </div>
    </section>
    
    <?php if ( $projects_query->have_posts() ) : ?>
    <section class="similar-projects">
        <div class="container">

            <div class="similar-projects__head">
                <div class="similar-projects__title-wrap">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/quote.svg" alt="" aria-hidden="true">
                    <h2 class="similar-projects__title"><?php esc_html_e( 'our Recent projects', 'bury' ); ?></h2>
                    <p class="similar-projects__subtitle"><?php esc_html_e( 'Certified drylining contractors delivering commercial interior projects across Manchester ', 'bury' ); ?></p>
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

    <section class="reviews mb-m">
        <div class="container">

            <div class="services__head">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/quote.svg" alt="" aria-hidden="true">
                <h2 class="services__title"><?= __('What Our Clients Say' , 'bury') ?></h2>
                <p class="services__subtitle"><?= __('Client reviews reflecting our quality, reliability and professional approach.' , 'bury') ?></p>
            </div>
            <?= do_shortcode('[trustindex no-registration=google]') ?>
        </div>
    </section>

<?php if ( $services_query->have_posts() ) : ?>
<section class="similar-services">
    <div class="container">

        <div class="similar-services__head">
            <div class="similar-services__title-wrap">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/quote.svg" alt="" aria-hidden="true">
                <h2 class="similar-services__title"><?php esc_html_e( 'Our others services', 'bury' ); ?></h2>
                <p class="similar-services__subtitle"><?php esc_html_e( 'Specialist drylining and interior finishing services supporting commercial developments and residential projects across Manchester and Greater Manchester.', 'bury' ); ?></p>
            </div>
            <div class="similar-services__nav">
                <button class="similar-services__btn similar-services__btn--prev" aria-label="Previous">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="22" viewBox="0 0 14 22" fill="none">
                        <path d="M11.3307 22L14 19.4092L5.33867 11L14 2.59076L11.3307 -1.1668e-07L-4.80825e-07 11L11.3307 22Z" fill="white"/>
                    </svg>
                </button>
                <button class="similar-services__btn similar-services__btn--next" aria-label="Next">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="22" viewBox="0 0 14 22" fill="none">
                        <path d="M2.66933 -2.02403e-06L-8.48405e-07 2.59076L8.66133 11L-1.13246e-07 19.4092L2.66933 22L14 11L2.66933 -2.02403e-06Z" fill="white"/>
                    </svg>
                </button>
            </div>
        </div>

        <div class="swiper similar-services__swiper">
            <div class="swiper-wrapper">
                <?php while ( $services_query->have_posts() ) : $services_query->the_post(); ?>
                <div class="swiper-slide">
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
                </div>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
            <div class="similar-services__dots swiper-pagination"></div>
        </div>

    </div>
</section>
<?php endif; ?>
