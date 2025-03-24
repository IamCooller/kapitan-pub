<?php
/**
 * Подключение стилей и скриптов
 */

add_action('wp_enqueue_scripts', function () {
    // Основные стили темы
    wp_enqueue_style('kapitan-pub-style', get_stylesheet_uri(), [], _S_VERSION);

    wp_enqueue_style('kapitan-pub-normalize', get_template_directory_uri() . '/assets/css/normalize.css', [], _S_VERSION);

    // Скомпилированные стили
    wp_enqueue_style(
        'kapitan-pub-main',
        get_template_directory_uri() . '/assets/css/main.css',
        [],
        _S_VERSION
    );

    // Скрипты
    wp_enqueue_script('kapitan-pub-scripts', get_template_directory_uri() . '/assets/js/scripts.js', [], _S_VERSION, true);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
});
