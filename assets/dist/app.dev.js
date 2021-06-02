"use strict";

require("./styles/app.scss");

require("./bootstrap");

/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */
// any CSS you import will output into a single css file (app.css in this case)
// start the Stimulus application

/** 
 *  FONCTIONNALITE ONGLETS 
 *  FONCTIONNALITE ONGLETS 
 *  FONCTIONNALITE ONGLETS 
 */
var onglets = document.querySelectorAll('.onglets');
var contenu = document.querySelectorAll('.param-content');
var activeContent = document.querySelector('.activeContenu');
var index = 0;
onglets.forEach(function (onglet) {
  onglet.addEventListener('click', function () {
    if (onglet.classList.contains('active')) {
      return;
    } else {
      onglet.classList.add('active');
    }

    index = onglet.getAttribute('data-anim');
    console.log(index);

    for (var i = 0; i < onglets.length; i++) {
      if (onglets[i].getAttribute('data-anim') != index) {
        onglets[i].classList.remove('active');
      }
    }

    for (var j = 0; j < contenu.length; j++) {
      activeContent.style.visibility = "visible";

      if (contenu[j].getAttribute('data-anim') == index) {
        contenu[j].classList.add('activeContenu');
        contenu[j].style.visibility = "visible";
      } else {
        contenu[j].classList.remove('activeContenu');
        contenu[j].style.visibility = "hidden";
      }
    }
  });
});
/** 
*  FONCTIONNALITE BURGER
*  FONCTIONNALITE BURGER
*  FONCTIONNALITE BURGER
*/

$('document').ready(function () {
  $('.btn-burger').click(function () {
    $('.citation').toggleClass('isOpen'), $('.burger').toggleClass('isOpen');
  });
});