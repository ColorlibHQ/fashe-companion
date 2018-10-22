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
class Fashe_About extends Widget_Base {

	public function get_name() {
		return 'fashe-aboutus';
	}

	public function get_title() {
		return __( 'About Us', 'fashe-companion' );
	}

	public function get_icon() {
		return 'eicon-post-content';
	}

	public function get_categories() {
		return [ 'fashe-elements' ];
	}

	protected function _register_controls() {

		$repeater = new \Elementor\Repeater();

		// ----------------------------------------  About Title ------------------------------
        
        $this->start_controls_section(
            'aboutus_title',
            [
                'label' => __( 'Title', 'fashe-companion' ),
            ]
        );
        $this->add_control(
            'aboutus_toptitle',
            [
                'label'     => esc_html__( 'Title', 'fashe-companion' ),
                'type'      => Controls_Manager::TEXT,
                'default'   => 'Our story'
            ]
        );
        $this->end_controls_section(); // End title
        // ----------------------------------------  About Content ------------------------------
        $this->start_controls_section(
            'aboutus_content',
            [
                'label' => __( 'About Content', 'fashe-companion' ),
            ]
        );
        $this->add_control(
            'aboutus_aboutcontent',
            [
                'label'     => esc_html__( 'Content', 'fashe-companion' ),
                'type'      => Controls_Manager::WYSIWYG ,
                'default'   => 'Phasellus egestas nisi nisi, lobortis ultricies risus semper nec. Vestibulum pharetra ac ante ut pellentesque. Curabitur fringilla dolor quis lorem accumsan, vitae molestie urna dapibus. Pellentesque porta est ac neque bibendum viverra. Vivamus lobortis magna ut interdum laoreet.'
            ]
        );
        $this->end_controls_section(); // End content

        // ----------------------------------------  About BlockQuote Content ------------------------------
        $this->start_controls_section(
            'aboutus_blockquote',
            [
                'label' => __( 'About BlockQuote Content', 'fashe-companion' ),
            ]
        );
        $this->add_control(
            'aboutus_blockquotecontent',
            [
                'label'     => esc_html__( 'Content', 'fashe-companion' ),
                'type'      => Controls_Manager::WYSIWYG ,
                'default'   => 'Creativity is just connecting things. When you ask creative people how they did something, they feel a little guilty because they didn\'t really do it, they just saw something. It seemed obvious to them after a while.'
            ]
        );
        $this->add_control(
            'aboutus_bttomtitle',
            [
                'label'     => esc_html__( 'Blockquote Bottom Title', 'fashe-companion' ),
                'type'      => Controls_Manager::TEXT ,
                'default'   => '- Steve Job’s'
            ]
        );
        $this->end_controls_section(); // End blockQuote content

        // ----------------------------------------  About featured image ------------------------------
		$this->start_controls_section(
			'aboutus_featuredimg',
			[
				'label' => __( 'Featured Image', 'fashe-companion' ),
			]
		);
        $this->add_control(
            'aboutus_img',
            [
                'label'     => esc_html__( 'Image', 'fashe-companion' ),
                'type'      => Controls_Manager::MEDIA ,
            ]
        );
		$this->end_controls_section(); // End blockQuote content

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
                    '{{WRAPPER}} h3.m-text26' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'color_content', [
                'label'     => __( 'Content Color', 'fashe-companion' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#888888',
                'selectors' => [
                    '{{WRAPPER}} section p' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'color_blockquotetitle', [
                'label'     => __( 'Blockquote Bottom Title Color', 'fashe-companion' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#333333',
                'selectors' => [
                    '{{WRAPPER}} span.s-text7' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'color_border', [
                'label'     => __( 'Border Color', 'fashe-companion' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#e6e6e6',
                'selectors' => [
                    '{{WRAPPER}} .bo13' => 'border-color: {{VALUE}};',
                ],
            ]
        );


        $this->end_controls_section();


	}

	protected function render() {

    $settings = $this->get_settings();

    ?>
    <!-- content page -->
    <section class="p-t-66 p-b-38">
        <div class="container">
            <div class="row">
                <?php 
                if( !empty( $settings['aboutus_img']['url']  )){
                    echo '<div class="col-md-4 p-b-30"><div class="hov-img-zoom">';
                    echo fashe_img_tag(
                        array(
                            'url' => esc_url( $settings['aboutus_img']['url'] ),
                        )
                    );
                    echo '</div></div>';
                }
                ?>

                <div class="col-md-8 p-b-30">
                    <?php 
                    if( !empty( $settings['aboutus_toptitle'] ) ){

                        echo fashe_heading_tag( array(
                            'tag'   => 'h3',
                            'text'  => esc_html( $settings['aboutus_toptitle'] ),
                            'class' => 'm-text26 p-t-15 p-b-16',
                        ) );
                    }
                    ?>

                    <div class="p-b-28">
                        <?php 
                            echo fashe_get_textareahtml_output( $settings['aboutus_aboutcontent'] );
                        ?>
                    </div>

                    <div class="bo13 p-l-29 m-l-9 p-b-10">
                        <?php
                        if( !empty( $settings['aboutus_blockquotecontent'] ) ):
                        ?>
                        <div class="p-b-11">
                            <?php 
                            echo fashe_get_textareahtml_output( $settings['aboutus_blockquotecontent'] );
                            ?>
                        </div>
                        <?php 
                        endif;
                        //
                        if( !empty( $settings['aboutus_bttomtitle'] ) ){

                            echo fashe_other_tag( array(
                                'tag'   => 'span',
                                'text'  => esc_html( $settings['aboutus_bttomtitle'] ),
                                'class' => 's-text7', 
                            ));
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
