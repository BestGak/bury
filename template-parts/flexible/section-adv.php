<?php 
$adv_title = get_sub_field('adv_title');
$adv = get_sub_field('adv');
?>

<?php if ( $adv_title || $adv ) : ?>
<section class="adv">
	<div class="container">
		<?php if ( $adv_title ) : ?>
			<div class="adv__title title__column">
				<div class="title"><?php echo esc_html( $adv_title ); ?></div>
			</div>
		<?php endif; ?>
		
		<?php if ( $adv ) : ?>
			<div class="adv__items">
				<?php foreach ( $adv as $item ) : 
					$title = $item['adv_repeater_title'];
					$description = $item['adv_repeater_description'];
					$icon = $item['adv_repeater_icon'];
					$link = $item['adv_repeater_link'];
				?>
					<div class="adv__item">
						<?php if ( $title ) : ?>
								<div class="adv__item__top">
									<?php echo esc_html( $title ); ?>
								</div>
						<?php endif; ?>
						
						<?php if ( $description ) : ?>
							<div class="adv__item__info">
								<?php echo esc_html( $description ); ?>
							</div>
						<?php endif; ?>
                        <?php if($link) : ?>
                            <a href="<?= $link['url'] ?>" class="adv__item__link"><?= $link['title'] ?></a>
                        <?php endif; ?>
						<?php if ( $icon ) : ?>
							<div class="adv__item__icon">
								<img src="<?php echo esc_url( $icon ); ?>" alt="<?php echo esc_attr( $title ); ?>">
							</div>
						<?php endif; ?>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
</section>
<?php endif; ?>