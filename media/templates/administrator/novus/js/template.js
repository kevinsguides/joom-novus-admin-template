document.addEventListener("DOMContentLoaded", function () {
  //when user hovers over a .dropdown.nav-item
  //add .show to .dropdown-menu

  let preferDesktop = false;
  if (document.querySelector('body').classList.contains('prefer-desktop')) {
    preferDesktop = true;
  }



  var dropdowns = document.querySelectorAll(".dropdown.nav-item");

  dropdowns.forEach(function (dropdown) {
    dropdown.addEventListener("mouseover", function () {
      dropdown.querySelector(".dropdown-menu").classList.add("show");
    });

    dropdown.addEventListener("mouseout", function () {
      dropdown.querySelector(".dropdown-menu").classList.remove("show");
    });
  });

  let secondLevelDropdown = document.querySelectorAll(
    "#mainAdminMenu .toggle-level-2"
  );

  secondLevelDropdown.forEach(function (dropdown) {

    if(!preferDesktop){
      dropdown.addEventListener("click", function (event) {
        event.preventDefault();
        event.stopPropagation();
        
        //find nearest .collapse-level-2 and toggle show
        dropdown.parentElement.querySelector(".collapse-level-2").classList.toggle("show");
      });
    }

    //show on hover
    dropdown.addEventListener("mouseover", function () {
      //hide all other .collapse-level-2.show
      let secondLevelCollapse = document.querySelectorAll(
        ".collapse-level-2.show"
      );

      secondLevelCollapse.forEach(function (collapse) {
        collapse.classList.remove("show");
      });


      //toggle show on next sibling that has class .collapse-level-2

      dropdown.parentElement.querySelector(".collapse-level-2").classList.toggle("show");

    }
    );

  });


  let secondLevelCollapse = document.querySelectorAll(".collapse-level-2");

  //when someone mouses over any .no-dropdown, remove .show from all .collapse-level-2

  let noDropdown = document.querySelectorAll(".item-level-2>.no-dropdown");

  noDropdown.forEach(function (dropdown) {
    dropdown.addEventListener("mouseover", function () {
      secondLevelCollapse.forEach(function (collapse) {
        collapse.classList.remove("show");
      });
    });
  });
  




  //when mouse leaves .collapse-level-2.show
  //remove .show from .collapse-level-2.show
  secondLevelCollapse.forEach(function (collapse) {
    collapse.addEventListener("mouseleave", function () {
      collapse.classList.remove("show");
    });
  });







      //if #activeComponentMenuContainer is taller than the viewport
      const activeComponentMenuContainer = document.querySelector('#activeComponentMenuContainer');

  //see if we have any .activeComponentMenuItem items
  let activeComponentMenuItems = document.querySelectorAll(
    ".activeComponentMenuItem"
  );

  if (activeComponentMenuItems.length > 0) {
    activeComponentMenuItems.forEach(function (item) {
      //add li to #activeComponentMenu
      let li = document.createElement("li");
      li.classList.add("nav-item");
      li.innerHTML = item.outerHTML;
      document.querySelector("#activeComponentMenu").appendChild(li);
    }
    );
    checkIfActiveComponentMenuContainerIsTallerThanViewport();
  }
  else{
    //hide #activeComponentMenuContainer
    activeComponentMenuContainer.classList.add('d-none');
    document.querySelector('#sideNavMenuToggleShow').classList.add('d-none');
    console.log('no activeComponentMenuItems');
  }



  function checkIfActiveComponentMenuContainerIsTallerThanViewport() {
    if (activeComponentMenuContainer.scrollHeight > (window.innerHeight * 0.8)) {
      //make it smaller
      activeComponentMenuContainer.classList.add('sizeSmaller');
    }
    else{
      //make it bigger
      activeComponentMenuContainer.classList.remove('sizeSmaller');
    }
  }


  function getCookie (name) {
    var value = "; " + document.cookie;
    var parts = value.split("; " + name + "=");
    if (parts.length == 2) return parts.pop().split(";").shift();
  };

  function setCookie (name, value, days) {
    var expires = "";
    if (days) {
      var date = new Date();
      date.setTime(date.getTime() + days * 24 * 60 * 60 * 1000); //days * hours * minutes * seconds * milliseconds
      expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "") + expires + "; path=/";
  };



  //find user cookies adminSidebarExpanded
  let adminSidebarExpanded = getCookie('adminSidebarExpanded');
  

  document.querySelector('#sideNavMenuToggleCollapse').addEventListener('click', function(event){
    event.preventDefault();
    document.querySelector('#activeComponentMenuContainer').classList.remove('show');
    adminSidebarExpanded = 'false';
    setCookie('adminSidebarExpanded', false, 365);
  });

  document.querySelector('#sideNavMenuToggleShow').addEventListener('click', function(event){
    event.preventDefault();
    document.querySelector('#activeComponentMenuContainer').classList.add('show');
    checkIfActiveComponentMenuContainerIsTallerThanViewport();
    adminSidebarExpanded = 'true';
    setCookie('adminSidebarExpanded', true, 365);
  });

});
