<?php
include "header.php";
include "menu.php";

include "checksession.php";
checkUser();

include "config.php"; //load in any variables
$DBC = mysqli_connect(DBHOST, DBUSER, DBPASSWORD, DBDATABASE) or die();

//insert DB code from here onwards
//check if the connection was good
if (mysqli_connect_errno()) {
    echo "Error: Unable to connect to MySQL. ".mysqli_connect_error() ;
    exit; //stop processing the page further
}

//Prepare query to send to server

if (!isAdmin()) {
    $query = 'SELECT orderID,firstname,lastname,orderon FROM orders, customer WHERE orders.customerID = customer.customerID AND customer.customerID='.$_SESSION['userid'];
} else {
    $query = 'SELECT orderID,firstname,lastname,orderon FROM orders, customer WHERE orders.customerID = customer.customerID';
}
$result = mysqli_query($DBC,$query);
$rowcount = mysqli_num_rows($result);

?>
<div id="body">
    <div class="header">
    <div>
        <h1>Current Orders</h1>
    </div>
    </div>
    <div class="footer">
    <div class="article">
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
    </table>
    </div>
    </div>
</div>

<?php
include "footer.php";
?>