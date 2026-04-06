<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Aomine Theme
 * @since Aomine Theme
 * @version 1.0.0
 */
include BURY_REQUIRE_DIRECTORY . '/template-parts/content-variables.php';
?>
<?= get_template_part('template-parts/section' , 'form') ?>
</main>
<footer class="footer">

	<div class="footer__logo-wrap">
		<?php if ( $site_logo_footer ) : ?>
			<a href="<?php echo home_url('/'); ?>" class="footer__logo">
				<img src="<?php echo esc_url( $site_logo_footer ); ?>" alt="Drylining Bury">
			</a>
		<?php else : ?>
			<a href="<?php echo home_url('/'); ?>" class="footer__logo">
				<img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.svg" alt="Drylining Bury">
			</a>
		<?php endif; ?>
	</div>

	<div class="footer__main">
		<div class="container">
			<div class="footer__grid">

                <?php if ( has_nav_menu('footer-menu') ) : ?>
				<div class="footer__col">
					<p class="footer__col-title"><?= __('Menu', 'bury') ?></p>
						<?php wp_nav_menu([
							'theme_location' => 'footer-menu',
							'container'      => false,
							'items_wrap'     => '<ul class="footer__nav-list">%3$s</ul>',
						]); ?>
				</div>
                <?php endif; ?>

				<div class="footer__col">
					<p class="footer__col-title"><?= __('Services', 'bury') ?></p>
					<ul class="footer__nav-list">
						<li class="footer__nav-item"><a href="#" class="footer__nav-link">Tape & Jointing</a></li>
						<li class="footer__nav-item"><a href="#" class="footer__nav-link">Drylining (1st & 2nd Fix)</a></li>
						<li class="footer__nav-item"><a href="#" class="footer__nav-link">Painting & Decorating</a></li>
						<li class="footer__nav-item"><a href="#" class="footer__nav-link">Suspended Ceilings</a></li>
					</ul>
				</div>

				<div class="footer__col">
					<p class="footer__col-title"><?= __('Services Area', 'bury') ?></p>
					<ul class="footer__nav-list footer__nav-list--area">
						<li class="footer__nav-item"><a href="#" class="footer__nav-link">Bury</a></li>
						<li class="footer__nav-item"><a href="#" class="footer__nav-link">Manchester</a></li>
						<li class="footer__nav-item"><a href="#" class="footer__nav-link">Rochdale</a></li>
						<li class="footer__nav-item"><a href="#" class="footer__nav-link">Greater Manchester</a></li>
					</ul>
				</div>

				<div class="footer__col">
					<p class="footer__col-title"><?= __('Contact Us', 'bury') ?></p>
					<ul class="footer__contacts">
						<?php if ( $contact_phone ) : ?>
						<li class="footer__contact-item">
							<span class="footer__contact-icon">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
									<g clip-path="url(#clip0_2023_1293)">
										<path d="M5.0048 7.72878L5.0057 7.72969C5.02986 7.22173 5.18482 6.82408 5.47986 6.39375L5.61508 6.20625L5.61597 6.20535C5.84456 5.9046 6.19476 5.57529 6.53004 5.30571C6.85625 5.04342 7.24887 4.77339 7.57751 4.64586C8.1886 4.4092 8.85017 4.44312 9.38311 4.87662L9.38941 4.88203C9.48287 4.95989 9.60492 5.09736 9.70221 5.20926C9.81639 5.34057 9.95358 5.50451 10.0934 5.6762C10.3701 6.01589 10.6778 6.40986 10.8615 6.6723L10.8624 6.6741C11.1276 7.05533 11.4985 7.65112 11.6521 7.94783L11.6538 7.95144C11.9052 8.44462 11.964 8.97939 11.7845 9.50732C11.7213 9.69222 11.6405 9.87185 11.469 10.0653C11.3317 10.2203 11.1431 10.3742 10.9137 10.5566L10.5902 10.8208C10.5661 10.8405 10.5453 10.8587 10.527 10.8739L10.5126 10.9027C10.5206 10.8857 10.4971 10.9093 10.5244 11.0434C10.5537 11.188 10.6317 11.4044 10.7939 11.7303V11.7321C11.0266 12.2022 11.3243 12.6273 11.7864 13.1321L11.7872 13.1338C12.1742 13.5583 12.6731 13.9784 13.033 14.1976L13.0339 14.1984C13.266 14.3401 13.5401 14.4683 13.7966 14.5599C14.0622 14.6549 14.2516 14.6898 14.3356 14.6915C14.3356 14.6915 14.3454 14.691 14.3644 14.6879C14.3841 14.6848 14.4072 14.6792 14.4303 14.6726C14.4421 14.6692 14.4527 14.6659 14.4618 14.6627C14.476 14.6475 14.4933 14.6291 14.5132 14.6068C14.58 14.5317 14.6644 14.4315 14.7494 14.3264L15.0577 13.9568C15.153 13.8489 15.2428 13.756 15.3308 13.6783C15.5376 13.4956 15.7328 13.3973 15.9582 13.333L16.0564 13.3087C16.5508 13.2044 17.0624 13.3905 17.5123 13.6215L17.5132 13.6206C17.9726 13.8561 18.6147 14.3046 19.162 14.733C19.4406 14.9512 19.7082 15.1745 19.9291 15.3766C20.134 15.5641 20.3474 15.7775 20.4736 15.9679L20.4781 15.9751C20.5468 16.0818 20.6424 16.2602 20.6935 16.4096L20.6917 16.4106C20.7449 16.5619 20.7764 16.7269 20.79 16.8721C20.8032 17.0141 20.8059 17.1963 20.7692 17.3688C20.7232 17.5873 20.6278 17.7896 20.5042 17.9962C20.381 18.2022 20.2082 18.4482 19.9787 18.757L19.9778 18.7589C19.8176 18.9731 19.6046 19.2143 19.408 19.416C19.231 19.5976 19.0006 19.8171 18.8131 19.9289L18.8077 19.9326C18.4756 20.1264 18.1277 20.2344 17.7025 20.2165C17.3168 20.2002 16.903 20.0802 16.4315 19.9091C14.7839 19.3104 13.2035 18.4376 11.6881 17.2994C8.77905 15.1149 6.6593 12.3582 5.24368 8.9205L5.12469 8.6122C5.09021 8.51287 5.06144 8.41584 5.04086 8.31742C4.99659 8.10548 4.99523 7.92054 5.0048 7.72878Z" fill="white"/>
									</g>
									<defs>
										<clipPath id="clip0_2023_1293">
										<rect width="24" height="24" fill="white"/>
										</clipPath>
									</defs>
								</svg>
							</span>
							<span class="footer__contact-text">
								<span class="footer__contact-label"><?= __('phone', 'bury') ?></span>
								<a href="tel:<?php echo esc_attr( preg_replace('/\s+/', '', $contact_phone) ); ?>"><?php echo esc_html( $contact_phone ); ?></a>
							</span>
						</li>
						<?php endif; ?>
						<?php if ( $contact_email ) : ?>
						<li class="footer__contact-item">
							<span class="footer__contact-icon">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
									<path d="M22.8244 5.50391L16.7588 11.5304L22.8244 17.5569C22.934 17.3277 23.0006 17.0744 23.0006 16.8038V6.25699C23.0006 5.98641 22.934 5.73309 22.8244 5.50391Z" fill="white"/>
									<path d="M21.2423 4.5H4.75796C4.48738 4.5 4.23406 4.56652 4.00488 4.67617L11.7573 12.3896C12.4428 13.0751 13.5575 13.0751 14.2429 12.3896L21.9954 4.67617C21.7662 4.56652 21.5129 4.5 21.2423 4.5Z" fill="white"/>
									<path d="M3.17617 5.50391C3.06652 5.73309 3 5.98641 3 6.25699V16.8038C3 17.0744 3.06652 17.3278 3.17617 17.5569L9.24176 11.5304L3.17617 5.50391Z" fill="white"/>
									<path d="M15.9298 12.3594L15.0715 13.2177C13.9293 14.3599 12.0709 14.3599 10.9288 13.2177L10.0705 12.3594L4.00488 18.3859C4.23406 18.4956 4.48738 18.5621 4.75796 18.5621H21.2423C21.5129 18.5621 21.7662 18.4956 21.9954 18.3859L15.9298 12.3594Z" fill="white"/>
								</svg>
							</span>
							<span class="footer__contact-text">
								<span class="footer__contact-label"><?= __('email', 'bury') ?></span>
								<a href="mailto:<?php echo esc_attr( $contact_email ); ?>"><?php echo esc_html( $contact_email ); ?></a>
							</span>
						</li>
						<?php endif; ?>
						<?php if ( $contact_address ) : ?>
						<li class="footer__contact-item">
							<span class="footer__contact-icon">
								<svg xmlns="http://www.w3.org/2000/svg" width="15" height="20" viewBox="0 0 15 20" fill="none">
									<path d="M7.5 0C3.36675 0 0 3.3675 0 7.5C0 9.62475 1.0575 11.817 2.4285 13.8675C3.80025 15.9187 5.5155 17.826 6.96975 19.2803C7.1104 19.4209 7.30113 19.4998 7.5 19.4998C7.69887 19.4998 7.8896 19.4209 8.03025 19.2803C9.5175 17.793 11.2327 15.885 12.5963 13.8412C13.9598 11.7983 15 9.62025 15 7.5C15 3.3675 11.6333 0 7.5 0ZM7.5 4.5C9.14775 4.5 10.5 5.85225 10.5 7.5C10.5 9.14775 9.14775 10.5 7.5 10.5C5.85225 10.5 4.5 9.14775 4.5 7.5C4.5 5.85225 5.85225 4.5 7.5 4.5Z" fill="white"/>
								</svg>
							</span>
							<span class="footer__contact-text">
								<span class="footer__contact-label"><?= __('address', 'bury') ?></span>
								<a href="https://maps.google.com/?q=<?php echo urlencode( $contact_address ); ?>" target="_blank" rel="noopener"><?php echo esc_html( $contact_address ); ?></a>
							</span>
						</li>
						<?php endif; ?>
					</ul>

					<div class="footer__socials">
						<?php if ( $linkedin ) : ?>
						<a href="<?php echo esc_url( $linkedin ); ?>" class="footer__social-link" rel="nofollow noopener" target="_blank" aria-label="LinkedIn">
							<svg xmlns="http://www.w3.org/2000/svg" width="16" height="15" viewBox="0 0 16 15" fill="none"><path d="M0.193257 4.85233H3.55016V14.9332H0.193257V4.85233ZM14.567 5.77315C13.8619 5.0034 12.9292 4.61846 11.7696 4.61846C11.3424 4.61846 10.954 4.67101 10.6047 4.77619C10.2555 4.8813 9.96056 5.02877 9.71973 5.21868C9.47905 5.40859 9.28736 5.58488 9.14506 5.74757C9.00974 5.90209 8.87741 6.0821 8.74828 6.28572V4.85226H5.40139L5.41165 5.3406C5.41853 5.66622 5.42191 6.66985 5.42191 8.35162C5.42191 10.0335 5.41514 12.2273 5.40153 14.9332H8.74828V9.30774C8.74828 8.96196 8.78537 8.68736 8.86013 8.48373C9.00265 8.13769 9.21774 7.84799 9.50613 7.61411C9.79449 7.37995 10.1521 7.26298 10.5795 7.26298C11.1625 7.26298 11.5916 7.46472 11.8663 7.86823C12.1409 8.2717 12.2782 8.82952 12.2782 9.54162V14.9329H15.625V9.15532C15.6248 7.66998 15.2724 6.54265 14.567 5.77315ZM1.89206 0C1.32925 0 0.873218 0.164575 0.523867 0.493403C0.174551 0.822303 0 1.23753 0 1.73949C0 2.23442 0.169527 2.64823 0.508617 2.98044C0.8476 3.31269 1.29525 3.4789 1.85133 3.4789H1.87167C2.4414 3.4789 2.90092 3.31283 3.25013 2.98044C3.59933 2.64823 3.77054 2.23457 3.7638 1.73949C3.75703 1.23757 3.58398 0.822303 3.24499 0.493403C2.90605 0.164432 2.4549 0 1.89206 0Z" fill="currentColor"/></svg>
						</a>
						<?php endif; ?>
						<?php if ( $facebook ) : ?>
						<a href="<?php echo esc_url( $facebook ); ?>" class="footer__social-link" rel="nofollow noopener" target="_blank" aria-label="Facebook">
							<svg xmlns="http://www.w3.org/2000/svg" width="9" height="18" viewBox="0 0 9 18" fill="none"><path d="M5.36802 5.62043V3.27668C5.36829 3.12269 5.39638 2.97027 5.45068 2.82814C5.50498 2.686 5.58442 2.55692 5.68447 2.4483C5.78452 2.33967 5.90321 2.25362 6.03376 2.19507C6.16431 2.13651 6.30417 2.1066 6.44532 2.10704H7.51851V-0.821533H5.37007C4.94704 -0.82168 4.52815 -0.730911 4.13729 -0.554412C3.74643 -0.377913 3.39127 -0.119142 3.0921 0.207121C2.79293 0.533385 2.5556 0.920748 2.39369 1.34708C2.23178 1.77342 2.14845 2.23038 2.14845 2.69186V5.62043H0V8.55347H2.14845V17.9285H5.36905V8.55347H7.5175L8.59375 5.62043H5.36802Z" fill="currentColor"/></svg>
						</a>
						<?php endif; ?>
						<?php if ( $instagram ) : ?>
						<a href="<?php echo esc_url( $instagram ); ?>" class="footer__social-link" rel="nofollow noopener" target="_blank" aria-label="Instagram">
							<svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 19 19" fill="none"><path d="M9.38045 1.68856C11.8868 1.68856 12.1836 1.69954 13.1694 1.7435C14.0854 1.78379 14.5801 1.93763 14.9098 2.06583C15.3459 2.23431 15.661 2.43944 15.9872 2.76543C16.3169 3.09508 16.5185 3.40642 16.6871 3.8423C16.8153 4.17195 16.9692 4.67009 17.0095 5.58214C17.0535 6.5711 17.0644 6.86778 17.0644 9.3695C17.0644 11.8748 17.0535 12.1716 17.0095 13.1569C16.9692 14.0726 16.8153 14.5671 16.6871 14.8967C16.5185 15.3325 16.3133 15.6475 15.9872 15.9735C15.6574 16.3032 15.3459 16.5047 14.9098 16.6732C14.5801 16.8013 14.0817 16.9552 13.1694 16.9954C12.18 17.0394 11.8832 17.0504 9.38045 17.0504C6.87415 17.0504 6.57734 17.0394 5.59165 16.9954C4.67559 16.9552 4.18092 16.8013 3.85113 16.6732C3.41509 16.5047 3.09996 16.2996 2.77384 15.9735C2.44406 15.6439 2.24253 15.3325 2.07397 14.8967C1.94572 14.5671 1.79182 14.0689 1.75152 13.1569C1.70754 12.1678 1.69655 11.8712 1.69655 9.3695C1.69655 6.86412 1.70754 6.56744 1.75152 5.58214C1.79182 4.66643 1.94572 4.17195 2.07397 3.8423C2.24253 3.40642 2.44772 3.09142 2.77384 2.76543C3.10362 2.43578 3.41509 2.23431 3.85113 2.06583C4.18092 1.93763 4.67926 1.78379 5.59165 1.7435C6.57734 1.69954 6.87415 1.68856 9.38045 1.68856ZM9.38045 0C6.83384 0 6.51505 0.0109885 5.5147 0.0549423C4.51803 0.0988962 3.83281 0.26006 3.2392 0.490818C2.61995 0.732563 2.09595 1.05123 1.57563 1.57501C1.05164 2.09513 0.732851 2.61892 0.49101 3.23427C0.260162 3.83131 0.0989351 4.51259 0.0549638 5.50888C0.0109928 6.51249 0 6.83116 0 9.37677C0 11.9225 0.0109928 12.2412 0.0549638 13.2411C0.0989351 14.2373 0.260162 14.9223 0.49101 15.5157C0.732851 16.1347 1.05164 16.6585 1.57563 17.1787C2.09595 17.6988 2.61995 18.0211 3.23554 18.2591C3.83281 18.4899 4.51436 18.6511 5.51104 18.695C6.51138 18.739 6.83018 18.75 9.37682 18.75C11.9235 18.75 12.2423 18.739 13.2426 18.695C14.2393 18.6511 14.9245 18.4899 15.5181 18.2591C16.1338 18.0211 16.6577 17.6988 17.178 17.1787C17.6984 16.6585 18.0208 16.1347 18.259 15.5194C18.4898 14.9223 18.651 14.2411 18.695 13.2448C18.739 12.2448 18.75 11.9261 18.75 9.3805C18.75 6.83482 18.739 6.51615 18.695 5.51621C18.651 4.51991 18.4898 3.83497 18.259 3.2416C18.0281 2.61892 17.7094 2.09513 17.1854 1.57501C16.6651 1.05489 16.141 0.732563 15.5255 0.49448C14.9282 0.263723 14.2466 0.102559 13.25 0.0586051C12.246 0.0109884 11.9272 0 9.38045 0Z" fill="currentColor"/><path d="M9.38046 4.5605C6.72025 4.5605 4.562 6.7179 4.562 9.37708C4.562 12.0364 6.72025 14.1937 9.38046 14.1937C12.0408 14.1937 14.1989 12.0364 14.1989 9.37708C14.1989 6.7179 12.0408 4.5605 9.38046 4.5605ZM9.38046 12.5015C7.65463 12.5015 6.25488 11.1023 6.25488 9.37708C6.25488 7.65193 7.65463 6.25273 9.38046 6.25273C11.1064 6.25273 12.5061 7.65193 12.5061 9.37708C12.5061 11.1023 11.1064 12.5015 9.38046 12.5015Z" fill="currentColor"/><path d="M15.5138 4.36983C15.5138 4.99251 15.0081 5.49432 14.3888 5.49432C13.7659 5.49432 13.2639 4.98885 13.2639 4.36983C13.2639 3.74715 13.7696 3.24535 14.3888 3.24535C15.0081 3.24535 15.5138 3.75081 15.5138 4.36983Z" fill="currentColor"/></svg>
						</a>
						<?php endif; ?>
					</div>
				</div>

			</div>
		</div>
	</div>

	<div class="footer__bottom">
		<div class="container footer__bottom-inner">
			<p class="footer__copyright">
				<?php echo $footer_copyright ? esc_html( $footer_copyright ) : '2026 Drylining Bury Limited.'; ?>
			</p>
			<?php if ( has_nav_menu('footer-additional') ) : ?>
				<?php wp_nav_menu([
					'theme_location' => 'footer-additional',
					'container'      => false,
					'items_wrap'     => '<ul class="footer__bottom-nav">%3$s</ul>',
				]); ?>
			<?php endif; ?>
			<div class="footer__dev">
				<span><?= __('Development', 'bury') ?></span>
				<a href="https://lumios.agency" target="_blank" rel="noopener" class="footer__dev-badge">LUMIOS</a>
			</div>
		</div>
	</div>

</footer>

<?php wp_footer(); ?>
</body>
</html>
