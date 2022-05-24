<?php
$dp_options = get_design_plus_options();
$prefix = is_front_page() ? 'index_' : '';
?>

<?php if(is_front_page()): ?>
<ul id="news-tab-list__panel--all" class="p-news-tab-list__panel p-news-list is-active">

  <?php
    $args = array(
      'post_type' => 'news',
      'post_status' => 'publish',
      'posts_per_page' => $dp_options['index_news_num']
    );

    $the_query = new WP_Query( $args );

    if ( $the_query->have_posts() ) :
      while ( $the_query->have_posts() ) :
        $the_query->the_post();
        $news_cats = get_the_terms( $post->ID, 'news_category' );
  ?>
  <li class="p-news-list__item p-article04">
    <a href="<?php the_permalink(); ?>">
      <?php if ( $dp_options['news_show_date'] ) : ?>
      <time class="p-article04__date" datetime="<?php the_time( 'Y-m-d' ); ?>"><?php the_time( 'Y.m.d' ); ?></time>
      <?php endif; ?>
      <?php if ( $dp_options['news_show_category'] && $news_cats ) : ?>
        <span class="p-article04__cat p-cat p-cat--sm p-cat--<?php echo esc_attr( $news_cats[0]->term_id ); ?>"><?php echo esc_html( $news_cats[0]->name ); ?></span>
      <?php endif; ?>
      <h3 class="p-article04__title"><?php echo wp_trim_words( get_the_title(), 43, '...' ); ?></h3>
    </a>
  </li>
  <?php
      endwhile;
      wp_reset_postdata();
    endif;
  ?>

</ul>

<?php for ( $i = 1; $i <= 4; $i++ ) : ?>

  <?php if ( $dp_options[$prefix . 'news_tab_cat' . $i] ) : ?>
  <ul id="news-tab-list__panel--<?php echo $i; ?>" class="p-news-tab-list__panel p-news-list">
    <?php
    $tab_args = array(
      'post_type' => 'news',
      'post_status' => 'publish',
      'posts_per_page' => is_front_page() ? $dp_options['index_news_num'] : -1,
      'tax_query' => array(
        array(
          'taxonomy' => 'news_category',
          'field' => 'term_id',
          'terms' => $dp_options[$prefix . 'news_tab_cat' . $i]
        )
      )
    );
    $tab_query = new WP_Query( $tab_args );

    if ( $tab_query->have_posts() ) :
      while ( $tab_query->have_posts() ) :
        $tab_query->the_post();
    ?>
    <li class="p-news-list__item p-article04">
      <a href="<?php the_permalink(); ?>">

        <?php if ( $dp_options['news_show_date'] ) : ?>
        <time class="p-article04__date" datetime="<?php the_time( 'Y-m-d' ); ?>"><?php the_time( 'Y.m.d' ); ?></time>
        <?php endif; ?>

        <h3 class="p-article04__title"><?php echo wp_trim_words( get_the_title(), 43, '...' ); ?></h3>
      </a>
    </li>
    <?php
      endwhile;
      wp_reset_postdata();
    endif;
    ?>
  </ul>
  <?php endif; ?>

<?php endfor; ?>
<?php else: // news archive page ?>
<?php // TYPE1
if($dp_options['archive_pager_type'] == 'type1'):
  // 最新記事一覧 -------------------------
  $post_num = $dp_options['archive_pager_type1_loaded_num'];
  if(is_mobile()){
   $post_num = $dp_options['archive_pager_type1_loaded_num_mobile'];
  }
  $load_button_label = $dp_options['archive_pager_type1_button_label'];
?>
<div id="news-tab-list__panel--all" class="p-news-tab-list__panel p-news-list news_list_wrap is-active">
  <div class="news_list ajax_post_list">
<?php
  $args = array( 'post_type' => 'news', 'posts_per_page' => $post_num );
  $post_list_query = new wp_query($args);
  $all_post_count = $post_list_query->found_posts;
  if($post_list_query->have_posts()):
   while ( $post_list_query->have_posts() ) : $post_list_query->the_post();
      $news_cats = get_the_terms( $post->ID, 'news_category' );
