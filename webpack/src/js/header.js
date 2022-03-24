export default function() {
  const header = document.getElementById('js-header');

  if (!header.classList.contains('l-header--fixed')) return;

  window.addEventListener('scroll', () => {
    if (window.pageYOffset > 100) {
      header.classList.add('is-active');
    } else {
      header.classList.remove('is-active');
    }
  })
}
