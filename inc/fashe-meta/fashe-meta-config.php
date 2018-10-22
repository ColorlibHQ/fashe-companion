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
    

    // Fashe meta scripts enqueue
    add_action( 'admin_enqueue_scripts', 'fahse_meta_scripts' );
    function fahse_meta_scripts(){
        wp_enqueue_style( 'fashe-meta-style', plugins_url( 'assets/css/fashe-meta.css', __FILE__ ) );
        wp_enqueue_script( 'fashe-meta-script', plugins_url( 'assets/js/fashe-meta.js', __FILE__ ), array('jquery'), '1.0', true );
    }

    // Page Header select option meta
    add_action("add_meta_boxes", "add_custom_meta_box");
    function add_custom_meta_box()
    {
        // Page settings meta box
        add_meta_box("pagesettings-meta-box", "Builder Page Settings", "fashe_settings_meta_box_markup", "page", "side", "high", null);
        // page header background meta box
        add_meta_box("pageheader-meta-box", "Page Header Background Settings", "fashe_pageheaderbg_meta_box_markup", "page", "side", "high", null);
    }

    // Builder page settings meta field markup
    function fashe_settings_meta_box_markup($object) {

    wp_nonce_field(basename(__FILE__), "fashe-pagesettings-meta-nonce");

    ?>
        <div class="header-opt">
            <p class="post-attributes-label-wrapper">
                <label for="pageheader-dropdown" class="post-attributes-label"><?php esc_html_e( 'Set Page Header', 'fashe-companion' ); ?></label>
            </p>
            <?php 
            $val = get_post_meta( $object->ID ,'_fashe_page_header', true );
            ?>
            <select name="pageheader" class="fashe-admin-selectbox" id="page_header_selectbox">
                <option value="show" <?php echo esc_attr( $val == 'show' ? 'selected' : '' ); ?>><?php esc_html_e( 'Show', 'fashe-companion' ); ?></option>
                <option value="hide" <?php echo esc_attr( $val == 'hide' ? 'selected' : '' ); ?> ><?php esc_html_e( 'Hide', 'fashe-companion' ); ?></option>
            </select>

        </div>
        <div class="page-opt-type">
            <p class="post-attributes-label-wrapper">
                <label for="pageheader-dropdown" class="post-attributes-label"><?php esc_html_e( 'Set Page Layout From', 'fashe-companion' ); ?></label>
            </p>
            <?php 
            $val = get_post_meta( $object->ID ,'_fashe_page_layout_from', true );
            ?>
            <select name="pagelayout" class="fashe-admin-selectbox" id="page_header_layout">
                <option value="customizer" <?php echo esc_attr( $val == 'customizer' ? 'selected' : '' ); ?>><?php esc_html_e( 'Customizer', 'fashe-companion' ); ?></option>
                <option value="pagemeta" <?php echo esc_attr( $val == 'pagemeta' ? 'selected' : '' ); ?> ><?php esc_html_e( 'Page Meta', 'fashe-companion' ); ?></option>
            </select>

        </div>
        <div class="page-opt">
            <?php 
            $val = get_post_meta( $object->ID ,'_fashe_page_style', true );
            ?>
            <p class="post-attributes-label-wrapper">
                <label for="pageheader-dropdown" class="post-attributes-label"><?php esc_html_e( 'Set page style', 'fashe-companion' ); ?></label>
            </p>
            <div class="radio-btn">
                <label class="ckb">
                    <input type="radio" name="pagestyle" value="1" <?php echo esc_attr( $val == '1' ? 'checked' : ''  ); ?>> 
                    <img src="<?php echo esc_url( plugins_url( 'assets/img/thumb_01.png', __FILE__ ) ); ?>" />
                </label>
                <label class="ckb">
                <input type="radio" name="pagestyle" value="2" <?php echo esc_attr( $val == '2' ? 'checked' : ''  ); ?>> 
                <img src="<?php echo esc_url( plugins_url( 'assets/img/thumb_02.png', __FILE__ ) ); ?>" />
                </label>
                <label class="ckb">
                    <input type="radio" name="pagestyle" value="3" <?php echo esc_attr( $val == '3' ? 'checked' : ''  ); ?>> 
                    <img src="<?php echo esc_url( plugins_url( 'assets/img/thumb_03.png', __FILE__ ) ); ?>" />
                </label>
            </div>
        </div>
    <?php  
    }

    // Page Header settings meta field markup
    function fashe_pageheaderbg_meta_box_markup($object) {

    wp_nonce_field(basename(__FILE__), "fashe-headerbg-meta-nonce");

    ?>
        <div class="header-opt">
            <p class="post-attributes-label-wrapper">
                <label for="pageheader-dropdown" class="post-attributes-label"><?php esc_html_e( 'Set Page Header Background', 'fashe-companion' ); ?></label>
            </p>
            <?php 
            $val = get_post_meta( $object->ID ,'_fashe_header_bg', true );
            ?>
            <select name="headerbg" class="fashe-admin-selectbox" id="page_header_selectbox">
                <option value="customize" <?php echo esc_attr( $val == 'customize' ? 'selected' : '' ); ?>><?php esc_html_e( 'From Customize', 'fashe-companion' ); ?></option>
                <option value="featured" <?php echo esc_attr( $val == 'featured' ? 'selected' : '' ); ?> ><?php esc_html_e( 'Featured Image', 'fashe-companion' ); ?></option>
            </select>

        </div>
    <?php  
    }
    // Builder page settings save
    function fashe_save_page_settings_meta( $post_id, $post, $update )
    {
        if (!isset($_POST["fashe-pagesettings-meta-nonce"]) || !wp_verify_nonce($_POST["fashe-pagesettings-meta-nonce"], basename(__FILE__)))
            return $post_id;

        if(!current_user_can("edit_post", $post_id))
            return $post_id;

        if(defined("DOING_AUTOSAVE") && DOING_AUTOSAVE)
            return $post_id;

        $slug = "page";
        if($slug != $post->post_type)
            return $post_id;

        $meta_pageheader = "";
        $meta_pagestyle  = "";
        $meta_pagelayout  = "customizer";

        //
        if(isset($_POST["pageheader"]))
        {
            $meta_pageheader = $_POST["pageheader"];
        }   
        update_post_meta($post_id, "_fashe_page_header", sanitize_text_field( $meta_pageheader ) );

        //
        if(isset($_POST["pagelayout"]))
        {
            $meta_pagelayout = $_POST["pagelayout"];
        }   
        update_post_meta( $post_id, "_fashe_page_layout_from", sanitize_text_field( $meta_pagelayout ) );

        //
        if(isset($_POST["pagestyle"]))
        {
            $meta_pagestyle = $_POST["pagestyle"];
        }   
        update_post_meta($post_id, "_fashe_page_style", sanitize_text_field( $meta_pagestyle ) );

    }

    add_action("save_post", "fashe_save_page_settings_meta", 10, 3);
   
    // Page header background settings save
    function fashe_save_page_page_headerbg_settings_meta( $post_id, $post, $update )
    {
        if (!isset( $_POST["fashe-headerbg-meta-nonce"] ) || !wp_verify_nonce( $_POST["fashe-headerbg-meta-nonce"], basename(__FILE__)))
            return $post_id;

        if(!current_user_can("edit_post", $post_id))
            return $post_id;

        if(defined("DOING_AUTOSAVE") && DOING_AUTOSAVE)
            return $post_id;

        $slug = "page";
        if($slug != $post->post_type)
            return $post_id;

        $meta_headerbg   = "";

        if(isset($_POST["headerbg"]))
        {
            $meta_headerbg = $_POST["headerbg"];
        }   
        update_post_meta( $post_id, "_fashe_header_bg", sanitize_text_field( $meta_headerbg ) );

    }

    add_action("save_post", "fashe_save_page_page_headerbg_settings_meta", 10, 3);
?>