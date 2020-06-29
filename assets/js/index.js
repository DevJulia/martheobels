import { common } from './helpers/common.js';
import { home } from './pages/home.js';

$(document).ready(function() {
  common();

  if ($('body').hasClass('page-template-homepage'))
    home();
});

