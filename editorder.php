<?php
include "header.php";
include "menu.php";
include "checksession.php";
checkUser();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Waipukurau Pizzeria - Edit an order</title>
    <!--CSS Stylesheet for datetime picker (flatpickr)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <!--CSS to style select box-->
    <style>
        select {
        width: 150px;
        margin: 5px;
    }
    </style>
</head>
<body>
    <!--Fields are not required as the customer may wish to only change one field-->
<div id="body">
<div class="header">
    <div>
    <h1>Order details update</h1>
    </div>
  </div>
  <div class="footer">
  <div class="article">
    <h2><a href="listorders.php">[Return to the Orders listing]</a><a href="index.php">[Return to the main page]</a></h2>
    <h3>Pizza order for customer Admin, Admin</h3>
    <form action="">
    <label for="editordertime">Order for (date & time):</label>
    <input type="datetime-local" name="editordertime" id="editordertime"><br><br>
    <label for="extras">Extras:</label>
    <input type="text" name="extras" max="200">
    <h4>Pizzas for this order:</h4>
        <label for="pizzatype">1:</label>
        <select name="pizzatype" id="pizzatype">
            <option value="none" selected disabled hidden>none</option> 
            <option value="pizza1">Pizza 1 (S) $10</option> 
            <option value="pizza2">Pizza 2 (S) $10</option>
            <option value="pizza3">Pizza 3 (S) $6</option>
            <option value="pizza4">Pizza 4 (S) $6</option>
            <option value="pizza5">Pizza 5 (S) $8</option>
            <option value="pizza6">Pizza 6 (S) $7</option>
            <option value="pizza7">Pizza 7 (S) $8</option>
            <option value="pizza8">Pizza (S) $9</option>
            <option value="pizza9">Pizza 9 (V) $9</option>
            <option value="pizza10">Pizza 10 (V) $6</option>
            <option value="pizza10">Pizza 11 (V) $6</option>
            <option value="pizza10">Pizza 12 (V) $7</option>
            <input type="number" name="quantity" min="1" max="10"><br><br>
        </select>
        <label for="pizzatype">2:</label>
        <select name="pizzatype">
            <option value="none" selected disabled hidden>none</option> 
            <option value="pizza1">Pizza 1 (S) $10</option> 
            <option value="pizza2">Pizza 2 (S) $10</option>
            <option value="pizza3">Pizza 3 (S) $6</option>
            <option value="pizza4">Pizza 4 (S) $6</option>
            <option value="pizza5">Pizza 5 (S) $8</option>
            <option value="pizza6">Pizza 6 (S) $7</option>
            <option value="pizza7">Pizza 7 (S) $8</option>
            <option value="pizza8">Pizza (S) $9</option>
            <option value="pizza9">Pizza 9 (V) $9</option>
            <option value="pizza10">Pizza 10 (V) $6</option>
            <option value="pizza10">Pizza 11 (V) $6</option>
            <option value="pizza10">Pizza 12 (V) $7</option>
            <input type="number" name="quantity" min="1" max="10"><br><br>
        </select>
        <label for="pizzatype">3:</label>
        <select name="pizzatype">
            <option value="none" selected disabled hidden>none</option>
            <option value="pizza1">Pizza 1 (S) $10</option> 
            <option value="pizza2">Pizza 2 (S) $10</option>
            <option value="pizza3">Pizza 3 (S) $6</option>
            <option value="pizza4">Pizza 4 (S) $6</option>
            <option value="pizza5">Pizza 5 (S) $8</option>
            <option value="pizza6">Pizza 6 (S) $7</option>
            <option value="pizza7">Pizza 7 (S) $8</option>
            <option value="pizza8">Pizza (S) $9</option>
            <option value="pizza9">Pizza 9 (V) $9</option>
            <option value="pizza10">Pizza 10 (V) $6</option>
            <option value="pizza10">Pizza 11 (V) $6</option>
            <option value="pizza10">Pizza 12 (V) $7</option>
            <input type="number" name="quantity" min="1" max="10"><br><br>
        </select>
        <label for="pizzatype">4:</label>
        <select name="pizzatype">
            <option value="none" selected disabled hidden>none</option> 
            <option value="pizza1">Pizza 1 (S) $10</option> 
            <option value="pizza2">Pizza 2 (S) $10</option>
            <option value="pizza3">Pizza 3 (S) $6</option>
            <option value="pizza4">Pizza 4 (S) $6</option>
            <option value="pizza5">Pizza 5 (S) $8</option>
            <option value="pizza6">Pizza 6 (S) $7</option>
            <option value="pizza7">Pizza 7 (S) $8</option>
            <option value="pizza8">Pizza (S) $9</option>
            <option value="pizza9">Pizza 9 (V) $9</option>
            <option value="pizza10">Pizza 10 (V) $6</option>
            <option value="pizza10">Pizza 11 (V) $6</option>
            <option value="pizza10">Pizza 12 (V) $7</option>
            <input type="number" name="quantity" min="1" max="10"><br><br>
        </select>
        <label for="pizzatype">5:</label>
        <select name="pizzatype">
            <option value="none" selected disabled hidden>none</option> 
            <option value="pizza1">Pizza 1 (S) $10</option> 
            <option value="pizza2">Pizza 2 (S) $10</option>
            <option value="pizza3">Pizza 3 (S) $6</option>
            <option value="pizza4">Pizza 4 (S) $6</option>
            <option value="pizza5">Pizza 5 (S) $8</option>
            <option value="pizza6">Pizza 6 (S) $7</option>
            <option value="pizza7">Pizza 7 (S) $8</option>
            <option value="pizza8">Pizza (S) $9</option>
            <option value="pizza9">Pizza 9 (V) $9</option>
            <option value="pizza10">Pizza 10 (V) $6</option>
            <option value="pizza10">Pizza 11 (V) $6</option>
            <option value="pizza10">Pizza 12 (V) $7</option>
            <input type="number" name="quantity" min="1" max="10"><br><br>
        </select>
        <label for="pizzatype">6:</label>
        <select name="pizzatype">
            <option value="none" selected disabled hidden>none</option> 
            <option value="pizza1">Pizza 1 (S) $10</option> 
            <option value="pizza2">Pizza 2 (S) $10</option>
            <option value="pizza3">Pizza 3 (S) $6</option>
            <option value="pizza4">Pizza 4 (S) $6</option>
            <option value="pizza5">Pizza 5 (S) $8</option>
            <option value="pizza6">Pizza 6 (S) $7</option>
            <option value="pizza7">Pizza 7 (S) $8</option>
            <option value="pizza8">Pizza (S) $9</option>
            <option value="pizza9">Pizza 9 (V) $9</option>
            <option value="pizza10">Pizza 10 (V) $6</option>
            <option value="pizza10">Pizza 11 (V) $6</option>
            <option value="pizza10">Pizza 12 (V) $7</option>
            <input type="number" name="quantity" min="1" max="10"><br><br>
        </select>
        <label for="pizzatype">7:</label>
        <select name="pizzatype">
            <option value="none" selected disabled hidden>none</option> 
            <option value="pizza1">Pizza 1 (S) $10</option> 
            <option value="pizza2">Pizza 2 (S) $10</option>
            <option value="pizza3">Pizza 3 (S) $6</option>
            <option value="pizza4">Pizza 4 (S) $6</option>
            <option value="pizza5">Pizza 5 (S) $8</option>
            <option value="pizza6">Pizza 6 (S) $7</option>
            <option value="pizza7">Pizza 7 (S) $8</option>
            <option value="pizza8">Pizza (S) $9</option>
            <option value="pizza9">Pizza 9 (V) $9</option>
            <option value="pizza10">Pizza 10 (V) $6</option>
            <option value="pizza10">Pizza 11 (V) $6</option>
            <option value="pizza10">Pizza 12 (V) $7</option>
            <input type="number" name="quantity" min="1" max="10"><br><br>
        </select>
        <label for="pizzatype">8:</label>
        <select name="pizzatype">
            <option value="none" selected disabled hidden>none</option> 
            <option value="pizza1">Pizza 1 (S) $10</option> 
            <option value="pizza2">Pizza 2 (S) $10</option>
            <option value="pizza3">Pizza 3 (S) $6</option>
            <option value="pizza4">Pizza 4 (S) $6</option>
            <option value="pizza5">Pizza 5 (S) $8</option>
            <option value="pizza6">Pizza 6 (S) $7</option>
            <option value="pizza7">Pizza 7 (S) $8</option>
            <option value="pizza8">Pizza (S) $9</option>
            <option value="pizza9">Pizza 9 (V) $9</option>
            <option value="pizza10">Pizza 10 (V) $6</option>
            <option value="pizza10">Pizza 11 (V) $6</option>
            <option value="pizza10">Pizza 12 (V) $7</option>
            <input type="number" name="quantity" min="1" max="10"><br><br>
        </select>
        <label for="pizzatype">9:</label>
        <select name="pizzatype">
            <option value="none" selected disabled hidden>none</option> <!--Needs error checking to ensure customer cannot enter none as pizza type-->
            <option value="pizza1">Pizza 1 (S) $10</option> <!--Check value name, most likely wrong-->
            <option value="pizza2">Pizza 2 (S) $10</option>
            <option value="pizza3">Pizza 3 (S) $6</option>
            <option value="pizza4">Pizza 4 (S) $6</option>
            <option value="pizza5">Pizza 5 (S) $8</option>
            <option value="pizza6">Pizza 6 (S) $7</option>
            <option value="pizza7">Pizza 7 (S) $8</option>
            <option value="pizza8">Pizza (S) $9</option>
            <option value="pizza9">Pizza 9 (V) $9</option>
            <option value="pizza10">Pizza 10 (V) $6</option>
            <option value="pizza10">Pizza 11 (V) $6</option>
            <option value="pizza10">Pizza 12 (V) $7</option>
            <input type="number" name="quantity" min="1" max="10"><br><br>
        </select>
        <label for="pizzatype">10:</label>
        <select name="pizzatype">
            <option value="none" selected disabled hidden>none</option> <!--Needs error checking to ensure customer cannot enter none as pizza type-->
            <option value="pizza1">Pizza 1 (S) $10</option> <!--Check value name, most likely wrong-->
            <option value="pizza2">Pizza 2 (S) $10</option>
            <option value="pizza3">Pizza 3 (S) $6</option>
            <option value="pizza4">Pizza 4 (S) $6</option>
            <option value="pizza5">Pizza 5 (S) $8</option>
            <option value="pizza6">Pizza 6 (S) $7</option>
            <option value="pizza7">Pizza 7 (S) $8</option>
            <option value="pizza8">Pizza (S) $9</option>
            <option value="pizza9">Pizza 9 (V) $9</option>
            <option value="pizza10">Pizza 10 (V) $6</option>
            <option value="pizza10">Pizza 11 (V) $6</option>
            <option value="pizza10">Pizza 12 (V) $7</option>
            <input type="number" name="quantity" min="1" max="10"><br><br>
        </select>
        <input type="submit" value="Update" name="updateorder" id="updateorder"><a href="editorder.php">[Cancel]</a>
    </form>

    <!--JavaScript for datetime picker (flatpickr)-->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        config = {
            enableTime: true,
            dateFormat: "Y-m-d H:i",
            minDate: "today" //Added min date of today to prevent user from booking previous date
        }
        flatpickr("input[type=datetime-local]", config);
    </script>
     </div>
    </div>
</div>
</body>
</html>
<?php 
include "footer.php";
?>