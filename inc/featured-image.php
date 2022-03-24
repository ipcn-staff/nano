<?php
/**
 * Add recommended image sizes
 */
function add_recommended_image_size( $content, $post_id ) {

  $post_type = get_post_type( $post_id );

  switch ( $post_type ) {
    case 'company' :
      $content .= '<p>' . __( 'Recommended image size. Width: 1180px, Height: 480px', 'tcd-w' ) . '</p>' . "\n";
      break;
  }

  return $content;

}

add_filter( 'admin_post_thumbnail_html', 'add_recommended_image_size', 10, 2 );
