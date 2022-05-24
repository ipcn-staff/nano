<?php
$dp_options = get_design_plus_options();

$works_label = $dp_options['works_breadcrumb'] ? esc_html( $dp_options['works_breadcrumb'] ) : __( 'Works', 'tcd-w' );

get_header();

get_template_part( 'template-parts/breadcrumb' );
?>

<div class="l-contents l-contents--grid<?php if ( 'type2' === $dp_options['sidebar'] ) { echo '-rev'; } ?>">

  <div class="l-contents__inner l-inner">

    <?php get_template_part( 'template-parts/page-header' ); ?>

    <div class="l-primary">

      <?php
      if ( have_posts() ) :
        while ( have_posts() ) :
          the_post();
          $categories = get_the_terms( $post->ID, 'works_category' );
					$previous_post = get_previous_post();
          $next_post = get_next_post();
					$args = array(
            'post_type' => 'works',
            'post_status' => 'publish',
            'posts_per_page' => 6,
            'post__not_in' => array( $post->ID ),
            'orderby' => 'rand',
          );

          if ( $categories ) {
            $args['tax_query'] = array(
              array(
                'taxonomy' => 'works_category',
                'field' => 'term_id',
                'terms' => $categories[0]->term_id
              )
            );
          }

          $the_query = new WP_Query( $args );
      ?>
      <article class="p-works-entry">
        <header class="p-works-entry__header">

          <?php if ( $dp_options['works_show_thumbnail']  && has_post_thumbnail() ) : ?>
			    <div class="p-works-entry__img">
            <?php the_post_thumbnail( 'full' ); ?>
          </div>
          <?php endif; ?>

          <?php if ( $dp_options['works_show_category'] && $categories ) : ?>
          <a class="p-works-entry__cat" href="<?php echo get_category_link( $categories[0]->term_id ); ?>"><?php echo esc_html( $categories[0]->name ); ?></a>
          <?php endif; ?>

          <h1 class="p-works-entry__title"><?php the_title(); ?></h1>
        </header>

        <div class="p-entry__body">
        <?php
        the_content();
        if ( ! post_password_required() ) {
          wp_link_pages( array(
            'before' => '<div class="p-page-links">',
            'after' => '</div>',
            'link_before' => '<span>',
            'link_after' => '</span>'
          ) );
        }
        ?>
        </div>

        <?php if ( $dp_options['works_show_next_post'] && ( $previous_post || $next_post ) ) : ?>
			  <ul class="p-nav01 c-nav01 u-clearfix">
			  	<li class="p-nav01__item--prev p-nav01__item c-nav01__item c-nav01__item--prev"><?php if ( $previous_post ) : ?><a href="<?php echo esc_url( get_permalink( $previous_post->ID ) ); ?>" data-prev="<?php _e( 'Previous post', 'tcd-w' ); ?>"><span><?php echo esc_html( wp_trim_words( $previous_post->post_title, 26, '...' ) ); ?></span></a><?php endif; ?></li>
			  	<li class="p-nav01__item--next p-nav01__item c-nav01__item c-nav01__item--next"><?php if ( $next_post ) : ?><a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>" data-next="<?php _e( 'Next post', 'tcd-w' ); ?>"><span><?php echo esc_html( wp_trim_words( $next_post->post_title, 26, '...' ) ); ?></span></a><?php endif; ?></li>
			  </ul>
        <?php endif; ?>

      </article><!-- /.p-works-entry -->
      <?php
        endwhile;
      endif;
      ?>

      <?php if ( $dp_options['show_related_works'] && $the_query->have_posts() ) : ?>
      <section class="p-latest-works">
        <h2 class="p-latest-works__headline"><?php echo esc_html( $works_label ); ?></h2>

        <div class="p-latest-works__list">
          <?php
          while ( $the_query->have_posts() ) :
            $the_query->the_post();
          ?>
          <article class="p-latest-works__list-item p-article08">
            <a class="p-article08__img p-hover-effect--<?php echo esc_attr( $dp_options['hover_type'] ); ?>" href="<?php the_permalink(); ?>">
              <?php
              if ( has_post_thumbnail() ) {
                the_post_thumbnail( 'size7' );
              } else {
                echo '<img src="' . get_template_directory_uri() . '/assets/images/490x300.gif" alt="">';
              }
              ?>
            </a>
            <h3 class="p-article08__title">
              <a href="<?php the_permalink(); ?>"><?php echo wp_trim_words( get_the_title(), 28, '...' ); ?></a>
            </h3>
          </article>
          <?php
          endwhile;
          wp_reset_postdata();
          ?>
        </div>

     </section>
    <?php endif; ?>

    </div><!-- /.l-primary -->
    <?php get_sidebar(); ?>
  </div>
</div>

<?php get_footer(); ?>
