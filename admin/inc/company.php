<?php
/*
 * Manage company tab
 */

// Add default values
add_filter( 'before_getting_design_plus_option', 'add_company_dp_default_options' );

//  Add label of company tab
add_action( 'tcd_tab_labels', 'add_company_tab_label' );

// Add HTML of company tab
add_action( 'tcd_tab_panel', 'add_company_tab_panel' );

// Register sanitize function
add_filter( 'theme_options_validate', 'add_company_theme_options_validate' );

function add_company_dp_default_options( $dp_default_options ) {

  // Company page
  $dp_default_options['company_breadcrumb'] = __( 'Company', 'tcd-w' );
  $dp_default_options['company_slug'] = 'company';

  // Basic
	$dp_default_options['company_key_color'] = '#d80100';
	$dp_default_options['company_title'] = 'COMPANY';
	$dp_default_options['company_title_font_size'] = 32;
	$dp_default_options['company_title_font_size_sp'] = 22;
	$dp_default_options['company_title_color'] = '#ffffff';
	$dp_default_options['company_sub'] = __( 'Company', 'tcd-w' );
	$dp_default_options['company_sub_font_size'] = 16;
	$dp_default_options['company_sub_font_size_sp'] = 14;
	$dp_default_options['company_sub_color'] = '#ffffff';

  // Page header
  $dp_default_options['company_ph_title'] = 'COMPANY';
  $dp_default_options['company_ph_title_font_size'] = 46;
  $dp_default_options['company_ph_title_font_size_sp'] = 29;
  $dp_default_options['company_ph_title_color'] = '#ffffff';
  $dp_default_options['company_ph_sub'] = __( 'Company', 'tcd-w' );
  $dp_default_options['company_ph_sub_color'] = '#ffffff';
  $dp_default_options['company_ph_img'] = '';
  $dp_default_options['company_ph_overlay'] = '#000000';
  $dp_default_options['company_ph_overlay_opacity'] = 0;

  // Archive page
  $dp_default_options['company_archive_catch'] = __( 'Enter catchphrase here.', 'tcd-w' );
  $dp_default_options['company_archive_catch_font_size'] = 38;
  $dp_default_options['company_archive_catch_font_size_sp'] = 20;
  $dp_default_options['company_archive_catch_color'] = '#000000';
  $dp_default_options['company_archive_desc'] = __( "Enter description here. Enter description here. Enter description here.\nEnter description here. Enter description here. Enter description here. Enter description here. Enter description here.", 'tcd-w' );
  $dp_default_options['company_archive_desc_font_size'] = 16;
  $dp_default_options['company_archive_desc_font_size_sp'] = 14;
  $dp_default_options['company_archive_desc_color'] = '#000000';

  // Posts list
  $dp_default_options['company_post_title_font_size'] = 32;
  $dp_default_options['company_post_title_font_size_sp'] = 24;
  $dp_default_options['company_post_title_color'] = '#000000';
  $dp_default_options['company_post_sub_font_size'] = 16;
  $dp_default_options['company_post_sub_font_size_sp'] = 14;
  $dp_default_options['company_post_sub_color'] = '#000000';
  $dp_default_options['company_post_desc_font_size'] = 20;
  $dp_default_options['company_post_desc_font_size_sp'] = 16;
  $dp_default_options['company_post_desc_color'] = '#000000';

  // Single page
	$dp_default_options['company_content_font_size'] = 16;
	$dp_default_options['company_content_font_size_sp'] = 14;

	return $dp_default_options;
}

function add_company_tab_label( $tab_labels ) {
  $dp_options = get_design_plus_options();

  $tab_labels['company'] = $dp_options['company_breadcrumb'] ? $dp_options['company_breadcrumb'] : __( 'Company', 'tcd-w' );

	return $tab_labels;
}

