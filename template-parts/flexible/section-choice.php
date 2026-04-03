<?php 
$choice_title = get_sub_field('choice_title');
$choice_image = get_sub_field('choice_image');
$choice = get_sub_field('choice');
?>

<?php if ( $choice_title || $choice ) : ?>
<section class="choice pb-m mb-m">
	<div class="container">
		<div class="choice__container">
			<?php if ( $choice_title ) : ?>
				<div class="choice__title">
					<div class="title"><?php echo esc_html( $choice_title ); ?></div> 
				</div>
			<?php endif; ?>
			
			<div class="choice__wrap">
				<?php if ( $choice_image ) : ?>
					<div class="choice__img">
						<img src="<?php echo esc_url( $choice_image ); ?>" alt="<?php echo esc_attr( $choice_title ); ?>">
					</div>
				<?php endif; ?>
				
				<?php if ( $choice ) : ?>
					<div class="choice__items">
						<?php $index = 1; ?>
						<?php foreach ( $choice as $item ) : 
							$item_title = $item['choice_repeater_title'];
							$item_description = $item['choice_repeater_description'];
						?>
							<div class="choice__item">
								<?php if ( $item_title ) : ?>
									<div class="choice__item__top">
										<span><?php echo $index; ?></span>
										<?php echo esc_html( $item_title ); ?>
									</div>
								<?php endif; ?>
								
								<?php if ( $item_description ) : ?>
									<div class="choice__item__content">
										<?php echo wpautop( $item_description ); ?>
									</div>
								<?php endif; ?>
							</div>
							<?php $index++; ?>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>
<?php endif; ?>