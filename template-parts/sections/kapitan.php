<?php

/**
 * Hero section - Kapitan is for everyone who
 *
 * @package KAPITAN_PUB
 */


// Fallback values
$title = !empty(get_sub_field('title')) ? get_sub_field('title') : '';
$text = !empty(get_sub_field('text')) ? get_sub_field('text') : '';
$quote = !empty(get_sub_field('quote')) ? get_sub_field('quote') : '';
$image = !empty(get_sub_field('image')) ? get_sub_field('image') : '';
?>
<section class="space-y-16 py-14">
    <div class="kapitan-for-everyone">
        <div class="kapitan-for-everyone__inner">
            <?php if (!empty($image)) : ?>
                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" class="kapitan-for-everyone__image" />
            <?php endif; ?>
            <?php if (!empty($title)) : ?>
                <h2 class="kapitan-for-everyone__title"><?php echo esc_html($title); ?></h2>
            <?php endif; ?>
            <?php if (!empty($text)) : ?>
                <p class="kapitan-for-everyone__text opacity-65 font-medium"><?php echo esc_html($text); ?></p>
            <?php endif; ?>
            <?php if (!empty($quote)) : ?>
                <p class="kapitan-for-everyone__quote"><?php echo esc_html($quote); ?></p>
            <?php endif; ?>
        </div>
    </div>
</section>