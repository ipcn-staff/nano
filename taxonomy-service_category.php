<?php
$dp_options = get_design_plus_options();

$queried_object = get_queried_object();

$args = array(
  'parent' => $queried_object->term_id
);

$terms = get_terms( 'service_category', $args );

get_header();

get_template_part( 'template-parts/breadcrumb' );
?>

<div class="l-contents">
  <div class="l-contents__inner l-inner">
    <div class="l-primary">
      <header class="p-service-cat-header">

        <div class="p-page-header">
          <h1 class="p-page-header__title"><?php echo esc_html( $queried_object->name ); ?></h1>
          <?php if ( ! is_mobile() ) : ?>
          <p class="p-page-header__sub"><?php echo esc_html( get_term_meta( $queried_object->term_id, 'sub', true ) ); ?></p>
          <?php endif; ?>
        </div>

        <?php if ( is_mobile() ) { get_template_part( 'template-parts/list' ); } ?>

        <?php
        if ( $img = get_term_meta( $queried_object->term_id, 'img', true ) ) {
          echo wp_get_attachment_image( $img, 'size11', false, array( 'class' => 'p-service-cat-header__img' ) );
        } else {
          echo '<img src="' . get_template_directory_uri() . '/assets/images/880x300.gif" alt="">';
        }
        ?>

      </header>

      <?php get_template_part( 'template-parts/archive-header' ); ?>

      <ul class="p-service-cats-list">
        <?php
        foreach ( $terms as $term ) :
          $img = get_term_meta( $term->term_id, 'img', true );
        ?>
        <li class="p-service-cats-list__item p-article10" data-aos="custom-fade">
          <a class="p-hover-effect--<?php echo esc_attr( $dp_options['hover_type'] ); ?>" href="<?php echo esc_attr( get_term_link( $term, 'service_category' ) ); ?>">
            <div class="p-article10__img">
              <?php
              if ( $img ) {
                echo wp_get_attachment_image( $img, 'size8' );
              } else {
                echo '<img src="' . get_template_directory_uri() . '/assets/images/790x420.gif" alt="">';
              }
              ?>
            </div>
            <div class="p-article10__content">
              <h3 class="p-article10__title"><?php echo wp_trim_words( $term->name, 15, '...' ); ?></h3>
              <p class="p-article10__desc"><?php echo wp_trim_words( get_term_meta( $term->term_id, 'desc', true ), 36, '...' ); ?></p>
            </div>
          </a>
        </li>
        <?php endforeach; ?>
      </ul>

    </div><!-- /.l-primary -->
  </div>
</div>

<?php get_footer(); ?>
