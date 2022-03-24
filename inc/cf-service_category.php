<?php
/**
 * Add settings to service categories
 */

// Add form fields to edit-tags.php (Add New Category)
function nano_service_category_add_form_fields() {
  ?>
  <h3><?php _e( 'Archive page settings', 'tcd-w' ); ?></h3>
  <div class="form-field term-sub">
    <label for="sub"><?php _e( 'Sub title', 'tcd-w' ); ?></label>
    <input type="text" name="sub" id="sub" value="">
  </div>
  <div class="form-field term-desc">
    <label for="desc"><?php _e( 'Description', 'tcd-w' ); ?></label>
    <textarea name="desc" id="desc"></textarea>
  </div>
  <div class="form-field term-img">
    <div class="image_box cf">
    	<div class="cf cf_media_field hide-if-no-js">
    		<input type="hidden" value="" id="img" name="img" class="cf_media_id">
    		<div class="preview_field"></div>
    		<div class="button_area">
    			<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
    			<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button hidden">
    		</div>
    	</div>
    </div>
    <p><?php _e( 'Recommended image size: Width: 1180px, Height: 860px', 'tcd-w' ); ?></p>
  </div>
  <h3><?php _e( 'Taxonomy archive page settings', 'tcd-w' ); ?></h3>
  <div class="form-field term-tax_catch">
    <label for="tax_catch"><?php _e( 'Catchphrase', 'tcd-w' ); ?></label>
    <textarea name="tax_catch" id="tax_catch"></textarea>
  </div>
  <div class="form-field term-tax_desc">
    <label for="tax_desc"><?php _e( 'Description', 'tcd-w' ); ?></label>
    <textarea name="tax_desc" id="tax_desc"></textarea>
  </div>
  <h3><?php _e( 'Megamenu settings', 'tcd-w' ); ?></h3>
  <div class="form-field term-textcolor">
    <label for="textcolor"><?php _e( 'Text color', 'tcd-w' ); ?></label>
    <input type="text" class="c-color-picker" name="textcolor" id="textcolor" data-defalt-color="#ffffff" value="#ffffff">
  </div>
  <div class="form-field term-overlay">
    <label for="overlay"><?php _e( 'Color overlay on the background image', 'tcd-w' ); ?></label>
    <input type="text" class="c-color-picker" name="overlay" id="overlay" data-defalt-color="#000000" value="#000000">
  </div>
  <div class="form-field term-opacity">
    <label for="opacity"><?php _e( 'Opacity of the overlay on the background image', 'tcd-w' ); ?></label>
    <input type="number" min="0" max="1" step="0.1" name="opacity" id="opacity" value="0">
  </div>
  <?php
}

