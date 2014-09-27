<?php

  // add the database, username, etc here...
  // change the fake user name and password to your real ones
  $connection_string = "host=localhost port=5432 dbname=yourdatabasename user=postgres password=yourpassword";
  $dbconnection= pg_connect($connection_string) or die("no dice");
  
  $thequery = "SELECT * FROM wifitable";
  $results = pg_exec($thequery);
  
  
echo("<table border=1>");
while ($line = pg_fetch_array($results, null, PGSQL_ASSOC)) {
    echo("<tr>");
    foreach ($line as $col_value => $row_value) {
        echo("<td>$row_value</td>");
    }
    echo("</tr>\n");
}
echo("</table>");
  
?>