<?php
namespace AEFE_ELEMENTOR\AEFEIconBox;

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
class AEFE_IconBox extends \Elementor\Widget_Base {

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
		return 'aefe-icon-box';
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
		return esc_html__( 'Icon Box', AEFE_TEXTDOMAIN );
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
		return 'eicon-icon-box';
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
		return [ 'icon', 'icon box', 'service', 'step' ];
	}

	public function get_style_depends() {
		return [ 'aefe-main', 'aefe-responsive' ];
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
		//Template
		$this->start_controls_section(
			'aefe-icon-box-section',
			[
				'label' => esc_html__( 'Icon BOx', AEFE_TEXTDOMAIN ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		// Icon
		$this->add_control(
			'aefe_icon_box_icon',
			[
				'label' => esc_html__( 'Icon', AEFE_TEXTDOMAIN ),
				'type' => \Elementor\Controls_Manager::ICONS,
				//'skin' => 'inline',				
				'default' => [
					'value' => 'fas fa-code',
					'library' => 'fa-solid',
				],
			]
		);

		// Icon Box Title
		$this->add_control(
			'aefe_icon_box_title', [
				'label' => esc_html__( 'Title', AEFE_TEXTDOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Web Development' , AEFE_TEXTDOMAIN ),
				'label_block' => true,
				'dynamic' => [
					'active' => true
				]
			]
		);
		// Icon Box Content
		$this->add_control(
			'aefe_icon_box_content', [
				'label' => esc_html__( 'Content', AEFE_TEXTDOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,				
				'show_label' => false,
				'dynamic' => [
					'active' => true
				]
			]
		);
		// Background Number
		$this->add_control(
			'aefe_icon_box_number', [
				'label' => esc_html__( 'Number', AEFE_TEXTDOMAIN ),
				'type' => \Elementor\Controls_Manager::NUMBER,	
				'selectors' => [
					'{{WRAPPER}} .aefe-icon-box-de-itm .aefe-icon-box-design-item:after' => 'content:"{{VALUE}}" ',
				],
			]
		);

		$this->end_controls_section(); // End of the content section


		//Icon Box Style
		$this->start_controls_section(
			'aefe_icon_box_style_section',
			[
				'label' => esc_html__( 'Style', AEFE_TEXTDOMAIN ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		

		// Icon Box Style

		// Primary Color
		$this->add_control(
			'aefe_icon_box_primary_color',
			[
				'label' => esc_html__( 'Primary Color', AEFE_TEXTDOMAIN ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#f26522',
				'selectors' => [
					'{{WRAPPER}} .aefe-icon-box-design-item' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .aefe-icon-box-design-icon' => 'background-color: {{VALUE}}',
				],
			]
		);

		// Icon Color
		$this->add_control(
			'aefe_icon_box_icon_color',
			[
				'label' => esc_html__( 'Icon Color', AEFE_TEXTDOMAIN ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#f26522',
				'selectors' => [
					'{{WRAPPER}} .aefe-icon-box-design-icon i' => 'color: {{VALUE}}',
				],
			]
		);

		// Icon background Color
		$this->add_control(
			'aefe_icon_box_icon_bgcolor',
			[
				'label' => esc_html__( 'Icon BG Color', AEFE_TEXTDOMAIN ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .aefe-icon-box-design-item .aefe-icon-box-design-icon:before' => 'background-color: {{VALUE}}',
				],
			]
		);

		// Title Color
		$this->add_control(
			'aefe_icon_box_title_color',
			[
				'label' => esc_html__( 'Title Color', AEFE_TEXTDOMAIN ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .aefe-icon-box-design-item h4' => 'color: {{VALUE}}',
				],
			]
		);

		// Title Typography
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'aefe_icon_box_title_typography',
				'selector' => '{{WRAPPER}} .aefe-icon-box-design-item h4',
			]
		);

		// Content Color
		$this->add_control(
			'aefe_icon_box_content_color',
			[
				'label' => esc_html__( 'Content Color', AEFE_TEXTDOMAIN ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .aefe-icon-box-design-item p' => 'color: {{VALUE}}',
				],
			]
		);

		// Content Typography
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'label' => esc_html__( 'Content Typhography', AEFE_TEXTDOMAIN ),
				'name' => 'aefe_icon_box_content_typography',
				'selector' => '{{WRAPPER}} .aefe-icon-box-design-item p',
			]
		);
		
		// Number Color
		$this->add_control(
			'aefe_icon_box_number_color',
			[
				'label' => esc_html__( 'Number Color', AEFE_TEXTDOMAIN ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#ff7737',
				'selectors' => [
					'{{WRAPPER}} .aefe-icon-box-de-itm:nth-of-type(2n+1) .aefe-icon-box-design-item:after' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section(); // End of the style section

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
		include 'icon-box-style-one.php';


	}


}