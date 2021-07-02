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
 
         if(btnTab.classList.contains('active')){
             return;
         } else {
             btnTab.classList.add('active');
         }
 
         index = btnTab.getAttribute('data-anim');
         console.log(index);
         
         for(let i = 0; i < btnTabs.length; i++) {
 
             if(btnTabs[i].getAttribute('data-anim') != index) {
                 btnTabs[i].classList.remove('active');
             }
 
         }
 
         for(let j = 0; j < content.length; j++){
            activeContent.style.visibility = "visible";
             if(content[j].getAttribute('data-anim') == index) {
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

        if(onglet.classList.contains('active')){
            return;
        } else {
            onglet.classList.add('active');
        }

        index = onglet.getAttribute('data-anim');
        console.log(index);

        for(let i = 0; i < onglets.length; i++) {

            if(onglets[i].getAttribute('data-anim') != index) {
                onglets[i].classList.remove('active');
            }

        }

        for(let j = 0; j < contenu.length; j++){
           activeContent.style.visibility = "visible";
            if(contenu[j].getAttribute('data-anim') == index) {
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

 $('document').ready(function(){
    $('.btn-burger').click(function(){
        $('.citation').toggleClass('isOpen'),
        $('.burger').toggleClass('isOpen');
    })
});

 /** 
 *  FONCTIONNALITE CAROUSSEL
 *  FONCTIONNALITE CAROUSSEL
 *  FONCTIONNALITE CAROUSSEL
 */