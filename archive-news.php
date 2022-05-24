<?php
$dp_options = get_design_plus_options();

$args = array(
  'prev_next' => false,
  'type' => 'array'
);

get_header();

get_template_part( 'template-parts/breadcrumb' );
?>

<div class="l-contents l-contents--grid<?php if ( 'type2' === $dp_options['sidebar'] ) { echo '-rev'; } ?>">

  <div class="l-contents__inner l-inner">

    <?php get_template_part( 'template-parts/page-header' ); ?>

    <div class="l-primary">

      <div id="js-news-tab-list" class="p-news-tab-list">
        <?php get_template_part( 'template-parts/news-tabs' ); ?>
        <?php get_template_part( 'template-parts/news-panels' ); ?>
      </div>

      <?php if ( paginate_links( $args ) && $dp_options['archive_pager_type'] == 'type2') : ?>
      <ul class="p-pager">
        <?php foreach ( paginate_links( $args ) as $link ) : ?>
        <li class="p-pager__item"><?php echo $link; ?></li>
        <?php endforeach; ?>
      </ul>
      <?php endif; ?>

    </div><!-- /.l-primary -->

    <?php get_sidebar(); ?>

  </div>

</div>

<?php get_footer(); ?>
