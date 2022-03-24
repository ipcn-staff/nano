<?php
/*
 * Manage header tab
 */

// Add default values
add_filter( 'before_getting_design_plus_option', 'add_header_dp_default_options' );

// Add label of header tab
add_action( 'tcd_tab_labels', 'add_header_tab_label' );

// Add HTML of header tab
add_action( 'tcd_tab_panel', 'add_header_tab_panel' );

// Register sanitize function
add_filter( 'theme_options_validate', 'add_header_theme_options_validate' );

global $header_fix_options;
$header_fix_options = array(
	'type1' => array(
		'value' => 'type1',
		'label' => __( 'Normal header', 'tcd-w' )
	),
 	'type2' => array(
		'value' => 'type2',
		'label' => __( 'Fix at top after page scroll', 'tcd-w' )
	),
);

global $megamenu_options;
$megamenu_options = array(
  'type1' => array(
    'value' => 'type1',
    'label' => __( 'Dropdown menu', 'tcd-w' ),
    'image' => get_template_directory_uri() . '/admin/assets/images/megamenu1.jpg'
  ),
  'type2' => array(
    'value' => 'type2',
    'label' => __( 'Mega menu A', 'tcd-w' ),
    'image' => get_template_directory_uri() . '/admin/assets/images/megamenu2.jpg'
  ),
  'type3' => array(
    'value' => 'type3',
    'label' => __( 'Mega menu B', 'tcd-w' ),
    'image' => get_template_directory_uri() . '/admin/assets/images/megamenu3.jpg'
  )
);

function add_header_dp_default_options( $dp_default_options ) {

  // Header
	$dp_default_options['header_fix'] = 'type1';
	$dp_default_options['sp_header_fix'] = 'type1';
	$dp_default_options['header_bg'] = '#ffffff';
	$dp_default_options['header_bg_fixed'] = '#ffffff';
	$dp_default_options['header_catch'] = __( 'Enter catchphrase here.', 'tcd-w' );
	$dp_default_options['header_catch_font_size'] = 14;
	$dp_default_options['header_catch_color'] = '#000000';
	$dp_default_options['header_display_search'] = 1;
  $dp_default_options['show_header_lang'] = 1;

  // Global navigation
	$dp_default_options['gnav_bg'] = '#eeeeee';
	$dp_default_options['gnav_color'] = '#000000';
	$dp_default_options['gnav_bg_hover'] = '#d90000';
	$dp_default_options['gnav_color_hover'] = '#ffffff';
	$dp_default_options['gnav_sub_color'] = '#ffffff';
	$dp_default_options['gnav_sub_bg'] = '#d90000';
	$dp_default_options['gnav_sub_color_hover'] = '#ffffff';
	$dp_default_options['gnav_sub_bg_hover'] = '#a40000';
	$dp_default_options['gnav_color_sp'] = '#000000';
	$dp_default_options['gnav_bg_sp'] = '#ffffff';

  // Global navigation display
  $dp_default_options['megamenu'] = array();

	return $dp_default_options;
}

function add_header_tab_label( $tab_labels ) {
	$tab_labels['header'] = __( 'Header', 'tcd-w' );
	return $tab_labels;
}

