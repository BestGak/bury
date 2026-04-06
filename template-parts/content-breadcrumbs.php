<?php
$thumb = get_the_post_thumbnail_url( null, 'full' );
$style = $thumb
    ? ' style="background: linear-gradient(0deg, rgba(0,0,0,0.60) 0%, rgba(0,0,0,0.60) 100%), url(' . esc_url( $thumb ) . ') lightgray 50% / cover no-repeat"'
    : '';
?>
<section class="breadcrumbs<?php echo $thumb ? ' breadcrumbs--has-thumb' : ''; ?>"<?php echo $style; ?>>
	<div class="container breadcrumbs__inner">
		<nav class="breadcrumbs__nav" aria-label="Breadcrumb">
			<?php if ( function_exists( 'yoast_breadcrumb' ) ) : ?>
				<?php yoast_breadcrumb(); ?>
			<?php else : ?>
				<?php echo bury_fallback_breadcrumbs(); ?>
			<?php endif; ?>
		</nav>
		<h1 class="breadcrumbs__title"><?php the_title(); ?></h1>
	</div>
</section>
