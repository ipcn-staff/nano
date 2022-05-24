<?php
$dp_options = get_design_plus_options();

$args = array(
  'prev_next' => false,
  'type' => 'array'
);

get_header();
?>

<div class="l-contents l-contents--no-border">

  <?php get_template_part( 'template-parts/cover' ); ?>

  <div class="l-contents__inner l-inner">
    <div class="l-primary">

      <?php get_template_part( 'template-parts/archive-header' ); ?>

      <div class="p-works-list">
        <?php
        if ( have_posts() ) :
          while ( have_posts() ) :
            the_post();
            $categories = get_the_terms( $post->ID, 'works_category' );
        ?>
        <article class="p-works-list__item p-article06" data-aos="custom-fade">
          <a class="p-article06__img p-hover-effect--<?php echo esc_attr( $dp_options['hover_type'] ); ?>" href="<?php the_permalink(); ?>">
            <?php
            if ( has_post_thumbnail() ) {
              the_post_thumbnail( 'size1' );
            } else {
              echo '<img src="' . get_template_directory_uri() . '/assets/images/740x440.gif" alt="">';
            }
            ?>
          </a>
          <div class="p-article06__content">
            <h3 class="p-article06__title">
              <a href="<?php the_permalink(); ?>"><?php echo wp_trim_words( get_the_title(), 29, '...' ); ?></a>
            </h3>
            <p class="p-article06__excerpt"><?php echo wp_trim_words( get_the_excerpt(), 63, '...' ); ?></p>
            <?php if ( $dp_options['works_show_category'] && $categories ) : ?>
            <a class="p-article06__cat" href="<?php echo get_category_link( $categories[0]->term_id ); ?>">
              <?php echo esc_html( $categories[0]->name ); ?>
            </a>
            <?php endif; ?>
          </div>
        </article>
        <?php
          endwhile;
        endif;
        ?>
      </div>

      <?php if ( paginate_links( $args ) ) : ?>
      <ul class="p-pager">
        <?php foreach ( paginate_links( $args ) as $link ) : ?>
        <li class="p-pager__item"><?php echo $link; ?></li>
        <?php endforeach; ?>
      </ul>
      <?php endif; ?>

    </div><!-- /.l-primary -->
  </div>
</div>

<?php get_footer(); ?>
