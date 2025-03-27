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
	<div class="container pb-6 border-b border-white/18">
		<div class="bg-blue -mt-16  pt-[50px] pb-[80px] px-[30px] relative z-10 ">
			<div class="grid grid-cols-3">
				<div class="grid grid-cols-2 gap-x-[40px] col-span-2">
					<?php if (!empty($address)) : ?>
						<div class="flex gap-5 pb-7   border-b border-white/12 ">
							<div class="h-full">
								<img src="<?php echo get_template_directory_uri(); ?>/assets/img/address-icon.png" alt="address" class="w-[35px] h-[35px]" />
							</div>
							<div class="">
								<div class="font-semibold mb-4"><?php echo esc_html($address_label); ?></div>
								<div>
									<?php echo wp_kses_post($address); ?>
								</div>
							</div>
						</div>
					<?php endif; ?>

					<?php if (!empty($phone) || !empty($email)) : ?>
						<div class="flex gap-5 pb-7  border-b border-white/12 ">
							<div class="h-full">
								<img src="<?php echo get_template_directory_uri(); ?>/assets/img/Contact-icon.png" alt="contact" class="w-[33px] h-[33px]" />
							</div>
							<div class="">
								<div class="font-semibold mb-4"><?php echo esc_html($contact_label); ?></div>
								<div>
									<?php if (!empty($phone)) : ?>
										<a href="tel:<?php echo esc_attr($phone); ?>" class="block underline"><?php echo esc_html($phone); ?></a>
									<?php endif; ?>
									<?php if (!empty($email)) : ?>
										<a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a>
									<?php endif; ?>
								</div>
							</div>
						</div>
					<?php endif; ?>

					<?php if (!empty($parking_text)) : ?>
						<div class="flex gap-5 pb-7 pt-4 border-b border-white/12 ">
							<div class="h-full">
								<img src="<?php echo get_template_directory_uri(); ?>/assets/img/Parking-icon.svg" alt="parging" class="w-[38px] h-[34px]" />
							</div>
							<div class="">
								<div class="font-semibold mb-4"><?php echo esc_html($parking_label); ?></div>
								<div>
									<p><?php echo esc_html($parking_text); ?></p>
								</div>
							</div>
						</div>
					<?php endif; ?>
				</div>

				<?php if (!empty($open_hours)) : ?>
					<div class="px-4 flex gap-[20px]">
						<div class="h-full">
							<img src="<?php echo get_template_directory_uri(); ?>/assets/img/hours-icon.png" alt="hours" class="w-[35px] h-[35px]" />
						</div>
						<div class="">
							<div class="font-semibold mb-4"><?php echo esc_html($open_hours_label); ?></div>
							<div>
								<?php echo wp_kses_post($open_hours); ?>
							</div>
						</div>
					</div>
				<?php endif; ?>
			</div>

			<?php if (!empty($qr_codes) && is_array($qr_codes)) : ?>
				<div class="flex gap-9 mt-3">
					<?php foreach ($qr_codes as $qr_code) :
						$qr_image = !empty($qr_code['qr_image']) ? $qr_code['qr_image'] : '';
						$qr_title = !empty($qr_code['qr_title']) ? $qr_code['qr_title'] : '';

						if (!empty($qr_image) && !empty($qr_title)) :
					?>
							<div class="">
								<div class="font-semibold mb-2.5"><?php echo esc_html($qr_title); ?></div>
								<?php if (is_array($qr_image) && !empty($qr_image['url'])) : ?>
									<img src="<?php echo esc_url($qr_image['url']); ?>" alt="<?php echo esc_attr($qr_title); ?>" class="w-[150px] aspect-square" />
								<?php else : ?>
									<img src="<?php echo esc_url($qr_image); ?>" alt="<?php echo esc_attr($qr_title); ?>" class="w-[150px] aspect-square" />
								<?php endif; ?>
							</div>
					<?php
						endif;
					endforeach;
					?>
				</div>
			<?php endif; ?>
		</div>

		<div class="mt-6 grid grid-cols-3 gap-8">
			<div class="space-y-9">
				<div class="max-w-[201px] max-h-[89px]">
					<?php
					if (has_custom_logo()) {
						the_custom_logo();
					} else {
						echo '<a href="' . esc_url(home_url('/')) . '" aria-label="' . esc_attr(get_bloginfo('name')) . '">' . get_bloginfo('name') . '</a>';
					}
					?>
				</div>
				<?php if (!empty($footer_text)) : ?>
					<p class="max-w-[350px]"><?php echo esc_html($footer_text); ?></p>
				<?php endif; ?>
			</div>
			<div class="">
				<?php
				wp_nav_menu([
					'theme_location' => 'footer-menu',
					'container'      => false,
					'menu_class'     => 'flex flex-col text-center items-center justify-center',
					'menu_id'        => 'footer-menu',
					'echo'           => true,
					'fallback_cb'    => false,
					'items_wrap'     => '<nav id="%1$s" class="%2$s" role="navigation" aria-label="' . esc_attr__('Main menu', 'kapitan-pub') . '">%3$s</nav>',
					'walker'         => new Custom_Walker_Nav_Menu(),
				]);
				?>
			</div>
			<div class="text-secondary text-right space-y-8">
				<?php if (!empty($phone) || !empty($email)) : ?>
					<div class="">
						<div class="font-montserrat text-lg font-semibold"><?php echo esc_html($contact_info_label); ?></div>
						<?php if (!empty($phone)) : ?>
							<a href="tel:<?php echo esc_attr($phone); ?>" class="font-montserrat text-lg font-bold block underline"><?php echo esc_html($phone); ?></a>
						<?php endif; ?>
						<?php if (!empty($email)) : ?>
							<a href="mailto:<?php echo esc_attr($email); ?>" class="font-montserrat text-lg block"><?php echo esc_html($email); ?></a>
						<?php endif; ?>
					</div>
				<?php endif; ?>

				<?php if (!empty($reservation_email)) : ?>
					<div class="">
						<div class="text-lg font-semibold font-montserrat text-white bg-secondary w-fit ml-auto"><?php echo esc_html($reservation_label); ?></div>
						<a href="mailto:<?php echo esc_attr($reservation_email); ?>" class="font-montserrat text-lg block"><?php echo esc_html($reservation_email); ?></a>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<div class="pt-12 pb-4 text-center container">
		<?php if (!empty($copyright_text)) : ?>
			<p class="text-sm"><?php echo esc_html($copyright_text); ?></p>
		<?php endif; ?>

		<?php if (!empty($social_links) && is_array($social_links)) : ?>
			<div class="mt-8 flex max-w-[115px] mx-auto justify-between">
				<?php foreach ($social_links as $social) :
					$social_url = !empty($social['url']) ? $social['url'] : '';
					$social_icon = !empty($social['icon']) ? $social['icon'] : '';
					$social_name = !empty($social['name']) ? $social['name'] : '';


				?>
					<a href="<?php echo esc_url($social_url); ?>">
						<?php if (is_array($social_icon) && !empty($social_icon['url'])) : ?>
							<img src="<?php echo esc_url($social_icon['url']); ?>" alt="<?php echo esc_attr($social_name); ?>" class="" />
						<?php else : ?>
							<img src="<?php echo esc_url($social_icon); ?>" alt="<?php echo esc_attr($social_name); ?>" class="<?php echo esc_attr($icon_class); ?>" />
						<?php endif; ?>
					</a>
				<?php
				endforeach;
				?>
			</div>
		<?php endif; ?>
	</div>
</footer>


<?php wp_footer(); ?>

</body>

</html>