<?php

// Set theme languages directory
load_theme_textdomain( 'tcd-w', get_template_directory() . '/languages' );

// style.cssのDescriptionをPoedit等に認識させる
__( '"NANO" is a WordPress theme that allows you to create a large corporate website at a low cost. The multi-level site structure organized and transmits a wide range of business info. Also you can easy to design the top page that conveys your company\'s message and achievements.', 'tcd-nano' );

function nano_setup() {

	// Enable post thumbnails
	add_theme_support( 'post-thumbnails' );

	// Enable a title tag
	add_theme_support( 'title-tag' );

	// Enable automatic feed links
	add_theme_support( 'automatic-feed-links' );

	// Add image sizes
  add_image_size( 'size1', 740, 440, true ); // 2x for index.php, archive-works.php
  add_image_size( 'size2', 240, 240, true ); // 2x for styled-post-list.php
  add_image_size( 'size3', 600, 240, true ); // 2x for banner-list1.php
  add_image_size( 'size4', 600, 400, true ); // 2x for banner-list2.php
  add_image_size( 'size5', 740, 280, true ); // 2x for footer.php
  add_image_size( 'size6', 520, 312, true ); // 2x for single.php
  add_image_size( 'size7', 490, 300, true ); // 2x for single-works.php
  add_image_size( 'size8', 790, 420, true ); // 2x for taxonomy-service_category.php
  add_image_size( 'size9', 830, 440, true ); // 1x for single-company.php
  add_image_size( 'size10', 440, 600, true ); // 2x for megamenus
  add_image_size( 'size11', 880, 300, true ); // 1x for taxonomy-service_category.php
  add_image_size( 'size12', 570, 150, true ); // 1x for contents-builder.php
	add_image_size( 'size-card', 130, 130, true ); // For card link

	// Register menus
	register_nav_menus( array(
		'global' => __( 'Global navigation', 'tcd-w' ),
		'footer' => __( 'Footer navigation', 'tcd-w' )
	) );

}
add_action( 'after_setup_theme', 'nano_setup' );

function nano_init() {
  $dp_options = get_design_plus_options();

	// Disable emoji
  if ( 0 === $dp_options['use_emoji'] ) {
  	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
  	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	}

}
add_action( 'init', 'nano_init' );

/**
 * Modify the number of posts to display
 */
function nano_pre_get_posts( $query ) {

  $dp_options = get_design_plus_options();

  if ( is_admin() || ! $query->is_main_query() ) {
    return;
  }

  if ( $query->is_post_type_archive( 'news' ) || $query->is_tax('news_category') ) {

    $news_tab_cat1 = $dp_options['news_tab_cat1'];
    $news_tab_cat2 = $dp_options['news_tab_cat2'];
    $news_tab_cat3 = $dp_options['news_tab_cat3'];
    $news_tab_cat4 = $dp_options['news_tab_cat4'];
    if(is_mobile()){
      $device = '_mobile';
    }else{
      $device = '';
    };

    if ( $news_tab_cat1 || $news_tab_cat2 || $news_tab_cat3 || $news_tab_cat4 ) {
      if($dp_options['archive_pager_type'] == 'type2'){
        $post_num = $dp_options['archive_pager_type2_posts_per_page'.$device];
      }else{
        $post_num = -1;
      }
    } else {
      $post_num = $dp_options['archive_pager_type2_posts_per_page'.$device];
    }

    $query->set( 'posts_per_page', $post_num );

  } elseif ( $query->is_post_type_archive( 'company' ) ) {
    $query->set( 'posts_per_page', -1 );

  } elseif ( $query->is_tax( 'service_category' ) ) {
    $query->set( 'posts_per_page', $dp_options['service_post_num'] );

  } elseif ( $query->is_post_type_archive( 'works' ) ) {
    $query->set( 'posts_per_page', $dp_options['works_post_num'] );
  }

}
add_action( 'pre_get_posts', 'nano_pre_get_posts' );

function nano_template_include( $template ) {

  if ( is_tax( 'service_category' ) ) {

    $queried_object = get_queried_object();

    $args = array(
      'parent' => $queried_object->term_id
    );

    $terms = get_terms( 'service_category', $args );

    if ( 0 === count( $terms ) ) {

      $new_template = locate_template( array( 'taxonomy.php' ) );

      if ( ! empty( $new_template ) ) {
        return $new_template;
      }
    }
  }

	return $template;
}
add_filter( 'template_include', 'nano_template_include', 99 );

