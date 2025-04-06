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
<html                <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <?php wp_head(); ?>
</head>

<body                <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <header role="banner" class="header
<?php echo is_front_page() ? 'header-home' : ''; ?>">
        <div class="header-desktop">
            <div class="header-desktop__inner">
                <?php
                    wp_nav_menu([
                        'theme_location' => 'header-menu',
                        'container'      => false,
                        'menu_class'     => 'header-desktop__menu',
                        'menu_id'        => 'header-menu',
                        'echo'           => true,
                        'fallback_cb'    => false,
                        'items_wrap'     => '<nav id="%1$s" class="%2$s" role="navigation" aria-label="' . esc_attr__('Main menu', 'kapitan-pub') . '">%3$s</nav>',
                        'walker'         => new Custom_Walker_Nav_Menu(),
                    ]);
                ?>
                <div class="header-desktop__logo">
                    <?php
                        if (has_custom_logo()) {
                            the_custom_logo();
                        } else {
                            echo '<a href="' . esc_url(home_url('/')) . '" aria-label="' . esc_attr(get_bloginfo('name')) . '">' . get_bloginfo('name') . '</a>';
                        }
                    ?>
                </div>
                <div class="header-desktop__buttons">
                    <?php if (function_exists('pll_the_languages')): ?>
                        <div class="header-desktop__languages">
                            <?php
                                $languages = pll_the_languages([
                                    'show_flags'             => 0,
                                    'show_names'             => 1,
                                    'hide_if_empty'          => 0,
                                    'raw'                    => 1,
                                    'hide_current'           => 0,
                                    'force_home'             => 0,
                                    'post_id'                => get_the_ID(),
                                    'hide_if_no_translation' => 0,
                                    'use_search_url_filter'  => 1,
                                    'rewrite'                => 1,
                                ]);

                                if (! empty($languages)) {
                                    echo '<ul>';
                                    foreach ($languages as $lang) {
                                        $classes = [];
                                        if ($lang['current_lang']) {
                                            $classes[] = 'lang-item-current';
                                        }
                                        echo '<li class="' . implode(' ', $classes) . '">';
                                        echo '<a href="' . esc_url($lang['url']) . '">';
                                        echo '<span>' . esc_html($lang['slug']) . '</span>';
                                        echo '</a>';
                                        echo '</li>';
                                    }
                                    echo '</ul>';
                                }
                            ?>
                        </div>
                    <?php endif; ?>

                    <a href="tel:<?php echo esc_attr(get_field('phone_number', 'option')); ?>"
                        class="button header-desktop__buttons-phone"
                        aria-label="<?php echo esc_attr__('Call us', 'kapitan-pub'); ?>">
                        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/phone-icon.svg"
                            width="25"
                            height="25"
                            alt="<?php echo esc_attr__('Phone icon', 'kapitan-pub'); ?>" />
                    </a>

                    <a href="<?php echo esc_url('/booking'); ?>"
                        class="button header-desktop__buttons-booking"
                        aria-label="<?php echo esc_attr__('Book a table', 'kapitan-pub'); ?>">
                        <?php echo function_exists('pll__') ? pll__('BOOK A TABLE') : 'BOOK A TABLE'; ?>
                    </a>
                </div>
            </div>
        </div>
        <div class="header-desktop__logo lg:hidden mx-auto">
            <?php
                if (has_custom_logo()) {
                    the_custom_logo();
                } else {
                    echo '<a href="' . esc_url(home_url('/')) . '" aria-label="' . esc_attr(get_bloginfo('name')) . '">' . get_bloginfo('name') . '</a>';
                }
            ?>
        </div>


    </header>

    <div class="header-mobile">
        <div class="header-mobile__inner">
            <a href="tel:<?php echo esc_attr(get_field('phone_number', 'option')); ?>"
                class="header-mobile__phone header-mobile__button"
                aria-label="<?php echo esc_attr__('Call us', 'kapitan-pub'); ?>">
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/phone-icon.svg"
                    alt="<?php echo esc_attr__('Phone icon', 'kapitan-pub'); ?>" />
            </a>


            <button type="button"
                class="header-mobile__menu-open header-mobile__button"
                aria-label="<?php echo esc_attr__('Toggle menu', 'kapitan-pub'); ?>">
                <svg width="33" height="21" viewBox="0 0 33 21" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <rect width="33" height="3" fill="currentColor" />
                    <rect width="33" height="3" transform="translate(0 9)" fill="currentColor" />
                    <rect width="33" height="3" transform="translate(0 18)" fill="currentColor" />
                </svg>
            </button>
        </div>
    </div>

    <div class="mobile-menu" id="mobile-menu" role="dialog" aria-modal="true" aria-label="<?php echo esc_attr__('Mobile menu', 'kapitan-pub'); ?>">
        <div class="container">
            <div class="mobile-menu__header">
                <div class="mobile-menu__logo">
                    <?php
                        if (has_custom_logo()) {
                            the_custom_logo();
                        } else {
                            echo '<a href="' . esc_url(home_url('/')) . '" aria-label="' . esc_attr(get_bloginfo('name')) . '">' . get_bloginfo('name') . '</a>';
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
                    'items_wrap'     => '<nav id="%1$s" class="%2$s" role="navigation" aria-label="' . esc_attr__('Mobile menu navigation', 'kapitan-pub') . '">%3$s</nav>',
                    'walker'         => new Custom_Walker_Nav_Menu(),
                ]);
            ?>

            <?php if (function_exists('pll_the_languages')): ?>
                <div class="mobile-menu__languages">
                    <?php
                        $languages = pll_the_languages([
                            'show_flags'             => 0,
                            'show_names'             => 1,
                            'hide_if_empty'          => 0,
                            'raw'                    => 1,
                            'hide_current'           => 0,
                            'force_home'             => 1,
                            'post_id'                => get_the_ID(),
                            'hide_if_no_translation' => 0,
                            'use_search_url_filter'  => 1,
                            'rewrite'                => 1,
                        ]);

                        if (! empty($languages)) {
                            echo '<ul>';
                            foreach ($languages as $lang) {

                                $classes = [];
                                if ($lang['current_lang']) {
                                    $classes[] = 'lang-item-current';
                                }
                                echo '<li class="' . implode(' ', $classes) . '">';
                                echo '<a href="' . esc_url($lang['url']) . '">';

                                echo '<span>' . esc_html($lang['slug']) . '</span>';
                                echo '</a>';
                                echo '</li>';
                            }
                            echo '</ul>';
                        }
                    ?>
                </div>
            <?php endif; ?>

            <button type="button"
                class="mobile-menu__close header-mobile__button"
                aria-label="<?php echo esc_attr__('Close menu', 'kapitan-pub'); ?>">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M18 6L6 18" stroke="currentColor" stroke-width="2" />
                    <path d="M6 6L18 18" stroke="currentColor" stroke-width="2" />
                </svg>
            </button>
        </div>
    </div>