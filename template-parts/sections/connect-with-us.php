<?php

/**
 * connect-with-us section
 *
 * @package KAPITAN_PUB
 */


// Fallback values
$title = !empty(get_field('connect_title', 'option')) ? get_field('connect_title', 'option') : '';
$text = !empty(get_field('connect_text', 'option')) ? get_field('connect_text', 'option') : '';
$hashtag = !empty(get_field('connect_hashtag', 'option')) ? get_field('connect_hashtag', 'option') : '';
$images = !empty(get_field('connect_images', 'option')) ? get_field('connect_images', 'option') : [];

?>
<section class="connect-with-us-section relative" id="connect-with-us">
    <div class="lines"></div>
    <div class="connect-with-us-container">
        <div class="connect-with-us-header">
            <?php if (!empty($title)) : ?>
                <div class="connect-with-us-title"><?php echo esc_html($title); ?></div>
            <?php endif; ?>
            <?php if (!empty($text)) : ?>
                <p class="connect-with-us-description"><?php echo esc_html($text); ?></p>
            <?php endif; ?>
        </div>
        <?php if (!empty($images)) : ?>
            <div class="connect-with-us-slider">
                <div class="swiper-wrapper">
                    <?php foreach ($images as $image) : ?>
                        <div class="swiper-slide">
                            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
        <?php if (!empty($hashtag)) : ?>
            <p class="connect-with-us-hashtag"><?php echo esc_html($hashtag); ?></p>
        <?php endif; ?>
    </div>
</section>