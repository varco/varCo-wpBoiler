<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 * @package WordPress
 */

define( 'DISALLOW_FILE_EDIT', true );
define('DB_CHARSET', 'utf8');
define('DB_COLLATE', '');
define('WP_MEMORY_LIMIT', '64M'); //Increase memory limit to 64MB
define(SINGLE_PATH, TEMPLATEPATH . '/templates-singles');

$table_prefix = 'wp_';

// ** ENVIRONMENT declaration and configurations ** //

    $server = strtolower( $_SERVER['SERVER_NAME'] );
    $environment = 'production';
    $path_array = explode("/", __FILE__);

    $environments = array(
        "sand.dev" => "development",
        "staging.*.com" => "staging",
        "www.*.com" => "production"
    );

    foreach ($environments as $key => $value) {
        if($key == $server) $environment = $value;
    }

    define('ENVIRONMENT', $environment);

    //define database connection settings
    if(defined('ENVIRONMENT')) {
        switch(ENVIRONMENT) {
        case 'development':

            define( 'WP_CONTENT_URL', 'http://*.dev/wp-content' );
            define( 'WP_CONTENT_DIR', '/Users/' . $path_array[2] . '/Sites/GoCactus/*/deploy/wp-content' );

            define('DB_HOST', 'localhost');
            define('DB_NAME', 'database_development');
            define('DB_USER', 'root');
            define('DB_PASSWORD', 'root');

            define('WP_DEBUG', false);
            define('WP_DEBUG_LOG', false);
            define('WP_DEBUG_DISPLAY', true);
            @ini_set('display_errors', true);

            break;
        case 'staging':

            define( 'WP_CONTENT_URL', 'http://staging.*.com/wp-content' );
            define( 'WP_CONTENT_DIR', '/web/staging.*.com/wp-content' );

            define('DB_HOST', 'localhost');
            define('DB_NAME', 'database_staging');
            define('DB_USER', '');
            define('DB_PASSWORD', '');

            define('WP_DEBUG', false);
            define('WP_DEBUG_LOG', false);
            define('WP_DEBUG_DISPLAY', true);
            @ini_set('display_errors', true);
            break;

        case 'production':

            define( 'WP_CONTENT_URL', 'http://www.*.com/wp-content' );
            define( 'WP_CONTENT_DIR', '/web/www.*.com/wp-content' );

            define('DB_HOST', 'localhost');
            define('DB_NAME', 'database_prod');
            define('DB_USER', '');
            define('DB_PASSWORD', '');

            define('WP_DEBUG', false);
            define('WP_DEBUG_LOG', true);
            define('WP_DEBUG_DISPLAY', false);
            @ini_set('display_errors', false);
            break;
        }
    }

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'put your unique phrase here');
define('SECURE_AUTH_KEY',  'put your unique phrase here');
define('LOGGED_IN_KEY',    'put your unique phrase here');
define('NONCE_KEY',        'put your unique phrase here');
define('AUTH_SALT',        'put your unique phrase here');
define('SECURE_AUTH_SALT', 'put your unique phrase here');
define('LOGGED_IN_SALT',   'put your unique phrase here');
define('NONCE_SALT',       'put your unique phrase here');

/**#@-*/

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
    define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
