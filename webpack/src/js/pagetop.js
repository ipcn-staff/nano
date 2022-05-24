import $ from 'jquery';

export default function() {
  const pagetop = document.getElementById('js-pagetop');

  window.addEventListener('scroll', () => {
    if (window.pageYOffset > 100) {
      pagetop.classList.add('is-active');
    } else {
      pagetop.classList.remove('is-active');
    }
  });

  pagetop.addEventListener('click', () => {

    // Use jQuery for Safari
    $('body, html').animate({
      scrollTop: 0
    }, 1000);
  });
}
