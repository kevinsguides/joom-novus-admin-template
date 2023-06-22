
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

  let secondLevelDropdown = document.querySelectorAll('#mainAdminMenu .toggle-level-2');

  secondLevelDropdown.forEach(function (dropdown) {
    dropdown.addEventListener('click', function (event) {
      event.preventDefault();
      event.stopPropagation();
      dropdown.nextElementSibling.classList.toggle('show');
      console.log('showzies');
    });
  });

  //when mouse leaves .collapse-level-2.show
  //remove .show from .collapse-level-2.show

  let secondLevelCollapse = document.querySelectorAll('.collapse-level-2');

  secondLevelCollapse.forEach(function (collapse) {
    collapse.addEventListener('mouseleave', function () {
      collapse.classList.remove('show');
    });
  }
  );


});