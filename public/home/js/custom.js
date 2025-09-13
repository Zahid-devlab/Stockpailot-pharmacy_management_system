/*
------------------------------------------------------------------------
* Template Name    : Softie | SaaS & Software Html5 Landing Page      *
* Author           : Webonzer                                         *
* Version          : 2.1                                              *
* Created          : March 2023                                       *
* File Description : Main Js file of the template                     *
*-----------------------------------------------------------------------
*/
var navbar=document.querySelector("nav");window.onscroll=function(){window.pageYOffset>60?navbar.classList.add("stickyadd"):navbar.classList.remove("stickyadd")},$(document).on("click",".navbar-collapse.show",function(a){$(a.target).is("a")&&$(this).collapse("hide")}),$(".img-zoom").magnificPopup({type:"image",closeOnContentClick:!0,mainClass:"mfp-fade",gallery:{enabled:!0,navigateByImgClick:!0,preload:[0,1]}}),$("#owl-demo").owlCarousel({autoPlay:1e4,items:3,itemsDesktop:[1199,3],itemsDesktopSmall:[979,3]}),$(window).on("scroll",function(){$(this).scrollTop()>100?$(".back_top").fadeIn():$(".back_top").fadeOut()}),$(".back_top").on("click",function(){return $("html, body").animate({scrollTop:0},1e3),!1});

document.addEventListener("DOMContentLoaded", function() {
    var navbar = document.querySelector("nav");
    window.onscroll = function() {
        if (window.pageYOffset > 60) {
            navbar.classList.add("stickyadd");
        } else {
            navbar.classList.remove("stickyadd");
        }
    };
});

