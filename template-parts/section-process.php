<?php
/**
 * Reusable process block.
 *
 * Args:
 *   image   (string)  — absolute URL or path to image
 *   reverse (bool)    — flip layout: image right, content left. Default false.
 */
$image   = $args['image']   ?? '';
$reverse = ! empty( $args['reverse'] );
?>

<section class="process-block<?php echo $reverse ? ' process-block--reverse' : ''; ?>">
    <div class="container">
        <div class="process-block__inner">

            <?php if ( $image ) : ?>
            <div class="process-block__img-wrap">
                <img src="<?php echo esc_url( $image ); ?>" alt="" loading="lazy" class="process-block__img">
            </div>
            <?php endif; ?>

            <div class="process-block__content">
                <?php echo $args['content'] ?? ''; ?>
            </div>

        </div>
    </div>
</section>
