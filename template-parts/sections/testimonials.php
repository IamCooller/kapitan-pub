<?php

/**
 * Testimonials section
 *
 * @package KAPITAN_PUB
 */




// Fallback values
$title = !empty(get_sub_field('title')) ? get_sub_field('title') : '';
$image = !empty(get_sub_field('image')) ? get_sub_field('image') : '';
$image_text = !empty(get_sub_field('image_text')) ? get_sub_field('image_text') : '';
$testimonials = !empty(get_sub_field('testimonials')) ? get_sub_field('testimonials') : [];

?>
<section class="bg-blue py-[100px]">
    <div class="container grid grid-cols-2 items-center gap-[200px]">
        <?php if (!empty($image)) : ?>
            <div class="relative h-fit pr-[58px]">
                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" class="w-full" />
                <?php if (!empty($image_text)) : ?>
                    <div class="absolute bottom-0 right-0 font-island text-5xl -rotate-4">
                        <span class="text-white"><?php echo esc_html($image_text); ?></span>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
        <div class="">
            <?php if (!empty($title)) : ?>
                <h2 class="h2 mb-8"><?php echo esc_html($title); ?></h2>
            <?php endif; ?>
            <?php if (!empty($testimonials)) : ?>
                <div class="pl-[100px]">
                    <div class="testimonials-slider">
                        <div class="swiper-wrapper">
                            <?php foreach ($testimonials as $testimonial) :
                                $testimonial_text = !empty($testimonial['text']) ? $testimonial['text'] : '';
                                $testimonial_author = !empty($testimonial['author']) ? $testimonial['author'] : '';

                                if (!empty($testimonial_text) || !empty($testimonial_author)) :
                            ?>
                                    <div class="swiper-slide">
                                        <?php if (!empty($testimonial_text)) : ?>
                                            <p class="max-w-[470px]"><?php echo esc_html($testimonial_text); ?></p>
                                        <?php endif; ?>
                                        <?php if (!empty($testimonial_author)) : ?>
                                            <div class="mt-6 font-inter text-[12px] uppercase">
                                                <span class="text-secondary">/</span> BY <?php echo esc_html($testimonial_author); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                            <?php
                                endif;
                            endforeach;
                            ?>
                        </div>
                        <div class="testimonials-pagination mt-8"></div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>