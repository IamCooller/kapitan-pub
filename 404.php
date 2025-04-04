<?php

/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package KAPITAN_PUB
 */

get_header();
?>

<main id="primary" class="site-main">
	<section class="error-404 not-found h-screen flex items-center justify-center">
		<div class="error-404-content">
			<h1 class="error-404-title">404</h1>
			<h2 class="error-404-subtitle"><?php esc_html_e('Oops! Page Not Found', 'kapitan-pub'); ?></h2>
			<p class="error-404-text"><?php esc_html_e('The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.', 'kapitan-pub'); ?></p>



			<div class="error-404-actions">
				<a href="<?php echo esc_url(home_url('/')); ?>" class="button">
					<?php esc_html_e('Back to Home', 'kapitan-pub'); ?>
				</a>
				<a href="<?php echo esc_url(home_url('/contact-us/')); ?>" class="button">
					<?php esc_html_e('Contact Us', 'kapitan-pub'); ?>
				</a>
			</div>


		</div>
	</section>
</main>

<?php
get_footer();
