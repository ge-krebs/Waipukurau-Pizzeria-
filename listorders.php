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
    <title>Waipukurau Pizzeria - Current orders</title>
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

//insert DB code from here onwards
//check if the connection was good
if (mysqli_connect_errno()) {
    echo "Error: Unable to connect to MySQL. ".mysqli_connect_error() ;
    exit; //stop processing the page further
}

//Prepare query to send to server
$query = 'SELECT orderID,firstname,lastname,orderon FROM orders, customer WHERE orders.customerID = customer.customerID';
$result = mysqli_query($DBC,$query);
$rowcount = mysqli_num_rows($result);

?>
<h1>Current Orders</h1>
<h2><a href="placeorder.php">[Place an order]</a><a href="index.php">[Return to main page]</a></h2>
<table border="1">
<thead><th>Orders (Date of order, Order number)</th><th>Customer</th><th>Actions</th></tr></thead>

<?php

//Make sure there are orders/diplay results
if ($rowcount > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['orderID'];
        echo '<tr><td>'.$row['orderon'].' ('.$row['orderID'].')'.'</td>';
        echo '<td>'.$row['lastname'].', '.$row['firstname'].'</td>';
        echo '<td><a href="vieworder.php?id='.$id.'">[view]</a>';
        echo '<a href="editorder.php?id='.$id.'">[edit]</a>';
        echo '<a href="deleteorder.php?id='.$id.'">[delete]</a></td>';
        echo '</tr>'.PHP_EOL;
    }
} else {
    echo "<h2>No orders found!</h2>";
}
mysqli_free_result($result); //free memory
mysqli_close($DBC); //close connection once done
?>
</body>
</html>