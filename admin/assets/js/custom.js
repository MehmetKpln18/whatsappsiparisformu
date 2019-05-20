$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})



jQuery(document).ready(function($) {
"use strict";
$('#customers-testimonials').owlCarousel( {
    loop: true,
    center: true,
    items: 3,
    margin: 10,
    autoplay: true,
    dots:false,
    pagination: false,
    nav:false,
    autoplayTimeout: 8500,
    smartSpeed: 450,
    navText: ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
    responsive: {
      0: {
        items: 1
      },
      768: {
        items: 2
      },
      1170: {
        items: 3
      }
    }
  });
});