function add_company_tab_panel( $dp_options ) {
  global $dp_default_options;
?>
<div id="tab-content-company">

	<?php // Company page ?>
	<div class="theme_option_field cf">
  	<h3 class="theme_option_headline"><?php _e( 'Company page settings', 'tcd-w' ); ?></h3>
		<h4 class="theme_option_headline2"><?php _e( 'Breadcrumb settings', 'tcd-w' ); ?></h4>
		<p><?php _e( 'It is used in the breadcrumb navigation. If it is not registerd, "Company" is displayed instead.', 'tcd-w' ); ?></p>
		<p><input type="text" name="dp_options[company_breadcrumb]" value="<?php echo esc_attr( $dp_options['company_breadcrumb'] ); ?>"></p>
    <h4 class="theme_option_headline2"><?php _e( 'Slug settings', 'tcd-w' ); ?></h4>
		<p><?php _e( 'It is used in URL. You can use only alphanumeric. If it is not registerd, "company" is used instead.', 'tcd-w' ); ?></p>
		<p><?php _e( 'Note: if you want to change the slug, change permalinks from "Plain".', 'tcd-w' ); ?></p>
		<p><?php _e( 'Note: after changing the slug, you need to go to "Permalink Settings" and click "Save Changes".', 'tcd-w' ); ?></p>
		<p><input type="text" name="dp_options[company_slug]" value="<?php echo esc_attr( $dp_options['company_slug'] ); ?>"></p>
    <input type="submit" class="button-ml ajax_button" value="<?php echo _e( 'Save Changes', 'tcd-w' ); ?>">
	</div>

  <?php // Basic ?>
  <div class="theme_option_field cf">
  	<h3 class="theme_option_headline"><?php _e( 'Basic settings', 'tcd-w' ); ?></h3>
    <p><?php _e( 'Set the key color and page title area to be displayed in the sidebar.', 'tcd-w' ); ?>
  	<h4 class="theme_option_headline2"><?php _e( 'Key color', 'tcd-w' ); ?></h4>
    <p><?php _e( 'This color is used for the background color of the page title in the sidebar, the color of the frame line when hovering in the category list, the color of the border line of the main content, and the link hover color.', 'tcd-w' ); ?></p>
    <input type="text" class="c-color-picker" name="dp_options[company_key_color]" value="<?php echo esc_attr( $dp_options['company_key_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['company_key_color'] ); ?>">
  	<h4 class="theme_option_headline2"><?php _e( 'Title', 'tcd-w' ); ?></h4>
    <p><?php _e( 'Please set the title displayed at the top of the sidebar.', 'tcd-w' ); ?></p>
    <input class="regular-text" type="text" name="dp_options[company_title]" value="<?php echo esc_attr( $dp_options['company_title'] ); ?>">
    <p><?php _e( 'Font size', 'tcd-w' ); ?> <input type="number" min="1" step="1" value="<?php echo esc_attr( $dp_options['company_title_font_size'] ); ?>" name="dp_options[company_title_font_size]" class="tiny-text"> px</p>
    <p><?php _e( 'Font size for mobile', 'tcd-w' ); ?> <input type="number" min="1" step="1" value="<?php echo esc_attr( $dp_options['company_title_font_size_sp'] ); ?>" class="tiny-text" name="dp_options[company_title_font_size_sp]"> px</p>
    <input type="text" class="c-color-picker" name="dp_options[company_title_color]" value="<?php echo esc_attr( $dp_options['company_title_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['company_title_color'] ); ?>">
  	<h4 class="theme_option_headline2"><?php _e( 'Sub title', 'tcd-w' ); ?></h4>
    <p><?php _e( 'Please set the sub title displayed at the top of the sidebar.', 'tcd-w' ); ?></p>
    <input class="regular-text" type="text" name="dp_options[company_sub]" value="<?php echo esc_attr( $dp_options['company_sub'] ); ?>">
    <p><?php _e( 'Font size', 'tcd-w' ); ?> <input type="number" min="1" step="1" value="<?php echo esc_attr( $dp_options['company_sub_font_size'] ); ?>" name="dp_options[company_sub_font_size]" class="tiny-text"> px</p>
    <p><?php _e( 'Font size for mobile', 'tcd-w' ); ?> <input type="number" min="1" step="1" value="<?php echo esc_attr( $dp_options['company_sub_font_size_sp'] ); ?>" class="tiny-text" name="dp_options[company_sub_font_size_sp]"> px</p>
    <input type="text" class="c-color-picker" name="dp_options[company_sub_color]" value="<?php echo esc_attr( $dp_options['company_sub_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['company_sub_color'] ); ?>">
    <input type="submit" class="button-ml ajax_button" value="<?php echo _e( 'Save Changes', 'tcd-w' ); ?>">
	</div>

	<?php // Page header ?>
	<div class="theme_option_field cf">
  	<h3 class="theme_option_headline"><?php _e( 'Page header settings', 'tcd-w' ); ?></h3>
    <p><?php _e( 'Set the page header to display at archive page.', 'tcd-w' ); ?></p>
    <h4 class="theme_option_headline2"><?php _e( 'Title', 'tcd-w' ); ?></h4>
    <p><?php _e( 'Set the title of page header.', 'tcd-w' ); ?></p>
    <p><input type="text" class="regular-text" name="dp_options[company_ph_title]" value="<?php echo esc_attr( $dp_options['company_ph_title'] ); ?>"></p>
    <p><?php _e( 'Font size', 'tcd-w' ); ?> <input type="number" min="1" step="1" name="dp_options[company_ph_title_font_size]" value="<?php echo esc_attr( $dp_options['company_ph_title_font_size'] ); ?>" class="tiny-text"> px</p>
    <p><?php _e( 'Font size (mobile)', 'tcd-w' ); ?> <input type="number" min="1" step="1" name="dp_options[company_ph_title_font_size_sp]" value="<?php echo esc_attr( $dp_options['company_ph_title_font_size_sp'] ); ?>" class="tiny-text"> px</p>
    <input type="text" class="c-color-picker" name="dp_options[company_ph_title_color]" value="<?php echo esc_attr( $dp_options['company_ph_title_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['company_ph_title_color'] ); ?>">
    <h4 class="theme_option_headline2"><?php _e( 'Sub title', 'tcd-w' ); ?></h4>
    <p><?php _e( 'Set the sub title of page header.', 'tcd-w' ); ?></p>
    <p><input type="text" class="regular-text" name="dp_options[company_ph_sub]" value="<?php echo esc_attr( $dp_options['company_ph_sub'] ); ?>"></p>
    <input type="text" class="c-color-picker" name="dp_options[company_ph_sub_color]" value="<?php echo esc_attr( $dp_options['company_ph_sub_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['company_ph_sub_color'] ); ?>">
    <h4 class="theme_option_headline2"><?php _e( 'Background image', 'tcd-w' ); ?></h4>
    <p><?php _e( 'Recommended image size. Width: 1450px, Height: 450px', 'tcd-w' ); ?></p>
  	<div class="image_box cf">
  		<div class="cf cf_media_field hide-if-no-js company_ph_img">
  			<input type="hidden" value="<?php echo esc_attr( $dp_options['company_ph_img'] ); ?>" id="company_ph_img" name="dp_options[company_ph_img]" class="cf_media_id">
  			<div class="preview_field"><?php if ( $dp_options['company_ph_img'] ) { echo wp_get_attachment_image( $dp_options['company_ph_img'], 'medium' ); } ?></div>
  			<div class="button_area">
  				<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
  				<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $dp_options['company_ph_img'] ) { echo 'hidden'; } ?>">
  			</div>
  		</div>
  	</div>
    <h4 class="theme_option_headline2"><?php _e( 'Color overlay on the background image', 'tcd-w' ); ?></h4>
    <p><?php _e( 'Use overlay, to make it easy to read the title. Please set color of overlay.', 'tcd-w' ); ?></p>
    <input class="c-color-picker" type="text" name="dp_options[company_ph_overlay]" data-default-color="<?php echo esc_attr( $dp_default_options['company_ph_overlay'] ); ?>" value="<?php echo esc_attr( $dp_options['company_ph_overlay'] ); ?>">
    <h4 class="theme_option_headline2"><?php _e( 'Opacity of the overlay on the background image', 'tcd-w' ); ?></h4>
    <p><?php _e( 'Please set opacity of overlay (e.g. 0.3). If you do not want to display the overlay, enter "0"', 'tcd-w' ); ?></p>
    <input type="number" min="0" max="1.0" step="0.1" name="dp_options[company_ph_overlay_opacity]" value="<?php echo esc_attr( $dp_options['company_ph_overlay_opacity'] ); ?>">
    <input type="submit" class="button-ml ajax_button" value="<?php echo _e( 'Save Changes', 'tcd-w' ); ?>">
	</div>

  <?php // Archive page ?>
  <div class="theme_option_field cf">
  	<h3 class="theme_option_headline"><?php _e( 'Archive Page Settings', 'tcd-w' ); ?></h3>
    <p><?php _e( 'Set a catch phrase and description of the archive page.', 'tcd-w' ); ?></p>
    <h4 class="theme_option_headline2"><?php _e( 'Catchphrase', 'tcd-w' ); ?></h4>
    <p><textarea class="regular-text" name="dp_options[company_archive_catch]"><?php echo esc_textarea( $dp_options['company_archive_catch'] ); ?></textarea></p>
    <p><?php _e( 'Font size', 'tcd-w' ); ?> <input type="number" min="1" step="1" name="dp_options[company_archive_catch_font_size]" value="<?php echo esc_attr( $dp_options['company_archive_catch_font_size'] ); ?>" class="tiny-text"> px</p>
    <p><?php _e( 'Font size (mobile)', 'tcd-w' ); ?> <input type="number" min="1" step="1" name="dp_options[company_archive_catch_font_size_sp]" value="<?php echo esc_attr( $dp_options['company_archive_catch_font_size_sp'] ); ?>" class="tiny-text"> px</p>
    <input type="text" class="c-color-picker" name="dp_options[company_archive_catch_color]" value="<?php echo esc_attr( $dp_options['company_archive_catch_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['company_archive_catch_color'] ); ?>">
    <h4 class="theme_option_headline2"><?php _e( 'Description', 'tcd-w' ); ?></h4>
    <p><textarea class="regular-text" name="dp_options[company_archive_desc]"><?php echo esc_textarea( $dp_options['company_archive_desc'] ); ?></textarea></p>
    <p><?php _e( 'Font size', 'tcd-w' ); ?> <input type="number" min="1" step="1" name="dp_options[company_archive_desc_font_size]" value="<?php echo esc_attr( $dp_options['company_archive_desc_font_size'] ); ?>" class="tiny-text"> px</p>
    <p><?php _e( 'Font size (mobile)', 'tcd-w' ); ?> <input type="number" min="1" step="1" name="dp_options[company_archive_desc_font_size_sp]" value="<?php echo esc_attr( $dp_options['company_archive_desc_font_size_sp'] ); ?>" class="tiny-text"> px</p>
    <input type="text" class="c-color-picker" name="dp_options[company_archive_desc_color]" value="<?php echo esc_attr( $dp_options['company_archive_desc_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['company_archive_desc_color'] ); ?>">
    <input type="submit" class="button-ml ajax_button" value="<?php echo _e( 'Save Changes', 'tcd-w' ); ?>">
	</div>

  <?php // Posts list ?>
  <div class="theme_option_field cf">
  	<h3 class="theme_option_headline"><?php _e( 'Posts list settings', 'tcd-w' ); ?></h3>
    <p><?php _e( 'Set the font size of post list of archive page.', 'tcd-w' ); ?></p>
    <h4 class="theme_option_headline2"><?php _e( 'Title', 'tcd-w' ); ?></h4>
    <p><?php _e( 'Font size', 'tcd-w' ); ?> <input type="number" min="1" step="1" name="dp_options[company_post_title_font_size]" value="<?php echo esc_attr( $dp_options['company_post_title_font_size'] ); ?>" class="tiny-text"> px</p>
    <p><?php _e( 'Font size (mobile)', 'tcd-w' ); ?> <input type="number" min="1" step="1" name="dp_options[company_post_title_font_size_sp]" value="<?php echo esc_attr( $dp_options['company_post_title_font_size_sp'] ); ?>" class="tiny-text"> px</p>
    <input type="text" class="c-color-picker" name="dp_options[company_post_title_color]" value="<?php echo esc_attr( $dp_options['company_post_title_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['company_post_title_color'] ); ?>">
    <h4 class="theme_option_headline2"><?php _e( 'Sub title', 'tcd-w' ); ?></h4>
    <p><?php _e( 'Font size', 'tcd-w' ); ?> <input type="number" min="1" step="1" name="dp_options[company_post_sub_font_size]" value="<?php echo esc_attr( $dp_options['company_post_sub_font_size'] ); ?>" class="tiny-text"> px</p>
    <p><?php _e( 'Font size (mobile)', 'tcd-w' ); ?> <input type="number" min="1" step="1" name="dp_options[company_post_sub_font_size_sp]" value="<?php echo esc_attr( $dp_options['company_post_sub_font_size_sp'] ); ?>" class="tiny-text"> px</p>
    <input type="text" class="c-color-picker" name="dp_options[company_post_sub_color]" value="<?php echo esc_attr( $dp_options['company_post_sub_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['company_post_sub_color'] ); ?>">
    <h4 class="theme_option_headline2"><?php _e( 'Description', 'tcd-w' ); ?></h4>
    <p><?php _e( 'Font size', 'tcd-w' ); ?> <input type="number" min="1" step="1" name="dp_options[company_post_desc_font_size]" value="<?php echo esc_attr( $dp_options['company_post_desc_font_size'] ); ?>" class="tiny-text"> px</p>
    <p><?php _e( 'Font size (mobile)', 'tcd-w' ); ?> <input type="number" min="1" step="1" name="dp_options[company_post_desc_font_size_sp]" value="<?php echo esc_attr( $dp_options['company_post_desc_font_size_sp'] ); ?>" class="tiny-text"> px</p>
    <input type="text" class="c-color-picker" name="dp_options[company_post_desc_color]" value="<?php echo esc_attr( $dp_options['company_post_desc_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['company_post_desc_color'] ); ?>">
    <input type="submit" class="button-ml ajax_button" value="<?php echo _e( 'Save Changes', 'tcd-w' ); ?>">
	</div>

	<?php // Single page ?>
  <div class="theme_option_field cf">
  	<h3 class="theme_option_headline"><?php _e( 'Single Page Settings', 'tcd-w' ); ?></h3>
  	<h4 class="theme_option_headline2"><?php _e( 'Font size settings', 'tcd-w' ); ?></h4>
  	<p><label><?php _e( 'Post contents', 'tcd-w' ); ?> <input class="hankaku tiny-text" type="number" min="1" step="1" name="dp_options[company_content_font_size]" value="<?php echo esc_attr( $dp_options['company_content_font_size'] ); ?>"> <span>px</span></label></p>
  	<p><label><?php _e( 'Post contents (mobile)', 'tcd-w' ); ?> <input class="hankaku tiny-text" type="number" min="1" step="1" name="dp_options[company_content_font_size_sp]" value="<?php echo esc_attr( $dp_options['company_content_font_size_sp'] ); ?>"> <span>px</span></label></p>
  	<input type="submit" class="button-ml ajax_button" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
	</div>
