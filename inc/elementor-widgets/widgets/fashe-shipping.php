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
 * Fashe elementor shipping info section widget.
 *
 * @since 1.0
 */
class Fashe_Shipping extends Widget_Base {

	public function get_name() {
		return 'fashe-shipping';
	}

	public function get_title() {
		return __( 'Shipping Info Section', 'fashe-companion' );
	}

	public function get_icon() {
		return 'eicon-product-info';
	}

	public function get_categories() {
		return [ 'fashe-elements' ];
	}

	protected function _register_controls() {

		$repeater = new \Elementor\Repeater();

		// ----------------------------------------  Shipping content ------------------------------
        
		$this->start_controls_section(
			'shipping_content',
			[
				'label' => __( 'Shipping Information Content', 'fashe-companion' ),
			]
		);
        $this->add_control(
            'shippingcontent', [
                'label' => __( 'Shipping Information', 'fashe-companion' ),
                'type'  => Controls_Manager::REPEATER,
                'title_field' => '{{{ label }}}',
                'fields' => [
                    [
                        'name' => 'label',
                        'label' => __( 'Title Top', 'fashe-companion' ),
                        'type' => Controls_Manager::TEXT,
                        'label_block' => true,
                        'default' => 'Free Delivery Worldwide'
                    ],
                    [
                        'name' => 'uselink',
                        'label' => __( 'Title Botom Link', 'fashe-companion' ),
                        'type' => \Elementor\Controls_Manager::SWITCHER,
                        'label_on'  => __( 'Yes', 'fashe-companion' ),
                        'label_off' => __( 'No', 'fashe-companion' ),
                        'return_value' => 'yes',
                        'default'      => 'yes',                        
                    ],
                    [
                        'name' => 'titlebottom',
                        'label' => __( 'Title Bottom', 'fashe-companion' ),
                        'type' => Controls_Manager::TEXT,
                        'label_block' => true,
                        'default' => 'Simply return it within 30 days for an exchange.'
                    ],
                    [
                        'name' => 'tblink',
                        'label' => __( 'Title Bottom Link', 'fashe-companion' ),
                        'type' => Controls_Manager::URL,
                        'label_block' => true,
                        'show_external' => false,
                        'condition' => [
                            'uselink' => 'yes',
                        ]
                    ],
                    [
                        'name' => 'border',
                        'label' => __( 'Set Border', 'fashe-companion' ),
                        'type' => \Elementor\Controls_Manager::SWITCHER,
                        'label_on' => __( 'Yes', 'fashe-companion' ),
                        'label_off' => __( 'No', 'fashe-companion' ),
                        'return_value' => 'yes',
                        'default' => 'no',                        
                    ],
                ],
            ]
        );

		$this->end_controls_section(); // End map content

        /**
         * Style Tab
         * ------------------------------ Style ------------------------------
         *
         */
        $this->start_controls_section(
            'textcolor', [
                'label' => __( 'Text Color', 'fashe-companion' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'color_titletop', [
                'label' => __( 'Title Top Color', 'fashe-companion' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#555555',
                'selectors' => [
                    '{{WRAPPER}} .shipping .m-text12' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'color_titlebottom', [
                'label' => __( 'Title Bottom Color', 'fashe-companion' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#888888',
                'selectors' => [
                    '{{WRAPPER}} .shipping .s-text11' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'color_linkhover', [
                'label' => __( 'Link Hover Color', 'fashe-companion' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#e65540',
                'selectors' => [
                    '{{WRAPPER}} .shipping a.s-text11:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'color_border', [
                'label' => __( 'Border Color', 'fashe-companion' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#d9d9d9',
                'selectors' => [
                    '{{WRAPPER}} .shipping .bo2' => 'border-color: {{VALUE}};',
                ],
            ]
        );


        $this->end_controls_section();


	}

	protected function render() {

    $settings = $this->get_settings();

    ?>

    <!-- Shipping -->
    <section class="shipping p-t-62 p-b-46">
        <div class="flex-w p-l-15 p-r-15">
            <?php 
            if( is_array( $settings['shippingcontent'] ) && count( $settings['shippingcontent'] ) > 0 ):
                foreach( $settings['shippingcontent'] as $info ):
                $border = 'respon1';
                if( !empty( $info['border'] ) ){
                    $border = 'bo2 respon2';
                }
            ?>
            <div class="flex-col-c w-size5 p-l-15 p-r-15 p-t-16 p-b-15 <?php echo esc_attr( $border ); ?>">
                <?php 
                    // Title
                    if( !empty( $info['label'] ) ){
                        echo fashe_heading_tag(
                            array(
                                'tag'         => 'h4',
                                'text'        => esc_html( $info['label'] ),
                                'class'       => 'm-text12 t-center',
                            )
                        );
                    }
                    // title bottom with anchor
                    if( !empty( $info['uselink'] ) ){

                        if( !empty( $info['titlebottom'] ) && !empty( $info['tblink']['url'] ) ){
                            echo fashe_anchor_tag(
                                array(
                                'url'       => esc_url( $info['tblink']['url'] ),
                                'class'     => 's-text11 t-center',
                                'text'      => esc_html( $info['titlebottom'] ),
                                )
                            );
                        }
                    }else{
                        // title bottom
                        if( !empty( $info['titlebottom'] ) ){
                            echo fashe_other_tag(
                                array(
                                    'tag'         => 'span',
                                    'text'        => esc_html( $info['titlebottom'] ),
                                    'class'       => 's-text11 t-center',
                                )
                            );
                        }
                    }
                ?>
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
