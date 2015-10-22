var $ = jQuery;
module.exports = initMainNav;

function initMainNav(options) {
  var self = {
    navOpen: false
  };
  
  self.settings = $.extend({
    containerSelector: '.js-nav',
    triggerSelector: '.js-nav__trigger',
    menuSelector: '.js-nav__menu',
    activeClass: 'is-open'
  }, options);

  function _init() {
    self.$container = $(self.settings.containerSelector);
    self.$trigger = $(self.settings.triggerSelector);
    self.$menu = $(self.settings.menuSelector);
    _bind();
  }

  // private functions
  function _bind() {
    self.$trigger.on('click', _clickHandler);
  }

  function _clickHandler(event) {
    event.preventDefault();
    self.navOpen ? _close() : _open();
  }

  function _close() {
    self.$container.addClass(self.settings.activeClass);
    self.navOpen = false;
  }

  function _open() {
    self.$container.removeClass(self.settings.activeClass);
    self.navOpen = true;
  }

  _init();
}