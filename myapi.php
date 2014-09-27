<?php

$y1 = $_GET["y1"];
$x1 = $_GET["x1"];
$y2 = $_GET["y2"];
$x2 = $_GET["x2"];
?>

<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Simple Polylines</title>
    <style>
      html, body, #map-canvas {
        height: 90%;
        margin: 0px;
        padding: 0px
      }
    </style>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
    <script>

function initialize() {
  var mapOptions = {
    zoom: 2,
    center: new google.maps.LatLng(<?php $newyy = (($y1+$y2)/2); echo $newyy; ?>, <?php $newxx = (($x1+$x2)/2); echo $newxx; ?>),
    mapTypeId: google.maps.MapTypeId.TERRAIN
  };

  var map = new google.maps.Map(document.getElementById('map-canvas'),
      mapOptions);

  var flightPlanCoordinates = [
    new google.maps.LatLng(<?php echo $y1; ?>, <?php echo $x1; ?>),
    new google.maps.LatLng(<?php echo $y2; ?>, <?php echo $x2; ?>)
  ];
  var flightPath = new google.maps.Polyline({
    path: flightPlanCoordinates,
    geodesic: true,
    strokeColor: '#FF0000',
    strokeOpacity: 1.0,
    strokeWeight: 2
  });

  flightPath.setMap(map);
}

google.maps.event.addDomListener(window, 'load', initialize);

    </script>
  </head>
  <body>
    <div id="map-canvas"></div>
	Location 1 (Lat/Lon): <?php echo $y1. ",".$x1; ?><br />
	Location 2 (Lat/Lon): <?php echo $y2, ",".$x2; ?><br />
  </body>
</html>