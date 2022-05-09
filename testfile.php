<!DOCTYPE HTML>
<html><head><title>MySQL examples</title> </head>
<body>
<?php
include "config.php"; //load in any variables
$DBC = mysqli_connect("127.0.0.1", DBUSER , DBPASSWORD, DBDATABASE);
 
//check if the connection was good
if (!$DBC) {
    echo "Error: Unable to connect to MySQL.\n". mysqli_connect_errno()."=".mysqli_connect_error() ;
    exit; //stop processing the page further
};
//insert DB code from here onwards
echo "<pre>";  
//prepare a query and send it to the server
$query = 'SELECT bookingID,customerID,telephone,bookingdate,people FROM booking';
$result = mysqli_query($DBC,$query);
 
//check result for data
if (mysqli_num_rows($result) > 0) {
	/* retrieve a row from the results
	   one at a time until no rows left in the result */
    echo "Record count: ".mysqli_num_rows($result).PHP_EOL;
    while ($row = mysqli_fetch_assoc($result)) {
	  echo "booking ID ".$row['bookingID'] . PHP_EOL;
	  echo "customer ID ".$row['customerID'] . PHP_EOL;
	  echo "telephone ".$row['telephone'] . PHP_EOL;
	  echo "booking date ".$row['bookingdate'] . PHP_EOL;
      echo "people ".$row['people'] . PHP_EOL;
	  echo "<hr />";
   }
   mysqli_free_result($result); //free any memory used by the query
}
echo "</pre>";
/* show a quick confirmation that we have a connection
   this can be removed - not required for normal activities
*/
	echo "Connectted via ".mysqli_get_host_info($DBC); //show some info on the connection 
 
mysqli_close($DBC); //close the connection once done
?>
</body>
</html>