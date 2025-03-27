<?php

/**
 * Events section
 *
 * @package KAPITAN_PUB
 */

// Enqueue needed scripts for this section
wp_enqueue_style('swiper-css');
wp_enqueue_script('swiper-js');
wp_enqueue_script('events-slider-js');

// Fallback values
$title = !empty(get_sub_field('title')) ? get_sub_field('title') : '';
$subtitle = !empty(get_sub_field('subtitle')) ? get_sub_field('subtitle') : '';
$events = !empty(get_sub_field('events')) ? get_sub_field('events') : [];


?>
<section class="events-section">
    <div class="events-container">
        <div class="events-header">
            <?php if (!empty($title)) : ?>
                <div class="events-title"><?php echo esc_html($title); ?></div>
            <?php endif; ?>
            <?php if (!empty($subtitle)) : ?>
                <p class="events-description"><?php echo esc_html($subtitle); ?></p>
            <?php endif; ?>
        </div>
        <?php if (!empty($events)) : ?>
            <div class="events-grid">
                <?php foreach ($events as $event) :
                    $event_image = !empty($event['image']) ? $event['image'] : '';
                    $event_title = !empty($event['title']) ? $event['title'] : '';
                    $event_date = !empty($event['date']) ? $event['date'] : '';
                    $event_time = !empty($event['time']) ? $event['time'] : '';
                ?>
                    <div class="event-item">
                        <?php if (!empty($event_image)) : ?>
                            <img src="<?php echo esc_url($event_image['url']); ?>" alt="<?php echo esc_attr($event_image['alt']); ?>" class="event-image" />
                        <?php endif; ?>
                        <div class="event-content">
                            <?php if (!empty($event_title)) : ?>
                                <div class="event-title">
                                    <?php echo esc_html($event_title); ?>
                                </div>
                            <?php endif; ?>
                            <div class="event-details">
                                <?php if (!empty($event_date)) : ?>
                                    <p><?php echo esc_html($event_date); ?></p>
                                <?php endif; ?>
                                <?php if (!empty($event_time)) : ?>
                                    <p><?php echo esc_html($event_time); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>