<?php
include "header.php";
include "menu.php";

include "checksession.php";

include "config.php"; //load in any variables
$DBC = mysqli_connect(DBHOST, DBUSER, DBPASSWORD, DBDATABASE) or die();

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
$query = 'SELECT * FROM booking 
INNER JOIN customer ON booking.customerID = customer.customerID 
WHERE bookingID='.$id;
$result = mysqli_query($DBC,$query);
$rowcount = mysqli_num_rows($result); 
?>
<div id="body">
    <div class="header">
    <div>
        <h1>Booking details view</h1>
    </div>
    </div>
    <div class="footer">
    <div class="article">
        <h2><a href="listbookings.php">[Return to Booking listing]</a><a href="index.php">[Return to main menu]</a></h2>

        <?php

        //makes sure we have the customer
        if ($rowcount > 0) {
            echo "<fieldset><legend>Booking Detail #$id</legend><dl>";
            $row = mysqli_fetch_assoc($result);
            echo "<dt>Booking date & time:</dt><dd>".$row['bookingdate']."</dd>".PHP_EOL;
            echo "<dt>Party size:</dt><dd>".$row['people']."</dd>".PHP_EOL;
            echo "<dt>Customer:</dt><dd>".$row['lastname'].", ".$row['firstname']." (".$row['telephone'].")"."</dd></fieldset>".PHP_EOL;
        } else echo "<h2>No booking found!</h2>";

        mysqli_free_result($result); //free any memory used by the query
        mysqli_close($DBC); //close the connection once done

        ?>
    </div>
    </div>
</div>
<?php
include "footer.php";
?>