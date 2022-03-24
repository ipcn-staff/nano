<?php
/*
 * 外国語サイトリンク設定
 */


// Add default values
add_filter( 'before_getting_design_plus_option', 'add_lang_dp_default_options' );


// Add label of front page tab
add_action( 'tcd_tab_labels', 'add_lang_tab_label' );


// Add HTML of front page tab
add_action( 'tcd_tab_panel', 'add_lang_tab_panel' );


// Register sanitize function
add_filter( 'theme_options_validate', 'add_lang_theme_options_validate' );


// タブの名前
function add_lang_tab_label( $tab_labels ) {
	$tab_labels['lang'] = __( 'Laguage link', 'tcd-w' );
	return $tab_labels;
}


// 初期値
function add_lang_dp_default_options( $dp_default_options ) {

  $dp_default_options['lang_link'] = array();
  for ( $i = 1; $i <= 2; $i++ ) {
    $dp_default_options['lang_link'][] = array(
      'name' => sprintf( __( 'TEST%s', 'tcd-w' ), $i ),
      'code' => sprintf( __( 'TEST%s', 'tcd-w' ), $i ),
      'url' => '#',
      'icon_preset' => 'none',
      'image' => false,
      'target' => 1,
      'tag' => '',
      'tag_code' => '',
      'current_site' => '',
    );
  }

  return $dp_default_options;

}

// 国旗
global $translate_icon_preset_options;
$translate_icon_preset_options = array(
  'jp' => array('value' => 'jp', 'label' => __( 'Japan', 'tcd-w' ), 'image' => 'jp.png'),
  'uk' => array('value' => 'uk', 'label' => __( 'UK', 'tcd-w' ), 'image' => 'uk.png'),
  'us' => array('value' => 'us', 'label' => __( 'US', 'tcd-w' ), 'image' => 'us.png'),
  'cn' => array('value' => 'cn', 'label' => __( 'China', 'tcd-w' ), 'image' => 'cn.png'),
  'kr' => array('value' => 'kr', 'label' => __( 'Korea', 'tcd-w' ), 'image' => 'kr.png'),
  'es' => array('value' => 'es', 'label' => __( 'Spain', 'tcd-w' ), 'image' => 'es.png'),
  'pt' => array('value' => 'pt', 'label' => __( 'Portugal', 'tcd-w' ), 'image' => 'pt.png'),
  'fr' => array('value' => 'fr', 'label' => __( 'France', 'tcd-w' ), 'image' => 'fr.png'),
  'de' => array('value' => 'de', 'label' => __( 'Germany', 'tcd-w' ), 'image' => 'de.png'),
  'ru' => array('value' => 'ru', 'label' => __( 'Russia', 'tcd-w' ), 'image' => 'ru.png'),
  'none' => array('value' => 'none', 'label' => __( 'Don\'t use', 'tcd-w' )),
);

// 入力欄の出力　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_lang_tab_panel( $options ) {

  global $dp_default_options, $translate_icon_preset_options;

?>

