<?php

/**
 * Booking Form Functionality
 *
 * @package KAPITAN_PUB
 */

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Handle Booking Form AJAX Submission
 */
function kapitan_pub_handle_booking_form()
{
    // Check nonce for security
    if (! isset($_POST['booking_nonce_field']) || ! wp_verify_nonce($_POST['booking_nonce_field'], 'booking_nonce')) {
        wp_send_json_error(__('Security check failed.', 'kapitan-pub'));
        exit;
    }

    // Collect form data
    $name    = sanitize_text_field($_POST['name'] ?? '');
    $email   = sanitize_email($_POST['email'] ?? '');
    $phone   = sanitize_text_field($_POST['phone'] ?? '');
    $persons = sanitize_text_field($_POST['persons'] ?? '');
    $date    = sanitize_text_field($_POST['date'] ?? '');
    $time    = sanitize_text_field($_POST['time'] ?? '');
    $message = sanitize_textarea_field($_POST['message'] ?? '');
    $lang    = sanitize_text_field($_POST['lang'] ?? 'en');

    // Validate required fields
    if (empty($name) || empty($email) || empty($phone) || empty($persons) || empty($date) || empty($time)) {
        wp_send_json_error(
            function_exists('pll__')
            ? pll__('Please fill in all required fields.')
            : __('Please fill in all required fields.', 'kapitan-pub')
        );
        exit;
    }

    // Validate email
    if (! is_email($email)) {
        wp_send_json_error(
            function_exists('pll__')
            ? pll__('Please enter a valid email address.')
            : __('Please enter a valid email address.', 'kapitan-pub')
        );
        exit;
    }

    // Validate date (must be current or future date)
    $selected_date = new DateTime($date);
    $today         = new DateTime();
    $today->setTime(0, 0, 0); // Reset time part for comparison

    if ($selected_date < $today) {
        wp_send_json_error(
            function_exists('pll__')
            ? pll__('Please select a future date.')
            : __('Please select a future date.', 'kapitan-pub')
        );
        exit;
    }

    // Define restaurant opening hours
    $opening_hours = [
        0 => ['open' => '08:00', 'close' => '16:00'], // Sunday
        1 => ['open' => '08:00', 'close' => '16:00'], // Monday
        2 => ['open' => '08:00', 'close' => '16:00'], // Tuesday
        3 => ['open' => '08:00', 'close' => '16:00'], // Wednesday
        4 => ['open' => '08:00', 'close' => '16:00'], // Thursday
        5 => ['open' => '08:00', 'close' => '16:00'], // Friday
        6 => ['open' => '08:00', 'close' => '16:00'], // Saturday
    ];

    // Validate time (must be within opening hours)
    $day_of_week = (int) $selected_date->format('w');
    $hours       = $opening_hours[$day_of_week];

    if (! is_time_within_range($time, $hours['open'], $hours['close'])) {
        wp_send_json_error(
            function_exists('pll__')
            ? pll__('Please select a time within our opening hours.')
            : __('Please select a time within our opening hours.', 'kapitan-pub')
        );
        exit;
    }

    // Prepare email content
    $to = get_option('admin_email');

    // Логирование данных формы
    error_log('--------- НАЧАЛО ОТПРАВКИ ФОРМЫ БРОНИРОВАНИЯ ---------');
    error_log('Данные формы бронирования:');
    error_log('Имя: ' . $name);
    error_log('Email: ' . $email);
    error_log('Телефон: ' . $phone);
    error_log('Гости: ' . $persons);
    error_log('Дата: ' . $date);
    error_log('Время: ' . $time);
    error_log('Получатель: ' . $to);

    // Email subject based on language
    $subject = function_exists('pll__')
    ? sprintf(pll__('New Booking Request from %s'), $name)
    : sprintf(__('New Booking Request from %s', 'kapitan-pub'), $name);

    // Email content
    $body = '<h2>' . $subject . '</h2>';
    $body .= '<p><strong>' . __('Name', 'kapitan-pub') . ':</strong> ' . $name . '</p>';
    $body .= '<p><strong>' . __('Email', 'kapitan-pub') . ':</strong> ' . $email . '</p>';
    $body .= '<p><strong>' . __('Phone', 'kapitan-pub') . ':</strong> ' . $phone . '</p>';
    $body .= '<p><strong>' . __('Number of Persons', 'kapitan-pub') . ':</strong> ' . $persons . '</p>';
    $body .= '<p><strong>' . __('Date', 'kapitan-pub') . ':</strong> ' . $date . '</p>';
    $body .= '<p><strong>' . __('Time', 'kapitan-pub') . ':</strong> ' . $time . '</p>';

    if (! empty($message)) {
        $body .= '<p><strong>' . __('Special Requests', 'kapitan-pub') . ':</strong> ' . $message . '</p>';
    }

    $body .= '<p><strong>' . __('Language', 'kapitan-pub') . ':</strong> ' . $lang . '</p>';
    $body .= '<p><em>' . __('This message was sent from the booking form on your website.', 'kapitan-pub') . '</em></p>';

    // Email headers
    $headers   = ['Content-Type: text/html; charset=UTF-8'];
    $headers[] = 'Reply-To: ' . $name . ' <' . $email . '>';

    error_log('Заголовки письма:');
    error_log(print_r($headers, true));
    error_log('Тема письма: ' . $subject);
    error_log('Попытка отправки письма на адрес: ' . $to);

    // Проверяем, есть ли функция wp_mail
    if (! function_exists('wp_mail')) {
        error_log('ОШИБКА: Функция wp_mail не существует!');
    } else {
        error_log('Функция wp_mail существует');
    }

    // Проверяем, установлен ли плагин WP Mail SMTP
    if (class_exists('WPMailSMTP\WP')) {
        error_log('WP Mail SMTP активен, будет использоваться для отправки');
    }

    // Send email
    $mail_sent = wp_mail($to, $subject, $body, $headers);

    // Если отправка через wp_mail не удалась, попробуем стандартную функцию PHP mail
    if (! $mail_sent) {
        error_log('Пробуем отправить через стандартную функцию PHP mail()');

        // Формируем заголовки для mail()
        $php_headers = 'MIME-Version: 1.0' . "\r\n";
        $php_headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
        $php_headers .= 'From: ' . get_bloginfo('name') . ' <' . $to . '>' . "\r\n";
        $php_headers .= 'Reply-To: ' . $name . ' <' . $email . '>' . "\r\n";

        // Пытаемся отправить через mail()
        $direct_mail_sent = @mail($to, $subject, $body, $php_headers);
        error_log('Результат отправки через PHP mail(): ' . ($direct_mail_sent ? 'УСПЕШНО' : 'ОШИБКА'));
    }

    error_log('Результат отправки: ' . ($mail_sent ? 'УСПЕШНО' : 'ОШИБКА'));
    if (! $mail_sent) {
        // Проверяем глобальные ошибки WordPress
        global $phpmailer;
        if (isset($phpmailer) && is_object($phpmailer) && is_wp_error($phpmailer->ErrorInfo)) {
            error_log('PHPMailer ошибка: ' . $phpmailer->ErrorInfo);
        } else {
            error_log('Неизвестная ошибка отправки письма');
        }
    }
    error_log('--------- КОНЕЦ ОТПРАВКИ ФОРМЫ БРОНИРОВАНИЯ ---------');

    if ($mail_sent) {
        wp_send_json_success(
            function_exists('pll__')
            ? pll__('Thank you! Your booking request has been sent successfully. We will contact you shortly.')
            : __('Thank you! Your booking request has been sent successfully. We will contact you shortly.', 'kapitan-pub')
        );
    } else {
        wp_send_json_error(
            function_exists('pll__')
            ? pll__('Failed to send your booking request. Please try again or contact us directly.')
            : __('Failed to send your booking request. Please try again or contact us directly.', 'kapitan-pub')
        );
    }

    exit;
}

