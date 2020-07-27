import { home } from './pages/home.js';

$(document).ready(function() {
  if ($('body').hasClass('page-template-homepage')) {
    home();
  }
    
});

