<?php get_template_part( 'template-parts/content', 'breadcrumbs', array( 'without_bg' => true ) ); ?>
<?php
$current_post_id = get_the_ID();
$categories = get_the_category();

if ( $categories ) {
	$category_ids = array();
	foreach ( $categories as $category ) {
		$category_ids[] = $category->term_id;
	}
	
	$related_posts = new WP_Query( array(
		'post_type'      => 'post',
		'posts_per_page' => 3,
		'post__not_in'   => array( $current_post_id ),
		'category__in'   => $category_ids,
		'orderby'        => 'date',
		'order'          => 'DESC',
	) );
    }
    ?>
<div class="container-s mb-m">
	<article class="article ">
		<div class="article__important">

            <div class="news__cat">
                <?php
                if ( ! empty( $categories ) ) {
                    $category_names = array();
                    foreach ( $categories as $category ) {
                        $category_names[] = esc_html( $category->name );
                    }
                    echo implode( ', ', $category_names );
                }
                ?>
            </div>			
            <div class="news__item__info-date">
                <div class="news__item__time">
                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15" fill="none">
                        <g clip-path="url(#clip0_195_4302)">
                            <path d="M7.1875 14.375C11.1502 14.375 14.375 11.1502 14.375 7.1875C14.375 3.2248 11.1502 0 7.1875 0C3.22476 0 0 3.2248 0 7.1875C0 11.1502 3.2248 14.375 7.1875 14.375ZM7.1875 0.958317C10.6231 0.958317 13.4167 3.75185 13.4167 7.1875C13.4167 10.6232 10.6232 13.4167 7.1875 13.4167C3.75185 13.4167 0.958317 10.6232 0.958317 7.1875C0.958317 3.75185 3.75189 0.958317 7.1875 0.958317Z" fill="#474F5A"></path>
                            <path d="M9.28377 9.47792C9.37243 9.54977 9.47782 9.58334 9.58324 9.58334C9.65505 9.58349 9.72596 9.5674 9.79068 9.53628C9.8554 9.50517 9.91225 9.45983 9.95698 9.40366C10.1223 9.19761 10.0887 8.89573 9.88272 8.73041L7.66657 6.95749V3.35416C7.66657 3.09061 7.45096 2.875 7.18741 2.875C6.92387 2.875 6.70825 3.09061 6.70825 3.35416V7.18751C6.70825 7.33366 6.77535 7.47022 6.88794 7.56124L9.28377 9.47792Z" fill="#474F5A"></path>
                        </g>
                        <defs>
                            <clipPath id="clip0_195_4302">
                                <rect width="14.375" height="14.375" fill="white"></rect>
                            </clipPath>
                        </defs>
                    </svg>
                    <?php echo tyrbota_get_reading_time(); ?> <?= __('хв' , 'tyrbota') ?>.
                </div>

                <div class="news__item__look">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <g clip-path="url(#clip0_195_4308)">
                            <path d="M10 3.9502C12.0598 3.9502 14.0816 4.49963 15.8467 5.54004C17.5597 6.54984 18.9916 7.99378 19.9873 9.71484L20.0146 9.76953C20.0381 9.82596 20.0498 9.88676 20.0498 9.94824C20.0498 10.0303 20.0284 10.1116 19.9873 10.1826C18.9916 11.9036 17.5596 13.3467 15.8467 14.3564C14.0816 15.397 12.0599 15.9473 10 15.9473C7.94013 15.9473 5.91847 15.397 4.15332 14.3564C2.44042 13.3467 1.00833 11.9036 0.0126953 10.1826C-0.0283831 10.1116 -0.0498047 10.0303 -0.0498047 9.94824C-0.0497507 9.86629 -0.0283317 9.78579 0.0126953 9.71484C1.00834 7.99378 2.44033 6.54988 4.15332 5.54004C5.91837 4.49966 7.94023 3.9502 10 3.9502ZM10 4.88281C8.10653 4.88281 6.24848 5.38885 4.62695 6.34473C3.13044 7.22695 1.86728 8.46907 0.959961 9.94824C1.86732 11.4277 3.13025 12.6704 4.62695 13.5527C6.24847 14.5086 8.10655 15.0137 10 15.0137C11.8934 15.0137 13.7515 14.5086 15.373 13.5527C16.8696 12.6705 18.1317 11.4275 19.0391 9.94824C18.1317 8.46923 16.8693 7.22688 15.373 6.34473C13.7515 5.38886 11.8934 4.88283 10 4.88281Z" fill="#474F5A" stroke="#474F5A" stroke-width="0.1"></path>
                            <path d="M10 6.15479C12.092 6.15483 13.7939 7.85668 13.7939 9.94873C13.7939 12.0408 12.0921 13.7426 10 13.7427C7.9079 13.7427 6.2061 12.0408 6.20605 9.94873C6.20605 7.85661 7.90788 6.15479 10 6.15479ZM10 7.08838C8.42263 7.08838 7.13965 8.37136 7.13965 9.94873C7.13969 11.5261 8.42266 12.8091 10 12.8091C11.5773 12.809 12.8603 11.5261 12.8604 9.94873C12.8604 8.37139 11.5774 7.08843 10 7.08838Z" fill="#474F5A" stroke="#474F5A" stroke-width="0.1"></path>
                        </g>
                        <defs>
                            <clipPath id="clip0_195_4308">
                                <rect width="20" height="20" fill="white"></rect>
                            </clipPath>
                        </defs>
                    </svg>
                    <?php echo tyrbota_get_post_views(); ?>
                </div>

                <div class="news__date">
                    <?php echo get_the_date( 'd/m/Y' ); ?>
                </div>

                <?php if ( get_the_modified_date( 'U' ) > get_the_date( 'U' ) ) : ?>
                    <div class="news__date news__date--updated">
                        <?php _e( 'Оновлено:', 'tyrbota' ); ?> <?php echo get_the_modified_date( 'd/m/Y' ); ?>
                    </div>
                <?php endif; ?>
            </div>
		</div>
        <?php if ( has_post_thumbnail() ) : ?>
            <?php the_post_thumbnail( 'full', array( 'alt' => esc_attr( get_the_title() ) ) ); ?>
        <?php endif; ?>
		<?= the_content(); ?>
		</article>

        <div class="autor">
            <?php
            $author_id = get_the_author_meta( 'ID' );
            $author_name = get_the_author_meta( 'display_name' );
            $author_description = get_the_author_meta( 'description' );
            $author_url = get_author_posts_url( $author_id );
            $author_logo = get_field( 'author_logo', 'user_' . $author_id );
            ?>
            
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

