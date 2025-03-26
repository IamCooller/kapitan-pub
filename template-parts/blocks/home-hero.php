<?php

/**
 * Home Hero Block Template.
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool $is_preview True during backend preview render.
 * @param int $post_id The post ID the block is rendering content from.
 * @param array $context The context provided to the block by the post or its parent block.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'home-hero-' . $block['id'];
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'hero';
if (!empty($block['className'])) {
    $className .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $className .= ' align' . $block['align'];
}

// Load values and assign defaults.
$background_image = get_field('hero_background_image');
$background_url = $background_image ? $background_image['url'] : get_template_directory_uri() . '/assets/img/home/hero-bg.png';
$buttons = get_field('hero_buttons') ?: [];
?>

<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>"
    style="background-image: url(<?php echo esc_url($background_url); ?>); background-size: cover; background-position: center;">
    <div class="hero__inner">
        <div class="hero__logo">
            <?php
            if (has_custom_logo()) {
                the_custom_logo();
            } else {
                echo '<a href="' . esc_url(home_url('/')) . '" aria-label="' . esc_attr(get_bloginfo('name')) . '">' . get_bloginfo('name') . '</a>';
            }
            ?>
        </div>

        <div class="hero__buttons">
            <a href="/booking" class="button booking-button">
                <?php esc_html_e('BOOK A TABLE', 'kapitan'); ?>
            </a>
            <?php if ($buttons) : ?>
                <?php foreach ($buttons as $button) : ?>
                    <a href="<?php echo esc_url($button['link']); ?>" class="button">
                        <?php echo esc_html($button['text']); ?>
                    </a>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>