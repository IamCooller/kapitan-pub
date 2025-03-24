<?php
/**
 * Настройки языков
 */

// Добавляем поддержку языков для ACF полей
add_filter('acf/load_value', function ($value, $post_id, $field) {
    if (function_exists('pll_get_post_language')) {
        $lang = pll_get_post_language($post_id);
        if ($lang) {
            $value = get_field($field['name'], $post_id, $lang);
        }
    }
    return $value;
}, 10, 3);
