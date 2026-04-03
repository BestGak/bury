<?php
$hero_label  = get_sub_field( 'hero_label' );
$hero_title  = get_sub_field( 'hero_title' );
$hero_link   = get_sub_field( 'hero_link' );
$hero_images = get_sub_field( 'hero_images' );

$link_url    = $hero_link['url']    ?? '#';
$link_text   = $hero_link['title']  ?? __( 'Каталог пансіонатів', 'tyrbota' );
$link_target = ! empty( $hero_link['target'] ) ? ' target="' . esc_attr( $hero_link['target'] ) . '"' : '';
?>
<section class="hero">
    <div class="container">
        <div class="hero__container">
            <div class="hero__content">
                <?php if ( $hero_label ) : ?>
                <div class="hero__label">
                    <img src="<?= get_template_directory_uri() ?>/assets/images/hero-icon.svg" alt="<?= esc_attr( $hero_label ) ?>">
                    <?= esc_html( $hero_label ) ?>
                </div>
                <?php endif; ?>

                <div class="hero__title">
                    <?= $hero_title ? esc_html( $hero_title ) : 'Офіційний сервіс пошуку та вибору пансіонатів по всій Україні' ?>
                </div>

                <a href="<?= esc_url( $link_url ) ?>" class="btn btn-third"<?= $link_target ?>>
                    <?= esc_html( $link_text ) ?>
                </a>
            </div>
        </div>
    </div>
    <div class="hero__marquee">
        <div class="marquee">
            <div class="marquee__wrap">
                <?php if ( $hero_images ) : ?>
                    <?php foreach ( $hero_images as $item ) :
                        if ( empty( $item ) ) continue;
                        $img = $item['hero_image'];
                    ?>
                    <img src="<?= esc_url( $img['url'] ) ?>" alt="<?= esc_attr( $img['alt'] ?? '' ) ?>">
                    <?php endforeach; ?>

                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
