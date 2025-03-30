<?php

/**
 * Contact Form Handler
 * Handle contact form AJAX submission
 */
function kapitan_pub_handle_contact_form()
{
    // Check nonce for security
    if (!isset($_POST['contact_nonce_field']) || !wp_verify_nonce($_POST['contact_nonce_field'], 'contact_nonce')) {
        wp_send_json_error(__('Security check failed.', 'kapitan-pub'));
        exit;
    }

    // Collect form data
    $name = sanitize_text_field($_POST['name'] ?? '');
    $email = sanitize_email($_POST['email'] ?? '');
    $message = sanitize_textarea_field($_POST['message'] ?? '');
    $lang = sanitize_text_field($_POST['lang'] ?? 'en');

    // Validate required fields
    if (empty($name) || empty($email) || empty($message)) {
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

    // Prepare email to admin
    $to = get_option('admin_email');
    $subject = function_exists('pll__')
        ? sprintf(pll__('New Contact Form Message from %s'), get_bloginfo('name'))
        : sprintf(__('New Contact Form Message from %s', 'kapitan-pub'), get_bloginfo('name'));

    // Email content
    $body = '<h2>' . $subject . '</h2>';
    $body .= '<p><strong>' . __('Name', 'kapitan-pub') . ':</strong> ' . $name . '</p>';
    $body .= '<p><strong>' . __('Email', 'kapitan-pub') . ':</strong> ' . $email . '</p>';
    $body .= '<p><strong>' . __('Message', 'kapitan-pub') . ':</strong> ' . nl2br($message) . '</p>';
    $body .= '<p><strong>' . __('Language', 'kapitan-pub') . ':</strong> ' . $lang . '</p>';
    $body .= '<p><em>' . __('This message was sent from the contact form on your website.', 'kapitan-pub') . '</em></p>';

    // Email headers
    $headers = array('Content-Type: text/html; charset=UTF-8');
    $headers[] = 'From: ' . get_bloginfo('name') . ' <' . $to . '>';
    $headers[] = 'Reply-To: ' . $name . ' <' . $email . '>';

    // Send email
    $mail_sent = wp_mail($to, $subject, $body, $headers);

    if ($mail_sent) {
        wp_send_json_success(
            function_exists('pll__')
                ? pll__('Thank you! Your message has been sent successfully. We will contact you shortly.')
                : __('Thank you! Your message has been sent successfully. We will contact you shortly.', 'kapitan-pub')
        );
    } else {
        wp_send_json_error(
            function_exists('pll__')
                ? pll__('Failed to send your message. Please try again or contact us directly.')
                : __('Failed to send your message. Please try again or contact us directly.', 'kapitan-pub')
        );
    }

    exit;
}

/**
 * Register contact form translations and scripts
 */
function kapitan_pub_register_contact_form_scripts()
{
    // Initialize translations array with default values
    $translations = array(
        'required' => __('This field is required', 'kapitan-pub'),
        'email' => __('Please enter a valid email address', 'kapitan-pub'),
        'server_error' => __('Server error. Please try again later.', 'kapitan-pub'),
        'success' => __('Thank you! Your message has been sent successfully. We will contact you shortly.', 'kapitan-pub'),
    );

    // Override with Polylang translations if available
    if (function_exists('pll__')) {
        $translations = array(
            'required' => pll__('This field is required'),
            'email' => pll__('Please enter a valid email address'),
            'server_error' => pll__('Server error. Please try again later.'),
            'success' => pll__('Thank you! Your message has been sent successfully. We will contact you shortly.'),
        );
    }

    // Localize script - we'll add this in the wp_footer
    wp_localize_script('main-js', 'contactFormTranslations', $translations);
}

// Hook contact form functions into WordPress
add_action('wp_ajax_process_contact', 'kapitan_pub_handle_contact_form');
add_action('wp_ajax_nopriv_process_contact', 'kapitan_pub_handle_contact_form');
add_action('wp_enqueue_scripts', 'kapitan_pub_register_contact_form_scripts', 30);
