<?php
if (class_exists('Kirki')) {
    Kirki::add_config('BURY_theme_config', array(
        'capability'  => 'edit_theme_options',
        'option_type' => 'theme_mod',
    ));

    // Основная панель
    Kirki::add_panel('main_settings', array(
        'priority'    => 10,
        'title'       => esc_html__('Основные настройки', 'BURY'),
    ));

    // Вкладка Логотип
    Kirki::add_section('logo_section', array(
        'title'       => esc_html__('Логотип', 'BURY'),
        'panel'       => 'main_settings',
        'priority'    => 150,
    ));

    Kirki::add_field('BURY_theme_config', array(
        'type'      => 'image',
        'settings'  => 'site_logo',
        'label'     => esc_html__('Загрузить логотип хедера', 'BURY'),
        'section'   => 'logo_section',
        'default'   => '',
        'priority'  => 10,
    ));

    Kirki::add_field('BURY_theme_config', array(
        'type'      => 'image',
        'settings'  => 'site_logo_footer',
        'label'     => esc_html__('Загрузить логотип футора', 'BURY'),
        'section'   => 'logo_section',
        'default'   => '',
        'priority'  => 10,
    ));

    // Вкладка Социальные сети
    Kirki::add_section('social_links_section', array(
        'title'       => esc_html__('Социальные сети', 'BURY'),
        'panel'       => 'main_settings',
        'priority'    => 160,
    ));

    $social_networks = [
        'linkedin'  => ['label' => 'LinkedIn', 'icon' => 'dashicons-linkedin'],
        'facebook'  => ['label' => 'Facebook', 'icon' => 'dashicons-facebook'],
        'instagram' => ['label' => 'Instagram', 'icon' => 'dashicons-camera'],
    ];

    // Добавляем поля для социальных сетей
    foreach ($social_networks as $key => $data) {
        Kirki::add_field('BURY_theme_config', array(
            'type'      => 'text',
            'settings'  => 'social_' . $key,
            'label'     => sprintf('<span class="dashicons %s"></span> %s', $data['icon'], esc_html__($data['label'], 'BURY')),
            'section'   => 'social_links_section',
            'default'   => '',
            'priority'  => 10,
            'sanitize_callback' => 'esc_url',
        ));
    }

    // Вкладка Footer
    Kirki::add_section('footer_section', array(
        'title'       => esc_html__('Footer', 'BURY'),
        'panel'       => 'main_settings',
        'priority'    => 170,
    ));


    Kirki::add_field('BURY_theme_config', array(
        'type'      => 'text',
        'settings'  => 'footer_copyright',
        'label'     => esc_html__('Копирайт', 'BURY'),
        'section'   => 'footer_section',
        'default'   => '',
        'priority'  => 20,
    ));

  




    //Вкладка контактный данные
    Kirki::add_section( 'contact_details', array(
        'title'    => __( 'Контактные данные', 'BURY' ),
        'priority' => 165,
        'panel'    => 'main_settings', 
    ) );

    Kirki::add_field( 'BURY_config', array(
        'type'        => 'text',
        'settings'    => 'contact_phone',
        'label'       => __( 'Телефон', 'BURY' ),
        'section'     => 'contact_details',
        'default'     => '',
        'priority'    => 10,
    ) );

    Kirki::add_field( 'BURY_config', array(
        'type'        => 'text',
        'settings'    => 'contact_phone_second',
        'label'       => __( 'Второй Телефон если нужен', 'BURY' ),
        'section'     => 'contact_details',
        'default'     => '',
        'priority'    => 10,
    ) );

    Kirki::add_field( 'BURY_config', array(
        'type'        => 'text',
        'settings'    => 'contact_email',
        'label'       => __( 'Электронная почта', 'BURY' ),
        'section'     => 'contact_details',
        'default'     => '',
        'priority'    => 20,
        'transport'   => 'postMessage',
    ) );
    Kirki::add_field( 'BURY_config', array(
        'type'        => 'text',
        'settings'    => 'contact_address',
        'label'       => __( 'Адресс', 'BURY' ),
        'section'     => 'contact_details',
        'default'     => '',
        'priority'    => 20,
        'transport'   => 'postMessage',
    ) );

    Kirki::add_field( 'BURY_config', array(
        'type'              => 'text',
        'settings'          => 'contact_map',
        'label'             => __( 'Айфрейм карты', 'BURY' ),
        'section'           => 'contact_details',
        'default'           => '',
        'priority'          => 20,
        'transport'         => 'postMessage',
        'sanitize_callback' => 'wp_kses_post', 
    ) );
    

    Kirki::add_field( 'BURY_config', array(
        'type'      => 'textarea',
        'settings'    => 'contact_work_time',
        'label'       => __( 'Рабочие часы', 'BURY' ),
        'section'     => 'contact_details',
        'default'     => '',
        'priority'    => 30,
    ) );

        Kirki::add_field( 'BURY_config', array(
        'type'      => 'textarea',
        'settings'    => 'contact_work_time_page',
        'label'       => __( 'Рабочие часы на странице контактов', 'BURY' ),
        'section'     => 'contact_details',
        'default'     => '',
        'priority'    => 30,
    ) );
}
