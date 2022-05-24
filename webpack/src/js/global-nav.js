import $ from 'jquery';

export default function() {
  const headerNav = document.getElementById('js-header__nav');
  const menuBtn = document.getElementById('js-menu-btn');
  const close = document.getElementById('js-header__nav-close');

  menuBtn.addEventListener('click', () => {
    $(headerNav).slideToggle();
    close.classList.toggle('is-active');
  });

  close.addEventListener('click', (e) => {
    e.preventDefault();
    $(headerNav).slideToggle();
    close.classList.toggle('is-active');
  });

  $('[data-megamenu]').hover(e => {
    const megamenu = document.getElementById(e.target.dataset.megamenu);
    megamenu.classList.add('is-active');
  }, e => {
    const megamenu = document.getElementById(e.target.dataset.megamenu);
    megamenu.classList.remove('is-active');
  });
}
