/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/js/app.js":
/*!*****************************!*\
  !*** ./resources/js/app.js ***!
  \*****************************/
/***/ (() => {

jQuery(function ($) {
  //the shrinkHeader variable is where you tell the scroll effect to start.
  var shrinkHeader = 100;
  headerShrink();
  $(window).scroll(function () {
    //console.log(scroll);
    headerShrink();
  });
  function getCurrentScroll() {
    return window.pageYOffset || document.documentElement.scrollTop;
  }
  function headerShrink() {
    var scroll = getCurrentScroll();
    if (scroll >= shrinkHeader) {
      $('.site-header').addClass('header-shrink');
    } else {
      $('.site-header').removeClass('header-shrink');
    }
  }
  $('.menu-has-article').hover(function () {
    // $('.menu-article').css({
    //   visibility: 'hidden',
    //   opacity: '0',
    //   zIndex: '-10',
    // });
    // $('.menu-article').fadeOut('slow', function () {});
    $('.menu-article').hide();
    var dataArticle = $(this).data('target');
    //console.log(dataArticle);
    $('#' + dataArticle).fadeIn('slow', function () {});
    // $('#' + dataArticle).css({
    //   visibility: 'visible',
    //   opacity: '100',
    //   zIndex: '0',
    // });
  }, function () {
    // let dataArticle = $(this).data('target');
    // console.log(dataArticle);
    // $('#' + dataArticle).css({ visibility: 'hidden', opacity: '0' });
  });
  $('.main-nav--ul > li').hover(function () {
    //$('#main-nav').addClass('bg-brand-bluedark bg-opacity-95');
  }, function () {
    //$('#main-nav').removeClass('bg-brand-bluedark bg-opacity-95');
  });

  // Mobile Menu
  $('#mobilemenu-open').click(function (e) {
    e.preventDefault();
    $('#mobilemenu').removeClass('translate-x-full');
    $('#mobilemenu-overlay').removeClass('invisible opacity-0').addClass('visible opacity-100');
    $('body').addClass('overflow-y-hidden');
  });
  $('#mobilemenu-close, #mobilemenu-overlay').click(function (e) {
    e.preventDefault();
    $('#mobilemenu').addClass('translate-x-full');
    $('#mobilemenu-overlay').removeClass('visible opacity-100').addClass('invisible opacity-0');
    $('body').removeClass('overflow-y-hidden');
  });
  $('#mobilemenu a').click(function (e) {
    $('#mobilemenu').addClass('translate-x-full');
    $('#mobilemenu-overlay').removeClass('visible opacity-100').addClass('invisible opacity-0');
    $('body').removeClass('overflow-y-hidden');
  });

  // Header Search
  $('#header-search-button').on('click', function () {
    $('#header-search').toggleClass('show');
    $('#searchform-input').val('');
    $('#searchform-input').focus();
  });
  $(window).click(function () {
    if ($('#header-search').hasClass('show')) {
      $('#header-search').removeClass('show');
      $('#searchform-input').val('');
    }
  });
  $('#header-search, #header-search-button').click(function (event) {
    event.stopPropagation();
  });

  // Accordion
  $('.collapse').click(function (e) {
    e.preventDefault();
    $('.collapse').find('input[type=checkbox]').prop('checked', false);
    $(this).find('input[type=checkbox]').prop('checked', true);
    $('html, body').scrollTop($(this).offset().top - 16 - $('.site-header').outerHeight(true));
  });
  $("a[href*='#']").click(function (e) {
    //e.preventDefault();
    //var urlhash = $(location).prop('hash');
    var targetEle = this.hash;
    var $targetEle = $(targetEle);
    $('html, body').stop().animate({
      scrollTop: $targetEle.offset().top - 16 - $('.site-header').outerHeight(true)
    }, 500, 'swing', function () {
      window.location.hash = targetEle;
    });
    if ($targetEle.hasClass('collapse')) {
      //console.log('collapse');
      $('.collapse').find('input[type=checkbox]').prop('checked', false);
      $targetEle.find('input[type=checkbox]').prop('checked', true);
    }
  });
});

/***/ }),

