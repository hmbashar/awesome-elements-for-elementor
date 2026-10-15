<?php
namespace AEFE_ELEMENTOR\AEFETestimonialSlider;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor List Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class AEFE_Testimonial_Slider extends \Elementor\Widget_Base {

	 
	/**
	 * Get widget name.
	 *
	 * Retrieve list widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'aefe-testimonial';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve list widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Testimonial Slider', AEFE_TEXTDOMAIN );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve list widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-review';
	}

	/**
	 * Get custom help URL.
	 *
	 * Retrieve a URL where the user can get more information about the widget.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget help URL.
	 */
	public function get_custom_help_url() {
		return 'https://developers.elementor.com/docs/widgets/';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the list widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'aefe-category' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the list widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return [ 'testimonial', 'feedback', 'reviews' ];
	}

	public function get_style_depends() {
		return [ 'aefe-owlcarousel', 'aefe-main', 'aefe-responsive' ];
	}

	public function get_script_depends() {
		return [ 'aefe-owlcarousel', 'aefe-main' ];
	}

	/**
	 * Register list widget controls.
	 *
	 * Add input fields to allow the user to customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {
	
      
        $this->start_controls_section(
			'aefe-testimonial-slider-style-section',
			[
				'label' => esc_html__( 'Style', AEFE_TEXTDOMAIN ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,				
			]
		);
		$this->add_control(
			'aefe_testimonial_slider_style',
			[
				'label' => esc_html__( 'Style', AEFE_TEXTDOMAIN),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'testm-style-one',
				'options' => [
					'testm-style-one'  => esc_html__( 'Style One', AEFE_TEXTDOMAIN ),
					'testm-style-two' => esc_html__( 'Style Two', AEFE_TEXTDOMAIN ),
					'testm-style-three' => esc_html__( 'Style Three', AEFE_TEXTDOMAIN ),
				],
			]
		);


		$this->end_controls_section();


        $this->start_controls_section(
			'aefe_testimonial_slider_section',
			[
				'label' => esc_html__( 'Content', AEFE_TEXTDOMAIN ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,				
			]
		);

		$repeater = new \Elementor\Repeater();
		// Title
		$repeater->add_control(
			'aefe_testimonial_slider_title',
			[
				'label' => esc_html__( 'Title', AEFE_TEXTDOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,				
				'placeholder' => esc_html__( 'Title Name', AEFE_TEXTDOMAIN ),
				'label_block' => true,
				'dynamic' => [
					'active' => true,
				],
			]
		);
		
		// subtitle
		$repeater->add_control(
			'aefe_testimonial_slider_subtitle',
			[
				'label' => esc_html__( 'Sub Title', AEFE_TEXTDOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,				
				'placeholder' => esc_html__( 'Subtitle', AEFE_TEXTDOMAIN ),
				'label_block' => true,
				'dynamic' => [
					'active' => true,
				],
			]
		);

        // Image
        $repeater->add_control(
			'aefe_testimonial_slider_img',
			[
				'label' => esc_html__( 'Image', AEFE_TEXTDOMAIN ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'dynamic' => [
					'active' => true,
				],
			]
		);

        // Content
        $repeater->add_control(
			'aefe_testimonial_slider_content',
			[
				'label' => esc_html__( 'Content', AEFE_TEXTDOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'dynamic' => [
					'active' => true,
				],
			]
		);
		// facebook url 
		$repeater->add_control(
			'aefe_testimonial_slider_fb_url',
			[
				'label' => esc_html__( 'Facebook URL', AEFE_TEXTDOMAIN ),
				'type' => \Elementor\Controls_Manager::URL,				
				'placeholder' => esc_html__( 'https://fb.com/hmbashar', AEFE_TEXTDOMAIN ),
				'label_block' => true,			
			]
		);
		
		// Twitter URL 
		$repeater->add_control(
			'aefe_testimonial_slider_tw_url',
			[
				'label' => esc_html__( 'Twitter URL', AEFE_TEXTDOMAIN ),
				'type' => \Elementor\Controls_Manager::URL,				
				'placeholder' => esc_html__( 'https://twitter.com/hmbashar', AEFE_TEXTDOMAIN ),
				'label_block' => true,
			]
		);
		
		// LinkedIn URL
		$repeater->add_control(
			'aefe_testimonial_slider_linkd_url',
			[
				'label' => esc_html__( 'LinkedIn URL', AEFE_TEXTDOMAIN ),
				'type' => \Elementor\Controls_Manager::URL,				
				'placeholder' => esc_html__( 'https://www.linkedin.com/in/shaplahost/', AEFE_TEXTDOMAIN ),
				'label_block' => true,
			]
		);
		
		// Dribbble URL
		$repeater->add_control(
			'aefe_testimonial_slider_drib_url',
			[
				'label' => esc_html__( 'Dribbble URL', AEFE_TEXTDOMAIN ),
				'type' => \Elementor\Controls_Manager::URL,				
				'placeholder' => esc_html__( 'https://www.linkedin.com/in/shaplahost/', AEFE_TEXTDOMAIN ),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'aefe_testimonial_slider_rating',
			[
				'label' => esc_html__( 'Rating', AEFE_TEXTDOMAIN),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '5',
				'options' => [
					'0'  => esc_html__( 'None', AEFE_TEXTDOMAIN),
					'1'  => esc_html__( '1 Star', AEFE_TEXTDOMAIN),
					'2'  => esc_html__( '2 Stars', AEFE_TEXTDOMAIN),
					'3'  => esc_html__( '3 Stars', AEFE_TEXTDOMAIN),
					'4'  => esc_html__( '4 Stars', AEFE_TEXTDOMAIN),
					'5'  => esc_html__( '5 Stars', AEFE_TEXTDOMAIN),
				],
			]
		);

		$this->add_control(
			'aefe_testimonial_slider_list',
			[
				'label' => esc_html__( 'Testimonial List', AEFE_TEXTDOMAIN ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ aefe_testimonial_slider_title }}}',
			]
		);

		
		$this->end_controls_section();

		
		//Testimonial Style
		$this->start_controls_section(
			'aefe_testimonial_slider_style_section',
			[
				'label' => esc_html__( 'General', AEFE_TEXTDOMAIN ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		// Number of items
		$this->add_responsive_control(
			'aefe_testimonial_item_count',
			[
				'type' => \Elementor\Controls_Manager::NUMBER,
				'label' => esc_html__( 'Number of Items', AEFE_TEXTDOMAIN),		
				'min' => 1,
				'max' => 8,								
				'step' => 1,								
				'devices' => [ 'desktop', 'tablet', 'mobile' ],
				'desktop_default' => '3',
				'tablet_default' => '2',
				'mobile_default' => '1'
			]
		);

		// Item gap
		$this->add_responsive_control(
			'aefe_testimonial_item_gap',
			[
				'type' => \Elementor\Controls_Manager::NUMBER,
				'label' => esc_html__( 'Gap', AEFE_TEXTDOMAIN),		
				'min' => 0,
				'max' => 100,								
				'step' => 1,								
				'devices' => [ 'desktop', 'tablet', 'mobile' ],
				'desktop_default' => 0,
				'tablet_default' => 0,
				'mobile_default' => 0
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'aefe_testimonial_img_border_radius',
				'selector' => '{{WRAPPER}} .your-class',
			]
		);
		// Mouse Drag
		$this->add_responsive_control(
			'aefe_testimonial_item_mouseDrag',
			[
				'label' => esc_html__( 'Mouse Drag', AEFE_TEXTDOMAIN ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', AEFE_TEXTDOMAIN ),
				'label_off' => esc_html__( 'Off', AEFE_TEXTDOMAIN),
				'return_value' => 1,										
				'devices' => [ 'desktop', 'tablet', 'mobile' ],
				'desktop_default' => 1,
				'tablet_default' => 1,
				'mobile_default' => 1
			]
		);
		//Auto Play
		$this->add_control(
			'aefe_testimonial_slider_autoplay',
			[
				'label' => esc_html__( 'AutoPlay', AEFE_TEXTDOMAIN ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', AEFE_TEXTDOMAIN ),
				'label_off' => esc_html__( 'Off', AEFE_TEXTDOMAIN),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		
		
		//Nav Switch
		$this->add_responsive_control(
			'aefe_testimonial_slider_nav_switch',
			[
				'label' => esc_html__( 'Nav', AEFE_TEXTDOMAIN ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', AEFE_TEXTDOMAIN ),
				'label_off' => esc_html__( 'Off', AEFE_TEXTDOMAIN),
				'return_value' => 1,
				'default' => 0,
			]
		);
		
		
		
		//Dot Switch
		$this->add_responsive_control(
			'aefe_testimonial_slider_dot_switch',
			[
				'label' => esc_html__( 'Dots', AEFE_TEXTDOMAIN ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', AEFE_TEXTDOMAIN ),
				'label_off' => esc_html__( 'Off', AEFE_TEXTDOMAIN),
				'return_value' => 1,
				'default' => 0,
			]
		);
		
		
		
		//Quote Switch
		$this->add_control(
			'aefe_testimonial_slider_quote_switch',
			[
				'label' => esc_html__( 'Quote Icon', AEFE_TEXTDOMAIN ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', AEFE_TEXTDOMAIN ),
				'label_off' => esc_html__( 'Off', AEFE_TEXTDOMAIN),
				'condition' => [
					'aefe_testimonial_slider_style' => 'testm-style-two',
				],
				'return_value' => 1,
				'default' => 0,
			]
		);
		

		//Loop
		$this->add_control(
			'aefe_testimonial_slider_loop',
			[
				'label' => esc_html__( 'Loop', AEFE_TEXTDOMAIN ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', AEFE_TEXTDOMAIN ),
				'label_off' => esc_html__( 'Off', AEFE_TEXTDOMAIN),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		// Box Shadow
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'boxaefe_testimonial_style_two_box_shadow',
				'label' => esc_html__( 'Box Shadow', AEFE_TEXTDOMAIN ),
				'selector' => '{{WRAPPER}} .aefe-tms-single-testimonial',
				'condition' => [
					'aefe_testimonial_slider_style' => 'testm-style-two',
				],
			]
		);
		

		// Box Shadow
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'boxaefe_testimonial_style_two_before_box_shadow',
				'label' => esc_html__( 'Before Box Shadow', AEFE_TEXTDOMAIN ),
				'selector' => '{{WRAPPER}} .aefe-tms-single-testimonial:before',
				'condition' => [
					'aefe_testimonial_slider_style' => 'testm-style-two',
				],
			]
		);
		

		// Box Shadow
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'boxaefe_testimonial_style_two_after_box_shadow',
				'label' => esc_html__( 'After Box Shadow', AEFE_TEXTDOMAIN ),
				'selector' => '{{WRAPPER}} .aefe-tms-single-testimonial:after',
				'condition' => [
					'aefe_testimonial_slider_style' => 'testm-style-two',
				],
			]
		);
		
		// Start control tabs
		$this->start_controls_tabs( 'aefe_testmonial_general_tabs_style' );

		
		//Start Single Tab
		$this->start_controls_tab(
			'aefe-testimonial-general-tab-normal', [
				'label'	=> esc_html__( 'Normal', AEFE_TEXTDOMAIN),
			]
		);


		// Background Color Style One
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'aefe_testmonial_background_color1',
				'label' => esc_html__( 'Background', AEFE_TEXTDOMAIN ),
				'types' => [ 'gradient'],
				'selector' => '{{WRAPPER}} .aefe-single-some-review',
				'condition' => [
					'aefe_testimonial_slider_style' => 'testm-style-one',
				],
				
				
			]
		);

		// Background Color Style Two
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'aefe_testmonial_background_color2',
				'label' => esc_html__( 'Background', AEFE_TEXTDOMAIN ),
				'types' => [ 'gradient'],
				'selector' => '{{WRAPPER}} .aefe-tms-single-testimonial',
				'condition' => [
					'aefe_testimonial_slider_style' => 'testm-style-two',
				],
				
				
			]
		);

		// Background Color Style Three
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'aefe_testmonial_background_color3',
				'label' => esc_html__( 'Background', AEFE_TEXTDOMAIN ),
				'types' => [ 'gradient'],
				'selector' => '{{WRAPPER}} .aefe-tm-3-testimonial-area',
				'condition' => [
					'aefe_testimonial_slider_style' => 'testm-style-three',
				],
				
				
			]
		);


		//Title Typography
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'aefe_testmonial_title_typography',
				'label' =>esc_html__( 'Title Typography', AEFE_TEXTDOMAIN),
				'selector' => '{{WRAPPER}} .aefe-single-some-review-title h2 a, {{WRAPPER}} .aefe-tms-testimonial-client-name h2, {{WRAPPER}} .aefe-tm-3-testi_client_name h2',
				
			]
		);

		// Title Color
		$this->add_control(
			'aefe_testmonial_title_color',
			[
				'label' =>esc_html__( 'Title Color', AEFE_TEXTDOMAIN),
				'type' => \Elementor\Controls_Manager::COLOR,				
				'selectors' => [
					'{{WRAPPER}} .aefe-single-some-review-title h2 a' => 'color: {{VALUE}};',
					'{{WRAPPER}} .aefe-tms-testimonial-client-name h2' => 'color: {{VALUE}};',
					'{{WRAPPER}} .aefe-tm-3-testi_client_name h2' => 'color: {{VALUE}};',
				],
			]
		);

		//SubTitle Typography
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'aefe_tm_subtitle_typography',
				'label' =>esc_html__( 'Subtitle Typography', AEFE_TEXTDOMAIN),
				'selector' => '{{WRAPPER}} .aefe-single-some-review-title h4, {{WRAPPER}} .aefe-tms-testimonial-client-name h3, {{WRAPPER}} .aefe-tm-3-testi_client_name h3',
				
			]
		);

		// SubTitle Color
		$this->add_control(
			'aefe_testmonial_subtitle_color',
			[
				'label' =>esc_html__( 'Subtitle Color', AEFE_TEXTDOMAIN),
				'type' => \Elementor\Controls_Manager::COLOR,				
				'selectors' => [
					'{{WRAPPER}} .aefe-single-some-review-title h4' => 'color: {{VALUE}};',
					'{{WRAPPER}} .aefe-tms-testimonial-client-name h3' => 'color: {{VALUE}};',
					'{{WRAPPER}} .aefe-tm-3-testi_client_name h3' => 'color: {{VALUE}};',
				],
			]
		);

		// Star Color
		$this->add_control(
			'aefe_testmonial_star_color',
			[
				'label' =>esc_html__( 'Star Color', AEFE_TEXTDOMAIN),
				'type' => \Elementor\Controls_Manager::COLOR,				
				'selectors' => [
					'{{WRAPPER}} .aefe-tms-testimonial-rating i' => 'color: {{VALUE}};',
				],
			]
		);

		//Content Typography
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'aefe_testmonial_content_typography',
				'label' =>esc_html__( 'Conetent Typography', AEFE_TEXTDOMAIN),
				'selector' => '{{WRAPPER}} .aefe-single-some-review-content p, {{WRAPPER}} .aefe-tms-testimonial-message p,  {{WRAPPER}} .aefe-tm-3-testimonial-message p',				
			]
		);

		// Content Color
		$this->add_control(
			'aefe_testmonial_content_color',
			[
				'label' =>esc_html__( 'Content Color', AEFE_TEXTDOMAIN),
				'type' => \Elementor\Controls_Manager::COLOR,				
				'selectors' => [
					'{{WRAPPER}} .aefe-single-some-review-content p' => 'color: {{VALUE}};',
					'{{WRAPPER}} .aefe-tms-testimonial-message p' => 'color: {{VALUE}};',
					'{{WRAPPER}} .aefe-tm-3-testimonial-message p' => 'color: {{VALUE}};',
				],
			]
		);


		// Content Dimensions
		$this->add_control(
			'aefe_testmonial_content_margin',
			[
				'label' => esc_html__( 'Content Margin', AEFE_TEXTDOMAIN),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .aefe-single-some-review-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .aefe-tm-3-testimonial-message' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->end_controls_tab(); // end single normal controls

		//Start Single Tab
		$this->start_controls_tab(
			'aefe-testimonial-general-tab-hover', [
				'label'	=> esc_html__( 'Hover', AEFE_TEXTDOMAIN),
				'condition' => [
					'aefe_testimonial_slider_style!' => 'testm-style-three', // this section not for style three
				],
				
			]
		);


		// Background Color Style One
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'aefe_testmonial_background_color1_hover',
				'label' => esc_html__( 'Background', AEFE_TEXTDOMAIN ),
				'types' => [ 'gradient'],
				'selector' => '{{WRAPPER}} .aefe-single-some-review:hover',
				'condition' => [
					'aefe_testimonial_slider_style' => 'testm-style-one',
				],
				
				
			]
		);

		// Background Color Style Two
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'aefe_testmonial_background_color2_hover',
				'label' => esc_html__( 'Background', AEFE_TEXTDOMAIN ),
				'types' => [ 'gradient'],
				'selector' => '{{WRAPPER}} .aefe-tms-single-testimonial:hover',
				'condition' => [
					'aefe_testimonial_slider_style' => 'testm-style-two',
				],
				
				
			]
		);



		// Title Color
		$this->add_control(
			'aefe_testmonial_title_color_hover',
			[
				'label' =>esc_html__( 'Title Color', AEFE_TEXTDOMAIN),
				'type' => \Elementor\Controls_Manager::COLOR,				
				'selectors' => [
					'{{WRAPPER}} .aefe-single-some-review:hover .aefe-single-some-review-title h2 a' => 'color: {{VALUE}};',
					'{{WRAPPER}} .aefe-tms-single-testimonial:hover .aefe-tms-testimonial-client-name h2' => 'color: {{VALUE}};',					
				],
			]
		);


		// SubTitle Color
		$this->add_control(
			'aefe_testmonial_subtitle_color_hover',
			[
				'label' =>esc_html__( 'Subtitle Color', AEFE_TEXTDOMAIN),
				'type' => \Elementor\Controls_Manager::COLOR,				
				'selectors' => [
					'{{WRAPPER}} .aefe-single-some-review:hover .aefe-single-some-review-title h4' => 'color: {{VALUE}};',
					'{{WRAPPER}} .aefe-tms-single-testimonial:hover .aefe-tms-testimonial-client-name h3' => 'color: {{VALUE}};',					
				],
			]
		);

		// Star Color
		$this->add_control(
			'aefe_testmonial_star_color_hover',
			[
				'label' =>esc_html__( 'Star Color', AEFE_TEXTDOMAIN),
				'type' => \Elementor\Controls_Manager::COLOR,				
				'selectors' => [
					'{{WRAPPER}} .aefe-single-some-review:hover .aefe-tms-testimonial-rating i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .aefe-tms-single-testimonial:hover .aefe-tms-testimonial-rating i' => 'color: {{VALUE}};',
				],
			]
		);


		// Content Color
		$this->add_control(
			'aefe_testmonial_content_color_hover',
			[
				'label' =>esc_html__( 'Content Color', AEFE_TEXTDOMAIN),
				'type' => \Elementor\Controls_Manager::COLOR,				
				'selectors' => [
					'{{WRAPPER}} .aefe-single-some-review:hover .aefe-single-some-review-content p' => 'color: {{VALUE}};',
					'{{WRAPPER}} .aefe-tms-single-testimonial:hover .aefe-tms-testimonial-message p' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab(); // end single hover tab
		$this->end_controls_tabs(); // end general tabs
		$this->end_controls_section(); // end section.


		// Social Icon Style Normal and Hover
		// Pricing Button Section Style
        $this->start_controls_section(
			'aefe_testmonial_social_section_style',
			[
				'label' =>esc_html__( 'Social Profile', AEFE_TEXTDOMAIN),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'aefe_testmonial_social_tabs_style' );

		$this->start_controls_tab(
			'aefe_testmonial_social_tab_normal',
			[
				'label' =>esc_html__( 'Normal', AEFE_TEXTDOMAIN),
			]
		);

		$this->add_control(
			'aefe_testmonial_social_color',
			[
				'label' =>esc_html__( 'Color', AEFE_TEXTDOMAIN),
				'type' => \Elementor\Controls_Manager::COLOR,				
				'selectors' => [
					'{{WRAPPER}} .aefe-single-some-review-social a i' => 'color: {{VALUE}};',
					
				],
			]
		);

		$this->add_control(
			'aefe_testmonial_social_icon_size',
			[
				'label' => esc_html__( 'Size', AEFE_TEXTDOMAIN),
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Please input your size with unite (px, rem), like 15px', AEFE_TEXTDOMAIN),
				'selectors' => [
					'{{WRAPPER}} .aefe-single-some-review-social a i' => 'font-size: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'aefe_testmonial_social_tab_button_hover',
			[
				'label' =>esc_html__( 'Hover', AEFE_TEXTDOMAIN),
			]
		);


		$this->add_control(
			'aefe_testmonial_social_color_hover',
			[
				'label' =>esc_html__( 'Color', AEFE_TEXTDOMAIN),
				'type' => \Elementor\Controls_Manager::COLOR,				
				'selectors' => [
					'{{WRAPPER}} .aefe-single-some-review:hover .aefe-single-some-review-social a i' => 'color: {{VALUE}};',					
				],
			]
		);


		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();



		// Nav
		$this->start_controls_section(
			'aefe_testmonial_slider_nav_bar',
			[
				'label' => esc_html__( 'Nav', AEFE_TEXTDOMAIN),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'aefe_testimonial_slider_nav_switch' => '1',
				],
			]
		);


		$this->add_control(
			'aefe_testi_slider_nav_isize',
			[
				'label' => esc_html__( 'Icon Size', AEFE_TEXTDOMAIN ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'rem' ],	
				'default' => [
					'unit' => 'px',
					'size' => 30,
				],
				'selectors' => [
					'{{WRAPPER}} .aefe-some-review-contents-area .owl-nav button i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .aefe-tms-testimonial-content-area .owl-nav button i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .aefe-tm-3-testimonial-area .owl-nav button i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'aefe_testi_slider_nav_button_size',
			[
				'label' => esc_html__( 'Button Size', AEFE_TEXTDOMAIN ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [
					'top'		=> '10',
					'bottom'	=> '10',
					'left'		=> '20',
					'right'		=> '20',
					'unit' 		=> 'px',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .aefe-some-review-contents-area .owl-nav button i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .aefe-tms-testimonial-content-area .owl-nav button i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .aefe-tm-3-testimonial-area .owl-nav button i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'aefe_testimonial_nav_selected_icon_left',
			[
				'label' => esc_html__( 'Left Nav', AEFE_TEXTDOMAIN),
				'type' => \Elementor\Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'skin' => 'inline',
				'label_block' => false,
				'default' => [
					'value' => 'fas fa-angle-left',
					'library' => 'fa-solid',
				],
			]
		);

		$this->add_control(
			'aefe_testimonial_nav_selected_icon_right',
			[
				'label' => esc_html__( 'Right Nav', AEFE_TEXTDOMAIN),
				'type' => \Elementor\Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'skin' => 'inline',
				'label_block' => false,
				'default' => [
					'value' => 'fas fa-angle-right',
					'library' => 'fa-solid',
				],
			]
		);

		$this->add_responsive_control(
			'aefe_testimonial_nav_left_icon_indent',
			[
				'label' => esc_html__( 'Left Nav Spacing', AEFE_TEXTDOMAIN),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'rem' ],	
				'range' => [
					'px' => [
						'max' => 150,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 30,
				],
				'selectors' => [
					'{{WRAPPER}} .aefe-some-review-contents-area .owl-nav button.owl-prev' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .aefe-tms-testimonial-content-area .owl-nav button.owl-prev' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .aefe-tm-3-testimonial-area .owl-nav button.owl-prev' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'aefe_testimonial_nav_right_icon_indent',
			[
				'label' => esc_html__( 'Right Nav Spacing', AEFE_TEXTDOMAIN),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'rem' ],	
				'range' => [
					'px' => [
						'max' => 150,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 30,
				],
				'selectors' => [
					'{{WRAPPER}} .aefe-some-review-contents-area .owl-nav button.owl-next' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .aefe-tms-testimonial-content-area .owl-nav button.owl-next' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .aefe-tm-3-testimonial-area .owl-nav button.owl-next' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'aefe_testimonial_nav_position_indent',
			[
				'label' => esc_html__( 'Nav Position', AEFE_TEXTDOMAIN),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'rem' ],				
				'default' => [
					'unit' => '%',
					'size' => 47,
				],
				'selectors' => [
					'{{WRAPPER}} .aefe-some-review-contents-area .owl-nav' => 'top: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .aefe-tms-testimonial-content-area .owl-nav' => 'top: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .aefe-tm-3-testimonial-area .owl-nav' => 'top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'aefe_view',
			[
				'label' => esc_html__( 'View', AEFE_TEXTDOMAIN ),
				'type' => \Elementor\Controls_Manager::HIDDEN,
				'default' => 'traditional',
			]
		);

		$this->add_control(
			'aefe_testimonial_nav_border_radius',
			[
				'label' => esc_html__( 'Border Radius', AEFE_TEXTDOMAIN ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'default'	=> [
					'top' 		=> '3',
					'right' 	=> '3',
					'bottom' 	=> '3',
					'left' 		=> '3',
					'unit' 		=> 'px',
					'isLinked' 	=> false,
				],
				'selectors' => [
					'{{WRAPPER}} .aefe-some-review-contents-area .owl-nav button i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .aefe-tms-testimonial-content-area .owl-nav button i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .aefe-tm-3-testimonial-area .owl-nav button i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs( 'aefe_testimonial_tabs_button_style');


		$this->start_controls_tab(
			'aefe_testimonial_slider_tab_button_normal',
			[
				'label' => esc_html__( 'Normal', AEFE_TEXTDOMAIN ),
			]
		);

		$this->add_control(
			'aefe_testimonial_button_nav_color',
			[
				'label' => esc_html__( 'Color', AEFE_TEXTDOMAIN ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .aefe-some-review-contents-area .owl-nav button i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .aefe-tms-testimonial-content-area .owl-nav button i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .aefe-tm-3-testimonial-area .owl-nav button i' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'aefe_testimonial_slider_nav_background',
				'label' => esc_html__( 'Background', AEFE_TEXTDOMAIN ),
				'types' => [ 'classic', 'gradient' ],
				'exclude' => [ 'image' ],
				'selector' => '{{WRAPPER}} .aefe-some-review-contents-area .owl-nav button i, {{WRAPPER}} .aefe-tms-testimonial-content-area .owl-nav button i, .aefe-tm-3-testimonial-area .owl-nav button i',
				'fields_options' => [
					'background' => [
						'default' => 'classic',
					],
					'color' => [
						'default' => '#000000',
					],
				]				
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'aefe_testimonial_slider_tab_button_hover',
			[
				'label' => esc_html__( 'Hover', AEFE_TEXTDOMAIN ),
			]
		);

		$this->add_control(
			'aefe_testimonial_button_nav_hover_color',
			[
				'label' => esc_html__( 'Color', AEFE_TEXTDOMAIN ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .aefe-some-review-contents-area .owl-nav button:hover i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .aefe-tms-testimonial-content-area .owl-nav button:hover i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .aefe-tm-3-testimonial-area .owl-nav button:hover i' => 'color: {{VALUE}};',
				]				
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'aefe_testimonial_slider_nav_button_background_hover',
				'label' => esc_html__( 'Background', AEFE_TEXTDOMAIN ),
				'types' => [ 'classic', 'gradient' ],
				'exclude' => [ 'image' ],
				'selector' => '{{WRAPPER}} .aefe-some-review-contents-area .owl-nav button:hover i, {{WRAPPER}} .aefe-some-review-contents-area .owl-nav button i:focus, {{WRAPPER}} .aefe-tms-testimonial-content-area .owl-nav button i:hover, .aefe-tm-3-testimonial-area .owl-nav button:hover i',
				'fields_options' => [
					'background' => [
						'default' => 'classic',
					],
				]
			]
		);


		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section(); // Nav

		// Dots
		$this->start_controls_section(
			'aefe_testmonial_slider_dots_bar',
			[
				'label' => esc_html__( 'Dots', AEFE_TEXTDOMAIN),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'aefe_testimonial_slider_dot_switch' => '1',
				],
			]
		);


		$this->add_control(
			'aefe_testi_slider_dot_size',
			[
				'label' => esc_html__( 'Size', AEFE_TEXTDOMAIN ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'rem' ],	
				'default' => [
					'unit' => 'px',
					'size' => 12,
				],
				'selectors' => [
					'{{WRAPPER}} .aefe-some-review-contents-area .owl-dots button.owl-dot span' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .aefe-tms-testimonial-content-area button.owl-dot span' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'aefe_testimonial_slider_style!' => 'testm-style-three',
				],
			]
		);

		// Dot Width for testimonial style 3
		$this->add_control(
			'aefe_testi_slider_dot_width_tms3',
			[
				'label' => esc_html__( 'Width', AEFE_TEXTDOMAIN ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'rem' ],	
				'default' => [
					'unit' => 'px',
					'size' => 30,
				],
				'selectors' => [
					'{{WRAPPER}} .aefe-tm-3-testimonial-slider .owl-dots .owl-dot' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'aefe_testimonial_slider_style' => 'testm-style-three',
				],
			]
		);

		// Dot Height for testimonial style 3
		$this->add_control(
			'aefe_testi_slider_dot_height_tms3',
			[
				'label' => esc_html__( 'Height', AEFE_TEXTDOMAIN ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'rem' ],	
				'default' => [
					'unit' => 'px',
					'size' => 2,
				],
				'selectors' => [
					'{{WRAPPER}} .aefe-tm-3-testimonial-slider .owl-dots .owl-dot' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'aefe_testimonial_slider_style' => 'testm-style-three',
				],
			]
		);

		$this->add_control(
			'aefe_testimonial_dots_space',
			[
				'label' => esc_html__( 'Spacing', AEFE_TEXTDOMAIN ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .aefe-some-review-contents-area .owl-dots' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .aefe-tms-testimonial-content-area .owl-dots' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .aefe-tm-3-testimonial-slider .owl-dots' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'aefe_testimonial_dot_gap',
			[
				'label' => esc_html__( 'Dot Gap', AEFE_TEXTDOMAIN ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'default' => [
					'unit' => 'px',
					'size' => 5,
				],
				'selectors' => [
					'{{WRAPPER}} .aefe-some-review-contents-area .owl-dots button.owl-dot span' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .aefe-tms-testimonial-content-area button.owl-dot span' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .aefe-tm-3-testimonial-slider .owl-dots button.owl-dot' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		// DOt Normal Color
		$this->add_control(
			'aefe_testimonial_slider_dot_color',
			[
				'label' => esc_html__( 'Color', AEFE_TEXTDOMAIN ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#666666',
				'selectors' => [
					'{{WRAPPER}} .aefe-some-review-contents-area .owl-dots button.owl-dot span' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .aefe-tms-testimonial-content-area button.owl-dot span' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .aefe-tm-3-testimonial-slider .owl-dots .owl-dot' => 'background: {{VALUE}};',
				],
			]
		);

		//Dot Active Color
		$this->add_control(
			'aefe_testimonial_slider_dot_active_color',
			[
				'label' => esc_html__( 'Active Color', AEFE_TEXTDOMAIN ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#000000',
				'selectors' => [
					'{{WRAPPER}} .aefe-some-review-contents-area .owl-dots button.owl-dot.active span' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .aefe-tms-testimonial-content-area .owl-dot.active span' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .aefe-tm-3-testimonial-slider .owl-dots .owl-dot.active, .aefe-tm-3-testimonial-slider .owl-dots .owl-dot:hover' => 'background: {{VALUE}};',
				],				
			]
		);

		$this->end_controls_section(); // Dot

		// Quote
		$this->start_controls_section(
			'aefe_testmonial_slider_quote_icon_bar',
			[
				'label' => esc_html__( 'Quote', AEFE_TEXTDOMAIN),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'aefe_testimonial_slider_quote_switch' => '1',
				],
			]
		);
				

		$this->add_control(
			'aefe_testi_slider_quote_size',
			[
				'label' => esc_html__( 'Size', AEFE_TEXTDOMAIN ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'rem' ],	
				'default' => [
					'unit' => 'px',
					'size' => 58,
				],
				'selectors' => [
					'{{WRAPPER}} .aefe-tms-testimonial-quote i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		// Quote Color
		$this->add_control(
			'aefe_testimonial_slider_quote_color',
			[
				'label' => esc_html__( 'Color', AEFE_TEXTDOMAIN ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#4b278f',
				'selectors' => [
					'{{WRAPPER}} .aefe-tms-testimonial-quote i' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section(); // Quote



	}


	/**
	 * Render list widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		
		$settings = $this->get_settings_for_display();
		if (is_admin())
		{
		  // solves the width issue
		  // The javascript called after elementor scripts are fully loaded.
		  if ( ! defined( 'ELEMENTOR_VERSION' ) ) {
			  return;
		  }

		}


			//load render view to show widget output on frontend/website.
			if(!empty($settings['aefe_testimonial_slider_style']) && 'testm-style-one' == $settings['aefe_testimonial_slider_style']) {
				include 'testimonial-style-one.php';
			}

			//load render view to show widget output on frontend/website.
			elseif(!empty($settings['aefe_testimonial_slider_style']) && 'testm-style-two' == $settings['aefe_testimonial_slider_style']) {
				include 'testimonial-style-two.php';
			}

			//load render view to show widget output on frontend/website.
			elseif(!empty($settings['aefe_testimonial_slider_style']) && 'testm-style-three' == $settings['aefe_testimonial_slider_style']) {
				include 'testimonial-style-three.php';
			}


	?>
  


<?php	

	}


}