function add_header_tab_panel( $dp_options ) {
  global $dp_default_options, $header_fix_options, $megamenu_options;
?>
<div id="tab-content-header">

  <?php // Header ?>
  <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e( 'Header settings', 'tcd-w' ); ?></h3>
  	<h4 class="theme_option_headline2"><?php _e( 'Header position', 'tcd-w' ); ?></h4>
    <p><?php _e( 'Please set the display position of the header bar.', 'tcd-w' ); ?></p>
    <div class="theme_option_message">
      <?php echo __( '<p>Normal display position - When scrolling through the page, the header bar disappears.</p><p>Fixed display at the top - Following the page scroll, the header bar is fixedly displayed at the top of the page.</p>', 'tcd-w' ); ?>
    </div>
   	<fieldset class="cf select_type2">
			<?php foreach ( $header_fix_options as $option ) : ?>
     	<label class="description"><input type="radio" name="dp_options[header_fix]" value="<?php esc_attr_e( $option['value'] ); ?>" <?php checked( $option['value'], $dp_options['header_fix'] ); ?>><?php _e( $option['label'], 'tcd-w' ); ?></label>
			<?php endforeach; ?>
    </fieldset>
  	<h4 class="theme_option_headline2"><?php _e( 'Header position (mobile)', 'tcd-w' ); ?></h4>
    <p><?php _e( 'Please set the display position of the header bar for mobile.', 'tcd-w' ); ?></p>
  	<fieldset class="cf select_type2">
			<?php foreach ( $header_fix_options as $option ) : ?>
			<label class="description"><input type="radio" name="dp_options[sp_header_fix]" value="<?php echo esc_attr( $option['value'] ); ?>" <?php checked( $option['value'], $dp_options['sp_header_fix'] ); ?>><?php esc_html_e( $option['label'], 'tcd-w' ); ?></label>
			<?php endforeach; ?>
		</fieldset>
  	<h4 class="theme_option_headline2"><?php _e( 'Background color', 'tcd-w' ); ?></h4>
    <p><?php _e( 'Please set the background color of header bar.', 'tcd-w' ); ?></p>
		<input type="text" name="dp_options[header_bg]" value="<?php echo esc_attr( $dp_options['header_bg'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['header_bg'] ); ?>" class="c-color-picker">
  	<h4 class="theme_option_headline2"><?php _e( 'Background color on fixed', 'tcd-w' ); ?></h4>
    <p><?php _e( 'Sets the background color of the header bar for fixed display.', 'tcd-w' ); ?></p>
		<input type="text" name="dp_options[header_bg_fixed]" value="<?php echo esc_attr( $dp_options['header_bg_fixed'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['header_bg_fixed'] ); ?>" class="c-color-picker">
  	<h4 class="theme_option_headline2"><?php _e( 'Catchphrase', 'tcd-w' ); ?></h4>
    <p><input type="text" class="regular-text" name="dp_options[header_catch]" value="<?php echo esc_attr( $dp_options['header_catch'] ); ?>"></p>
    <p><?php _e( 'Font size', 'tcd-w' ); ?> <input type="number" class="tiny-text" name="dp_options[header_catch_font_size]" value="<?php echo esc_attr( $dp_options['header_catch_font_size'] ); ?>" min="1" step="1"> px</p>
    <input type="text" class="c-color-picker" name="dp_options[header_catch_color]" value="<?php echo esc_attr( $dp_options['header_catch_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['header_catch_color'] ); ?>">
  	<h4 class="theme_option_headline2"><?php _e( 'Header search', 'tcd-w' ); ?></h4>
    <p><label><input type="checkbox" value="1" name="dp_options[header_display_search]" <?php checked( 1, $dp_options['header_display_search'] ); ?>> <?php _e( 'Display the search form', 'tcd-w' ); ?></label></p>
    <h4 class="theme_option_headline2"><?php _e('Language link setting', 'tcd-w');  ?></h4>
    <p><label><input type="checkbox" value="1" name="dp_options[show_header_lang]" <?php checked( 1, $dp_options['show_header_lang'] ); ?>> <?php _e('Display language link', 'tcd-w');  ?></label></p>
    <input type="submit" class="button-ml ajax_button" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
  </div>

 	<?php // Global navigation ?>
  <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e( 'Global navigation settings', 'tcd-w' ); ?></h3>
    <p><?php _e( 'Set the color scheme of the the menu.', 'tcd-w' ); ?></p>
    <p><label for="gnav_bg"><?php _e( 'Background color', 'tcd-w' ); ?> </label><input type="text" id="gnav_bg" class="c-color-picker" name="dp_options[gnav_bg]" value="<?php echo esc_attr( $dp_options['gnav_bg'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['gnav_bg'] ); ?>"></p>
    <p><label for="gnav_color"><?php _e( 'Font color', 'tcd-w' ); ?> </label><input type="text" id="gnav_color" class="c-color-picker" name="dp_options[gnav_color]" value="<?php echo esc_attr( $dp_options['gnav_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['gnav_color'] ); ?>"></p>
    <p><label for="gnav_bg_hover"><?php _e( 'Background color on hover', 'tcd-w' ); ?> </label><input type="text" id="gnav_bg_hover" class="c-color-picker" name="dp_options[gnav_bg_hover]" value="<?php echo esc_attr( $dp_options['gnav_bg_hover'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['gnav_bg_hover'] ); ?>"></p>
    <p><label for="gnav_color_hover"><?php _e( 'Font color on hover', 'tcd-w' ); ?> </label><input type="text" id="gnav_color_hover" class="c-color-picker" name="dp_options[gnav_color_hover]" value="<?php echo esc_attr( $dp_options['gnav_color_hover'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['gnav_color_hover'] ); ?>"></p>
  	<h4 class="theme_option_headline2"><?php _e( 'Submenu settings', 'tcd-w' ); ?></h4>
    <p><?php _e( 'Set the color scheme of the submenu.', 'tcd-w' ); ?></p>
    <p><label for="gnav_sub_color"><?php _e( 'Font color', 'tcd-w' ); ?> </label><input type="text" id="gnav_sub_color" class="c-color-picker" name="dp_options[gnav_sub_color]" value="<?php echo esc_attr( $dp_options['gnav_sub_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['gnav_sub_color'] ); ?>"></p>
    <p><label for="gnav_sub_bg"><?php _e( 'Background color', 'tcd-w' ); ?> </label><input type="text" id="gnav_sub_bg" class="c-color-picker" name="dp_options[gnav_sub_bg]" value="<?php echo esc_attr( $dp_options['gnav_sub_bg'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['gnav_sub_bg'] ); ?>"></p>
    <p><label for="gnav_sub_color_hover"><?php _e( 'Font color on hover', 'tcd-w' ); ?> </label><input type="text" id="gnav_sub_color_hover" class="c-color-picker" name="dp_options[gnav_sub_color_hover]" value="<?php echo esc_attr( $dp_options['gnav_sub_color_hover'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['gnav_sub_color_hover'] ); ?>"></p>
    <p><label for="gnav_sub_bg_hover"><?php _e( 'Background color on hover', 'tcd-w' ); ?> </label><input type="text" class="c-color-picker" name="dp_options[gnav_sub_bg_hover]" value="<?php echo esc_attr( $dp_options['gnav_sub_bg_hover'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['gnav_sub_bg_hover'] ); ?>"></p>
  	<h4 class="theme_option_headline2"><?php _e( 'Menu setting for mobile', 'tcd-w' ); ?></h4>
    <p><?php _e( 'Sets the color scheme of the menu for mobile.', 'tcd-w' ); ?></p>
    <p><label for="gnav_color_sp"><?php _e( 'Font color', 'tcd-w' ); ?> </label><input type="text" class="c-color-picker" name="dp_options[gnav_color_sp]" value="<?php echo esc_attr( $dp_options['gnav_color_sp'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['gnav_color_sp'] ); ?>"></p>
    <p><label for="gnav_bg_sp"><?php _e( 'Background color', 'tcd-w' ); ?> </label><input type="text" class="c-color-picker" name="dp_options[gnav_bg_sp]" value="<?php echo esc_attr( $dp_options['gnav_bg_sp'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['gnav_bg_sp'] ); ?>"></p>
		<input type="submit" class="button-ml ajax_button" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
	</div><!-- END .sub_box -->

  <?php // Global navigation display ?>
  <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e( 'Global navigation display settings', 'tcd-w' ); ?></h3>
    <p><?php _e( 'Set the display format of the sub menu of the global menu', 'tcd-w' ); ?></p>
    <div class="theme_option_message">
      <?php echo __( '<p>Dropdown menu - Display submenu in drop down.</p><p>Mega menu A - Display the category list of \"service\"</p><p>Mega menu B - Display the post list of \"service\"</p>', 'tcd-w' ); ?>
    </div>
    <p><?php printf( __( '<b>To use Mega menu A, please set category image on <a href="%s" target="_blank">Category edit screen</a>.</b>', 'tcd-w' ), admin_url( 'edit-tags.php?taxonomy=service_category&post_type=service' ) ); ?></p>
    <p><?php _e( '<b>Mega menu B uses eyecatch image.</b>', 'tcd-w' ); ?></p>

    <?php
    $menu_locations = get_nav_menu_locations();
    $nav_menus = wp_get_nav_menus();
    $global_nav_items = array();

    if ( isset( $menu_locations['global'] ) ) {

      foreach ( (array) $nav_menus as $menu ) {

        if ( $menu_locations['global'] === $menu->term_id ) {

          $global_nav_items = wp_get_nav_menu_items( $menu );
          break;

        }
      }
    }

    echo '<table>';

    foreach ( $global_nav_items as $item ) {

      if ( $item->menu_item_parent ) continue;

      $value = isset( $dp_options['megamenu'][$item->ID] ) ? $dp_options['megamenu'][$item->ID] : '';

      echo '<tr>';
      echo '<th>' . esc_html( $item->title ) . '</th>';
      echo '<td>';
      echo '<select name="dp_options[megamenu][' . esc_attr( $item->ID ) . ']">';

      foreach ( $megamenu_options as $option ) {
			  echo '<option value="' . esc_attr( $option['value'] ) . '" ' . selected( $option['value'], $value, false ) . '>' . esc_html( $option['label'] ) . '</option>';
      }

      echo '</select>';
      echo '</td>';
      echo '</tr>';
    }

    echo '</table>' . "\n";
    ?>
    <ul class="p-megamenu wp-clearfix">
      <?php foreach ( $megamenu_options as $option ) : ?>
      <li>
        <img src="<?php echo esc_attr( $option['image'] ); ?>" alt="<?php echo esc_attr( $option['label'] ); ?>">
        <p><?php echo $option['label']; ?></p>
      </li>
      <?php endforeach; ?>
    </ul>

	  <input type="submit" class="button-ml ajax_button" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
  </div>

</div><!-- END #tab-content7 -->
<?php
}

