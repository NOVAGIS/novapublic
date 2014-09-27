<?php


  // replace these variables with your real ones
  $connection_string = "host=localhost port=5432 dbname=yourdatabasename user=postgres password=yourpassword";
  $dbconnection= pg_connect($connection_string) or die("no dice");
  
  $thequery = "INSERT INTO testone (name, number) VALUES ('alang',33)";
  $results = pg_exec($thequery);
  
  echo $results;
  
?>