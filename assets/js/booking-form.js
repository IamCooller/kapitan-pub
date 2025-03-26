/**
 * Booking Form Handler
 * Handles validation and AJAX submission of the booking form
 */
document.addEventListener("DOMContentLoaded", function () {
	const form = document.getElementById("booking-form");
	if (!form) return;

	const responseContainer = document.getElementById("booking-response");
	const submitButton = form.querySelector(".booking-submit");
	const dateInput = form.querySelector("#date");
	const timeInput = form.querySelector("#time");

	// Define restaurant opening hours
	const openingHours = {
		0: { open: "11:00", close: "21:00" }, // Sunday
		1: { open: "11:00", close: "21:00" }, // Monday
		2: { open: "11:00", close: "22:00" }, // Tuesday
		3: { open: "11:00", close: "22:00" }, // Wednesday
		4: { open: "11:00", close: "22:00" }, // Thursday
		5: { open: "11:00", close: "23:00" }, // Friday
		6: { open: "11:00", close: "23:00" }, // Saturday
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
		required: translations.required || "This field is required",
		email: translations.email || "Please enter a valid email address",
		phone: translations.phone || "Please enter a valid phone number",
		date: translations.date || "Please enter a valid date",
		pastDate: translations.pastDate || "Please select a future date",
		time: translations.time || "Please select a valid time within our opening hours",
		server_error: translations.server_error || "Server error. Please try again later.",
		success: translations.success || "Thank you! Your booking request has been sent successfully. We will contact you shortly.",
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
		responseContainer.scrollIntoView({ behavior: "smooth", block: "center" });
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
	form.addEventListener("submit", function (e) {
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
