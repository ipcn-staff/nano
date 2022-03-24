const $ = jQuery
const headerNav = $('#js-header__nav');
const menuBtn = $('#js-menu-btn');
const close = $('#js-header__nav-close');

menuBtn.click(() => {
  $(headerNav).slideToggle();
  close.toggleClass('l-header__nav-close--is-active');
})

close.click((e) => {
  e.preventDefault();
  $(headerNav).slideToggle();
  close.toggleClass('l-header__nav-close--is-active');
});
