<?php

namespace WP_Post_Qrcode;

require WP_Post_Qrcode_Path . '/includes/frontend/qr-code.php';

if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Assets {
    public function __construct() {
        add_action( 'admin_enqueue_scripts', [$this, 'admin_enqueue_scripts'] );
    }

    /* PLugin Assets Load */
    /**
     * @param $screen
     */
    public function admin_enqueue_scripts( $screen ) {

        $current_screen = get_current_screen();

        /* Admin Screen Post type Check */
        $post_type_check = $current_screen->post_type;

        if ( 'options-general.php' === $screen ) {
            /* Scrip Enqueue */
            wp_enqueue_script( 'wp-post-qrcode-script', WP_Post_Qrcode_Assets . '/js/main.js', array(), WP_Post_Qrcode_Version, true );
            /* Style Enqueue */
            wp_enqueue_style( 'wp-post-qrcode-style', WP_Post_Qrcode_Assets . '/css/style.css', array(), WP_Post_Qrcode_Version );
            $date = array(
                'site_url' => site_url(),
            );
            wp_localize_script( 'wp-post-qrcode-script', 'wp_post_qrcode', $date );
        }
    }
}