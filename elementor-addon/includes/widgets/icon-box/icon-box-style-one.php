<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?>

<div class="aefe-icon-box-de-itm">
    <div class="aefe-icon-box-design-item">
        <div class="aefe-icon-box-design-icon">
            <?php \Elementor\Icons_Manager::render_icon( $settings['aefe_icon_box_icon'], [ 'aria-hidden' => 'true' ] ); ?>
        </div>
        <?php if(!empty($settings['aefe_icon_box_title'])) : ?>
            <h4><?php echo esc_html($settings['aefe_icon_box_title']); ?></h4>
        <?php endif; ?>

        <?php if(!empty($settings['aefe_icon_box_content'])) : ?>
            <p><?php echo esc_html($settings['aefe_icon_box_content']); ?></p>
        <?php endif; ?>
    </div>
</div><!-- design-item end -->