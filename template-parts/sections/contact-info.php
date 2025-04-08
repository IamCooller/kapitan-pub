<?php

    /**
     * Contact Info section
     *
     * @package KAPITAN_PUB
     */

    // Fallback values
    $title         = ! empty(get_sub_field('title')) ? get_sub_field('title') : 'WRITE TO US';
    $contact_intro = ! empty(get_sub_field('contact_intro')) ? get_sub_field('contact_intro') : '';
    $info_blocks   = ! empty(get_sub_field('info_blocks')) ? get_sub_field('info_blocks') : [];
?>
<section class="contact-info-section relative" id="contact-info">
    <div class="lines"></div>
    <div class="contact-info-container">
        <div class="contact-info-grid">
            <div class="contact-info-form-col">
                <div class="h3 mb-2.5"><?php echo esc_html($title); ?></div>
                <div class="contact-info-text">
                    <?php echo wp_kses_post($contact_intro); ?>
                </div>

                <form id="contact-form" class="form" method="post">
                    <div id="response" class="response hidden"></div>
                    <div class="form-group">
                        <label for="name" class="sr-only">
                            <?php echo function_exists('pll__') ? pll__('Name') : 'Name'; ?>
                        </label>
                        <input type="text" id="name" name="name" class="form-input" placeholder="<?php echo function_exists('pll__') ? pll__('Name') : 'Name'; ?>" required />
                        <div class="form-error"></div>
                    </div>

                    <div class="form-group">
                        <label for="email" class="sr-only">
                            <?php echo function_exists('pll__') ? pll__('Email') : 'Email'; ?>
                        </label>
                        <input type="email" id="email" name="email" class="form-input" placeholder="<?php echo function_exists('pll__') ? pll__('Email') : 'Email'; ?>" required />
                        <div class="form-error"></div>
                    </div>

                    <div class="form-group">
                        <label for="message" class="sr-only">
                            <?php echo function_exists('pll__') ? pll__('Message') : 'Message'; ?>
                        </label>
                        <textarea id="message" name="message" class="form-textarea" placeholder="<?php echo function_exists('pll__') ? pll__('Message') : 'Message'; ?>" required></textarea>
                        <div class="form-error"></div>
                    </div>

                    <?php wp_nonce_field('contact_nonce', 'contact_nonce_field'); ?>
                    <input type="hidden" name="action" value="process_contact">
                    <input type="hidden" name="lang" value="<?php echo function_exists('pll_current_language') ? pll_current_language() : 'en'; ?>">

                    <button type="submit" class="button submit">
                        <?php echo function_exists('pll__') ? pll__('SUBMIT') : 'SUBMIT'; ?>
                    </button>
                </form>
            </div>

            <div class="contact-info-details-col">
                <?php if (! empty($info_blocks)): ?>
<?php foreach ($info_blocks as $block): ?>
                        <div class="contact-info-block">
                            <div class="contact-info-block-title"><?php echo esc_html($block['title']); ?></div>
                            <div class="contact-info-block-content">
                                <?php if (! empty($block['has_icon']) && $block['has_icon']): ?>
                                    <span class="contact-info-block-icon"></span>
                                <?php endif; ?>
                                <div class="contact-info-block-text">
                                    <?php echo wp_kses_post($block['content']); ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>


                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<script>
    /**
     * Contact Form Handler
     * Handles validation and AJAX submission of the contact form
     */
    document.addEventListener("DOMContentLoaded", function() {
        const form = document.getElementById("contact-form");
        if (!form) return;

        const responseContainer = form.querySelector("#contact-form #response");
        const submitButton = form.querySelector("#contact-form .submit");

        // Validation messages based on language
        const translations = window.contactFormTranslations || {};
        const messages = {
            required:                                           <?php echo function_exists('pll__') ? '"' . pll__("This field is required") . '"' : '"This field is required"' ?>,
            email:                                     <?php echo function_exists('pll__') ? '"' . pll__("Please enter a valid email address") . '"' : '"Please enter a valid email address"' ?>,
            server_error:                                                   <?php echo function_exists('pll__') ? '"' . pll__("Server error. Please try again later.") . '"' : '"Server error. Please try again later."' ?>,
            success:                                         <?php echo function_exists('pll__') ? '"' . pll__("Thank you! Your message has been sent successfully. We will contact you shortly.") . '"' : '"Thank you! Your message has been sent successfully. We will contact you shortly."' ?>
        };

        // Form Validation
        const validators = {
            email: (value) => {
                const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return regex.test(value);
            }
        };

        // Clear all errors
        const clearErrors = () => {
            form.querySelectorAll(".form-group").forEach((group) => {
                group.classList.remove("has-error");
                const errorElement = group.querySelector(".form-error");
                if (errorElement) errorElement.textContent = "";
            });

            responseContainer.classList.add("hidden");
            responseContainer.classList.remove("success", "error");
            responseContainer.textContent = "";
        };

        // Set error for a field
        const setFieldError = (field, message) => {
            const formGroup = field.closest(".form-group");
            formGroup.classList.add("has-error");
            const errorElement = formGroup.querySelector(".form-error");
            if (errorElement) errorElement.textContent = message;
        };

        // Show form response
        const showResponse = (message, isSuccess) => {
            responseContainer.textContent = message;
            responseContainer.classList.remove("hidden");
            responseContainer.classList.add(isSuccess ? "success" : "error");

            if (isSuccess) {
                form.reset();
            }

            // Scroll to response
            responseContainer.scrollIntoView({
                behavior: "smooth",
                block: "center"
            });
        };

        // Validate form
        const validateForm = () => {
            clearErrors();
            let isValid = true;

            form.querySelectorAll("[required]").forEach((field) => {
                // Required check
                if (!field.value.trim()) {
                    setFieldError(field, messages.required);
                    isValid = false;
                    return;
                }

                // Type-specific validations
                if (field.type === "email" && !validators.email(field.value)) {
                    setFieldError(field, messages.email);
                    isValid = false;
                }
            });

            return isValid;
        };

        // Form submission
        form.addEventListener("submit", function(e) {
            e.preventDefault();

            if (!validateForm()) return;

            // Prepare form data
            const formData = new FormData(form);

            // Show loading state
            submitButton.classList.add("loading");

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
                    submitButton.classList.remove("loading");

                    if (data.success) {
                        showResponse(data.data || messages.success, true);
                    } else {
                        showResponse(data.data || messages.server_error, false);
                    }
                })
                .catch((error) => {
                    submitButton.classList.remove("loading");
                    showResponse(error.message || messages.server_error, false);
                    console.error("Contact form error:", error);
                });
        });
    });
</script>