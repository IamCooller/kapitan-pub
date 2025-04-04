<?php

/**
 * Home Hero Main section
 *
 * @package KAPITAN_PUB
 */


// Fallback values
$background_image = !empty(get_sub_field('background_image')) ? get_sub_field('background_image') : '';
$title = !empty(get_sub_field('title')) ? get_sub_field('title') : '';
$opacity = !empty(get_sub_field('opacity')) ? get_sub_field('opacity') : 0.7;
?>

<section class="hero-secondary" <?php if (!empty($background_image)) : ?>style="background-image: url(<?php echo esc_url($background_image['url']); ?>); background-size: cover; background-position: center;" <?php endif; ?>>
    <div class="hero-secondary__overlay"
        style="opacity: <?php echo esc_attr($opacity); ?>;"></div>
    <div class="hero-secondary__inner relative z-[1]">


        <div class="hero-secondary__content">
            <h1 class="hero-secondary__title"><?php echo esc_html($title); ?></h1>
        </div>
    </div>
</section>