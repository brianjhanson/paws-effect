var APP = window.APP || {};
var $ = jQuery;
var mainNav = require('./modules/main-nav.js');

APP.init = function() {
  mainNav();
};

$(document).ready(function() {
  APP.init();
});