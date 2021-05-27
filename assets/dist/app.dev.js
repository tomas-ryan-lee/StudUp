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
var modal = null;
var focusableSelector = 'button, a, input, textarea';
var focusables = [];
var previouslyFocusedElement = null;

var openModal = function openModal(e) {
  e.preventDefault();

  if (e.className === "js-modal-signUp") {
    closeModal;
  }

  modal = document.querySelector(e.target.getAttribute('href'));
  focusables = Array.from(modal.querySelectorAll(focusableSelector));
  previouslyFocusedElement = document.querySelector(':focus');
  modal.style.display = null;
  focusables[0].focus();
  modal.removeAttribute('aria-hidden');
  modal.setAttribute('aria-modal', 'true');
  modal.addEventListener('click', closeModal);
  modal.querySelector('.js-modal-close').addEventListener('click', closeModal);
  modal.querySelector('.js-modal-stop').addEventListener('click', stopPropagation);
};

var closeModal = function closeModal(e) {
  if (modal === null) return;
  if (previouslyFocusedElement !== null) previouslyFocusedElement.focus();
  e.preventDefault();
  modal.removeAttribute('aria-modal');
  modal.setAttribute('aria-hidden', 'true');
  modal.removeEventListener('click', closeModal);
  modal.querySelector('.js-modal-close').removeEventListener('click', closeModal);
  modal.querySelector('.js-modal-stop').removeEventListener('click', stopPropagation);

  var hideModal = function hideModal() {
    modal.style.display = "none";
    modal.removeEventListener('animationend', hideModal);
    modal = null;
  };

  modal.addEventListener('animationend', hideModal);
};

var stopPropagation = function stopPropagation(e) {
  e.stopPropagation();
};

var focusInModal = function focusInModal(e) {
  e.preventDefault();
  var index = focusables.findIndex(function (f) {
    return f === modal.querySelector(':focus');
  });

  if (e.shiftKey === true) {
    index--;
  } else {
    index++;
  }

  if (index >= focusables.length) {
    index = 0;
  }

  if (index < 0) {
    index = focusables.length - 1;
  }

  focusables[index].focus();
};

$('document').ready(function () {
  $('.btn-burger').click(function () {
    $('.citation').toggleClass('isOpen'), $('.burger').toggleClass('isOpen');
  });
});
/** 
document.querySelectorAll('.js-modal-signUp').forEach(a => {
    a.addEventListener('click', openModal)
})
document.querySelectorAll('.js-modal-signIn').forEach(a => {
    a.addEventListener('click', openModal)
})
*/

window.addEventListener('keydown', function (e) {
  if (e.key === "Escape" || e.key === "Esc") {
    closeModal(e);
  }

  if (e.key === "Tab" && modal !== null) {
    focusInModal(e);
  }
});