// Add form fields to term.php (Edit Category)
function nano_edit_service_category_form_fields( $tag ) {
  $img = get_term_meta( $tag->term_id, 'img', true );
  ?>
  </table>
  <h2><?php _e( 'Archive page settings', 'tcd-w' ); ?></h2>
  <table class="form-table">
    <tr class="form-field term-sub-wrap">
      <th scope="row">
        <label for="sub"><?php _e( 'Sub title', 'tcd-w' ); ?></label>
      </th>
      <td>
        <input name="sub" id="sub" type="text" value="<?php echo esc_attr( get_term_meta( $tag->term_id, 'sub', true ) ); ?>">
      </td>
    </tr>
    <tr class="form-field term-desc-wrap">
      <th scope="row">
        <label for="desc"><?php _e( 'Description', 'tcd-w' ); ?></label>
      </th>
      <td>
        <textarea name="desc" id="desc"><?php echo esc_textarea( get_term_meta( $tag->term_id, 'desc', true ) ); ?></textarea>
      </td>
    </tr>
    <tr class="form-field">
    	<th scope="row"><label for="img"><?php _e( 'Image', 'tcd-w' ); ?></label></th>
      <td>
  			<div class="image_box cf">
  				<div class="cf cf_media_field hide-if-no-js">
  					<input type="hidden" value="<?php if ( isset( $img ) ) { echo esc_attr( $img ); } ?>" id="img" name="img" class="cf_media_id">
  					<div class="preview_field"><?php if ( isset( $img ) ) { echo wp_get_attachment_image( $img, 'medium' ); } ?></div>
  					<div class="button_area">
  						<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
  						<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! isset( $img ) ) { echo 'hidden'; } ?>">
  					</div>
  				</div>
  			</div>
        <p><?php _e( 'Recommended image size: Width: 1180px, Height: 860px', 'tcd-w' ); ?></p>
      </td>
    </tr>
  </table>
  <h2><?php _e( 'Taxonomy archive page settings', 'tcd-w' ); ?></h2>
  <table class="form-table">
    <tr class="form-field term-tax_catch-wrap">
      <th scope="row">
        <label for="tax_catch"><?php _e( 'Catchphrase', 'tcd-w' ); ?></label>
      </th>
      <td>
        <textarea name="tax_catch" id="tax_catch"><?php echo esc_textarea( get_term_meta( $tag->term_id, 'tax_catch', true ) ); ?></textarea>
      </td>
    </tr>
    <tr class="form-field term-tax_desc-wrap">
      <th scope="row">
        <label for="tax_desc"><?php _e( 'Description', 'tcd-w' ); ?></label>
      </th>
      <td>
        <textarea name="tax_desc" id="tax_desc"><?php echo esc_textarea( get_term_meta( $tag->term_id, 'tax_desc', true ) ); ?></textarea>
      </td>
    </tr>
  </table>
  <h2><?php _e( 'Megamenu settings', 'tcd-w' ); ?></h2>
  <table class="form-table">
    <tr class="form-field term-textcolor-wrap">
      <th scope="row">
        <label for="textcolor"><?php _e( 'Text color', 'tcd-w' ); ?></label>
      </th>
      <td>
        <input type="text" class="c-color-picker" name="textcolor" id="textcolor" value="<?php echo esc_attr( get_term_meta( $tag->term_id, 'textcolor', true ) ); ?>" data-default-color="#ffffff">
      </td>
    </tr>
    <tr class="form-field term-overlay-wrap">
      <th scope="row">
        <label for="overlay"><?php _e( 'Color overlay on the background image', 'tcd-w' ); ?></label>
      </th>
      <td>
        <input type="text" class="c-color-picker" name="overlay" id="overlay" value="<?php echo esc_attr( get_term_meta( $tag->term_id, 'overlay', true ) ); ?>" data-default-color="#000000">
      </td>
    </tr>
    <tr class="form-field term-opacity-wrap">
      <th scope="row">
        <label for="opacity"><?php _e( 'Opacity of the overlay on the background image', 'tcd-w' ); ?></label>
      </th>
      <td>
      <input type="number" min="0" max="1" step="0.1" name="opacity" id="opacity" value="<?php echo esc_attr( get_term_meta( $tag->term_id, 'opacity', true ) ); ?>">
      </td>
    </tr>
  <?php
}

// Save
function nano_save_service_category( $term_id ) {
  $meta_keys = array(
    'sub',
    'desc',
    'img',
    'tax_catch',
    'tax_desc',
    'textcolor',
    'overlay',
    'opacity'
  );

  foreach ( $meta_keys as $meta_key ) {
    $old = get_term_meta( $term_id, $meta_key, true );
    $new = isset( $_POST[$meta_key] ) ? $_POST[$meta_key] : '';

    if ( isset( $new ) && $new !== $old ) {
      update_term_meta( $term_id, $meta_key, $new );
    } elseif ( '' === $new && $old ) {
      delete_term_meta( $term_id, $meta_key, $old );
    }
  }
}

add_action( 'service_category_add_form_fields', 'nano_service_category_add_form_fields' );
add_action( 'service_category_edit_form_fields', 'nano_edit_service_category_form_fields' );
add_action( 'created_service_category', 'nano_save_service_category' );
add_action( 'edited_service_category', 'nano_save_service_category' );
