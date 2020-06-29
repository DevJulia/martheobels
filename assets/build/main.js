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
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./assets/js/helpers/common.js":
/*!*************************************!*\
  !*** ./assets/js/helpers/common.js ***!
  \*************************************/
/*! exports provided: common */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "common", function() { return common; });
function common() {
  console.log($('body'));
}



/***/ }),

/***/ "./assets/js/index.js":
/*!****************************!*\
  !*** ./assets/js/index.js ***!
  \****************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _helpers_common_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./helpers/common.js */ "./assets/js/helpers/common.js");
/* harmony import */ var _pages_home_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./pages/home.js */ "./assets/js/pages/home.js");


$(document).ready(function () {
  Object(_helpers_common_js__WEBPACK_IMPORTED_MODULE_0__["common"])();
  if ($('body').hasClass('page-template-homepage')) Object(_pages_home_js__WEBPACK_IMPORTED_MODULE_1__["home"])();
});

/***/ }),

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
  var $frame = $('#basic');
  var $wrap = $frame.parent();
  var options = {
    horizontal: 1,
    itemNav: 'basic',
    slidee: '.slidee',
    smart: 1,
    // mouseDragging: 1,
    // touchDragging: 1,
    releaseSwing: 1,
    startAt: 0,
    scrollBar: $wrap.find('.scrollbar'),
    scrollBy: 1,
    speed: 500,
    elasticBounds: 1,
    dragHandle: 1,
    dynamicHandle: 1,
    clickBar: 1,
    keyboardNavBy: 'pages'
  };
  var sly = new Sly($frame, options).init();
  sly.on('moveEnd', function (e) {
    console.log(Math.round(sly.pos.cur * 100 / sly.pos.end));
  });
  $wrap.find('.toStart').on('click', function () {
    var item = $(this).data('item'); // Animate a particular item to the start of the frame.
    // If no item is provided, the whole content will be animated.

    $frame.sly('toStart', item);
  });
  $(window).resize(function () {
    sly.reload();
  });
}



/***/ }),

/***/ "./assets/sass/main.scss":
/*!*******************************!*\
  !*** ./assets/sass/main.scss ***!
  \*******************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

// extracted by mini-css-extract-plugin

/***/ }),

/***/ 0:
/*!**********************************************************!*\
  !*** multi ./assets/js/index.js ./assets/sass/main.scss ***!
  \**********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! ./assets/js/index.js */"./assets/js/index.js");
module.exports = __webpack_require__(/*! ./assets/sass/main.scss */"./assets/sass/main.scss");


/***/ })

/******/ });
//# sourceMappingURL=main.js.map