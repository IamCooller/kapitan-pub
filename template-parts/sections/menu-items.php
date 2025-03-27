<?php

/**
 * Menu Items section
 *
 * @package KAPITAN_PUB
 */



// Fallback values
$left_image_1 = !empty(get_sub_field('left_image_1')) ? get_sub_field('left_image_1') : '';
$left_image_2 = !empty(get_sub_field('left_image_2')) ? get_sub_field('left_image_2') : '';
$right_image = !empty(get_sub_field('right_image')) ? get_sub_field('right_image') : '';
$button_text = !empty(get_sub_field('button_text')) ? get_sub_field('button_text') : '';
$button_link = !empty(get_sub_field('button_link')) ? get_sub_field('button_link') : '#';
$categories = !empty(get_sub_field('categories')) ? get_sub_field('categories') : [];


?>
<section class="py-[100px]">
    <div class="container grid grid-cols-3 gap-[100px]">
        <div class="space-y-16">
            <?php if (!empty($left_image_1)) : ?>
                <div class="">
                    <img src="<?php echo esc_url($left_image_1['url']); ?>" alt="<?php echo esc_attr($left_image_1['alt']); ?>" width="<?php echo esc_attr($left_image_1['width']); ?>" height="<?php echo esc_attr($left_image_1['height']); ?>" />
                </div>
            <?php endif; ?>
            <?php if (!empty($left_image_2)) : ?>
                <div class="px-[52px]">
                    <img src="<?php echo esc_url($left_image_2['url']); ?>" alt="<?php echo esc_attr($left_image_2['alt']); ?>" width="<?php echo esc_attr($left_image_2['width']); ?>" height="<?php echo esc_attr($left_image_2['height']); ?>" />
                </div>
            <?php endif; ?>
        </div>
        <div class="space-y-16 text-center">
            <?php
            if (!empty($categories)) :
                foreach ($categories as $category) :
                    $category_title = !empty($category['title']) ? $category['title'] : '';
                    $category_items = !empty($category['items']) ? $category['items'] : '';

                    if (!empty($category_title) || !empty($category_items)) :
            ?>
                        <div>
                            <?php if (!empty($category_title)) : ?>
                                <div class="font-jeju text-2xl uppercase leading-none mb-2.5">
                                    <?php echo esc_html($category_title); ?>
                                </div>
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/Rhombus.svg" alt="<?php echo esc_attr($category_title); ?>" class="w-6 block mx-auto mb-4" />
                            <?php endif; ?>
                            <?php if (!empty($category_items)) : ?>
                                <div class="opacity-65">
                                    <?php echo wp_kses_post($category_items); ?>
                                </div>
                            <?php endif; ?>
                        </div>
            <?php
                    endif;
                endforeach;
            endif;
            ?>
            <?php if (!empty($button_text) && !empty($button_link)) : ?>
                <a href="<?php echo esc_url($button_link); ?>" class="button mx-auto"><?php echo esc_html($button_text); ?></a>
            <?php endif; ?>
        </div>
        <?php if (!empty($right_image)) : ?>
            <div class="py-[100px]">
                <img src="<?php echo esc_url($right_image['url']); ?>" alt="<?php echo esc_attr($right_image['alt']); ?>" width="<?php echo esc_attr($right_image['width']); ?>" height="<?php echo esc_attr($right_image['height']); ?>" />
            </div>
        <?php endif; ?>
    </div>
</section>