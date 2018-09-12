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
 * Fashe elementor about us section widget.
 *
 * @since 1.0
 */
class Fashe_Banner_Video extends Widget_Base {

	public function get_name() {
		return 'fashe-banner-video';
	}

	public function get_title() {
		return __( 'Banner Video', 'fashe-companion' );
	}

	public function get_icon() {
		return 'eicon-youtube';
	}

	public function get_categories() {
		return [ 'fashe-elements' ];
	}

	protected function _register_controls() {

		$repeater = new \Elementor\Repeater();

        // ----------------------------------------  content ------------------------------
        $this->start_controls_section(
            'bannervideo_content',
            [
                'label' => __( 'Banner Video Section Content', 'fashe-companion' ),
            ]
        );
        $this->add_control(
            'bannervideo_titleone',
            [
                'label' => esc_html__( 'Title #1', 'fashe-companion' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true
            ]
        );
        $this->add_control(
            'bannervideo_titletwo',
            [
                'label' => esc_html__( 'Title #2', 'fashe-companion' ),
                'type'  => Controls_Manager::TEXT,
                'label_block' => true
            ]
        );
        $this->add_control(
            'bannervideo_linktext',
            [
                'label' => esc_html__( 'Link Title', 'fashe-companion' ),
                'type'  => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__( 'PLAY VIDEO', 'fashe' )
            ]
        );
        $this->add_control(
            'bannervideo_videourl',
            [
                'label' => esc_html__( 'Video Url', 'fashe-companion' ),
                'type'  => Controls_Manager::URL,
                'show_external' => false
            ]
        );

        $this->end_controls_section(); // End content


        //------------------------------ Style title ------------------------------
        $this->start_controls_section(
            'style_textcolor', [
                'label' => __( 'Style Title', 'fashe-companion' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'color_titleone', [
                'label' => __( 'Title #1 Color', 'fashe-companion' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .flex-col-c-m .m-text9' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'color_titletwo', [
                'label' => __( 'Title #2 Color', 'fashe-companion' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .flex-col-c-m .l-text1' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'color_titlethree', [
                'label' => __( 'Link Title Color', 'fashe-companion' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .flex-col-c-m .btn-play' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .flex-col-c-m .hov5:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();


	}

	protected function render() {

    $settings = $this->get_settings();

    $pos = '';
    if( !empty( $settings['featuresvtwo_imgpos'] ) ){
        $pos = 'order-last';
    } 

    ?>
    <section class="parallax0 parallax100">
        <div class="overlay0 p-t-190 p-b-200">
            <div class="flex-col-c-m p-l-15 p-r-15">
                <?php 
                // Text one
                if( !empty( $settings['bannervideo_titleone'] ) ){
                    echo '<span class="m-text9 p-t-45 fs-20-sm">'.esc_html( $settings['bannervideo_titleone'] ).'</span>';
                }
                // Text two
                if( !empty( $settings['bannervideo_titletwo'] ) ){
                    echo '<h3 class="l-text1 fs-35-sm">'.esc_html( $settings['bannervideo_titletwo'] ).'</h3>';
                }
                ?>
                <span class="btn-play s-text4 hov5 cs-pointer p-t-25" data-toggle="modal" data-target="#modal-video-01">
                    <i class="fa fa-play" aria-hidden="true"></i>
                    <?php 
                    if( !empty( $settings['bannervideo_linktext'] ) ){
                        echo esc_html( $settings['bannervideo_linktext'] );
                    }
                    ?>
                </span>
            </div>
        </div>
    </section>
    
    <div class="modal fade" id="modal-video-01" tabindex="-1" data-dismiss="modal" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document" data-dismiss="modal">
        <div class="close-mo-video-01 trans-0-4 teste" data-dismiss="modal" aria-label="Close">&times;</div>

        <div class="wrap-video-mo-01">
            <div class="video-mo-01">
                <?php 
                if( !empty( $settings['bannervideo_videourl']['url'] ) ){
                    echo '<div class="videoframe" data-videourl="'.esc_url( $settings['bannervideo_videourl']['url'] ).'"></div>';
                }
                ?>
            </div>
        </div>
    </div>
    </div>

    <?php

        }
	
}
