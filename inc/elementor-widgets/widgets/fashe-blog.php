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
 * Fashe elementor few words section widget.
 *
 * @since 1.0
 */
class Fashe_Blog extends Widget_Base {

	public function get_name() {
		return 'fashe-blog';
	}

	public function get_title() {
		return __( 'Blog', 'fashe-companion' );
	}

	public function get_icon() {
		return 'eicon-posts-grid';
	}

	public function get_categories() {
		return [ 'fashe-elements' ];
	}

	protected function _register_controls() {

		$repeater = new \Elementor\Repeater();

        // ----------------------------------------  Blog content ------------------------------
        $this->start_controls_section(
            'blog_content',
            [
                'label' => __( 'Blgo', 'fashe-companion' ),
            ]
        );
        $this->add_control(
            'blog_sectiontitle',
            [
                'label' => esc_html__( 'Section Title', 'fashe-companion' ),
                'type'  => Controls_Manager::TEXT,
            ]
        );
        $this->add_control(
            'blog_limit',
            [
                'label'     => esc_html__( 'Post Limit', 'fashe-companion' ),
                'type'      => Controls_Manager::TEXT,
                'default'   => 3
            ]
        );

        $this->end_controls_section(); // End few words content

        //------------------------------ Style text ------------------------------
        $this->start_controls_section(
            'style_color', [
                'label' => __( 'Style Text Color', 'fashe-companion' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'color_blogtitle', [
                'label'     => __( 'Blog Title Color', 'fashe-companion' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#333333',
                'selectors' => [
                    '{{WRAPPER}} .blog .block3 h4.p-b-7 a' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .blog .block3 .s-text7'   => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'color_blogtitlehov', [
                'label'     => __( 'Blog Title Hover Color', 'fashe-companion' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#e65540',
                'selectors' => [
                    '{{WRAPPER}} .blog .block3 h4.p-b-7 a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'color_blogtext', [
                'label'     => __( 'Blog Text Color', 'fashe-companion' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#888888',
                'selectors' => [
                    '{{WRAPPER}} .blog .post-excerpt p'   => 'color: {{VALUE}};',
                    '{{WRAPPER}} .blog span.s-text6'      => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        //------------------------------ Style Section ------------------------------
        $this->start_controls_section(
            'style_section', [
                'label' => __( 'Style Section', 'fashe-companion' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'color_secttitle', [
                'label'     => __( 'Section Title Color', 'fashe-companion' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#333333',
                'selectors' => [
                    '{{WRAPPER}} .blog .sec-title .m-text5' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name'      => 'typography_secttitle',
                'selector'  => '{{WRAPPER}} .blog .sec-title .m-text5',
            ]
        );
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(), [
                'name'     => 'text_shadow_secttitle',
                'selector' => '{{WRAPPER}} .blog .sec-title .m-text5',
            ]
        );
        $this->end_controls_section();


	}

	protected function render() {

    $settings = $this->get_settings();

    ?>
    <section class="blog p-b-65">
        <div class="container">
            <?php 
            if( !empty( $settings['blog_sectiontitle'] ) ){
                echo fashe_heading_tag(
                    array(
                        'tag'         => 'h3',
                        'text'        => esc_html( $settings['blog_sectiontitle'] ),
                        'class'       => 'm-text5 t-center',
                        'wrap_before' => '<div class="sec-title p-b-52">',
                        'wrap_after'  => '</div>',
                    )
                );
            }
            // Blog
            fashe_blog_section( $settings['blog_limit'] );
            ?>
        </div>
    </section>
    
    <?php

        }
	
}
