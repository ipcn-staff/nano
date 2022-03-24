import $ from 'jquery';

export default function() {

  const dropdown = document.getElementById('js-list');

  if (dropdown) {

    $(dropdown).find('.is-current').parents('.p-list__item').last().addClass('is-parent');

    dropdown.addEventListener('click', e => {
      if (e.target.classList.contains('p-list__item-toggle')) {
        e.preventDefault();
        e.target.parentNode.parentNode.classList.toggle('is-active');
        $(e.target.parentNode.nextElementSibling).not(':animated').slideToggle();
      } else if (e.target.classList.contains('p-list__item-btn')) {
        e.preventDefault();
        $(e.target).parents('.p-list__item').toggleClass('is-active');
        $(e.target).parents('.p-list__item').children('ul').slideToggle();
      }
    });

  }

}
