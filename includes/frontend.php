<?php

namespace WP_Post_Qrcode;

require WP_Post_Qrcode_Path . '/includes/frontend/qr-code.php';

if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Frontend {
    public function __construct() {

        new Frontend\QR_Code();
    }
}