/**
 * Helper function to check if time is within range
 */
function is_time_within_range($time, $open_time, $close_time)
{
    // Check if time is in 12-hour format with AM/PM
    if (strpos($time, 'AM') !== false || strpos($time, 'PM') !== false) {
        // Convert 12-hour format to 24-hour format for comparison
        $time_parts = explode(' ', $time);
        $time_value = $time_parts[0];
        $am_pm      = $time_parts[1];

        $time_components = explode(':', $time_value);
        $hours           = (int) $time_components[0];
        $minutes         = isset($time_components[1]) ? $time_components[1] : '00';

        // Convert hours to 24-hour format
        if ($am_pm === 'PM' && $hours < 12) {
            $hours += 12;
        } else if ($am_pm === 'AM' && $hours === 12) {
            $hours = 0;
        }

        // Create 24-hour format time string
        $time = sprintf('%02d:%s', $hours, $minutes);
    }

    $time_stamp  = strtotime("1970-01-01 $time");
    $open_stamp  = strtotime("1970-01-01 $open_time");
    $close_stamp = strtotime("1970-01-01 $close_time");

    return ($time_stamp >= $open_stamp && $time_stamp <= $close_stamp);
}

/**
 * Register booking form strings for translation
 */
function kapitan_pub_register_booking_form_translations()
{
    if (function_exists('pll_register_string')) {
        // Register form field labels
        pll_register_string('booking_name', 'Name', 'kapitan-pub');
        pll_register_string('booking_email', 'Email', 'kapitan-pub');
        pll_register_string('booking_phone', 'Phone', 'kapitan-pub');
        pll_register_string('booking_phone_number', 'Phone Number', 'kapitan-pub');
        pll_register_string('booking_persons', 'Persons', 'kapitan-pub');
        pll_register_string('booking_date', 'Date', 'kapitan-pub');
        pll_register_string('booking_time', 'Time', 'kapitan-pub');
        pll_register_string('booking_special_requests', 'Special Requests', 'kapitan-pub');
        pll_register_string('booking_more', 'More', 'kapitan-pub');
        pll_register_string('booking_submit', 'BOOK NOW', 'kapitan-pub');
        pll_register_string('booking_reserve', 'RESERVE', 'kapitan-pub');
        pll_register_string('booking_book_a_table', 'BOOK A TABLE', 'kapitan-pub');
        pll_register_string('booking_book_private_dining', 'Book private dining', 'kapitan-pub');
        pll_register_string('booking_banquet_room', '& banquet room', 'kapitan-pub');
        pll_register_string('booking_available_hours', 'Available hours:', 'kapitan-pub');

        // Register person options
        pll_register_string('booking_1_person', '1 person', 'kapitan-pub');
        pll_register_string('booking_2_persons', '2 persons', 'kapitan-pub');
        pll_register_string('booking_3_5_persons', '3-5 persons', 'kapitan-pub');
        pll_register_string('booking_5_10_persons', '5-10 persons', 'kapitan-pub');
        pll_register_string('booking_more_10_persons', 'more than 10 persons', 'kapitan-pub');

        // Register validation messages
        pll_register_string('booking_required', 'This field is required', 'kapitan-pub');
        pll_register_string('booking_invalid_email', 'Please enter a valid email address', 'kapitan-pub');
        pll_register_string('booking_invalid_phone', 'Please enter a valid phone number', 'kapitan-pub');
        pll_register_string('booking_invalid_date', 'Please enter a valid date', 'kapitan-pub');
        pll_register_string('booking_past_date', 'Please select a future date', 'kapitan-pub');
        pll_register_string('booking_future_date', 'Please select a future date.', 'kapitan-pub');
        pll_register_string('booking_time_range', 'Please select a time within our opening hours', 'kapitan-pub');
        pll_register_string('booking_server_error', 'Server error. Please try again later.', 'kapitan-pub');
        pll_register_string('booking_available_hours', 'Available hours:', 'kapitan-pub');

        // Register success/error messages
        pll_register_string('booking_success', 'Thank you! Your booking request has been sent successfully. We will contact you shortly.', 'kapitan-pub');
        pll_register_string('booking_error', 'Failed to send your booking request. Please try again or contact us directly.', 'kapitan-pub');
        pll_register_string('booking_fill_required', 'Please fill in all required fields.', 'kapitan-pub');
    }
}

