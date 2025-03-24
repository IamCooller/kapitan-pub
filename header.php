<?php

    /**
     * The header for our theme
     *
     * This is the template that displays all of the <head> section and everything up until <div id="content">
     *
     * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
     *
     * @package KAPITAN_PUB
     */

?>
<!doctype html>
<html                                                   <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <?php wp_head(); ?>
</head>

<body                                                   <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <header class="header">

        <div class="header__inner">
                    <?php
                        wp_nav_menu([
                            'theme_location' => 'header-menu',
                            'container'      => false,
                            'menu_class'     => 'header__menu',
                            'menu_id'        => 'header-menu',
                            'echo'           => true,
                            'fallback_cb'    => false,
                            'items_wrap'     => '<nav id="%1$s" class="%2$s">%3$s</nav>',
                            'walker'         => new Custom_Walker_Nav_Menu(), // Добавляем наш Walker

                        ]);
                    ?>
            <div class="header__logo">
                <?php
                    if (has_custom_logo()) {
                        the_custom_logo();
                    } else {
                        echo '<a href="' . esc_url(home_url('/')) . '">' . get_bloginfo('name') . '</a>';
                    }
                ?>
            </div>
            <div class="header__buttons">
                <a href="<?php echo get_field('phone_number', 'option'); ?>" class="button header__buttons-phone">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/phone-icon.svg" alt="phone" />
                </a>

                <a href="/booking" class="button header__buttons-booking">
                    <?php _e('BOOK A TABLE', 'kapitan'); ?>
                </a>
            </div>
        </div>
    </header>