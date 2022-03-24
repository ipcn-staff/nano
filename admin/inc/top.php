<?php
/*
 * Manage front page tab
 */

// Add default values
add_filter( 'before_getting_design_plus_option', 'add_top_dp_default_options' );

// Add label of front page tab
add_action( 'tcd_tab_labels', 'add_top_tab_label' );

// Add HTML of front page tab
add_action( 'tcd_tab_panel', 'add_top_tab_panel' );

// Register sanitize function
add_filter( 'theme_options_validate', 'add_top_theme_options_validate' );

global $header_content_type_options;
$header_content_type_options = array(
  'type2' => array( 'value' => 'type1', 'label' => __( 'Image slider', 'tcd-w' ) ),
  'type3' => array( 'value' => 'type2', 'label' => __( 'Video', 'tcd-w' ) ),
  'type4' => array( 'value' => 'type3', 'label' => __( 'YouTube', 'tcd-w' ) )
);

global $header_slider_img_animation_type_options;
$header_slider_img_animation_type_options = array(
  'type1' => array( 'value' => 'type1', 'label' => __( 'Zoom in', 'tcd-w' ) ),
  'type2' => array( 'value' => 'type2', 'label' => __( 'Zoom out', 'tcd-w' ) ),
  'type3' => array( 'value' => 'type3', 'label' => __( 'None', 'tcd-w' ) )
);

global $header_slider_animation_time_options;
$header_slider_animation_time_options = array();
for ( $i = 5; $i <= 10; $i++ ) {
  $header_slider_animation_time_options[$i] = array(
    'value' => $i,
    'label' => sprintf( __( '%d seconds', 'tcd-w' ), $i )
  );
}

global $slider_content_type_mobile_options;
$slider_content_type_mobile_options = array(
  'type1' => array( 'value' => 'type1', 'label' => __( 'Type1: Same as PC setting', 'tcd-w' ) ),
  'type2' => array( 'value' => 'type2', 'label' => __( 'Type2: Logo', 'tcd-w' ) ),
  'type3' => array( 'value' => 'type3', 'label' => __( 'Type3: Catchphrase', 'tcd-w' ) )
);

function add_top_dp_default_options( $dp_default_options ) {

  // Header contents
  $dp_default_options['header_content_type'] = 'type1';

  // Image slider
  for ( $i = 1; $i <= 5; $i++ ) {
    $dp_default_options['header_slider_img' . $i] = '';
    $dp_default_options['header_slider_img_animation_type' . $i] = 'type3';
    $dp_default_options['header_slider_overlay' . $i] = '#000000';
    $dp_default_options['header_slider_overlay_opacity' . $i] = 0.3;
    $dp_default_options['header_slider_catch' . $i] = sprintf( __( 'Enter slider%d' . "\n" . 'catchphrase', 'tcd-w' ), $i );
    $dp_default_options['header_slider_catch_vertical' . $i] = 0;
    $dp_default_options['header_slider_catch_font_size' . $i] = 40;
    $dp_default_options['header_slider_catch_color' . $i] = '#ffffff';
    $dp_default_options['header_slider_btn_label' . $i] = __( 'Sample button', 'tcd-w' );
    $dp_default_options['header_slider_btn_url' . $i] = '#';
    $dp_default_options['header_slider_btn_target' . $i] = 0;
    $dp_default_options['header_slider_btn_color' . $i] = '#ffffff';
    $dp_default_options['header_slider_btn_bg' . $i] = '#d90000';
    $dp_default_options['header_slider_btn_color_hover' . $i] = '#ffffff';
    $dp_default_options['header_slider_btn_bg_hover' . $i] = '#a40000';

    $dp_default_options['header_slider_img_sp' . $i] = '';
    $dp_default_options['header_slider_catch_font_size_sp' . $i] = 26;
    $dp_default_options['header_slider_overlay_sp' . $i] = '#000000';
    $dp_default_options['header_slider_overlay_opacity_sp' . $i] = 0;
  }

  $dp_default_options['header_slider_content_type_mobile'] = 'type1';
  $dp_default_options['header_slider_logo'] = '';
  $dp_default_options['header_slider_logo_width'] = '';
  $dp_default_options['header_slider_catch_sp'] = '';
  $dp_default_options['header_slider_catch_font_size_sp'] = 20;
  $dp_default_options['header_slider_catch_vertical_sp'] = 0;
  $dp_default_options['header_slider_catch_color_sp'] = '#ffffff';
  $dp_default_options['header_slider_animation_time'] = 7;

  // Video
  $dp_default_options['header_video'] = '';
  $dp_default_options['header_video_img'] = '';
  $dp_default_options['header_video_catch'] = '';
  $dp_default_options['header_video_catch_vertical'] = 0;
  $dp_default_options['header_video_catch_font_size'] = 40;
  $dp_default_options['header_video_catch_color'] = '#ffffff';
  $dp_default_options['header_video_btn_label'] = '';
  $dp_default_options['header_video_btn_url'] = '';
  $dp_default_options['header_video_btn_target'] = 0;
  $dp_default_options['header_video_btn_color'] = '#ffffff';
  $dp_default_options['header_video_btn_bg'] = '#d90000';
  $dp_default_options['header_video_btn_color_hover'] = '#ffffff';
  $dp_default_options['header_video_btn_bg_hover'] = '#a40000';
  $dp_default_options['header_video_overlay'] = '#000000';
  $dp_default_options['header_video_overlay_opacity'] = 0;

  $dp_default_options['header_video_content_type_mobile'] = 'type1';
  $dp_default_options['header_video_catch_font_size_sp_type1'] = 20;
  $dp_default_options['header_video_logo'] = '';
  $dp_default_options['header_video_logo_width'] = '';
  $dp_default_options['header_video_catch_sp'] = '';
  $dp_default_options['header_video_catch_vertical_sp'] = 0;
  $dp_default_options['header_video_catch_font_size_sp_type3'] = 20;
  $dp_default_options['header_video_catch_color_sp'] = '#ffffff';
  $dp_default_options['header_video_overlay_sp'] = '#000000';
  $dp_default_options['header_video_overlay_opacity_sp'] = 0;

  // YouTube
  $dp_default_options['header_youtube_id'] = '';

  // Contents after the header content
  $dp_default_options['display_index_content01'] = 1;
  $dp_default_options['index_content01_catch'] = __( 'Enter catchphrase here.', 'tcd-w' );
  $dp_default_options['index_content01_catch_font_size'] = 38;
  $dp_default_options['index_content01_catch_font_size_sp'] = 26;
  $dp_default_options['index_content01_catch_color'] = '#000000';
  $dp_default_options['index_content01_desc'] = __( 'Enter description here. Enter description here. Enter description here.' . "\n" . 'Enter description here. Enter description here. Enter description here. Enter description here. Enter description here. ', 'tcd-w' );
  $dp_default_options['index_content01_desc_font_size'] = 16;
  $dp_default_options['index_content01_desc_font_size_sp'] = 14;
  $dp_default_options['index_content01_desc_color'] = '#000000';

  for ( $i = 1; $i <= 3; $i++ ) {
    $dp_default_options['index_content01_box_title' . $i] = sprintf( __( 'Item%d', 'tcd-w' ), $i );
    $dp_default_options['index_content01_box_sub' . $i] = __( 'Sub title', 'tcd-w' );
    $dp_default_options['index_content01_box_desc' . $i] = __( 'Enter description here. Enter description here. Enter description here. Enter description here. Enter description here. Enter description here.', 'tcd-w' );
    $dp_default_options['index_content01_box_img' . $i] = '';
    $dp_default_options['index_content01_box_overlay' . $i] = '#000000';
    $dp_default_options['index_content01_box_overlay_opacity' . $i] = 0.4;
    $dp_default_options['index_content01_box_url' . $i] = '#';
    $dp_default_options['index_content01_box_target' . $i] = 0;
  }

  $dp_default_options['index_content01_box_title_font_size'] = 32;
  $dp_default_options['index_content01_box_title_font_size_sp'] = 26;
  $dp_default_options['index_content01_box_title_color'] = '#000000';
  $dp_default_options['index_content01_box_sub_color'] = '#000000';
  $dp_default_options['index_content01_btn_label'] = __( 'Sample button', 'tcd-w' );
  $dp_default_options['index_content01_btn_url'] = '#';
  $dp_default_options['index_content01_btn_target'] = 0;
  $dp_default_options['index_content01_btn_bg'] = '#d90000';
  $dp_default_options['index_content01_btn_color'] = '#ffffff';
  $dp_default_options['index_content01_btn_bg_hover'] = '#a40000';
  $dp_default_options['index_content01_btn_color_hover'] = '#ffffff';

  // Contents builder
  $dp_default_options['index_contents_order'] = array(
    'news',
    'service',
    'banner',
    'works',
    'wysiwyg1',
    'wysiwyg2',
    'wysiwyg3'
  );

  // News
  $dp_default_options['display_index_news'] = 1;
  $dp_default_options['index_news_title'] = 'NEWS';
  $dp_default_options['index_news_title_font_size'] = 46;
  $dp_default_options['index_news_title_font_size_sp'] = 28;
  $dp_default_options['index_news_title_color'] = '#000000';
  $dp_default_options['index_news_sub'] = __( 'News', 'tcd-w' );
  $dp_default_options['index_news_sub_color'] = '#000000';
  $dp_default_options['index_news_desc'] = __( "Enter description here. Enter description here. Enter description here.\nEnter description here. Enter description here. Enter description here. Enter description here. Enter description here.", 'tcd-w' );
  $dp_default_options['index_news_desc_font_size'] = 16;
  $dp_default_options['index_news_desc_font_size_sp'] = 14;
  $dp_default_options['index_news_desc_color'] = '#000000';
  $dp_default_options['index_news_num'] = 5;
  $dp_default_options['index_news_btn_bg'] = '#d90000';
  $dp_default_options['index_news_btn_color'] = '#ffffff';
  $dp_default_options['index_news_btn_bg_hover'] = '#a40000';
  $dp_default_options['index_news_btn_color_hover'] = '#ffffff';

  for ( $i = 1; $i <= 4; $i++ ) {
    $dp_default_options['index_news_tab_cat' . $i] = '';
  }

  // Service
  $dp_default_options['display_index_service'] = 1;
  $dp_default_options['index_service_bg'] = '#f8f8f8';
  $dp_default_options['index_service_title'] = 'SERVICE';
  $dp_default_options['index_service_title_font_size'] = 46;
  $dp_default_options['index_service_title_font_size_sp'] = 28;
  $dp_default_options['index_service_title_color'] = '#000000';
  $dp_default_options['index_service_sub'] = __( 'Service', 'tcd-w' );
  $dp_default_options['index_service_sub_color'] = '#000000';
  $dp_default_options['index_service_desc'] = __( "Enter description here. Enter description here. Enter description here.\nEnter description here. Enter description here. Enter description here. Enter description here. Enter description here.", 'tcd-w' );
  $dp_default_options['index_service_desc_font_size'] = 16;
  $dp_default_options['index_service_desc_font_size_sp'] = 14;
  $dp_default_options['index_service_desc_color'] = '#000000';

  for ( $i = 1; $i <= 3; $i++ ) {
    $dp_default_options['index_service_box_title' . $i] = sprintf( __( 'Item%d', 'tcd-w' ), $i );
    $dp_default_options['index_service_box_sub' . $i] = __( 'Sub title', 'tcd-w' );
    $dp_default_options['index_service_box_desc' . $i] = __( 'Enter description here. Enter description here. Enter description here. Enter description here. Enter description here. Enter description here.', 'tcd-w' );
    $dp_default_options['index_service_box_img' . $i] = '';
    $dp_default_options['index_service_box_overlay' . $i] = '#000000';
    $dp_default_options['index_service_box_overlay_opacity' . $i] = 0.4;
    $dp_default_options['index_service_box_url' . $i] = '#';
    $dp_default_options['index_service_box_target' . $i] = 0;
  }

  $dp_default_options['index_service_box_title_font_size'] = 32;
  $dp_default_options['index_service_box_title_font_size_sp'] = 26;
  $dp_default_options['index_service_box_title_color'] = '#000000';
  $dp_default_options['index_service_box_sub_color'] = '#000000';
  $dp_default_options['index_service_btn_label'] = __( 'Sample button', 'tcd-w' );
  $dp_default_options['index_service_btn_url'] = '#';
  $dp_default_options['index_service_btn_target'] = 0;
  $dp_default_options['index_service_btn_bg'] = '#d90000';
  $dp_default_options['index_service_btn_color'] = '#ffffff';
  $dp_default_options['index_service_btn_bg_hover'] = '#a40000';
  $dp_default_options['index_service_btn_color_hover'] = '#ffffff';

  // Banner
  $dp_default_options['display_index_banner'] = 1;

  for ( $i = 1; $i <= 6; $i++ ) {
    $dp_default_options['index_banner_title' . $i] = __( 'Banner', 'tcd-w' ) . $i;
    $dp_default_options['index_banner_title_color' . $i] = '#ffffff';
    $dp_default_options['index_banner_sub' . $i] = __( 'Sub title', 'tcd-w' );
    $dp_default_options['index_banner_sub_color' . $i] = '#ffffff';
    $dp_default_options['index_banner_desc' . $i] = __( 'Enter description here. Enter description here.', 'tcd-w' );
    $dp_default_options['index_banner_desc_color' . $i] = '#000000';
    $dp_default_options['index_banner_img' . $i] = '';
    $dp_default_options['index_banner_display_overlay' . $i] = 1;
    $dp_default_options['index_banner_overlay' . $i] = '#000000';
    $dp_default_options['index_banner_url' . $i] = '#';
    $dp_default_options['index_banner_target' . $i] = 0;
  }

  // Works
  $dp_default_options['display_index_works'] = 1;
  $dp_default_options['index_works_title'] = 'WORKS';
  $dp_default_options['index_works_title_font_size'] = 46;
  $dp_default_options['index_works_title_font_size_sp'] = 28;
  $dp_default_options['index_works_title_color'] = '#000000';
  $dp_default_options['index_works_sub'] = __( 'Works', 'tcd-w' );
  $dp_default_options['index_works_sub_color'] = '#000000';
  $dp_default_options['index_works_desc'] = __( "Enter description here. Enter description here. Enter description here.\nEnter description here. Enter description here. Enter description here. Enter description here. Enter description here.", 'tcd-w' );
  $dp_default_options['index_works_desc_font_size'] = 16;
  $dp_default_options['index_works_desc_font_size_sp'] = 14;
  $dp_default_options['index_works_desc_color'] = '#000000';
  $dp_default_options['index_works_num'] = 3;
  $dp_default_options['index_works_btn_bg'] = '#d90000';
  $dp_default_options['index_works_btn_color'] = '#ffffff';
  $dp_default_options['index_works_btn_bg_hover'] = '#a40000';
  $dp_default_options['index_works_btn_color_hover'] = '#ffffff';

  // Wysiwyg
  for( $i = 1; $i <= 3; $i++ ) {
    $dp_default_options['display_index_wysiwyg' . $i] = 0;
    $dp_default_options['index_wysiwyg_editor' . $i] = '';
  }

	return $dp_default_options;
}

