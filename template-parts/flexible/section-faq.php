<?php 
$faq_title = get_sub_field('faq_title');
$faq_description = get_sub_field('faq_description');
$faq = get_sub_field('faq'); 
?>

<section class="faq mb-m">
	<div class="container">
		<div class="faq__container">
			<?php if ( $faq_title || $faq_description ) : ?>
				<div class="faq__title justify-title">
					<?php if ( $faq_title ) : ?>
						<div class="title"><?php echo esc_html( $faq_title ); ?></div>
					<?php endif; ?>
					
					<?php if ( $faq_description ) : ?>
						<p><?php echo esc_html( $faq_description ); ?></p>
					<?php endif; ?>
				</div>
			<?php endif; ?>
			
			<?php if ( $faq ) : ?>
				<div class="faq__items accord" itemscope itemtype="https://schema.org/FAQPage">
					<?php foreach ( $faq as $index => $item ) : 
						$faq_ask = $item['faq_ask'];
						$faq_answer = $item['faq_answer'];
					?>
						<div class="faq__item accord-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
							<div class="faq__item__top accord-item-top">
								<h3 itemprop="name"><?php echo esc_html( $faq_ask ); ?></h3>
								<div class="faq-icon-wrapper">
									<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M8 1L8 15" stroke="#474F5A" stroke-width="2" stroke-linecap="square"/>
										<path d="M1 8H15" stroke="#474F5A" stroke-width="2" stroke-linecap="square"/>
									</svg>
								</div>
							</div>
							<div class="faq__item-bottom accord-item-bottom" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
								<div class="faq__item-bottom-wrap">
									<div itemprop="text"><?php echo  $faq_answer ; ?></div>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>