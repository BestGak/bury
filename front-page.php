<?php
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
		'orderby'        => 'date',
		'order'          => 'DESC',
	] );
	$faq_title = get_field( 'faq_title' );
	$faq_items = get_field( 'faq' );
?>
<?php
include BURY_REQUIRE_DIRECTORY . '/template-parts/content-variables.php';
get_header();
?>

<section class="hero" style="background: linear-gradient(0deg, rgba(0,0,0,0.60) 0%, rgba(0,0,0,0.60) 100%), url('<?php echo get_stylesheet_directory_uri(); ?>/assets/images/hero.jpg') lightgray 50% / cover no-repeat;">
    <div class="container hero__inner">

        <div class="hero__content">
            <h1 class="hero__title"><?php esc_html_e( 'Professional Tape & Jointing & Drylining Contractors in Manchester', 'bury' ); ?></h1>

            <div class="hero__desc-wrap">
                <div class="hero__man">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/hero-man.png" alt="" aria-hidden="true">
                </div>
                <p class="hero__desc"><?php esc_html_e( 'DryLining Bury Limited is a trusted drylining and interior finishing contractor based in Bury, Greater Manchester. We specialise in tape and jointing, spray plastering, painting, drylining and suspended ceilings for residential and commercial projects.', 'bury' ); ?></p>
            </div>

            <div class="hero__actions">
                <a href="<?php echo esc_url( home_url( '/contacts/#cform' ) ); ?>" class="btn btn--secondary hero__btn">
                    <?php esc_html_e( 'Get a free quote', 'bury' ); ?>
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="10" viewBox="0 0 18 10" fill="none">
                            <path d="M17.21 5.505L18 4.701L17.21 3.897L17.017 3.701L13.382 0L11.955 1.402L14.215 3.7H0V5.7H14.214L11.956 8L13.382 9.402L17.017 5.7L17.21 5.505Z" fill="white"/>
                        </svg>
                </a>

                <?php if ( $contact_phone ) : ?>
                <a href="tel:<?php echo esc_attr( preg_replace( '/\s+/', '', $contact_phone ) ); ?>" class="hero__phone">
                    <span class="hero__phone-icon">
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
						<path d="M0.00479514 3.22878L0.00569966 3.22969C0.0298566 2.72173 0.184823 2.32408 0.479857 1.89375L0.615078 1.70625L0.615973 1.70535C0.844564 1.4046 1.19476 1.07529 1.53004 0.805708C1.85625 0.543425 2.24887 0.273388 2.57751 0.145855C3.1886 -0.090803 3.85017 -0.0568799 4.38311 0.376625L4.38941 0.382034C4.48287 0.459886 4.60492 0.59736 4.70221 0.709255C4.81639 0.840572 4.95358 1.00451 5.09344 1.1762C5.37011 1.51589 5.67777 1.90986 5.86146 2.1723L5.86238 2.1741C6.12758 2.55533 6.49848 3.15112 6.65208 3.44783L6.65383 3.45144C6.90518 3.94462 6.96398 4.47939 6.78454 5.00732C6.7213 5.19222 6.64054 5.37185 6.46903 5.56532C6.33167 5.72031 6.14309 5.87419 5.91371 6.05659L5.59017 6.32077C5.56608 6.34052 5.54531 6.35871 5.52703 6.37394L5.51263 6.40274C5.52057 6.38566 5.49712 6.40929 5.52435 6.54342C5.55371 6.68797 5.63171 6.90443 5.79389 7.23028V7.23212C6.0266 7.70225 6.32429 8.12732 6.78638 8.63206L6.78721 8.63382C7.17417 9.05834 7.67309 9.47843 8.033 9.69757L8.03392 9.6984C8.26598 9.84009 8.54014 9.96831 8.79657 10.0599C9.06223 10.1549 9.25155 10.1898 9.33564 10.1915C9.33555 10.1915 9.34543 10.191 9.36444 10.1879C9.38411 10.1848 9.40718 10.1792 9.43026 10.1726C9.44207 10.1692 9.45269 10.1659 9.46183 10.1627C9.47595 10.1475 9.49331 10.1291 9.51324 10.1068C9.57998 10.0317 9.66435 9.93148 9.74937 9.82643L10.0577 9.45683C10.153 9.34892 10.2428 9.25597 10.3308 9.17834C10.5376 8.99557 10.7328 8.89726 10.9582 8.83302L11.0564 8.80874C11.5508 8.70443 12.0624 8.89052 12.5123 9.12148L12.5132 9.12065C12.9726 9.35612 13.6147 9.80455 14.162 10.233C14.4406 10.4512 14.7082 10.6745 14.9291 10.8766C15.134 11.0641 15.3474 11.2775 15.4735 11.4679L15.4781 11.4751C15.5468 11.5818 15.6424 11.7602 15.6935 11.9096L15.6917 11.9106C15.7449 12.0619 15.7764 12.2269 15.79 12.3721C15.8032 12.5141 15.8059 12.6963 15.7692 12.8688C15.7232 13.0873 15.6278 13.2896 15.5042 13.4962C15.381 13.7022 15.2082 13.9482 14.9787 14.257L14.9778 14.2589C14.8176 14.4731 14.6046 14.7143 14.408 14.916C14.231 15.0976 14.0006 15.3171 13.8131 15.4289L13.8077 15.4326C13.4756 15.6264 13.1277 15.7344 12.7025 15.7165C12.3168 15.7002 11.903 15.5802 11.4315 15.4091C9.78389 14.8104 8.20349 13.9376 6.68807 12.7994C3.77905 10.6149 1.6593 7.85825 0.243678 4.4205L0.124694 4.1122C0.0902074 4.01287 0.0614353 3.91584 0.0408599 3.81742C-0.00341089 3.60548 -0.00476794 3.42054 0.00479514 3.22878Z" fill="#00C4BE"/>
						</svg>
                    </span>
                    <span class="hero__phone-info">
                        <strong><?php echo esc_html( $contact_phone ); ?></strong>
                        <span><?php esc_html_e( 'call now', 'bury' ); ?></span>
                    </span>
                </a>
                <?php endif; ?>
            </div>
        </div>

        <div class="hero__rating">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/google.svg" alt="Google" class="hero__rating-logo">
            <div class="hero__rating-info">
                <span class="hero__rating-label"><?php esc_html_e( 'Rating', 'bury' ); ?></span>
                <div class="hero__rating-score">
                    <strong>4.9</strong>
                    <span class="hero__rating-stars">★★★★★</span>
                </div>
                <a href="#reviews" class="hero__rating-link"><?php esc_html_e( 'Read our reviews', 'bury' ); ?></a>
            </div>
        </div>

    </div>
