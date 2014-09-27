<?php

/*
 * Authors: Doug Lawrie and Alan Glennon
 * Data: NOVA Campolide Campus, Portugal
 * Date: 19 November 2013
 * MIT License
 */
 
  // the files Dijkstra.php, network.php, pather.php, and PriorityQueue.php all go together.
 // run via pather.php?start=A&end=B
 // or something like that.
 
 
 
require("Dijkstra.php");
require("network.php");

function runTest() {
	$g = new Graph();
	// from - to nodes; distance in meters
	$g->addedge("A","H",275.4);
	$g->addedge("A","F",308.2);
	$g->addedge("A","C",189.9);
	$g->addedge("A","B",401.5);
	$g->addedge("A","J",307.1);
	$g->addedge("A","D",332.6);
	$g->addedge("A","I",98.3);
	$g->addedge("B","C",283.2);
	$g->addedge("B","D",108.6);
	$g->addedge("B","F",363.6);
	$g->addedge("B","H",197.3);
	$g->addedge("C","A",189.9);
	$g->addedge("C","B",283.2);
	$g->addedge("C","D",310.1);
	$g->addedge("C","F",117.3);
	$g->addedge("D","A",332.6);
	$g->addedge("D","B",108.6);
	$g->addedge("D","C",310.1);
	$g->addedge("D","F",390.6);
	$g->addedge("B","J",107.5);
	$g->addedge("B","I",313.1);
	$g->addedge("C","I",138.3);
	$g->addedge("C","J",285.2);
	$g->addedge("D","H",224.3);
	$g->addedge("D","I",241.7);
	$g->addedge("D","J",56.9);
	$g->addedge("E","F",72.8);
	$g->addedge("F","A",308.2);
	$g->addedge("F","B",363.6);
	$g->addedge("F","C",117.3);
	$g->addedge("F","D",390.6);
	$g->addedge("F","E",72.8);
	$g->addedge("F","G",60.6);
	$g->addedge("F","H",27.2);
	$g->addedge("F","I",256.6);
	$g->addedge("F","J",365.7);
	$g->addedge("G","F",60.6);
	$g->addedge("G","H",66.0);
	$g->addedge("H","A",275.4);
	$g->addedge("H","B",197.3);
	$g->addedge("H","C",107.3);
	$g->addedge("H","D",224.3);
	$g->addedge("H","F",27.2);
	$g->addedge("H","G",66.0);
	$g->addedge("H","I",223.8);
	$g->addedge("H","J",199.4);
	$g->addedge("I","A",98.3);
	$g->addedge("I","B",313.1);
	$g->addedge("I","C",138.3);
	$g->addedge("I","D",241.7);
	$g->addedge("I","F",256.6);
	$g->addedge("I","H",223.8);
	$g->addedge("I","J",226.3);
	$g->addedge("J","A",307.1);
	$g->addedge("J","B",107.5);
	$g->addedge("J","C",285.2);
	$g->addedge("J","D",56.9);
	$g->addedge("J","F",365.7);
	$g->addedge("J","H",199.4);
	$g->addedge("J","I",226.3);
	
	$startingplace = ($_GET["start"]);
	$endingplace = ($_GET["end"]);

	
	list($distances, $prev) = $g->paths_from($startingplace);
	
	
	$path = $g->paths_to($prev, $endingplace);
	
	return $path;


	
}


$newpath = runTest();


	$numberofvertices = count($newpath);
	// note, number of vertex-to-vertex paths will be this number minus 1
	
	$summation = 0;
	
	for ($i = 0; $i < ($numberofvertices-1); $i++) {
		echo "reach: ".$newpath[$i].$newpath[($i+1)]." is ".$mynetwork[$newpath[$i].$newpath[($i+1)]]." meters<br />";
		$summation = $summation + $mynetwork[$newpath[$i].$newpath[($i+1)]];
	}
	echo "summation: ".$summation."<br />";
	
	
	echo "number of vertices in path: ".$numberofvertices."<br />";
	
	print_r($newpath);
	
	echo "<br />";

?>

	
	