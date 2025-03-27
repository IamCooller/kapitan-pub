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
<section class="py-[100px]">
    <div class="container space-y-16">
        <div class="text-center max-w-[448px] mx-auto">
            <?php if (!empty($title)) : ?>
                <div class="text-[32px] uppercase mb-2.5 leading-none"><?php echo esc_html($title); ?></div>
            <?php endif; ?>
            <?php if (!empty($text)) : ?>
                <p class="opacity-65"><?php echo esc_html($text); ?></p>
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
            <p class="text-center text-[12px] mt-8"><?php echo esc_html($hashtag); ?></p>
        <?php endif; ?>
    </div>
</section>