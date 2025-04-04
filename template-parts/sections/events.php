<?php

/**
 * Events section
 *
 * @package KAPITAN_PUB
 */

// Fallback values
$title = !empty(get_sub_field('title')) ? get_sub_field('title') : '';
$subtitle = !empty(get_sub_field('subtitle')) ? get_sub_field('subtitle') : '';
$events = !empty(get_sub_field('events')) ? get_sub_field('events') : [];

?>
<section class="events-section relative">
    <div class="lines"></div>
    <div class="events-container relative">
        <div class="events-header">
            <?php if (!empty($title)) : ?>
                <div class="events-title"><?php echo esc_html($title); ?></div>
            <?php endif; ?>
            <?php if (!empty($subtitle)) : ?>
                <p class="events-description"><?php echo esc_html($subtitle); ?></p>
            <?php endif; ?>
        </div>
        <?php if (!empty($events)) : ?>
            <div class="events-swiper swiper <?php echo count($events) <= 3 ? 'swiper-mobile' : ''; ?>">
                <div class="swiper-wrapper">
                    <?php foreach ($events as $event) :
                        $event_image = !empty($event['image']) ? $event['image'] : '';
                        $event_title = !empty($event['title']) ? $event['title'] : '';
                        $event_date = !empty($event['date']) ? $event['date'] : '';
                        $event_time = !empty($event['time']) ? $event['time'] : '';
                    ?>
                        <div class="event-item swiper-slide">
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
            </div>

            <button class="button-next "
                tabindex="0"
                aria-label="Next">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m9 18 6-6-6-6" />
                </svg>
            </button>
            <button class="button-prev"
                tabindex="0"
                aria-label="Previous">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m15 18-6-6 6-6" />
                </svg>
            </button>
        <?php endif; ?>
    </div>
</section>