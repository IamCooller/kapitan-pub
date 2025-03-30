<?php

/**
 * Настройки темы
 */

add_action('after_setup_theme', function () {



    // Регистрация строк для перевода
    if (function_exists('pll_register_string')) {
        pll_register_string('book_table', 'BOOK A TABLE', 'kapitan-pub');
        pll_register_string('main_menu', 'Main Menu', 'kapitan-pub');

        // Проверяем настройки Polylang
        if (function_exists('pll_current_language')) {
            $current_lang = pll_current_language();
            $languages = pll_the_languages(['hide_if_empty' => 0, 'raw' => 1]);

            if (empty($languages)) {
                error_log('Polylang: No languages configured. Please add languages in Polylang settings.');
            }
        }
    }

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
        'header-menu' => __('Header Menu', 'kapitan-pub'),
        'footer-menu' => __('Footer Menu', 'kapitan-pub'),
    ]);

    // Поддержка кастомного логотипа
    add_theme_support('custom-logo', [
        'height'      => 250,
        'width'       => 250,
        'flex-width'  => true,
        'flex-height' => true,
    ]);

    // Установка дефолтного логотипа при активации темы
    if (! get_theme_mod('custom_logo')) {
        $default_logo = get_template_directory_uri() . '/assets/img/logo.png';
        $upload_dir   = wp_upload_dir();
        $image_data   = file_get_contents($default_logo);

        if ($image_data) {
            $filename = basename($default_logo);
            if (wp_mkdir_p($upload_dir['path'])) {
                $file = $upload_dir['path'] . '/' . $filename;
            } else {
                $file = $upload_dir['basedir'] . '/' . $filename;
            }

            file_put_contents($file, $image_data);

            $wp_filetype = wp_check_filetype($filename, null);

            $attachment = [
                'post_mime_type' => $wp_filetype['type'],
                'post_title'     => sanitize_file_name($filename),
                'post_content'   => '',
                'post_status'    => 'inherit',
            ];

            $attach_id = wp_insert_attachment($attachment, $file);
            require_once(ABSPATH . 'wp-admin/includes/image.php');

            $attach_data = wp_generate_attachment_metadata($attach_id, $file);
            wp_update_attachment_metadata($attach_id, $attach_data);

            set_theme_mod('custom_logo', $attach_id);
        }
    }

    // Импорт ACF полей при активации темы
    if (function_exists('acf_update_setting')) {
        $acf_json_path = get_stylesheet_directory() . '/assets/acf-json';

        // Проверяем существование директории
        if (is_dir($acf_json_path)) {
            // Получаем все JSON файлы
            $json_files = glob($acf_json_path . '/*.json');

            if (! empty($json_files)) {
                foreach ($json_files as $json_file) {
                    // Получаем содержимое JSON файла
                    $json_data = file_get_contents($json_file);

                    if ($json_data) {
                        $field_group = json_decode($json_data, true);

                        // Проверяем, существует ли уже группа полей
                        $existing = acf_get_field_group($field_group['key']);

                        if (! $existing) {
                            // Импортируем группу полей
                            acf_update_field_group($field_group);
                        }
                    }
                }
            }
        }
    }
});




class Custom_Walker_Nav_Menu extends Walker_Nav_Menu
{
    public function start_lvl(&$output, $depth = 0, $args = [])
    {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<div class=\"sub-menu\">\n";
    }

    public function start_el(&$output, $item, $depth = 0, $args = [], $id = 0)
    {
        $indent = ($depth) ? str_repeat("\t", $depth) : '';

        $classes     = empty($item->classes) ? [] : (array) $item->classes;
        $classes[]   = 'header__menu-link';
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
        $class_names = ' class="' . esc_attr($class_names) . '"';

        $attributes = ! empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
        $attributes .= ! empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
        $attributes .= ! empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
        $attributes .= ! empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';

        $output .= $indent . '<a' . $class_names . $attributes . '>';
        $output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
        $output .= '</a>';
    }
}

// Разрешаем загрузку SVG файлов
add_filter('upload_mimes', function ($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
});

// Исправляем проверку MIME типа для SVG файлов
add_filter('wp_check_filetype_and_ext', function ($data, $file, $filename, $mimes) {
    $filetype = wp_check_filetype($filename, $mimes);

    if ('svg' === $filetype['ext']) {
        $data['ext'] = 'svg';
        $data['type'] = 'image/svg+xml';
    }

    return $data;
}, 10, 4);
