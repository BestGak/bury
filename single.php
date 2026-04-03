<?php $post_type = get_post_type(); ?>
<?php get_header(); ?>
	<main>
            <?= get_template_part('template-parts/single/single' , $post_type ) ?>
    </main><!-- .site-main -->
<?php get_footer(); ?>