</section>

<?= the_content(); ?>



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

	<?php if ( $services_query->have_posts() ) : ?>
    <section class="services mb-m">
        <div class="container">

            <div class="services__head">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/quote.svg" alt="" aria-hidden="true">
                <h2 class="services__title">Our main Services</h2>
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

            <div class="services__footer">
                <a href="<?php echo esc_url( home_url( '/contacts' ) ); ?>" class="btn btn--outline">
                    <?php esc_html_e( 'Get a free quote', 'bury' ); ?>
                    <span class="btn__icon">
                       <svg xmlns="http://www.w3.org/2000/svg" width="18" height="10" viewBox="0 0 18 10" fill="none">
                            <path d="M17.21 5.505L18 4.701L17.21 3.897L17.017 3.701L13.382 0L11.955 1.402L14.215 3.7H0V5.7H14.214L11.956 8L13.382 9.402L17.017 5.7L17.21 5.505Z" fill="white"/>
                        </svg>
                    </span>
                </a>
            </div>

        </div>
    </section>
    <?php endif; ?>

	<section class="process-block process-block--reverse mb-m">
		<div class="container">
			<div class="process-block__inner">

				<div class="process-block__img-wrap">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/house-image.png" alt="" loading="lazy" class="process-block__img">
				</div>

				<div class="process-block__content">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/quote.svg" alt="" aria-hidden="true">
					<h2>Specialist Drylining &amp; Interior Finishing Contractor in Manchester</h2>
					<p>DryLining Bury Limited is a professional drylining and interior finishing contractor delivering high-quality services across Manchester City Centre and Greater Manchester. We specialise in providing reliable, efficient, and professional solutions for both residential and commercial projects, ensuring smooth, paint-ready finishes that meet modern UK construction standards.</p>
					<p>Our team works closely with main contractors, developers, and homeowners, providing tailored services for new builds, refurbishments, office fit-outs, and luxury apartment projects.</p>
					<div class="process-block__cta">
						<a href="<?php echo esc_url( home_url( '/about' ) ); ?>" class="btn btn--secondary">
							<?php esc_html_e( 'More about us', 'bury' ); ?>
								<svg xmlns="http://www.w3.org/2000/svg" width="18" height="10" viewBox="0 0 18 10" fill="none">
									<path d="M17.21 5.505L18 4.701L17.21 3.897L17.017 3.701L13.382 0L11.955 1.402L14.215 3.7H0V5.7H14.214L11.956 8L13.382 9.402L17.017 5.7L17.21 5.505Z" fill="white"/>
								</svg>
						</a>
					</div>
				</div>

			</div>
		</div>
	</section>

	<div class="mb-m">
		<?= get_template_part('template-parts/section' , 'form') ?>
	</div>

