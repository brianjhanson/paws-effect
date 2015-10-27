var APP = window.APP || {};
var $ = jQuery;
var mainNav = require('./modules/main-nav.js');
var peSlider = require('./modules/pe-slider.js');
var peMaps = require('./modules/pe-maps.js');
var router = require('mini-router');

APP.init = function() {
  // init our router
  router({
    '/$': APP.routeHome,
    '/contact/?$': APP.routeContact
  });
  mainNav();
};

APP.routeHome = function() {
  // console.log(peSlider);
  peSlider();
  peMaps();
};

APP.routeContact = function() {
  peMaps();
};

$(document).ready(function() {
  APP.init();
});