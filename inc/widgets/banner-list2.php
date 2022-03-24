<?php
/**
 * Banner list2 (tcd ver)
 */
class tcdw_banner_list2_widget extends WP_Widget {

  private $banner_count = 3;

	/**
	 * Sets up the widgets name etc
	 */
  function __construct() {
    parent::__construct(
      'tcdw_banner_list2_widget',// ID
      __( 'Banner list2 (tcd ver)', 'tcd-w' ),
      array(
        'classname' => 'tcdw_banner_list2_widget',
        'description' => __( 'Displays banner list.', 'tcd-w' )
      )
    );
  }

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {

    $title = apply_filters( 'widget_title', $instance['title'] );
    $output = '';

    for ( $i = 1; $i <= $this->banner_count; $i++ ) {

      if ( ! $instance['banner_image' . $i] ) continue;

      $banner_catch = trim( $instance['banner_catch' . $i] );
      $banner_title = trim( $instance['banner_title' . $i] );
      $banner_sub = trim( $instance['banner_sub' . $i] );
      $banner_display_gradation_overlay = $instance['banner_display_gradation_overlay' . $i];
      $banner_gradation_overlay = $instance['banner_gradation_overlay' . $i];
      $banner_url = $instance['banner_url' . $i];
      $banner_target_blank = $instance['banner_target_blank' . $i] ? ' target="_blank"' : '';
      $banner_image = wp_get_attachment_image_src( $instance['banner_image' . $i], 'size4' );

      $output .= '<li class="p-banners-list__item p-banner p-banner--lg">';

      $output .= $banner_target_blank
        ? '<a href="' . esc_url( $banner_url ) . '" target="_blank">'
        : '<a href="' . esc_url( $banner_url ) . '">';

      $output .= $banner_display_gradation_overlay
        ? '<div class="p-banner__content" style="background: linear-gradient(to right, rgba(' . implode( ', ', hex2rgb( $banner_gradation_overlay ) ) . ', 0.75) 0%, transparent 75%);">'
        : '<div class="p-banner__content">';

      $output .= '<p>' . nl2br( esc_html( $banner_catch ) ) . '</p>';
      $output .= '<p class="p-banner__title">' . esc_html( $banner_title ) . '</p>';
      $output .= '<p>' . esc_html( $banner_sub ) . '</p>';

      $output .= '</div>';

      $output .= '<img src="' . esc_attr( $banner_image[0] ) . '" alt="">';

      $output .= '</a></li>';
    }

   	echo $args['before_widget'];

		if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}

    if ( ! $output ) return;

    echo "\n" . '<ul class="p-banners-list">' . "\n" . $output . '</ul>' . "\n";

