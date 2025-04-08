<?php

    /**
     * Booking Form section
     *
     * @package KAPITAN_PUB
     */

    // Fallback values
    $image      = ! empty(get_sub_field('image')) ? get_sub_field('image') : '';
    $left_text  = ! empty(get_sub_field('left_text')) ? get_sub_field('left_text') : '';
    $right_text = ! empty(get_sub_field('right_text')) ? get_sub_field('right_text') : '';
    $title      = ! empty(get_sub_field('title')) ? get_sub_field('title') : '';
    $subtitle   = ! empty(get_sub_field('subtitle')) ? get_sub_field('subtitle') : '';
?>
<section class="booking-section" id="booking-form">
    <div class="booking-container">
        <div class="booking-content">
            <?php if (! empty($title)): ?>
                <h2 class="h2 md:mb-8">
                    <?php echo esc_html($title); ?>
                </h2>
            <?php endif; ?>
            <div class="booking-content-inner">
                <?php if (! empty($subtitle)): ?>
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

                    <button type="submit" class="button submit max-w-none w-auto px-4
                        py-3 md:py-4 hover:bg-main-hover duration-300 ease-in-out">
                        <?php echo function_exists('pll__') ? pll__('form_button_book') : 'BOOK A TABLE'; ?>
                    </button>
                </form>
            </div>
        </div>
        <?php if (! empty($image)): ?>
            <div class="booking-image-wrapper">
                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                <div class="booking-caption">
                    <?php if (! empty($left_text)): ?>
<?php echo esc_html($left_text); ?>
                        <br />
                    <?php endif; ?>
<?php if (! empty($right_text)): ?>
                        <span class="booking-caption-right">
                            <?php echo esc_html($right_text); ?>
                        </span>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>

