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
          $categories = get_the_terms( $post->ID, 'news_category' );
					$previous_post = get_previous_post();
          $next_post = get_next_post();
					$args = array(
            'post_type' => 'news',
            'post_status' => 'publish',
            'posts_per_page' => 10,
            'orderby' => 'date',
            'order' => 'DESC'
          );
          $the_query = new WP_Query( $args );
      ?>
      <article class="p-entry">

        <div class="p-entry__inner">

  	      <header class="p-entry__header">

            <?php if ( $dp_options['news_show_category'] && $categories ) : ?>
            <span class="p-entry__cat p-cat p-cat--<?php echo esc_attr( $categories[0]->term_id ); ?>"><?php echo esc_html( $categories[0]->name ); ?></span>
            <?php endif; ?>

            <h1 class="p-entry__title"><?php the_title(); ?></h1>

            <?php if ( $dp_options['news_show_date'] ) : ?>
            <time class="p-entry__date" datetime="<?php the_time( 'Y-m-d' ); ?>"><?php the_time( 'Y.m.d' ); ?></time>
            <?php endif; ?>

          </header>

          <?php if ( $dp_options['news_show_thumbnail']  && has_post_thumbnail() ) : ?>
  	      <div class="p-entry__img">
            <?php the_post_thumbnail( 'full' ); ?>
          </div>
          <?php endif; ?>

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

          <?php if ( $dp_options['news_show_sns_btm'] ) { get_template_part( 'template-parts/sns-btn-btm' ); } ?>

          <?php if ( $dp_options['news_show_next_post'] && ( $previous_post || $next_post ) ) : ?>
			    <ul class="p-nav01 c-nav01 u-clearfix">
			    	<li class="p-nav01__item--prev p-nav01__item c-nav01__item c-nav01__item--prev"><?php if ( $previous_post ) : ?><a href="<?php echo esc_url( get_permalink( $previous_post->ID ) ); ?>" data-prev="<?php _e( 'Previous post', 'tcd-w' ); ?>"><span><?php echo esc_html( wp_trim_words( $previous_post->post_title, 26, '...' ) ); ?></span></a><?php endif; ?></li>
			    	<li class="p-nav01__item--next p-nav01__item c-nav01__item c-nav01__item--next"><?php if ( $next_post ) : ?><a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>" data-next="<?php _e( 'Next post', 'tcd-w' ); ?>"><span><?php echo esc_html( wp_trim_words( $next_post->post_title, 26, '...' ) ); ?></span></a><?php endif; ?></li>
			    </ul>
          <?php endif; ?>

  	    </div>
      </article>
      <?php
        endwhile;
      endif;
      ?>

      <?php get_template_part( 'template-parts/ad-btm' ); ?>

      <?php if ( $dp_options['news_show_latest_post'] ) : ?>
      <section class="p-latest-news">
        <h2 class="p-headline"><?php _e( 'Latest posts', 'tcd-w' ); ?></h2>
        <ul class="p-news-list">
          <?php
          if ( $the_query->have_posts() ) :
            while ( $the_query->have_posts() ) :
              $the_query->the_post();
              $categories = get_the_terms( $post->ID, 'news_category' );
          ?>
          <li class="p-news-list__item p-article04">
            <a href="<?php the_permalink(); ?>">
              <?php if ( $dp_options['news_show_date'] ) : ?>
              <time class="p-article04__date" datetime="<?php the_time( 'Y-m-d' ); ?>"><?php the_time( 'Y.m.d' ); ?></time>
              <?php endif; ?>
              <?php if ( $dp_options['news_show_category'] && $categories ) : ?>
              <span class="p-article04__cat p-cat p-cat--sm p-cat--<?php echo esc_attr( $categories[0]->term_id ); ?>"><?php echo esc_html( $categories[0]->name ); ?></span>
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
      </section>
      <?php endif; ?>

    </div><!-- /.l-primary -->

    <?php get_sidebar(); ?>

  </div>
</div>

<?php get_footer(); ?>
