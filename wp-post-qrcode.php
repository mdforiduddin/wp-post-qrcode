<?php
/**
 * Plugin Name: WordPress Post QR Code
 * Plugin URI: https://bdteamwork.com
 * Description: Easily convert WordPress post URLs to QR codes
 * Version: 1.0.0
 * Author: Md Forid Uddin
 * Author URI: https://bdteamwork.com
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: wp-post-qrcode
 * Domain Path: /languages
 */

if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Main plugin class
 *
 * @author   Md Forid Uddin
 */
final class WP_Post_Qrcode {

    /**
     * Plugin version
     *
     * @var string
     */
    const version = '1.0.0';

    /**
     * Class Constructor
     */
    private function __construct() {

        $this->define_constants();

        register_activation_hook( __FILE__, [$this, 'activate'] );

        add_action( 'plugin_loaded', [$this, 'init_plugin'] );
    }

    /**
     * Initiatizes a singleton instance
     *
     * @return /WP_Post_Qrcode
     */
    public static function init() {

        /**
         * @var mixed
         */
        static $instance = false;

        if ( !$instance ) {
            $instance = new self();
        }

        return $instance;
    }

    /**
     * Define the required plugin constants
     *
     * @return void
     */
    public function define_constants() {
        define( 'WP_Post_Qrcode_Version', self::version );
        define( 'WP_Post_Qrcode_File', __FILE__ );
        define( 'WP_Post_Qrcode_Path', __DIR__ );
        define( 'WP_Post_Qrcode_Url', plugins_url( '', WP_Post_Qrcode_File ) );
        define( 'WP_Post_Qrcode_Assets', WP_Post_Qrcode_Url . '/assets' );
        define( 'WP_Post_Qrcode_Plugin_Base', plugin_basename( WP_Post_Qrcode_File ) );
    }

    /**
     * Initialize the plugin
     *
     * @return void
     */
    public function init_plugin() {

        load_plugin_textdomain( 'wp-post-qrcode', false, WP_Post_Qrcode_Url . '/languages' );

        if ( is_admin() ) {
            if ( file_exists( WP_Post_Qrcode_Path . '/includes/admin.php' ) ) {
                require WP_Post_Qrcode_Path . '/includes/admin.php';

                new WP_Post_Qrcode\Admin();
            }
        } else {

            if ( file_exists( WP_Post_Qrcode_Path . '/includes/frontend.php' ) ) {
                require WP_Post_Qrcode_Path . '/includes/frontend.php';

                new WP_Post_Qrcode\Frontend();
            }
        }

        if ( file_exists( WP_Post_Qrcode_Path . '/includes/assets.php' ) ) {
            require WP_Post_Qrcode_Path . '/includes/assets.php';

            new WP_Post_Qrcode\Assets();
        }
    }

    /**
     * Plugin Activation Function
     *
     * @return void
     */
    public function activate() {
    }
}

/**
 * Initializes the main plugin
 *
 * @return /WP_Post_Qrcode
 */
function WP_Post_Qrcode() {

    return WP_Post_Qrcode::init();
}

// kick-off the plugin
WP_Post_Qrcode();
