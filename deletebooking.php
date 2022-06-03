<?php
include "header.php";
include "menu.php";

include "checksession.php";
checkUser();

include "config.php"; //load in any variables
$DBC = mysqli_connect("127.0.0.1", DBUSER, DBPASSWORD, DBDATABASE);

//insert DB code from here onwards
//check if the connection was good
if (mysqli_connect_errno()) {
    echo "Error: Unable to connect to MySQL. ".mysqli_connect_error() ;
    exit; //stop processing the page further
}

//function to clean input but not validate type and content
    function cleanInput($data) {  
    return htmlspecialchars(stripslashes(trim($data)));
  }

//retrieve the bookingID from the URL
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = $_GET['id'];
    if (empty($id) or !is_numeric($id)) {
        echo "<h2>Invalid Customer ID</h2>"; //simple error feedback
        exit;
    } 
}

//the data was sent using a formtherefore we use the $_POST instead of $_GET
//check if we are saving data first by checking if the submit button exists in the array
if (isset($_POST['submit']) and !empty($_POST['submit']) and ($_POST['submit'] == 'Delete')) {     
    $error = 0; //clear our error flag
    $msg = 'Error: ';  
//bookingID (sent via a form it is a string not a number so we try a type conversion!)    
    if (isset($_POST['id']) and !empty($_POST['id']) and is_integer(intval($_POST['id']))) {
       $id = cleanInput($_POST['id']); 
    } else {
       $error++; //bump the error flag
       $msg .= 'Invalid Booking ID '; //append error message
       $id = 0;  
    }    

    //delete item from orderlines if existing
    if ($error == 0 and $id > 0) {
        $query = "DELETE FROM booking WHERE bookingID=?";
        $stmt = mysqli_prepare($DBC,$query); //prepare the query
        mysqli_stmt_bind_param($stmt,'i', $id); 
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);    
        echo "<h2>Booking has been deleted!</h2>";     
        
    } else { 
      echo "<h2>$msg</h2>".PHP_EOL;
    }  
}

    //prepare query
    $query = 'SELECT * FROM booking 
    INNER JOIN customer ON booking.customerID = customer.customerID 
    WHERE bookingID='.$id;
    $result = mysqli_query($DBC,$query);
    $rowcount = mysqli_num_rows($result); 

?>
<div id="body">
    <div class="header">
    <div>
        <h1>Booking preview before deletion</h1>
    </div>
    </div>
    <div class="footer">
    <div class="article">
        <h2><a href="listbookings.php">[Return to Bookings listing]</a><a href="index.php">[Return to main page]</a></h2>

        <?php
        //ensure we have the booking
        if ($rowcount > 0) {
            echo "<fieldset><legend>Booking Detail #$id</legend><dl>";
            $row = mysqli_fetch_assoc($result);
            echo "<dt>Booking date & time:</dt><dd>".$row['bookingdate']."</dd>".PHP_EOL;
            echo "<dt>Party size:</dt><dd>".$row['people']."</dd>".PHP_EOL;
            echo "<dt>Customer:</dt><dd>".$row['lastname'].", ".$row['firstname']." (".$row['telephone'].")"."</dd></fieldset></dl>".PHP_EOL;
        ?>
        <form method="POST" action="deletebooking.php">
            <h2>Are you sure you want to delete this booking?</h2>
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="submit" name="submit" value="Delete">
            <a href="listbookings.php">[Cancel]</a>
        <?php
        } else echo "<h2>No order found!</h2>"; //Feedback

        mysqli_free_result($result); //free memory from the query
        mysqli_close($DBC); //close connection
        ?>
    </div>
    </div>
</div>

<?php
include "footer.php";
?>