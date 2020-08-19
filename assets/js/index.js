import { home } from './pages/home.js';

$(document).ready(function() {
  if ($('body').hasClass('page-template-homepage')) {
    home();
  }
  
  let width = $('.single-product .square-text').outerWidth();
  $('.single-product .square-text').css('height', width + 'px');

  $(window).on('resize', function() {
    let width = $('.single-product .square-text').outerWidth();
    $('.single-product .square-text').css('height', width + 'px');
  })
});

