var GoogleMapsLoader = require('google-maps'); // only for common js environments 
var $ = jQuery;

module.exports = init;
GoogleMapsLoader.KEY = 'AIzaSyBtCWGnx-xFobcS7jiIbipV-0fTbjSyMgo';

function init() {
  var self = {};

  self.settings = $.extend({
    mapSelector: '.js-map'
  });
  
  self.$map = $(self.settings.mapSelector);
  self.lat = self.$map.attr('data-lat');
  self.lng = self.$map.attr('data-lng');
  self.addr = self.$map.attr('data-addr');

  GoogleMapsLoader.load(function(google) {
    var map = new google.maps.Map(self.$map[0], {
      center: new google.maps.LatLng(self.lat, self.lng),
      scrollWheel: false,
      zoom: 17
    });

    var marker = new google.maps.Marker({
      position: new google.maps.LatLng(self.lat, self.lng),
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

