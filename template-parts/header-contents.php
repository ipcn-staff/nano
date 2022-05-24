<?php $dp_options = get_design_plus_options(); ?>

<?php if ( 'type1' === $dp_options['header_content_type'] ) : // Image ?>
<div id="js-header-slider" class="p-header-slider" data-speed="<?php echo esc_attr( $dp_options['header_slider_animation_time'] * 1000 ); ?>">

  <?php
  for ( $i = 1; $i <= 5; $i++ ) :
    if ( ! $dp_options['header_slider_img' . $i] ) continue;

    $catch = $dp_options['header_slider_catch' . $i];
    $vertical = $dp_options['header_slider_catch_vertical' . $i];
    $btn_label = $dp_options['header_slider_btn_label' . $i];
    $btn_url = $dp_options['header_slider_btn_url' . $i];
    $btn_target = $dp_options['header_slider_btn_target' . $i];
    $logo = '';

    if ( is_mobile() ) {

      switch ( $dp_options['header_slider_content_type_mobile'] ) {

        case 'type2' : // Logo
          $catch = '';
          $btn_label = '';
          $logo = $dp_options['header_slider_logo'];
          break;

        case 'type3' : // Catchphrase
          $catch = $dp_options['header_slider_catch_sp'];
          $vertical = $dp_options['header_slider_catch_vertical_sp'];
          $btn_label = '';
          break;
      }
    }
  ?>
  <div class="p-header-slider__item p-header-slider__item--<?php echo $i; ?> p-header-content" data-animation="<?php if ( 'type3' !== $dp_options['header_slider_img_animation_type' . $i] ) { echo '1'; } ?>">

    <div class="p-header-content__inner">

      <?php if ( $catch ) : ?>
      <div class="p-header-content__title<?php if ( $vertical ) { echo ' p-header-content__title--vertical'; } ?>">
        <span><?php echo nl2br( esc_html( $catch ) ); ?></span>
      </div>
      <?php endif; ?>

      <?php if ( $btn_label ) : ?>
      <p class="p-header-content__btn p-btn">
        <a href="<?php echo esc_attr( $btn_url ); ?>"<?php if ( $btn_target ) { echo ' target="_blank"'; } ?>><?php echo esc_html( $btn_label ); ?></a>
      </p>
      <?php endif; ?>

      <?php if ( $logo ) : ?>
      <img src="<?php echo esc_attr( wp_get_attachment_url( $logo ) ); ?>" alt=""<?php if ( $dp_options['header_slider_logo_width'] ) { echo ' width="' . esc_attr( $dp_options['header_slider_logo_width'] ) . '"'; } ?>>
      <?php endif; ?>

    </div>

    <div class="p-header-slider__item-img p-header-slider__item-img--<?php echo esc_attr( $dp_options['header_slider_img_animation_type' . $i] ); ?>"></div>
  </div>
  <?php endfor; ?>

  <a href="#js-cb" id="js-header-content__link" class="p-header-content__link" aria-hidden="true"></a>
</div>

<?php
elseif ( 'type2' === $dp_options['header_content_type'] ) : // Video

  $catch = $dp_options['header_video_catch'];
  $vertical = $dp_options['header_video_catch_vertical'];
  $btn_label = $dp_options['header_video_btn_label'];
  $logo = '';

  if ( is_mobile() ) {

    switch ( $dp_options['header_video_content_type_mobile'] ) {

      case 'type2' : // Logo
        $catch = '';
        $btn_label = '';
        $logo = $dp_options['header_video_logo'];
        break;

      case 'type3' : // Catchphrase
        $catch = $dp_options['header_video_catch_sp'];
        $vertical = $dp_options['header_video_catch_vertical_sp'];
        $btn_label = '';
        break;
    }
  }
?>
<div id="js-header-video" class="p-header-video p-header-content">

  <?php if ( ! wp_is_mobile() ) : ?>
  <video autoplay loop muted>
    <source src="<?php echo esc_attr( wp_get_attachment_url( $dp_options['header_video'] ) ); ?>">
  </video>
  <?php endif; ?>

  <div class="p-header-content__inner">

    <?php if ( $catch ) : ?>
    <div class="p-header-content__title<?php if ( $vertical ) { echo ' p-header-content__title--vertical'; } ?>">
      <span><?php echo nl2br( esc_html( $catch ) ); ?></span>
    </div>
    <?php endif; ?>

    <?php if ( $btn_label ) : ?>
    <p class="p-header-content__btn p-btn">
      <a href="<?php echo esc_attr( $dp_options['header_video_btn_url'] ); ?>"<?php if ( $dp_options['header_video_btn_target'] ) { echo ' target="_blank"'; } ?>><?php echo esc_html( $dp_options['header_video_btn_label'] ); ?></a>
    </p>
    <?php endif; ?>

    <?php if ( $logo ) : ?>
    <img src="<?php echo esc_attr( wp_get_attachment_url( $logo ) ); ?>" alt=""<?php if ( $dp_options['header_video_logo_width'] ) { echo ' width="' . esc_attr( $dp_options['header_video_logo_width'] ) . '"'; } ?>>
    <?php endif; ?>

  </div>

  <a href="#js-cb" id="js-header-content__link" class="p-header-content__link" aria-hidden="true"></a>

</div>

<?php
elseif ( 'type3' === $dp_options['header_content_type'] ) : // YouTube

  $catch = $dp_options['header_video_catch'];
  $vertical = $dp_options['header_video_catch_vertical'];
  $btn_label = $dp_options['header_video_btn_label'];
  $logo = '';

  if ( is_mobile() ) {

    switch ( $dp_options['header_video_content_type_mobile'] ) {

      case 'type2' : // Logo
        $catch = '';
        $btn_label = '';
        $logo = $dp_options['header_video_logo'];
        break;

      case 'type3' : // Catchphrase
        $catch = $dp_options['header_video_catch_sp'];
        $vertical = $dp_options['header_video_catch_vertical_sp'];
        $btn_label = '';
        break;
    }
  }
?>
<div id="js-header-youtube" class="p-header-youtube p-header-content">

  <?php if ( ! wp_is_mobile() ) : ?>
  <div id="js-header-youtube__player" class="p-header-youtube__player" data-video-id="<?php echo esc_attr( $dp_options['header_youtube_id'] ); ?>"></div>
  <?php endif; ?>

  <div class="p-header-content__inner">

    <?php if ( $catch ) : ?>
    <div class="p-header-content__title<?php if ( $vertical ) { echo ' p-header-content__title--vertical'; } ?>">
      <span><?php echo nl2br( esc_html( $catch ) ); ?></span>
    </div>
    <?php endif; ?>

    <?php if ( $btn_label ) : ?>
    <p class="p-header-content__btn p-btn">
      <a href="<?php echo esc_attr( $dp_options['header_video_btn_url'] ); ?>"<?php if ( $dp_options['header_video_btn_target'] ) { echo ' target="_blank"'; } ?>><?php echo esc_html( $btn_label ); ?></a>
    </p>
    <?php endif; ?>

    <?php if ( $logo ) : ?>
    <img src="<?php echo esc_attr( wp_get_attachment_url( $logo ) ); ?>" alt=""<?php if ( $dp_options['header_video_logo_width'] ) { echo ' width="' . esc_attr( $dp_options['header_video_logo_width'] ) . '"'; } ?>>
    <?php endif; ?>

  </div>

  <a href="#js-cb" id="js-header-content__link" class="p-header-content__link" aria-hidden="true"></a>

</div>
<?php endif; ?>
