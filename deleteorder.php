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

//function to clean input but not validate type and content
function cleanInput($data) {  
  return htmlspecialchars(stripslashes(trim($data)));
}

//retrieve the itemid from the URL
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = $_GET['id'];
    if (empty($id) or !is_numeric($id)) {
        echo "<h2>Invalid Food Item ID</h2>"; //simple error feedback
        exit;
    } 
}

//check if we are saving data first by checking if the submit button exists in the array
if (isset($_POST['submit']) and !empty($_POST['submit']) and ($_POST['submit'] == 'Delete')) {     
    $error = 0; //clear our error flag
    $msg = 'Error: ';  
//itemID (sent via a form it is a string not a number so we try a type conversion!)    
    if (isset($_POST['id']) and !empty($_POST['id']) and is_integer(intval($_POST['id']))) {
       $id = cleanInput($_POST['id']); 
    } else {
       $error++; //bump the error flag
       $msg .= 'Invalid Food Item ID '; //append error message
       $id = 0;  
    }

//delete item from orderlines if existing
    if ($error == 0 and $id > 0) {
        $query = "DELETE FROM orderlines WHERE orderID=?";
        $stmt = mysqli_prepare($DBC,$query); //prepare the query
        mysqli_stmt_bind_param($stmt,'i', $id); 
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);    
        //echo "<h2>Order ID #$id has been deleted!</h2>";     
        
    } else { 
      echo "<h2>$msg</h2>".PHP_EOL;
    }     
    
//save the delete item if the error flag is still clear and food item id is > 0
    if ($error == 0 and $id > 0) {
        $query = "DELETE FROM orders WHERE orderID=?";
        $stmt = mysqli_prepare($DBC,$query); //prepare the query
        mysqli_stmt_bind_param($stmt,'i', $id); 
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);    
        echo "<h2>Order ID #$id has been deleted!</h2>";     
        
    } else { 
      echo "<h2>$msg</h2>".PHP_EOL;
    }          
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
            echo "<fieldset><legend>Order details #$id</legend><dl>";
            $row = mysqli_fetch_assoc($result);
            echo "<dt>Date & time ordered for</dt><dd>".$row['orderon']."</dd>".PHP_EOL;
            echo "<dt>Customer name:</dt><dd>".$row['lastname'].", ".$row['firstname']."</dd>".PHP_EOL;
            echo "<dt>Extras:</dt><dd>".$row['pizzaextras']."</dd>".PHP_EOL;
            echo "<dt>Pizzas:</dt><dd>".$row['pizza']." X ".$row['qty']."</dd>".PHP_EOL;
            while ($row = mysqli_fetch_array($result)) {
                echo "<dd>".$row['pizza']." X ".$row['qty']."</dd>".PHP_EOL;
                } 
            echo "</dl></fieldset>".PHP_EOL;
            ?><form method="POST" action="deleteorder.php">
                <h2>Are you sure you want to delete this order?</h2>
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="submit" name="submit" value="Delete">
                <a href="listorders.php">[Cancel]</a>
            </form>
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