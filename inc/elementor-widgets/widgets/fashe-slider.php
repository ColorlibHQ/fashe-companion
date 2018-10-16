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
 * Fashe elementor slider section widget.
 *
 * @since 1.0
 */
class Fashe_Slider extends Widget_Base {

	public function get_name() {
		return 'fashe-slider';
	}

	public function get_title() {
		return __( 'Hero Section Slider', 'fashe-companion' );
	}

	public function get_icon() {
		return 'eicon-slider-push';
	}

	public function get_categories() {
		return [ 'fashe-elements' ];
	}

	protected function _register_controls() {

		$repeater = new \Elementor\Repeater();

		// ----------------------------------------  Slider content ------------------------------
		$this->start_controls_section(
			'slider_content',
			[
				'label' => __( 'Slider content', 'fashe-companion' ),
			]
		);
        $this->add_control(
            'slider_style',
            [
                'label' => __( 'Slider Style', 'fashe-companion' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'style_1',
                'label_block' => true,
                'options' => [
                    'style_1'  => __( 'Style 1', 'fashe-companion' ),
                    'style_2'  => __( 'Style 2', 'fashe-companion' ),
                ],
            ]
        );
		$this->add_control(
            'fasheslider', [
                'label' => __( 'Create Slider', 'fashe-companion' ),
                'type' => Controls_Manager::REPEATER,
                'title_field' => '{{{ label }}}',
                'fields' => [
                    [
                        'name' => 'label',
                        'label' => __( 'Title', 'fashe-companion' ),
                        'type' => Controls_Manager::TEXT,
                        'label_block' => true,
                        'default' => 'Women Collection 2018'
                    ],
                    [
                        'name' => 'titleanimation',
                        'label' => __( 'Title Animation', 'fashe-companion' ),
                        'type' => Controls_Manager::ANIMATION,
                        'label_block' => true,
                    ],
                    [
                        'name' => 'titletwo',
                        'label' => __( 'Sub Title', 'fashe-companion' ),
                        'type' => Controls_Manager::TEXT,
                        'label_block' => true,
                        'default' => 'New arrivals'
                    ],
                    [
                        'name' => 'titletwoanimation',
                        'label' => __( 'Sub Title Animation', 'fashe-companion' ),
                        'type' => Controls_Manager::ANIMATION,
                        'label_block' => true,
                    ],
                    [
                        'name' => 'btnlabel',
                        'label' => __( 'Button Text', 'fashe-companion' ),
                        'type' => Controls_Manager::TEXT,
                        'label_block' => true,
                        'default' => 'Shop Now'
                    ],
                    [
                        'name' => 'btnurl',
                        'label' => __( 'Button Url', 'fashe-companion' ),
                        'show_external' => false,
                        'type' => Controls_Manager::URL,
                    ],
                    [
                        'name' => 'buttonanimation',
                        'label' => __( 'Button Animation', 'fashe-companion' ),
                        'type' => Controls_Manager::ANIMATION,
                        'label_block' => true,
                    ],
                    [
                        'name' => 'img',
                        'label' => __( 'Slider Background Image', 'fashe-companion' ),
                        'type' => Controls_Manager::MEDIA,
                    ],


                ],
            ]
		);
		$this->end_controls_section(); // End slider content

        //------------------------------ Style title  ------------------------------
        $this->start_controls_section(
            'style_titletwo', [
                'label' => __( 'Style Title ', 'fashe-companion' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'color_titletwo', [
                'label' => __( 'Title Color', 'fashe-companion' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .caption2-slide1.xl-text1' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .caption2-slide1.xl-text1.bo14' => 'border-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_titletwo',
                'selector' => '{{WRAPPER}} .caption2-slide1.xl-text1',
            ]
        );
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(), [
                'name' => 'text_shadow_titletwo',
                'selector' => '{{WRAPPER}} .caption2-slide1.xl-text1',
            ]
        );
        $this->end_controls_section();

        /**
         * Style Tab
         * ------------------------------ Style Sub Title ------------------------------
         *
         */
        $this->start_controls_section(
            'style_title', [
                'label' => __( 'Style Sub Title', 'fashe-companion' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'color_title', [
                'label' => __( 'Sub Title Color', 'fashe-companion' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .caption1-slide1.m-text1' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_title',
                'selector' => '{{WRAPPER}} .caption1-slide1.m-text1',
            ]
        );
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(), [
                'name' => 'text_shadow_title',
                'selector' => '{{WRAPPER}} .caption1-slide1.m-text1',
            ]
        );
        $this->end_controls_section();

        //------------------------------ Style Button ------------------------------
        $this->start_controls_section(
            'style_btn', [
                'label' => __( 'Style Button', 'fashe-companion' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'color_btntext', [
                'label' => __( 'Button Text Color', 'fashe-companion' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#111111',
                'selectors' => [
                    '{{WRAPPER}} .flex-c-m.size2.bo-rad-23.hov1' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'color_btnhovtext', [
                'label' => __( 'Button Hover Text Color', 'fashe-companion' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#111111',
                'selectors' => [
                    '{{WRAPPER}} .flex-c-m.size2.bo-rad-23.hov1:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'color_btnbg', [
                'label' => __( 'Button background Color', 'fashe-companion' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .flex-c-m.size2.bo-rad-23.hov1' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'color_btnhovbg', [
                'label' => __( 'Button Hover background Color', 'fashe-companion' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#e65540',
                'selectors' => [
                    '{{WRAPPER}} .flex-c-m.size2.bo-rad-23.hov1:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_btn',
                'selector' => '{{WRAPPER}} .flex-c-m.size2.bo-rad-23.hov1',
            ]
        );

        $this->end_controls_section();


	}

	protected function render() {

    $settings = $this->get_settings();


    ?>
    <!-- Slide1 -->
    <section class="slide1">
        <div class="wrap-slick1">
            <div class="slick1">
                <?php 
                if( is_array( $settings['fasheslider'] ) && count( $settings['fasheslider'] ) > 0 ):

                    $i = 0;
                    foreach( $settings['fasheslider'] as  $slider ):

                    $i++;


                ?>
                <div class="item-slick1 item<?php echo esc_attr( $i ); ?>-slick1" <?php echo fashe_inline_bg_img( esc_url( $slider['img']['url'] ) ); ?> >
                    <div class="wrap-content-slide1 sizefull flex-col-c-m p-l-15 p-r-15 p-t-150 p-b-170">
                        
                        <?php 
                        if( $settings['slider_style'] == 'style_2' && $slider['label'] ):
                        ?>
                        <h2 class="caption2-slide1 xl-text1 bo14 t-center animated visible-false m-b-37" data-appear="<?php echo esc_attr( !empty(  $slider['titleanimation'] ) ? $slider['titleanimation'] : '' ); ?>">
                            <?php echo esc_html( $slider['label'] ); ?>
                        </h2>
                        <?php 
                        endif;
                        //$sliderstyle;
                        
                        if( !empty( $slider['titletwo'] ) ):
                        ?>
                        <span class="caption1-slide1 m-text1 t-center animated visible-false m-b-15" data-appear="<?php echo esc_attr( !empty(  $slider['titletwoanimation'] ) ? $slider['titletwoanimation'] : '' ); ?>">
                            <?php echo esc_html( $slider['titletwo'] ); ?>
                        </span>
                        <?php 
                        endif;
                        //
                        
                        if( $settings['slider_style'] == 'style_1' && $slider['label'] ):
                        ?>
                        <h2 class="caption2-slide1 xl-text1 t-center animated visible-false m-b-37" data-appear="<?php echo esc_attr( !empty(  $slider['titleanimation'] ) ? $slider['titleanimation'] : '' ); ?>">
                            <?php echo esc_html( $slider['label'] ); ?>
                        </h2>
                        <?php 
                        endif;
                        //
                        if( !empty( $slider['btnlabel'] ) && !empty( $slider['btnurl']['url'] ) ):
                        ?>

                        <div class="wrap-btn-slide1 w-size1 animated visible-false" data-appear="<?php echo esc_attr( !empty(  $slider['buttonanimation'] ) ? $slider['buttonanimation'] : '' ); ?>">
                            <!-- Button -->
                            <a href="<?php echo esc_url( $slider['btnurl']['url'] ); ?>" class="flex-c-m size2 bo-rad-23 s-text2 bgwhite hov1 trans-0-4">
                                <?php echo esc_html( $slider['btnlabel'] ); ?>
                            </a>
                        </div>
                        <?php 
                        endif;
                        ?>
                    </div>
                </div>
                <?php
                endforeach; 
                endif;
                ?>

            </div>
        </div>
    </section>

    <?php

        }
	
}
