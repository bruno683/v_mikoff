/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */
// app.js

const cards = document.querySelectorAll('.card');
const form = document.querySelector('.section-form');
const intro = document.querySelector('.intro');

function checkCard() {
    const triggerBottom = window.innerHeight /5 *6;

    //transform all cards
    cards.forEach(card => {
        const cardTop = card.getBoundingClientRect().top;

        if(cardTop < triggerBottom) {
            card.classList.add('show')
        }else {
            card.classList.remove('show')
        }
    })
    // tranform form
    const formTop = form.getBoundingClientRect().top

    if (formTop < triggerBottom) {
        form.classList.add('show')
    }else {
        form.classList.remove('show')
    }
    //transfom intro class object
    const introTop = intro.getBoundingClientRect().top;

    if (introTop < triggerBottom) {
        intro.classList.add('show')
    }else {
        intro.classList.remove('show')
    }
}


window.addEventListener('scroll', checkCard);



const $ = require('jquery');
// this "modifies" the jquery module: adding behavior to it
// the bootstrap module doesn't export/return anything
require('bootstrap');



// or you can include specific pieces
// require('bootstrap/js/dist/tooltip');
// require('bootstrap/js/dist/popover');

$(document).ready(function() {
    $('[data-toggle="popover"]').popover();
});


// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';

// start the Stimulus application
import './bootstrap';
