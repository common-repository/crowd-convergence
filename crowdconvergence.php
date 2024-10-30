<?php
/**
 * @package Crowd_Convergence
 * @version 2.0
 */
/*
Plugin Name: Crowd Convergence
Plugin URI: http://crowdconvergence.com/wordpress-plugin/
Description: Include your Crowd Convergence output stream on your Wordpres site.
Author: Crowd Convergence
Version: 2.0
Author URI: http://crowdconvergence.com/
*/




/**
 * Adds Crowd_Convergence widget.
 */
class Crowd_Convergence extends WP_Widget {

	/*
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
	 		'crowd_convergence', // Base ID
			'Crowd Convergence Widget', // Name
			array( 'description' => __( 'Display a timeline of moderated social items from your Crowd Convergence account.', 'text_domain' ), ) // Args
		);
	}

	/*
	 * Front-end display of widget.
	 */
	public function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );

		$widget_title = $instance['widget_title'];
		$url = $instance['url'];
		$follow_button = $instance['follow_button'];
		$tweet_box = $instance['tweet_box'];
		$height = $instance['height'];
		$width = $instance['width'];
		$items_to_display = $instance['items_to_display'];
		$theme = $instance['theme'];
		$show_avatars = $instance['show_avatars'];
		$show_media = $instance['show_media'];
		$show_time = $instance['show_time'];
		$show_source_logo = $instance['show_source_logo'];

		echo $before_widget;
		if ( ! empty( $title ) )
			echo $before_title . $title . $after_title;

	?>

		<div id="crowd-convergence-widget"></div>
		<script src="https://secure.crowdconvergence.com/js/html-widget-load.js"></script>
		<script type="text/javascript">
 			window.CrowdConvergenceWidget.start({"widget-title":"<?php echo $widget_title; ?>","height":"<?php echo $height; ?>","width":"<?php echo $width; ?>","item-count":<?php echo $items_to_display; ?>,"colours":"<?php echo $theme; ?>","display-avatars":<?php echo $show_avatars; ?>,"display-media":<?php echo $show_media; ?>,"display-timestamps":<?php echo $show_time; ?>,"display-source-logo":<?php echo $show_source_logo; ?>,"widget-follow":"<?php echo $follow_button; ?>","widget-tweet-box":"<?php echo $tweet_box; ?>","url":"<?php echo $url; ?>"})
 		</script>

	<?php

		echo $after_widget;
	}

	/*
	 * Sanitize widget form values as they are saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['widget_title'] = strip_tags( $new_instance['widget_title'] );
		$instance['url'] = strip_tags( $new_instance['url'] );
		$instance['follow_button'] = strip_tags( $new_instance['follow_button'] );
		$instance['tweet_box'] = strip_tags( $new_instance['tweet_box'] );
		$instance['height'] = strip_tags( $new_instance['height'] );
		$instance['width'] = strip_tags( $new_instance['width'] );
		$instance['items_to_display'] = strip_tags( $new_instance['items_to_display'] );
		$instance['theme'] = strip_tags( $new_instance['theme'] );
		$instance['show_avatars'] = strip_tags( $new_instance['show_avatars'] );
		$instance['show_media'] = strip_tags( $new_instance['show_media'] );
		$instance['show_time'] = strip_tags( $new_instance['show_time'] );
		$instance['show_source_logo'] = strip_tags( $new_instance['show_source_logo'] );

		return $instance;
	}

	/*
	 * Back-end widget form.
	 */
	public function form( $instance ) {

		// defaults
		$widget_title = (isset($instance['widget_title'])) ? $instance['widget_title'] : __( 'Social Stream', 'text_domain' );
		$url = (isset($instance['url'])) ? $instance['url'] : __( 'https://', 'text_domain' );
		$follow_button = (isset($instance['follow_button'])) ? $instance['follow_button'] : __( 'CrowdConverge', 'text_domain' );
		$tweet_box = (isset($instance['tweet_box'])) ? $instance['tweet_box'] : __( 'CrowdConverge', 'text_domain' );
		$height = (isset($instance['height'])) ? $instance['height'] : __( '600', 'text_domain' );
		$width = (isset($instance['width'])) ? $instance['width'] : __( '400', 'text_domain' );
		$items_to_display = (isset($instance['items_to_display'])) ? $instance['items_to_display'] : __( '10', 'text_domain' );
		$theme = (isset($instance['theme'])) ? $instance['theme'] : __( 'light', 'text_domain' );
		$show_avatars = (isset($instance['show_avatars'])) ? $instance['show_avatars'] : __( 'true', 'text_domain' );
		$show_media = (isset($instance['show_media'])) ? $instance['show_media'] : __( 'true', 'text_domain' );
		$show_time = (isset($instance['show_time'])) ? $instance['show_time'] : __( 'true', 'text_domain' );
		$show_source_logo = (isset($instance['show_source_logo'])) ? $instance['show_source_logo'] : __( 'true', 'text_domain' );

		?>

		<style type="text/css">
		.widget_label { display: inline-block; width: 120px; }
		</style>

		<p>
		<label class="widget_label" for="<?php echo $this->get_field_id( 'widget_title' ); ?>"><?php _e( 'Title:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'widget_title' ); ?>" name="<?php echo $this->get_field_name( 'widget_title' ); ?>" type="text" value="<?php echo esc_attr( $widget_title ); ?>" />
		</p>

		<p>
		<label class="widget_label" for="<?php echo $this->get_field_id( 'url' ); ?>"><?php _e( 'Output URL:' ); ?> <small><br>(Product specific output)</small></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'url' ); ?>" name="<?php echo $this->get_field_name( 'url' ); ?>" type="text" value="<?php echo esc_attr( $url ); ?>" />
		</p>

		<p>
		<label class="widget_label" for="<?php echo $this->get_field_id( 'follow_button' ); ?>"><?php _e( 'Follow button:' ); ?><small><br>(Leave blank to hide)</small></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'follow_button' ); ?>" name="<?php echo $this->get_field_name( 'follow_button' ); ?>" type="text" value="<?php echo esc_attr( $follow_button ); ?>" />
		</p>

		<p>
		<label class="widget_label" for="<?php echo $this->get_field_id( 'tweet_box' ); ?>"><?php _e( 'Tweet box:' ); ?><small><br>(Leave blank to hide)</small></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'tweet_box' ); ?>" name="<?php echo $this->get_field_name( 'tweet_box' ); ?>" type="text" value="<?php echo esc_attr( $tweet_box ); ?>" />
		</p>

		<p>
		<label class="widget_label" for="<?php echo $this->get_field_id( 'height' ); ?>"><?php _e( 'Height:' ); ?></label>
		<input class="small-text" id="<?php echo $this->get_field_id( 'height' ); ?>" name="<?php echo $this->get_field_name( 'height' ); ?>" type="text" value="<?php echo esc_attr( $height ); ?>" /> px
		</p>

		<p>
		<label class="widget_label" for="<?php echo $this->get_field_id( 'width' ); ?>"><?php _e( 'Width:' ); ?></label>
		<input class="small-text" id="<?php echo $this->get_field_id( 'width' ); ?>" name="<?php echo $this->get_field_name( 'width' ); ?>" type="text" value="<?php echo esc_attr( $width ); ?>" /> px
		</p>

		<p>
		<label class="widget_label" for="<?php echo $this->get_field_id( 'items_to_display' ); ?>"><?php _e( 'Items to display:' ); ?></label>
		<input class="small-text" id="<?php echo $this->get_field_id( 'items_to_display' ); ?>" name="<?php echo $this->get_field_name( 'items_to_display' ); ?>" type="text" value="<?php echo esc_attr( $items_to_display ); ?>" />
		</p>

		<p>
		<label class="widget_label" for="<?php echo $this->get_field_id( 'theme' ); ?>"><?php _e( 'Theme:' ); ?></label>
		<select id="<?php echo $this->get_field_id( 'theme' ); ?>" name="<?php echo $this->get_field_name( 'theme' ); ?>">
			<option <?php echo esc_attr( $theme ) == 'light' ? 'selected' : ''; ?> value="light">Light</option>
			<option <?php echo esc_attr( $theme ) != 'light' ? 'selected' : ''; ?> value="dark">Dark</option>
		</select>
		</p>

		<p>
		<label class="widget_label" for="<?php echo $this->get_field_id( 'show_avatars' ); ?>"><?php _e( 'Show avatars:' ); ?></label>
		<select id="<?php echo $this->get_field_id( 'show_avatars' ); ?>" name="<?php echo $this->get_field_name( 'show_avatars' ); ?>">
			<option <?php echo esc_attr( $show_avatars ) == 'true' ? 'selected' : ''; ?> value="true">Yes</option>
			<option <?php echo esc_attr( $show_avatars ) != 'true' ? 'selected' : ''; ?> value="false">No</option>
		</select>
		</p>

		<p>
		<label class="widget_label" for="<?php echo $this->get_field_id( 'show_media' ); ?>"><?php _e( 'Show media:' ); ?></label>
		<select id="<?php echo $this->get_field_id( 'show_media' ); ?>" name="<?php echo $this->get_field_name( 'show_media' ); ?>">
			<option <?php echo esc_attr( $show_media ) == 'true' ? 'selected' : ''; ?> value="true">Yes</option>
			<option <?php echo esc_attr( $show_media ) != 'true' ? 'selected' : ''; ?> value="false">No</option>
		</select>
		</p>

		<p>
		<label class="widget_label" for="<?php echo $this->get_field_id( 'show_time' ); ?>"><?php _e( 'Show time:' ); ?></label>
		<select id="<?php echo $this->get_field_id( 'show_time' ); ?>" name="<?php echo $this->get_field_name( 'show_time' ); ?>">
			<option <?php echo esc_attr( $show_time ) == 'true' ? 'selected' : ''; ?> value="true">Yes</option>
			<option <?php echo esc_attr( $show_time ) != 'true' ? 'selected' : ''; ?> value="false">No</option>
		</select>
		</p>

		<p>
		<label class="widget_label" for="<?php echo $this->get_field_id( 'show_source_logo' ); ?>"><?php _e( 'Show source logo:' ); ?></label>
		<select id="<?php echo $this->get_field_id( 'show_source_logo' ); ?>" name="<?php echo $this->get_field_name( 'show_source_logo' ); ?>">
			<option <?php echo esc_attr( $show_source_logo ) == 'true' ? 'selected' : ''; ?> value="true">Yes</option>
			<option <?php echo esc_attr( $show_source_logo ) != 'true' ? 'selected' : ''; ?> value="false">No</option>
		</select>
		</p>

		<?php
	}

} // class Crowd_Convergence


// register Crowd_Convergence widget
add_action( 'widgets_init', create_function( '', 'register_widget( "crowd_convergence" );' ) );


?>
