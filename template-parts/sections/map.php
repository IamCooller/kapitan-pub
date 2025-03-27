<?php

/**
 * Map section
 *
 * @package KAPITAN_PUB
 */


// Fallback value
$embed_code = !empty(get_sub_field('embed_code')) ? get_sub_field('embed_code') : '';
?>
<?php if (!empty($embed_code)) : ?>
    <section>
        <?php echo wp_kses($embed_code, [
            'iframe' => [
                'src' => [],
                'width' => [],
                'height' => [],
                'style' => [],
                'allowfullscreen' => [],
                'loading' => [],
                'referrerpolicy' => []
            ]
        ]); ?>
    </section>
<?php endif; ?>