function nano_template_redirect() {
  if ( ! is_tax( 'news_category' ) ) return;
  $dp_options = get_design_plus_options();
  $news_tab_cat1 = $dp_options['news_tab_cat1'];
  $news_tab_cat2 = $dp_options['news_tab_cat2'];
  $news_tab_cat3 = $dp_options['news_tab_cat3'];
  $news_tab_cat4 = $dp_options['news_tab_cat4'];
  if ( $news_tab_cat1 || $news_tab_cat2 || $news_tab_cat3 || $news_tab_cat4 ) {
    if($dp_options['archive_pager_type'] == 'type2'){
      return;
    }else{
      wp_redirect( get_post_type_archive_link( 'news' ), 301 );
      exit;
    }
  } else {
    return;
  }
}
add_action( 'template_redirect', 'nano_template_redirect' );

/**
 * Creates sidebars.
 */
function nano_widgets_init() {

  // Base
	register_sidebar( array(
		'before_widget' => '<div class="p-widget %2$s" id="%1$s">' . "\n",
		'after_widget' => "</div>\n",
		'before_title' => '<h2 class="p-widget__title">',
		'after_title' => '</h2>',
		'name' => __( 'Common widget', 'tcd-w' ),
        'description' => __( 'Widgets set in this widget area are displayed as "basic widget" in the sidebar of all pages. If there are individual settings, the widget will be displayed.', 'tcd-w' ),
		'id' => 'common_widget'
	) );

  // Posts
	register_sidebar( array(
		'before_widget' => '<div class="p-widget %2$s" id="%1$s">' . "\n",
		'after_widget' => "</div>\n",
		'before_title' => '<h2 class="p-widget__title">',
		'after_title' => '</h2>',
		'name' => __( 'Blog', 'tcd-w' ),
		'id' => 'blog_widget'
	) );
	register_sidebar( array(
		'before_widget' => '<div class="p-widget %2$s" id="%1$s">' . "\n",
		'after_widget' => "</div>\n",
		'before_title' => '<h2 class="p-widget__title">',
		'after_title' => '</h2>',
		'name' => __( 'Blog (mobile)', 'tcd-w' ),
		'id' => 'blog_widget_sp'
	) );

  // News
	register_sidebar( array(
		'before_widget' => '<div class="p-widget %2$s" id="%1$s">' . "\n",
		'after_widget' => "</div>\n",
		'before_title' => '<h2 class="p-widget__title">',
		'after_title' => '</h2>',
		'name' => __( 'News', 'tcd-w' ),
		'id' => 'news_widget'
	) );
	register_sidebar( array(
		'before_widget' => '<div class="p-widget %2$s" id="%1$s">' . "\n",
		'after_widget' => "</div>\n",
		'before_title' => '<h2 class="p-widget__title">',
		'after_title' => '</h2>',
		'name' => __( 'News (mobile)', 'tcd-w' ),
		'id' => 'news_widget_sp'
	) );

  // Company
	register_sidebar( array(
		'before_widget' => '<div class="p-widget %2$s" id="%1$s">' . "\n",
		'after_widget' => "</div>\n",
		'before_title' => '<h2 class="p-widget__title">',
		'after_title' => '</h2>',
		'name' => __( 'Company', 'tcd-w' ),
		'id' => 'company_widget'
	) );
	register_sidebar( array(
		'before_widget' => '<div class="p-widget %2$s" id="%1$s">' . "\n",
		'after_widget' => "</div>\n",
		'before_title' => '<h2 class="p-widget__title">',
		'after_title' => '</h2>',
		'name' => __( 'Company (mobile)', 'tcd-w' ),
		'id' => 'company_widget_sp'
	) );

  // Service
	register_sidebar( array(
		'before_widget' => '<div class="p-widget %2$s" id="%1$s">' . "\n",
		'after_widget' => "</div>\n",
		'before_title' => '<h2 class="p-widget__title">',
		'after_title' => '</h2>',
		'name' => __( 'Service', 'tcd-w' ),
		'id' => 'service_widget'
	) );
	register_sidebar( array(
		'before_widget' => '<div class="p-widget %2$s" id="%1$s">' . "\n",
		'after_widget' => "</div>\n",
		'before_title' => '<h2 class="p-widget__title">',
		'after_title' => '</h2>',
		'name' => __( 'Service (mobile)', 'tcd-w' ),
		'id' => 'service_widget_sp'
	) );

  // Works
	register_sidebar( array(
		'before_widget' => '<div class="p-widget %2$s" id="%1$s">' . "\n",
		'after_widget' => "</div>\n",
		'before_title' => '<h2 class="p-widget__title">',
		'after_title' => '</h2>',
		'name' => __( 'Works', 'tcd-w' ),
		'id' => 'works_widget'
	) );
	register_sidebar( array(
		'before_widget' => '<div class="p-widget %2$s" id="%1$s">' . "\n",
		'after_widget' => "</div>\n",
		'before_title' => '<h2 class="p-widget__title">',
		'after_title' => '</h2>',
		'name' => __( 'Works (mobile)', 'tcd-w' ),
		'id' => 'works_widget_sp'
	) );

  // Footer
	register_sidebar( array(
		'before_widget' => '<div class="p-footer-widgets__item p-footer-widget %2$s" id="%1$s">' . "\n",
		'after_widget' => "</div>\n",
		'before_title' => '<h2 class="p-footer-widget__title">',
		'after_title' => '</h2>',
		'name' => __( 'Footer', 'tcd-w' ),
		'id' => 'footer_widget'
	) );
	register_sidebar( array(
		'before_widget' => '<div class="p-footer-widgets__item p-footer-widget %2$s" id="%1$s">' . "\n",
		'after_widget' => "</div>\n",
		'before_title' => '<h2 class="p-footer-widget__title">',
		'after_title' => '</h2>',
		'name' => __( 'Footer (mobile)', 'tcd-w' ),
		'id' => 'footer_widget_sp'
	) );
}
add_action( 'widgets_init', 'nano_widgets_init' );

