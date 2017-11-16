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
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
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
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/assets/js/addItem.js":
/***/ (function(module, exports) {

$(document).ready(function () {
    $('.add').click(function (event) {
        if ($('.add').hasClass('btn-success')) {
            app.addItem();
        }
        event.stopPropagation();
        app.resetForm();
        $('.addNewItem').addClass('hideAddItem');
        $(".newItem").focus();
        $(this).removeClass('btn-primary').addClass('btn-success');
        $(this).children().removeClass('fa-plus').addClass('fa-check');
    });
    $('html').click(function (event) {
        if ($('.addNewItem').has('hideAddItem').length === 0 && !$(event.target).closest('.addNewItem').length) {
            app.resetForm();
            $('.ahGroupItem').hide();
            $('.addNewItem').removeClass('hideAddItem');
            $('.add').removeClass('btn-success').addClass('btn-primary');
            $('.add').children().removeClass('fa-check').addClass('fa-plus');
        }
    });
});

/***/ }),

/***/ "./resources/assets/js/buttons.js":
/***/ (function(module, exports) {

$(document).ready(function () {
    $(document).on('click', '.complete', function () {
        $(this).toggleClass('completed');
        $(this).parent().toggleClass('done');
        $(this).closest('li').find('.hoeveelheid').toggleClass('checked');
        $(this).closest('li').find('.items').toggleClass('checked');
    });

    $('.reset').click(function () {
        $('.shadow').show();
        $('.messageContainer').css('display', 'flex');
        $('.resetItems').show();
    });

    $('.trashContainer').click(function () {
        $('.trashContainer').css('display', 'none');
        $('.trash').hide();
    }).children().click(function () {
        return false;
    });

    $('.delete').click(function () {
        $('.trashContainer').css('display', 'flex');
        $('.trash').show();
    });

    $('.confirmationButton').click(function () {
        $('.shadow').hide();
        $('.messageContainer').hide();
        $('.resetItems').hide();
        $('.saveItems').hide();
        $('.trashContainer').hide();
        $('.trash').hide();
    });
});

/***/ }),

/***/ "./resources/assets/sass/groceries.scss":
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/assets/sass/login.scss":
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/assets/sass/users.scss":
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ 0:
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__("./resources/assets/js/buttons.js");
__webpack_require__("./resources/assets/js/addItem.js");
__webpack_require__("./resources/assets/sass/login.scss");
__webpack_require__("./resources/assets/sass/groceries.scss");
module.exports = __webpack_require__("./resources/assets/sass/users.scss");


/***/ })

/******/ });