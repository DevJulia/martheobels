import { common } from './helpers/common.js';
import { home } from './pages/home.js';

$(document).ready(function() {
  common();
  home();

  //Remove admin style
  $('html').attr('style', 'margin-top: 0 !important');

});