/**
 * Enqueue scripts
 */
function nano_scripts() {
  $dp_options = get_design_plus_options();


  if ( is_front_page() && 'type1' === $dp_options['header_content_type'] ) {
    wp_enqueue_style( 'nano-slick', get_template_directory_uri() . '/assets/css/slick.min.css', false, version_num() );
    wp_enqueue_style( 'nano-slick-theme', get_template_directory_uri() . '/assets/css/slick-theme.min.css', false, version_num() );
  }

  wp_enqueue_style( 'nano-style', get_stylesheet_uri(), false, version_num() );

  if ( is_front_page() ) {
    wp_enqueue_script( 'nano-front-page', get_template_directory_uri() . '/assets/js/front-page.js', array( 'jquery' ), version_num(), true );
  } elseif ( is_single() ) {
    wp_enqueue_script( 'nano-bundle', get_template_directory_uri() . '/assets/js/bundle.js', array( 'jquery' ), version_num(), true );
    wp_enqueue_script( 'nano-comment', get_template_directory_uri() . '/assets/js/comment.js', array( 'jquery' ), version_num(), true );
  } else {
    wp_enqueue_script( 'nano-bundle', get_template_directory_uri() . '/assets/js/bundle.js', array( 'jquery' ), version_num(), true );
  }

  if($dp_options['lang_link']){
    wp_enqueue_script( 'nano-lang', get_template_directory_uri() . '/assets/js/jscript.js', array( 'jquery' ), version_num(), true );
  }

}

// Priority 12 should be bigger than that of pagebuilder (11)
add_action( 'wp_enqueue_scripts', 'nano_scripts', 12 );

/**
 * Enqueue admin scripts
 */
function nano_admin_scripts( $hook_suffix ) {

  // Media uploader API
  wp_enqueue_media();
  wp_enqueue_script( 'cf-media-field', get_template_directory_uri() . '/admin/assets/js/cf-media-field.min.js', '', version_num() );
  wp_localize_script( 'cf-media-field', 'cfmf_text', array( 'title' => __( 'Please Select Image', 'tcd-w' ), 'button' => __( 'Use this Image', 'tcd-w' ) ) );

	// WordPress Color Picker API
	wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_script( 'wp-color-picker');

  // For widgets.php
  if ( 'widgets.php' === $hook_suffix ) {
    wp_enqueue_style( 'nano-widgets', get_template_directory_uri() . '/admin/assets/css/widgets.min.css', '', version_num() );
	  wp_enqueue_script( 'nano-widgets', get_template_directory_uri() . '/admin/assets/js/widget.min.js', array( 'jquery' ), '', version_num() );
  }

  // For theme options
  if ( 'toplevel_page_theme_options' === $hook_suffix ) {
    wp_enqueue_style( 'a-footer-bar', get_template_directory_uri() . '/admin/assets/css/footer-bar.min.css', '', version_num() );
    wp_enqueue_style( 'cb', get_template_directory_uri() . '/admin/assets/css/cb.min.css', '', version_num() );
	  wp_enqueue_script( 'cb', get_template_directory_uri() . '/admin/assets/js/cb.min.js', '', version_num() );
		wp_enqueue_style( 'editor-buttons' ); // editor-buttons.css を常時出力
	  wp_enqueue_script( 'jquery.cookieTab', get_template_directory_uri() . '/admin/assets/js/jquery.cookieTab.js', '', version_num() );
	  wp_enqueue_script( 'jquery-form' ); // For submitting with AJAX
  }

  wp_enqueue_style( 'my-admin', get_template_directory_uri() . '/admin/assets/css/my_admin.min.css', '', version_num() );
	wp_enqueue_script( 'my-script', get_template_directory_uri() . '/admin/assets/js/my_script.min.js', array( 'jquery', 'jquery-ui-resizable' ), version_num(), true );
  wp_localize_script( 'my-script', 'error_messages', array( 'success' => __( 'Settings Saved Successfully', 'tcd-w' ), 'error' => __( 'Can not save data. Please try again.', 'tcd-w' ) ) );
}
add_action( 'admin_enqueue_scripts', 'nano_admin_scripts' );