<section class="process-block">
    <div class="container">
        <div class="process-block__inner">

            <div class="process-block__img-wrap">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/man.png" alt="" loading="lazy" class="process-block__img">
            </div>

            <div class="process-block__content">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/quote.svg" alt="" aria-hidden="true">
                <h2>Professional Drylining You Can Rely On</h2>
                <p>At DryLining Bury Limited, we deliver consistent, high-quality drylining and interior finishing services across Manchester and Greater Manchester. Our work is built on experience, attention to detail and a professional approach on every site.</p>
                <p><strong>Our reputation is based on:</strong></p>
                <ul>
                    <li>Experienced, fully certified teams</li>
                    <li>High standards of workmanship</li>
                    <li>Clear communication and professional site management</li>
                    <li>Health &amp; Safety-focused delivery</li>
                    <li>Reliable scheduling and on-time completion</li>
                    <li>Proven expertise in modern drylining systems</li>
                </ul>
                <div class="process-block__cta">
                    <a href="<?php echo esc_url( home_url( '/contacts/#cform' ) ); ?>" class="btn btn--secondary">
                        <?php esc_html_e( 'Get a free quote', 'bury' ); ?>
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="10" viewBox="0 0 18 10" fill="none">
                                <path d="M17.21 5.505L18 4.701L17.21 3.897L17.017 3.701L13.382 0L11.955 1.402L14.215 3.7H0V5.7H14.214L11.956 8L13.382 9.402L17.017 5.7L17.21 5.505Z" fill="white"/>
                            </svg>
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>

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

	<section class="project-tabs mb-m">
		<div class="container-l">

			<div class="project-tabs__head">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/quote.svg" alt="" aria-hidden="true">
				<h2 class="project-tabs__title"><?php esc_html_e( 'Commercial & Residential Projects', 'bury' ); ?></h2>
			</div>

			<div class="project-tabs__body" style="background-image: linear-gradient(0deg, rgba(16,35,49,0.40) 0%, rgba(16,35,49,0.40) 100%), url('<?php echo get_stylesheet_directory_uri(); ?>/assets/images/house.png'); background-position: center center; background-size: cover; background-repeat: no-repeat;">

				<div class="project-tabs__nav">
					<button class="project-tabs__tab is-active" data-tab="1">
						<span class="project-tabs__tab-num">01</span>
						<span><?php esc_html_e( 'Commercial Projects', 'bury' ); ?></span>
					</button>
					<button class="project-tabs__tab" data-tab="2">
						<span class="project-tabs__tab-num">02</span>
						<span><?php esc_html_e( 'Residential Projects', 'bury' ); ?></span>
					</button>
					<button class="project-tabs__tab" data-tab="3">
						<span class="project-tabs__tab-num">03</span>
						<span><?php esc_html_e( 'Private / Domestic Projects', 'bury' ); ?></span>
					</button>
				</div>

				<div class="project-tabs__panels">

					<div class="project-tabs__panel is-active" data-panel="1">
						<div class="project-tabs__panel-img">
							<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/house.png" alt="Commercial Projects" loading="lazy">
						</div>
						<div class="project-tabs__panel-content">
							<h3><?php esc_html_e( 'Commercial Projects', 'bury' ); ?></h3>
							<p><?php esc_html_e( 'We deliver professional drylining and interior finishing services for a wide range of commercial projects across Manchester and Greater Manchester. Our team works closely with developers, main contractors and project managers, supporting projects from early stages through to final handover.', 'bury' ); ?></p>
							<p><?php esc_html_e( 'Our commercial experience includes office fit-outs, apartment blocks, retail spaces and new-build developments, where quality, programme and compliance are critical. We understand the demands of live sites, tight deadlines and high finishing standards, ensuring reliable delivery on every project.', 'bury' ); ?></p>
							<p><?php esc_html_e( 'With a focus on efficient workflow, skilled labour and safety-first practices, we provide consistent results that meet modern UK construction requirements.', 'bury' ); ?></p>
						</div>
					</div>

					<div class="project-tabs__panel" data-panel="2">
						<div class="project-tabs__panel-img">
							<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/house.png" alt="Residential Projects" loading="lazy">
						</div>
						<div class="project-tabs__panel-content">
							<h3><?php esc_html_e( 'Residential Projects', 'bury' ); ?></h3>
							<p><?php esc_html_e( 'We support residential developers and housing associations across Greater Manchester with reliable drylining and interior finishing services. Our team is experienced in working within occupied and part-occupied developments, maintaining high standards while minimising disruption.', 'bury' ); ?></p>
							<p><?php esc_html_e( 'From new housing estates to apartment complexes and refurbishment schemes, we provide consistent finishing quality and work to programme across all residential project types.', 'bury' ); ?></p>
						</div>
					</div>

					<div class="project-tabs__panel" data-panel="3">
						<div class="project-tabs__panel-img">
							<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/house.png" alt="Private / Domestic Projects" loading="lazy">
						</div>
						<div class="project-tabs__panel-content">
							<h3><?php esc_html_e( 'Private / Domestic Projects', 'bury' ); ?></h3>
							<p><?php esc_html_e( 'For homeowners and private clients across Manchester and Greater Manchester, we offer professional drylining and interior finishing tailored to domestic settings. Whether it\'s a single room, full home renovation or extension, our team delivers clean, precise results with minimal disruption.', 'bury' ); ?></p>
							<p><?php esc_html_e( 'We take pride in our attention to detail and clear communication throughout every private project, ensuring the finished result meets your expectations and is ready for decoration.', 'bury' ); ?></p>
						</div>
					</div>

				</div>
			</div>

		</div>
	</section>

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