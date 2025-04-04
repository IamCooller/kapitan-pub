<?php

/**
 * Cuisine and Chefs section
 *
 * @package KAPITAN_PUB
 */

// Check if we have rows in the repeater
if (have_rows('content_blocks')) :
?>
    <section class="cuisine-chefs-section relative" id="cuisine-chefs">
        <div class="lines"></div>
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
            <div class="cuisine-chefs-container">
                <?php if ($is_image_left) : ?>
                    <div class="cuisine-chefs-image-wrapper cuisine-chefs-image-wrapper--left">
                        <?php if (!empty($main_image)) : ?>
                            <div class="cuisine-chefs-main-image-wrapper">
                                <img src="<?php echo esc_url($main_image['url']); ?>" alt="<?php echo esc_attr($main_image['alt']); ?>" class="cuisine-chefs-main-image" />
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($secondary_image)) : ?>
                            <img src="<?php echo esc_url($secondary_image['url']); ?>" alt="<?php echo esc_attr($secondary_image['alt']); ?>" class="cuisine-chefs-secondary-image cuisine-chefs-secondary-image--right" />
                        <?php endif; ?>
                    </div>

                    <div class="cuisine-chefs-content">
                        <?php if (!empty($title)) : ?>
                            <h2 class="h2 md:mb-8"><?php echo esc_html($title); ?></h2>
                        <?php endif; ?>

                        <div class="cuisine-chefs-content-inner">
                            <?php if (!empty($subtitle)) : ?>
                                <h3 class="h3"><?php echo esc_html($subtitle); ?></h3>
                            <?php endif; ?>

                            <?php if (!empty($text)) : ?>
                                <p class="cuisine-chefs-text"><?php echo esc_html($text); ?></p>
                            <?php endif; ?>

                            <?php if (!empty($button_text) && !empty($button_link)) : ?>
                                <div class="cuisine-chefs-button-wrapper">
                                    <a href="<?php echo esc_url($button_link); ?>" class="button"><?php echo esc_html($button_text); ?></a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php else : ?>
                    <div class="cuisine-chefs-content">
                        <?php if (!empty($title)) : ?>
                            <h2 class="h2 md:mb-8"><?php echo esc_html($title); ?></h2>
                        <?php endif; ?>

                        <div class="cuisine-chefs-content-inner">
                            <?php if (!empty($subtitle)) : ?>
                                <h3 class="h3"><?php echo esc_html($subtitle); ?></h3>
                            <?php endif; ?>

                            <?php if (!empty($text)) : ?>
                                <p class="cuisine-chefs-text"><?php echo esc_html($text); ?></p>
                            <?php endif; ?>

                            <?php if (!empty($button_text) && !empty($button_link)) : ?>
                                <div class="cuisine-chefs-button-wrapper">
                                    <a href="<?php echo esc_url($button_link); ?>" class="button"><?php echo esc_html($button_text); ?></a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="cuisine-chefs-image-wrapper cuisine-chefs-image-wrapper--right  ">
                        <?php if (!empty($secondary_image)) : ?>
                            <img src="<?php echo esc_url($secondary_image['url']); ?>" alt="<?php echo esc_attr($secondary_image['alt']); ?>" class="cuisine-chefs-secondary-image cuisine-chefs-secondary-image--left" />
                        <?php endif; ?>

                        <?php if (!empty($main_image)) : ?>
                            <div class="cuisine-chefs-main-image-wrapper cuisine-chefs-main-image-wrapper--right">
                                <img src="<?php echo esc_url($main_image['url']); ?>" alt="<?php echo esc_attr($main_image['alt']); ?>" class="cuisine-chefs-main-image" />
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php endwhile; ?>
    </section>
<?php endif; ?>