import $ from 'jquery';

export default function() {

  const dropdownTitles = document.querySelectorAll('.p-dropdown__title');

  for (var i = 0, len = dropdownTitles.length; i < len; i++) {
    dropdownTitles[i].addEventListener('click', e => {
      e.target.classList.toggle('is-active');
      $(e.target.nextElementSibling).not(':animated').slideToggle();
    });
  }
}
