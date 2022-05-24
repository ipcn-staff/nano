<?php
/**
 * Manage footer tab
 */

// Add default values
add_filter( 'before_getting_design_plus_option', 'add_footer_dp_default_options' );

// Add label of footer tab
add_action( 'tcd_tab_labels', 'add_footer_tab_label' );

// Add HTML of footer tab
add_action( 'tcd_tab_panel', 'add_footer_tab_panel' );

// Register sanitize function
add_filter( 'theme_options_validate', 'add_footer_theme_options_validate' );

// Logo type
global $footer_logo_type_options;
$footer_logo_type_options = array(
	'type1' => array( 'value' => 'type1', 'label' => __( 'Use text for logo', 'tcd-w' ) ),
	'type2' => array( 'value' => 'type2', 'label' => __( 'Use image for logo', 'tcd-w' ) )
);

// Footer bar display type
global $footer_bar_display_options;
$footer_bar_display_options = array(
	'type1' => array( 'value' => 'type1', 'label' => __( 'Fade In', 'tcd-w' ) ),
	'type2' => array( 'value' => 'type2', 'label' => __( 'Slide In', 'tcd-w' ) ),
	'type3' => array( 'value' => 'type3', 'label' => __( 'Hide', 'tcd-w' ) )
);

// Footer bar button type
global $footer_bar_button_options;
$footer_bar_button_options = array(
	'type1' => array( 'value' => 'type1', 'label' => __( 'Default', 'tcd-w' ) ),
 	'type2' => array( 'value' => 'type2', 'label' => __( 'Share', 'tcd-w' ) ),
 	'type3' => array( 'value' => 'type3', 'label' => __( 'Telephone', 'tcd-w' ) )
);

// Footer bar button icon
global $footer_bar_icon_options;
$footer_bar_icon_options = array(
	'file-text' => array( 'value' => 'file-text', 'label' => __( 'Document', 'tcd-w' ) ),
	'share-alt' => array( 'value' => 'share-alt', 'label' => __( 'Share', 'tcd-w' ) ),
	'phone' => array( 'value' => 'phone', 'label' => __( 'Telephone', 'tcd-w' ) ),
	'envelope' => array( 'value' => 'envelope', 'label' => __( 'Envelope', 'tcd-w' ) ),
	'tag' => array( 'value' => 'tag', 'label' => __( 'Tag', 'tcd-w' ) ),
	'pencil' => array( 'value' => 'pencil', 'label' => __( 'Pencil', 'tcd-w' ) )
);

function add_footer_dp_default_options( $dp_default_options ) {

  // Footer banners
  $dp_default_options['display_footer_banners'] = 1;
  $dp_default_options['footer_banners_bg'] = '#f4f4f4';
  for ( $i = 1; $i <= 3; $i++ ) {
    $dp_default_options['footer_banners_banner_title' . $i] = sprintf( __( 'Banner%d title', 'tcd-w' ), $i );
    $dp_default_options['footer_banners_banner_img' . $i] = '';
    $dp_default_options['footer_banners_banner_url' . $i] = '#';
    $dp_default_options['footer_banners_banner_target' . $i] = '';
    $dp_default_options['footer_banners_banner_display_gradation_overlay' . $i] = 1;
    $dp_default_options['footer_banners_banner_gradation_overlay' . $i] = '#000000';
  }

  // Company information
  $dp_default_options['company_info_color'] = '#000000';
  $dp_default_options['company_info_bg'] = '#ffffff';
  $dp_default_options['footer_use_logo_image'] = 'type1';
	$dp_default_options['footer_logo_font_size'] = 40;
	$dp_default_options['footer_logo_image'] = '';
	$dp_default_options['footer_logo_image_retina'] = '';
  $dp_default_options['sp_footer_use_logo_image'] = 'type1';
	$dp_default_options['sp_footer_logo_font_size'] = 25;
	$dp_default_options['sp_footer_logo_image'] = '';
	$dp_default_options['sp_footer_logo_image_retina'] = '';
  $dp_default_options['footer_catch'] = __( 'Enter catchphrase here.', 'tcd-w' );
  $dp_default_options['footer_catch_font_size'] = 14;
  $dp_default_options['footer_catch_color'] = '#000000';
	$dp_default_options['facebook_url'] = '';
	$dp_default_options['twitter_url'] = '';
	$dp_default_options['insta_url'] = '';
	$dp_default_options['pinterest_url'] = '';
	$dp_default_options['mail_url'] = '';
	$dp_default_options['show_rss'] = 1;

  // Footer widgets
	$dp_default_options['footer_widgets_bg'] = '#ffffff';
	$dp_default_options['footer_widgets_headline_color'] = '#d90000';
	$dp_default_options['footer_widgets_color'] = '#000000';

  // Footer menu
	$dp_default_options['footer_menu_color'] = '#000000';
	$dp_default_options['footer_menu_color_hover'] = '#000000';
	$dp_default_options['footer_menu_bg'] = '#ffffff';

  // Copyright
	$dp_default_options['copyright_bg'] = '#d90000';

  // Footer bar
	$dp_default_options['footer_bar_display'] = 'type3';
	$dp_default_options['footer_bar_tp'] = 0.8;
	$dp_default_options['footer_bar_bg'] = '#ffffff';
	$dp_default_options['footer_bar_border'] = '#dddddd';
	$dp_default_options['footer_bar_color'] = '#000000';
	$dp_default_options['footer_bar_btns'] = array();

	return $dp_default_options;
}