<div id="tab-content-lang" class="tab-content">


   <?php // 言語リンクの設定 ------------------------------------------------------------ ?>
  <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e('Language link setting', 'tcd-w');  ?></h3>
      <div class="theme_option_message2">
        <p><?php _e('Set the language link to be displayed in the header area.', 'tcd-w');  ?></p>
      </div>
     <div class="theme_option_message">
      <p><?php _e('Click add item button to start this option.<br />You can change order by dragging each headline of option field.', 'tcd-w');  ?></p>
     </div>
     <?php //繰り返しフィールド ----- ?>
     <div class="repeater-wrapper" data-delete-confirm="<?php _e( 'Delete?', 'tcd-w' ); ?>">
      <div class="repeater sortable">
       <?php
            if ( $options['lang_link'] ) :
              foreach ( $options['lang_link'] as $key => $value ) :
       ?>
       <div class="sub_box repeater-item repeater-item-<?php echo esc_attr( $key ); ?>">
        <h4 class="theme_option_subbox_headline"><?php if($value['name']) { echo esc_html( $value['name'] ); } else { _e( 'Item', 'tcd-w' ); }; ?></h4>
        <div class="sub_box_content">
         <h4 class="theme_option_headline2"><?php _e( 'Name of country', 'tcd-w' ); ?></h4>
         <input id="dp_options[lang_link<?php echo esc_attr( $key ); ?>_name]" class="repeater-label regular-text" type="text" name="dp_options[repeater_lang_link][<?php echo esc_attr( $key ); ?>][name]" value="<?php echo esc_attr( $value['name'] ); ?>">
         <h4 class="theme_option_headline2"><?php _e( 'Code of language', 'tcd-w' ); ?></h4>
         <div class="theme_option_message2">
          <p><?php _e('This code will be used in header menu.', 'tcd-w'); ?></p>
         </div>
         <input id="dp_options[lang_link<?php echo esc_attr( $key ); ?>_code]" class="regular-text" type="text" name="dp_options[repeater_lang_link][<?php echo esc_attr( $key ); ?>][code]" value="<?php echo esc_attr( $value['code'] ); ?>">
         <h4 class="theme_option_headline2"><?php _e( 'Flag image', 'tcd-w' ); ?></h4>
         <div class="theme_option_message2">
          <p><?php _e('You can select the icon below or use the image that you upload when you select "none". ', 'tcd-w'); ?></p>
         </div>
         <ul class="translate_preset_icons clearfix">
          <?php foreach( $translate_icon_preset_options as $option ) : ?>
          <li><label><input type="radio" name="dp_options[repeater_lang_link][<?php echo esc_attr( $key ); ?>][icon_preset]" value="<?php echo esc_attr( $option['value'] ); ?>" <?php checked( $option['value'], $value['icon_preset'] ); ?>><?php if($option['value']!='none'){ ?><span class="icon_preset"><img src="<?php echo get_template_directory_uri(); ?>/admin/assets/images/<?php echo esc_attr( $option['image'] ); ?>" /></span><?php }; ?><?php esc_html_e( $option['label'], 'tcd-w' ); ?></label></li>
          <?php endforeach; ?>
         </ul>
         <h4 class="theme_option_headline2"><?php _e( 'Original flag image', 'tcd-w' ); ?></h4>
         <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '100', '100'); ?></p>
         <div class="image_box cf">
          <div class="cf cf_media_field hide-if-no-js lang_link<?php echo esc_attr( $key ); ?>_image">
           <input type="hidden" value="<?php if($value['image']) { echo esc_attr( $value['image'] ); }; ?>" id="lang_link<?php echo esc_attr( $key ); ?>_image" name="dp_options[repeater_lang_link][<?php echo esc_attr( $key ); ?>][image]" class="cf_media_id">
           <div class="preview_field"><?php if($value['image']){ echo wp_get_attachment_image($value['image'], 'medium'); }; ?></div>
           <div class="buttton_area">
            <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
            <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$value['image']){ echo 'hidden'; }; ?>">
           </div>
          </div>
         </div>
         <h4 class="theme_option_headline2"><?php _e( 'Link URL', 'tcd-w' ); ?></h4>
         <p class="displayment_checkbox2"><label><input name="dp_options[repeater_lang_link][<?php echo esc_attr( $key ); ?>][current_site]" type="checkbox" value="1" <?php checked( $value['current_site'], 1 ); ?>><?php _e( 'This language link URL is same URL as current web site home page', 'tcd-w' ); ?></label></p>
         <div style="<?php if($value['current_site'] == 1) { echo 'display:none;'; } else { echo 'display:block;'; }; ?>">
          <div class="theme_option_message2">
           <p><?php _e('Please enter URL for this language.', 'tcd-w'); ?></p>
          </div>
          <input id="dp_options[lang_link<?php echo esc_attr( $key ); ?>_url]" class="regular-text" type="text" name="dp_options[repeater_lang_link][<?php echo esc_attr( $key ); ?>][url]" value="<?php echo esc_attr( $value['url'] ); ?>">
         </div>
         <h4 class="theme_option_headline2"><?php _e( 'Annotations tag', 'tcd-w' ); ?></h4>
         <div class="theme_option_message2">
          <p><?php _e('Please check the checkbox if you want to display hreflang annotations tag for multi-language sites.', 'tcd-w'); ?></p>
         </div>
         <p><label><input name="dp_options[repeater_lang_link][<?php echo esc_attr( $key ); ?>][tag]" type="checkbox" value="1" <?php checked( $value['tag'], 1 ); ?>><?php _e( 'Display annotation tag', 'tcd-w' ); ?></label></p>
         <h4 class="theme_option_headline2"><?php _e( 'Annotations tag language code', 'tcd-w' ); ?></h4>
         <div class="theme_option_message2">
          <p><?php _e('Please enter the correct language code.<br />Japanese:ja, English:en, Chinese:zh, Korien:ko, Spainish:es, Portuguese:pt-PT, French:fr, German:de, Russian:ru', 'tcd-w'); ?></p>
         </div>
         <input id="dp_options[lang_link<?php echo esc_attr( $key ); ?>_tag_code]" class="regular-text" type="text" name="dp_options[repeater_lang_link][<?php echo esc_attr( $key ); ?>][tag_code]" value="<?php echo esc_attr( $value['tag_code'] ); ?>">
         <p class="delete-row right-align"><a href="#" class="button button-secondary button-delete-row"><?php _e( 'Delete item', 'tcd-w' ); ?></a></p>
        </div><!-- END .sub_box_content -->
       </div><!-- END .sub_box -->
       <?php
              endforeach;
            endif;
            $key = 'addindex';
            ob_start();
       ?>
       <div class="sub_box repeater-item repeater-item-<?php echo $key; ?>">
        <h4 class="theme_option_subbox_headline"><?php _e( 'New item', 'tcd-w' ); ?></h4>
        <div class="sub_box_content">
         <h4 class="theme_option_headline2"><?php _e( 'Name of country', 'tcd-w' ); ?></h4>
         <input id="dp_options[lang_link<?php echo esc_attr( $key ); ?>_name]" class="repeater-label regular-text" type="text" name="dp_options[repeater_lang_link][<?php echo esc_attr( $key ); ?>][name]" value="">
         <h4 class="theme_option_headline2"><?php _e( 'Code of language', 'tcd-w' ); ?></h4>
         <div class="theme_option_message2">
          <p><?php _e('This code will be used in header menu.', 'tcd-w'); ?></p>
         </div>
         <input id="dp_options[lang_link<?php echo esc_attr( $key ); ?>_code]" class="regular-text" type="text" name="dp_options[repeater_lang_link][<?php echo esc_attr( $key ); ?>][code]" value="">
         <h4 class="theme_option_headline2"><?php _e( 'Flag image', 'tcd-w' ); ?></h4>
         <div class="theme_option_message2">
          <p><?php _e('You can select the icon below or use the image that you upload when you select "none". ', 'tcd-w'); ?></p>
         </div>
         <ul class="translate_preset_icons clearfix">
          <?php foreach( $translate_icon_preset_options as $option ) : ?>
          <li><label><input type="radio" name="dp_options[repeater_lang_link][<?php echo esc_attr( $key ); ?>][icon_preset]" value="<?php echo esc_attr( $option['value'] ); ?>" <?php checked( $option['value'], $value['icon_preset'] ); ?>><?php if($option['value']!='none'){ ?><span class="icon_preset"><img src="<?php echo get_template_directory_uri(); ?>/admin/assets/images/<?php echo esc_attr( $option['image'] ); ?>" /></span><?php }; ?><?php esc_html_e( $option['label'], 'tcd-w' ); ?></label></li>
          <?php endforeach; ?>
         </ul>
         <h4 class="theme_option_headline2"><?php _e( 'Original flag image', 'tcd-w' ); ?></h4>
         <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '100', '100'); ?></p>
         <div class="image_box cf">
          <div class="cf cf_media_field hide-if-no-js lang_link<?php echo esc_attr( $key ); ?>_image">
           <input type="hidden" value="" name="dp_options[repeater_lang_link][<?php echo esc_attr( $key ); ?>][image]" id="lang_link<?php echo esc_attr( $key ); ?>_image" class="cf_media_id">
           <div class="preview_field"></div>
           <div class="buttton_area">
            <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
            <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button hidden">
           </div>
          </div>
         </div>
         <h4 class="theme_option_headline2"><?php _e( 'Link URL', 'tcd-w' ); ?></h4>
         <p class="displayment_checkbox"><label><input name="dp_options[repeater_lang_link][<?php echo esc_attr( $key ); ?>][current_site]" type="checkbox" value="1"><?php _e( 'This language link URL is same URL as current web site home page', 'tcd-w' ); ?></label></p>
         <div>
          <div class="theme_option_message2">
           <p><?php _e('Please enter URL for this language.', 'tcd-w'); ?></p>
          </div>
          <input id="dp_options[lang_link<?php echo esc_attr( $key ); ?>_url]" class="regular-text" type="text" name="dp_options[repeater_lang_link][<?php echo esc_attr( $key ); ?>][url]" value="">
         </div>
         <h4 class="theme_option_headline2"><?php _e( 'Annotations tag', 'tcd-w' ); ?></h4>
         <div class="theme_option_message2">
          <p><?php _e('Please check the checkbox if you want to display hreflang annotations tag for multi-language sites.', 'tcd-w'); ?></p>
         </div>
         <p><label><input name="dp_options[repeater_lang_link][<?php echo esc_attr( $key ); ?>][tag]" type="checkbox" value="1"><?php _e( 'Display annotation tag', 'tcd-w' ); ?></label></p>
         <h4 class="theme_option_headline2"><?php _e( 'Annotations tag language code', 'tcd-w' ); ?></h4>
         <div class="theme_option_message2">
          <p><?php _e('Please enter the correct language code.<br />Japanese:ja, English:en, Chinese:zh, Korien:ko, Spainish:es, Portuguese:pt-PT, French:fr, German:de, Russian:ru', 'tcd-w'); ?></p>
         </div>
         <input id="dp_options[lang_link<?php echo esc_attr( $key ); ?>_tag_code]" class="regular-text" type="text" name="dp_options[repeater_lang_link][<?php echo esc_attr( $key ); ?>][tag_code]" value="">
         <p class="delete-row right-align"><a href="#" class="button button-secondary button-delete-row"><?php _e( 'Delete item', 'tcd-w' ); ?></a></p>
        </div><!-- END .sub_box_content -->
       </div><!-- END .sub_box -->
       <?php
            $clone = ob_get_clean();
       ?>
      </div><!-- END .repeater -->
      <a href="#" class="button button-secondary button-add-row" data-clone="<?php echo esc_attr( $clone ); ?>"><?php _e( 'Add item', 'tcd-w' ); ?></a>
     </div><!-- END .repeater-wrapper -->
     <?php //繰り返しフィールドここまで ----- ?>
    <input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>">
   </div>

