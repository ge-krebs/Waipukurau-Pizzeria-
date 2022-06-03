<?php
include "checksession.php";
checkUser();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Waipukurau Pizzeria - Edit a booking</title>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="script.js"></script>

</head>
<body>

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

    //retrieve the bookingID from the URL
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $id = $_GET['id'];
    if (empty($id) or !is_numeric($id)) {
        echo "<h2>Invalid booking ID</h2>"; //simple error feedback
        exit;
        } 
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
    
    if ($error == 0 and $id > 0) {
            $query = "UPDATE customer SET firstname=?,lastname=?,email=? WHERE customerID=?";
            $stmt = mysqli_prepare($DBC,$query); //prepare the query
            mysqli_stmt_bind_param($stmt,'sssi', $firstname, $lastname, $email,$id); 
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);    
            echo "<h2>customer details updated.</h2>";     
        } else { 
          echo "<h2>$msg</h2>".PHP_EOL;
        }  
    }

//locate booking to edit by using the bookingID
    $query = 'SELECT * FROM booking 
    INNER JOIN customer ON booking.customerID = customer.customerID
    WHERE bookingid='.$id;
    $result = mysqli_query($DBC, $query);
    $rowcount = mysqli_num_rows($result);
    if ($rowcount > 0) {
        $row = mysqli_fetch_assoc($result);
    }

?>

    <h1>Edit a booking</h1>
    <h2><a href="listbookings.php">[Return to the bookings listing]</a><a href="index.php">[Return to the main menu]</a></h2>
    <h2>Booking made for</h2> <?php $row.['lastname']?>
    <form method ="POST" action="editbooking.php">
        <input type="hidden" name="id" value="<?php echo $id;?>">
        <p>
            <label for="bookingdate">Booking date & time:</label>
            <input type="datetime-local" name="bookingdate" id="bookingdate" required value="<?php echo $row['bookingdate']; ?>">
        </p>
        <p>
            <label for="telephone">Contact number:</label>
            <input type="tel" id="telephone" name="telephone" placeholder="###-###-####" maxlength="12" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}">
        </p>
        <label for="people">Party size (# people, 1-10)</label>
        <input type="number" id="people" name="people" min="1" max="10"><br><br>
        <input type="Submit" value="Update"> 
        <a href="listbookings.php">[Cancel]</a>
    </form>
</body>
</html>