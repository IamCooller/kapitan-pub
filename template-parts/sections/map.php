<?php

/**
 * Map section
 *
 * @package KAPITAN_PUB
 */


// Fallback value
$map_frame = !empty(get_field('map', 'option')) ? get_field('map', 'option') : '';

// Attempt to remove loading="lazy" if it exists in the iframe tag
if (strpos($map_frame, '<iframe') !== false) {
    $map_frame = str_replace(' loading="lazy"', '', $map_frame);
}

?>
<?php if (!empty($map_frame)) : ?>
    <section class="map-section" id="map">
        <?php echo $map_frame; ?>
    </section>
<?php endif; ?>