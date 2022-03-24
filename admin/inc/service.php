<?php
/*
 * Manage service tab
 */

// Add default values
add_filter( 'before_getting_design_plus_option', 'add_service_dp_default_options' );

//  Add label of service tab
add_action( 'tcd_tab_labels', 'add_service_tab_label' );

// Add HTML of service tab
add_action( 'tcd_tab_panel', 'add_service_tab_panel' );

// Register sanitize function
add_filter( 'theme_options_validate', 'add_service_theme_options_validate' );

function add_service_dp_default_options( $dp_default_options ) {

  // Service page
  $dp_default_options['service_breadcrumb'] = __( 'Service', 'tcd-w' );
  $dp_default_options['service_slug'] = 'service';

  // Basic
	$dp_default_options['service_key_color'] = '#d80100';
	$dp_default_options['service_title'] = 'SERVICE';
	$dp_default_options['service_title_font_size'] = 30;
	$dp_default_options['service_title_font_size_sp'] = 20;
	$dp_default_options['service_title_color'] = '#ffffff';
	$dp_default_options['service_sub'] = __( 'Service', 'tcd-w' );
	$dp_default_options['service_sub_font_size'] = 16;
	$dp_default_options['service_sub_font_size_sp'] = 14;
	$dp_default_options['service_sub_color'] = '#ffffff';

  // Page header
  $dp_default_options['service_ph_title'] = 'SERVICE';
  $dp_default_options['service_ph_title_font_size'] = 46;
  $dp_default_options['service_ph_title_font_size_sp'] = 29;
  $dp_default_options['service_ph_title_color'] = '#ffffff';
  $dp_default_options['service_ph_sub'] = __( 'Service', 'tcd-w' );
  $dp_default_options['service_ph_sub_color'] = '#ffffff';
  $dp_default_options['service_ph_img'] = '';
  $dp_default_options['service_ph_overlay'] = '#000000';
  $dp_default_options['service_ph_overlay_opacity'] = 0;

  // Archive page
  $dp_default_options['service_archive_catch'] = __( 'Enter catchphrase here.', 'tcd-w' );
  $dp_default_options['service_archive_catch_font_size'] = 38;
  $dp_default_options['service_archive_catch_font_size_sp'] = 20;
  $dp_default_options['service_archive_catch_color'] = '#000000';
  $dp_default_options['service_archive_desc'] = __( "Enter description here. Enter description here. Enter description here.\nEnter description here. Enter description here. Enter description here. Enter description here. Enter description here.", 'tcd-w' );
  $dp_default_options['service_archive_desc_font_size'] = 16;
  $dp_default_options['service_archive_desc_font_size_sp'] = 14;
  $dp_default_options['service_archive_desc_color'] = '#000000';
	$dp_default_options['service_post_num'] = 6;

  // Posts list
  $dp_default_options['service_post_title_font_size'] = 32;
  $dp_default_options['service_post_title_font_size_sp'] = 24;
  $dp_default_options['service_post_title_color'] = '#000000';
  $dp_default_options['service_post_sub_font_size'] = 16;
  $dp_default_options['service_post_sub_font_size_sp'] = 14;
  $dp_default_options['service_post_sub_color'] = '#000000';
  $dp_default_options['service_post_desc_font_size'] = 20;
  $dp_default_options['service_post_desc_font_size_sp'] = 16;
  $dp_default_options['service_post_desc_color'] = '#000000';

  // Single page
	$dp_default_options['service_single_title_font_size'] = 32;
	$dp_default_options['service_single_title_font_size_sp'] = 20;
	$dp_default_options['service_content_font_size'] = 16;
	$dp_default_options['service_content_font_size_sp'] = 14;

	// Display
	$dp_default_options['service_show_thumbnail'] = 1;

	return $dp_default_options;
}

function add_service_tab_label( $tab_labels ) {
  $dp_options = get_design_plus_options();

  $tab_labels['service'] = $dp_options['service_breadcrumb'] ? $dp_options['service_breadcrumb'] : __( 'Service', 'tcd-w' );

	return $tab_labels;
}

