<?php
  $newlat = $_POST["lat"];
  $newlon = $_POST["lon"];
  $newacc = $_POST["acc"];
  $newatt = $_POST["att"];
  $newuse = $_POST["use"];  
  $newstr = $_POST["str"];
  
  $File = "wifistrength.txt"; 
  $Data = time()." ".$newlat." ".$newlon." ".$newacc." ".$newatt." ".$newuse." ".$newstr."\r\r"; 
  file_put_contents($File, $Data, FILE_APPEND | LOCK_EX); 

?>