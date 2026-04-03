<?php get_header(); ?>

<main class="main">
	<section class="error">
		<div class="container error__inner">
			<img src="<?php echo get_template_directory_uri(); ?>/assets/images/404.svg" alt="404" class="error__img">
			<h1 class="error__title"><?= __('Page not found', 'bury') ?></h1>
			<p class="error__text"><?= __('It may have been deleted or is temporarily unavailable.<br> Return to the homepage or use the menu to find the section you\'re looking for.', 'bury') ?></p>
			<a href="<?php echo home_url('/'); ?>" class="btn btn--secondary error__btn">
				<?= __('Go to home', 'bury') ?>
				<img src="<?php echo get_template_directory_uri(); ?>/assets/images/header-arrow.svg" alt="404" aria-hidden="true">
			</a>
		</div>
	</section>
</main>

<?php get_footer(); ?>