<script>
    /**
     * Booking Form Handler
     * Handles validation and AJAX submission of the booking form
     */
    document.addEventListener("DOMContentLoaded", function() {
        const form = document.getElementById("booking-form");
        if (!form) return;

        const responseContainer = form.querySelector("#booking-form #response");
        const submitButton = form.querySelector("#booking-form .submit");
        const dateInput = form.querySelector("#date");
        const timeInput = form.querySelector("#time");

        // Define restaurant opening hours
        const openingHours = {
            0: {
                open: "11:00",
                close: "21:00"
            }, // Sunday
            1: {
                open: "11:00",
                close: "21:00"
            }, // Monday
            2: {
                open: "11:00",
                close: "22:00"
            }, // Tuesday
            3: {
                open: "11:00",
                close: "22:00"
            }, // Wednesday
            4: {
                open: "11:00",
                close: "22:00"
            }, // Thursday
            5: {
                open: "11:00",
                close: "23:00"
            }, // Friday
            6: {
                open: "11:00",
                close: "23:00"
            }, // Saturday
        };

        // Set min date attribute to today
        const today = new Date();
        const todayFormatted = today.toISOString().split("T")[0];
        dateInput.setAttribute("min", todayFormatted);

        // Handle date change to update time input options
        dateInput.addEventListener("change", updateTimeOptions);

        // Initialize time options
        updateTimeOptions();

        // Validation messages based on language
        const translations = window.bookingFormTranslations || {};
        const messages = {
            required:                                                                <?php echo function_exists('pll__') ? '"' . pll__("This field is required") . '"' : '"This field is required"' ?>,
            email:                                                       <?php echo function_exists('pll__') ? '"' . pll__("Please enter a valid email address") . '"' : '"Please enter a valid email address"' ?>,
            phone:                                                       <?php echo function_exists('pll__') ? '"' . pll__("Please enter a valid phone number") . '"' : '"Please enter a valid phone number"' ?>,
            date:                                                    <?php echo function_exists('pll__') ? '"' . pll__("Please enter a valid date") . '"' : '"Please enter a valid date"' ?>,
            pastDate:                                                                <?php echo function_exists('pll__') ? '"' . pll__("Please select a future date") . '"' : '"Please select a future date"' ?>,
            time:                                                    <?php echo function_exists('pll__') ? '"' . pll__("Please select a valid time within our opening hours") . '"' : '"Please select a valid time within our opening hours"' ?>,
            server_error:                                                                            <?php echo function_exists('pll__') ? '"' . pll__("Server error. Please try again later.") . '"' : '"Server error. Please try again later."' ?>,
            success:                                                             <?php echo function_exists('pll__') ? '"' . pll__("Thank you! Your booking request has been sent successfully. We will contact you shortly.") . '"' : '"Thank you! Your booking request has been sent successfully. We will contact you shortly."' ?>
        };

        // Form Validation
        const validators = {
            email: (value) => {
                const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return regex.test(value);
            },
            phone: (value) => {
                // Basic phone validation, can be adjusted for specific format
                const regex = /^[+]?[(]?[0-9]{3}[)]?[-\s.]?[0-9]{3}[-\s.]?[0-9]{4,6}$/;
                return regex.test(value);
            },
            date: (value) => {
                const selectedDate = new Date(value);
                const today = new Date();
                today.setHours(0, 0, 0, 0);
                return selectedDate >= today;
            },
            time: (value, dateValue) => {
                if (!dateValue) return false;

                const selectedDate = new Date(dateValue);
                const dayOfWeek = selectedDate.getDay();

                // Get hours for selected day
                const hours = openingHours[dayOfWeek];
                if (!hours) return false;

                // Compare with opening hours
                return isTimeWithinRange(value, hours.open, hours.close);
            },
        };

        // Helper function to check if time is within range
        function isTimeWithinRange(time, openTime, closeTime) {
            // Convert the time strings to Date objects for comparison
            const timeDate = new Date(`1970-01-01T${time}:00`);
            const openDate = new Date(`1970-01-01T${openTime}:00`);
            const closeDate = new Date(`1970-01-01T${closeTime}:00`);

            return timeDate >= openDate && timeDate <= closeDate;
        }

        // Update time input options based on selected date
        function updateTimeOptions() {
            const dateValue = dateInput.value;

            // Clear the time input
            timeInput.value = "";

            if (!dateValue) return;

            const selectedDate = new Date(dateValue);
            const dayOfWeek = selectedDate.getDay();
            const today = new Date();

            // Get hours for selected day
            const hours = openingHours[dayOfWeek];
            if (!hours) return;

            // Set min and max attributes for time input
            let minTime = hours.open;
            const maxTime = hours.close;

            // If today is selected, check current time
            if (selectedDate.toDateString() === today.toDateString()) {
                const currentHour = today.getHours();
                const currentMinute = today.getMinutes();
                const formattedCurrentTime = `${String(currentHour).padStart(2, "0")}:${String(currentMinute).padStart(2, "0")}`;

                // If current time is after opening time, update min time
                if (formattedCurrentTime > hours.open) {
                    minTime = formattedCurrentTime;
                }
            }

            timeInput.setAttribute("min", minTime);
            timeInput.setAttribute("max", maxTime);

            // Create helper text to display available hours
            const hourRangeElement = document.createElement("span");
            hourRangeElement.classList.add("time-range-helper");
            hourRangeElement.textContent = `Available hours: ${formatTimeDisplay(hours.open)} – ${formatTimeDisplay(hours.close)}`;

            // Check if helper text already exists and replace it
            const existingHelper = timeInput.parentNode.querySelector(".time-range-helper");
            if (existingHelper) {
                existingHelper.textContent = hourRangeElement.textContent;
            } else {
                timeInput.insertAdjacentElement("afterend", hourRangeElement);
            }
        }

        // Format time for display (convert 24h to 12h format)
        function formatTimeDisplay(time24h) {
            const [hours, minutes] = time24h.split(":");
            const hour = parseInt(hours, 10);
            const period = hour >= 12 ? "PM" : "AM";
            const hour12 = hour % 12 || 12;
            return `${hour12}:${minutes} ${period}`;
        }

        // Clear all errors
        const clearErrors = () => {
            form.querySelectorAll(".form-group").forEach((group) => {
                group.classList.remove("has-error");
                const errorMessage = group.querySelector(".error-message");
                if (errorMessage) errorMessage.textContent = "";
            });

            responseContainer.classList.add("hidden");
            responseContainer.classList.remove("success", "error");
            responseContainer.textContent = "";
        };

        // Set error for a field
        const setFieldError = (field, message) => {
            const formGroup = field.closest(".form-group");
            formGroup.classList.add("has-error");
            const errorMessage = formGroup.querySelector(".error-message");
            if (errorMessage) errorMessage.textContent = message;
        };

        // Show form response
        const showResponse = (message, isSuccess) => {
            responseContainer.textContent = message;
            responseContainer.classList.remove("hidden");
            responseContainer.classList.add(isSuccess ? "success" : "error");

            if (isSuccess) {
                form.reset();

                // Reset time helper text
                updateTimeOptions();
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
                } else if (field.name === "phone" && !validators.phone(field.value)) {
                    setFieldError(field, messages.phone);
                    isValid = false;
                } else if (field.type === "date") {
                    if (!validators.date(field.value)) {
                        setFieldError(field, messages.pastDate);
                        isValid = false;
                    }
                } else if (field.type === "time") {
                    if (!validators.time(field.value, dateInput.value)) {
                        setFieldError(field, messages.time);
                        isValid = false;
                    }
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
            fetch((window.bookingFormData && window.bookingFormData.ajaxurl) || "/wp-admin/admin-ajax.php", {
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
                    console.error("Booking form error:", error);
                });
        });
    });
</script>