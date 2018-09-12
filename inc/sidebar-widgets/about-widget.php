<?php
/**
 * @version  1.0
 * @package  Fashee
 *
 */
 
 
/**************************************
*Creating About Widget
***************************************/
 
class fashe_about_widget extends WP_Widget {


function __construct() {

parent::__construct(
// Base ID of your widget
'fashe_about_widget', 


// Widget name will appear in UI
esc_html__( 'About Widget', 'fashe' ), 

// Widget description
array( 'description' => esc_html__( 'Add footer About Content', 'fashe' ), ) 
);

}

// This is where the action happens
public function widget( $args, $instance ) {
	
$title 		= apply_filters( 'widget_title', $instance['title'] );
$textarea 	= apply_filters( 'widget_textarea', $instance['textarea'] );

// before and after widget arguments are defined by themes
echo wp_kses_post( $args['before_widget'] );
if ( ! empty( $title ) )
echo wp_kses_post( $args['before_title'] . $title . $args['after_title'] );

    
?>
	<div>
		<?php 
		if( $textarea ){
			echo '<p class="s-text7 w-size27">'.wp_kses_post( $textarea).'</p>';
		}
		if( has_nav_menu('social-menu') ){
			echo '<div class="flex-m p-t-30">';
			$navargs = array(
				'theme_location' => 'social-menu',
				'container' => '',
				'menu_class'     => 'bottombar-social',
				'depth'          => 1,
				'fallback_cb'    => 'fashe_social_navwalker::fallback',
				'walker'    	 => new fashe_social_navwalker(),
			);  
			wp_nav_menu( $navargs );
			echo '</div>';
		}
		?>
	</div>

<?php
echo wp_kses_post( $args['after_widget'] );
}
		
// Widget Backend 
public function form( $instance ) {
	
if ( isset( $instance[ 'title' ] ) ) {
	$title = $instance[ 'title' ];
}else {
	$title = esc_html__( 'About', 'fashe' );
}


//	Text Area
if ( isset( $instance[ 'textarea' ] ) ) {
	$textarea = $instance[ 'textarea' ];
}else {
	$textarea = '';
}


// Widget admin form
?>
<p>
<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:' ,'fashe'); ?></label> 
<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
</p>

<p>
<label for="<?php echo esc_attr( $this->get_field_id( 'textarea' ) ); ?>"><?php esc_html_e( 'Text Area:' ,'fashe'); ?></label> 
<textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'textarea' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'textarea' ) ); ?>"><?php echo esc_textarea( $textarea ); ?></textarea>
</p>


<?php 
}

	
// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {

	
$instance = array();
$instance['title'] 	  = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
$instance['textarea'] = ( ! empty( $new_instance['textarea'] ) ) ? strip_tags( $new_instance['textarea'] ) : '';

return $instance;
}

} // Class fashe_about_widget ends here


// Register and load the widget
function fashe_about_load_widget() {
	register_widget( 'fashe_about_widget' );
}
add_action( 'widgets_init', 'fashe_about_load_widget' );