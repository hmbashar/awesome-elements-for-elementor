<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


	
		?>
<div class="aefe-tm-sth-our-team-content-area fix owl-carousel">
		<?php 
			if(!empty($settings['aefe-tm-slider-list'])) : foreach($settings['aefe-tm-slider-list'] as $aefe_teammember_slider) :

				//for twitter url
				if ( ! empty( $aefe_teammember_slider['aefe-tm-twitter']['url'] ) ) {
					$this->add_link_attributes( 'aefe-tm-twitter', $aefe_teammember_slider['aefe-tm-twitter'] );
				}

				//for facebook url
				if ( ! empty( $aefe_teammember_slider['aefe-tm-facebook']['url'] ) ) {
					$this->add_link_attributes( 'aefe-tm-facebook', $aefe_teammember_slider['aefe-tm-facebook'] );
				}

				//for linkedin url
				if ( ! empty( $aefe_teammember_slider['aefe-tm-linkedIn']['url'] ) ) {
					$this->add_link_attributes( 'aefe-tm-linkedIn', $aefe_teammember_slider['aefe-tm-linkedIn'] );
				}
		?>
		<!--single Team member-->
		<div class="aefe-tm-sth-single-team-member floatleft">
			<!--Team Member Header-->
			<div class="aefe-tm-sth-team-member-header"></div><!--/ Team Member Header-->
			<div class="aefe-tm-sth-team-member-picture">
				<?php if(!empty($aefe_teammember_slider['aefe-tm-member-picture']['url'])) : ?>
					<a><img src="<?php echo esc_url($aefe_teammember_slider['aefe-tm-member-picture']['url']); ?>" alt="" /></a>
				<?php else : ?>
					<a><img src="<?php echo esc_url( AEFE_URL ); ?>assets/img/single-team-member-1.png" alt="" /></a>
				<?php endif; ?>
			</div>
			<!--Team Name-->
			<div class="aefe-tm-sth-team-member-name">
				<h2><?php echo esc_html($aefe_teammember_slider['aefe-tm-name']); ?></h2>
				<h3><?php echo esc_html($aefe_teammember_slider['aefe-tm-subtitle']); ?></h3>
			</div><!--/ Team Name-->
			<div class="aefe-tm-sth-team-about">
				<p><?php echo esc_html($aefe_teammember_slider['aefe-tm-member-bio']); ?></p>
			</div>
			<div class="aefe-tm-sth-team-socials-profile">

				<?php if(!empty($aefe_teammember_slider['aefe-tm-twitter'])) : ?>
					<a <?php echo $this->get_render_attribute_string( 'aefe-tm-twitter' ); ?>><i class="fa fa-twitter"></i></a>
				<?php endif; ?>
				
				<?php if(!empty($aefe_teammember_slider['aefe-tm-facebook'])) : ?>
					<a <?php echo $this->get_render_attribute_string( 'aefe-tm-facebook' ); ?>><i class="fa fa-facebook"></i></a>
				<?php endif; ?>

				<?php if(!empty($aefe_teammember_slider['aefe-tm-linkedIn'])) : ?>
					<a <?php echo $this->get_render_attribute_string( 'aefe-tm-linkedIn' ); ?>><i class="fa fa-linkedin"></i></a>
				<?php endif; ?>
			</div>
		</div><!--/ single Team member-->
		<?php endforeach; else : ?>
			<!--Team Name-->
			<div class="aefe-tm-sth-team-member-name">
				<h2><?php esc_html_e( 'Please add your member list', AEFE_TEXTDOMAIN ); ?></h2>
			</div><!--/ Team Name-->
		<?php endif; ?>
	</div>
