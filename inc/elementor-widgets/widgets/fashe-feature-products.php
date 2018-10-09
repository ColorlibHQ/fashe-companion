<?php
namespace Fasheelementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;



// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 *
 * Fashe elementor counter section widget.
 *
 * @since 1.0
 */
class Fashe_Feature_Products extends Widget_Base {

	public function get_name() {
		return 'fashe-featured-products';
	}

	public function get_title() {
		return __( 'Featured Products', 'fashe-companion' );
	}

	public function get_icon() {
		return 'eicon-product-images';
	}

	public function get_categories() {
		return [ 'fashe-elements' ];
	}

	protected function _register_controls() {

		$repeater = new \Elementor\Repeater();

		// ----------------------------------------  Counter content ------------------------------
		$this->start_controls_section(
			'featured_products',
			[
				'label' => __( 'Featured Products Settings', 'fashe-companion' ),
			]
		);
        $this->add_control(
            'sectiontitle', [
                'label' => __( 'Section Title', 'fashe-companion' ),
                'type'  => Controls_Manager::TEXT,
                'label_block' => true
            ]
        );

        $this->add_control(
            'postlimit', [
                'label' => __( 'Post Limit', 'fashe-companion' ),
                'type'  => Controls_Manager::NUMBER,
                'label_block' => true,
                'default'     => 6
            ]
        );
		$this->end_controls_section(); // End counter content


        //------------------------------ Style title ------------------------------
        $this->start_controls_section(
            'style_title', [
                'label' => __( 'Style Section Title', 'fashe-companion' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'color_title', [
                'label'  => __( 'Title Color', 'fashe-companion' ),
                'type'   => Controls_Manager::COLOR,
                'default' => '#222222',
                'selectors' => [
                    '{{WRAPPER}} .newproduct h3.m-text5' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name'      => 'typography_title',
                'selector'  => '{{WRAPPER}} .newproduct h3.m-text5',
            ]
        );
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(), [
                'name'      => 'text_shadow_title',
                'selector'  => '{{WRAPPER}} .newproduct h3.m-text5',
            ]
        );
        $this->add_control(
            'color_productprice', [
                'label'  => __( 'Product title and price color', 'fashe-companion' ),
                'type'   => Controls_Manager::COLOR,
                'default' => '#222222',
                'selectors' => [
                    '{{WRAPPER}} .newproduct .block2 .s-text3' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .newproduct .block2 .m-text6' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'color_producttitlehov', [
                'label'  => __( 'Product title hover color', 'fashe-companion' ),
                'type'   => Controls_Manager::COLOR,
                'default' => '#e65540',
                'selectors' => [
                    '{{WRAPPER}} .newproduct .block2 .s-text3:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_section();

	}

	protected function render() {

    $settings = $this->get_settings();

    ?>

    <!-- New Product -->
    <section class="newproduct p-t-45 p-b-105">
        <div class="container">
            <?php 
            if( !empty( $settings['sectiontitle'] ) ){
                echo fashe_heading_tag(
                    array(
                        'tag'         => 'h3',
                        'text'        => esc_html( $settings['sectiontitle'] ),
                        'class'       => 'm-text5 t-center',
                        'wrap_before' => '<div class="sec-title p-b-52">',
                        'wrap_after'  => '</div>',
                    )
                );
            }
            // Featured products
            fashe_featured_products( $settings['postlimit'] );
            ?>

        </div>
    </section>


    <?php

        }
	
}
