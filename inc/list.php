<?php
function get_taxonomy_hierarchy( $taxonomy, $parent = 0 ) {

  $children = array();

  $terms = get_terms( $taxonomy, array( 'parent' => $parent ) );

  foreach ( $terms as $term ) {
    $term->children = get_taxonomy_hierarchy( $taxonomy, $term->term_id );
    $children[$term->term_id] = $term;
  }

  return $children;
}

function get_taxonomy_hierarchy_html( $current_term_id, $taxonomy, $terms_tree, $parent = 0 ) {

  $output = '';

  $output .= $parent ? '<ul class="p-list__item-sub" style="display: none;">' : '';

  $terms = get_terms( $taxonomy, array( 'parent' => $parent ) );

  foreach ( $terms as $term ) {

    $classname = 'p-list__item';

    if ( $current_term_id === $term->term_id ) {
      $classname .= ' is-current';

      if ( 0 === $term->parent ) {
        $classname .= ' is-parent';
      }
    }

    if ( $terms_tree[$term->term_id]->children ) {
      $classname .= ' p-list__item--has-children';
    }

    $output .= '<li class="' . $classname . '">';
    $output .= '<a href="' . get_term_link( $term, $taxonomy ) . '">';
    $output .= esc_html( $term->name );
    $output .= $terms_tree[$term->term_id]->children ? '<span class="p-list__item-toggle"></span>' : '';
    $output .= '</a>';

    $output .= $terms_tree[$term->term_id]->children
      ? get_taxonomy_hierarchy_html( $current_term_id, $taxonomy, $terms_tree[$term->term_id]->children, $term->term_id )
      : '';

    $output .= '</li>';
  }

  $output .= $parent ? '</ul>' : '';

  return $output;
}
