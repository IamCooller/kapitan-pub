<?php

/**
 * Contact Info section
 *
 * @package KAPITAN_PUB
 */

// Fallback values
$title = !empty(get_sub_field('title')) ? get_sub_field('title') : 'WRITE TO US';
$email_text = !empty(get_sub_field('email_text')) ? get_sub_field('email_text') : 'For general enquiries please email:';
$email = !empty(get_sub_field('email')) ? get_sub_field('email') : 'fidalgo@example.com';
$info_blocks = !empty(get_sub_field('info_blocks')) ? get_sub_field('info_blocks') : [];
?>

<section class="contact-info-section">
    <div class="contact-info-container">
        <div class="contact-info-grid">
            <div class="contact-info-form-col">
                <div class="contact-info-title"><?php echo esc_html($title); ?></div>
                <p class="contact-info-text">
                    <?php echo esc_html($email_text); ?>
                    <a href="mailto:<?php echo esc_attr($email); ?>" class="contact-info-email"><?php echo esc_html($email); ?></a>
                </p>

                <form id="contact-form" class="contact-form" method="post">
                    <div id="response" class="contact-form-response hidden"></div>
                    <div class="contact-form-group">
                        <label for="name" class="sr-only">
                            <?php echo function_exists('pll__') ? pll__('Name') : 'Name'; ?>
                        </label>
                        <input type="text" id="name" name="name" class="contact-form-input" placeholder="<?php echo function_exists('pll__') ? pll__('Name') : 'Name'; ?>" required />
                        <div class="contact-form-error"></div>
                    </div>

                    <div class="contact-form-group">
                        <label for="email" class="sr-only">
                            <?php echo function_exists('pll__') ? pll__('Email') : 'Email'; ?>
                        </label>
                        <input type="email" id="email" name="email" class="contact-form-input" placeholder="<?php echo function_exists('pll__') ? pll__('Email') : 'Email'; ?>" required />
                        <div class="contact-form-error"></div>
                    </div>

                    <div class="contact-form-group">
                        <label for="message" class="sr-only">
                            <?php echo function_exists('pll__') ? pll__('Message') : 'Message'; ?>
                        </label>
                        <textarea id="message" name="message" class="contact-form-textarea" placeholder="<?php echo function_exists('pll__') ? pll__('Message') : 'Message'; ?>" required></textarea>
                        <div class="contact-form-error"></div>
                    </div>

                    <?php wp_nonce_field('contact_nonce', 'contact_nonce_field'); ?>
                    <input type="hidden" name="action" value="process_contact">
                    <input type="hidden" name="lang" value="<?php echo function_exists('pll_current_language') ? pll_current_language() : 'en'; ?>">

                    <button type="submit" class="contact-form-button">
                        <?php echo function_exists('pll__') ? pll__('SUBMIT') : 'SUBMIT'; ?>
                    </button>
                </form>
            </div>

            <div class="contact-info-details-col">
                <?php if (!empty($info_blocks)) : ?>
                    <?php foreach ($info_blocks as $block) : ?>
                        <div class="contact-info-block">
                            <div class="contact-info-block-title"><?php echo esc_html($block['title']); ?></div>
                            <div class="contact-info-block-content">
                                <?php if (!empty($block['has_icon']) && $block['has_icon']) : ?>
                                    <span class="contact-info-block-icon"></span>
                                <?php endif; ?>
                                <div class="contact-info-block-text">
                                    <?php echo wp_kses_post($block['content']); ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <!-- Default info blocks if none are defined -->
                    <div class="contact-info-block">
                        <div class="contact-info-block-title">LUNCH TIME</div>
                        <div class="contact-info-block-content">
                            <span class="contact-info-block-icon"></span>
                            <div class="contact-info-block-text">
                                Monday to Sunday <br>
                                10:30am - 03:00pm
                            </div>
                        </div>
                    </div>
                    <div class="contact-info-block">
                        <div class="contact-info-block-title">DINNER TIME</div>
                        <div class="contact-info-block-content">
                            <span class="contact-info-block-icon"></span>
                            <div class="contact-info-block-text">
                                Monday to Sunday <br>
                                10:30am - 03:00pm
                            </div>
                        </div>
                    </div>
                    <div class="contact-info-block">
                        <div class="contact-info-block-title">BOOK A TABLE</div>
                        <div class="contact-info-block-content">
                            <span class="contact-info-block-icon"></span>
                            <div class="contact-info-block-text">
                                Monday to Sunday <br>
                                10:30am - 03:00pm
                            </div>
                        </div>
                    </div>
                    <div class="contact-info-block">
                        <div class="contact-info-block-title">RESTAURANT CONTACT</div>
                        <div class="contact-info-block-content">
                            <span class="contact-info-block-icon"></span>
                            <div class="contact-info-block-text">
                                Monday to Sunday <br>
                                10:30am - 03:00pm
                            </div>
                        </div>
                    </div>
                    <div class="contact-info-block">
                        <div class="contact-info-block-title">RESTAURANT ADDRESS</div>
                        <div class="contact-info-block-content">
                            <div class="contact-info-block-text">
                                Monday to Sunday <br>
                                10:30am - 03:00pm
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>