function add_service_tab_panel( $dp_options ) {
  global $dp_default_options;
?>
<div id="tab-content-service">

	<?php // Service page ?>
	<div class="theme_option_field cf">
  	<h3 class="theme_option_headline"><?php _e( 'Service page settings', 'tcd-w' ); ?></h3>
		<h4 class="theme_option_headline2"><?php _e( 'Breadcrumb settings', 'tcd-w' ); ?></h4>
		<p><?php _e( 'It is used in the breadcrumb navigation. If it is not registerd, "Service" is displayed instead.', 'tcd-w' ); ?></p>
		<p><input type="text" name="dp_options[service_breadcrumb]" value="<?php echo esc_attr( $dp_options['service_breadcrumb'] ); ?>"></p>
    <h4 class="theme_option_headline2"><?php _e( 'Slug settings', 'tcd-w' ); ?></h4>
		<p><?php _e( 'It is used in URL. You can use only alphanumeric. If it is not registerd, "service" is used instead.', 'tcd-w' ); ?></p>
		<p><?php _e( 'Note: if you want to change the slug, change permalinks from "Plain".', 'tcd-w' ); ?></p>
		<p><?php _e( 'Note: after changing the slug, you need to go to "Permalink Settings" and click "Save Changes".', 'tcd-w' ); ?></p>
		<p><input type="text" name="dp_options[service_slug]" value="<?php echo esc_attr( $dp_options['service_slug'] ); ?>"></p>
    <input type="submit" class="button-ml ajax_button" value="<?php echo _e( 'Save Changes', 'tcd-w' ); ?>">
	</div>

  <?php // Basic ?>
  <div class="theme_option_field cf">
  	<h3 class="theme_option_headline"><?php _e( 'Basic settings', 'tcd-w' ); ?></h3>
    <p><?php _e( 'Set the key color and page title area to be displayed in the sidebar.', 'tcd-w' ); ?>
  	<h4 class="theme_option_headline2"><?php _e( 'Key color', 'tcd-w' ); ?></h4>
    <p><?php _e( 'This color is used for the background color of the page title in the sidebar, the color of the frame line when hovering in the category list, the color of the border line of the main content, and the link hover color.', 'tcd-w' ); ?></p>
    <input type="text" class="c-color-picker" name="dp_options[service_key_color]" value="<?php echo esc_attr( $dp_options['service_key_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['service_key_color'] ); ?>">
  	<h4 class="theme_option_headline2"><?php _e( 'Title', 'tcd-w' ); ?></h4>
    <p><?php _e( 'Please set the title displayed at the top of the sidebar.', 'tcd-w' ); ?></p>
    <input class="regular-text" type="text" name="dp_options[service_title]" value="<?php echo esc_attr( $dp_options['service_title'] ); ?>">
    <p><?php _e( 'Font size', 'tcd-w' ); ?> <input type="number" min="1" step="1" value="<?php echo esc_attr( $dp_options['service_title_font_size'] ); ?>" name="dp_options[service_title_font_size]" class="tiny-text"> px</p>
    <p><?php _e( 'Font size for mobile', 'tcd-w' ); ?> <input type="number" min="1" step="1" value="<?php echo esc_attr( $dp_options['service_title_font_size_sp'] ); ?>" class="tiny-text" name="dp_options[service_title_font_size_sp]"> px</p>
    <input type="text" class="c-color-picker" name="dp_options[service_title_color]" value="<?php echo esc_attr( $dp_options['service_title_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['service_title_color'] ); ?>">
  	<h4 class="theme_option_headline2"><?php _e( 'Sub title', 'tcd-w' ); ?></h4>
    <p><?php _e( 'Please set the sub title displayed at the top of the sidebar.', 'tcd-w' ); ?></p>
    <input class="regular-text" type="text" name="dp_options[service_sub]" value="<?php echo esc_attr( $dp_options['service_sub'] ); ?>">
    <p><?php _e( 'Font size', 'tcd-w' ); ?> <input type="number" min="1" step="1" value="<?php echo esc_attr( $dp_options['service_sub_font_size'] ); ?>" name="dp_options[service_sub_font_size]" class="tiny-text"> px</p>
    <p><?php _e( 'Font size for mobile', 'tcd-w' ); ?> <input type="number" min="1" step="1" value="<?php echo esc_attr( $dp_options['service_sub_font_size_sp'] ); ?>" class="tiny-text" name="dp_options[service_sub_font_size_sp]"> px</p>
    <input type="text" class="c-color-picker" name="dp_options[service_sub_color]" value="<?php echo esc_attr( $dp_options['service_sub_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['service_sub_color'] ); ?>">
    <input type="submit" class="button-ml ajax_button" value="<?php echo _e( 'Save Changes', 'tcd-w' ); ?>">
	</div>

	<?php // Page header ?>
	<div class="theme_option_field cf">
  	<h3 class="theme_option_headline"><?php _e( 'Page header settings', 'tcd-w' ); ?></h3>
    <p><?php _e( 'Set the page header to display at archive page.', 'tcd-w' ); ?></p>
    <h4 class="theme_option_headline2"><?php _e( 'Title', 'tcd-w' ); ?></h4>
    <p><?php _e( 'Set the title of page header.', 'tcd-w' ); ?></p>
    <p><input type="text" class="regular-text" name="dp_options[service_ph_title]" value="<?php echo esc_attr( $dp_options['service_ph_title'] ); ?>"></p>
    <p><?php _e( 'Font size', 'tcd-w' ); ?> <input type="number" min="1" step="1" name="dp_options[service_ph_title_font_size]" value="<?php echo esc_attr( $dp_options['service_ph_title_font_size'] ); ?>" class="tiny-text"> px</p>
    <p><?php _e( 'Font size (mobile)', 'tcd-w' ); ?> <input type="number" min="1" step="1" name="dp_options[service_ph_title_font_size_sp]" value="<?php echo esc_attr( $dp_options['service_ph_title_font_size_sp'] ); ?>" class="tiny-text"> px</p>
    <input type="text" class="c-color-picker" name="dp_options[service_ph_title_color]" value="<?php echo esc_attr( $dp_options['service_ph_title_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['service_ph_title_color'] ); ?>">
    <h4 class="theme_option_headline2"><?php _e( 'Sub title', 'tcd-w' ); ?></h4>
    <p><?php _e( 'Set the sub title of page header.', 'tcd-w' ); ?></p>
    <p><input type="text" class="regular-text" name="dp_options[service_ph_sub]" value="<?php echo esc_attr( $dp_options['service_ph_sub'] ); ?>"></p>
    <input type="text" class="c-color-picker" name="dp_options[service_ph_sub_color]" value="<?php echo esc_attr( $dp_options['service_ph_sub_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['service_ph_sub_color'] ); ?>">
    <h4 class="theme_option_headline2"><?php _e( 'Background image', 'tcd-w' ); ?></h4>
    <p><?php _e( 'Recommended image size. Width: 1450px, Height: 450px', 'tcd-w' ); ?></p>
  	<div class="image_box cf">
  		<div class="cf cf_media_field hide-if-no-js service_ph_img">
  			<input type="hidden" value="<?php echo esc_attr( $dp_options['service_ph_img'] ); ?>" id="service_ph_img" name="dp_options[service_ph_img]" class="cf_media_id">
  			<div class="preview_field"><?php if ( $dp_options['service_ph_img'] ) { echo wp_get_attachment_image( $dp_options['service_ph_img'], 'medium' ); } ?></div>
  			<div class="button_area">
  				<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
  				<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $dp_options['service_ph_img'] ) { echo 'hidden'; } ?>">
  			</div>
  		</div>
  	</div>
    <h4 class="theme_option_headline2"><?php _e( 'Color overlay on the background image', 'tcd-w' ); ?></h4>
    <p><?php _e( 'Use overlay, to make it easy to read the title. Please set color of overlay.', 'tcd-w' ); ?></p>
    <input class="c-color-picker" type="text" name="dp_options[service_ph_overlay]" data-default-color="<?php echo esc_attr( $dp_default_options['service_ph_overlay'] ); ?>" value="<?php echo esc_attr( $dp_options['service_ph_overlay'] ); ?>">
    <h4 class="theme_option_headline2"><?php _e( 'Opacity of the overlay on the background image', 'tcd-w' ); ?></h4>
    <p><?php _e( 'Please set opacity of overlay (e.g. 0.3). If you do not want to display the overlay, enter "0"', 'tcd-w' ); ?></p>
    <input type="number" min="0" max="1.0" step="0.1" name="dp_options[service_ph_overlay_opacity]" value="<?php echo esc_attr( $dp_options['service_ph_overlay_opacity'] ); ?>">
    <input type="submit" class="button-ml ajax_button" value="<?php echo _e( 'Save Changes', 'tcd-w' ); ?>">
	</div>

  <?php // Archive page ?>
  <div class="theme_option_field cf">
  	<h3 class="theme_option_headline"><?php _e( 'Archive Page Settings', 'tcd-w' ); ?></h3>
    <p><?php _e( 'Set a catch phrase and description of the archive page.', 'tcd-w' ); ?></p>
    <h4 class="theme_option_headline2"><?php _e( 'Catchphrase', 'tcd-w' ); ?></h4>
    <p><textarea class="regular-text" name="dp_options[service_archive_catch]"><?php echo esc_textarea( $dp_options['service_archive_catch'] ); ?></textarea></p>
    <p><?php _e( 'Font size', 'tcd-w' ); ?> <input type="number" min="1" step="1" name="dp_options[service_archive_catch_font_size]" value="<?php echo esc_attr( $dp_options['service_archive_catch_font_size'] ); ?>" class="tiny-text"> px</p>
    <p><?php _e( 'Font size (mobile)', 'tcd-w' ); ?> <input type="number" min="1" step="1" name="dp_options[service_archive_catch_font_size_sp]" value="<?php echo esc_attr( $dp_options['service_archive_catch_font_size_sp'] ); ?>" class="tiny-text"> px</p>
    <input type="text" class="c-color-picker" name="dp_options[service_archive_catch_color]" value="<?php echo esc_attr( $dp_options['service_archive_catch_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['service_archive_catch_color'] ); ?>">
    <h4 class="theme_option_headline2"><?php _e( 'Description', 'tcd-w' ); ?></h4>
    <p><textarea class="regular-text" name="dp_options[service_archive_desc]"><?php echo esc_textarea( $dp_options['service_archive_desc'] ); ?></textarea></p>
    <p><?php _e( 'Font size', 'tcd-w' ); ?> <input type="number" min="1" step="1" name="dp_options[service_archive_desc_font_size]" value="<?php echo esc_attr( $dp_options['service_archive_desc_font_size'] ); ?>" class="tiny-text"> px</p>
    <p><?php _e( 'Font size (mobile)', 'tcd-w' ); ?> <input type="number" min="1" step="1" name="dp_options[service_archive_desc_font_size_sp]" value="<?php echo esc_attr( $dp_options['service_archive_desc_font_size_sp'] ); ?>" class="tiny-text"> px</p>
    <input type="text" class="c-color-picker" name="dp_options[service_archive_desc_color]" value="<?php echo esc_attr( $dp_options['service_archive_desc_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['service_archive_desc_color'] ); ?>">
    <h4 class="theme_option_headline2"><?php _e( 'Number of posts to display', 'tcd-w' ); ?></h4>
    <p><?php _e( 'You can set the number of posts to be displayed in child category archive page.', 'tcd-w' ); ?></p>
    <input class="tiny-text" type="number" min="1" step="1" name="dp_options[service_post_num]" value="<?php echo esc_attr( $dp_options['service_post_num'] ); ?>"><?php _e( ' posts', 'tcd-w' ); ?>
    <input type="submit" class="button-ml ajax_button" value="<?php echo _e( 'Save Changes', 'tcd-w' ); ?>">
	</div>

  <?php // Posts list ?>
  <div class="theme_option_field cf">
  	<h3 class="theme_option_headline"><?php _e( 'Category list settings', 'tcd-w' ); ?></h3>
    <p><?php _e( 'Set the font size of category list of archive page.', 'tcd-w' ); ?></p>
    <h4 class="theme_option_headline2"><?php _e( 'Title', 'tcd-w' ); ?></h4>
    <p><?php _e( 'Font size', 'tcd-w' ); ?> <input type="number" min="1" step="1" name="dp_options[service_post_title_font_size]" value="<?php echo esc_attr( $dp_options['service_post_title_font_size'] ); ?>" class="tiny-text"> px</p>
    <p><?php _e( 'Font size (mobile)', 'tcd-w' ); ?> <input type="number" min="1" step="1" name="dp_options[service_post_title_font_size_sp]" value="<?php echo esc_attr( $dp_options['service_post_title_font_size_sp'] ); ?>" class="tiny-text"> px</p>
    <input type="text" class="c-color-picker" name="dp_options[service_post_title_color]" value="<?php echo esc_attr( $dp_options['service_post_title_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['service_post_title_color'] ); ?>">
    <h4 class="theme_option_headline2"><?php _e( 'Sub title', 'tcd-w' ); ?></h4>
    <p><?php _e( 'Font size', 'tcd-w' ); ?> <input type="number" min="1" step="1" name="dp_options[service_post_sub_font_size]" value="<?php echo esc_attr( $dp_options['service_post_sub_font_size'] ); ?>" class="tiny-text"> px</p>
    <p><?php _e( 'Font size (mobile)', 'tcd-w' ); ?> <input type="number" min="1" step="1" name="dp_options[service_post_sub_font_size_sp]" value="<?php echo esc_attr( $dp_options['service_post_sub_font_size_sp'] ); ?>" class="tiny-text"> px</p>
    <input type="text" class="c-color-picker" name="dp_options[service_post_sub_color]" value="<?php echo esc_attr( $dp_options['service_post_sub_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['service_post_sub_color'] ); ?>">
    <h4 class="theme_option_headline2"><?php _e( 'Description', 'tcd-w' ); ?></h4>
    <p><?php _e( 'Font size', 'tcd-w' ); ?> <input type="number" min="1" step="1" name="dp_options[service_post_desc_font_size]" value="<?php echo esc_attr( $dp_options['service_post_desc_font_size'] ); ?>" class="tiny-text"> px</p>
    <p><?php _e( 'Font size (mobile)', 'tcd-w' ); ?> <input type="number" min="1" step="1" name="dp_options[service_post_desc_font_size_sp]" value="<?php echo esc_attr( $dp_options['service_post_desc_font_size_sp'] ); ?>" class="tiny-text"> px</p>
    <input type="text" class="c-color-picker" name="dp_options[service_post_desc_color]" value="<?php echo esc_attr( $dp_options['service_post_desc_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['service_post_desc_color'] ); ?>">
    <input type="submit" class="button-ml ajax_button" value="<?php echo _e( 'Save Changes', 'tcd-w' ); ?>">
	</div>

	<?php // Single page ?>
  <div class="theme_option_field cf">
  	<h3 class="theme_option_headline"><?php _e( 'Single Page Settings', 'tcd-w' ); ?></h3>
  	<h4 class="theme_option_headline2"><?php _e( 'Font size of post title', 'tcd-w' ); ?></h4>
    <p><?php _e( 'You can set the font size of the single page title.', 'tcd-w' ); ?></p>
  	<p><input class="hankaku tiny-text" type="number" min="1" step="1" name="dp_options[service_single_title_font_size]" value="<?php echo esc_attr( $dp_options['service_single_title_font_size'] ); ?>"> <span>px</span></p>
  	<h4 class="theme_option_headline2"><?php _e( 'Font size of post title (mobile)', 'tcd-w' ); ?></h4>
    <p><?php _e( 'You can set the font size of the single page title for mobile.', 'tcd-w' ); ?></p>
  	<p><input class="hankaku tiny-text" type="number" min="1" step="1" name="dp_options[service_single_title_font_size_sp]" value="<?php echo esc_attr( $dp_options['service_single_title_font_size_sp'] ); ?>"> <span>px</span></p>
  	<h4 class="theme_option_headline2"><?php _e( 'Font size of post contents', 'tcd-w' ); ?></h4>
    <p><?php _e( 'You can set the font size of the single page contents.', 'tcd-w' ); ?></p>
  	<p><input class="hankaku tiny-text" type="number" min="1" step="1" name="dp_options[service_content_font_size]" value="<?php echo esc_attr( $dp_options['service_content_font_size'] ); ?>"> <span>px</span></p>
  	<h4 class="theme_option_headline2"><?php _e( 'Font size of post contents (mobile)', 'tcd-w' ); ?></h4>
    <p><?php _e( 'You can set the font size of the single page contents for mobile.', 'tcd-w' ); ?></p>
  	<p><input class="hankaku tiny-text" type="number" min="1" step="1" name="dp_options[service_content_font_size_sp]" value="<?php echo esc_attr( $dp_options['service_content_font_size_sp'] ); ?>"> <span>px</span></p>
  	<input type="submit" class="button-ml ajax_button" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
	</div>

	<?php // Display ?>
  <div class="theme_option_field cf">
  	<h3 class="theme_option_headline"><?php _e( 'Display settings', 'tcd-w' ); ?></h3>
    <h4 class="theme_option_headline2"><?php _e( 'Settings for single page', 'tcd-w' ); ?></h4>
    <ul>
    	<li><label><input name="dp_options[service_show_thumbnail]" type="checkbox" value="1" <?php checked( '1', $dp_options['service_show_thumbnail'] ); ?>><?php _e( 'Display thumbnail', 'tcd-w' ); ?></label></li>
    </ul>
    <input type="submit" class="button-ml ajax_button" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
	</div>
