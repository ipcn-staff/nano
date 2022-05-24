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
          $categories = get_the_category();
          $pagenation_type = 'type3' === $post->pagenation_type ? $dp_options['pagenation_type'] : $post->pagenation_type;
					$previous_post = get_previous_post();
          $next_post = get_next_post();
					$args = array(
            'post_type' => 'post',
            'post_status' => 'publish',
            'posts_per_page' => 6,
            'post__not_in' => array( $post->ID ),
            'category_name' => $categories[0]->slug,
            'orderby' => 'rand',
          );
          $the_query = new WP_Query( $args );
      ?>
      <article class="p-entry">

        <div class="p-entry__inner">

  	      <header class="p-entry__header">

            <?php if ( $dp_options['show_category'] ) : ?>
            <a class="p-entry__cat p-cat p-cat--<?php echo esc_attr( $categories[0]->term_id ); ?>" href="<?php echo get_category_link( $categories[0]->term_id ); ?>"><?php echo esc_html( $categories[0]->name ); ?></a>
            <?php endif; ?>

            <h1 class="p-entry__title"><?php the_title(); ?></h1>

            <ul class="p-entry_date">
             <?php if ( $dp_options['show_date']){ ?>
             <li class="date"><time class="p-entry__date" datetime="<?php the_time( 'Y-m-d' ); ?>"><?php the_time( 'Y.m.d' ); ?></time></li>
             <?php
                  if ( $dp_options['show_update']){
                    $post_date = get_the_time('Ymd');
                    $modified_date = get_the_modified_date('Ymd');
                    if($post_date < $modified_date){
             ?>
             <li class="update"><time class="p-entry__update" datetime="<?php the_modified_time( 'Y-m-d' ); ?>"><?php the_modified_date('Y.m.d'); ?></time></li>
             <?php
                    };
                  };
             ?>
             <?php }; ?>
            </ul>

          </header>

          <?php if ( $dp_options['show_thumbnail']  && has_post_thumbnail() ) : ?>
  	      <div class="p-entry__img p-entry__img--lg">
            <?php the_post_thumbnail( 'full' ); ?>
          </div>
          <?php endif; ?>

          <div class="p-entry__body">
          <?php
          the_content();

          if ( ! post_password_required() ) {

            if ( 'type2' === $pagenation_type ) {

              if ( $page < $numpages && preg_match( '/href="(.*?)"/', _wp_link_page( $page + 1 ), $matches ) ) {

                echo '<div class="p-readmore p-btn">';
                echo '<a class="p-readmore__btn" href="' . esc_url( $matches[1] ) . '">' . __( 'Read more', 'tcd-w' ) . '</a>';
                echo '<p class="p-readmore__num">' . $page . ' / ' . $numpages . '</p>';
                echo '</div>' . "\n";

              }

            } else {

              wp_link_pages( array(
                'before' => '<div class="p-page-links">',
                'after' => '</div>',
                'link_before' => '<span>',
                'link_after' => '</span>'
              ) );

            }
          }
          ?>
          </div>

          <?php if ( $dp_options['show_sns_btm'] ) { get_template_part( 'template-parts/sns-btn-btm' ); } ?>

          <?php
                  // copy title&url button ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
                  if($options['single_blog_show_copy_btm']) {
             ?>
             <div class="single_copy_title_url" id="single_copy_title_url_bottom">
              <button class="single_copy_title_url_btn" data-clipboard-text="<?php echo esc_attr( strip_tags( get_the_title() ) . ' ' . get_permalink() ); ?>" data-clipboard-copied="<?php echo esc_attr( __( 'COPIED Title&amp;URL', 'tcd-w' ) ); ?>"><?php _e( 'COPY Title&amp;URL', 'tcd-w' ); ?></button>
             </div>
             <?php }; ?>

          <?php get_template_part( 'template-parts/meta-box' ); ?>

          <?php if ( $dp_options['show_next_post'] && ( $previous_post || $next_post ) ) : ?>
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

      <?php if ( $dp_options['show_comment'] ) { comments_template( '', true ); } ?>

      <?php if ( $dp_options['show_related_post'] ) : ?>
      <section>
        <h2 class="p-headline"><?php _e( 'Related posts', 'tcd-w' ); ?></h2>
  	  	<div class="p-entry__related">

          <?php
          if ( $the_query->have_posts() ) :
            while( $the_query->have_posts() ) :
              $the_query->the_post();
          ?>
          <article class="p-entry__related-item p-article03">
            <a href="<?php the_permalink(); ?>" class="p-hover-effect--<?php echo esc_attr( $dp_options['hover_type'] ); ?>">
              <div class="p-article03__img">
                <?php
                if ( has_post_thumbnail() ) {
                  the_post_thumbnail( 'size6' );
                } else {
                  echo '<img src="' . get_template_directory_uri() . '/assets/images/520x312.gif" alt="">';
                }
                ?>
              </div>
              <h3 class="p-article03__title"><?php echo wp_trim_words( get_the_title(), 28, '...' ); ?></h3>
            </a>
          </article>
          <?php
            endwhile;
            wp_reset_postdata();
          endif;
          ?>

        </div>
      </section>
      <?php endif; ?>

    </div><!-- /.l-primary -->

    <?php get_sidebar(); ?>

  </div>
</div>

<?php get_footer(); ?>
