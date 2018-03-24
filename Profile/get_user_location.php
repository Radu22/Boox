<?php
		global $latitude,$longitude;
			function get(){
				$adress = 'Romania,Iasi';
				$adress = urlencode($adress);
				$url = 'http://maps.googleapis.com/maps/api/geocode/xml?address=' . $adress . '&sensor=true';
				  $xml = simplexml_load_file($url);
				  $status = $xml->status;
				  if ($status == 'OK') {
				   	  $latitude = $xml->result->geometry->location->lat;
				      $longitude = $xml->result->geometry->location->lng;
				  }

				  return 'Coordinates are ' . $latitude . ' - lat,and ' . $longitude . ' - lng';
			}
?>