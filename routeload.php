<!DOCTYPE html>
<html>
<head>
<meta charset=utf-8 />
<title>GeoJSON Marker from URL</title>
  
  <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no' />
  <script src='//api.tiles.mapbox.com/mapbox.js/v1.4.2/mapbox.js'></script>
  <link href='//api.tiles.mapbox.com/mapbox.js/v1.4.2/mapbox.css' rel='stylesheet' />
  
  <style>
    body { margin:0; padding:0; }
    #map { position:absolute; top:0; bottom:0; width:100%; }
  </style>
</head>
<body>
<div id='map'></div>
<script>
var map = L.mapbox.map('map', 'glennon.ga2nja98')
    .setView([38.7335, -9.160], 17);
	

// load only the geojson parts you need.

var markerLayer = L.mapbox.markerLayer()
    .loadURL('novaroutes.geojson')
	// start with all routes off
	.filter(function() { return false })
    .addTo(map);

map.markerLayer.setFilter(function() {return true});


	

</script>
</body>
</html>