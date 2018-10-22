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
 * Fashe elementor banner countdown section widget.
 *
 * @since 1.0
 */
class Fashe_Banner_Counter extends Widget_Base {

	public function get_name() {
		return 'fashe-banner-countdown';
	}

	public function get_title() {
		return __( 'Banner Countdown', 'fashe-companion' );
	}

	public function get_icon() {
		return 'eicon-column';
	}

	public function get_categories() {
		return [ 'fashe-elements' ];
	}

	protected function _register_controls() {

		$repeater = new \Elementor\Repeater();

        // ----------------------------------------  Countdown product Info ------------------------------
        $this->start_controls_section(
            'countdown_productcontent',
            [
                'label' => __( 'Countdown Product Info', 'fashe-companion' ),
            ]
        );
        $this->add_control(
            'countdown_ptitle',
            [
                'label' => esc_html__( 'Product Title', 'fashe-companion' ),
                'type' => Controls_Manager::TEXT,
            ]
        );
        $this->add_control(
            'countdown_purl', 
            [
                'label' => esc_html__( 'Product Url', 'fashe-companion' ),
                'type' => Controls_Manager::URL,
                'show_external' => false
            ]
        );
        $this->add_control(
            'countdown_poldprice',
            [
                'label' => esc_html__( 'Old Price', 'fashe-companion' ),
                'type'  => Controls_Manager::TEXT,
            ]
        );
        $this->add_control(
            'countdown_newprice',
            [
                'label' => esc_html__( 'New Price', 'fashe-companion' ),
                'type'  => Controls_Manager::TEXT,
            ]
        );
        $this->add_control(
            'countdown_day',
            [
                'label' => esc_html__( 'Days', 'fashe-companion' ),
                'type'  => Controls_Manager::NUMBER,
            ]
        );
        $this->add_control(
            'countdown_productthumb',
            [
                'label' => esc_html__( 'Product Thumbnail', 'fashe-companion' ),
                'type'  => Controls_Manager::MEDIA,
            ]
        );
        $this->end_controls_section(); // End product content

        // ----------------------------------------  Product Collection Info ------------------------------
        $this->start_controls_section(
            'collection_promo',
            [
                'label' => __( 'Product Collection Promo', 'fashe-companion' ),
            ]
        );
        $this->add_control(
            'collection_switch',
            [
                'label' => __( 'Show Collection Promo', 'fashe-companion' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'fashe-companion' ),
                'label_off' => __( 'Hide', 'fashe-companion' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        $this->add_control(
            'collection_title',
            [
                'label' => esc_html__( 'Title #1', 'fashe-companion' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true
            ]
        );
        $this->add_control( 
            'collection_titletwo',
            [
                'label' => esc_html__( 'Title #2', 'fashe-companion' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true
            ]
        );
        $this->add_control(
            'collection_linktitle',
            [
                'label' => esc_html__( 'Link Title', 'fashe-companion' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true
            ]
        );
        $this->add_control(
            'collection_url',
            [
                'label' => esc_html__( 'Url', 'fashe-companion' ),
                'type' => Controls_Manager::URL,
                'show_external' => false
            ]
        );
        $this->add_control(
            'collection_thumb',
            [
                'label' => esc_html__( 'Thumbnail', 'fashe-companion' ),
                'type' => Controls_Manager::MEDIA,
            ]
        );

        $this->end_controls_section(); // End collection content


        //------------------------------ Countdown Style ------------------------------
        $this->start_controls_section(
            'style_countdown', [
                'label' => __( 'Countdown Style', 'fashe-companion' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'color_title', [
                'label' => __( 'Title Color', 'fashe-companion' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#555555',
                'selectors' => [
                    '{{WRAPPER}} .ab-t-l .s-text3' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'color_oldprice', [
                'label' => __( 'Old Price Color', 'fashe-companion' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#555555',
                'selectors' => [
                    '{{WRAPPER}} .block2-oldprice' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'color_newprice', [
                'label' => __( 'New Price Color', 'fashe-companion' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#e65540',
                'selectors' => [
                    '{{WRAPPER}} .block2-newprice' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'color_date', [
                'label' => __( 'Date Color', 'fashe-companion' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#555555',
                'selectors' => [
                    '{{WRAPPER}} .flex-col-c-m .m-text10' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'color_datetext', [
                'label' => __( 'Date Text Color', 'fashe-companion' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#999999',
                'selectors' => [
                    '{{WRAPPER}} .flex-col-c-m .s-text5' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'color_boxborder', [
                'label' => __( 'Date Box Border Color', 'fashe-companion' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#dbdbdb',
                'selectors' => [
                    '{{WRAPPER}} .flex-col-c-m.bo1' => 'border-color: {{VALUE}};',
                ],
            ]
        );



        $this->end_controls_section();

        //------------------------------ Style Collection ------------------------------
        $this->start_controls_section(
            'collection_style', [
                'label' => __( 'Style Collection Text', 'fashe-companion' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'color_titleone', [
                'label' => __( 'Title #1 Color', 'fashe-companion' ),
                'type'  => Controls_Manager::COLOR,
                'default'   => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .hov-img-zoom .ab-t-l .m-text9' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'color_titletwo', [
                'label' => __( 'Title #2 Color', 'fashe-companion' ),
                'type'  => Controls_Manager::COLOR,
                'default'   => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .hov-img-zoom .ab-t-l .l-text1' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'color_linktitle', [
                'label' => __( 'Link Title Color', 'fashe-companion' ),
                'type'  => Controls_Manager::COLOR,
                'default'   => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .hov-img-zoom .ab-t-l .hov2' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'color_linktitlehov', [
                'label' => __( 'Link Title Hover Color', 'fashe-companion' ),
                'type'  => Controls_Manager::COLOR,
                'default'   => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .hov-img-zoom .ab-t-l .hov2:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();


	}

	protected function render() {

    $settings = $this->get_settings();

    // Style Check

    if( !empty( $settings['collection_switch'] ) ):
    ?>
    <section class="banner2 bg5 p-t-55 p-b-55">
        <div class="container">
            <div class="row">
                <div class="col-sm-10 col-md-8 col-lg-6 m-l-r-auto p-t-15 p-b-15">
                    <div class="hov-img-zoom pos-relative">
                        <?php 

                        if( !empty( $settings['collection_thumb']['url'] ) ){
                            echo fashe_img_tag(
                                array(
                                    'url'    => esc_url( $settings['collection_thumb']['url'] ),
                                )
                            );
                        }
                        ?>
                        <div class="ab-t-l sizefull flex-col-c-m p-l-15 p-r-15">
                            <?php 
                            // left box title one
                            if( !empty( $settings[ 'collection_title' ] )  ){
                                echo fashe_other_tag(
                                    array(
                                        'tag'         => 'span',
                                        'text'        => esc_html( $settings[ 'collection_title' ] ),
                                        'class'       => 'm-text9 p-t-45 fs-20-sm',
                                    )
                                );
                            }
                            // left box title one
                            if( $settings['collection_titletwo']  ){
                                echo fashe_heading_tag(
                                    array(
                                        'tag'         => 'h3',
                                        'text'        => esc_html( $settings['collection_titletwo'] ),
                                        'class'       => 'l-text1 fs-35-sm',
                                    )
                                );
                            }
                            // left box link
                            if( !empty( $settings['collection_linktitle'] ) && !empty( $settings['collection_url']['url'] ) ){
                                echo fashe_anchor_tag(
                                    array(
                                        'url'           => esc_url( $settings['collection_url']['url'] ),
                                        'text'          => esc_html( $settings['collection_linktitle'] ),
                                        'class'         => 's-text4 hov2 p-t-20',
                                    )
                                );
                                
                            }
                            ?>
                        </div>
                    </div>
                </div>

                <div class="col-sm-10 col-md-8 col-lg-6 m-l-r-auto p-t-15 p-b-15">
                    <div class="bgwhite hov-img-zoom pos-relative p-b-20per-ssm"> 
                        <?php 
                        if( !empty( $settings['countdown_productthumb']['url'] ) ){
                            echo fashe_img_tag(
                                array(
                                    'url'    => esc_url( $settings['countdown_productthumb']['url'] ),
                                )
                            );
                        }
                        ?>

                        <div class="ab-t-l sizefull flex-col-c-b p-l-15 p-r-15 p-b-20">
                            <div class="t-center">
                                <?php 
                                // Product Title
                                if( !empty( $settings['countdown_ptitle'] ) ){
                                    echo fashe_anchor_tag(
                                        array(
                                            'url'           => esc_url( $settings['countdown_purl']['url'] ),
                                            'text'          => esc_html( $settings['countdown_ptitle'] ),
                                            'class'         => 'dis-block s-text3 p-b-5',
                                        )
                                    );
                                    
                                }
                                // Old price
                                if( !empty( $settings['countdown_poldprice'] ) ){
                                    echo fashe_other_tag(
                                        array(
                                            'tag'         => 'span',
                                            'text'        => esc_html( $settings['countdown_poldprice'] ),
                                            'class'       => 'block2-oldprice m-text7 p-r-5',
                                        )
                                    );
                                }
                                // New price
                                if( !empty( $settings['countdown_newprice'] ) ){
                                    echo fashe_other_tag(
                                        array(
                                            'tag'         => 'span',
                                            'text'        => esc_html( $settings['countdown_newprice'] ),
                                            'class'       => 'block2-newprice m-text8',
                                        )
                                    );
                                }
                                ?>
                            </div>

                            <div class="flex-c-m p-t-44 p-t-30-xl">
                                <div class="flex-col-c-m size3 bo1 m-l-5 m-r-5">
                                    <span class="m-text10 p-b-1 days" data-days="<?php echo esc_attr( $settings['countdown_day'] ); ?>">
                                        <?php esc_html_e( '10', 'fashe' ); ?>
                                    </span>

                                    <span class="s-text5">
                                        <?php esc_html_e( 'days', 'fashe' ); ?>
                                    </span>
                                </div>

                                <div class="flex-col-c-m size3 bo1 m-l-5 m-r-5">
                                    <span class="m-text10 p-b-1 hours">
                                        <?php esc_html_e( '09', 'fashe' ); ?>
                                    </span>

                                    <span class="s-text5">
                                        <?php esc_html_e( 'hrs', 'fashe' ); ?>
                                    </span>
                                </div>

                                <div class="flex-col-c-m size3 bo1 m-l-5 m-r-5">
                                    <span class="m-text10 p-b-1 minutes">
                                        <?php esc_html_e( '32', 'fashe' ); ?>
                                    </span>

                                    <span class="s-text5">
                                        <?php esc_html_e( 'mins', 'fashe' ); ?>
                                    </span>
                                </div>

                                <div class="flex-col-c-m size3 bo1 m-l-5 m-r-5">
                                    <span class="m-text10 p-b-1 seconds">
                                        <?php esc_html_e( '05', 'fashe' ); ?>
                                    </span>

                                    <span class="s-text5">
                                        <?php esc_html_e( 'secs', 'fashe' ); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php 
    else:
    ?>
    <!-- Banner2 v1 -->
    <div class="banner2 p-t-55 p-b-55 bg-img1">
        <div class="container">
            <div class="flex-w flex-r-m flex-c-xl">
                <div class="p-t-15 p-b-15 w-size28">
                    <div class="bgwhite hov-img-zoom pos-relative p-b-20per-ssm"> 
                        <?php 
                        if( !empty( $settings['countdown_productthumb']['url'] ) ){
                            echo fashe_img_tag(
                                array(
                                    'url'    => esc_url( $settings['countdown_productthumb']['url'] ),
                                )
                            );
                        }
                        ?>

                        <div class="ab-t-l sizefull flex-col-c-b p-l-15 p-r-15 p-b-20">
                            <div class="t-center">
                                <?php 
                                // Product Title
                                if( !empty( $settings['countdown_ptitle'] ) ){
                                    echo fashe_anchor_tag(
                                        array(
                                            'url'           => esc_url( $settings['countdown_purl']['url'] ),
                                            'text'          => esc_html( $settings['countdown_ptitle'] ),
                                            'class'         => 'dis-block s-text3 p-b-5',
                                        )
                                    );
                                    
                                }
                                // Old price
                                if( !empty( $settings['countdown_poldprice'] ) ){
                                    echo fashe_other_tag(
                                        array(
                                            'tag'         => 'span',
                                            'text'        => esc_html( $settings['countdown_poldprice'] ),
                                            'class'       => 'block2-oldprice m-text7 p-r-5',
                                        )
                                    );
                                }
                                // New price
                                if( !empty( $settings['countdown_newprice'] ) ){
                                    echo fashe_other_tag(
                                        array(
                                            'tag'         => 'span',
                                            'text'        => esc_html( $settings['countdown_newprice'] ),
                                            'class'       => 'block2-newprice m-text8',
                                        )
                                    );
                                }
                                ?>
                            </div>

                            <div class="flex-c-m p-t-44 p-t-30-xl">
                                <div class="flex-col-c-m size3 bo1 m-l-5 m-r-5">
                                    <span class="m-text10 p-b-1 days" data-days="<?php echo esc_attr( $settings['countdown_day'] ); ?>">
                                        <?php esc_html_e( '10', 'fashe' ); ?>
                                    </span>

                                    <span class="s-text5">
                                        <?php esc_html_e( 'days', 'fashe' ); ?>
                                    </span>
                                </div>

                                <div class="flex-col-c-m size3 bo1 m-l-5 m-r-5">
                                    <span class="m-text10 p-b-1 hours">
                                        <?php esc_html_e( '09', 'fashe' ); ?>
                                    </span>

                                    <span class="s-text5">
                                        <?php esc_html_e( 'hrs', 'fashe' ); ?>
                                    </span>
                                </div>

                                <div class="flex-col-c-m size3 bo1 m-l-5 m-r-5">
                                    <span class="m-text10 p-b-1 minutes">
                                        <?php esc_html_e( '32', 'fashe' ); ?>
                                    </span>

                                    <span class="s-text5">
                                        <?php esc_html_e( 'mins', 'fashe' ); ?>
                                    </span>
                                </div>

                                <div class="flex-col-c-m size3 bo1 m-l-5 m-r-5">
                                    <span class="m-text10 p-b-1 seconds">
                                        <?php esc_html_e( '05', 'fashe' ); ?>
                                    </span>

                                    <span class="s-text5">
                                        <?php esc_html_e( 'secs', 'fashe' ); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <?php
    endif;

        }
	
}
