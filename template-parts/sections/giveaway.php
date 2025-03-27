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
<section class="bg-blue py-[100px]">
    <div class="container grid grid-cols-2 items-center gap-[200px]">
        <div class="">
            <?php if (!empty($title)) : ?>
                <h2 class="h2 mb-8"><?php echo esc_html($title); ?></h2>
            <?php endif; ?>
            <div class="pl-[100px]">
                <?php if (!empty($text)) : ?>
                    <p class="max-w-[470px]"><?php echo esc_html($text); ?></p>
                <?php endif; ?>
                <?php if (!empty($button_text) && !empty($button_link)) : ?>
                    <a href="<?php echo esc_url($button_link); ?>" class="button mt-6 max-w-[206px]"><?php echo esc_html($button_text); ?></a>
                <?php endif; ?>
            </div>
        </div>
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
    </div>
</section>