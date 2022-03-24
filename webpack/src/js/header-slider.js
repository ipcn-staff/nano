import $ from 'jquery';

import '../css/slick.css';
import '../css/slick-theme.css';
import './slick.min';

export default function() {
  const $headerSlider = $('#js-header-slider');
  const $headerSliderItem = $headerSlider.find('.p-header-slider__item');
  const $headerSliderItemImg = $headerSlider.find('.p-header-slider__item-img');
  const speed = $headerSlider.data('speed');

  $(window).on('js-initialized', () => {
    let timerId;

    $headerSlider.slick({
      arrows: false,
      autoplay: false,
      pauseOnHover: false,
      speed: 1000,
      slide: '.p-header-slider__item'
    });

    $headerSliderItem
      .first()
        .addClass('is-active')

    if (!$headerSliderItem.first().data('animation')) {
      timerId = setTimeout(() => {
        $headerSlider.slick('slickNext');
      }, speed);
    }

    $headerSliderItemImg.on('animationend', () => {
      $headerSlider.slick('slickNext');
    });

    $headerSlider.on('beforeChange', (event, slick, currentSlide, nextSlide) => {
      $headerSliderItem
        .eq(nextSlide)
          .addClass('is-active');
    });

    $headerSlider.on('afterChange', (event, slick, currentSlide) => {
      const prevSlide = currentSlide === 0
        ? $headerSliderItem.length - 1
        : currentSlide - 1;

      if (!$headerSliderItem.eq(currentSlide).data('animation')) {
        timerId = setTimeout(() => {
          $headerSlider.slick('slickNext');
        }, speed);
      }

      $headerSliderItem.eq(prevSlide).removeClass('is-active');
    });

    $headerSlider.on('swipe', (event, slick) => {
      if (timerId) {
        clearTimeout(timerId);
        timerId = null;
      }
    });
  });
}
