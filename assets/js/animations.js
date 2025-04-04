import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";

// Регистрируем плагины GSAP
gsap.registerPlugin(ScrollTrigger);

// Инициализация анимаций
const initAnimations = () => {
	// Анимация появления шапки при загрузке страницы
	const headerAnimation = () => {
		const headerDesktop = document.querySelector(".header-desktop");
		const headerMobile = document.querySelector(".header-mobile");
		const headerLogo = document.querySelector(".header-desktop__logo");
		const headerMenu = document.querySelector(".header-desktop__menu");
		const headerButtons = document.querySelector(".header-desktop__buttons");

		// Создаем таймлайн для анимации шапки
		const headerTimeline = gsap.timeline({
			defaults: {
				ease: "power3.out",
				duration: 0.8,
			},
		});

		// Сначала скрываем все элементы
		gsap.set([headerDesktop, headerMobile], {
			opacity: 0,
			y: -20,
		});

		gsap.set([headerLogo, headerMenu, headerButtons], {
			opacity: 0,
			y: -15,
		});

		// Анимируем появление шапки
		headerTimeline
			.to([headerDesktop, headerMobile], {
				opacity: 1,
				y: 0,
				duration: 1,
				clearProps: "all",
			})
			.to(
				headerLogo,
				{
					opacity: 1,
					y: 0,
					duration: 0.6,
					clearProps: "all",
				},
				"-=0.5"
			)
			.to(
				headerMenu,
				{
					opacity: 1,
					y: 0,
					duration: 0.6,
					clearProps: "all",
				},
				"-=0.4"
			)
			.to(
				headerButtons,
				{
					opacity: 1,
					y: 0,
					duration: 0.6,
					clearProps: "all",
				},
				"-=0.4"
			);
	};

	// Анимация элементов секции Hero
	const heroAnimation = () => {
		// Создаем таймлайн для анимации героя
		const masterTimeline = gsap.timeline({
			defaults: {
				ease: "power3.out",
			},
			// Запускаем после анимации шапки
			delay: 0.3,
		});

		// Анимация лого героя
		const heroLogo = document.querySelector(".hero__logo");
		if (heroLogo) {
			gsap.set(heroLogo, {
				opacity: 0,
				y: 30,
			});

			masterTimeline.to(heroLogo, {
				opacity: 1,
				y: 0,
				duration: 0.7,
				clearProps: "transform",
			});
		}

		// Анимация кнопок - способ 1: используя stagger параметр
		const heroButtonsContainer = document.querySelector(".hero-stagger-container");
		if (heroButtonsContainer) {
			gsap.set(heroButtonsContainer, {
				opacity: 0,
				yPercent: 100,
			});

			masterTimeline.to(heroButtonsContainer, {
				opacity: 1,
				yPercent: 0,
				duration: 0.7,
				clearProps: "transform",
			});
		}
	};

	// Анимация секции Cuisine & Chefs
	const cuisineChefsAnimation = () => {
		const containers = document.querySelectorAll(".cuisine-chefs-container");
		if (containers.length === 0) return;
		containers.forEach((container) => {
			const imageWrapper = container.querySelector(".cuisine-chefs-image-wrapper");
			const content = container.querySelector(".cuisine-chefs-content");

			// Check if wrappers exist before querying children
			let mainImage, secondaryImage, title, contentInner, subtitle, text, button;
			let isImageLeft = false;

			if (imageWrapper) {
				mainImage = imageWrapper.querySelector(".cuisine-chefs-main-image-wrapper");
				secondaryImage = imageWrapper.querySelector(".cuisine-chefs-secondary-image");
				isImageLeft = imageWrapper.classList.contains("cuisine-chefs-image-wrapper--left");
			}

			if (content) {
				title = content.querySelector("h2");
				contentInner = content.querySelector(".cuisine-chefs-content-inner");
				if (contentInner) {
					subtitle = contentInner.querySelector("h3");
					text = contentInner.querySelector(".cuisine-chefs-text");
					button = contentInner.querySelector(".cuisine-chefs-button-wrapper");
				}
			}

			const tl = gsap.timeline({
				scrollTrigger: {
					trigger: container,
					start: "top 85%", // Start animation when 85% of the container is visible
					toggleActions: "play none none none", // Play animation once on enter
				},
				defaults: {
					duration: 0.8,
					ease: "power3.out",
				},
			});

			// Initial states
			if (imageWrapper) gsap.set(imageWrapper, { opacity: 0 });
			if (content) gsap.set(content, { opacity: 0 });
			const contentElements = [title, subtitle, text, button].filter((el) => el); // Filter out nulls
			if (contentElements.length > 0) gsap.set(contentElements, { opacity: 0, y: 30 });
			if (mainImage) gsap.set(mainImage, { opacity: 0, scale: 0.9 });
			if (secondaryImage) gsap.set(secondaryImage, { opacity: 0, x: isImageLeft ? 30 : -30 });

			// Animation sequence
			if (isImageLeft) {
				if (imageWrapper) tl.fromTo(imageWrapper, { x: -50, opacity: 0 }, { x: 0, opacity: 1 });
				if (mainImage) tl.to(mainImage, { opacity: 1, scale: 1, duration: 0.6 }, "-=0.4");
				if (secondaryImage) tl.to(secondaryImage, { opacity: 1, x: 0, duration: 0.5 }, "-=0.3");
				if (content) tl.fromTo(content, { x: 50, opacity: 0 }, { x: 0, opacity: 1 }, "-=0.6");
			} else {
				if (content) tl.fromTo(content, { x: -50, opacity: 0 }, { x: 0, opacity: 1 });
				if (imageWrapper) tl.fromTo(imageWrapper, { x: 50, opacity: 0 }, { x: 0, opacity: 1 }, "-=0.6");
				if (mainImage) tl.to(mainImage, { opacity: 1, scale: 1, duration: 0.6 }, "-=0.4");
				if (secondaryImage) tl.to(secondaryImage, { opacity: 1, x: 0, duration: 0.5 }, "-=0.3");
			}

			// Staggered content animation
			if (title) tl.to(title, { opacity: 1, y: 0, duration: 0.5 }, "-=0.4");
			if (subtitle) tl.to(subtitle, { opacity: 1, y: 0, duration: 0.5 }, "-=0.4");
			if (text) tl.to(text, { opacity: 1, y: 0, duration: 0.5 }, "-=0.4");
			if (button) tl.to(button, { opacity: 1, y: 0, duration: 0.5 }, "-=0.4");
		});
	};

	// Анимация секции About History
	const aboutHistoryAnimation = () => {
		const section = document.querySelector( '.about-history-section' );
		if ( !section ) return;

		const container = section.querySelector( '.about-history-container' );
		const mainImageWrapper = section.querySelector( '.about-history-main-image-wrapper' );
		const content = section.querySelector( '.about-history-content' );
		const info = section.querySelector( '.about-history-info' );
		const details = section.querySelector( '.about-history-details' );
		const secondaryImageWrapper = section.querySelector( '.about-history-secondary-image-wrapper' );
		const meta = section.querySelector( '.about-history-meta' );

		// Elements within info & meta
		const title = info?.querySelector( '.h3' );
		const description = info?.querySelector( '.about-history-description' );
		const hours = meta?.querySelector( '.about-history-hours' );
		const tagline = meta?.querySelector( '.about-history-tagline' );

		if ( !container || !mainImageWrapper || !content ) return;

		const tl = gsap.timeline( {
			scrollTrigger: {
				trigger: container,
				start: 'top 80%', // Start animation when 80% of the container is visible
				toggleActions: 'play none none none', // Play animation once on enter
			},
			defaults: {
				duration: 0.9,
				ease: 'power3.out',
				clearProps: 'all',
			},
		} );

		// Initial states
		gsap.set( container, { opacity: 0 } );
		gsap.set( mainImageWrapper, { opacity: 0, x: -50 } );
		gsap.set( content, { opacity: 0, x: 50 } );
		gsap.set( [ title, description, secondaryImageWrapper, hours, tagline ], { opacity: 0, y: 20 } );

		// Animation sequence
		tl.to( container, { opacity: 1, duration: 0.5 } )
		 .to( mainImageWrapper, { opacity: 1, x: 0 }, '-=0.2' )
		 .to( content, { opacity: 1, x: 0 }, '< ' ); // Start at the same time as main image

		// Stagger content elements
		if ( title ) tl.to( title, { opacity: 1, y: 0, duration: 0.5 }, '-=0.4' );
		if ( description ) tl.to( description, { opacity: 1, y: 0, duration: 0.5 }, '-=0.4' );
		if ( secondaryImageWrapper ) tl.to( secondaryImageWrapper, { opacity: 1, y: 0, duration: 0.5 }, '-=0.4' );
		if ( hours ) tl.to( hours, { opacity: 1, y: 0, duration: 0.5 }, '-=0.4' );
		if ( tagline ) tl.to( tagline, { opacity: 1, y: 0, duration: 0.5 }, '-=0.4' );
	};

	// Анимация Footer
	const footerAnimation = () => {
		const footerElement = document.querySelector( 'footer' );
		if ( !footerElement ) return;

		// Внутренние блоки футера для анимации
		const footerTop = footerElement.querySelector( '.footer-top' );
		const footerMiddle = footerElement.querySelector( '.footer-middle' );
		const footerBottom = footerElement.querySelector( '.footer-bottom' );
		const infoBlocks = footerElement.querySelectorAll( '.footer-info-block, .footer-parking-block, .footer-hours-block' );
		const qrSection = footerElement.querySelector( '.footer-qr-section' );
		const brand = footerElement.querySelector( '.footer-brand' );
		const menu = footerElement.querySelector( '.footer-menu' ); // Может понадобиться уточнить селектор
		const contactInfo = footerElement.querySelector( '.footer-contact-info' );
		const social = footerElement.querySelector( '.footer-social' );
		const copyright = footerElement.querySelector( '.footer-copyright' );

		const tl = gsap.timeline( {
			scrollTrigger: {
				trigger: footerElement,
				start: 'top 90%', // Начать чуть раньше
				toggleActions: 'play reverse play reverse', // Проигрывать при входе/выходе
				// markers: true, // Раскомментируйте для отладки
			},
			defaults: {
				duration: 0.6,
				ease: 'power3.out',
			},
		} );

		// 1. Появление основного контейнера (чуть медленнее)
		tl.fromTo( footerElement, 
			{ opacity: 0.5, y: 60 }, 
			{ opacity: 1, y: 0, duration: 0.8 }
		);

		// 2. Появление информационных блоков сверху с небольшим разбросом
		if ( infoBlocks.length > 0 ) {
			tl.fromTo( infoBlocks, 
				{ opacity: 0, y: 30 }, 
				{ opacity: 1, y: 0, stagger: 0.1, duration: 0.5 }, 
				'-=0.5' // Начать чуть раньше, чем закончится анимация контейнера
			);
		}

		// 3. Появление QR кодов (если есть)
		if ( qrSection ) {
			tl.fromTo( qrSection, 
				{ opacity: 0, scale: 0.9 }, 
				{ opacity: 1, scale: 1, duration: 0.5 }, 
				'<0.1' // Начать почти одновременно с инфо-блоками
			);
		}

		// 4. Появление среднего блока (бренд, меню, контакты)
		const middleElements = [ brand, menu, contactInfo ].filter( el => el );
		if ( middleElements.length > 0 ) {
			tl.fromTo( middleElements, 
				{ opacity: 0, y: 30 }, 
				{ opacity: 1, y: 0, stagger: 0.15, duration: 0.5 }, 
				'-=0.3' 
			);
		}

		// 5. Появление нижнего блока (копирайт, соцсети)
		const bottomElements = [ copyright, social ].filter( el => el );
		if ( bottomElements.length > 0 ) {
			tl.fromTo( bottomElements, 
				{ opacity: 0 }, 
				{ opacity: 1, duration: 0.4 }, 
				'-=0.2'
			);
		}
	};

	// Интеграция с Lenis для плавного скролла
	const integrateWithLenis = () => {
		// Проверяем, доступен ли экземпляр Lenis
		if (window.lenis) {
			// Интегрируем Lenis с GSAP ScrollTrigger
			ScrollTrigger.defaults({
				scroller: document.documentElement,
			});

			// Обновляем ScrollTrigger при скролле Lenis
			window.addEventListener("lenis-scroll", () => {
				ScrollTrigger.update();
			});
		}
	};

	// Запускаем анимации
	headerAnimation();
	heroAnimation(); // Добавляем анимацию героя
	cuisineChefsAnimation(); // Add Cuisine & Chefs animation
	aboutHistoryAnimation(); // Add About History animation
	footerAnimation(); // Add Footer animation
	integrateWithLenis();

	// Функция для обновления ScrollTrigger при изменении размеров окна
	window.addEventListener("resize", () => {
		ScrollTrigger.refresh();
	});
};

// Инициализируем анимации после загрузки DOM
document.addEventListener("DOMContentLoaded", initAnimations);

// Экспортируем функцию инициализации для возможного использования в других файлах
export default initAnimations;
