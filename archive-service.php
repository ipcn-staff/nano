<?php
$dp_options = get_design_plus_options();

$args = array(
  'parent' => 0 // get only top level terms
);

$categories = get_terms( 'service_category', $args );

get_header();
?>

<div class="l-contents l-contents--no-border">

  <?php get_template_part( 'template-parts/cover' ); ?>

  <div class="l-contents__inner l-inner">
    <div class="l-primary">

      <?php get_template_part( 'template-parts/archive-header' ); ?>

      <?php
      if ( $categories ) :
        $count = 0;

        foreach ( $categories as $index => $category ) :
          $count++;
      ?>
      <article class="p-article09<?php if ( 1 === $count % 2 ) { echo ' p-article09--rev'; } ?>">
        <a class="p-hover-effect--<?php echo esc_attr( $dp_options['hover_type'] ); ?>" href="<?php echo get_term_link( $categories[$index], 'service_category' ); ?>">
          <div class="p-article09__content">
            <h3 class="p-article09__title"><?php echo esc_html( $categories[$index]->name ); ?></h3>
            <p class="p-article09__sub"><?php echo esc_html( get_term_meta( $categories[$index]->term_id, 'sub', true ) ); ?></p>
            <p class="p-article09__desc"><?php echo nl2br( esc_html( get_term_meta( $categories[$index]->term_id, 'desc', true ) ) ); ?></p>
            <p class="p-article09__link"><?php echo esc_html( $categories[$index]->name ); ?></p>
          </div>

          <div class="p-article09__img">
            <?php
            if ( $img = get_term_meta( $categories[$index]->term_id, 'img', true ) ) {
              echo wp_get_attachment_image( $img, 'full' );
            } else {
              echo '<img src="' . get_template_directory_uri() . '/assets/images/590x430.gif" alt="">';
            }
            ?>
          </div>
        </a>
      </article>
      <?php
        endforeach;
      endif;
      ?>

    </div><!-- /.l-primary -->
  </div>
</div>

<?php get_footer(); ?>
