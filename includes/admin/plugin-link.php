<?php

namespace WP_Post_Qrcode\Admin;

if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Plugin_Link {
    public function __construct() {

        /*
         * PLugin Action link Add hook
         */
        add_filter( 'plugin_action_links_' . WP_Post_Qrcode_Plugin_Base, [$this, 'Plugin_new_link'] );

        /*
         * Plugin Row Link Add Hook
         */
        add_filter( 'plugin_row_meta', [$this, 'plugin_row_meta'], 10, 2 );
    }

    /**
     * @param  $links
     * @return mixed
     */
    public function Plugin_new_link( $links ) {
        $settings_link = sprintf( '<a href="%1$s"> %2$s </a>',
            admin_url( 'options-general.php' ),
            esc_html__( 'Settings', 'wp-post-qrcode' ) );

        array_unshift( $links, $settings_link );

        return $links;
    }

    /**
     * Plugin row meta.
     *
     * @param  array  $plugin_meta
     * @param  string $plugin_file    .
     * @return array  An array of plugin row meta links.
     */
    public function plugin_row_meta( $plugin_meta, $plugin_file ) {
        if ( WP_Post_Qrcode_Plugin_Base === $plugin_file ) {
            $row_meta = [
                'docs'  => '<a href="https://github.com/mdforiduddin" target="_blank">' . esc_html__( 'Documentation', 'wp-post-qrcode' ) . '</a>',
                'video' => '<a href="https://github.com/mdforiduddin/video" target="_blank">' . esc_html__( 'Video Tutorials', 'wp-post-qrcode' ) . '</a>',
            ];

            $plugin_meta = array_merge( $plugin_meta, $row_meta );
        }

        return $plugin_meta;
    }
}