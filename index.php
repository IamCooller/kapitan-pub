<?php get_header(); ?>
<main class="main min-h-96">
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


</main>

<?php get_footer(); ?>