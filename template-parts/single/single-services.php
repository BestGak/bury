<?php
include BURY_REQUIRE_DIRECTORY . '/template-parts/content-variables.php';
$current_id = get_the_ID();

$projects_query = new WP_Query( [
		'post_type'      => 'projects',
		'posts_per_page' => 8,
		'post_status'    => 'publish',
		'orderby'        => 'date',
		'order'          => 'DESC',
] );

$services_query = new WP_Query( [
    'post_type'      => 'services',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
    'post__not_in'   => [ $current_id ],
    'orderby'        => 'date',
    'order'          => 'DESC',
] );
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

    <section class="certification">
        <div class="container">

            <div class="certification__left">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/quote.svg" alt="" aria-hidden="true">
                <h2 class="certification__title"><?php esc_html_e( 'Our Certification', 'bury' ); ?></h2>
                <p class="certification__subtitle"><?php esc_html_e( 'All works carried out safely and in full compliance with UK regulations.', 'bury' ); ?></p>
            </div>

            <div class="certification__logos">
                <div class="certification__logo">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/partner1.png" alt="Checkatrade" loading="lazy">
                </div>
                <div class="certification__logo">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/partner2.png" alt="CSCS" loading="lazy">
                </div>
                <div class="certification__logo">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/partner3.png" alt="IPAF" loading="lazy">
                </div>
                <div class="certification__logo">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/partner4.png" alt="PASMA" loading="lazy">
                </div>
            </div>

        </div>
    </section>

    <!-- Block 1: image left, content right -->
    <section class="process-block">
        <div class="container">
            <div class="process-block__inner">

                <div class="process-block__img-wrap">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/single-about.webp" alt="" loading="lazy" class="process-block__img">
                </div>

                <div class="process-block__content">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/quote.svg" alt="" aria-hidden="true">
                    <h2>Tape &amp; Jointing</h2>
                    <p>Tape &amp; jointing is a modern finishing technique used to create smooth, seamless plasterboard surfaces without the need for traditional plastering. At DryLining Bury Limited, we provide professional tape and jointing services for residential and commercial projects across Manchester, ensuring perfectly finished walls and ceilings that are ready for painting and decorating.</p>
                    <ul>
                        <li>Smooth, seamless wall and ceiling finishes</li>
                        <li>Faster drying time compared to traditional plaster</li>
                        <li>Ideal for new builds, offices, and apartment developments</li>
                        <li>Professional joint reinforcement for long-lasting durability</li>
                        <li>Clean and efficient installation process</li>
                        <li>Perfect surface preparation ready for painting</li>
                    </ul>
                    <div class="process-block__cta">
                        <a href="<?php echo esc_url( home_url( '/contacts/#contact' ) ); ?>" class="btn btn--secondary">
                            <?php esc_html_e( 'Get a free quote', 'bury' ); ?>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <g clip-path="url(#clip0_312_10346)">
                                    <path d="M13.71 12.505L14.5 11.701L13.71 10.897L13.517 10.701L9.882 7L8.455 8.402L10.715 10.7H-3.5V12.7H10.714L8.456 15L9.882 16.402L13.517 12.7L13.71 12.505Z" fill="white"/>
                                </g>
                                <defs>
                                    <clipPath id="clip0_312_10346">
                                    <rect width="24" height="24" fill="white"/>
                                    </clipPath>
                                </defs>
                            </svg>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Block 2: image right, content left (reverse) -->
    <section class="process-block process-block--reverse">
        <div class="container">
            <div class="process-block__inner">

                <div class="process-block__img-wrap">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/single-about.webp" alt="" loading="lazy" class="process-block__img">
                </div>

                <div class="process-block__content">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/quote.svg" alt="" aria-hidden="true">
                    <h2>Professional Tape &amp; Jointing Services in Manchester</h2>
                    <p>At DryLining Bury Limited, our tape and jointing services are designed to support both large-scale construction projects and smaller residential works across Manchester and Greater Manchester. We work closely with contractors, developers and private clients to deliver consistent finishing standards and reliable project timelines.</p>
                    <p>Our team regularly supports a wide range of construction environments, ensuring plasterboard systems are properly prepared and finished before decoration begins.</p>
                    <hr>
                    <h4>Commercial Projects</h4>
                    <p>Office fit-outs, apartment developments, retail units and large construction sites where efficient drywall finishing is essential.</p>
                    <hr>
                    <h4>Residential Projects</h4>
                    <p>New housing developments and refurbishment projects requiring high-quality interior finishing.</p>
                    <hr>
                    <h4>Private / Domestic Projects</h4>
                    <p>Houses, flats and home renovations where clients require clean, professional drywall finishing ready for painting and decorating.</p>
                </div>

            </div>
        </div>
    </section>

    <section class="service-included">
        <div class="container">

            <div class="service-included__head">
                <div class="service-included__title-wrap">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/quote.svg" alt="" aria-hidden="true">
                    <h2 class="service-included__title"><?php esc_html_e( "What's Included in Tape & Jointing Works", 'bury' ); ?></h2>
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
                    <div class="swiper-slide">
                        <div class="included-card">
                            <div class="included-card__img-wrap">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/service-img1.png" alt="Board Preparation" loading="lazy">
                            </div>
                            <div class="included-card__body">
                                <h3 class="included-card__title"><?php esc_html_e( 'Board Preparation', 'bury' ); ?></h3>
                                <p class="included-card__text"><?php esc_html_e( 'We carefully inspect and align all plasterboards to ensure they are level, stable, and correctly positioned, providing a solid foundation for seamless jointing.', 'bury' ); ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="included-card">
                            <div class="included-card__img-wrap">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/service-img2.png" alt="Taping Joints" loading="lazy">
                            </div>
                            <div class="included-card__body">
                                <h3 class="included-card__title"><?php esc_html_e( 'Taping Joints', 'bury' ); ?></h3>
                                <p class="included-card__text"><?php esc_html_e( 'All joints are reinforced with high-quality tape to prevent cracks and ensure a strong, durable finish that will last for years.', 'bury' ); ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="included-card">
                            <div class="included-card__img-wrap">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/service-img3.png" alt="Filling Joints" loading="lazy">
                            </div>
                            <div class="included-card__body">
                                <h3 class="included-card__title"><?php esc_html_e( 'Filling Joints', 'bury' ); ?></h3>
                                <p class="included-card__text"><?php esc_html_e( 'We apply joint compound meticulously to fill seams and gaps, creating smooth, even surfaces ready for the next stage of finishing.', 'bury' ); ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="included-card">
                            <div class="included-card__img-wrap">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/service-img1.png" alt="Board Preparation" loading="lazy">
                            </div>
                            <div class="included-card__body">
                                <h3 class="included-card__title"><?php esc_html_e( 'Board Preparation', 'bury' ); ?></h3>
                                <p class="included-card__text"><?php esc_html_e( 'We carefully inspect and align all plasterboards to ensure they are level, stable, and correctly positioned, providing a solid foundation for seamless jointing.', 'bury' ); ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="included-card">
                            <div class="included-card__img-wrap">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/service-img2.png" alt="Taping Joints" loading="lazy">
                            </div>
                            <div class="included-card__body">
                                <h3 class="included-card__title"><?php esc_html_e( 'Taping Joints', 'bury' ); ?></h3>
                                <p class="included-card__text"><?php esc_html_e( 'All joints are reinforced with high-quality tape to prevent cracks and ensure a strong, durable finish that will last for years.', 'bury' ); ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="included-card">
                            <div class="included-card__img-wrap">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/service-img3.png" alt="Filling Joints" loading="lazy">
                            </div>
                            <div class="included-card__body">
                                <h3 class="included-card__title"><?php esc_html_e( 'Filling Joints', 'bury' ); ?></h3>
                                <p class="included-card__text"><?php esc_html_e( 'We apply joint compound meticulously to fill seams and gaps, creating smooth, even surfaces ready for the next stage of finishing.', 'bury' ); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="service-included__dots swiper-pagination"></div>
            </div>

        </div>
    </section>

    <section class="process-block">
        <div class="container">

            <div class="process-block__head">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/quote.svg" alt="" aria-hidden="true">
                <h2>Our Tape &amp; Jointing Works Process</h2>
                <p>We follow a clear, step-by-step approach from board installation and jointing to sanding, finishing, and handover, ensuring smooth, durable walls and ceilings fully compliant with UK standards.</p>
            </div>

            <div class="process-block__inner">

                <div class="process-block__img-wrap">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/single-about.webp" alt="" loading="lazy" class="process-block__img">
                </div>

                <div class="process-block__content">
                    <ol>
                        <li>
                            <b>Consultation &amp; Survey</b>
                            <p>We meet with you to discuss your goals, inspect the property, and assess the existing conditions to plan an effective renovation strategy.</p>
                        </li>
                        <li>
                            <b>Design &amp; Planning</b>
                            <p>Detailed layouts, interior concepts, and material selections are developed to reflect your style, optimise space, and ensure functionality.</p>
                        </li>
                        <li>
                            <b>Approvals &amp; Permissions</b>
                            <p>All necessary permissions, including Building Control approvals, are managed to guarantee full compliance with UK regulations.</p>
                        </li>
                        <li>
                            <b>Construction &amp; Installations</b>
                            <p>Demolition, structural changes, and installation of electrical, plumbing, and mechanical systems are carried out safely and efficiently.</p>
                        </li>
                        <li>
                            <b>Handover &amp; Aftercare</b>
                            <p>Final inspections are conducted, the property is handed over clean and fully functional, and ongoing support and warranty ensure long-term peace of mind.</p>
                        </li>
                    </ol>
                </div>

            </div>
        </div>
    </section>

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
                    <a href="<?php echo esc_url( home_url( '/contacts/#contact' ) ); ?>" class="btn btn--secondary">
                        <?php esc_html_e( 'Get a free quote', 'bury' ); ?>
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="10" viewBox="0 0 18 10" fill="none">
                                <path d="M17.21 5.505L18 4.701L17.21 3.897L17.017 3.701L13.382 0L11.955 1.402L14.215 3.7H0V5.7H14.214L11.956 8L13.382 9.402L17.017 5.7L17.21 5.505Z" fill="white"/>
                            </svg>
                    </a>
                    <?php if ( $contact_phone ) : ?>
                    <a href="tel:<?php echo esc_attr( preg_replace( '/\s+/', '', $contact_phone ) ); ?>" class="service-cta__phone">
    <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
    <rect x="0.5" y="0.5" width="39" height="39" fill="white"/>
    <rect x="0.5" y="0.5" width="39" height="39" stroke="#00C4BE"/>
    <path d="M20.6309 16.641C20.6405 16.5523 20.6703 16.4631 20.7225 16.3893L20.7819 16.3212L20.7828 16.3213C20.8724 16.2393 20.9712 16.1928 21.1052 16.1839C21.1687 16.1798 21.2395 16.184 21.3204 16.1956L21.5969 16.2515C22.2476 16.4063 22.6964 16.67 23.0472 17.1144C23.3175 17.4597 23.4677 17.8496 23.5277 18.3383C23.5344 18.3911 23.54 18.4644 23.5426 18.5406L23.5435 18.7587C23.5407 18.8571 23.5373 18.9246 23.5261 18.9789C23.5138 19.0385 23.4932 19.0799 23.4643 19.1273L23.4632 19.1281C23.2882 19.4066 22.88 19.4512 22.6483 19.2186L22.6061 19.1723C22.568 19.125 22.5402 19.0731 22.5212 19.0056C22.4974 18.9214 22.4887 18.8146 22.4837 18.6675C22.4732 18.3632 22.4198 18.1248 22.3223 17.9349C22.2255 17.7464 22.0825 17.6003 21.8829 17.4847L21.7357 17.4093C21.5817 17.3399 21.4047 17.2871 21.17 17.2439L21.1683 17.2437C21.0473 17.2199 20.9544 17.1954 20.8808 17.157C20.822 17.1262 20.7779 17.0882 20.7408 17.0406L20.7063 16.9905C20.6403 16.8868 20.6181 16.7591 20.6309 16.641Z" fill="#00C4BE" stroke="#00C4BE" stroke-width="0.2"/>
    <path d="M21.0753 13.8839C21.0797 13.8026 21.0987 13.7127 21.1382 13.6496C21.1718 13.5975 21.2232 13.5466 21.2747 13.5069C21.3254 13.4677 21.3854 13.432 21.4418 13.4157C21.464 13.4092 21.4913 13.407 21.5151 13.4058C21.541 13.4045 21.5714 13.4039 21.6048 13.4046C21.672 13.4061 21.7554 13.4116 21.8433 13.4192C21.931 13.4267 22.025 13.4366 22.115 13.4484L22.363 13.4883C23.1345 13.6457 23.84 13.9695 24.4243 14.4419C25.4623 15.2834 26.0399 16.4794 26.1255 17.9564C26.1433 18.2423 26.1417 18.445 26.1054 18.5918C26.0868 18.6671 26.0589 18.7312 26.0171 18.7849C25.9751 18.8388 25.9226 18.8776 25.8633 18.9089L25.8625 18.9079C25.6445 19.0252 25.3942 18.9868 25.2242 18.8085C25.1054 18.6856 25.0695 18.523 25.0709 18.2829C25.075 17.649 24.9288 16.942 24.6947 16.4564L24.6938 16.4563C24.4218 15.8893 24.0016 15.4065 23.4724 15.0534L23.2922 14.9416C22.8573 14.6939 22.3216 14.5271 21.8004 14.4814C21.6016 14.464 21.4531 14.4377 21.3428 14.3852C21.225 14.3291 21.1552 14.246 21.1097 14.1322C21.0794 14.0583 21.0708 13.9663 21.0753 13.8839Z" fill="#00C4BE" stroke="#00C4BE" stroke-width="0.2"/>
    <path d="M11.9276 15.9473L11.9286 15.9482C11.9527 15.4402 12.1077 15.0426 12.4027 14.6123L12.5379 14.4248L12.5388 14.4239C12.7674 14.1231 13.1176 13.7938 13.4529 13.5242C13.7791 13.2619 14.1717 12.9919 14.5004 12.8644C15.1114 12.6277 15.773 12.6616 16.306 13.0951L16.3123 13.1005C16.4057 13.1784 16.5278 13.3159 16.6251 13.4278C16.7392 13.5591 16.8764 13.723 17.0163 13.8947C17.293 14.2344 17.6006 14.6284 17.7843 14.8908L17.7852 14.8926C18.0504 15.2738 18.4213 15.8696 18.5749 16.1663L18.5767 16.1699C18.828 16.6631 18.8868 17.1979 18.7074 17.7258C18.6442 17.9107 18.5634 18.0904 18.3919 18.2838C18.2545 18.4388 18.0659 18.5927 17.8366 18.7751L17.513 19.0393C17.4889 19.059 17.4682 19.0772 17.4499 19.0924L17.4355 19.1212C17.4434 19.1042 17.42 19.1278 17.4472 19.2619C17.4766 19.4065 17.5546 19.6229 17.7167 19.9488V19.9506C17.9494 20.4208 18.2471 20.8458 18.7092 21.3506L18.7101 21.3523C19.097 21.7768 19.5959 22.1969 19.9558 22.4161L19.9568 22.4169C20.1888 22.5586 20.463 22.6868 20.7194 22.7784C20.9851 22.8734 21.1744 22.9083 21.2585 22.91C21.2584 22.91 21.2683 22.9095 21.2873 22.9064C21.307 22.9033 21.33 22.8977 21.3531 22.8911C21.3649 22.8877 21.3755 22.8844 21.3847 22.8812C21.3988 22.866 21.4162 22.8476 21.4361 22.8253C21.5028 22.7502 21.5872 22.65 21.6722 22.5449L21.9805 22.1753C22.0759 22.0674 22.1657 21.9745 22.2537 21.8968C22.4604 21.7141 22.6557 21.6158 22.8811 21.5515L22.9793 21.5272C23.4736 21.4229 23.9853 21.609 24.4352 21.84L24.4361 21.8392C24.8954 22.0746 25.5375 22.5231 26.0848 22.9515C26.3635 23.1697 26.6311 23.393 26.852 23.5951C27.0568 23.7826 27.2702 23.996 27.3964 24.1864L27.4009 24.1936C27.4696 24.3004 27.5652 24.4787 27.6164 24.6281L27.6145 24.6291C27.6678 24.7804 27.6993 24.9454 27.7128 25.0906C27.726 25.2326 27.7287 25.4148 27.6921 25.5873C27.6461 25.8058 27.5506 26.0081 27.427 26.2147C27.3038 26.4208 27.131 26.6667 26.9015 26.9755L26.9006 26.9774C26.7405 27.1916 26.5274 27.4328 26.3309 27.6345C26.1538 27.8161 25.9234 28.0356 25.736 28.1474L25.7305 28.1511C25.3984 28.3449 25.0506 28.4529 24.6253 28.435C24.2397 28.4187 23.8258 28.2988 23.3543 28.1276C21.7067 27.5289 20.1263 26.6561 18.6109 25.5179C15.7019 23.3334 13.5822 20.5768 12.1665 17.139L12.0475 16.8307C12.0131 16.7314 11.9843 16.6343 11.9637 16.5359C11.9194 16.324 11.9181 16.1391 11.9276 15.9473Z" fill="#00C4BE"/>
    <path d="M21.4722 11.2381C21.4711 11.0739 21.5427 10.9026 21.6948 10.8025C21.7703 10.752 21.8409 10.723 21.9493 10.7171C21.9993 10.7144 22.0581 10.717 22.1298 10.723L22.3878 10.752C23.6034 10.9043 24.6916 11.2661 25.5877 11.8163C26.2297 12.211 26.6362 12.5681 27.1557 13.1872L27.1566 13.1873C27.7062 13.8476 27.9989 14.3398 28.2873 15.0899C28.5789 15.8518 28.7192 16.5365 28.7498 17.3692L28.7497 17.3701C28.7546 17.5351 28.7526 17.835 28.742 18.0391L28.7419 18.04C28.7311 18.2312 28.7203 18.3572 28.6954 18.4485C28.668 18.5489 28.6239 18.608 28.5586 18.6682C28.4451 18.7744 28.2842 18.8099 28.1386 18.7933C27.9932 18.7767 27.8449 18.706 27.7604 18.5765L27.7595 18.5755C27.7175 18.5093 27.6938 18.4484 27.6829 18.3443C27.6728 18.2472 27.674 18.1077 27.6806 17.8835C27.7184 16.564 27.4523 15.5358 26.8135 14.5064C26.0505 13.2726 24.91 12.4396 23.4217 12.0317C23.0415 11.9277 22.721 11.8645 22.2197 11.7969C21.8962 11.7544 21.803 11.735 21.7021 11.6727L21.7004 11.6717L21.6468 11.6317C21.5301 11.5309 21.4732 11.3821 21.4722 11.2381Z" fill="#00C4BE" stroke="#00C4BE" stroke-width="0.2"/>
    </svg>

                    <span class="service-cta__phone-info">
                        <strong><?php echo esc_html( $contact_phone ); ?></strong>
                        <span><?php esc_html_e( 'call now', 'bury' ); ?></span>
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
