<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$unique_id = 'tms1-' . esc_attr( uniqid() );

// Item Count
$item_count_desk   = isset( $settings['aefe_testimonial_item_count'] )        ? (int) $settings['aefe_testimonial_item_count']        : 3;
$item_count_tab    = isset( $settings['aefe_testimonial_item_count_tablet'] )  ? (int) $settings['aefe_testimonial_item_count_tablet']  : 2;
$item_count_mobile = isset( $settings['aefe_testimonial_item_count_mobile'] )  ? (int) $settings['aefe_testimonial_item_count_mobile']  : 1;

// Item Gap
$item_gap_desk   = isset( $settings['aefe_testimonial_item_gap'] )        ? (int) $settings['aefe_testimonial_item_gap']        : 0;
$item_gap_tab    = isset( $settings['aefe_testimonial_item_gap_tablet'] )  ? (int) $settings['aefe_testimonial_item_gap_tablet']  : 0;
$item_gap_mobile = isset( $settings['aefe_testimonial_item_gap_mobile'] )  ? (int) $settings['aefe_testimonial_item_gap_mobile']  : 0;

// Mouse Drag
$mouse_drag_desk   = isset( $settings['aefe_testimonial_item_mouseDrag'] )        ? (int) $settings['aefe_testimonial_item_mouseDrag']        : 1;
$mouse_drag_tab    = isset( $settings['aefe_testimonial_item_mouseDrag_tablet'] )  ? (int) $settings['aefe_testimonial_item_mouseDrag_tablet']  : 1;
$mouse_drag_mobile = isset( $settings['aefe_testimonial_item_mouseDrag_mobile'] )  ? (int) $settings['aefe_testimonial_item_mouseDrag_mobile']  : 1;

// Nav
$nav_desk   = isset( $settings['aefe_testimonial_slider_nav_switch'] )        ? (int) $settings['aefe_testimonial_slider_nav_switch']        : 0;
$nav_tab    = isset( $settings['aefe_testimonial_slider_nav_switch_tablet'] )  ? (int) $settings['aefe_testimonial_slider_nav_switch_tablet']  : 0;
$nav_mobile = isset( $settings['aefe_testimonial_slider_nav_switch_mobile'] )  ? (int) $settings['aefe_testimonial_slider_nav_switch_mobile']  : 0;

// Dots
$dot_desk   = isset( $settings['aefe_testimonial_slider_dot_switch'] )        ? (int) $settings['aefe_testimonial_slider_dot_switch']        : 0;
$dot_tab    = isset( $settings['aefe_testimonial_slider_dot_switch_tablet'] )  ? (int) $settings['aefe_testimonial_slider_dot_switch_tablet']  : 0;
$dot_mobile = isset( $settings['aefe_testimonial_slider_dot_switch_mobile'] )  ? (int) $settings['aefe_testimonial_slider_dot_switch_mobile']  : 0;

$autoplay  = ( 'yes' === $settings['aefe_testimonial_slider_autoplay'] ) ? 1 : 0;
$aefe_loop = ( 'yes' === $settings['aefe_testimonial_slider_loop'] )     ? 1 : 0;

// Build nav icon HTML safely
ob_start();
\Elementor\Icons_Manager::render_icon( $settings['aefe_testimonial_nav_selected_icon_left'],  [ 'aria-hidden' => 'true' ] );
$nav_icon_left = ob_get_clean();

ob_start();
\Elementor\Icons_Manager::render_icon( $settings['aefe_testimonial_nav_selected_icon_right'], [ 'aria-hidden' => 'true' ] );
$nav_icon_right = ob_get_clean();

// Pass carousel settings to JS via data attributes (no inline script needed)
$carousel_config = wp_json_encode( [
	'loop'      => (bool) $aefe_loop,
	'autoplay'  => (bool) $autoplay,
	'navLeft'   => $nav_icon_left,
	'navRight'  => $nav_icon_right,
	'autoplayHoverPause' => false,
	'responsive' => [
		'0'    => [ 'items' => $item_count_mobile, 'margin' => $item_gap_mobile, 'mouseDrag' => (bool) $mouse_drag_mobile, 'nav' => (bool) $nav_mobile,  'dots' => (bool) $dot_mobile ],
		'600'  => [ 'items' => 2 ],
		'750'  => [ 'items' => $item_count_tab,    'margin' => $item_gap_tab,    'mouseDrag' => (bool) $mouse_drag_tab,    'nav' => (bool) $nav_tab,     'dots' => (bool) $dot_tab ],
		'1000' => [ 'items' => $item_count_desk,   'margin' => $item_gap_desk,   'mouseDrag' => (bool) $mouse_drag_desk,   'nav' => (bool) $nav_desk,    'dots' => (bool) $dot_desk ],
	],
] );
?>

