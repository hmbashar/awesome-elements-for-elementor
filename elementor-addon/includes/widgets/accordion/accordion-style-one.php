<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
$count = 01;

?>
<div class="aefe-faq-1-freeask-accordian-area">
	<div class="aefe-faq-1-accordion_area " id="aefe_accordion">
        <?php if(!empty($settings['aefe_accordion_list'])) : foreach($settings['aefe_accordion_list'] as $aefe_accordion_one) : ?>
        <!--Single Accordion-->
        <div class="aefe-faq-1-single_accordion ">
            <div class="aefe-faq-1-accordion_hearder fix">
                <h2><span><?php echo esc_html($count); ?>.</span>  <?php echo esc_html($aefe_accordion_one['aefe_accordion_title']);?></h2>
                <span class="aefe-faq-1-accordion_icon">
                    <?php if(!empty($settings['aefe_accordion_icon_close'])) : ?>                        
                        <span class="aefe-acc1-close"><?php \Elementor\Icons_Manager::render_icon( $settings['aefe_accordion_icon_close'], [ 'aria-hidden' => 'true' ] ); ?></span>
                    <?php else : ?>
                        <i class="fa fa-plus"></i>
                    <?php endif; ?>
                    
                    <?php if(!empty($settings['aefe_accordion_icon_open'])) : ?>         
                        <span class="aefe-acc1-open"><?php \Elementor\Icons_Manager::render_icon( $settings['aefe_accordion_icon_open'], [ 'aria-hidden' => 'true' ] ); ?></span>
                    <?php else : ?>
                        <i class="fa fa-minus"></i>
                    <?php endif; ?>

                </span>
            </div>
            <div class="aefe-faq-1-accordion_content fix">
                <?php echo wp_kses_post( $aefe_accordion_one['aefe_accordion_content'] ); ?>
            </div>
        </div>	<!--/ Single Accordion-->
      <?php $count++; endforeach; endif; ?>

    </div>
</div>