<?php
$dp_options = get_design_plus_options();
$prefix = is_front_page() ? 'index_' : '';
?>

<?php if ( $dp_options[$prefix . 'news_tab_cat1'] || $dp_options[$prefix . 'news_tab_cat2'] || $dp_options[$prefix . 'news_tab_cat3'] || $dp_options[$prefix . 'news_tab_cat4'] ) : ?>
  <?php if(is_front_page()): // front page ?>
<div class="p-news-tab-list__tabs-wrapper">
  <ul class="p-news-tab-list__tabs">

    <li class="p-news-tab-list__tabs-item is-active">
      <a href="#news-tab-list__panel--all"><?php _e( 'Latest info', 'tcd-w' ); ?></a>
    </li>
    <?php
    for ( $i = 1; $i <= 4; $i++ ) {

      if ( ! $dp_options[$prefix . 'news_tab_cat' . $i] ) continue;

      $news_cat = get_term_by( 'id', $dp_options[$prefix . 'news_tab_cat' . $i], 'news_category' );

      echo '<li class="p-news-tab-list__tabs-item">';
      echo '<a href="#news-tab-list__panel--' . $i . '">';
      echo esc_html( $news_cat->name );
      echo '</a></li>';

    }
    ?>
  </ul>
</div>
  <?php else: // news archive page ?>
    <?php if($dp_options['archive_pager_type']=='type1'): ?>
<div class="p-news-tab-list__tabs-wrapper">
  <ul class="p-news-tab-list__tabs">

    <li class="p-news-tab-list__tabs-item is-active">
      <a href="#news-tab-list__panel--all"><?php _e( 'Latest info', 'tcd-w' ); ?></a>
    </li>
    <?php
    for ( $i = 1; $i <= 4; $i++ ) {

      if ( ! $dp_options[$prefix . 'news_tab_cat' . $i] ) continue;

      $news_cat = get_term_by( 'id', $dp_options[$prefix . 'news_tab_cat' . $i], 'news_category' );

      echo '<li class="p-news-tab-list__tabs-item">';
      echo '<a href="#news-tab-list__panel--' . $i . '">';
      echo esc_html( $news_cat->name );
      echo '</a></li>';

    }
    ?>
  </ul>
</div>
    <?php elseif($dp_options['archive_pager_type']=='type2'): ?>
<div class="p-news-tab-list__tabs-wrapper">
  <ul class="p-news-tab-list__tabs2">
    <?php if(is_post_type_archive('news')): ?>
    <li class="p-news-tab-list__tabs-item is-active">
    <?php else: ?>
    <li class="p-news-tab-list__tabs-item">
    <?php endif; ?>
      <a href="<?php echo get_post_type_archive_link('news'); ?>"><?php _e( 'Latest info', 'tcd-w' ); ?></a>
    </li>
    <?php
    for ( $i = 1; $i <= 4; $i++ ) {

      if ( ! $dp_options[$prefix . 'news_tab_cat' . $i] ) continue;

      $flag = is_tax('news_category', $dp_options[$prefix . 'news_tab_cat' . $i])? ' is-active': '';
      $news_cat = get_term_by( 'id', $dp_options[$prefix . 'news_tab_cat' . $i], 'news_category' );
      echo '<li class="p-news-tab-list__tabs-item'.$flag.'">';
      echo '<a href="' . esc_url(get_term_link($news_cat->term_id,'news_category')) . '">';
      echo esc_html( $news_cat->name );
      echo '</a></li>';

    }
    ?>
  </ul>
</div>
    <?php endif; // endif pager type ?>
  <?php endif; // endif is_front_page() ?>
<?php endif; ?>
