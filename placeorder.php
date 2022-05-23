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
    <title>Waipukurau Pizzeria - Place an order</title>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="script.js"></script>
</head>
<body>

<?php

    include "config.php"; //load in any variables
    $DBC = mysqli_connect("127.0.0.1", DBUSER, DBPASSWORD, DBDATABASE);



    if (mysqli_connect_errno()) {
        echo "Error: Unable to connect to MySQL. ".mysqli_connect_error() ;
        exit; //stop processing the page further
  };
function pr($data){
    echo '<pre>'.print_r($data,true).'</pre>';
    exit;
}

    //function to clean input but not validate type and content
function cleanInput($data) {  
    return htmlspecialchars(stripslashes(trim($data)));
  }
  
  //the data was sent using a formtherefore we use the $_POST instead of $_GET
  //check if we are saving data first by checking if the submit button exists in the array
  if (isset($_POST['submit']) and !empty($_POST['submit']) and ($_POST['submit'] == 'Place Order')) {
    //if ($_SERVER["REQUEST_METHOD"] == "POST") { //alternative simpler POST test    
    //pr($_POST);
    //validate data incoming from form
    //this needs to send datetime-local to the server
    $error = 0; //clear our error flag
    $msg = 'Error: ';
    if (isset($_POST['orderon']) and !empty($_POST['orderon']) and is_string($_POST['orderon'])) {
      $orderon = cleanInput($_POST['orderon']); 
      //we would also do context checking here for contents, etc       
    } else {
      $error++; //bump the error flag
      $msg .= 'Invalid order date/time '; //append eror message
      $orderon = '';  
    } 

    //extras to post
    if (isset($_POST['extras']) and !empty($_POST['extras']) and is_string($_POST['extras'])) {
        $extras = cleanInput($_POST['extras']);        
        //$extras = (strlen($ex)>200)?substr($ex,0,200):$ex; //check length and clip if too big   
    } else {
        $error++; //bump the error flag
        $msg .= 'Invalid description  '; //append eror message
        $extras = '';  
    }
    
    //Post orderon and extras values to the database
    if ($error == 0) {
        $customerID = getCustomerID();
        $query = "INSERT INTO orders (orderon,pizzaextras,customerID) VALUES (?,?,?)";
        $stmt = mysqli_prepare($DBC,$query) or die(mysqli_error($DBC)); //prepare the query
        mysqli_stmt_bind_param($stmt,'ssi', $orderon, $extras, $customerID); 
        mysqli_stmt_execute($stmt) or die(mysqli_error($DBC));
        mysqli_stmt_close($stmt);    

        $orderID = mysqli_insert_id($DBC);
        //pr($_POST);
    foreach($_POST['items'] as $orderItem){
        $query = "INSERT INTO orderlines (orderID,itemID,qty) VALUES (?,?,?)";
        $stmt = mysqli_prepare($DBC,$query) or die(mysqli_error($DBC)); //prepare the query
        mysqli_stmt_bind_param($stmt,'iii', $orderID, $orderItem['itemID'], $orderItem['qty']); 
        mysqli_stmt_execute($stmt) or die(mysqli_error($DBC));
        mysqli_stmt_close($stmt);
}

    echo "<h2>Order placed!</h2>";        
    } else { 
      echo "<h2>$msg</h2>".PHP_EOL;
    }
}


// Preparing query to bring pizza data into the option value html tag
//This is commented out, this query is to bring the pizza data from SQL data base into order form (not implemented)
$query = 'SELECT itemID, pizza, pizzatype, price FROM fooditems ORDER BY itemID';
$result = mysqli_query($DBC,$query);
$rowcount = mysqli_num_rows($result);
?>


<h1>Place an order</h1>
<h2><a href="listorders.php">[Return to the Orders listing]</a><a href="index.php">[Return to the main page]</a></h2>
<h3>Pizza order</h3>

<form method="POST" action="placeorder.php">
<p>
    <label for="orderon">Order for (date & time):</label>
    <input type="datetime-local" name="orderon" id="orderon" required>
</p>
<p>
    <label for="extras">Extras:</label>
    <input type="text" name="extras" max="200">
</p>

<h4>Pizzas for this order:</h4>
    <table id="pizzaTable">
<tr><td>
    <select id="defaultOptions" name="items[1][itemID]">
<?php
        if ($rowcount > 0) {
            while($row = mysqli_fetch_array($result)) {
            $id = $row['itemID'];
            echo '<option value="'.$id.'">'.$row['pizza'].' ('.$row['pizzatype'].') $'.$row['price'].'</option>';
            }
        } else {
            echo '<p>No pizza found in database</p>';
        }
        echo '</select>';
        mysqli_free_result($result); //free any memory used by the query
        mysqli_close($DBC); //close the connection once done
?>
</select>
</td>

<td>
    <input type="number" name="items[1][qty]" min="1" max="10" value="1"></td>
</tr>
</table>
    <input type="button" class="button" id="addItem" value="Add Item" onclick="addPizza()"><br><br>
    <input type="submit" name="submit" value="Place Order">
     <a href="listorders.php">[Cancel]</a>
</form>

<!-- JavaScript for adding item to place order page -->
    <script>
    var totalItems=1;
    function addPizza()
    {
         totalItems++;
        var x =document.getElementById('pizzaTable').insertRow();
        var y = x.insertCell(0);
        var z = x.insertCell(1);
        var a = x.insertCell(2);
        y.innerHTML="<select name='items["+totalItems+"][itemID]'>"+document.getElementById('defaultOptions').innerHTML+"</select>";
        z.innerHTML="<input type='number' name='items["+totalItems+"][qty]' min='1' max='10'>";
        a.innerHTML+="<input type='button' class='button' value='Delete' onClick='deletePizza(1)'></input>";
    }
    function deletePizza(row) 
    {
        var i = row.parentNode.row.parentNode.rowIndex;
        document.getElementById('pizzaTable').deletePizza(i);
    }
    </script>
</body>
</html>

