<?php global $wp_query; ?>
<?php get_header(); ?>
<div class="l-contents l-contents--no-border">
  <?php get_template_part( 'template-parts/cover' ); ?>
  <div class="l-contents__inner l-inner">
    <div class="l-primary">

      <?php get_template_part( 'template-parts/archive-header' ); ?>

      <div class="p-company-list">
        <?php
        if ( have_posts() ) :
          while ( have_posts() ) :
            the_post();
        ?>
        <article class="p-company-list__item p-article05<?php if ( 0 !== $wp_query->current_post % 2 ) { echo ' p-article05--rev'; } ?>">
          <a href="<?php the_permalink(); ?>">
            <?php
            if ( has_post_thumbnail() ) {
              the_post_thumbnail( 'full', array( 'class' => 'p-article05__img' ) );
            } else {
              echo '<img src="' . get_template_directory_uri() . '/assets/images/1180x480.gif" alt="">';
            }
            ?>
            <div class="p-article05__content">
              <h3 class="p-article05__title"><?php echo esc_html( $post->archive_title ); ?></h3>
              <p class="p-article05__sub"><?php echo esc_html( $post->archive_sub ); ?></p>
              <p class="p-article05__desc"><?php echo nl2br( esc_html( $post->archive_desc ) ); ?></p>
              <p class="p-article05__link"><?php the_title(); ?></p>
            </div>
          </a>
        </article>
        <?php
          endwhile;
        endif;
        ?>
      </div>
    </div><!-- /.l-primary -->
  </div>
</div>
<?php get_footer(); ?>