</div><!-- END #tab-content4 -->
<?php
}

function add_service_theme_options_validate( $input ) {

  // Service page
 	$input['service_breadcrumb'] = sanitize_text_field( $input['service_breadcrumb'] );
 	$input['service_slug'] = sanitize_text_field( $input['service_slug'] );

  // Basic
  $input['service_key_color'] = sanitize_hex_color( $input['service_key_color'] );
  $input['service_title'] = sanitize_text_field( $input['service_title'] );
  $input['service_title_font_size'] = absint( $input['service_title_font_size'] );
  $input['service_title_font_size_sp'] = absint( $input['service_title_font_size_sp'] );
  $input['service_title_color'] = sanitize_hex_color( $input['service_title_color'] );
  $input['service_sub'] = sanitize_text_field( $input['service_sub'] );
  $input['service_sub_font_size'] = absint( $input['service_sub_font_size'] );
  $input['service_sub_font_size_sp'] = absint( $input['service_sub_font_size_sp'] );
  $input['service_sub_color'] = sanitize_hex_color( $input['service_sub_color'] );

  // Page header
 	$input['service_ph_title'] = sanitize_text_field( $input['service_ph_title'] );
 	$input['service_ph_title_font_size'] = absint( $input['service_ph_title_font_size'] );
 	$input['service_ph_title_font_size_sp'] = absint( $input['service_ph_title_font_size_sp'] );
 	$input['service_ph_title_color'] = sanitize_hex_color( $input['service_ph_title_color'] );
 	$input['service_ph_sub'] = sanitize_text_field( $input['service_ph_sub'] );
 	$input['service_ph_sub_color'] = sanitize_hex_color( $input['service_ph_sub_color'] );
 	$input['service_ph_img'] = absint( $input['service_ph_img'] );
 	$input['service_ph_overlay'] = sanitize_hex_color( $input['service_ph_overlay'] );
 	$input['service_ph_overlay_opacity'] = sanitize_text_field( $input['service_ph_overlay_opacity'] );

  // Archive page
 	$input['service_archive_catch'] = sanitize_textarea_field( $input['service_archive_catch'] );
 	$input['service_archive_catch_font_size'] = absint( $input['service_archive_catch_font_size'] );
 	$input['service_archive_catch_font_size_sp'] = absint( $input['service_archive_catch_font_size_sp'] );
 	$input['service_archive_catch_color'] = sanitize_hex_color( $input['service_archive_catch_color'] );
 	$input['service_archive_desc'] = sanitize_textarea_field( $input['service_archive_desc'] );
 	$input['service_archive_desc_font_size'] = absint( $input['service_archive_desc_font_size'] );
 	$input['service_archive_desc_font_size_sp'] = absint( $input['service_archive_desc_font_size_sp'] );
 	$input['service_archive_desc_color'] = sanitize_hex_color( $input['service_archive_desc_color'] );
  $input['service_post_num'] = absint( $input['service_post_num'] );

  // Posts list
 	$input['service_post_title_font_size'] = absint( $input['service_post_title_font_size'] );
 	$input['service_post_title_font_size_sp'] = absint( $input['service_post_title_font_size_sp'] );
 	$input['service_post_title_color'] = sanitize_hex_color( $input['service_post_title_color'] );
 	$input['service_post_sub_font_size'] = absint( $input['service_post_sub_font_size'] );
 	$input['service_post_sub_font_size_sp'] = absint( $input['service_post_sub_font_size_sp'] );
 	$input['service_post_sub_color'] = sanitize_hex_color( $input['service_post_sub_color'] );
 	$input['service_post_desc_font_size'] = absint( $input['service_post_desc_font_size'] );
 	$input['service_post_desc_font_size_sp'] = absint( $input['service_post_desc_font_size_sp'] );
 	$input['service_post_desc_color'] = sanitize_hex_color( $input['service_post_desc_color'] );

  // Single page
 	$input['service_single_title_font_size'] = absint( $input['service_single_title_font_size'] );
 	$input['service_single_title_font_size_sp'] = absint( $input['service_single_title_font_size_sp'] );
 	$input['service_content_font_size'] = absint( $input['service_content_font_size'] );
 	$input['service_content_font_size_sp'] = absint( $input['service_content_font_size_sp'] );

 	// Display
 	if ( ! isset( $input['service_show_thumbnail'] ) ) $input['service_show_thumbnail'] = null;
  $input['service_show_thumbnail'] = ( $input['service_show_thumbnail'] == 1 ? 1 : 0 );

	return $input;
}
