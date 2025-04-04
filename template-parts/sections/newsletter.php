<?php

/**
 * Newsletter Section
 *
 * @package KAPITAN_PUB
 */

$title = !empty(get_sub_field('title')) ? get_sub_field('title') : '';
$subtitle = !empty(get_sub_field('subtitle')) ? get_sub_field('subtitle') : '';
$bg_image = !empty(get_sub_field('bg_image')) ? get_sub_field('bg_image') : get_template_directory_uri() . '';
$socials = !empty(get_sub_field('socials')) ? get_sub_field('socials') : [];
?>
<section class="newsletter-section"
    style="
    <?php if (!empty($bg_image)) : ?>
        background-image: url(<?php echo esc_url($bg_image['url']); ?>);
    <?php endif; ?>

    ">
    <div class="newsletter-overlay"></div>
    <div class="newsletter-container">
        <?php if (!empty($title)) : ?>
            <div class="newsletter-title"><?php echo esc_html($title); ?></div>
        <?php endif; ?>
        <?php if (!empty($subtitle)) : ?>
            <p class="newsletter-subtitle"><?php echo esc_html($subtitle); ?></p>
        <?php endif; ?>

        <form id="newsletter-form" class="newsletter-form" method="post">

            <div class="newsletter-form-wrapper">
                <label for="email" class="sr-only">Email</label>
                <input type="email" id="email" name="email" placeholder="YOUR EMAIL" class="newsletter-input" required>

                <?php wp_nonce_field('newsletter_nonce', 'newsletter_nonce_field'); ?>
                <input type="hidden" name="action" value="process_newsletter">
                <input type="hidden" name="lang" value="<?php echo function_exists('pll_current_language') ? pll_current_language() : 'en'; ?>">

                <button type="submit" class="newsletter-submit" title="Subscribe">
                    <span class="newsletter-submit-text">SIGN UP</span>
                    <div class="newsletter-loader"
                        style="display: none;">
                        <svg class="animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </div>
                </button>
            </div>
            <div id="response" class="newsletter-response "></div>
        </form>

        <div class="newsletter-socials">
            <?php if (!empty($socials)) : ?>
                <?php
                $count = 0;
                foreach ($socials as $social) :
                ?>
                    <a href="<?php echo esc_url($social['url']); ?>" class="newsletter-social-link" target="_blank">
                        <?php echo esc_html($social['name']); ?>
                    </a>
                    <?php if ($count < count($socials) - 1) : ?>
                        <span class="newsletter-social-separator">
                            <svg width="8" height="13" viewBox="0 0 8 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4.15868 1.06438C4.14178 1.0376 4.11838 1.01553 4.09065 1.00024C4.06292 0.984949 4.03177 0.976929 4.0001 0.976929C3.96844 0.976929 3.93729 0.984949 3.90956 1.00024C3.88183 1.01553 3.85842 1.0376 3.84152 1.06438L0.474728 6.39993C0.45583 6.42988 0.445801 6.46457 0.445801 6.49998C0.445801 6.5354 0.45583 6.57009 0.474728 6.60004L3.84152 11.9356C3.85842 11.9624 3.88183 11.9844 3.90956 11.9997C3.93729 12.015 3.96844 12.023 4.0001 12.023C4.03177 12.023 4.06292 12.015 4.09065 11.9997C4.11838 11.9844 4.14178 11.9624 4.15868 11.9356L7.52548 6.60004C7.54438 6.57009 7.55441 6.5354 7.55441 6.49998C7.55441 6.46457 7.54438 6.42988 7.52548 6.39993L4.15868 1.06438ZM4.0001 11.4842L0.855025 6.49998L4.0001 1.51579L7.14518 6.49998L4.0001 11.4842Z" fill="#BB936D" />
                            </svg>
                        </span>
                <?php endif;
                    $count++;
                endforeach;
                ?>
            <?php endif; ?>
        </div>
    </div>
</section>

<script>
    /**
     * Newsletter Form Handler
     * Handles validation and AJAX submission of the newsletter form
     */
    document.addEventListener("DOMContentLoaded", function() {
        const form = document.getElementById("newsletter-form");
        if (!form) return;

        const responseContainer = form.querySelector("#response");
        const submitButton = form.querySelector(".newsletter-submit");
        const emailInput = form.querySelector("#email");

        // Validation messages based on language
        const translations = window.newsletterFormTranslations || {};
        const messages = {
            required: translations.required || "This field is required",
            email: translations.email || "Please enter a valid email address",
            server_error: translations.server_error || "Server error. Please try again later.",
            success: translations.success || "Thank you! You have successfully subscribed to our newsletter."
        };

        // Form Validation
        const validators = {
            email: (value) => {
                const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return regex.test(value);
            }
        };

        // Clear errors
        const clearErrors = () => {
            responseContainer.classList.add("hidden");
            responseContainer.classList.remove("success", "error");
            responseContainer.textContent = "";
        };

        // Show form response
        const showResponse = (message, isSuccess) => {
            responseContainer.textContent = message;
            responseContainer.classList.remove("hidden");
            responseContainer.classList.add(isSuccess ? "success" : "error");

            if (isSuccess) {
                form.reset();
            }
        };

        // Validate form
        const validateForm = () => {
            clearErrors();
            let isValid = true;

            if (!emailInput.value.trim()) {
                showResponse(messages.required, false);
                isValid = false;
                return isValid;
            }

            if (!validators.email(emailInput.value)) {
                showResponse(messages.email, false);
                isValid = false;
            }

            return isValid;
        };

        // Form submission
        form.addEventListener("submit", function(e) {
            e.preventDefault();

            if (!validateForm()) return;

            // Prepare form data
            const formData = new FormData(form);

            // Show loading state
            document.querySelector(".newsletter-submit-text").style.opacity = "0";
            document.querySelector(".newsletter-submit").style.pointerEvents = "none";
            document.querySelector(".newsletter-loader").style.display = "block";
            // Send AJAX request
            fetch((window.kapitan_pub_data && window.kapitan_pub_data.ajaxurl) || "/wp-admin/admin-ajax.php", {
                    method: "POST",
                    body: formData,
                    credentials: "same-origin",
                })
                .then((response) => {
                    if (!response.ok) {
                        throw new Error(messages.server_error);
                    }
                    return response.json();
                })
                .then((data) => {
                    document.querySelector(".newsletter-submit-text").style.opacity = "1";
                    document.querySelector(".newsletter-submit").style.pointerEvents = "auto";
                    document.querySelector(".newsletter-loader").style.display = "none";
                    if (data.success) {
                        showResponse(data.data || messages.success, true);
                    } else {
                        showResponse(data.data || messages.server_error, false);
                    }
                })
                .catch((error) => {
                    document.querySelector(".newsletter-submit-text").style.opacity = "1";
                    document.querySelector(".newsletter-submit").style.pointerEvents = "auto";
                    document.querySelector(".newsletter-loader").style.display = "none";
                    showResponse(error.message || messages.server_error, false);
                    console.error("Newsletter form error:", error);
                });
        });
    });
</script>