function add_header_theme_options_validate( $input ) {
  global $header_fix_options, $megamenu_options;

  // Header
 	if ( ! isset( $input['header_fix'] ) ) $input['header_fix'] = null;
 	if ( ! array_key_exists( $input['header_fix'], $header_fix_options ) ) $input['header_fix'] = null;
 	if ( ! isset( $input['sp_header_fix'] ) ) $input['sp_header_fix'] = null;
 	if ( ! array_key_exists( $input['sp_header_fix'], $header_fix_options ) ) $input['sp_header_fix'] = null;
	$input['header_bg'] = sanitize_hex_color( $input['header_bg'] );
	$input['header_bg_fixed'] = sanitize_hex_color( $input['header_bg_fixed'] );
  $input['header_catch'] = sanitize_text_field( $input['header_catch'] );
  $input['header_catch_font_size'] = absint( $input['header_catch_font_size'] );
	$input['header_catch_color'] = sanitize_hex_color( $input['header_catch_color'] );
  if ( ! isset( $input['header_display_search'] ) ) $input['header_display_search'] = null;
  $input['header_display_search'] = $input['header_display_search'] ? 1 : 0;
  if ( ! isset( $input['show_header_lang'] ) )
    $input['show_header_lang'] = null;
    $input['show_header_lang'] = ( $input['show_header_lang'] == 1 ? 1 : 0 );

  // Global navigation
	$input['gnav_bg'] = sanitize_hex_color( $input['gnav_bg'] );
	$input['gnav_color'] = sanitize_hex_color( $input['gnav_color'] );
	$input['gnav_bg_hover'] = sanitize_hex_color( $input['gnav_bg_hover'] );
	$input['gnav_color_hover'] = sanitize_hex_color( $input['gnav_color_hover'] );
	$input['gnav_sub_color'] = sanitize_hex_color( $input['gnav_sub_color'] );
	$input['gnav_sub_bg'] = sanitize_hex_color( $input['gnav_sub_bg'] );
	$input['gnav_sub_color_hover'] = sanitize_hex_color( $input['gnav_sub_color_hover'] );
	$input['gnav_sub_bg_hover'] = sanitize_hex_color( $input['gnav_sub_bg_hover'] );
	$input['gnav_color_sp'] = sanitize_hex_color( $input['gnav_color_sp'] );
	$input['gnav_bg_sp'] = sanitize_hex_color( $input['gnav_bg_sp'] );

  // Global navigation display
  foreach ( array_keys( $input['megamenu'] ) as $index ) {
    if ( ! array_key_exists( $input['megamenu'][$index], $megamenu_options ) ) {
      $input['megamenu'][$index] = null;
    }
  }

	return $input;
}