function add_top_tab_label( $tab_labels ) {
	$tab_labels['top'] = __( 'Front page', 'tcd-w' );
	return $tab_labels;
}

function add_top_tab_panel( $dp_options ) {
  global $dp_default_options, $header_content_type_options, $header_slider_img_animation_type_options, $header_slider_animation_time_options, $slider_content_type_mobile_options;

  $news_categories = get_terms( 'news_category' );
?>
<div id="tab-content-top">

	<?php // Header content ?>
	<div class="theme_option_field cf">
  	<h3 class="theme_option_headline"><?php _e( 'Header content settings', 'tcd-w' ); ?></h3>
    <p><?php _e( 'You can set header content as the first view of your site. ', 'tcd-w' ); ?></p>
    <div class="theme_option_message"><?php echo __( '<p>Image slider:You can set 5 slides or 1 image as fixed header.</p><p>Video:You can display MP4 format videos.</p><p>Youtube:You can display Youtube videos.</p>', 'tcd-w' ); ?></div>
    <h4 class="theme_option_headline2"><?php _e( 'Header content type', 'tcd-w' ); ?></h4>
    <?php foreach ( $header_content_type_options as $option ) : ?>
    <p><label><input type="radio" name="dp_options[header_content_type]" value="<?php echo esc_attr( $option['value'] ); ?>" <?php checked( $option['value'], $dp_options['header_content_type'] ); ?>><?php echo esc_html_e( $option['label'] ); ?></label></p>
    <?php endforeach; ?>
		<input type="submit" class="button-ml ajax_button" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
	</div>

  <?php // Image slider ?>
  <div id="header_content_type_type1"<?php if ( 'type1' !== $dp_options['header_content_type'] ) { echo ' style="display: none;"'; } ?>>
	  <div class="theme_option_field cf">
  	  <h3 class="theme_option_headline"><?php _e( 'Image slider settings', 'tcd-w' ); ?></h3>
      <p><?php _e( 'Please set slider item.', 'tcd-w' ); ?></p>
		  <?php for ( $i = 1; $i <= 5; $i++ ) : ?>
		  <div class="sub_box cf">
      	<h3 class="theme_option_subbox_headline"><?php printf( __( 'Slide%s setting for PC', 'tcd-w' ), $i ); ?></h3>
      	<div class="sub_box_content">
      		<h4 class="theme_option_headline2"><?php _e( 'Image', 'tcd-w' ); ?></h4>
          <p><?php _e( 'Image for PC and Tablet.', 'tcd-w' ); ?></p>
          <p><?php printf( __( 'Recommended size. Width:%dpx, Height:%dpx', 'tcd-w' ), 1450, 815 ); ?></p>
      		<div class="image_box cf">
      			<div class="cf cf_media_field hide-if-no-js">
      				<input type="hidden" value="<?php echo esc_attr( $dp_options['header_slider_img' . $i] ); ?>" id="header_slider_img<?php echo $i; ?>" name="dp_options[header_slider_img<?php echo $i; ?>]" class="cf_media_id">
      				<div class="preview_field"><?php if ( $dp_options['header_slider_img' . $i] ) { echo wp_get_attachment_image( $dp_options['header_slider_img' . $i], 'medium' ); } ?></div>
      				<div class="button_area">
      					<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
      					<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $dp_options['header_slider_img' . $i] ) { echo 'hidden'; } ?>">
      				</div>
      			</div>
      		</div>
          <h4 class="theme_option_headline2"><?php _e( 'Animation type of the background image', 'tcd-w' ); ?></h4>
          <p><?php _e( 'Please select animation of background image.', 'tcd-w' ); ?></p>
          <?php foreach ( $header_slider_img_animation_type_options as $option ) : ?>
          <p><label><input type="radio" name="dp_options[header_slider_img_animation_type<?php echo $i; ?>]" value="<?php echo esc_attr( $option['value'] ); ?>" <?php checked( $option['value'], $dp_options['header_slider_img_animation_type' . $i] ); ?>> <?php echo esc_html( $option['label'] ); ?></label></p>
          <?php endforeach; ?>
          <h4 class="theme_option_headline2"><?php _e( 'Color overlay on the background image', 'tcd-w' ); ?></h4>
          <p><?php _e( 'Use overlay, to become easy to read the catchphrase on the background. Please set color of overlay.', 'tcd-w' ); ?></p>
          <input class="c-color-picker" type="text" name="dp_options[header_slider_overlay<?php echo $i; ?>]" data-default-color="<?php echo esc_attr( $dp_default_options['header_slider_overlay' . $i] ); ?>" value="<?php echo esc_attr( $dp_options['header_slider_overlay' . $i] ); ?>">
          <h4 class="theme_option_headline2"><?php _e( 'Opacity of the overlay on the background image', 'tcd-w' ); ?></h4>
          <p><?php _e( 'Please set opacity of overlay. If you do not want to display the overlay, enter "0"', 'tcd-w' ); ?></p>
          <input type="number" min="0" max="1.0" step="0.1" name="dp_options[header_slider_overlay_opacity<?php echo $i; ?>]" value="<?php echo esc_attr( $dp_options['header_slider_overlay_opacity' . $i] ); ?>">
      		<h4 class="theme_option_headline2"><?php _e( 'Catchphrase', 'tcd-w' ); ?></h4>
          <p><?php _e( 'Please set the catchphrase displayed in the center of the header. Set the catchphrase, font color, font size, writing direction.', 'tcd-w' ); ?></p>
          <textarea class="regular-text" name="dp_options[header_slider_catch<?php echo $i; ?>]"><?php echo esc_textarea( $dp_options['header_slider_catch' . $i] ); ?></textarea>
          <p><label><input type="checkbox" name="dp_options[header_slider_catch_vertical<?php echo $i; ?>]" value="1" <?php checked( 1, $dp_options['header_slider_catch_vertical' . $i] ); ?>> <?php _e( 'Vertical writing', 'tcd-w' ); ?></label></p>
          <p><label><?php _e( 'Font size', 'tcd-w' ); ?> <input type="number" min="1" step="1" class="tiny-text" name="dp_options[header_slider_catch_font_size<?php echo $i; ?>]" value="<?php echo esc_attr( $dp_options['header_slider_catch_font_size' . $i] ); ?>"> px</label></p>
          <p><label for="header_slider_catch_color<?php echo $i; ?>"><?php _e( 'Font color', 'tcd-w' ); ?> </label><input type="text" class="c-color-picker" id="header_slider_catch_color<?php echo $i; ?>" name="dp_options[header_slider_catch_color<?php echo $i; ?>]" value="<?php echo esc_attr( $dp_options['header_slider_catch_color' . $i] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['header_slider_catch_color' . $i] ); ?>"></p>
      		<h4 class="theme_option_headline2"><?php _e( 'Button', 'tcd-w' ); ?></h4>
          <p><?php _e( 'Button label', 'tcd-w' ); ?> <input type="text" class="regular-text" name="dp_options[header_slider_btn_label<?php echo $i; ?>]" value="<?php echo esc_attr( $dp_options['header_slider_btn_label' . $i] ); ?>"></p>
          <p><?php _e( 'Link URL', 'tcd-w' ); ?> <input type="text" class="regular-text" name="dp_options[header_slider_btn_url<?php echo $i; ?>]" value="<?php echo esc_attr( $dp_options['header_slider_btn_url' . $i] ); ?>"></p>
          <p><label><input type="checkbox" name="dp_options[header_slider_btn_target<?php echo $i; ?>]" value="1" <?php checked( 1, $dp_options['header_slider_btn_target' . $i] ); ?>> <?php _e( 'Open with new window', 'tcd-w' ); ?></label></p>
          <p>
            <label for="header_slider_btn_color"><?php _e( 'Font color', 'tcd-w' ); ?></label>
            <input type="text" class="c-color-picker" name="dp_options[header_slider_btn_color<?php echo $i; ?>]" value="<?php echo esc_attr( $dp_options['header_slider_btn_color' . $i] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['header_slider_btn_color' . $i] ); ?>" id="header_slider_btn_color">
          </p>
          <p>
            <label for="header_slider_btn_bg"><?php _e( 'Background color', 'tcd-w' ); ?></label>
            <input type="text" class="c-color-picker" name="dp_options[header_slider_btn_bg<?php echo $i; ?>]" value="<?php echo esc_attr( $dp_options['header_slider_btn_bg' . $i] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['header_slider_btn_bg' . $i] ); ?>" id="header_slider_btn_bg">
          </p>
          <p>
            <label for="header_slider_btn_color_hover"><?php _e( 'Font color on hover', 'tcd-w' ); ?></label>
            <input type="text" class="c-color-picker" name="dp_options[header_slider_btn_color_hover<?php echo $i; ?>]" value="<?php echo esc_attr( $dp_options['header_slider_btn_color_hover' . $i] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['header_slider_btn_color_hover' . $i] ); ?>" id="header_slider_btn_color_hover">
          </p>
          <p>
            <label for="header_slider_btn_bg_hover"><?php _e( 'Background color on hover', 'tcd-w' ); ?></label>
            <input type="text" class="c-color-picker" name="dp_options[header_slider_btn_bg_hover<?php echo $i; ?>]" value="<?php echo esc_attr( $dp_options['header_slider_btn_bg_hover' . $i] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['header_slider_btn_bg_hover' . $i] ); ?>" id="header_slider_btn_bg_hover">
          </p>

		  		<input type="submit" class="button-ml ajax_button" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
		  	</div>
		  </div><!-- .sub_box END -->
		  <?php endfor; ?>

		  <div class="sub_box cf">
      	<h5 class="theme_option_subbox_headline"><?php _e( 'Slides setting for mobile', 'tcd-w' ); ?></h5>
      	<div class="sub_box_content">
            <p><?php _e( 'Sets the display contents of the slider for mobile.', 'tcd-w' ); ?></p>
      		<h6 class="theme_option_headline2"><?php _e( 'Content type', 'tcd-w' ); ?></h6>
          <?php foreach ( $slider_content_type_mobile_options as $option ) : ?>
          <p><label><input type="radio" name="dp_options[header_slider_content_type_mobile]" value="<?php echo esc_attr( $option['value'] ); ?>" <?php checked( $option['value'], $dp_options['header_slider_content_type_mobile'] ); ?>> <?php echo esc_html( $option['label'] ); ?></label></p>
          <?php endforeach; ?>

          <div id="header_slider_content_type_mobile_type2" style="<?php if ( 'type2' !== $dp_options['header_slider_content_type_mobile'] ) { echo 'display: none'; } ?>">
  	        <h6 class="theme_option_headline2"><?php _e( 'Logo', 'tcd-w' ); ?></h6>
            <p><?php _e( 'Please set logo image.', 'tcd-w' ); ?></p>
            <p><?php printf( __( 'Recommended image size. Width: %dpx or more, Height: %dpx or more', 'tcd-w' ), 145, 18 ); ?></p>
            <div class="image_box cf header_slider_logo">
            	<div class="cf cf_media_field hide-if-no-js">
            		<input type="hidden" value="<?php echo esc_attr( $dp_options['header_slider_logo'] ); ?>" id="header_slider_logo" name="dp_options[header_slider_logo]" class="cf_media_id">
            		<div class="preview_field"><?php if ( $dp_options['header_slider_logo'] ) { echo wp_get_attachment_image( $dp_options['header_slider_logo'], 'medium' ); } ?></div>
            		<div class="button_area">
            			<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
            			<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $dp_options['header_slider_logo'] ) { echo 'hidden'; } ?>">
            		</div>
            	</div>
            </div>
            <div class="slider_logo_preview-wrapper" style="display: none;">
              <h6 class="theme_option_headline2"><?php _e( 'Logo preview', 'tcd-w' ); ?></h6>
              <p><?php _e( 'You can change the logo size by moving the mouse cursor over the logo and dragging the arrow. Double-click on the logo to return to the original size.', 'tcd-w' ); ?></p>
              <input type="hidden" value="<?php echo esc_attr( $dp_options['header_slider_logo_width'] ); ?>" name="dp_options[header_slider_logo_width]" id="header_slider_logo_width">
              <div class="slider_logo_preview slider_logo_preview-mobile header_slider_logo_preview header_slider_logo_preview-mobile" data-logo-width-input="#header_slider_logo_width" data-logo-img=".header_slider_logo img" data-overlay-color=".header_slider_overlay_sp" data-overlay-opacity=".header_slider_overlay_opacity_sp"></div>
            </div>
          </div>

          <div id="header_slider_content_type_mobile_type3" style="<?php if ( 'type3' !== $dp_options['header_slider_content_type_mobile'] ) { echo 'display: none'; } ?>">
      		  <h6 class="theme_option_headline2"><?php _e( 'Catchphrase', 'tcd-w' ); ?></h6>
            <p><?php _e( 'Please set the catchphrase displayed in the center of the header. Set the catchphrase, font color, font size, writing direction.', 'tcd-w' ); ?></p>
            <textarea class="regular-text" name="dp_options[header_slider_catch_sp]"><?php echo esc_textarea( $dp_options['header_slider_catch_sp'] ); ?></textarea>
            <p><label><input type="checkbox" name="dp_options[header_slider_catch_vertical_sp]" value="1" <?php checked( 1, $dp_options['header_slider_catch_vertical_sp'] ); ?>> <?php _e( 'Vertical writing', 'tcd-w' ); ?></label></p>
            <p><label><?php _e( 'Font size', 'tcd-w' ); ?> <input type="number" min="1" step="1" name="dp_options[header_slider_catch_font_size_sp]" value="<?php echo esc_attr( $dp_options['header_slider_catch_font_size_sp'] ); ?>" class="tiny-text"> px</label></p>
            <p><label for="header_slider_catch_color_sp"><?php _e( 'Font color', 'tcd-w' ); ?></label> <input type="text" class="c-color-picker" name="dp_options[header_slider_catch_color_sp]" value="<?php echo esc_attr( $dp_options['header_slider_catch_color_sp'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['header_slider_catch_color_sp'] ); ?>"></p>
          </div>

          <?php for ( $i = 1; $i <= 5; $i++ ) : ?>
		      <div class="sub_box cf">
      	    <div class="theme_option_subbox_headline"><?php printf( __( 'Slide%d setting for mobile', 'tcd-w' ), $i ); ?></div>
      	    <div class="sub_box_content">
      		    <div class="theme_option_headline2"><?php _e( 'Image', 'tcd-w' ); ?></div>
                <p><?php _e( 'You can set image for smartphone.', 'tcd-w' ); ?></p>
                <p><?php printf( __( 'Recommend image size. Width:%dpx or more, Height:%dpx or more', 'tcd-w' ), 750, 1334 ); ?></p>
      		    <div class="image_box cf">
      		    	<div class="cf cf_media_field hide-if-no-js">
      		    		<input type="hidden" value="<?php echo esc_attr( $dp_options['header_slider_img_sp' . $i] ); ?>" id="header_slider_img_sp<?php echo $i; ?>" name="dp_options[header_slider_img_sp<?php echo $i; ?>]" class="cf_media_id">
      		    		<div class="preview_field"><?php if ( $dp_options['header_slider_img_sp' . $i] ) { echo wp_get_attachment_image( $dp_options['header_slider_img_sp' . $i], 'medium' ); } ?></div>
      		    		<div class="button_area">
      		    			<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
      		    			<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $dp_options['header_slider_img_sp' . $i] ) { echo 'hidden'; } ?>">
      		    		</div>
      		    	</div>
      		    </div>

              <div class="header_slider_content_type_mobile_type1" style="<?php if ( 'type1' !== $dp_options['header_slider_content_type_mobile'] ) { echo 'display: none'; } ?>">
      		      <div class="theme_option_headline2"><?php _e( 'Font size of catchphrase (mobile)', 'tcd-w' ); ?></div>
                  <p><?php _e( 'You can set catchphrase font size for mobile.', 'tcd-w' ); ?></p>
                <p><input type="number" min="1" step="1" name="dp_options[header_slider_catch_font_size_sp<?php echo $i; ?>]" value="<?php echo esc_attr( $dp_options['header_slider_catch_font_size_sp' . $i] ); ?>" class="tiny-text"> px</p>
              </div>

              <div class="header_slider_content_type_mobile_type2 header_slider_content_type_mobile_type3" style="<?php if ( 'type1' === $dp_options['header_slider_content_type_mobile'] ) { echo 'display: none;'; } ?>">
  	            <h6 class="theme_option_headline2"><?php _e( 'Color overlay on the background', 'tcd-w' ); ?></h6>
                <p><?php _e( 'Use overlay, to become easy to read the catchphrase on the background. Please set color of overlay.', 'tcd-w' ); ?></p>
                <input type="text" class="header_slider_overlay_sp c-color-picker" name="dp_options[header_slider_overlay_sp<?php echo $i; ?>]" value="<?php echo esc_attr( $dp_options['header_slider_overlay_sp' . $i] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['header_slider_overlay_sp' . $i] ); ?>">
  	            <h6 class="theme_option_headline2"><?php _e( 'Opacity of the overlay on the background', 'tcd-w' ); ?></h6>
                <p><?php _e( 'Please set opacity of overlay. If you do not want to display the overlay, enter "0"', 'tcd-w' ); ?></p>
                <p><input class="header_slider_overlay_opacity_sp" type="number" min="0" max="1" step="0.1" name="dp_options[header_slider_overlay_opacity_sp<?php echo $i; ?>]" value="<?php echo esc_attr( $dp_options['header_slider_overlay_opacity_sp' . $i] ); ?>"></p>
              </div>

		  		    <input type="submit" class="button-ml ajax_button" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
            </div>
          </div>
          <?php endfor; ?>

		      <input type="submit" class="button-ml ajax_button" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
        </div>
      </div>

      <h4 class="theme_option_headline2"><?php _e( 'Image slider animation time', 'tcd-w' ); ?></h4>
        <p><?php _e( 'Please set transition speed. (5 to 10 seconds)', 'tcd-w' ); ?></p>
      <select name="dp_options[header_slider_animation_time]">

        <?php foreach ( $header_slider_animation_time_options as $option ) : ?>
        <option value="<?php echo esc_attr( $option['value'] ); ?>" <?php selected( $option['value'], $dp_options['header_slider_animation_time'] ); ?>><?php echo esc_attr_e( $option['label'] ); ?></option>
        <?php endforeach; ?>

      </select>
		  <input type="submit" class="button-ml ajax_button" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
    </div>
  </div>

  <?php // Video and YouTube ?>
  <div class="header_content_type_type2 header_content_type_type3" style="<?php if ( 'type1' === $dp_options['header_content_type'] ) { echo 'display: none;'; } ?>">
	  <div class="theme_option_field cf">

      <?php // Video ?>
      <div id="header_content_type_type2" style="<?php if ( 'type2' !== $dp_options['header_content_type'] ) { echo 'display: none;'; } ?>">
  	    <h3 class="theme_option_headline"><?php _e( 'Video settings', 'tcd-w' ); ?></h3>
        <h4 class="theme_option_headline2"><?php _e( 'Video file', 'tcd-w' ); ?></h4>
        <p><?php _e( 'Please upload MP4 format file.', 'tcd-w' ); ?></p>
        <div class="image_box cf">
		      <div class="cf cf_media_field hide-if-no-js header_video">
		      	<input type="hidden" value="<?php echo esc_attr( $dp_options['header_video'] ); ?>" id="header_video" name="dp_options[header_video]" class="cf_media_id">
		      	<div class="preview_field preview_field_video">
		      		<?php if ( $dp_options['header_video'] ) : ?>
		      		<h5><?php _e( 'Uploaded MP4 file', 'tcd-w' ); ?></h5>
          		<p><?php echo esc_html( wp_get_attachment_url( $dp_options['header_video'] ) ); ?></p>
		      		<?php endif; ?>
          	</div>
          	<div class="button_area">
          		<input type="button" value="<?php _e( 'Select MP4 file', 'tcd-w' ); ?>" class="cfmf-select-video button">
          		<input type="button" value="<?php _e( 'Remove MP4 file', 'tcd-w' ); ?>" class="cfmf-delete-video button <?php if ( ! $dp_options['header_video'] ) { echo 'hidden'; }; ?>">
          	</div>
          </div>
        </div>
      </div>

      <?php // YouTube ?>
      <div id="header_content_type_type3" style="<?php if ( 'type3' !== $dp_options['header_content_type'] ) { echo 'display: none;'; } ?>">
  	    <h3 class="theme_option_headline"><?php _e( 'YouTube settings', 'tcd-w' ); ?></h3>
  	    <h4 class="theme_option_headline2"><?php _e( 'Video ID of YouTube', 'tcd-w' ); ?></h4>
        <p><?php _e( 'Please input a video ID of YouTube', 'tcd-w' ); ?></p>
        <input type="text" name="dp_options[header_youtube_id]" value="<?php echo esc_attr( $dp_options['header_youtube_id'] ); ?>">
      </div>

      <h4 class="theme_option_headline2"><?php _e( 'Substitute image', 'tcd-w' ); ?></h4>
      <p><?php _e( 'Substitute image is displayed on tablet and mobile devices. Recommended size: width:1450px, height:815px', 'tcd-w' ); ?></p>
      <div class="image_box cf">
      	<div class="cf cf_media_field hide-if-no-js">
      		<input type="hidden" value="<?php echo esc_attr( $dp_options['header_video_img'] ); ?>" id="header_video_img" name="dp_options[header_video_img]" class="cf_media_id">
      		<div class="preview_field"><?php if ( $dp_options['header_video_img'] ) { echo wp_get_attachment_image( $dp_options['header_video_img'], 'medium' ); } ?></div>
      		<div class="button_area">
      			<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
      			<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $dp_options['header_video_img'] ) { echo 'hidden'; } ?>">
      		</div>
      	</div>
      </div>
		  <div class="sub_box cf">
      	<h3 class="theme_option_subbox_headline"><?php _e( 'Overlay contents setting for PC', 'tcd-w' ); ?></h3>
      	<div class="sub_box_content">
      		<h4 class="theme_option_headline2"><?php _e( 'Catchphrase', 'tcd-w' ); ?></h4>
          <p><?php _e( 'Please set the catchphrase displayed in the center of the header. Set the catchphrase, font color, font size, writing direction.', 'tcd-w' ); ?></p>
          <textarea class="regular-text" name="dp_options[header_video_catch]"><?php echo esc_textarea( $dp_options['header_video_catch'] ); ?></textarea>
          <p><label><input type="checkbox" name="dp_options[header_video_catch_vertical]" value="1" <?php checked( 1, $dp_options['header_video_catch_vertical'] ); ?>> <?php _e( 'Vertical writing', 'tcd-w' ); ?></label></p>
          <p><label><?php _e( 'Font size', 'tcd-w' ); ?> <input type="number" min="1" step="1" name="dp_options[header_video_catch_font_size]" value="<?php echo esc_attr( $dp_options['header_video_catch_font_size'] ); ?>" class="tiny-text"> px</label></p>
          <p><label for="header_video_catch_color"><?php _e( 'Font color', 'tcd-w' ); ?></label> <input type="text" class="c-color-picker" name="dp_options[header_video_catch_color]" value="<?php echo esc_attr( $dp_options['header_video_catch_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['header_video_catch_color'] ); ?>"></p>
      		<h4 class="theme_option_headline2"><?php _e( 'Button', 'tcd-w' ); ?></h4>
          <p><?php _e( 'Button label', 'tcd-w' ); ?> <input type="text" class="regular-text" name="dp_options[header_video_btn_label]" value="<?php echo esc_attr( $dp_options['header_video_btn_label'] ); ?>"></p>
          <p><?php _e( 'Link URL', 'tcd-w' ); ?> <input type="text" class="regular-text" name="dp_options[header_video_btn_url]" value="<?php echo esc_attr( $dp_options['header_video_btn_url'] ); ?>"></p>
          <p><label><input type="checkbox" name="dp_options[header_video_btn_target]" value="1" <?php checked( 1, $dp_options['header_video_btn_target'] ); ?>> <?php _e( 'Open with new window', 'tcd-w' ); ?></label></p>
          <p>
            <label for="header_video_btn_color"><?php _e( 'Font color', 'tcd-w' ); ?></label>
            <input type="text" class="c-color-picker" name="dp_options[header_video_btn_color]" value="<?php echo esc_attr( $dp_options['header_video_btn_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['header_video_btn_color'] ); ?>" id="header_video_btn_color">
          </p>
          <p>
            <label for="header_video_btn_bg"><?php _e( 'Background color', 'tcd-w' ); ?></label>
            <input type="text" class="c-color-picker" name="dp_options[header_video_btn_bg]" value="<?php echo esc_attr( $dp_options['header_video_btn_bg'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['header_video_btn_bg'] ); ?>" id="header_video_btn_bg">
          </p>
          <p>
            <label for="header_video_btn_color_hover"><?php _e( 'Font color on hover', 'tcd-w' ); ?></label>
            <input type="text" class="c-color-picker" name="dp_options[header_video_btn_color_hover]" value="<?php echo esc_attr( $dp_options['header_video_btn_color_hover'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['header_video_btn_color_hover'] ); ?>" id="header_video_btn_color_hover">
          </p>
          <p>
            <label for="header_video_btn_bg_hover"><?php _e( 'Background color on hover', 'tcd-w' ); ?></label>
            <input type="text" class="c-color-picker" name="dp_options[header_video_btn_bg_hover]" value="<?php echo esc_attr( $dp_options['header_video_btn_bg_hover'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['header_video_btn_bg_hover'] ); ?>" id="header_video_btn_bg_hover">
          </p>
  	      <h6 class="theme_option_headline2"><?php _e( 'Color overlay on the background', 'tcd-w' ); ?></h6>
          <p><?php _e( 'Use overlay, to become easy to read the catchphrase on the background. Please set color of overlay.', 'tcd-w' ); ?></p>
          <input type="text" class="c-color-picker" name="dp_options[header_video_overlay]" value="<?php echo esc_attr( $dp_options['header_video_overlay'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['header_video_overlay'] ); ?>">
  	      <h6 class="theme_option_headline2"><?php _e( 'Opacity of the overlay on the background', 'tcd-w' ); ?></h6>
          <p><?php _e( 'Please set opacity of overlay. If you do not want to display the overlay, enter "0"', 'tcd-w' ); ?></p>
          <input type="number" min="0" max="1" step="0.1" name="dp_options[header_video_overlay_opacity]" value="<?php echo esc_attr( $dp_options['header_video_overlay_opacity'] ); ?>">
		      <input type="submit" class="button-ml ajax_button" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
        </div>
      </div>
		  <div class="sub_box cf">
      	<h3 class="theme_option_subbox_headline"><?php _e( 'Overlay contents setting for mobile', 'tcd-w' ); ?></h3>
      	<div class="sub_box_content">
      		<h6 class="theme_option_headline2"><?php _e( 'Content type', 'tcd-w' ); ?></h6>
          <?php foreach ( $slider_content_type_mobile_options as $option ) : ?>
          <p><label><input type="radio" name="dp_options[header_video_content_type_mobile]" value="<?php echo esc_attr( $option['value'] ); ?>" <?php checked( $option['value'], $dp_options['header_video_content_type_mobile'] ); ?>> <?php echo esc_html( $option['label'] ); ?></label></p>
          <?php endforeach; ?>

          <div id="header_video_content_type_mobile_type1" style="<?php if ( 'type1' !== $dp_options['header_video_content_type_mobile'] ) { echo 'display: none'; } ?>">
      		  <h6 class="theme_option_headline2"><?php _e( 'Font size of catchphrase (mobile)', 'tcd-w' ); ?></h6>
            <p><input type="number" min="1" step="1" name="dp_options[header_video_catch_font_size_sp_type1]" value="<?php echo esc_attr( $dp_options['header_video_catch_font_size_sp_type1'] ); ?>" class="tiny-text"> px</p>
          </div>

          <div id="header_video_content_type_mobile_type2" style="<?php if ( 'type2' !== $dp_options['header_video_content_type_mobile'] ) { echo 'display: none'; } ?>">
  	        <h6 class="theme_option_headline2"><?php _e( 'Logo', 'tcd-w' ); ?></h6>
            <p><?php _e( 'Please set logo image.', 'tcd-w' ); ?></p>
            <p><?php printf( __( 'Recommended image size. Width: %dpx or more, Height: %dpx or more', 'tcd-w' ), 145, 18 ); ?></p>
            <div class="image_box cf header_video_logo">
            	<div class="cf cf_media_field hide-if-no-js">
            		<input type="hidden" value="<?php echo esc_attr( $dp_options['header_video_logo'] ); ?>" id="header_video_logo" name="dp_options[header_video_logo]" class="cf_media_id">
            		<div class="preview_field"><?php if ( $dp_options['header_video_logo'] ) { echo wp_get_attachment_image( $dp_options['header_video_logo'], 'medium' ); } ?></div>
            		<div class="button_area">
            			<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
            			<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $dp_options['header_video_logo'] ) { echo 'hidden'; } ?>">
            		</div>
            	</div>
            </div>
            <div class="slider_logo_preview-wrapper" style="display: none;">
              <h6 class="theme_option_headline2"><?php _e( 'Logo preview', 'tcd-w' ); ?></h6>
              <p><?php _e( 'You can change the logo size by moving the mouse cursor over the logo and dragging the arrow. Double-click on the logo to return to the original size.', 'tcd-w' ); ?></p>
              <input type="hidden" value="<?php echo esc_attr( $dp_options['header_video_logo_width'] ); ?>" name="dp_options[header_video_logo_width]" id="header_video_logo_width">
              <div class="slider_logo_preview slider_logo_preview-mobile header_video_logo_preview header_video_logo_preview-mobile" data-logo-width-input="#header_video_logo_width" data-logo-img=".header_video_logo img" data-overlay-color=".header_video_overlay_sp" data-overlay-opacity=".header_video_overlay_opacity_sp"></div>
            </div>
          </div>

          <div id="header_video_content_type_mobile_type3" style="<?php if ( 'type3' !== $dp_options['header_video_content_type_mobile'] ) { echo 'display: none'; } ?>">
      		  <h6 class="theme_option_headline2"><?php _e( 'Catchphrase', 'tcd-w' ); ?></h6>
            <p><?php _e( 'Please set the catchphrase displayed in the center of the header. Set the catchphrase, font color, font size, writing direction.', 'tcd-w' ); ?></p>
            <textarea class="regular-text" name="dp_options[header_video_catch_sp]"><?php echo esc_textarea( $dp_options['header_video_catch_sp'] ); ?></textarea>
            <p><label><input type="checkbox" name="dp_options[header_video_catch_vertical_sp]" value="1" <?php checked( 1, $dp_options['header_video_catch_vertical_sp'] ); ?>> <?php _e( 'Vertical writing', 'tcd-w' ); ?></label></p>
            <p><label><?php _e( 'Font size', 'tcd-w' ); ?> <input type="number" min="1" step="1" name="dp_options[header_video_catch_font_size_sp_type3]" value="<?php echo esc_attr( $dp_options['header_video_catch_font_size_sp_type3'] ); ?>" class="tiny-text"> px</label></p>
            <p><label for="header_video_catch_color_sp"><?php _e( 'Font color', 'tcd-w' ); ?></label> <input type="text" class="c-color-picker" name="dp_options[header_video_catch_color_sp]" value="<?php echo esc_attr( $dp_options['header_video_catch_color_sp'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['header_video_catch_color_sp'] ); ?>"></p>
          </div>

          <div class="header_video_content_type_mobile_type2 header_video_content_type_mobile_type3" style="<?php if ( 'type1' === $dp_options['header_video_content_type_mobile'] ) { echo 'display: none'; } ?>">
  	        <h6 class="theme_option_headline2"><?php _e( 'Color overlay on the background', 'tcd-w' ); ?></h6>
            <p><?php _e( 'Use overlay, to become easy to read the catchphrase on the background. Please set color of overlay.', 'tcd-w' ); ?></p>
            <input type="text" class="header_video_overlay_sp c-color-picker" name="dp_options[header_video_overlay_sp]" value="<?php echo esc_attr( $dp_options['header_video_overlay_sp'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['header_video_overlay_sp'] ); ?>">
  	        <h6 class="theme_option_headline2"><?php _e( 'Opacity of the overlay on the background', 'tcd-w' ); ?></h6>
            <p><?php _e( 'Please set opacity of overlay. If you do not want to display the overlay, enter "0"', 'tcd-w' ); ?></p>
            <input type="number" min="0" max="1" step="0.1" name="dp_options[header_video_overlay_opacity_sp]" value="<?php echo esc_attr( $dp_options['header_video_overlay_opacity_sp'] ); ?>" class="tiny-text header_video_overlay_opacity_sp">
          </div>

		      <input type="submit" class="button-ml ajax_button" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
        </div>
      </div>
		  <input type="submit" class="button-ml ajax_button" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
    </div>
  </div>

  <?php // Contents settings after the header content ?>
	<div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e( 'Contents settings after the header content', 'tcd-w' ); ?></h3>
    <p><?php _e( 'Please set the content to be displayed directly under the header content.', 'tcd-w' ); ?></p>
    <p><label><input type="checkbox" name="dp_options[display_index_content01]" value="1" <?php checked( 1, $dp_options['display_index_content01'] ); ?>> <?php _e( 'Display this content', 'tcd-w' ); ?></label></p>
    <h4 class="theme_option_headline2"><?php _e( 'Catchphrase', 'tcd-w' ); ?></h4>
    <textarea class="large-text" name="dp_options[index_content01_catch]"><?php echo esc_textarea( $dp_options['index_content01_catch'] ); ?></textarea>
    <p><label><?php _e( 'Font size', 'tcd-w' ); ?> <input type="number" min="1" step="1" name="dp_options[index_content01_catch_font_size]" value="<?php echo esc_attr( $dp_options['index_content01_catch_font_size'] ); ?>" class="tiny-text"> px</label></p>
    <p><label><?php _e( 'Font size for mobile', 'tcd-w' ); ?> <input type="number" min="1" step="1" name="dp_options[index_content01_catch_font_size_sp]" value="<?php echo esc_attr( $dp_options['index_content01_catch_font_size_sp'] ); ?>" class="tiny-text"> px</label></p>
    <input type="text" class="c-color-picker" name="dp_options[index_content01_catch_color]" value="<?php echo esc_attr( $dp_options['index_content01_catch_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['index_content01_catch_color'] ); ?>">
    <h4 class="theme_option_headline2"><?php _e( 'Description', 'tcd-w' ); ?></h4>
    <textarea class="large-text" name="dp_options[index_content01_desc]"><?php echo esc_textarea( $dp_options['index_content01_desc'] ); ?></textarea>
    <p><label><?php _e( 'Font size', 'tcd-w' ); ?> <input type="number" min="1" step="1" name="dp_options[index_content01_desc_font_size]" value="<?php echo esc_attr( $dp_options['index_content01_desc_font_size'] ); ?>" class="tiny-text"> px</label></p>
    <p><label><?php _e( 'Font size for mobile', 'tcd-w' ); ?> <input type="number" min="1" step="1" name="dp_options[index_content01_desc_font_size_sp]" value="<?php echo esc_attr( $dp_options['index_content01_desc_font_size_sp'] ); ?>" class="tiny-text"> px</label></p>
    <input type="text" class="c-color-picker" name="dp_options[index_content01_desc_color]" value="<?php echo esc_attr( $dp_options['index_content01_desc_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['index_content01_desc_color'] ); ?>">
    <h4 class="theme_option_headline2"><?php _e( 'Three boxes', 'tcd-w' ); ?></h4>
      <p><?php _e( 'Display three content boxes horizontally.', 'tcd-w' ); ?></p>
    <?php for ( $i = 1; $i <= 3; $i++ ) : ?>
		<div class="sub_box cf">
      <h5 class="theme_option_subbox_headline"><?php _e( 'Item', 'tcd-w' ); ?><?php echo $i; ?></h5>
    	<div class="sub_box_content">
        <h6 class="theme_option_headline2"><?php _e( 'Title', 'tcd-w' ); ?></h6>
        <p><?php _e( 'Please set the title to be at the top of the box.', 'tcd-w' ); ?></p>
        <input type="text" class="regular-text" name="dp_options[index_content01_box_title<?php echo $i; ?>]" value="<?php echo esc_attr( $dp_options['index_content01_box_title' . $i] ); ?>">
        <h6 class="theme_option_headline2"><?php _e( 'Sub title', 'tcd-w' ); ?></h6>
        <p><?php _e( 'Please set the sub title to at the top of the box.', 'tcd-w' ); ?></p>
        <input type="text" class="regular-text" name="dp_options[index_content01_box_sub<?php echo $i; ?>]" value="<?php echo esc_attr( $dp_options['index_content01_box_sub' . $i] ); ?>">
        <h6 class="theme_option_headline2"><?php _e( 'Description', 'tcd-w' ); ?></h6>
        <p><?php _e( 'Please set a description to be displayed when hovering in the box.', 'tcd-w' ); ?></p>
        <textarea name="dp_options[index_content01_box_desc<?php echo $i; ?>]" class="large-text"><?php echo esc_textarea( $dp_options['index_content01_box_desc' . $i] ); ?></textarea>
        <h6 class="theme_option_headline2"><?php _e( 'Image', 'tcd-w' ); ?></h6>
        <p><?php _e( 'Recommended image size. Width: 800px, Height: 1085px', 'tcd-w' ); ?></p>
        <div class="image_box cf">
          <div class="cf cf_media_field hide-if-no-js index_content01_box_img<?php echo $i ?>">
        		<input type="hidden" value="<?php echo esc_attr( $dp_options['index_content01_box_img' . $i] ); ?>" id="index_content01_box_img<?php echo $i ?>" name="dp_options[index_content01_box_img<?php echo $i ?>]" class="cf_media_id">
        		<div class="preview_field"><?php if ( $dp_options['index_content01_box_img' . $i] ) { echo wp_get_attachment_image( $dp_options['index_content01_box_img' . $i], 'medium' ); } ?></div>
        		<div class="button_area">
        			<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
        			<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $dp_options['index_content01_box_img' . $i] ) { echo 'hidden'; } ?>">
        		</div>
        	</div>
        </div>
        <h6 class="theme_option_headline2"><?php _e( 'Color overlay on the background image', 'tcd-w' ); ?></h6>
        <p><?php _e( 'Please set the title to be at the top of the box.', 'tcd-w' ); ?></p>
        <input type="text" class="c-color-picker" name="dp_options[index_content01_box_overlay<?php echo $i; ?>]" value="<?php echo esc_attr( $dp_options['index_content01_box_overlay' . $i] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['index_content01_box_overlay' . $i] ); ?>">
        <h6 class="theme_option_headline2"><?php _e( 'Opacity of the overlay on the background image', 'tcd-w' ); ?></h6>
        <p><?php _e( 'Please set opacity of overlay. If you do not want to display the overlay, enter "0"', 'tcd-w' ); ?></p>
        <input type="number" class="tiny-text" min="0" max="1" step="0.1" name="dp_options[index_content01_box_overlay_opacity<?php echo $i; ?>]" value="<?php echo esc_attr( $dp_options['index_content01_box_overlay_opacity' . $i] ); ?>">
        <h6 class="theme_option_headline2"><?php _e( 'Link URL', 'tcd-w' ); ?></h6>
        <p><input type="text" name="dp_options[index_content01_box_url<?php echo $i; ?>]" value="<?php echo esc_attr( $dp_options['index_content01_box_url' . $i] ); ?>" class="regular-text"></p>
        <p><label><input type="checkbox" name="dp_options[index_content01_box_target<?php echo $i; ?>]" value="1" <?php checked( 1, $dp_options['index_content01_box_target' . $i] ); ?>> <?php _e( 'Open with new window', 'tcd-w' ); ?></label></p>
      </div>
    </div>
    <?php endfor; ?>

    <p><?php _e( 'Font size of title', 'tcd-w' ); ?> <input type="number" min="1" step="1" name="dp_options[index_content01_box_title_font_size]" value="<?php echo esc_attr( $dp_options['index_content01_box_title_font_size'] ); ?>" class="tiny-text"> px</p>
    <p><?php _e( 'Font size of title (mobile)', 'tcd-w' ); ?> <input type="number" min="1" step="1" name="dp_options[index_content01_box_title_font_size_sp]" value="<?php echo esc_attr( $dp_options['index_content01_box_title_font_size_sp'] ); ?>" class="tiny-text"> px</p>
    <p>
      <label for="index_content01_box_title_color"><?php _e( 'Font color of title', 'tcd-w' ); ?></label>
      <input type="text" name="dp_options[index_content01_box_title_color]" value="<?php echo esc_attr( $dp_options['index_content01_box_title_color'] ); ?>" class="c-color-picker" data-default-color="<?php echo esc_attr( $dp_default_options['index_content01_box_title_color'] ); ?>">
    </p>
    <p>
      <label for="index_content01_box_sub_color"><?php _e( 'Font color of sub title', 'tcd-w' ); ?></label>
      <input type="text" name="dp_options[index_content01_box_sub_color]" value="<?php echo esc_attr( $dp_options['index_content01_box_sub_color'] ); ?>" class="c-color-picker" data-default-color="<?php echo esc_attr( $dp_default_options['index_content01_box_sub_color'] ); ?>">
    </p>

    <h4 class="theme_option_headline2"><?php _e( 'Button', 'tcd-w' ); ?></h4>
    <p><?php _e( 'Set the button to be displayed at the bottom.', 'tcd-w' ); ?></p>
    <p><?php _e( 'Button label', 'tcd-w' ); ?> <input type="text" class="regular-text" name="dp_options[index_content01_btn_label]" value="<?php echo esc_attr( $dp_options['index_content01_btn_label'] ); ?>"></p>
    <p><?php _e( 'Link URL', 'tcd-w' ); ?> <input type="text" class="regular-text" name="dp_options[index_content01_btn_url]" value="<?php echo esc_attr( $dp_options['index_content01_btn_url'] ); ?>"></p>
    <p><label><input type="checkbox" name="dp_options[index_content01_btn_target]" value="1" <?php checked( 1, $dp_options['index_content01_btn_target'] ); ?>> <?php _e( 'Open with new window', 'tcd-w' ); ?></label></p>
    <p>
      <label for="index_content01_btn_color"><?php _e( 'Font color', 'tcd-w' ); ?></label>
      <input type="text" class="c-color-picker" name="dp_options[index_content01_btn_color]" value="<?php echo esc_attr( $dp_options['index_content01_btn_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['index_content01_btn_color'] ); ?>" id="index_content01_btn_color">
    </p>
    <p>
      <label for="index_content01_btn_bg"><?php _e( 'Background color', 'tcd-w' ); ?></label>
      <input type="text" class="c-color-picker" name="dp_options[index_content01_btn_bg]" value="<?php echo esc_attr( $dp_options['index_content01_btn_bg'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['index_content01_btn_bg'] ); ?>" id="index_content01_btn_bg">
    </p>
    <p>
      <label for="index_content01_btn_color_hover"><?php _e( 'Font color on hover', 'tcd-w' ); ?></label>
      <input type="text" class="c-color-picker" name="dp_options[index_content01_btn_color_hover]" value="<?php echo esc_attr( $dp_options['index_content01_btn_color_hover'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['index_content01_btn_color_hover'] ); ?>" id="index_content01_btn_color_hover">
    </p>
    <p>
      <label for="index_content01_btn_bg_hover"><?php _e( 'Background color on hover', 'tcd-w' ); ?></label>
      <input type="text" class="c-color-picker" name="dp_options[index_content01_btn_bg_hover]" value="<?php echo esc_attr( $dp_options['index_content01_btn_bg_hover'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['index_content01_btn_bg_hover'] ); ?>" id="index_content01_btn_bg_hover">
    </p>
	  <input type="submit" class="button-ml ajax_button" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
  </div>

  <?php // Contents Builder ?>
	<div class="theme_option_field cf">
  	<h3 class="theme_option_headline"><?php _e( 'Main content', 'tcd-w' ); ?></h3>
    <p><?php _e( 'You can change order by dragging each headline of option field.', 'tcd-w' ); ?></p>

    <div class="sortable">

      <?php foreach ( $dp_options['index_contents_order'] as $order ) : ?>

      <?php if ( 'news' === $order ) : ?>
		  <div class="sub_box cf">
      	<h3 class="theme_option_subbox_headline"><?php _e( 'News', 'tcd-w' ); ?></h3>
      	<div class="sub_box_content">
          <p><?php _e( 'This is posts list of news. You can select any category and display it in tab style.', 'tcd-w' ); ?></p>
          <input type="hidden" name="dp_options[index_contents_order][]" value="news">
          <p><label><input type="checkbox" name="dp_options[display_index_news]" value="1" <?php checked( 1, $dp_options['display_index_news'] ); ?>> <?php _e( 'Display this content', 'tcd-w' ); ?></label></p>
      		<h4 class="theme_option_headline2"><?php _e( 'Title', 'tcd-w' ); ?></h4>
          <p><?php _e( 'Please set the title.', 'tcd-w' ); ?></p>
          <p><input type="text" name="dp_options[index_news_title]" value="<?php echo esc_attr( $dp_options['index_news_title'] ); ?>" class="regular-text"></p>
          <p><label><?php _e( 'Font size', 'tcd-w' ); ?> <input type="number" min="1" step="1" name="dp_options[index_news_title_font_size]" value="<?php echo esc_attr( $dp_options['index_news_title_font_size'] ); ?>" class="tiny-text"> px</p>
          <p><label><?php _e( 'Font size for mobile', 'tcd-w' ); ?> <input type="number" min="1" step="1" name="dp_options[index_news_title_font_size_sp]" value="<?php echo esc_attr( $dp_options['index_news_title_font_size_sp'] ); ?>" class="tiny-text"> px</p>
          <input type="text" class="c-color-picker" name="dp_options[index_news_title_color]" data-default-color="<?php echo esc_attr( $dp_default_options['index_news_title_color'] ); ?>" value="<?php echo esc_attr( $dp_options['index_news_title_color'] ); ?>">
      		<h4 class="theme_option_headline2"><?php _e( 'Sub title', 'tcd-w' ); ?></h4>
          <p><?php _e( 'Please set the sub title.', 'tcd-w' ); ?></p>
          <p><input type="text" name="dp_options[index_news_sub]" value="<?php echo esc_attr( $dp_options['index_news_sub'] ); ?>" class="regular-text"></p>
          <input type="text" class="c-color-picker" name="dp_options[index_news_sub_color]" data-default-color="<?php echo esc_attr( $dp_default_options['index_news_sub_color'] ); ?>" value="<?php echo esc_attr( $dp_options['index_news_sub_color'] ); ?>">
      		<h4 class="theme_option_headline2"><?php _e( 'Description', 'tcd-w' ); ?></h4>
          <p><?php _e( 'Please set the description.', 'tcd-w' ); ?></p>
          <p><textarea class="large-text" name="dp_options[index_news_desc]"><?php echo esc_textarea( $dp_options['index_news_desc'] ); ?></textarea></p>
          <p><label><?php _e( 'Font size', 'tcd-w' ); ?> <input type="number" min="1" step="1" name="dp_options[index_news_desc_font_size]" value="<?php echo esc_attr( $dp_options['index_news_desc_font_size'] ); ?>" class="tiny-text"> px</p>
          <p><label><?php _e( 'Font size for mobile', 'tcd-w' ); ?> <input type="number" min="1" step="1" name="dp_options[index_news_desc_font_size_sp]" value="<?php echo esc_attr( $dp_options['index_news_desc_font_size_sp'] ); ?>" class="tiny-text"> px</p>
          <input type="text" class="c-color-picker" name="dp_options[index_news_desc_color]" data-default-color="<?php echo esc_attr( $dp_default_options['index_news_desc_color'] ); ?>" value="<?php echo esc_attr( $dp_options['index_news_desc_color'] ); ?>">
          <h4 class="theme_option_headline2"><?php _e( 'Tab settings', 'tcd-w' ); ?></h4>
          <p><?php _e( 'Please select the category to display on the tab. If not selected, the tab is not displayed.', 'tcd-w' ); ?></p>
          <?php for ( $i = 1; $i <= 4; $i++ ) : ?>
          <select name="dp_options[index_news_tab_cat<?php echo $i; ?>]">

            <option value="0"><?php printf( __( '— Select tab %d —', 'tcd-w' ), $i ); ?></option>

            <?php foreach ( $news_categories as $cat ) : ?>
            <option value="<?php echo esc_attr( $cat->term_id ); ?>" <?php selected( $cat->term_id, $dp_options['index_news_tab_cat' . $i] ); ?>>
                <?php echo esc_html( $cat->name ); ?>
              </option>
            <?php endforeach; ?>

          </select>
          <?php endfor; ?>
      		<h4 class="theme_option_headline2"><?php _e( 'Number of posts to display', 'tcd-w' ); ?></h4>
          <p><?php _e( 'Set the number of displayed posts.', 'tcd-w' ); ?></p>
          <p><input type="number" class="tiny-text" min="1" step="1" name="dp_options[index_news_num]" value="<?php echo esc_attr( $dp_options['index_news_num'] ); ?>"> <?php _e( ' posts', 'tcd-w' ); ?></p>
          <h4 class="theme_option_headline2"><?php _e( 'Button', 'tcd-w' ); ?></h4>
          <p><?php _e( 'Set the archive page button to be displayed at the bottom.', 'tcd-w' ); ?></p>
          <p>
            <label for="index_news_btn_color"><?php _e( 'Font color', 'tcd-w' ); ?></label>
            <input type="text" class="c-color-picker" name="dp_options[index_news_btn_color]" value="<?php echo esc_attr( $dp_options['index_news_btn_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['index_news_btn_color'] ); ?>" id="index_news_btn_color">
          </p>
          <p>
            <label for="index_news_btn_bg"><?php _e( 'Background color', 'tcd-w' ); ?></label>
            <input type="text" class="c-color-picker" name="dp_options[index_news_btn_bg]" value="<?php echo esc_attr( $dp_options['index_news_btn_bg'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['index_news_btn_bg'] ); ?>" id="index_news_btn_bg">
          </p>
          <p>
            <label for="index_news_btn_color_hover"><?php _e( 'Font color on hover', 'tcd-w' ); ?></label>
            <input type="text" class="c-color-picker" name="dp_options[index_news_btn_color_hover]" value="<?php echo esc_attr( $dp_options['index_news_btn_color_hover'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['index_news_btn_color_hover'] ); ?>" id="index_news_btn_color_hover">
          </p>
          <p>
            <label for="index_news_btn_bg_hover"><?php _e( 'Background color on hover', 'tcd-w' ); ?></label>
            <input type="text" class="c-color-picker" name="dp_options[index_news_btn_bg_hover]" value="<?php echo esc_attr( $dp_options['index_news_btn_bg_hover'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['index_news_btn_bg_hover'] ); ?>" id="index_news_btn_bg_hover">
          </p>
		  		<input type="submit" class="button-ml ajax_button" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
		  	</div>
		  </div><!-- .sub_box END -->

      <?php elseif ( 'service' === $order ) : ?>
		  <div class="sub_box cf">
      	<h3 class="theme_option_subbox_headline"><?php _e( 'Service', 'tcd-w' ); ?></h3>
      	<div class="sub_box_content">
          <p><?php _e( 'Display three content boxes horizontally.', 'tcd-w' ); ?></p>
          <input type="hidden" name="dp_options[index_contents_order][]" value="service">
          <p><label><input type="checkbox" name="dp_options[display_index_service]" value="1" <?php checked( 1, $dp_options['display_index_service'] ); ?>> <?php _e( 'Display this content', 'tcd-w' ); ?></label></p>
      		<h4 class="theme_option_headline2"><?php _e( 'Background color', 'tcd-w' ); ?></h4>
          <p><?php _e( 'Set the background color of contents.', 'tcd-w' ); ?></p>
          <input type="text" class="c-color-picker" name="dp_options[index_service_bg]" data-default-color="<?php echo esc_attr( $dp_default_options['index_service_bg'] ); ?>" value="<?php echo esc_attr( $dp_options['index_service_bg'] ); ?>">
      		<h4 class="theme_option_headline2"><?php _e( 'Title', 'tcd-w' ); ?></h4>
          <p><?php _e( 'Please set the title.', 'tcd-w' ); ?></p>
          <p><input type="text" name="dp_options[index_service_title]" value="<?php echo esc_attr( $dp_options['index_service_title'] ); ?>" class="regular-text"></p>
          <p><label><?php _e( 'Font size', 'tcd-w' ); ?> <input type="number" min="1" step="1" name="dp_options[index_service_title_font_size]" value="<?php echo esc_attr( $dp_options['index_service_title_font_size'] ); ?>" class="tiny-text"> px</p>
          <p><label><?php _e( 'Font size for mobile', 'tcd-w' ); ?> <input type="number" min="1" step="1" name="dp_options[index_service_title_font_size_sp]" value="<?php echo esc_attr( $dp_options['index_service_title_font_size_sp'] ); ?>" class="tiny-text"> px</p>
          <input type="text" class="c-color-picker" name="dp_options[index_service_title_color]" data-default-color="<?php echo esc_attr( $dp_default_options['index_service_title_color'] ); ?>" value="<?php echo esc_attr( $dp_options['index_service_title_color'] ); ?>">
      		<h4 class="theme_option_headline2"><?php _e( 'Sub title', 'tcd-w' ); ?></h4>
          <p><?php _e( 'Please set the sub title.', 'tcd-w' ); ?></p>
          <p><input type="text" name="dp_options[index_service_sub]" value="<?php echo esc_attr( $dp_options['index_service_sub'] ); ?>" class="regular-text"></p>
          <input type="text" class="c-color-picker" name="dp_options[index_service_sub_color]" data-default-color="<?php echo esc_attr( $dp_default_options['index_service_sub_color'] ); ?>" value="<?php echo esc_attr( $dp_options['index_service_sub_color'] ); ?>">
      		<h4 class="theme_option_headline2"><?php _e( 'Description', 'tcd-w' ); ?></h4>
          <p><?php _e( 'Please set the description.', 'tcd-w' ); ?></p>
          <p><textarea class="large-text" name="dp_options[index_service_desc]"><?php echo esc_textarea( $dp_options['index_service_desc'] ); ?></textarea></p>
          <p><label><?php _e( 'Font size', 'tcd-w' ); ?> <input type="number" min="1" step="1" name="dp_options[index_service_desc_font_size]" value="<?php echo esc_attr( $dp_options['index_service_desc_font_size'] ); ?>" class="tiny-text"> px</p>
          <p><label><?php _e( 'Font size for mobile', 'tcd-w' ); ?> <input type="number" min="1" step="1" name="dp_options[index_service_desc_font_size_sp]" value="<?php echo esc_attr( $dp_options['index_service_desc_font_size_sp'] ); ?>" class="tiny-text"> px</p>
          <input type="text" class="c-color-picker" name="dp_options[index_service_desc_color]" data-default-color="<?php echo esc_attr( $dp_default_options['index_service_desc_color'] ); ?>" value="<?php echo esc_attr( $dp_options['index_service_desc_color'] ); ?>">
          <h4 class="theme_option_headline2"><?php _e( 'Three boxes', 'tcd-w' ); ?></h4>
          <?php for ( $i = 1; $i <= 3; $i++ ) : ?>
		      <div class="sub_box cf">
            <h5 class="theme_option_subbox_headline"><?php _e( 'Item', 'tcd-w' ); ?><?php echo $i; ?></h5>
          	<div class="sub_box_content">
              <h6 class="theme_option_headline2"><?php _e( 'Title', 'tcd-w' ); ?></h6>
              <p><?php _e( 'Please set the title to be at the top of the box.', 'tcd-w' ); ?></p>
              <input type="text" class="regular-text" name="dp_options[index_service_box_title<?php echo $i; ?>]" value="<?php echo esc_attr( $dp_options['index_service_box_title' . $i] ); ?>">
              <h6 class="theme_option_headline2"><?php _e( 'Sub title', 'tcd-w' ); ?></h6>
              <p><?php _e( 'Please set the sub title to at the top of the box.', 'tcd-w' ); ?></p>
              <input type="text" class="regular-text" name="dp_options[index_service_box_sub<?php echo $i; ?>]" value="<?php echo esc_attr( $dp_options['index_service_box_sub' . $i] ); ?>">
              <h6 class="theme_option_headline2"><?php _e( 'Description', 'tcd-w' ); ?></h6>
              <p><?php _e( 'Please set a description to be displayed when hovering in the box.', 'tcd-w' ); ?></p>
              <textarea name="dp_options[index_service_box_desc<?php echo $i; ?>]" class="large-text"><?php echo esc_textarea( $dp_options['index_service_box_desc' . $i] ); ?></textarea>
              <h6 class="theme_option_headline2"><?php _e( 'Image', 'tcd-w' ); ?></h6>
              <p><?php _e( 'Recommended image size. Width: 800px, Height: 1085px', 'tcd-w' ); ?></p>
              <div class="image_box cf">
                <div class="cf cf_media_field hide-if-no-js index_service_box_img<?php echo $i ?>">
              		<input type="hidden" value="<?php echo esc_attr( $dp_options['index_service_box_img' . $i] ); ?>" id="index_service_box_img<?php echo $i ?>" name="dp_options[index_service_box_img<?php echo $i ?>]" class="cf_media_id">
              		<div class="preview_field"><?php if ( $dp_options['index_service_box_img' . $i] ) { echo wp_get_attachment_image( $dp_options['index_service_box_img' . $i], 'medium' ); } ?></div>
              		<div class="button_area">
              			<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
              			<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $dp_options['index_service_box_img' . $i] ) { echo 'hidden'; } ?>">
              		</div>
              	</div>
              </div>
              <h6 class="theme_option_headline2"><?php _e( 'Color overlay on the background image', 'tcd-w' ); ?></h6>
              <p><?php _e( 'Please set the overlay color when hovering in the box.', 'tcd-w' ); ?></p>
              <input type="text" class="c-color-picker" name="dp_options[index_service_box_overlay<?php echo $i; ?>]" value="<?php echo esc_attr( $dp_options['index_service_box_overlay' . $i] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['index_service_box_overlay' . $i] ); ?>">
              <h6 class="theme_option_headline2"><?php _e( 'Opacity of the overlay on the background image', 'tcd-w' ); ?></h6>
              <p><?php _e( 'Please set opacity of overlay. If you do not want to display the overlay, enter "0"', 'tcd-w' ); ?></p>
              <input type="number" class="tiny-text" min="0" max="1" step="0.1" name="dp_options[index_service_box_overlay_opacity<?php echo $i; ?>]" value="<?php echo esc_attr( $dp_options['index_service_box_overlay_opacity' . $i] ); ?>">
              <h6 class="theme_option_headline2"><?php _e( 'Link URL', 'tcd-w' ); ?></h6>
              <p><input type="text" name="dp_options[index_service_box_url<?php echo $i; ?>]" value="<?php echo esc_attr( $dp_options['index_service_box_url' . $i] ); ?>" class="regular-text"></p>
              <p><label><input type="checkbox" name="dp_options[index_service_box_target<?php echo $i; ?>]" value="1" <?php checked( 1, $dp_options['index_service_box_target' . $i] ); ?>> <?php _e( 'Open with new window', 'tcd-w' ); ?></label></p>
            </div>
          </div>
          <?php endfor; ?>
          <p><?php _e( 'Font size of title', 'tcd-w' ); ?> <input type="number" min="1" step="1" name="dp_options[index_service_box_title_font_size]" value="<?php echo esc_attr( $dp_options['index_service_box_title_font_size'] ); ?>" class="tiny-text"> px</p>
          <p><?php _e( 'Font size of title (mobile)', 'tcd-w' ); ?> <input type="number" min="1" step="1" name="dp_options[index_service_box_title_font_size_sp]" value="<?php echo esc_attr( $dp_options['index_service_box_title_font_size_sp'] ); ?>" class="tiny-text"> px</p>
          <p>
            <label for="index_service_box_title_color"><?php _e( 'Font color of title', 'tcd-w' ); ?></label>
            <input type="text" name="dp_options[index_service_box_title_color]" value="<?php echo esc_attr( $dp_options['index_service_box_title_color'] ); ?>" class="c-color-picker" data-default-color="<?php echo esc_attr( $dp_default_options['index_service_box_title_color'] ); ?>">
          </p>
          <p>
            <label for="index_service_box_sub_color"><?php _e( 'Font color of sub title', 'tcd-w' ); ?></label>
            <input type="text" name="dp_options[index_service_box_sub_color]" value="<?php echo esc_attr( $dp_options['index_service_box_sub_color'] ); ?>" class="c-color-picker" data-default-color="<?php echo esc_attr( $dp_default_options['index_service_box_sub_color'] ); ?>">
          </p>

          <h4 class="theme_option_headline2"><?php _e( 'Button', 'tcd-w' ); ?></h4>
          <p><?php _e( 'Set the button to be displayed at the bottom.', 'tcd-w' ); ?></p>
          <p><?php _e( 'Button label', 'tcd-w' ); ?> <input type="text" class="regular-text" name="dp_options[index_service_btn_label]" value="<?php echo esc_attr( $dp_options['index_service_btn_label'] ); ?>"></p>
          <p><?php _e( 'Link URL', 'tcd-w' ); ?> <input type="text" class="regular-text" name="dp_options[index_service_btn_url]" value="<?php echo esc_attr( $dp_options['index_service_btn_url'] ); ?>"></p>
          <p><label><input type="checkbox" name="dp_options[index_service_btn_target]" value="1" <?php checked( 1, $dp_options['index_service_btn_target'] ); ?>> <?php _e( 'Open with new window', 'tcd-w' ); ?></label></p>
          <p>
            <label for="index_service_btn_color"><?php _e( 'Font color', 'tcd-w' ); ?></label>
            <input type="text" class="c-color-picker" name="dp_options[index_service_btn_color]" value="<?php echo esc_attr( $dp_options['index_service_btn_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['index_service_btn_color'] ); ?>" id="index_service_btn_color">
          </p>
          <p>
            <label for="index_service_btn_bg"><?php _e( 'Background color', 'tcd-w' ); ?></label>
            <input type="text" class="c-color-picker" name="dp_options[index_service_btn_bg]" value="<?php echo esc_attr( $dp_options['index_service_btn_bg'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['index_service_btn_bg'] ); ?>" id="index_service_btn_bg">
          </p>
          <p>
            <label for="index_service_btn_color_hover"><?php _e( 'Font color on hover', 'tcd-w' ); ?></label>
            <input type="text" class="c-color-picker" name="dp_options[index_service_btn_color_hover]" value="<?php echo esc_attr( $dp_options['index_service_btn_color_hover'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['index_service_btn_color_hover'] ); ?>" id="index_service_btn_color_hover">
          </p>
          <p>
            <label for="index_service_btn_bg_hover"><?php _e( 'Background color on hover', 'tcd-w' ); ?></label>
            <input type="text" class="c-color-picker" name="dp_options[index_service_btn_bg_hover]" value="<?php echo esc_attr( $dp_options['index_service_btn_bg_hover'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['index_service_btn_bg_hover'] ); ?>" id="index_service_btn_bg_hover">
          </p>
		  		<input type="submit" class="button-ml ajax_button" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
		  	</div>
		  </div><!-- .sub_box END -->

      <?php elseif ( 'banner' === $order ) : ?>
		  <div class="sub_box cf">
      	<h3 class="theme_option_subbox_headline"><?php _e( 'Banner', 'tcd-w' ); ?></h3>
      	<div class="sub_box_content">
          <p><?php _e( 'Display three sets of two banners horizontally.', 'tcd-w' ); ?></p>
          <input type="hidden" name="dp_options[index_contents_order][]" value="banner">
          <p><label><input type="checkbox" name="dp_options[display_index_banner]" value="1" <?php checked( 1, $dp_options['display_index_banner'] ); ?>> <?php _e( 'Display this content', 'tcd-w' ); ?></label></p>
      		<h4 class="theme_option_headline2"><?php _e( 'Banner settings', 'tcd-w' ); ?></h4>
          <?php for ( $i = 1; $i <= 6; $i++ ) : ?>
		      <div class="sub_box cf">
            <h5 class="theme_option_subbox_headline"><?php _e( 'Banner', 'tcd-w' ); ?><?php echo $i; ?></h5>
          	<div class="sub_box_content">
              <h6 class="theme_option_headline2"><?php _e( 'Title', 'tcd-w' ); ?></h6>
              <p><?php _e( 'Please set the title displayed on the banner.', 'tcd-w' ); ?></p>
              <p><input type="text" class="regular-text" name="dp_options[index_banner_title<?php echo $i; ?>]" value="<?php echo esc_attr( $dp_options['index_banner_title' . $i] ); ?>"></p>
              <p><input type="text" class="c-color-picker" name="dp_options[index_banner_title_color<?php echo $i; ?>]" value="<?php echo esc_attr( $dp_options['index_banner_title_color' . $i] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['index_banner_title_color' . $i] ); ?>"></p>
              <h6 class="theme_option_headline2"><?php _e( 'Sub title', 'tcd-w' ); ?></h6>
              <p><?php _e( 'Please set the sub title displayed on the banner.', 'tcd-w' ); ?></p>
              <p><input type="text" class="regular-text" name="dp_options[index_banner_sub<?php echo $i; ?>]" value="<?php echo esc_attr( $dp_options['index_banner_sub' . $i] ); ?>"></p>
              <p><input type="text" class="c-color-picker" name="dp_options[index_banner_sub_color<?php echo $i; ?>]" value="<?php echo esc_attr( $dp_options['index_banner_sub_color' . $i] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['index_banner_sub_color' . $i] ); ?>"></p>
              <h6 class="theme_option_headline2"><?php _e( 'Description', 'tcd-w' ); ?></h6>
              <p><?php _e( 'Please set a description to displayed under the banner.', 'tcd-w' ); ?></p>
              <textarea class="large-text" name="dp_options[index_banner_desc<?php echo $i; ?>]"><?php echo esc_textarea( $dp_options['index_banner_desc' . $i] ); ?></textarea>
              <p><input type="text" class="c-color-picker" name="dp_options[index_banner_desc_color<?php echo $i; ?>]" value="<?php echo esc_attr( $dp_options['index_banner_desc_color' . $i] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['index_banner_desc_color' . $i] ); ?>"></p>
              <h6 class="theme_option_headline2"><?php _e( 'Background image', 'tcd-w' ); ?></h6>
              <p><?php _e( 'Recommended size: width:570px, height:150px', 'tcd-w' ); ?></p>
      		    <div class="image_box cf">
      		    	<div class="cf cf_media_field hide-if-no-js">
      		    		<input type="hidden" value="<?php echo esc_attr( $dp_options['index_banner_img' . $i] ); ?>" id="index_banner_img<?php echo $i; ?>" name="dp_options[index_banner_img<?php echo $i; ?>]" class="cf_media_id">
      		    		<div class="preview_field"><?php if ( $dp_options['index_banner_img' . $i] ) { echo wp_get_attachment_image( $dp_options['index_banner_img' . $i], 'medium' ); } ?></div>
      		    		<div class="button_area">
      		    			<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
      		    			<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $dp_options['index_banner_img' . $i] ) { echo 'hidden'; } ?>">
      		    		</div>
      		    	</div>
      		    </div>
              <h6 class="theme_option_headline2"><?php _e( 'Gradation overlay', 'tcd-w' ); ?></h6>
              <p><?php _e( 'Use gradation overlay, to make it easy to read the title.', 'tcd-w' ); ?></p>
              <p><label><input type="checkbox" name="dp_options[index_banner_display_overlay<?php echo $i; ?>]" value="1" <?php checked( 1, $dp_options['index_banner_display_overlay' . $i] ); ?>> <?php _e( 'Display gradation overlay', 'tcd-w' ); ?></label></p>
              <input type="text" class="c-color-picker" name="dp_options[index_banner_overlay<?php echo $i; ?>]" value="<?php echo esc_attr( $dp_options['index_banner_overlay' . $i] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['index_banner_overlay' . $i] ); ?>">
              <h6 class="theme_option_headline2"><?php _e( 'Link URL', 'tcd-w' ); ?></h6>
              <p><input type="text" name="dp_options[index_banner_url<?php echo $i; ?>]" value="<?php echo esc_attr( $dp_options['index_banner_url' . $i] ); ?>" class="regular-text"></p>
              <p><label><input type="checkbox" name="dp_options[index_banner_target<?php echo $i; ?>]" value="1" <?php checked( 1, $dp_options['index_banner_target' . $i] ); ?>> <?php _e( 'Open with new window', 'tcd-w' ); ?></label></p>
		  		    <input type="submit" class="button-ml ajax_button" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
            </div>
          </div>
          <?php endfor; ?>
		  		<input type="submit" class="button-ml ajax_button" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
		  	</div>
		  </div><!-- .sub_box END -->

      <?php elseif ( 'works' === $order ) : ?>
		  <div class="sub_box cf">
      	<h3 class="theme_option_subbox_headline"><?php _e( 'Works', 'tcd-w' ); ?></h3>
      	<div class="sub_box_content">
          <input type="hidden" name="dp_options[index_contents_order][]" value="works">
          <p><label><input type="checkbox" name="dp_options[display_index_works]" value="1" <?php checked( 1, $dp_options['display_index_works'] ); ?>> <?php _e( 'Display this content', 'tcd-w' ); ?></label></p>
      		<h4 class="theme_option_headline2"><?php _e( 'Title', 'tcd-w' ); ?></h4>
          <p><?php _e( 'Please set the title.', 'tcd-w' ); ?></p>
          <p><input type="text" name="dp_options[index_works_title]" value="<?php echo esc_attr( $dp_options['index_works_title'] ); ?>" class="regular-text"></p>
          <p><label><?php _e( 'Font size', 'tcd-w' ); ?> <input type="number" min="1" step="1" name="dp_options[index_works_title_font_size]" value="<?php echo esc_attr( $dp_options['index_works_title_font_size'] ); ?>" class="tiny-text"> px</p>
          <p><label><?php _e( 'Font size for mobile', 'tcd-w' ); ?> <input type="number" min="1" step="1" name="dp_options[index_works_title_font_size_sp]" value="<?php echo esc_attr( $dp_options['index_works_title_font_size_sp'] ); ?>" class="tiny-text"> px</p>
          <input type="text" class="c-color-picker" name="dp_options[index_works_title_color]" data-default-color="<?php echo esc_attr( $dp_default_options['index_works_title_color'] ); ?>" value="<?php echo esc_attr( $dp_options['index_works_title_color'] ); ?>">
      		<h4 class="theme_option_headline2"><?php _e( 'Sub title', 'tcd-w' ); ?></h4>
          <p><?php _e( 'Please set the sub title.', 'tcd-w' ); ?></p>
          <p><input type="text" name="dp_options[index_works_sub]" value="<?php echo esc_attr( $dp_options['index_works_sub'] ); ?>" class="regular-text"></p>
          <input type="text" class="c-color-picker" name="dp_options[index_works_sub_color]" data-default-color="<?php echo esc_attr( $dp_default_options['index_works_sub_color'] ); ?>" value="<?php echo esc_attr( $dp_options['index_works_sub_color'] ); ?>">
      		<h4 class="theme_option_headline2"><?php _e( 'Description', 'tcd-w' ); ?></h4>
          <p><?php _e( 'Please set the description.', 'tcd-w' ); ?></p>
          <p><textarea class="large-text" name="dp_options[index_works_desc]"><?php echo esc_textarea( $dp_options['index_works_desc'] ); ?></textarea></p>
          <p><label><?php _e( 'Font size', 'tcd-w' ); ?> <input type="number" min="1" step="1" name="dp_options[index_works_desc_font_size]" value="<?php echo esc_attr( $dp_options['index_works_desc_font_size'] ); ?>" class="tiny-text"> px</p>
          <p><label><?php _e( 'Font size for mobile', 'tcd-w' ); ?> <input type="number" min="1" step="1" name="dp_options[index_works_desc_font_size_sp]" value="<?php echo esc_attr( $dp_options['index_works_desc_font_size_sp'] ); ?>" class="tiny-text"> px</p>
          <input type="text" class="c-color-picker" name="dp_options[index_works_desc_color]" data-default-color="<?php echo esc_attr( $dp_default_options['index_works_desc_color'] ); ?>" value="<?php echo esc_attr( $dp_options['index_works_desc_color'] ); ?>">
      		<h4 class="theme_option_headline2"><?php _e( 'Number of posts to display', 'tcd-w' ); ?></h4>
          <p><?php _e( 'Set the number of displayed posts.', 'tcd-w' ); ?></p>
          <p><input type="number" class="tiny-text" min="1" step="1" name="dp_options[index_works_num]" value="<?php echo esc_attr( $dp_options['index_works_num'] ); ?>"> <?php _e( ' posts', 'tcd-w' ); ?></p>
          <h4 class="theme_option_headline2"><?php _e( 'Button', 'tcd-w' ); ?></h4>
          <p><?php _e( 'Set the archive page button to be displayed at the bottom.', 'tcd-w' ); ?></p>
          <p>
            <label for="index_works_btn_color"><?php _e( 'Font color', 'tcd-w' ); ?></label>
            <input type="text" class="c-color-picker" name="dp_options[index_works_btn_color]" value="<?php echo esc_attr( $dp_options['index_works_btn_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['index_works_btn_color'] ); ?>" id="index_works_btn_color">
          </p>
          <p>
            <label for="index_works_btn_bg"><?php _e( 'Background color', 'tcd-w' ); ?></label>
            <input type="text" class="c-color-picker" name="dp_options[index_works_btn_bg]" value="<?php echo esc_attr( $dp_options['index_works_btn_bg'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['index_works_btn_bg'] ); ?>" id="index_works_btn_bg">
          </p>
          <p>
            <label for="index_works_btn_color_hover"><?php _e( 'Font color on hover', 'tcd-w' ); ?></label>
            <input type="text" class="c-color-picker" name="dp_options[index_works_btn_color_hover]" value="<?php echo esc_attr( $dp_options['index_works_btn_color_hover'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['index_works_btn_color_hover'] ); ?>" id="index_works_btn_color_hover">
          </p>
          <p>
            <label for="index_works_btn_bg_hover"><?php _e( 'Background color on hover', 'tcd-w' ); ?></label>
            <input type="text" class="c-color-picker" name="dp_options[index_works_btn_bg_hover]" value="<?php echo esc_attr( $dp_options['index_works_btn_bg_hover'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['index_works_btn_bg_hover'] ); ?>" id="index_works_btn_bg_hover">
          </p>
		  		<input type="submit" class="button-ml ajax_button" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
		  	</div>
		  </div><!-- .sub_box END -->

      <?php
      elseif ( 'wysiwyg1' === $order || 'wysiwyg2' === $order || 'wysiwyg3' === $order ) :
        $key = mb_substr( $order, -1 );
      ?>
		  <div class="sub_box cf">
      	<h3 class="theme_option_subbox_headline"><?php _e( 'Wysiwyg contents', 'tcd-w' ); ?><?php echo esc_html( $key ); ?></h3>
      	<div class="sub_box_content">
          <p><?php _e( 'Please create content freely as you like blog posts.', 'tcd-w' ); ?></p>
          <input type="hidden" name="dp_options[index_contents_order][]" value="wysiwyg<?php echo esc_attr( $key ); ?>">
          <p><label><input type="checkbox" name="dp_options[display_index_wysiwyg<?php echo esc_attr( $key ); ?>]" value="1" <?php checked( 1, $dp_options['display_index_wysiwyg' . $key] ); ?>> <?php _e( 'Display this content', 'tcd-w' ); ?></label></p>
			    <?php
          wp_editor(
            $dp_options['index_wysiwyg_editor' . $key],
            'index_wysiwyg_editor' . $key,
            array(
              'textarea_name' => 'dp_options[index_wysiwyg_editor' . $key . ']',
              'textarea_rows' => 10
            )
          );
          ?>
		  		<input type="submit" class="button-ml ajax_button" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
		  	</div>
		  </div><!-- .sub_box END -->
      <?php endif; endforeach; ?>
		  <input type="submit" class="button-ml ajax_button" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
    </div>

  </div>
