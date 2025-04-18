<?php

/**
 * Newsletter Form Functionality
 *
 * @package KAPITAN_PUB
 */

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Handle Newsletter Form AJAX Submission
 */
function kapitan_pub_handle_newsletter_form()
{
    // Check nonce for security
    if (! isset($_POST['newsletter_nonce_field']) || ! wp_verify_nonce($_POST['newsletter_nonce_field'], 'newsletter_nonce')) {
        wp_send_json_error(__('Security check failed.', 'kapitan-pub'));
        exit;
    }

    // Collect form data
    $email = sanitize_email($_POST['email'] ?? '');
    $lang  = sanitize_text_field($_POST['lang'] ?? 'en');

    // Validate required fields
    if (empty($email)) {
        wp_send_json_error(
            function_exists('pll__')
            ? pll__('Please enter your email address.')
            : __('Please enter your email address.', 'kapitan-pub')
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
    $to = get_option('admin_email');

    // Логирование данных формы подписки
    error_log('--------- НАЧАЛО ОТПРАВКИ ФОРМЫ ПОДПИСКИ ---------');
    error_log('Email подписчика: ' . $email);
    error_log('Получатель уведомления: ' . $to);

    $subject = function_exists('pll__')
    ? sprintf(pll__('New Newsletter Subscription from %s'), get_bloginfo('name'))
    : sprintf(__('New Newsletter Subscription from %s', 'kapitan-pub'), get_bloginfo('name'));

    // Email content
    $body = '<h2>' . $subject . '</h2>';
    $body .= '<p><strong>' . __('Email', 'kapitan-pub') . ':</strong> ' . $email . '</p>';
    $body .= '<p><strong>' . __('Language', 'kapitan-pub') . ':</strong> ' . $lang . '</p>';
    $body .= '<p><em>' . __('This subscription was made from the newsletter form on your website.', 'kapitan-pub') . '</em></p>';

    // Email headers
    $headers = ['Content-Type: text/html; charset=UTF-8'];
    // Удалить From заголовок, т.к. WP Mail SMTP сам его установит
    $headers[] = 'Reply-To: ' . $email . ' <' . $email . '>';

    error_log('Заголовки письма формы подписки:');
    error_log(print_r($headers, true));
    error_log('Тема письма: ' . $subject);

    // Проверяем, активен ли WP Mail SMTP
    if (class_exists('WPMailSMTP\WP')) {
        error_log('WP Mail SMTP активен для формы подписки');
    }

    // Send email
    $mail_sent = wp_mail($to, $subject, $body, $headers);

    error_log('Результат отправки формы подписки: ' . ($mail_sent ? 'УСПЕШНО' : 'ОШИБКА'));
    if (! $mail_sent) {
        global $phpmailer;
        if (isset($phpmailer) && is_object($phpmailer) && is_wp_error($phpmailer->ErrorInfo)) {
            error_log('PHPMailer ошибка (форма подписки): ' . $phpmailer->ErrorInfo);
        }
    }
    error_log('--------- КОНЕЦ ОТПРАВКИ ФОРМЫ ПОДПИСКИ ---------');

    if ($mail_sent) {
        wp_send_json_success(
            function_exists('pll__')
            ? pll__('Thank you! You have successfully subscribed to our newsletter.')
            : __('Thank you! You have successfully subscribed to our newsletter.', 'kapitan-pub')
        );
    } else {
        wp_send_json_error(
            function_exists('pll__')
            ? pll__('Failed to subscribe. Please try again or contact us directly.')
            : __('Failed to subscribe. Please try again or contact us directly.', 'kapitan-pub')
        );
    }

    exit;
}

/**
 * Register newsletter form translations
 */
function kapitan_pub_register_newsletter_form_translations()
{
    // If Polylang is active, register these strings for translation
    if (function_exists('pll_register_string')) {
        pll_register_string('newsletter-required', 'This field is required', 'kapitan-pub');
        pll_register_string('newsletter-email', 'Please enter a valid email address', 'kapitan-pub');
        pll_register_string('newsletter-server-error', 'Server error. Please try again later.', 'kapitan-pub');
        pll_register_string('newsletter-success', 'Thank you! You have successfully subscribed to our newsletter.', 'kapitan-pub');
    }
}

/**
 * Enqueue newsletter form scripts
 */
function kapitan_pub_enqueue_newsletter_form_script()
{
    // Initialize translations array with default values
    $translations = [
        'required'     => __('This field is required', 'kapitan-pub'),
        'email'        => __('Please enter a valid email address', 'kapitan-pub'),
        'server_error' => __('Server error. Please try again later.', 'kapitan-pub'),
        'success'      => __('Thank you! You have successfully subscribed to our newsletter.', 'kapitan-pub'),
    ];

    // Override with Polylang translations if available
    if (function_exists('pll__')) {
        $translations = [
            'required'     => pll__('This field is required'),
            'email'        => pll__('Please enter a valid email address'),
            'server_error' => pll__('Server error. Please try again later.'),
            'success'      => pll__('Thank you! You have successfully subscribed to our newsletter.'),
        ];
    }

    // Localize script
    wp_localize_script('vite-main', 'newsletterFormTranslations', $translations);
}

// Hook into WordPress
add_action('wp_ajax_process_newsletter', 'kapitan_pub_handle_newsletter_form');
add_action('wp_ajax_nopriv_process_newsletter', 'kapitan_pub_handle_newsletter_form');
add_action('init', 'kapitan_pub_register_newsletter_form_translations');
add_action('wp_enqueue_scripts', 'kapitan_pub_enqueue_newsletter_form_script', 30);
