<?php 
if( !defined( 'WPINC' ) ){
    die;
}
/**
 * @Packge     : Fashe Companion
 * @Version    : 1.0
 * @Author     : Colorlib
 * @Author URI : http://colorlib.com/wp/
 *
 */
    
    // Woo products category list
    function fashe_product_cat(){
        
        $product_cat = get_terms( array( 'taxonomy' => 'product_cat' ,'hide_empty' => true ) );


        $productCat = [];
        if( is_array( $product_cat ) && count( $product_cat ) > 0 ){
            foreach( $product_cat as $cat ){
                $productCat[$cat->slug]= $cat->name;
            }
        }
        return $productCat;
    }
    
    // Instagram object Instance
    function fashe_instagram_instance(){
        
        $api = Wpzoom_Instagram_Widget_API::getInstance();

        return $api;
    }
    // Featured Product 
    function fashe_featured_products( $postnumber = '6' ){
        ?>
            <div class="wrap-slick2 rs1-slick2">
                <div class="slick2">
                <?php
                    $args = array(
                        'post_type' => 'product',
                        'posts_per_page' => esc_html( $postnumber ),
                        'tax_query' => array(
                                array(
                                    'taxonomy' => 'product_visibility',
                                    'field'    => 'name',
                                    'terms'    => 'featured',
                                ),
                            ),
                        );
                    $loop = new WP_Query( $args );
                    if ( $loop->have_posts() ) {
                        
                        global $set_place;
                            $set_place['set_place'] = 'item-slick2 p-l-15 p-r-15';
                        
                        while ( $loop->have_posts() ) : $loop->the_post();
                            wc_get_template_part( 'content', 'product' );
                        endwhile;
                    } else {
                        echo esc_html__( 'No feature product found', 'fashe' );
                    }
                    wp_reset_postdata();
                ?>
                </div>
            </div>
        <?php
    }

    // Blog Section
    function fashe_blog_section( $postnumber ){
        
        ?>
            <div class="row">
                <?php   
                $args = array(
                    'post_type'      => 'post',
                    'posts_per_page' => esc_html( $postnumber ),
                );
                
                $query = new WP_Query( $args );
                
                if( $query->have_posts() ):
                while( $query->have_posts() ):
                    $query->the_post();
                ?>
                <div class="col-sm-10 col-md-4 p-b-30 m-l-r-auto">
                    <!-- Block3 -->
                    <div class="block3">
                        <a href="<?php the_permalink() ?>" class="block3-img dis-block hov-img-zoom">
                            <?php 
                            the_post_thumbnail('fashe_widget_post_thumb');
                            ?>
                        </a>

                        <div class="block3-txt p-t-14">
                            <h4 class="p-b-7">
                                <a href="<?php the_permalink() ?>" class="m-text11">
                                    <?php the_title(); ?>
                                </a>
                            </h4>
                            <span class="s-text6"><?php esc_html_e( 'By', 'fashe' ); ?></span> <span class="s-text7"><?php the_author(); ?></span>
                            <span class="s-text6"><?php esc_html_e( 'on', 'fashe' ); ?></span> <span class="s-text7"><?php echo esc_html( get_the_date() ); ?></span>
                            <div class="post-excerpt s-text8">
                                <?php the_excerpt(); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php 
                endwhile;
                wp_reset_postdata();
                endif;
                ?>
            </div>
        <?php
    }

    // Our Product section
    function fashe_our_product( $postnumber ){
       
        if( !fashe_is_wc_activated() ){
            return;
        }

        global $set_place, $woocommerce;
        $set_place['set_place'] = 'col-sm-6 col-md-4 col-lg-3 p-b-50';
        ?>
            <!-- Tab panes -->
            <div class="tab-content woocommerce p-t-35">
                <div class="tab-pane fade show active" id="best-seller" role="tabpanel">
                    <div class="row">
                        <?php 
                        // setup query
                        $args = array(
                            'post_type'             => 'product',
                            'post_status'           => 'publish',
                            'ignore_sticky_posts'   => 1,
                            'posts_per_page'        => esc_html( $postnumber ),         
                            'meta_key'              => 'total_sales',
                            'orderby'               => 'meta_value_num',
                        );
                        
                        $loop = new WP_Query( $args );
                        if ( $loop->have_posts() ) {
                            
                            while ( $loop->have_posts() ) : $loop->the_post();
                            
                                wc_get_template_part( 'content', 'product' );
                                
                            endwhile;
                            wp_reset_postdata();
                        } else {
                            echo esc_html__( 'No feature product found', 'fashe' );
                        }
                        
                        ?>
                    </div>
                </div>

                <div class="tab-pane fade" id="featured" role="tabpanel">
                    <div class="row">
                        <?php
                            $args = array(
                                'post_type' => 'product',
                                'posts_per_page' => esc_html( $postnumber ),
                                'tax_query' => array(
                                        array(
                                            'taxonomy' => 'product_visibility',
                                            'field'    => 'name',
                                            'terms'    => 'featured',
                                        ),
                                    ),
                                );
                            $loop = new WP_Query( $args );
                            if ( $loop->have_posts() ) {
                                
                                while ( $loop->have_posts() ) : $loop->the_post();
                                
                                    wc_get_template_part( 'content', 'product' );
                                    
                                endwhile;
                                wp_reset_postdata();
                            } else {
                                echo esc_html__( 'No feature product found', 'fashe' );
                            }
                            
                        ?>
                    </div>
                </div>

                <div class="tab-pane fade" id="sale" role="tabpanel">
                    <div class="row">
                        <?php 
                        // Get products on sale
                        $product_ids_on_sale = wc_get_product_ids_on_sale();
                        $meta_query = array();
                        $meta_query[] = $woocommerce->query->visibility_meta_query();
                        $meta_query[] = $woocommerce->query->stock_status_meta_query();
                        $args = array(
                            'posts_per_page'=> esc_html( $postnumber ),
                            'orderby'       => 'title',
                            'order'         => 'asc',
                            'no_found_rows' => 1,
                            'post_status'   => 'publish',
                            'post_type'     => 'product',
                            'orderby'       => 'date',
                            'order'         => 'ASC',
                            'meta_query'    => $meta_query,
                            'post__in'      => $product_ids_on_sale
                        );
                            
                        $loop = new WP_Query( $args );
                        if ( $loop->have_posts() ) {
                            
                            while ( $loop->have_posts() ) : $loop->the_post();
                            
                                wc_get_template_part( 'content', 'product' );
                                
                            endwhile;
                            wp_reset_postdata();
                        } else {
                            echo esc_html__( 'No feature product found', 'fashe' );
                        }
                        ?>

                    </div>
                </div>

                <div class="tab-pane fade" id="top-rate" role="tabpanel">
                    <div class="row">
                        <?php 

                        $query_args = array(
                            'posts_per_page' => esc_html( $postnumber ),
                            'no_found_rows'  => 1,
                            'post_status'    => 'publish',
                            'post_type'      => 'product',
                            'meta_key'       => '_wc_average_rating',
                            'orderby'        => 'meta_value_num',
                            'order'          => 'DESC',
                            'meta_query'     => WC()->query->get_meta_query(),
                            'tax_query'      => WC()->query->get_tax_query(),
                        ); // WPCS: slow query ok.
                        $loop = new WP_Query( $query_args );
                        if ( $loop->have_posts() ) {
                            while ( $loop->have_posts() ) : $loop->the_post();
                            
                                wc_get_template_part( 'content', 'product' );
                                
                            endwhile;
                            wp_reset_postdata();
                        } else {
                            echo esc_html__( 'No feature product found', 'fashe' );
                        }
                        
                        ?>
                    </div>
                </div>
            </div>

        <?php

    }

    // Set contact form 7 default form template
    function fashe_contact7_form_content( $template, $prop ) {
      if ( 'form' == $prop ) {

            $template =
                '<div class="bo4 of-hidden size15 m-b-20">
                [text* fashe-name class:sizefull class:s-text7 class:p-l-22 class:p-r-22 placeholder "Full Name"]
                </div>
                <div class="bo4 of-hidden size15 m-b-20">
                [text* phone-number class:sizefull class:s-text7 class:p-l-22 class:p-r-22 placeholder "Phone Number"]
                </div>
                <div class="bo4 of-hidden size15 m-b-20">
                [email* fashe-email class:sizefull class:s-text7 class:p-l-22 class:p-r-22 placeholder "Email Address"]
                </div>
                [textarea message class:dis-block class:s-text7 class:size20 class:bo4 class:p-l-22 rows:4 class:p-r-22 class:p-t-13 class:m-b-20 placeholder "Message"]
                <div class="w-size25">
                [submit class:flex-c-m class:size2 class:bg1 class:bo-rad-23 class:hov1 class:m-text3 class:trans-0-4 "Send"]
                </div>';
            return $template;

      } else {
        return $template;
      } 
    }
    add_filter( 'wpcf7_default_template', 'fashe_contact7_form_content', 10, 2 );

?>