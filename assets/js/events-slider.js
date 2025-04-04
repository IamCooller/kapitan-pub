import Swiper from "swiper";
import { Navigation, Autoplay } from "swiper/modules";

document.addEventListener("DOMContentLoaded", () => {
	// Check if events section exists on the page
	const eventsSection = document.querySelector(".events-section");
	if (!eventsSection) return;

	// Find the swiper container
	let swiperContainer = eventsSection.querySelector(".events-swiper.swiper");

	// Only proceed if the container exists
	if (swiperContainer) {
		const slides = swiperContainer.querySelectorAll('.swiper-slide');
		const slideCount = slides.length;
		const isDesktop = window.innerWidth >= 1024;

		// Initialize Swiper only if conditions are met
		if ((isDesktop && slideCount > 3) || (!isDesktop && slideCount > 2)) {
			// Initialize the Swiper
			const eventsSwiper = new Swiper(swiperContainer, {
				slidesPerView: "auto", // Use "auto" or adjust based on design
				spaceBetween: 20,
				centeredSlides: false, // Consider if still needed without loop sometimes
				loop: true, // Loop might cause issues if slideCount is exactly slidesPerView + 1
				modules: [Navigation, Autoplay],
				autoplay: {
					delay: 2500,
					disableOnInteraction: true,
				},
				speed: 800,
				// Add Navigation module
				navigation: {
					nextEl: ".button-next",
					prevEl: ".button-prev",
				},
				breakpoints: {
					// Mobile view (< 768)
					320: {
						slidesPerView: 2, // Adjusted for potentially fewer slides
						spaceBetween: 15,
						centeredSlides: false, // Often better without centering on mobile
					},
					// Tablet view (>= 768 and < 1024)
					768: {
						slidesPerView: 2,
						spaceBetween: 20,
						centeredSlides: true,
					},
					// Desktop view (>= 1024) - Will only init if > 3 slides
					1024: {
						slidesPerView: 3,
						spaceBetween: 30,
						centeredSlides: true,
					},
				},
			});
		} else {
			// Optional: Add a class to style the container as a grid if needed
			// swiperContainer.classList.add('events-grid-fallback');
			// swiperContainer.classList.remove('swiper'); 
            // // Hide navigation buttons if slider is not initialized
            const navNext = eventsSection.querySelector('.button-next');
            const navPrev = eventsSection.querySelector('.button-prev');
            if (navNext) navNext.style.display = 'none';
            if (navPrev) navPrev.style.display = 'none';
		}
	}
});
