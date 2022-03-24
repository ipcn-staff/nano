<?php
$dp_options = get_design_plus_options();

$company_label = $dp_options['company_breadcrumb'] ? $dp_options['company_breadcrumb'] : __( 'Company', 'tcd-w' );
$service_label = $dp_options['service_breadcrumb'] ? $dp_options['service_breadcrumb'] : __( 'Service', 'tcd-w' );
?>
<ul id="js-list" class="p-list">
<?php
if ( is_singular( 'company' ) ) {

  $post_id = $post->ID;

  $args = array(
    'post_type' => 'company',
    'post_status' => 'publish',
    'posts_per_page' => -1
  );

  $the_query = new WP_Query( $args );

  if ( is_mobile() ) {
    echo '<li class="p-list__item p-list__item--has-children">';
    echo '<a href="' . get_post_type_archive_link( 'company' ) . '">';
    echo esc_html( $company_label );
    echo '<span class="p-list__item-toggle"></span>';
    echo '</a>';
    echo '<ul class="p-list__item-sub" style="display: none;">';
  }

  if ( $the_query->have_posts() ) {
    while( $the_query->have_posts() ) {
      $the_query->the_post();

      echo $post_id === $post->ID
        ? '<li class="p-list__item is-current is-parent">'
        : '<li class="p-list__item">';

      echo '<a href="' . get_the_permalink( $post->ID ) . '">' . get_the_title( $post->ID ) . '</a>';
      echo '</li>';
    }
    wp_reset_postdata();
  }

  if ( is_mobile() ) {
    echo '<li class="p-list__item">';
    echo '<button class="p-list__item-btn" aria-hidden="true">' . __( 'Close', 'tcd-w' ) . '</button>';
    echo '</li>';
    echo '</ul>';
    echo '</li>';
  }

} elseif ( is_category() || is_tax() ) {

  if(!is_mobile() && is_tax('news_category') && $dp_options['archive_pager_type']=='type2') return;

  $queried_object = get_queried_object();
  $taxonomy = get_taxonomy( $queried_object->taxonomy );
  $post_types = $taxonomy->object_type;
  $terms_tree = get_taxonomy_hierarchy( $queried_object->taxonomy );

  if ( is_mobile() ) {
    echo '<li class="p-list__item p-list__item--has-children">';
    echo '<a href="' . get_post_type_archive_link( $post_types[0] ) . '">';
    echo 'service' === $post_types[0] ? $service_label : __( 'Latest posts', 'tcd-w' );
    echo '<span class="p-list__item-toggle"></span>';
    echo '</a>';
    echo '<ul class="p-list__item-sub" style="display: none;">';
  }

  echo get_taxonomy_hierarchy_html( $queried_object->term_id, $queried_object->taxonomy, $terms_tree );

  if ( is_mobile() ) {
    echo '<li class="p-list__item">';
    echo '<button class="p-list__item-btn" aria-hidden="true">' . __( 'Close', 'tcd-w' ) . '</button>';
    echo '</li>';
    echo '</ul>';
    echo '</li>';
  }

} elseif ( is_single() ) {

  $post_type = get_post_type( $post );
  $taxonomy = 'post' === $post_type ? 'category' : $post_type . '_category';
  $terms = get_the_terms( $post->ID, $taxonomy );
  $term_id = $terms ? $terms[0]->term_id : null;
  $terms_tree = get_taxonomy_hierarchy( $taxonomy );

  if ( is_mobile() ) {
    echo '<li class="p-list__item p-list__item--has-children">';
    echo '<a href="' . get_post_type_archive_link( $post_type ) . '">';
    echo 'service' === $post_type ? $service_label : __( 'Latest posts', 'tcd-w' );
    echo '<span class="p-list__item-toggle"></span>';
    echo '</a>';
    echo '<ul class="p-list__item-sub" style="display: none;">';
  } elseif ( is_singular( 'post' ) ) {
    echo '<li class="p-list__item">';
    echo '<a href="' . get_post_type_archive_link( 'post' ) . '">' . __( 'Latest posts', 'tcd-w' ) . '</a>';
    echo '</li>';
  }

  echo get_taxonomy_hierarchy_html( $term_id, $taxonomy, $terms_tree );

  if ( is_mobile() ) {
    echo '<li class="p-list__item">';
    echo '<button class="p-list__item-btn" aria-hidden="true">' . __( 'Close', 'tcd-w' ) . '</button>';
    echo '</li>';
    echo '</ul>';
    echo '</li>';
  }

} else {

  $terms_tree = get_taxonomy_hierarchy( 'category' );

  if ( is_mobile() ) {
    echo '<li class="p-list__item p-list__item--has-children is-current">';
    echo '<a href="' . get_post_type_archive_link( 'post' ) . '">';
    echo __( 'Latest posts', 'tcd-w' );
    echo '<span class="p-list__item-toggle"></span>';
    echo '</a>';
    echo '<ul class="p-list__item-sub" style="display: none;">';
  } else {
    echo '<li class="p-list__item is-current is-parent">';
    echo '<a href="' . get_post_type_archive_link( 'post' ) . '">' . __( 'Latest posts', 'tcd-w' ) . '</a>';
    echo '</li>';
  }

  echo get_taxonomy_hierarchy_html( null, 'category', $terms_tree );

  if ( is_mobile() ) {
    echo '<li class="p-list__item">';
    echo '<button class="p-list__item-btn" aria-hidden="true">' . __( 'Close', 'tcd-w' ) . '</button>';
    echo '</li>';
    echo '</ul>';
    echo '</li>';
  }
}
?>
</ul>
