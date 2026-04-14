<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
<title>
<?php
if ( function_exists( 'YoastSEO' ) && YoastSEO()->meta->for_current_page()->context->title ) {
  echo esc_html( YoastSEO()->meta->for_current_page()->context->title );
} else {
  echo esc_html( get_the_title() );
}
?>
</title>
    <?php wp_head();?> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta charset="<?php bloginfo( 'charset' ); ?>">

</head>
<body <?php body_class(); ?>>
<?php wp_body_open();
include BURY_REQUIRE_DIRECTORY . '/template-parts/content-variables.php';?>

<header class="header">
	<div class="container-l">
	<div class="header__topbar">
		<div class="container header__topbar-inner">

			<?php echo get_template_part('template-parts/header', 'socials'); ?>

			<div class="header__contacts">
				<?php if ( $contact_phone ) : ?>
				<a href="tel:<?php echo esc_attr( preg_replace('/\s+/', '', $contact_phone) ); ?>" class="header__contact-item">
					<span class="header__contact-icon">
						<svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.6 1.27h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L7.91 8.91a16 16 0 0 0 6 6l.91-.91a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 21.73 16.92z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
					</span>
					<span class="header__contact-text">
						<strong><?php echo esc_html( $contact_phone ); ?></strong>
						<?php if ( $contact_work_time ) : ?><span><?php echo esc_html( $contact_work_time ); ?></span><?php endif; ?>
					</span>
				</a>
				<?php endif; ?>
				<?php if ( $contact_address ) : ?>
				<a href="https://maps.google.com/?q=<?php echo urlencode( $contact_address ); ?>" target="_blank" rel="noopener" class="header__contact-item">
					<span class="header__contact-icon">
						<svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0 1 18 0z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><circle cx="12" cy="10" r="3" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
					</span>
					<span class="header__contact-text">
						<strong><?php echo esc_html( $contact_address ); ?></strong>
						<span><?= __('Google maps' , 'bury') ?></span>
					</span>
				</a>
				<?php endif; ?>
			</div>

		</div>
	</div>

	<div class="header__main">
			<a href="<?php echo home_url('/'); ?>" class="header__logo">
				<img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.svg" alt="Drylining Bury" width="220" height="60">
			</a>

		<nav class="header__nav">
			<?php if ( has_nav_menu('header-menu') ) : ?>
				<?php wp_nav_menu([
					'theme_location' => 'header-menu',
					'container'      => false,
					'items_wrap'     => '<ul class="header__nav-list">%3$s</ul>',
				]); ?>
			<?php endif; ?>
		</nav>

		<a href="<?php echo esc_url( home_url( '/contacts/#cform' ) ); ?>" class="btn btn--third header__cta">
			<?= __('Get a free quote' , 'bury') ?>
			<img src="<?php echo get_template_directory_uri(); ?>/assets/images/header-arrow.svg" alt="arrow" aria-hidden="true">
		</a>

		<button class="header__burger" aria-label="Open menu">
			<span></span>
			<span></span>
			<span></span>
		</button>
	</div>

	<!-- MOBILE MENU -->
	<div class="header__mobile-menu">
		<div class="header__mobile-top">
			<a href="<?php echo home_url('/'); ?>" class="header__logo">
				<img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.svg" alt="Drylining Bury" width="180" height="50">
			</a>
			<button class="header__mobile-close" aria-label="Close menu">
				<svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><line x1="18" y1="6" x2="6" y2="18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><line x1="6" y1="6" x2="18" y2="18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
			</button>
		</div>

		<nav class="header__mobile-nav">
			<?php if ( has_nav_menu('header-menu') ) : ?>
				<?php wp_nav_menu([
					'theme_location' => 'header-menu',
					'container'      => false,
					'items_wrap'     => '<ul class="header__mobile-nav-list">%3$s</ul>',
				]); ?>
			<?php endif; ?>
			<a href="<?php echo esc_url( home_url( '/contacts/#cform' ) ); ?>" class="btn btn--third header__mobile-cta">
				<?= __('Get a free quote' , 'bury') ?>
				<img src="<?php echo get_template_directory_uri(); ?>/assets/images/header-arrow.svg" alt="Button" aria-hidden="true">
			</a>
		</nav>

		<div class="header__mobile-bottom">
			<?php echo get_template_part('template-parts/header', 'socials'); ?>
			<?php if ( $contact_phone ) : ?>
			<a href="tel:<?php echo esc_attr( preg_replace('/\s+/', '', $contact_phone) ); ?>" class="header__contact-item">
				<span class="header__contact-icon">
					<svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.6 1.27h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L7.91 8.91a16 16 0 0 0 6 6l.91-.91a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 21.73 16.92z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
				</span>
				<span class="header__contact-text">
					<strong><?php echo esc_html( $contact_phone ); ?></strong>
					<?php if ( $contact_work_time ) : ?><span><?php echo esc_html( $contact_work_time ); ?></span><?php endif; ?>
				</span>
			</a>
			<?php endif; ?>
			<?php if ( $contact_address ) : ?>
			<a href="https://maps.google.com/?q=<?php echo urlencode( $contact_address ); ?>" target="_blank" rel="noopener" class="header__contact-item">
				<span class="header__contact-icon">
					<svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0 1 18 0z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><circle cx="12" cy="10" r="3" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
				</span>
				<span class="header__contact-text">
					<strong><?php echo esc_html( $contact_address ); ?></strong>
					<span>Google maps</span>
				</span>
			</a>
			<?php endif; ?>
		</div>
	</div>

	<div class="header__overlay"></div>
</div>
</header>
<main class="main">