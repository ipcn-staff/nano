<?php
$dp_options = get_design_plus_options();

if ( is_post_type_archive( 'news' ) || is_singular( 'news' ) || is_tax( 'news_category' ) ) {

  $title = $dp_options['news_title'];
  $sub = $dp_options['news_sub'];

} elseif ( is_singular( 'company' ) ) {

  $title = $dp_options['company_title'];
  $sub = $dp_options['company_sub'];

} elseif ( is_tax( 'service_category' ) ) {

  $queried_object = get_queried_object();
  $ancestors = get_ancestors( $queried_object->term_id, $queried_object->taxonomy, 'taxonomy' );
  $ancestor = isset( $ancestors[0] ) ? get_term( $ancestors[count($ancestors) - 1], $queried_object->taxonomy ) : null;

  if ( $ancestor ) {
    $title = $ancestor->name;
    $sub = is_mobile() ? '' : get_term_meta( $ancestor->term_id, 'sub', true );
  } else {
    $title = $queried_object->name;
    $sub = is_mobile() ? '' : get_term_meta( $queried_object->term_id, 'sub', true );
  }

} elseif ( is_singular( 'service' ) ) {

  $terms = get_the_terms( $post->ID, 'service_category' );

  if ( $terms ) {

    $ancestors = get_ancestors( $terms[0]->term_id, $terms[0]->taxonomy, 'taxonomy' );
    $ancestor = isset( $ancestors[0] ) ? get_term( $ancestors[count($ancestors) - 1], $terms[0]->taxonomy ) : null;

    if ( $ancestor ) {
      $title = $ancestor->name;
      $sub = is_mobile() ? '' : get_term_meta( $ancestor->term_id, 'sub', true );
    } else {
      $title = $terms[0]->name;
      $sub = is_mobile() ? '' : get_term_meta( $terms[0]->term_id, 'sub', true );
    }

  } else {
    $title = $dp_options['service_title'];
    $sub = $dp_options['service_sub'];
  }

} elseif ( is_tax( 'works_category' ) || is_singular( 'works' ) ) {

  $title = $dp_options['works_title'];
  $sub = $dp_options['works_sub'];

} else {

  $title = $dp_options['blog_title'];
  $sub = $dp_options['blog_sub'];
}
?>
<header class="l-page-header<?php if ( is_post_type_archive( 'news' ) || is_singular( 'news' ) ) { echo ' pb0'; } ?>">
  <div class="p-page-header">
    <h1 class="p-page-header__title"><?php echo esc_html( $title ); ?></h1>
    <p class="p-page-header__sub"><?php echo esc_html( $sub ); ?></p>
  </div>
  <?php
  if ( ! is_post_type_archive() && ! is_singular( 'news' ) ) {
    get_template_part( 'template-parts/list' );
  }
  ?>
</header>
