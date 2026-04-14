<?php
$cert_title       = get_field( 'certificates_title', 'option' ) ?: __( 'Our Certification', 'bury' );
$cert_description = get_field( 'certificates_description', 'option' ) ?: __( 'All works carried out safely and in full compliance with UK regulations.', 'bury' );
$certificates     = get_field( 'certificates', 'option' );
?>
<section class="certification">
    <div class="container">

        <div class="certification__left">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/quote.svg" alt="" aria-hidden="true">
            <h2 class="certification__title"><?php echo esc_html( $cert_title ); ?></h2>
            <p class="certification__subtitle"><?php echo esc_html( $cert_description ); ?></p>
        </div>

        <div class="certification__logos">
            <?php if ( $certificates ) :
                foreach ( $certificates as $cert ) :
                    $logo = $cert['certificates_logo'];
                    $logo_url = is_array( $logo ) ? $logo['url'] : $logo;
                    $logo_alt = is_array( $logo ) ? ( $logo['alt'] ?? '' ) : '';
                    $link     = $cert['certificates_link'] ?? '';
            ?>
            <div class="certification__logo">
                <?php if ( $link ) : ?>
                <a href="<?php echo esc_url( $link ); ?>" target="_blank" rel="noopener nofollow">
                <?php endif; ?>
                    <img src="<?php echo esc_url( $logo_url ); ?>" alt="<?php echo esc_attr( $logo_alt ); ?>" loading="lazy">
                <?php if ( $link ) : ?>
                </a>
                <?php endif; ?>
            </div>
            <?php endforeach; else : ?>
            <div class="certification__logo">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/partner1.png" alt="Checkatrade" loading="lazy">
            </div>
            <div class="certification__logo">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/partner2.png" alt="CSCS" loading="lazy">
            </div>
            <div class="certification__logo">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/partner3.png" alt="IPAF" loading="lazy">
            </div>
            <div class="certification__logo">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/partner4.png" alt="PASMA" loading="lazy">
            </div>
            <?php endif; ?>
        </div>

    </div>
</section>
