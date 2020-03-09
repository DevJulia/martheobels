/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "./assets/build";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./assets/js/pages/home.js":
/*!*********************************!*\
  !*** ./assets/js/pages/home.js ***!
  \*********************************/
/*! exports provided: home */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "home", function() { return home; });
function home() {
  var step = $(window).width() * 0.3;
  console.log(step);
  $(window).resize(function () {
    $('.main-home').css('transform', 'matrix(1, 0, 0, 1, 0, 0)');
    step = $(window).width() * 0.3;
    $('.progress').css('width', '0');
  });
  var wheeldelta = {
    x: 0,
    y: 0
  };
  var wheeling;
  $('.main-home').on('wheel', function (e) {
    if (!wheeling) {
      console.log('start wheeling!');
      var transMatrix = $(this).css('transform');
      var direction = 1;
      var position = 0;
      console.log($('.main-home').width());

      if (transMatrix !== 'none') {
        position = transMatrix.split('(')[1];
        position = position.split(')')[0];
        position = position.split(',');
        position = parseFloat(position[4]);
      }

      console.log('pos :' + position);

      if (e.originalEvent.deltaY < 0) {
        //Mouse wheel up
        var direction = 1;
      } else {
        //Mouse wheel down
        var direction = -1;
      }

      if (position + direction * step <= 0 && position + direction * step >= -$('.main-home').width() - 0.8 * $(window).width()) {
        var percentage = -100 * (position + direction * step) / $(window).width();
        console.log('%:' + percentage);
        $('.progress').css('width', percentage + '%');
        $(this).animate({
          'opacity': step
        }, {
          step: function step(now) {
            if (transMatrix !== 'none') {
              $(this).css('transform', 'translate3d(' + (position + direction * now) + 'px, 0px, 0px)');
            } else {
              $(this).css('transform', 'translate3d(-' + now + 'px, 0px, 0px)');
            }
          },
          duration: 600,
          easing: 'swing',
          queue: false,
          complete: function complete() {
            if (transMatrix !== 'none') {
              $(this).css('transform', 'matrix(1, 0, 0, 1,' + (position + direction * step) + ', 0)');
            } else {
              $(this).css('transform', 'matrix(1, 0, 0, 1, -' + step + ', 0)');
            }
          }
        }, 'swing');
      }
    }

    clearTimeout(wheeling);
    wheeling = setTimeout(function () {
      console.log('stop wheeling!');
      wheeling = undefined; // reset wheeldelta

      wheeldelta.x = 0;
      wheeldelta.y = 0;
    }, 250);
    wheeldelta.x += e.originalEvent.deltaX;
    wheeldelta.y += e.originalEvent.deltaY; // console.log(wheeldelta);
  });
}



/***/ }),

/***/ 1:
/*!***************************************!*\
  !*** multi ./assets/js/pages/home.js ***!
  \***************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! ./assets/js/pages/home.js */"./assets/js/pages/home.js");


/***/ })

/******/ });
//# sourceMappingURL=home.js.map