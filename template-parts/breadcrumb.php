<?php
$dp_options = get_design_plus_options();

$news_label = $dp_options['news_breadcrumb'] ? $dp_options['news_breadcrumb'] : __( 'News', 'tcd-w' );
$company_label = $dp_options['company_breadcrumb'] ? $dp_options['company_breadcrumb'] : __( 'Company', 'tcd-w' );
$service_label = $dp_options['service_breadcrumb'] ? $dp_options['service_breadcrumb'] : __( 'Service', 'tcd-w' );
$works_label = $dp_options['works_breadcrumb'] ? $dp_options['works_breadcrumb'] : __( 'Works', 'tcd-w' );

$breadcrumb_items = array(
  array(
    'name' => 'HOME',
    'url' => get_home_url( null, '/' )
  )
);

if ( is_post_type_archive( 'news' ) || is_singular( 'news' ) || is_tax( 'news_category' ) ) {

  $breadcrumb_items[] = array(
    'name' => $news_label,
    'url' => get_post_type_archive_link( 'news' )
  );

} elseif ( is_singular( 'company' ) ) {

  $breadcrumb_items[] = array(
    'name' => $company_label,
    'url' => get_post_type_archive_link( 'company' )
  );

} elseif ( is_tax( 'service_category' ) || is_singular( 'service' ) ) {

  $breadcrumb_items[] = array(
    'name' => $service_label,
    'url' => get_post_type_archive_link( 'service' )
  );

} elseif ( is_tax( 'works_category' ) || is_singular( 'works' ) ) {

  $breadcrumb_items[] = array(
    'name' => $works_label,
    'url' => get_post_type_archive_link( 'works' )
  );

} else {

  $breadcrumb_items[] = array(
    'name' => __( 'Blog', 'tcd-w' ),
    'url' => get_post_type_archive_link( 'post' )
  );

}

if ( is_category() || is_tax() ) {
  $queried_object = get_queried_object();
  $ancestors = get_ancestors( $queried_object->term_id, $queried_object->taxonomy, 'taxonomy' );

  foreach ( array_reverse( $ancestors ) as $ancestor ) {
    $term = get_term( $ancestor, $queried_object->taxonomy );

    $breadcrumb_items[] = array(
      'name' => $term->name,
      'url' => get_term_link( $term->term_id, $queried_object->taxonomy )
    );
  }

  $breadcrumb_items[] = array( 'name' => $queried_object->name );

} elseif ( is_singular( 'post' ) ) {

  $categories = get_the_category();
  $ancestors = get_ancestors( $categories[0]->term_id, 'category', 'taxonomy' );

  foreach ( array_reverse( $ancestors ) as $ancestor ) {
    $category = get_category( $ancestor );

    $breadcrumb_items[] = array(
      'name' => $category->name,
      'url' => get_category_link( $category->term_id )
    );
  }

  $breadcrumb_items[] = array(
    'name' => $categories[0]->name,
    'url' => get_category_link( $categories[0]->term_id )
  );

} elseif ( is_singular( 'service' ) || is_singular( 'works' ) ) {

  $post_type = get_post_type( $post );
  $taxonomy = $post_type . '_category';
  $terms = get_the_terms( $post->ID, $taxonomy );

  if ( $terms ) {

    $ancestors = get_ancestors( $terms[0]->term_id, $taxonomy, 'taxonomy' );

    foreach ( array_reverse( $ancestors ) as $ancestor ) {
      $term = get_term( $ancestor, $taxonomy );

      $breadcrumb_items[] = array(
        'name' => $term->name,
        'url' => get_term_link( $term->term_id, $taxonomy )
      );
    }

    $breadcrumb_items[] = array(
      'name' => $terms[0]->name,
      'url' => get_term_link( $terms[0]->term_id, $taxonomy )
    );
  }

}

if ( is_single() ) {
  $breadcrumb_items[] = array( 'name' => strip_tags( get_the_title() ) );
}

// Render
echo '<ol class="p-breadcrumb c-breadcrumb l-inner" itemscope itemtype="http://schema.org/BreadcrumbList">' . "\n";

for ( $i = 0, $len = count( $breadcrumb_items ); $i < $len; $i++ ) {

  // Add tags
  if ( $len - 1 !== $i ) {

    if ( 0 === $i ) {
      echo '<li class="p-breadcrumb__item c-breadcrumb__item c-breadcrumb__item--home" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">';
    } else {
      echo '<li class="p-breadcrumb__item c-breadcrumb__item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">';
    }
    echo '<a href="' . esc_url( $breadcrumb_items[$i]['url'] ) . '" itemprop="item"><span itemprop="name">' . esc_html( $breadcrumb_items[$i]['name'] ) . '</span></a>';
    echo '<meta itemprop="position" content="' . ( $i + 1 ) . '">';
    echo '</li>' . "\n";

  } else {
    echo '<li class="p-breadcrumb__item c-breadcrumb__item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name">' . esc_html( $breadcrumb_items[$i]['name'] ) . '</span>';
    echo '<meta itemprop="position" content="' . ( $i + 1 ) . '">';
    echo '</li>' . "\n";
  }
}
echo '</ol>' . "\n";
