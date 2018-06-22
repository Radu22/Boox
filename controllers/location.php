<?php
    session_start();
    require_once("../models/location.php");
    $lat = $_REQUEST["lat"];
    $long = $_REQUEST["long"];
    $location = new Location($lat, $long);
    
   	$location->updateLocation();
    $location->locNotification();
 ?>
