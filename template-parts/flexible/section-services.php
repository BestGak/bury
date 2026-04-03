<?php 
$services_title = get_sub_field('services_title');
$services_description = get_sub_field('services_description');

$all_services = new WP_Query( array(
    'post_type'      => 'services',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
    'post_parent'    => 0,
) );

$total_services = $all_services->found_posts;
wp_reset_postdata();

$services = new WP_Query( array(
    'post_type'      => 'services',
    'posts_per_page' => 5,
    'orderby'        => 'date',
    'order'          => 'DESC',
    'post_status'    => 'publish',
    'post_parent'    => 0,
) );

$remaining_services = $total_services - 5;
?>

<?php if ( $services->have_posts() ) : ?>
<section class="serving mb-m">
	<div class="container">
		<div class="serving__container">
			<div class="serving__title justify-title">
				<?php if ( $services_title ) : ?>
					<div class="title"><?php echo esc_html( $services_title ); ?></div>
				<?php endif; ?>
				
				<?php if ( $services_description ) : ?>
					<p><?php echo esc_html( $services_description ); ?></p>
				<?php endif; ?>
			</div>
			
			<div class="serving__items">
				<?php while ( $services->have_posts() ) : $services->the_post(); ?>
					<div class="serving__item">
						<a href="<?php the_permalink(); ?>" class="serving__item__img">
							<?php if ( has_post_thumbnail() ) : ?>
								<img src="<?php echo esc_url( get_the_post_thumbnail_url( get_the_ID(), 'medium_large' ) ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>">
							<?php else : ?>
								<img src="<?php echo TYRBOTA_THEME_DIRECTORY; ?>assets/images/serving-img.webp" alt="<?php echo esc_attr( get_the_title() ); ?>">
							<?php endif; ?>
						</a>
						<div class="serving__item__info">
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							<a href="<?php the_permalink(); ?>" class="btn btn-primary">
								<?php _e( 'Дізнатися більше', 'tyrbota' ); ?>
								<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
									<path d="M9 5.625L4.875 1.5L3.9375 2.4375L7.5 6L3.9375 9.5625L4.875 10.5L9 6.375V5.625Z" fill="white"/>
								</svg>
							</a>
						</div>
					</div>
				<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>
				
				<?php if ( $remaining_services > 0 ) : ?>
					<div class="serving__item serving__item-more">
						<div class="serving__item-more-content">
							<a href="<?= get_url_template('template-parts/page-services.php') ?>" class="arrow-icon">
								<svg xmlns="http://www.w3.org/2000/svg" width="97" height="60" viewBox="0 0 97 60" fill="none">
									<path d="M84.4299 29.9499L59.1002 5.93119L65.0371 0.301575L96.3033 29.9495L65.0371 59.5973L59.1007 53.9682L84.4299 29.9499Z" fill="#0957C3"/>
									<path d="M50.6589 29.6483L25.3292 5.62962L31.2661 0L62.5323 29.6479L31.2661 59.2958L25.3297 53.6666L50.6589 29.6483Z" fill="#0957C3"/>
								</svg> 
							</a>
							<a href="<?= get_url_template('template-parts/page-services.php') ?>" class="more-link">
								<?php printf( __( 'Показати ще %d послуг', 'tyrbota' ), $remaining_services ); ?>
								<svg width="24" height="21" viewBox="0 0 24 21" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M1.00001 10.2987L21.5974 10.2987" stroke="#0957C3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
									<path d="M15.6316 3.00635L21.5094 8.88417C22.2905 9.66522 22.2905 10.9316 21.5094 11.7126L15.6316 17.5904" stroke="#0957C3" stroke-width="2" stroke-linecap="round"/>
								</svg>
							</a>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>
<?php endif; ?>