import Swiper from "swiper";

import "swiper/css";
import "swiper/css/navigation";
import "swiper/css/pagination";

document.addEventListener("DOMContentLoaded", () => {
	// Initialize testimonials slider (THEY SAY section)
	// Single slide with custom pagination and autoplay
	if (document.querySelector(".testimonials-slider")) {
		const testimonialSlider = new Swiper(".testimonials-slider", {
			slidesPerView: 1,
			spaceBetween: 30,
			loop: true,
			autoplay: {
				delay: 5000,
				disableOnInteraction: false,
			},
			pagination: {
				el: ".testimonials-pagination",
				clickable: true,
			},
			navigation: false,
		});
	}

	// Initialize Instagram gallery slider (CONNECT WITH US section)
	// 5 slides on desktop, 1 on mobile with center slide bigger
	if (document.querySelector(".instagram-slider")) {
		const instagramSlider = new Swiper(".instagram-slider", {
			slidesPerView: 5,
			spaceBetween: 20,
			loop: false,
			centeredSlides: true,
			allowTouchMove: window.innerWidth < 1024,

			breakpoints: {
				// when window width is >= 320px
				320: {
					slidesPerView: 1,
					spaceBetween: 10,
					centeredSlides: true,
					allowTouchMove: true,
				},
				// when window width is >= 480px
				480: {
					slidesPerView: 2,
					spaceBetween: 20,
					allowTouchMove: true,
				},
				// when window width is >= 768px
				768: {
					slidesPerView: 3,
					spaceBetween: 30,
					allowTouchMove: true,
					autoplay: {
						delay: 3000,
						disableOnInteraction: false,
					},
				},
				// when window width is >= 1024px
				1024: {
					slidesPerView: 5,
					spaceBetween: 20,
					centeredSlides: false,
					allowTouchMove: false,
					loop: false,
					autoplay: false,
				},
			},
			on: {
				init: function () {
					// Add class to center slide on mobile to make it bigger
					if (window.innerWidth < 768) {
						this.slides.forEach((slide, index) => {
							if (index === this.activeIndex) {
								slide.classList.add("instagram-slider__slide--active");
							} else {
								slide.classList.remove("instagram-slider__slide--active");
							}
						});
					}
				},
				slideChange: function () {
					// Update center slide class when slide changes
					if (window.innerWidth < 768) {
						this.slides.forEach((slide, index) => {
							if (index === this.activeIndex) {
								slide.classList.add("instagram-slider__slide--active");
							} else {
								slide.classList.remove("instagram-slider__slide--active");
							}
						});
					}
				},
			},
		});
	}
});
