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
    <section class="map-section">
        <?php
        // Process the embed code to add our custom class to the iframe
        $embed_code = str_replace('<iframe', '<iframe class="map-iframe"', $embed_code);

        echo wp_kses($embed_code, [
            'iframe' => [
                'src' => [],
                'width' => [],
                'height' => [],
                'style' => [],
                'class' => [],
                'allowfullscreen' => [],
                'loading' => [],
                'referrerpolicy' => []
            ]
        ]);
        ?>
    </section>
<?php endif; ?>