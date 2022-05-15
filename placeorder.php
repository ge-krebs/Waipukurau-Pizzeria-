<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Waipukurau Pizzeria - Place an order</title>

    <!--CSS Stylesheet for datetime picker (flatpickr)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <!--CSS to style select box-->
    <style>
        select {
        width: 150px;
        margin: 10px;
    }
    </style>

</head>
<body>
    <!--Pizza data/orders have been assumed based on the assignment brief-->
    <h1>Place an order</h1>
    <h2><a href="listorders.php">[Return to the Orders listing]</a><a href="index.php">[Return to the main page]</a></h2>
    <h3>Pizza order for customer test</h3>
    <form action="">
        <label for="ordertime">Order for (date & time):</label>
        <input type="datetime-local" name="ordertime" id="ordertime" required><br><br>
        <label for="extras">Extras:</label>
        <input type="text" name="extras" max="200">
        <h4>Pizzas for this order:</h4>
        <table id="pizzaTable">
            <tr>
                <td>
                    <select name="pizzatype" id="pizzatype">
                        <option value="none" selected disabled hidden>none</option> <!--Needs error checking to ensure customer cannot enter none as pizza type-->
                        <option value="pizza1">Pizza 1 (S) $10</option>
                        <option value="pizza2">Pizza 2 (S) $10</option>
                        <option value="pizza3">Pizza 3 (S) $6</option>
                        <option value="pizza4">Pizza 4 (S) $6</option>
                        <option value="pizza5">Pizza 5 (S) $8</option>
                        <option value="pizza6">Pizza 6 (S) $7</option>
                        <option value="pizza7">Pizza 7 (S) $8</option>
                        <option value="pizza8">Pizza (S) $9</option>
                        <option value="pizza9">Pizza 9 (V) $9</option>
                        <option value="pizza11">Pizza 10 (V) $6</option>
                        <option value="pizza12">Pizza 11 (V) $6</option>
                        <option value="pizza13">Pizza 12 (V) $7</option>
                        </select>
                </td>
                <td>
                    <input type="number" name="quantity" min="1" max="10">
                </td>
                <td>
                    <input type="submit" class="button" value="Delete" onclick="deletePizza(self);"/>
                </td>
            </tr>
        </table>
        <br>

        <input type="button" class="button" id="addItem" value="Add Item" onclick="addPizza()"><br><br>
        
        <input type="submit" value="Place Order" name="placeorder" id="placeorder"><a href="test.html">[Cancel]</a>

    </form>

    <!--JavaScript for datetime picker (flatpickr)-->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        config = {
            enableTime: true,
            dateFormat: "Y-m-d H:i",
            minDate: "today"
        }
        flatpickr("input[type=datetime-local]", config);

    //JavaScript for adding item to place order page
        function addPizza()
        {
            var x =document.getElementById('pizzaTable').insertRow();
            var y = x.insertCell(0);
            var z = x.insertCell(1);
            var a = x.insertCell(2);
            y.innerHTML="<select name='pizzatype' id='pizzatype'><option value='none' selected disabled hidden>none</option><option value='pizza1'>Pizza 1 (S) $10</option><option value='pizza2'>Pizza 2 (S) $10</option><option value='pizza3'>Pizza 3 (S) $6</option><option value='pizza4'>Pizza 4 (S) $6</option><option value='pizza5'>Pizza 5 (S) $8</option><option value='pizza6'>Pizza 6 (S) $7</option><option value='pizza7'>Pizza 7 (S) $8</option><option value='pizza8'>Pizza (S) $9</option><option value='pizza9'>Pizza 9 (V) $9</option><option value='pizza10'>Pizza 10 (V) $6</option><option value='pizza11'>Pizza 11 (V) $6</option><option value='pizza12'>Pizza 12 (V) $7</option></select>";
            z.innerHTML="<input type='number' name='pizzaamount' min='1' max='10'>"
            a.innerHTML += "<button onClick='deletePizza(self)'>Delete</button>";
        };
        function deletePizza(row) 
        {
            var i = row.parentNode.parentNode.rowIndex;
            document.getElementById('pizzaTable').deletePizza(i);
        };
    </script>
</body>
</html>