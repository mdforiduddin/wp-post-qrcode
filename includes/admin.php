<?php

namespace WP_Post_Qrcode;

require WP_Post_Qrcode_Path . '/includes/admin/settings.php';

require WP_Post_Qrcode_Path . '/includes/admin/plugin-link.php';

if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Admin {
    public function __construct() {

        new Admin\Settings();

        new Admin\Plugin_Link();
    }
}