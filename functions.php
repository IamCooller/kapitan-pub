<?php

    /**
     * KAPITAN PUB functions and definitions
     *
     * @link https://developer.wordpress.org/themes/basics/theme-functions/
     *
     * @package KAPITAN_PUB
     */

    if (! defined('_S_VERSION')) {
        // Replace the version number of the theme on each release.
        define('_S_VERSION', '1.0.0');
    }

    define('IS_VITE_DEVELOPMENT', true);

    // Подключаем функции
    require get_template_directory() . '/inc/acf-blocks.php';  // ACF Gutenberg Blocks (создай файл позже)
    require get_template_directory() . '/inc/theme-setup.php'; // Поддержка темы, меню и т.д.
    require get_template_directory() . '/inc/inc.vite.php';

    require get_template_directory() . '/inc/booking-form.php';     // Форма бронирования
    require get_template_directory() . '/inc/contact-form.php';     // Форма контактов
    require get_template_directory() . '/inc/newsletter.php';       // Форма подписки на новости
    require get_template_directory() . '/inc/polylang-strings.php'; // Регистрация строк для Polylang

    // Enqueue scripts and styles
    function kapitan_pub_scripts()
    {
        // Register Swiper for potential use throughout the site
        wp_register_style('swiper-css', 'https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css', [], '10.0.0');
        wp_register_script('swiper-js', 'https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js', [], '10.0.0', true);

        // Register custom component scripts
        wp_register_script('events-slider-js', get_template_directory_uri() . '/assets/js/events-slider.js', ['swiper-js'], '1.0.0', true);

        // Localize script with AJAX URL for all AJAX-powered forms
        wp_localize_script('main', 'kapitan_pub_data', [
            'ajaxurl' => admin_url('admin-ajax.php'),
        ]);
    }
    add_action('wp_enqueue_scripts', 'kapitan_pub_scripts');

    add_action('after_switch_theme', function () {
        wp_cache_flush();
    });

    // Также добавляем очистку кеша при сохранении настроек темы
    add_action('acf/save_post', function ($post_id) {
        if ($post_id === 'options') {
            wp_cache_flush();
        }
    }, 20);

    // Create directory for ACF JSON if it doesn't exist
    add_action('admin_init', function () {
        $acf_json_dir = get_stylesheet_directory() . '/assets/acf-json';

        if (! file_exists($acf_json_dir)) {
            mkdir($acf_json_dir, 0755, true);
        }
    });

    // Simple unified path for ACF JSON files
    add_filter('acf/settings/save_json', function () {
        return get_stylesheet_directory() . '/assets/acf-json';
    });

    // Add path for loading ACF JSON files
    add_filter('acf/settings/load_json', function ($paths) {
        $paths[] = get_stylesheet_directory() . '/assets/acf-json';
        return $paths;
    });

    // Disable ACF's custom field validation which may be causing memory issues
    add_filter('acf/settings/row_index_offset', '__return_zero');

    // Increase admin-ajax.php timeout for ACF
    add_filter('admin_init', function () {
        set_time_limit(120);
    });

    /**
     * =========================================================================
     * Social Link Click Tracking
     * =========================================================================
     */

    // Define the database table name
    global $wpdb;
    define('KAPITANPUB_TRACKING_TABLE', $wpdb->prefix . 'social_link_clicks');

    /**
     * Create the database table on theme activation.
     */
    function kapitanpub_create_tracking_table()
    {
        global $wpdb;
        $table_name      = KAPITANPUB_TRACKING_TABLE;
        $charset_collate = $wpdb->get_charset_collate();

        // Check if table already exists before creating
        if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
            $sql = "CREATE TABLE $table_name (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            click_time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
            link_type varchar(50) NOT NULL,
            target_url varchar(255) DEFAULT '' NOT NULL,
            user_id bigint(20) UNSIGNED DEFAULT 0 NOT NULL,
            ip_address varchar(100) DEFAULT '' NOT NULL,
            user_agent varchar(255) DEFAULT '' NOT NULL,
            PRIMARY KEY  (id)
        ) $charset_collate;";

            require_once ABSPATH . 'wp-admin/includes/upgrade.php';
            dbDelta($sql);
        }
    }
    // Hook into theme activation
    add_action('after_switch_theme', 'kapitanpub_create_tracking_table');

    /**
     * Register REST API endpoint for tracking clicks.
     */
    function kapitanpub_register_tracking_endpoint()
    {
        register_rest_route('kapitanpub/v1', '/track-click', [
            'methods'             => 'POST',
            'callback'            => 'kapitanpub_handle_track_click',
            'permission_callback' => function ($request) {
                // Verify nonce - basic security check
                $nonce = $request->get_header('X-WP-Nonce');
                if (! wp_verify_nonce($nonce, 'wp_rest')) {
                    return new WP_Error('rest_nonce_invalid', __('Nonce is invalid.', 'kapitan-pub'), ['status' => 403]);
                }
                // Allow any user (logged in or not) to hit this endpoint after nonce verification
                return true;
            },
        ]);
    }
    add_action('rest_api_init', 'kapitanpub_register_tracking_endpoint');

    /**
     * Handle the incoming click tracking data via REST API.
     */
    function kapitanpub_handle_track_click(WP_REST_Request $request)
    {
        global $wpdb;
        $table_name = KAPITANPUB_TRACKING_TABLE;

        $params = $request->get_json_params();

        // Sanitize input data
        $link_type  = isset($params['type']) ? sanitize_text_field($params['type']) : '';
        $target_url = isset($params['url']) ? esc_url_raw($params['url']) : ''; // esc_url_raw suitable for DB storage

        // Basic validation
        if (empty($link_type) || empty($target_url)) {
            return new WP_Error('missing_data', __('Missing link type or URL.', 'kapitan-pub'), ['status' => 400]);
        }

        // Whitelist allowed types if necessary (redundant if ACF/footer logic is trusted, but safer)
        $allowed_types = ['facebook', 'instagram', 'tiktok'];
        if (! in_array($link_type, $allowed_types)) {
            return new WP_Error('invalid_type', __('Invalid link type provided.', 'kapitan-pub'), ['status' => 400]);
        }

                                             // Get user data
        $user_id    = get_current_user_id(); // Returns 0 if user is not logged in
        $ip_address = isset($_SERVER['REMOTE_ADDR']) ? sanitize_text_field($_SERVER['REMOTE_ADDR']) : 'Unknown';
        // Consider GDPR implications of storing IP addresses. Anonymization might be required.
        // Example: $ip_address = wp_privacy_anonymize_ip( $ip_address );

        $user_agent = isset($_SERVER['HTTP_USER_AGENT']) ? sanitize_text_field(substr($_SERVER['HTTP_USER_AGENT'], 0, 255)) : 'Unknown'; // Truncate to fit DB

        // Insert data into the database
        $result = $wpdb->insert(
            $table_name,
            [
                'click_time' => current_time('mysql'),
                'link_type'  => $link_type,
                'target_url' => $target_url,
                'user_id'    => $user_id,
                'ip_address' => $ip_address,
                'user_agent' => $user_agent,
            ],
            [
                '%s', // click_time (string format)
                '%s', // link_type
                '%s', // target_url
                '%d', // user_id
                '%s', // ip_address
                '%s', // user_agent
            ]
        );

        if ($result === false) {
            // Log error for debugging: error_log('DB Insert Error: ' . $wpdb->last_error);
            return new WP_Error('db_error', __('Could not save tracking data.', 'kapitan-pub'), ['status' => 500]);
        }

        // Return success response
        return new WP_REST_Response(['success' => true, 'message' => 'Click tracked successfully.'], 200);
    }

    /**
     * Add admin menu page for viewing click statistics.
     */
    function kapitanpub_add_tracking_admin_menu()
    {
        add_menu_page(
            __('Social Clicks', 'kapitan-pub'), // Page title
            __('Social Clicks', 'kapitan-pub'), // Menu title
            'manage_options',                   // Capability required
            'kapitanpub-social-clicks',         // Menu slug
            'kapitanpub_display_tracking_page', // Function to display the page
            'dashicons-chart-bar',              // Icon URL
            30                                  // Position
        );
    }
    add_action('admin_menu', 'kapitanpub_add_tracking_admin_menu');

    /**
     * Display the admin page content.
     */
    function kapitanpub_display_tracking_page()
    {
        global $wpdb;
        $table_name = KAPITANPUB_TRACKING_TABLE;

        // Check user capability
        if (! current_user_can('manage_options')) {
            wp_die(__('You do not have sufficient permissions to access this page.', 'kapitan-pub'));
        }

        // Get total counts per type
        $counts = $wpdb->get_results(
            "SELECT link_type, COUNT(*) as count FROM $table_name GROUP BY link_type",
            ARRAY_A// Return as associative array
        );

        // Get recent clicks (e.g., last 100)
        $recent_clicks = $wpdb->get_results(
            $wpdb->prepare(
                "SELECT * FROM $table_name ORDER BY click_time DESC LIMIT %d",
                100// Limit to 100 recent entries
            ),
            ARRAY_A
        );

    ?>
    <div class="wrap">
        <h1><?php echo esc_html__('Social Link Click Tracking', 'kapitan-pub'); ?></h1>

        <h2><?php echo esc_html__('Total Clicks per Network', 'kapitan-pub'); ?></h2>
        <?php if (! empty($counts)): ?>
            <ul>
                <?php foreach ($counts as $count_data): ?>
                    <li>
                        <strong><?php echo esc_html(ucfirst($count_data['link_type'])); ?>:</strong>
                        <?php echo esc_html($count_data['count']); ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p><?php esc_html_e('No clicks recorded yet.', 'kapitan-pub'); ?></p>
        <?php endif; ?>

        <hr>

        <h2><?php echo esc_html__('Recent Clicks (Last 100)', 'kapitan-pub'); ?></h2>
        <?php if (! empty($recent_clicks)): ?>
            <table class="wp-list-table widefat fixed striped">
                <thead>
                    <tr>
                        <th><?php esc_html_e('Type', 'kapitan-pub'); ?></th>
                        <th><?php esc_html_e('Target URL', 'kapitan-pub'); ?></th>
                        <th><?php esc_html_e('Time', 'kapitan-pub'); ?></th>
                        <th><?php esc_html_e('User', 'kapitan-pub'); ?></th>
                        <th><?php esc_html_e('IP Address', 'kapitan-pub'); ?></th>
                        <th><?php esc_html_e('User Agent', 'kapitan-pub'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($recent_clicks as $click):
                                $user_info = __('Guest', 'kapitan-pub');
                                if ($click['user_id'] > 0) {
                                    $user_data = get_userdata($click['user_id']);
                                    $user_info = $user_data ? esc_html($user_data->display_name) . ' (ID: ' . $click['user_id'] . ')' : __('Unknown User', 'kapitan-pub') . ' (ID: ' . $click['user_id'] . ')';
                                }
                            ?>
	                        <tr>
	                            <td><?php echo esc_html(ucfirst($click['link_type'])); ?></td>
	                            <td><a href="<?php echo esc_url($click['target_url']); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html($click['target_url']); ?></a></td>
	                            <td><?php echo esc_html($click['click_time']); ?></td>
	                            <td><?php echo $user_info; // Already escaped
                                            ?></td>
	                            <td><?php echo esc_html($click['ip_address']); ?></td>
	                            <td><?php echo esc_html($click['user_agent']); ?></td>
	                        </tr>
	                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p><?php esc_html_e('No clicks recorded yet.', 'kapitan-pub'); ?></p>
        <?php endif; ?>

    </div>
<?php
}