		echo $args['after_widget'];
  }

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
  function form( $instance ) {
    $defaults = array( 'title' => '' );

    for ( $i = 1; $i <= $this->banner_count; $i++ ) {
      $defaults['banner_catch' . $i] = '';
      $defaults['banner_title' . $i] = '';
      $defaults['banner_sub' . $i] = '';
      $defaults['banner_display_gradation_overlay' . $i] = 0;
      $defaults['banner_gradation_overlay' . $i] = '#000000';
      $defaults['banner_url' . $i] = '';
      $defaults['banner_image' . $i] = '';
      $defaults['banner_target_blank' . $i] = 0;
    }

    $instance = wp_parse_args( (array) $instance, $defaults );
?>
  <p>
    <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Catchphrase:', 'tcd-w' ); ?></label>
    <input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $instance['title']) ; ?>" class="widefat">
  </p>
  <?php for ( $i = 1; $i <= $this->banner_count; $i++ ) : ?>
  <div class="a-widget-box">
    <h4 class="a-widget-box__headline"><?php _e( 'Banner','tcd-w' ); ?><?php echo $i; ?></h4>
    <div class="a-widget-box__content">
      <h5 class="a-widget-box__sub-headline">
        <label for="<?php echo $this->get_field_id( 'banner_catch' . $i ); ?>"><?php _e( 'Banner title:', 'tcd-w' ); ?></label>
      </h5>
      <p><textarea id="<?php echo $this->get_field_id( 'banner_catch' . $i ); ?>" name="<?php echo $this->get_field_name( 'banner_catch' . $i ); ?>" class="widefat"><?php echo esc_textarea( $instance['banner_catch' . $i] ); ?></textarea></p>
      <h5 class="a-widget-box__sub-headline">
        <label for="<?php echo $this->get_field_id( 'banner_title' . $i ); ?>"><?php _e( 'Banner title:', 'tcd-w' ); ?></label>
      </h5>
      <p><input type="text" id="<?php echo $this->get_field_id( 'banner_title' . $i ); ?>" name="<?php echo $this->get_field_name( 'banner_title' . $i ); ?>" class="widefat" value="<?php echo esc_attr( $instance['banner_title' . $i] ); ?>"></p>
      <h5 class="a-widget-box__sub-headline">
        <label for="<?php echo $this->get_field_id( 'banner_sub' . $i ); ?>"><?php _e( 'Banner sub title:', 'tcd-w' ); ?></label>
      </h5>
      <p><input type="text" id="<?php echo $this->get_field_id( 'banner_sub' . $i ); ?>" name="<?php echo $this->get_field_name( 'banner_sub' . $i ); ?>" class="widefat" value="<?php echo esc_attr( $instance['banner_sub' . $i] ); ?>"></p>
      <h5 class="a-widget-box__sub-headline">
        <label for="<?php echo $this->get_field_id( 'banner_gradation_overlay' . $i ); ?>"><?php _e( 'Gradation overlay', 'tcd-w' ); ?></label>
      </h5>
      <p><label><input type="checkbox" id="<?php echo $this->get_field_id( 'banner_display_gradation_overlay' . $i ); ?>" name="<?php echo $this->get_field_name( 'banner_display_gradation_overlay' . $i ); ?>" value="1" <?php checked( 1, $instance['banner_display_gradation_overlay' . $i] ); ?>> <?php _e( 'Display gradation overlay', 'tcd-w' ); ?></label></p>
      <p><input type="text" id="<?php echo $this->get_field_id( 'banner_gradation_overlay' . $i ); ?>" name="<?php echo $this->get_field_name( 'banner_gradation_overlay' . $i ); ?>" value="<?php echo esc_html( $instance['banner_gradation_overlay' . $i] ); ?>" class="w-color-picker" data-default-color="#000000"></p>
      <h5 class="a-widget-box__sub-headline">
        <label for="<?php echo $this->get_field_id( 'banner_url' . $i ); ?>"><?php _e( 'Banner url:', 'tcd-w' ); ?></label>
      </h5>
      <p><input type="text" id="<?php echo $this->get_field_id( 'banner_url' . $i ); ?>" name="<?php echo $this->get_field_name( 'banner_url' . $i ); ?>" value="<?php echo $instance['banner_url' . $i]; ?>" class="widefat"></p>
      <input type="hidden" name="<?php echo $this->get_field_name( 'banner_target_blank' . $i ); ?>" value="0">
      <p><label><input id="<?php echo $this->get_field_id( 'banner_target_blank' . $i ); ?>" name="<?php echo $this->get_field_name( 'banner_target_blank' . $i ); ?>" type="checkbox" value="1" <?php checked( '1', $instance['banner_target_blank' . $i] ); ?>> <?php _e( 'Open link in new window', 'tcd-w' ); ?></label></p>
      <h5 class="a-widget-box__sub-headline">
        <label for="<?php echo $this->get_field_id( 'banner_image' . $i ); ?>"><?php _e( 'Banner image:', 'tcd-w' ); ?></label>
      </h5>
      <div class="a-widget-box__upload cf cf_media_field hide-if-no-js <?php echo $this->get_field_id( 'banner_image' . $i ); ?>">
        <input type="hidden" value="<?php echo $instance['banner_image' . $i]; ?>" id="<?php echo $this->get_field_id( 'banner_image' . $i ); ?>" name="<?php echo $this->get_field_name( 'banner_image' . $i ); ?>" class="cf_media_id">
        <div class="preview_field"><?php if ( $instance['banner_image' . $i] ) { echo wp_get_attachment_image( $instance['banner_image' . $i], 'medium' ); } ?></div>
        <div class="button_area">
          <input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
          <input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $instance['banner_image' . $i] ) { echo 'hidden'; } ?>">
        </div>
      </div>
      <p class="description"><?php _e( 'Recommend image size. Width:600px, Height:400px', 'tcd-w' ); ?></p>
    </div>
  </div>
  <?php endfor; ?>
<?php
  }

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
  function update( $new_instance, $old_instance ) {

    $new_instance['title'] = strip_tags( $new_instance['title'] );

    for ( $i = 1; $i <= $this->banner_count; $i++ ) {
      $new_instance['banner_catch' . $i] = strip_tags( $new_instance['banner_catch' . $i] );
      $new_instance['banner_title' . $i] = strip_tags( $new_instance['banner_title' . $i] );
      $new_instance['banner_sub' . $i] = strip_tags( $new_instance['banner_sub' . $i] );
      if ( ! isset( $new_instance['banner_display_gradation_overlay' . $i] ) ) $new_instance['banner_display_gradation_overlay' . $i] = null;
      $new_instance['banner_display_gradation_overlay' . $i] = '1' === $new_instance['banner_display_gradation_overlay' . $i] ? '1' : null;
      $new_instance['banner_gradation_overlay' . $i] = strip_tags( $new_instance['banner_gradation_overlay' . $i] );
      $new_instance['banner_url' . $i] = strip_tags( $new_instance['banner_url' . $i] );
      if ( ! isset( $new_instance['banner_target_blank' . $i] ) ) $new_instance['banner_target_blank' . $i] = null;
      $new_instance['banner_target_blank' . $i] = '1' === $new_instance['banner_target_blank' . $i] ? '1' : null;
      $new_instance['banner_image' . $i] = strip_tags( $new_instance['banner_image' . $i] );
    }
    return $new_instance;
  }
}

// register tcdw_banner_list2_widget widget
function register_tcdw_banner_list2_widget() {
	register_widget( 'tcdw_banner_list2_widget' );
}
add_action( 'widgets_init', 'register_tcdw_banner_list2_widget' );
