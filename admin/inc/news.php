<?php
/*
 * Manage news tab
 */

// Add default values
add_filter( 'before_getting_design_plus_option', 'add_news_dp_default_options' );

//  Add label of news tab
add_action( 'tcd_tab_labels', 'add_news_tab_label' );

// Add HTML of news tab
add_action( 'tcd_tab_panel', 'add_news_tab_panel' );

// Register sanitize function
add_filter( 'theme_options_validate', 'add_news_theme_options_validate' );

function add_news_dp_default_options( $dp_default_options ) {

  // News page
  $dp_default_options['news_breadcrumb'] = __( 'News', 'tcd-w' );
  $dp_default_options['news_slug'] = 'news';

  // Basic
	$dp_default_options['news_key_color'] = '#d80100';
	$dp_default_options['news_title'] = 'NEWS';
	$dp_default_options['news_title_font_size'] = 32;
	$dp_default_options['news_title_font_size_sp'] = 22;
	$dp_default_options['news_title_color'] = '#ffffff';
	$dp_default_options['news_sub'] = __( 'News', 'tcd-w' );
	$dp_default_options['news_sub_font_size'] = 16;
	$dp_default_options['news_sub_font_size_sp'] = 14;
	$dp_default_options['news_sub_color'] = '#ffffff';

  // Archive page
  for ( $i = 1; $i <= 4; $i++ ) {
	  $dp_default_options['news_tab_cat' . $i] = 0;
  }
	$dp_default_options['news_post_num'] = 7;

  // archive pager type
  global $archive_pager_type_options;
  $archive_pager_type_options = array(
    'type1' => array('value' => 'type1','label' => __( 'Type A', 'tcd-w' ), 'desc' => __('You can sort smoothly without going to the archive page. The pager cannot be displayed when this option is selected, so it is effective when the number of articles is relatively small.', 'tcd-w')),
    'type2' => array('value' => 'type2','label' => __( 'Type B', 'tcd-w' ), 'desc' => __('When sorting by category, you will be redirected to the archive page, and you can specify the number of articles to be displayed in one page.', 'tcd-w')),
  );

  $dp_default_options['archive_pager_type'] ='type1';
  $dp_default_options['archive_pager_type1_button_label'] = __('read more', 'tcd-w');
  $dp_default_options['archive_pager_type1_loaded_num'] = '5';
  $dp_default_options['archive_pager_type1_next_num'] = '5';
  $dp_default_options['archive_pager_type1_loaded_num_mobile'] = '4';
  $dp_default_options['archive_pager_type1_next_num_mobile'] = '4';
  $dp_default_options['archive_pager_type2_posts_per_page'] = '10';
  $dp_default_options['archive_pager_type2_posts_per_page_mobile'] = '5';

  // Single page
	$dp_default_options['news_single_title_font_size'] = 32;
	$dp_default_options['news_single_title_font_size_sp'] = 20;
	$dp_default_options['news_content_font_size'] = 16;
	$dp_default_options['news_content_font_size_sp'] = 14;

	// Display
	$dp_default_options['news_show_date'] = 1;
	$dp_default_options['news_show_category'] = 0;
	$dp_default_options['news_show_thumbnail'] = 1;
	//$dp_default_options['news_show_sns_top'] = 1;
	$dp_default_options['news_show_sns_btm'] = 1;
	$dp_default_options['news_show_next_post'] = 1;
	$dp_default_options['news_show_latest_post'] = 1;

  // Single page banner
  //for ( $i = 1; $i <= 6; $i++ ) {
  for ( $i = 3; $i <= 6; $i++ ) {
	  $dp_default_options['news_ad_code' . $i] = '';
	  $dp_default_options['news_ad_image' . $i] = false;
	  $dp_default_options['news_ad_url' . $i] = '';
  }

  // Single page banner (mobile)
	$dp_default_options['news_mobile_ad_code1'] = '';
	$dp_default_options['news_mobile_ad_image1'] = false;
	$dp_default_options['news_mobile_ad_url1'] = '';

	return $dp_default_options;
}

function add_news_tab_label( $tab_labels ) {
  $dp_options = get_design_plus_options();

  $tab_labels['news'] = $dp_options['news_breadcrumb'] ? $dp_options['news_breadcrumb'] : __( 'News', 'tcd-w' );

	return $tab_labels;
}

