<?php
/*
 * Template Name: Страница про нас
 * Description: Это моя кастомная страница про нас
 * Author: Misha Kushnirenko
 * Version: 1.0
 */
include BURY_REQUIRE_DIRECTORY . '/template-parts/content-variables.php';

$history_title  = get_field( 'history_title' )  ?: __( 'History of Our Company', 'bury' );
$history_slides = get_field( 'history_slides' );
?>
<?php get_header(); ?>
    <?php get_template_part( 'template-parts/content', 'breadcrumbs', array( 'without_bg' => false ) ); ?>

    

    <section class="process-block process-block--about">
        <div class="container">
            <div class="process-block__img-full">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/violet_house.jpg" alt="About DryLining Bury">
            </div>
            <div class="process-block__inner">
                <div class="process-block__about-title">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/quote.svg" alt="" aria-hidden="true">
                    <h2><?= __('About DryLining Bury Limited — Manchester Drylining Contractors', 'bury') ?></h2>
                </div>
                <div class="process-block__about-text">
                    <p><?= __('DryLining Bury Limited is a Manchester-based company specialising in drylining and interior finishing services for both commercial and residential projects. We provide reliable solutions from initial planning through to final finishes, working closely with developers, contractors and private clients to ensure every project runs smoothly.', 'bury') ?></p>
                    <p><?= __('Our team focuses on quality workmanship, efficiency and safe site practices. Using modern drylining systems and professional techniques, we deliver durable, smooth and paint-ready surfaces that meet the demands of today\'s construction standards.', 'bury') ?></p>
                    <p><?= __('At DryLining Bury Limited, we believe that attention to detail and consistent project delivery are key to successful results. Whether it\'s a commercial development, residential project or refurbishment, we adapt our services to meet each project\'s specific requirements across Manchester and Greater Manchester.', 'bury') ?></p>
                </div>
            </div>
        </div>
    </section>

    <section class="process-block">
        <div class="container">

            <div class="process-block__head">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/quote.svg" alt="" aria-hidden="true">
                <h2><?= __('Why People Choose Us', 'bury') ?></h2>
                <p><?= __('Clients choose DryLining Bury Limited for our reliable workmanship, transparent communication, and high-quality drylining and interior finishing services delivered on schedule across Manchester and Greater Manchester.', 'bury') ?></p>
            </div>

            <div class="process-block__inner">

                <div class="process-block__img-wrap">
                    <img class="process-block__img" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/about_image.jpg" alt="Why choose us">
                </div>

                <div class="process-block__content">
                    <b class="process-block__wrapper">
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48" fill="none">
                            <path d="M15.1129 15.252C17.6175 16.6059 21.8116 17.0861 24.854 17.0849C27.8992 16.96 38.021 16.1082 33.5179 12.7127C33.5506 10.4624 31.9696 7.44237 29.5452 5.78079C29.2865 5.60265 29.0137 5.43468 28.7267 5.27746C28.76 5.92388 28.9741 8.25449 28.6634 8.68883L28.4816 8.76236C27.9184 8.43434 27.584 5.46239 27.4411 4.73566L26.1119 4.30189C25.7826 3.63907 25.5832 3.0656 24.3671 3C23.4441 3.37835 23.3176 3.58873 23.0577 4.30019L23.025 4.39181C22.5838 4.51001 22.0511 4.66384 21.6066 4.75602C21.427 5.52234 21.1197 8.43717 20.5881 8.75048C19.934 8.49938 20.3108 5.92953 20.3515 5.32666C16.7109 7.48535 16.1263 9.63217 15.5027 12.7987C14.4792 13.4801 13.8725 14.5818 15.1129 15.252ZM19.4646 14.5784C23.6113 14.8442 27.6727 14.7068 31.8125 14.5032C31.555 14.6011 31.2505 14.7017 30.9839 14.7945C27.3479 15.675 23.6198 15.86 19.8657 15.1864C19.1076 15.0507 17.896 14.8137 17.291 14.4919C17.9819 14.4925 18.7687 14.5338 19.4646 14.5784Z" fill="#0AB5B0"/>
                            <path d="M42.3556 29.8443C41.266 30.1084 39.3387 33.0611 37.5453 32.6578C36.7946 32.2614 36.0941 31.5313 35.9484 30.8905C35.479 28.8263 39.6307 28.0209 39.8256 26.266C39.8787 25.7842 39.2178 25.2854 38.3372 25.3272C34.8701 26.4668 32.5247 27.6414 31.2877 30.0976C31.016 30.623 30.8335 31.1671 30.7432 31.7196C30.6726 32.1737 30.6421 33.5786 30.3528 33.8585C29.2875 34.8889 27.4591 36.2457 26.2587 37.1901L16.4109 44.9534C19.6001 44.9777 22.7899 44.9794 25.9797 44.9596C26.5084 44.4704 27.0642 43.9349 27.6268 43.4683C29.4869 41.7671 31.3634 40.0756 33.1467 38.3382C33.5133 37.9808 33.8488 37.6607 34.2928 37.3434C35.8563 37.3474 38.0881 37.3886 39.2466 36.5465C41.2688 35.0773 43.1012 32.7698 43.3153 30.748C43.3656 30.2712 43.0815 29.9387 42.3562 29.8443H42.3556Z" fill="#0AB5B0"/>
                            <path d="M12.2804 36.1083C12.9419 36.5777 13.2288 37.0081 13.77 37.5176C14.824 38.4304 17.0338 40.4404 18.1533 41.1988C19.6971 40.0236 21.0991 38.8597 22.6039 37.6743C20.5427 35.7593 17.9172 34.1238 16.0181 32.1625C15.5301 31.6586 16.0238 29.9393 15.9165 29.2126C15.5894 26.9962 12.7956 24.777 9.29738 24.8352C5.59188 25.2973 10.679 27.3711 11.2801 28.2777C12.1392 29.5739 10.4909 32.8191 7.8197 31.9837C6.38043 31.5087 6.07936 29.1537 4.71013 29.0005C4.48192 29.057 4.36274 29.035 4.3006 29.1928C3.70524 30.7062 4.3232 32.7738 5.22811 34.1792C6.7764 36.5839 8.78166 36.9668 12.2804 36.1083Z" fill="#0AB5B0"/>
                            <path d="M31.9835 18.0385C26.0632 19.0372 23.0508 19.2431 17.0903 17.9587C17.6219 20.8736 17.719 24.8935 21.4048 26.8407C24.5861 28.5215 27.9707 27.2133 29.6958 25.1808C31.4638 22.8049 31.6288 20.6694 31.9841 18.0385H31.9835Z" fill="#0AB5B0"/>
                            <path d="M19.8269 28.216C19.1903 28.8953 18.6904 29.3234 17.9289 29.9472C17.9058 31.9724 18.7581 32.0572 20.5572 33.6351C21.6034 34.5179 22.8286 35.6321 23.9515 36.4317C25.3258 35.4036 27.1588 34.0316 28.3326 32.8399C28.5444 32.6245 29.3166 29.0666 29.6651 28.5571C29.6967 28.5107 29.3397 28.2528 29.2505 28.1895C25.8127 30.3255 23.2059 30.0507 19.8269 28.216Z" fill="#0AB5B0"/>
                            <path d="M40.5983 38.3071C38.0157 39.3901 37.8429 39.1169 35.0361 39.1842C34.3503 39.8442 32.384 41.8949 31.8186 42.5764C32.6038 43.4417 33.6363 44.148 34.4441 44.9522C36.9289 45.0003 40.5017 45.0269 42.9645 44.959C42.9831 43.4649 42.081 39.3878 40.5983 38.3071Z" fill="#0AB5B0"/>
                            <path d="M16.6114 42.1211C15.8449 41.451 15.0252 40.7525 14.257 40.0886C12.659 38.7069 12.3105 38.3422 9.66355 38.3422C9.27888 38.3704 8.83716 38.3953 8.4604 38.4315C7.51594 39.5055 5.19436 44.0253 6.47603 44.872C7.35157 45.0643 11.9241 44.9647 13.1781 44.9698C14.1147 44.2725 15.8641 42.8903 16.6114 42.1211Z" fill="#0AB5B0"/>
                            <path d="M28.7803 44.9539L30.781 44.9636L32.1706 44.9573C31.8034 44.6672 30.7336 43.7787 30.3308 43.626C29.823 44.0638 29.3022 44.5264 28.7803 44.9539Z" fill="#0AB5B0"/>
                        </svg>
                        <h4><?= __('Skilled Drylining Specialists', 'bury') ?></h4>
                    </b>
                    <p><?= __('Our experienced team specialises in professional drylining installation for commercial and residential projects across Manchester and Greater Manchester. Using modern drylining systems and proven installation methods, we deliver precise, smooth and durable wall and ceiling finishes.', 'bury') ?></p>
                    <hr>
                    <b class="process-block__wrapper">
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48" fill="none">
                            <path d="M42.6119 9.52716C42.3723 9.208 41.4003 9.08988 40.8958 9.00129C37.3677 8.38433 33.7282 7.69008 30.6042 6.42285C29.39 5.93028 28.1485 5.32399 27.0916 4.70074C26.3508 4.26409 25.2674 3.38136 24.452 3.09424C24.1762 2.99686 23.921 3.00063 23.6128 3C22.5986 3.56294 21.6933 4.26472 20.7174 4.80755C18.0499 6.2928 14.0031 7.75919 10.5909 8.35731C4.28914 9.46245 5.01445 8.85868 5.03517 13.1485L5.04683 17.9944C5.01769 26.7696 5.33954 34.2417 14.9894 41.1948C16.6284 42.3766 21.9808 46.0262 24.3691 45.9999C26.1992 45.4363 27.9264 44.4813 29.423 43.6061C34.1802 40.8235 38.1176 37.2769 40.2644 33.3439C41.3316 31.3811 42.0641 29.3493 42.4494 27.2835C42.687 25.9327 42.8321 24.5756 42.8833 23.2167C42.961 21.6962 43.2071 10.3188 42.6119 9.52716ZM39.0871 24.7051C38.9407 26.1733 38.6221 27.6328 38.1331 29.0697C37.5484 30.7993 36.6301 32.4756 35.4009 34.0582C33.2451 36.7686 28.1453 40.75 24.0972 42.4137C21.4362 41.6509 16.5766 37.9422 14.8909 36.418C8.65329 30.7767 8.68955 24.1421 8.81195 17.5232C8.8398 16.0342 8.71028 14.1695 8.88707 12.6817C8.96414 12.0315 10.5106 11.8028 11.4289 11.6036C14.4169 10.954 17.0869 10.3213 19.6987 9.12506C21.0347 8.5125 22.5287 7.71521 23.9055 7.18683C25.4668 7.51605 28.2198 9.26266 29.9922 9.83627C31.7621 10.4539 33.6324 10.927 35.5052 11.395C36.4371 11.6275 38.3915 11.8034 39.0061 12.2646C39.5086 13.1479 39.2774 23.0445 39.0871 24.7051Z" fill="url(#paint0_linear_266_7061)"/>
                            <path d="M33.9879 13.9816C31.4007 13.4036 29.0888 12.7559 26.9084 11.679C26.3424 11.3994 24.4216 10.4463 23.7824 10.44C21.5812 11.4805 19.6242 12.4568 17.12 13.2334C15.7568 13.6562 13.3626 14.0671 12.1846 14.51C11.3071 14.8399 11.7734 18.6981 11.7352 19.4765C11.4464 25.3899 12.5104 31.1983 18.8199 35.8193C19.6113 36.4199 23.015 39.0254 24.1503 39.1504C28.9962 36.6015 33.1726 32.9707 34.9133 29.0295C36.8393 24.6711 36.112 19.9986 36.3451 15.514C36.4015 14.4327 35.2954 14.2807 33.9879 13.9816ZM32.9058 20.8732C29.8698 23.8783 26.7821 26.9405 23.4742 29.8155C23.2754 29.9882 22.8156 29.9895 22.5254 29.9706C21.486 29.6018 19.6236 27.7246 18.8115 26.9888C17.9981 26.272 15.7309 24.5015 15.9951 23.6037C17.256 19.3176 21.0431 23.6093 22.6595 24.8866C24.3782 23.3982 28.9308 18.3745 30.6716 17.6049C33.2548 17.5327 33.9108 19.8793 32.9058 20.8732Z" fill="url(#paint1_linear_266_7061)"/>
                            <defs>
                                <linearGradient id="paint0_linear_266_7061" x1="1.69034" y1="16.2497" x2="43.4871" y2="32.4379" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#08B0B2"/>
                                <stop offset="1" stop-color="#0CC5B3"/>
                                </linearGradient>
                                <linearGradient id="paint1_linear_266_7061" x1="9.47511" y1="19.3647" x2="36.3609" y2="29.7775" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#08B0B2"/>
                                <stop offset="1" stop-color="#0CC5B3"/>
                                </linearGradient>
                            </defs>
                        </svg>
                        <h4><?= __('Fully Insured & Health & Safety Compliant', 'bury') ?></h4>
                    </b>
                    <p><?= __('DryLining Bury Limited operates with full insurance and strict health & safety compliance, following UK construction regulations and site standards. We prioritise safe working practices on every project, giving developers and contractors complete confidence.', 'bury') ?></p>
                    <hr>
                    <b class="process-block__wrapper">
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48" fill="none">
                            <path d="M42.5341 12.3437C42.403 12.2972 42.3101 12.2388 42.1996 12.2802C40.7193 12.8347 40.6532 13.5814 38.8462 14.0894C35.6053 13.2093 35.9929 9.98464 37.8418 9.55003C43.0818 8.31855 38.153 6.53205 34.8187 6.62507C32.4387 6.85504 31.0327 7.56147 29.5792 8.83585C28.7322 9.62445 27.7148 10.7035 27.9321 11.7215C28.1112 12.5603 30.2961 13.4465 29.8373 14.417C29.4997 15.1307 28.8173 15.8175 28.2645 16.465C27.3959 17.4836 26.505 18.4846 25.6698 19.5145C26.4368 20.7145 26.0967 20.96 24.7919 21.8814C24.3996 21.5253 23.8463 20.9899 23.3998 20.6918C22.7303 20.6706 18.6151 20.6902 18.1474 20.7961C17.6179 21.178 18.9263 22.348 19.3542 22.6819C20.3488 23.4581 20.8531 24.779 22.6034 24.0705C22.4573 24.3624 22.3479 24.5206 22.1502 24.8012C24.8832 28.0868 24.9199 26.3923 27.1708 24.1082C27.9822 23.255 32.8315 17.9911 33.5314 17.7844C35.1407 18.0557 35.228 21.1445 39.0516 19.7182C40.8473 19.0484 41.9173 17.5327 42.402 16.2542C42.6941 15.4826 43.1339 12.9944 42.5341 12.3437Z" fill="#0AB5B0"/>
                            <path d="M15.4556 27.9747C16.4033 27.0827 17.3241 26.1783 18.2181 25.2621C11.8735 27.0755 8.1603 23.0947 6.97314 19.4974C6.21801 16.3498 6.66448 13.2134 9.41713 10.5339C11.6423 8.36761 15.597 7.3754 18.9391 9.12779C23.0714 11.2946 23.8983 15.2159 23.4235 18.4742C24.2746 18.0804 24.8362 17.8293 25.5975 17.3554C25.9815 12.8687 22.7669 5.91602 14.5523 6.00077C11.9194 6.18836 9.78566 7.02915 8.15565 8.45236C2.46867 13.4181 2.84185 22.533 10.2141 26.708C11.6768 27.5364 13.5773 27.9168 15.4556 27.9747Z" fill="#0AB5B0"/>
                            <path d="M39.5005 35.3201C36.3241 32.2629 33.0677 29.2403 29.8458 26.2042C29.5263 25.9029 29.1759 25.5727 28.7325 25.352L28.4218 25.3081C27.648 25.9215 25.9907 27.586 25.4265 28.3152C25.523 28.664 25.8689 30.3673 26.0583 30.5741C28.8574 33.6308 31.8082 36.6467 34.7369 39.6513C35.572 40.5076 36.3132 40.9923 37.8947 41.013C40.5013 40.521 41.1072 38.227 40.5467 36.6855C40.4233 36.3454 39.8122 35.6204 39.5005 35.3201ZM37.1602 38.4839C35.5292 38.5128 34.566 36.7392 36.2048 35.8007C37.9056 35.9346 38.7102 37.6022 37.1602 38.4839Z" fill="#0AB5B0"/>
                            <path d="M22.0999 27.3928C21.4103 26.8642 21.2916 25.9195 19.9078 25.935C19.0355 26.5319 16.1904 29.3917 15.3119 30.231L11.4346 33.9161C10.2846 35.0251 8.69227 36.2711 8.75834 37.6757C8.82802 39.1469 9.70858 41.1091 12.423 41.0171C12.5154 41.0135 12.6078 41.0094 12.7002 41.0042C14.3204 40.5453 14.7457 39.7857 15.6526 38.8296L18.4089 35.9119L21.7086 32.4035C23.7639 30.2118 25.0708 29.6692 22.0999 27.3928ZM12.6445 38.6053L12.5995 38.6002C11.3809 38.4575 11.0423 37.7697 11.2823 37.0276C11.4733 36.4065 12.038 35.8644 12.8447 35.529C15.2696 35.8618 14.02 37.8762 12.6445 38.6053Z" fill="#0AB5B0"/>
                            <path d="M17.943 16.2149C18.8426 15.6536 20.3436 14.8108 20.3704 13.9416C20.3803 13.6997 20.244 13.4656 19.9921 13.292C18.965 12.585 16.9866 14.3152 16.1865 14.7948C16.1937 13.1571 16.2722 11.4719 16.0977 9.84402C16.0513 9.41355 15.7178 9.02493 15.0339 8.97584C14.317 9.41665 14.1828 9.86056 14.1797 10.5288C14.172 12.1411 14.1962 13.7627 14.1998 15.3751C13.549 16.0929 13.2785 16.496 13.566 17.3781C13.7208 17.8546 14.4868 18.5946 15.4314 18.3977C16.6877 17.9538 16.778 16.9507 17.943 16.2149Z" fill="#0AB5B0"/>
                            <path d="M15.0729 24.6213C15.6082 24.6213 16.0422 24.1868 16.0422 23.6508C16.0422 23.1148 15.6082 22.6803 15.0729 22.6803C14.5375 22.6803 14.1035 23.1148 14.1035 23.6508C14.1035 24.1868 14.5375 24.6213 15.0729 24.6213Z" fill="#0AB5B0"/>
                            <path d="M21.5592 18.0268C22.0945 18.0268 22.5285 17.5922 22.5285 17.0562C22.5285 16.5202 22.0945 16.0857 21.5592 16.0857C21.0238 16.0857 20.5898 16.5202 20.5898 17.0562C20.5898 17.5922 21.0238 18.0268 21.5592 18.0268Z" fill="#0AB5B0"/>
                            <path d="M8.82749 17.958C9.36284 17.958 9.79683 17.5235 9.79683 16.9875C9.79683 16.4515 9.36284 16.017 8.82749 16.017C8.29214 16.017 7.85815 16.4515 7.85815 16.9875C7.85815 17.5235 8.29214 17.958 8.82749 17.958Z" fill="#0AB5B0"/>
                        </svg>
                        <h4><?= __('Reliable Project Delivery', 'bury') ?></h4>
                    </b>
                    <p><?= __('We understand the importance of meeting construction deadlines. Our team works efficiently with site managers and contractors to ensure drylining works are completed on time and within project schedules, helping your development run smoothly.', 'bury') ?></p>
                    <hr>
                    <b class="process-block__wrapper">
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48" fill="none">
                            <path d="M39.1971 14.6699C38.9161 14.6904 38.8393 14.6528 38.7289 14.769C37.9831 15.555 38.5423 17.0645 38.0621 17.8704L37.8824 17.8334L38.0735 17.8397L37.8437 17.7537C37.2355 15.9093 38.2089 13.2123 37.5382 11.5827C37.4329 11.3264 37.2389 11.0877 36.8788 10.9533C36.1842 10.6947 17.4923 10.8343 15.0767 10.8257C14.5886 11.0034 14.3115 11.1834 14.1505 11.5485C13.915 12.0828 13.9338 17.7343 14.0515 18.5779C14.0942 18.8832 14.196 19.2386 14.4458 19.5012C14.6312 19.696 14.9788 19.872 15.3219 19.9136C16.9467 20.1089 21.3278 19.966 23.2353 19.9654C28.0631 19.9637 32.9602 20.0787 37.7794 19.9631C38.2265 19.9523 38.9581 19.9591 39.3302 19.7877C39.8217 19.5616 40.0243 19.1042 40.088 18.7294C40.1637 18.2834 40.1335 17.8214 40.1272 17.3732C40.1363 16.6373 40.4328 14.9479 39.1971 14.6699Z" fill="#0AB5B0"/>
                            <path d="M28.7204 27.7802C28.5571 27.7443 28.3831 27.7352 28.2135 27.7215L27.9945 27.7027C27.9422 27.6993 27.8904 27.6953 27.838 27.6913C27.8921 26.477 28.2215 24.5455 26.8874 23.5891C26.5461 23.3448 26.0284 23.2183 25.5545 23.1374C23.3033 22.7535 13.5796 22.2756 12.2575 21.1911C11.8325 20.8431 11.8575 20.2815 11.8547 19.852C11.8467 18.5123 11.8826 17.1715 11.9019 15.8318L13.5637 15.7646L13.5802 13.8468C12.8417 13.844 11.6635 13.8161 10.9598 13.8525C10.1679 14.27 9.90277 14.6693 9.79297 15.3386C9.65928 16.1554 9.67749 21.0721 9.89993 21.8496C10.0166 22.2597 10.2049 22.6294 10.6156 22.9512C13.1791 24.9607 25.0316 24.7312 25.6205 25.5685C25.9772 26.0754 25.7724 27.0853 25.7581 27.6515C24.1652 27.8178 23.6077 28.1983 23.5667 29.3016C23.437 32.7932 23.5548 36.3514 23.5138 39.8396C23.4774 42.8955 24.3211 42.83 28.3654 42.8197C29.0271 42.6261 29.4771 42.3703 29.7598 41.9163C29.9231 41.6532 29.9896 41.3792 30.0198 41.0967C30.1728 39.6539 30.273 29.2907 29.7951 28.5332C29.584 28.1988 29.258 27.897 28.7204 27.7802Z" fill="#0AB5B0"/>
                            <path d="M11.6488 9.46942L11.6954 9.45689C12.1158 8.43504 12.526 7.29016 12.9732 6.29109C14.0564 5.86219 15.2329 5.3769 16.3252 4.97305C15.3927 4.59712 13.7987 3.99336 12.9794 3.5804C12.7035 3.03416 11.8706 0.640164 11.576 0.444794L10.4268 3.54736C9.44939 3.99791 8.1301 4.58345 7.06738 4.95483C8.13749 5.46006 9.31911 5.85478 10.342 6.34634C10.524 6.78493 11.469 9.37316 11.6488 9.46942Z" fill="#0AB5B0"/>
                            <path d="M31.6153 8.69939C31.9845 7.72425 32.3748 6.59588 32.8157 5.64808C33.8118 5.23854 35.0583 4.69743 36.0584 4.32606C35.0014 3.87152 33.9324 3.42895 32.8527 2.99834C32.6553 2.56658 31.7956 0.187966 31.5271 0C31.1562 0.983686 30.7813 2.05395 30.3432 3.0177C29.4586 3.413 28.0426 4.01848 27.072 4.32606C28.1586 4.75553 29.2333 5.19867 30.2943 5.65548C30.5253 6.14704 31.3479 8.52908 31.6153 8.69939Z" fill="#0AB5B0"/>
                        </svg>
                        <h4><?= __('Quality Workmanship & Professional Finishes', 'bury') ?></h4>
                    </b>
                    <p><?= __('Attention to detail is at the core of our work. We deliver high-quality drylining and interior finishing, creating smooth, paint-ready surfaces using professional techniques and reliable materials suitable for modern construction standards.', 'bury') ?></p>
                </div>

            </div>

        </div>
    </section>

    <section class="company-history">
        <div class="container">

            <div class="company-history__head">
                <div class="company-history__title-wrap">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/quote.svg" alt="" aria-hidden="true">
                    <h2 class="company-history__title"><?php echo esc_html( $history_title ); ?></h2>
                </div>
                <div class="company-history__nav">
                    <button class="company-history__btn company-history__btn--prev" aria-label="Previous">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="22" viewBox="0 0 14 22" fill="none">
                            <path d="M11.3307 22L14 19.4092L5.33867 11L14 2.59076L11.3307 -1.1668e-07L-4.80825e-07 11L11.3307 22Z" fill="white"/>
                        </svg>
                    </button>
                    <button class="company-history__btn company-history__btn--next" aria-label="Next">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="22" viewBox="0 0 14 22" fill="none">
                            <path d="M2.66933 -2.02403e-06L-8.48405e-07 2.59076L8.66133 11L-1.13246e-07 19.4092L2.66933 22L14 11L2.66933 -2.02403e-06Z" fill="white"/>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="company-history__swiper swiper">
                <div class="swiper-wrapper">

                    <?php if ( $history_slides ) :
                        foreach ( $history_slides as $slide ) :
                            $slide_img     = $slide['slide_image'];
                            $slide_img_url = is_array( $slide_img ) ? $slide_img['url'] : $slide_img;
                            $slide_img_alt = is_array( $slide_img ) ? ( $slide_img['alt'] ?? '' ) : '';
                    ?>
                    <div class="swiper-slide">
                        <div class="company-history__slide">
                            <div class="company-history__img-wrap">
                                <img src="<?php echo esc_url( $slide_img_url ); ?>" alt="<?php echo esc_attr( $slide_img_alt ); ?>" loading="lazy">
                            </div>
                            <div class="company-history__content">
                                <div class="company-history__text"><?php echo wp_kses_post( $slide['slide_content'] ); ?></div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; endif; ?>

                </div>
            </div>

            <div class="company-history__dots"></div>

        </div>
    </section> 

    <section class="about-cards">
        <div class="container">
        <div class="about-cards__grid">

            <div class="about-cards__card" style="background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/images/mission.png');">
                <div class="about-cards__overlay"></div>
                <div class="about-cards__body">
                    <div class="about-cards__icon">
                       <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48" fill="none">
                            <path d="M32.7992 15.1998V8.59976L39.3992 1.99976L41.5991 6.39976L45.9992 8.59976L39.3992 15.1998H32.7992ZM32.7992 15.1998L23.9992 23.9996M45.9993 23.9997C45.9993 36.1501 36.1496 45.9998 23.9992 45.9998C11.849 45.9998 1.99927 36.1501 1.99927 23.9997C1.99927 11.8495 11.849 1.99976 23.9992 1.99976M34.9992 23.9997C34.9992 30.0748 30.0744 34.9998 23.9992 34.9998C17.9241 34.9998 12.9993 30.0748 12.9993 23.9997C12.9993 17.9246 17.9241 12.9998 23.9992 12.9998" stroke="#00C4BE" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <h2 class="about-cards__title"><?= __('Our Approach', 'bury') ?></h2>
                    </div>
                    <div class="about-cards__content">
                        <p class="about-cards__text"><?= __('Our approach is simple. We begin by understanding the project requirements and then guide clients through planning, materials, scheduling, and delivery. Our team keeps the site organised, safe, and ensures all work meets professional standards, delivering a smooth and efficient project.') ?></p>
                    </div>
                </div>
            </div>

            <div class="about-cards__card" style="background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/images/aproach.png');">
                <div class="about-cards__overlay"></div>
                <div class="about-cards__body">
                    <div class="about-cards__icon">
                       <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48" fill="none">
                            <path d="M32 15.0295L4 43.0294M35.9999 29.0294H17.9999M13.1999 37.0294H26.6745C27.1637 37.0294 27.4083 37.0294 27.6385 36.9742C27.8426 36.9252 28.0376 36.8444 28.2165 36.7347C28.4185 36.611 28.5914 36.4381 28.9373 36.0922L38.9999 26.0294C39.4779 25.5515 39.7169 25.3126 39.9092 25.101C44.0695 20.5241 44.0695 13.5348 39.9092 8.95789C39.7169 8.74632 39.4779 8.50736 38.9999 8.02943C38.5221 7.55151 38.2831 7.31255 38.0716 7.12023C33.4947 2.95992 26.5053 2.95992 21.9284 7.12023C21.7169 7.31255 21.4779 7.5515 21.0001 8.02943L10.9373 18.0922C10.5913 18.4381 10.4184 18.611 10.2947 18.8128C10.1851 18.9918 10.1042 19.1869 10.0553 19.3909C10 19.6211 10 19.8657 10 20.355V33.8294C10 34.9496 10 35.5095 10.218 35.9374C10.4097 36.3138 10.7157 36.6197 11.092 36.8114C11.5198 37.0294 12.0799 37.0294 13.1999 37.0294Z" stroke="#00C4BE" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <h2 class="about-cards__title"><?= __('Our Mission', 'bury') ?></h2>
                    </div>
                    <div class="about-cards__content">
                        <p class="about-cards__text"><?= __('At DryLining Bury Limited, our mission is to provide reliable, high-quality drylining and interior finishing services that improve the quality, durability, and appearance of every space we work on. We focus on doing the job right — with clear communication, fair pricing, and attention to every detail.', 'bury') ?></p>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>



    <section class="reviews mb-m">
        <div class="container">

            <div class="services__head">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/quote.svg" alt="" aria-hidden="true">
                <h2 class="services__title"><?= __('What Our Clients Say' , 'bury') ?></h2>
                <p class="services__subtitle"><?= __('Client reviews reflecting our quality, reliability and professional approach.' , 'bury') ?></p>
            </div>
            <?= do_shortcode('[trustindex no-registration=google]') ?>
        </div>
    </section>

<?php get_footer(); ?>