?>
  <article class="p-news-list__item p-article04 item animate">
    <a href="<?php the_permalink(); ?>">
      <?php if ( $dp_options['news_show_date'] ) : ?>
      <time class="p-article04__date" datetime="<?php the_time( 'Y-m-d' ); ?>"><?php the_time( 'Y.m.d' ); ?></time>
      <?php endif; ?>
      <?php if ( $dp_options['news_show_category'] && $news_cats ) : ?>
        <span class="p-article04__cat p-cat p-cat--sm p-cat--<?php echo esc_attr( $news_cats[0]->term_id ); ?>"><?php echo esc_html( $news_cats[0]->name ); ?></span>
      <?php endif; ?>
      <h3 class="p-article04__title"><?php echo wp_trim_words( get_the_title(), 43, '...' ); ?></h3>
    </a>
  </article>
<?php
    endwhile;
  endif;
?>
  </div>
   <?php if($all_post_count > $post_num) { ?>
   <div class="entry-more" data-catid="" data-offset-post="<?php echo esc_attr($post_num); ?>">
    <span><?php echo esc_html($load_button_label); ?></span>
   </div>
   <div class="entry-loading"><?php _e( 'LOADING...', 'tcd-w' ); ?></div>
   <?php }; ?>
</div>
<?php for ( $i = 1; $i <= 4; $i++ ) : // カテゴリー別記事一覧 ?>
  <?php if ( $dp_options[$prefix . 'news_tab_cat' . $i] ) : ?>
<div id="news-tab-list__panel--<?php echo $i; ?>" class="p-news-tab-list__panel p-news-list news_list_wrap">
  <div class="news_list ajax_post_list">
    <?php
    $tab_args = array(
      'post_type' => 'news',
      'post_status' => 'publish',
      'posts_per_page' => $post_num,
      'tax_query' => array(
        array(
          'taxonomy' => 'news_category',
          'field' => 'term_id',
          'terms' => $dp_options[$prefix . 'news_tab_cat' . $i]
        )
      )
    );
    $tab_query = new WP_Query( $tab_args );
    $all_post_count = $tab_query->found_posts;

    if ( $tab_query->have_posts() ) :
      while ( $tab_query->have_posts() ) :
        $tab_query->the_post();
    ?>
    <article class="p-news-list__item p-article04">
      <a href="<?php the_permalink(); ?>">

        <?php if ( $dp_options['news_show_date'] ) : ?>
        <time class="p-article04__date" datetime="<?php the_time( 'Y-m-d' ); ?>"><?php the_time( 'Y.m.d' ); ?></time>
        <?php endif; ?>

        <h3 class="p-article04__title"><?php echo wp_trim_words( get_the_title(), 43, '...' ); ?></h3>
      </a>
    </article>
    <?php
      endwhile;
      wp_reset_postdata();
    endif;
    ?>
  </div>
   <?php if($all_post_count > $post_num) { ?>
   <div class="entry-more" data-catid="<?php echo esc_attr($dp_options[$prefix . 'news_tab_cat' . $i]); ?>" data-offset-post="<?php echo esc_attr($post_num); ?>">
    <span><?php echo esc_html($load_button_label); ?></span>
   </div>
   <div class="entry-loading"><?php _e( 'LOADING...', 'tcd-w' ); ?></div>
   <?php }; ?>
</div>
  <?php endif; ?>
<?php endfor; ?>

<?php // TYPE2
elseif($dp_options['archive_pager_type'] == 'type2'):
?>
<ul id="news-tab-list__panel--all" class="p-news-tab-list__panel p-news-list is-active">
  <?php
    if ( have_posts() ) :
      while ( have_posts() ) :
        the_post();
        $news_cats = get_the_terms( $post->ID, 'news_category' );
  ?>
  <li class="p-news-list__item p-article04">
    <a href="<?php the_permalink(); ?>">
      <?php if ( $dp_options['news_show_date'] ) : ?>
      <time class="p-article04__date" datetime="<?php the_time( 'Y-m-d' ); ?>"><?php the_time( 'Y.m.d' ); ?></time>
      <?php endif; ?>
      <?php if ( $dp_options['news_show_category'] && $news_cats && !is_tax('news_category') ) : ?>
        <span class="p-article04__cat p-cat p-cat--sm p-cat--<?php echo esc_attr( $news_cats[0]->term_id ); ?>"><?php echo esc_html( $news_cats[0]->name ); ?></span>
      <?php endif; ?>
      <h3 class="p-article04__title"><?php echo wp_trim_words( get_the_title(), 43, '...' ); ?></h3>
    </a>
  </li>
  <?php
      endwhile;
      wp_reset_postdata();
    endif;
  ?>
</ul>
<?php endif; // endif pager type ?>
<?php endif; ?>