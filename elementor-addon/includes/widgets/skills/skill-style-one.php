<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
if(!empty($settings['aefe_skills_template_style']) && 'aefe_skill_style_one' == $settings['aefe_skills_template_style']) :

	
?>

<div class="aefe_single_skills">
    <div class="aefe_skill_icon">
        <a><img src="<?php echo esc_url( $settings['aefe-skills-logo']['url']); ?>" alt=""></a>
    </div>
    <div class="aefe_skill_title">
        <h3><?php echo esc_html($settings['aefe-skills-title']); ?></h3>
        <div class="aefe_skill_rate">
            <p><?php echo esc_html($settings['aefe-skills-subtitle']); ?></p>
            <div class="aefe_skill_barfiller" data-perc="<?php echo esc_attr($settings['aefe-skills-percentage']); ?>%">
                <div class="aefe_skill_tipWrap" >
                    <span class="aefe_skill_tip"><?php echo esc_html($settings['aefe-skills-percentage']); ?>%</span>
                </div>
                <span class="aefe_skill_fill aefe-skills-skill"></span>
            </div>
        </div>
    </div>
    <div class="aefe_skill_text">
        <p><?php echo esc_html($settings['aefe-skills-content']);?></p>
    </div>
</div>

<?php endif; ?>