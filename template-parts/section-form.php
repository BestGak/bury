<?php 
    include BURY_REQUIRE_DIRECTORY . '/template-parts/content-variables.php';
?>
<section class="cform">
    <div class="container-l cform__inner" style="background: linear-gradient(90deg, #102331 0%, rgba(16, 35, 49, 0.60) 49.42%, rgba(16, 35, 49, 0.00) 100%), url('<?php echo get_template_directory_uri(); ?>/assets/images/form.webp') center / cover no-repeat;">
        <div class="cform__left">
            <h2 class="cform__title"><?= __('Ready to start your project?', 'bury') ?></h2>
            <p class="cform__desc"><?= __("Whether it's a commercial or private project, DryLining Bury Limited delivers reliable, high-quality drylining and interior finishing across Manchester and Greater Manchester.", 'bury') ?></p>
            <div class="cform__contacts">
                <?php if ( $contact_phone ) : ?>
                <a href="tel:<?php echo esc_attr( preg_replace('/\s+/', '', $contact_phone) ); ?>" class="cform__contact-item">
                    <span class="cform__contact-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.6 1.27h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L7.91 8.91a16 16 0 0 0 6 6l.91-.91a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 21.73 16.92z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </span>
                    <span class="cform__contact-text">
                        <strong><?php echo esc_html( $contact_phone ); ?></strong>
                        <span><?= __('call now', 'bury') ?></span>
                    </span>
                </a>
                <?php endif; ?>
                <?php if ( $contact_email ) : ?>
                <a href="mailto:<?php echo esc_attr( $contact_email ); ?>" class="cform__contact-item">
                    <span class="cform__contact-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><polyline points="22,6 12,13 2,6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </span>
                    <span class="cform__contact-text">
                        <strong><?php echo esc_html( $contact_email ); ?></strong>
                        <span><?= __('write now', 'bury') ?></span>
                    </span>
                </a>
                <?php endif; ?>
            </div>
        </div>

        <div class="cform__right">
            <div class="cform__form-wrap">
                <?= do_shortcode('[contact-form-7 id="06617ca" title="Contact form 1"]') ?>
            </div>
        </div>

    </div>
</section>