</div><!-- END #tab-content4 -->
<?php
}

function add_company_theme_options_validate( $input ) {

  // Company page
 	$input['company_breadcrumb'] = sanitize_text_field( $input['company_breadcrumb'] );
 	$input['company_slug'] = sanitize_text_field( $input['company_slug'] );

  // Basic
  $input['company_key_color'] = sanitize_hex_color( $input['company_key_color'] );
  $input['company_title'] = sanitize_text_field( $input['company_title'] );
  $input['company_title_font_size'] = absint( $input['company_title_font_size'] );
  $input['company_title_font_size_sp'] = absint( $input['company_title_font_size_sp'] );
  $input['company_title_color'] = sanitize_hex_color( $input['company_title_color'] );
  $input['company_sub'] = sanitize_text_field( $input['company_sub'] );
  $input['company_sub_font_size'] = absint( $input['company_sub_font_size'] );
  $input['company_sub_font_size_sp'] = absint( $input['company_sub_font_size_sp'] );
  $input['company_sub_color'] = sanitize_hex_color( $input['company_sub_color'] );

  // Page header
 	$input['company_ph_title'] = sanitize_text_field( $input['company_ph_title'] );
 	$input['company_ph_title_font_size'] = absint( $input['company_ph_title_font_size'] );
 	$input['company_ph_title_font_size_sp'] = absint( $input['company_ph_title_font_size_sp'] );
 	$input['company_ph_title_color'] = sanitize_hex_color( $input['company_ph_title_color'] );
 	$input['company_ph_sub'] = sanitize_text_field( $input['company_ph_sub'] );
 	$input['company_ph_sub_color'] = sanitize_hex_color( $input['company_ph_sub_color'] );
 	$input['company_ph_img'] = absint( $input['company_ph_img'] );
 	$input['company_ph_overlay'] = sanitize_hex_color( $input['company_ph_overlay'] );
 	$input['company_ph_overlay_opacity'] = sanitize_text_field( $input['company_ph_overlay_opacity'] );

  // Archive page
 	$input['company_archive_catch'] = sanitize_textarea_field( $input['company_archive_catch'] );
 	$input['company_archive_catch_font_size'] = absint( $input['company_archive_catch_font_size'] );
 	$input['company_archive_catch_font_size_sp'] = absint( $input['company_archive_catch_font_size_sp'] );
 	$input['company_archive_catch_color'] = sanitize_hex_color( $input['company_archive_catch_color'] );
 	$input['company_archive_desc'] = sanitize_textarea_field( $input['company_archive_desc'] );
 	$input['company_archive_desc_font_size'] = absint( $input['company_archive_desc_font_size'] );
 	$input['company_archive_desc_font_size_sp'] = absint( $input['company_archive_desc_font_size_sp'] );
 	$input['company_archive_desc_color'] = sanitize_hex_color( $input['company_archive_desc_color'] );

  // Posts list
 	$input['company_post_title_font_size'] = absint( $input['company_post_title_font_size'] );
 	$input['company_post_title_font_size_sp'] = absint( $input['company_post_title_font_size_sp'] );
 	$input['company_post_title_color'] = sanitize_hex_color( $input['company_post_title_color'] );
 	$input['company_post_sub_font_size'] = absint( $input['company_post_sub_font_size'] );
 	$input['company_post_sub_font_size_sp'] = absint( $input['company_post_sub_font_size_sp'] );
 	$input['company_post_sub_color'] = sanitize_hex_color( $input['company_post_sub_color'] );
 	$input['company_post_desc_font_size'] = absint( $input['company_post_desc_font_size'] );
 	$input['company_post_desc_font_size_sp'] = absint( $input['company_post_desc_font_size_sp'] );
 	$input['company_post_desc_color'] = sanitize_hex_color( $input['company_post_desc_color'] );

  // Single page
 	$input['company_content_font_size'] = absint( $input['company_content_font_size'] );
 	$input['company_content_font_size_sp'] = absint( $input['company_content_font_size_sp'] );

	return $input;
}
