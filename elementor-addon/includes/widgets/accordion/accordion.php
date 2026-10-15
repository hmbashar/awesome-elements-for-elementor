<?php
namespace AEFE_ELEMENTOR\AEFEAccordion;

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
class AEFE_Accordion extends \Elementor\Widget_Base {


	public function get_script_depends() {

		wp_register_script( 'aefe-faq-activation', AEFE_URL . 'assets/js/faq-script.js', [ 'jquery' ], AEFE_VERSION, true );

		return [
			'aefe-faq-activation',
		];

	}



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
		return 'aefe-accordion';
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
		return esc_html__( 'Accordion', AEFE_TEXTDOMAIN );
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
		return 'eicon-toggle';
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
		return [ 'Accordion', 'FAQ', 'Toggle', 'Question', 'answer' ];
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

		//Template Selection
		$this->start_controls_section(
			'aefe-ac-template-style',
			[
				'label' => esc_html__( 'Style', AEFE_TEXTDOMAIN ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'aefe_ac_design_type',
			[
				'label' => esc_html__( 'Select Style', AEFE_TEXTDOMAIN ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'ac_style_one',
				'options' => [
					'ac_style_one'  => esc_html__( 'Style One', AEFE_TEXTDOMAIN ),
				],
			]
		);

		// Open Icon
		$this->add_control(
			'aefe_accordion_icon_open',
			[
				'label' => esc_html__( 'Open Icon', AEFE_TEXTDOMAIN ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'skin' => 'inline',				
				'default' => [
					'value' => 'fas fa-minus',
					'library' => 'fa-solid',
				],
			]
		);

		// Close Icon
		$this->add_control(
			'aefe_accordion_icon_close',
			[
				'label' => esc_html__( 'Close Icon', AEFE_TEXTDOMAIN ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'skin' => 'inline',
				'default' => [
					'value' => 'fas fa-plus',
					'library' => 'fa-solid',
				],
			]
		);

		
		$this->end_controls_section();

		//Accoridion Repeater
		$this->start_controls_section(
			'aefe-ac-template-content',
			[
				'label' => esc_html__( 'Content', AEFE_TEXTDOMAIN ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);


			$repeater = new \Elementor\Repeater();

			$repeater->add_control(
				'aefe_accordion_title', [
					'label' => esc_html__( 'Title', AEFE_TEXTDOMAIN ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => esc_html__( 'List Title' , AEFE_TEXTDOMAIN ),
					'label_block' => true,
				]
			);

			$repeater->add_control(
				'aefe_accordion_content', [
					'label' => esc_html__( 'Content', AEFE_TEXTDOMAIN ),
					'type' => \Elementor\Controls_Manager::WYSIWYG,
					'default' => esc_html__( 'List Content' , AEFE_TEXTDOMAIN ),
					'show_label' => false,
				]
			);

			$this->add_control(
				'aefe_accordion_list',
				[
					'label' => esc_html__( 'Accordion List', AEFE_TEXTDOMAIN),
					'type' => \Elementor\Controls_Manager::REPEATER,
					'fields' => $repeater->get_controls(),
					'default' => [
						[
							'aefe_accordion_title' => esc_html__( 'Sedeiusmod tempor inccsetetur aliquatraiy? #1', AEFE_TEXTDOMAIN ),
							'aefe_accordion_content' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod temporo incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrd exercitation ullamco laboris nisi ut aliquip.', AEFE_TEXTDOMAIN ),
						],
						[
							'aefe_accordion_title' => esc_html__( 'Sedeiusmod tempor inccsetetur aliquatraiy? #2', AEFE_TEXTDOMAIN ),
							'aefe_accordion_content' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod temporo incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrd exercitation ullamco laboris nisi ut aliquip..', AEFE_TEXTDOMAIN ),
						],
					],
					'title_field' => '{{{ aefe_accordion_title }}}',
				]
			);

		$this->end_controls_section(); // Accordion List End


		//Template Selection
		$this->start_controls_section(
			'aefe_acordion_style_section',
			[
				'label' => esc_html__( 'Style', AEFE_TEXTDOMAIN ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		// Title Color
		$this->add_control(
			'aefe_accordion_title_color',
			[
				'label' => esc_html__( 'Title Color', AEFE_TEXTDOMAIN ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#444444',
				'selectors' => [
					'{{WRAPPER}} .aefe-faq-1-accordion_hearder h2' => 'color: {{VALUE}}',
				],
			]
		);

		// Title Typography
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'aefe_accordion_title_typography',
				'selector' => '{{WRAPPER}} .aefe-faq-1-accordion_hearder h2',
			]
		);

		// Content Color
		$this->add_control(
			'aefe_accordion_content_color',
			[
				'label' => esc_html__( 'Content Color', AEFE_TEXTDOMAIN ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#666666',
				'selectors' => [
					'{{WRAPPER}} .aefe-faq-1-accordion_content p' => 'color: {{VALUE}}',
					'{{WRAPPER}} .aefe-faq-1-accordion_content' => 'color: {{VALUE}}',
				],
			]
		);

		// Content Typography
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'aefe_accordion_content_typography',
				'selector' => '{{WRAPPER}} .aefe-faq-1-accordion_content p',
			]
		);

		// Focus Color
		$this->add_control(
			'aefe_accordion_focus_color',
			[
				'label' => esc_html__( 'Focus Color', AEFE_TEXTDOMAIN ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#ed174b',
				'selectors' => [
					'{{WRAPPER}} .aefe-faq-1-single_accordion:before' => 'border-color: {{VALUE}}',
					'{{WRAPPER}} .aefe-faq-1-accordion_hearder.aefe-faq-1-accordion_active span.aefe-faq-1-accordion_icon .aefe-acc1-open i' => 'background-color: {{VALUE}};border-color: {{VALUE}}',
					'{{WRAPPER}} .aefe-faq-1-active_single_accordion' => 'border-color: {{VALUE}}',
				],
			]
		);

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

		// Select Style One
		if(!empty($settings['aefe_ac_design_type']) && 'ac_style_one' == $settings['aefe_ac_design_type']) {
			include 'accordion-style-one.php'; // Get Style One
		}
		


	}


}