document.addEventListener('DOMContentLoaded', function () {
  const hamburger = document.getElementById('hamburger-btn');
  const nav = document.querySelector('nav');

  if (hamburger && nav) {
    hamburger.addEventListener('click', function () {
      nav.classList.toggle('open');
    });
  }
});