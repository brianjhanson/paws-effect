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
    '/contact/?$': APP.routeContact,
    '/events(.+)': APP.routeEvents
  });
  mainNav();
};

APP.routeHome = function() {
  // console.log(peSlider);
  peSlider();
  peMaps.trainingCenter();
};

APP.routeContact = function() {
  peMaps.trainingCenter();
};

APP.routeEvents = function() {
  peMaps.drawMap();
}

$(document).ready(function() {
  APP.init();
});