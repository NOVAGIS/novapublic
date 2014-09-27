<?php
  $newtime = time();
  $newlatitude        = $_POST["lat"];
  $newlongitude       = $_POST["lon"];
  $newgpsaccuracy     = $_POST["acc"];
  $newusercomment     = $_POST["att"];
  $newcontributorname = $_POST["use"];  
  
  $newssidname        = $_POST['ssid'];
  $newmacaddress      = $_POST['mac'];
  $newlastpingtime    = $_POST['ping'];
  $newwifistrength    = $_POST["str"];
  
  $newincominglength  = $_POST["sizer"];
  
  $File = "wifistrength2.txt"; 
  $Data = $newincominglength." ".time()." ".$newlatitude." ".$newlongitude." ".$newgpsaccuracy." ".$newusercomment." ".$newcontributorname." ".$newssidname." ".$newmacaddress." ".$newlastpingtime." ".$newwifistrength."\r"; 
  file_put_contents($File, $Data, FILE_APPEND | LOCK_EX); 
  
  $connection_string = "host=localhost port=5432 dbname=yourdatabasenamehere user=postgres password=yourpasswordhere";
  $dbconnection= pg_connect($connection_string) or die("no dice");
  
  $thequery = "INSERT INTO wifitable (mytimecode,latitude,longitude,locationaccuracy,usercomment,contributorname,ssidname,macaddress,lastpingtime,wifiquality,geopoint) VALUES ($newtime,$newlatitude,$newlongitude,$newgpsaccuracy,'$newusercomment','$newcontributorname','$newssidname','$newmacaddress',$newlastpingtime,$newwifistrength,ST_SetSRID(ST_MakePoint($newlongitude, $newlatitude), 4326))";
  $results = pg_exec($thequery);
  
?>