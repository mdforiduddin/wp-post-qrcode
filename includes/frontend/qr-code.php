<?php

namespace WP_Post_Qrcode\Frontend;

if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class QR_Code {
    public function __construct() {

        add_action( 'the_content', array( $this, 'wp_post_qrcode_render' ) );
    }

    /**
     * Post To Qrcode Function
     *
     * @param  $content
     * @return mixed
     */
    public function wp_post_qrcode_render( $content ) {
        $current_post_id    = get_the_ID();
        $current_post_url   = urldecode( get_the_permalink( $current_post_id ) );
        $current_post_title = get_the_title( $current_post_id );
        $current_post_type  = get_post_type( $current_post_id );

        /* Post Type Chack */
        $included_post_types = apply_filters( 'wp-post-qrcode-included-post-types', array( 'post' ) );

        if ( !in_array( $current_post_type, $included_post_types ) ) {
            return $content;
        }

        /* User Custom Dimension Add Filter */
        $_height = get_option( 'wp-post-qrcode-height' );
        $height  = $_height ? intval( $_height ) : 185;

        $_width = get_option( 'wp-post-qrcode-width' );
        $width  = $_width ? intval( $_width ) : 185;

        $dimension = apply_filters( 'wp-post-qrcode-custom-dimension', "{$width}x{$height}" );

        /* Image Add Custom Attributes */
        $attributes = apply_filters( 'wp-post-qrcode-add-attributes', '' );

        $image_src = sprintf( 'https://api.qrserver.com/v1/create-qr-code/?size=%s&data=%s', $dimension, $current_post_url );

        $is_visible = apply_filters( 'wp-post-qrcode-is-visible', true );

        if ( $is_visible ) {
            $content .= sprintf( '<div class="wp-post-qrcode"> <img %1$s src="%2$s" alt="%3$s"></div>', esc_attr( $attributes ), $image_src, $current_post_title );
        }

        return $content;
    }
}
