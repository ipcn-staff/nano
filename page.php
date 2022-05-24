<?php $catch = $post->catch_and_desc_catch; ?>
<?php get_header(); ?>

<div class="l-contents l-contents--no-border">

  <?php get_template_part( 'template-parts/cover' ); ?>

  <div class="l-contents__inner l-inner<?php if ( ! $catch ) { echo ' mt50'; } ?>">

    <div class="l-primary">

      <?php if ( $catch ) { get_template_part( 'template-parts/archive-header' ); } ?>

      <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
      <div class="p-entry__body">
        <?php the_content(); ?>
      </div>
      <?php endwhile; endif; ?>

    </div><!-- /.l-primary -->
  </div>
</div>

<?php get_footer(); ?>
