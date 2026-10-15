<?php
namespace AEFE_ELEMENTOR\TeamMember;

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
class AEFE_TeamMember extends \Elementor\Widget_Base {

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
		return 'aefe-team-member';
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
		return esc_html__( 'Team Member', AEFE_TEXTDOMAIN );
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
		return 'eicon-person';
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
		return [ 'team member', 'Talent', 'Team', 'person' ];
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
		//Single Or Repeater
		$this->start_controls_section(
			'aefe-tm-single-or-repeater-tab',
			[
				'label' => esc_html__( 'Type', AEFE_TEXTDOMAIN ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'aefe-tm-repeater-single',
			[
				'label' => esc_html__( 'Type', AEFE_TEXTDOMAIN ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'single',
				'options' => [
					'single'  => esc_html__( 'Single', AEFE_TEXTDOMAIN ),
					'slider' => esc_html__( 'Slider', AEFE_TEXTDOMAIN ),
				],
			]
		);
		$this->end_controls_section(); // End the Single Or Repeater Option

        // Information Section
		$this->start_controls_section(
			'tm_content_section',
			[
				'label' => esc_html__( 'Content', AEFE_TEXTDOMAIN ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'aefe-tm-repeater-single' => 'single',
                ],
			]
		);
		
		// Person Name
		$this->add_control(
			'aefe-tm-name',
			[
				'label' => esc_html__( 'Name', AEFE_TEXTDOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,				
				'placeholder' => esc_html__( 'Member Name', AEFE_TEXTDOMAIN ),
			]
		);
		
		// Person subtitle
		$this->add_control(
			'aefe-tm-subtitle',
			[
				'label' => esc_html__( 'Sub Title', AEFE_TEXTDOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,				
				'placeholder' => esc_html__( 'Subtitle', AEFE_TEXTDOMAIN ),
			]
		);

        // Person Picture
        $this->add_control(
			'aefe-tm-member-picture',
			[
				'label' => esc_html__( 'Member Picture', AEFE_TEXTDOMAIN ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->end_controls_section();

        // Social Profile Section
		$this->start_controls_section(
			'tm_social_section',
			[
				'label' => esc_html__( 'Social Profile', AEFE_TEXTDOMAIN ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'aefe-tm-repeater-single' => 'single',
                ],
			]
		);
		
		// facebook url 
		$this->add_control(
			'aefe-tm-facebook',
			[
				'label' => esc_html__( 'Facebook URL', AEFE_TEXTDOMAIN ),
				'type' => \Elementor\Controls_Manager::URL,				
				'placeholder' => esc_html__( 'https://fb.com/hmbashar', AEFE_TEXTDOMAIN ),
                'label_block' => true,
			]
		);
		
		// Twitter URL subtitle
		$this->add_control(
			'aefe-tm-twitter',
			[
				'label' => esc_html__( 'Twitter URL', AEFE_TEXTDOMAIN ),
				'type' => \Elementor\Controls_Manager::URL,				
				'placeholder' => esc_html__( 'https://twitter.com/hmbashar', AEFE_TEXTDOMAIN ),
                'label_block' => true,
			]
		);

		$this->end_controls_section();

        /*---------------------------------------------------------------
        Repeater Control
        -----------------------------------------------------------------*/
        $this->start_controls_section(
			'aefe-tm-slider-content_section',
			[
				'label' => esc_html__( 'Content', AEFE_TEXTDOMAIN ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
				'condition' => [
                    'aefe-tm-repeater-single' => 'slider',
                ],
			]
		);

		$repeater = new \Elementor\Repeater();

		// Person Name
		$repeater->add_control(
			'aefe-tm-name',
			[
				'label' => esc_html__( 'Name', AEFE_TEXTDOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,				
				'placeholder' => esc_html__( 'Member Name', AEFE_TEXTDOMAIN ),
				'default' => esc_html__( 'Member #1' , 'plugin-name' ),
			]
		);
		
		// Person subtitle
		$repeater->add_control(
			'aefe-tm-subtitle',
			[
				'label' => esc_html__( 'Sub Title', AEFE_TEXTDOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,				
				'placeholder' => esc_html__( 'Subtitle', AEFE_TEXTDOMAIN ),
			]
		);

        // Person Picture
        $repeater->add_control(
			'aefe-tm-member-picture',
			[
				'label' => esc_html__( 'Member Picture', AEFE_TEXTDOMAIN ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

        // Person BIO
        $repeater->add_control(
			'aefe-tm-member-bio',
			[
				'label' => esc_html__( 'Short Description', AEFE_TEXTDOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Donec sollicitudin molestie malesuada. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ac diam.', AEFE_TEXTDOMAIN ),
			]
		);
		// facebook url 
		$repeater->add_control(
			'aefe-tm-facebook',
			[
				'label' => esc_html__( 'Facebook URL', AEFE_TEXTDOMAIN ),
				'type' => \Elementor\Controls_Manager::URL,				
				'placeholder' => esc_html__( 'https://fb.com/hmbashar', AEFE_TEXTDOMAIN ),
                'label_block' => true,
			]
		);
		
		// Twitter URL 
		$repeater->add_control(
			'aefe-tm-twitter',
			[
				'label' => esc_html__( 'Twitter URL', AEFE_TEXTDOMAIN ),
				'type' => \Elementor\Controls_Manager::URL,				
				'placeholder' => esc_html__( 'https://twitter.com/hmbashar', AEFE_TEXTDOMAIN ),
                'label_block' => true,
			]
		);
		
		// LinkedIn URL
		$repeater->add_control(
			'aefe-tm-linkedIn',
			[
				'label' => esc_html__( 'LinkedIn URL', AEFE_TEXTDOMAIN ),
				'type' => \Elementor\Controls_Manager::URL,				
				'placeholder' => esc_html__( 'https://www.linkedin.com/in/shaplahost/', AEFE_TEXTDOMAIN ),
                'label_block' => true,
			]
		);
		$repeater->add_control(
			'list_color',
			[
				'label' => esc_html__( 'Color', AEFE_TEXTDOMAIN),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'color: {{VALUE}}'
				],
			]
		);

		$this->add_control(
			'aefe-tm-slider-list',
			[
				'label' => esc_html__( 'Slider List', AEFE_TEXTDOMAIN ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
			]
		);

		$this->end_controls_section();


		// Style Tab for Team Member Single Style
        $this->start_controls_section(
			'aefe_tm_single_section_style',
			[
				'label' =>esc_html__( 'General', AEFE_TEXTDOMAIN),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,				
			]
		);
		
		//Title Typography
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'aefe_tm_title_typography',
				'label'    => esc_html__( 'Title Typography', AEFE_TEXTDOMAIN),
				'selector' => '{{WRAPPER}} .aefe-tm-single-team-member-name h2 a, {{WRAPPER}} .aefe-tm-sth-team-member-name h2',
			]
		);

		// Title Color
		$this->add_control(
			'aefe_tm_title_color',
			[
				'label' =>esc_html__( 'Title Color', AEFE_TEXTDOMAIN),
				'type' => \Elementor\Controls_Manager::COLOR,				
				'selectors' => [
					'{{WRAPPER}} .aefe-tm-single-team-member-name h2 a' => 'color: {{VALUE}};',
					'{{WRAPPER}} .aefe-tm-sth-team-member-name h2' => 'color: {{VALUE}};',
				],
			]
		);

		//SubTitle Typography
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'aefe_tm_subtitle_typography',
				'label'    => esc_html__( 'Subtitle Typography', AEFE_TEXTDOMAIN),
				'selector' => '{{WRAPPER}} .aefe-tm-single-team-member-name h3, {{WRAPPER}} .aefe-tm-sth-team-member-name h3',
			]
		);

		// SubTitle Color
		$this->add_control(
			'aefe_tm_subtitle_color',
			[
				'label' =>esc_html__( 'Subtitle Color', AEFE_TEXTDOMAIN),
				'type' => \Elementor\Controls_Manager::COLOR,				
				'selectors' => [
					'{{WRAPPER}} .aefe-tm-single-team-member-name h3' => 'color: {{VALUE}};',
					'{{WRAPPER}} .aefe-tm-sth-team-member-name h3' => 'color: {{VALUE}};',
				],
			]
		);

		//Content Typography
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'aefe_tm_content_typography',
				'label' =>esc_html__( 'Conetent Typography', AEFE_TEXTDOMAIN),
				'selector' => '{{WRAPPER}} .aefe-tm-sth-team-about p',
			]
		);

		// Title Color
		$this->add_control(
			'aefe_tm_content_color',
			[
				'label' =>esc_html__( 'Content Color', AEFE_TEXTDOMAIN),
				'type' => \Elementor\Controls_Manager::COLOR,				
				'selectors' => [
					'{{WRAPPER}} .aefe-tm-sth-team-about p' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section(); //  End Style Tab for Team Member Single Style


		// Social Icon Style Normal and Hover
		// Pricing Button Section Style
        $this->start_controls_section(
			'aefe_tm_social_section_style',
			[
				'label' =>esc_html__( 'Social Profile', AEFE_TEXTDOMAIN),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'aefe_tm_social_tabs_style' );

		$this->start_controls_tab(
			'aefe_tm_social_tab_normal',
			[
				'label' =>esc_html__( 'Normal', AEFE_TEXTDOMAIN),
			]
		);

		$this->add_control(
			'aefe_tm_social_color',
			[
				'label' =>esc_html__( 'Color', AEFE_TEXTDOMAIN),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .aefe-tm-single-team-member-social a i' => 'color: {{VALUE}};border-color: {{VALUE}};',
					'{{WRAPPER}} .aefe-tm-sth-team-socials-profile a i' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'aefe_tm_social_bg_color',
			[
				'label' =>esc_html__( 'Background Color', AEFE_TEXTDOMAIN),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .aefe-tm-single-team-member-social a i' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .aefe-tm-sth-team-socials-profile a i' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'aefe_tm_social_tab_button_hover',
			[
				'label' =>esc_html__( 'Hover', AEFE_TEXTDOMAIN),
			]
		);


		$this->add_control(
			'aefe_tm_social_color_hover',
			[
				'label' =>esc_html__( 'Color', AEFE_TEXTDOMAIN),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .aefe-tm-single-team-member:hover .aefe-tm-single-team-member-social a i' => 'color: {{VALUE}};border-color: {{VALUE}};',
					'{{WRAPPER}} .aefe-tm-sth-team-socials-profile a i:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'aefe_tm_social_bg_color_hover',
			[
				'label' =>esc_html__( 'Background Color', AEFE_TEXTDOMAIN),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .aefe-tm-single-team-member:hover .aefe-tm-single-team-member-social a i' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .aefe-tm-sth-team-socials-profile a i:hover' => 'background-color: {{VALUE}};',
				],
			]
		);


		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();



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
			//load render view to show widget output on frontend/website.

			if(!empty($settings['aefe-tm-repeater-single']) && 'single' == $settings['aefe-tm-repeater-single']) {
					include 'teammember-one.php';
			}elseif(!empty($settings['aefe-tm-repeater-single']) && 'slider' == $settings['aefe-tm-repeater-single']) {
				include 'teammember-two.php';
			}




	}


}