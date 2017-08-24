<!DOCTYPE>
<html>
  <head>
    <script type='text/javascript' src='http://maps.google.com/maps/api/js'></script>
        <meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
  </head>
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
for($i=0;$i<count($ListCommerces)-1;$i++){
  $adresses_lat .= "'".$ListCommerces[$i]['lat']."', ";
  $adresses_lng .= "'".$ListCommerces[$i]['lng']."', ";
  $identify_customer .= '"'.$ListCommerces[$i]['nom'].'", ';
}

$adresses_lat = "[".substr($adresses_lat,0,-2)."]";
$adresses_lng = "[".substr($adresses_lng,0,-2)."]";
$identify_customer = "[".substr($identify_customer,0,-2)."]";
?>
<!-  --------------------- FIN DU PHP ---------------------------------  --> 

	
<style>
   #map {
      height: 470px;
      width: 1600px;
   }
</style>
<?php 



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
  for($i=0;$i<count($ListCommerces)-1;$i++){
    $adresses_lat .= "'".$ListCommerces[$i]['lat']."', ";
    $adresses_lng .= "'".$ListCommerces[$i]['lng']."', ";
    $identify_customer .= '"'.$ListCommerces[$i]['nom'].'", ';
  }

  $adresses_lat = "[".substr($adresses_lat,0,-2)."]";
  $adresses_lng = "[".substr($adresses_lng,0,-2)."]";
  $identify_customer = "[".substr($identify_customer,0,-2)."]";

?>

<div id="map"></div>
<script>
   var geocoder, map;
   
   function initMap() {
      var optCenterMap = new google.maps.LatLng(48, 2);
      var myOptions = {
         zoom: 10,
         center: optCenterMap,
         mapTypeId: google.maps.MapTypeId.ROADMAP
      }
      map = new google.maps.Map(document.getElementById("map"), myOptions);
     
      var adresses_lat = <?php echo $adresses_lat; ?>;
      var adresses_lng = <?php echo $adresses_lng; ?>;
      var identify_technicien = <?php echo $identify_customer; ?>;
      var bounds = new google.maps.LatLngBounds();
      var markers = new Array();
      for (var i = 0; i < adresses_lat.length; i++) {
         var optCenterMarker = new google.maps.LatLng(adresses_lat[i], adresses_lng[i]);
         var mark = new google.maps.Marker({
             position: optCenterMarker,
             map: map,
             title: identify_technicien[i]
         });
         markers.push(mark);
         var infoBulle = new google.maps.InfoWindow();
         var content = '<b>'+identify_technicien[i]+'</b>';
         google.maps.event.addListener(mark,'click', (function(mark,content,infoBulle){ 
             return function() {
                infoBulle.setContent(content)
                infoBulle.open(map, mark);
             };
         })(mark,content,infoBulle));
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



</html>