</div>
	<section class="related-pension pension mb-m">
	<div class="container">
		<div class="related-pension__container">
			<div class="related-pension__title justify-title">
				<div class="title"><?= __( 'Пансіонати які вас зацікавлять', 'tyrbota' ) ?></div>
				<div class="arrows">
					<div class="pension-button-prev arrow arrow-prev">
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
							<g clip-path="url(#clip0_67_1010)">
							<path d="M10.4 2L5.10713 7.29289C4.71661 7.68342 4.71661 8.31658 5.10713 8.70711L10.4 14" stroke="#3D8FFE" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
							</g>
							<defs><clipPath id="clip0_67_1010"><rect width="16" height="16" fill="white" transform="translate(16 16) rotate(-180)"/></clipPath></defs>
						</svg>
					</div>
					<div class="pension-button-next arrow arrow-next">
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
							<path d="M5.59998 14L10.8929 8.70711C11.2834 8.31658 11.2834 7.68342 10.8929 7.29289L5.59998 2" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
						</svg>
					</div>
				</div>
			</div>
			<div class="pension__content__wrap">
				<?php
				$related_city_id = 0;
				$city_terms = get_the_terms( $post->ID, 'city' );
				if ( $city_terms && ! is_wp_error( $city_terms ) ) {
					foreach ( $city_terms as $_t ) {
						if ( (int) $_t->parent === 0 ) {
							$related_city_id = $_t->term_id;
							break;
						}
					}
				}

				$related_args = [
					'post_type'      => 'pansionat',
					'posts_per_page' => 8,
					'post_status'    => 'publish',
					'post__not_in'   => [ $post->ID ],
					'meta_key'       => 'pansyony_rating',
					'orderby'        => 'meta_value_num',
					'order'          => 'DESC',
				];

				if ( $related_city_id ) {
					$city_children = get_term_children( $related_city_id, 'city' );
					$related_args['tax_query'] = [ [
						'taxonomy' => 'city',
						'field'    => 'term_id',
						'terms'   => array_merge( [ $related_city_id ], $city_children ),
					] ];
				}

				$related_query = new WP_Query( $related_args );
				?>
				<div class="swiper pensionSlider">
					<div class="swiper-wrapper pensionSlider-wrapper">
						<?php if ( $related_query->have_posts() ) : ?>
						<?php while ( $related_query->have_posts() ) : $related_query->the_post(); ?>
						<?php get_template_part( 'template-parts/single/pansionat-loop-item' ); ?>
						<?php endwhile; wp_reset_postdata(); ?>
						<?php endif; ?>
					</div>
					<div class="pension-pagination"></div>
				</div>
			</div>
		</div>
	</div>
	</section>
