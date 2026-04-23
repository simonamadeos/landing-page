
let lastScrollTop = 0;
const navbar = document.getElementById('mainNav');

window.addEventListener('scroll', function () {
  let scrollTop = window.pageYOffset || document.documentElement.scrollTop;

  if (scrollTop > lastScrollTop) {
    // Scroll ke bawah
    navbar.style.top = '-80px'; // geser keluar layar
  } else {
    // Scroll ke atas
    navbar.style.top = '0';
  }

  lastScrollTop = scrollTop <= 0 ? 0 : scrollTop; // agar nilai tidak negatif
});