/**
 * Registers an editor stylesheet for the theme
 */
function nano_add_editor_styles() {
	add_editor_style( 'admin/assets/css/editor-style.min.css' );
}
add_action( 'admin_init', 'nano_add_editor_styles' );


// ビジュアルエディタに表(テーブル)の機能を追加 -----------------------------------------------
function mce_external_plugins_table($plugins) {
    $plugins['table'] = 'https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.7.4/plugins/table/plugin.min.js';
    return $plugins;
}
add_filter( 'mce_external_plugins', 'mce_external_plugins_table' );

// tinymceのtableボタンにclass属性プルダウンメニューを追加
function mce_buttons_table($buttons) {
    $buttons[] = 'table';
    return $buttons;
}
add_filter( 'mce_buttons', 'mce_buttons_table' );

function bootstrap_classes_tinymce($settings) {
  $styles = array(
    array('title' => __('Default style', 'tcd-w'), 'value' => ''),
    array('title' => __('No border', 'tcd-w'), 'value' => 'table_no_border'),
    array('title' => __('Display only horizontal border', 'tcd-w'), 'value' => 'table_border_horizontal')
  );
  $settings['table_class_list'] = json_encode($styles);
  return $settings;
}
add_filter('tiny_mce_before_init', 'bootstrap_classes_tinymce');


/**
 * Add favicon
 */
function nano_add_favicon() {
  $dp_options = get_design_plus_options();

  if ( $dp_options['favicon'] ) {
    echo '<link rel="shortcut icon" href="' . esc_html( wp_get_attachment_url( $dp_options['favicon'] ) ) . '">' . "\n";
  }
}
add_action( 'wp_head', 'nano_add_favicon' );

/**
 * Manage get_the_archive_title() function
 */
function nano_archive_title( $title ) {
  global $author, $post;

  if ( is_author() ) {
    $title = get_the_author_meta( 'display_name', $author );
  } elseif ( is_category() || is_tag() ) {
    $title = single_term_title( '', false );
  } elseif ( is_day() ) {
    $title = get_the_time( __( 'F jS, Y', 'tcd-w' ), $post );
  } elseif ( is_month() ) {
    $title = get_the_time( __( 'F, Y', 'tcd-w' ), $post );
  } elseif ( is_year() ) {
    $title = get_the_time( __( 'Y', 'tcd-w' ), $post );
  } elseif ( is_search() ) {
    $title = sprintf( __( 'Search result: %s', 'tcd-w' ), $title );
  }

  return $title;
}
add_filter( 'get_the_archive_title', 'nano_archive_title' );

/**
 * Modify the length of excerpts
 */
function nano_excerpt_length( $length ) {
  return 100;
}
add_filter( 'excerpt_length', 'nano_excerpt_length' );

/**
 * Disable self pingback
 */
function no_self_ping( &$links ) {
  $home = home_url();
  foreach ( $links as $l => $link ) {
  	if ( 0 === strpos( $link, $home ) ) {
			unset( $links[$l] );
		}
	}
}
add_action( 'pre_ping', 'no_self_ping' );

/**
 * Remove unnecessary codes from wp_head
 */
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'index_rel_link' );
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );

/**
 * Remove inline styles
 */
add_action( 'widgets_init', 'remove_recent_comments_style' );
add_action( 'get_header', 'remove_adminbar_inline_style' );

function remove_recent_comments_style() {
  global $wp_widget_factory;
  remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
}

