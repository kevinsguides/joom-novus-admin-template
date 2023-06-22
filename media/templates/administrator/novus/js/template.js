
document.addEventListener('DOMContentLoaded', function () {

  //when user hovers over a .dropdown.nav-item
  //add .show to .dropdown-menu

  var dropdowns = document.querySelectorAll('.dropdown.nav-item');

  dropdowns.forEach(function (dropdown) {
    dropdown.addEventListener('mouseover', function () {
      dropdown.querySelector('.dropdown-menu').classList.add('show');
    });

    dropdown.addEventListener('mouseout', function () {
      dropdown.querySelector('.dropdown-menu').classList.remove('show');
    });
  });


});