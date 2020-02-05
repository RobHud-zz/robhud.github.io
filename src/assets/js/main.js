import objectFitImages from "object-fit-images";

import svg4everybody from "svg4everybody/dist/svg4everybody.legacy.js";
import $ from 'jquery';
import 'slick-carousel';
import AOS from "aos"
import fooCollection from "./modules/fooCollection";
import animation404 from "./modules/sushiAnimation";
import Rellax from "rellax";
import Inputmask from "inputmask";
import Splitting from "splitting";
import * as module from "./modules/ajax";
import validate from "./modules/jquery.validate.min";

import {scrollEventListenerThirdArgument} from "./modules/fooCollection";
import {querySelectorAsArray} from "./modules/fooCollection";



Splitting();
$("form").validate({
    rules: {
        name: "required",
        email: {
            required: true,
            email: true
        },
        phone: {
            required: true,
            minlength: 13
        },
        comment: {
            required: true,
            minlength: 10
        }
    },
    // Specify validation error messages
    messages: {
        name: "Пожалуйста, введите своё имя",
        email: "Пожалуйста, введите ваш email",
        phone: {
            required: "Пожалуйста, введите ваш номер телефона",
            minlength: "Введенный номер слишком короткий"
        },
        comment: "required"

    }
    // // Make sure the form is submitted to the destination defined
    // // in the "action" attribute of the form when valid
    // submitHandler: function(form) {
    //     form.submit();
    // }
});

localStorage.setItem('firstVisit', 'true');

var callBackTel = document.querySelector(".masked-tel"),
    cartTel     = document.querySelector(".masked-cart-tel"),
    im = new Inputmask("+38 (099) 999-99-99");
if (callBackTel) im.mask(callBackTel);
if (cartTel) im.mask(cartTel);

//import * as module from "./modules/module.js";

var productBox = document.querySelectorAll('.product-set__product-box');
for (var i = 0; i < productBox.length; i++) {
    if (productBox[i].querySelectorAll('.product-set__product').length === 3) productBox[i].classList.add('triple');
}


if ( document.querySelector('.rellax') && window.innerWidth > 1024 ) { var rellax = new Rellax('.rellax'); }

var currentWindowLocation = 0;
function makeBodyInactive() {
    if ( !document.body.classList.contains('inactive') ) {
        currentWindowLocation = window.pageYOffset;
    }
    document.body.classList.toggle('inactive');
    if ( !document.body.classList.contains('inactive') ) {
        window.scrollTo(0, currentWindowLocation);
    }
}

let is404 = !!document.querySelector(".error-page");

const fileInputElement = document.getElementById('file');
if ( fileInputElement ) {
    fileInputElement.addEventListener('change', fooCollection.handleFileSelect, false);
}

document.addEventListener("DOMContentLoaded", function() {

    if (lazyLoadInstance) {
        lazyLoadInstance.update();
    }

    querySelectorAsArray('form').forEach( item => item.noValidate = true);


    $('.order-trigger').on('click', function () {
        var order = $('.order');

        if (order.hasClass('order-cart')) {
            order.removeClass('order-cart').addClass('order-form')
        }

        $('html, body').animate({scrollTop: 0}, 1000);
    });

    document.addEventListener('scroll', function () {
        querySelectorAsArray('.surprise-cat').forEach(cat => {
            if ( cat.classList.contains('active') && (cat.getBoundingClientRect().bottom - window.innerHeight) <= 60 )   {
                cat.classList.add('active');
            }
        });
    }, scrollEventListenerThirdArgument);

    AOS.init();
    objectFitImages();
    svg4everybody();
    $('.product-slider__wrapper').slick({
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 800,
                settings: {
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 540,
                settings: {
                    slidesToShow: 1
                }
            }
        ]
    });

    $('.contains__item').on('click', function() {
        this.classList.toggle('active')
    });

    $('.contains__clear').on('click', function () {
        $(this).parents('.contains').find('.contains__item').removeClass('active');
    });

    var filter = document.getElementsByClassName('filter');

    if (filter.length > 0) {
        $('.contains').on('click', function (e) {
            if ( e.target.classList.contains('contains') ) {
                $(this).toggleClass('active');
            }
        });
        $('.tags').on('click', function (e) {
            if ( e.target.classList.contains('tags') ) {
                if ( !$(this).hasClass('active') ){ fooCollection.closeModals() }
                $(this).toggleClass('active');
            }
        });
    }

    $('.footer__contacts-sub').on('click', function () {
        makeBodyInactive();
        $('.pop--call').addClass('active');
    });

    $('.tags').on('click', function (e) {
        let target    = e.target,
            hostText  = this.querySelector('.tags__title'),
            host      = this;


        if ( target.classList.contains('tags__item-view') ) {
            hostText.innerText = target.innerText;

            if ( !this.classList.contains('tags--sort') ) {
                let linkSrc   = window.getComputedStyle(target,':before').getPropertyValue('background-image'),
                    rec       = this.getElementsByClassName('tags__icon')[0],
                    linkClear = linkSrc.replace('"',"").replace('"',"").replace("\(", "").replace("\)","").replace("url",""),
                    linkArr   = linkClear.split('/'),
                    linkImg   = (linkArr[(linkArr.length-1)]).toString();

                rec.style.backgroundImage = 'url(/catalog/view/theme/sushi/img/icons/' + linkImg + ')';
            }
            fooCollection.closeModals();
        }
    });

    var commentsButton = document.querySelector('.comments__button');

    if (commentsButton) {
        commentsButton.addEventListener('click', function () {
            document.querySelector('.pop--comments').classList.add('active');
            makeBodyInactive();
        })
    }

    const $popUps = $('.pop');
    $popUps.on('mousedown', function (e) {
        let target = e.target;
        e.stopPropagation();

        if (target.classList.contains('pop__cross-in') || target.classList.contains('pop') || target.classList.contains('pop--close-el')) {
            makeBodyInactive();
            $popUps.removeClass('active');
        }
    });

    $('.modal').on('focusout', () => fooCollection.closeModals());


    let $search       = $('.search'),
        $searchInput  = $('.search__input'),
        $searchButton = $('.search__button');
    $searchButton.on('click', function () {
        console.log(this.closest('.search'));
        if ( this.closest('.search').classList.contains('active') ){
            fooCollection.closeModals();
            $searchButton.attr('type', 'submit');
        } else {
            $searchButton.attr('type', 'button');
        }

        $search.addClass("active");
        $searchInput.focus();
    });
    $search.on('blur', function () {
        $searchInput.removeClass('active');
    });


    fooCollection.makeCount('.products__bamboo', 'products__plus', 'products__minus', 'products__count');
    fooCollection.makeCount('.cart__bot', 'cart__plus', 'cart__minus', 'cart__count');
    fooCollection.makeCount('.cart-big__item', 'cart-big__plus', 'cart-big__minus', 'cart-big__count');

    module.formCheckout();
});

document.getElementsByClassName('cart__button')[0].addEventListener('click', function () {
    fooCollection.closeModals();
    this.classList.toggle('active');
    $('.cart').toggleClass('active');
});

document.getElementsByClassName('burger')[0].addEventListener('click', function () {
    fooCollection.closeModals();
    document.querySelector('.menu').classList.add('active');
});
document.getElementsByClassName('menu__close')[0].addEventListener('click', function () {
    fooCollection.closeModals();
    document.querySelector('.menu').classList.remove('active');
});

// ADDEVENTLISTENER
window.onload = function () {
    if (is404) animation404.init();
};