<?php

/**
 * Booking Form section
 *
 * @package KAPITAN_PUB
 */


// Fallback values
$image = !empty(get_sub_field('image')) ? get_sub_field('image') : '';
$left_text = !empty(get_sub_field('left_text')) ? get_sub_field('left_text') : '';
$right_text = !empty(get_sub_field('right_text')) ? get_sub_field('right_text') : '';
$title = !empty(get_sub_field('title')) ? get_sub_field('title') : '';
$subtitle = !empty(get_sub_field('subtitle')) ? get_sub_field('subtitle') : '';
?>
<section class="booking-section">
    <div class="booking-container">
        <div class="booking-content">
            <?php if (!empty($title)) : ?>
                <h2 class="h2 md:mb-8">
                    <?php echo esc_html($title); ?>
                </h2>
            <?php endif; ?>
            <div class="booking-content-inner">
                <?php if (!empty($subtitle)) : ?>
                    <h3 class="booking-subtitle">
                        <?php echo esc_html($subtitle); ?>
                    </h3>
                <?php endif; ?>

                <form id="booking-form" class="form" method="post">
                    <div id="response" class="response hidden"></div>
                    <div class="form-group">
                        <label for="name" class="sr-only">
                            <?php echo function_exists('pll__') ? pll__('Name') : 'Name'; ?>
                        </label>
                        <input type="text" id="name" name="name" class="form-input" placeholder="<?php echo function_exists('pll__') ? pll__('Name') : 'Name'; ?>" required />
                        <div class="error-message"></div>
                    </div>

                    <div class="form-group">
                        <label for="email" class="sr-only">
                            <?php echo function_exists('pll__') ? pll__('Email') : 'Email'; ?>
                        </label>
                        <input type="email" id="email" name="email" class="form-input" placeholder="<?php echo function_exists('pll__') ? pll__('Email') : 'Email'; ?>" required />
                        <div class="error-message"></div>
                    </div>

                    <div class="form-group">
                        <label for="phone" class="sr-only">
                            <?php echo function_exists('pll__') ? pll__('Phone') : 'Phone'; ?>
                        </label>
                        <input type="tel" id="phone" name="phone" placeholder="<?php echo function_exists('pll__') ? pll__('Phone Number') : 'Phone Number'; ?>" class="form-input" required />
                        <div class="error-message"></div>
                    </div>

                    <div class="form-group">
                        <label for="persons" class="sr-only">
                            <?php echo function_exists('pll__') ? pll__('Persons') : 'Persons'; ?>
                        </label>
                        <select id="persons" name="persons" class="form-select" required>
                            <option value="1"><?php echo function_exists('pll__') ? pll__('1 person') : '1 person'; ?></option>
                            <option value="2"><?php echo function_exists('pll__') ? pll__('2 persons') : '2 persons'; ?></option>
                            <option value="3-5"><?php echo function_exists('pll__') ? pll__('3-5 persons') : '3-5 persons'; ?></option>
                            <option value="5-10"><?php echo function_exists('pll__') ? pll__('5-10 persons') : '5-10 persons'; ?></option>
                            <option value="more"><?php echo function_exists('pll__') ? pll__('more than 10 persons') : 'more than 10 persons'; ?></option>
                        </select>
                        <div class="error-message"></div>
                    </div>

                    <div class="form-group">
                        <label for="date" class="sr-only">
                            <?php echo function_exists('pll__') ? pll__('Date') : 'Date'; ?>
                        </label>
                        <input type="date" id="date" name="date" class="form-input" required />
                        <div class="error-message"></div>
                    </div>

                    <div class="form-group">
                        <label for="time" class="sr-only">
                            <?php echo function_exists('pll__') ? pll__('Time') : 'Time'; ?>
                        </label>
                        <input type="time" id="time" name="time" class="form-input" required />
                        <div class="error-message"></div>
                    </div>

                    <?php wp_nonce_field('booking_nonce', 'booking_nonce_field'); ?>
                    <input type="hidden" name="action" value="process_booking">
                    <input type="hidden" name="lang" value="<?php echo function_exists('pll_current_language') ? pll_current_language() : 'en'; ?>">

                    <button type="submit" class="button submit">
                        <?php echo function_exists('pll__') ? pll__('BOOK NOW') : 'BOOK NOW'; ?>
                    </button>
                </form>
            </div>
        </div>
        <?php if (!empty($image)) : ?>
            <div class="booking-image-wrapper">
                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                <div class="booking-caption">
                    <?php if (!empty($left_text)) : ?>
                        <?php echo esc_html($left_text); ?>
                        <br />
                    <?php endif; ?>
                    <?php if (!empty($right_text)) : ?>
                        <span class="booking-caption-right">
                            <?php echo esc_html($right_text); ?>
                        </span>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>