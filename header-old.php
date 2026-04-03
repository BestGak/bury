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
include TYRBOTA_REQUIRE_DIRECTORY . '/template-parts/content-variables.php';?>
<header class="header">
	
<div class="container">	
	<div class="header__container">	
		<?php
		if($site_logo) { ?>
		<a href="<?= get_home_url(); ?>" class="logo">
			<img src="<?= $site_logo ?>" alt="<?= the_title() ?>">
		</a>
		<?php } ?>
		<div class="header__info">
			<button class="search-btn open">
				<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
					<path fill-rule="evenodd" clip-rule="evenodd" d="M7.5 0C6.31161 0 5.14023 0.282399 4.0824 0.823925C3.02456 1.36545 2.11055 2.1506 1.41568 3.11467C0.720821 4.07874 0.264998 5.19414 0.0857786 6.36894C-0.0934407 7.54373 0.00907469 8.7443 0.384876 9.87171C0.760678 10.9991 1.39901 12.0211 2.24726 12.8534C3.09552 13.6857 4.12941 14.3045 5.26374 14.6589C6.39808 15.0132 7.60038 15.0929 8.77156 14.8914C9.94275 14.6899 11.0493 14.213 12 13.5L16.5 18L18 16.5L13.5 12C14.3357 10.8857 14.8446 9.56075 14.9697 8.17354C15.0948 6.78633 14.8311 5.39169 14.2082 4.1459C13.5853 2.9001 12.6278 1.85238 11.443 1.12012C10.2582 0.38786 8.89284 0 7.5 0ZM2 7.5C2 6.04131 2.57946 4.64236 3.61091 3.61091C4.64236 2.57946 6.04131 2 7.5 2C8.95869 2 10.3576 2.57946 11.3891 3.61091C12.4205 4.64236 13 6.04131 13 7.5C13 8.95869 12.4205 10.3576 11.3891 11.3891C10.3576 12.4205 8.95869 13 7.5 13C6.04131 13 4.64236 12.4205 3.61091 11.3891C2.57946 10.3576 2 8.95869 2 7.5Z" fill="white"/>
				</svg>
			</button>
			<div class="search-block">
				<div class="container"> 
					<div class="search-btn__wrap">
						<button class="search-btn-close close">
							<svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17" fill="none">
								<path d="M14.8823 0.321533C15.0243 0.321533 15.1652 0.349215 15.2964 0.403564C15.4277 0.458024 15.5476 0.538311 15.6479 0.638916L15.647 0.639893C16.0689 1.06235 16.0699 1.75191 15.6392 2.17505L9.66846 8.14673L15.647 14.1194C15.7475 14.2198 15.8279 14.3387 15.8823 14.47C15.9367 14.6012 15.9643 14.742 15.9644 14.884C15.9644 15.0261 15.9367 15.1669 15.8823 15.2981C15.8279 15.4294 15.7476 15.5493 15.647 15.6497L15.6411 15.6545C15.4309 15.8542 15.1617 15.9641 14.8784 15.9641C14.6025 15.964 14.3276 15.8664 14.1099 15.6487L8.13916 9.677L2.17529 15.6487L2.16943 15.6545C1.95925 15.8542 1.69009 15.9641 1.40674 15.9641V15.9631C1.19321 15.9639 0.984212 15.9023 0.806152 15.7844C0.627628 15.6662 0.488314 15.4976 0.405762 15.3C0.323205 15.1024 0.30084 14.8843 0.342285 14.6741C0.383744 14.464 0.486833 14.2709 0.638184 14.1194L6.60889 8.14771L0.638184 2.17603C0.43545 1.97327 0.321881 1.69809 0.321777 1.41138C0.321777 1.12452 0.435354 0.848602 0.638184 0.645752C0.840918 0.443045 1.11615 0.329444 1.40283 0.329346C1.68969 0.329346 1.96563 0.442901 2.16846 0.645752L8.13916 6.61646L14.1177 0.638916L14.1968 0.567627C14.2788 0.500244 14.3699 0.444387 14.4683 0.403564C14.5994 0.34914 14.7403 0.32157 14.8823 0.321533Z" fill="white" stroke="white" stroke-width="0.642857"/>
							</svg>
						</button>
					</div>
					<div class="search__wrap">						
						<div class="search__container"> 
						<form action="<?= esc_url( home_url( '/pansionaty/' ) ) ?>" method="get">
						<input class="input__search-input" type="text" name="pansionat_search" placeholder="<?= __('Пошук по сайту......' , 'tyrbota') ?>" autocomplete="off">
						<div class="input__submit">
								<span><?= __('Знайти' , 'tyrbota') ?></span>
								<input type="submit" value="">
								<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
									<path fill-rule="evenodd" clip-rule="evenodd" d="M8.83333 3C7.90903 3 6.99796 3.21964 6.1752 3.64083C5.35243 4.06202 4.64154 4.67269 4.10109 5.42252C3.56064 6.17236 3.20611 7.03989 3.06672 7.95362C2.92732 8.86735 3.00706 9.80112 3.29935 10.678C3.59164 11.5549 4.08812 12.3497 4.74787 12.9971C5.40762 13.6444 6.21176 14.1257 7.09402 14.4013C7.97628 14.6769 8.9114 14.7389 9.82232 14.5822C10.7332 14.4255 11.5939 14.0546 12.3333 13.5L15.8333 17L17 15.8333L13.5 12.3333C14.15 11.4667 14.5458 10.4361 14.6431 9.3572C14.7404 8.27826 14.5353 7.19354 14.0508 6.22459C13.5663 5.25564 12.8216 4.44074 11.9001 3.8712C10.9786 3.30167 9.91665 3 8.83333 3ZM4.55556 8.83333C4.55556 7.6988 5.00625 6.61073 5.80849 5.80849C6.61073 5.00625 7.6988 4.55556 8.83333 4.55556C9.96787 4.55556 11.0559 5.00625 11.8582 5.80849C12.6604 6.61073 13.1111 7.6988 13.1111 8.83333C13.1111 9.96787 12.6604 11.0559 11.8582 11.8582C11.0559 12.6604 9.96787 13.1111 8.83333 13.1111C7.6988 13.1111 6.61073 12.6604 5.80849 11.8582C5.00625 11.0559 4.55556 9.96787 4.55556 8.83333Z" fill="white"/>
								</svg>
						</div>
						</form>
						
						</div>
					</div>
					
				</div>				
			</div>
			<div class="lang">
				<?= tyrbota_wpml_language_switcher(); ?>
				</div>
				<div class="header__btns">
					<button class="btn btn-primary" data-open="question-popup"><?= __('Залишити заявку' , 'tyrbota') ?></button>
					<button class="btn btn-secondary" data-open="add-popup"><?= __('Додати пансіонат' , 'tyrbota') ?></button>
				</div>
			</div>		
				<div class="burger" data-menu-toggle>
			<span></span>
			<span></span>
		</div>	
	</div>
	<div class="header__bottom">
		<div class="header__cat" data-menu-toggle>
			<div class="header__cat__icon">
			<span></span><span></span><span></span>
			</div>
			<?= __('Каталог' , 'tyrbota') ?>
		</div>
		<div class="header__nav">
			<nav>
					<?php
					if ( has_nav_menu( 'header-menu' ) ) {
					wp_nav_menu( array(
						'theme_location' => 'header-menu',
						'container'      => false,
						'items_wrap'     => '<ul id="%1$s" class="menu">%3$s</ul>',
					) );
					}
					?>
					
			</nav>
		</div>
		<div class="header__menu">
			<div class="container">
				<div class="header__menu__wrap">
			<nav>
					<?php
					if ( has_nav_menu( 'burger-menu' ) ) {
					wp_nav_menu( array(
						'theme_location' => 'burger-menu',
						'container'      => false,
						'items_wrap'     => '<ul id="%1$s" class="menu">%3$s</ul>',
					) );
					}
					?>
				<ul>
					<li>
						<a href="#">Меню</a>
						<ul class="sub-menu">
							<li><a href="#">Головна</a></li>
							<li><a href="#">Новини</a></li>
							<li><a href="#">Відгуки</a></li>
							<li><a href="#">Контакти</a></li>
							<li><a href="#">Спецпропозиції</a></li>
							<li><a href="#">Пансіонати для літніх 65</a></li>
						</ul>
					</li>
					<li>
						<a href="#">Про нас</a>
						<ul class="sub-menu">
							<li><a href="#">Про нас</a></li>
							<li><a href="#">FAQ</a></li>
						</ul>
					</li>
					<li>
						<a href="#">Послуги</a>
						<ul class="sub-menu">
							<li><a href="#">Для инвалидов-колясочников</a></li>
							<li><a href="#">Догляд за людьми похилого віку після 80 років</a></li>
							<li><a href="#">Для пожилых с Альцгеймера</a></li>
							<li><a href="#">Догляд за хворими людьми в умовах стаціонару</a></li>
							<li><a href="#">Догляд за людьми похилого віку після інсульту</a></li>
						</ul>
					</li>
					<li>
						<a href="#">Контакти</a>
						<ul class="sub-menu">
							<li><a href="#">Відгуки</a></li>
							<li><a href="#">Новини</a></li>
							<li><a href="#">Контакти</a></li>
						</ul>
					</li>
				</ul>
			</nav>
			<div class="header__btns">
				<button class="btn btn-primary" data-open="question-popup"><?= __('Залишити заявку' , 'tyrbota') ?></button>
					<button class="btn btn-secondary" data-open="add-popup"><?= __('Додати пансіонат' , 'tyrbota') ?></button>
				</div>
				</div>
			</div>
		</div>
	</div>
</div>
</header>