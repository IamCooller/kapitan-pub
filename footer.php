<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package KAPITAN_PUB
 */

// Get ACF footer options if they exist
$address = get_field('address', 'option');
$phone = get_field('phone_number', 'option');
$email = get_field('email', 'option');
$parking_text = get_field('parking_text', 'option');
$open_hours = get_field('open_hours', 'option');
$qr_codes = get_field('qr_codes', 'option');
$footer_text = get_field('footer_text', 'option');
$copyright_text = get_field('copyright_text', 'option');
$reservation_email = get_field('reservation_email', 'option');
$social_links = get_field('social_links', 'option');

// Translations
$address_label = function_exists('pll__') ? pll__('Address') : 'Address';
$contact_label = function_exists('pll__') ? pll__('Contact') : 'Contact';
$parking_label = function_exists('pll__') ? pll__('Parking') : 'Parking';
$open_hours_label = function_exists('pll__') ? pll__('Open hours') : 'Open hours';
$contact_info_label = function_exists('pll__') ? pll__('Kontaktné údaje') : 'Kontaktné údaje';
$reservation_label = function_exists('pll__') ? pll__('Rezervácia') : 'Rezervácia';
?>

<footer>
	<div class="footer-container">
		<div class="footer-top">
			<div class="footer-main-grid">
				<div class="footer-info-grid">
					<?php if (!empty($address)) : ?>
						<div class="footer-info-block">
							<div class="footer-info-block__icon-wrapper">
								<img src="<?php echo get_template_directory_uri(); ?>/assets/img/address-icon.png" alt="address" class="footer-address-icon" />
							</div>
							<div class="footer-info-block__content">
								<div class="footer-info-block__title"><?php echo esc_html($address_label); ?></div>
								<div class="footer-info-block__text">
									<?php echo wp_kses_post($address); ?>
								</div>
							</div>
						</div>
					<?php endif; ?>

					<?php if (!empty($phone) || !empty($email)) : ?>
						<div class="footer-info-block">
							<div class="footer-info-block__icon-wrapper">
								<img src="<?php echo get_template_directory_uri(); ?>/assets/img/Contact-icon.png" alt="contact" class="footer-contact-icon" />
							</div>
							<div class="footer-info-block__content">
								<div class="footer-info-block__title"><?php echo esc_html($contact_label); ?></div>
								<div class="footer-info-block__text">
									<?php if (!empty($phone)) : ?>
										<a href="tel:<?php echo esc_attr($phone); ?>" class="footer-phone-link"><?php echo esc_html($phone); ?></a>
									<?php endif; ?>
									<?php if (!empty($email)) : ?>
										<a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a>
									<?php endif; ?>
								</div>
							</div>
						</div>
					<?php endif; ?>

					<?php if (!empty($parking_text)) : ?>
						<div class="footer-parking-block">
							<div class="footer-info-block__icon-wrapper">
								<img src="<?php echo get_template_directory_uri(); ?>/assets/img/Parking-icon.svg" alt="parking" class="footer-parking-icon" />
							</div>
							<div class="footer-info-block__content">
								<div class="footer-info-block__title"><?php echo esc_html($parking_label); ?></div>
								<div class="footer-info-block__text">
									<p><?php echo esc_html($parking_text); ?></p>
								</div>
							</div>
						</div>
					<?php endif; ?>
				</div>

				<?php if (!empty($open_hours)) : ?>
					<div class="footer-hours-block">
						<div class="footer-info-block__icon-wrapper">
							<img src="<?php echo get_template_directory_uri(); ?>/assets/img/hours-icon.png" alt="hours" class="footer-hours-icon" />
						</div>
						<div class="footer-info-block__content">
							<div class="footer-info-block__title"><?php echo esc_html($open_hours_label); ?></div>
							<div class="footer-info-block__text">
								<?php echo wp_kses_post($open_hours); ?>
							</div>
						</div>
					</div>
				<?php endif; ?>
			</div>

			<?php if (!empty($qr_codes) && is_array($qr_codes)) : ?>
				<div class="footer-qr-section">
					<?php foreach ($qr_codes as $qr_code) :
						$qr_image = !empty($qr_code['qr_image']) ? $qr_code['qr_image'] : '';
						$qr_title = !empty($qr_code['qr_title']) ? $qr_code['qr_title'] : '';

						if (!empty($qr_image) && !empty($qr_title)) :
					?>
							<div>
								<div class="footer-qr-title"><?php echo esc_html($qr_title); ?></div>
								<?php if (is_array($qr_image) && !empty($qr_image['url'])) : ?>
									<img src="<?php echo esc_url($qr_image['url']); ?>" alt="<?php echo esc_attr($qr_title); ?>" class="footer-qr-image" />
								<?php else : ?>
									<img src="<?php echo esc_url($qr_image); ?>" alt="<?php echo esc_attr($qr_title); ?>" class="footer-qr-image" />
								<?php endif; ?>
							</div>
					<?php
						endif;
					endforeach;
					?>
				</div>
			<?php endif; ?>
		</div>

		<div class="footer-middle">
			<div class="footer-brand">
				<div class="footer-logo-wrapper">
					<?php
					if (has_custom_logo()) {
						the_custom_logo();
					} else {
						echo '<a href="' . esc_url(home_url('/')) . '" aria-label="' . esc_attr(get_bloginfo('name')) . '">' . get_bloginfo('name') . '</a>';
					}
					?>
				</div>
				<?php if (!empty($footer_text)) : ?>
					<p class="footer-text"><?php echo esc_html($footer_text); ?></p>
				<?php endif; ?>
			</div>
			<div>
				<?php
				wp_nav_menu([
					'theme_location' => 'footer-menu',
					'container'      => false,
					'menu_class'     => 'footer-menu',
					'menu_id'        => 'footer-menu',
					'echo'           => true,
					'fallback_cb'    => false,
					'items_wrap'     => '<nav id="%1$s" class="%2$s" role="navigation" aria-label="' . esc_attr__('Footer menu', 'kapitan-pub') . '">%3$s</nav>',
					'walker'         => new Custom_Walker_Nav_Menu(),
				]);
				?>
			</div>
			<div class="footer-contact-info">
				<?php if (!empty($phone) || !empty($email)) : ?>
					<div>
						<div class="footer-contact-heading"><?php echo esc_html($contact_info_label); ?></div>
						<?php if (!empty($phone)) : ?>
							<a href="tel:<?php echo esc_attr($phone); ?>" class="footer-contact-phone"><?php echo esc_html($phone); ?></a>
						<?php endif; ?>
						<?php if (!empty($email)) : ?>
							<a href="mailto:<?php echo esc_attr($email); ?>" class="footer-contact-email"><?php echo esc_html($email); ?></a>
						<?php endif; ?>
					</div>
				<?php endif; ?>

				<?php if (!empty($reservation_email)) : ?>
					<div>
						<div class="footer-reservation-heading"><?php echo esc_html($reservation_label); ?></div>
						<a href="mailto:<?php echo esc_attr($reservation_email); ?>" class="footer-reservation-email"><?php echo esc_html($reservation_email); ?></a>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<div class="footer-bottom">
		<?php if (!empty($copyright_text)) : ?>
			<p class="footer-copyright"><?php echo esc_html($copyright_text); ?></p>
		<?php endif; ?>

		<?php if (!empty($social_links) && is_array($social_links)) : ?>
			<div class="footer-social">
				<?php foreach ($social_links as $social) :
					$social_url = !empty($social['url']) ? $social['url'] : '';
					$social_icon = !empty($social['icon']) ? $social['icon'] : '';
					$social_name = !empty($social['name']) ? $social['name'] : '';

					if (!empty($social_url) && !empty($social_icon)) :
						// Определяем класс иконки на основе имени соцсети
						$icon_class = 'footer-social-icon-default';
						if (strtolower($social_name) === 'facebook') {
							$icon_class = 'footer-social-icon-facebook';
						} elseif (strtolower($social_name) === 'youtube') {
							$icon_class = 'footer-social-icon-youtube';
						} elseif (strtolower($social_name) === 'instagram') {
							$icon_class = 'footer-social-icon-instagram';
						}
				?>
						<a href="<?php echo esc_url($social_url); ?>">
							<?php if (is_array($social_icon) && !empty($social_icon['url'])) : ?>
								<img src="<?php echo esc_url($social_icon['url']); ?>" alt="<?php echo esc_attr($social_name); ?>" class="<?php echo esc_attr($icon_class); ?>" />
							<?php else : ?>
								<img src="<?php echo esc_url($social_icon); ?>" alt="<?php echo esc_attr($social_name); ?>" class="<?php echo esc_attr($icon_class); ?>" />
							<?php endif; ?>
						</a>
				<?php
					endif;
				endforeach;
				?>
			</div>
		<?php endif; ?>
	</div>
</footer>


<?php wp_footer(); ?>

</body>

</html>