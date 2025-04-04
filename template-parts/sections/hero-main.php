<?php

/**
 * Home Hero Main section
 *
 * @package KAPITAN_PUB
 */


// Fallback values
$background_image = !empty(get_sub_field('background_image')) ? get_sub_field('background_image') : '';
$buttons = !empty(get_sub_field('buttons')) ? get_sub_field('buttons') : [];
?>

<section class="hero " id="hero-main" <?php if (!empty($background_image)) : ?>style="background-image: url(<?php echo esc_url($background_image['url']); ?>); background-size: cover; background-position: center;" <?php endif; ?>>
    <div class="hero__inner relative z-[1]">


        <div class="hero__buttons hero-stagger-container">
            <a href="/booking" class="button booking-button ">
                <?php echo function_exists('pll__') ? pll__('BOOK A TABLE') : 'BOOK A TABLE'; ?>
            </a>
            <?php if (!empty($buttons)) : ?>
                <?php
                foreach ($buttons as $button) :
                    $button_text = !empty($button['text']) ? $button['text'] : '';
                    $button_link = !empty($button['link']) ? $button['link'] : '#';

                    if (!empty($button_text)) :
                ?>
                        <a href="<?php echo esc_url($button_link); ?>" class="button ">
                            <?php echo esc_html($button_text); ?>
                        </a>
                <?php
                    endif;
                endforeach;
                ?>
            <?php endif; ?>
        </div>
    </div>
</section>