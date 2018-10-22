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
 * Fashe elementor about page section widget.
 *
 * @since 1.0
 */
class Fashe_Contact extends Widget_Base {

    public function get_name() {
        return 'fashe-contact';
    }

    public function get_title() {
        return __( 'Contact', 'fashe-companion' );
    }

    public function get_icon() {
        return 'eicon-tel-field';
    }

    public function get_categories() {
        return [ 'fashe-elements' ];
    }

    protected function _register_controls() {

        $repeater = new \Elementor\Repeater();

        // ----------------------------------------  Contact Form  ------------------------------
        
        $this->start_controls_section(
            'contact_form',
            [
                'label' => __( 'Contact Form', 'fashe-companion' ),
            ]
        );
        $this->add_control(
            'contact_title',
            [
                'label'     => esc_html__( 'Title', 'fashe-companion' ),
                'type'      => Controls_Manager::TEXT,
                'label_block' => true,
                'default'   => 'Send us your message',
            ]
        );
        $this->add_control(
            'contact_formshortcode',
            [
                'label'     => esc_html__( 'Form Shortcode', 'fashe-companion' ),
                'type'      => Controls_Manager::WYSIWYG,
            ]
        );
        $this->end_controls_section(); // End Contact Form
        // ----------------------------------------  Contact Map ------------------------------
        $this->start_controls_section(
            'contact_map',
            [
                'label' => __( 'Map', 'fashe-companion' ),
            ]
        );
        $this->add_control(
            'map_lat',
            [
                'label'     => esc_html__( 'Latitude', 'fashe-companion' ),
                'type'      => Controls_Manager::TEXT ,
            ]
        );
        $this->add_control(
            'map_lng',
            [
                'label'     => esc_html__( 'Longitude', 'fashe-companion' ),
                'type'      => Controls_Manager::TEXT ,
            ]
        );
        $this->add_control(
            'map_markertext',
            [
                'label'     => esc_html__( 'Marker Text', 'fashe-companion' ),
                'type'      => Controls_Manager::TEXTAREA ,
            ]
        );
        $this->add_control(
            'map_markerimg',
            [
                'label'     => esc_html__( 'Marker Icon Upload', 'fashe-companion' ),
                'type'      => Controls_Manager::MEDIA ,
            ]
        );
        $this->end_controls_section(); // End content


        /**
         * Style Tab
         * ------------------------------ Style ------------------------------
         *
         */
        $this->start_controls_section(
            'stylecolor', [
                'label' => __( 'Style Color', 'fashe-companion' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'color_title', [
                'label'     => __( 'Title Color', 'fashe-companion' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#333333',
                'selectors' => [
                    '{{WRAPPER}} .leave-comment h4' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'color_btntext', [
                'label'     => __( 'Button text color', 'fashe-companion' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .bg1.bo-rad-23.hov1' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'color_border', [
                'label'     => __( 'Button text hover color', 'fashe-companion' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .bg1.bo-rad-23.hov1:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'color_btnbg', [
                'label'     => __( 'Button background color', 'fashe-companion' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#222222',
                'selectors' => [
                    '{{WRAPPER}}  .bg1.bo-rad-23.hov1' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'color_btnbghov', [
                'label'     => __( 'Button Hover background color', 'fashe-companion' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#e65540',
                'selectors' => [
                    '{{WRAPPER}} .bg1.bo-rad-23.hov1:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );


        $this->end_controls_section();


    }

    protected function render() {

    $settings = $this->get_settings();

     wp_enqueue_script( 'maps-googleapis' );
     wp_enqueue_script( 'fashe-map-custom' );

     if( !empty( $settings['map_markertext'] ) ){
        wp_localize_script( 'fashe-map-custom', 'fashemapmarkertext', array(
            'map_markertext' => esc_html( $settings['map_markertext'] )
        ) );
     }


    ?>
    <!-- content page -->
    <section class="p-t-66 p-b-60">
        <div class="container">
            <div class="row">
                <?php 
                if( !empty( $settings['map_lat'] ) && !empty( $settings['map_lng'] ) && !empty( $settings['map_markerimg']['url'] ) ):
                ?>
                <div class="col-md-6 p-b-30">
                    <div class="p-r-20 p-r-0-lg">
                        <div class="contact-map size21" id="google_map" data-map-x="<?php echo esc_html( $settings['map_lat'] ); ?>" data-map-y="<?php echo esc_attr( $settings['map_lng'] ); ?>" data-pin="<?php echo esc_url( $settings['map_markerimg']['url'] ); ?>" data-scrollwhell="0" data-draggable="1"></div>
                    </div>
                </div>
                <?php 
                endif;
                ?>
                <div class="col-md-6 p-b-30">
                    <div class="leave-comment">
                        <?php 
                        if( !empty( $settings['contact_title'] ) ){
                            echo '<h4 class="m-text26 p-b-36 p-t-15">'.esc_html( $settings['contact_title'] ).'</h4>';
                        }
                        //
                        if( !empty( $settings['contact_formshortcode'] ) ){
                            echo fashe_get_textareahtml_output( $settings['contact_formshortcode'] );
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php

        }
    
}
