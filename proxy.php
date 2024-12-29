<?php
// proxy.php
$origin = $_GET['origin'];
$destination = $_GET['destination'];
$apiKey = 'AIzaSyAx_5V0k3AP2ZxGMNZ7TSy0LnhwChWuDoE';

$url = "https://maps.googleapis.com/maps/api/directions/json?origin=$origin&destination=$destination&mode=driving&key=$apiKey";
$response = file_get_contents($url);
echo $response;
