<?php
/**
 * @version  1.0
 * @package  Fashe
 *
 */
 
 
/**************************************
*Creating Newsletter Widget
***************************************/
 
class fashe_newsletter_widget extends WP_Widget {


function __construct() {

parent::__construct(
// Base ID of your widget
'fashe_newsletter_widget',


// Widget name will appear in UI
esc_html__( 'Newsletter Form', 'fashe' ), 

// Widget description
array( 'description' => esc_html__( 'Add footer newsletter signup form.', 'fashe' ), ) 
);

}

// This is where the action happens
public function widget( $args, $instance ) {
	
$title 		= apply_filters( 'widget_title', $instance['title'] );
$actionurl 	= apply_filters( 'widget_actionurl', $instance['actionurl'] );

// mc validation
wp_enqueue_script( 'mc-validate');

// before and after widget arguments are defined by themes
echo wp_kses_post( $args['before_widget'] );
if ( ! empty( $title ) )
echo wp_kses_post( $args['before_title'] . $title . $args['after_title'] );

    
?>

<form action="<?php echo esc_url( $actionurl ); ?>" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
	<div class="effect1 w-size9">
		<input class="s-text7 bg6 w-full p-b-5" type="email" id="mce-EMAIL" name="EMAIL" placeholder="<?php esc_html_e( 'email@example.com', 'fashe' ); ?>">
		<span class="effect1-line"></span>
	</div>
    <div id="mce-responses" class="clear">
        <div class="response" id="mce-error-response" style="display:none"></div>
        <div class="response" id="mce-success-response" style="display:none"></div>
    </div>  
	<div class="w-size2 p-t-20">
		<!-- Button -->
		<button type="submit" class="flex-c-m size2 bg4 bo-rad-23 hov1 m-text3 trans-0-4" name="subscribe" id="mc-embedded-subscribe">
			<?php esc_html_e( 'Subscribe', 'fashe' ) ?>
		</button>
	</div>

</form>



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
if ( isset( $instance[ 'actionurl' ] ) ) {
	$actionurl = $instance[ 'actionurl' ];
}else {
	$actionurl = '';
}


// Widget admin form
?>
<p>
<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:' ,'fashe'); ?></label> 
<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
</p>

<p>
<label for="<?php echo esc_attr( $this->get_field_id( 'actionurl' ) ); ?>"><?php esc_html_e( 'Action URL:' ,'fashe'); ?></label> 
<p >Enter here your MailChimp action URL. <a href="http://docs.creativegigs.net/docs/aproch/how-to-use-optin-form/how-to-locate-mailchimp-newsletter-form-action-url/" target="_blank">How to</a></p>
<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'actionurl' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'actionurl' ) ); ?>" type="text" value="<?php echo esc_attr( $actionurl ); ?>" />

</p>

<?php 
}

	
// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {

	
$instance = array();
$instance['title'] 	  = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
$instance['actionurl'] = ( ! empty( $new_instance['actionurl'] ) ) ? strip_tags( $new_instance['actionurl'] ) : '';

return $instance;

}

} // Class fashe_newsletter_widget ends here


// Register and load the widget
function fashe_newsletter_load_widget() {
	register_widget( 'fashe_newsletter_widget' );
}
add_action( 'widgets_init', 'fashe_newsletter_load_widget' );