function remove_adminbar_inline_style() {
  remove_action( 'wp_head', '_admin_bar_bump_cb' );
}

/**
 * Remove wpautop() function from the_excerpt
 */
remove_filter( 'the_excerpt', 'wpautop' );

/**
 * Remove brakets from at the end of excerpts
 */
function nano_excerpt_more( $more ) {
  return '...';
}
add_filter( 'excerpt_more', 'nano_excerpt_more' );

/**
 * Theme options
 */
require get_template_directory() . '/admin/theme-options.php';

/**
 * Manage custom columns
 */
require get_template_directory() . '/inc/admin_column.php';

/**
 * Add quicktags to the visual editor
 */
require get_template_directory() . '/inc/custom_editor.php';

/**
 * Add footer bar
 */
require get_template_directory() . '/inc/footer-bar.php';

/*
 * Manage the category list
 */
require get_template_directory() . '/inc/list.php';

/*
 * Add load icon
 */
require get_template_directory() . '/inc/load-icon.php';

/**
 * Modify HTML of menus
 */
require get_template_directory() . '/inc/menu.php';

/**
 * Add inline styles and scripts
 */
require get_template_directory() . '/inc/head.php';
require get_template_directory() . '/inc/footer.php';

/**
 * Add page builder
 */
require get_template_directory() . '/pagebuilder/pagebuilder.php';

/**
 * Add recommended image sizes
 */
require get_template_directory() . '/inc/featured-image.php';

/**
 * Manage quick edit
 */
require get_template_directory() . '/inc/quick_edit.php';

/**
 * Add shortcodes
 */
require get_template_directory() . '/inc/short_code.php';

/**
 * Update notifier
 */
require get_template_directory() . '/inc/update_notifier.php';

/**
 * Add custom fields
 */
require get_template_directory() . '/inc/class-tcd-meta-box.php';
require get_template_directory() . '/inc/blog_cf.php';
require get_template_directory() . '/inc/cf-category.php';
require get_template_directory() . '/inc/cf-company.php';
require get_template_directory() . '/inc/cf-page.php';
require get_template_directory() . '/inc/cf-service_category.php';
require get_template_directory() . '/inc/recommend.php';
require get_template_directory() . '/inc/custom_css.php';
require get_template_directory() . '/inc/seo.php';

/**
 * Manage OGP and Twitter Cards
 */
require get_template_directory() . '/inc/ogp.php';

/**
 * Add password protected pages
 */
require get_template_directory() . '/inc/password_form.php';

/**
 * Register widgets
 */
require get_template_directory() . '/inc/widgets/ad.php';
require get_template_directory() . '/inc/widgets/archive_list.php';
require get_template_directory() . '/inc/widgets/banner-list1.php';
require get_template_directory() . '/inc/widgets/banner-list2.php';
require get_template_directory() . '/inc/widgets/google_search.php';
require get_template_directory() . '/inc/widgets/styled-post-list.php';

/**
 * Test if the current browser runs on a mobile device
 */
function is_mobile() {

	// If you want to include tablets, use wp_is_mobile() function.
 	$match = 0;
	$ua = array(
  	'iPhone', // iPhone
   	'iPod', // iPod touch
		'Android.*Mobile', // 1.5+ Android *** Only mobile
		'Windows.*Phone', // *** Windows Phone
		'dream', // Pre 1.5 Android
		'CUPCAKE', // 1.5+ Android
		'BlackBerry', // BlackBerry
		'BB10', // BlackBerry10
		'webOS', // Palm Pre Experimental
		'incognito', // Other iPhone browser
		'webmate' // Other iPhone browser
	);

 	$pattern = '/' . implode( '|', $ua ) . '/i';
 	$match   = preg_match( $pattern, $_SERVER['HTTP_USER_AGENT'] );

	return 1 === $match ? TRUE : FALSE;
}

/**
 * Translate rgb to hex
 */
function hex2rgb( $hex ) {

   $hex = str_replace( '#', '', $hex );

   if( strlen( $hex ) == 3 ) {
      $r = hexdec( substr( $hex, 0, 1 ) . substr( $hex, 0, 1 ) );
      $g = hexdec( substr( $hex, 1, 1 ) . substr( $hex, 1, 1 ) );
      $b = hexdec( substr( $hex, 2, 1 ) . substr( $hex, 2, 1 ) );
   } else {
      $r = hexdec( substr( $hex, 0, 2 ) );
      $g = hexdec( substr( $hex, 2, 2 ) );
      $b = hexdec( substr( $hex, 4, 2 ) );
   }
   $rgb = array( $r, $g, $b );

   return $rgb;
}

