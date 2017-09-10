<?php


class Commerces { 
  # Variables de la classe
	private $dbh;
	
	public function __construct($dbh='') {
		$this->dbh = $dbh;
	}

	public function GetListCommerceForCalculateLatLng(){
		$sql = 'SELECT *
		FROM commerce
		WHERE lat = ""
		AND lng =""';
		$sth = $this->dbh->prepare($sql);
		if ($sth->execute()) {
			$i=0;
			while($data[$i] = $sth->fetch()) $i++;
			return $data;
		} else {
			if(DEBUG == 'ON') {
				echo '<p class="Debug">Erreur SQL : '.$sql.' - '.var_dump($sth->errorInfo()).'</p>';
			}
		}
	}

	public function update_commerce($lat, $lng, $id){
		$sql = 'UPDATE commerce SET lat = ?,lng = ?
		WHERE id = ? ';
		$sth = $this->dbh->prepare($sql);
		$sth->bindParam(1, $lat, PDO::PARAM_INT);
		$sth->bindParam(2, $lng, PDO::PARAM_INT);
		$sth->bindParam(3, $id, PDO::PARAM_INT);
		if ($sth->execute()) {
			return true;
		} else {
			if(DEBUG == 'ON') {
				echo '<p class="Debug">Erreur SQL : '.$sql.' - '.var_dump($sth->errorInfo()).'</p>';
			}
		}
	}

	public function update_lat_long() {
      $GetListCommerceForCalculateLatLng = $this->GetListCommerceForCalculateLatLng();
      for ($i=0;$i<count($GetListCommerceForCalculateLatLng)-1;$i++) {
         $adresses = stripslashes(strip_tags(nl2br(($GetListCommerceForCalculateLatLng[$i]['rue'] . ' ' . $GetListCommerceForCalculateLatLng[$i]['cp'] . ' ' . $GetListCommerceForCalculateLatLng[$i]['ville'] . ' ' . $GetListCommerceForCalculateLatLng[$i]['pays']))));
         $address = urlencode(str_replace(array("\r\n", "\n", "\r"), ' ', $adresses));
         $response_a = new \stdClass();
         $response_a->error_message = 'Vous avez atteinte les limites';
         //htmldump($response_a);
         while (isset($response_a->error_message) && $response_a->error_message == 'Vous avez atteinte les limites') {
            //htmldump($response_a);
            $address_url = "https://maps.google.com/maps/api/geocode/json?address=$address";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $address_url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            $response = curl_exec($ch);
            curl_close($ch);
            //$response_a->error_message = '';
            $response_a = json_decode($response);
         }

         //Print the provided address in Human readable/ complete Postal address;
         //Print the Latitude and Longitude of the address
         if (isset($response_a->results[0]->geometry->location->lat)) {
            $lat = $response_a->results[0]->geometry->location->lat;
            $long = $response_a->results[0]->geometry->location->lng;
            $this->update_commerce($lat,$long, $GetListCommerceForCalculateLatLng[$i]['id']);
         }
      }
   }
	public function GetListCommerce(){
		$this->update_lat_long();
		$sql = 'SELECT *
		FROM commerce
		WHERE lat != ""
		AND lng != "" ';
		$sth = $this->dbh->prepare($sql);
		if ($sth->execute()) {
			$i=0;
			while($data[$i] = $sth->fetch()) $i++;
			return $data;
		} else {
			if(DEBUG == 'ON') {
				echo '<p class="Debug">Erreur SQL : '.$sql.' - '.var_dump($sth->errorInfo()).'</p>';
			}
		}
	}
	
}

?>