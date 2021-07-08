/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';

// start the Stimulus application
import './bootstrap';





/** 
 *  FONCTIONNALITE ONGLETS 
 *  FONCTIONNALITE ONGLETS 
 *  FONCTIONNALITE ONGLETS 
 */

const btnTabs = document.querySelectorAll('.btn-tab');
const content = document.querySelectorAll('.tab-content')
const onglets = document.querySelectorAll('.onglets');
const contenu = document.querySelectorAll('.param-content')
let activeContent = document.querySelector('.activeContenu')
let index = 0;

/* 
    ONGLETS MODIFIER PAGE PROJET
    ONGLETS MODIFIER PAGE PROJET
    ONGLETS MODIFIER PAGE PROJET
*/


btnTabs.forEach(btnTab => {

    btnTab.addEventListener('click', () => {

        if (btnTab.classList.contains('active')) {
            return;
        } else {
            btnTab.classList.add('active');
        }

        index = btnTab.getAttribute('data-anim');
        console.log(index);

        for (let i = 0; i < btnTabs.length; i++) {

            if (btnTabs[i].getAttribute('data-anim') != index) {
                btnTabs[i].classList.remove('active');
            }

        }

        for (let j = 0; j < content.length; j++) {
            activeContent.style.visibility = "visible";
            if (content[j].getAttribute('data-anim') == index) {
                content[j].classList.add('activeContenu');
                content[j].style.visibility = "visible";
            } else {
                content[j].classList.remove('activeContenu');
                content[j].style.visibility = "hidden";
            }


        }


    })

})

/* 
    ONGLETS PARAMETRES
    ONGLETS PARAMETRES
    ONGLETS PARAMETRES
*/

onglets.forEach(onglet => {

    onglet.addEventListener('click', () => {

        if (onglet.classList.contains('active')) {
            return;
        } else {
            onglet.classList.add('active');
        }

        index = onglet.getAttribute('data-anim');
        console.log(index);

        for (let i = 0; i < onglets.length; i++) {

            if (onglets[i].getAttribute('data-anim') != index) {
                onglets[i].classList.remove('active');
            }

        }

        for (let j = 0; j < contenu.length; j++) {
            activeContent.style.visibility = "visible";
            if (contenu[j].getAttribute('data-anim') == index) {
                contenu[j].classList.add('activeContenu');
                contenu[j].style.visibility = "visible";
            } else {
                contenu[j].classList.remove('activeContenu');
                contenu[j].style.visibility = "hidden";
            }


        }


    })

})

/** 
 *  FONCTIONNALITE BURGER
 *  FONCTIONNALITE BURGER
 *  FONCTIONNALITE BURGER
 */

$('document').ready(function() {
    $('.btn-burger').click(function() {
        $('.citation').toggleClass('isOpen'),
            $('.burger').toggleClass('isOpen');
    })
});


/**
 *   CONNECTION SUBMISSION
 *   CONNECTION SUBMISSION
 *   CONNECTION SUBMISSION
 */

function success(input) {
    // input.className = 'success';
    // // hide the error message
    // const error = input.previousElementSibling;
    // error.innerText = '';
    return true;
}

function error(input, message) {
    // TODO : display missing field message
    // input.className = 'error';
    // show the error message
    // const error = input.previousElementSibling;
    // error.innerText = message;
    return false;
}

const form = document.getElementById('login_form');

const login = form.elements[0];
const password = form.elements[1];

const requiredFields = [
    { input: login, message: 'Login is required' },
    { input: password, message: 'Password is required' }
]

function requireValue(input, message) {
    return input.value.trim() === '' ?
        error(input, message) :
        success(input);
}

document.getElementById("login_button").onclick = check_credentials;


function check_credentials() {

    let valid = true;
    requiredFields.forEach((input) => {
        valid = requireValue(input.input, input.message);
    });

    if (valid) {
        const form = document.getElementById('login_form');

        const login = form.elements[0];
        const password = form.elements[1];

        var xhttp = new XMLHttpRequest();
        xhttp.open("POST", "/api/users/isValid", true);
        xhttp.setRequestHeader("Content-type", "application/json");
        xhttp.onload = function() {
            var jsonResponse = JSON.parse(xhttp.responseText);
            if (jsonResponse['isValid']) {
                document.forms["login_form"].submit();
            } else {
                // TODO : display error message
                return false;
            }
        };
        xhttp.send(JSON.stringify({ "login": login.value, "password": password.value }));
    }
    return false;
}
/** 
 *  FONCTIONNALITE CAROUSSEL PROJET FAIT POUR TOI
 *  FONCTIONNALITE CAROUSSEL PROJET FAIT POUR TOI
 *  FONCTIONNALITE CAROUSSEL PROJET FAIT POUR TOI
 */

$(document).ready(function() {
    $('.carousel').slick({
        infinite: true,
        slidesToShow: 3,
        slideToScroll: 1,
        adaptiveHeight: true
    });
});
/** 
 *  FONCTIONNALITE CAROUSSEL MES COLLABS
 *  FONCTIONNALITE CAROUSSEL MES COLLABS
 *  FONCTIONNALITE CAROUSSEL MES COLLABS
 */
$(document).ready(function() {
    $('.collab__slider').slick({
        infinite: true,
        slidesToShow: 1,
        slideToScroll: 1,
        adaptiveHeight: true,
        prevArrow: '.arrow_prev',
        nextArrow: '.arrow_next'
    });
});

$(document).ready(function() {
    $('.pending__collab__slider').slick({
        infinite: true,
        slidesToShow: 2,
        slideToScroll: 1,
        adaptiveHeight: true,
        prevArrow: '.pending_arrow_prev',
        nextArrow: '.pending_arrow_next',
    });
});

/*
 *  FONCTIONNALITE CHANGEMENT BOUTTON MES COLLABS
 *  FONCTIONNALITE CHANGEMENT BOUTTON MES COLLABS
 *  FONCTIONNALITE CHANGEMENT BOUTTON MES COLLABS
 */
/**
let btnConfirm = document.querySelector('.confirm_end');
let btnSend = document.querySelector('.send_end');
let btnCancel = document.querySelector('.cancel_end');
btnConfirm.addEventListener('click', () => {
    btnConfirm.innerText = "Annuler"
    btnSend.style.display = "block";
})
btnCancel.addEventListener('click', () => {
    btnCancel.style.display = "none";
    btnSend.style.display = "none";
    btnConfirm.innerText = "Mission finie";
}) */