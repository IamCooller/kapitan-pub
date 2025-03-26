// Mobile Menu Functionality
document.addEventListener("DOMContentLoaded", () => {
	const menuOpenBtn = document.querySelector(".header-mobile__menu-open");
	const menuCloseBtn = document.querySelector(".mobile-menu__close");
	const mobileMenu = document.querySelector(".mobile-menu");
	const body = document.body;

	// Open menu
	menuOpenBtn.addEventListener("click", () => {
		mobileMenu.classList.add("header-mobile__menu-open");
		body.style.overflow = "hidden"; // Prevent scrolling when menu is open
	});

	// Close menu
	menuCloseBtn.addEventListener("click", () => {
		mobileMenu.classList.remove("header-mobile__menu-open");
		body.style.overflow = ""; // Restore scrolling
	});

	// Close menu when clicking on menu links
	const menuLinks = document.querySelectorAll(".mobile-menu__nav a");
	menuLinks.forEach((link) => {
		link.addEventListener("click", () => {
			mobileMenu.classList.remove("header-mobile__menu-open");
			body.style.overflow = "";
		});
	});
});
