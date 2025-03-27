<?php

/**
 * Instagram section
 *
 * @package KAPITAN_PUB
 */


// Fallback values
$title = !empty(get_sub_field('title')) ? get_sub_field('title') : '';
$text = !empty(get_sub_field('text')) ? get_sub_field('text') : '';
$hashtag = !empty(get_sub_field('hashtag')) ? get_sub_field('hashtag') : '';
$images = !empty(get_sub_field('images')) ? get_sub_field('images') : [];

?>
<section class="instagram-section">
    <div class="instagram-container">
        <div class="instagram-header">
            <?php if (!empty($title)) : ?>
                <div class="instagram-title"><?php echo esc_html($title); ?></div>
            <?php endif; ?>
            <?php if (!empty($text)) : ?>
                <p class="instagram-description"><?php echo esc_html($text); ?></p>
            <?php endif; ?>
        </div>
        <?php if (!empty($images)) : ?>
            <div class="instagram-slider">
                <div class="swiper-wrapper">
                    <?php foreach ($images as $image) :
                        if (!empty($image['image'])) :
                    ?>
                            <div class="swiper-slide">
                                <img src="<?php echo esc_url($image['image']['url']); ?>" alt="<?php echo esc_attr($image['image']['alt']); ?>" />
                            </div>
                    <?php
                        endif;
                    endforeach;
                    ?>
                </div>

            </div>
        <?php endif; ?>
        <?php if (!empty($hashtag)) : ?>
            <p class="instagram-hashtag"><?php echo esc_html($hashtag); ?></p>
        <?php endif; ?>
    </div>
</section>