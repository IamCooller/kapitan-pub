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
<section class="testimonials-section" id="testimonials">
    <div class="testimonials-container">
        <?php if (!empty($image)) : ?>
            <div class="testimonials-image-wrapper">
                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" class="testimonials-image" />
                <?php if (!empty($image_text)) : ?>
                    <div class="testimonials-image-caption">
                        <span class="testimonials-image-caption-text"><?php echo esc_html($image_text); ?></span>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
        <div class="testimonials-content">
            <?php if (!empty($title)) : ?>
                <h2 class="h2 md:mb-8"><?php echo esc_html($title); ?></h2>
            <?php endif; ?>
            <?php if (!empty($testimonials)) : ?>
                <div class="testimonials-slider-wrapper">
                    <div class="testimonials-slider">
                        <div class="swiper-wrapper">
                            <?php foreach ($testimonials as $testimonial) :
                                $testimonial_text = !empty($testimonial['text']) ? $testimonial['text'] : '';
                                $testimonial_author = !empty($testimonial['author']) ? $testimonial['author'] : '';

                                if (!empty($testimonial_text) || !empty($testimonial_author)) :
                            ?>
                                    <div class="swiper-slide">
                                        <?php if (!empty($testimonial_text)) : ?>
                                            <p class="testimonials-quote"><?php echo esc_html($testimonial_text); ?></p>
                                        <?php endif; ?>
                                        <?php if (!empty($testimonial_author)) : ?>
                                            <div class="testimonials-author">
                                                <span class="testimonials-author-separator">/</span> BY <?php echo esc_html($testimonial_author); ?>
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