<?php
namespace AEFE_ELEMENTOR\PricingTable;

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
class AEFE_Pricing_Table extends \Elementor\Widget_Base {

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
		return 'aefe-pricing-table';
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
		return esc_html__( 'Pricing Table', 'aefe' );
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
		return 'eicon-price-table';
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
		return [ 'table', 'pricing', 'pricing table', 'package' ];
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
			'aefe-pt-template-style',
			[
				'label' => esc_html__( 'Style', 'aefe' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'aefe-pt-style',
			[
				'label' => esc_html__( 'Style', 'aefe' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'style-one',
				'options' => [
					'style-one'  => esc_html__( 'Style One', 'aefe' ),
					'style-two' => esc_html__( 'Style Two', 'aefe' ),
				],
			]
		);
		$this->end_controls_section(); // End the template style option
		// Header Section
		$this->start_controls_section(
			'header_content_section',
			[
				'label' => esc_html__( 'Header', 'aefe' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		
		// Package Name
		$this->add_control(
			'package_name',
			[
				'label' => esc_html__( 'Package Name', 'aefe' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Starter', 'aefe' ),
				'placeholder' => esc_html__( 'Package Name', 'aefe' ),
			]
		);
		$this->end_controls_section();

		// Price Section
		$this->start_controls_section(
			'pacakge_price_section',
			[
				'label' => esc_html__( 'Price', 'aefe' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		
		// Package Price Currency
		$this->add_control(
			'package_price_currency',
			[
				'label' => esc_html__( 'Currency', 'aefe' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '$', 'aefe' ),
				'placeholder' => esc_html__( 'Currency', 'aefe' ),
				'label_block' => true,
			]
		);	
		
		// Package Price
		$this->add_control(
			'package_price',
			[
				'label' => esc_html__( 'Price', 'aefe' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => esc_html__( '10', 'aefe' ),
				'placeholder' => esc_html__( 'Price', 'aefe' ),
				'label_block' => true,
			]
		);
		
				
		// Package Duration
		$this->add_control(
			'package_duration',
			[
				'label' => esc_html__( 'Duration', 'aefe' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '/m', 'aefe' ),
				'placeholder' => esc_html__( 'Duration', 'aefe' ),
				'label_block' => true,
			]
		);

		$this->end_controls_section();

		// Package Content Section
		$this->start_controls_section(
			'pacakge_content_section',
			[
				'label' => esc_html__( 'Content', 'aefe' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		
		// Package Feature list
		$this->add_control(
			'package_content',
			[
				'label' => esc_html__( 'Feature List', 'aefe' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,	
				'placeholder' => esc_html__( 'Pacakge Feature', 'aefe' ),		
				
			]
		);
		
		$this->end_controls_section();

		// Package Footer Section
		$this->start_controls_section(
			'pacakge_footer_section',
			[
				'label' => esc_html__( 'Footer', 'aefe' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		
		// Package Button Text
		$this->add_control(
			'pacakge_button_text',
			[
				'label' => esc_html__( 'Button Text', 'aefe' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Buy Now', 'aefe' ),								
				'label_block' => true,
				'default'		=> esc_html('Buy Now', 'aefe'),
			]
		);
		
		// Package Button URL
		$this->add_control(
			'pacakge_button_url',
			[
				'label' => esc_html__( 'Button URL', 'aefe' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'aefe' ),					
				'label_block' => true,				
			]
		);
		
		$this->end_controls_section();

		// Pricing Header Section Style
		$this->start_controls_section(
			'aefe_pricing_heading_section_style',
			[
				'label'		=> esc_html__( 'Header', 'aefe' ),
				'tab'		=> \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
	
		// Header Background
		$this->add_control(
			'aefe_pricing_tb_background_type',
			[
				'label' => esc_html__( 'Background Type', AEFE_TEXTDOMAIN ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'Image',
				'options' => [
					'color'  => esc_html__( 'Color', AEFE_TEXTDOMAIN ),
					'Image' => esc_html__( 'Image', AEFE_TEXTDOMAIN ),
				]
			]
		);
		
		// Header Background Image for style one
		$this->add_control(
			'aefe-pt-background-image',
			[
				'label' => esc_html__( 'Background Image', AEFE_TEXTDOMAIN ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => AEFE_URL . 'assets/img/pricing-header-bg.png',	
				],
				'condition' => [
					'aefe_pricing_tb_background_type' => 'Image',
					'aefe-pt-style' => 'style-one',
				]
			]
		);

		// Header Background Image for style two
		$this->add_control(
			'aefe-pt-background-image-two',
			[
				'label' => esc_html__( 'Background Image', AEFE_TEXTDOMAIN ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => AEFE_URL . 'assets/img/pricing-header-style-two-bg.png',	
				],
				'condition' => [
					'aefe_pricing_tb_background_type' => 'Image',
					'aefe-pt-style' => 'style-two',
				]
			]
		);

		$this->add_control(
			'aefe-pt-header-background-color',
			[
				'label' => esc_html__( 'Background Color', AEFE_TEXTDOMAIN ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selector' => '{{WRAPPER}} .aefe-pt-single-pricing-table-header',
				'default' => '#0081FF',
				'condition' => [
					'aefe_pricing_tb_background_type' => 'color',
				]
			]
		);

		//Heading Color
		$this->add_control(
			'aefe-pricing-heading-color',
			[
				'label' => esc_html__( 'Title Color', 'aefe' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .aefe-pt-single-pricing-table-header h2' => 'color: {{VALUE}}',
				],
			]
		);

		//Title Typhography
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'aefe-pt-title-typography',
				'selector' => '{{WRAPPER}} .aefe-pt-single-pricing-table-header h2',
			]
		);


		$this->end_controls_section(); // Pricing Header Section Style

		// Pricing Pricing Section Style
		$this->start_controls_section(
			'aefe_pt-price_style',
			[
				'label'		=> esc_html__( 'Pricing', 'aefe' ),
				'tab'		=> \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		//Pricing Color
		$this->add_control(
			'aefe-pricing-price-color',
			[
				'label' => esc_html__( 'Price Color', 'aefe' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .aefe-pt-single-pricing-price h2' => 'color: {{VALUE}}',
				],
			]
		);

		//Price Typhography
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'label'		=> esc_html__( 'Typography', 'aefe' ),
				'name' => 'aefe-pt-price-typography',
				'selector' => '{{WRAPPER}} .aefe-pt-single-pricing-price h2',
			]
		);


		$this->end_controls_section(); // Pricing Pricing Section Style

		// Pricing Content Section Style
		$this->start_controls_section(
			'aefe_pt-content_style',
			[
				'label'		=> esc_html__( 'Content', 'aefe' ),
				'tab'		=> \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		//content Color
		$this->add_control(
			'aefe-pricing-content-color',
			[
				'label' => esc_html__( 'Content Color', 'aefe' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .aefe-pt-single-pricing-content' => 'color: {{VALUE}}',
				],
			]
		);

		//Content Typhography
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'label'		=> esc_html__( 'Typography', 'aefe' ),
				'name' => 'aefe-pt-content-typography',
				'selector' => '{{WRAPPER}} .aefe-pt-single-pricing-content',
			]
		);


		$this->end_controls_section(); // Pricing Content Section Style
	
		// Pricing Button Section Style
        $this->start_controls_section(
			'aefe_pt_btn_section_style',
			[
				'label' =>esc_html__( 'Button', 'aefe'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'width',
			[
				'label'			=> esc_html__( 'Width (%)', 'aefe'),
				'type'			=> \Elementor\Controls_Manager::SLIDER,
				'selectors'		=> [
					'{{WRAPPER}} .aefe-pt-style-two .aefe-pt-single-pricing-buy' => 'width: {{SIZE}}%;',
				]
			]
		);

		$this->add_responsive_control(
			'aefe_pt_btn_text_padding',
			[
				'label' =>esc_html__( 'Padding', 'aefe'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .aefe-pt-style-two .aefe-pt-single-pricing-buy a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'aefe_pt_btn_typography',
				'label' =>esc_html__( 'Typography', 'aefe'),
				'selector' => '{{WRAPPER}} .aefe-pt-style-two .aefe-pt-single-pricing-buy a',
			]
		);

        $this->add_group_control(
        	\Elementor\Group_Control_Text_Shadow::get_type(),
        	[
        		'name' => 'aefe_pt_btn_shadow',
        		'selector' => '{{WRAPPER}} .aefe-pt-style-two .aefe-pt-single-pricing-buy a',
        	]
        );

		$this->start_controls_tabs( 'aefe_pt_btn_tabs_style' );

		$this->start_controls_tab(
			'aefe_pt_btn_tab_normal',
			[
				'label' =>esc_html__( 'Normal', 'aefe'),
			]
		);

		$this->add_control(
			'aefe_pt_btn_text_color',
			[
				'label' =>esc_html__( 'Text Color', 'aefe'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .aefe-pt-style-two .aefe-pt-single-pricing-buy a' => 'color: {{VALUE}};',
					'{{WRAPPER}} .aefe-pt-style-two .aefe-pt-single-pricing-buy a' => 'stroke: {{VALUE}}; fill: {{VALUE}};',
				],
			]
		);

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            array(
				'name'     => 'aefe_pt_btn_bg_color',				
				'selector' => '{{WRAPPER}} .aefe-pt-style-two .aefe-pt-single-pricing-buy a',
            )
        );

		$this->end_controls_tab();

		$this->start_controls_tab(
			'aefe_pt_btn_tab_button_hover',
			[
				'label' =>esc_html__( 'Hover', 'aefe'),
			]
		);

		$this->add_control(
			'aefe_pt_btn_hover_color',
			[
				'label' =>esc_html__( 'Text Color', 'aefe'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .aefe-pt-style-two.aefe-pt-single-pricing-table:hover .aefe-pt-st-two-b.aefe-pt-single-pricing-buy a' => 'color: {{VALUE}};',					
				],
			]
		);

	    $this->add_group_control(
		    \Elementor\Group_Control_Background::get_type(),
		    array(
			    'name'     => 'aefe_pt_btn_bg_hover_color',
			    'default' => '',
			    'selector' => '{{WRAPPER}} .aefe-pt-style-two.aefe-pt-single-pricing-table:hover .aefe-pt-st-two-b.aefe-pt-single-pricing-buy a',
		    )
	    );

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

        $this->start_controls_section(
			'aefe_pt_btn_border_style_tabs',
			[
				'label' =>esc_html__( 'Border', 'aefe'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'aefe_pt_btn_border_style',
			[
				'label' => esc_html_x( 'Border Type', 'Border Control', 'aefe'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'none' => esc_html__( 'None', 'aefe'),
					'solid' => esc_html_x( 'Solid', 'Border Control', 'aefe'),
					'double' => esc_html_x( 'Double', 'Border Control', 'aefe'),
					'dotted' => esc_html_x( 'Dotted', 'Border Control', 'aefe'),
					'dashed' => esc_html_x( 'Dashed', 'Border Control', 'aefe'),
					'groove' => esc_html_x( 'Groove', 'Border Control', 'aefe'),
				],
				'default'	=> 'none',
				'selectors' => [
					'{{WRAPPER}} .aefe-pt-style-two .aefe-pt-single-pricing-buy a' => 'border-style: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'aefe_pt_btn_border_dimensions',
			[
				'label' 	=> esc_html_x( 'Width', 'Border Control', 'aefe'),
				'type' 		=> \Elementor\Controls_Manager::DIMENSIONS,
				'condition'	=> [
					'aefe_pt_btn_border_style!' => 'none'
				],
				'selectors' => [
					'{{WRAPPER}} .aefe-pt-style-two .aefe-pt-single-pricing-buy a' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->start_controls_tabs( 'xs_tabs_button_border_style' );
		$this->start_controls_tab(
			'aefe_pt_btn_tab_border_normal',
			[
				'label' =>esc_html__( 'Normal', 'aefe'),
			]
		);

		$this->add_control(
			'aefe_pt_btn_border_color',
			[
				'label' => esc_html_x( 'Color', 'Border Control', 'aefe'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .aefe-pt-style-two .aefe-pt-single-pricing-buy a' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'aefe_pt_btn_border_radius',
			[
				'label' =>esc_html__( 'Border Radius', 'aefe'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%'],
				'default' => [
					'top' => '',
					'right' => '',
					'bottom' => '' ,
					'left' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .aefe-pt-style-two .aefe-pt-single-pricing-buy a' =>  'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'aefe_pt_btn_tab_button_border_hover',
			[
				'label' =>esc_html__( 'Hover', 'aefe'),
			]
		);
		$this->add_control(
			'aefe_pt_btn_hover_border_color',
			[
				'label' => esc_html_x( 'Color', 'Border Control', 'aefe'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .aefe-pt-style-two.aefe-pt-single-pricing-table:hover .aefe-pt-st-two-b.aefe-pt-single-pricing-buy a' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'aefe_pt_btn_border_radius_h',
			[
				'label' =>esc_html__( 'Border Radius', 'aefe'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%'],
				'selectors' => [
					'{{WRAPPER}} .elementskit-btn:hover' =>  'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

        $this->start_controls_section(
			'aefe_pt_btn_box_shadow_style',
			[
				'label' =>esc_html__( 'Shadow', 'aefe'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
			  'name' => 'aefe_pt_btn_box_shadow_group',
			  'selector' => '{{WRAPPER}} .aefe-pt-st-two-b.aefe-pt-single-pricing-buy a',
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
		include 'pricing-table-ren.php';


	}


}