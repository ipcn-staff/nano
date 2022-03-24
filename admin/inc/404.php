<?php
/*
 * Manage 404 tab
 */

// Add default values
add_filter( 'before_getting_design_plus_option', 'add_404_dp_default_options' );

// Add label of 404 tab
add_action( 'tcd_tab_labels', 'add_404_tab_label' );

// Add HTML of 404 tab
add_action( 'tcd_tab_panel', 'add_404_tab_panel' );

// Register sanitize function
add_filter( 'theme_options_validate', 'add_404_theme_options_validate' );

function add_404_dp_default_options( $dp_default_options ) {

  $dp_default_options['404_ph_title'] = '404 Not Found';
  $dp_default_options['404_ph_title_font_size'] = 46;
  $dp_default_options['404_ph_title_font_size_sp'] = 29;
  $dp_default_options['404_ph_title_color'] = '#ffffff';
  $dp_default_options['404_ph_sub'] = __( '404 Not Found', 'tcd-w' );
  $dp_default_options['404_ph_sub_color'] = '#ffffff';
  $dp_default_options['404_ph_img'] = '';
  $dp_default_options['404_ph_overlay'] = '#000000';
  $dp_default_options['404_ph_overlay_opacity'] = 0;

	return $dp_default_options;
}

function add_404_tab_label( $tab_labels ) {
	$tab_labels['404'] = __( '404 page', 'tcd-w' );
	return $tab_labels;
}

function add_404_tab_panel( $dp_options ) {
  global $dp_default_options;
?>
<div id="tab-content-404">
  <p style="margin-top:0;">
    <?php _e( 'The 404 page is displayed when accessing the page with the browser, but the page does not exist on the website.Please set the header image, catch phrase, explanation to be displayed on page 404.', 'tcd-w' ); ?>
  </p>

	<div class="theme_option_field cf">
  	<h3 class="theme_option_headline"><?php _e( 'Page header settings', 'tcd-w' ); ?></h3>
    <h4 class="theme_option_headline2"><?php _e( 'Title', 'tcd-w' ); ?></h4>
    <p><?php _e( 'Set the title of page header.', 'tcd-w' ); ?></p>
    <p><input type="text" class="regular-text" name="dp_options[404_ph_title]" value="<?php echo esc_attr( $dp_options['404_ph_title'] ); ?>"></p>
    <p><?php _e( 'Font size', 'tcd-w' ); ?> <input type="number" min="1" step="1" name="dp_options[404_ph_title_font_size]" value="<?php echo esc_attr( $dp_options['404_ph_title_font_size'] ); ?>" class="tiny-text"> px</p>
    <p><?php _e( 'Font size (mobile)', 'tcd-w' ); ?> <input type="number" min="1" step="1" name="dp_options[404_ph_title_font_size_sp]" value="<?php echo esc_attr( $dp_options['404_ph_title_font_size_sp'] ); ?>" class="tiny-text"> px</p>
    <input type="text" class="c-color-picker" name="dp_options[404_ph_title_color]" value="<?php echo esc_attr( $dp_options['404_ph_title_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['404_ph_title_color'] ); ?>">
    <h4 class="theme_option_headline2"><?php _e( 'Sub title', 'tcd-w' ); ?></h4>
    <p><?php _e( 'Set the sub title of page header.', 'tcd-w' ); ?></p>
    <p><input type="text" class="regular-text" name="dp_options[404_ph_sub]" value="<?php echo esc_attr( $dp_options['404_ph_sub'] ); ?>"></p>
    <input type="text" class="c-color-picker" name="dp_options[404_ph_sub_color]" value="<?php echo esc_attr( $dp_options['404_ph_sub_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['404_ph_sub_color'] ); ?>">
    <h4 class="theme_option_headline2"><?php _e( 'Background image', 'tcd-w' ); ?></h4>
    <p><?php _e( 'Recommended image size. Width: 1450px, Height: 450px', 'tcd-w' ); ?></p>
  	<div class="image_box cf">
  		<div class="cf cf_media_field hide-if-no-js 404_ph_img">
  			<input type="hidden" value="<?php echo esc_attr( $dp_options['404_ph_img'] ); ?>" id="404_ph_img" name="dp_options[404_ph_img]" class="cf_media_id">
  			<div class="preview_field"><?php if ( $dp_options['404_ph_img'] ) { echo wp_get_attachment_image( $dp_options['404_ph_img'], 'medium' ); } ?></div>
  			<div class="button_area">
  				<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
  				<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $dp_options['404_ph_img'] ) { echo 'hidden'; } ?>">
  			</div>
  		</div>
  	</div>
    <h4 class="theme_option_headline2"><?php _e( 'Color overlay on the background image', 'tcd-w' ); ?></h4>
    <p><?php _e( 'Use overlay, to make it easy to read the title. Please set color of overlay.', 'tcd-w' ); ?></p>
    <input class="c-color-picker" type="text" name="dp_options[404_ph_overlay]" data-default-color="<?php echo esc_attr( $dp_default_options['404_ph_overlay'] ); ?>" value="<?php echo esc_attr( $dp_options['404_ph_overlay'] ); ?>">
    <h4 class="theme_option_headline2"><?php _e( 'Opacity of the overlay on the background image', 'tcd-w' ); ?></h4>
    <p><?php _e( 'Please set opacity of overlay (e.g. 0.3). If you do not want to display the overlay, enter "0"', 'tcd-w' ); ?></p>
    <input type="number" min="0" max="1.0" step="0.1" name="dp_options[404_ph_overlay_opacity]" value="<?php echo esc_attr( $dp_options['404_ph_overlay_opacity'] ); ?>">
    <input type="submit" class="button-ml ajax_button" value="<?php echo _e( 'Save Changes', 'tcd-w' ); ?>">
	</div>

</div><!-- END #tab-content-404 -->
<?php
}

function add_404_theme_options_validate( $input ) {

 	$input['404_ph_title'] = sanitize_text_field( $input['404_ph_title'] );
 	$input['404_ph_title_font_size'] = absint( $input['404_ph_title_font_size'] );
 	$input['404_ph_title_font_size_sp'] = absint( $input['404_ph_title_font_size_sp'] );
 	$input['404_ph_title_color'] = sanitize_hex_color( $input['404_ph_title_color'] );
 	$input['404_ph_sub'] = sanitize_text_field( $input['404_ph_sub'] );
 	$input['404_ph_sub_color'] = sanitize_hex_color( $input['404_ph_sub_color'] );
 	$input['404_ph_img'] = absint( $input['404_ph_img'] );
 	$input['404_ph_overlay'] = sanitize_hex_color( $input['404_ph_overlay'] );
 	$input['404_ph_overlay_opacity'] = sanitize_text_field( $input['404_ph_overlay_opacity'] );

	return $input;
}
