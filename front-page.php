<?php get_header(); ?>
<main class="main">
    <section class="hero"
        style="background-image: url(<?php echo get_template_directory_uri(); ?>/assets/img/home/hero-bg.png); background-size: cover; background-position: center;">

        <div class="hero__inner">
            <div class="hero__logo">
                <?php
                if (has_custom_logo()) {
                    the_custom_logo();
                } else {
                    echo '<a href="' . esc_url(home_url('/')) . '" aria-label="' . esc_attr(get_bloginfo('name')) . '">' . get_bloginfo('name') . '</a>';
                }
                ?>
            </div>

            <div class="hero__buttons">
                <a href="#" class="button booking-button">
                    <?php esc_html_e('BOOK A TABLE', 'kapitan'); ?>
                </a>
                <a href="#" class="button ">
                    <?php esc_html_e('LOCATION', 'kapitan'); ?>
                </a>
                <a href="#" class="button ">
                    <?php esc_html_e('MENU', 'kapitan'); ?>
                </a>
                <a href="#" class="button ">
                    <?php esc_html_e('EVENTS', 'kapitan'); ?>
                </a>
            </div>
        </div>

    </section>
</main>
<?php get_footer(); ?>