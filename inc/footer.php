<?php
function tcd_footer() {

	$dp_options = get_design_plus_options();

	if ( is_singular( array( 'post', 'news' ) ) ) :
    if ( /*'type5' == $dp_options['sns_type_top'] ||*/ 'type5' == $dp_options['sns_type_btm'] ) :
      if ( /*$dp_options['show_twitter_top'] ||*/ $dp_options['show_twitter_btm'] ) :
?>
<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
<?php
			endif;
      if ( /*$dp_options['show_fblike_top'] || $dp_options['show_fbshare_top'] ||*/ $dp_options['show_fblike_btm'] || $dp_options['show_fbshare_btm'] ) :
?>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/ja_JP/sdk.js#xfbml=1&version=v3.0';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<?php
			endif;
      if ( /*$dp_options['show_google_top'] ||*/ $dp_options['show_google_btm'] ) :
?>
<script src="https://apis.google.com/js/platform.js" async defer></script>
<?php
			endif;
      if ( /*$dp_options['show_hatena_top'] ||*/ $dp_options['show_hatena_btm'] ) :
?>
<script type="text/javascript" src="https://b.st-hatena.com/js/bookmark_button.js" charset="utf-8" async="async"></script>
<?php
			endif;
      if ( /*$dp_options['show_pocket_top'] ||*/ $dp_options['show_pocket_btm'] ) :
?>
<script type="text/javascript">!function(d,i){if(!d.getElementById(i)){var j=d.createElement("script");j.id=i;j.src="https://widgets.getpocket.com/v1/j/btn.js?v=1";var w=d.getElementById(i);d.body.appendChild(j);}}(document,"pocket-btn-js");</script>
<?php
			endif;
      if ( /*$dp_options['show_pinterest_top'] ||*/ $dp_options['show_pinterest_btm'] ) :
?>
<script async defer src="//assets.pinterest.com/js/pinit.js"></script>
<?php
			endif;
		endif;
	endif;
}
add_action( 'wp_footer', 'tcd_footer' );
