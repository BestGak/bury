<?php 
    $about_image = get_sub_field('about_image');
    $about_content = get_sub_field('about_content');
    $about_bg = get_sub_field('about_bg');    
    $class = $about_bg ? 'care care-without' : 'care';
?>
<section class="pb-m <?= $class ?>">
	<div class="container">
		<div class="care__container">
            <?php if($about_image) : ?>
			<div class="care__img">
				<img src="<?= $about_image['url'] ?>" alt="<?= !empty($about_image['alt']) ? $about_image['alt'] : the_title() ?>">
			</div>
            <?php endif; ?>
            <?php if($about_content) : ?>
			<div class="care__content">
				<?= $about_content ?>
			</div>
            <?php endif;?>
		</div>
	</div>
</section>