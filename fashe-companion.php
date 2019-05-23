<?php
/**
* Plugin Name:          Fashe Companion
* Plugin URI:           https://colorlib.com/wp/themes/fashe/
* Description:          Fashe Companion is a companion for Fashe theme.
* Version:              1.3
* Author:               Colorlib
* Author URI:           https://colorlib.com/
* Tested up to:         5.1
* Requires:             4.6 or higher
* License:              GPLv3 or later
* License URI:          http://www.gnu.org/licenses/gpl-3.0.html
* Requires PHP:         5.6
* Text Domain:          fashe-companion
* Domain Path:          /languages
*
* Copyright 2019 Colorlib support@colorlib.com
*
*
* This program is free software; you can redistribute it and/or modify
* it under the terms of the GNU General Public License, version 3, as
* published by the Free Software Foundation.
*
* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License for more details.
*
* You should have received a copy of the GNU General Public License
* along with this program; if not, write to the Free Software
* Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


if( !defined( 'WPINC' ) ){
    die;
}

/*************************
    Define Constant
*************************/

// Define version constant
if( !defined( 'FASHE_COMPANION_VERSION' ) ){
    define( 'FASHE_COMPANION_VERSION', '1.2' );
}

// Define dir path constant
if( !defined( 'FASHE_COMPANION_DIR_PATH' ) ){
    define( 'FASHE_COMPANION_DIR_PATH', plugin_dir_path( __FILE__ ) );
}

// Define inc dir path constant
if( !defined( 'FASHE_COMPANION_INC_DIR_PATH' ) ){
    define( 'FASHE_COMPANION_INC_DIR_PATH', FASHE_COMPANION_DIR_PATH.'inc/' );
}

// Define sidebar widgets dir path constant
if( !defined( 'FASHE_COMPANION_SW_DIR_PATH' ) ){
    define( 'FASHE_COMPANION_SW_DIR_PATH', FASHE_COMPANION_INC_DIR_PATH.'sidebar-widgets/' );
}

// Define elementor widgets dir path constant
if( !defined( 'FASHE_COMPANION_EW_DIR_PATH' ) ){
    define( 'FASHE_COMPANION_EW_DIR_PATH', FASHE_COMPANION_INC_DIR_PATH.'elementor-widgets/' );
}

// Define demo data dir path constant
if( !defined( 'FASHE_COMPANION_DEMO_DIR_PATH' ) ){
    define( 'FASHE_COMPANION_DEMO_DIR_PATH', FASHE_COMPANION_INC_DIR_PATH.'demo-data/' );
}


$current_theme = wp_get_theme();

$is_parent = $current_theme->parent();


if( ( 'Fashe' ==  $current_theme->get( 'Name' ) ) || ( $is_parent && 'Fashe' == $is_parent->get( 'Name' ) ) ){
    require_once FASHE_COMPANION_DIR_PATH . 'fashe-init.php';
}else{

    add_action( 'admin_notices', 'fashe_companion_admin_notice', 99 );
    function fashe_companion_admin_notice() {
        $url = 'https://wordpress.org/themes/fashe/';
    ?>
        <div class="notice-warning notice">
            <p><?php printf( __( 'In order to use the <strong>Fashe Companion</strong> plugin you have to also install the %1$sFashe Theme%2$s', 'fashe-companion' ), '<a href="'.esc_url( $url ).'" target="_blank">', '</a>' ); ?></p>
        </div>
        <?php
    }
}

?>