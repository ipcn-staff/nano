<?php
$dp_options = get_design_plus_options();

$args = array(
  'prev_next' => false,
  'type' => 'array'
);

$queried_object = get_queried_object();

get_header();

get_template_part( 'template-parts/breadcrumb' );
?>

<div class="l-contents l-contents--grid<?php if ( 'type2' === $dp_options['sidebar'] ) { echo '-rev'; } ?>">
  <div class="l-contents__inner l-inner">

    <?php get_template_part( 'template-parts/page-header' ); ?>

    <div class="l-primary">
      <section class="p-cat-list">
        <h2 class="p-cat-list__title"><?php echo esc_html( $queried_object->name ); ?></h2>

        <div class="p-cat-list__list">
          <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
          <article class="p-cat-list__list-item p-article07" data-aos="custom-fade">
            <a class="p-hover-effect--<?php echo esc_attr( $dp_options['hover_type'] ); ?>" href="<?php the_permalink(); ?>">
              <div class="p-article07__img">
                <?php
                if ( has_post_thumbnail() ) {
                  the_post_thumbnail( 'size1' );
                } else {
                  echo '<img src="' . get_template_directory_uri() . '/assets/images/740x440.gif" alt="">';
                }
                ?>
              </div>
              <h3 class="p-article07__title"><?php echo wp_trim_words( get_the_title(), 29, '...' ); ?></h3>
            </a>
          </article>
          <?php endwhile; endif; ?>
        </div><!-- /.p-cat-list -->

      </section>

      <?php if ( paginate_links( $args ) ) : ?>
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
