<?php

/**
 * Регистрация ACF блоков
 */

add_action('acf/init', function () {

    if (function_exists('acf_register_block_type')) {

        acf_register_block_type([
            'name'            => 'home-hero',
            'title'           => __('Home Hero Block', 'kapitan-pub'),
            'description'     => __('Main banner', 'kapitan-pub'),
            'render_template' => 'template-parts/blocks/home-hero.php',
            'category'        => 'layout',
            'icon'            => 'format-image',
            'mode'            => 'edit',
            'supports'        => ['align' => false],
        ]);

        // Можно добавить другие блоки тут же
    }
});

if (function_exists('acf_add_options_page')) {
    acf_add_options_page([
        'page_title' => 'Theme Settings',
        'menu_title' => 'Theme Settings',
        'menu_slug'  => 'theme-settings',
        'capability' => 'edit_posts',
        'redirect'   => false,
    ]);
}
