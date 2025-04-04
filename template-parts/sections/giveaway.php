<?php

/**
 * Giveaway section
 *
 * @package KAPITAN_PUB
 */


// Fallback values
$title = !empty(get_sub_field('title')) ? get_sub_field('title') : '';
$text = !empty(get_sub_field('text')) ? get_sub_field('text') : '';
$button_text = !empty(get_sub_field('button_text')) ? get_sub_field('button_text') : '';
$button_link = !empty(get_sub_field('button_link')) ? get_sub_field('button_link') : '#';
$image = !empty(get_sub_field('image')) ? get_sub_field('image') : '';
$image_text = !empty(get_sub_field('image_text')) ? get_sub_field('image_text') : '';
?>
<section class="giveaway-section" id="giveaway">
    <div class="giveaway-container">
        <div class="giveaway-content">
            <?php if (!empty($title)) : ?>
                <h2 class="h2 md:mb-8"><?php echo esc_html($title); ?></h2>
            <?php endif; ?>
            <div class="giveaway-text-wrapper">
                <?php if (!empty($text)) : ?>
                    <p class="giveaway-text"><?php echo esc_html($text); ?></p>
                <?php endif; ?>
                <?php if (!empty($button_text) && !empty($button_link)) : ?>
                    <a href="<?php echo esc_url($button_link); ?>" class="button giveaway-button"><?php echo esc_html($button_text); ?></a>
                <?php endif; ?>
            </div>
        </div>
        <?php if (!empty($image)) : ?>
            <div class="giveaway-image-wrapper">
                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" class="giveaway-image" />
                <?php if (!empty($image_text)) : ?>
                    <div class="giveaway-image-caption">
                        <span class="giveaway-image-caption-text"><?php echo esc_html($image_text); ?></span>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</section>