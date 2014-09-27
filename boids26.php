<html>
<head>
  <link href='//api.tiles.mapbox.com/mapbox.js/v1.4.0/mapbox.css' rel='stylesheet' />
  <!--[if lte IE 8]>
    <link href='//api.tiles.mapbox.com/mapbox.js/v1.4.0/mapbox.ie.css' rel='stylesheet' />
  <![endif]-->
  <script src='//api.tiles.mapbox.com/mapbox.js/v1.4.0/mapbox.js'></script>
  <style>
  #map {
    width:100%;
    height:80%;
  }
  </style>
</head>
<body>
  <div id='map' class='dark'></div>
  <script type='text/javascript'>
  
	function getRandomInt(min, max) {
		return Math.floor(Math.random() * (max - min + 1) + min);
	}
  
  
	function toRad(Value) {
    /** Converts numeric degrees to radians */
		return Value * Math.PI / 180;
	}
	
	function toDeg(Value) {
		return Value * (180 / Math.PI);
	}
  
	function getBearing(startLat,startLong,endLat,endLong){
		startLat = toRad(startLat);
		startLong = toRad(startLong);
		endLat = toRad(endLat);
		endLong = toRad(endLong);

		var dLong = endLong - startLong;

		var dPhi = Math.log(Math.tan(endLat/2.0+Math.PI/4.0)/Math.tan(startLat/2.0+Math.PI/4.0));
		if (Math.abs(dLong) > Math.PI){
			if (dLong > 0.0)
			dLong = -(2.0 * Math.PI - dLong);
		else
			dLong = (2.0 * Math.PI + dLong);
		}
		var azzymuth = (toDeg(Math.atan2(dLong, dPhi)) + 360.0) % 360.0;
		
		if (azzymuth >= 27.5 && azzymuth < 72.5) {
			return 8;
		}
		if (azzymuth >= 72.5 && azzymuth < 117.5) {
			return 7;
		}
		if (azzymuth >= 117.5 && azzymuth < 152.5) {
			return 6;
		}
		if (azzymuth >= 152.5 && azzymuth < 197.5) {
			return 5;
		}
		if (azzymuth >= 197.5 && azzymuth < 242.5) {
			return 4;
		}
		if (azzymuth >= 242.5 && azzymuth < 297.5) {
			return 3;
		}
		if (azzymuth >= 297.5 && azzymuth < 332.5) {
			return 2;
		}
		if (azzymuth >= 332.5 || azzymuth < 27.5) {
			return 1;
		}
		}
		
		// if (azzymuth >= 332.5 && azzymuth < 27.5) {
		// 	return 1;
		//}
		
 
 
 
  
	function haversine(lat1,lat2,lng1,lng2){
		rad = 6372.8; // for km Use 3961 for miles
		deltaLat = toRad(lat2-lat1);
		deltaLng = toRad(lng2-lng1);
		lat1 = toRad(lat1);
		lat2 = toRad(lat2);
		a = Math.sin(deltaLat/2) * Math.sin(deltaLat/2) + Math.sin(deltaLng/2) * Math.sin(deltaLng/2) * Math.cos(lat1) * Math.cos(lat2); 
		c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
		return  rad * c;
	}
  
	var map = L.mapbox.map('map', 'glennon.g6l2a8f4')
      .setView([38.9, -9.2], 9);
	var marker = [];
	var startinglat = [];
	var startinglon = [];	
	var observationsize = 5;
	
	
	for (var loopini=0;loopini<observationsize;loopini++)
		{
		startinglat[loopini] = 0;
		startinglon[loopini] = 0;
		}
	
	for (var loopone=0;loopone<observationsize;loopone++)
		{
		marker[loopone] = L.marker([startinglat[loopone], startinglat[loopone]], {
				icon: L.mapbox.marker.icon({
					type: 'Feature',
					geometry: {
						type: 'Point',
						coordinates: [startinglat[loopone], startinglat[loopone]]
					},
					properties: {  }
				})
			});
		};
	
	var newlat = [];
	var newlon = [];
	var mydirection = [];
	
	for (var looptwo=0;looptwo<observationsize;looptwo++)
		{
		startinglat[looptwo] = ((Math.random()*1)+38.5);
		startinglon[looptwo] = ((Math.random()*1)-9.5);	
		newlat[looptwo] = startinglat[looptwo];
		newlon[looptwo] = startinglon[looptwo];	
		};
	
	
	var lat1 = 0;
	var lng1 = 0;
	var result = 0;
	var nearestneighboraddress = -1;
	var computerResponse = 0;
	
	// answers to the question: for current address, nearest lat, lon, and distance
	var nearyneighbor = [];
	var nearydis = [];
	
	var priordirection = []
	for (var loop3a=0;loop3a<observationsize;loop3a++)
		{
		priordirection[loop3a] = 0;
		}
	
	
	
	window.setInterval(function() {
			
		result = 40100; // a very high result to start
		
		// distance between coordinate pair herehere and pair therethere
		for (var hereherecounter=0;hereherecounter<observationsize;hereherecounter++)
			{
			for (var theretherecounter=0;theretherecounter<observationsize;theretherecounter++){
				var ans = haversine(newlat[hereherecounter],newlat[theretherecounter],newlon[hereherecounter],newlon[theretherecounter]);
				// check for a lower distance and exclude itself from consideration
				if ((ans < result) && (hereherecounter != theretherecounter)) {
					result = ans;
					nearestneighboraddress = theretherecounter;
					
					// at this point, for the -- hereherecounter address, its nearest neighbor is nearestneighboraddress with a distance of result
					
				}
		
			}
			nearyneighbor[hereherecounter] = nearestneighboraddress; 
			nearydis[hereherecounter] = result;
			result = 40100; // a very high result to start the next round

			};
		
        var azzy = getBearing(newlat[0],newlon[0],newlat[nearyneighbor[0]],newlon[nearyneighbor[0]]);
		document.getElementById("awesome").innerHTML = "node address 0; closest node: "+nearyneighbor[0]+" at: "+nearydis[0]+" azimuth: "+azzy;
		
		var azzy2 = getBearing(newlat[1],newlon[1],newlat[nearyneighbor[1]],newlon[nearyneighbor[1]]);
		document.getElementById("status2").innerHTML = "node address 1; closest node: "+nearyneighbor[1]+" at: "+nearydis[1]+" azimuth: "+azzy2;

		var azzy3 = getBearing(newlat[2],newlon[2],newlat[nearyneighbor[2]],newlon[nearyneighbor[2]]);
		document.getElementById("status3").innerHTML = "node address 2; closest node: "+nearyneighbor[2]+" at: "+nearydis[2]+" azimuth: "+azzy3;
		
		var azzy4 = getBearing(newlat[3],newlon[3],newlat[nearyneighbor[3]],newlon[nearyneighbor[3]]);
		document.getElementById("status4").innerHTML = "node address 3; closest node: "+nearyneighbor[3]+" at: "+nearydis[3]+" azimuth: "+azzy4;

		var azzy5 = getBearing(newlat[4],newlon[4],newlat[nearyneighbor[4]],newlon[nearyneighbor[4]]);
		document.getElementById("status5").innerHTML = "node address 4; closest node: "+nearyneighbor[4]+" at: "+nearydis[4]+" azimuth: "+azzy5;
	
	
		// 
		// for a point find the closest neighbor
		//    calculate the azimuth and distance to the point
		// if the distance is more than 0.01, the move toward the other point
		// if the distance is less than 0.005, move away from the other point
		//

		
		
		
		for (var loop3=0;loop3<observationsize;loop3++)
			{
			
			// make it so there is a preference for forward motion. forward, slightly to the left, or slightly to the right in each step.
			// eight directions --- queens case
			
			switch(priordirection[(loop3)])
				{
				case 1: //north
					computerResponse = getRandomInt(1, 3);
					if (computerResponse == 3) {
						computerResponse = 8;
						}
					mydirection = computerResponse;
					break;
				case 2: //northwest
					computerResponse = getRandomInt(1, 3);
					mydirection = computerResponse;
					break;
				case 3: //west
					computerResponse = getRandomInt(2, 4);
					mydirection = computerResponse;
					break;
				case 4: //southwest
					computerResponse = getRandomInt(3, 5);
					mydirection = computerResponse;
					break;
				case 5: //south
					computerResponse = getRandomInt(4, 6);
					mydirection = computerResponse;
					break;
				case 6: // southeast
					computerResponse = getRandomInt(5, 7);
					mydirection = computerResponse;
					break;
				case 7: // east
					computerResponse = getRandomInt(6, 8);
					mydirection = computerResponse;
					break;
				case 8: // northeast
					computerResponse = getRandomInt(7, 9);
					if (computerResponse == 9) {
						computerResponse = 1;
						}
					mydirection = computerResponse;
					break;
				default:
					mydirection = Math.floor((Math.random()*8)+1);
					priordirection[0] = mydirection;
					break;
				}
				
			
			
			switch(mydirection)
				{
				case 1: // north
					newlat[loop3] = newlat[loop3] + 0.001;
					newlon[loop3] = newlon[loop3] + 0.000;
					priordirection[loop3] = mydirection;
					break;
				case 2: // northwest
					newlat[loop3] = newlat[loop3] + 0.0007071067811865;
					newlon[loop3] = newlon[loop3] - 0.0007071067811865;
					priordirection[loop3] = mydirection;
					break;
				case 3: // west
					newlat[loop3] = newlat[loop3] + 0.000;
					newlon[loop3] = newlon[loop3] - 0.001;
					priordirection[loop3] = mydirection;
					break;
				case 4: // southwest
					newlat[loop3] = newlat[loop3] - 0.0007071067811865;
					newlon[loop3] = newlon[loop3] - 0.0007071067811865;
					priordirection[loop3] = mydirection;
					break;
				case 5: // south
					newlat[loop3] = newlat[loop3] - 0.001;
					newlon[loop3] = newlon[loop3] + 0.000;
					priordirection[loop3] = mydirection;
					break;
				case 6: // southeast
					newlat[loop3] = newlat[loop3] - 0.0007071067811865;
					newlon[loop3] = newlon[loop3] + 0.0007071067811865;
					priordirection[loop3] = mydirection;
					break;
				case 7: // east
					newlat[loop3] = newlat[loop3] + 0.000;
					newlon[loop3] = newlon[loop3] + 0.001;
					priordirection[loop3] = mydirection;
					break;
				case 8: // northwest
					newlat[loop3] = newlat[loop3] + 0.0007071067811865;
					newlon[loop3] = newlon[loop3] + 0.0007071067811865;
					priordirection[loop3] = mydirection;
					break;
				}			
			marker[loop3].setLatLng(L.latLng(newlat[loop3],newlon[loop3]));	
			}
		
	}, 50);
	
	for (var loop4=0;loop4<observationsize;loop4++)
		{
		marker[loop4].addTo(map);
		};
	
	
  </script>
  <p id="awesome">status 1</p>
  <p id="status2">status 2</p>
  <p id="status3">status 3</p>
  <p id="status4">status 4</p>
  <p id="status5">status 5</p>
  

</body>
</html>