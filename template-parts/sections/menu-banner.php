<?php

/**
 * Menu Banner section
 *
 * @package KAPITAN_PUB
 */
?>

<?php
$background_image = !empty(get_sub_field('background_image')) ? get_sub_field('background_image') : '';
$title = !empty(get_sub_field('title')) ? get_sub_field('title') : '';
$subtitle = !empty(get_sub_field('subtitle')) ? get_sub_field('subtitle') : '';
?>
<section class="menu-banner relative"
    <?php if (!empty($background_image)) : ?>
    style="background-image: url(<?php echo esc_url($background_image['url']); ?>);"
    <?php endif; ?>>
    <div class="menu-banner-container">
        <div class="menu-banner-line-left"></div>
        <div class="menu-banner-line-right"></div>
        <div class="menu-banner-content">
            <?php if (!empty($title)) : ?>
                <p class="menu-banner-title"><?php echo esc_html($title); ?></p>
            <?php endif; ?>
            <?php if (!empty($subtitle)) : ?>
                <p class="menu-banner-subtitle"><?php echo esc_html($subtitle); ?></p>
            <?php endif; ?>
        </div>
        <a href="/menu" class="absolute bottom-0 left-0 w-full h-full"></a>
    </div>
</section>