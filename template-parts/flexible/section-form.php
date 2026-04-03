<?php 
$form_content = get_sub_field('form_content'); 
$form_image = get_sub_field('form_image');
$form_choice = get_sub_field('form_choice');
?>
<section class="add mb-m">
	<div class="container">
		<div class="add__container">
			<div class="add__image">
				<?php if ( $form_image ) : ?>
					<img src="<?php echo esc_url( $form_image ); ?>" alt="<?php echo esc_attr( wp_strip_all_tags( $form_content ) ); ?>">
				<?php endif; ?>
			</div>
			
			<div class="add__form form__container">
				<?php if ( $form_content ) : ?>
					<div class="add__form__title form__title">
						<?php echo $form_content; ?>
					</div>
				<?php endif; ?>
				
				<?php if ( $form_choice && function_exists( 'wpcf7_contact_form' ) ) : ?>
					<?php echo do_shortcode( '[contact-form-7 id="' . $form_choice . '"]' ); ?>
				<?php else : ?>
					<p><?php _e( 'Форма не вибрана', 'tyrbota' ); ?></p>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>