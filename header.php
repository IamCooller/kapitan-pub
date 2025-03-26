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
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <header>
        <div class="header-desktop   ">
            <div class=" header-desktop__inner">
                <?php
                wp_nav_menu([
                    'theme_location' => 'header-menu',
                    'container'      => false,
                    'menu_class'     => 'header-desktop__menu',
                    'menu_id'        => 'header-menu',
                    'echo'           => true,
                    'fallback_cb'    => false,
                    'items_wrap'     => '<nav id="%1$s" class="%2$s">%3$s</nav>',
                    'walker'         => new Custom_Walker_Nav_Menu(),

                ]);
                ?>
                <div class="header-desktop__logo">
                    <?php
                    if (has_custom_logo()) {
                        the_custom_logo();
                    } else {
                        echo '<a href="' . esc_url(home_url('/')) . '">' . get_bloginfo('name') . '</a>';
                    }
                    ?>
                </div>
                <div class="header-desktop__buttons">
                    <a href="tel:<?php echo esc_attr(get_field('phone_number', 'option')); ?>" class="button header-desktop__buttons-phone">
                        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/phone-icon.svg" width="25" height="25" alt="<?php echo esc_attr__('phone', 'kapitan-pub'); ?>" />
                    </a>

                    <a href="<?php echo esc_url('/booking'); ?>" class="button header-desktop__buttons-booking">
                        <?php esc_html_e('BOOK A TABLE', 'kapitan'); ?>
                    </a>
                </div>


            </div>
        </div>
        <div class="header-mobile     ">
            <div class="header-mobile__inner ">

                <a href="tel:<?php echo esc_attr(get_field('phone_number', 'option')); ?>" class="header-mobile__phone header-mobile__button">
                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/phone-icon.svg" alt="<?php echo esc_attr__('phone', 'kapitan-pub'); ?>" />
                </a>

                <button class="header-mobile__menu-open header-mobile__button">
                    <svg width="33" height="21" viewBox="0 0 33 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect width="33" height="3" fill="white" />
                        <rect width="33" height="3" transform="translate(0 9)" fill="white" />
                        <rect width="33" height="3" transform="translate(0 18)" fill="white" />
                    </svg>

                </button>
            </div>
        </div>

        <div class="mobile-menu" id="mobileMenu">
            <div class="mobile-menu__header">
                <div class="mobile-menu__logo">
                    <?php
                    if (has_custom_logo()) {
                        the_custom_logo();
                    } else {
                        echo '<a href="' . esc_url(home_url('/')) . '">' . get_bloginfo('name') . '</a>';
                    }
                    ?>
                </div>

            </div>

            <?php
            wp_nav_menu([
                'theme_location' => 'header-menu',
                'container'      => false,
                'menu_class'     => 'mobile-menu__nav header__menu',
                'menu_id'        => 'mobile-menu-nav',
                'echo'           => true,
                'fallback_cb'    => false,
                'items_wrap'     => '<nav id="%1$s" class="%2$s">%3$s</nav>',
                'walker'         => new Custom_Walker_Nav_Menu(),

            ]);
            ?>

            <button class="mobile-menu__close header-mobile__button">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M18 6L6 18" stroke="white" stroke-width="2" />
                    <path d="M6 6L18 18" stroke="white" stroke-width="2" />
                </svg>
            </button>
        </div>
    </header>