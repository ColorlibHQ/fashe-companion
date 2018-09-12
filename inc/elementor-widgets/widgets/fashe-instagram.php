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
 * Fashe elementor Instagram section widget.
 *
 * @since 1.0
 */
class Fashe_Instagram extends Widget_Base {

	public function get_name() {
		return 'fashe-instagram';
	}

	public function get_title() {
		return __( 'Instagram Section', 'fashe-companion' );
	}

	public function get_icon() {
		return 'eicon-gallery-grid';
	}

	public function get_categories() {
		return [ 'fashe-elements' ];
	}

	protected function _register_controls() {

        $repeater = new \Elementor\Repeater();
		

        // ----------------------------------------  Instagram settings ------------------------------
        $this->start_controls_section(
            'settings_instagram',
            [
                'label' => __( 'Instagram settings', 'fashe-companion' ),
            ]
        );
        $this->add_control(
            'section_title', [
                'label' => __( 'Section Title', 'fashe-companion' ),
                'type'  => Controls_Manager::TEXT,

            ]
        );
        $this->add_control(
            'img_limit', [
                'label'   => __( 'Image Limit', 'fashe-companion' ),
                'type'    => Controls_Manager::NUMBER,
                'default' => '5',

            ]
        );
        $this->add_control(
            'img_width', [
                'label'    => __( 'Image Widht', 'fashe-companion' ),
                'type'     => Controls_Manager::NUMBER,
                'default'  => '420'

            ]
        );

        $this->end_controls_section(); // End Instagram settings



        /**
         * Style Tab
         * ------------------------------ Style Title ------------------------------
         *
         */
        $this->start_controls_section(
            'style_title', [
                'label' => __( 'Style Title', 'fashe-companion' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'color_title', [
                'label'   => __( 'Title Color', 'fashe-companion' ),
                'type'    => Controls_Manager::COLOR,
                'default' => '#222222',
                'selectors' => [
                    '{{WRAPPER}} .instagram .sec-title h3' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_title',
                'selector' => '{{WRAPPER}} .instagram .sec-title h3',
            ]
        );
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(), [
                'name' => 'text_shadow_title',
                'selector' => '{{WRAPPER}} .instagram .sec-title h3',
            ]
        );
        $this->end_controls_section();



	}

	protected function render() {

    $settings = $this->get_settings();

    $api = fashe_instagram_instance();

    $getitems   = $api->get_items( $settings['img_limit'], $settings['img_width'] );
    $items      = $getitems['items'];
    $username   = $getitems['username'];
    ?>
    <section class="instagram p-t-20">
        <?php 
        // Title
        if( !empty( $settings['section_title'] ) ){
            echo fashe_heading_tag(
                array(
                    'tag'         => 'h3',
                    'text'        => esc_html( $settings['section_title'] ),
                    'class'       => 'm-text5 t-center',
                    'wrap_before' => '<div class="sec-title p-b-52 p-l-15 p-r-15">',
                    'wrap_after'  => '</div>',
                )
            );

        }
        ?>

        <div class="flex-w">
            <?php 
            if( is_array( $items ) && count( $items ) > 0 ):
            foreach( $items as $item ):
            
            $link       = $item['link'];
            $src        = $item['image-url'];
            $likes      = $item['likes'];
            $comments   = $item['comments'];
            $location   = $item['location'];
            
            ?>
            <div class="block4 wrap-pic-w">
                <img src="<?php echo esc_url( $src ); ?>" alt="IMG-INSTAGRAM">
                <a href="<?php echo esc_url( $link ); ?>" class="block4-overlay sizefull ab-t-l trans-0-4">
                    <span class="block4-overlay-heart s-text9 flex-m trans-0-4 p-l-40 p-t-25">
                        <i class="icon_heart_alt fs-20 p-r-12" aria-hidden="true"></i>
                        <span class="p-t-2"><?php echo esc_html( $likes ); ?></span>
                    </span>

                    <div class="block4-overlay-txt trans-0-4 p-l-40 p-r-25 p-b-30">
                        <?php 
                        if( $location ):
                        ?>
                        <p class="s-text10 m-b-15 h-size1 of-hidden"><?php echo esc_html( $location ); ?></p>
                        <?php 
                        endif;
                        ?>
                        <span class="s-text9">
                            <?php echo sprintf( __( 'Photo by @%s', 'fashe' ), esc_html( $username ) ); ?>
                        </span>
                    </div>
                </a>
            </div>
            <?php
            endforeach;
            endif;
            ?>
        </div>
    </section>

    <?php

        }
	
}
