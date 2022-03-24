<?php
/**
 * Add data-megamenu attributes to the global navigation
 */
function nano_walker_nav_menu_start_el( $item_output, $item, $depth, $args ) {

  $dp_options = get_design_plus_options();

  if ( 'global' !== $args->theme_location ) return $item_output;

  if ( ! isset( $dp_options['megamenu'][$item->ID] ) ) return $item_output;

  if ( 'type1' === $dp_options['megamenu'][$item->ID] ) return $item_output;

  return sprintf( '<a href="%s" data-megamenu="js-megamenu%d">%s</a>', $item->url, $item->ID, $item->title );
}

add_filter( 'walker_nav_menu_start_el', 'nano_walker_nav_menu_start_el', 10, 4 );

function add_color_overlay_to_megamenu_a( $inline_styles, $dp_options ) {

  $menu_locations = get_nav_menu_locations();
  $nav_menus = wp_get_nav_menus();

  if ( ! isset( $menu_locations['global'] ) ) return $inline_styles;

  foreach ( $nav_menus as $menu ) {

    if ( $menu_locations['global'] !== $menu->term_id ) continue;

    $nav_menu_items = wp_get_nav_menu_items( $menu );

    foreach ( (array) $nav_menu_items as $item ) {

      if ( ! isset( $dp_options['megamenu'][$item->menu_item_parent] ) ) continue;

      if ( 'type2' === $dp_options['megamenu'][$item->menu_item_parent] ) {

        $overlay = get_term_meta( $item->object_id, 'overlay', true );
        $opacity = get_term_meta( $item->object_id, 'opacity', true );
        $textcolor = get_term_meta( $item->object_id, 'textcolor', true );
        if($textcolor==''){ $textcolor = '#ffffff'; };

        $inline_styles[] = array(
          'selectors' => sprintf( '.p-megamenu01__item--%d .p-megamenu01__item-img::before', $item->object_id ),
          'properties' => sprintf( 'background: rgba(%s, %f)', implode( ', ', hex2rgb( $overlay ) ), esc_html( $opacity ) )
        );
        $inline_styles[] = array(
          'selectors' => sprintf( '.p-megamenu01__item--%d a', $item->object_id ),
          'properties' => sprintf( 'color: %s', esc_html( $textcolor ) )
        );
      }
    }
  }

  return $inline_styles;
}
add_filter( 'tcd_inline_styles', 'add_color_overlay_to_megamenu_a', 10, 2 );

function render_megamenu_a( $id, $megamenus ) {
  $index = 0;
?>
<div id="js-megamenu<?php echo esc_attr( $id ); ?>" class="p-megamenu01 js-megamenu">
  <?php
  foreach ( $megamenus[$id] as $menu ) :
    if ( 'service_category' !== $menu->object ) continue;

    $term = get_term( $menu->object_id, 'service_category' );
    $children = get_terms( 'service_category', array( 'parent' => $term->term_id ) );
  ?>
  <div class="p-megamenu01__item p-megamenu01__item--<?php echo esc_attr( $menu->object_id ); ?>">
    <ul class="p-megamenu01__item-list" style="transition-delay: <?php echo 0.5 + 0.1 * $index++; ?>s;">
      <li>
        <a href="<?php echo esc_url( get_term_link( $term->term_id, 'service_category' ) ); ?>">
          <?php echo esc_html( $term->name ); ?>
        </a>
        <ul>
          <?php foreach ( $children as $child ) : ?>
          <li>
            <a href="<?php echo get_term_link( $child->term_id, 'service_category' ); ?>">
              <?php echo esc_html( $child->name ); ?>
            </a>
          </li>
          <?php endforeach; ?>
        </ul>
      </li>
    </ul>
    <div class="p-megamenu01__item-img">
      <?php
      if ( get_term_meta( $term->term_id, 'img', true ) ) {
        echo wp_get_attachment_image( get_term_meta( $term->term_id, 'img', true ), 'full' );
      }
      ?>
    </div>
  </div>
  <?php endforeach; ?>
</div>
<?php
}

function render_megamenu_b( $id, $megamenus ) {
  $dp_options = get_design_plus_options();
  $company_label = $dp_options['company_breadcrumb'] ? $dp_options['company_breadcrumb'] : __( 'Company', 'tcd-w' );
?>
<div id="js-megamenu<?php echo esc_attr( $id ); ?>" class="p-megamenu02 js-megamenu">
  <div class="p-megamenu02__inner l-inner">

    <div class="p-megamenu02__header">
      <div>
        <p class="p-megamenu02__title"><?php echo esc_html( $dp_options['company_title'] ); ?></p>
        <p class="p-megamenu02__sub"><?php echo esc_html( $dp_options['company_sub'] ); ?></p>
      </div>
      <a class="p-megamenu02__link" href="<?php echo get_post_type_archive_link( 'company' ); ?>">
        <?php printf( __( 'Go to %s', 'tcd-w' ), $company_label ); ?>
      </a>
    </div>

    <ul class="p-megamenu02__list">
      <?php
      foreach ( $megamenus[$id] as $menu ) :
        if ( 'company' !== $menu->object ) continue;

        $delim = strpos($menu->url, '=');
        if($delim){
          $this_slug = substr($menu->url, $delim+1);
          $post = get_page_by_path($this_slug , OBJECT , 'company');
          $post_id = $post->ID;
        }else{
          $post_id = url_to_postid( $menu->url );
        }
      ?>
      <li class="p-article13">
        <a href="<?php echo esc_url( $menu->url ); ?>">
          <div class="p-article13__img">
            <?php
            if ( has_post_thumbnail( $post_id ) ) {
              echo get_the_post_thumbnail( $post_id, 'size10' );
            }
            ?>
          </div>
          <div class="p-article13__content">
            <p class="p-article13__title"><?php echo esc_html( get_post_meta( $post_id, 'archive_title', true ) ); ?></p>
            <p class="p-article13__sub"><?php echo esc_html( get_post_meta( $post_id, 'archive_sub', true ) ); ?></p>
          </div>
        </a>
      </li>
      <?php endforeach; ?>
    </ul>

  </div>
</div>
<?php
}
