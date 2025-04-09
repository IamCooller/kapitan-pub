<?php
    $title = get_sub_field('title');

?>
<section class="py-[50px] lg:py-[100px] relative" id="booking-form-block">
    <div class="lines"></div>
    <div class="container">
        <div class=" h3 mb-8 sm:mb-16 uppercase text-center"><?php echo $title; ?></div>

        <form id="booking-form-second" class="form" method="post">
            <div id="response" class="response hidden"></div>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
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
            </div>

            <?php wp_nonce_field('booking_nonce', 'booking_nonce_field'); ?>
            <input type="hidden" name="action" value="process_booking">
            <input type="hidden" name="lang" value="<?php echo function_exists('pll_current_language') ? pll_current_language() : 'en'; ?>">

            <button type="submit" class="button submit border-y-0 mx-auto mt-8 sm:mt-16">
                <?php echo function_exists('pll__') ? pll__('BOOK NOW') : 'BOOK NOW'; ?>
            </button>
        </form>
    </div>
</section>


<script>
    /**
     * Booking Form Handler
     * Handles validation and AJAX submission of the booking form
     */
    document.addEventListener("DOMContentLoaded", function() {
        const form = document.getElementById("booking-form-second");
        if (!form) return;

        const responseContainer = form.querySelector("#response");
        const submitButton = form.querySelector(".submit");
        const dateInput = form.querySelector("#date");
        const timeInput = form.querySelector("#time");

        // Define restaurant opening hours
        const openingHours = {
            0: {
                open: "08:00",
                close: "16:00"
            }, // Sunday
            1: {
                open: "08:00",
                close: "16:00"
            }, // Monday
            2: {
                open: "08:00",
                close: "16:00"
            }, // Tuesday
            3: {
                open: "08:00",
                close: "16:00"
            }, // Wednesday
            4: {
                open: "08:00",
                close: "16:00"
            }, // Thursday
            5: {
                open: "08:00",
                close: "16:00"
            }, // Friday
            6: {
                open: "08:00",
                close: "16:00"
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

        // Установить текущую дату и время по умолчанию
        function setDefaultDateAndTime() {
            const now = new Date();

            // Форматируем дату в формате YYYY-MM-DD для поля date
            const today = now.toISOString().split('T')[0];
            dateInput.value = today;

            // Определяем ближайшее доступное время (округляем до следующего часа)
            let hours = now.getHours();
            let minutes = now.getMinutes();

            // Если текущее время близко к концу часа, переходим к следующему
            if (minutes >= 30) {
                hours++;
            }

            // Если время за пределами рабочего дня, используем время открытия
            const dayOfWeek = now.getDay();
            const openingHour = parseInt(openingHours[dayOfWeek].open.split(':')[0]);
            const closingHour = parseInt(openingHours[dayOfWeek].close.split(':')[0]);

            if (hours < openingHour) {
                hours = openingHour;
            } else if (hours >= closingHour) {
                // Если уже закрыто, устанавливаем на завтра время открытия
                const tomorrow = new Date();
                tomorrow.setDate(tomorrow.getDate() + 1);
                dateInput.value = tomorrow.toISOString().split('T')[0];
                hours = openingHour;
            }

            // Форматируем время в формате HH:00 для поля time
            const formattedTime = `${String(hours).padStart(2, '0')}:00`;
            timeInput.value = formattedTime;

            // Обновить опции времени после установки даты
            updateTimeOptions();
        }

        // Вызываем функцию установки значений по умолчанию
        setDefaultDateAndTime();

        // Validation messages based on language
        const translations = window.bookingFormSecondTranslations || {
            required: "This field is required",
            email: "Please enter a valid email address",
            phone: "Please enter a valid phone number",
            date: "Please enter a valid date",
            pastDate: "Please select a future date",
            time: "Please select a valid time within our opening hours",
            server_error: "Server error. Please try again later.",
            success: "Thank you! Your booking request has been sent successfully. We will contact you shortly.",
            available_hours: "Available hours:"
        };

        // Log translations for debugging
        console.log("BookingFormSecond translations:", translations);

        // Form Validation
        const validators = {
            email: (value) => {
                const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return regex.test(value);
            },
            phone: (value) => {
                // Basic phone validation, can be adjusted for specific format
                const regex = /^[+]?[0-9\s()-]{10,20}$/;
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

            const availableHoursText = translations.available_hours || "Available hours:";
            hourRangeElement.textContent = `${availableHoursText} ${formatTimeDisplay(hours.open)} – ${formatTimeDisplay(hours.close)}`;

            // Check if helper text already exists and replace it
            const existingHelper = timeInput.parentNode.querySelector(".time-range-helper");
            if (existingHelper) {
                existingHelper.textContent = hourRangeElement.textContent;
            } else {
                timeInput.insertAdjacentElement("afterend", hourRangeElement);
            }
        }

        // Helper function to check if time is within range
        function isTimeWithinRange(time, openTime, closeTime) {
            // Convert the time strings to Date objects for comparison
            const timeDate = new Date(`1970-01-01T${time}:00`);
            const openDate = new Date(`1970-01-01T${openTime}:00`);
            const closeDate = new Date(`1970-01-01T${closeTime}:00`);

            return timeDate >= openDate && timeDate <= closeDate;
        }

        // Format time for display (in 24h format)
        function formatTimeDisplay(time24h) {
            return time24h;
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
                    setFieldError(field, translations.required);
                    isValid = false;
                    return;
                }

                // Type-specific validations
                if (field.type === "email" && !validators.email(field.value)) {
                    setFieldError(field, translations.email);
                    isValid = false;
                } else if (field.name === "phone" && !validators.phone(field.value)) {
                    setFieldError(field, translations.phone);
                    isValid = false;
                } else if (field.type === "date") {
                    if (!validators.date(field.value)) {
                        setFieldError(field, translations.pastDate);
                        isValid = false;
                    }
                } else if (field.type === "time") {
                    if (!validators.time(field.value, dateInput.value)) {
                        setFieldError(field, translations.time);
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

            // Prepare form data (используем объект формы вместо this)
            const formData = new FormData(form);

            // Show loading state
            submitButton.classList.add("loading");

            // Send AJAX request
            fetch("/wp-admin/admin-ajax.php", {
                    method: "POST",
                    body: formData,
                    credentials: "same-origin",
                })
                .then((response) => {
                    if (!response.ok) {
                        throw new Error(translations.server_error);
                    }
                    return response.json();
                })
                .then((data) => {
                    submitButton.classList.remove("loading");

                    if (data.success) {
                        showResponse(data.data || translations.success, true);
                    } else {
                        showResponse(data.data || translations.server_error, false);
                    }
                })
                .catch((error) => {
                    submitButton.classList.remove("loading");
                    showResponse(error.message || translations.server_error, false);
                    console.error("Booking form error:", error);
                });
        });
    });
</script>