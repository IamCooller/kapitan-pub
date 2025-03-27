<?php

/**
 * Cuisine and Chefs section
 *
 * @package KAPITAN_PUB
 */

// Check if we have rows in the repeater
if (have_rows('content_blocks')) :
?>
    <section class="space-y-16 pb-[100px]">
        <?php
        // Loop through the rows of the repeater
        while (have_rows('content_blocks')) : the_row();
            // Get field values with fallbacks
            $title = get_sub_field('title') ?: '';
            $subtitle = get_sub_field('subtitle') ?: '';
            $text = get_sub_field('text') ?: '';
            $button_text = get_sub_field('button_text') ?: '#';
            $button_link = get_sub_field('button_link') ?: '';
            $main_image = get_sub_field('main_image') ?: '';
            $secondary_image = get_sub_field('secondary_image') ?: ''; // Optional secondary image
            $image_position = get_sub_field('image_position') ?: 'left'; // Default to left if not set

            // Skip this block if required fields are empty
            if (empty($title) && empty($main_image)) {
                continue;
            }

            // Determine the layout based on image position
            $is_image_left = ($image_position === 'left');
        ?>
            <div class="container grid grid-cols-2 gap-16 items-center">
                <?php if ($is_image_left) : ?>
                    <div class="relative">
                        <?php if (!empty($main_image)) : ?>
                            <div class="overflow-hidden max-w-[490px] min-h-[559px]">
                                <img src="<?php echo esc_url($main_image['url']); ?>" alt="<?php echo esc_attr($main_image['alt']); ?>" class="w-full h-full object-cover" />
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($secondary_image)) : ?>
                            <img src="<?php echo esc_url($secondary_image['url']); ?>" alt="<?php echo esc_attr($secondary_image['alt']); ?>" class="absolute bottom-8 right-0 aspect-square w-[211px]" />
                        <?php endif; ?>
                    </div>

                    <div class="">
                        <?php if (!empty($title)) : ?>
                            <h2 class="h2 mb-8"><?php echo esc_html($title); ?></h2>
                        <?php endif; ?>

                        <div class="px-10 space-y-6">
                            <?php if (!empty($subtitle)) : ?>
                                <h3 class="text-[32px]"><?php echo esc_html($subtitle); ?></h3>
                            <?php endif; ?>

                            <?php if (!empty($text)) : ?>
                                <p class="opacity-65"><?php echo esc_html($text); ?></p>
                            <?php endif; ?>

                            <?php if (!empty($button_text) && !empty($button_link)) : ?>
                                <a href="<?php echo esc_url($button_link); ?>" class="button"><?php echo esc_html($button_text); ?></a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php else : ?>
                    <div class="">
                        <?php if (!empty($title)) : ?>
                            <h2 class="h2 mb-8"><?php echo esc_html($title); ?></h2>
                        <?php endif; ?>

                        <div class="px-10 space-y-6">
                            <?php if (!empty($subtitle)) : ?>
                                <h3 class="text-[32px]"><?php echo esc_html($subtitle); ?></h3>
                            <?php endif; ?>

                            <?php if (!empty($text)) : ?>
                                <p class="opacity-65"><?php echo esc_html($text); ?></p>
                            <?php endif; ?>

                            <?php if (!empty($button_text) && !empty($button_link)) : ?>
                                <a href="<?php echo esc_url($button_link); ?>" class="button"><?php echo esc_html($button_text); ?></a>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="relative">
                        <?php if (!empty($secondary_image)) : ?>
                            <img src="<?php echo esc_url($secondary_image['url']); ?>" alt="<?php echo esc_attr($secondary_image['alt']); ?>" class="absolute bottom-8 left-0 aspect-square w-[211px]" />
                        <?php endif; ?>

                        <?php if (!empty($main_image)) : ?>
                            <div class="overflow-hidden max-w-[490px] min-h-[559px] ml-auto">
                                <img src="<?php echo esc_url($main_image['url']); ?>" alt="<?php echo esc_attr($main_image['alt']); ?>" class="w-full h-full object-cover" />
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php endwhile; ?>
    </section>
<?php endif; ?>