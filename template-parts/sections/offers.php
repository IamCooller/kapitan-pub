	<?php

	$title = get_sub_field('title');
	$items = get_sub_field('items');
	?>
	<section class=" offers-section" id="offers">
		<div class="container">
			<?php if ($title) : ?>
				<div class="h3  offers-section__title"><?php echo $title; ?></div>
			<?php endif; ?>
			<?php if ($items) : ?>
				<div class="offers-section__items">
					<?php foreach ($items as $item) : ?>
						<div class="offers-section__item">
							<div class="  h3  offers-section__item-title"><?php echo $item['title']; ?></div>
							<ul class="offers-section__item-list">
								<?php foreach ($item['items'] as $item) : ?>
									<li class="menu-item">

										<span class="menu-item__name"><span class="menu-item__marker">•</span><?php echo $item['name']; ?></span>
										<span class="menu-item__dots"></span>
										<span class="menu-item__price"><?php echo $item['price']; ?></span>
									</li>
								<?php endforeach; ?>
							</ul>
						</div>
					<?php endforeach; ?>
				<?php endif; ?>
				</div>
	</section>