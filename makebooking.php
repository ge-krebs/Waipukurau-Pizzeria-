<?php
include "checksession.php";
checkUser();
loginstatus();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Waipukurau Pizzeria - Make a booking</title>
    <!--CSS Stylesheet for datetime picker (flatpickr)-->
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

    if (isset($_POST['submit']) and !empty($_POST['submit']) and ($_POST['submit'] == 'Add')) {
        $error = 0;
        $msg = 'Error: ';
        //pr($_POST);
        if($error == 0) {
            $customerID = getCustomerID();
            $query = "INSERT INTO booking (telephone,bookingdate,people,customerID) VALUES (?,?,?,?)";
            $stmt = mysqli_prepare($DBC, $query) or die(mysqli_error($DBC));
            mysqli_stmt_bind_param($stmt, 'sssi', $telephone['telephone'], $bookingdate['bookingdate'], $people['people'], $customerID);
            mysqli_stmt_execute($stmt) or die(mysqli_error($DBC));
            mysqli_stmt_close($stmt);
            echo "<h2>Booking confirmed</h2>";
        } else {
            echo "<h2>$msg</h2>".PHP_EOL;
        }
        mysqli_close($DBC); // Close connection
    }
?>

    <h1>Make a booking</h1>
    <h2><a href="listbookings.php">[Return to the Bookings listing]</a><a href="index.php">[Return to the main page]</a></h2>
    <h2>Booking for Test</h2>

    <form method="POST" action="makebooking.php">
    <p>
        <label for="bookingdate">Booking date & time:</label>
        <input type="datetime-local" name="bookingdate" id="bookingdate">
    </p>
    <p>
        <label for="people">Party size (# people, 1-10)</label>
        <input type="number" id="people" name="people" min="1" max="10" required>
    </p>
    <p>
        <label for="telephone">Contact number:</label>
        <input type="tel" id="telephone" name="telephone" placeholder="###-###-####" maxlength="12" required> <!--pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}"-->
    </p>
        <input type="Submit" name="submit" value="Add">
        <a href="listbookings.php">[Cancel]</a>
    </form>

</body>
</html>