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
require get_template_directory() . '/inc/languages.php';
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

/**
 * Настройка ACF JSON
 */
add_filter('acf/settings/save_json', function ($path) {
    // Указываем путь для сохранения JSON файлов
    return get_stylesheet_directory() . '/assets/acf-json';
});

// Добавляем поддержку JSON для опций темы
add_filter('acf/settings/save_json/key=group_header_settings', function ($path) {
    return get_stylesheet_directory() . '/assets/acf-json';
});
