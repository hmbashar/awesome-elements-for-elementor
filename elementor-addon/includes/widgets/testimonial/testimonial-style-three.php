<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$unique_id = 'tms3-' . esc_attr( uniqid() );

// Item Count
$item_count_desk   = $settings['aefe_testimonial_item_count']        ? (int) $settings['aefe_testimonial_item_count']        : 1;
$item_count_tab    = $settings['aefe_testimonial_item_count_tablet']  ? (int) $settings['aefe_testimonial_item_count_tablet']  : 1;
$item_count_mobile = $settings['aefe_testimonial_item_count_mobile']  ? (int) $settings['aefe_testimonial_item_count_mobile']  : 1;

// Mouse Drag
$mouse_drag_desk   = $settings['aefe_testimonial_item_mouseDrag']        ? (int) $settings['aefe_testimonial_item_mouseDrag']        : 1;
$mouse_drag_tab    = $settings['aefe_testimonial_item_mouseDrag_tablet']  ? (int) $settings['aefe_testimonial_item_mouseDrag_tablet']  : 1;
$mouse_drag_mobile = $settings['aefe_testimonial_item_mouseDrag_mobile']  ? (int) $settings['aefe_testimonial_item_mouseDrag_mobile']  : 1;

// Nav
$nav_desk   = $settings['aefe_testimonial_slider_nav_switch']        ? (int) $settings['aefe_testimonial_slider_nav_switch']        : 0;
$nav_tab    = $settings['aefe_testimonial_slider_nav_switch_tablet']  ? (int) $settings['aefe_testimonial_slider_nav_switch_tablet']  : 0;
$nav_mobile = $settings['aefe_testimonial_slider_nav_switch_mobile']  ? (int) $settings['aefe_testimonial_slider_nav_switch_mobile']  : 0;

// Dots
$dot_desk   = $settings['aefe_testimonial_slider_dot_switch']        ? (int) $settings['aefe_testimonial_slider_dot_switch']        : 0;
$dot_tab    = $settings['aefe_testimonial_slider_dot_switch_tablet']  ? (int) $settings['aefe_testimonial_slider_dot_switch_tablet']  : 0;
$dot_mobile = $settings['aefe_testimonial_slider_dot_switch_mobile']  ? (int) $settings['aefe_testimonial_slider_dot_switch_mobile']  : 0;

$autoplay  = ( 'yes' === $settings['aefe_testimonial_slider_autoplay'] ) ? 1 : 0;
$aefe_loop = ( 'yes' === $settings['aefe_testimonial_slider_loop'] )     ? 1 : 0;

// Build nav icon HTML safely
ob_start();
\Elementor\Icons_Manager::render_icon( $settings['aefe_testimonial_nav_selected_icon_left'],  [ 'aria-hidden' => 'true' ] );
$nav_icon_left = ob_get_clean();

ob_start();
\Elementor\Icons_Manager::render_icon( $settings['aefe_testimonial_nav_selected_icon_right'], [ 'aria-hidden' => 'true' ] );
$nav_icon_right = ob_get_clean();

$carousel_config = wp_json_encode( [
	'loop'      => (bool) $aefe_loop,
	'autoplay'  => (bool) $autoplay,
	'navLeft'   => $nav_icon_left,
	'navRight'  => $nav_icon_right,
	'autoplayHoverPause' => false,
	'responsive' => [
		'0'    => [ 'items' => $item_count_mobile, 'mouseDrag' => (bool) $mouse_drag_mobile, 'nav' => (bool) $nav_mobile, 'dots' => (bool) $dot_mobile ],
		'600'  => [ 'items' => 2 ],
		'750'  => [ 'items' => $item_count_tab,    'mouseDrag' => (bool) $mouse_drag_tab,    'nav' => (bool) $nav_tab,    'dots' => (bool) $dot_tab ],
		'1000' => [ 'items' => $item_count_desk,   'mouseDrag' => (bool) $mouse_drag_desk,   'nav' => (bool) $nav_desk,   'dots' => (bool) $dot_desk ],
	],
] );
?>

<div class="aefe-tm-3-testimonial-area fix">
	<div class="aefe-tm-3-testimonial fix">
		<div
			class="aefe-tm-3-testimonial-slider owl-carousel fix aefe-owl-carousel"
			id="<?php echo esc_attr( $unique_id ); ?>"
			data-carousel="<?php echo esc_attr( $carousel_config ); ?>"
		>
			<?php if ( ! empty( $settings['aefe_testimonial_slider_list'] ) ) :
				foreach ( $settings['aefe_testimonial_slider_list'] as $testimonial_slider ) : ?>
			<!--Single Testimonial-->
			<div class="aefe-tm-3-single-testimonial">
				<div class="aefe-tm-3-testimonila-text fix">
					<div class="aefe-tm-3-testimonial-icon">
						<i class="fa fa-quote-right"></i>
					</div>
					<?php if ( ! empty( $testimonial_slider['aefe_testimonial_slider_rating'] ) && '0' !== $testimonial_slider['aefe_testimonial_slider_rating'] ) :
						$tst_val = (int) $testimonial_slider['aefe_testimonial_slider_rating'];
					?>
					<!--Rating -->
					<div class="aefe-tms-testimonial-rating aefe-tm-3-single-testimonial-rating">
						<?php for ( $x = 1; $x <= $tst_val; $x++ ) : ?>
							<i class="fa fa-star"></i>
						<?php endfor; ?>
					</div><!--/ Rating -->
					<?php endif; ?>
					<div class="aefe-tm-3-testimonial-message">
						<p><?php echo esc_html( $testimonial_slider['aefe_testimonial_slider_content'] ); ?></p>
					</div>
					<div class="aefe-tm-3-testimonial-client-info fix">
						<div class="aefe-tm-3-testimonial-img">
							<?php if ( ! empty( $testimonial_slider['aefe_testimonial_slider_img']['url'] ) ) : ?>
								<img src="<?php echo esc_url( $testimonial_slider['aefe_testimonial_slider_img']['url'] ); ?>" alt="">
							<?php else : ?>
								<img src="<?php echo esc_url( AEFE_URL ); ?>assets/img/single-team-member.png" alt="">
							<?php endif; ?>
						</div>
						<div class="aefe-tm-3-testi_client_name">
							<h2><?php echo esc_html( $testimonial_slider['aefe_testimonial_slider_title'] ); ?></h2>
							<h3><?php echo esc_html( $testimonial_slider['aefe_testimonial_slider_subtitle'] ); ?></h3>
						</div>
					</div>
				</div>
			</div><!--/ Single Testimonial-->
			<?php endforeach; else : ?>
				<div class="aefe-single-some-review-title fix">
					<h2><a><?php do_action( 'aefe_please_add_testimonial' ); ?></a></h2>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div><!--/ Testimonial Area-->
