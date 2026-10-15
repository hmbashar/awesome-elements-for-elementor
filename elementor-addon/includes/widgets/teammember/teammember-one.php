<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
		/*-------------------------------------------- 
			Repeater Widget Data Display
		-------------------------------------------*/

		if(!empty($settings['aefe-tm-repeater-single']) && $settings['aefe-tm-repeater-single'] === 'slider') :
		?>

	
	       <!-- Our Talent Team Area-->
        <section class="aefe-tm-our-talent-team-area fix">
           	<div class="aefe-tm-our-talent-team column section-margin">
               <!--Our Talent Team Bottom/Content-->
               <div class="aefe-tm-ourtalent-team-bottom">
                    <div class="aefe-tm-our-talent-slider-content owl-carousel">

						<?php 
							if(!empty($settings['aefe-tm-slider-list'])) :
							
								foreach($settings['aefe-tm-slider-list'] as $team_member_slider) :

									// check if member image has set.
									if(!empty($team_member_slider['aefe-tm-member-picture']['url'])) {
										$team_img = $team_member_slider['aefe-tm-member-picture']['url'];
									}else {
										$team_img = esc_url( AEFE_URL ) . 'assets/img/single-team-member-1.png'; // fallback placeholder image
									}	
									
									// Facebook URL Field Checked
									if ( ! empty( $team_member_slider['aefe-tm-facebook']['url'] ) ) {
										$this->add_link_attributes( 'aefe-tm-facebook', $team_member_slider['aefe-tm-facebook'] );
									}
							
									
									// Twitter URL Field Checked
									if ( ! empty( $team_member_slider['aefe-tm-twitter']['url'] ) ) {
										$this->add_link_attributes( 'aefe-tm-twitter', $team_member_slider['aefe-tm-twitter'] );
									}
							
						?>
							<!--Single Team Member-->
							<div class="aefe-tm-single-team-member elementor-repeater-item-<?php echo esc_attr($team_member_slider['_id']); ?>">
								<div class="aefe-tm-single-team-member-picture">
									<a><img src="<?php echo esc_url($team_img); ?>" alt="<?php echo esc_html($team_member_slider['aefe-tm-name']); ?>"></a>
								</div>
								<div class="aefe-tm-single-team-member-name">
									<h2><a><?php echo esc_html($team_member_slider['aefe-tm-name']); ?></a></h2>
									<h3><?php echo esc_html($team_member_slider['aefe-tm-subtitle']); ?></h3>
								</div>
								<div class="aefe-tm-single-team-member-social">
									<a <?php echo $this->get_render_attribute_string( 'aefe-tm-facebook' ); ?> ><i class="fab fa-facebook-f"></i></a>
									<a <?php echo $this->get_render_attribute_string( 'aefe-tm-twitter' ); ?> ><i class="fab fa-twitter"></i></a>
								</div>
							</div><!--/ Single Team Member-->
							
						<?php endforeach; endif; ?>

                    </div>
               </div><!--/ Our Talent Team Bottom/Content-->
           </div>
       </section><!--/ Our Talent Team Area-->

	   <!-------------------------------------------- 
			Single Widget Data Display
		------------------------------------------->
	<?php else : 
		
			// check if member image has set.
			if(!empty($settings['aefe-tm-member-picture']['url'])) {
				$team_single_img = $settings['aefe-tm-member-picture']['url'];
			}else {
				$team_single_img = esc_url( AEFE_URL ) . 'assets/img/single-team-member-1.png'; // fallback placeholder image
			}	
			
			// Facebook URL Field Checked
			if ( ! empty( $settings['aefe-tm-facebook']['url'] ) ) {
				$this->add_link_attributes( 'aefe-tm-facebook', $settings['aefe-tm-facebook'] );
			}
	
			
			// Twitter URL Field Checked
			if ( ! empty( $settings['aefe-tm-twitter']['url'] ) ) {
				$this->add_link_attributes( 'aefe-tm-twitter', $settings['aefe-tm-twitter'] );
			}		

		?>

	<!--Single Team Member-->
	<div class="aefe-tm-single-team-member">
		<div class="aefe-tm-single-team-member-picture">
			<a><img src="<?php echo esc_url($team_single_img); ?>" alt="<?php echo esc_html($settings['aefe-tm-name']); ?>"></a>
		</div>
		<div class="aefe-tm-single-team-member-name">
			<h2><a><?php echo esc_html($settings['aefe-tm-name']); ?></a></h2>
			<h3><?php echo esc_html($settings['aefe-tm-subtitle']); ?></h3>
		</div>
		<div class="aefe-tm-single-team-member-social">
			<a <?php echo $this->get_render_attribute_string( 'aefe-tm-facebook' ); ?> ><i class="fab fa-facebook-f"></i></a>
			<a <?php echo $this->get_render_attribute_string( 'aefe-tm-twitter' ); ?> ><i class="fab fa-twitter"></i></a>
		</div>
	</div><!--/ Single Team Member-->

	<?php endif; ?>

