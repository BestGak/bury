<?php
    $author_id = get_sub_field('author_choice');
    $author_name = get_the_author_meta( 'display_name' );
    $author_description = get_the_author_meta( 'description' );
    $author_url = get_author_posts_url( $author_id );
    $author_logo = get_field( 'author_logo', 'user_' . $author_id );
?>
<section class="author mb-m">
        <div class="container">
            <div class="autor">
                <?php if ( $author_logo ) : ?>
                    <img src="<?php echo esc_url( $author_logo ); ?>" alt="<?php echo esc_attr( $author_name ); ?>">
                <?php else : ?>
                    <?php echo get_avatar( $author_id, 120 ); ?>
                <?php endif; ?>
                <div class="autor__info">
                    <div class="autor__info__title">
                        <span><?php _e( 'Автор:', 'tyrbota' ); ?></span>
                        <a href="<?php echo esc_url( $author_url ); ?>"><?php echo esc_html( $author_name ); ?></a>
                    </div>
                    <?php if ( $author_description ) : ?>
                        <p><?php echo esc_html( $author_description ); ?></p>
                    <?php endif; ?>
            </div>
        </div>
</section>