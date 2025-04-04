import Lenis from "lenis";

// Инициализация плавного скролла
const initSmoothScroll = () => {
	// Создаем экземпляр Lenis с настройками
	const lenis = new Lenis({
		duration: 1.2, // Продолжительность анимации скролла
		easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)), // функция плавности (ease-out)
		direction: "vertical", // вертикальный скролл
		gestureOrientation: "vertical", // направление жестов
		smooth: true, // включить плавный скролл
		mouseMultiplier: 1, // множитель скорости для мыши
		smoothTouch: true, // отключить на тачскрине
		touchMultiplier: 2, // множитель скорости для тачскрина
		infinite: false, // бесконечный скролл отключен
	});

	// Функция для анимации
	function raf(time) {
		lenis.raf(time);
		requestAnimationFrame(raf);
	}

	// Запускаем анимацию
	requestAnimationFrame(raf);

	// Обработка событий прокрутки страницы
	lenis.on("scroll", ({ scroll, limit, velocity, direction, progress }) => {
		// Выпускаем пользовательское событие для синхронизации с GSAP
		window.dispatchEvent(
			new CustomEvent("lenis-scroll", {
				detail: { scroll, limit, velocity, direction, progress },
			})
		);
	});

	// Предоставляем глобальный доступ к lenis для использования с GSAP
	window.lenis = lenis;

	// Возвращаем экземпляр Lenis для потенциального использования в других файлах
	return lenis;
};

// Инициализируем плавный скролл после загрузки DOM
document.addEventListener("DOMContentLoaded", () => {
	const lenis = initSmoothScroll();

	// Добавляем событие для обновления Lenis при изменении размера окна
	window.addEventListener("resize", () => {
		lenis.resize();
	});
});

// Экспортируем функцию инициализации для возможного использования в других файлах
export default initSmoothScroll;