function add_news_tab_panel( $dp_options ) {
  global $dp_default_options, $archive_pager_type_options;

  $news_categories = get_terms( 'news_category' );
?>
<div id="tab-content-news">

  <?php // News page ?>
	<div class="theme_option_field cf">
  	<h3 class="theme_option_headline"><?php _e( 'News page settings', 'tcd-w' ); ?></h3>
		<h4 class="theme_option_headline2"><?php _e( 'Breadcrumb settings', 'tcd-w' ); ?></h4>
		<p><?php _e( 'It is used in the breadcrumb navigation. If it is not registerd, "News" is displayed instead.', 'tcd-w' ); ?></p>
		<p><input type="text" name="dp_options[news_breadcrumb]" value="<?php echo esc_attr( $dp_options['news_breadcrumb'] ); ?>"></p>
    <h4 class="theme_option_headline2"><?php _e( 'Slug settings', 'tcd-w' ); ?></h4>
		<p><?php _e( 'It is used in URL. You can use only alphanumeric. If it is not registerd, "news" is used instead.', 'tcd-w' ); ?></p>
		<p><?php _e( 'Note: if you want to change the slug, change permalinks from "Plain".', 'tcd-w' ); ?></p>
		<p><?php _e( 'Note: after changing the slug, you need to go to "Permalink Settings" and click "Save Changes".', 'tcd-w' ); ?></p>
		<p><input type="text" name="dp_options[news_slug]" value="<?php echo esc_attr( $dp_options['news_slug'] ); ?>"></p>
    <input type="submit" class="button-ml ajax_button" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
  </div>

  <?php // Basic ?>
  <div class="theme_option_field cf">
  	<h3 class="theme_option_headline"><?php _e( 'Basic settings', 'tcd-w' ); ?></h3>
    <p><?php _e( 'Set the key color and page title area to be displayed in the sidebar.', 'tcd-w' ); ?>
  	<h4 class="theme_option_headline2"><?php _e( 'Key color', 'tcd-w' ); ?></h4>
    <p><?php _e( 'This color is used for the background color of the page title in the sidebar, the color of the frame line when hovering in the category list, the color of the border line of the main content, and the link hover color.', 'tcd-w' ); ?></p>
    <input type="text" class="c-color-picker" name="dp_options[news_key_color]" value="<?php echo esc_attr( $dp_options['news_key_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['news_key_color'] ); ?>">
  	<h4 class="theme_option_headline2"><?php _e( 'Title', 'tcd-w' ); ?></h4>
    <p><?php _e( 'Please set the title displayed at the top of the sidebar.', 'tcd-w' ); ?></p>
    <input class="regular-text" type="text" name="dp_options[news_title]" value="<?php echo esc_attr( $dp_options['news_title'] ); ?>">
    <p><?php _e( 'Font size', 'tcd-w' ); ?> <input type="number" min="1" step="1" value="<?php echo esc_attr( $dp_options['news_title_font_size'] ); ?>" name="dp_options[news_title_font_size]" class="tiny-text"> px</p>
    <p><?php _e( 'Font size for mobile', 'tcd-w' ); ?> <input type="number" min="1" step="1" value="<?php echo esc_attr( $dp_options['news_title_font_size_sp'] ); ?>" class="tiny-text" name="dp_options[news_title_font_size_sp]"> px</p>
    <input type="text" class="c-color-picker" name="dp_options[news_title_color]" value="<?php echo esc_attr( $dp_options['news_title_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['news_title_color'] ); ?>">
  	<h4 class="theme_option_headline2"><?php _e( 'Sub title', 'tcd-w' ); ?></h4>
    <p><?php _e( 'Please set the sub title displayed at the top of the sidebar.', 'tcd-w' ); ?></p>
    <input class="regular-text" type="text" name="dp_options[news_sub]" value="<?php echo esc_attr( $dp_options['news_sub'] ); ?>">
    <p><?php _e( 'Font size', 'tcd-w' ); ?> <input type="number" min="1" step="1" value="<?php echo esc_attr( $dp_options['news_sub_font_size'] ); ?>" name="dp_options[news_sub_font_size]" class="tiny-text"> px</p>
    <p><?php _e( 'Font size for mobile', 'tcd-w' ); ?> <input type="number" min="1" step="1" value="<?php echo esc_attr( $dp_options['news_sub_font_size_sp'] ); ?>" class="tiny-text" name="dp_options[news_sub_font_size_sp]"> px</p>
    <input type="text" class="c-color-picker" name="dp_options[news_sub_color]" value="<?php echo esc_attr( $dp_options['news_sub_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['news_sub_color'] ); ?>">
    <input type="submit" class="button-ml ajax_button" value="<?php echo _e( 'Save Changes', 'tcd-w' ); ?>">
	</div>

	<?php // Archive page ?>
  <div class="theme_option_field cf">
  	<h3 class="theme_option_headline"><?php _e( 'Archive page settings', 'tcd-w' ); ?></h3>
    <h4 class="theme_option_headline2"><?php _e( 'Tab settings', 'tcd-w' ); ?></h4>
    <p><?php _e( 'Please select the category to display on the tab. If not selected, the tab is not displayed.', 'tcd-w' ); ?></p>

    <?php for ( $i = 1; $i <= 4; $i++ ) : ?>
      <select name="dp_options[news_tab_cat<?php echo $i; ?>]">

        <option value="0"><?php printf( __( '— Select tab %d —', 'tcd-w' ), $i ); ?></option>

        <?php foreach ( $news_categories as $cat ) : ?>
        <option value="<?php echo esc_attr( $cat->term_id ); ?>" <?php selected( $cat->term_id, $dp_options['news_tab_cat' . $i] ); ?>>
            <?php echo esc_html( $cat->name ); ?>
          </option>
        <?php endforeach; ?>

      </select>
    <?php endfor; ?>

     <h4 class="theme_option_headline2"><?php _e('Sort type setting', 'tcd-w');  ?></h4>
     <div class="theme_option_message">
      <p>
        <?php _e('Type A : You can sort smoothly without going to the archive page. The pager cannot be displayed when this option is selected, so it is effective when the number of articles is relatively small.', 'tcd-w'); ?><br>
        <?php _e('Type B : When sorting by category, you will be redirected to the archive page, and you can specify the number of articles to be displayed in one page.', 'tcd-w'); ?>
      </p>
     </div>
    <fieldset class="cf select_type2">
      <?php foreach ( $archive_pager_type_options as $option ) : ?>
      <label class="description"><input type="radio" id="archive__pager_type_<?php esc_attr_e( $option['value'] ); ?>" name="dp_options[archive_pager_type]" value="<?php echo esc_attr( $option['value'] ); ?>" <?php checked( $option['value'], $dp_options['archive_pager_type'] ); ?>><?php esc_html_e( $option['label'], 'tcd-w' ); ?></label>
      <?php endforeach; ?>
    </fieldset>

     <div id="archive_pager_type_type1_area" style="<?php if($dp_options['archive_pager_type'] == 'type1'){ echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <h4 class="theme_option_headline2"><?php _e('Additional loading button setting', 'tcd-w'); ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Button label', 'tcd-w'); ?></span> <input class="full_width" type="text" name="dp_options[archive_pager_type1_button_label]" value="<?php esc_attr_e( $dp_options['archive_pager_type1_button_label'] ); ?>" /></li>
      <li class="cf"><span class="label"><?php _e('Number of articles to display first', 'tcd-w'); ?></span> <input class="tiny-text" min="1" step="1" type="number" name="dp_options[archive_pager_type1_loaded_num]" value="<?php esc_attr_e( $dp_options['archive_pager_type1_loaded_num'] ); ?>" /></li>
      <li class="cf"><span class="label"><?php _e('Number of articles to load for additional loading', 'tcd-w'); ?></span> <input class="tiny-text" min="1" step="1" type="number" name="dp_options[archive_pager_type1_next_num]" value="<?php esc_attr_e( $dp_options['archive_pager_type1_next_num'] ); ?>" /></li>
      <li class="cf"><span class="label"><?php _e('Number of articles to display first (mobile)', 'tcd-w'); ?></span> <input class="tiny-text" min="1" step="1" type="number" name="dp_options[archive_pager_type1_loaded_num_mobile]" value="<?php esc_attr_e( $dp_options['archive_pager_type1_loaded_num_mobile'] ); ?>" /></li>
      <li class="cf"><span class="label"><?php _e('Number of articles to load for additional loading (mobile)', 'tcd-w'); ?></span> <input class="tiny-text" min="1" step="1" type="number" name="dp_options[archive_pager_type1_next_num_mobile]" value="<?php esc_attr_e( $dp_options['archive_pager_type1_next_num_mobile'] ); ?>" /></li>
     </ul>
     </div>

     <div id="archive_pager_type_type2_area" style="<?php if($dp_options['archive_pager_type'] == 'type2'){ echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <h4 class="theme_option_headline2"><?php _e('Posts per page', 'tcd-w'); ?></h4>
      <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Number of posts per page', 'tcd-w'); ?></span> <input class="tiny-text" min="1" step="1" type="number" name="dp_options[archive_pager_type2_posts_per_page]" value="<?php esc_attr_e( $dp_options['archive_pager_type2_posts_per_page'] ); ?>" /></li>
      <li class="cf"><span class="label"><?php _e('Number of posts per page (mobile)', 'tcd-w'); ?></span> <input class="tiny-text" min="1" step="1" type="number" name="dp_options[archive_pager_type2_posts_per_page_mobile]" value="<?php esc_attr_e( $dp_options['archive_pager_type2_posts_per_page_mobile'] ); ?>" /></li>
      </ul>
     </div>

    <input type="submit" class="button-ml ajax_button" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
	</div>

	<?php // Single page ?>
  <div class="theme_option_field cf">
  	<h3 class="theme_option_headline"><?php _e( 'Single Page Settings', 'tcd-w' ); ?></h3>
  	<h4 class="theme_option_headline2"><?php _e( 'Font size of post title', 'tcd-w' ); ?></h4>
    <p><?php _e( 'You can set the font size of the single page title.', 'tcd-w' ); ?></p>
  	<input class="hankaku tiny-text" type="number" min="1" step="1" name="dp_options[news_single_title_font_size]" value="<?php echo esc_attr( $dp_options['news_single_title_font_size'] ); ?>"> <span>px</span>
  	<h4 class="theme_option_headline2"><?php _e( 'Font size of post title (mobile)', 'tcd-w' ); ?></h4>
    <p><?php _e( 'You can set the font size of the single page title for mobile.', 'tcd-w' ); ?></p>
  	<input class="hankaku tiny-text" type="number" min="1" step="1" name="dp_options[news_single_title_font_size_sp]" value="<?php echo esc_attr( $dp_options['news_single_title_font_size_sp'] ); ?>"> <span>px</span>
  	<h4 class="theme_option_headline2"><?php _e( 'Font size of post contents', 'tcd-w' ); ?></h4>
    <p><?php _e( 'You can set the font size of the single page contents.', 'tcd-w' ); ?></p>
  	<input class="hankaku tiny-text" type="number" min="1" step="1" name="dp_options[news_content_font_size]" value="<?php echo esc_attr( $dp_options['news_content_font_size'] ); ?>"> <span>px</span>
  	<h4 class="theme_option_headline2"><?php _e( 'Font size of post contents (mobile)', 'tcd-w' ); ?></h4>
    <p><?php _e( 'You can set the font size of the single page contents for mobile.', 'tcd-w' ); ?></p>
  	<input class="hankaku tiny-text" type="number" min="1" step="1" name="dp_options[news_content_font_size_sp]" value="<?php echo esc_attr( $dp_options['news_content_font_size_sp'] ); ?>"> <span>px</span>
  	<input type="submit" class="button-ml ajax_button" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
	</div>
	<?php // Display ?>
  <div class="theme_option_field cf">
  	<h3 class="theme_option_headline"><?php _e( 'Display settings', 'tcd-w' ); ?></h3>
    <h4 class="theme_option_headline2"><?php _e( 'Settings for archive page and single page', 'tcd-w' ); ?></h4>
    <ul>
      <li><label><input name="dp_options[news_show_date]" type="checkbox" value="1" <?php checked( '1', $dp_options['news_show_date'] ); ?>><?php _e( 'Display date', 'tcd-w' ); ?></label></li>
      <li><label><input name="dp_options[news_show_category]" type="checkbox" value="1" <?php checked( '1', $dp_options['news_show_category'] ); ?>><?php _e( 'Display news category', 'tcd-w' ); ?></label></li>
    </ul>
    <h4 class="theme_option_headline2"><?php _e( 'Settings for single page', 'tcd-w' ); ?></h4>
    <ul>
      <li><label><input name="dp_options[news_show_thumbnail]" type="checkbox" value="1" <?php checked( '1', $dp_options['news_show_thumbnail'] ); ?>><?php _e( 'Display thumbnail', 'tcd-w' ); ?></label></li>
      <?php /*
      <li><label><input name="dp_options[news_show_sns_top]" type="checkbox" value="1" <?php checked( '1', $dp_options['news_show_sns_top'] ); ?>><?php _e( 'Display share buttons before the article', 'tcd-w' ); ?></label></li>
      */ ?>
    	<li><label><input name="dp_options[news_show_sns_btm]" type="checkbox" value="1" <?php checked( '1', $dp_options['news_show_sns_btm'] ); ?>><?php _e( 'Display share buttons after the article', 'tcd-w' ); ?></label></li>
    	<li><label><input name="dp_options[news_show_next_post]" type="checkbox" value="1" <?php checked( '1', $dp_options['news_show_next_post'] ); ?>><?php _e( 'Display next previous post link', 'tcd-w' ); ?></label></li>
    	<li><label><input name="dp_options[news_show_latest_post]" type="checkbox" value="1" <?php checked( '1', $dp_options['news_show_latest_post'] ); ?>><?php _e( 'Display latest news', 'tcd-w' ); ?></label></li>
    </ul>
    <input type="submit" class="button-ml ajax_button" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
	</div>
	<?php // Single page banner ?>
  <?php /*
	<div class="theme_option_field cf">
  	<h3 class="theme_option_headline"><?php _e( 'Single page banner settings', 'tcd-w' ); ?>1</h3>
  	<p><?php _e( 'This banner will be displayed before contents.', 'tcd-w' ); ?></p>
  	<div class="sub_box cf">
  		<h3 class="theme_option_subbox_headline"><?php _e( 'Left banner', 'tcd-w' ); ?></h3>
			<div class="sub_box_content">
  			<div class="theme_option_content">
  				<h4 class="theme_option_headline2"><?php _e( 'Banner code', 'tcd-w' ); ?></h4>
  				<p><?php _e( 'If you are using google adsense, enter all code below.', 'tcd-w' ); ?></p>
  				<textarea class="large-text" rows="10" name="dp_options[news_ad_code1]"><?php echo esc_textarea( $dp_options['news_ad_code1'] ); ?></textarea>
  			</div>
  			<p><?php _e( 'If you are not using google adsense, you can register your banner image and affiliate code individually.', 'tcd-w' ); ?></p>
  			<div class="theme_option_content">
  				<h4 class="theme_option_headline2"><?php _e( 'Register banner image.', 'tcd-w' ); _e( 'Recommend size. Width:300px Height:250px', 'tcd-w' ); ?></h4>
  				<div class="image_box cf">
  					<div class="cf cf_media_field hide-if-no-js news_ad_image1">
  						<input type="hidden" value="<?php echo esc_attr( $dp_options['news_ad_image1'] ); ?>" id="news_ad_image1" name="dp_options[news_ad_image1]" class="cf_media_id">
  						<div class="preview_field"><?php if ( $dp_options['news_ad_image1'] ) { echo wp_get_attachment_image( $dp_options['news_ad_image1'], 'medium' ); } ?></div>
  						<div class="button_area">
  							<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
  							<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $dp_options['news_ad_image1'] ) { echo 'hidden'; } ?>">
  						</div>
  					</div>
  				</div>
  			</div>
  			<div class="theme_option_content">
  				<h4 class="theme_option_headline2"><?php _e( 'Register affiliate code', 'tcd-w' ); ?></h4>
  				<input class="regular-text" type="text" name="dp_options[news_ad_url1]" value="<?php echo esc_attr( $dp_options['news_ad_url1'] ); ?>">
  				<input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>">
  			</div>
			</div>
  	</div><!-- END .sub_box -->
  	<div class="sub_box cf">
  		<h3 class="theme_option_subbox_headline"><?php _e( 'Right banner', 'tcd-w' ); ?></h3>
			<div class="sub_box_content">
  			<div class="theme_option_content">
  				<h4 class="theme_option_headline2"><?php _e( 'Banner code', 'tcd-w' ); ?></h4>
  				<p><?php _e( 'If you are using google adsense, enter all code below.', 'tcd-w' ); ?></p>
  				<textarea class="large-text" rows="10" name="dp_options[news_ad_code2]"><?php echo esc_textarea( $dp_options['news_ad_code2'] ); ?></textarea>
  			</div>
  			<p><?php _e( 'If you are not using google adsense, you can register your banner image and affiliate code individually.', 'tcd-w' );  ?></p>
  			<div class="theme_option_content">
  				<h4 class="theme_option_headline2"><?php _e( 'Register banner image.', 'tcd-w' ); _e( 'Recommend size. Width:300px Height:250px', 'tcd-w' ); ?></h4>
  				<div class="image_box cf">
  					<div class="cf cf_media_field hide-if-no-js news_ad_image2">
  						<input type="hidden" value="<?php echo esc_attr( $dp_options['news_ad_image2'] ); ?>" id="news_ad_image2" name="dp_options[news_ad_image2]" class="cf_media_id">
  						<div class="preview_field"><?php if ( $dp_options['news_ad_image2'] ) { echo wp_get_attachment_image($dp_options['news_ad_image2'], 'medium' ); } ?></div>
  						<div class="button_area">
  							<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
  							<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $dp_options['news_ad_image2'] ) { echo 'hidden'; } ?>">
  						</div>
  					</div>
  				</div>
  			</div>
  			<div class="theme_option_content">
  				<h4 class="theme_option_headline2"><?php _e( 'Register affiliate code', 'tcd-w' );  ?></h4>
  				<input class="regular-text" type="text" name="dp_options[news_ad_url2]" value="<?php echo esc_attr( $dp_options['news_ad_url2'] ); ?>">
  				<input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>">
  			</div>
  		</div><!-- END .sub_box -->
		</div>
  </div><!-- END .theme_option_field -->
  */ ?>
	<div class="theme_option_field cf">
    <?php /*
    <h3 class="theme_option_headline"><?php _e( 'Single page banner settings', 'tcd-w' ); ?>2</h3>
    */ ?>
  	<h3 class="theme_option_headline"><?php _e( 'Single page banner settings', 'tcd-w' ); ?>1</h3>
  	<p><?php _e( 'This banner will be displayed after contents.', 'tcd-w' ); ?></p>
  	<div class="sub_box cf">
  		<h3 class="theme_option_subbox_headline"><?php _e( 'Left banner', 'tcd-w' ); ?></h3>
			<div class="sub_box_content">
  			<div class="theme_option_content">
  				<h4 class="theme_option_headline2"><?php _e( 'Banner code', 'tcd-w' ); ?></h4>
  				<p><?php _e( 'If you are using google adsense, enter all code below.', 'tcd-w' ); ?></p>
  				<textarea class="large-text" rows="10" name="dp_options[news_ad_code3]"><?php echo esc_textarea( $dp_options['news_ad_code3'] ); ?></textarea>
  			</div>
            <p><?php _e( 'If you are not using google adsense, you can register your banner image and affiliate code individually. If an advertisement code is entered in the above setting field, the following setting will be invalid.', 'tcd-w' ); ?></p>
  			<div class="theme_option_content">
  				<h4 class="theme_option_headline2"><?php _e( 'Register banner image.', 'tcd-w' ); _e( 'Recommend size. Width:300px Height:250px', 'tcd-w' ); ?></h4>
  				<div class="image_box cf">
  					<div class="cf cf_media_field hide-if-no-js news_ad_image3">
  						<input type="hidden" value="<?php echo esc_attr( $dp_options['news_ad_image3'] ); ?>" id="news_ad_image3" name="dp_options[news_ad_image3]" class="cf_media_id">
  						<div class="preview_field"><?php if ( $dp_options['news_ad_image3'] ) { echo wp_get_attachment_image( $dp_options['news_ad_image3'], 'medium' ); } ?></div>
  						<div class="button_area">
  							<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
  							<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $dp_options['news_ad_image3'] ) { echo 'hidden'; } ?>">
  						</div>
  					</div>
  				</div>
  			</div>
  			<div class="theme_option_content">
  				<h4 class="theme_option_headline2"><?php _e( 'Register affiliate code', 'tcd-w' ); ?></h4>
  				<input class="regular-text" type="text" name="dp_options[news_ad_url3]" value="<?php echo esc_attr( $dp_options['news_ad_url3'] ); ?>">
  				<input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>">
  			</div>
			</div>
  	</div><!-- END .sub_box -->
  	<div class="sub_box cf">
  		<h3 class="theme_option_subbox_headline"><?php _e( 'Right banner', 'tcd-w' ); ?></h3>
			<div class="sub_box_content">
  			<div class="theme_option_content">
  				<h4 class="theme_option_headline2"><?php _e( 'Banner code', 'tcd-w' ); ?></h4>
  				<p><?php _e( 'If you are using google adsense, enter all code below.', 'tcd-w' ); ?></p>
  				<textarea class="large-text" rows="10" name="dp_options[news_ad_code4]"><?php echo esc_textarea( $dp_options['news_ad_code4'] ); ?></textarea>
  			</div>
            <p><?php _e( 'If you are not using google adsense, you can register your banner image and affiliate code individually. If an advertisement code is entered in the above setting field, the following setting will be invalid.', 'tcd-w' ); ?></p>
  			<div class="theme_option_content">
  				<h4 class="theme_option_headline2"><?php _e( 'Register banner image.', 'tcd-w' ); _e( 'Recommend size. Width:300px Height:250px', 'tcd-w' ); ?></h4>
  				<div class="image_box cf">
  					<div class="cf cf_media_field hide-if-no-js news_ad_image4">
  						<input type="hidden" value="<?php echo esc_attr( $dp_options['news_ad_image4'] ); ?>" id="news_ad_image4" name="dp_options[news_ad_image4]" class="cf_media_id">
  						<div class="preview_field"><?php if ( $dp_options['news_ad_image4'] ) { echo wp_get_attachment_image($dp_options['news_ad_image4'], 'medium' ); } ?></div>
  						<div class="button_area">
  							<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
  							<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $dp_options['news_ad_image4'] ) { echo 'hidden'; } ?>">
  						</div>
  					</div>
  				</div>
  			</div>
  			<div class="theme_option_content">
  				<h4 class="theme_option_headline2"><?php _e( 'Register affiliate code', 'tcd-w' );  ?></h4>
  				<input class="regular-text" type="text" name="dp_options[news_ad_url4]" value="<?php echo esc_attr( $dp_options['news_ad_url4'] ); ?>">
  				<input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>">
  			</div>
  		</div><!-- END .sub_box -->
		</div>
  </div><!-- END .theme_option_field -->
	<div class="theme_option_field cf">
    <?php /*
  	<h3 class="theme_option_headline"><?php _e( 'Single page banner settings', 'tcd-w' ); ?>3</h3>
    */ ?>
  	<h3 class="theme_option_headline"><?php _e( 'Single page banner settings', 'tcd-w' ); ?>2</h3>
  	<p><?php _e( 'Please copy and paste the short code inside the content to show this banner.', 'tcd-w' ); ?></p>
  	<p><?php _e( 'Short code', 'tcd-w' );  ?> : <input type="text" readonly="readonly" value="[n_ad]"></p>
  	<div class="sub_box cf">
  		<h3 class="theme_option_subbox_headline"><?php _e( 'Left banner', 'tcd-w' ); ?></h3>
			<div class="sub_box_content">
  			<div class="theme_option_content">
  				<h4 class="theme_option_headline2"><?php _e( 'Banner code', 'tcd-w' ); ?></h4>
  				<p><?php _e( 'If you are using google adsense, enter all code below.', 'tcd-w' ); ?></p>
  				<textarea class="large-text" rows="10" name="dp_options[news_ad_code5]"><?php echo esc_textarea( $dp_options['news_ad_code5'] ); ?></textarea>
  			</div>
            <p><?php _e( 'If you are not using google adsense, you can register your banner image and affiliate code individually. If an advertisement code is entered in the above setting field, the following setting will be invalid.', 'tcd-w' ); ?></p>
  			<div class="theme_option_content">
  				<h4 class="theme_option_headline2"><?php _e( 'Register banner image.', 'tcd-w' ); _e( 'Recommend size. Width:300px Height:250px', 'tcd-w' ); ?></h4>
  				<div class="image_box cf">
  					<div class="cf cf_media_field hide-if-no-js news_ad_image5">
  						<input type="hidden" value="<?php echo esc_attr( $dp_options['news_ad_image5'] ); ?>" id="news_ad_image5" name="dp_options[news_ad_image5]" class="cf_media_id">
  						<div class="preview_field"><?php if ( $dp_options['news_ad_image5'] ) { echo wp_get_attachment_image( $dp_options['news_ad_image5'], 'medium' ); } ?></div>
  						<div class="button_area">
  							<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
  							<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $dp_options['news_ad_image5'] ) { echo 'hidden'; } ?>">
  						</div>
  					</div>
  				</div>
  			</div>
  			<div class="theme_option_content">
  				<h4 class="theme_option_headline2"><?php _e( 'Register affiliate code', 'tcd-w' ); ?></h4>
  				<input class="regular-text" type="text" name="dp_options[news_ad_url5]" value="<?php echo esc_attr( $dp_options['news_ad_url5'] ); ?>">
  				<input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>">
  			</div>
			</div>
  	</div><!-- END .sub_box -->
  	<div class="sub_box cf">
  		<h3 class="theme_option_subbox_headline"><?php _e( 'Right banner', 'tcd-w' ); ?></h3>
			<div class="sub_box_content">
  			<div class="theme_option_content">
  				<h4 class="theme_option_headline2"><?php _e( 'Banner code', 'tcd-w' ); ?></h4>
  				<p><?php _e( 'If you are using google adsense, enter all code below.', 'tcd-w' ); ?></p>
  				<textarea class="large-text" rows="10" name="dp_options[news_ad_code6]"><?php echo esc_textarea( $dp_options['news_ad_code6'] ); ?></textarea>
  			</div>
            <p><?php _e( 'If you are not using google adsense, you can register your banner image and affiliate code individually. If an advertisement code is entered in the above setting field, the following setting will be invalid.', 'tcd-w' ); ?></p>
  			<div class="theme_option_content">
  				<h4 class="theme_option_headline2"><?php _e( 'Register banner image.', 'tcd-w' ); _e( 'Recommend size. Width:300px Height:250px', 'tcd-w' ); ?></h4>
  				<div class="image_box cf">
  					<div class="cf cf_media_field hide-if-no-js news_ad_image6">
  						<input type="hidden" value="<?php echo esc_attr( $dp_options['news_ad_image6'] ); ?>" id="news_ad_image6" name="dp_options[news_ad_image6]" class="cf_media_id">
  						<div class="preview_field"><?php if ( $dp_options['news_ad_image6'] ) { echo wp_get_attachment_image( $dp_options['news_ad_image6'], 'medium' ); } ?></div>
  						<div class="button_area">
  							<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
  							<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if( ! $dp_options['news_ad_image6'] ) { echo 'hidden'; } ?>">
  						</div>
  					</div>
  				</div>
  			</div>
  			<div class="theme_option_content">
  				<h4 class="theme_option_headline2"><?php _e( 'Register affiliate code', 'tcd-w' ); ?></h4>
  				<input class="regular-text" type="text" name="dp_options[news_ad_url6]" value="<?php echo esc_attr( $dp_options['news_ad_url6'] ); ?>">
  				<input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>">
  			</div>
  		</div>
  	</div><!-- END .sub_box -->
  </div><!-- END .theme_option_field -->
 	<?php // Single page banner ?>
	<div class="theme_option_field cf">
		<h3 class="theme_option_headline"><?php _e( 'Single page banner settings (mobile)', 'tcd-w' ); ?></h3>
		<p><?php _e( 'This banner will be displayed on mobile device.', 'tcd-w' ); ?></p>
 	 	<div class="theme_option_content">
 	 		<h4 class="theme_option_headline2"><?php _e( 'Banner code', 'tcd-w' ); ?></h4>
 	    <p><?php _e( 'If you are using google adsense, enter all code below.', 'tcd-w' ); ?></p>
 	    <textarea class="large-text" rows="10" name="dp_options[news_mobile_ad_code1]"><?php echo esc_textarea( $dp_options['news_mobile_ad_code1'] ); ?></textarea>
 	  </div>
      <p><?php _e( 'If you are not using google adsense, you can register your banner image and affiliate code individually. If an advertisement code is entered in the above setting field, the following setting will be invalid.', 'tcd-w' ); ?></p>
 	  <div class="theme_option_content">
 	  	<h4 class="theme_option_headline2"><?php _e( 'Register banner image.', 'tcd-w' ); ?></h4>
 	  	<div class="image_box cf">
 	    	<div class="cf cf_media_field hide-if-no-js news_mobile_ad_image1">
 	      	<input type="hidden" value="<?php echo esc_attr( $dp_options['news_mobile_ad_image1'] ); ?>" id="news_mobile_ad_image" name="dp_options[news_mobile_ad_image1]" class="cf_media_id">
 	      	<div class="preview_field"><?php if($dp_options['news_mobile_ad_image1']){ echo wp_get_attachment_image($dp_options['news_mobile_ad_image1'], 'medium' ); }; ?></div>
 	      	<div class="buttton_area">
 	       		<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
 	       		<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if(!$dp_options['news_mobile_ad_image1']){ echo 'hidden'; }; ?>">
 	     		</div>
 	    	</div>
			</div>
 	  </div>
 	 	<div class="theme_option_content">
 	    <h4 class="theme_option_headline2"><?php _e( 'Register affiliate code', 'tcd-w' ); ?></h4>
 	    <input class="regular-text" type="text" name="dp_options[news_mobile_ad_url1]" value="<?php echo esc_attr( $dp_options['news_mobile_ad_url1'] ); ?>">
 	  	<input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>">
		</div>
	</div><!-- END .theme_option_field -->
