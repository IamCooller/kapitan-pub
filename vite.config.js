// View your website at your own local server
// for example http://vite-php-setup.test

// http://localhost:3000 is serving Vite on development
// but accessing it directly will be empty

// IMPORTANT image urls in CSS works fine
// BUT you need to create a symlink on dev server to map this folder during dev:
// ln -s {path_to_vite}/src/assets {path_to_public_html}/assets
// on production everything will work just fine

//import vue from '@vitejs/plugin-vue'

import { defineConfig } from "vite";
import tailwindcss from "@tailwindcss/vite";
import VitePluginBrowserSync from "vite-plugin-browser-sync";
import { resolve } from "path";
//import liveReload from "vite-plugin-live-reload";

const paths = {
	styles: {
		src: "./assets/css/**/*.css",
		dest: "./assets/dist",
	},
	php: {
		src: "**/*.php",
		exclude: ["node_modules/**/*", "vendor/**/*", "assets/css/**/*"],
	},
	js: {
		src: "./assets/js/**/*.js",
		dest: "./assets/dist",
	},
};

export default defineConfig({
	plugins: [
		tailwindcss(),
		//liveReload([__dirname + "/**/*.php", __dirname + "/**/*.js", __dirname + "/**/*.css"]),
		VitePluginBrowserSync({
			dev: {
				bs: {
					proxy: "http://kapitan-pub.localhost",
					files: [paths.php.src, paths.styles.src, paths.js.src],
					ignore: paths.php.exclude,
					reloadDelay: 300,
					ghostMode: false,
					notify: false,
					open: true,
					snippetOptions: {
						ignorePaths: ["node_modules/**/*", "vendor/**/*", "assets/css/**/*"],
					},
					watchOptions: {
						ignoreInitial: true,
						ignored: ["node_modules/**/*", "vendor/**/*", "assets/css/**/*"],
						usePolling: true,
						interval: 1000,
						debounceDelay: 300,
					},
				},
			},
		}),
	],
	// config
	root: "",
	base: process.env.NODE_ENV === "development" ? "/" : "/dist/",
	build: {
		// output dir for production build
		outDir: resolve(__dirname, "./dist"),
		emptyOutDir: true,

		// emit manifest so PHP can find the hashed files
		manifest: true,

		// esbuild target
		target: "es2018",

		// our entry
		rollupOptions: {
			input: {
				main: resolve(__dirname + "/main.js"),
				home: resolve(__dirname + "/assets/js/home.js"),
				booking: resolve(__dirname + "/assets/js/booking-form.js"),
			},

			/*
      output: {
          entryFileNames: `[name].js`,
          chunkFileNames: `[name].js`,
          assetFileNames: `[name].[ext]`
      }*/
		},

		// minifying switch
		minify: true,
		write: true,
	},
	server: {
		// required to load scripts from custom host
		cors: true,

		// we need a strict port to match on PHP side
		strictPort: true,
		port: 3002,

		// serve over http
		https: false,

		host: true,
		hmr: {
			host: "localhost",
			overlay: true,
		},
	},
});
