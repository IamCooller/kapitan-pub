<?php

// Exit if accessed directly
if (! defined('ABSPATH'))
    exit;

/*
 * VITE & Tailwind JIT development
 * Inspired by https://github.com/andrefelipe/vite-php-setup
 *
 */

// dist subfolder - defined in vite.config.json
define('DIST_DEF', 'dist');

// defining some base urls and paths
define('DIST_URI', get_template_directory_uri() . '/' . DIST_DEF);
define('DIST_PATH', get_template_directory() . '/' . DIST_DEF);

// js enqueue settings
define('JS_DEPENDENCY', array('jquery')); // array('jquery') as example
define('JS_LOAD_IN_FOOTER', true); // load scripts in footer?

// deafult server address, port and entry point can be customized in vite.config.json
define('VITE_SERVER', 'http://localhost:3002');
define('VITE_ENTRY_POINT', '/main.js');

if (!defined('IS_VITE_DEVELOPMENT')) {
    define('IS_VITE_DEVELOPMENT', false);
}

/**
 * Enqueue Vite assets
 */
function vite_enqueue_assets()
{
    if (defined('IS_VITE_DEVELOPMENT') && IS_VITE_DEVELOPMENT === true) {
        // Make sure jQuery is loaded in development mode
        wp_enqueue_script('jquery');

        function vite_head_module_hook()
        {
            echo '<script type="module" crossorigin src="' . VITE_SERVER . VITE_ENTRY_POINT . '"></script>';
        }
        add_action('wp_head', 'vite_head_module_hook');
    } else {
        // Production mode
        $manifest = json_decode(file_get_contents(DIST_PATH . '/.vite/manifest.json'), true);

        if (is_array($manifest)) {
            // Process all entries in manifest
            foreach ($manifest as $entry) {
                // Enqueue CSS files
                if (isset($entry['css'])) {
                    foreach ($entry['css'] as $css_file) {
                        wp_enqueue_style('vite-' . $entry['name'], DIST_URI . '/' . $css_file);
                    }
                }

                // Enqueue JS files
                if (isset($entry['file'])) {
                    wp_enqueue_script('vite-' . $entry['name'], DIST_URI . '/' . $entry['file'], JS_DEPENDENCY, null, JS_LOAD_IN_FOOTER);
                }
            }
        } else {
            echo 'no manifest';
        }
    }
}
add_action('wp_enqueue_scripts', 'vite_enqueue_assets');
