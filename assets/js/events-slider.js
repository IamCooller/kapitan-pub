/**
 * Events Slider Initialization
 *
 * Uses Swiper JS to create a responsive slider for events section
 */

document.addEventListener("DOMContentLoaded", () => {
	// Check if events section exists on the page
	const eventsSection = document.querySelector(".events-section");
	if (!eventsSection) return;

	// Initialize Swiper only if events grid exists
	const eventsGrid = document.querySelector(".events-grid");
	if (!eventsGrid) return;

	// Convert grid to swiper container
	eventsGrid.classList.add("swiper");

	// Create swiper wrapper
	const swiperWrapper = document.createElement("div");
	swiperWrapper.className = "swiper-wrapper";

	// Get all event items and move them into the swiper wrapper
	const eventItems = Array.from(eventsGrid.querySelectorAll(".event-item"));
	eventItems.forEach((item) => {
		item.classList.add("swiper-slide");
		swiperWrapper.appendChild(item);
	});

	// Add wrapper to container
	eventsGrid.appendChild(swiperWrapper);

	// Initialize the Swiper
	const eventsSwiper = new Swiper(".events-grid", {
		slidesPerView: "auto",
		spaceBetween: 20,
		centeredSlides: false,
		loop: true,
		autoplay: {
			delay: 3000,
			disableOnInteraction: true,
		},
		speed: 800,
		breakpoints: {
			// Mobile view
			320: {
				slidesPerView: 1.5,
				spaceBetween: 15,
			},
			// Tablet view
			768: {
				slidesPerView: 2,
				spaceBetween: 20,
			},
			// Desktop view
			1024: {
				slidesPerView: 3,
				spaceBetween: 30,
			},
		},
	});
});