<div class="aefe-some-review-contents-area fix">
	<div
		class="aefe-some-review-content-slide fix owl-carousel aefe-owl-carousel"
		id="<?php echo esc_attr( $unique_id ); ?>"
		data-carousel="<?php echo esc_attr( $carousel_config ); ?>"
	>
		<?php if ( ! empty( $settings['aefe_testimonial_slider_list'] ) ) :
			foreach ( $settings['aefe_testimonial_slider_list'] as $testimonial_slider ) :

				if ( ! empty( $testimonial_slider['aefe_testimonial_slider_fb_url']['url'] ) ) {
					$this->add_link_attributes( 'aefe_testimonial_slider_fb_url', $testimonial_slider['aefe_testimonial_slider_fb_url'] );
				}
				if ( ! empty( $testimonial_slider['aefe_testimonial_slider_tw_url']['url'] ) ) {
					$this->add_link_attributes( 'aefe_testimonial_slider_tw_url', $testimonial_slider['aefe_testimonial_slider_tw_url'] );
				}
				if ( ! empty( $testimonial_slider['aefe_testimonial_slider_linkd_url']['url'] ) ) {
					$this->add_link_attributes( 'aefe_testimonial_slider_linkd_url', $testimonial_slider['aefe_testimonial_slider_linkd_url'] );
				}
				if ( ! empty( $testimonial_slider['aefe_testimonial_slider_drib_url']['url'] ) ) {
					$this->add_link_attributes( 'aefe_testimonial_slider_drib_url', $testimonial_slider['aefe_testimonial_slider_drib_url'] );
				}
		?>
		<!--Single Some Review -->
		<div class="aefe-single-some-review">
			<div class="aefe-single-some-review-img">
				<?php if ( ! empty( $testimonial_slider['aefe_testimonial_slider_img']['url'] ) ) : ?>
					<img src="<?php echo esc_url( $testimonial_slider['aefe_testimonial_slider_img']['url'] ); ?>" alt="">
				<?php else : ?>
					<img src="<?php echo esc_url( AEFE_URL ); ?>assets/img/single-team-member.png" alt="">
				<?php endif; ?>
			</div>
			<div class="aefe-single-some-review-title fix">
				<h2><a><?php echo esc_html( $testimonial_slider['aefe_testimonial_slider_title'] ); ?></a></h2>
				<h4><?php echo esc_html( $testimonial_slider['aefe_testimonial_slider_subtitle'] ); ?></h4>
				<?php if ( ! empty( $testimonial_slider['aefe_testimonial_slider_rating'] ) && '0' !== $testimonial_slider['aefe_testimonial_slider_rating'] ) :
					$tst_val = (int) $testimonial_slider['aefe_testimonial_slider_rating'];
				?>
					<div class="aefe-tms-testimonial-rating">
						<?php for ( $x = 1; $x <= $tst_val; $x++ ) : ?>
							<i class="fa fa-star"></i>
						<?php endfor; ?>
					</div>
				<?php endif; ?>
			</div>
			<div class="aefe-single-some-review-content fix">
				<p><?php echo esc_html( $testimonial_slider['aefe_testimonial_slider_content'] ); ?></p>
			</div>
			<div class="aefe-single-some-review-social fix">
				<a <?php echo $this->get_render_attribute_string( 'aefe_testimonial_slider_fb_url' ); ?>><i class="fa fa-facebook"></i></a>
				<a <?php echo $this->get_render_attribute_string( 'aefe_testimonial_slider_tw_url' ); ?>><i class="fa fa-twitter"></i></a>
				<a <?php echo $this->get_render_attribute_string( 'aefe_testimonial_slider_linkd_url' ); ?>><i class="fa fa-linkedin"></i></a>
				<a <?php echo $this->get_render_attribute_string( 'aefe_testimonial_slider_drib_url' ); ?>><i class="fa fa-dribbble"></i></a>
			</div>
		</div><!--/ Single Some Review -->
		<?php endforeach; else : ?>
			<div class="aefe-single-some-review-title fix">
				<h2><a><?php do_action( 'aefe_please_add_testimonial' ); ?></a></h2>
			</div>
		<?php endif; ?>
	</div>
</div>
