export default function() {
  const search = document.getElementById('js-header__search');
  const form = document.getElementById('js-header__form');
  const input = document.getElementById('js-header__form-input');
  const close = document.getElementById('js-header__form-close');

  search.addEventListener('click', () => {
    form.classList.toggle('is-active');
    input.tabIndex = Math.abs(input.tabIndex) - 1;
  });

  close.addEventListener('click', (e) => {
    e.preventDefault();
    form.classList.toggle('is-active');
    input.tabIndex = Math.abs(input.tabIndex) - 1;
  });
}
