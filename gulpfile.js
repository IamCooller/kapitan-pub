const gulp = require("gulp");
const sass = require("gulp-sass")(require("sass"));
const postcss = require("gulp-postcss");
const autoprefixer = require("autoprefixer");
const sourcemaps = require("gulp-sourcemaps");
const cleanCSS = require("gulp-clean-css");
const browserSync = require("browser-sync").create();

const paths = {
	styles: {
		src: "./assets/scss/main.scss",
		dest: "./assets/css",
	},
	php: {
		src: "**/*.php",
		exclude: ["node_modules/**/*", "vendor/**/*", "assets/css/**/*"],
	},
	js: {
		src: "./assets/js/**/*.js",
	},
};

// Добавляем логирование изменений файлов
function logFileChange(path) {
	console.log(`File changed: ${path}`);
}

// Используем async/await для лучшей производительности
async function styles() {
	return gulp
		.src(paths.styles.src)
		.pipe(sourcemaps.init())
		.pipe(
			sass({
				outputStyle: "expanded",
				includePaths: ["./assets/scss"],
			}).on("error", sass.logError)
		)
		.pipe(postcss([autoprefixer()]))
		.pipe(
			cleanCSS({
				level: 2,
				compatibility: "ie8",
			})
		)
		.pipe(sourcemaps.write("./"))
		.pipe(gulp.dest(paths.styles.dest))
		.pipe(browserSync.stream());
}

// Используем async/await для watch
async function watch(done) {
	browserSync.init({
		proxy: "http://kapitan-pub.localhost",
		files: [paths.php.src, "assets/css/**/*.css", paths.js.src],
		ignore: paths.php.exclude,
		reloadDelay: 300, // Увеличиваем задержку
		ghostMode: false,
		notify: false,
		open: false,
		snippetOptions: {
			ignorePaths: ["node_modules/**/*", "vendor/**/*", "assets/css/**/*"],
		},
		watchOptions: {
			ignoreInitial: true,
			ignored: ["node_modules/**/*", "vendor/**/*", "assets/css/**/*"],
			usePolling: true, // Используем polling для более надежного отслеживания
			interval: 1000, // Интервал проверки изменений
			debounceDelay: 300, // Задержка между проверками
		},
	});

	// Добавляем логирование для каждого типа файлов
	gulp.watch("./assets/scss/**/*.scss", gulp.series(styles)).on("change", (path) => logFileChange(path));

	gulp.watch(paths.js.src).on("change", (path) => {
		logFileChange(path);
		browserSync.reload();
	});

	gulp.watch(paths.php.src).on("change", (path) => {
		logFileChange(path);
		browserSync.reload();
	});

	done();
}

// Экспортируем задачи
exports.styles = styles;
exports.watch = watch;
exports.default = watch;