/***/ "./resources/css/app.css":
/*!*******************************!*\
  !*** ./resources/css/app.css ***!
  \*******************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./resources/css/editor-style.css":
/*!****************************************!*\
  !*** ./resources/css/editor-style.css ***!
  \****************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./resources/css/admin-style.css":
/*!***************************************!*\
  !*** ./resources/css/admin-style.css ***!
  \***************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./resources/css/acf-layouts.css":
/*!***************************************!*\
  !*** ./resources/css/acf-layouts.css ***!
  \***************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = __webpack_modules__;
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/chunk loaded */
/******/ 	(() => {
/******/ 		var deferred = [];
/******/ 		__webpack_require__.O = (result, chunkIds, fn, priority) => {
/******/ 			if(chunkIds) {
/******/ 				priority = priority || 0;
/******/ 				for(var i = deferred.length; i > 0 && deferred[i - 1][2] > priority; i--) deferred[i] = deferred[i - 1];
/******/ 				deferred[i] = [chunkIds, fn, priority];
/******/ 				return;
/******/ 			}
/******/ 			var notFulfilled = Infinity;
/******/ 			for (var i = 0; i < deferred.length; i++) {
/******/ 				var [chunkIds, fn, priority] = deferred[i];
/******/ 				var fulfilled = true;
/******/ 				for (var j = 0; j < chunkIds.length; j++) {
/******/ 					if ((priority & 1 === 0 || notFulfilled >= priority) && Object.keys(__webpack_require__.O).every((key) => (__webpack_require__.O[key](chunkIds[j])))) {
/******/ 						chunkIds.splice(j--, 1);
/******/ 					} else {
/******/ 						fulfilled = false;
/******/ 						if(priority < notFulfilled) notFulfilled = priority;
/******/ 					}
/******/ 				}
/******/ 				if(fulfilled) {
/******/ 					deferred.splice(i--, 1)
/******/ 					var r = fn();
/******/ 					if (r !== undefined) result = r;
/******/ 				}
/******/ 			}
/******/ 			return result;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/jsonp chunk loading */
/******/ 	(() => {
/******/ 		// no baseURI
/******/ 		
/******/ 		// object to store loaded and loading chunks
/******/ 		// undefined = chunk not loaded, null = chunk preloaded/prefetched
/******/ 		// [resolve, reject, Promise] = chunk loading, 0 = chunk loaded
/******/ 		var installedChunks = {
/******/ 			"/assets/js/app": 0,
/******/ 			"assets/css/acf-layouts": 0,
/******/ 			"assets/css/admin-style": 0,
/******/ 			"assets/css/editor-style": 0,
/******/ 			"assets/css/app": 0
/******/ 		};
/******/ 		
/******/ 		// no chunk on demand loading
/******/ 		
/******/ 		// no prefetching
/******/ 		
/******/ 		// no preloaded
/******/ 		
/******/ 		// no HMR
/******/ 		
/******/ 		// no HMR manifest
/******/ 		
/******/ 		__webpack_require__.O.j = (chunkId) => (installedChunks[chunkId] === 0);
/******/ 		
/******/ 		// install a JSONP callback for chunk loading
/******/ 		var webpackJsonpCallback = (parentChunkLoadingFunction, data) => {
/******/ 			var [chunkIds, moreModules, runtime] = data;
/******/ 			// add "moreModules" to the modules object,
/******/ 			// then flag all "chunkIds" as loaded and fire callback
/******/ 			var moduleId, chunkId, i = 0;
/******/ 			if(chunkIds.some((id) => (installedChunks[id] !== 0))) {
/******/ 				for(moduleId in moreModules) {
/******/ 					if(__webpack_require__.o(moreModules, moduleId)) {
/******/ 						__webpack_require__.m[moduleId] = moreModules[moduleId];
/******/ 					}
/******/ 				}
/******/ 				if(runtime) var result = runtime(__webpack_require__);
/******/ 			}
/******/ 			if(parentChunkLoadingFunction) parentChunkLoadingFunction(data);
/******/ 			for(;i < chunkIds.length; i++) {
/******/ 				chunkId = chunkIds[i];
/******/ 				if(__webpack_require__.o(installedChunks, chunkId) && installedChunks[chunkId]) {
/******/ 					installedChunks[chunkId][0]();
/******/ 				}
/******/ 				installedChunks[chunkId] = 0;
/******/ 			}
/******/ 			return __webpack_require__.O(result);
/******/ 		}
/******/ 		
/******/ 		var chunkLoadingGlobal = self["webpackChunksmc"] = self["webpackChunksmc"] || [];
/******/ 		chunkLoadingGlobal.forEach(webpackJsonpCallback.bind(null, 0));
/******/ 		chunkLoadingGlobal.push = webpackJsonpCallback.bind(null, chunkLoadingGlobal.push.bind(chunkLoadingGlobal));
/******/ 	})();
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module depends on other loaded chunks and execution need to be delayed
/******/ 	__webpack_require__.O(undefined, ["assets/css/acf-layouts","assets/css/admin-style","assets/css/editor-style","assets/css/app"], () => (__webpack_require__("./resources/js/app.js")))
/******/ 	__webpack_require__.O(undefined, ["assets/css/acf-layouts","assets/css/admin-style","assets/css/editor-style","assets/css/app"], () => (__webpack_require__("./resources/css/app.css")))
/******/ 	__webpack_require__.O(undefined, ["assets/css/acf-layouts","assets/css/admin-style","assets/css/editor-style","assets/css/app"], () => (__webpack_require__("./resources/css/editor-style.css")))
/******/ 	__webpack_require__.O(undefined, ["assets/css/acf-layouts","assets/css/admin-style","assets/css/editor-style","assets/css/app"], () => (__webpack_require__("./resources/css/admin-style.css")))
/******/ 	var __webpack_exports__ = __webpack_require__.O(undefined, ["assets/css/acf-layouts","assets/css/admin-style","assets/css/editor-style","assets/css/app"], () => (__webpack_require__("./resources/css/acf-layouts.css")))
/******/ 	__webpack_exports__ = __webpack_require__.O(__webpack_exports__);
/******/ 	
/******/ })()
;