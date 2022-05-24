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
      <section class="p-blog">
        <h2 class="p-blog__title">
          <?php echo is_home() ? esc_html( $dp_options['archive_catch'] ) : get_the_archive_title(); ?>
        </h2>
        <div class="p-blog__list">
          <?php
          if ( have_posts() ) :
            while ( have_posts() ) :
              the_post();
              $categories = get_the_category();
          ?>
          <article class="p-blog__list-item p-article01" data-aos="custom-fade">
            <a class="p-hover-effect--<?php echo esc_attr( $dp_options['hover_type'] ); ?>" href="<?php the_permalink(); ?>">
              <div class="p-article01__img">
                <?php
                if ( has_post_thumbnail() ) {
                  the_post_thumbnail( 'size1' );
                } else {
                  echo '<img src="' . get_template_directory_uri(). '/assets/images/740x440.gif" alt="">';
                }
                ?>
              </div>
              <h3 class="p-article01__title"><?php echo wp_trim_words( get_the_title(), 31, '...' ); ?></h3>
            </a>
            <p class="p-article01__excerpt"><?php echo is_mobile() ? wp_trim_words( get_the_excerpt(), 55, '...' ) : wp_trim_words( get_the_excerpt(), 74, '...' ); ?></p>
            <?php if ( $dp_options['show_category'] || $dp_options['show_date'] || $dp_options['show_update'] ) : ?>
            <ul class="p-article01__meta">
              <?php if ( $dp_options['show_category'] ) : ?>
              <a class="p-article01__cat p-cat p-cat--<?php echo esc_attr( $categories[0]->term_id ); ?>" href="<?php echo get_category_link( $categories[0]->term_id ); ?>"><?php echo esc_html( $categories[0]->name ); ?></a>
              <?php endif; ?>
            <?php if ( $dp_options['show_date'] ) : ?>
              <li class="date"><time class="p-article01__date" datetime="<?php the_time( 'Y-m-d' ); ?>"><?php the_time('Y.m.d'); ?></time></li>
            <?php
  		            endif;
  		            if ( $dp_options['show_update'] ) :
  			             $post_date = get_the_time('Ymd');
  			             $modified_date = get_the_modified_date('Ymd');
  			             if($post_date < $modified_date){
            ?>
            <li class="update"><time class="p-article01__update" datetime="<?php the_modified_time( 'Y-m-d' ); ?>"><?php the_modified_date( 'Y.m.d' ); ?></time></li>
            <?php
              	 };
              	 endif;
            ?>
          </ul>
            <?php endif; ?>
          </article>
          <?php
            endwhile;
          endif;
          ?>
        </div><!-- /.p-blog-list -->
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
