<?php
$dp_options = get_design_plus_options();

$tag = is_front_page() ? 'h1' : 'div';

$prefix = is_mobile() ? 'sp_' : '';

$logo_type = $dp_options[$prefix . 'header_use_logo_image'];
$logo_img = $dp_options[$prefix . 'header_logo_image'] ? wp_get_attachment_image_src( $dp_options[$prefix . 'header_logo_image'], 'full' ) : '' ;
$is_retina = $dp_options[$prefix . 'header_logo_image_retina'];

if ( $logo_img ) {
  $logo_width = $is_retina ? $logo_img[1] / 2 : $logo_img[1];
} else {
  $logo_width = null;
}
?>
<<?php echo $tag; ?> class="l-header__logo c-logo">
  <?php if ( 'type1' === $logo_type ) : ?>
  <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
  <?php else : ?>
  <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
    <img src="<?php echo esc_attr( $logo_img[0] ); ?>" alt="<?php bloginfo( 'name' ); ?>" width="<?php echo esc_attr( $logo_width ); ?>">
  </a>
  <?php endif; ?>
</<?php echo $tag; ?>>
