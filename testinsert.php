<?php

  $connection_string = "host=localhost port=5432 dbname=glennonbase user=postgres password=awesome";
  $dbconnection= pg_connect($connection_string) or die("no dice");
  
  $thequery = "INSERT INTO testone (name, number) VALUES ('alang',33)";
  $results = pg_exec($thequery);
  
  echo $results;
  
?>