</div><!-- END .tab-content -->

<?php
} // END add_lang_tab_panel()


// バリデーション　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_lang_theme_options_validate( $input ) {

  global $dp_default_options, $translate_icon_preset_options;

  $lang_link = array();
  if ( ! empty( $input['lang_link'] ) && is_array($input['lang_link'] ) ) :
    $input['repeater_lang_link'] = $input['lang_link'];
  endif;
  if ( isset( $input['repeater_lang_link'] ) ) :
  foreach ( (array)$input['repeater_lang_link'] as $key => $value ) {
    $lang_link[] = array(
      'name' => isset( $input['repeater_lang_link'][$key]['name'] ) ? wp_filter_nohtml_kses( $input['repeater_lang_link'][$key]['name'] ) : '',
      'code' => isset( $input['repeater_lang_link'][$key]['code'] ) ? wp_filter_nohtml_kses( $input['repeater_lang_link'][$key]['code'] ) : '',
      'icon_preset' => ( isset( $input['repeater_lang_link'][$key]['icon_preset'] ) && array_key_exists( $input['repeater_lang_link'][$key]['icon_preset'], $translate_icon_preset_options ) ) ? $input['repeater_lang_link'][$key]['icon_preset'] : 'none',
      'image' => isset( $input['repeater_lang_link'][$key]['image'] ) ? wp_filter_nohtml_kses( $input['repeater_lang_link'][$key]['image'] ) : '',
      'url' => isset( $input['repeater_lang_link'][$key]['url'] ) ? wp_filter_nohtml_kses( $input['repeater_lang_link'][$key]['url'] ) : '',
      'target' => ! empty( $input['repeater_lang_link'][$key]['target'] ) ? 1 : 0,
      'tag' => ! empty( $input['repeater_lang_link'][$key]['tag'] ) ? 1 : 0,
      'tag_code' => isset( $input['repeater_lang_link'][$key]['tag_code'] ) ? wp_filter_nohtml_kses( $input['repeater_lang_link'][$key]['tag_code'] ) : '',
      'current_site' => ! empty( $input['repeater_lang_link'][$key]['current_site'] ) ? 1 : 0,
    );
  }
  endif;
  $input['lang_link'] = $lang_link;

	return $input;

};


?>