function add_footer_tab_label( $tab_labels ) {
	$tab_labels['footer'] = __( 'Footer', 'tcd-w' );
	return $tab_labels;
}

function add_footer_tab_panel( $dp_options ) {
	global $footer_logo_type_options, $dp_default_options, $footer_bar_display_options, $footer_bar_button_options, $footer_bar_icon_options;
?>
<div id="tab-content-footer">

  <?php // Footer banners ?>
	<div class="theme_option_field cf">
  	<h3 class="theme_option_headline"><?php _e( 'Footer banners settings', 'tcd-w' ); ?></h3>
    <p><?php _e( 'Display three banners horizontally. You can display only one.', 'tcd-w' ); ?></p>
    <p><label><input type="checkbox" name="dp_options[display_footer_banners]" value="1" <?php checked( 1, $dp_options['display_footer_banners'] ); ?>> <?php _e( 'Display footer banners', 'tcd-w' ); ?></label></p>
    <h4 class="theme_option_headline2"><?php _e( 'Background color', 'tcd-w' ); ?></h4>
    <p><?php _e( 'Set the background color of contents.', 'tcd-w' ); ?></p>
    <input type="text" class="c-color-picker" name="dp_options[footer_banners_bg]" value="<?php echo esc_attr( $dp_options['footer_banners_bg'] ); ?>" data-default-color="<?php echo esc_attr( $dp_options['footer_banners_bg'] ); ?>">
    <h4 class="theme_option_headline2"><?php _e( 'Banners settings', 'tcd-w' ); ?></h4>
    <?php for ( $i = 1; $i <= 3; $i++ ) : ?>
		<div class="sub_box">
      <h5 class="theme_option_subbox_headline"><?php printf( __( 'Banner%d settings', 'tcd-w' ), $i ); ?></h5>
			<div class="sub_box_content">
        <h6 class="theme_option_headline2"><?php _e( 'Title', 'tcd-w' ); ?></h6>
        <p><?php _e( 'Please set the title displayed on the banner.', 'tcd-w' ); ?></p>
        <textarea name="dp_options[footer_banners_banner_title<?php echo $i; ?>]" class="regular-text"><?php echo esc_textarea( $dp_options['footer_banners_banner_title' . $i] ); ?></textarea>
        <h6 class="theme_option_headline2"><?php _e( 'Image', 'tcd-w' ); ?></h6>
        <p><?php _e( 'Recommend size. Width:740px Height:280px', 'tcd-w' ); ?></p>
    	  <div class="image_box cf">
          <div class="cf cf_media_field hide-if-no-js footer_banners_banner_img<?php echo $i; ?>">
            <input type="hidden" value="<?php echo esc_attr( $dp_options['footer_banners_banner_img' . $i] ); ?>" id="footer_banners_banner_img<?php echo $i; ?>" name="dp_options[footer_banners_banner_img<?php echo $i; ?>]" class="cf_media_id">
        		<div class="preview_field"><?php if ( $dp_options['footer_banners_banner_img' . $i] ) { echo wp_get_attachment_image( $dp_options['footer_banners_banner_img' . $i], 'full' ); } ?></div>
        		<div class="button_area">
        	 		<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
        	 		<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $dp_options['footer_banners_banner_img' . $i] ) { echo 'hidden'; } ?>">
        		</div>
			  	</div>
    	  </div>
        <h6 class="theme_option_headline2"><?php _e( 'Link URL', 'tcd-w' ); ?></h6>
        <input type="text" name="dp_options[footer_banners_banner_url<?php echo $i; ?>]" value="<?php echo esc_attr( $dp_options['footer_banners_banner_url' . $i] ); ?>" class="regular-text">
        <p><label><input type="checkbox" name="dp_options[footer_banners_banner_target<?php echo $i; ?>]" value="1" <?php checked( 1, $dp_options['footer_banners_banner_target' . $i] ); ?>> <?php _e( 'Open with new window', 'tcd-w' ); ?></label></p>
        <h6 class="theme_option_headline2"><?php _e( 'Gradation overlay', 'tcd-w' ); ?></h6>
        <p><?php _e( 'Use gradation overlay, to make it easy to read the title.', 'tcd-w' ); ?></p>
        <p><label><input type="checkbox" name="dp_options[footer_banners_banner_display_gradation_overlay<?php echo $i; ?>]" value="1" <?php checked( 1, $dp_options['footer_banners_banner_display_gradation_overlay' . $i] ); ?>> <?php _e( 'Display gradation overlay', 'tcd-w' ); ?></label></p>
        <input type="text" name="dp_options[footer_banners_banner_gradation_overlay<?php echo $i; ?>]" value="<?php echo esc_attr( $dp_options['footer_banners_banner_gradation_overlay' . $i] ); ?>" class="c-color-picker">
      </div>
    </div>
    <?php endfor; ?>
    <input type="submit" class="button-ml ajax_button" value="<?php echo _e( 'Save Changes', 'tcd-w' ); ?>">
  </div>

  <?php // Company information ?>
	<div class="theme_option_field cf">
  	<h3 class="theme_option_headline"><?php _e( 'Company information settings', 'tcd-w' ); ?></h3>
    <p><?php _e( 'Set company information to be displayed in the footer area. You can display logos, addresses, phone numbers, etc.', 'tcd-w' ); ?></p>
    <h4 class="theme_option_headline2"><?php _e( 'Color settings', 'tcd-w' ); ?></h4>
    <p><?php _e( 'Sets the font color and background color of the company information.', 'tcd-w' ); ?></p>
    <ul>
      <li>
        <label for="company_info_color"><?php _e( 'Font color', 'tcd-w' ); ?></label> <input id="company_info_color" type="text" class="c-color-picker" name="dp_options[company_info_color]" value="<?php echo esc_attr( $dp_options['company_info_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_options['company_info_color'] ); ?>">
      </li>
      <li>
        <label for="company_info_bg"><?php _e( 'Background color', 'tcd-w' ); ?></label> <input id="company_info_bg" type="text" class="c-color-picker" name="dp_options[company_info_bg]" value="<?php echo esc_attr( $dp_options['company_info_bg'] ); ?>" data-default-color="<?php echo esc_attr( $dp_options['company_info_bg'] ); ?>">
      </li>
    </ul>
    <h4 class="theme_option_headline2"><?php _e( 'Logo type', 'tcd-w' ); ?></h4>
      <p><?php _e( 'Please set the logo display type.', 'tcd-w' ); ?></p>
      <div class="theme_option_message">
        <?php echo __( '<p>text - Display the site title as text.</p><p>image - Display Uploaded logo image.</p>', 'tcd-w' ); ?>
      </div>
		<ul>
			<?php foreach ( $footer_logo_type_options as $option ) : ?>
			<li><label><input type="radio" value="<?php echo esc_attr( $option['value'] ); ?>" <?php checked( $dp_options['footer_use_logo_image'], $option['value'] ); ?> name="dp_options[footer_use_logo_image]"> <?php echo esc_html_e( $option['label'], 'tcd-w' ); ?></label></li>
			<?php endforeach; ?>
		</ul>
		<div id="footer_use_logo_image_type1"<?php if ( 'type2' === $dp_options['footer_use_logo_image'] ) { echo ' style="display: none;"'; } ?>>
    	<h4 class="theme_option_headline2"><?php _e( 'Font size for text logo', 'tcd-w' ); ?></h4>
    	<input class="tiny-text hankaku" type="number" min="1" name="dp_options[footer_logo_font_size]" value="<?php esc_attr_e( $dp_options['footer_logo_font_size'] ); ?>"> <span>px</span>
    </div>
		<div id="footer_use_logo_image_type2"<?php if ( 'type1' === $dp_options['footer_use_logo_image'] ) { echo ' style="display: none;"'; } ?>>
   		<h4 class="theme_option_headline2"><?php _e( 'Image for logo', 'tcd-w' ); ?></h4>
    	<div class="image_box cf">
    		<div class="cf cf_media_field hide-if-no-js footer_logo_image">
    			<input type="hidden" value="<?php echo esc_attr( $dp_options['footer_logo_image'] ); ?>" id="footer_logo_image" name="dp_options[footer_logo_image]" class="cf_media_id">
      		<div class="preview_field"><?php if ( $dp_options['footer_logo_image'] ) { echo wp_get_attachment_image( $dp_options['footer_logo_image'], 'full' ); } ?></div>
      		<div class="button_area">
      	 		<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
      	 		<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $dp_options['footer_logo_image'] ) { echo 'hidden'; } ?>">
      		</div>
				</div>
    	</div>
    	<p><label><input name="dp_options[footer_logo_image_retina]" type="checkbox" value="1" <?php checked( 1, $dp_options['footer_logo_image_retina'] ); ?>><?php _e( 'Use retina display logo image', 'tcd-w' ); ?></label></p>
    </div>
    <h4 class="theme_option_headline2"><?php _e( 'Logo type (mobile)', 'tcd-w' ); ?></h4>
		<ul>
			<?php foreach ( $footer_logo_type_options as $option ) : ?>
			<li><label><input type="radio" value="<?php echo esc_attr( $option['value'] ); ?>" <?php checked( $dp_options['sp_footer_use_logo_image'], $option['value'] ); ?> name="dp_options[sp_footer_use_logo_image]"> <?php echo esc_html_e( $option['label'], 'tcd-w' ); ?></label></li>
			<?php endforeach; ?>
		</ul>
		<div id="sp_footer_use_logo_image_type1"<?php if ( 'type2' === $dp_options['sp_footer_use_logo_image'] ) { echo ' style="display: none;"'; } ?>>
    	<h4 class="theme_option_headline2"><?php _e( 'Font size for text logo (mobile)', 'tcd-w' ); ?></h4>
    	<input class="tiny-text hankaku" type="number" min="1" name="dp_options[sp_footer_logo_font_size]" value="<?php esc_attr_e( $dp_options['sp_footer_logo_font_size'] ); ?>"> <span>px</span>
    </div>
		<div id="sp_footer_use_logo_image_type2"<?php if ( 'type1' === $dp_options['sp_footer_use_logo_image'] ) { echo ' style="display: none;"'; } ?>>
   		<h4 class="theme_option_headline2"><?php _e( 'Image for logo (mobile)', 'tcd-w' ); ?></h4>
    	<div class="image_box cf">
    		<div class="cf cf_media_field hide-if-no-js sp_footer_logo_image">
    			<input type="hidden" value="<?php echo esc_attr( $dp_options['sp_footer_logo_image'] ); ?>" id="sp_footer_logo_image" name="dp_options[sp_footer_logo_image]" class="cf_media_id">
      		<div class="preview_field"><?php if ( $dp_options['sp_footer_logo_image'] ) { echo wp_get_attachment_image( $dp_options['sp_footer_logo_image'], 'full' ); } ?></div>
      		<div class="button_area">
      	 		<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
      	 		<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $dp_options['sp_footer_logo_image'] ) { echo 'hidden'; } ?>">
      		</div>
				</div>
    	</div>
    	<p><label><input name="dp_options[sp_footer_logo_image_retina]" type="checkbox" value="1" <?php checked( 1, $dp_options['sp_footer_logo_image_retina'] ); ?>><?php _e( 'Use retina display logo image', 'tcd-w' ); ?></label></p>
    </div>
  	<h4 class="theme_option_headline2"><?php _e( 'Catchphrase', 'tcd-w' ); ?></h4>
    <p><input type="text" class="regular-text" name="dp_options[footer_catch]" value="<?php echo esc_attr( $dp_options['footer_catch'] ); ?>"></p>
    <p><?php _e( 'Font size', 'tcd-w' ); ?> <input type="number" class="tiny-text" name="dp_options[footer_catch_font_size]" value="<?php echo esc_attr( $dp_options['footer_catch_font_size'] ); ?>" min="1" step="1"> px</p>
    <input type="text" class="c-color-picker" name="dp_options[footer_catch_color]" value="<?php echo esc_attr( $dp_options['footer_catch_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['footer_catch_color'] ); ?>">
  	<h4 class="theme_option_headline2"><?php _e( 'Social settings', 'tcd-w' ); ?></h4>
    <p><?php _e( 'Please input URL to display the SNS icon and check for RSS button.', 'tcd-w' ); ?></p>
      <ul>
  	  	<li><label><?php _e( 'your Facebook URL', 'tcd-w' ); ?> <input class="regular-text" type="text" name="dp_options[facebook_url]" value="<?php esc_attr_e( $dp_options['facebook_url'] ); ?>"></label></li>
  	  	<li><label><?php _e( 'your Twitter URL', 'tcd-w' ); ?> <input class="regular-text" type="text" name="dp_options[twitter_url]" value="<?php esc_attr_e( $dp_options['twitter_url'] ); ?>"></label></li>
  	  	<li><label><?php _e( 'your instagram URL', 'tcd-w' ); ?> <input class="regular-text" type="text" name="dp_options[insta_url]" value="<?php esc_attr_e( $dp_options['insta_url'] ); ?>"></label></li>
  	  	<li><label><?php _e( 'your pinterest URL', 'tcd-w' ); ?> <input class="regular-text" type="text" name="dp_options[pinterest_url]" value="<?php esc_attr_e( $dp_options['pinterest_url'] ); ?>"></label></li>
  	  	<li><label><?php _e( 'your email address', 'tcd-w' ); ?> <input class="regular-text" type="text" name="dp_options[mail_url]" value="<?php esc_attr_e( $dp_options['mail_url'] ); ?>"></label></li>
		  </ul>
 		  <hr>
  	  <p><label><input name="dp_options[show_rss]" type="checkbox" value="1" <?php checked( '1', $dp_options['show_rss'] ); ?>><?php _e( 'Display RSS button', 'tcd-w' ); ?></label></p>
    <input type="submit" class="button-ml ajax_button" value="<?php echo _e( 'Save Changes', 'tcd-w' ); ?>">
  </div><!-- END .theme_option_field -->

  <?php // Footer widgets ?>
	<div class="theme_option_field cf">
  	<h3 class="theme_option_headline"><?php _e( 'Footer widgets settings', 'tcd-w' ); ?></h3>
    <p><?php _e( 'Sets the color scheme of the footer widget.', 'tcd-w' ); ?></p>
    <h4 class="theme_option_headline2"><?php _e( 'Background color', 'tcd-w' ); ?></h4>
    <input type="text" class="c-color-picker" name="dp_options[footer_widgets_bg]" value="<?php echo esc_attr( $dp_options['footer_widgets_bg'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['footer_widgets_bg'] ); ?>">
    <h4 class="theme_option_headline2"><?php _e( 'Font color of headlines', 'tcd-w' ); ?></h4>
    <input type="text" class="c-color-picker" name="dp_options[footer_widgets_headline_color]" value="<?php echo esc_attr( $dp_options['footer_widgets_headline_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['footer_widgets_headline_color'] ); ?>">
    <h4 class="theme_option_headline2"><?php _e( 'Font color', 'tcd-w' ); ?></h4>
    <input type="text" class="c-color-picker" name="dp_options[footer_widgets_color]" value="<?php echo esc_attr( $dp_options['footer_widgets_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['footer_widgets_color'] ); ?>">
    <input type="submit" class="button-ml ajax_button" value="<?php echo _e( 'Save Changes', 'tcd-w' ); ?>">
  </div>

  <?php // Footer menu ?>
	<div class="theme_option_field cf">
  	<h3 class="theme_option_headline"><?php _e( 'Footer menu settings', 'tcd-w' ); ?></h3>
    <p><?php _e( 'Sets the color scheme of the footer menu.', 'tcd-w' ); ?></p>
    <h4 class="theme_option_headline2"><?php _e( 'Font color', 'tcd-w' ); ?></h4>
    <input type="text" class="c-color-picker" name="dp_options[footer_menu_color]" value="<?php echo esc_attr( $dp_options['footer_menu_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['footer_menu_color'] ); ?>">
    <h4 class="theme_option_headline2"><?php _e( 'Font color on hover', 'tcd-w' ); ?></h4>
    <input type="text" class="c-color-picker" name="dp_options[footer_menu_color_hover]" value="<?php echo esc_attr( $dp_options['footer_menu_color_hover'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['footer_menu_color_hover'] ); ?>">
    <h4 class="theme_option_headline2"><?php _e( 'Background color', 'tcd-w' ); ?></h4>
    <input type="text" class="c-color-picker" name="dp_options[footer_menu_bg]" value="<?php echo esc_attr( $dp_options['footer_menu_bg'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['footer_menu_bg'] ); ?>">
    <input type="submit" class="button-ml ajax_button" value="<?php echo _e( 'Save Changes', 'tcd-w' ); ?>">
  </div><!-- END .theme_option_field -->

  <?php // Copyright ?>
	<div class="theme_option_field cf">
  	<h3 class="theme_option_headline"><?php _e( 'Copyright settings', 'tcd-w' ); ?></h3>
    <p><?php _e( 'Sets the background color of the copyright display area.', 'tcd-w' ); ?></p>
    <h4 class="theme_option_headline2"><?php _e( 'Background color', 'tcd-w' ); ?></h4>
    <input type="text" class="c-color-picker" name="dp_options[copyright_bg]" value="<?php echo esc_attr( $dp_options['copyright_bg'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['copyright_bg'] ); ?>">
    <input type="submit" class="button-ml ajax_button" value="<?php echo _e( 'Save Changes', 'tcd-w' ); ?>">
  </div><!-- END .theme_option_field -->
	<?php // Footer bar ?>
	<div class="theme_option_field cf">
  	<h3 class="theme_option_headline"><?php _e( 'Footer bar settings', 'tcd-w' ); ?></h3>
		<p><?php _e( 'Please set the footer bar which is displayed with smart phone.', 'tcd-w' ); ?>
    <h4 class="theme_option_headline2"><?php _e( 'Display type', 'tcd-w' ); ?></h4>
    <p><?php _e( 'Please select how to display the footer bar. When you scroll a page by a certain amount, the footer bar is displayed with the selected animation. If you do not use the footer bar, please check \"Hide\".', 'tcd-w' ); ?></p>
    <fieldset class="cf select_type2">
     <?php foreach ( $footer_bar_display_options as $option ) : ?>
     <label class="description"><input type="radio" name="dp_options[footer_bar_display]" value="<?php echo esc_attr( $option['value'] ); ?>" <?php checked( $dp_options['footer_bar_display'], $option['value'] ); ?>><?php echo esc_html_e( $option['label'], 'tcd-w' ); ?></label>
     <?php endforeach; ?>
    </fieldset>
    <h4 class="theme_option_headline2"><?php _e( 'Appearance settings', 'tcd-w' ); ?></h4>
    <p><?php _e( 'Please set the color and transparency of the footer bar.', 'tcd-w' ); ?></p>
    <p>
     	<?php _e( 'Background color', 'tcd-w' ); ?>
			<input type="text" name="dp_options[footer_bar_bg]" value="<?php echo esc_attr( $dp_options['footer_bar_bg'] ); ?>" data-default-color="#ffffff" class="c-color-picker">
		</p>
    <p>
    	<?php _e( 'Border color', 'tcd-w' ); ?>
			<input type="text" name="dp_options[footer_bar_border]" value="<?php echo esc_attr( $dp_options['footer_bar_border'] ); ?>" data-default-color="#dddddd" class="c-color-picker">
		</p>
    <p>
     	<?php _e( 'Font color', 'tcd-w' ); ?>
			<input type="text" name="dp_options[footer_bar_color]" value="<?php echo esc_attr( $dp_options['footer_bar_color'] ); ?>" data-default-color="#000000" class="c-color-picker">
		</p>
		<p>
     	<?php _e( 'Opacity of background', 'tcd-w' ); ?>
     	<input class="tiny-text hankaku" type="number" min="0" max="1" step="0.1" name="dp_options[footer_bar_tp]" value="<?php echo esc_attr( $dp_options['footer_bar_tp'] ); ?>">
      <p><?php _e( 'Please enter the number 0 - 1.0. (e.g. 0.8)', 'tcd-w' ); ?></p>
		</p>
    <h4 class="theme_option_headline2"><?php _e( 'Contents settings', 'tcd-w'); ?></h4>
   	<p><?php _e( 'You can display buttons with icon in the footer bar. (We recommend you to set max 4 buttons.)', 'tcd-w' ); ?><br><?php _e( 'You can select button types below.', 'tcd-w' ); ?></p>
		<table class="table-border">
			<tr>
				<th><?php _e( 'Default', 'tcd-w' ); ?></th>
				<td><?php _e( 'You can set link URL.', 'tcd-w' ); ?></td>
			</tr>
			<tr>
				<th><?php _e( 'Share', 'tcd-w' ); ?></th>
				<td><?php _e( 'Share buttons are displayed if you tap this button.', 'tcd-w' ); ?></td>
			</tr>
			<tr>
				<th><?php _e( 'Telephone', 'tcd-w' ); ?></th>
				<td><?php _e( 'You can call this number.', 'tcd-w' ); ?></td>
			</tr>
		</table>
        <p><?php _e( 'Click \"Add item\", and set the button for footer bar. You can drag the item to change their order.', 'tcd-w' ); ?></p>
		<div class="repeater-wrapper" data-delete-confirm="<?php _e( 'Delete?', 'tcd-w' ); ?>">
			<div class="repeater sortable">
				<?php
				if ( $dp_options['footer_bar_btns'] ) :
					foreach ( $dp_options['footer_bar_btns'] as $key => $value ) :
				?>
				<div class="sub_box repeater-item repeater-item-<?php echo esc_attr( $key ); ?>">
     			<h4 class="theme_option_subbox_headline"><?php echo esc_attr( $value['label'] ); ?></h4>
					<div class="sub_box_content">
            <p class="footer-bar-target" style="<?php if ( $value['type'] !== 'type1' ) { echo 'display: none;'; } ?>"><label><input name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][target]" type="checkbox" value="1" <?php checked( $value['target'], 1 ); ?>><?php _e( 'Open with new window', 'tcd-w' ); ?></label></p>
    				<table class="table-repeater">
     					<tr class="footer-bar-type">
								<th><label><?php _e( 'Button type', 'tcd-w' ); ?></label></th>
								<td>
									<select name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][type]">
										<?php foreach( $footer_bar_button_options as $option ) : ?>
										<option value="<?php echo esc_attr( $option['value'] ); ?>" <?php selected( $value['type'], $option['value'] ); ?>><?php esc_html_e( $option['label'], 'tcd-w' ); ?></option>
										<?php endforeach; ?>
									</select>
								</td>
							</tr>
     					<tr>
								<th><label for="dp_options[repeater_footer_bar_btn<?php echo esc_attr( $key ); ?>_label]"><?php _e( 'Button label', 'tcd-w' ); ?></label></th>
								<td><input id="dp_options[footer_bar_btn<?php echo esc_attr( $key ); ?>_label]" class="regular-text change_subbox_headline repeater-label" type="text" name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][label]" value="<?php echo esc_attr( $value['label'] ); ?>"></td>
							</tr>
							<tr class="footer-bar-url" style="<?php if ( $value['type'] !== 'type1' ) { echo 'display: none;'; } ?>">
								<th><label for="dp_options[footer_bar_btn<?php echo esc_attr( $key ); ?>_url]"><?php _e( 'Link URL', 'tcd-w' ); ?></label></th>
								<td><input id="dp_options[footer_bar_btn<?php echo esc_attr( $key ); ?>_url]" class="regular-text" type="text" name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][url]" value="<?php echo esc_attr( $value['url'] ); ?>"></td>
							</tr>
     					<tr class="footer-bar-number" style="<?php if ( $value['type'] !== 'type3' ) { echo 'display: none;'; } ?>">
								<th><label for="dp_options[footer_bar_btn<?php echo esc_attr( $key ); ?>_number]"><?php _e( 'Phone number', 'tcd-w' ); ?></label></th>
								<td><input id="dp_options[footer_bar_btn<?php echo esc_attr( $key ); ?>_number]" class="regular-text" type="text" name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][number]" value="<?php echo esc_attr( $value['number'] ); ?>"></td>
							</tr>
     					<tr>
								<th><?php _e( 'Button icon', 'tcd-w' ); ?></th>
								<td>
									<?php foreach( $footer_bar_icon_options as $option ) : ?>
									<p><label><input type="radio" name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][icon]" value="<?php echo esc_attr( $option['value'] ); ?>" <?php checked( $option['value'], $value['icon'] ); ?>><span class="icon icon-<?php echo esc_attr( $option['value'] ); ?>"></span><?php esc_html_e( $option['label'], 'tcd-w' ); ?></label></p>
									<?php endforeach; ?>
								</td>
							</tr>
						</table>
       			<p class="delete-row right-align"><a href="#" class="button button-secondary button-delete-row"><?php _e( 'Delete item', 'tcd-w' ); ?></a></p>
					</div>
				</div>
				<?php
					endforeach;
				endif;
				?>
				<?php
    		$key = 'addindex';
    		ob_start();
				?>
				<div class="sub_box repeater-item repeater-item-<?php echo $key; ?>">
     			<h4 class="theme_option_subbox_headline"><?php _e( 'New item', 'tcd-w' ); ?></h4>
					<div class="sub_box_content">
            <p class="footer-bar-target"><label><input name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][target]" type="checkbox" value="1"><?php _e( 'Open with new window', 'tcd-w' ); ?></label></p>
    				<table class="table-repeater">
     					<tr class="footer-bar-type">
								<th><label><?php _e( 'Button type', 'tcd-w' ); ?></label></th>
								<td>
									<select name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][type]">
										<?php foreach( $footer_bar_button_options as $option ) : ?>
										<option value="<?php echo esc_attr( $option['value'] ); ?>"><?php esc_html_e( $option['label'], 'tcd-w' ); ?></option>
										<?php endforeach; ?>
									</select>
								</td>
							</tr>
     					<tr>
								<th><label for="dp_options[repeater_footer_bar_btn<?php echo esc_attr( $key ); ?>_label]"><?php _e( 'Button label', 'tcd-w' ); ?></label></th>
								<td><input id="dp_options[footer_bar_btn<?php echo esc_attr( $key ); ?>_label]" class="regular-text change_subbox_headline repeater-label" type="text" name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][label]" value=""></td>
							</tr>
							<tr class="footer-bar-url">
								<th><label for="dp_options[footer_bar_btn<?php echo esc_attr( $key ); ?>_url]"><?php _e( 'Link URL', 'tcd-w' ); ?></label></th>
								<td><input id="dp_options[footer_bar_btn<?php echo esc_attr( $key ); ?>_url]" class="regular-text" type="text" name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][url]" value=""></td>
							</tr>
     					<tr class="footer-bar-number" style="display: none;">
								<th><label for="dp_options[footer_bar_btn<?php echo esc_attr( $key ); ?>_number]"><?php _e( 'Phone number', 'tcd-w' ); ?></label></th>
								<td><input id="dp_options[footer_bar_btn<?php echo esc_attr( $key ); ?>_number]" class="regular-text" type="text" name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][number]" value=""></td>
							</tr>
     					<tr>
								<th><?php _e( 'Button icon', 'tcd-w' ); ?></th>
								<td>
									<?php foreach( $footer_bar_icon_options as $option ) : ?>
									<p><label><input type="radio" name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][icon]" value="<?php echo esc_attr( $option['value'] ); ?>"<?php if ( 'file-text' == $option['value'] ) { echo ' checked="checked"'; } ?>><span class="icon icon-<?php echo esc_attr( $option['value'] ); ?>"></span><?php esc_html_e( $option['label'], 'tcd-w' ); ?></label></p>
									<?php endforeach; ?>
								</td>
							</tr>
						</table>
       			<p class="delete-row right-align"><a href="#" class="button button-secondary button-delete-row"><?php _e( 'Delete item', 'tcd-w' ); ?></a></p>
					</div>
				</div>
				<?php $clone = ob_get_clean(); ?>
			</div>
			<a href="#" class="button button-secondary button-add-row" data-clone="<?php echo esc_attr( $clone ); ?>"><?php _e( 'Add item', 'tcd-w' ); ?></a>
		</div>
		<input type="submit" class="button-ml ajax_button" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
	</div>
