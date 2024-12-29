document.addEventListener('DOMContentLoaded', function () {
  const menuIcon = document.getElementById('menu-icon');
  const closeIcon = document.getElementById('close-icon');
  const navMenu = document.querySelector('.header-nav');
  const body = document.body;
  const menuLinks = document.querySelectorAll('.header-nav a');

  menuIcon.addEventListener('click', function () {
    navMenu.classList.add('active');
    menuIcon.style.display = 'none';
    closeIcon.style.display = 'block';
    body.classList.add('no-scroll');
  });

  closeIcon.addEventListener('click', function () {
    navMenu.classList.remove('active');
    closeIcon.style.display = 'none';
    menuIcon.style.display = 'block';
    body.classList.remove('no-scroll');
  });

  menuLinks.forEach(function (link) {
    link.addEventListener('click', function () {
      navMenu.classList.remove('active');
      closeIcon.style.display = 'none';
      menuIcon.style.display = 'block';
      body.classList.remove('no-scroll');
    });
  });
});