<?php

/**
 * Register strings for Polylang translation.
 *
 * Add strings that need translation here using pll_register_string().
 *
 * @package Kapitan_Pub
 */

defined('ABSPATH') || exit;

// Перемещаем регистрацию строк на хук init, чтобы убедиться, что Polylang полностью загружен
add_action('init', function () {
    // Проверяем, что Polylang активен и функция доступна
    if (function_exists('pll_register_string')) {
        // Example:
        // pll_register_string('A unique name for the string', 'The string to translate', 'Theme Strings');

        // Add your theme strings registration here
        // pll_register_string('header_book_table', 'BOOK A TABLE', 'Header');
        // pll_register_string('form_name_placeholder', 'Name', 'Booking Form');
        // pll_register_string('form_email_placeholder', 'Email', 'Booking Form');
        // pll_register_string('form_phone_placeholder', 'Phone Number', 'Booking Form');

        // Menu items - типичные пункты меню
        pll_register_string('menu_home', 'Home', 'Menu');
        pll_register_string('menu_about', 'About', 'Menu');
        pll_register_string('menu_menu', 'Menu', 'Menu');
        pll_register_string('menu_events', 'Events', 'Menu');
        pll_register_string('menu_gallery', 'Gallery', 'Menu');
        pll_register_string('menu_contact', 'Contact', 'Menu');
        pll_register_string('menu_book_table', 'Book a Table', 'Menu');

        // Common interface elements - общие элементы интерфейса
        pll_register_string('common_read_more', 'Read More', 'Common');
        pll_register_string('common_view_details', 'View Details', 'Common');
        pll_register_string('common_share', 'Share', 'Common');
        pll_register_string('common_follow_us', 'Follow Us', 'Common');
        pll_register_string('common_learn_more', 'Learn More', 'Common');

        // Offers section - меню и цены
        pll_register_string('offers_title', 'Menu', 'Offers');
        pll_register_string('offers_breakfast_title', 'Breakfast', 'Offers');
        pll_register_string('offers_lunch_title', 'Lunch', 'Offers');
        pll_register_string('offers_dinner_title', 'Dinner', 'Offers');
        pll_register_string('offers_drinks_title', 'Drinks', 'Offers');

        // Big banner section
        pll_register_string('big_banner_title', 'Welcome to Kapitan Pub', 'Banners');
        pll_register_string('big_banner_text', 'Experience authentic cuisine and beverages in the heart of the city', 'Banners');

        // Footer section
        pll_register_string('footer_address_title', 'Address', 'Footer');
        pll_register_string('footer_address', '123 Main Street, City, Country', 'Footer');
        pll_register_string('footer_contact_title', 'Contact Us', 'Footer');
        pll_register_string('footer_parking_title', 'Parking', 'Footer');
        pll_register_string('footer_parking_info', 'Free parking available', 'Footer');
        pll_register_string('footer_hours_title', 'Open hours', 'Footer');
        pll_register_string('footer_hours_weekdays', 'Monday - Friday: 9am - 10pm', 'Footer');
        pll_register_string('footer_hours_weekends', 'Saturday - Sunday: 10am - 11pm', 'Footer');
        pll_register_string('footer_copyright', '© 2023 Kapitan Pub. All rights reserved.', 'Footer');
        pll_register_string('footer_contact_details', 'Contact Details', 'Footer');
        pll_register_string('footer_reservation', 'Reservation', 'Footer');
        pll_register_string('footer_icon_alt_address', 'Address icon', 'Footer Icons');
        pll_register_string('footer_icon_alt_contact', 'Contact icon', 'Footer Icons');
        pll_register_string('footer_icon_alt_parking', 'Parking icon', 'Footer Icons');
        pll_register_string('footer_icon_alt_hours', 'Opening hours icon', 'Footer Icons');

        // 404 Page
        pll_register_string('404_title', 'Page Not Found', '404 Page');
        pll_register_string('404_text', 'The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.', '404 Page');
        pll_register_string('404_home_button', 'Back to Home', '404 Page');
        pll_register_string('404_contact_button', 'Contact Us', '404 Page');

        // Newsletter
        pll_register_string('newsletter_title', 'Subscribe to Our Newsletter', 'Newsletter');
        pll_register_string('newsletter_subtitle', 'Stay updated with our latest news and special offers.', 'Newsletter');
        pll_register_string('newsletter_placeholder', 'Your Email Address', 'Newsletter');
        pll_register_string('newsletter_button', 'Subscribe', 'Newsletter');
        pll_register_string('newsletter_success', 'Thank you for subscribing!', 'Newsletter');
        pll_register_string('newsletter_error', 'There was an error. Please try again.', 'Newsletter');

        // About section
        pll_register_string('about_history_title', 'Our History', 'About');
        pll_register_string('about_info_title', 'About Us', 'About');

        // Events section
        pll_register_string('events_title', 'Upcoming Events', 'Events');
        pll_register_string('events_subtitle', 'Join us for special events', 'Events');
        pll_register_string('events_no_events', 'No upcoming events at the moment', 'Events');

        // Хедер - уже зарегистрированы в theme-setup.php, но добавим для полноты
        pll_register_string('header_book_table', 'BOOK A TABLE', 'Header');
        pll_register_string('header_call_us', 'Call us', 'Header');
        pll_register_string('header_toggle_menu', 'Toggle menu', 'Header');
        pll_register_string('header_close_menu', 'Close menu', 'Header');
        pll_register_string('header_mobile_menu', 'Mobile menu', 'Header');

        // Сообщения форм - валидация и ошибки
        pll_register_string('form_validation_required', 'This field is required', 'Form Messages');
        pll_register_string('form_validation_email', 'Please enter a valid email address', 'Form Messages');
        pll_register_string('form_validation_phone', 'Please enter a valid phone number', 'Form Messages');
        pll_register_string('form_validation_date', 'Please enter a valid date', 'Form Messages');
        pll_register_string('form_validation_past_date', 'Please select a future date', 'Form Messages');
        pll_register_string('form_validation_time', 'Please select a valid time within our opening hours', 'Form Messages');
        pll_register_string('form_server_error', 'Server error. Please try again later.', 'Form Messages');

        // Сообщения успеха для разных форм
        pll_register_string('form_success_contact', 'Thank you! Your message has been sent successfully. We will contact you shortly.', 'Form Messages');
        pll_register_string('form_success_booking', 'Thank you! Your booking request has been sent successfully. We will contact you shortly.', 'Form Messages');
        pll_register_string('form_success_newsletter', 'Thank you! You have successfully subscribed to our newsletter.', 'Form Messages');
    }
}, 20); // Приоритет 20, чтобы гарантировать, что Polylang полностью загружен