/**
 * Get the version number of this theme
 */
function version_num() {
	if ( function_exists( 'wp_get_theme' ) ) {
		$theme_data = wp_get_theme();
 	} else {
   		$theme_data = get_theme_data( TEMPLATEPATH . '/style.css' );
 	}
	$current_version = $theme_data['Version'];
 	return $current_version;
}

/**
 * カードリンクパーツ
 */
function get_the_custom_excerpt( $content, $length ) {
	$length = ( $length ? $length : 70 ); // デフォルトの長さを指定する
  $content =  preg_replace( '/<!--more-->.+/is', '', $content ); // moreタグ以降削除
 	$content =  strip_shortcodes( $content ); // ショートコード削除
  $content =  strip_tags( $content ); // タグの除去
  $content =  str_replace( '&nbsp;', '', $content ); // 特殊文字の削除（今回はスペースのみ）
  $content =  mb_substr( $content, 0, $length ); // 文字列を指定した長さで切り取る
  return $content.'...';
}

/**
 * カードリンクショートコード
 *
 * @param array $atts ユーザーがショートコードタグに指定した属性
 * @return string カードリンクの HTML
 */
function clink_scode( $atts ) {

  // ユーザーがショートコードに指定した属性を、あらかじめ定義した属性と結合
  $atts = shortcode_atts(
    array(
      'url' => '',
      'title' => '',
      'excerpt' => ''
    ),
    $atts
  );

  if ( ! $atts['url'] ) return;

  // URL から投稿 ID を取得
  $id = url_to_postid( $atts['url'] );

  if ( $id ) {
    return get_internal_clink_html( $id, $atts );
  } else {
    return get_external_clink_html( $atts );
  }
}

/**
 * 内部リンクのカードリンクの HTML を作成
 *
 * @param int $id 投稿 ID
 * @param array $atts ユーザーがショートコードタグに指定した属性
 * @return string カードリンクの HTML
 */
function get_internal_clink_html( $id, $atts ) {

  // ID から投稿情報を取得
  $post = get_post( $id );

  // 投稿日を取得
  $date = mysql2date( 'Y.m.d', $post->post_date );

  // タイトルを取得
  $title = $atts['title'] ? $atts['title'] : get_the_title( $id );
  $title = is_mobile() ? wp_trim_words( $title, 42, '...' ) : $title;

  // 抜粋を取得
  $excerpt = $atts['excerpt'];

  if ( ! $excerpt ) {
    if ( $post->post_excerpt ) {
      $excerpt = get_the_custom_excerpt( $post->post_excerpt, 70 );
    } else {
      $excerpt = get_the_custom_excerpt( $post->post_content, 70 );
    }
  }

  $excerpt = is_mobile() ? wp_trim_words( $excerpt, 50, '...' ) : $excerpt;

  // アイキャッチ画像を取得
  if ( has_post_thumbnail( $id ) ) {
    $img = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), 'size-card' );
    $img = $img[0];
  } else {
    $img = get_template_directory_uri() . '/assets/images/240x240.gif';
  }

  $clink  = '<div class="cardlink">
    <a href="' . esc_url( $atts['url'] ) . '">
      <div class="cardlink_thumbnail">
        <img src="' . esc_attr( $img ) . '">
      </div>
    </a>
    <div class="cardlink_content">
      <span class="cardlink_timestamp">' . esc_html( $date ) . '</span>
      <div class="cardlink_title">
        <a href="' . esc_url( $atts['url'] ) . '">' . esc_html( $title ) . '</a>
      </div>
      <div class="cardlink_excerpt">' . esc_html( $excerpt ) . '</div>
    </div>
    <div class="cardlink_footer"></div>
  </div>' . "\n";

  return $clink;
}

require_once( 'inc/OpenGraph.php' );

/**
 * 外部リンクのカードリンクの HTML を作成
 *
 * @see OpenGraph::fetch()
 *
 * @param array $atts ユーザーがショートコードタグに指定した属性
 * @return string カードリンクの HTML
 */
