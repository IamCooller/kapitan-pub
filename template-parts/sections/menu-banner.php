<?php

/**
 * Menu Banner section
 *
 * @package KAPITAN_PUB
 */
?>

<?php
$background_image = !empty(get_sub_field('background_image')) ? get_sub_field('background_image') : '';
$title = !empty(get_sub_field('title')) ? get_sub_field('title') : '';
$subtitle = !empty(get_sub_field('subtitle')) ? get_sub_field('subtitle') : '';
?>
<section class="bg-cover bg-center bg-no-repeat h-[540px] w-full"
    <?php if (!empty($background_image)) : ?>
    style="background-image: url(<?php echo esc_url($background_image['url']); ?>);"
    <?php endif; ?>>
    <div class="container h-full flex items-center justify-center relative">
        <div class="absolute top-1/2 translate-y-1/2 left-0 w-full h-[1px] bg-white max-w-1/3"></div>
        <div class="absolute top-1/2 translate-y-1/2 right-0 w-full h-[1px] bg-white max-w-1/3"></div>
        <div class="text-center">
            <?php if (!empty($title)) : ?>
                <p class="font-jeju text-[80px] mb-2.5 uppercase leading-none"><?php echo esc_html($title); ?></p>
            <?php endif; ?>
            <?php if (!empty($subtitle)) : ?>
                <p class="font-inter text-[20px]"><?php echo esc_html($subtitle); ?></p>
            <?php endif; ?>
        </div>
    </div>
</section>