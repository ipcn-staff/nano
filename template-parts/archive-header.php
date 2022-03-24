<?php
$dp_options = get_design_plus_options();

if ( is_page() ) {

  $catch = $post->catch_and_desc_catch;
  $desc = $post->catch_and_desc_desc;

} elseif ( is_post_type_archive() ){

  $queried_object = get_queried_object();
  $post_type = $queried_object->name;

  $catch = $dp_options[$post_type . '_archive_catch'];
  $desc = $dp_options[$post_type . '_archive_desc'];

} elseif ( is_tax( 'service_category' ) ) {

  $queried_object = get_queried_object();

  $catch = get_term_meta( $queried_object->term_id, 'tax_catch', true );
  $desc = get_term_meta( $queried_object->term_id, 'tax_desc', true );

}
?>
<div class="p-archive-header<?php if ( is_tax( 'service_category' ) ) { echo ' p-archive-header--no-shadow'; } ?>">
  <h2 class="p-archive-header__title"><?php echo nl2br( esc_html( $catch ) ); ?></h2>
  <p class="p-archive-header__desc"><?php echo nl2br( esc_html( $desc ) ); ?></p>
</div>
