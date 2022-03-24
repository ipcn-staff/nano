<?php $dp_options = get_design_plus_options(); ?>
<?php get_header(); ?>
<?php get_template_part( 'template-parts/breadcrumb' ); ?>

<div class="l-contents l-contents--grid<?php if ( 'type2' === $dp_options['sidebar'] ) { echo '-rev'; } ?>">

  <div class="l-contents__inner l-inner">

    <?php get_template_part( 'template-parts/page-header' ); ?>

    <div class="l-primary">

      <?php
      if ( have_posts() ) :
        while ( have_posts() ) :
          the_post();
          $categories = get_the_terms( $post->ID, 'service_category' );
      ?>
      <article class="p-service-entry">

        <?php if ( $categories ) : ?>
        <div class="p-headline p-headline--lg"><?php echo esc_html( $categories[0]->name ); ?></div>
        <?php endif; ?>

        <header class="p-service-entry__header">
          <h1 class="p-service-entry__title"><?php the_title(); ?></h1>

          <?php if ( $dp_options['service_show_thumbnail'] && has_post_thumbnail() ) : ?>
          <div class="p-service-entry__img">
            <?php the_post_thumbnail( 'full' ); ?>
          </div>
          <?php endif; ?>

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
      </article>
      <?php
        endwhile;
      endif;
      ?>

    </div><!-- /.l-primary -->

    <?php get_sidebar(); ?>

  </div>
</div>

<?php get_footer(); ?>
