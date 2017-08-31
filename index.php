<style>
   #map {
      height: 800px;
      width: 100%;
   }
</style>
<?php
  function __autoload($class_name) {
    include_once ('./class/'.$class_name.'.class.php');
  }
  define ('DEBUG','ON');

  include_once './config/db.inc.php';
  // Connexion a la base de donnees
  try {
    $dbh = new PDO('mysql:host='.$sql['server'].';dbname='.$sql['database'], $sql['login'], $sql['pass']);
  }
  catch (PDOException $e) {
    echo '<p class="error">Impossible de se connecter à la base de données, veuillez réessayer.</p>';
    exit;
  }

  $Commerces = new Commerces($dbh);

  $ListCommerces = $Commerces->GetListCommerce();

  $adresses_lat = '';
  $adresses_lng = '';
  $identify_customer='';
  $icons='';
  $desmarqueur='';
  $lien='';


  for($i=0;$i<count($ListCommerces)-1;$i++){
    $adresses_lat .= "'".$ListCommerces[$i]['lat']."', ";
    $adresses_lng .= "'".$ListCommerces[$i]['lng']."', ";
    $identify_customer .= '"'.$ListCommerces[$i]['nom'].'", ';
    $icons.= '"'.$ListCommerces[$i]['icons'].'", ';
    $desmarqueur.= '"'.$ListCommerces[$i]['desmarqueur'].'", ';
    $lien.= '"'.$ListCommerces[$i]['lien'].'", ';

  }

  $adresses_lat = "[".substr($adresses_lat,0,-2)."]";
  $adresses_lng = "[".substr($adresses_lng,0,-2)."]";
  $identify_customer = "[".substr($identify_customer,0,-2)."]";
  $icons = "[".substr($icons,0,-2)."]";
  $desmarqueur = "[".substr($desmarqueur,0,-2)."]";
  $lien = "[".substr($lien,0,-2)."]";

?>

<div id="map"></div>
<script>
   var geocoder, map;

   function initMap() {
      var optCenterMap = new google.maps.LatLng(48, 2);
      var myOptions = {
         zoom: 6,
         center: optCenterMap,
         mapTypeId: google.maps.MapTypeId.ROADMAP
      }
      map = new google.maps.Map(document.getElementById("map"), myOptions);

      var adresses_lat = <?php echo $adresses_lat; ?>;
      var adresses_lng = <?php echo $adresses_lng; ?>;
      var identify_technicien = <?php echo $identify_customer; ?>;
      var desmarqueur = <?php echo $desmarqueur; ?>;
      var lien = <?php echo $lien; ?>;
      var bounds = new google.maps.LatLngBounds();
      var icons = <?= $icons ?>;
      var markers = new Array();
      for (var i = 0; i < adresses_lat.length; i++) {
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
      }

      var markerCluster = new MarkerClusterer(map, markers,
            {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});
   }

</script>
<script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js">
    </script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCEbHjXyYvxFHP11e7fw1n-_AVzchbC9-M&libraries=geometry&callback=initMap">
</script>
<a href="admin/index.php">Administration</a>