</div><!-- END #tab-content8 -->
<?php
}

function add_footer_theme_options_validate( $input ) {
	global $footer_logo_type_options, $footer_bar_display_options, $footer_bar_button_options, $footer_bar_icon_options;

  // Footer banners
 	if ( ! isset( $input['display_footer_banners'] ) ) $input['display_footer_banners'] = null;
  $input['display_footer_banners'] = ( $input['display_footer_banners'] == 1 ? 1 : 0 );
  $input['footer_banners_bg'] = sanitize_hex_color( $input['footer_banners_bg'] );
  for ( $i = 1; $i <= 3; $i++ ) {
    $input['footer_banners_banner_title' . $i] = sanitize_textarea_field( $input['footer_banners_banner_title' . $i] );
    $input['footer_banners_banner_img' . $i] = absint( $input['footer_banners_banner_img' . $i] );
    $input['footer_banners_banner_url' . $i] = esc_url_raw( $input['footer_banners_banner_url' . $i] );
 	  if ( ! isset( $input['footer_banners_banner_target' . $i] ) ) $input['footer_banners_banner_target' . $i] = null;
    $input['footer_banners_banner_target' . $i] = ( $input['footer_banners_banner_target' . $i] == 1 ? 1 : 0 );
 	  if ( ! isset( $input['footer_banners_banner_display_gradation_overlay' . $i] ) ) $input['footer_banners_banner_display_gradation_overlay' . $i] = null;
    $input['footer_banners_banner_display_gradation_overlay' . $i] = ( $input['footer_banners_banner_display_gradation_overlay' . $i] == 1 ? 1 : 0 );
    $input['footer_banners_banner_gradation_overlay' . $i] = sanitize_hex_color( $input['footer_banners_banner_gradation_overlay' . $i] );
  }

  // Company information
 	$input['company_info_color'] = sanitize_hex_color( $input['company_info_color'] );
 	$input['company_info_bg'] = sanitize_hex_color( $input['company_info_bg'] );
  if ( ! isset( $input['footer_use_logo_image'] ) ) $input['footer_use_logo_image'] = null;
 	if ( ! array_key_exists( $input['footer_use_logo_image'], $footer_logo_type_options ) ) $input['footer_use_logo_image'] = null;
 	$input['footer_logo_font_size'] = absint( $input['footer_logo_font_size'] );
 	$input['footer_logo_image'] = absint( $input['footer_logo_image'] );
 	if ( ! isset( $input['footer_logo_image_retina'] ) ) $input['footer_logo_image_retina'] = null;
  $input['footer_logo_image_retina'] = ( $input['footer_logo_image_retina'] == 1 ? 1 : 0 );
  if ( ! isset( $input['sp_footer_use_logo_image'] ) ) $input['sp_footer_use_logo_image'] = null;
 	if ( ! array_key_exists( $input['sp_footer_use_logo_image'], $footer_logo_type_options ) ) $input['sp_footer_use_logo_image'] = null;
 	$input['sp_footer_logo_font_size'] = absint( $input['sp_footer_logo_font_size'] );
 	$input['sp_footer_logo_image'] = absint( $input['sp_footer_logo_image'] );
 	if ( ! isset( $input['sp_footer_logo_image_retina'] ) ) $input['sp_footer_logo_image_retina'] = null;
  $input['sp_footer_logo_image_retina'] = ( $input['sp_footer_logo_image_retina'] == 1 ? 1 : 0 );
	$input['footer_catch'] = sanitize_textarea_field( $input['footer_catch'] );
	$input['footer_catch_font_size'] = absint( $input['footer_catch_font_size'] );
	$input['footer_catch_color'] = sanitize_hex_color( $input['footer_catch_color'] );
  $input['facebook_url'] = esc_url_raw( $input['facebook_url'] );
  $input['twitter_url'] = esc_url_raw( $input['twitter_url'] );
  $input['insta_url'] = esc_url_raw( $input['insta_url'] );
  $input['pinterest_url'] = esc_url_raw( $input['pinterest_url'] );
  $input['mail_url'] = sanitize_email( $input['mail_url'] );
  if ( ! isset( $input['show_rss'] ) ) $input['show_rss'] = null;
  $input['show_rss'] = ( $input['show_rss'] == 1 ? 1 : 0 );

  // Footer widgets
  $input['footer_widgets_bg'] = sanitize_hex_color( $input['footer_widgets_bg'] );
  $input['footer_widgets_headline_color'] = sanitize_hex_color( $input['footer_widgets_headline_color'] );
  $input['footer_widgets_color'] = sanitize_hex_color( $input['footer_widgets_color'] );

  // Footer menu
  $input['footer_menu_color'] = sanitize_hex_color( $input['footer_menu_color'] );
  $input['footer_menu_color_hover'] = sanitize_hex_color( $input['footer_menu_color_hover'] );
  $input['footer_menu_bg'] = sanitize_hex_color( $input['footer_menu_bg'] );

  // Copyright
 	$input['copyright_bg'] = sanitize_hex_color( $input['copyright_bg'] );

  // Footer bar
 	if ( ! array_key_exists( $input['footer_bar_display'], $footer_bar_display_options ) ) $input['footer_bar_display'] = 'type3';
 	$input['footer_bar_bg'] = sanitize_hex_color( $input['footer_bar_bg'] );
 	$input['footer_bar_border'] = sanitize_hex_color( $input['footer_bar_border'] );
 	$input['footer_bar_color'] = sanitize_hex_color( $input['footer_bar_color'] );
 	$input['footer_bar_tp'] = sanitize_text_field( $input['footer_bar_tp'] );

	if ( isset( $input['footer_bar_btns'] ) ) {
    foreach ( $input['footer_bar_btns'] as $key => $value ) {
 	    if ( ! isset( $input['footer_bar_btns'][$key]['type'] ) ) $input['footer_bar_btns'][$key]['type'] = 'type1';
 	    if ( ! array_key_exists( $input['footer_bar_btns'][$key]['type'], $footer_bar_button_options ) ) $input['footer_bar_btns'][$key]['type'] = 'type1';
      $input['footer_bar_btns'][$key]['label'] = sanitize_text_field( $input['footer_bar_btns'][$key]['label'] );
      $input['footer_bar_btns'][$key]['url'] = esc_url_raw( $input['footer_bar_btns'][$key]['url'] );
      $input['footer_bar_btns'][$key]['number'] = sanitize_text_field( $input['footer_bar_btns'][$key]['number'] );
 	    if ( ! isset( $input['footer_bar_btns'][$key]['target'] ) ) $input['footer_bar_btns'][$key]['target'] = null;
      $input['footer_bar_btns'][$key]['target'] = ( $input['footer_bar_btns'][$key]['target'] == 1 ? 1 : 0 );
 	    if ( ! isset( $input['footer_bar_btns'][$key]['icon'] ) ) $input['footer_bar_btns'][$key]['icon'] = 'file-text';
 	    if ( ! array_key_exists( $input['footer_bar_btns'][$key]['icon'], $footer_bar_icon_options ) ) $input['footer_bar_btns'][$key]['icon'] = 'file-text';
    }
  }

	return $input;
}
