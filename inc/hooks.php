<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// Testimonial Slider fallback text
function aefe_please_add_testimonial() {
	esc_html_e( 'Please add testimonial', AEFE_TEXTDOMAIN );
}
add_action( 'aefe_please_add_testimonial', 'aefe_please_add_testimonial' );
