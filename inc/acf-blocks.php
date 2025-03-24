<?php
/**
 * Регистрация ACF блоков
 */

add_action('acf/init', function () {

    if (function_exists('acf_register_block_type')) {

        acf_register_block_type([
            'name'            => 'hero',
            'title'           => __('Hero Block', 'kapitan-pub'),
            'description'     => __('Main banner', 'kapitan-pub'),
            'render_template' => 'template-parts/blocks/hero.php',
            'category'        => 'layout',
            'icon'            => 'format-image',
            'mode'            => 'edit',
            'supports'        => ['align' => false],
        ]);

        // Можно добавить другие блоки тут же
    }

});
