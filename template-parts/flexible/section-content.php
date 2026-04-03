<?php 
    $content = get_sub_field('content');
?>
<?php
    if($content) { ?>
    <section class="seo mb-m">
	<div class="container">
		<div class="seo__container">
			<nav class="seo__toc js-toc">
                <button class="toc__toggle" type="button" aria-expanded="true">
                <span><?= __('Змiст' , 'tyrbota') ?></span>
                <svg width="40" height="40" viewBox="0 0 40 40" fill="none">
                    <rect x="0.5" y="0.5" width="39" height="39" rx="19.5" fill="white" stroke="#21262D"></rect>
                    <path d="M14.35 14L26.14 25.76" stroke="#21262D" stroke-width="2" stroke-linecap="round"></path>
                    <path d="M14.2 26.1L26 14.3" stroke="#21262D" stroke-width="2" stroke-linecap="round"></path>
                </svg>
                </button>
                <div class="toc__content"></div>
            </nav>
			<div class="seo__text">
                <?= $content ?>
			</div>
		</div>
	</div>
</section>
<?php } ?>
