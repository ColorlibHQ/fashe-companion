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
 * Fashe elementor our product section widget.
 *
 * @since 1.0
 */
class Fashe_Our_Products extends Widget_Base {

    public function get_name() {
        return 'fashe-ourproduct';
    }

    public function get_title() {
        return __( 'Our Product', 'fashe-companion' );
    }

    public function get_icon() {
        return 'eicon-product-tabs';
    }

    public function get_categories() {
        return [ 'fashe-elements' ];
    }

    protected function _register_controls() {

        $repeater = new \Elementor\Repeater();

        // ----------------------------------------  Our Product content ------------------------------
        $this->start_controls_section(
            'ourproduct_content',
            [
                'label' => __( 'Our Product', 'fashe-companion' ),
            ]
        );
        $this->add_control(
            'ptoduct_limit',
            [
                'label' => esc_html__( 'Product Limit', 'fashe-companion' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 8
            ]
        );
        $this->add_control(
            'product_secttitle',
            [
                'label' => esc_html__( 'Section Title', 'fashe-companion' ),
                'type' => Controls_Manager::TEXT,
            ]
        );

        $this->end_controls_section(); // End Features content

    /**
     * Style Tab
     * ------------------------------ Style section title ------------------------------
     *
     */
        $this->start_controls_section(
            'style_sectiontitle', [
                'label' => __( 'Style Section Title', 'fashe-companion' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'color_title', [
                'label' => __( 'Title Color', 'fashe-companion' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#222222',
                'selectors' => [
                    '{{WRAPPER}} .sec-title .m-text5' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_title',
                'selector' => '{{WRAPPER}} .sec-title .m-text5',
            ]
        );
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(), [
                'name' => 'text_shadow_title',
                'selector' => '{{WRAPPER}} .sec-title .m-text5',
            ]
        );
        $this->end_controls_section();

    /**
     * Style Tab
     * ------------------------------ Style Filter ------------------------------
     *
     */
        $this->start_controls_section(
            'style_filter', [
                'label' => __( 'Style Filter', 'fashe-companion' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'color_filter', [
                'label' => __( 'Filter Color', 'fashe-companion' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#888888',
                'selectors' => [
                    '{{WRAPPER}} .tab01 .nav-link' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'color_filterhov', [
                'label' => __( 'Filter Hover Color', 'fashe-companion' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#333333',
                'selectors' => [
                    '{{WRAPPER}} .tab01 .nav-link:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_filter',
                'selector' => '{{WRAPPER}} .tab01 .nav-link',
            ]
        );

        $this->end_controls_section();



    }

    protected function render() {

    $settings = $this->get_settings();

    $postnumber = 4;
    if( !empty( $settings['ptoduct_limit'] ) ){
        $postnumber = $settings['ptoduct_limit'];
    }
    
 
    ?>
    <!-- Our product -->
    <section class="bgwhite p-t-115 p-b-58">
        <div class="container">
            <?php           
            
            if( !empty( $settings['product_secttitle'] ) ){
                echo fashe_heading_tag(
                    array(
                        'tag'         => 'h3',
                        'text'        => esc_html( $settings['product_secttitle'] ),
                        'class'       => 'm-text5 t-center',
                        'wrap_before' => '<div class="sec-title p-b-22">',
                        'wrap_after'  => '</div>',
                    )
                );
            }
            ?>

            <div class="tab01">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#best-seller" role="tab"><?php esc_html_e( 'Best Seller', 'fashe' ); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#featured" role="tab"><?php esc_html_e( 'Featured', 'fashe' ); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#sale" role="tab"><?php esc_html_e( 'Sale', 'fashe' ); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#top-rate" role="tab"><?php esc_html_e( 'Top Rate', 'fashe' ); ?></a>
                    </li>
                </ul>
                <?php 
                // Our Product
                fashe_our_product( esc_html( $postnumber ) );
                ?>

            </div>

        </div>
    </section>


    <?php

        }
    
}
