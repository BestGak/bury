<?php get_header(); ?>
<main>
    <?php get_template_part( 'template-parts/content', 'breadcrumbs' ); ?>
    <article class="page-article">
        <div class="container">

            <div class="page-meta">
                <span class="page-meta__label"><?= __('Publish:', 'bury') ?></span>
                <div class="page-meta__date">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="3" y="4" width="18" height="18" rx="2" ry="2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><line x1="16" y1="2" x2="16" y2="6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><line x1="8" y1="2" x2="8" y2="6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><line x1="3" y1="10" x2="21" y2="10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    <time datetime="<?php echo get_the_date('Y-m-d'); ?>"><?php echo get_the_date('F j, Y'); ?></time>
                </div>
            </div>

            <?php the_content(); ?>

        </div>
    </article>
</main>
<?php get_footer(); ?>