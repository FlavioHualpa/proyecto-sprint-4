var boton1 = document.querySelector("#boton-generos");
boton1.addEventListener('click', function() {
   toggleMenu('#menu-generos', boton1.offsetTop, boton1.offsetLeft)
});

var boton2 = document.querySelector("#user-options");
boton2.addEventListener('click', function() {
   toggleMenu('#menu-usuario', boton2.offsetTop, boton2.offsetLeft)
});

var openMenu = null;

function toggleMenu(id, top, left) {
   menu = document.querySelector(id);
   if (openMenu && openMenu != menu) {
      openMenu.style.display = '';
   }
   if (menu.style.display == '') {
      menu.style.display = 'block';
      menu.style.top = (top + 50) + 'px';
      menu.style.left = left + 'px';
      openMenu = menu;
   }
   else {
      menu.style.display = '';
      openMenu = null;
   }
}
