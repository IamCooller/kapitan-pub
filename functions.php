<?php

/**
 * KAPITAN PUB functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package KAPITAN_PUB
 */

if (! defined('_S_VERSION')) {
    // Replace the version number of the theme on each release.
    define('_S_VERSION', '1.0.0');
}



define('IS_VITE_DEVELOPMENT', true);

// Подключаем функции
require get_template_directory() . '/inc/acf-blocks.php';  // ACF Gutenberg Blocks (создай файл позже)
require get_template_directory() . '/inc/theme-setup.php'; // Поддержка темы, меню и т.д.
require get_template_directory() . '/inc/inc.vite.php';

require get_template_directory() . '/inc/booking-form.php'; // Форма бронирования

add_action('after_switch_theme', function () {
    wp_cache_flush();
});

// Также добавляем очистку кеша при сохранении настроек темы
add_action('acf/save_post', function ($post_id) {
    if ($post_id === 'options') {
        wp_cache_flush();
    }
}, 20);

// Create directory for ACF JSON if it doesn't exist
add_action('admin_init', function () {
    $acf_json_dir = get_stylesheet_directory() . '/assets/acf-json';

    if (!file_exists($acf_json_dir)) {
        mkdir($acf_json_dir, 0755, true);
    }
});

// Simple unified path for ACF JSON files
add_filter('acf/settings/save_json', function () {
    return get_stylesheet_directory() . '/assets/acf-json';
});

// Add path for loading ACF JSON files
add_filter('acf/settings/load_json', function ($paths) {
    $paths[] = get_stylesheet_directory() . '/assets/acf-json';
    return $paths;
});

// Disable ACF's custom field validation which may be causing memory issues
add_filter('acf/settings/row_index_offset', '__return_zero');


// Increase admin-ajax.php timeout for ACF
add_filter('admin_init', function () {
    set_time_limit(120);
});
