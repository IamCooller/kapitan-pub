<?php get_header(); ?>
<main class="main">
	<?php
	if (have_posts()) :
		while (have_posts()) :
			the_post();
			the_content();
		endwhile;
	endif;
	?>

	<?php if (have_rows('sections')) : ?>
		<?php while (have_rows('sections')) : the_row(); ?>
			<?php
			// Получаем имя текущего макета
			$layout = get_row_layout();

			// Загружаем файл PHP, соответствующий этому макету
			get_template_part('template-parts/sections/' . $layout);
			?>
		<?php endwhile; ?>
	<?php endif; ?>

	<section class="bg-blue py-[100px]"
		style="
background-image: url(<?php echo get_template_directory_uri(); ?>/assets/images/bg-blue.jpg);
background-size: cover;
background-position: center;
background-repeat: no-repeat;
">
		<div class="container">
			<div class=" font-jeju text-[80px] text-center w-full mb-2.5">Capitan newsletter</div>
			<p class="text-center text-white font-medium">Subscribe to receive the latest news, announcements, and special offers</p>
			<form action="" class="flex gap-2.5 justify-baseline border-b border-b-white pb-2 mt-16">
				<label for="email" class="sr-only">Email</label>
				<input type="email" placeholder="YOUR EMAIL" class=" border-0 bg-transparent outline-none flex-1/2 font-medium placeholder:text-white ">
				<button type="submit" class=" bg-transparent border-0  not-disabled:cursor-pointer font-medium" title="Subscribe">SIGN UP</button>
			</form>
			<div class="flex justify-center items-center mt-16 gap-2.5">

				<a href="#" class="text-white font-medium text-xs">Facebook</a>
				<span class=""><svg width="8" height="13" viewBox="0 0 8 13" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M4.15868 1.06438C4.14178 1.0376 4.11838 1.01553 4.09065 1.00024C4.06292 0.984949 4.03177 0.976929 4.0001 0.976929C3.96844 0.976929 3.93729 0.984949 3.90956 1.00024C3.88183 1.01553 3.85842 1.0376 3.84152 1.06438L0.474728 6.39993C0.45583 6.42988 0.445801 6.46457 0.445801 6.49998C0.445801 6.5354 0.45583 6.57009 0.474728 6.60004L3.84152 11.9356C3.85842 11.9624 3.88183 11.9844 3.90956 11.9997C3.93729 12.015 3.96844 12.023 4.0001 12.023C4.03177 12.023 4.06292 12.015 4.09065 11.9997C4.11838 11.9844 4.14178 11.9624 4.15868 11.9356L7.52548 6.60004C7.54438 6.57009 7.55441 6.5354 7.55441 6.49998C7.55441 6.46457 7.54438 6.42988 7.52548 6.39993L4.15868 1.06438ZM4.0001 11.4842L0.855025 6.49998L4.0001 1.51579L7.14518 6.49998L4.0001 11.4842Z" fill="#BB936D" />
					</svg>
				</span>
				<a href="#" class="text-white font-medium text-xs">Instagram</a>
				<span class=""><svg width="8" height="13" viewBox="0 0 8 13" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M4.15868 1.06438C4.14178 1.0376 4.11838 1.01553 4.09065 1.00024C4.06292 0.984949 4.03177 0.976929 4.0001 0.976929C3.96844 0.976929 3.93729 0.984949 3.90956 1.00024C3.88183 1.01553 3.85842 1.0376 3.84152 1.06438L0.474728 6.39993C0.45583 6.42988 0.445801 6.46457 0.445801 6.49998C0.445801 6.5354 0.45583 6.57009 0.474728 6.60004L3.84152 11.9356C3.85842 11.9624 3.88183 11.9844 3.90956 11.9997C3.93729 12.015 3.96844 12.023 4.0001 12.023C4.03177 12.023 4.06292 12.015 4.09065 11.9997C4.11838 11.9844 4.14178 11.9624 4.15868 11.9356L7.52548 6.60004C7.54438 6.57009 7.55441 6.5354 7.55441 6.49998C7.55441 6.46457 7.54438 6.42988 7.52548 6.39993L4.15868 1.06438ZM4.0001 11.4842L0.855025 6.49998L4.0001 1.51579L7.14518 6.49998L4.0001 11.4842Z" fill="#BB936D" />
					</svg>
				</span>
				<a href="#" class="text-white font-medium text-xs">Twitter</a>
			</div>

		</div>
	</section>
</main>

<?php get_footer(); ?>