function get_external_clink_html( $atts ) {

  $graph = OpenGraph::fetch( $atts['url'] );

  // タイトルを取得
  $title = $atts['title'] ? $atts['title'] : $graph->title;

  // 抜粋を取得
  $excerpt = $atts['excerpt'] ? $atts['excerpt'] : $graph->description;

  // 画像を取得
  $img = $graph->image ? $graph->image : get_template_directory_uri() . '/assets/images/240x240.gif';

  $clink  = '<div class="cardlink">
    <a href=' . esc_url( $atts['url'] ) . '">
      <div class="cardlink_thumbnail">
        <img src="' . esc_attr( $img ) . '">
      </div>
    </a>
    <div class="cardlink_content">
      <div class="cardlink_title">
        <a href="' . esc_url( $atts['url'] ) . '">' . esc_html( $title ) . '</a>
      </div>
      <div class="cardlink_excerpt">' . esc_html( $excerpt ) . '</div>
    </div>
    <div class="cardlink_footer"></div>
  </div>' . "\n";

  return $clink;
}
add_shortcode( 'clink', 'clink_scode' );

/**
 * Comment
 */
function custom_comments( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	global $commentcount;
	if ( ! $commentcount ) {
		$commentcount = 0;
	}
?>
<li id="comment-<?php comment_ID(); ?>" class="c-comment__list-item comment">
	<div class="c-comment__item-header u-clearfix">
		<div class="c-comment__item-meta u-clearfix">
<?php
	if ( function_exists( 'get_avatar' ) && get_option( 'show_avatars' ) ) {
		echo get_avatar( $comment, 35, '', false, array( 'class' => 'c-comment__item-avatar' ) );
	}
	if ( get_comment_author_url() ) {
		echo '<a id="commentauthor-' . get_comment_ID() . '" class="c-comment__item-author" rel="nofollow">' . get_comment_author() . '</a>' . "\n";
	} else {
		echo '<span id="commentauthor-' . get_comment_ID() . '" class="c-comment__item-author">' . get_comment_author() . '</span>' . "\n";
	}
?>
			<time class="c-comment__item-date" datetime="<?php comment_time( 'Y-m-d' ); ?>"><?php comment_time( __( 'F jS, Y', 'tcd-w' ) ); ?></time>
		</div>
		<ul class="c-comment__item-act">
<?php
	if ( 1 == get_option( 'thread_comments' ) ) :
?>
			<li><?php comment_reply_link( array_merge( $args, array( 'add_below' => 'comment-content', 'depth' => $depth, 'max_depth' => $args['max_depth'], 'reply_text' => __( 'REPLY', 'tcd-w' ) . '' ) ) ); ?></li>
<?php
	else :
?>
    	<li><a href="javascript:void(0);" onclick="MGJS_CMT.reply('commentauthor-<?php comment_ID() ?>', 'comment-<?php comment_ID() ?>', 'js-comment__textarea');"><?php _e( 'REPLY', 'tcd-w' ); ?></a></li>
<?php
	endif;
?>
    	<li><a href="javascript:void(0);" onclick="MGJS_CMT.quote('commentauthor-<?php comment_ID() ?>', 'comment-<?php comment_ID() ?>', 'comment-content-<?php comment_ID() ?>', 'js-comment__textarea');"><?php _e( 'QUOTE', 'tcd-w' ); ?></a></li>
    	<?php edit_comment_link( __( 'EDIT', 'tcd-w' ), '<li>', '</li>'); ?>
		</ul>
	</div>
	<div id="comment-content-<?php comment_ID() ?>" class="c-comment__item-body">
<?php
	if ( 0 == $comment->comment_approved ) {
		echo '<span class="c-comment__item-note">' . __( 'Your comment is awaiting moderation.', 'tcd-w' ) . '</span>' . "\n";
	} else {
		comment_text();
	}
?>
	</div>
<?php
}

if ( ! function_exists( 'wp_get_nav_menu_name' ) ) {

	function wp_get_nav_menu_name( $location ) {
		$menu_name = '';

		$locations = get_nav_menu_locations();

		if ( isset( $locations[ $location ] ) ) {
			$menu = wp_get_nav_menu_object( $locations[ $location ] );

	   	if ( $menu && $menu->name ) {
	    	$menu_name = $menu->name;
	    }
		}

	  /**
	   * Filters the navigation menu name being returned.
	   *
	   * @since 4.9.0
	   *
	   * @param string $menu_name Menu name.
	   * @param string $location  Menu location identifier.
	   */
		return apply_filters( 'wp_get_nav_menu_name', $menu_name, $location );
	}

}


// ウィジェットブロックエディターを無効化 --------------------------------------------------------------------------------
function exclude_theme_support() {
    remove_theme_support( 'widgets-block-editor' );
}
add_action( 'after_setup_theme', 'exclude_theme_support' );

