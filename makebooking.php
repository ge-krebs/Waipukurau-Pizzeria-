<?php
include "header.php";
include "menu.php";
include "checksession.php";
checkUser();
?>

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="script.js"></script>

<?php

    include "config.php"; //Load in any variables
    $DBC = mysqli_connect("127.0.0.1", DBUSER, DBPASSWORD, DBDATABASE);

    if (mysqli_connect_errno()) {
        echo "Error: Unable to connect to MySQL. ".mysqli_connect_error() ;
        exit; //stop processing the page further
    };

    function pr($data){
        echo '<pre>'.print_r($data,true).'</pre>';
        exit;
    }

    function cleanInput($data) {
        return htmlspecialchars(stripslashes(trim($data)));
    }

    if (isset($_POST['submit']) and !empty($_POST['submit']) and ($_POST['submit'] == 'Add')) {
        $error = 0;
        $msg = 'Error: ';
        //pr($_POST);

        if (isset($_POST['telephone']) and !empty($_POST['telephone']) and is_string($_POST['telephone'])) {
            $telephone = cleanInput($_POST['telephone']); 
          } else {
            $error++; //bump the error flag
            $msg .= 'Invalid telephone'; // eror message
            $telephone = '';  
          } 

        if (isset($_POST['bookingdate']) and !empty($_POST['bookingdate']) and is_string($_POST['bookingdate'])) {
            $bookingdate = cleanInput($_POST['bookingdate']); 
        } else {
            $error++; //bump the error flag
            $msg .= 'Invalid booking date/time '; //append eror message
            $bookingdate = '';  
        } 

        if (isset($_POST['people']) and !empty($_POST['people']) and is_string($_POST['people'])) {
            $people = cleanInput($_POST['people']); 
            //we would also do context checking here for contents, etc       
          } else {
            $error++; //bump the error flag
            $msg .= 'Invalid number for people '; //append eror message
            $people = '';  
          } 

        if($error == 0) {
            $customerID = getCustomerID();
            $query = "INSERT INTO booking (telephone,bookingdate,people,customerID) VALUES (?,?,?,?)";
            $stmt = mysqli_prepare($DBC, $query) or die(mysqli_error($DBC));
            mysqli_stmt_bind_param($stmt, 'sssi', $telephone, $bookingdate, $people, $customerID);
            mysqli_stmt_execute($stmt) or die(mysqli_error($DBC));
            mysqli_stmt_close($stmt);
            echo "<h2>Booking confirmed</h2>";
        } else {
            echo "<h2>$msg</h2>".PHP_EOL;
        }
        // mysqli_close($DBC); // Close connection
    }
?>
<div id="body">
    <div class="header">
    <div>
    <h1>Make a booking</h1>
    </div>
    </div>
    <div class="footer">
    <div class="article">
    <h2><a href="listbookings.php">[Return to Bookings listing]</a><a href="index.php">[Return to main page]</a></h2>

    <form method="POST" action="makebooking.php">
    <p>
        <label for="bookingdate">Booking date & time:</label>
        <input type="datetime-local" name="bookingdate">
    </p>
    <p>
        <label for="people">Party size (# people, 1-10)</label>
        <input type="number" name="people" min="1" max="10" required>
    </p>
    <p>
        <label for="telephone">Contact number:</label>
        <input type="tel" name="telephone" placeholder="###-###-####" maxlength="12" required> <!--pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}"-->
    </p>
        <input type="Submit" name="submit" value="Add">
        <a href="listbookings.php">[Cancel]</a>
    </form>
    </div>
    </div>

<?php
include "footer.php";
?>