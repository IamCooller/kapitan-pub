<?php

/**
 * Map section
 *
 * @package KAPITAN_PUB
 */


// Fallback value
$map_frame = !empty(get_field('map', 'option')) ? get_field('map', 'option') : '';
?>
<?php if (!empty($map_frame)) : ?>
    <section class="map-section">
        <?php echo $map_frame; ?>
    </section>
<?php endif; ?>