<?php 
	if ( $related_posts->have_posts() ) :
?>
<section class="related-news mb-m">
	<div class="container">
		<div class="related-news__title justify-title">
			<div class="title"><?php _e( 'Схожі новини', 'tyrbota' ); ?></div>
			<a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ); ?>">
				<?php _e( 'Більше новин', 'tyrbota' ); ?>
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
					<g clip-path="url(#clip0_235_1388)">
						<path d="M2.99932 12.239L19.4772 12.239" stroke="#474F5A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
						<path d="M14.7051 6.40527L19.1245 10.8247C19.9055 11.6057 19.9055 12.8721 19.1245 13.6531L14.7051 18.0725" stroke="#474F5A" stroke-width="2" stroke-linecap="round"/>
					</g>
					<defs>
						<clipPath id="clip0_235_1388">
							<rect width="24" height="24" fill="white"/>
						</clipPath>
					</defs>
				</svg>
			</a>
		</div>
		<div class="news__wrap">
			<?php while ( $related_posts->have_posts() ) : $related_posts->the_post(); ?>
				<div class="news__item">
					<a href="<?php the_permalink(); ?>" class="news__item__img">
						<?php if ( has_post_thumbnail() ) : ?>
							<img src="<?php echo esc_url( get_the_post_thumbnail_url( get_the_ID(), 'full' ) ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>">
						<?php endif; ?>
					</a>
					<div class="news__item__info">
						<span class="news__cat">
							<?php
							$post_categories = get_the_category();
							if ( $post_categories ) {
								echo esc_html( $post_categories[0]->name );
							}
							?>
						</span>					
						<a class="news__title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						
						<div class="news__item__info-date">
							<div class="news__item__time">
								<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15" fill="none">
									<g clip-path="url(#clip0_195_4302)">
										<path d="M7.1875 14.375C11.1502 14.375 14.375 11.1502 14.375 7.1875C14.375 3.2248 11.1502 0 7.1875 0C3.22476 0 0 3.2248 0 7.1875C0 11.1502 3.2248 14.375 7.1875 14.375ZM7.1875 0.958317C10.6231 0.958317 13.4167 3.75185 13.4167 7.1875C13.4167 10.6232 10.6232 13.4167 7.1875 13.4167C3.75185 13.4167 0.958317 10.6232 0.958317 7.1875C0.958317 3.75185 3.75189 0.958317 7.1875 0.958317Z" fill="#474F5A"/>
										<path d="M9.28377 9.47792C9.37243 9.54977 9.47782 9.58334 9.58324 9.58334C9.65505 9.58349 9.72596 9.5674 9.79068 9.53628C9.8554 9.50517 9.91225 9.45983 9.95698 9.40366C10.1223 9.19761 10.0887 8.89573 9.88272 8.73041L7.66657 6.95749V3.35416C7.66657 3.09061 7.45096 2.875 7.18741 2.875C6.92387 2.875 6.70825 3.09061 6.70825 3.35416V7.18751C6.70825 7.33366 6.77535 7.47022 6.88794 7.56124L9.28377 9.47792Z" fill="#474F5A"/>
									</g>
									<defs>
										<clipPath id="clip0_195_4302">
											<rect width="14.375" height="14.375" fill="white"/>
										</clipPath>
									</defs>
								</svg>
								<?php echo tyrbota_get_reading_time( get_the_ID() ); ?> <?php _e( 'хв.', 'tyrbota' ); ?>
							</div>
							
							<div class="news__item__look">
								<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
									<g clip-path="url(#clip0_195_4308)">
										<path d="M10 3.9502C12.0598 3.9502 14.0816 4.49963 15.8467 5.54004C17.5597 6.54984 18.9916 7.99378 19.9873 9.71484L20.0146 9.76953C20.0381 9.82596 20.0498 9.88676 20.0498 9.94824C20.0498 10.0303 20.0284 10.1116 19.9873 10.1826C18.9916 11.9036 17.5596 13.3467 15.8467 14.3564C14.0816 15.397 12.0599 15.9473 10 15.9473C7.94013 15.9473 5.91847 15.397 4.15332 14.3564C2.44042 13.3467 1.00833 11.9036 0.0126953 10.1826C-0.0283831 10.1116 -0.0498047 10.0303 -0.0498047 9.94824C-0.0497507 9.86629 -0.0283317 9.78579 0.0126953 9.71484C1.00834 7.99378 2.44033 6.54988 4.15332 5.54004C5.91837 4.49966 7.94023 3.9502 10 3.9502ZM10 4.88281C8.10653 4.88281 6.24848 5.38885 4.62695 6.34473C3.13044 7.22695 1.86728 8.46907 0.959961 9.94824C1.86732 11.4277 3.13025 12.6704 4.62695 13.5527C6.24847 14.5086 8.10655 15.0137 10 15.0137C11.8934 15.0137 13.7515 14.5086 15.373 13.5527C16.8696 12.6705 18.1317 11.4275 19.0391 9.94824C18.1317 8.46923 16.8693 7.22688 15.373 6.34473C13.7515 5.38886 11.8934 4.88283 10 4.88281Z" fill="#474F5A" stroke="#474F5A" stroke-width="0.1"/>
										<path d="M10 6.15479C12.092 6.15483 13.7939 7.85668 13.7939 9.94873C13.7939 12.0408 12.0921 13.7426 10 13.7427C7.9079 13.7427 6.2061 12.0408 6.20605 9.94873C6.20605 7.85661 7.90788 6.15479 10 6.15479ZM10 7.08838C8.42263 7.08838 7.13965 8.37136 7.13965 9.94873C7.13969 11.5261 8.42266 12.8091 10 12.8091C11.5773 12.809 12.8603 11.5261 12.8604 9.94873C12.8604 8.37139 11.5774 7.08843 10 7.08838Z" fill="#474F5A" stroke="#474F5A" stroke-width="0.1"/>
									</g>
									<defs>
										<clipPath id="clip0_195_4308">
											<rect width="20" height="20" fill="white"/>
										</clipPath>
									</defs>
								</svg>
								<?php echo tyrbota_get_post_views( get_the_ID() ); ?>
							</div>
							
							<div class="news__date"><?php echo get_the_date( 'd/m/Y' ); ?></div>
						</div>
					</div>
				</div>
			<?php endwhile; ?>
			<?php wp_reset_postdata(); ?>
		</div>
	</div>
</section>

<?php
	endif; 
?>