<?php
$dp_options = get_design_plus_options();

if ( is_page() ) {
  $ph_title = $post->ph_title;
  $ph_sub = $post->ph_sub;
} elseif ( is_404() ) {
  $ph_title = $dp_options['404_ph_title'];
  $ph_sub = $dp_options['404_ph_sub'];
} elseif ( is_post_type_archive() ) {
  $queried_object = get_queried_object();
  $post_type = $queried_object->name;

  $title = $dp_options[$post_type . '_title'];
  $sub = $dp_options[$post_type . '_sub'];
  $ph_title = $dp_options[$post_type . '_ph_title'];
  $ph_sub = $dp_options[$post_type . '_ph_sub'];
}
?>
<header class="p-cover<?php if ( is_404() || is_page() ) { echo ' mt0'; } ?>">
  <?php if ( ! is_404() && ! is_page() ) : ?>
  <div class="p-cover__header">
    <span class="p-cover__header-title"><?php echo esc_html( $title ); ?></span>
    <span class="p-cover__header-sub"><?php echo esc_html( $sub ); ?></span>
  </div>
  <?php endif; ?>
  <div class="p-cover__inner">
    <h1 class="p-cover__title"><?php echo esc_html( $ph_title ); ?></h1>
    <p class="p-cover__sub"><?php echo esc_html( $ph_sub ); ?></p>
  </div>
</header>
