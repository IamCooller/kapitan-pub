<?php
/**
 * Настройки темы
 */

add_action('after_setup_theme', function () {

    // Мультиязычность — Polylang, WPML и т.д.
    load_theme_textdomain('kapitan-pub', get_template_directory() . '/languages');

    // Заголовок страницы
    add_theme_support('title-tag');

    // Миниатюры
    add_theme_support('post-thumbnails');

    // HTML5 разметка
    add_theme_support('html5', [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ]);

    // Меню
    register_nav_menus([
        'main' => __('Main Menu', 'kapitan-pub'),
    ]);

});
