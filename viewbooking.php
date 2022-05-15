<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Waipukurau Pizzeria - View booking</title>
</head>
<body>
<?php
include "config.php"; //load in any variables
$DBC = mysqli_connect("127.0.0.1", DBUSER, DBPASSWORD, DBDATABASE);

//insert DB code from here onwards
//check if the connection was good
if (mysqli_connect_errno()) {
    echo "Error: Unable to connect to MySQL. ".mysqli_connect_error() ;
    exit; //stop processing the page further
}

//do some simple validation to check if id exists
$id = $_GET['id'];
if (empty($id) or !is_numeric($id)) {
 echo "<h2>Invalid Booking ID</h2>"; //simple error feedback
 exit;
} 

//preparing a query to be sent to server
$query = 'SELECT * FROM booking WHERE bookingID='.$id;
$result = mysqli_query($DBC,$query);
$rowcount = mysqli_num_rows($result); 
?>

<h1>Booking details view</h1>
<h2><a href="listbookings.php">[Return to the booking listing]</a><a href="index.php">[Return to the main menu]</a></h2>

<?php

//makes sure we have the customer
if ($rowcount > 0) {
    echo "<fieldset><legend>Booking Detail #$id</legend><dl>";
    $row = mysqli_fetch_assoc($result);
    echo "<dt>"
}

?>
</body>
</html>