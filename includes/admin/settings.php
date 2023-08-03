<?php

namespace WP_Post_Qrcode\Admin;

if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Settings {
    public function __construct() {

        add_action( 'admin_init', [$this, 'add_section_with_field'] );
    }

    /**
     * Wordpress Option Page New Field Add
     *
     * @return void
     */
    function add_section_with_field() {
        /* Section Add Code */
        add_settings_section( 'post_qrcode_section', __( 'Post Qrcode Setting', 'wp-post-qrcode' ), [$this, 'section_content'], 'general',array(
            'before_section'=> '<div class="wp-post-qrcode">',
            'after_section' => '</div>'
        ));

        /* Add Fields */
        add_settings_field( 'wp-post-qrcode-height', __( 'Post Qrcode Height', 'wp-post-qrcode' ), [$this, 'display_fields'], 'general', 'post_qrcode_section', array(
            'name'      => 'wp-post-qrcode-height',
            'label_for' => 'wp-post-qrcode-height',
        ) );

        add_settings_field( 'wp-post-qrcode-width', __( 'Post Qrcode Width', 'wp-post-qrcode' ), [$this, 'display_fields'], 'general', 'post_qrcode_section', array(
            'name'      => 'wp-post-qrcode-width',
            'label_for' => 'wp-post-qrcode-width',
        ) );

        /* Register Fields */
        register_setting( 'general', 'wp-post-qrcode-height', array(
            'type'              => 'string',
            'sanitize_callback' => 'sanitize_text_field',
        ) );

        register_setting( 'general', 'wp-post-qrcode-width', array(
            'type'              => 'number',
            'sanitize_callback' => 'sanitize_text_field',
        ) );
    }

    /* Section Callback Fucntion */
    function section_content() {
        printf( '<p>%s</p>', __( 'Settings for Posts To QR Plugin', 'wp-post-qrcode' ) );
    }

    /**
     * Field add callback function
     *
     * @param  array  $post_qrcode_fiels
     * @return void
     */
    function display_fields( $post_qrcode_fiels ) {
        $field_name = $post_qrcode_fiels['name'];

        $__option_val = get_option( $field_name );

        $option_value = $__option_val ? intval( $__option_val ) : 185;

        printf( "<input type='number' id='%s' name='%s' value='%s'/>", esc_attr( $field_name ), esc_attr( $field_name ), esc_attr( $option_value ) );
    }
}