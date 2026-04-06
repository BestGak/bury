<?php
$address = get_field( 'project_address' );
?>
<article class="project-card">
    <a href="<?php the_permalink(); ?>" class="project-card__img-wrap">
        <?php if ( has_post_thumbnail() ) : ?>
            <div class="project-card__date">
                <span class="project-card__day"><?php echo get_the_date( 'j' ); ?></span>
                <span class="project-card__month"><?php echo strtoupper( get_the_date( 'F' ) ); ?></span>
                <span class="project-card__year"><?php echo get_the_date( 'Y' ); ?></span>
            </div>
            <?php the_post_thumbnail( 'large', [ 'class' => 'project-card__img', 'alt' => get_the_title() ] ); ?>
        <?php endif; ?>
    </a>
    <div class="project-card__body">
        <?php if ( $address ) : ?>
        <p class="project-card__address">
            <svg width="14" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0 1 18 0z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><circle cx="12" cy="10" r="3" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            <?php echo esc_html( $address ); ?>
        </p>
        <?php endif; ?>
        <div class="project-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
        <p class="project-card__excerpt"><?php echo wp_trim_words( get_the_excerpt(), 20 ); ?></p>
        <a href="<?php the_permalink(); ?>" class="btn btn--silver btn--sm project-card__btn">
            <?= __( 'Learn more', 'bury' ) ?>
            <span class="btn__icon">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7 17L17 7M17 7H7M17 7v10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </span>
        </a>
    </div>
</article>
