<?php $post_type = get_post_type();?>
<?php get_header(); ?>
        <?= get_template_part('template-parts/single/single' , $post_type ) ?>
<?php get_footer(); ?>