</div><!-- END #tab-content4 -->
<?php
}

function add_news_theme_options_validate( $input ) {
  global $archive_pager_type_options;

  // News page
 	$input['news_breadcrumb'] = sanitize_text_field( $input['news_breadcrumb'] );
 	$input['news_slug'] = sanitize_text_field( $input['news_slug'] );

  // Basic
  $input['news_key_color'] = sanitize_hex_color( $input['news_key_color'] );
  $input['news_title'] = sanitize_text_field( $input['news_title'] );
  $input['news_title_font_size'] = absint( $input['news_title_font_size'] );
  $input['news_title_font_size_sp'] = absint( $input['news_title_font_size_sp'] );
  $input['news_title_color'] = sanitize_hex_color( $input['news_title_color'] );
  $input['news_sub'] = sanitize_text_field( $input['news_sub'] );
  $input['news_sub_font_size'] = absint( $input['news_sub_font_size'] );
  $input['news_sub_font_size_sp'] = absint( $input['news_sub_font_size_sp'] );
  $input['news_sub_color'] = sanitize_hex_color( $input['news_sub_color'] );

  // Archive page
  for ( $i = 1; $i <= 4; $i++ ) {
    $input['news_tab_cat' . $i] = absint( $input['news_tab_cat' . $i] );
  }
  $input['news_post_num'] = absint( $input['news_post_num'] );

  // archive pager
  if ( ! isset( $value['archive_pager_type'] ) )
    $value['archive_pager_type'] = null;
  if ( ! array_key_exists( $value['archive_pager_type'], $archive_pager_type_options ) )
    $value['archive_pager_type'] = null;
  $input['archive_pager_type1_button_label'] = wp_filter_nohtml_kses( $input['archive_pager_type1_button_label'] );
  $input['archive_pager_type1_loaded_num'] = wp_filter_nohtml_kses( $input['archive_pager_type1_loaded_num'] );
  $input['archive_pager_type1_next_num'] = wp_filter_nohtml_kses( $input['archive_pager_type1_next_num'] );
  $input['archive_pager_type1_loaded_num_mobile'] = wp_filter_nohtml_kses( $input['archive_pager_type1_loaded_num_mobile'] );
  $input['archive_pager_type1_next_num_mobile'] = wp_filter_nohtml_kses( $input['archive_pager_type1_next_num_mobile'] );
  $input['archive_pager_type2_posts_per_page'] = wp_filter_nohtml_kses( $input['archive_pager_type2_posts_per_page'] );
  $input['archive_pager_type2_posts_per_page_mobile'] = wp_filter_nohtml_kses( $input['archive_pager_type2_posts_per_page_mobile'] );


  // Single page
 	$input['news_single_title_font_size'] = absint( $input['news_single_title_font_size'] );
 	$input['news_single_title_font_size_sp'] = absint( $input['news_single_title_font_size_sp'] );
 	$input['news_content_font_size'] = absint( $input['news_content_font_size'] );
 	$input['news_content_font_size_sp'] = absint( $input['news_content_font_size_sp'] );

 	// Display
 	if ( ! isset( $input['news_show_date'] ) ) $input['news_show_date'] = null;
  $input['news_show_date'] = ( $input['news_show_date'] == 1 ? 1 : 0 );
 	if ( ! isset( $input['news_show_category'] ) ) $input['news_show_category'] = null;
  $input['news_show_category'] = ( $input['news_show_category'] == 1 ? 1 : 0 );
 	if ( ! isset( $input['news_show_thumbnail'] ) ) $input['news_show_thumbnail'] = null;
  $input['news_show_thumbnail'] = ( $input['news_show_thumbnail'] == 1 ? 1 : 0 );
 	//if ( ! isset( $input['news_show_sns_top'] ) ) $input['news_show_sns_top'] = null;
  //$input['news_show_sns_top'] = ( $input['news_show_sns_top'] == 1 ? 1 : 0 );
 	if ( ! isset( $input['news_show_sns_btm'] ) ) $input['news_show_sns_btm'] = null;
  $input['news_show_sns_btm'] = ( $input['news_show_sns_btm'] == 1 ? 1 : 0 );
 	if ( ! isset( $input['news_show_next_post'] ) ) $input['news_show_next_post'] = null;
  $input['news_show_next_post'] = ( $input['news_show_next_post'] == 1 ? 1 : 0 );
 	if ( ! isset( $input['news_show_latest_post'] ) ) $input['news_show_latest_post'] = null;
  $input['news_show_latest_post'] = ( $input['news_show_latest_post'] == 1 ? 1 : 0 );

  // Single page banner
	//for ( $i = 1; $i <= 6; $i++ ) {
	for ( $i = 3; $i <= 6; $i++ ) {
 		$input['news_ad_code' . $i] = $input['news_ad_code' . $i];
 		$input['news_ad_image' . $i] = absint( $input['news_ad_image' . $i] );
 		$input['news_ad_url' . $i] = esc_url_raw( $input['news_ad_url' . $i] );
	}

  // Single page banner (mobile)
	$input['news_mobile_ad_code1'] = $input['news_mobile_ad_code1'];
 	$input['news_mobile_ad_image1'] = absint( $input['news_mobile_ad_image1'] );
 	$input['news_mobile_ad_url1'] = esc_url_raw( $input['news_mobile_ad_url1'] );

	return $input;
}
