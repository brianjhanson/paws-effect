var $ = jQuery;
var Flickity = require('flickity');
require('flickity-imagesloaded');
module.exports = initSlider;

function initSlider(options) {
  var self = {};

  self.settings = $.extend({
    containerSelector: '.js-slider',
    slideSelector: '.js-slider__item'
  }, options);

  var _init = function() {
    var flktyOpts = {
      // Options will go here
    };

    self.slider = new Flickity(
      self.settings.containerSelector, 
      {
        imagesLoaded: true,
        cellSelector: self.settings.slideSelector,
        cellAlign: 'left'
      }
    );

  };

  _init();
}