/**
 * Enqueue booking form script and pass translations to JS
 */
function kapitan_pub_enqueue_booking_form_script()
{
    // Initialize translations array with default values
    $translations = [
        'required'        => __('This field is required', 'kapitan-pub'),
        'email'           => __('Please enter a valid email address', 'kapitan-pub'),
        'phone'           => __('Please enter a valid phone number', 'kapitan-pub'),
        'date'            => __('Please enter a valid date', 'kapitan-pub'),
        'pastDate'        => __('Please select a future date', 'kapitan-pub'),
        'time'            => __('Please select a time within our opening hours', 'kapitan-pub'),
        'server_error'    => __('Server error. Please try again later.', 'kapitan-pub'),
        'success'         => __('Thank you! Your booking request has been sent successfully. We will contact you shortly.', 'kapitan-pub'),
        'available_hours' => __('Available hours:', 'kapitan-pub'),
    ];

    // Override with Polylang translations if available
    if (function_exists('pll__')) {
        $translations = [
            'required'        => pll__('This field is required'),
            'email'           => pll__('Please enter a valid email address'),
            'phone'           => pll__('Please enter a valid phone number'),
            'date'            => pll__('Please enter a valid date'),
            'pastDate'        => pll__('Please select a future date'),
            'time'            => pll__('Please select a time within our opening hours'),
            'server_error'    => pll__('Server error. Please try again later.'),
            'success'         => pll__('Thank you! Your booking request has been sent successfully. We will contact you shortly.'),
            'available_hours' => pll__('Available hours:'),
        ];
    }

    // Debugging information
    error_log('Booking form translations: ' . print_r($translations, true));

    // Localize script - we'll add this in the wp_footer
    wp_localize_script('vite-main', 'bookingFormTranslations', $translations);
    wp_localize_script('vite-main', 'bookingFormSecondTranslations', $translations);
}

// Hook into WordPress
add_action('wp_ajax_process_booking', 'kapitan_pub_handle_booking_form');
add_action('wp_ajax_nopriv_process_booking', 'kapitan_pub_handle_booking_form');
add_action('init', 'kapitan_pub_register_booking_form_translations');
add_action('wp_enqueue_scripts', 'kapitan_pub_enqueue_booking_form_script', 30);
