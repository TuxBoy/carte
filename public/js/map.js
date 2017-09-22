var geocoder, map;

var initMap = function () {
  var optCenterMap = new google.maps.LatLng(48, 2);
  var myOptions = {
    zoom: 6,
    center: optCenterMap,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  }
  map = new google.maps.Map(document.getElementById("map"), myOptions);

  var adresses_lat;
  var adresses_lng;
  var identify_technicien;
  var desmarqueur;
  var lien;
  var bounds;
  var icons;
  var markers = new Array();
  /*for (var i = 0; i < adresses_lat.length; i++) {
    var optCenterMarker = new google.maps.LatLng(adresses_lat[i], adresses_lng[i]);
    var mark = new google.maps.Marker({
      position: optCenterMarker,
      map: map,
      icon: icons[i],
      title: identify_technicien[i]
    });
    markers.push(mark);
    var infoBulle = new google.maps.InfoWindow();
    var content = '<b>'+identify_technicien[i]+'</b>';
    var title = identify_technicien[i];
    var content_desc = desmarqueur[i];
    var lien_url = lien[i];
    google.maps.event.addListener(mark, 'mouseover', (function(mark, title, content_desc, lien_url) {
      return function() {
        var content_marker = title + '<br>' + content_desc + '<br><a target="_blank" href="' + lien_url + '">' + '+  d\'info' + '</a>'
        infoBulle.setContent(content_marker);
        infoBulle.open(map, mark);
      }
    })(mark, title, content_desc, lien_url));
    //infoBulle.setContent(content)
    //infoBulle.open(map, mark);
  }*/

  var markerCluster = new MarkerClusterer(map, markers,
    {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});
}