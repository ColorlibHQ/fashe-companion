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
 * Fashe elementor product categories section widget.
 *
 * @since 1.0
 */
class Fashe_Product_Categories extends Widget_Base {

	public function get_name() {
		return 'fashe-product-cat';
	}

	public function get_title() {
		return __( 'Product Categories', 'fashe-companion' );
	}

	public function get_icon() {
		return 'eicon-slider-full-screen';
	}

	public function get_categories() {
		return [ 'fashe-elements' ];
	}

	protected function _register_controls() {

		$repeater = new \Elementor\Repeater();

		// ----------------------------------------  Product Category content ------------------------------
		$this->start_controls_section(
			'productcat_content',
			[
				'label' => __( 'Product Category Content', 'fashe-companion' ),

			]
		);
        // Start tabs controls
        $this->start_controls_tabs(
            'productcat_tabs'
        );
        // Start Column 1 tab
        $this->start_controls_tab(
            'col1_cat',
            [
                'label' => __( 'Column 1', 'fashe-companion' ),
            ]
        );
		$this->add_control(
            'pcatone', [
                'label' => __( 'Set Category', 'fashe-companion' ),
                'type' => Controls_Manager::REPEATER,
                'title_field' => '{{{ label }}}',
                'fields' => [
                    [
                        'name' => 'label',
                        'label' => __( 'Category', 'fashe-companion' ),
                        'type' => Controls_Manager::SELECT,
                        'label_block' => true,
                        'default' => '',
                        'options' => fashe_product_cat(),
                    ],
                ],
            ]
		);
        $this->end_controls_tab(); // End Column 1 tab
        
        // Start Column 2 tab
        $this->start_controls_tab(
            'col2_cat',
            [
                'label' => __( 'Column 2', 'fashe-companion' ),
            ]
        );
        $this->add_control(
            'pcattwo', [
                'label' => __( 'Set Category', 'fashe-companion' ),
                'type' => Controls_Manager::REPEATER,
                'title_field' => '{{{ label }}}',
                'fields' => [
                    [
                        'name' => 'label',
                        'label' => __( 'Category', 'fashe-companion' ),
                        'type' => Controls_Manager::SELECT,
                        'label_block' => true,
                        'default' => '',
                        'options' => fashe_product_cat(),
                    ],
                ],
            ]
        );
        $this->end_controls_tab(); // // End Column 2 tab

        // Start Column 3 tab
        $this->start_controls_tab(
            'col3_cat',
            [
                'label' => __( 'Column 3', 'fashe-companion' ),
            ]
        );
        $this->add_control(
            'pcatthree', [
                'label' => __( 'Set Category', 'fashe-companion' ),
                'type' => Controls_Manager::REPEATER,
                'title_field' => '{{{ label }}}',
                'fields' => [
                    [
                        'name' => 'label',
                        'label' => __( 'Category', 'fashe-companion' ),
                        'type' => Controls_Manager::SELECT,
                        'label_block' => true,
                        'default' => '',
                        'options' => fashe_product_cat(),
                    ],
                ],
            ]
        );
        $this->end_controls_tab(); // // End Column 3 tab

        $this->end_controls_tabs(); // End tabs controls
		$this->end_controls_section(); // End Hero content

    // ----------------------------------------  Product offer content ------------------------------
    $this->start_controls_section(
        'offer_content',
        [
            'label' => __( 'Offer Box', 'fashe-companion' ),

        ]
    );
    $this->add_control(
        'show_offerbox',
        [
            'label' => __( 'Show Offer Box', 'fashe-companion' ),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'label_on' => __( 'Show', 'fashe-companion' ),
            'label_off' => __( 'Hide', 'fashe-companion' ),
            'return_value' => 'yes',
            'default' => 'No',
        ]
    );
    $this->add_control(
        'offer_title',
        [
            'label' => esc_html__( 'Title', 'fashe-companion' ),
            'type'  => Controls_Manager::TEXT,
            'label_block' => true
        ]
    );
    $this->add_control(
        'offer_desc',
        [
            'label' => esc_html__( 'Descriptions', 'fashe-companion' ),
            'type'  => Controls_Manager::WYSIWYG,
        ]
    );
    $this->add_control(
        'offer_img',
        [
            'label' => esc_html__( 'Background Image', 'fashe-companion' ),
            'type'  => Controls_Manager::MEDIA,
        ]
    );
    $this->add_control(
        'offer_btntext',
        [
            'label' => esc_html__( 'Button Text', 'fashe-companion' ),
            'type'  => Controls_Manager::TEXT,
        ]
    );
    $this->add_control(
        'offer_btnurl',
        [
            'label' => esc_html__( 'Button Url', 'fashe-companion' ),
            'type'  => Controls_Manager::TEXT,
        ]
    );
    $this->end_controls_section(); // End Hero content
    /**
     * Style Tab
     * ------------------------------ Style Product Category ------------------------------
     *
     */
        $this->start_controls_section(
			'style_pcb', [
				'label' => __( 'Style Product Category Button', 'fashe-companion' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_control(
            'color_pcbbtntext', [
                'label' => __( 'Button Text Color', 'fashe-companion' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#333333',
                'selectors' => [
                    '{{WRAPPER}} .block1-wrapbtn .flex-c-m.bg3.hov1' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'color_pcbbtnhovtext', [
                'label' => __( 'Button Hover Text Color', 'fashe-companion' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#333333',
                'selectors' => [
                    '{{WRAPPER}} .block1-wrapbtn .flex-c-m.bg3.hov1:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'color_pcbbtnbg', [
                'label' => __( 'Button background Color', 'fashe-companion' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .block1-wrapbtn .flex-c-m.bg3.hov1' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'color_pcbbtnhovbg', [
                'label' => __( 'Button Hover background Color', 'fashe-companion' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#e65540',
                'selectors' => [
                    '{{WRAPPER}} .block1-wrapbtn .flex-c-m.bg3.hov1:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_pcbbtn',
                'selector' => '{{WRAPPER}} .block1-wrapbtn .flex-c-m.bg3.hov1',
            ]
        );

		$this->end_controls_section();


		//------------------------------ Offer Box Style ------------------------------
		$this->start_controls_section(
			'style_offerbox', [
				'label' => __( 'Style Offer Box', 'fashe-companion' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
        // Title Color
        $this->add_control(
            'title_options',
            [
                'label' => __( 'Title Style', 'fashe-companion' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'color_title', [
                'label' => __( 'Title Color', 'fashe-companion' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#111111',
                'selectors' => [
                    '{{WRAPPER}} .block2-content h4.m-text4' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_title',
                'selector' => '{{WRAPPER}} .block2-content h4.m-text4',
            ]
        );
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(), [
                'name' => 'text_shadow_title',
                'selector' => '{{WRAPPER}} .block2-content h4.m-text4',
            ]
        );
        // Descriptions Color
        $this->add_control(
            'desc_options',
            [
                'label' => __( 'Descriptions Style', 'fashe-companion' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
		$this->add_control(
			'color_desc', [
				'label' => __( 'Descriptions Color', 'fashe-companion' ),
				'type' => Controls_Manager::COLOR,
                'default' => '#888888',
				'selectors' => [
					'{{WRAPPER}} .block2-content .t-center p' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name' => 'typography_desc',
				'selector' => '{{WRAPPER}} .block2-content .t-center p',
			]
		);
        // Buttom Style
        $this->add_control(
            'btn_options',
            [
                'label' => __( 'Button Style', 'fashe-companion' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'color_btntext', [
                'label' => __( 'Button Text Color', 'fashe-companion' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .flex-c-m.size2.bo-rad-23.hov1' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'color_btnhovtext', [
                'label' => __( 'Button Hover Text Color', 'fashe-companion' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .flex-c-m.size2.bo-rad-23.hov1:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'color_btnbg', [
                'label' => __( 'Button background Color', 'fashe-companion' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#111111',
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
    <!-- Banner -->
    <section class="banner bgwhite p-t-40 p-b-40">
        <div class="container">
            <div class="row">
                <?php 
                // Col 1
                if( is_array( $settings['pcatone'] ) && count( $settings['pcatone'] ) > 0 ):
                ?>
                
                <div class="col-sm-10 col-md-8 col-lg-4 m-l-r-auto">
                    <?php 
                    foreach( $settings['pcatone']  as $val ):


                    $cat = get_term_by( 'slug', $val['label'], 'product_cat' );


                    if( $cat ):
                    
                    // get the thumbnail id using the queried category term_id
                    $thumbnail_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true ); 

                    // get the image URL
                    $image = wp_get_attachment_url( $thumbnail_id ); 
                    ?>
                    <!-- block1 -->
                    <div class="block1 hov-img-zoom pos-relative m-b-30">
                        <?php 
                        if( $image ){
                            echo fashe_img_tag(
                                array(
                                    'url'    => esc_url( $image ),
                                )
                            );
                        }
                        ?>
                        <div class="block1-wrapbtn w-size2">
                            <!-- Button -->
                            <a href="<?php echo esc_url( get_term_link( $cat->term_id ) ); ?>" class="flex-c-m size2 m-text2 bg3 hov1 trans-0-4">
                                <?php echo esc_html( $cat->name ); ?>
                            </a>
                        </div>
                    </div>
                    <?php 
                    endif;
                    endforeach;
                    ?>              
                </div>
                <?php 
                endif;
                
                // Col 2
                if( is_array( $settings['pcattwo'] ) && count( $settings['pcattwo']  ) > 0 ):
                ?>
                
                <div class="col-sm-10 col-md-8 col-lg-4 m-l-r-auto">
                    <?php 
                    foreach( $settings['pcattwo']   as $val ):

                    $cat = get_term_by( 'slug', $val['label'], 'product_cat' );
                    if( $cat ):
                    
                    // get the thumbnail id using the queried category term_id
                    $thumbnail_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true ); 

                    // get the image URL
                    $image = wp_get_attachment_url( $thumbnail_id ); 
                    ?>
                    <!-- block1 -->
                    <div class="block1 hov-img-zoom pos-relative m-b-30">
                        <?php 
                        if( $image ){
                            echo fashe_img_tag(
                                array(
                                    'url'    => esc_url( $image ),
                                )
                            );
                        }
                        ?>

                        <div class="block1-wrapbtn w-size2">
                            <!-- Button -->
                            <a href="<?php echo esc_url( get_term_link( $cat->term_id ) ); ?>" class="flex-c-m size2 m-text2 bg3 hov1 trans-0-4">
                                <?php echo esc_html( $cat->name ); ?>
                            </a>
                        </div>
                    </div>
                    <?php 
                    endif;
                    endforeach;
                    ?>              
                </div>
                <?php 
                endif;
                //
                if( !empty( $settings['show_offerbox'] ) || ( is_array( $settings['pcatthree'] ) && count( $settings['pcatthree'] ) > 0 ) ):

                    $pcatthree = $settings['pcatthree'];
                ?>
                
                <div class="col-sm-10 col-md-8 col-lg-4 m-l-r-auto">
                    <?php 
                    if( is_array( $pcatthree ) && count( $pcatthree ) > 0 ):
                    //
                        foreach( $pcatthree  as $val ):

                        $cat = get_term_by( 'slug', $val['label'], 'product_cat' );
                        if( $cat ):
                        
                        // get the thumbnail id using the queried category term_id
                        $thumbnail_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true ); 

                        // get the image URL
                        $image = wp_get_attachment_url( $thumbnail_id ); 
                        ?>
                        <!-- block1 -->
                        <div class="block1 hov-img-zoom pos-relative m-b-30">
                            <?php 
                            if( $image ){
                                echo fashe_img_tag(
                                    array(
                                        'url'    => esc_url( $image ),
                                    )
                                );
                            }
                            ?>

                            <div class="block1-wrapbtn w-size2">
                                <!-- Button -->
                                <a href="<?php echo esc_url( get_term_link( $cat->term_id ) ); ?>" class="flex-c-m size2 m-text2 bg3 hov1 trans-0-4">
                                    <?php echo esc_html( $cat->name ); ?>
                                </a>
                            </div>
                        </div>
                        <?php 
                        endif;
                        endforeach;
                    //
                    endif;
           
                    //block2
                 
                    if( !empty( $settings['show_offerbox'] ) && !empty( $settings['offer_title'] ) && !empty( $settings['offer_desc'] ) ):
                    ?>
                    <div class="block2 wrap-pic-w pos-relative m-b-30">
                        <?php 
                        if( !empty( $settings['offer_img']['url'] ) ){
                            echo fashe_img_tag(
                                array(
                                    'url'    => esc_url( $settings['offer_img']['url'] ),
                                )
                            );
                        }
                        ?>
                        <div class="block2-content sizefull ab-t-l flex-col-c-m">
                            <?php 
                            if( $settings['offer_title'] ){
                                echo fashe_heading_tag(
                                    array(
                                        'tag'         => 'h4',
                                        'text'        => esc_html( $settings['offer_title'] ),
                                        'class'       => 'm-text4 t-center w-size3 p-b-8',
                                    )
                                );
                            }
                            // 
                            if( $settings['offer_desc'] ){
                                echo '<div class="t-center w-size4">';
                                    echo fashe_get_textareahtml_output( $settings['offer_desc'] );
                                echo '</div>';

                            }
                            //
                            if( !empty( $settings['offer_btntext'] ) && !empty( $settings['offer_btnurl'] ) ){
                                echo fashe_anchor_tag(
                                    array(
                                        'url'           => esc_url( $settings['offer_btnurl'] ),
                                        'text'          => esc_html( $settings['offer_btntext'] ),
                                        'class'         => 'flex-c-m size2 bg4 bo-rad-23 hov1 m-text3 trans-0-4',
                                        'wrap_before'   => '<div class="w-size2 p-t-25">',
                                        'wrap_after'    => '</div>',
                                    )
                                );
                            }
                            ?>                      
                        </div>
                    </div>
                    <?php 
                    endif;
                    ?>
                </div>
                <?php 
                endif;
                ?>
            </div>
        </div>
    </section>

    <?php

        }
	
}