// タイトルとurlをコピーのスクリプト --------------------------------------------------------------------------------
function copy_title_url_script() {
	$dp_options = get_design_plus_options();
  if (is_singular('post') && $dp_options['single_blog_show_copy_btm']) {
    wp_enqueue_script( 'copy_title_url', get_template_directory_uri().'/assets/js/copy_title_url.js', array(), version_num(), true );
  }
}
add_action( 'wp_enqueue_scripts', 'copy_title_url_script' );

// AJAXでのギャラリー記事取得
function ajax_get_gellery_items() {
  if ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) return;

  if ( isset( $_POST['offset_post_num'], $_POST['post_cat_id'] ) ) {
    get_template_part('ajax-item');
    exit;
  }
}
add_action( 'wp_ajax_get_gellery_items', 'ajax_get_gellery_items' );
add_action( 'wp_ajax_nopriv_get_gellery_items', 'ajax_get_gellery_items' );

function getHomeUrl($path) {
    return home_url().'/'.$path;
}

function echoHomeUrl($path) {
    echo getHomeUrl($path);
}

function getThemePath($path) {
    return get_theme_file_uri().'/'.$path;
}

function echoThemePath($path) {
    echo getThemePath($path);
}

function getAssetsPath($path) {
    return getThemePath('assets').'/'.$path;
}

function echoAssetsPath($path) {
    echo getAssetsPath($path);
}

function getImgPath($path) {
    return getAssetsPath('images').'/'.$path;
}

function echoImgPath($path) {
    echo getImgPath($path);
}

function getRoomLayout($num) {
    $layout = "";
    switch ($num) {
        case 1:
            $layout = "K";
            break;
        case 2:
            $layout = "DK";
            break;
        case 3:
            $layout = "LDK";
            break;
        case 4:
            $layout = "SDK";
            break;
        case 5:
            $layout = "SLDK";
            break;
        case 6:
            $layout = "ワンルーム";
            break;
    }
    return $layout;
}

function getArchitecture($num) {
    $data = "";
    switch ((int)$num) {
        case 1:
            $data = "RC";
            break;
        case 2:
            $data = "SRC";
            break;
        case 3:
            $data = "鉄骨";
            break;
        case 4:
            $data = "木造";
            break;
    }
    return $data;
}

function getEra($num) {
    $data = "";
    switch ($num) {
        case 1:
            $data = "昭和";
            break;
        case 2:
            $data = "平成";
            break;
        case 3:
            $data = "令和";
            break;
    }
    return $data;
}

function getAspect($num) {
    $data = "";
    switch ($num) {
        case 1:
            $data = "媒介";
            break;
    }
    return $data;
}

function getDelivery($num) {
    $data = "";
    switch ($num) {
        case 1:
            $data = "昭和";
            break;
        case 2:
            $data = "平成";
            break;
        case 3:
            $data = "即";
            break;
        case 4:
            $data = "相談";
            break;
        case 5:
            $data = "令和";
            break;
    }
    return $data;
}

function getActualCondition($num) {
    $data = "";
    switch ($num) {
        case 1:
            $data = "空き";
            break;
        case 2:
            $data = "入居中";
            break;
        case 3:
            $data = "賃貸中";
            break;
        case 4:
            $data = "リフォーム中";
            break;
        case 5:
            $data = "更地";
            break;
        case 6:
            $data = "建築中";
            break;
        case 7:
            $data = "上屋あり";
            break;
    }
    return $data;
}

function getSystemImgPath($type,$seq,$img_num,$is_thumbnail = true) {
    if($is_thumbnail) {
        $img_size = 't';
    } else {
        $img_size = 'd';
    }
    return "https://conetas-web.com/fujimoto5/web/images/$type/$img_size/".sprintf("%08d",$seq)."-".sprintf("%02d",$img_num).".jpg";
}

function apiGet($path) {
    if($_SERVER['HTTP_HOST']==='demo.lo') {
        $root = "http://127.0.0.1:8000/";
    } else {
        $root = "https://conetas-web.com/fujimoto5-2/api/public/";
    }
    $res = wp_remote_get($root.$path);
    return json_decode($res["body"]);
}

function apiPost($path, $array) {
    if($_SERVER['HTTP_HOST']==='demo.lo') {
        $root = "http://127.0.0.1:8000/";
    } else {
        $root = "https://conetas-web.com/fujimoto5-2/api/public/";
    }

    $res = wp_remote_post($root.$path, array(
        'method' => 'POST',
        'headers' => array(
            'content-Type' => 'application/json; charset=utf-8'
        ),
        'httpversion' => '1.0',
        'sslverify' => false,
        'body' => json_encode($array)));
    return json_decode($res["body"]);
}
