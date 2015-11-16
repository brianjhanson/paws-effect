var GoogleMapsLoader = require('google-maps'); // only for common js environments 
var $ = jQuery;

module.exports = {};
module.exports.trainingCenter = trainingCenter;
module.exports.drawMap = drawMap;
GoogleMapsLoader.KEY = 'AIzaSyBtCWGnx-xFobcS7jiIbipV-0fTbjSyMgo';

var self = {};

function init() {
  self.settings = $.extend({
    mapSelector: '.js-map'
  });
  
  self.$map = $(self.settings.mapSelector);
}

function drawMap() {
  init();

  var lat = self.$map.attr('data-lat');
  var lng = self.$map.attr('data-lng');

  GoogleMapsLoader.load(function(google) {
    var pos = new google.maps.LatLng(lat, lng);
    console.log(pos);
    var map = new google.maps.Map(self.$map[0], {
      center: pos,
      scrollwheel: false,
      zoom: 17
    });

    new google.maps.Marker({
      position: pos,
      map: map
    });
  });
}

function trainingCenter() {
  init();

  var lat = self.$map.attr('data-lat');
  var lng = self.$map.attr('data-lng');

  GoogleMapsLoader.load(function(google) {
    var pos = new google.maps.LatLng(lat, lng);
    var map = new google.maps.Map(self.$map[0], {
      center: pos,
      scrollwheel: false,
      zoom: 17
    });

    var marker = new google.maps.Marker({
      position: pos,
      map: map,
      title: 'Paws & Effect'
    });

    var contentString = [
      '<div class="map-info">',
      '<div class="map-info__title"><h4>Training Facility</h4></div>',
      '<div class="map-info__addr"><p>2629 Beaver Avenue <br/> Des Moines, IA 50310</p></div>',
      '</div>'
    ].join('');

    var infoWindow = new google.maps.InfoWindow({
      content: contentString,
      maxWidth: 280
    });
    
    infoWindow.open(map, marker);
  });
}

