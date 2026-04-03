<?php 
$history_title = get_sub_field('history_title');
$history = get_sub_field('history'); 
?>

<?php if ( $history ) : ?>
<section class="history mb-m">
	<div class="container">
		<div class="history__container">
			<?php if ( $history_title ) : ?>
				<div class="history__title">
					<div class="title"><?php echo esc_html( $history_title ); ?></div>
				</div>
			<?php endif; ?>
			
			<?php if ( $history ) : ?>
				<div class="history__slider">
					<div class="swiper historySlider">
						<div class="swiper-wrapper historySlider-wrapper">
							<?php foreach ( $history as $item ) : 
								$slide_title = $item['history_repeater_title'];
								$slide_description = $item['history_repeater_description'];
								$slide_image = $item['history_repeater_image'];
							?>
								<div class="swiper-slide history__slide">
									<?php if ( $slide_image ) : ?>
										<div class="history__slide__img">
											<img src="<?php echo esc_url( $slide_image ); ?>" alt="<?php echo esc_attr( $slide_title ); ?>">
										</div>
									<?php endif; ?>
									
									<div class="history__slide__content">
										<?php if ( $slide_title ) : ?>
											<div class="history__slide__content__title">
												<?php echo esc_html( $slide_title ); ?>
											</div>
										<?php endif; ?>
										
										<?php if ( $slide_description ) : ?>
											<div class="hsitory__slide__content__text">
												<?php echo wpautop( $slide_description ); ?>
											</div>
										<?php endif; ?>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
						
						<div class="history-pagination"></div>
					</div>
					
					<div class="arrows">
						<div class="history-button-prev arrow arrow-prev">
							<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
								<g clip-path="url(#clip0_67_1010)">
									<path d="M10.4 2L5.10713 7.29289C4.71661 7.68342 4.71661 8.31658 5.10713 8.70711L10.4 14" stroke="#3D8FFE" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
								</g>
								<defs>
									<clipPath id="clip0_67_1010">
										<rect width="16" height="16" fill="white" transform="translate(16 16) rotate(-180)"/>
									</clipPath>
								</defs>
							</svg>
						</div>
						<div class="history-button-next arrow arrow-next">
							<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
								<path d="M5.59998 14L10.8929 8.70711C11.2834 8.31658 11.2834 7.68342 10.8929 7.29289L5.59998 2" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
							</svg>
						</div>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>
<?php endif; ?>