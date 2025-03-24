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

                                                           // Подключаем функции
require get_template_directory() . '/inc/acf-blocks.php';  // ACF Gutenberg Blocks (создай файл позже)
require get_template_directory() . '/inc/theme-setup.php'; // Поддержка темы, меню и т.д.
require get_template_directory() . '/inc/scripts.php';     // Подключение CSS и JS
require get_template_directory() . '/inc/languages.php';
add_action('init', function () {
    wp_cache_flush();
});

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
