<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Waipukurau Pizzeria - Current Bookings</title>
    <!--Style for draft table-->
    <style>
        table {
            font-family: 'Times New Roman', Times, serif;
        }
        td, th {
            border: 0.5px solid black;
        }
    </style>
</head>
<body>

    <?php
    include "config.php"; //load in any variables
    $DBC = mysqli_connect("127.0.0.1", DBUSER, DBPASSWORD, DBDATABASE);
    
    if (mysqli_connect_errno()) {
        echo "Error: Unable to connect to MySQL. ".mysqli_connect_error() ;
        exit;
    }
    
    $query = 'SELECT bookingID,customerID,telephone,bookingdate,people FROM booking';
    $result = mysqli_query($DBC,$query);
    $rowcount = mysqli_num_rows($result); 
    ?>

    <!--Data for bookingdate, people, firstname, lastname, & telephone is assumed from the assignment brief-->
    <h1>Current bookings</h1>
    <h2><a href="makebooking.php">[Make a booking]</a><a href="index.php">[Return to main page]</a></h2>
    
    <table><tr><th>Booking (date & time, people)</th><th>Customer(Telephone)</th><th>Action</th></tr>
    
    <?php
        if ($rowcount > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['bookingID'];
                echo '<tr><td>'.$row['bookingdate'].' ('.$row['people'].')'.'</td><td>'.$row['telephone'].'</td>';
                echo '<td><a href="viewbooking.php?id='.$id.'">[view]</a>';
                echo '<a href="editbooking.php?=id'.$id.'">[edit]</a>';
                echo '<a href="deletebooking.php?=id'.$id.'">[delete]</a></td>';
                echo '</tr>'.PHP_EOL;
            }
        }    
    mysqli_free_result($result); 
    mysqli_close($DBC);
    ?>
    
    </table>
</body>
</html>