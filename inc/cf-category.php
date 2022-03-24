<?php
/**
 * Add color settings to the category
 */

// Add form fields to edit-tags.php (Add New Category)
function nano_category_add_form_fields() {
  ?>
  <div class="form-field term-color">
    <label for="color"><?php _e( 'Category color', 'tcd-w' ); ?></label>
    <input name="color" id="color" class="c-color-picker" type="text" value="#000000" data-default-color="#000000">
  </div>
  <?php
}

// Add form fields to term.php (Edit Category)
function nano_edit_category_form_fields( $tag ) {
  ?>
  <tr class="form-field term-color-wrap">
  	<th scope="row"><label for="color"><?php _e( 'Category color', 'tcd-w' ); ?></label></th>
    <td>
      <input name="color" id="color" class="c-color-picker" type="text" value="<?php echo esc_attr( get_term_meta( $tag->term_id, 'color', true ) ); ?>" data-default-color="#000000">
    </td>
  </tr>
  <?php
}

// Save
function nano_save_category( $term_id ) {
  $meta_keys = array( 'color' );

  foreach ( $meta_keys as $meta_key ) {
    $old = get_term_meta( $term_id, $meta_key, true );
    $new = isset( $_POST[$meta_key] ) ? $_POST[$meta_key] : '';

    if ( $new && $new !== $old ) {
      update_term_meta( $term_id, $meta_key, $new );
    } elseif ( '' === $new && $old ) {
      delete_term_meta( $term_id, $meta_key, $old );
    }
  }
}

add_action( 'category_add_form_fields', 'nano_category_add_form_fields' );
add_action( 'edit_category_form_fields', 'nano_edit_category_form_fields' );
add_action( 'created_category', 'nano_save_category' );
add_action( 'edited_category', 'nano_save_category' );

add_action( 'news_category_add_form_fields', 'nano_category_add_form_fields' );
add_action( 'news_category_edit_form_fields', 'nano_edit_category_form_fields' );
add_action( 'created_news_category', 'nano_save_category' );
add_action( 'edited_news_category', 'nano_save_category' );
