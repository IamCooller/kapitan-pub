<?php

/**
 * About Info section
 *
 * @package KAPITAN_PUB
 */

// Fallback values
$title = !empty(get_sub_field('title')) ? get_sub_field('title') : '';
$description = !empty(get_sub_field('description')) ? get_sub_field('description') : '';
$image = !empty(get_sub_field('image')) ? get_sub_field('image') : '';
?>

<section class="about-info-section">
    <div class="about-info-container">
        <div class="about-info-grid">
            <div class="about-info-content">
                <?php if (!empty($title)) : ?>
                    <div class="h3"><?php echo esc_html($title); ?></div>
                <?php endif; ?>

                <?php if (!empty($description)) : ?>
                    <div class="about-info-description"><?php echo wp_kses_post($description); ?></div>

                <?php endif; ?>
            </div>

            <div class="about-info-image-wrapper">
                <?php if (!empty($image)) : ?>
                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" class="about-info-image">

                <?php endif; ?>
            </div>
        </div>
    </div>
</section>