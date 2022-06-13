<?php
include "header.php";
include "menu.php";

include "checksession.php";
checkUser();

include "config.php"; //load in any variables
$DBC = mysqli_connect(DBHOST, DBUSER, DBPASSWORD, DBDATABASE) or die();

//check if the connection was good
if (mysqli_connect_errno()) {
    echo "Error: Unable to connect to MySQL. ".mysqli_connect_error() ;
    exit; //stop processing the page further
}

//do some simple validation to check if id exists
$id = $_GET['id'];
if (empty($id) or !is_numeric($id)) {
 echo "<h2>No order found!</h2>"; //simple error feedback
 exit;
} 
//prepare query to send to server

$query = 'SELECT orders.orderID, orderon, pizzaextras, firstname, lastname, qty, pizza FROM orders
INNER JOIN customer ON orders.customerID = customer.customerID
INNER JOIN orderlines ON orders.orderID = orderlines.orderID
INNER JOIN fooditems ON orderlines.itemID = fooditems.itemID
WHERE orders.orderid='.$id;
$result = mysqli_query($DBC, $query);
$rowcount = mysqli_num_rows($result);
?>
<div id="body">
    <div class="header">
    <div>  
        <h1>Pizza Order Details View</h1>
    </div>
    </div>
    <div class="footer">
    <div class="article">
        <h2><a href="listorders.php">[Return to the orders listing]</a><a href="index.php">[Return to the main page]</a></h2>

        <?php
        //make sure there are orders
        if ($rowcount > 0) {
            $row = mysqli_fetch_assoc($result);
            echo "<fieldset><legend>Order details #$id</legend><dl>";
            echo "<dt>Date & time ordered for</dt><dd>".$row['orderon']."</dd>".PHP_EOL;
            echo "<dt>Customer name:</dt><dd>".$row['lastname'].", ".$row['firstname']."</dd>".PHP_EOL;
            echo "<dt>Extras:</dt><dd>".$row['pizzaextras']."</dd>".PHP_EOL;
            echo "<dt>Pizzas:</dt>";
            echo "<dd>".$row['pizza']." X ".$row['qty']."</dd>".PHP_EOL;
            while ($row = mysqli_fetch_array($result)) {
            echo "<dd>".$row['pizza']." X ".$row['qty']."</dd>".PHP_EOL;
            } 
            } else {
            echo "</dl></fieldset>".PHP_EOL;
            } 

        mysqli_free_result($result); //free memory from the query
        mysqli_close($DBC); //close connection
        ?>
    </div>
    </div>
</div>

<?php
include "footer.php";
?>