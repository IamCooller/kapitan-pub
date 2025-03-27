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
<section class="py-[100px]">
    <div class="container space-y-16">
        <div class="text-center max-w-[448px] mx-auto">
            <?php if (!empty($title)) : ?>
                <div class="text-[32px] uppercase mb-2.5 leading-none"><?php echo esc_html($title); ?></div>
            <?php endif; ?>
            <?php if (!empty($subtitle)) : ?>
                <p class="opacity-65"><?php echo esc_html($subtitle); ?></p>
            <?php endif; ?>
        </div>
        <?php if (!empty($events)) : ?>
            <div class="grid grid-cols-3 gap-[100px]">
                <?php foreach ($events as $event) :
                    $event_image = !empty($event['image']) ? $event['image'] : '';
                    $event_title = !empty($event['title']) ? $event['title'] : '';
                    $event_date = !empty($event['date']) ? $event['date'] : '';
                    $event_time = !empty($event['time']) ? $event['time'] : '';
                ?>
                    <div class="flex flex-col">
                        <?php if (!empty($event_image)) : ?>
                            <img src="<?php echo esc_url($event_image['url']); ?>" alt="<?php echo esc_attr($event_image['alt']); ?>" class="w-full object-cover" />
                        <?php endif; ?>
                        <div class="mt-9 text-center space-y-4">
                            <?php if (!empty($event_title)) : ?>
                                <div class="uppercase">
                                    <?php echo esc_html($event_title); ?>
                                </div>
                            <?php endif; ?>
                            <div class="opacity-65">
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