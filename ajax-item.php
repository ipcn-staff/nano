<?php
     $options = get_design_plus_option();

     $def_offset = is_mobile()? $options['archive_pager_type1_loaded_num_mobile'] : $options['archive_pager_type1_loaded_num'];
     $offset = isset( $_POST['offset_post_num'] ) ? $_POST['offset_post_num'] : $def_offset;
     $post_cat_id = isset( $_POST['post_cat_id'] ) ? $_POST['post_cat_id'] : '';
     $next_load_num = is_mobile()? $options['archive_pager_type1_next_num_mobile'] : $options['archive_pager_type1_next_num'];
     $posts_per_page = $next_load_num;

     if($post_cat_id){
       $all_query = new WP_Query( array('post_type' => 'news', 'post_status' => 'publish', 'posts_per_page' => -1, 'tax_query' => array( array( 'taxonomy' => 'news_category', 'field' => 'term_id', 'terms' => $post_cat_id ) )) );
       $all_post_count = $all_query->found_posts;
       $args = array( 'post_type' => 'news', 'post_status' => 'publish', 'posts_per_page' => $posts_per_page, 'offset' => $offset, 'orderby' => array('menu_order' => 'ASC', 'date' => 'DESC'), 'tax_query' => array( array( 'taxonomy' => 'news_category', 'field' => 'term_id', 'terms' => $post_cat_id ) ) );
     } else {
       $all_query = new WP_Query( array('post_type' => 'news', 'post_status' => 'publish', 'posts_per_page' => -1) );
       $all_post_count = $all_query->found_posts;
       $args = array( 'post_type' => 'news', 'post_status' => 'publish', 'posts_per_page' => $posts_per_page, 'offset' => $offset, 'orderby' => array('menu_order' => 'ASC', 'date' => 'DESC') );
     }

     $post_list_query = new wp_query($args);
     if($post_list_query->have_posts()):
       $entry_item = '';
       ob_start();
       while ( $post_list_query->have_posts() ) : $post_list_query->the_post();
         if(has_post_thumbnail()) {
           $image = get_post_meta($post->ID, 'news_list_image', true);
           if(empty($image)){
             $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size4' );
           } else {
             $image = wp_get_attachment_image_src( $image, 'full' );
           }
         } elseif($options['no_image1']) {
           $image = wp_get_attachment_image_src( $options['no_image1'], 'full' );
         } else {
           $image = array();
           $image[0] = esc_url(get_bloginfo('template_url')) . "/img/common/no_image2.gif";
         }
         /*$cat_id = '';
         $category = wp_get_post_terms( $post->ID, 'news_category' , array( 'orderby' => 'term_order' ));
         if ( $category && ! is_wp_error($category) ) {
           foreach ( $category as $cat ) :
             $cat_name = $cat->name;
             $cat_id = $cat->term_id;
             $cat_url = get_term_link($cat_id,'news_category');
             break;
           endforeach;
         };*/
         $news_cats = get_the_terms( $post->ID, 'news_category' );
?>
  <article class="item ajax_item offset_<?php echo $offset; ?> p-news-list__item p-article04" style="opacity:0; display:none;">
    <a href="<?php the_permalink(); ?>">
      <?php if ( $options['news_show_date'] ) : ?>
      <time class="p-article04__date" datetime="<?php the_time( 'Y-m-d' ); ?>"><?php the_time( 'Y.m.d' ); ?></time>
      <?php endif; ?>
      <?php if ( $options['news_show_category'] && $news_cats && !$post_cat_id ) : ?>
        <span class="p-article04__cat p-cat p-cat--sm p-cat--<?php echo esc_attr( $news_cats[0]->term_id ); ?>"><?php echo esc_html( $news_cats[0]->name ); ?></span>
      <?php endif; ?>
      <h3 class="p-article04__title"><?php echo wp_trim_words( get_the_title(), 43, '...' ); ?></h3>
    </a>
  </article>
<?php
       endwhile;
       $entry_item .= ob_get_contents();
       ob_end_clean();
     endif;

     wp_send_json( array(
       'html' => $entry_item,
       'remain' => $all_post_count - ( $offset + $post_list_query->post_count )
     ) );
?>