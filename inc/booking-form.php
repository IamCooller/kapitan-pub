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
    if (!isset($_POST['booking_nonce_field']) || !wp_verify_nonce($_POST['booking_nonce_field'], 'booking_nonce')) {
        wp_send_json_error(__('Security check failed.', 'kapitan-pub'));
        exit;
    }

    // Collect form data
    $name = sanitize_text_field($_POST['name'] ?? '');
    $email = sanitize_email($_POST['email'] ?? '');
    $phone = sanitize_text_field($_POST['phone'] ?? '');
    $persons = sanitize_text_field($_POST['persons'] ?? '');
    $date = sanitize_text_field($_POST['date'] ?? '');
    $time = sanitize_text_field($_POST['time'] ?? '');
    $message = sanitize_textarea_field($_POST['message'] ?? '');
    $lang = sanitize_text_field($_POST['lang'] ?? 'en');

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
    if (!is_email($email)) {
        wp_send_json_error(
            function_exists('pll__')
                ? pll__('Please enter a valid email address.')
                : __('Please enter a valid email address.', 'kapitan-pub')
        );
        exit;
    }

    // Validate date (must be current or future date)
    $selected_date = new DateTime($date);
    $today = new DateTime();
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
    $opening_hours = array(
        0 => array('open' => '11:00', 'close' => '21:00'), // Sunday
        1 => array('open' => '11:00', 'close' => '21:00'), // Monday
        2 => array('open' => '11:00', 'close' => '22:00'), // Tuesday
        3 => array('open' => '11:00', 'close' => '22:00'), // Wednesday
        4 => array('open' => '11:00', 'close' => '22:00'), // Thursday
        5 => array('open' => '11:00', 'close' => '23:00'), // Friday
        6 => array('open' => '11:00', 'close' => '23:00')  // Saturday
    );

    // Validate time (must be within opening hours)
    $day_of_week = (int)$selected_date->format('w');
    $hours = $opening_hours[$day_of_week];

    if (!is_time_within_range($time, $hours['open'], $hours['close'])) {
        wp_send_json_error(
            function_exists('pll__')
                ? pll__('Please select a time within our opening hours.')
                : __('Please select a time within our opening hours.', 'kapitan-pub')
        );
        exit;
    }

    // Prepare email content
    $to = get_option('admin_email');

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

    if (!empty($message)) {
        $body .= '<p><strong>' . __('Special Requests', 'kapitan-pub') . ':</strong> ' . $message . '</p>';
    }

    $body .= '<p><strong>' . __('Language', 'kapitan-pub') . ':</strong> ' . $lang . '</p>';
    $body .= '<p><em>' . __('This message was sent from the booking form on your website.', 'kapitan-pub') . '</em></p>';

    // Email headers
    $headers = array('Content-Type: text/html; charset=UTF-8');
    $headers[] = 'From: ' . get_bloginfo('name') . ' <' . $to . '>';
    $headers[] = 'Reply-To: ' . $name . ' <' . $email . '>';

    // Send email
    $mail_sent = wp_mail($to, $subject, $body, $headers);

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
    $time_stamp = strtotime("1970-01-01 $time");
    $open_stamp = strtotime("1970-01-01 $open_time");
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
        pll_register_string('booking_time_range', 'Please select a time within our opening hours', 'kapitan-pub');
        pll_register_string('booking_server_error', 'Server error. Please try again later.', 'kapitan-pub');

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
    $translations = array(
        'required' => __('This field is required', 'kapitan-pub'),
        'email' => __('Please enter a valid email address', 'kapitan-pub'),
        'phone' => __('Please enter a valid phone number', 'kapitan-pub'),
        'date' => __('Please enter a valid date', 'kapitan-pub'),
        'pastDate' => __('Please select a future date', 'kapitan-pub'),
        'time' => __('Please select a time within our opening hours', 'kapitan-pub'),
        'server_error' => __('Server error. Please try again later.', 'kapitan-pub'),
        'success' => __('Thank you! Your booking request has been sent successfully. We will contact you shortly.', 'kapitan-pub'),
    );

    // Override with Polylang translations if available
    if (function_exists('pll__')) {
        $translations = array(
            'required' => pll__('This field is required'),
            'email' => pll__('Please enter a valid email address'),
            'phone' => pll__('Please enter a valid phone number'),
            'date' => pll__('Please enter a valid date'),
            'pastDate' => pll__('Please select a future date'),
            'time' => pll__('Please select a time within our opening hours'),
            'server_error' => pll__('Server error. Please try again later.'),
            'success' => pll__('Thank you! Your booking request has been sent successfully. We will contact you shortly.'),
        );
    }

    // Localize script - we'll add this in the wp_footer
    wp_localize_script('main-js', 'bookingFormTranslations', $translations);
}

// Hook into WordPress
add_action('wp_ajax_process_booking', 'kapitan_pub_handle_booking_form');
add_action('wp_ajax_nopriv_process_booking', 'kapitan_pub_handle_booking_form');
add_action('init', 'kapitan_pub_register_booking_form_translations');
add_action('wp_enqueue_scripts', 'kapitan_pub_enqueue_booking_form_script', 30);