</div><!-- END #tab-content3 -->
<?php
}

function add_top_theme_options_validate( $input ) {
  global $dp_default_options, $header_content_type_options, $header_slider_animation_options, $header_slider_animation_time_options, $header_slider_img_animation_type_options, $slider_content_type_mobile_options;

  // Image slider
  for ( $i = 1; $i <= 5; $i++ ) {
	  $input['header_slider_img' . $i] = absint( $input['header_slider_img' . $i] );
    if ( ! isset( $input['header_slider_img_animation_type' . $i] ) ) $input['header_slider_img_animation_type' . $i] = null;
    if ( ! array_key_exists( $input['header_slider_img_animation_type' . $i], $header_slider_img_animation_type_options ) ) $input['header_slider_img_animation_type' . $i] = null;
    $input['header_slider_overlay' . $i] = sanitize_hex_color( $input['header_slider_overlay' . $i] );
    $input['header_slider_overlay_opacity' . $i] = sanitize_text_field( $input['header_slider_overlay_opacity' . $i] );
	  $input['header_slider_catch' . $i] = sanitize_textarea_field( $input['header_slider_catch' . $i] );
    if ( ! isset( $input['header_slider_catch_vertical' . $i] ) ) $input['header_slider_catch_vertical' . $i] = null;
	  $input['header_slider_catch_vertical' . $i] = ( $input['header_slider_catch_vertical' . $i] == 1 ? 1 : 0 );
	  $input['header_slider_catch_font_size' . $i] = absint( $input['header_slider_catch_font_size' . $i] );
	  $input['header_slider_catch_color' . $i] = sanitize_hex_color( $input['header_slider_catch_color' . $i] );
    $input['header_slider_btn_label' . $i] = sanitize_text_field( $input['header_slider_btn_label' . $i] );
    $input['header_slider_btn_url' . $i] = sanitize_text_field( $input['header_slider_btn_url' . $i] );
    if ( ! isset( $input['header_slider_btn_target' . $i] ) ) $input['header_slider_btn_target' . $i] = null;
	  $input['header_slider_btn_target' . $i] = ( $input['header_slider_btn_target' . $i] == 1 ? 1 : 0 );
	  $input['header_slider_btn_color' . $i] = sanitize_hex_color( $input['header_slider_btn_color' . $i] );
	  $input['header_slider_btn_bg' . $i] = sanitize_hex_color( $input['header_slider_btn_bg' . $i] );
	  $input['header_slider_btn_color_hover' . $i] = sanitize_hex_color( $input['header_slider_btn_color_hover' . $i] );
	  $input['header_slider_btn_bg_hover' . $i] = sanitize_hex_color( $input['header_slider_btn_bg_hover' . $i] );

	  $input['header_slider_img_sp' . $i] = absint( $input['header_slider_img_sp' . $i] );
	  $input['header_slider_catch_font_size_sp' . $i] = absint( $input['header_slider_catch_font_size_sp' . $i] );
    $input['header_slider_overlay_sp' . $i] = sanitize_hex_color( $input['header_slider_overlay_sp' . $i] );
    $input['header_slider_overlay_opacity_sp' . $i] = sanitize_text_field( $input['header_slider_overlay_opacity_sp' . $i] );
  }

  if ( ! isset( $input['header_slider_content_type_mobile'] ) ) $input['header_slider_content_type_mobile'] = null;
  if ( ! array_key_exists( $input['header_slider_content_type_mobile'], $slider_content_type_mobile_options ) ) $input['header_slider_content_type_mobile'] = null;
	$input['header_slider_logo'] = absint( $input['header_slider_logo'] );
	$input['header_slider_logo_width'] = absint( $input['header_slider_logo_width'] );
	$input['header_slider_catch_sp'] = sanitize_textarea_field( $input['header_slider_catch_sp'] );
	$input['header_slider_catch_font_size_sp'] = absint( $input['header_slider_catch_font_size_sp'] );
  if ( ! isset( $input['header_slider_catch_vertical_sp'] ) ) $input['header_slider_catch_vertical_sp'] = null;
	$input['header_slider_catch_vertical_sp'] = ( $input['header_slider_catch_vertical_sp'] == 1 ? 1 : 0 );
	$input['header_slider_catch_color_sp'] = sanitize_hex_color( $input['header_slider_catch_color_sp'] );

  if ( ! isset( $input['header_slider_animation_time'] ) ) $input['header_slider_animation_time'] = null;
  if ( ! array_key_exists( $input['header_slider_animation_time'], $header_slider_animation_time_options ) ) $input['header_slider_animation_time'] = null;

  // Video
	$input['header_video'] = absint( $input['header_video'] );
	$input['header_video_img'] = absint( $input['header_video_img'] );
	$input['header_video_catch'] = sanitize_textarea_field( $input['header_video_catch'] );
  if ( ! isset( $input['header_video_catch_vertical'] ) ) $input['header_video_catch_vertical'] = null;
	$input['header_video_catch_vertical'] = ( $input['header_video_catch_vertical'] == 1 ? 1 : 0 );
	$input['header_video_catch_font_size'] = absint( $input['header_video_catch_font_size'] );
	$input['header_video_catch_color'] = sanitize_hex_color( $input['header_video_catch_color'] );
  $input['header_video_btn_label'] = sanitize_text_field( $input['header_video_btn_label'] );
  $input['header_video_btn_url'] = sanitize_text_field( $input['header_video_btn_url'] );
  if ( ! isset( $input['header_video_btn_target'] ) ) $input['header_video_btn_target'] = null;
	$input['header_video_btn_target'] = ( $input['header_video_btn_target'] == 1 ? 1 : 0 );
	$input['header_video_btn_color'] = sanitize_hex_color( $input['header_video_btn_color'] );
	$input['header_video_btn_bg'] = sanitize_hex_color( $input['header_video_btn_bg'] );
	$input['header_video_btn_color_hover'] = sanitize_hex_color( $input['header_video_btn_color_hover'] );
	$input['header_video_btn_bg_hover'] = sanitize_hex_color( $input['header_video_btn_bg_hover'] );
  $input['header_video_overlay'] = sanitize_hex_color( $input['header_video_overlay'] );
  $input['header_video_overlay_opacity'] = sanitize_text_field( $input['header_video_overlay_opacity'] );

  if ( ! isset( $input['header_video_content_type_mobile'] ) ) $input['header_video_content_type_mobile'] = null;
  if ( ! array_key_exists( $input['header_video_content_type_mobile'], $slider_content_type_mobile_options ) ) $input['header_video_content_type_mobile'] = null;
	$input['header_video_catch_font_size_sp_type1'] = absint( $input['header_video_catch_font_size_sp_type1'] );
	$input['header_video_logo'] = absint( $input['header_video_logo'] );
	$input['header_video_logo_width'] = absint( $input['header_video_logo_width'] );
	$input['header_video_catch_sp'] = sanitize_textarea_field( $input['header_video_catch_sp'] );
  if ( ! isset( $input['header_video_catch_vertical_sp'] ) ) $input['header_video_catch_vertical_sp'] = null;
	$input['header_video_catch_vertical_sp'] = ( $input['header_video_catch_vertical_sp'] == 1 ? 1 : 0 );
	$input['header_video_catch_font_size_sp_type3'] = absint( $input['header_video_catch_font_size_sp_type3'] );
	$input['header_video_catch_color_sp'] = sanitize_hex_color( $input['header_video_catch_color_sp'] );

  // YouTube
	$input['header_youtube_id'] = sanitize_text_field( $input['header_youtube_id'] );

  // Contents after the header content
  if ( ! isset( $input['display_index_content01'] ) ) $input['display_index_content01'] = null;
	$input['display_index_content01'] = ( $input['display_index_content01'] == 1 ? 1 : 0 );
  $input['index_content01_catch'] = sanitize_textarea_field( $input['index_content01_catch'] );
  $input['index_content01_catch_font_size'] = absint( $input['index_content01_catch_font_size'] );
  $input['index_content01_catch_font_size_sp'] = absint( $input['index_content01_catch_font_size_sp'] );
  $input['index_content01_catch_color'] = sanitize_hex_color( $input['index_content01_catch_color'] );
  $input['index_content01_desc'] = sanitize_textarea_field( $input['index_content01_desc'] );
  $input['index_content01_desc_font_size'] = absint( $input['index_content01_desc_font_size'] );
  $input['index_content01_desc_font_size_sp'] = absint( $input['index_content01_desc_font_size_sp'] );
  $input['index_content01_desc_color'] = sanitize_hex_color( $input['index_content01_desc_color'] );

  for ( $i = 1; $i <= 3; $i++ ) {
    $input['index_content01_box_title' . $i] = sanitize_text_field( $input['index_content01_box_title' . $i] );
    $input['index_content01_box_sub' . $i] = sanitize_text_field( $input['index_content01_box_sub' . $i] );
    $input['index_content01_box_desc' . $i] = sanitize_textarea_field( $input['index_content01_box_desc' . $i] );
    $input['index_content01_box_img' . $i] = absint( $input['index_content01_box_img' . $i] );
    $input['index_content01_box_overlay' . $i] = sanitize_hex_color( $input['index_content01_box_overlay' . $i] );
    $input['index_content01_box_overlay_opacity' . $i] = sanitize_text_field( $input['index_content01_box_overlay_opacity' . $i] );
    $input['index_content01_box_url' . $i] = sanitize_text_field( $input['index_content01_box_url' . $i] );
    if ( ! isset( $input['index_content01_box_target' . $i] ) ) $input['index_content01_box_target' . $i] = null;
	  $input['index_content01_box_target' . $i] = ( $input['index_content01_box_target' . $i] == 1 ? 1 : 0 );
  }

  $input['index_content01_box_title_font_size'] = absint( $input['index_content01_box_title_font_size'] );
  $input['index_content01_box_title_font_size_sp'] = absint( $input['index_content01_box_title_font_size_sp'] );
  $input['index_content01_box_title_color'] = sanitize_hex_color( $input['index_content01_box_title_color'] );
  $input['index_content01_box_sub_color'] = sanitize_hex_color( $input['index_content01_box_sub_color'] );
  $input['index_content01_btn_label'] = sanitize_text_field( $input['index_content01_btn_label'] );
  $input['index_content01_btn_url'] = sanitize_text_field( $input['index_content01_btn_url'] );
	if ( ! isset( $input['index_content01_btn_target'] ) ) $input['index_content01_btn_target'] = null;
	$input['index_content01_btn_target'] = ( $input['index_content01_btn_target'] == 1 ? 1 : 0 );
  $input['index_content01_btn_bg'] = sanitize_hex_color( $input['index_content01_btn_bg'] );
  $input['index_content01_btn_color'] = sanitize_hex_color( $input['index_content01_btn_color'] );
  $input['index_content01_btn_bg_hover'] = sanitize_hex_color( $input['index_content01_btn_bg_hover'] );
  $input['index_content01_btn_color_hover'] = sanitize_hex_color( $input['index_content01_btn_color_hover'] );

  // Contents builder
  if ( ! isset( $input['index_contents_order'] ) || count( $input['index_contents_order'] ) !== count( $dp_default_options['index_contents_order'] ) ) {
    $input['index_contents_order'] = $dp_default_options['index_contents_order'];
  }
  foreach ( $input['index_contents_order'] as $order ) {
    if ( ! in_array( $order, $dp_default_options['index_contents_order'] ) ) {
      $input['index_contents_order'] = $dp_default_options['index_contents_order'];
      break;
    }
  }

  // News
  if ( ! isset( $input['display_index_news'] ) ) $input['display_index_news'] = null;
	$input['display_index_news'] = ( $input['display_index_news'] == 1 ? 1 : 0 );
  $input['index_news_title'] = sanitize_text_field( $input['index_news_title'] );
  $input['index_news_title_font_size'] = absint( $input['index_news_title_font_size'] );
  $input['index_news_title_font_size_sp'] = absint( $input['index_news_title_font_size_sp'] );
  $input['index_news_title_color'] = sanitize_hex_color( $input['index_news_title_color'] );
  $input['index_news_sub'] = sanitize_text_field( $input['index_news_sub'] );
  $input['index_news_sub_color'] = sanitize_hex_color( $input['index_news_sub_color'] );
  $input['index_news_desc'] = sanitize_textarea_field( $input['index_news_desc'] );
  $input['index_news_desc_font_size'] = absint( $input['index_news_desc_font_size'] );
  $input['index_news_desc_font_size_sp'] = absint( $input['index_news_desc_font_size_sp'] );
  $input['index_news_desc_color'] = sanitize_hex_color( $input['index_news_desc_color'] );
  $input['index_news_num'] = absint( $input['index_news_num'] );
  $input['index_news_btn_bg'] = sanitize_hex_color( $input['index_news_btn_bg'] );
  $input['index_news_btn_color'] = sanitize_hex_color( $input['index_news_btn_color'] );
  $input['index_news_btn_bg_hover'] = sanitize_hex_color( $input['index_news_btn_bg_hover'] );
  $input['index_news_btn_color_hover'] = sanitize_hex_color( $input['index_news_btn_color_hover'] );

  for ( $i = 1; $i <= 4; $i++ ) {
    $input['index_news_tab_cat' . $i] = absint( $input['index_news_tab_cat' . $i] );
  }

  // Service
  if ( ! isset( $input['display_index_service'] ) ) $input['display_index_service'] = null;
	$input['display_index_service'] = ( $input['display_index_service'] == 1 ? 1 : 0 );
  $input['index_service_bg'] = sanitize_hex_color( $input['index_service_bg'] );
  $input['index_service_title'] = sanitize_text_field( $input['index_service_title'] );
  $input['index_service_title_font_size'] = absint( $input['index_service_title_font_size'] );
  $input['index_service_title_font_size_sp'] = absint( $input['index_service_title_font_size_sp'] );
  $input['index_service_title_color'] = sanitize_hex_color( $input['index_service_title_color'] );
  $input['index_service_sub'] = sanitize_text_field( $input['index_service_sub'] );
  $input['index_service_sub_color'] = sanitize_hex_color( $input['index_service_sub_color'] );
  $input['index_service_desc'] = sanitize_textarea_field( $input['index_service_desc'] );
  $input['index_service_desc_font_size'] = absint( $input['index_service_desc_font_size'] );
  $input['index_service_desc_font_size_sp'] = absint( $input['index_service_desc_font_size_sp'] );
  $input['index_service_desc_color'] = sanitize_hex_color( $input['index_service_desc_color'] );
  $input['index_service_box_title_font_size'] = absint( $input['index_service_box_title_font_size'] );
  $input['index_service_box_title_font_size_sp'] = absint( $input['index_service_box_title_font_size_sp'] );
  $input['index_service_box_title_color'] = sanitize_hex_color( $input['index_service_box_title_color'] );
  $input['index_service_box_sub_color'] = sanitize_hex_color( $input['index_service_box_sub_color'] );
  $input['index_service_btn_label'] = sanitize_text_field( $input['index_service_btn_label'] );
  $input['index_service_btn_url'] = sanitize_text_field( $input['index_service_btn_url'] );
	if ( ! isset( $input['index_service_btn_target'] ) ) $input['index_service_btn_target'] = null;
	$input['index_service_btn_target'] = ( $input['index_service_btn_target'] == 1 ? 1 : 0 );
  $input['index_service_btn_bg'] = sanitize_hex_color( $input['index_service_btn_bg'] );
  $input['index_service_btn_color'] = sanitize_hex_color( $input['index_service_btn_color'] );
  $input['index_service_btn_bg_hover'] = sanitize_hex_color( $input['index_service_btn_bg_hover'] );
  $input['index_service_btn_color_hover'] = sanitize_hex_color( $input['index_service_btn_color_hover'] );

  // Banner
  if ( ! isset( $input['display_index_banner'] ) ) $input['display_index_banner'] = null;
	$input['display_index_banner'] = ( $input['display_index_banner'] == 1 ? 1 : 0 );

  for ( $i = 1; $i <= 6; $i++ ) {
    $input['index_banner_title' . $i] = sanitize_text_field( $input['index_banner_title' . $i] );
    $input['index_banner_title_color' . $i] = sanitize_hex_color( $input['index_banner_title_color' . $i] );
    $input['index_banner_sub' . $i] = sanitize_text_field( $input['index_banner_sub' . $i] );
    $input['index_banner_sub_color' . $i] = sanitize_hex_color( $input['index_banner_sub_color' . $i] );
    $input['index_banner_desc' . $i] = sanitize_textarea_field( $input['index_banner_desc' . $i] );
    $input['index_banner_desc_color' . $i] = sanitize_hex_color( $input['index_banner_desc_color' . $i] );
    $input['index_banner_img' . $i] = absint( $input['index_banner_img' . $i] );
    if ( ! isset( $input['index_banner_display_overlay' . $i] ) ) $input['index_banner_display_overlay' . $i] = null;
	  $input['index_banner_display_overlay' . $i] = ( $input['index_banner_display_overlay' . $i] == 1 ? 1 : 0 );
    $input['index_banner_overlay' . $i] = sanitize_hex_color( $input['index_banner_overlay' . $i] );
    $input['index_banner_url' . $i] = sanitize_text_field( $input['index_banner_url' . $i] );
    if ( ! isset( $input['index_banner_target' . $i] ) ) $input['index_banner_target' . $i] = null;
	  $input['index_banner_target' . $i] = ( $input['index_banner_target' . $i] == 1 ? 1 : 0 );
  }

  // Works
  if ( ! isset( $input['display_index_works'] ) ) $input['display_index_works'] = null;
	$input['display_index_works'] = ( $input['display_index_works'] == 1 ? 1 : 0 );
  $input['index_works_title'] = sanitize_text_field( $input['index_works_title'] );
  $input['index_works_title_font_size'] = absint( $input['index_works_title_font_size'] );
  $input['index_works_title_font_size_sp'] = absint( $input['index_works_title_font_size_sp'] );
  $input['index_works_title_color'] = sanitize_hex_color( $input['index_works_title_color'] );
  $input['index_works_sub'] = sanitize_text_field( $input['index_works_sub'] );
  $input['index_works_sub_color'] = sanitize_hex_color( $input['index_works_sub_color'] );
  $input['index_works_desc'] = sanitize_textarea_field( $input['index_works_desc'] );
  $input['index_works_desc_font_size'] = absint( $input['index_works_desc_font_size'] );
  $input['index_works_desc_font_size_sp'] = absint( $input['index_works_desc_font_size_sp'] );
  $input['index_works_desc_color'] = sanitize_hex_color( $input['index_works_desc_color'] );
  $input['index_works_num'] = absint( $input['index_works_num'] );
  $input['index_works_btn_bg'] = sanitize_hex_color( $input['index_works_btn_bg'] );
  $input['index_works_btn_color'] = sanitize_hex_color( $input['index_works_btn_color'] );
  $input['index_works_btn_bg_hover'] = sanitize_hex_color( $input['index_works_btn_bg_hover'] );
  $input['index_works_btn_color_hover'] = sanitize_hex_color( $input['index_works_btn_color_hover'] );

  // Wysiwyg
  for ( $i = 1; $i <= 3; $i++ ) {
 	  if ( ! isset( $input['display_index_wysiwyg' . $i] ) ) $input['display_index_wysiwyg' . $i] = null;
    $input['display_index_wysiwyg' . $i] = ( $input['display_index_wysiwyg' . $i] == 1 ? 1 : 0 );
  }

	return $input;
}
