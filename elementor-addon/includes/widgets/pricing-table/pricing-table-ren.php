<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

	// package url checked
    if ( ! empty( $settings['pacakge_button_url']['url'] ) ) {
        $this->add_link_attributes( 'pacakge_button_url', $settings['pacakge_button_url'] );
    }


    //Check Template Style and add extra class for style two
    if(!empty($settings['aefe-pt-style']) && $settings['aefe-pt-style'] == 'style-two') {
        $pricing_table_style = 'aefe-pt-style-two';
        $pricing_table_buton_style = 'aefe-pt-st-two-b';
    }else {
        $pricing_table_style = NULL;
        $pricing_table_buton_style = NULL;
    }
    
    $h_bg_color = $settings['aefe-pt-header-background-color'];


    // Header Background shape/image bases on selected style
    if('style-one' == $settings['aefe-pt-style']) {
        $h_bg_image = $settings['aefe-pt-background-image']['url'];
    }elseif('style-two' == $settings['aefe-pt-style']) {
        $h_bg_image = $settings['aefe-pt-background-image-two']['url'];
    }

?>

    <!--Single Price-->
    <div class="<?php echo esc_attr($pricing_table_style); ?> aefe-pt-single-pricing-table">
        <div class="aefe-pt-single-pricing-table-header"
        
            <?php if( 'color' == $settings['aefe_pricing_tb_background_type']) : ?> style="background:<?php echo esc_attr($h_bg_color); ?>"

            <?php elseif( 'Image' == $settings['aefe_pricing_tb_background_type']) : ?> style="background-image:url(<?php echo esc_url($h_bg_image); ?>)"
            
            <?php endif; ?>

        >
            <h2><?php echo esc_html($settings['package_name']);?></h2>
        </div>
        <div class="aefe-pt-single-pricing-price">
            <h2><sup><?php echo esc_html($settings['package_price_currency']);?></sup><?php echo esc_html($settings['package_price']);?><span><?php echo esc_html($settings['package_duration']);?></span></h2>
        </div>
        <div class="aefe-pt-single-pricing-content">
            <?php echo wp_kses($settings['package_content'],  wp_kses_allowed_html('post'));?>
        </div>
        <div class="<?php echo esc_attr($pricing_table_buton_style); ?> aefe-pt-single-pricing-buy">
            <a <?php echo $this->get_render_attribute_string( 'pacakge_button_url' ); ?>><?php echo esc_html($settings['pacakge_button_text']);?></a>
        </div>
    </div><!--/ Single Price-->



