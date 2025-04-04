<?php

/**
 * About History section
 *
 * @package KAPITAN_PUB
 */

// Fallback values
$title = !empty(get_sub_field('title')) ? get_sub_field('title') : '';
$description = !empty(get_sub_field('description')) ? get_sub_field('description') : '';
$main_image = !empty(get_sub_field('main_image')) ? get_sub_field('main_image') : '';
$secondary_image = !empty(get_sub_field('secondary_image')) ? get_sub_field('secondary_image') : '';
$hours_title = !empty(get_sub_field('hours_title')) ? get_sub_field('hours_title') : '';
$hours_content = !empty(get_sub_field('hours_content')) ? get_sub_field('hours_content') : '';
$tagline = !empty(get_sub_field('tagline')) ? get_sub_field('tagline') : '';
?>

<section class="about-history-section relative" id="about-history">
    <div class="lines"></div>
    <div class="about-history-container">
        <div class="about-history-grid">
            <div class="about-history-main-image-wrapper">
                <?php if (!empty($main_image)) : ?>
                    <img src="<?php echo esc_url($main_image['url']); ?>" alt="<?php echo esc_attr($main_image['alt']); ?>" class="about-history-main-image">

                <?php endif; ?>
            </div>

            <div class="about-history-content">
                <div class="about-history-info">
                    <?php if (!empty($title)) : ?>
                        <div class="h3"><?php echo esc_html($title); ?></div>
                    <?php endif; ?>

                    <?php if (!empty($description)) : ?>
                        <p class="about-history-description"><?php echo esc_html($description); ?></p>
                    <?php endif; ?>
                </div>

                <div class="about-history-details">
                    <div class="about-history-secondary-image-wrapper">
                        <?php if (!empty($secondary_image)) : ?>
                            <img src="<?php echo esc_url($secondary_image['url']); ?>" alt="<?php echo esc_attr($secondary_image['alt']); ?>" class="about-history-secondary-image">

                        <?php endif; ?>
                    </div>

                    <div class="about-history-meta">
                        <div class="about-history-hours">
                            <?php if (!empty($hours_title)) : ?>
                                <p class="about-history-hours-title"><?php echo esc_html($hours_title); ?></p>
                            <?php endif; ?>

                            <?php if (!empty($hours_content)) : ?>
                                <div class="about-history-hours-content">
                                    <?php echo wp_kses_post($hours_content); ?>
                                </div>

                            <?php endif; ?>
                        </div>

                        <?php if (!empty($tagline)) : ?>
                            <div class="about-history-tagline">
                                <?php echo wp_kses_post($tagline); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>